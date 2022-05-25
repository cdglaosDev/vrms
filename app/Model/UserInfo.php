<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class UserInfo extends Model
{
    protected $guarded = [];
	
    protected $dates = ['deleted_at'];
    public function vehiclesales()
    {
    	return $this->belongsTo('App\Model\VehicleSaleCenter', 'user_id')->withDefault();
    }
    public function province()
    {
    	return $this->belongsTo('App\Model\Province', "province_code", "province_code")->withDefault();
    }
    public function servicecounter()
    {
        return $this->belongsTo('App\Model\ServiceCounter', 'user_id')->withDefault();
    }

    public function district()
    {
    	return $this->belongsTo('App\Model\District', "district_code", "district_code")->withDefault();
    }

    public function users()
    {
    	return $this->belongsTo('App\User', 'user_id')->withDefault();
    }
   
}
