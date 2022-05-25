<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
	
    protected $fillable=['name','name_en','desc','province_code','status','district_code'];

   public function province()
   {

      return $this->belongsTo('\App\Model\Province', 'province_code', "province_code");

   }

   public function department()
   {
      return $this->hasMany('\App\Model\Department');
   }

   public function appbooks()
   {
      return $this->hasMany('\App\Model\AppBook');
   }

   public function villages()
   {
      return $this->hasMany('\App\Model\Village');
   }
   
   public function drivingschool()
   {
      return $this->hasMany('\App\Model\DrivingSchool');
   }

   public function vehiclesalecenter()
   {
      return $this->hasMany('\App\Model\VehicleSaleCenter');
   }

   public function itprs()
   {
      return $this->hasMany('\App\Model\ITPRS');
   }

   public function vehicledetail()
   {
      return $this->hasMany('\App\Model\VehicleDetail');
   }
}

