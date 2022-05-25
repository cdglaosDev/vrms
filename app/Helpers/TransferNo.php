<?php
namespace App\Helpers;
use App\Helpers\GenerateCodeNo;
use App\Model\TransferVehicle;
use App\Model\VehicleInspection;
class TransferNo
{
    public static function inpect_no()
    {
        $code = VehicleInspection::where('inspect_number', 'LIKE', GenerateCodeNo::getCodePrefix() . '%')->orderBy('inspect_number', 'desc')->select('inspect_number')->first();
        $inspect_no= GenerateCodeNo::priceCode($code['inspect_number']);
        return $inspect_no;
    }
   
}