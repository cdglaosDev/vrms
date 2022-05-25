<?php

namespace App\Http\Controllers\Module4;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\LicenseAlphabetControlStatus as LicenseControl;
class LicenseAlphabetControl extends Controller
{
    function __construct()
    {   
        $this->middleware('permission:Alphabet-Control-Status-All');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $license_control = LicenseControl::get();
        return view('Module4.LicenseAlphabetControl.index', compact('license_control'));
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
         if (LicenseControl::where([['id', '!=', request('id')], ['name', request('name')]])->exists()) {
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
        $data = new LicenseControl;
        $data->name = $request->name;
        $data->created_by = auth()->user()->id;
        $data->save();
        return back()->with('success', trans('table_man.lic_alp_ctrl_added_msg'));
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
       $data = LicenseControl::find($id);
       \LogActivity::saveToLog($data, $tb_name = "license_alphabet_control_statuses", $action = "update");
       $data->name = $request->name;
       $data->save();
        return back()->with('success', trans('table_man.lic_alp_ctrl_update_msg'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = LicenseControl::find($id);
        \LogActivity::saveToLog($data, $tb_name = "license_alphabet_control_statuses", $action = "delete");
        $data->delete();
        return back()->with('success', trans('table_man.lic_alp_ctrl_delete_msg'));
    }
}
