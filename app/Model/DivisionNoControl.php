<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GeneralEnum;

class DivisionNoControl extends Model
{
     
   use GeneralEnum;
   protected $fillable=['province_code', 'division_no_start', 'division_no_end', 'alert_at', 'present_division_no', 'status'];
   
   public static $generalenum = [
   "status" => ["uses" => "Uses", "not uses" => "Not Uses", "availables" => "Available"]
   ];
 
   public function province()
   {
      return $this->belongsTo('\App\Model\Province', "province_code", "province_code");
   }

   

}
