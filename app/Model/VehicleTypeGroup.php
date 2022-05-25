<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Traits\HasRoles;
class VehicleTypeGroup extends Model
{
    protected $table = "vehicle_type_groups";
    protected $fillable = ["name", "status"];

    public function vehicle_type()
    {
        return $this->belongsTo('\App\Model\VehicleType');
    }
  
}
