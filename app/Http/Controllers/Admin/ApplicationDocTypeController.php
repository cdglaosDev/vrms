<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ApplicationDocType;
use DB;
class ApplicationDocTypeController extends Controller
{   

    function __construct()
    {
        $this->middleware('permission:Application-Doc-Type-All');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['applicationdoctype'] = ApplicationDocType::orderByDesc('created_at')->get();
        return view('admin.vehicle.application-doc-type', $data);
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
        if (ApplicationDocType::where([['id', '!=', request('id')], ['name', request('name')]])->orwhere([['id', '!=', request('id')], ['name_en', request('name_en')]])->exists()) {
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
        ApplicationDocType::create($request->all());
        return back()->with('success', trans('table_man.app_doc_type_added_msg'));
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
       
        $applicationdoctype =ApplicationDocType::find($id);
        \LogActivity::saveToLog($applicationdoctype, $tb_name = "applicationdoc_types", $action = "update");
        $applicationdoctype->update($request->all());
        return back()->with('success', trans('table_man.app_doc_type_update_msg'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ApplicationDocType::find($id);
        \LogActivity::saveToLog($data,$tb_name = "ApplicationDoc_Types", $action = "delete");
        $data->delete();
        return back()->with('success', trans('table_man.app_doc_type_delete_msg'));
    }
}
