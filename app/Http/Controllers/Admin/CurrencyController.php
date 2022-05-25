<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Currency;

class CurrencyController extends Controller
{   

     function __construct()
    {
     

         $this->middleware('permission:Table-Management-View');
         $this->middleware('permission:Table-Management-Create', ['only' => ['create','store']]);
         $this->middleware('permission:Table-Management-Edit', ['only' => ['edit','update']]);
         $this->middleware('permission:Table-Management-Delete', ['only' => ['destroy']]);
          $this->middleware('permission:Table-Management-All|Table-Management-View|Table-Management-Create|Table-Management-Edit|Table-Management-Delete');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['currency']=Currency::orderByDesc('created_at')->get();
        return view('admin.vehicle.currency',$data);
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
        //
        $this->validate($request,[

            'name'=>'required', 
            'symbol'=>'required'
        ]);

        $currency=new Currency();
        $currency->name=$request->name;
        $currency->symbol=$request->symbol;
         $currency->status=$request->status;
        $currency->save();

        return redirect('admin/currency')->with('successful', 'Successfully added Currency');
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
        //
        $this->validate($request,[
            'name' => 'required',
            'symbol' =>'required',
           
            
        ]);
         $currency =Currency::find($id);
        \LogActivity::saveToLog($currency ,$tb_name="currencys",$action="update");
         $currency->name =$request->name;
         $currency->symbol =$request->symbol;
           $currency->status=$request->status;
        $currency->save();
         return back()->with('success','Successful Currency updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $data =Currency::find($id);
        \LogActivity::saveToLog($data,$tb_name="Currencys",$action="delete");
     $data->delete();
        return back()->with('success','Successful delete currency');
    }
}
