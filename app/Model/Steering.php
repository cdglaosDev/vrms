<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
class Steering extends Model
{
  
    protected $fillable = ['name', 'name_en', 'description', 'status'];

    public function vehicledetail()
    {
       return $this->hasMany('\App\Model\VehicleDetail');
    }
}
