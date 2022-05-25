<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CarSaleCenter;
use App\Model\Province;

class CarSaleCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       // $data['car-sales'] = CarSaleCenter::orderByDesc('created_at')->paginate(4);
        $data['carsales']= CarSaleCenter::orderByDesc('created_at')->get();
        $data['province']= Province::pluck('id','name');
        return view('admin.car-sales.car-sales',$data);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
          return view('admin.car-sales.create');
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
         $this->validate($request,[
            'name' => 'required',
            'address' =>'required',
            'phone' =>'required',
            'email' =>'required',
            'user_id' =>'required',
            'province_id'=>'required'
           
        ]);
         $carsales=new CarSaleCenter();
         $carsales->name =$request->name;
         $carsales->address =$request->address;
         $carsales->phone =$request->phone;
         $carsales->email =$request->email;
         $carsales->user_id =$request->user_id;
         $carsales->province_id =$request->province_id;
           $carsales->status =$request->status;
         $carsales->save();
         return redirect('admin/car-sales')->with('success','Successful CarSaleCenter Added.');
    
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
         $data['car-sales'] =CarSaleCenter::find($id);
        return view('admin.car-sales.edit',$data);
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
        //
         $this->validate($request,[
            'name' => 'required',
            'address' =>'required',
            'phone' =>'required',
            'email' =>'required'
        ]);
        $product = CarSaleCenter::find($id);
         \LogActivity::saveToLog($product ,$tb_name="Car_SaleCenters",$action="update");
        $product->update($request->all());
        return redirect('admin/car-sales')->with('message','Successful Car Sale Center updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $data =CarSaleCenter::find($id);
        \LogActivity::saveToLog($data,$tb_name="CarSale_Centers",$action="delete");
     $data->delete();
        return redirect('admin/car-sales')->with('success','Successful Car Sale Center Delete.');
    }
}
