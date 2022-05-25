<?php
namespace App\Helpers;
use App\Helpers\GenerateCodeNo;
use App\Model\PriceList;

class BillNo
{
  public function billNo($service_counter)
  {
    $conterMatch = \App\Model\CounterMatching::whereServiceCounterIdAndProvinceCode($service_counter, Helper::current_province())->select('start_bill_no', 'bill_no_present')->first();
   
    if($conterMatch){
    $check_no = new \App\Helpers\Helper;
      if($conterMatch->start_bill_no != null){ //if start_bill_no have in counter match table, continue
          if ($conterMatch->bill_no_present == null) { //if receipt_no doesn't have in  price_list,can use start_bill_no from counter match
            $price_receipt_no = $conterMatch->start_bill_no;
          } else { //if receipt_no exist in price list table, increament bill_no_present at counter matching table
              if ( $check_no->number_check($conterMatch->bill_no_present) ) {
                $price_receipt_no =  $conterMatch->bill_no_present + 1; // if receipt_no have and also integer value, current receipt no autoincrement.
              } else { //if bill_no_present is not integer value, change format for increment
                $length = strlen($conterMatch->bill_no_present);
                $only_num = ltrim($conterMatch->bill_no_present, '0') +1;
                $price_receipt_no =  str_pad($only_num, $length, "0", STR_PAD_LEFT);
              }
          }
      } else{ // show error "need to assign counter first"
        $price_receipt_no = null;
      }
    } else {
      $price_receipt_no = null;
    }
    return $price_receipt_no;
  }

}