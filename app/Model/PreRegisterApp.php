<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PreRegisterApp extends Model
{
    use SoftDeletes;
    protected $table = 'pre_register_apps';
    protected $fillable = ["vehicle_detail_id","date_request", "app_status_id", "staff_approve_id", "app_number", "regapp_number", "comment", "qr_code", "user_id","remark"];


    public function vehicle_detail()
    {
        return $this->belongsTo("\App\Model\VehicleDetail", "vehicle_detail_id");
    }

    public function app_status()
    {
        return $this->belongsTo("App\Model\ApplicationStatus", "app_status_id")->withDefault();
    }

    public function staff()
    {
    	return $this->belongsTo("App\Model\Staff", 'staff_approve_id');
    }
    public function user()
    {
        return $this->belongsTo("App\User", 'user_id');
    }

    //query1
    public function getData1()
    {
      if(auth()->user()->user_level == "province"){
         return $this->whereHas('vehicle_detail', function($q){
            $q->whereProvinceCode(\App\Helpers\Helper::current_province());
         })->whereUserId(auth()->id());
      } else {
        return $this->whereUserId(auth()->id());
      }
     
    }
    //query2
   public function getData2()
   {
      if(auth()->user()->user_level == "province"){
            return $this->whereHas('vehicle_detail', function($q){
                $q->whereProvinceCode(\App\Helpers\Helper::current_province());
            })->where('app_status_id', '!=', 6 );
         
        } else {
            return $this->where('app_status_id', '!=', 6);
      }
   }

    public function scopeImportList()
    {
        return  $this->getData2()->union($this->getData1())->with(['vehicle_detail.brand', 'vehicle_detail.model', 'vehicle_detail.province', 'vehicle_detail.district', 'vehicle_detail.type', 'vehicle_detail.vehicleKind', 'vehicle_detail.color'])->orderByDesc('app_number')->paginate(100);
             
    }

   
}
