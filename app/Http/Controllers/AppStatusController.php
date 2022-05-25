<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ApplicationStatus;
class AppStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['app_status'] = ApplicationStatus::whereStatus(1)->orderByDesc('created_at')->get();
        
        return view('AppStatus.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'name_en' => 'required'
        ]);

        $input =$request->all();
        ApplicationStatus::create($input);
        return back()->with('success', 'Applicatoin Status created successfully');
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

        $this->validate($request, [
            'name' => 'required',
            'name_en' => 'required'
        ]);

       $data = ApplicationStatus::find($id);
       \LogActivity::saveToLog($data,$tb_name = "application_statuses", $action = "update");
       $data->name = $request->name;
       $data->name_en = $request->name_en;
       $data->status = $request->status;
       $data->save();
        return back()->with('success', 'Applicatoin Status updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $data = ApplicationStatus::find($id);
        \LogActivity::saveToLog($data, $tb_name = "application_statuses", $action = "delete");
        $data->delete();
        return back()->with('success', 'Successful delete');
    }
}
