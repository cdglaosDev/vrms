<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
   
    protected $fillable = ['name', 'name_en', 'description', 'brand_id', 'status', 'created_by'];
    

    public function brand()
    {
    	return $this->belongsTo('App\Model\VehicleBrand', 'brand_id');
    }

    public function itprs()
    {
 		return $this->hasOne('\App\Model\ITPRS');
 	}
 	public function appbooks()
    {
        return $this->hasMany('\App\Model\AppBook');
    }
}
