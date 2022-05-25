<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\EngineBrand;
use DB;
class EngineBrandController extends Controller
{   

    function __construct()
    {
        $this->middleware('permission:Engine-Brand-All');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['enginebrand'] = EngineBrand::orderByDesc('created_at')->get();
        return view('admin.engine-brand.engine-brand', $data);
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
        if (EngineBrand::where([['id', '!=', request('id')], ['name', request('name')]])->orwhere([['id', '!=', request('id')], ['name_en', request('name_en')]])->exists()) {
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
        EngineBrand::create($request->all());
        return back()->with('success', trans('table_man.eng_brand_added_msg'));
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
        $engine_brands = EngineBrand::find($id);
        \LogActivity::saveToLog($engine_brands, $tb_name = "engine_brands", $action = "update");
        $engine_brands->update($request->all());
        return back()->with('success', trans('table_man.eng_brand_update_msg'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = EngineBrand::find($id);
        \LogActivity::saveToLog($data, $tb_name = "Engine_brands", $action = "delete");
        $data->delete();
        return back()->with('success', trans('table_man.eng_brand_delete_msg'));
    }
}
