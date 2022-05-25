<?php

namespace App\Http\Controllers\Module4;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AppForm;
use Illuminate\Support\Facades\Input;
use App\Model\VehicleDocument;
use App\Model\Vehicle;
use App\Helpers\getData;
use App\Helpers\DateHelper;
use App\Helpers\Helper;
use App\Model\AppFormPurpose;
use App\Notifications\Registration;
use Auth;
use DataTables;
class ApplicationController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:App-Form-List-View');
         $this->middleware('permission:App-Form-List-Create', ['only' => ['create', 'store']]);
         $this->middleware('permission:App-Form-Entry-Edit', ['only' => ['edit', 'update']]);
         $this->middleware('permission:App-Form-Entry-Delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        switch (auth()->user()->user_status) {
            case "book_print":
                if (auth()->user()->user_level == "province") {
                    $data1 = AppForm::whereHas('vehicle', function($query) {
                        $query->where('province_code', Helper::current_province());
                    })->orwhereHas('appFormPurpose', function($purpose){
                            $purpose->whereIn('app_purpose_id', [1, 2, 3, 4, 7, 8]);
                        })->whereAppFormStatusId(5)->orderByDesc('created_at');
                    $data = AppForm::whereHas('vehicle', function($query) {
                        $query->where('province_code', Helper::current_province());
                    })->orwhereHas('appFormPurpose', function($purpose){
                            $purpose->whereIn('app_purpose_id',5);
                        })->whereAppFormStatusId(3)->union($data1)->orderByDesc('created_at');
                } else {
                    $data1 = AppForm::whereHas('appFormPurpose', function($purpose){
                        $purpose->whereIn('app_purpose_id', [1, 2, 3, 4, 7, 8]);
                    })->whereAppFormStatusId(5)->orderByDesc('created_at');
                    $data = AppForm::whereHas('appFormPurpose', function($purpose){
                        $purpose->where('app_purpose_id',5);
                    })->whereAppFormStatusId(3)->union($data1)->orderByDesc('created_at');
                } 
            break;
            case "card_print":
                if (auth()->user()->user_level == "province") {
                    $data1 = AppForm::whereHas('vehicle', function($query) {
                        $query->where('province_code', Helper::current_province());
                    })->orwhereHas('appFormPurpose', function($purpose){
                        $purpose->whereIn('app_purpose_id', [3, 4, 7, 8]);
                    })->whereAppFormStatusId(3)->orderByDesc('created_at');
                    $data = AppForm::whereHas('vehicle', function($query) {
                        $query->where('province_code', Helper::current_province());
                    })->orwhereHas('appFormPurpose', function($purpose){
                        $purpose->whereIn('app_purpose_id', [1, 2, 4]);
                    })->whereAppFormStatusId(4)->union($data1)->orderByDesc('created_at');
                } else {
                    $data1 = AppForm::whereHas('appFormPurpose', function($purpose){
                            $purpose->whereIn('app_purpose_id', [3, 4, 7, 8]);
                        })->whereAppFormStatusId(3)->orderByDesc('created_at');
                    $data = AppForm::whereHas('appFormPurpose', function($purpose){
                        $purpose->whereIn('app_purpose_id', [1, 2, 4]);
                    })->whereAppFormStatusId(4)->union($data1)->orderByDesc('created_at');
                } 
            break;
            case "license_control":
                if (auth()->user()->user_level == "province") {
                    $data = AppForm::whereHas('vehicle', function($query) {
                        $query->where('province_code', Helper::current_province());
                    })->orwhereHas('appFormPurpose', function($purpose){
                            $purpose->whereIn('app_purpose_id', [1, 2]);
                        })->whereAppFormStatusId(3)->orderByDesc('created_at');
                } else {
                    $data = AppForm::whereHas('appFormPurpose', function($purpose){
                            $purpose->whereIn('app_purpose_id', [1, 2]);
                        })->whereAppFormStatusId(3)->orderByDesc('created_at');
                } 
            break;
            case "counter_calling":
                if (auth()->user()->user_level == "province") {
                    $data1 = AppForm::whereHas('vehicle', function($query) {
                        $query->where('province_code', Helper::current_province());
                    })->orwhereHas('appFormPurpose', function($purpose){
                        $purpose->whereIn('app_purpose_id', [1, 2, 3, 4, 7, 8]);
                        })->whereAppFormStatusId(6)->orderByDesc('created_at');
                    $data = AppForm::whereHas('vehicle', function($query) {
                        $query->where('province_code', Helper::current_province());
                    })->orwhereHas('appFormPurpose', function($purpose){
                        $purpose->where('app_purpose_id', 5);
                        })->whereAppFormStatusId(4)->union($data1)->orderByDesc('created_at');
                } else {
                    $data1 = AppForm::whereHas('appFormPurpose', function($purpose){
                            $purpose->whereIn('app_purpose_id', [1, 2, 3, 4, 7, 8]);
                        })->whereAppFormStatusId(6)->orderByDesc('created_at');
                    $data = AppForm::whereHas('appFormPurpose', function($purpose){
                        $purpose->where('app_purpose_id', 5);
                    })->whereAppFormStatusId(4)->union($data1)->orderByDesc('created_at');
                } 
            break;
            case "lock_vehicle":
                if (auth()->user()->user_level == "province") {
                    $data = AppForm::whereHas('vehicle', function($query) {
                        $query->where('province_code', Helper::current_province());
                    })->orwhereHas('appFormPurpose', function($purpose){
                            $purpose->whereIn('app_purpose_id',  [1, 2, 3, 4]);
                        })->whereAppFormStatusId(3)->orderByDesc('created_at');
                } else {
                    $data = AppForm::whereHas('appFormPurpose', function($purpose){
                            $purpose->whereIn('app_purpose_id',  [1, 2, 3, 4]);
                        })->whereAppFormStatusId(3)->orderByDesc('created_at');
                } 
            break;
            default:
            if (auth()->user()->user_level == "province") {
                $data = AppForm::whereHas('vehicle', function($query) {
                        $query->where('province_code', Helper::current_province());
                    })->orderByDesc('created_at');
            } else {
                $data = AppForm::orderByDesc('created_at');
            }
        }
        $app_form = $data->get();
        return view('Module4.registration.index', compact('app_form'));
    }
    //  public function applicationList()
    //  {
    //     if (request()->ajax()) {
    //         if(auth()->user()->user_level == "admin"){
    //             $data =  AppForm::orderByDesc('date_request');
    //         }else{
    //             $data =  AppForm::whereHas('vehicle', function($query) {
    //                 $query->where('province_code', Helper::current_province());
    //             })->orderByDesc('date_request');
    //         }

    //         return DataTables::eloquent($data)
           
    //             ->addColumn('action', function (AppForm $app_form) {
    //                 return '<a href="/applications/edit/'.$app_form->id.'" class="btn btn-info">Edit</a>';
    //             })
    //             ->toJson();
    //     }
    //  }

    public function SearchAppNo()
    {
        $q = Input::get ( 'q' );
        if ($q == null) {
            return back()->with('error', "Please enter App no.");
        }
        $data['app_form'] = AppForm::where('app_no', 'LIKE', '%'.$q.'%')->first();
        $data['data'] = getData::vehInfo();
        if (count( $data['app_form']) > 0) {
            return view('Module4.registration.edit', $data);
        }
        return redirect()->route('application.create')->with('error', 'Not found your search App Number');
       
    }

    //Registration form when scan QR code by staff
    public function scanQrCode($app_no)
    {
       $data['app_form'] = AppForm::whereAppNo($app_no)->first();
       $data['veh_doc'] = VehicleDocument::whereVehicleId($data['app_form']['vehicle_id'])->get();
        return view('ApplicationForm.edit', $data);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $veh_data = getData::vehInfo();
        $app_purposes = \App\Model\AppPurpose::whereStatus(1)->get();
        return view('Module4.registration.create', compact('veh_data', 'app_purposes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'customer_name'=> 'required',
            'licence_no' => 'required',
            // There no UI for 'vehicle_kind_code'. So, comment for it.
            // 'vehicle_kind_code' => 'required',
            'brand_id' => 'required',
            'model_id' => 'required',
            'province_code' =>'required',
            'district_code' =>'required',
            'village_name' => 'required',
            'engine_no' => 'required|unique:vehicles',
            'chassis_no' => 'required|unique:vehicles',
           
        ]);
        $vehicle_id = Vehicle::create(request()->only('licence_no', 'division_no', 'province_no', 'brand_id', 'model_id', 'province_code', 'district_code', 'engine_no','chassis_no', 'village_name', 'vehicle_type_id'))->id;
      
        $app_form_id = AppForm::create([
        'date_request' => request('date_request'),
        'app_no' => request('app_no'),
        'staff_id' => request('staff_id'),
        'app_form_status_id' => 1,
        'note' => request('note'),
        'comment' => request('comment'),
        'customer_name' => request('customer_name'),
        'vehicle_id' => $vehicle_id,
        ])->id;

        $app_purpose = new \App\Library\SaveAppPurpose;
        $app_purpose->storeAppPurpose($app_form_id, request('app_purpose_id'));
        return redirect('/applications')->with('success', 'Successful new form registration.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicle = Vehicle::find($id);
        $data = getData::vehInfo();
       return view('Module4.Application.detail', compact('data','vehicle'));
    }

  

    /**
     * Show the form for editing application form.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {  
        $app_form = AppForm::find($id);
        $vehicle = Vehicle::whereId($app_form['vehicle_id'])->first();
        $veh_info = getData::vehInfo();
        $app_purposes = \App\Model\AppPurpose::whereStatus(1)->get();
        $data = AppForm::whereAppNo($app_form->app_no)->first();
        $vehicle_doc = VehicleDocument::whereVehicleId($app_form['vehicle_id'])->pluck('filename', 'doc_type_id');
        
            if ($vehicle_doc->isNotEmpty()) {
                $vehicle_doc =   $vehicle_doc;
            } else {
                $vehicle_doc = null;
            }
        $smart_card_code = \App\Model\SmartCardSetting::select('code', 'security_pin')->first();
        return view('Module4.registration.edit',compact('app_form', 'data', 'vehicle_doc', 'veh_info', 'app_purposes', 'vehicle', 'smart_card_code'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //update application form 
    public function update($id)
    {
        $this->validate(request(), [
            'customer_name' => 'required',
            'date_request'=>'required'
        ]);

        //Check app_purpose change or not
        $app_purposes = AppFormPurpose::whereAppFormId($id)->pluck('app_purpose_id')->toArray();
        if(count($app_purposes) > count(request('app_purpose_id'))){
            $differenceArray = array_diff($app_purposes, request('app_purpose_id'));
        }else{
            $differenceArray = array_diff(request('app_purpose_id'), $app_purposes );
        }

        $data = AppForm::find($id);
        $data->staff_id = request('staff_id');
        $data->note = request('note');
        $data->comment = request('comment');
        $data->date_request = request('date_request');
        if(count($differenceArray) > 0){
            $data->app_form_status_id = 1;//When update application, will change status into "1".
        }else{
            $data->app_form_status_id = request('app_form_status_id');
        }
        $data->customer_name = request('customer_name');
        $data->save();
        Vehicle::whereId($data['vehicle_id'])->update([
            'division_no'=> request('division_no'),
            'province_no' => request('province_no'),
            'licence_no' => request('licence_no')
        ]);
        $app_purpose = new \App\Library\SaveAppPurpose;
        $app_purpose->storeAppPurpose($id, request('app_purpose_id'));
       
        Auth::user()->notifyWithNotiUser(new Registration($data, "AppForm", "Appform Created!"));
        return back()->with('success', 'Application registration is successfully updated.');
    }

 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    // Add new vehicle document 
    public function addDocument(Request $request)
    {
        if ($request->hasfile('filename')) {
        $file = $request->file('filename');
        $name = uniqid().'_'.$file->getClientOriginalName();
        $file->move(public_path().'/images/doc/', $name);  
        $filename = $name;  
        $v_doc = array(
            'vehicle_id' => $request->vehicle_id,
            'doc_type_id' => $request ->doc_type_id,
            'filename'=>$filename
          );
          \App\Model\VehicleDocument::insert($v_doc);
          return back()->with('success', 'Vehicle document successful added.');
        }
    }

    // delete vehicle document in module4
    public function deleteVehDocument($id)
    {
        VehicleDocument::destroy($id);
        return back()->with('success', 'Vehicle document successfully deleted');
    }

}
