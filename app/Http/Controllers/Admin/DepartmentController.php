<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Department;
use App\Model\Province;
use App\Model\District;

class DepartmentController extends Controller
{   
    function __construct()
    {
        $this->middleware('permission:Department-All');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['department'] = Department::orderByDesc('created_at')->get();
        return view('admin.car-sales.department',$data);
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
     //check duplicate records in department
     public function checkRecord()
     {
       if( Department::where([['id', '!=', request('id')], ['name' , request('name')]])->orwhere([['id', '!=', request('id')], ['name_en' , request('name_en')]])->exists()){
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
        Department::create($request->all());
         return back()->with('success', trans('table_man.dept_added_msg'));
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
      
        $department =Department::find($id);
         \LogActivity::saveToLog($department ,$tb_name="departments",$action="update");
        $department->name =$request->name;
        $department->name_en =$request->name_en;
        $department->status =$request->status;
        $department->save();
         return back()->with('success', trans('table_man.dept_update_msg'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Department::find($id);
        \LogActivity::saveToLog($data,$tb_name="Departments",$action="delete");
        $data->delete();
        return back()->with('success', trans('table_man.dept_delete_msg')); 
    }
}
