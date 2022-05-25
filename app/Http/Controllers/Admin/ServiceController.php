<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ServiceCounter;
use App\Model\Province;
use  Illuminate\Validation\Rule;
class ServiceController extends Controller
{   
    function __construct()
    {
        $this->middleware('permission:ServiceCounter-All');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if (auth()->user()->user_level == "province") { 
        $data['services'] = \App\Model\ServiceCounter::whereProvinceCode(\App\Helpers\Helper::current_province())->orderByDesc('created_at')->get();
      } else {
        $data['services'] = \App\Model\ServiceCounter::orderByDesc('created_at')->get();
      }

      $data['province'] = \App\Model\Province::GetProvince();
      $data['user'] = \App\User::get();
      return view("admin.service-counter.service-counter",$data);
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
    //check license no with vehicle kind when click "Check" button in license booking page
    public function checkRecord()
    {
      if (ServiceCounter::whereNameAndProvinceCode(request('name'), request('province_code'))->where('id', '!=', request('id'))->exists() || ServiceCounter::whereNameEnAndProvinceCode(request('name_en'), request('province_code'))->where('id', '!=', request('id'))->exists()) {
        return response()->json([
          'status' =>  "used",
        ]);
      }
    }

    public function store(Request $request)
    {
      ServiceCounter::create($request->all());
      return back()->with('success', trans('table_man.ser_counter_added_msg')); 
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
      
      $service = ServiceCounter::find($id);
      \LogActivity::saveToLog($service, $tb_name = "service_counters", $action = "update");
      $service->update($request->all());
     return back()->with('success', trans('table_man.ser_counter_update_msg')); 
    }
       
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $data = ServiceCounter::find($id);
      \LogActivity::saveToLog($data,$tb_name = "service_counters", $action = "delete");
      $data->delete();
      return back()->with('success', trans('table_man.ser_counter_delete_msg')); 
    }
}
