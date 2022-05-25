<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleInspection extends Model
{
    use SoftDeletes;
    protected $fillable = ["app_request_no", "date", "inspect_place_id", "issue_date", "expire_date", "vehicle_id", "result", "comment", "user_id","log_activity","status"];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }

    public function activeOptions()
    {
        return [
            1 => 'Active',
            0 => 'Deactive',
        ];
    }

    public function vehicle()
    {
       return $this->belongsTo('\App\Model\Vehicle');
    }

    public function user()
    {
        return $this->belongsTo('\App\User', 'user_id');
    }

    public function inspect_place()
    {
        return $this->hasOne('App\Model\InspectPlace', 'id', 'inspect_place_id');
    }
}
