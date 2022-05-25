<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class VehicleHistory extends Model
{
    protected $table = "vehicle_history";
    protected $guarded = [];

    public function vehicle()
    {
        return $this->belongsTo('\App\Model\Vehicle', 'vehicle_id')->withDefault();
    }

    public function province()
    {
        return $this->belongsTo('\App\Model\Province', 'province_code', 'province_code')->withDefault();
    }

    public function district()
    {
        return $this->belongsTo('\App\Model\District', 'district_code', 'district_code')->withDefault();
    }

    public function vehicle_kind()
    {
        return $this->belongsTo('\App\Model\VehicleKind', 'vehicle_kind_code', 'vehicle_kind_code')->withDefault();
    }

    public function setIssueDateAttribute($value)
    {
        $d_value = null;
        if(isset($value)){
            if ($value == "0000-00-00") {
                $d_value = $value;
            } else {
                $d_value = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            }
        }

        $this->attributes['issue_date'] = $d_value;
    }
    public function getIssueDateAttribute($value)
    {
        if (isset($value)) {
            if ($value == "0000-00-00") {
                return $value;
            } else {
                return Carbon::parse($value)->format('d/m/Y');
            }
        } else {
            return null;
        }
    }

    public function setExpireDateAttribute($value)
    {
        $d_value = null;
        if(isset($value)){
            if ($value == "0000-00-00") {
                $d_value = $value;
            } else {
                $d_value = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            }
        }

        $this->attributes['expire_date'] = $d_value;
    }

    public function getExpireDateAttribute($value)
    {
        if (isset($value)) {
            if ($value == "0000-00-00") {
                return $value;
            } else {
                return Carbon::parse($value)->format('d/m/Y');
            }
        } else {
            return null;
        }
    }
}
