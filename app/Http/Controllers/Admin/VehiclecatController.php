<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\VehicleCategory;

class VehiclecatController extends Controller
{   

      function __construct()
    {
     

         $this->middleware('permission:Table-Management-View');
         $this->middleware('permission:Table-Management-Create', ['only' => ['create','store']]);
         $this->middleware('permission:Table-Management-Edit', ['only' => ['edit','update']]);
         $this->middleware('permission:Table-Management-Delete', ['only' => ['destroy']]);
          $this->middleware('permission:Table-Management-All|Table-Management-View|Table-Management-Create|Table-Management-Edit|Table-Management-Delete');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['vehiclebrand']=VehicleCategory::orderByDesc('created_at')->get();
        return view('admin.vehicle-category.vehiclecat',$data);
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
        //
        $this->validate($request,[
             "name"=>"required",
          "name_en"=>"required",
            'description'=>'required',
            
              ]);

            $vehiclebrand=new VehicleCategory();

            $vehiclebrand->name=$request->name;
            $vehiclebrand->name_en=$request->name_en;
            $vehiclebrand->description=$request->description;
           
 $vehiclebrand->status=$request->status;
            $vehiclebrand->save();
            return redirect('admin/vehicle-category')->with('success', "Successfully added Vehicle Category");

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
        //
        $this->validate($request,[
           
            "name"=>'required|unique:vehicle_categories,name,'.$id.',id,deleted_at,NULL',
            "name_en"=>'required|unique:vehicle_categories,name_en,'.$id.',id,deleted_at,NULL',
            'description'=>'required',

              ]);

            $vehiclebrand=VehicleCategory::find($id);
 \LogActivity::saveToLog($vehiclebrand ,$tb_name="vehicle_categories",$action="update");
            $vehiclebrand->name=$request->name;
            $vehiclebrand->name_en=$request->name_en;
            $vehiclebrand->description=$request->description;
           
$vehiclebrand->status=$request->status;

            $vehiclebrand->save();
            return back()->with('success','Successful Vehicle Category updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data =VehicleCategory::find($id);
        \LogActivity::saveToLog($data,$tb_name="vehicle_categories",$action="delete");
     $data->delete();
        return back()->with('success','Successful Vehicle Category Delete.');
}
}