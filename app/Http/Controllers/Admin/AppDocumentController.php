<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\PreRegisterApp;
use App\Model\VehicleDetail;
use App\Model\AppFormDetail;
use App\Model\AppDocument;
use Auth;
use App\Helpers\DateHelper;
use DB;
class AppDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    $data['appformdetails']=\App\Model\AppDocument::orderByDesc('created_at')->get();
      $data['appstatus'] =\App\Model\ApplicationStatus::whereStatus(1)->get();
       $data['staff'] =\App\Model\Staff::get();
     $data1['document']=\App\Model\AppDocument::orderByDesc('created_at')->get();
     
     
       // return view("md5.application-form",$data);
         return view("md5.pre-reg-app",$data,$data1);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=\App\Model\PreRegisterApp::orderByDesc('created_at')->get();
           return view("md5.application-form",$data);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

             $prereg = PreRegisterApp::find($id);
        
        return view('md5.show',compact('prereg'));
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
     
     
       $vehicle= AppDocument::find($id);
        \LogActivity::saveToLog($district ,$tb_name="app_documents",$action="update");
           $vehicle->doc_type_id = $request->doc_type_id;
             $vehicle->filename = $request->filename;
             $vehicle->link = $request->link;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data =PreRegisterApp::find($id);
        \LogActivity::saveToLog($data,$tb_name="AppForm_Details",$action="delete");
     $data->delete();
        return redirect('Module5/app-form')->with('success','Successful Application Form Detail  Delete.'); 
    }
}
