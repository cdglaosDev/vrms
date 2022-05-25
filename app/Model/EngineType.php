<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
class EngineType extends Model
{
    protected $fillable = ['name', 'name_en', 'description', 'status'];

    public function vehicledetail()
    {
       return $this->belongsTo('\App\Model\VehicleDetail');
    }
}
