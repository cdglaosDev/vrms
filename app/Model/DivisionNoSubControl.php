<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DivisionNoSubControl extends Model
{
   use SoftDeletes;

   protected $fillable=['province_code','division_no_start','division_no_end','alert_at','present_division_no','status'];

   public function province()
   {
      return $this->belongsTo('\App\Model\Province','province_code',"province_code");
   }

}
