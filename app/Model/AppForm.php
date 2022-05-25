<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Traits\GeneralEnum;
use App\Traits\GeneralNotify;
class AppForm extends Model
{

    use SoftDeletes,StatusTrait,GeneralEnum, GeneralNotify;
    
    protected $guarded = [];
    
    public function vehicle()
    {
        return $this->belongsTo("App\Model\Vehicle", "vehicle_id")->withDefault();
    }
    public function staff()
    {
        return $this->belongsTo("App\User", "staff_id", "id")->withDefault();
    }
     public function appcards()
    {
        return $this->hasMany('\App\Model\AppFormDetail');
    }

    public function company()
    {
    	return $this->belongsTo("App\Model\Company", "company_id")->withDefault();
    }
    
    public function license_type()
    {
    	return $this->belongsTo("App\Model\AppLicenseType", "app_license_type_id")->withDefault();
    }
    public function tax_office()
    {
    	return $this->belongsTo("App\Model\TaxOffice", "tax_office_id")->withDefault();
    }
  
    public function appFormPurpose()
    {
    	return $this->hasMany("App\Model\AppFormPurpose", "app_form_id");
    }

    public function app_status()
    {
    	return $this->belongsTo("App\Model\AppFormStatus", "app_form_status_id")->withDefault();
    }

    public function VehicleCheckResult()
    {
        return $this->hasMany('App\Model\VehicleCheckResult');
    }

     public function TransferVehicle()
     {
         return $this->hasOne('App\Model\TransferVehicle');
     }

    public function app_docs()
    {
         return $this->hasMany("App\Model\AppDocument", "vehicle_detail_id");
     }

     public function priceList()
     {
        return $this->hasMany("App\Model\PriceList", "app_form_id");
    }

    public function setDateRequestAttribute($value)
    {
        $this->attributes['date_request'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }


    public function getDateRequestAttribute($value)
    {
        return ($value == "0000-00-00" || $value == null) ? null : Carbon::parse($value)->format('d/m/Y');
     
    }

    public function scopeAppForm()
    {
        if(auth()->user()->user_level == "province"){
            return $this->whereHas('vehicle', function($q) {
                $q->whereProvinceCode(auth()->user()->user_info->province_code);
                })->whereIn('app_form_status_id', [1, 9])->whereNotIn('id', \App\Model\LicenseNoBooking::usedBooking())->get();
         }else {
             return $this->whereIn('app_form_status_id', [1, 9])->whereNotIn('id', \App\Model\LicenseNoBooking::usedBooking())->get();
         }
    }
      

}
