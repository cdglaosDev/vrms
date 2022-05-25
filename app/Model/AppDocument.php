<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
class AppDocument extends Model
{
    use SoftDeletes;
    protected $fillable=['vehicle_detail_id','doc_type_id','filename','link','date'];

  	
  	public function getDateAttribute($value)
	  {
    	return Carbon::parse($value)->format('d-m-Y');
	  }

    public function doctype()
    {
    	return $this->belongsTo('\App\Model\ApplicationDocType','doc_type_id');
    }

    public function app_form()
    {
      return $this->hasMany('\App\Model\AppForm');
    }

    public function vehicle_detail()
    {
        return $this->belongsTo("\App\Model\VehicleDetail",'vehicle_detail_id')->withDefault();
    }

    //show data for attached modal after excel import
    public static function DocData($id)
    {
     
      $data['app_doc'] = self::whereVehicleDetailId($id)->pluck('filename', 'doc_type_id');
      $data['pre_lic'] = \App\Model\VehicleDetail::whereId($id)->pluck('licence_no_need')->first();
      $data['pre_app_no'] = \App\Model\PreRegisterApp::whereVehicleDetailId($id)->pluck('regapp_number')->first();
      return $data;
    }
}
