<?php

namespace App\Traits;
use App\Model\VehicleHistory;
trait SaveVehicleHistory
{
    public function saveVehicleHistory($data, $app_id)
    {
        $vehicle_history = new VehicleHistory();
        $vehicle_history -> vehicle_id = $data->id;
        $vehicle_history -> app_id = $app_id;
        $vehicle_history -> province_no = $data->province_no;
        $vehicle_history -> licence_no = $data->licence_no;
        $vehicle_history -> vehicle_kind_code = $data->vehicle_kind_code;
        $vehicle_history -> owner_name = $data->owner_name;
        $vehicle_history -> tenant_name = $data->tenant_name;
        $vehicle_history -> province_code = $data->province_code;
        $vehicle_history -> district_code = $data->district_code;
        $vehicle_history -> village_name = $data->village_name;
        $vehicle_history -> vehicle_unit = $data->vehicle_unit;
        $vehicle_history -> engine_no = $data->engine_no;
        $vehicle_history -> issue_date = $data->issue_date;
        $vehicle_history -> expire_date = $data->expire_date;
        $vehicle_history -> quick_id = $data->quick_id;
        $vehicle_history -> save();
    }

    public function updateVehicleHistory($data)
    {
        $vehicle_history = VehicleHistory::where('vehicle_id', $data->id)->orderBy('id', 'desc')->first();
        $vehicle_history -> issue_date = $data->issue_date;
        $vehicle_history -> expire_date = $data->expire_date;
        $vehicle_history -> save();
    }
}
