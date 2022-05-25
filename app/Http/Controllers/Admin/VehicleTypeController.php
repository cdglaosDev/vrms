<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\VehicleType;

class VehicleTypeController extends Controller
{   

    function __construct()
    {
        $this->middleware('permission:Vehicle-Type-All');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
         $data['vehicletype']= VehicleType::orderByDesc('created_at')->get();
        $data['VehicleTypeGroup'] =\App\Model\VehicleTypeGroup::whereStatus(1)->get();
        return view('admin.vehicle.vehicle-type',$data);
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
    //check duplicate records in country
    public function checkRecord()
    {
      if( VehicleType::where([['id', '!=', request('id')], ['name' , request('name')]])->orwhere([['id', '!=', request('id')], ['name_en' , request('name_en')]])->exists()){
        return response()->json([
          'status' =>  "used",
        ]);
      }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        VehicleType::create($request->only('name', 'name_en','vehicle_type_group_id', 'status'));
        return back()->with('success', trans('table_man.v_type_added_msg'));
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
       
        $vehicletype =VehicleType::find($id);
        \LogActivity::saveToLog($vehicletype ,$tb_name="vehicle_type",$action="update");
        $vehicletype->name = request('name');
        $vehicletype->name_en = request('name_en');
        $vehicletype->vehicle_type_group_id = request('vehicle_type_group_id');
        $vehicletype->status = request('status');
        $vehicletype->save();
        return back()->with('success', trans('table_man.v_type_update_msg'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data =VehicleType::find($id);
        \LogActivity::saveToLog($data,$tb_name="Vehicle_Types",$action="delete");
        $data->delete();
        return back()->with('success', trans('table_man.v_type_delete_msg'));
    }
    
}
