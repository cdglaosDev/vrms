<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Input;
use DB;

class DateHelper
{
    /*
     *Convert the date given from UI as "dd/mm/yyyy" to "Y-m-d H:i:s" for MySQL
    */
    public static function getMySQLDateTimeFromUIDate($dateValue)
    {

      $day = substr($dateValue,0,2);
      $month = substr($dateValue,3,2);
      $year = substr($dateValue,6,4);
      $data= $year . "-" . $month . "-" . $day . " 00:00:00";
      $timestamp = strtotime($data);
      $mydate = date("Y-m-d H:i:s", $timestamp);
      return $mydate;
    }

    public static function getMySQLDateFromUIDate($dateValue)
    {
      $day = substr($dateValue,0,2);
      $month = substr($dateValue,3,2);
      $year = substr($dateValue,6,4);
      $data= $year . "-" . $month . "-" . $day ;
      $timestamp = strtotime($data);
      //$mydate = date("Y-m-d");
      $mydate = date("Y-m-d", $timestamp);
      return $data;

    }
    // change date format form excel d/m/y to y-m-d
    public static function changeDateFromExcel($dateValue)
    {

      $day = substr($dateValue,0,2);
      $month = substr($dateValue,3,2);
      $year = substr($dateValue,6,4);
      $data= $year . "-" . $month . "-" . $day ;
      return $data;
    }


    public static function showDate($value)
    {
        $date = substr($value, 0, 10);
        $date = date("d-m-Y", strtotime($date));
        return $date;
    }
   
    public static function showExpireDate($value){
      $date = substr($value, 0, 10);
      $date = date("d M Y", strtotime($date));
      return $date;
    }

    public static function expireDate(){
      $expire_date = date('d-m-Y', strtotime('+1 years'));
      return $expire_date;
    }

    public static function dateFormat($value)
    {
      return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }

   

  //Inspect Expire date by app purpose
    public static function inspectDate($app_purpose)
    {
      if(in_array(1,$app_purpose)){
        $expire_date = date('Y-m-d', strtotime('+2 years'));
      }elseif(in_array(11,$app_purpose) && in_array(1,$app_purpose)){
        $expire_date = date('Y-m-d', strtotime('+1 years'));
      }elseif(in_array(3,$app_purpose)){
      $expire_date = date('Y-m-d', strtotime('+1 years'));
      }else{
      $expire_date = null;
      }
      return $expire_date;
     
    }

    //Expire date by Vehicle kind
    public static function expDate($vehicle_kind_code)
    {
      switch ($vehicle_kind_code) {
        case "5":
            $expire_date = date('Y-m-d', strtotime('+2 years'));
            
            break;
        case "8":
          $expire_date = date('Y-m-d', strtotime('+1 years'));
            break;
        default:
        $expire_date = date('Y-m-d', strtotime('+5 years'));
      }
      return $expire_date;
    }
}