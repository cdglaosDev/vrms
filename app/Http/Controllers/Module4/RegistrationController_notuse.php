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
class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $app_form = AppForm::get();
   
        return view('Module4.registration.index',compact('app_form'));
    }

    public function SearchAppNo(){
        $q = Input::get ( 'q' );
        if($q == null){
            return back()->with('error',"Please enter App no.");
        }
        $data['app_form'] = AppForm::where('app_no','LIKE','%'.$q.'%')->first();
        
        if(count( $data['app_form'])>0){
            return view('Module4.Register.search-app-no',$data);
        }
        return redirect()->route('application.create')->with('error','Not found your search App Number');
       
    }

    //Registration form when scan QR code by staff
    public function scanQrCode($app_no)
    {
       $data['app_form'] = AppForm::whereAppNo($app_no)->first();
       $data['veh_doc'] = VehicleDocument::whereVehicleId($data['app_form']['vehicle_id'])->get();
     
        return view('ApplicationForm.edit',$data);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = getData::vehInfo();
       
        return view('Module4.registration.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $vehicle =new Vehicle;
        $vehicle->division_no = $request->division_no;
        $vehicle->province_no = $request->province_no;
        $vehicle->licence_no =  $request->licence_no;
        $vehicle->owner_name = $request->owner_name;
        $vehicle->tenant_name = $request->tenant_name;
        $vehicle->village_name = $request->village_name;
        $vehicle->vehicle_kind_id = $request->vehicle_kind_id;
        $vehicle->district_code = $request->district_code;
        $vehicle->province_code = $request->province_code;
       $vehicle->vehicle_type_id = $request->vehicle_type_id;
       $vehicle->brand_id = $request->brand_id;
       $vehicle->model_id = $request->model_id;
       $vehicle->color_id = $request->color_id;
       $vehicle->view = $request->view;
       $vehicle->lock = $request->lock;
       $vehicle->quick = $request->quick;
       $vehicle->tax_10_40 = $request->tax_10_40;
       $vehicle->tax_12 = $request->tax_12;
       $vehicle->tax_50 = $request->tax_50;
       $vehicle->tax_receipt = $request->tax_receipt;
       $vehicle->import_permit_hsny = $request->import_permit_hsny;
       $vehicle->import_permit_invest = $request->import_permit_invest;
       $vehicle->sub_color_id = $request->sub_color_id;
        $vehicle->steering_id = $request->steering_id;
       $vehicle->seat = $request->seat;
       $vehicle->year_manufacture = $request->year_manufacture;
       $vehicle->height = $request->height;
       $vehicle->long = $request->long;
       $vehicle->gas_id = $request->gas_id;
       $vehicle->wheels = $request->wheels;
       $vehicle->total_weight = $request->total_weight;
       $vehicle->engine_no = $request->engine_no;
       $vehicle->chassis_no = $request->chassis_no;
       $vehicle->weight = $request->weight;
       $vehicle->width = $request->width;
       $vehicle->import_permit_no = $request->import_permit_no;
        $vehicle->industrial_doc_no = $request->industrial_doc_no;
        $vehicle->technical_doc_no  = $request->technical_doc_no;
        $vehicle->comerce_permit_no = $request->comerce_permit_no;
        $vehicle->tax_no = $request->tax_no;
        $vehicle->tax_payment_no = $request->tax_payment_no;
         $vehicle->police_doc_no = $request->police_doc_no;
         $vehicle->moter_brand_id = $request->moter_brand_id;
        $vehicle->issue_date = DateHelper::getMySQLDateFromUIDate($request->issue_date);
        $vehicle->police_doc_date = DateHelper::getMySQLDateFromUIDate($request->police_doc_date);
       $vehicle->expire_date = DateHelper::getMySQLDateFromUIDate($request->expire_date);
       $vehicle->import_permit_date = DateHelper::getMySQLDateFromUIDate($request->import_permit_date);
       $vehicle->industiral_doc_date = DateHelper::getMySQLDateFromUIDate($request->industiral_doc_date);
       $vehicle->technical_doc_date = DateHelper::getMySQLDateFromUIDate($request->technical_doc_date);
       $vehicle->comerce_permit_date = DateHelper::getMySQLDateFromUIDate($request->comerce_permit_date);
       $vehicle->tax_date = DateHelper::getMySQLDateFromUIDate($request->tax_date);
       $vehicle->tax_payment_date = DateHelper::getMySQLDateFromUIDate($request->tax_payment_date);
        $vehicle->tax_permit = $request->tax_permit;
       $vehicle->user_id = auth()->id();
        $vehicle->remark = $request->remark;
        $vehicle->save(); 
    
        $app_form = new AppForm();
        $app_form->vehicle_id = $vehicle->id;
       $app_form->note = $request->note;
       $app_form->comment = $request->comment;
       $app_form->app_no = $request->app_no;
       $app_form->staff_id = auth()->id();
       $app_form->date_request = DateHelper::getMySQLDateFromUIDate($request->date_requeset);
       $app_form->app_type_id = 1;
       $app_form->app_status_id = $request->app_status_id;
       $app_form->customer_name = $request->customer_name;
    
       if($request->hasfile('filename'))
       {
        
          $filename =[];
          foreach($request->file('filename') as $file)
          {
              $name=uniqid().'_'.$file->getClientOriginalName();
              $file->move(public_path().'/images/doc/', $name);  
              $filename[] = $name;  
          }
       }
       foreach($request->doc_type_id as $doc_type_id => $value)
          {    
              $v_doc = array(
                'vehicle_id' => $vehicle->id,
                  'doc_type_id' => $request ->doc_type_id[$doc_type_id],
                   'filename'=>$filename[$doc_type_id],
              );
              \App\Model\VehicleDocument::insert($v_doc);
          }
       
        $vehicle->app_form()->save($app_form);
      
        return redirect()->to('application')->with('success','Successful new registration');

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
       return view('Module4.Application.detail',compact('data','vehicle'));
    }

    public function storeAppFormDetail(Request $request)
    {
     
        $data = new \App\Model\AppFormDetail();
        $data->app_type_id = $request->app_type_id;
        $data->app_form_id = $request->app_form_id;
        $data->detail_note = $request->detail_note;
        $data->staff_id = auth()->id();
        $data->save();
        return back()->with('success',"App form detaill already added.");
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
        $data = getData::vehInfo();
        return view('Module4.registration.edit',compact('app_form','data'));
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
        $data = AppForm::find($id);
        $data->staff_id = $request->staff_id;
        $data->note = $request->note;
        $data->comment = $request->comment;
        $data->date_request = \App\Helpers\DateHelper::getMySQLDateFromUIDate($request->date_request);
        $data->app_status_id = $request->app_status_id;
        $data->save();
        $vehicle = \App\Model\Vehicle::whereId($data['vehicle_id'])->first();
        $vehicle->division_no = $request->division_no;
        $vehicle->province_no = $request->province_no;
       
        $vehicle->save();
        return redirect()->to('application-form')->with('success','Registration form updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    
}
