<?php

namespace App\Http\Controllers\Module2;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\LicenseNoBooking;
use App\Model\Vehicle;
use App\Model\LicenseNoNotSale;
use App\Model\PriceList;
use DB;
class SubPriceList extends Controller
{
  public function getRefNo(Request $request)
  {
    if ($request->get('query')) {
        $query = $request->get('query');
        $data = \DB::table('app_forms')
              ->join('users','app_forms.customer_id', '=','users.id')
              ->select('app_forms.app_no', 'users.first_name', 'users.last_name', 'users.id')
              ->where('app_no', 'LIKE', "%{$query}%")
              ->get();
        $output = '<ul class="ref dropdown-menu" style = "display:block; position:relative">';
        foreach ($data as $row) {
          $output .= '
          <li><a href="#">'.$row->app_no.'</a></li>
            <div id="customer" style = "display:none;">'.$row->first_name."".$row->last_name.'</div>
            <div id="customerId" style = "display:none;">'.$row->id.'</div>
          ';
        }
        $output .= '</ul>';
        echo $output;
      }
  }
  //get unit price with current province.
  public function priceItem(Request $request)
  {
        $code = str_replace(',', '.', $request->code);
      // $province = auth()->user()->user_info->pluck('province_code')->first();
        $price = \App\Model\PriceItemUnitPrice::whereProvinceCode(\App\Helpers\Helper::current_province())->whereHas('price_item', function($q) use($code){
          $q->where('code', '=', $code)->select('name','name_en','code');
        })->first();
          if (! empty($price)) {
            $data = [];
            $data = array('item' => $price->price_item->code, 'price' => $price->unit_price, 'name' => $price->price_item->name, 'name_en' => $price->price_item->name_en, 'price_item_id' => $price->price_item_id, 'fine_percent' => $price->fine_percent);
            return response()->json($data);
          } else {
            return ['result' => 'not-found'];
          }
  }

  //get price item unit price by province when click add more item with auto suggestion
  public function priceItemBK(Request $request)
  {       
          $province = auth()->user()->user_info->pluck('province_code')->first();
          $query = $request->get('term', '');
          $app_form_id = $request->get('app_form_id');
          //get vehicle type group id by app form id
          // $app_data = \App\Model\AppForm::with('vehicle.vtype:id,vehicle_type_group_id')->whereId($app_form_id)->first();
          // $vtype_group_id = $app_data->vehicle->vtype->vehicle_type_group_id;
          // $app_purpose_id = \App\Model\AppFormPurpose::whereAppFormId( $app_form_id)->pluck('app_purpose_id')->toArray();
          // $price_item_id = \App\Model\PriceItemMapping::whereIn('app_purpose_id',  $app_purpose_id)->distinct('price_item_id')->pluck('price_item_id')->toArray();

              if($request->type == 'item'){  
              // $fees = \App\Model\PriceItemUnitPrice::whereHas('price_item', function($q) use($vtype_group_id, $query){
              //     $q->where('code','LIKE','%'.$query.'%')->where('status', '=', 1)->where('vehicle_type_group_id','=', $vtype_group_id)->orWhere('vehicle_type_group_id','=',5)->orWhere('vehicle_type_group_id','=',6);
              // })->whereIn('price_item_id', $price_item_id)->whereProvinceCode(\App\Helpers\Helper::current_province())->get();
              $fees = \App\Model\PriceItemUnitPrice::whereProvinceCode(\App\Helpers\Helper::current_province())->get();
              $data=[];
                  foreach ($fees as $fee) {
                      $data[]=array('item' => $fee->price_item->code, 'price'=>$fee->unit_price,'name' => $fee->price_item->name, 'name_en' => $fee->price_item->name_en, 'price_item_id' => $fee->price_item_id, 'fine_percent' => $fee->fine_percent);
                  }
                  if (count($fees)) {
                    return response()->json($data);
                  } else {
                    return ['name' => '', 'sortname' => ''];
                  }
              }
  }

