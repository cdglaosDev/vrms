<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Input;
use App\Model\ApplicationStatus;
use App\Helpers\GenerateCodeNo;
use App\Model\AppForm;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class SyncImportData
{
    public $app_form;
    public $vehicle;
    public $vehicle_doc;
    
    public function __construct($app_form, $vehicle, $vehicle_doc)
    {
        $this->app_form = $app_form;
        $this->vehicle = $vehicle;
        $this->vehicle_doc = $vehicle_doc;
    }
   
   
    public  function syncAppData()
    {
       
        try {
            DB::beginTransaction();
            try {
                $app_no = new \App\Helpers\AppNo;
                $vehicle = new \App\Model\Vehicle;
                $vehicle->licence_no = null;
                $vehicle->owner_name = $this->vehicle['owner_name'];
                $vehicle->tenant_name = $this->vehicle['tenant_name'];
                $vehicle->village_name = $this->vehicle['village_name'];
                $vehicle->vehicle_type_id = $this->vehicle['vehicle_type_id'];
                $vehicle->steering_id = $this->vehicle['steering_id'];
                $vehicle->color_id = $this->vehicle['color_id'];
                $vehicle->year_manufacture = $this->vehicle['year_manufacture'];
                $vehicle->height = $this->vehicle['height'];
                $vehicle->long = $this->vehicle['long'];
                $vehicle->gas_id = $this->vehicle['gas_id'];
                $vehicle->wheels = $this->vehicle['wheels'];
                $vehicle->engine_no = $this->vehicle['engine_no'];
                $vehicle->chassis_no = $this->vehicle['chassis_no'];
                $vehicle->weight = $this->vehicle['weight'];
                $vehicle->import_permit_no = $this->vehicle['import_permit_no'];
                $vehicle->import_permit_date = $this->vehicle['import_permit_date'];
                $vehicle->industrial_doc_no = $this->vehicle['industrial_doc_no'];
                $vehicle->industrial_doc_date = $this->vehicle['industrial_doc_date'];
                $vehicle->technical_doc_no = $this->vehicle['technical_doc_no'];
                $vehicle->technical_doc_date = $this->vehicle['technical_doc_date'];
                $vehicle->width = $this->vehicle['width'];
                $vehicle->brand_id = $this->vehicle['brand_id'];
                $vehicle->model_id = $this->vehicle['model_id'];
                $vehicle->comerce_permit_no = $this->vehicle['comerce_permit_no'];
                $vehicle->comerce_permit_date = $this->vehicle['comerce_permit_date'];
                $vehicle->tax_no = $this->vehicle['tax_no'];
                $vehicle->tax_date = $this->vehicle['tax_date'];
                $vehicle->tax_payment_no = $this->vehicle['tax_payment_no'];
                $vehicle->tax_payment_date = $this->vehicle['tax_payment_date'];
                $vehicle->police_doc_no = $this->vehicle['police_doc_no'];
                $vehicle->police_doc_date = $this->vehicle['police_doc_date'];
                $vehicle->remark = $this->vehicle['remark'];
                $vehicle->seat = $this->vehicle['seat'];
                $vehicle->user_id = $this->vehicle['user_id'];
                $vehicle->district_code = $this->vehicle['district_code'];
                $vehicle->province_code = $this->vehicle['province_code'];
                $vehicle->motor_brand_id = $this->vehicle['motor_brand_id'];
                $vehicle->locks = $this->vehicle['locks'];
                $vehicle->lock_no = $this->vehicle['lock_no'];
                $vehicle->startlock = $this->vehicle['startlock'];
                $vehicle->endlock = $this->vehicle['endlock'];
                $vehicle->companylock = $this->vehicle['companylock'];
                $vehicle->cylinder = $this->vehicle['cylinder'];
                $vehicle->cc = $this->vehicle['cc'];
                $vehicle->weight_filled = $this->vehicle['weight_filled'];
                $vehicle->axis = $this->vehicle['axis'];
                $vehicle->location = $this->vehicle['location'];
                $vehicle->engine_type_id = $this->vehicle['engine_type_id'];
                $vehicle->vehicle_kind_code = $this->vehicle['vehicle_kind_code'];
                $vehicle->total_weight = $this->vehicle['total_weight'];
                $vehicle->pre_licence_no = $this->vehicle['licence_no_need'];
                $vehicle->save();
               
            } catch(\Exception $e){
                return response()->json(['status' => 'error', 'message' => "Error in vehicle"]);
            }
           
            try {
            $app_form = new \App\Model\AppForm;
            $app_form->date_request = date("d/m/Y");
            $app_form->app_request_no = $this->app_form['regapp_number'];
            $app_form->app_no = $app_no->getAppNo();
            $app_form->vehicle_id = $vehicle->id;
            $app_form->app_form_status_id = 1;
            $app_form->comment =  $this->app_form['comment'];
            $app_form->customer_name = $vehicle->owner_name;
            $app_form->customer_id = $this->app_form['user_id'];
            $app_form->staff_id = auth()->id();
            $app_form->save();
            } catch(\Exception $e){
                return response()->json(['status' => 'error', 'message' => "Error in App Form"]);
            }
          
             $pre_app = \App\Model\PreRegisterApp::whereId($this->app_form['id'])->first();
            if($app_form){
                \App\Model\AppFormPurpose::create([
                    'app_purpose_id' => 1,
                    'app_form_id' => $app_form->id
                ]);
            }
        
            try{
                $new_path = 'images/vehicle_doc/'.$vehicle->id;
                if (! File::exists(public_path().'/'. $new_path)) {
                    File::makeDirectory(public_path().'/'. $new_path,0777,true);
                }
                foreach ($this->vehicle_doc as $veh_doc) {
                    $veh_document = new \App\Model\VehicleDocument;
                    $veh_document->vehicle_id = $vehicle->id;
                    $veh_document->doc_type_id = $veh_doc->doc_type_id;
                    $veh_document->filename = $veh_doc->filename;
                    $old_path =  '/images/doc/'.$pre_app->regapp_number.'/'.$veh_doc->filename;
                    if ($veh_doc->filename && $old_path) {
                        File::copy(public_path($old_path), public_path( $new_path.'/'.$veh_doc->filename));
                    }
                    $veh_document->save();
                }
            }catch(\Exception $e){
                return response()->json(['status' => 'error', 'message' => "Error when added vehicle document"]);
            }
        
            $pre_app->qr_code = $app_form->app_no;
            $pre_app->app_number = $app_form->app_no;
            $pre_app->staff_approve_id = auth()->id();
            $pre_app->app_status_id = 4;
            $pre_app->save();
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => "Error when added vehicle document"]);
        }
    }

}