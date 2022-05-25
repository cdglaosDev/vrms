<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
   
    protected $fillable = ['name', 'name_en', 'status', "vehicle_type_group_id", "created_by", "updated_by"];
    
    public function appbooks()
    {
        return $this->hasMany('\App\Model\AppBook');
    }
   
    public function vehicledetail()
    {
    	return $this->belongsTo('\App\Model\VehicleDetail');
    }
   
   public function vehicleinspection()
    {
        return $this->hasMany('\App\Model\VehicleInspection');
    }
    
    public function vtype_group()
    {
        return $this->belongsTo('\App\Model\VehicleTypeGroup', 'vehicle_type_group_id');
    }
  
}
