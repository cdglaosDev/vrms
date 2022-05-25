<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DrivingSchool extends Model
{
  
    protected $fillable = ['province_code','village_code','district_code','name','name_en','contact','email','phone','address','status'];
    
    public function province()
    {
    	return $this->belongsTo("App\Model\Province", "province_code", "province_code");
    }

    public function district()
    {
    	return $this->belongsTo("App\Model\District", "district_code", "district_code");
    }

    public function village()
    {
    	return $this->belongsTo("App\Model\Village", "village_code", "village_code");
    }
}
