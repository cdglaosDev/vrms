<?php
namespace App\Library;

use Illuminate\Http\Request;
use App\Model\AppDocument;

class DocFilename
{
    //change filename
    public function DocFile($file, $value)
    {
        if ($value == 2) {
            $name='Licenses_of_import_car'.'.'.$file->extension();
        } elseif ($value == 5) {
            $name='Licenses_of_import_goods_of_Department_of_Commerce'.'.'.$file->extension();
        } elseif ($value == 4) {
            $name='Vehicle_License_Technician_License_Mechanical_import_and_registration_in_Lao_PDR'.'.'.$file->extension();
        } elseif ($value == 3) {
            $name='Licenses_Of_the_Ministry_of_Industry_and_Commerce'.'.'.$file->extension();
        } elseif ($value == 6) {
            $name='Tax_returns'.'.'.$file->extension();
        } elseif ($value == 7) {
            $name='Tax_Relief_certificate'.'.'.$file->extension();
        } elseif ($value == 8) {
            $name='Record_of_solving_the_case'.'.'.$file->extension();
        }

        return $name;
    }

   //create folder by preregister form
    public function getDocFolder($vehicle_detail_id)
    {
        return \App\Model\PreRegisterApp::whereVehicleDetailId($vehicle_detail_id)->pluck('regapp_number')->first();
    }

    //create document folder for App form
    public function getVehDocFolder($vehicle_detail_id)
    {
        return \App\Model\AppForm::whereVehicleId($vehicle_detail_id)->pluck('app_no')->first();
    }

}