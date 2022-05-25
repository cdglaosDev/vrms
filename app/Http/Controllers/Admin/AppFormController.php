<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\PreRegisterApp;
use App\Model\VehicleDetail;
use App\Model\AppFormDetail;
use App\Model\AppDocument;
use Auth;
use App\Helpers\DateHelper;
class AppFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
      $data['appformdetails']=\App\Model\PreRegisterApp::orderByDesc('created_at')->get();
      $data['appstatus'] =\App\Model\ApplicationStatus::whereStatus(1)->get();
       $data['staff'] =\App\Model\Staff::get();
     $data1['document']=\App\Model\AppDocument::orderByDesc('created_at')->get();
     
       // return view("md5.application-form",$data);
         return view("md5.pre-reg-app",$data,$data1);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=\App\Model\PreRegisterApp::orderByDesc('created_at')->get();
           return view("md5.application-form",$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
      $request->user_id = Auth::user()->id;
       $vehicle =new VehicleDetail;
       $vehicle->user_id= auth()->id();
       $vehicle->licence_no = $request->licence_no;
       $vehicle->licence_no_need=$request->licence_no_need;
       $vehicle->purpose_id=$request->purpose_id;
       $vehicle->owner_name=$request->owner_name;
       $vehicle->tenant_name=$request->tenant_name;
       $vehicle->village_name=$request->village_name;
       $vehicle->district_code=$request->district_code;
       $vehicle->province_code=$request->province_code;
       $vehicle->vehicle_type_id=$request->vehicle_type_id;
       $vehicle->brand_id=$request->brand_id;
       $vehicle->model_id=$request->model_id;
       $vehicle->color_id=$request->color_id;
        $vehicle->steering_id=$request->steering_id;
       $vehicle->seat=$request->seat;
       $vehicle->year_manufacture=$request->year_manufacture;
       $vehicle->height=$request->height;
       $vehicle->long=$request->long;
       $vehicle->gas_id=$request->gas_id;
       $vehicle->total_weight=$request->total_weight;
       $vehicle->width=$request->width;
       $vehicle->import_permit_no=$request->import_permit_no;
       $vehicle->import_permit_date=DateHelper::getMySQLDateTimeFromUIDate($request->import_permit_date);
      
       $vehicle->industrial_doc_no=$request->industrial_doc_no;
       $vehicle->industrial_doc_date=DateHelper::getMySQLDateTimeFromUIDate($request->industrial_doc_date);
      
       $vehicle->technical_doc_no=$request->technical_doc_no;
       $vehicle->technical_doc_date=DateHelper::getMySQLDateTimeFromUIDate($request->technical_doc_date);
      
       $vehicle->comerce_permit_no=$request->comerce_permit_no;
       $vehicle->comerce_permit_date=DateHelper::getMySQLDateTimeFromUIDate($request->comerce_permit_date);
      
       $vehicle->tax_no=$request->tax_no;
       $vehicle->tax_date=DateHelper::getMySQLDateTimeFromUIDate($request->tax_date);
        $vehicle->tax_payment_no=$request->tax_payment_no;
       $vehicle->tax_payment_date=DateHelper::getMySQLDateTimeFromUIDate($request->tax_payment_date);
     
        $vehicle->police_doc_no=$request->police_doc_no;
        $vehicle->police_doc_date=DateHelper::getMySQLDateTimeFromUIDate($request->police_doc_date);

      $vehicle->datetime_update=DateHelper::getMySQLDateTimeFromUIDate($request->datetime_update);
     
       $vehicle->remark=$request->remark;
      
       $vehicle->save();


       \App\Model\PreRegisterApp::create([
             'vehicle_detail_id' => $vehicle->id,
            'user_id'=>auth()->id(),
          
          'date_request' => date('Y-m-d H:i:s', strtotime($request->input('date_request'))),
    
            'status_id' =>$request->status_id,
            'staff_approve_id'=>$request->staff_approve_id,
            'regapp_number' => $request->regapp_number,
            'comment'=>$request->comment,
            'qr_code'=>$request->qr_code

        ]);
     
       \App\Model\AppDocument::create([
           'vehicle_detail_id' =>$vehicle->id,
            'doc_type_id' => $request->doc_type_id,
            'filename' =>$request->filename,
            'link'=>$request->link,
          'date' => date('Y-m-d H:i:s', strtotime($request->input('date'))),
  
        ]);
      

     
     return redirect('pre-reg-app')->with('success','Successful Application Form  Added.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
        $prereg = PreRegisterApp::find($id);
        return view('md5.show',compact('prereg'));
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
       $request->validate([
       
       
       ]); 
       $district= PreRegisterApp::find($id);
        \LogActivity::saveToLog($district ,$tb_name="pre-reg-apps",$action="update");
          $district->update($request->all());
      return back()->with('success','Successfully Pre Registration Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data =PreRegisterApp::find($id);
        \LogActivity::saveToLog($data,$tb_name="AppForm_Details",$action="delete");
        $data->delete();
       return back()->with('success',' Pre Registration App Successfully Delete ');
    }
}
