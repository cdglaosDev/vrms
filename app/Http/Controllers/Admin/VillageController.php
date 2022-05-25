<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Village;
use DB;
class VillageController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Village-All');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data['villages'] = \App\Model\Village::orderByDesc('created_at')->get();
      $data['province'] = \App\Model\Province::GetProvince();
      return view("admin.village.village",$data);
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
        $district =  Village::where([['id', '!=', request('id')], ['village_code' , request('code')]])->pluck('id')->count();
        return response()->json([
            'data' =>  $district,
        ]);
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      Village::create($request->all());
      return redirect('/admin/village')->with('success', trans('table_man.village_added_msg')); 
    
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
     
      $village = Village::find($id);
      \LogActivity::saveToLog($village,$tb_name="districts",$action="update");
      $village->update($request->all());
     return redirect('/admin/village')->with('success', trans('table_man.village_update_msg')); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Village::find($id);
        \LogActivity::saveToLog($data,$tb_name="Villages",$action="delete");
        $data->delete();
        return redirect('/admin/village')->with('success', trans('table_man.village_delete_msg')); 
    }
}
