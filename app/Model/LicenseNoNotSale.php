<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class LicenseNoNotSale extends Model
{
    
    protected $fillable = [
        "license_no_not_sale_number", "status","created_by", "province_code"
    ];
    
    public function province()
    {
        return $this->belongsTo('App\Model\Province', 'province_code');
    }

    public function scopeNotSaleNo()
    {
        return  $this->whereNotNull('license_no_not_sale_number')->pluck('license_no_not_sale_number');
    }
}