  //check this number is use or not in license no booking, license not sale and vehicle tables  by module2  price list page
  public function licenseBooking($license)
  {
  
    $data = preg_split('/\s+/', $license);
    $alphabet = $data[0];
    $booking_no = $data[1];
    
    if (preg_match("/[a-z]/i", $booking_no)) {// if license no format is not correct
      return response()->json([
        'status' => "include-alphabet"
      ]);
    }

    $vehicle = DB::table('vehicles')
                  ->leftjoin('app_forms', 'vehicles.id', '=', 'app_forms.vehicle_id')
                  ->join('vehicle_types', 'vehicles.vehicle_type_id', '=', 'vehicle_types.id')
                  ->where('app_forms.id', request('app_form_id'))
                  ->select('vehicles.province_code', 'vehicles.vehicle_kind_code', 'vehicle_types.vehicle_type_group_id')
                  ->first();
    $alphabet_control = \App\Model\LicenseAlphabetControl::whereHas('licAlphabet', function($q) use($alphabet){
                        $q->whereName($alphabet);
                        })->where([['province_code', $vehicle->province_code], ['vehicle_type_group_id',$vehicle->vehicle_type_group_id ], ['vehicle_kind_code', $vehicle->vehicle_kind_code]])
                          ->whereIn('license_alphabet_control_status_id', [5, 12])->pluck('id')->count();
    if($alphabet_control == 0){ //does not exist alphabet in alphabet control
      return response()->json([
        'status' => "no-alphabet"
      ]);
    }
    
    // this current app form already booked, just update request license no 
    if (LicenseNoBooking::whereLicenseNoBookNumberAndVehicleKindCodeAndProvinceCodeAndAppId($license, $this->getKind(request('app_form_id')), $this->getProvince(request('app_form_id')), request('app_form_id'))->exists()) {
      return response()->json([
        'status' => 'can-use',
        'veh_kind' => $vehicle->vehicle_kind_code
      ]);
    } else { 
       return $this->checkLicenseAlradyUsed($license, $this->getKind(request('app_form_id')), $this->getProvince(request('app_form_id')), $booking_no);
    }
    
  }


  //check license no already used when booking from module2
  public function checkLicenseAlradyUsed($license, $veh_kind, $province_code, $booking_no)
  {
     
    if (\App\Model\LicenseNoSale::whereLicenseNoSaleNumberAndProvinceCode($booking_no, $province_code)->exists()) {
        return response()->json(['status' => 'not-use', 'veh_kind' => $veh_kind]);
        
    } else if (LicenseNoNotSale::whereLicenseNoNotSaleNumberAndProvinceCode($booking_no, $province_code)->exists()) {
      return response()->json(['status' => 'not-use', 'veh_kind' => $veh_kind]);
    } else if (\App\Model\LicenseNoHistory::whereVehicleKindCodeAndProvinceCodeAndLicenceNo($veh_kind, $province_code, $license)->exists()){
        //$text = "LicenseNoHistory:".$veh_kind.":".$province_code.":".$license;
        return response()->json(['status' => 'not-use', 'veh_kind' => $veh_kind]);
    }else if (LicenseNoBooking::whereVehicleKindCodeAndProvinceCodeAndLicenseNoBookNumber($veh_kind, $province_code, $license)->exists()) {
      return response()->json(['status' => 'not-use', 'veh_kind' => $veh_kind]);
    }else if (Vehicle::whereVehicleKindCodeAndProvinceCodeAndLicenceNo($veh_kind, $province_code, $license)->exists()) {
      return response()->json(['status' => 'not-use', 'veh_kind' => $veh_kind]);
    }else {
      return response()->json(['status' => 'can-use', 'veh_kind' => $veh_kind]);
    }

  }

