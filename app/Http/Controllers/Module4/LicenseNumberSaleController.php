<?php

namespace App\Http\Controllers\Module4;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\LicenseNoSale;
use Illuminate\Validation\Rule;
class LicenseNumberSaleController extends Controller
{
    private $alert;
    function __construct()
    {   
        $this->middleware('permission:License-Number-Sale-List-View');
         $this->middleware('permission:License-Number-Sale-Create', ['only' => ['store']]);
         $this->middleware('permission:License-Number-Sale-Edit', ['only' => ['update']]);
         $this->middleware('permission:License-Number-Sale-Delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $license_sales = LicenseNoSale::LicenseSaleList();
        return view('Module4.LicenseNumberSale.index', compact('license_sales'));
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
    public function getNumber()
    {
        $lic_sale = LicenseNoSale::whereProvinceCode(request('province'))->where('id', '!=', request('id'))->pluck('license_no_sale_number');
        $lic_not_sale = \App\Model\LicenseNoNotSale::whereProvinceCodeAndLicenseNoNotSaleNumber(request('province'), request('licNo'))->pluck('license_no_not_sale_number');
        return response()->json([
            'lic_sale' =>  $lic_sale,
            'lic_not_sale' => $lic_not_sale
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
        $this->validate($request,[
            'price_item_id'=> 'required',
            'license_no_sale_number' => 'required',
            'province_code' =>  Rule::unique('license_no_sales')->where(function ($query) use ($request) {
                return $query->where('license_no_sale_number', $request->license_no_sale_number);
            }),
        ]);
       
        LicenseNoSale::create(request()->only('price_item_id', 'license_no_sale_number', 'province_code', 'status'));
        return back()->with('success', trans('module4.add_license_sale'));
        
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
        $this->validate($request,[
            'price_item_id'=> 'required',
            'province_code' => 'required',
            'license_no_sale_number' => ['required',
                Rule::unique('license_no_sales')->where(function ($query) use ($request) {
                    return $query->where('province_code', $request->province_code);
                })->ignore($id)
            ]
        ]);
        $license_sale = LicenseNoSale::find($id);
        $license_sale->update($request->all());
        return back()->with('success', trans('module4.add_license_sale'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        LicenseNoSale::destroy($id);
        return back()->with('success', 'Delete license No. sale.');
    }

    public function getUnitPrice(Request $request, $price_item_id)
    {
        $unit_price = \App\Model\PriceItemUnitPrice::whereProvinceCodeAndPriceItemId($request->province, $price_item_id)->sum('unit_price');
        return response()->json($unit_price);
    }
}
