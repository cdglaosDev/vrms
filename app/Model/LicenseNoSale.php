<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class LicenseNoSale extends Model
{
    
    protected $fillable = [
        'price_item_id', 'license_no_sale_number', 'status', 'created_by', "vehicle_kind_id", "province_code"
    ];

    public function priceItem()
    {
        return $this->belongsTo('App\Model\PriceItem', 'price_item_id');
    }

    public function province()
    {
        return $this->belongsTo('App\Model\Province', 'province_code');
    }
    //get license sale list by user level
    public  function scopeLicenseSaleList()
    {
        if (auth()->user()->user_level == "province") {
           return $this->whereProvinceCode(\App\Helpers\Helper::current_province())->orderByDesc('status')->get();
        } else {
            return $this->orderByDesc('status')->get();
        }
    }

    public function scopeSaleNo()
    {
        return  $this->whereNotNull('license_no_sale_number')->pluck('license_no_sale_number');
    }
}
