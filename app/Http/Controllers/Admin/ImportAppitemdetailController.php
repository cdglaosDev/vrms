<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AppItemDetailRequest;
use App\Model\AppItemDetail;
class ImportAppitemdetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $app_detail = AppItemDetail::orderByDesc('created_at')->get();
        return view('admin.Import-appitemdetail.importdetail',compact('app_detail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['currency'] = \App\Model\MoneyUnit::get();
        $data['vtype'] = \App\Model\VehicleType::get();
        $data['vmodel'] = \App\Model\VehicleModel::get();
        $data['vbrand'] = \App\Model\VehicleBrand::get();
        $data['vstandard'] = \App\Model\Standard::get();
        $data['gas'] = \App\Model\Gas::get();
        $data['steering'] = \App\Model\Steering::get();
        return view('admin.Import-appitemdetail.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppItemDetailRequest $request)
    {
        $data = $request->validated();
        $data['price'] = $request->price;
        $data['item_car_gen'] =$request->item_car_gen;
        $data['car_tech'] =$request->car_tech;
        AppItemDetail::create($data);
       return redirect('admin/importdetail')->with('success','Successful Import App Item Detail Added.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = AppItemDetail::find($id);
        return view('admin.Import-appitemdetail.detail',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $data['app_item'] = \App\Model\AppItemDetail::find($id);
        $data['currency'] = \App\Model\MoneyUnit::get();
        $data['vtype'] = \App\Model\VehicleType::get();
        $data['vmodel'] = \App\Model\VehicleModel::get();
        $data['vbrand'] = \App\Model\VehicleBrand::get();
        $data['vstandard'] = \App\Model\Standard::get();
        $data['gas'] = \App\Model\Gas::get();
        $data['steering'] = \App\Model\Steering::get();
        return view('admin.Import-appitemdetail.edit',$data);
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
        $data = $request->all();
        $data = $request->except(['_token', '_method' ]);
       
        AppItemDetail::where('id',$id)->update($data);
         return redirect('admin/importdetail')->with('success','Successful Import App Item Detail Update.'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          AppItemDetail::find($id)->delete();
        return redirect('admin/importdetail')->with('success','Successful Delete'); 
    }
}
