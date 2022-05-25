<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
class TrafficAccident extends Model
{
    protected $table = "traffic_accidents";
    protected $fillable=[ 'name', 'name_en', 'status'];

    public function illegal_trafic_acci()
    {
        return $this->belongsTo("App\Model\IllegalTrafficAccident", 'traffic_accidence_id');
    }
    
}
