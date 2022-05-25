<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VehicleBrand extends Model
{
    protected $fillable = [ 'name', 'name_en', 'description', 'status'];

    public function models()
    {
    	return $this->hasMany("App\Model\VehicleModel");
    }

    public function appbooks()
    {
        return $this->hasMany('\App\Model\AppBook');
    }

    public function vehicledetail()
    {
        return $this->hasMany('\App\Model\VehicleDetail');
    }

    public function itprs()
    {
 		return $this->hasOne('\App\Model\ITPRS');
 	}

   
}
