<?php

namespace App\Helpers;

class Helper
{
    public static function type($type)
    {
        return auth()->user()->user_type == $type;
    }

    // get province for current login user
    public static function current_province()
    {
        return \App\Model\UserInfo::where('user_id', auth()->id())->pluck('province_code')->first();
    }
     //get assign counter id
     public static function counterId()
    {
        return isset(auth()->user()->counter_id)? auth()->user()->counter_id:'counter';
    }

    // vrms access token when search vehicle in api
    public static function accessToken()
    {
        return "7syoaUOHt8lhH254ogoPk9dSzJvAh3hJDH4/dlYIULQ=";
    }
    //get each role by type
    public static function getType($type)
    {
        return \App\Permission::whereType($type)->get();
    }
    //get check all by type
    public static function getAllType($type)
    {
        return \App\Permission::whereType($type)->select('id', 'name')->first();
    }

    public static function bNo($service_counter_id)
    {
        $bill_no = new \App\Helpers\BillNo;
        return $bill_no->billNo($service_counter_id);
    }

    public static function userLevel()
    {
        return auth()->user()->user_level;
    }

    //auto show "buying license no" if buying license for this app in license booking when click vehicle edit page
    public static function getBuyLicNo($vehicle_id, $vehicle_kind)
    {
        $app_form = \App\Model\AppForm::whereAppFormStatusIdAndVehicleId(3, $vehicle_id)->latest()->first();
        if ($app_form != null) {
            $buy_lic_no = \App\Model\LicenseNoBooking::whereAppIdAndVehicleKindCode($app_form->id, $vehicle_kind)->latest()->first();
            //$alphabet = \App\Model\LicenseNoBooking::whereAppId($app_form->id)->with('alphabet:id,name')->first();
            if ($buy_lic_no) {

                $book_license_no = $buy_lic_no->license_no_book_number;
                //=================================================================================
                //There is no space in some LicenseNoBooking's license_no because of the old data. 
                //So, if there is no space, add sapce in license_no and udpate in LicenseNoBooking.
                $lic_no_arr = explode(" ", trim($book_license_no));
                if (count($lic_no_arr) == 1) {
                    $book_license_no = substr_replace($book_license_no," ", 2, 0);
                    
                    $buy_lic_no->license_no_book_number = $book_license_no;
                    $buy_lic_no->save();
                }
                //=================================================================================

                return $book_license_no;
            }
        }
        return null;
    }
    //check number or string when using auto increment 
    public function number_check($int)
    {
        if ($int > 0 && !is_float($int) && $int[0] != 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

     //remove space for engine no and chassis no when submit app
     public static function SubmitApp($id)
     {
         $pre_app = \App\Model\PreRegisterApp::find($id);
         $pre_app->update(['app_status_id' => 3]);
         $vehicle_detail = \App\Model\VehicleDetail::whereId($pre_app->vehicle_detail_id)->first();
         if  ( ($vehicle_detail->engine_no == trim($vehicle_detail->engine_no) && strpos($vehicle_detail->engine_no, ' ') !== false ) || ($vehicle_detail->chassis_no == trim($vehicle_detail->chassis_no) && strpos($vehicle_detail->chassis_no, ' ') !== false )) {
             $vehicle_detail->update(['engine_no'=> strtoupper(str_replace(' ', '', $vehicle_detail->engine_no)), 'chassis_no' => strtoupper(str_replace(' ', '', $vehicle_detail->chassis_no))]);
         }
     }
}
