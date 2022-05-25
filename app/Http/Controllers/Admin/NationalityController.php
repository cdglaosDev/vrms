<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Nationality;

class NationalityController extends Controller
{   
    function __construct()
    {
        $this->middleware('permission:Nationality-All');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    $data['nations'] = Nationality::orderByDesc('created_at')->get();
      
        return view("admin.nationality.nation",$data);


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
    //check duplicate records in nationality
    public function checkRecord()
    {
      if( Nationality::where([['id', '!=', request('id')], ['name' , request('name')]])->orwhere([['id', '!=', request('id')], ['name_en' , request('name_en')]])->exists()){
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
        
        $nation = new Nationality();
        $nation->name = $request->name;
        $nation->name_en = $request->name_en;
        $nation->remark = $request->remark;
        $nation->status = $request->status;
        $nation->save();
     return back()->with('success', trans('table_man.nationality_added_msg')); 
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
     
        $update=Nationality::find($id);
        \LogActivity::saveToLog($update ,$tb_name="nationalitys",$action="update");
        $update->name=$request->name;
        $update->name_en=$request->name_en;
        $update->remark=$request->remark;
        $update->status=$request->status;
        $update->save();
     return back()->with('success', trans('table_man.nationality_update_msg')); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $data =Nationality::find($id);
        \LogActivity::saveToLog($data,$tb_name="Nationalitys",$action="delete");
      $data->delete();
      return back()->with('success', trans('table_man.nationality_delete_msg')); 
    }
}
