<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
class PriceItemGroupDetail extends Model
{
      //use SoftDeletes;
   
    protected $fillable = ['item_group_id','price_item_id'];

     public function priceitem()
    {
       return $this->belongsTo('\App\Model\PriceItem','price_item_id');
    }

      public function pricegroup()
    {
       return $this->belongsTo('\App\Model\PriceItemGroup','item_group_id');
    }
     public function Priceitemgroup()
    {
        return $this->belongsTo('App\Model\PriceItemGroup');
    }
     

}
