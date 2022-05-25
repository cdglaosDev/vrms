<?php
namespace App\Library;

use Illuminate\Http\Request;
use App\Model\AppDocument;

class UploadDoc
{
    // save app document for vehicle detail
    public function saveDB(Request $request, $vehicle_detail_id)
    {
        if ($request->hasfile('filename')) {
           $filename =[];
           foreach ($request->file('filename') as $file) {
               $name=uniqid().'_'.$file->getClientOriginalName();
               $file->move(public_path().'/images/doc/', $name);  
               $filename[] = $name;  
           }
        }

        foreach ($request->doc_type_id as $doc_type_id => $value) {  
            $appdoc = array(
                'vehicle_detail_id' => $vehicle_detail_id,
                'doc_type_id' => $value,
                'filename'=>$filename[$doc_type_id]
            );
            AppDocument::insert($appdoc);
        }
    }

    //Pre  app form auto generate 
    public function savePreForm($vehicle_detail_id,  $save_type)
    {
        $app = new \App\Helpers\AppNo;
        $pre_app = \App\Model\PreRegisterApp::create([
            'vehicle_detail_id' => $vehicle_detail_id,
            'user_id'=>auth()->id(),
            'date_request' => date("Y-m-d"),
            'app_status_id' =>($save_type == "submit"?3:6),
            'staff_approve_id' =>auth()->id(),
            'regapp_number'=>$app->getPreAppNo(),
        ]);
        return $pre_app->id;
    }
   

    public function savePreFormByExcel($vehicle_detail_id)
    {
        $app = new \App\Helpers\AppNo;
        \App\Model\PreRegisterApp::create([
            'vehicle_detail_id' => $vehicle_detail_id,
            'user_id'=>auth()->id(),
            'date_request' => date("Y-m-d"),
            'app_status_id' =>6,
            'staff_approve_id' =>auth()->id(),
            'regapp_number'=>$app->getPreAppNo()
        ]);
    }
}