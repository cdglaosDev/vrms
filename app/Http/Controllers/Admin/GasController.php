<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Gas;

class GasController extends Controller
{   
    function __construct()
    {
        $this->middleware('permission:Engine-Type-All');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $data['enginetype'] = Gas::orderByDesc('created_at')->get();
        return view('admin.vehicle.engine-type', $data);
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
    
    if (Gas::where([['id', '!=', request('id')], ['name', request('name')]])->orwhere([['id', '!=', request('id')], ['name_en', request('name_en')]])->exists()) {
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
        Gas::create($request->all());
        return back()->with('success', trans('table_man.eng_type_added_msg'));
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
       
        $enginetype = Gas::find($id);
        \LogActivity::saveToLog($enginetype,$tb_name="gases",$action="update");
        $enginetype->update($request->all());
        return back()->with('success', trans('table_man.eng_type_update_msg'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Gas::find($id);
        \LogActivity::saveToLog($data, $tb_name = "gases", $action = "delete");
        $data->delete();
        return back()->with('success', trans('table_man.eng_type_delete_msg'));
    }
}
