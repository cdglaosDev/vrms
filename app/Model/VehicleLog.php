<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VehicleLog extends Model
{
    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at',
       
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function brandOld()
    {
        return $this->belongsTo('App\Model\VehicleBrand' ,'from','id');
    }

    public function brandNew()
    {
        return $this->belongsTo('App\Model\VehicleBrand' ,'to','id');
    }
   
    public function modelOld()
    {
        return $this->belongsTo('App\Model\VehicleModel' ,'from','id');
    }
    public function modelNew()
    {
        return $this->belongsTo('App\Model\VehicleModel' ,'to','id');
    }
    public function provinceOld()
    {
        return $this->belongsTo('App\Model\Province' ,'from','province_code');
    }
    public function provinceNew()
    {
        return $this->belongsTo('App\Model\Province' ,'to','province_code');
    }
    public function districtOld()
    {
        return $this->belongsTo('App\Model\District' ,'from','district_code');
    }
    public function districtNew()
    {
        return $this->belongsTo('App\Model\District' ,'to','district_code');
    }

    public function colorOld()
    {
        return $this->belongsTo('App\Model\Color' ,'from','id');
    }

    public function colorNew()
    {
        return $this->belongsTo('App\Model\Color' ,'to','id');
    }

    public function kindOld()
    {
        return $this->belongsTo('App\Model\VehicleKind' ,'from','vehicle_kind_code');
    }

    public function kindNew()
    {
        return $this->belongsTo('App\Model\VehicleKind' ,'to','vehicle_kind_code');
    }

    public function typeOld()
    {
        return $this->belongsTo('App\Model\VehicleType' ,'from','id');
    }

    public function typeNew()
    {
        return $this->belongsTo('App\Model\VehicleType' ,'to','id');
    }

    public function motorBrandOld()
    {
        return $this->belongsTo('App\Model\EngineBrand' ,'from','id');
    }

    public function motorBrandNew()
    {
        return $this->belongsTo('App\Model\EngineBrand' ,'to','id');
    }
    public function steeringOld()
    {
        return $this->belongsTo('App\Model\Steering' ,'from','id');
    }

    public function steeringNew()
    {
        return $this->belongsTo('App\Model\Steering' ,'to','id');
    }

    public function engineTypegOld()
    {
        return $this->belongsTo('App\Model\EngineType' ,'from','id');
    }

    public function engineTypegNew()
    {
        return $this->belongsTo('App\Model\EngineType' ,'to','id');
    }


}
