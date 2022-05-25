<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\VehicleModel;
use App\Model\VehicleBrand;
use DB;
class VehicleModelController extends Controller
{   

    function __construct()
    {
        $this->middleware('permission:Vehicle-Model-All');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $result = [];
        $data['vehiclemodel'] = VehicleModel::with('brand')->select(['id','name', 'name_en','description','status','brand_id'])->orderByDesc('created_at')->chunk(300, function($properties) use (&$result){
          
          $result[] = $properties;
        });
     
        $brand = VehicleBrand::whereStatus(1)->get();
        return view('admin.vehicle.vehicle-model', compact('result','brand'));
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
   //check duplicate record name and name_en by brand
    public function checkRecord()
    {
      
      if (VehicleModel::where([['id', '!=', request('id')], ['name', request('name')], ['brand_id', request('brand')]])->orwhere([['id', '!=', request('id')], ['name_en', request('name_en')], ['brand_id', request('brand')]])->exists()) {
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
        VehicleModel::create($request->all());
        return back()->with('success', trans('table_man.v_model_added_msg'));
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
        $vehiclemodel = VehicleModel::find($id);
      \LogActivity::saveToLog($vehiclemodel, $tb_name = "vehicle_models", $action = "update");
        $vehiclemodel->update($request->all());
        return back()->with('success', trans('table_man.v_model_update_msg'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $data =VehicleModel::find($id);
      \LogActivity::saveToLog($data,$tb_name="Vehicle_Models",$action="delete");
      $data->delete();
      return back()->with('success', trans('table_man.v_model_delete_msg'));
    }
}
