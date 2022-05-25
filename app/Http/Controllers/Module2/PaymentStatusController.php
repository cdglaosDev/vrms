<?php

namespace App\Http\Controllers\Module2;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\PaymentStatus;
class PaymentStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =  PaymentStatus::whereStatus(1)->orderByDesc('created_at')->get();
        return view('PaymentStatus.index', compact('data'));
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

         $this->validate($request, [
            'name' => 'required',
            'name_en' => 'required'
        ]);

        $input =$request->all();
        PaymentStatus::create($input);
        return back()->with('success', 'Payment Status created successfully');
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
        $this->validate($request, [
            'name' => 'required',
            'name_en' => 'required'
        ]);
        $data = PaymentStatus::find($id);
        \LogActivity::saveToLog($data, $tb_name = "payment_statuses", $action = "update");
     
       $data->name = $request->name;
       $data->name_en = $request->name_en;
       $data->status = $request->status;
       $data->save();
       return back()->with('success', 'Payment Status updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $data = PaymentStatus::find($id);
        \LogActivity::saveToLog($data, $tb_name = "payment_statuses", $action = "delete");
        $data->delete();
        return back()->with('success', 'Successful delete');
    }
}
