<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Display;
use App\Model\AppForm;
use DateTime;
use DateTimeZone;
use DB;

class DisplayController extends Controller
{
    public function index()
    {
        $display = Display::all();
        return view('Display.index',compact('display'));
    }

    public function Search(Request $request)
    {
        $department_id = auth()->user()->department['id'];
        $counter_matching = auth()->user()->counter_matching;
        $dt_now = new \DateTime('NOW');
        $time_zone = new DateTimeZone('Asia/Vientiane'); 
        $dt_now->setTimezone($time_zone);
        $time = \Carbon\Carbon::parse($dt_now)->format("H:i:s");

        foreach ($counter_matching as $value) {
            $counter = $value->service_counter['name'];
        }
        
        $app_numbers = AppForm::where('app_no', $request->app_number)->first();
        $validator = \Validator::make($request->all(), ['app_number' => 'required|unique:displays']);
        if ($validator->fails()) {   

            return response()->json("App Number is on call!!Please call another Number");

        } else if ($app_numbers == null) {
            return response()->json("App Number does not exist!");
        } else {
            
            $display = new Display();
            $display -> app_number = request('app_number');
            $display -> counter = $counter;
            $display -> status = "calling";
            $display -> time_call = $time;
            $display -> department_id = $department_id;
            $display -> save();
            
            return response()->json($display);
        }
    } 
     
    public function update(Request $request, Display $display)
    {
        $all_app_no = Display::pluck('app_number')->toArray(); 
        if (in_array($request->app_number, $all_app_no)) {
            Display::whereAppNumber($request->app_number)->delete();
            
            \App\Model\AppForm::whereAppNo($request->app_number)->update(['app_form_status_id' => 7]);
            $app_no = $request->app_number;
            $vehicle = \App\Model\Vehicle::whereHas('app_form', function ($query) use ($app_no){
            $query->where('app_no', '=', $app_no);})->get()->first();

            \App\Model\Vehicle::whereId($vehicle->id)->update([
                'quick_id' => str_replace(' ', '', $vehicle->licence_no).$vehicle->vehicle_kind_code.$vehicle->province_code,
                'reg_complete' => "Y"
            ]);
            
            try {
                $app_form = \App\Model\AppForm::where('app_no', $app_no)->first();
                if($app_form){
                    //If already called app_no, already created VehicleHistory.
                    if (!(\App\Model\VehicleHistory::whereVehicleIdAndAppId($vehicle->id, $app_form->id)->exists())){
                        
                        $vehicle->saveVehicleHistory($vehicle, $app_form->id);
                    }
                }                
            } catch (\Exception $e) {
                return response()->json(['status' => "Error in saving Vehicle History.\n" . $e, 'errors' => $e]);
            }

            return response()->json(['status' => trans('module4.display_done_msg')]);
        } else {
            $department_id = auth()->user()->department['id'];
            $counter_matching = auth()->user()->counter_matching;
            $dt_now = new \DateTime('NOW');
            $time_zone = new DateTimeZone('Asia/Vientiane'); 
            $dt_now->setTimezone($time_zone);
            $time = \Carbon\Carbon::parse($dt_now)->format("H:i:s");
            if ($counter_matching->isEmpty()) {
                return response()->json(['status' => "This user can't call. Need to assign counter."]);
            }
            foreach ($counter_matching as $value) {
                $counter = $value->service_counter['name'];
            }
            
            $app_numbers = AppForm::where('app_no', $request->app_number)->first();
            $validator = \Validator::make($request->all(), ['app_number' => 'required|unique:displays']);

            if ($validator->fails()) {   

                return response()->json("App Number is on call!!Please call another Number");

            } else if ($app_numbers == null) {
                return response()->json("App Number does not exist!");
            } else {
                
                $display = new Display();
                $display -> app_number = request('app_number');
                $display -> counter = $counter;
                $display -> status = "calling";
                $display -> time_call = $time;
                $display -> department_id = $department_id;
                $display -> save();
            
            }
            return response()->json(['status' => trans('module4.display_success_msg')]);
        }
       
    }

    /*
    public function update(Request $request, Display $display)
    {
        $all_app_no = Display::pluck('app_number')->toArray(); 
        if (in_array($request->app_number, $all_app_no)) {
            Display::whereAppNumber($request->app_number)->delete();
            \App\Model\AppForm::whereAppNo($request->app_number)->update(['app_form_status_id' => 7]);
            $app_no = $request->app_number;
            $vehicle = \App\Model\Vehicle::whereHas('app_form', function ($query) use ($app_no){
                $query->where('app_no', '=', $app_no);
            })->select('id','licence_no', 'vehicle_kind_code', 'province_code')->get()->first();
            \App\Model\Vehicle::whereId($vehicle->id)->update([
                'quick_id' => str_replace(' ', '', $vehicle->licence_no).$vehicle->vehicle_kind_code.$vehicle->province_code,
                'reg_complete' => "Y"
            ]);
            return response()->json(['status' => "Done process."]);
        } else {
            $department_id = auth()->user()->department['id'];
            $counter_matching = auth()->user()->counter_matching;
            $dt_now = new \DateTime('NOW');
            $time_zone = new DateTimeZone('Asia/Vientiane'); 
            $dt_now->setTimezone($time_zone);
            $time = \Carbon\Carbon::parse($dt_now)->format("H:i:s");
            if ($counter_matching->isEmpty()) {
                return response()->json(['status' => "This user can't call.Need to assign counter."]);
            }
            foreach ($counter_matching as $value) {
                $counter = $value->service_counter['name'];
            }
            
            $app_numbers = AppForm::where('app_no', $request->app_number)->first();
            $validator = \Validator::make($request->all(), ['app_number' => 'required|unique:displays']);

            if ($validator->fails()) {   

                return response()->json("App Number is on call!!Please call another Number");

            } else if ($app_numbers == null) {
                return response()->json("App Number does not exist!");
            } else {
                
                $display = new Display();
                $display -> app_number = request('app_number');
                $display -> counter = $counter;
                $display -> status = "calling";
                $display -> time_call = $time;
                $display -> department_id = $department_id;
                $display -> save();
            
            }
            return response()->json(['status' => "Successful calling."]);
        }
       
    }

    */

    //Dummy because of the route with resource
    public function show($id)
    {
               
    }

    public function destroy($app_number)
    {
        $display = Display::whereAppNumber($app_number)->first();
        if ($display) {
            $display->delete();
            return response()->json(['status' => "Successful Delete."]);
        } else {
            return response()->json(['status' => "Your app number doesn't exit."]);
        }
       
    }

  
}
