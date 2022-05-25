<?php
namespace App\Library;
use DB;
class TotalItemPrice
{
    public static function getTotal($price_item_id)
    {
        return  \App\Model\PriceItemUnitPrice::select([
            DB::raw("SUM(unit_price) as total_price"),
        ])->groupBy('price_item_id')->wherePriceItemIdAndProvinceCode($price_item_id, \App\Helpers\Helper::current_province())->pluck('total_price')->first();
    }

    public static function subTotalByDiscount($unit_price, $discount)
    {
        return $unit_price - $discount;
    }
}