<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Department;
use App\Model\OldDocument;
use App\Helpers\DateHelper;
class OlddocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    $data['documents']=\App\Model\OldDocument::orderByDesc('created_at')->get();
      $data['department'] =\App\Model\Department::pluck('id','name');
       $data['olddocument'] =\App\Model\OldDocumentCategory::pluck('id','name');
        return view("admin.olddocument.olddocument",$data);


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
        
            $request->validate([
        "department"=>"required",
         "type"=>"required",
         "file"=>"required",
          "remark"=>"required"
       ]); 
        $input = $request->all();
         $input['date']=DateHelper::getMySQLDateTimeFromUIDate($request->date);
           $input = OldDocument::create($input);
     return redirect('admin/old-document')->with('success','Successful Old Document  Added.'); 
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
       $request->validate([
       
       
       ]); 
      $input = $request->all();
        \LogActivity::saveToLog($input ,$tb_name="old_documents",$action="update");
      $input['date']=DateHelper::getMySQLDateTimeFromUIDate($request->date);
        $user = OldDocument::find($id);
         $user->update($input);
     return redirect('admin/old-document')->with('success','Successful OldDocument Update.'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $data =OldDocument::find($id);
        \LogActivity::saveToLog($data,$tb_name="old_documents",$action="delete");
     $data->delete();
        return redirect('admin/old-document')->with('success','Successful Old Document  Delete.'); 
    }
}
