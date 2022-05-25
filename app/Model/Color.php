<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
	
     protected $fillable = [
        'name', 'name_en', 'status', 'created_by', "updated_by"
    ];
   	public function itprs()
   	{
 		return $this->hasOne('\App\Model\ITPRS');
 	}
	 
 	public function vehicledetail()
	{
 		return $this->hasMany('\App\Model\VehicleDetail');
 	}
}
