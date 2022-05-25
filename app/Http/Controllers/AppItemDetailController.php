<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AppItemDetailRequest;
use App\Model\Vehicle;
class AppItemDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $app_detail = Vehicle::orderByDesc('created_at')->get();
        return view('AppItemDetail.index',compact('app_detail'));
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
        return view('AppItemDetail.create',$data);
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
        Vehicle::create($data);
        return redirect()->route('app-item-detail.index')->with('success','Create App Item Detail successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Vehicle::find($id);
        return view('AppItemDetail.detail',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $data['app_item'] = \App\Model\Vehicle::find($id);
        $data['currency'] = \App\Model\MoneyUnit::get();
        $data['vtype'] = \App\Model\VehicleType::get();
        $data['vmodel'] = \App\Model\VehicleModel::get();
        $data['vbrand'] = \App\Model\VehicleBrand::get();
        $data['vstandard'] = \App\Model\Standard::get();
        $data['gas'] = \App\Model\Gas::get();
        $data['steering'] = \App\Model\Steering::get();
        return view('AppItemDetail.edit',$data);
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
        $item = Vehicle::find($id);
         \LogActivity::saveToLog($item,$tb_name="app_item_details",$action="update");
        $data = $request->all();
        $data = $request->except(['_token', '_method' ]);
       
        Vehicle::where('id',$id)->update($data);
        return redirect()->route('app-item-detail.index')->with('success', 'updated Application Item Detial successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Vehicle::find($id);
         \LogActivity::saveToLog($item,$tb_name="app_item_details",$action="delete");
          $item->delete();
         return back()->with('success', 'Delete  successfully');
    }
}
