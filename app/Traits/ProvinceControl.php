<?php

namespace App\Traits;

use App\Model\ProvinceNoControl;
use App\Model\Vehicle;

trait ProvinceControl
{
    public function getProNo($province_code)
    {
        $pro_no = ProvinceNoControl::whereProvinceCodeAndStatus($province_code, 'uses')->first();

        $province_msg = "normal";
        $province_no = null;
        $text = null;
        if ($pro_no != null) {
            $province_no_start = $this->createProvinceNumber($pro_no->province_no_start);
            if ($pro_no->present_province_no == null) {
                $province_no = $pro_no->province_no_start;

                $text = $text.",".$this->createProNumberFormat($pro_no->province_no_start);//for testing
                $present_province_no_format = $this->createProNumberFormat($pro_no->province_no_start);
                $present_province_no = $province_no_start; 
                
                $text = $text.",".$present_province_no_format;//for testing

                //Check increase province_no is already used or not
                $province_info = Vehicle::whereProvinceCodeAndProvinceNo($province_code, $present_province_no_format)->get();

                if (count($province_info) > 0) { //already use
                    goto increase_pro_no;
                } else { //haven't used it.
                    $province_no = $present_province_no_format;
                }
            } else {
                $present_province_no_format = $pro_no->present_province_no;
                $present_province_no = $this->createProvinceNumber($pro_no->present_province_no); //If leading "0", create number.

                increase_pro_no:$present_province_no_format = $this->increaseProvinceNumber($present_province_no_format);
                $present_province_no = $present_province_no + 1;

                $text = $text.",".$present_province_no_format;//for testing

                //Check increase province_no is already used or not
                $province_info = Vehicle::whereProvinceCodeAndProvinceNo($province_code, $present_province_no_format)->get();
                
                if (count($province_info) > 0) { //already use
                    goto increase_pro_no;
                } else { //haven't used it.
                    $province_no = $present_province_no_format;
                }
            }
        } else {
            $province_msg = "not_exist";
            $province_no = null;
        }

        $pro_array[0] = $province_msg;
        $pro_array[1] = $province_no;
        $pro_array[2] = $text;

        return $pro_array;
    }

    //IF province_no is leading "0", create number and return it.
    public function createProvinceNumber($province_no)
    {
        $check_no = new \App\Helpers\Helper;
        if ($check_no->number_check($province_no)) {
            return $province_no;
        } else {
            $only_num = (int)(ltrim($province_no, '0'));
            return $only_num;
        }
    }

    //IF province_no is leading "0", create number and increase it.
    public function increaseProvinceNumber($province_no)
    {
        $check_no = new \App\Helpers\Helper;
        if ($check_no->number_check($province_no)) {
            $province_no =  $province_no + 1; // if province_no have and also integer value, current province_no autoincrement.
            $length = strlen($province_no);
            if($length < 7){
                $province_no =  str_pad($province_no, 7, "0", STR_PAD_LEFT);
            }
        } else {
            $length = strlen($province_no);
            $only_num = (int)(ltrim($province_no, '0')) + 1;
            if($length >= 7){
                $province_no =  str_pad($only_num, $length, "0", STR_PAD_LEFT);
            }else{
                $province_no =  str_pad($only_num, 7, "0", STR_PAD_LEFT);
            }
        }

        return $province_no;
    }

    //IF length is less than 7, add "0" before number to length 7
    public function createProNumberFormat($province_no)
    {
        $length = strlen($province_no);
        
        if($length < 7){
            $province_no =  str_pad($province_no, 7, "0", STR_PAD_LEFT);
        }

        return $province_no;
    }

    public function updateProPresent($pro_code, $province_no)
    {
        if ($province_no != null) {
            ProvinceNoControl::whereProvinceCodeAndStatus($pro_code, 'uses')->update(['present_province_no' => $province_no]);
        }
    }
}
