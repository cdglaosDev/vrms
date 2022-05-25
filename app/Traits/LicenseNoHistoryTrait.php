<?php

namespace App\Traits;
use App\Model\LicenseNoHistory;
trait LicenseNoHistoryTrait
{
    public function saveLicenseNoHistory($data)
    {
        //If it has old data, will change status from "uses" to "not_uses".
        $old_license_no_history = LicenseNoHistory::where('vehicle_id', $data->id)->orderBy('id', 'desc')->first();
        if($old_license_no_history){
            $old_license_no_history -> license_no_status = "not_uses";
            $old_license_no_history -> end_date = date("Y-m-d");
            $old_license_no_history -> save();
        }

        $license_no_history = new LicenseNoHistory();
        $license_no_history -> vehicle_id = $data->id;
        $license_no_history -> vehicle_kind_code = $data->vehicle_kind_code;
        $license_no_history -> province_code = $data->province_code;
        $license_no_history -> licence_no = $data->licence_no;
        $license_no_history -> start_date = date("Y-m-d");
        $license_no_history -> license_no_status = "uses";
        $license_no_history -> created_by = auth()->user()->id;
        $license_no_history -> save();
    }
}
