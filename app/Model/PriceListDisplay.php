<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PriceListDisplay extends Model
{

    protected $table = "price_list_display";
    protected $fillable = ["province_code", "counter_id", "item_code", "item_name", "item_price", "payer"];
   
    /*
    public $timestamps = false;
    public function app_form()
    {
        return $this->belongsTo('\App\Model\AppForm', 'app_number', 'app_no')->withDefault();
    }
    */
}
