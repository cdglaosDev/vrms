<?php

namespace App\Http\Controllers\Module2;
use App\Http\Controllers\Controller;
use App\Model\PriceList;
use App\Model\CounterMatching;
use App\Model\MoneyUnit;
use App\Model\PriceListDetail;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Helpers\DateHelper;
use App\Helpers\GenerateCodeNo;
use Illuminate\Support\Facades\Input;
Use App\Helpers\Helper;
use App\Model\LicenseNoBooking;
use DB;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class ManagementPriceList extends Controller
{
  //protected $price_detail;
    function __construct()
    {
        $this->middleware('permission:PriceList-View');
        $this->middleware('permission:PriceList-Create', ['only' => ['create', 'store']]);
        
        $this->middleware('permission:PriceList-Entry-Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:PriceList-Entry-Delete', ['only' => ['destroy']]);
        //$this->price_detail = new \App\Library\StorePriceListDetail();
    }

    public function index()
    {  
        $assign_counter = \App\Model\CounterMatching::whereStaffIdAndProvinceCode(auth()->id(),  \App\Helpers\Helper::current_province())->pluck('service_counter_id')->toArray();
       
        $service_counter_id = CounterMatching::whereStaffId(auth()->id())->pluck('service_counter_id')->first();
        if(auth()->user()->user_level == "admin"){
            $pricelists = PriceList::orderBy('date')->paginate(10);
        }else{
            $pricelists = PriceList::whereServiceCounterId($service_counter_id)->orderBy('date')->paginate(10);
        }
        return view('module2.ManagementPriceList.index', compact('pricelists'));
    } 

    public function create()
    {   
        //get service counter with current province
        $scounters = CounterMatching::whereStaffIdAndProvinceCode(auth()->id(), Helper::current_province())->get();
        if($scounters->IsEmpty()){
            return redirect('price-list')->with('error', 'You need to do assign counter at first.');
        }
        
        $item_list = \App\Model\PriceItemUnitPrice::whereHas('price_item', function($q){
            $q->where('status', '=', 1);
        })->whereProvinceCode($scounters[0]->province_code)->get(); //item list for table
       
        if (Input::get ( 'app_no' )) {
            if( strpos(Input::get ( 'app_no' ), ',') !== false ) {
                $q = str_replace(',', '.', Input::get ( 'app_no' ));
           } else {
                $q = Input::get ( 'app_no' );
           }
            $active_counter =\App\Model\ServiceCounter::whereId(request('active_counter'))->select('id', 'name')->first();
            $active_bill = Input::get ('active_bill'); //active bill 
          
            $active_payment_date = PriceList::getLastDate(request('active_counter')); // get latest date by counter_id
            if(auth()->user()->user_level == "province"){
                $app_form = \App\Model\AppForm::whereHas('vehicle', function($veh){
                            $veh->whereProvinceCode(Helper::current_province());
                            })->whereAppNo($q)->first();
            } else {
                $app_form = \App\Model\AppForm::whereAppNo($q)->first();
            }

            $counter_province_level = $scounters->map(function($item) {
                return $item->service_counter_id;
            });
         
            //check request no is bill no or app_no
            if (is_numeric($q)) {
              
                if (strpos($q,'.') !== false) {
                    $receipt_no = explode(".", $q);
                    $counter_id = \App\Model\ServiceCounter::whereNameAndProvinceCode($receipt_no[0], Helper::current_province())->pluck('id')->first();
                
                    if(auth()->user()->user_level == "province"){
                        $price_list = PriceList::wherePriceReceiptNoAndServiceCounterId($receipt_no[1], $counter_id)->whereIn('service_counter_id', $counter_province_level)->get();
                    } else{
                        $price_list = PriceList::wherePriceReceiptNo($receipt_no[1])->get();
                    }
                    if ($price_list->isEmpty()) { 
                        return redirect('/price-list/create')->with('error', trans('finance_title.bill_not_exist'));                  
                    }
                } else{
                    return redirect('/price-list/create')->with('error', trans('finance_title.add_counter_into_search')); 
                }
               
            } else {
                if ( $app_form == null ) {
                    return back()->with('error', trans('finance_title.app_not_exist'));
                }
                $price_list = PriceList::whereAppFormId($app_form->id)->get();
                
            }
          
            
                if (count($price_list) > 0) {
                    //if data have in pricelist table, show data by app no
                    $code = true;
                   
                    return redirect('/price-list/create')->with(['code' => $code,'price_list' => $price_list,'app_form' =>$app_form,'service_counter'=>$scounters, 'item_list'=>$item_list, 'active_counter' => $active_counter, 'active_bill' => $active_bill]);
                
                } else {
                   
                    $active_bill = \App\Helpers\Helper::bNo(request('active_counter'));
                  
                    // if data doesn't  have pricelist table, get data from unit price table by using item mapping
                    //get all purpose by app_id
                    $app_purpose_id = \App\Model\AppFormPurpose::whereAppFormId($app_form->id)->pluck('app_purpose_id')->toArray();
                    
                    //get vehicle type group id by search app no
                    $app_data = \App\Model\AppForm::with('vehicle.vtype:id,vehicle_type_group_id')->whereAppNo($q)->first();
                    $book_no = \App\Model\LicenseNoBooking::whereAppId($app_data->id)->pluck('license_no_book_number')->first();
                    $vtype_group_id = $app_data->vehicle->vtype->vehicle_type_group_id;
                    
                    $price_item_id = \App\Model\PriceItemMapping::whereIn('app_purpose_id',  $app_purpose_id)->distinct('price_item_id')->pluck('price_item_id')->toArray();
                   
                    $price_item_unit = \App\Model\PriceItemUnitPrice::with('price_item')->whereHas('price_item', function($q) use($vtype_group_id){
                        $q->where('status', '=', 1)->where('vehicle_type_group_id','=', $vtype_group_id)->orWhere('vehicle_type_group_id','=',5)->orWhere('vehicle_type_group_id','=',6);
                    })->whereIn('price_item_id', $price_item_id)->whereProvinceCode(Helper::current_province())->get();
                    
                    $total_amount = 0;
                    foreach ($price_item_unit as $key => $value) {
                    if (isset($value->unit_price))
                        $total_amount += $value->unit_price;
                    }
                   
                    $total_amt = number_format( $total_amount);
                    $disableButton_app = false;
                  
                    $disableButton = true;
                    return view('module2.ManagementPriceList.create', compact('price_item_unit', 'scounters', 'total_amt','app_form', 'item_list', 'disableButton', 'disableButton_app', 'book_no', 'active_counter', 'active_bill', 'active_payment_date'));
                   
                }
            }
        $disableButton_app = false;
        $disableButton = true;
      
        return view('module2.ManagementPriceList.create', compact('item_list', 'scounters', 'disableButton', 'disableButton_app'));
    
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'date' => 'required',
            'user_payer' => 'required',
            'service_counter_id' => 'required',
            'item_code' => 'required',
        ],[
            'item_code.required' => 'At leaset one Item code should include.',
                   
        ]);
        $price_receipts = PriceList::whereServiceCounterId(request('service_counter_id'))->where('id','!=', request('price_list_id'))->pluck('price_receipt_no')->toArray();
       
        $data = request()->all();
       // return response()->json(['data' => $data]);
        if(in_array($data['price_receipt_no'],  $price_receipts)) {
            return response ()->json([
                'msg' =>" Your bill no have already taken.You need to change bill no."
            ]);
        }
            if ($request->price_list_id == null) {
                $data['reciept_status'] = "save";
                $data['total_amt'] = str_replace(',', '', $data['total_amt']);
                $data['province_code'] = Helper::current_province();
                $priceList = PriceList::storePriceList($data);
                $plist_id =  $priceList->id;
                $price_detail = new \App\Library\StorePriceListDetail();
                $price_detail->savePriceListDetail($data, $priceList->id);
                $price_detail->updatePresentBill($data['service_counter_id'],$data['price_receipt_no']);
            } else {
            
            $priceList = PriceList::whereId(request('price_list_id'))->update([
                'price_receipt_no' => $data['price_receipt_no'],
                'date' =>  \App\Helpers\DateHelper::getMySQLDateTimeFromUIDate($data['date']),
                'user_payer' =>  $data['user_payer'],
                'total_amt'  =>  str_replace(',', '', $data['total_amt']),
                'reciept_status'  => $data['reciept_status'],
                'service_counter_id' => $data['service_counter_id'],
                'money_unit_id'  => 1,
                'status' => 1,
                'app_form_id' => $data['app_form_id'],
                'cc' => $data['cc'],
                'road_tax' => $data['road_tax'],
                'note' => $data['note'],
                'code' => $data['code'],
                'updated_by' => $data['updated_by']
            ]);
            $plist_id = request('price_list_id');
            PriceListDetail::wherePriceListId(request('price_list_id'))->delete();
            $price_detail = new \App\Library\StorePriceListDetail();
            $price_detail->savePriceListDetail($data, request('price_list_id'));
            }
            
        // Set JSON Response array (status = success | error)
        //$plist_id = request('price_list_id');
            $response = array ('status' => 'success',
                            'msg' => trans('finance_title.created_pricelist'),
                            'id' => $plist_id,);
            // Return JSON Response
        
            return response ()->json ($response);
    }

    public function show($id)
    {
        $pricelist = PriceList::findOrFail($id);
        return view('module2.ManagementPriceList.show', compact('pricelist'));
    }

    public function edit(PriceList $price_list)
    {

        $money_unit = MoneyUnit::all();
        $service_counter = CounterMatching::whereStaffId(auth()->id())->whereProvinceCode(Helper::current_province())->get();
        $price_detail = \App\Model\PriceListDetail::where('price_list_id', $price_list->id)->get();
        $user = \App\User::whereUserType('customer')->get();
        return view('module2.ManagementPriceList.edit', compact('money_unit', 'service_counter', 'price_list', 'price_detail', 'user'));
    }

    //change status 
    public function cancelBill()
    {
        $reciept_status = request('reciept_status');
        $price = PriceList::find(request('price_id'));
        $price->update(['reciept_status' => $reciept_status]);
        \App\Model\AppForm::whereId($price->app_form_id)->update(['app_form_status_id' => 2]);
        return response()->json([
            'price' => $price,
            'reciept_status' => $reciept_status,
        ]);
    }

      //print only for bill
    public function PrintPriceList($price_list_id)
    { 
        $data = request()->all(); 
        $current_price_list = PriceList::whereId($price_list_id)->first();
        if ($data['reciept_status'] == 'cancel bill') {
            \DB::table('price_lists')->whereId($price_list_id)->update(['reciept_status' => 'cancel bill', 'updated_by' => auth()->id()]);
            $price_list = $current_price_list;
        } else if($data['reciept_status'] == 'save'){
                \DB::table('price_lists')->whereId($price_list_id)->update(['reciept_status' => 'printed','updated_by' => auth()->id() ]);
                \DB::table('app_forms')->whereId($current_price_list->app_form_id)->update(['app_form_status_id' => 3, 'customer_name' => $current_price_list->user_payer ]);
                // if($current_price_list->app_form_id && LicenseNoBooking::whereAppId($current_price_list->app_form_id)->exists()){
                //     \DB::table('app_forms')->whereId($current_price_list->app_form_id)->update(['app_form_status_id' => 3]);
                // }
               
                $detail =  \App\Model\PriceListDetail::wherePriceListId($price_list_id)->pluck('price_list_id')->toArray();
                if (in_array($price_list_id, $detail)){
                     DB::table('price_list_details')->where('price_list_id', $price_list_id)->delete();
                     $price_details = new \App\Library\StorePriceListDetail();
                     $price_details->savePriceListDetail($data, $price_list_id);
                     \DB::table('price_lists')->whereId($price_list_id)->update(['total_amt' => str_replace(',', '', $data['total_amt'])]);
                   
                } else {
                    $price_details = new \App\Library\StorePriceListDetail();
                    $price_details->savePriceListDetail($data, $price_list_id);
                    \DB::table('price_lists')->whereId($price_list_id)->update(['total_amt' => str_replace(',', '', $data['total_amt'])]);
                }
        } else {
            $price_list = $current_price_list;
        }
        $price_list = PriceList::with('ServiceCounter:id,name', 'appForm.vehicle:id,licence_no,chassis_no','appForm.appFormPurpose', 'staff:id,first_name,last_name')->whereId($price_list_id)->first();
        $price_detail = \App\Model\PriceListDetail::priceDetail($price_list_id);
        return response()->json([
            'price_detail' => $price_detail,
            'price_list' => $price_list,
            'buy_lic' => LicenseNoBooking::checkLicbook($price_list->app_form_id)
           
        ]);
    }

    public function deletePriceDetail($id)
    {
        \App\Model\PriceListDetail::find($id)->delete($id);
        return response()->json([
            'success' => 'Record deleted successfully!',
        ]);
    }

    public function destroy(PriceList $price_list)
    {
        $data = PriceList::find($price_list -> id);
        \LogActivity::saveToLog($data, $tb_name = "price_lists", $action = "delete");
        $price_list -> delete();
        return redirect('/price-list')->with('success', 'Successful Deleted');
    }

  
    public function receiveMoney(Request $request)
    {
        $plist = PriceList::find($request->id);
        $plist->receive_amt = $request->receive_amt;
        $plist->refund_amt = $request->refund_amt;
        $plist->payment_status = "complete";
        $plist->reciept_status = "complete";
        $plist->save();
        return back()->with('success', 'Successful received money');
    }

    public function pNo()
    {
        $p_no = PriceList::where('no', 'LIKE', GenerateCodeNo::getCodePrefix() . '%')->orderBy('no', 'desc')->select('no')->first();
        
        $price_no= GenerateCodeNo::priceCode($p_no['no']);

        return $price_no;
    }

    //select by bill no at pop up when search app_no 
    public function getPriceItem($id)
    {
        $price_detail = \App\Model\PriceListDetail::priceDetail($id);
        $price_list = PriceList::with('ServiceCounter','appForm.vehicle', 'staff:id,first_name,last_name')->whereId($id)->first();
        $second_bill_status =  PriceList::whereAppFormIdAndRecieptStatus( $price_list->app_form_id, 'printed')->pluck('reciept_status')->first();
       
        return response()->json([
            'price_detail' => $price_detail,
            'price_list' => $price_list,
            'second_bill_status' =>  $second_bill_status,
            'buy_lic' => LicenseNoBooking::checkLicbook($price_list->app_form_id)
        ]);
    }

       
    public function getPricelist()
    {
        $q = Input::get ( 'app_no' );
        if($q == null){
            return back()->with('error', "You need to type app no.");
        }
        $price_list = PriceList::where('price_receipt_no', 'LIKE','%'.$q.'%')->get();
        if (count($price_list) > 0) {
                return back(['price_list' => $price_list]);
        } else {
            $app_purpose_id = \App\Model\AppForm::whereAppNo($q)->pluck('app_purpose_id')->first();
            $item_map = \App\Model\PriceItemMapping::with('priceItem', 'priceItem.price_item_unit_price', 'staff')->whereAppPurposeId($app_purpose_id)->first();
            
            return view('module2.ManagementPriceList.create', compact('item_map'));
        }
        return redirect()->route('price-list.create')->with('error', 'Not found your search Price List Number');
        
    }

    public function searchLicense()
    {
        
        //get service counter with current province
        $service_counter = CounterMatching::whereStaffId(auth()->id())->whereProvinceCode(Helper::current_province())->first();
       
        if($service_counter == null){
            return redirect('price-list')->with('error', 'You need to do assign counter at first.');
        }
      
        $item_list = \App\Model\PriceItemUnitPrice::whereHas('price_item', function($q){
            $q->where('status', '=', 1);
        })->whereProvinceCode($service_counter->province_code)->paginate(50); //item list for table
      
        if (Input::get ( 'app_no' )) {
            $q = Input::get ( 'app_no' );
            $app_form = \App\Model\AppForm::whereAppNo($q)->first();
            //check request no is bill no or app_no
            if (is_numeric($q)) {
                if (strpos($q,'.') !== false) {
                    $receipt_no = explode(".",$q);
                    $price_list = PriceList::wherePriceReceiptNo($receipt_no[1])->get();
                        if ($price_list->isEmpty()) { 
                            return redirect('/price-list/create')->with('error', 'This bill number does not exit.');                  
                        }
                    
                } else {
                    $price_list = PriceList::wherePriceReceiptNo($q)->get();
                    if ($price_list->isEmpty()) { 
                        return redirect('/price-list/create')->with('error', 'This bill number does not exit.');                  
                    }
                }
                
            } else {
                if ( $app_form == null ) {
                    return back()->with('error',"This app number does not exit.");
                }
                $price_list = PriceList::whereAppFormId($app_form->id)->get();
            }
            
                if (count($price_list) > 0) {
                    //if data have in pricelist table, show data by app no
                    $code = true;
                    return redirect('/price-list/create')->with(['code' => $code,'price_list' => $price_list,'app_form' =>$app_form,'service_counter'=>$service_counter, 'item_list'=>$item_list]);
                
                } else {
                  
                    // if data not have pricelist table, get data from unit price table by using item mapping
                    //get all purpose by app_id
                    $app_purpose_id = \App\Model\AppFormPurpose::whereAppFormId($app_form->id)->pluck('app_purpose_id')->toArray();
                    
                    //get vehicle type group id by search app no
                    $app_data = \App\Model\AppForm::with('vehicle.vtype:id,vehicle_type_group_id')->whereAppNo($q)->first();
                    $book_no = \App\Model\LicenseNoBooking::whereAppId($app_data->id)->pluck('license_no_book_number')->first();
                    $vtype_group_id = $app_data->vehicle->vtype->vehicle_type_group_id;
                    $price_item_id = \App\Model\PriceItemMapping::whereIn('app_purpose_id',  $app_purpose_id)->distinct('price_item_id')->pluck('price_item_id')->toArray();
                   
                    $price_item_unit = \App\Model\PriceItemUnitPrice::with('price_item')->whereHas('price_item', function($q) use($vtype_group_id){
                        $q->where('status', '=', 1)->where('vehicle_type_group_id','=', $vtype_group_id)->orWhere('vehicle_type_group_id','=',5)->orWhere('vehicle_type_group_id','=',6);
                    })->whereIn('price_item_id', $price_item_id)->whereProvinceCode(Helper::current_province())->get();
                    
                    $total_amt = 0;
                    foreach ($price_item_unit as $key => $value) {
                    if (isset($value->unit_price))
                        $total_amt += $value->unit_price;
                    }
                 
                    $disableButton_app = false;
                  
                    $disableButton = true;
                    return view('module2.ManagementPriceList.create', compact('price_item_unit', 'service_counter', 'total_amt','app_form', 'item_list', 'disableButton', 'disableButton_app', 'book_no'));
                   
                }
            }
        $disableButton_app = false;
        $disableButton = true;
        $cpage = request('current_page');
         $spage = request('search_page');
        $pagination = "";
        if ($cpage == 1) {
            $pagination = 0;
        } else {
            $pagination = ($cpage * 20) - 20;
        }
        $vehicle_result =\App\Model\Vehicle::searchVehicle();
        $vehicles = array_slice($vehicle_result, $pagination, 20);
        $total_vehicles = count($vehicle_result);
        $num = ceil($total_vehicles / 20);
        $total_pages = number_format($num, 0, ".", "");
        return view('module2.ManagementPriceList.create', compact('item_list', 'service_counter', 'disableButton', 'disableButton_app','vehicles', 'total_vehicles', 'total_pages'));
    }

    //save and print data when click print button with status is "pending"
    public function savePrintPriceList()
    {
        $data = request()->all();
        $data['reciept_status'] = "printed"; 
        $data['total_amt'] = str_replace(',', '', $data['total_amt']);
        $data['province_code'] = \App\Helpers\Helper::current_province();
        $priceList = PriceList::storePriceList($data);
        $price_detail = new \App\Library\StorePriceListDetail();
        $price_detail->savePriceListDetail($data, $priceList->id); 
        \DB::table('counter_matchings')->where('service_counter_id', $data['service_counter_id'])->update(['bill_no_present' => $data['price_receipt_no']]);
        if($priceList->app_form_id){
            \DB::table('app_forms')->whereId($priceList->app_form_id)->update(['app_form_status_id' => 3, 'customer_name' => $priceList->user_payer]);
        }
      
        $price_list = PriceList::with('ServiceCounter:id,name', 'appForm.vehicle:id,licence_no,chassis_no','appForm.appFormPurpose', 'staff:id,first_name,last_name')->whereId($priceList->id)->first();
        $price_detail = \App\Model\PriceListDetail::priceDetail($priceList->id);
        
        return response()->json([
            'price_detail' => $price_detail,
            'price_list' => $price_list,
            'buy_lic' => LicenseNoBooking::checkLicbook($price_list->app_form_id)
        ]);
       
    }

    public function getPriceListDetailByOldData($id)
    {
        $price_detail = \App\Model\PriceListDetail::priceDetail($id);
        $price_list = PriceList::with('ServiceCounter','appForm.vehicle', 'staff:id,first_name,last_name')->whereId($id)->first();
       
        return response()->json([
            'price_detail' => $price_detail,
            'price_list' => $price_list,
            'bill_no' =>  \App\Helpers\Helper::bNo($price_list->service_counter_id),
        ]);
    }
    
}
