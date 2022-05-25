<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class PriceItem extends Model
{
   
    protected $fillable = ["code", "name", "name_en", "description", "status", "show_hide", "vehicle_type_group_id", 'license_sale'];

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

    public function activeOptions()
    {
        return [
            1 => 'Active',
            0 => 'Deactive',
            2 => '_',
        ];
    }

    public function getShowHideAttribute($attribute)
    {
        return $this->ShowOptions()[$attribute];
    }

    public function scopeShow($query)
    {
        return $query->where('show_hide', 1);
    }

    public function scopeHide($query)
    {
        return $query->where('show_hide', 0);
    }

    public function ShowOptions()
    {
        return [
            1 => 'Show',
            0 => 'Hide',
        ];
    }

    public function PriceListDetails()

    {
        return $this->hasMany('App\Model\PriceListDetail');
    }


    public function province()
    {
       return $this->belongsTo('\App\Model\Province', 'province_code');
    }

    public function money_unit()
    {
        return $this->belongsTo('\App\Model\MoneyUnit', 'money_unit_id');
    }


    public function price_item_unit_price()
    {
        return $this->hasMany('App\Model\PriceItemUnitPrice', 'price_item_id');
    }

    public function VehTypeGroup()
    {
        return $this->belongsTo('\App\Model\VehicleTypeGroup', 'vehicle_type_group_id')->withDefault();
    }

    public function priceitemgroupdetails()
    {
        return $this->hasMany('\App\Model\PriceItemGroupDetail');
    }
    public function price_item_mapping()
    {
        return $this->hasMany('\App\Model\PriceItemMapping', 'price_item_id');
    }
    
    public function numbersale()
    {
        return $this->hasMany('App\Model\LicenseNoSale');
    }


}
