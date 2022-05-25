<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\District;
use App\Model\Country;
use DB;
class DistrictController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:District-All');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->user_level == "province") { 
            $data['districts'] = \App\Model\District::whereProvinceCode(\App\Helpers\Helper::current_province())->orderByDesc('created_at')->get();
        } else {
            $data['districts'] = \App\Model\District::orderByDesc('created_at')->get();
        }
        $data['province'] = \App\Model\Province::GetProvince();
        return view("admin.district.district",$data);


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
        District::create($request->all());
        return back()->with('success', trans('table_man.district_added_msg')); 
      
    }

    //check duplicate records in country
    public function checkRecord()
    {
        $district =  District::where([['id', '!=', request('id')], ['district_code' , request('district_code')]])
                    ->orwhere([['id', '!=', request('id')], ['name' , request('district_name')]])
                    ->count();
        return response()->json([
            'data' =>  $district,
        ]);
        
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
      
       $district = District::find($id);
       \LogActivity::saveToLog($district, $tb_name = "districts", $action = "update");
        $district->update($request->all());
        return redirect('/admin/district')->with('success', trans('table_man.district_update_msg')); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = District::find($id);
        \LogActivity::saveToLog($data, $tb_name = "Districts", $action = "delete");
        $data->delete();
        return redirect('/admin/district')->with('success', trans('table_man.district_delete_msg')); 
    }
}
