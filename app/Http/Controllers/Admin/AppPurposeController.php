<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AppPurpose;

class AppPurposeController extends Controller
{   
    function __construct()
    {
        $this->middleware('permission:App-Purpose-All');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data['apppurpose'] = \App\Model\AppPurpose::orderByDesc('created_at')->get();
        return view('admin.vehicle.app-purpose',$data);
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

    //check duplicate record name and name_en
    public function checkRecord()
    {
        if (AppPurpose::where([['id', '!=', request('id')], ['name', request('name')]])->orwhere([['id', '!=', request('id')], ['name_en', request('name_en')]])->exists()) {
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
        AppPurpose::create($request->all());
        return back()->with('success', trans('table_man.app_purpose_added_msg'));
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
        $app_purpose = AppPurpose::find($id);
        \LogActivity::saveToLog($app_purpose , $tb_name = "app_purposes", $action = "update");
        $app_purpose->update($request->all());
        return back()->with('success', trans('table_man.app_purpose_update_msg'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = AppPurpose::find($id);
        \LogActivity::saveToLog($data, $tb_name = "App_Purposes", $action = "delete");
        $data->delete();
        return back()->with('success', trans('table_man.app_purpose_delete_msg'));
    }
    
}
