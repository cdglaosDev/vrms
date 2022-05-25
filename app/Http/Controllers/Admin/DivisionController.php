<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Division;
use DB;
class DivisionController extends Controller
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
         $data['division']= Division::orderByDesc('created_at')->get();
        return view('admin.vehicle.division',$data);
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
       $province_no_trash = Division::pluck('name')->toArray();
    $province_no_trash1 = Division::pluck('name_en')->toArray();
      $province_trash = Division::onlyTrashed()->wherename($request->name)->pluck('name')->first();
      $province_trash1 = Division::onlyTrashed()->wherename($request->name)->pluck('name_en')->first();
      if(in_array($request->name,$province_no_trash)){
        return back()->with('error','Division Name already exits.');
    }
     else if(in_array($request->name_en,$province_no_trash1)){
        return back()->with('error','Division Name(English) already exits.');
    }
      else if($request->name == $province_trash or $request->name_en == $province_trash1 ){
      DB::table('divisions')->wherename($request->name,$request->name_en)->update([
         'name' =>$request->name,
         'name_en' =>$request->name_en,
           'status' =>$request->status,
        'deleted_at' =>null
      ]);
      
       return redirect('admin/division')->with('success','Successful Division Added.');
 
      }else{
       $this->validate($request,[
             "name"=>"required",
            "name_en"=>"required",
         ]);
          $vehiclemodel=new Division();
         $vehiclemodel->name =$request->name;
         $vehiclemodel->name_en =$request->name_en;
           $vehiclemodel->status =$request->status;
        $vehiclemodel->save();
         return redirect('admin/division')->with('success','Successful Division Added.');
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
            'name' => 'required|unique:divisions,name,'.$id.',id,deleted_at,NULL',
            'name_en' =>'required|unique:divisions,name_en,'.$id.',id,deleted_at,NULL',
        ]);
         $division =Division::find($id);
        \LogActivity::saveToLog($division ,$tb_name="divisions",$action="update");
         $division->name =$request->name;
         $division->name_en =$request->name_en;
            $division->status =$request->status;
        $division->save();
         return back()->with('success','Successful division updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data =Division::find($id);
        \LogActivity::saveToLog($data,$tb_name="Divisions",$action="delete");
     $data->delete();
        return back()->with('success','Successful delete Division');
    }
}
