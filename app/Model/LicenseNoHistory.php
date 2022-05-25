<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class LicenseNoHistory extends Model
{
    protected $table = "license_no_history";
    protected $fillable = ["vehicle_id", "licence_no", "vehicle_kind_code", "province_code","start_date", "end_date","license_no_status", "remark", "created_by"];

    public function getStatusAttribute($attribute)
    {
        return $this->activeOptions()[$attribute];
    }

    public function vehicle()
    {
        return $this->belongsTo('App\Model\Vehicle', 'vehicle_id');
    }
}
