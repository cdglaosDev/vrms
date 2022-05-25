<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\PreRegisterApp;
use App\Helpers\DateHelper;
use App\Helpers\GenerateCodeNo;
use App\Model\ApplicationStatus;
use App\Model\AppForm;
use DB;

use App\Model\Vehicle;
use App\Model\VehicleDetail;

class ImporterApplication extends Controller
{
   
    function __construct()
    {
        $this->middleware('permission:Importer-Application-Item-Approve', ['only' => ['approveApp']]);
       
    }
    public function show(PreRegisterApp $import_application)
    {
        
        return view('staff.importvehicle.show',compact('import_application'));
    }


    public function getAppNumber()
    {

        $code = AppForm::where('app_number', 'LIKE', GenerateCodeNo::appNumberPrefix() . '%')->orderBy('app_number', 'desc')->select('app_number')->first();
      
       $app_num= GenerateCodeNo::appNumber($code['app_number']);
       return $app_num;
    }

   // Approve importer application by staff. and then sync to module4 specific database.

   public function approveApp( $id)
   {   
    
        try{
            $app_form = PreRegisterApp::find($id);
            $vehicle = \App\Model\VehicleDetail::whereId($app_form->vehicle_detail_id)->first();
            $vehicle_doc = \App\Model\AppDocument::whereVehicleDetailId($app_form->vehicle_detail_id)->get();
            $engine_no = Vehicle::getEngine()->toArray();
            $chassis_no = Vehicle::getChassis()->toArray();

            if(in_array($vehicle->engine_no, $engine_no) || in_array($vehicle->chassis_no, $chassis_no)) {
                throw new \Exception("Duplicate engine no or chassis no.please check again.");
            }else{
                $app = new \App\Helpers\SyncImportData($app_form, $vehicle, $vehicle_doc);
                $app->syncAppData();
                $app_number = PreRegisterApp::whereId($id)->pluck('app_number')->first();
              
                return response()->json([
                    'status' =>'ok',
                    'msg' => trans('module4.success_approve'),
                    'app_number' => $app_number
                ]);
            }
          
        }catch (\Exception $e) {
            $fails = $e->getMessage();
            return response()->json([
                'status' =>'duplicate',
                'msg' => $fails
            ]);
        }
       
   }
   // change draft stage to normal for new modal
   public function submitAppByModal($id)
   {
        \App\Helpers\Helper::SubmitApp($id);
        return response()->json([
            'status' =>200,
            'message' => trans('module4.success_submit')
        ]);

   }
    // change draft stage to normal
    public function submitApp()
    {
        \App\Helpers\Helper::SubmitApp(request('pre_app_id'));
        return response()->json([
            'status' =>200,
            'message' => trans('module4.success_submit'),
            'pre_app_id' => request('pre_app_id')
        ]);

    }
  



    //    Approve all selected app form
    public function approveAll(Request $request)
   {
        $pre_app_ids = explode(',', $request->app_form_id);
       
        foreach($pre_app_ids as $key=>$value){
            try{
                $app_form = PreRegisterApp::whereId($value)->first();
                $vehicle = \App\Model\VehicleDetail::whereId($app_form->vehicle_detail_id)->first();
                $vehicle_doc = \App\Model\AppDocument::whereVehicleDetailId($app_form->vehicle_detail_id)->get();
                $engine_no = Vehicle::getEngine()->toArray();
                $chassis_no = Vehicle::getChassis()->toArray();
              
                if(in_array($vehicle->engine_no, $engine_no) || in_array($vehicle->chassis_no, $chassis_no)) {
                    throw new \Exception("Duplicate engine no or chassis no.please check again.");
                }else{
                    $app = new \App\Helpers\SyncImportData($app_form, $vehicle, $vehicle_doc);
                    $app->syncAppData();
                }
            
            }catch (\Exception $e) {
               
                if($e){
                    $duplicateData['engine_no'] = $vehicle->engine_no;
                    $duplicateData['chassis_no'] = $vehicle->chassis_no;
                }
                return redirect()->to('/import-vehicle')->with(['message' => 'Duplicate engine no or chassis no. please check again.']);
            }
            echo PHP_EOL;
        }
        
        return back()->with('success',trans('module4.success_approve'));
        
    }

    //update status when click delete button
    public function preAppStatus()
    {
        \App\Model\PreRegisterApp::whereId(request('pre_app_id'))->update(['app_status_id' => 5]);
        return response()->json([
          'status' =>'200',
          'message' => trans('module4.success_delete'),
          'pre_app_id' => request('pre_app_id')
        ]);
    }

    
}
