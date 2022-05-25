<?php

namespace App\Http\Controllers\Module4;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\LicenseNumberPresent;
use Illuminate\Validation\Rule;
use DB;

class LicenseNoPresentController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:License-Present-List-View');
        $this->middleware('permission:License-Present-Create', ['only' => ['store']]);
        $this->middleware('permission:License-Present-Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:License-Present-Delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (auth()->user()->user_level == "admin") {
            $license_no_presents = LicenseNumberPresent::get();
        } else {
            $license_no_presents = LicenseNumberPresent::whereProvinceCode(\App\Helpers\Helper::current_province())->get();
        }
        return view("Module4.LicenseNoPresent.index", compact('license_no_presents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    //check status by province in division control
    public function checkPresentStatus()
    {
        $license_present = LicenseNumberPresent::whereProvinceCodeAndStatusAndVehicleTypeGroupIdAndVehicleKindCode(request('province'), request('status'), request('type_group'), request('vehicle_kind'))->where('id', '!=', request('id'))->pluck('id')->first();
        $alphabet = \App\Model\LicenseAlphabet::whereId(request('alphabet'))->pluck('name')->first();
        $lic_no = $alphabet . ' ' . request('lic_no');
        $vehicle = \App\Model\Vehicle::whereLicenceNoAndVehicleKindCodeAndProvinceCode($lic_no, request('vehicle_kind'), request('province'))->pluck('licence_no')->first();

        return response()->json([
            'lic_present' => $license_present,
            'vehicle' => $vehicle
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = request()->all();
        $input['created_by'] = auth()->id();
        LicenseNumberPresent::create($input);
        return redirect('license-no-present')->with('success', trans('module4.present_success_msg'));
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
        $data['present'] = LicenseNumberPresent::find($id);
        return view('LicenseNoPresent.edit', $data);
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

        $license_present = LicenseNumberPresent::find($id);
        \LogActivity::saveToLog($license_present, $tb_name = "license_no_presents", $action = "update");
        $license_present->update(request()->all());
        return redirect('license-no-present')->with('success', 'Successful License Number Present Update.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = LicenseNumberPresent::find($id);
        \LogActivity::saveToLog($data, $tb_name = "license_no_presents", $action = "delete");
        $data->delete();
        return back()->with('success', 'Successful delete');
    }

    public function changeAlertAt(Request $request)
    {
        try {
            $license_present = LicenseNumberPresent::find($request->licenseNoPresent_id);
            $license_present->update(['alert_at' => 0]);

            return response()->json(['status' => 'OK', 'message' => trans('module4.success_msg')]);
        } catch (\Exception $e) {
            return response()->json(['status' => "error", 'error' => $e->getMessage()]);
        }
    }
}
