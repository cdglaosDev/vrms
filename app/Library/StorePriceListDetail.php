<?php
namespace App\Library;
use App\Model\PriceList;
use App\Model\PriceListDetail;
Use App\Helpers\Helper;
use App\Model\CounterMatching;
class StorePriceListDetail
{
   
    ////save price list detail record
    public function savePriceListDetail($data,  $price_list_id)
    {
        foreach ($data['price_item_id'] as $key => $value) {
            
            PriceListDetail::create([
                'quantity' => $data['quantity'][$key],
                'price' => $data['unit_price'][$key] != null? str_replace(',', '', $data['unit_price'][$key]):0.00,
                'sub_total' => str_replace(',', '', $data['sub_total'][$key]), 
                'item_name' => $data['item_name'][$key],
                'item_name_en' => $data['item_name'][$key],
                'item_code' => $data['item_code'][$key],
                'price_item_id' => $data['price_item_id'][$key] ,
                'price_list_id' => $price_list_id ,
                'province_code' =>Helper::current_province(),
                'fine_percent' =>str_replace(',', '.', $data['fine_percent'][$key]) ,
            ]);
            
        }

    }

    //update latest bill into counter matching table after added new pircelist

    public function updatePresentBill($service_counter_id, $latest_bill)
    {
      CounterMatching::where('service_counter_id', $service_counter_id)->update(['bill_no_present' => $latest_bill]);
    }

    
}