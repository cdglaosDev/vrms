<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VehiclePassport extends Model
{
    protected $table = "vehicle_passports";
    protected $guarded = [];

    public function getBookNoAttribute(){
        return $this->pro_code."-".ltrim($this->code_no, '0')."/".$this->year;
    }

    public function vehicle_type()
    {
        return $this->belongsTo('\App\Model\VehicleType', 'vehicle_type_id')->withDefault();
    }

    public function brand()
    {
    	return $this->belongsTo('\App\Model\VehicleBrand', 'brand_id')->withDefault();
    }

    public function vehicle_model()
    {
    	return $this->belongsTo('\App\Model\VehicleModel', 'model_id')->withDefault();
    }

    public function engine_brand()
    {
    	return $this->belongsTo('\App\Model\EngineBrand', 'engine_brand_id')->withDefault();
    }

    public function dis()
    {
    	return $this->belongsTo('\App\Model\District', 'district', 'district_code')->withDefault();
    }

    public function pro()
    {
    	return $this->belongsTo('\App\Model\Province', 'province', 'province_code')->withDefault();
    }
 
    public function color()
    {
        return $this->belongsTo('\App\Model\Color', 'color_id')->withDefault();
    }

    public function steering()
    {
        return $this->belongsTo('\App\Model\Steering', 'steering_id')->withDefault();
    }

    public function done_at()
    {
    	return $this->belongsTo('\App\Model\Province', 'doneat', 'province_code')->withDefault();
    }

    public function vehicle_purpose()
    {
        return $this->belongsTo("\App\Model\VehiclePurpose", 'vehicle_purpose_id')->withDefault();
    }
    public function users()
    {
        return $this->belongsTo("App\User", 'id');
    }

    
}
