<?php

namespace App\Traits;

use App\Model\LicenseAlphabetControl;
use App\Model\LicenseAlphabetControlStatus;
use App\Model\LicenseNumberPresent;
use App\Model\LicenseNoBooking;
use App\Model\LicenseNoHistory;
use App\Model\LicenseNoNotSale;
use App\Model\LicenseNoSale;
use Exception;

trait LicenceNo
{
    //=========================================================================================================
    public function getLicense($province_code, $type_group, $veh_kind)
    {
        start:$license_info = LicenseNumberPresent::whereProvinceCodeAndVehicleTypeGroupIdAndVehicleKindCodeAndStatus($province_code, $type_group, $veh_kind, "uses")
        ->orderBy('license_no_present_number', 'desc')->first();

        $license_msg = "";
        $license_no = null;
        $alert_at = 0;
        $licenseNoPresent_id = null;
        $text = "";//For Testing
        if (!empty($license_info)) {
            //==========================
            $license_alphabet_id = $license_info->license_alphabet_id;
            $alert_license_present = $this->createLicenseNumber($license_info->alert_license_present);
            $present_license_no_format = $license_info->license_no_present_number;
            $present_license_no = $this->createLicenseNumber($license_info->license_no_present_number); //If leading "0", create number.
            $alert_at = $license_info->alert_at;
            $licenseNoPresent_id = $license_info->id;
            
            check:if ($present_license_no <= 9999) {//Less Than or equal 9999
                if($present_license_no >= $alert_license_present){
                    $license_msg = "alert_at_over";
                }
                
                $result = $this->checkLicenseAlradyUsed($present_license_no_format, $veh_kind, $province_code, $license_info->license_alphabet_id, $license_info->licenseAlphabet->name);
                $text = $result;//For Testing
                if($result != ""){
                    $present_license_no_format = $this->increaseLicenseNumber($present_license_no_format);
                    $present_license_no = $present_license_no + 1; 

                    goto check;
                }else{
                    $license_no = $license_info->licenseAlphabet['name'] . ' ' . $present_license_no_format;
                }
            } else { //Greater Than 9999
                $status_uses = LicenseAlphabetControlStatus::whereName("Uses")->select('id', 'name')->first();
                $status_available = LicenseAlphabetControlStatus::whereName("Available")->select('id', 'name')->first();
                $status_full = LicenseAlphabetControlStatus::whereName("Full")->select('id', 'name')->first();

                //----------- Get Alphabet Control and License No. Present -----------
                $present_alphabet_control = LicenseAlphabetControl::whereProvinceCodeAndVehicleTypeGroupIdAndVehicleKindCodeAndLicenseAlphabetIdAndLicenseAlphabetControlStatusId($province_code, $type_group, $veh_kind, $license_alphabet_id, $status_uses->id)->first();
                if (empty($present_alphabet_control)){
                    throw new Exception ('There is no alphabet "'.$license_info->licenseAlphabet->name.'" in Alphabet Control to get next alphabet.');
                }
                $next_alphabet_id = $present_alphabet_control->license_alphabet_next_id;
                $next_alphabet_control = LicenseAlphabetControl::whereProvinceCodeAndVehicleTypeGroupIdAndVehicleKindCodeAndLicenseAlphabetIdAndLicenseAlphabetControlStatusId($province_code, $type_group, $veh_kind, $next_alphabet_id, $status_available->id)->first();
                $next_license_info = LicenseNumberPresent::whereProvinceCodeAndVehicleTypeGroupIdAndVehicleKindCodeAndStatus($province_code, $type_group, $veh_kind, "availables")->first();
                
                $present_alphabet_name = $present_alphabet_control->licAlphabet->name??'';
                $next_alphabet_name = $present_alphabet_control->licAlphabetNext->name??'';
                $province_name = $present_alphabet_control->province->name??'';
                if(empty($next_alphabet_control)){
                    throw new Exception (str_replace('present_alphabet_name', $present_alphabet_name,(str_replace('next_alphabet_name', $next_alphabet_name, trans('module4.lic_ctrl_no_next')))));
                }else if(empty($next_license_info)){
                    throw new Exception (str_replace('province_name', $province_name,(str_replace('next_alphabet_name', $next_alphabet_name, trans('module4.lic_ctrl_no_lic_present')))));
                }else{
                    //----------- Update Alphabet Control -----------
                    $present_alphabet_control->update(['license_alphabet_control_status_id' => $status_full->id]);//Update uses to full
                    $next_alphabet_control->update(['license_alphabet_control_status_id' => $status_uses->id]);//Update available to uses

                    //----------- Update License No. Present -----------
                    $license_info->update(['status' => "full"]);//Update uses to full
                    $next_license_info->update(['status' => "uses"]);//Update available to uses
                    goto start;
                }
            }
        } else {
            throw new Exception (trans('module4.lic_ctrl_no_present'));
        }

        $lic_array[0] = $license_msg;
        $lic_array[1] = $license_no;
        $lic_array[2] = $alert_at;
        $lic_array[3] = $licenseNoPresent_id; 
        $lic_array[4] = $text;//For Testing

        return $lic_array;
    }
    //process flow for generating auto license number
    //check licneseNonotsale and LicenseNo History and licenseNoBooking table
    /*public function checkLicenseAlradyUsed($license, $veh_kind, $province_code, $license_alphabet_id, $licenseAlphabetName)
    {
        $license_no = $licenseAlphabetName . ' ' . $license;

        if (LicenseNoSale::whereLicenseNoSaleNumberAndProvinceCode($license, $province_code)->exists()) {
            return true;
        } else if (LicenseNoNotSale::whereLicenseNoNotSaleNumberAndProvinceCode($license, $province_code)->exists()) {
            return true;
        } else if (LicenseNoHistory::whereLicenceNoAndProvinceCode($license_no, $province_code)->exists()){
            return true;
        }else if (LicenseNoBooking::whereVehicleKindCodeAndProvinceCodeAndLicenseNoBookNumber($veh_kind, $province_code, $license_no)->exists()) {
            return true;
        }else {//Skip 27 and 67
            $lastTwoNum = substr($license, -2);
            if($lastTwoNum == "27" || $lastTwoNum == "67"){
                return true;
            } 
        }

        return false;
    }*/
    public function checkLicenseAlradyUsed($license, $veh_kind, $province_code, $license_alphabet_id, $licenseAlphabetName)
    {
        $license_no = $licenseAlphabetName . ' ' . $license;

        $text = "";
        if (LicenseNoSale::whereLicenseNoSaleNumberAndProvinceCode($license, $province_code)->exists()) {
            $text = "LicenseNoSale:".$license.":".$province_code;
            return $text;
        } else if (LicenseNoNotSale::whereLicenseNoNotSaleNumberAndProvinceCode($license, $province_code)->exists()) {
            $text = "LicenseNoNotSale:".$license.":".$province_code;
            return $text;
        } else if (LicenseNoHistory::whereVehicleKindCodeAndProvinceCodeAndLicenceNo($veh_kind, $province_code, $license_no)->exists()){
            $text = "LicenseNoHistory:".$veh_kind.":".$province_code.":".$license_no;
            return $text;
        }else if (LicenseNoBooking::whereVehicleKindCodeAndProvinceCodeAndLicenseNoBookNumber($veh_kind, $province_code, $license_no)->exists()) {
            $text = "LicenseNoBooking:".$veh_kind.":".$province_code.":".$license_no;
            return $text;
        }else {//Skip 27 and 67
            $lastTwoNum = substr($license, -2);
            if($lastTwoNum == "27" || $lastTwoNum == "67"){
                $text = "End with 27 or 67:".$lastTwoNum;
                return $text;
            } 
        }

        return $text;
    }

