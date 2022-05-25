<?php

namespace App\Http\Controllers\Module6;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\VehiclePassport as Passport;
use App\Model\Vehicle;
use App\Helpers\Helper;
use App\Helpers\DateHelper;
use App\Helpers\GenerateCodeNo;
use Carbon\Carbon;
class VehiclePassport extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Vehicle-Passbook-All|New-Register-List-View|New-Register-Entry-Edit|New-Register-Entry-Delete|New-Register');
        $this->middleware('permission:New-Register-List-View');
        $this->middleware('permission:New-Register', ['only' => ['create', 'store']]);
        $this->middleware('permission:New-Register-Entry-Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:New-Register-Entry-Delete', ['only' => ['destroy']]);
        $this->middleware('permission:New-Register', ['only' => ['search']]);
    }
    public function index()
    { 
      
        $data['car'] = Passport::whereProvince(Helper::current_province())->whereDate('created_at', Carbon::yesterday())->orWhereDate('created_at', Carbon::today())->orderByDesc('issue_date')->paginate(10);
       
        return view('module6.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('module6.create');
      
       
    }

    public function search(){
       
        return view('module6.search');
    
    }
   
    public function getData(Request $request)
    {
        $vehicle = Vehicle::whereDivisionNo($request->division_no)->get();
        $data = \App\Helpers\getData::vehInfo();
        if ($vehicle->isEmpty()) {
            return back()->with('error', 'This division does not exit.');
            
        } else {
            if (count($vehicle) ==1) {
                $vehicle = $vehicle[0];
                $code_no = $this->codeNo($vehicle['province_code']);
                return view('module6.create', compact('vehicle', 'data', 'code_no'));
            } else {
                return view('module6.searchlist', compact('vehicle'));
            }
        }
       
    }
    // vehicle list by search division no .that is same division no
    public function searchlist(){
        $vehicle = Vehicle::whereId(request()->vehicle_id)->first();
        $data = \App\Helpers\getData::vehInfo();
        $code_no = $this->codeNo($vehicle['province_code']);
        return view('module6.create', compact('vehicle', 'data', 'code_no'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $code_no = Passport::whereProCode($request->pro_code)->pluck('code_no')->toArray();
        $data = $request->all();
        if (in_array($request->code_no,$code_no)) {
            $latest_code =Passport::whereProCode($request->pro_code)->orderBy('code_no', 'desc')->select('code_no')->first();
            $data['code_no'] = GenerateCodeNo::Bcode($latest_code['code_no']); 
        }
        $data['issue_date'] = DateHelper::dateFormat($request->issue_date);
        $data['expire_date'] = DateHelper::dateFormat($request->expire_date);
        $data['user_id'] = auth()->id();
        $data['doneat'] = request('province');
        $data = Passport::create($data);
        return redirect()->to('vehicle-passport/'.$data->id.'/'.'edit')->with('success', 'Successful Register!');
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
        $data['vehicle'] = Passport::find($id);
        $data['vehi_purpose'] = $data['vehicle']->vehicle_purpose;
        $data['data'] = \App\Helpers\getData::vehInfo();
        return view('module6.edit', $data);
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
        $data = Passport::find($id);
        \LogActivity::saveToLog($data, $tb_name = "vehicle_passports", $action = "update");
        $request['issue_date'] = DateHelper::dateFormat($request->issue_date);
        $request['expire_date'] = DateHelper::dateFormat($request->expire_date);
        $request['doneat'] = request('province');
        $data->update($request->all());
        return redirect()->to('vehicle-passport')->with('success', 'Successful Updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Passport::find($id);
        \LogActivity::saveToLog($data, $tb_name = "vehicle_passports", $action = "delete");
        $data->delete();
        return back()->with('success', 'Successful Deleted');
    }

    public function bookNumber()
    {
        $get_number  =Passport::latest('id')->first();
        $f_trim = substr($get_number['number'], 3);
        $b_trim = substr($f_trim, 0, -5);
        $book_num= GenerateCodeNo::bookNumber($b_trim);
        return $book_num .'/'. date('Y');
    }
    //get only code no depend on province come from vehicle table when searching division no
    public function codeNo($province_code)
    {
        $latest_pro_code = Passport::whereProCode($province_code)->orderBy('code_no', 'desc')->select('code_no')->first();
        $code_no = GenerateCodeNo::Bcode($latest_pro_code['code_no']);
        return $code_no;
    }

    //get province code and code no depend on change province by ajax
    public function getCode(Request $request, $code)
    {
        $data = \App\Model\Province::whereProvinceCode($code)->select('province_code')->first();
        $b_code = Passport::whereProCode($data['province_code'])->orderBy('code_no', 'desc')->select('code_no')->first();
        $new_code = GenerateCodeNo::Bcode($b_code['code_no']);
        return response()->json([
            'pro_code' => $data['province_code'],
            'code_no' => $new_code
        ]);
    }
}
