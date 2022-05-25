<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
class Village extends Model
{
   
    protected $fillable=['village_code', 'name', 'name_en', 'description', 'province_code', 'district_code', 'status', 'created_by'];

    public function province()
    {
       return $this->belongsTo('\App\Model\Province', 'province_code', "province_code");
    }

    public function district()
    {
       return $this->belongsTo('\App\Model\District', 'district_code', "district_code");
    }
    public function drivingschool()
    {
        return $this->hasMany('\App\Model\DrivingSchool');
    }
    public function vehiclesalecenter()
    {
        return $this->hasMany('\App\Model\VehicleSaleCenter');
    }
    public function itprs()
    {
        return $this->hasMany('\App\Model\ITPRS');
    }
}
