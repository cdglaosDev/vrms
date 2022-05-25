<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AppDocument;
use App\Helpers\DateHelper;
class ImportAppDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['app_doc'] = AppDocument::orderByDesc('created_at')->get();
        return view('ImportAppDocument.index',$data);
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
         $this->validate($request, [
            'doc_type_id' => 'required',
            'filename' => 'required',
            'link'=>'required',
            'date'=>'required'
        ]);

         $data = new AppDocument;
         $data->doc_type_id = $request->doc_type_id;
         $data->app_form_id =1;
         $data->filename = $request->filename;
         $data->link = $request->link;
         $data->date = DateHelper::getMySQLDateTimeFromUIDate($request->date);
         $data->save();
        return back()->with('success','Importer Applicatoin Document created successfully');

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
            'doc_type_id' => 'required',
            'filename' => 'required',
            'link'=>'required',
            'date'=>'required'
        ]);
         $data = AppDocument::find($id);
         $data->doc_type_id = $request->doc_type_id;
         $data->app_form_id = 1;
         $data->filename = $request->filename;
         $data->link = $request->link;
         $data->date = DateHelper::getMySQLDateTimeFromUIDate($request->date);
         $data->save();
        return back()->with('success','Impoter Applicatoin Document updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AppDocument::find($id)->delete();
        return back()->with('success','Successful deleted');
    }
}
