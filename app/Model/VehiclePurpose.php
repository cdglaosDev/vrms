<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class VehiclePurpose extends Model
{
   
    protected $fillable = ['name', 'name_en', 'type'];

    public function vehicle_detail()
    {
        return $this->hasMany('\App\Model\VehicleDetail');
    }
}
