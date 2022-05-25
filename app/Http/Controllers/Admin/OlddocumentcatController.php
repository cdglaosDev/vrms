<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\OldDocumentCategory;
use App\Model\Province;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class OlddocumentcatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data=\App\Model\OldDocumentCategory::orderByDesc('created_at')->get();
        return view("admin.Olddocument-Category.olddocument_cat",compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
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
       
        "name"=>"required",
        "name_en"=>"required"

        ]);
        
         $country=new OldDocumentCategory();
       
        $country->name=$request->name;
           $country->name_en=$request->name_en;
           $country->status=$request->status;
   $country->save();
   return redirect('admin/old-doc-category')->with('success','Successful Old Document Category Added.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
       
        "name"=>"required",
        "name_en"=>"required"
        ]);
         $update=OldDocumentCategory::find($id);
         \LogActivity::saveToLog($update ,$tb_name="olddocument_categorys",$action="update");
        $update->name=$request->name;
         $update->name_en=$request->name_en;
         $update->status=$request->status;
   $update->save();
   return redirect('admin/old-doc-category')->with('success','Successful Old Document Category Update.'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
    {
    $data =OldDocumentCategory::find($id);
        \LogActivity::saveToLog($data,$tb_name="Olddocument_Categorys",$action="delete");
     $data->delete();
        return redirect('admin/old-doc-category')->with('success','Successful Delete.'); 
    }
}
