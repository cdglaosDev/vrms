<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\WorkingStatus;
use App\Model\WorkingStatusGroup;
use DB;
class WorkingStatusController extends Controller
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
         $data['workingstatus']= WorkingStatus::orderByDesc('created_at')->paginate(5);
        $data['working']= WorkingStatusGroup::get();
        return view('admin.vehicle.working-status',$data);
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
        
         $province_no_trash = WorkingStatus::pluck('name')->toArray();
    $province_no_trash1 = WorkingStatus::pluck('name_en')->toArray();
      $province_trash = WorkingStatus::onlyTrashed()->wherename($request->name)->pluck('name')->first();
      $province_trash1 = WorkingStatus::onlyTrashed()->wherename($request->name)->pluck('name_en')->first();
      if(in_array($request->name,$province_no_trash)){
        return back()->with('error','Working Status  Name already exits.');
    }
     else if(in_array($request->name_en,$province_no_trash1)){
        return back()->with('error','Working Status  Name(English) already exits.');
    }
      else if($request->name == $province_trash or $request->name_en == $province_trash1 ){
      DB::table('working_statuses')->wherename($request->name,$request->name_en)->update([
         'name' =>$request->name,
         'name_en' =>$request->name_en,
        
         'description' =>$request->description,
          'working_status_group_id' =>$request->working_status_group_id,
           'status' =>$request->status,
        'deleted_at' =>null
      ]);
      
       return redirect('admin/working-status')->with('success','Successful Working Status  Added.');
 
      }else{
       $this->validate($request,[
             "name"=>"required",
            "name_en"=>"required",
          
            
         ]);
           $workingstatus=new WorkingStatus();
         $workingstatus->name =$request->name;
         $workingstatus->name_en =$request->name_en;
         $workingstatus->description =$request->description;
         $workingstatus->working_status_group_id =$request->working_status_group_id;
           $workingstatus->status =$request->status;
        $workingstatus->save();
         return redirect('admin/working-status')->with('success','Successful Working Status  Added.');
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
             'name' => 'required|unique:working_statuses,name,'.$id.',id,deleted_at,NULL',
            'name_en' => 'required|unique:working_statuses,name_en,'.$id.',id,deleted_at,NULL',
            'description' =>'required',
            'working_status_group_id' =>'required',
           
            
        ]);
         $workingstatus =WorkingStatus::find($id);
        \LogActivity::saveToLog($workingstatus,$tb_name="workingstatus",$action="update");
         $workingstatus->name =$request->name;
         $workingstatus->name_en =$request->name_en;
         $workingstatus->description =$request->description;
         $workingstatus->working_status_group_id =$request->working_status_group_id;
           $workingstatus->status =$request->status;
        $workingstatus->save();
         return back()->with('success','Successful Working Status updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data =WorkingStatus::find($id);
        \LogActivity::saveToLog($data,$tb_name="Working_Status",$action="delete");
     $data->delete();
        return back()->with('success','Successful delete Working Status');
    }
}
