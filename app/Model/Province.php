<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
   
   public $timestamps = true;
   protected $fillable=['name', 'name_en', 'desc', 'country_id', 'old_name', 'status', 'province_code', 'abb', 'abb_en'];

   public function country()
   {
   return $this->belongsTo('\App\Model\Country', 'country_id');
   }
   public function departments()
   {
      return $this->hasMany('\App\Model\Department');
   }

   public function services()
   {
      return $this->hasMany('\App\Model\ServiceCounter');
   }
   public function districts()
   {
      return $this->hasMany('\App\Model\District');
   }

   public function trasfers()
   {
      return $this->hasMany('\App\Model\TransferVehicle');
   }

   public function storedocuments()
   {
      return $this->belongsTo('\App\Model\StoreDocument');
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

   public function provincenocontrol()
   {
      return $this->hasMany('\App\Model\ProvinceNoControl');
   }
   public function divisionnocontrol()
   {
      return $this->hasMany('\App\Model\ProvinceNoControl');
   }

   public function TransferVehicle()
   {
      return $this->hasMany('App\Model\TransferVehicle');
   }

   public function price_item_unit_price()
   {
      return $this->hasMany('App\Model\PriceItemUnitPrice');
   }
   public function price_item()
   {
      return $this->hasMany('App\Model\PriceItem');
   }

   public function vehicledetail()
   {
      return $this->hasMany('App\Model\VehicleDetail');
   }

   public function v_passport()
   {
      return $this->hasMany('App\Model\VehiclePassport', 'pro_code');
   }

   public function user_infos()
   {
      return $this->hasMany('App\Model\UserInfo', 'province_code', 'province_code');
   }

   //get province by user level
   public  function scopeGetProvince()
   {
     if(auth()->user()->user_level == "province"){
        return $this->whereProvinceCode(auth()->user()->user_info->province_code)->whereStatus(1)->orderBy('created_at')->get();
     }else {
         return $this->whereStatus(1)->orderBy('created_at')->get(); 
     }
   }
   // get province by customer
   public  function scopeProvinceByCustomer()
   {
      if(auth()->check()){
         if(auth()->user()->user_type == "customer"){
            return $this->whereProvinceCode(auth()->user()->user_info->province_code)->whereStatus(1)->get();
         } else {
            return self::GetProvince();
         }
      }
     
   }   
 }

