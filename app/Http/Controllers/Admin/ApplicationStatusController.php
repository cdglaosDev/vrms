<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ApplicationStatus;

class ApplicationStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $data['applicationstatus']= ApplicationStatus::orderByDesc('created_at')->get();
        return view('admin.vehicle.application-status',$data);
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
            'name' => 'required',
            'name_en' =>'required',
           
            
        ]);
         $applicationstatus=new ApplicationStatus();
         $applicationstatus->name =$request->name;
         $applicationstatus->name_en =$request->name_en;
            $applicationstatus->status =$request->status;
        $applicationstatus->save();
         return redirect('admin/application-status')->with('success','Successful Application Status Added.');
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
            'name' => 'required',
            'name_en' =>'required',
           
            
        ]);
         $applicationstatus =ApplicationStatus::find($id);
        \LogActivity::saveToLog($applicationstatus ,$tb_name="application_status",$action="update");
         $applicationstatus->name =$request->name;
         $applicationstatus->name_en =$request->name_en;
            $applicationstatus->status =$request->status;
        $applicationstatus->save();
         return back()->with('success','Successful Application Status updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data =ApplicationStatus::find($id);
        \LogActivity::saveToLog($data,$tb_name="Application Status",$action="delete");
     $data->delete();
        return back()->with('success','Successful Application Status delete');
    }
}
