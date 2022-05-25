<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class PriceItemUnitPrice extends Model
{

   
    // protected $fillable=['price_item_id','province_code','unit_price','fine_percent','status','money_unit_id'];
    protected $guarded = [];

    public function price_item(){
        return $this->belongsTo('App\Model\PriceItem', 'price_item_id')->where('status','=',1);
    }

    public function province()
    {
       return $this->belongsTo('\App\Model\Province', 'province_code', 'province_code')->withDefault();
    }

    public function money_unit()
    {
        return $this->belongsTo('\App\Model\MoneyUnit', 'money_unit_id');
    }
    
    public function item()
    {
    	return $this->belongsTo('App\Model\PriceItem', 'price_item_id');
    }
}