    //IF license_no is leading "0", create number and return it.
    public function createLicenseNumber($license_no)
    {
        $check_no = new \App\Helpers\Helper;
        if ($check_no->number_check($license_no)) {
            return $license_no;
        } else {
            $only_num = (int)(ltrim($license_no, '0'));
            return $only_num;
        }
    }

    //IF license_no is leading "0", create number and increase it.
    public function increaseLicenseNumber($license_no)
    {
        $check_no = new \App\Helpers\Helper;
        if ($check_no->number_check($license_no)) {
            $license_no =  $license_no + 1; 
        } else {
            $length = strlen($license_no);
            $only_num = (int)(ltrim($license_no, '0')) + 1;
            $license_no =  str_pad($only_num, $length, "0", STR_PAD_LEFT);
        }

        return $license_no;
    }
    //=========================================================================================================

    /*
    public function getLicense($province_code, $type_group, $veh_kind)
    {
        $last_lic_no = LicenseNumberPresent::whereProvinceCodeAndVehicleTypeGroupIdAndVehicleKindCodeAndStatus($province_code, $type_group, $veh_kind, "uses")->orderBy('license_no_present_number', 'desc')->select('license_alphabet_id', 'license_no_present_number', 'vehicle_kind_code')->first();

        if (!empty($last_lic_no)) {
            $license = $last_lic_no['license_no_present_number'];
            return $this->checkLicense($license, $veh_kind, $province_code, $last_lic_no);
        } else {
            return "not_exist";
        }
    }
    //process flow for generating auto license number
    //check licneseNonotsale and LicenseNo History and licenseNoBooking table
    public function checkLicense($license, $veh_kind, $province_code, $last_lic_no)
    {
        if (LicenseNoNotSale::whereLicenseNoNotSaleNumber($license)->exists() || LicenseNoSale::whereLicenseNoSaleNumber($license)->exists()) {
            if ($veh_kind == 5 || $veh_kind == 8) { //must_include_dash
                return  $this->checkLicense($this->checkLicenseByVehicleKind($license), $veh_kind, $province_code, $last_lic_no);
            } else {
                return  $this->checkLicense($license + 1, $veh_kind, $province_code, $last_lic_no);
            }
        } else {
            if (LicenseNoHistory::whereLicenseAlphabetIdAndLicenseNoNumberAndVehicleKindCode($last_lic_no['license_alphabet_id'], $license, $veh_kind)->exists()) {
                if ($veh_kind == 5 || $veh_kind == 8) {
                    return   $this->checkLicense($this->checkLicenseByVehicleKind($license), $veh_kind, $province_code, $last_lic_no);
                } else {
                    return   $this->checkLicense($license + 1, $veh_kind, $province_code, $last_lic_no);
                }
            } else {
                $alphabet = \App\Model\LicenseAlphabet::whereId($last_lic_no['license_alphabet_id'])->pluck('name')->first();
                $concat_lic = $alphabet . ' ' . $license;
                if (LicenseNoBooking::whereVehicleKindCodeAndProvinceCodeAndLicenseNoBookNumber($veh_kind, $province_code, $concat_lic)->exists()) {
                    if ($veh_kind == 5 || $veh_kind == 8) {
                        return   $this->checkLicense($this->checkLicenseByVehicleKind($license), $veh_kind, $province_code, $last_lic_no);
                    } else {
                        return   $this->checkLicense($license + 1, $veh_kind, $province_code, $last_lic_no);
                    }
                } else {

                    switch ($veh_kind) {
                        case "5":
                            $lic_no = $this->FormatByVehicleKind($license);
                            $lic_no = $last_lic_no->licenseAlphabet['name'] . ' ' . $lic_no;
                            break;
                        case "8":
                            $lic_no = $this->FormatByVehicleKind($license);
                            $lic_no = $last_lic_no->licenseAlphabet['name'] . ' ' . $lic_no;
                            break;
                        default:
                            $lic_no = $last_lic_no->licenseAlphabet['name'] . ' ' . $license;
                    }
                }
            }
        }
        return $lic_no;
    }

    //check license no into other table by vehicle kind
    //if lic no have in other table, increment 1 for this number
    public function checkLicenseByVehicleKind($license)
    {
        $lic = explode('-', $license);
        if (count($lic) == 2) //If vehicle = 5 or 8, must include "-". If count == 1, "-" is not included in licenseNo. 
        {
            $lic1 = $lic[1] + 1;
            return $lic[0] . '-' . $lic1;
        } else {
            throw new \Exception("License No. format should be \"00-00\" for VehicleKind 5 and 8. Please check in \"License Number Present\" for Number Code \"" . $license . "\".");
        }
    }

    //get license format by vehicle kind when added into vehicle table
    public function FormatByVehicleKind($license)
    {
        $lic = explode('-', $license);
        if (count($lic) == 2) //If vehicle = 5 or 8, must include "-". If count == 1, "-" is not included in licenseNo. 
        {
            $lic1 = $lic[1];
            return $lic[0] . '-' . $lic1;
        } else {
            throw new \Exception("License No. format should be \"00-00\" for VehicleKind 5 and 8. Please check in \"License Number Present\" for Number Code \"" . $license . "\".");
        }
    }*/

