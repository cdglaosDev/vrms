<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class IllegalTrafficAccident extends Model
{
   
    protected $table = "illegal_traffic_accident";
    protected $fillable=[ 'illegal_traffic_id', 'traffic_accidence_id'];

    public function illegal_traffic()
    {
        return $this->belongsTo('App\Model\IllegalTraffic', 'illegal_traffic_id');
    }

    public function traffic_accident()
    {
        return $this->belongsTo('App\Model\TrafficAccident', 'traffic_accidence_id');
    }
}