  /*============================ Save booking no into booking table ===========================*/
  public function saveLicenseBooking()
  {
   
    $data = request()->all();
    $app_id = LicenseNoBooking::whereAppId(request('app_form_id'))->pluck('app_id')->first();
      $expire_date = date('d/m/Y', strtotime('+3 months'));
        if (!$app_id) {
          LicenseNoBooking::create([
            'user_id' => auth()->id(),
            'license_no_book_number' => request('license'),
            'customer_name' => request('user_payer'),
            'date' => date("Y-m-d"),
            'expire_date' =>  $expire_date,
            'created_by' => auth()->id(),
            'app_id' => request('app_form_id'),
            'vehicle_kind_code' => $this->getKind(request('app_form_id')),
            'province_code' => $this->getProvince(request('app_form_id')),
            'book_from_pricelist' =>1
          ]);
        } else {
          LicenseNoBooking::whereAppId(request('app_form_id'))->update([
            'user_id' => auth()->id(),
            'license_no_book_number' => request('license'),
            'customer_name' => request('user_payer'),
            'date' => date("Y-m-d"),
            'created_by' => auth()->id(),
            'vehicle_kind_code' => $this->getKind(request('app_form_id')),
            'province_code' => $this->getProvince(request('app_form_id')),
            'book_from_pricelist' =>1
          ]);
        }
        $lic_no = \App\Model\Vehicle::whereHas('app_form', function($query) {
          $query->where('id', request('app_form_id'));
          })->pluck('licence_no')->first();
        if ($lic_no != null) {
          \App\Model\Vehicle::whereHas('app_form', function($query) {
            $query->where('id', request('app_form_id'));
            })->first()->update(['licence_no' => request('lic_no')]);
        }

        if(request('price_list_id') == null){
          $priceList = PriceList::storePriceList($data);
          $price_detail = new \App\Library\StorePriceListDetail();
          $price_detail->savePriceListDetail($data, $priceList->id);
          $price_detail->updatePresentBill( $data['service_counter_id'],  $data['price_receipt_no']);
          return $this->replicateData( $priceList->id,  $data['app_form_id'], $data['price_receipt_no'], $data['license'], $data['service_counter_id']);
        } else {
          return $this->replicateData($data['price_list_id'], $data['app_form_id'], $data['price_receipt_no'], $data['license'], $data['service_counter_id']);
        }
        //return response()->json($data);
        
  }

  // replicate old price list data and update bill no into counter matching and update status into app form
  public function replicateData($price_list_id, $app_form_id, $price_receipt_no, $license, $service_counter_id)
  {
      $check_no = new \App\Helpers\Helper;  
        //generate new bill no when confirming booking number
        $old_plist = \App\Model\PriceList::with('PriceListDetails')->whereId($price_list_id)->first();
        //get last record for this counter
        $counter =  \App\Model\CounterMatching::whereServiceCounterId($service_counter_id)->first();
       
        $new_plist = $old_plist->replicate();
        //auto increment bill number
        if ($price_receipt_no == $old_plist->price_receipt_no) {
          if ( $check_no->number_check($counter->bill_no_present) ) {
            $new_plist->price_receipt_no =  $counter->bill_no_present + 1; // if receipt_no have and also integer value, current receipt no autoincrement.
          } else {
            $length = strlen( $counter->bill_no_present);
            $only_num = ltrim( $counter->bill_no_present, '0') +1;
            $new_plist->price_receipt_no =  str_pad($only_num,$length,"0", STR_PAD_LEFT);
          }
        } else {
          $new_plist->price_receipt_no =   $price_receipt_no;
        }
        $new_plist->lic_book_no = $license;
        $new_plist->reciept_status = "save";
        $new_plist->total_amt = null;
        $new_plist->save();
        $counter->update(['bill_no_present' =>$new_plist->price_receipt_no ]);
        PriceList::whereId($price_list_id)->update(['reciept_status' => "printed" ]); //update status printed for first bill
        //\App\Model\AppForm::whereId($app_form_id)->first()->update(['app_form_status_id' => 3]);
        $first_bill_list = PriceList::with('ServiceCounter:id,name', 'appForm.vehicle:id,licence_no,chassis_no','appForm.appFormPurpose', 'staff:id,first_name,last_name')->whereId($price_list_id)->first();
        $price_detail = \App\Model\PriceListDetail::priceDetail($price_list_id);
        return response()->json([
          'status' => "success",
          'price_list' => $first_bill_list,
          'second_bill' => $new_plist,
          'price_detail' =>  $price_detail,
          'buy_lic' => LicenseNoBooking::checkLicbook($first_bill_list->app_form_id)
        ]);
  }



