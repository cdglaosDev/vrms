<?php
namespace App\Helpers;
use App\Model\VehicleLog;

class StoreVehicleLog
{
    public function saveData($change_value, $old_data)
    {
        foreach ($change_value as $key=>$value) {
        
            if ($key != "updated_at") {
                VehicleLog::create([
                    'vehicle_id' =>$old_data->id,
                    'status' => '1',
                    'name' => $key,
                    'from' => $old_data[$key],
                    'to' => $value,
                    'app_request_no'=> $old_data->app_form->app_no,
                    'user_id' => auth()->id(),
                    'ip_address' => request()->ip(),
                ]);
            } 
          
        }
    }
}