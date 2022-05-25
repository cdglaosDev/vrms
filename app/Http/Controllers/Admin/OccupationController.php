<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Occupation;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class OccupationController extends Controller
{    
    function __construct()
    {
        $this->middleware('permission:Occupation-All');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data=\App\Model\Occupation::orderByDesc('created_at')->get();
        return view("admin.occupation.occupation",compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
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

    //check duplicate records in country
    public function checkRecord()
    {
      if( Occupation::where([['id', '!=', request('id')], ['name' , request('name')]])->orwhere([['id', '!=', request('id')], ['name_en' , request('name_en')]])->exists()){
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
      
        $vehiclemodel = new Occupation();
        $vehiclemodel->name =$request->name;
        $vehiclemodel->name_en =$request->name_en;
        $vehiclemodel->status =$request->status;
        $vehiclemodel->save();
        return back()->with('success', trans('table_man.occupation_added_msg'));
      
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
        $update = Occupation::find($id);
        \LogActivity::saveToLog($update ,$tb_name="occupations",$action="update");
        $update->name=$request->name;
        $update->name_en=$request->name_en;
        $update->status=$request->status;
        $update->save();
        return back()->with('success', trans('table_man.occupation_update_msg')); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  public function destroy($id)
  {
      $data =Occupation::find($id);
      \LogActivity::saveToLog($data,$tb_name="Occupations",$action="delete");
      $data->delete();
      return back()->with('success', trans('table_man.occupation_delete_msg')); 
  }
}
