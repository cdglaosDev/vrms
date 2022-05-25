<?php

namespace App\Http\Controllers\Module4;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\LicenseNoNotSale;
use Illuminate\Validation\Rule;
class LicenseNumberNotSaleController extends Controller
{
    function __construct()
    {   
        $this->middleware('permission:License-Number-Not-Sale-List-View');
         $this->middleware('permission:License-Number-Not-Sale-Create', ['only' => ['store']]);
         $this->middleware('permission:License-Number-Not-Sale-Edit', ['only' => ['update']]);
         $this->middleware('permission:License-Number-Not-Sale-Delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->user_level == "admin") {
            $license_not_sales = LicenseNoNotSale::orderByDesc('status')->get();
        } else {
            $license_not_sales = LicenseNoNotSale::whereProvinceCode(\App\Helpers\Helper::current_province())->orderByDesc('status')->get();
        }
       
        return view('Module4.LicenseNumberNotSale.index', compact('license_not_sales'));
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
    // get number by province
    public function getNumber()
    {
        $license_not_sale = LicenseNoNotSale::whereProvinceCode(request('province'))->where('id', '!=', request('id'))->pluck('license_no_not_sale_number');
        $data = [];
        $lic_bookings = \App\Model\LicenseNoBooking::whereDate('expire_date', '>=', '2021-05-07')->whereProvinceCode(request('province'))->pluck('license_no_book_number')->toArray();
        foreach ($lic_bookings as $booking) {
            $data[] = preg_replace('/[^0-9]/', '', $booking);
        }
       return response()->json([
           'license_not_sale' =>$license_not_sale,
           'license_booking' => $data
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
            'license_no_not_sale_number' => ['required',
                Rule::unique('license_no_not_sales')->where(function ($query) use ($request) {
                    return $query->where('province_code', $request->province_code);
                })
            ]
        ]);
        LicenseNoNotSale::create(request()->only('license_no_not_sale_number', 'status', 'province_code'));
        return back()->with('success', 'Added license No. not sale.');
    }

    //if added number end with 27, 67 in license sale and booking form
    public function saveFromOtherForm()
    {
        if (! \App\Model\LicenseNoNotSale::whereLicenseNoNotSaleNumberAndProvinceCode(request('licNo'), request('province_code'))->exists()) {
            LicenseNoNotSale::create([
                'license_no_not_sale_number'=>request('licNo'),
                'province_code'=>request('province_code'),
                'status' =>1
            ]);
            return response()->json([
                'status' => 'ok'
            ]);
         } 
       
       
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
            'license_no_not_sale_number' => ['required',
                Rule::unique('license_no_not_sales')->where(function ($query) use ($request) {
                    return $query->where('province_code', $request->province_code);
                })->ignore($id)
            ]
        ]);
        
        $license_not_sale = LicenseNoNotSale::find($id);
        \LogActivity::saveToLog($license_not_sale, $tb_name = "license_no_not_sales", $action = "update"); 
        $license_not_sale->update($request->all());
        return back()->with('success', 'Updated license No. not sale.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        LicenseNoNotSale::destroy($id);
        return back()->with('success', 'Delete license No. not sale.');
    }

    
}
