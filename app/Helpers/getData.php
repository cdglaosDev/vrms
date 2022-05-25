<?php
namespace App\Helpers;
use App\Helpers\GenerateCodeNo;
use App\Model\TransferVehicle;
class getData
{
    public static function vehInfo()
    {
        $data['kinds'] = \App\Model\VehicleKind::select('vehicle_kind_code', 'name')->whereStatus(1)->get();
        $data['brands'] = \App\Model\VehicleBrand::whereStatus(1)->get();
        $data['types'] = \App\Model\VehicleType::whereStatus(1)->get();
        $data['models'] = \App\Model\VehicleModel::whereStatus(1)->get();
        $data['provinces'] = \App\Model\Province::whereStatus(1)->get();
        $data['eng_type'] = \App\Model\EngineType::whereStatus(1)->get();
        $data['districts'] = \App\Model\District::whereStatus(1)->get();
        $data['colors'] = \App\Model\Color::whereStatus(1)->get();
        $data['gases'] = \App\Model\Gas::get();
        $data['purposes'] = \App\Model\VehiclePurpose::get();
        $data['doc_type'] = \App\Model\ApplicationDocType::get();
        $data['steerings'] = \App\Model\Steering::get();
        $data['moter_brand'] = \App\Model\EngineBrand::whereStatus(1)->get();
        $data['app_status'] = \App\Model\ApplicationStatus::whereStatus(1)->get();
        $data['app_types'] = \App\Model\ApplicationType::whereStatus(1)->get();
        $data['staff'] = \App\Model\Staff::whereStatus(1)->get();
        $data['app_form_status'] = \App\Model\AppFormStatus::whereStatus(1)->get();
        return $data;
    }

    public static function getAppNumber()
    {
        $code = \App\Model\AppForm::where('app_no', 'LIKE', GenerateCodeNo::appNumberPrefix() . '%')->orderBy('app_no', 'desc')->select('app_no')->first();
      
        $app_num= GenerateCodeNo::appNumber($code['app_no']);
        
        return $app_num;
    }

    public static function tran_no()
    {
        $code = TransferVehicle::where('transfer_no', 'LIKE', GenerateCodeNo::tranNoPrefix() . '%')->orderBy('transfer_no', 'desc')->select('transfer_no')->first();
        if ($code != null) {
            $tran_code= GenerateCodeNo::tranNo($code['transfer_no']);
            return $tran_code;
        } else {
            return "TR000001";
        }
    }

    public static function getTrafficeAccident($id)
    {
       return  \App\Model\IllegalTrafficAccident::whereIllegalTrafficId($id)->pluck('traffic_accidence_id')->toArray();
    }
}