<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\VehicleTypeGroup;
use App\Helpers\Helper;

class VehicletypeGroupController extends Controller
{
    
    function __construct()
    {
        $this->middleware('permission:Vehicle-Type-Group-All');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   
    public function index()
    {
        $data=\App\Model\VehicleTypeGroup::get();
        return view("admin.Vehicle-type-group.vehicle_type_group",compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
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
      if( VehicleTypeGroup::where([['id', '!=', request('id')], ['name' , request('name')]])->exists()){
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
        $vehicle_type_group = new VehicleTypeGroup();
        $vehicle_type_group->name = $request->name;
        $vehicle_type_group->status = $request->status;
        $vehicle_type_group->save();
        return back()->with('success', trans('table_man.v_type_group_added_msg')); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
     
        $type_group = VehicleTypeGroup::find($id);
        \LogActivity::saveToLog($type_group,$tb_name ="vehicel-type-groups",$action="update");
        $type_group->name = $request->name;
        $type_group->status = $request->status;
        $type_group->save();
        return back()->with('success', trans('table_man.v_type_group_update_msg')); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
    {
        $data = VehicleTypeGroup::find($id);
        \LogActivity::saveToLog($data,$tb_name="vehicle-type-groups",$action="delete");
        $data->delete();
        return back()->with('success', trans('table_man.v_type_group_delete_msg')); 
    }
}
