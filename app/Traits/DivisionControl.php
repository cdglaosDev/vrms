<?php

namespace App\Traits;

use App\Model\DivisionNoControl;
use App\Model\Vehicle;

trait DivisionControl
{
    public function getDivNo($province_code)
    {
        start:$div_no = DivisionNoControl::whereProvinceCodeAndStatus($province_code, 'uses')->first();

        $division_msg = "normal";
        $division_no = null;
        if ($div_no != null) {            
            $division_no_start = $this->createDivNumber($div_no->division_no_start);
            $division_no_end = $this->createDivNumber($div_no->division_no_end);
            $alert_at = $this->createDivNumber($div_no->alert_at);

            if ($div_no->present_division_no == null) { // if present no is null
                $present_division_no_format = $this->createDivNumberFormat($div_no->division_no_start);
                $present_division_no = $division_no_start; 
                
                //Check increase division_no is already used or not
                $division_info = Vehicle::whereProvinceCodeAndDivisionNo($province_code, $present_division_no_format)->get();

                if (count($division_info) > 0) { //already use
                    goto increease_div_no;
                } else { //haven't used it.
                    $division_no = $present_division_no_format;
                }
            } else {
                $present_division_no_format = $div_no->present_division_no;
                $present_division_no = $this->createDivNumber($div_no->present_division_no); //If leading "0", create number.

                increease_div_no:$present_division_no_format = $this->increaseDivNumber($present_division_no_format);
                $present_division_no = $present_division_no + 1;

                if ($present_division_no <= $division_no_end) { // if present_no less than end_no in div_controls
                    //if present_division_no in  greater than equal min and less than equal max in div_controls
                    if ($present_division_no >= $division_no_start && $present_division_no <= $division_no_end) {
                        if ($present_division_no == $alert_at) {
                            $division_msg = "alert_at_equal";
                        }else if ($present_division_no > $alert_at) {
                            $division_msg = "alert_at_over";
                        }

                        //Check increase division_no is already used or not
                        $division_info = Vehicle::whereProvinceCodeAndDivisionNo($province_code, $present_division_no_format)->get();

                        if (count($division_info) > 0) { //already use
                            goto increease_div_no;
                        } else { //haven't used it.
                            $division_no = $present_division_no_format;
                        }
                    }else{
                        $division_msg = "must_between";
                        $division_no = null;
                    }
                } else {
                    $available_div_no = \App\Model\DivisionNoControl::whereProvinceCodeAndStatus($province_code, 'availables')->first();
                    if ($available_div_no != null) {
                        $div_no->update(['status' =>  'full']); //Change "uses" to "full"
                        $available_div_no->update(['status' =>  'uses']); //Change "availables" to "uses"
                        goto start;
                    } else {
                        $division_msg = "full";
                        $division_no = null;
                    }
                }
            }
        } else {
            $division_msg = "not_exist";
            $division_no = null;
        }

        $div_array[0] = $division_msg;
        $div_array[1] = $division_no;

        return $div_array;
    }

    //IF division_no is leading "0", create number and return it.
    public function createDivNumber($division_no)
    {
        $check_no = new \App\Helpers\Helper;
        if ($check_no->number_check($division_no)) {
            return $division_no;
        } else {
            $only_num = (int)(ltrim($division_no, '0'));
            return $only_num;
        }
    }

    //IF division_no is leading "0", create number and increase it.
    public function increaseDivNumber($division_no)
    {
        $check_no = new \App\Helpers\Helper;
        if ($check_no->number_check($division_no)) {
            $division_no =  $division_no + 1; // if division_no have and also integer value, current division_no autoincrement.
            $length = strlen($division_no);
            if($length < 7){
                $division_no = str_pad($division_no, 7, "0", STR_PAD_LEFT);
            }
        } else {
            $length = strlen($division_no);
            $only_num = (int)(ltrim($division_no, '0')) + 1;
            if($length >= 7){
                $division_no =  str_pad($only_num, $length, "0", STR_PAD_LEFT);
            }else{
                $division_no =  str_pad($only_num, 7, "0", STR_PAD_LEFT);
            }
            
        }

        return $division_no;
    }

    //IF length is less than 7, add "0" before number to length 7
    public function createDivNumberFormat($division_no)
    {
        $length = strlen($division_no);
        
        if($length < 7){
            $division_no =  str_pad($division_no, 7, "0", STR_PAD_LEFT);
        }

        return $division_no;
    }

    //update division_no in division control table after added division in vehicle
    public function updateDivPresent($pro_code, $division_no)
    {
        if ($division_no != null) {
            DivisionNoControl::whereProvinceCodeAndStatus($pro_code, 'uses')->update(['present_division_no' => $division_no]);
        }
    }
}
