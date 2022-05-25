<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PriceItemMapping extends Model
{
    protected $fillable = ["app_purpose_id", "price_item_id"];

    public function priceItem()
    {
        return $this->belongsTo("App\Model\PriceItem", 'price_item_id')->withDefault();
    }
    
    public function app_purpose()
    {
        return $this->belongsTo("App\Model\AppPurpose", 'app_purpose_id')->withDefault();
    }
}
