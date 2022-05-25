<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class IllegalTraffic extends Model
{
    protected $fillable = ["vehicle_id", "place", "offender_name", "officer_name", "date", 
                        "status", "remark", "illegal_date", "illegal_no", "bill_date","bill_no", "note", "to_date", "user_id", "log"];

    public function vehicle()
    {
        return $this->belongsTo("App\Model\Vehicle", 'vehicle_id')->withDefault();
    }

    public function illegal_trafic_acc()
    {
        return $this->hasMany("App\Model\IllegalTrafficAccident", 'illegal_traffic_id');
    }

    

}