    //update license no into license no present table 
    public function updateLicenseNoPresent($province_code, $licence_no, $vehicle_kind_code, $type_group, $old_kind_code, $vehicle_id)
    {
        if ($licence_no != null) {
            $app_form = \App\Model\AppForm::whereAppFormStatusIdAndVehicleId(3, $vehicle_id)->latest()->first();
            if ($app_form) {
                $booking_license = LicenseNoBooking::whereAppIdAndVehicleKindCodeAndLicenseNoBookNumber($app_form->id, $old_kind_code, $licence_no)->latest()->first();
            } else {
                $booking_license = null;
            }

            if (!$booking_license) {
                $lic_no = explode(" ", $licence_no);
                $alphabet_id = \App\Model\LicenseAlphabet::whereName($lic_no[0])->pluck('id')->first();
                //$lic = $lic_no[1];
                if ($vehicle_kind_code == 5 || $vehicle_kind_code == 8) {
                    $lic = $this->IncrementNumberByVehicleKind($lic_no[1]);
                } else {
                    if ($this->number_check($lic_no[1])) {
                        $lic = $lic_no[1] + 1;
                    } else {
                        $length = strlen($lic_no[1]);
                        $only_num = (int)(ltrim($lic_no[1], '0')) + 1;
                        $lic =  str_pad($only_num, $length, "0", STR_PAD_LEFT);
                    }
                }

                LicenseNumberPresent::whereProvinceCodeAndVehicleTypeGroupIdAndVehicleKindCodeAndStatus($province_code, $type_group, $vehicle_kind_code, 'uses')->update(['license_no_present_number' => $lic]);
            } else {
                //If LicenseNo is getting from LicenseNoBooking, change LicenseNoBooking's licenseNo as 2(uses).
                $booking_license->status = 2;
                $booking_license->save();
            }
        }
    }
    //increment license number by vehicle kind
    public function IncrementNumberByVehicleKind($license)
    {
        $lic = explode('-', $license);
        $lic1 = $lic[1] + 1;
        return $lic[0] . '-' . $lic1;
    }

    public function number_check($int)
    {
        if ($int > 0 && !is_float($int) && $int{
        0} != 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
