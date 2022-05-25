<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\VehicleKind;

class VehicleKindController extends Controller
{   
    function __construct()
    {
        $this->middleware('permission:Vehicle-Kind-All');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['vehiclekind'] = VehicleKind::orderByDesc('created_at')->get();
        return view('admin.vehicle.vehicle-kind',$data);
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
      //check duplicate record vehicle kind code
      public function checkRecord()
      {
        
        if (VehicleKind::where([['id', '!=', request('id')], ['vehicle_kind_code', request('veh_kind_code')]])->exists()) {
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
        VehicleKind::create($request->all());
         return back()->with('success', trans('table_man.v_kind_added_msg'));
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
       
        $vehiclekind =VehicleKind::find($id);
        \LogActivity::saveToLog($vehiclekind, $tb_name = "vehicle_kinds", $action = "update");
        $vehiclekind->update($request->all());
         return back()->with('success', trans('table_man.v_kind_update_msg'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $data = VehicleKind::find($id);
      \LogActivity::saveToLog($data, $tb_name = "Vehicle_Kinds", $action = "delete");
      $data->delete();
      return back()->with('success', 'Successful Vehicle Kind Delete.');
    }
}
