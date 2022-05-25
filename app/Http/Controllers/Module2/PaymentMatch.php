<?php

namespace App\Http\Controllers\Module2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AppPurpose;
use App\Model\PriceItemMapping;
class PaymentMatch extends Controller
{
    function __construct()
    {   
        $this->middleware('permission:Match-Payment-All|Match-Payment-List-View|Match-Payment-Edit');
        $this->middleware('permission:Match-Payment-List-View');
        $this->middleware('permission:Match-Payment-Edit', ['only' => ['edit', 'update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $app_purpose = AppPurpose::whereStatus(1)->get();
        return view('module2.PaymentMatch.index', compact('app_purpose'));
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
        $app_purpose = AppPurpose::find($id);
        $price_item = \App\Model\PriceItem::whereStatus(1)->get();
        $item_mapping = \App\Model\PriceItemMapping::whereAppPurposeId($id)->pluck('price_item_id')->toArray();
        return view('module2.PaymentMatch.edit', compact('app_purpose', 'price_item', 'item_mapping'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeMatchPayment(Request $request)
    {
        $this->validate($request,[
            'price_item_id' => 'required',
            'app_purpose_id' => 'required',
          ]);
        PriceItemMapping::whereAppPurposeId(request('app_purpose_id'))->delete();
        foreach(request('price_item_id') as $key => $value)
            {   
                $payment_match = array(
                    'app_purpose_id' => $request->app_purpose_id,
                    'price_item_id' => $value
                );
                PriceItemMapping::insert($payment_match);
            }
        
        return redirect()->route('match-payments.index')->with('success', 'Successful Match Payment!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
