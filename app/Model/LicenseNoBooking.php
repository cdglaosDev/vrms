<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
class LicenseNoBooking extends Model
{

    protected $fillable = ["license_alphabet_id", "user_id", "license_no_book_number", "customer_name", "date", "expire_date", "note", "status", "created_by", "vehicle_kind_code", "province_code", "app_id", "vehicle_type_group_id", 'book_from_pricelist'];

    public function getStatusAttribute($attribute)
    {
        return $this->activeOptions()[$attribute];
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }

    public function scopeUses($query)
    {
        return $query->where('status', 2);
    }

    public function activeOptions()
    {
        return [
            2 => 'Uses',
            1 => 'Active',
            0 => 'Deactive',
        ];
    }

    public function alphabet()
    {
        return $this->belongsTo('App\Model\LicenseAlphabet', 'license_alphabet_id');
    }
    public function vehicle_kind()
    {
        return $this->belongsTo('App\Model\VehicleKind', 'vehicle_kind_code', 'vehicle_kind_code')->withDefault();
    }
    public function province()
    {
        return $this->belongsTo('App\Model\Province', 'province_code', 'province_code')->withDefault();
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function scopeBookingLists()
    {
       if(auth()->user()->user_level =="province"){
            return $this->whereProvinceCode(auth()->user()->user_info->province_code)->orderByDesc('status')->get();
       } else {
            return $this->orderByDesc('status')->get();
       }
    }
    public static function usedBooking()
    {
        return self::whereNotNull('app_id')->pluck('app_id')->toArray();
    }

     /* mutator and accessor for expire date */
   public function setExpireDateAttribute($value)
   {
      $this->attributes['expire_date'] = isset($value)? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') :  null;
     
   }
   public function getExpireDateAttribute($value)
   {
      return ($value == "0000-00-00") ? $value : Carbon::parse($value)->format('d/m/Y');
   }

   //check license numbere buy  or not for this app form from module2

   public static function checkLicbook($app_form_id)
   {
       if(self::whereAppId($app_form_id)->pluck('license_no_book_number')->first()){
        return true;
       }
       return false;
   }
   
}
