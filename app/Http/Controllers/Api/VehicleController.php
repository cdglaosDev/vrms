<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Vehicle;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\VehicleCollection;
use App\Http\Resources\VehicleInspectCollection;
use App\Http\Resources\VehicleTrafficCollection;
use App\Model\TrafficAccident;
use App\Model\IllegalTraffic;
use App\Model\VehicleInspection;
class VehicleController extends Controller
{
    protected $api_token;
   public function __construct()
   {
       $this->api_token = new \App\Library\CheckToken;
   }
    //get vehicle data by division_no and license no and access token
    public function index(Request $request)
    {
        if (in_array($request->access_token, $this->api_token->allToken())) {
            $vehicle = Vehicle::whereDivisionNoAndLicenceNo($request->division_no, $request->license_no)->get();
            if (!$vehicle->isEmpty()) {
                return new VehicleCollection($vehicle);
            } else {
                return response()->json([
                    'data'=>"No result found.",
                    'success' => 'Success'
                ]);
            }
        } else {
            return response()->json(['message' => 'UnAuthorised'], 401);
        }
       
    }

    //get vehicle info by license no and access token
    public function getVehicleByLicense(Request $request)
    {
        if (in_array($request->access_token,$this->api_token->allToken())) {
            $vehicle = Vehicle::whereLicenceNo($request->license_no)->get();
            if (!$vehicle->isEmpty()) {
                return new VehicleCollection($vehicle);
            } else {
                return response()->json([
                    'data'=>"No result found.",
                    'success' => 'Success'
                ]);
            }
           
        } else {
            return response()->json(['message' => 'UnAuthorised'], 401);
        }
       
    }
     //get vehicle info by license no and province_code and app_purpose_id access token
     public function getVehicleByProvince(Request $request)
     {
         if (in_array($request->access_token,$this->api_token->allToken())) {
            $vehicle = Vehicle::whereLicenceNoAndProvinceCodeAndVehiclePurposeId($request->license_no, $request->province_code, $request->vehicle_purpose_id)->get();
            if (!$vehicle->isEmpty()) {
                return new VehicleCollection($vehicle);
            } else {
                return response()->json([
                    'data'=>"No result found.",
                    'success' => 'Success'
                ]);
            }
         } else {
            return response()->json(['message' => 'UnAuthorised'], 401);
         }
        
     }
    //get accident type by access token
    public function getAccident(Request $request)
    {
        if (in_array($request->access_token,$this->api_token->allToken())){
        $data = TrafficAccident::whereStatus(1)->get();
        return response()->json([
            'data'=>$data,
            'success' => 'Success'
        ]);
        }else{
            return response()->json(['message' => 'UnAuthorised'], 401);
        }
    }

    //upload traffice accident 
    public function postTrafficAccident(Request $request)
    {
        if (in_array($request->access_token,$this->api_token->allToken())){
        $vehicle_id = Vehicle::whereLicenceNo($request->license_no)->pluck('id')->first();
                if($vehicle_id != null){
                $result =  IllegalTraffic::create([
                        'traffic_accident_id' => $request->traffic_accident_id,
                        'vehicle_id' =>$vehicle_id, 
                        'license_no' => $request->license_no,
                        'place' => $request->place,
                        'offender_name' => $request->offender_name,
                        'officer_name' => $request->officer_name,
                        'date' => $request->date,
                        'remark' => $request->remark,
                        'user_id' => \App\User::whereApiToken(request('access_token'))->pluck('id')->first(),
                ]);
                    return response()->json([
                        'data'=> $result,
                        'success' => 'success'
                    ]);
                }else{
                    return response()->json([
                        'data'=>"No result found."
                    ]);
                }
        }else{
            return response()->json(['message' => 'UnAuthorised'], 401);
        }
        
    }
    //get all traffice accident by license no
    public function getTrafficAccident(Request $request)
    {
        if(in_array($request->access_token, $this->api_token->allToken())){
            $accident = IllegalTraffic::whereLicenseNo($request->license_no)->get();
            if (!$accident->isEmpty()) {
                return new VehicleTrafficCollection($accident);
            }else {
                return response()->json([
                    'data'=>"No result found.",
                    'success' => 'Success'
                ]);
            }
               
        }else{
            return response()->json(['message' => 'UnAuthorised'], 401);
        }
    }

    public function getVehicleInspect(Request $request)
    {
        if(in_array($request->access_token,$this->api_token->allToken())){
            $vehicle_id = Vehicle::whereDivisionNoAndLicenceNo($request->division_no,$request->license_no)->pluck('id')->first();
            $vehicle_inspect = VehicleInspection::whereVehicleId($vehicle_id)->get();
            if (!$vehicle_inspect->isEmpty()) {
                return new VehicleInspectCollection($vehicle_inspect);
            }else {
                return response()->json([
                    'data'=>"No result found.",
                    'success' => 'Success'
                ]);
            }
           
        }else{
            return response()->json(['message' => 'UnAuthorised'], 401);
        }
    }
}