  public function getKind($app_id)
  {
    return \App\Model\Vehicle::whereHas('app_form', function($q) use($app_id){
        $q->whereId($app_id);
    })->pluck('vehicle_kind_code')->first();
  }

  public function getProvince($app_id)
  {
        return \App\Model\Vehicle::whereHas('app_form', function($q) use($app_id){
          $q->whereId($app_id);
      })->pluck('province_code')->first();
  }

  //cancel bill from managePriceList page
  public function billCancel($id)
  {
    $price_list =  \App\Model\PriceList::find($id);
    $price_list->update(['reciept_status' => "cancel bill"]);
    \App\Model\AppForm::whereId($price_list->app_form_id)->update(['app_form_status_id' => 2]);
    return back()->with('success', 'Successful cancel bill.');
  }
  // get bill number and service counter id when click previous button
  public function getPreviousBill()
  {
    return $this->previousPriceListData(request('service_counter_id'), request('bill_no'));
  }

  public function previousPriceListData($service_counter_id, $bill_no)
  {
    $increase_bill = $this->checkNoForPrevious($bill_no);
     $price_list = PriceList::with('ServiceCounter','appForm.vehicle', 'staff:id,first_name,last_name')->whereServiceCounterIdAndPriceReceiptNo($service_counter_id, $increase_bill)->first();
     if ($price_list == null) {
       return $this->previousPriceListData($service_counter_id,  $increase_bill);
     }
     $price_detail = \App\Model\PriceListDetail::priceDetail($price_list->id);
     return response()->json([
       'price_detail' => $price_detail,
       'price_list' => $price_list
     ]);
  }

   //check number or start with "0" number for decreasing bill
   public function checkNoForPrevious($bill_no)
   {
     $check_no = new \App\Helpers\Helper;
     if ( $check_no->number_check($bill_no) ) {
       $bill =  $bill_no - 1; // if receipt_no have and also integer value, current receipt no autoincrement.
     } else {
       $length = strlen($bill_no);
       $only_num = ltrim($bill_no, '0') - 1;
       $bill =  str_pad($only_num, $length, "0", STR_PAD_LEFT);
     }
     return $bill;
   }

   // get bill number and service counter id when click previous button
   public function getNextBill()
   {
    return $this->nextPriceListData(request('service_counter_id'), request('bill_no'));
   }

   public function nextPriceListData($service_counter_id, $bill_no)
   {
     $increase_bill = $this->checkNoForNext($bill_no);
      $price_list = PriceList::with('ServiceCounter','appForm.vehicle', 'staff:id,first_name,last_name')->whereServiceCounterIdAndPriceReceiptNo($service_counter_id, $increase_bill)->first();
      if ($price_list == null) {
        return $this->nextPriceListData($service_counter_id,  $increase_bill);
      }
      $price_detail = \App\Model\PriceListDetail::priceDetail($price_list->id);
      return response()->json([
        'price_detail' => $price_detail,
        'price_list' => $price_list
      ]);
   }

   
  
  //check number or start with "0" number for increasing bill
  public function checkNoForNext($bill_no)
  {
    $check_no = new \App\Helpers\Helper;
    if ( $check_no->number_check($bill_no) ) {
      $bill =  $bill_no + 1; // if receipt_no have and also integer value, current receipt no autoincrement.
    } else {
      $length = strlen($bill_no);
      $only_num = ltrim($bill_no, '0') +1;
      $bill =  str_pad($only_num, $length, "0", STR_PAD_LEFT);
    }
    return $bill;
  }

  
}
