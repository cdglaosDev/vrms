<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Province;
use App\Model\Country;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Helpers\GenerateCodeNo;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\StorePostRequest;
use Hash;


class ProvinceController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Province-All');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $data['provinces'] = \App\Model\Province::GetProvince();
        $data['country'] = \App\Model\Country::whereStatus(1)->get();
        return view("admin.province.province",$data);
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
        $province= new Province();
        $province->province_code = $request->province_code;
        $province->name = $request->name;
        $province->name_en = $request->name_en;
        $province->abb = $request->abb;
        $province->abb_en = $request->abb_en;
        $province->desc = $request->desc;
        $province->old_name = isset($request->old_name) ? $request->old_name : $request->name;
        $province->country_id = $request->country_id;
        $province->save();
        return redirect('/admin/province')->with('success', trans('table_man.province_added_msg')); 
    }

    //check duplicate records in country
    public function checkRecord()
    {
        $province =  Province::where([['id', '!=', request('id')], ['province_code' , request('province_code')]])
                    ->orwhere([['id', '!=', request('id')], ['name' , request('name')]])
                    ->orwhere([['id', '!=', request('id')], ['name_en' , request('name_en')]])
                    ->orwhere([['id', '!=', request('id')], ['abb' , request('abb_name')]])
                    ->orwhere([['id', '!=', request('id')], ['abb_en' , request('abb_name_en')]])
                    ->count();
       
        return response()->json([
            'province' =>  $province,
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
     
        $province= Province::find($id);
        \LogActivity::saveToLog($province,$tb_name="province",$action="update");
        $province->province_code =$request->province_code;
        $province->name =$request->name;
        $province->name_en =$request->name_en;
        $province->abb =$request->abb;
        $province->abb_en =$request->abb_en;
        $province->desc =$request->desc;
        $province->old_name =isset($request->old_name) ? $request->old_name : $request->name;    
        $province->country_id =$request->country_id;
        $province->status =$request->status; 
        $province->save();
        return redirect('admin/province')->with('success', trans('table_man.province_update_msg')); 
    }
       
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $data = Province::find($id);
      \LogActivity::saveToLog($data,$tb_name = "Provinces",$action = "delete");
      $data->delete();
      return redirect('admin/province')->with('success', trans('table_man.province_delete_msg')); 
    }
}
