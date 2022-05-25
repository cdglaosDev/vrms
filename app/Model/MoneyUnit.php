<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MoneyUnit extends Model
{
    protected $fillable = ['name', 'name_en', 'status'];

    public function PriceList()
    {
        return $this->hasMany('App\Model\PriceList');
    }

    public function price_item_unit_price()
    {
        return $this->hasMany('App\Model\PriceItemUnitPrice');
    }
}
