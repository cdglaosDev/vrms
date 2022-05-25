<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Model\ITPRS;
use App\Helpers\GenerateCodeNo;
use DB;
use App\Helpers\DateHelper;
use App\Helpers\Helper;

class CarRegister extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Vehicle-Passbook-All|New-Register-List-View|New-Register-Entry-Edit|New-Register-Entry-Delete,New-Register-List-Create|New-Register-List-Create');
        $this->middleware('permission:New-Register-List-View');
        $this->middleware('permission:New-Register-List-Create', ['only' => ['create','store']]);
        $this->middleware('permission:New-Register-Entry-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:New-Register-Entry-Delete', ['only' => ['destroy']]);
        $this->middleware('permission:New-Register-List-Create', ['only' => ['search']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
      
        $data['car']= ITPRS::whereProvince(Helper::current_province())->orderByDesc('issue_date')->get();
       
        return view('car.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('car.register');
      
       
    }

    public function search(){
        return view('car.search');
    
    }
   
    public function getData(Request $request)
    {
     
        $url = file_get_contents("http://vdvclao.org/thongpong/c/action/simdatacdg2?pass=".$request->pass."&type=".$request->type."&division_no=".$request->division_no);
       
        if($url == "division_no is missing syntax: ?type=[vehiclereg|license]&division_no=[division_no]" || $url == null){

           return view('not-found'); 
        }else{
     
        $d1 =[];
        $data = [];
        $d1 = explode("\r\n",$url);
        $d2 = array_filter($d1);
            foreach($d2 as $d3){
                $key_value = explode(':', $d3);
                $fieldname = $key_value[0];
                $value = $key_value[1];
                $data[$fieldname] = $value;
            }
       
        Session::put(['type'=>$request->type, 'pass'=>$request->pass]);
        $data['data'] = $data;
      
        $data1['data'] =  preg_replace("/[\r\n\t]/","",$data['data']); 
      
       return view('car.register',$data1);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    //   $data=str_replace(PHP_EOL, '', $request->print_count);
   
    //   $request['print_count'] = $data[0];
        $code_no = ITPRS::whereProCode($request->pro_code)->pluck('code_no')->toArray();
        $data = $request->all();
        if(in_array($request->code_no,$code_no)){
            $latest_code =ITPRS::whereProCode($request->pro_code)->orderBy('code_no', 'desc')->select('code_no')->first();
            $data['code_no'] = GenerateCodeNo::Bcode($latest_code['code_no']); 
        }
       
        $data['issue_date']=DateHelper::dateFormat($request->issue_date);
        $data['expire_date']=DateHelper::dateFormat($request->expire_date);
       
        ITPRS::create($data);
        return redirect()->to('car-register')->with('success','Successful Register!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['data'] = ITPRS::find($id);
        $data['vehi_purpose'] = $data['data']->vehicle_purpose;
       
        return view('car.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $data = ITPRS::find($id);
        \LogActivity::saveToLog($data,$tb_name="tblitprs",$action="update");
        $request['issue_date']=DateHelper::dateFormat($request->issue_date);
        $request['expire_date']=DateHelper::dateFormat($request->expire_date);
        $data->update($request->all());
        return redirect()->to('car-register')->with('success','Successful Updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $data = ITPRS::find($id);
        \LogActivity::saveToLog($data,$tb_name="tblitprs",$action="delete");
       $data->delete();
        return back()->with('success','Successful Deleted');
    }

    public function bookNumber(){
       
        $get_number  = \App\Model\ITPRS::latest('id')->first();
        $f_trim = substr($get_number['number'],3);
        $b_trim = substr($f_trim,0,-5);

       
        $book_num= GenerateCodeNo::bookNumber($b_trim);
        return $book_num .'/'. date('Y');
        
        
    }
    public function getCode(Request $request,$code){
        $data = \App\Model\Province::whereProvinceCode($code)->select('province_code')->first();
        $b_code =\App\Model\ITPRS::whereProCode($data['province_code'])->orderBy('code_no', 'desc')->select('code_no')->first();
        $new_code = GenerateCodeNo::Bcode($b_code['code_no']);
             return response()->json([
                    'pro_code' => $data['province_code'],
                    'code_no' => $new_code
                ]);
    }
    
}
