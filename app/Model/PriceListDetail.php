<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class PriceListDetail extends Model
{
  
    // protected $fillable = ['quantity','price','sub_total','status','price_item_id','price_list_id','item_name','item_name_en','item_code'];
    protected $guarded = [];

    protected $attributes = [
        'status' => 1
    ];

    public function getStatusAttribute($attribute)
    {
        return $this -> activeOptions()[$attribute];
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
            0 => 'Inactive',
            2 => 'Inprogress',
        ];
    }

    public function PriceItem()
    {
        return $this->belongsTo('App\Model\PriceItem', 'price_item_id');
    }

    public function PriceList()
    {
        return $this->belongsTo('App\Model\PriceList', 'price_list_id');
    }

    public static function priceDetail($plist_id){
        return self::wherePriceListId($plist_id)->orderBy('item_code')->get();
    }
}
