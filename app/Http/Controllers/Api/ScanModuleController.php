<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\VehicleDocument;

class ScanModuleController extends Controller
{
    public function uploadFile(Request $request)
    { 
        if ($request->access_token == \App\Helpers\Helper::accessToken()) {
            
            $myfiles = [];
            if ($request->file('2')) {
                $file2 = $this->fileSavePath(request('vehicle_id'), 2);
            } else {
                $file2 = null;
            }
            if ($request->file('5')) {
                $file5 = $this->fileSavePath(request('vehicle_id'), 5);
            } else {
                $file5 = null;
            }
            if ($request->file('4')) {
                $file4 =  $this->fileSavePath(request('vehicle_id'), 4);
            } else {
                $file4 = null;
            }
            if ($request->file('3')) {
                $file3 =  $this->fileSavePath(request('vehicle_id'), 3); 
            } else {
                $file3 = null;
            }
            if ($request->file('6')) {
                $file6 = $this->fileSavePath(request('vehicle_id'), 6);  
            } else {
                $file6 = null;
            }
            if ($request->file('7')) {
                $file7 = $this->fileSavePath(request('vehicle_id'), 7); 
            } else {
                $file7 = null;
            }
            if ($request->file('8')) {
                $file8 = $this->fileSavePath(request('vehicle_id'), 8); 
            } else {
                $file8 = null;
            }
            $array = array("2" => $file2, "5" => $file5, "4" => $file4, "3" => $file3, "6" => $file6, "7" => $file7, "8" => $file8); 
            array_push($myfiles, $array);
           
            foreach ($myfiles[0] as $key=>$value) {
                switch ($key) {
                    case ($key == 2):
                        $this->saveDocFile($key, $value, request('vehicle_id'));
                    break;
                    case ($key == 5):
                        $this->saveDocFile($key, $value, request('vehicle_id'));
                     break;
                    case ($key == 4):
                     $this->saveDocFile($key, $value, request('vehicle_id'));
                    break;
                    case ($key == 3):
                        $this->saveDocFile($key, $value, request('vehicle_id'));
                     break;
                     case ($key == 6):
                         $this->saveDocFile($key, $value, request('vehicle_id'));
                     break;
                     case ($key == 7):
                       $this->saveDocFile($key, $value, request('vehicle_id'));
                     break;
                     case ($key == 8):
                        $this->saveDocFile($key, $value, request('vehicle_id'));
                     break;
                }
            }
           
            return response()->json(['message' => 'Successful'], 200);
        }
        
    }

    //update filename into database when uploading from window app
    public function saveDocFile($key, $value, $vehicle_id)
    {
        if ($value != null) {
            VehicleDocument::whereVehicleIdAndDocTypeId($vehicle_id, $key)->update(['filename'=> $value]);
        }
    }

    //save file path from scan module window app
    public function fileSavePath($vehicle_id, $doc_type_id)
    {
        $filename = request()->file($doc_type_id)->getClientOriginalName();
        request()->file($doc_type_id)->move(public_path().'/images/vehicle_doc/'.$vehicle_id.'/', $filename);
        return $filename; 
    }
}
