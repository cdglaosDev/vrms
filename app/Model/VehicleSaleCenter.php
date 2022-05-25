<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VehicleSaleCenter extends Model
{
   
     protected $fillable = ['user_id', 'province_code', 'district_code', 'village_code', 'name', 'name_en', 'email', 'phone', 'address', 'contact', 'status', 'created_by'];

    public function province()
    {
    	return $this->belongsTo("App\Model\Province", "province_code", "province_code");
    }
    public function userinfos()
    {
        return $this->belongsTo("App\Model\UserInfo", 'user_id');
    }
    public function district()
    {
    	return $this->belongsTo("App\Model\District", "district_code", "district_code");
    }
    public function village()
    {
    	return $this->belongsTo("App\Model\Village", "village_code", "village_code");
    }
    public function users()
    {
        return $this->belongsTo("App\User", 'user_id');
    }
    
}
