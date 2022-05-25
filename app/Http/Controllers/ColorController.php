<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Color;
use DB;
class ColorController extends Controller
{   

    function __construct()
    {
     
        $this->middleware('permission:Color-All');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $color = Color::orderByDesc('created_at')->get();
        return view('Color.index', compact('color'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }
    //check duplicate record name and name_en
    public function checkRecord()
    {
        if (Color::where([['id', '!=', request('id')], ['name', request('name')]])->orwhere([['id', '!=', request('id')], ['name_en', request('name_en')]])->exists()) {
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
        $data = $request->all();
        $data['created_by'] = auth()->id();
        Color::create($data);
        return back()->with('success', trans('table_man.color_added_msg'));
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
        $color = Color::find($id);
        \LogActivity::saveToLog($color, $tb_name = "colors", $action = "update");
        $data = $request->all();
        $data = $request->except(['_token', '_method' ]);
        $data['updated_by'] = auth()->id();
        $color->update($data);
        return back()->with('success', trans('table_man.color_update_msg'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Color::find($id);
        \LogActivity::saveToLog($data,$tb_name = "colors", $action = "delete");
        $data->delete();
        return back()->with('success', trans('table_man.color_delete_msg'));
    }
}
