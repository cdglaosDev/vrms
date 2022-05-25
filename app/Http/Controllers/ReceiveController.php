<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Receive;
use App\Model\ITPRS;
use DB;
use Carbon\Carbon;
use Session;
class ReceiveController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Vehicle-Passbook-All|New-Register-List-Print');
       
        $this->middleware('permission:New-Register-List-Print', ['only' => ['Print', 'getPrint']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function receive($id)
    {
        $reg_id =$id;
        return view('receive.create',compact('reg_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allReceive(){
        $data['receive'] = Receive::orderByDesc('created_at')->get();
        return view('receive.list',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeReceive(Request $request)
    {
        
        $title =$request->title;
        $amt =$request->amt;
         $count = count($title);
        for($i = 0; $i < $count; $i++){

        $data = new Receive();
        $data->reg_id = $request['reg_id'];
        $data->srno = $request['srno'];
        $data->txt1 = $request['txt1'];
        $data->txt2 = $request['txt2'];
        $data->txt3 = $request['txt3'];
        $data->txt4 = $request['txt4'];
        $data->title = $title[$i];
        $data->amt =$amt[$i];
        
        $data->save();
    }
     
  
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Receive::destroy($id);
        return back()->with('success','Successful Deleted!');
    }

    public function Print($id){
       
        $data['data'] = $this->getData($id);
        $data['yellow'] = \App\Model\VehiclePurpose::whereType("y")->pluck('id')->toArray();
        $data['green'] = \App\Model\VehiclePurpose::whereType("g")->pluck('id')->toArray();
        $data['pink'] = \App\Model\VehiclePurpose::whereType("p")->pluck('id')->toArray();
        
        return view('print.p1',$data);
    }

    public function getReport(){
        return view('report');
    }

   
    public function searchResult(Request $request){
        $start =\Carbon\Carbon::parse($request->date_from)->format('Y-m-d');
        $end = \Carbon\Carbon::parse($request->date_to)->format('Y-m-d');
        $type =$request->type;
        $data['data'] =ITPRS::whereBetween('created_at', [$start, $end])->count();
        Session::put(['start'=>$start, 'end'=>$end,'type'=>$type]);
     
        return view('result',$data);
    }
    public function getData($id){
        $data = \App\Model\VehiclePassport::where('id',$id)->first();
        return $data;
    }



   public function getPrint(Request $request,$id,$page){

       $data['data'] = $this->getData($id);
       $data['yellow'] = \App\Model\VehiclePurpose::whereType("y")->pluck('id')->toArray();
       $data['green'] = \App\Model\VehiclePurpose::whereType("g")->pluck('id')->toArray();
       $data['pink'] = \App\Model\VehiclePurpose::whereType("p")->pluck('id')->toArray();
      if($page =="p1"){
        return view('print.p1',$data);
      }else if($page =="p2"){
        return view('print.p2',$data);
      }else if($page =="p3"){
        return view('print.p3',$data);
      }else{
        return view('print.p4',$data);
      }
    }
}
