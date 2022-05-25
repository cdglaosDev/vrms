<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetDropdownList extends Controller
{
    //get district code when onchange province code
    public function getDistrict(Request $request, $code)
    {
        $district = \App\Model\District::where("province_code", $code)->pluck("name", "district_code");
        $province_abbv = \App\Model\Province::whereProvinceCode($code)->pluck('abb')->first();
        return response()->json([
            'district' => $district,
            'province_abb' => $province_abbv
        ]);
    }

    //get vmodel when onchange vehicle brand
    public function getVmodel(Request $request, $brand)
    {
        $vmodel = \App\Model\VehicleModel::where("brand_id", $brand)->pluck("name", "id");
        return response()->json($vmodel);
    }

    //get village when onchange district code in form
    public function getVillage(Request $request, $code)
    {
        $village = \App\Model\Village::where("district_code", $code)->pluck("name", "village_code");
        return response()->json($village);
    }


    //get service counter depend on province code
    public function getServiceCounter($province_code)
    {
        $counterMatch = \App\Model\CounterMatching::whereProvinceCode(02);
        $usedCounter = $counterMatch->pluck('service_counter_id')->toArray();
        $userUser = $counterMatch->pluck('staff_id')->toArray();
        $serviceCounter = \App\Model\ServiceCounter::whereNotIn('id', $usedCounter)->where("province_code", $province_code)->pluck('name_en', 'id');
        $user = \App\User::whereHas('user_info', function ($q) use ($province_code) {
            $q->whereProvinceCode($province_code);
        })->whereUserTypeAndCustomerStatus('staff', 'approve')->get();
        return response()->json([
            'service_counters' => $serviceCounter,
            'users' => $user
        ]);
    }
    // get app form by province  code for license booking
    public function getAppFormByProvince()
    {
        $vehicle_type = \App\Model\VehicleType::where("vehicle_type_group_id", request('v_type'))->pluck('id');

        $appForm = \App\Model\AppForm::whereHas('vehicle', function ($q) use($vehicle_type) {
            $q->whereProvinceCodeAndVehicleKindCode(request('province_code'), request('veh_kind'))->whereIn('vehicle_type_id', $vehicle_type);
        })->whereIn('app_form_status_id', [1, 2])->whereNotIn('id', \App\Model\LicenseNoBooking::usedBooking())->where('id', '!=', request('id'))->pluck("app_no", "id");
        return response()->json($appForm);
    }

    public function getAlphabetControl()
    {
        $alphabetControl = \App\Model\LicenseAlphabetControl::whereHas('licAlphaControlStatus', function ($q) {
            $q->whereIn('name', ['Uses', 'Available']);
        })->whereProvinceCodeAndVehicleKindCodeAndVehicleTypeGroupId(request('province_code'), request('vehicle_kind'), request('vehicle_type_group'))
        ->pluck('license_alphabet_id');

        $alphabet = \App\Model\LicenseAlphabet::whereIn('id', $alphabetControl)->pluck('name', 'id');
        return response()->json($alphabet);
    }

    // get alphabet when haven't use by this province, vehicle kind code and vtype for alphabet control
    public function getAlphabet()
    {
        $alphabetControl = \App\Model\LicenseAlphabetControl::whereProvinceCodeAndVehicleKindCodeAndVehicleTypeGroupId(request('province_code'), request('vehicle_kind_code'), request('vtype'))->pluck('license_alphabet_id');
        $alphabet = \App\Model\LicenseAlphabet::whereNotIn('id', $alphabetControl)->pluck('name', 'id');
        return response()->json($alphabet);
    }

    // // get alphabet when haven't use by this province, vehicle kind code and vtype for alphabet control
    public function getAlphabetNext()
    {
        $alphabetControl = \App\Model\LicenseAlphabetControl::whereProvinceCodeAndVehicleKindCodeAndVehicleTypeGroupId(request('province_code'), request('vehicle_kind_code'), request('vtype'))->pluck('license_alphabet_next_id');
        $alphabet = \App\Model\LicenseAlphabet::whereNotIn('id', $alphabetControl)->where('id', '!=', request('selected_alpha'))->pluck('name', 'id');
        return response()->json($alphabet);
    }

    public function checkLicenseBooking()
    {
        $text = "";
        $license_no = request('licenseNo');
        $license_no_arr = explode(" ", request('licenseNo'));
        $license_alpha = $license_no_arr[0];
        $license_only_no = $license_no_arr[1];
        $veh_kind = request('vehicle_kind');
        $province_code = request('province');

        // if (\App\Model\LicenseNoBooking::whereLicenseNoBookNumberAndVehicleKindCodeAndProvinceCode(request('licenseNo'), request('vehicle_kind'), request('province'))->where('id', '!=', request('id'))->exists() 
        // || \App\Model\LicenseNoNotSale::whereLicenseNoNotSaleNumberAndProvinceCode($license_only_no, request('province'))->exists()) {
        //     return response()->json(['status' => "used", 'message' => trans('module4.msg_already_book')]);
        // } else {
        // }

        if (\App\Model\LicenseNoSale::whereLicenseNoSaleNumberAndProvinceCode($license_only_no, $province_code)->exists()) {
            $text = "LicenseNoSale:".$license_only_no.":".$province_code;
            return response()->json(['status' => "used", 'message' => trans('module4.msg_already_book')]);
        } else if (\App\Model\LicenseNoNotSale::whereLicenseNoNotSaleNumberAndProvinceCode($license_only_no, $province_code)->exists()) {
            $text = "LicenseNoNotSale:".$license_only_no.":".$province_code;
            return response()->json(['status' => "used", 'message' => trans('module4.msg_already_book')]);
        } else if (\App\Model\LicenseNoHistory::whereVehicleKindCodeAndProvinceCodeAndLicenceNo($veh_kind, $province_code, $license_no)->exists()){
            $text = "LicenseNoHistory:".$veh_kind.":".$province_code.":".$license_no;
            return response()->json(['status' => "used", 'message' => trans('module4.msg_already_book')]);
        }else if (\App\Model\LicenseNoBooking::whereVehicleKindCodeAndProvinceCodeAndLicenseNoBookNumberAndVehicleTypeGroupId($veh_kind, $province_code, $license_no, request('v_type'))->exists()) {
            $text = "LicenseNoBooking:".$veh_kind.":".$province_code.":".$license_no;
            return response()->json(['status' => "used", 'message' => trans('module4.msg_already_book')]);
        }else {
            $alphabet_control = \App\Model\LicenseAlphabetControl::whereHas('licAlphabet', function ($q) use ($license_alpha) {
                $q->whereName($license_alpha);
            })->whereProvinceCodeAndVehicleKindCodeAndVehicleTypeGroupId(request('province'), request('vehicle_kind'), request('v_type'))->whereIn('license_alphabet_control_status_id', [5, 12])->pluck('id')->count();

            if($alphabet_control == 0){
                return response()->json(['status' => "not_exist", 'message' => trans('module4.msg_alphabet_not_available')]); 
            }else{
                return response()->json(['status' => "OK"]); 
            } 
        }
    }

    //check status by province in province control
    public function checkProvinceStatus()
    {
        if (\App\Model\ProvinceNoControl::whereProvinceCodeAndStatus(request('province'), request('status'))->where('id', '!=', request('id'))->exists()) {
            return response()->json(['status' => "used", 'message' => trans('module4.msg_already_exist')]);
        }
    }

    //get bill no by server counter id
    public function getBillNo()
    {
        $bill_no = new \App\Helpers\BillNo;
        return response()->json([
            'bill_no' => $bill_no->billNo(request('id')),
            'counter_name' => \App\Model\ServiceCounter::name(request('id')),
            'payment_date' => \App\Model\PriceList::getLastDate(request('id')),
        ]);
    }
}
