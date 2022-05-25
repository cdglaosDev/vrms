<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CardSign;
use App\Helpers\Helper;
use App\Model\PrintLog;
use App\Http\Resources\CardSignResource;
class SmartCardSign extends Controller
{
    //get logo and sign for smart card
    public function getLogo(Request $request)
    {
        if ($request->access_token == Helper::accessToken()) {
            $code = \App\Model\CardSign::selectRaw('dept_name as department, officer_name as officer, logo, sign')->first();
         
            return response()->json([
                 'data' => $code
             ], 200);
        } else {
            return response()->json(['message' => 'UnAuthorised'], 401);
        }
    }
    //save print log
    public function savePrintLog(Request $request)
    {
        if ($request->access_token == Helper::accessToken()) {
            if (request('user_id') != null && request('vehicle_id') != null ) {
                $request['print_log_datetime'] = date('Y-m-d H:i:s');
                PrintLog::create($request->all());
                \App\Model\AppForm::whereVehicleIdAndAppFormStatusId(request('vehicle_id'), 4)->update(['app_form_status_id'=>5]);
                return response()->json(['message' => 'Successful'], 200);

            } else {
                return response()->json(['message' => 'Unsuccessful.'], 200);
            }
               
        } else {
                return response()->json(['message' => 'UnAuthorised'], 401);
       }
    }
   
}
