<?php

namespace App\Http\Controllers\Module2;
use App\Http\Controllers\Controller;
use App\Model\PriceListDetail;
use App\Model\PriceList;
use App\Model\PriceItem;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;

class ManagementPriceListDetail extends Controller
{
    public function index()
    {
        $pricelistdetail = PriceListDetail::whereStatus(1)->orderByDesc('created_at')->get();
        return view('ManagementPriceListDetail.index', compact('pricelistdetail'));
    }

    public function create()
    {
        $pricelist = PriceList::all();
        $priceitem = PriceItem::all();
        $pricelistdetail = PriceListDetail::all();
        return view('ManagementPriceListDetail.create', compact('pricelist','priceitem','pricelistdetail'));
    }

    public function store()
    {
        $data = request() -> validate([
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'total' => 'required|numeric',
            'status' => 'required',
            'price_item_id' => 'required',
            'price_list_id' => 'required',
        ]);

        $id = auth()->user()->id;
        $pricelistdetail = new PriceListDetail();
        $pricelistdetail -> quantity = request('quantity');
        $pricelistdetail -> price = request('price');
        $pricelistdetail -> total = request('total');
        $pricelistdetail -> status = request('status');
        $pricelistdetail -> price_item_id = request('price_item_id');
        $pricelistdetail -> price_list_id = request('price_list_id');
        $pricelistdetail -> user_id = $id;
        $pricelistdetail -> save();

        return redirect('pricelistdetail')->with('success', 'Successful Created');
    }

    public function show(PriceListDetail $pricelistdetail)
    {
        return view('ManagementPriceListDetail.show', compact('pricelistdetail'));
    }

    public function edit(PriceListDetail $pricelistdetail)
    {
        $pricelist = PriceList::all();
        $priceitem = PriceItem::all();
        return view('ManagementPriceListDetail.edit', compact('pricelist','priceitem','pricelistdetail'));
    }

    public function update(PriceListDetail $pricelistdetail)
    {
        $pricelistdetail -> update($this -> validateRequest());
        $data = PriceListDetail::find($pricelistdetail -> id);
        \LogActivity::saveToLog($data, $tb_name = "price_list_details",$action = "update");
        return redirect('pricelistdetail')->with('success', 'Successful Updated');
    }

    public function destroy(PriceListDetail $pricelistdetail)
    {
        $data = PriceListDetail::find($pricelistdetail -> id);
        \LogActivity::saveToLog($data, $tb_name = "price_list_details", $action = "delete");
        $pricelistdetail -> delete();
        return redirect('pricelistdetail')->with('success', 'Successful Deleted');
    }

    public function delete($id)
    {
        $data = PriceListDetail::find($id);
        $data->delete();
        return back();
    }

    protected function validateRequest()
    {
         return request() -> validate([
                'quantity' => 'required|numeric',
                'price' => 'required|numeric',
                'total' => 'required|numeric',
                'status' => 'required',
                'price_item_id' => 'required',
                'price_list_id' => 'required',
            ]);
    }

    public function priceListDetail($id)
    {
        $pricelist = \App\Model\PriceList::findOrFail($id);
        return view('ManagementPriceList.detail', compact('pricelist'));
        
    }

    public function printReceipt($id){
        dd($id);
    }
}
