<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AppBook extends Model
{

	
	 use SoftDeletes;
   //Const DELETED_AT = "status";

     protected $fillable=['book_number', 'book_type', 'book_vehicle_type', 'book_license_plate_number', 'book_vehicle_brand','book_cc','book_engine_number','book_vehicle_model','book_no_cylinder', 'book_vehicle_color', 'book_steering_wheel', 'book_engine_brand', 'book_chass_number', 'book_vehicle_width', 'book_vehicle_length', 'book_vehicle_height', 'book_seat_number', 'book_net_weight', 'book_owner_name', 'book_owner_last_name','book_owner_address','book_owner_address','book_owner_district', 'book_owner_phone', 'book_owner_fax', 'book_valid_date', 'book_issue_date', 'book_issue_place', 'book_approve_officer_name', 'status', 'book_extension_date', 'book_addition_info'];

 public function vehicletypes()
    {
       return $this->belongsTo('\App\Model\VehicleType');
    }
    public function vehiclebrands()
    {
       return $this->belongsTo('\App\Model\VehicleBrand');
    }
    public function vehiclemodels()
    {
       return $this->belongsTo('\App\Model\VehicleModel');
    }
   
     public function districts()
    {
       return $this->belongsTo('\App\Model\District');
    }
}
