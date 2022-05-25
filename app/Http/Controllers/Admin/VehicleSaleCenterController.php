<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\VehicleSaleCenter;
use App\Model\Province;
use App\Model\District;
use App\Model\Village;
use App\Model\UserInfo;
use App\User;
class VehicleSaleCenterController extends Controller
{   
    function __construct()
    {
        $this->middleware('permission:Vehicle-Sale-All');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->user_level == "province") {
            $data['vehiclesalecenter'] = VehicleSaleCenter::whereProvinceCode(\App\Helpers\Helper::current_province())->orderByDesc('created_at')->get();
        } else {
            $data['vehiclesalecenter'] = VehicleSaleCenter::orderByDesc('created_at')->get();
        }
       
        $data['province'] = Province::GetProvince();
        $data['district'] = District::whereStatus(1)->get();
        $data['village'] = Village::whereStatus(1)->get();
        $data['userinfo'] = UserInfo::pluck('id');
        $data['user'] = User::get();
        return view('admin.car-sales.vehicle-sale',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['travel'] = VehicleSaleCenter::get();
        return view('admin.car-sales.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->id();
        $data['created_by'] = auth()->id();
        VehicleSaleCenter::create($data);
         return back()->with('success', trans('table_man.v_sale_added_msg'));
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
        //
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
       
        $vehiclesalecenter = VehicleSaleCenter::find($id);
        $vehiclesalecenter->update($request->all());
        return back()->with('success', trans('table_man.v_sale_update_msg'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = VehicleSaleCenter::find($id);
        \LogActivity::saveToLog($data,$tb_name = "VehicleSale_Centers", $action = "delete");
        $data->delete();
       return back()->with('success', trans('table_man.v_sale_delete_msg'));
    }
}
