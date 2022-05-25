<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
class VehicleKind extends Model
{

 	protected $fillable=['name', 'name_en', 'vehicle_kind_code', 'status'];

 	public function itprs()
	{
 		return $this->hasOne('\App\Model\ITPRS');
 	}
  
}
