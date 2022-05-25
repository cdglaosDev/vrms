<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class VehicleOverSystem extends Model
{
    protected $table = "vehicle_over_system";
    protected $guarded = [];

    public function vtype()
    {
        return $this->belongsTo('\App\Model\VehicleType', 'vehicle_type_id')->withDefault();
    }

    public function vbrand()
    {
        return $this->belongsTo('\App\Model\VehicleBrand', 'brand_id')->withDefault();
    }

    public function vmodel()
    {
        return $this->belongsTo('\App\Model\VehicleModel', 'model_id')->withDefault();
    }

    public function color()
    {
        return $this->belongsTo("App\Model\Color", 'color_id');
    }

    public function steering()
    {
        return $this->belongsTo('\App\Model\Steering', 'steering_id')->withDefault();
    }

    public function user()
    {
        return $this->belongsTo('\App\User', 'created_by');
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = isset($value) ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : $value;
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
    
}
