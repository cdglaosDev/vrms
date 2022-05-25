<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\MoneyUnit;

class MoneyUnitController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:Money-Unit-All');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['moneyunit'] = MoneyUnit::orderByDesc('created_at')->get();
        return view('admin.vehicle.money-unit', $data);
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
        if (MoneyUnit::where([['id', '!=', request('id')], ['name', request('name')]])->orwhere([['id', '!=', request('id')], ['name_en', request('name_en')]])->exists()) {
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
        MoneyUnit::create($request->all());
        return back()->with('success', trans('table_man.money_unit_added_msg'));
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
       
        $moneyunit = MoneyUnit::find($id);
        \LogActivity::saveToLog($moneyunit , $tb_name = "money_units", $action = "update");
        $moneyunit->update($request->all());
        return back()->with('success', trans('table_man.money_unit_update_msg'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = MoneyUnit::find($id);
        \LogActivity::saveToLog($data, $tb_name = " Money_Units", $action = "delete");
        $data->delete();
        return back()->with('success', trans('table_man.money_unit_delete_msg'));
    }
}
