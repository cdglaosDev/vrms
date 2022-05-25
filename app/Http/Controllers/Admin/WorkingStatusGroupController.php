<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\WorkingStatusGroup;
use DB;
class WorkingStatusGroupController extends Controller
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
         $data['workingstatusgroup']= WorkingStatusGroup::orderByDesc('created_at')->get();
        return view('admin.vehicle.working-status-group',$data);
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
        $province_no_trash = WorkingStatusGroup::pluck('name')->toArray();
    $province_no_trash1 = WorkingStatusGroup::pluck('name_en')->toArray();
      $province_trash = WorkingStatusGroup::onlyTrashed()->wherename($request->name)->pluck('name')->first();
      $province_trash1 = WorkingStatusGroup::onlyTrashed()->wherename($request->name)->pluck('name_en')->first();
      if(in_array($request->name,$province_no_trash)){
        return back()->with('error','Working Status Group Name already exits.');
    }
     else if(in_array($request->name_en,$province_no_trash1)){
        return back()->with('error','Working Status Group Name(English) already exits.');
    }
      else if($request->name == $province_trash or $request->name_en == $province_trash1 ){
      DB::table('working_status_groups')->wherename($request->name,$request->name_en)->update([
         'name' =>$request->name,
         'name_en' =>$request->name_en,
        
         'description' =>$request->description,
         
           'status' =>$request->status,
        'deleted_at' =>null
      ]);
      
       return redirect('admin/working-status-group')->with('success','Successful Working Status Group Added.');
 
      }else{
       $this->validate($request,[
             "name"=>"required",
            "name_en"=>"required",
          
            
         ]);
          $vehiclemodel=new WorkingStatusGroup();
         $vehiclemodel->name =$request->name;
         $vehiclemodel->name_en =$request->name_en;
         $vehiclemodel->description =$request->description;
        
        
       
           $vehiclemodel->status =$request->status;
        $vehiclemodel->save();
         return redirect('admin/working-status-group')->with('success','Successful Working Status Group Added.');
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
        
        $this->validate($request,[
            'name' => 'required|unique:working_status_groups,name,'.$id.',id,deleted_at,NULL',
            'name_en' => 'required|unique:working_status_groups,name_en,'.$id.',id,deleted_at,NULL',
            'description' =>'required',
           
            
        ]);

         $workingstatusgroup =WorkingStatusGroup::find($id);
           \LogActivity::saveToLog($workingstatusgroup,$tb_name="workingstatus_groups",$action="update");
         $workingstatusgroup->name =$request->name;
         $workingstatusgroup->name_en =$request->name_en;
         $workingstatusgroup->description =$request->description;
            $workingstatusgroup->status =$request->status;
        $workingstatusgroup->save();
         return back()->with('success','Successful Working Status Group updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $data =WorkingStatusGroup::find($id);
        \LogActivity::saveToLog($data,$tb_name="Working Status Group",$action="delete");
     $data->delete();
        return back()->with('success','Successful delete Working Status Group');
    }
}
