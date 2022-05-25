<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ApplicationType;
use DB;
class ApplicationTypeController extends Controller
{   

    function __construct()
    {
     

         $this->middleware('permission:Application-Type-All');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $data['applicationtype']= ApplicationType::orderByDesc('created_at')->get();
        return view('admin.vehicle.application-type',$data);

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
        $province_no_trash =ApplicationType::pluck('name')->toArray();
    $province_no_trash1 =ApplicationType::pluck('name_en')->toArray();
      $province_trash =ApplicationType::onlyTrashed()->wherename($request->name)->pluck('name')->first();
      $province_trash1 =ApplicationType::onlyTrashed()->wherename($request->name)->pluck('name_en')->first();
      if(in_array($request->name,$province_no_trash)){
        return back()->with('error','Application Type Name already exits.');
    }
     else if(in_array($request->name_en,$province_no_trash1)){
        return back()->with('error','Application Type Name(English) already exits.');
    }
      else if($request->name == $province_trash or $request->name_en == $province_trash1 ){
      DB::table('application_types')->wherename($request->name,$request->name_en)->update([
         'name' =>$request->name,
         'name_en' =>$request->name_en,
        
        
         
           'status' =>$request->status,
        'deleted_at' =>null
      ]);
      
       return redirect('admin/application-type')->with('success','Successful Application Type Added.');
 
      }else{
       $this->validate($request,[
             "name"=>"required",
            "name_en"=>"required",
          
            
         ]);
          $vehiclemodel=new ApplicationType();
         $vehiclemodel->name =$request->name;
         $vehiclemodel->name_en =$request->name_en;
        
        
       
           $vehiclemodel->status =$request->status;
        $vehiclemodel->save();
         return redirect('admin/application-type')->with('success','Successful Application Type Added.');
      }
        
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
            'name' => 'required|unique:application_types,name,'.$id.',id,deleted_at,NULL',
            'name_en' => 'required|unique:application_types,name_en,'.$id.',id,deleted_at,NULL',
           
           
            
        ]);
         $applicationtype =ApplicationType::find($id);
        \LogActivity::saveToLog($applicationtype ,$tb_name="application_types",$action="update");
         $applicationtype->name =$request->name;
         $applicationtype->name_en =$request->name_en;
           $applicationtype->status =$request->status;
        $applicationtype->save();
         return back()->with('success','Successful Application Type updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data =ApplicationType::find($id);
        \LogActivity::saveToLog($data,$tb_name="Application_Types",$action="delete");
     $data->delete();
        return back()->with('success','Successful  Application Type delete');
    }
}
