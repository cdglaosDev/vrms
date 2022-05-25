<?php

namespace App\Http\Controllers\Module4;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\LicenseNoBooking;
class LicenseNumberBookingController extends Controller
{
    function __construct()
    {   
        $this->middleware('permission:License-Number-Booking-List-View');
         $this->middleware('permission:License-Number-Booking-Create', ['only' => ['store']]);
         $this->middleware('permission:License-Number-Booking-Edit', ['only' => ['update']]);
         $this->middleware('permission:License-Number-Booking-Delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lic_bookings = LicenseNoBooking::BookingLists();
        return view('Module4.LicenseNoBooking.index', compact('lic_bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateRequest();
        $input = request()->all();
        $input['user_id'] = auth()->id();
        LicenseNoBooking::create($input);
        return redirect('/license-number-booking')->with('success', 'Successful License Number Booking Added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $license_booking = \App\Model\LicenseNoBooking::find($id);
        $usedBook =  \App\Model\LicenseNoBooking::whereNotNull('app_id')->where('id', '!=', $id)->pluck('app_id')->toArray();
  
        $vehicle_kinds = \App\Model\VehicleKind::whereStatus(1)->get();
        $provinces = \App\Model\Province::GetProvince();
        if(auth()->user()->user_level == "province"){
            $app_form = \App\Model\AppForm::whereHas('vehicle', function($q) use($license_booking){
                        $q->whereProvinceCodeAndVehicleKindCode(auth()->user()->user_info->province_code, $license_booking->vehicle_kind_code);
                        })->whereNotIn('id',$usedBook)->whereIn('app_form_status_id', [1, 2])->orwhere('id',  $license_booking->app_id)->get();
         }else {
            $app_form = \App\Model\AppForm::whereHas('vehicle', function($q) use($license_booking){
                $q->whereProvinceCodeAndVehicleKindCode($license_booking->province_code, $license_booking->vehicle_kind_code);
                })->whereNotIn('id',$usedBook)->whereIn('app_form_status_id', [1, 2])->orwhere('id',  $license_booking->app_id)->get();
         }
       
        return view('Module4.LicenseNoBooking.edit', compact('license_booking', 'vehicle_kinds', 'provinces', 'app_form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      
        $request->validate([
            'license_no_book_number' => 'required',
            'app_id' => 'required|unique:license_no_bookings,app_id,'.$id,
            'vehicle_kind_code' =>'required',
            'province_code'=>"required"
            ]);
     
        $license_booking = LicenseNoBooking::find($id);
        \LogActivity::saveToLog($license_booking, $tb_name = "license_no_bookings", $action = "update"); 
        $license_booking->update(request()->all()); 
       return redirect('/license-number-booking')->with('success', 'Successful License Number Booking Update.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = LicenseNoBooking::find($id);
        \LogActivity::saveToLog($data, $tb_name = "license_no_bookings", $action = "delete");
        $data->delete();
        return back()->with('success', 'Successful delete');
    }

    private function validateRequest()
    {
        return request() -> validate([
            'license_no_book_number' => 'required',
            'customer_name' => 'required',
            'vehicle_kind_code' =>'required',
            'province_code'=>"required"
          
        ]);
    }

    //check license no with vehicle kind when click "Check" button in license booking page
    public function checkRecord()
    {
        $license_no_arr = explode(" ", request('lic_no'));
        $booking_no = $license_no_arr[1];
        
        if (LicenseNoBooking::whereLicenseNoBookNumberAndVehicleKindCodeAndProvinceCodeAndVehicleTypeGroupId(request('lic_no'), request('veh_kind'), request('province_code'), request('vehicle_type_group_id'))->exists() 
        || \App\Model\LicenseNoNotSale::whereLicenseNoNotSaleNumberAndProvinceCode($booking_no, request('province_code'))->exists() 
        || \App\Model\LicenseNoSale::whereLicenseNoSaleNumberAndProvinceCode($booking_no, request('province_code'))->exists()
        || \App\Model\LicenseNoHistory::whereVehicleKindCodeAndProvinceCodeAndLicenceNo(request('veh_kind'), request('province_code'), request('lic_no'))->exists()
        ) {
            $message = "Not-Available";
            return response()->json($message);
        } else {
            $lastTwoNum = substr(request('lic_no'), -2);
            if($lastTwoNum == "27" || $lastTwoNum == "67"){
                $message = "Not-Available";
                return response()->json($message);
            } else{
                $message = "Available";
                return response()->json($message);
            }
        }
    }


    //get customer name when choosing app no
    public function geCustomerName($app_id)
    {
        $customer_name = \App\Model\AppForm::whereId($app_id)->select("customer_name")->first();
        return response()->json($customer_name);
    }
}
