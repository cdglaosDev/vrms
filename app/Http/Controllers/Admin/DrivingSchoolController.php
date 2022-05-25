<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\DrivingSchool;
use App\Model\Province;
use App\Model\District;
use App\Model\Village;
use DB;
class DrivingSchoolController extends Controller
{   

    function __construct()
    {
        $this->middleware('permission:Driving-School-All');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->user_level == "province") {
            $data['drivingschool'] = DrivingSchool::whereProvinceCode(\App\Helpers\Helper::current_province())->orderByDesc('created_at')->get();
        } else {
            $data['drivingschool'] = DrivingSchool::orderByDesc('created_at')->get();
        }
        
        $data['province'] = Province::GetProvince();
        $data['district'] = District::whereStatus(1)->get();
        $data['village'] = Village::pluck('village_code','name');
        return view('admin.car-sales.driving-school',$data);
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
        DrivingSchool::create($request->all());
        return back()->with('success', trans('table_man.driving_added_msg'));
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
       
        $drivingschool = DrivingSchool::find($id);
        \LogActivity::saveToLog($drivingschool , $tb_name = "driving_schools", $action = "update");
        $drivingschool->update($request->all());
        return back()->with('success', trans('table_man.driving_update_msg'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DrivingSchool::find($id);
        \LogActivity::saveToLog($data, $tb_name = "Driving_Schools", $action = "delete");
        $data->delete();
        return back()->with('success', trans('table_man.driving_delete_msg')); 
    }
}
