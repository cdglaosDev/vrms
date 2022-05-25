<?php

namespace App\Http\Controllers\Module2;
use App\Http\Controllers\Controller;
use App\Model\PriceItem;
use App\Model\PriceItemUnitPrice;
use App\Model\Province;
use App\Model\MoneyUnit;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use Validator;
use App\Helpers\Helper;
use App\Model\PriceItemMapping;

class ManagementPriceItem extends Controller
{
    
     function __construct()
    {
         $this->middleware('permission:Price-Item-List-View');
         $this->middleware('permission:Price-Item-List-Create', ['only' => ['create', 'store']]);
         $this->middleware('permission:Price-Item-Entry-Edit', ['only' => ['edit', 'update']]);
         $this->middleware('permission:Price-Item-Entry-Delete', ['only' => ['destroy']]);
       
    }

    public function index()
    {
       
        $price_item = PriceItem::orderByDesc('created_at')->get();
        return view('module2.ManagePriceItem.index', compact('price_item'));
    }

    //create priceItem form
    public function create()
    {
        $price_item = PriceItem::all();
        return view('module2.ManagePriceItem.create', compact('price_item'));
    }

    //Save record priceItem into database
    public function store()
    {
        $code = str_replace(',', '.', request('code'));
     
        $data = request() -> validate([
                    'code' => 'required|unique:price_items',
                    'name' => 'required',
                    'name_en' => 'required',
                    'description' => '',
                    'status' => 'required',
                    'show_hide' => 'required',
                ]);
        PriceItem::create([
            'code' => $code,
            'name' =>  request('name'),
            'name_en' => request('name_en'),
            'description' => request('description'),
            'status' =>  request('status'),
            'show_hide' => request('show_hide'),
            'vehicle_type_group_id' => request('vehicle_type_group_id'),
            'license_sale' => request('license_sale')
        ]);

        return redirect('price-item')->with('success','Successful Created.');
    }

    //detail priceItem
    public function show(PriceItem $price_item)
    {
        return view('module2.ManagePriceItem.show', compact('price_item'));
    }

    //edit priceItem
    public function edit(PriceItem $price_item)
    {
        return view('module2.ManagePriceItem.edit', compact('price_item'));
    }
    
    //update priceItem
    public function update(PriceItem $price_item)
    {
        $this->validate(request(),[
            'code' => 'required',
            'name' => 'required',
            'name_en' => 'required',
            'status' => 'required',
            'show_hide' => 'required',
            'vehicle_type_group_id'=> 'required',
                 
        ]);
        $item = request()->all();
        $item['code'] = str_replace(',', '.', $item['code']);
        $data = PriceItem::find($price_item -> id);
        \LogActivity::saveToLog($data,$tb_name = "price_items", $action = "update");
        $price_item -> update($item);
        return redirect('price-item')->with('success', 'Successful updated.');
    }

    //delete priceItem
    public function destroy(PriceItem $price_item)
    {
        $data = PriceItem::find($price_item -> id);
        \LogActivity::saveToLog($data,$tb_name = "price_items", $action = "delete");
        $price_item -> delete();
        return redirect('price-item') -> with('success', 'Successful deleted.');
    }

    private function validateRequest()
    {
        return request() -> validate([
            'code' => 'required',
            'name' => 'required',
            'name_en' => 'required',
            'description' => '',
            'status' => 'required',
            'show_hide' => 'required',
            'vehicle_type_group_id'=> 'required',
            'license_sale' =>''
           
        ]);
    }
    
    //add unitprice for each item
    public function CreateUnitPrice(PriceItem $priceitem)
    {
        $unitprice = PriceItemUnitPrice::wherePriceItemIdAndProvinceCode($priceitem->id, Helper::current_province())->get();
        $currency = MoneyUnit::whereStatus(1)->get();
        if(auth()->user()->roles->pluck('name')[0] == "Super Admin"){
        $price_province = Province::whereStatus(1)->get();
        }else{
        $price_province = Province::whereStatusAndProvinceCode(1, Helper::current_province())->get();
        }
        return view('module2.ManagePriceItem.item_price', compact('unitprice', 'price_province', 'currency', 'priceitem'));
    }

    //store unitprice data into database
    public function StoreUnitPrice(Request $request)
    {
       
        $unit_price = PriceItemUnitPrice::whereProvinceCodeAndPriceItemId($request->province_code[0],$request->price_item_id[0])->get();
       
        if ($unit_price->isNotEmpty()) {
            return back()->with('error', 'Price Item Unit Price already defined at this province.');
        }
        if (count($request->province_code) > 0) {
            foreach ($request ->province_code as $code => $value) {   
                $unitprice = array(
                    'price_item_id' => $request ->price_item_id[$code],
                    'province_code' => $request ->province_code[$code],
                    'unit_price' => $request ->unit_price[$code],
                    'fine_percent' => $request ->fine_percent[$code],
                    'money_unit_id' => $request ->money_unit_id[$code],
                    'status' => "1",
                );
                PriceItemUnitPrice::insert($unitprice);
            }
        }

        return redirect()->back()->with('success', 'Successful inserted.');
    }
    
    //Delete Unit price record in Price item detail page
    public function DestoryUnitPrice(PriceItemUnitPrice $unitprice)
    {
        $data = PriceItemUnitPrice::find($unitprice -> id);
        \LogActivity::saveToLog($data,$tb_name = "price_item_unit_prices", $action = "delete");
        $unitprice -> delete();
        return redirect()->back() -> with('success', 'Successful deleted.');
    }

    public function updateUnitPrice($id)
    {
       PriceItemUnitPrice::whereId($id)->update([
           'province_code' => Helper::current_province(),
           'unit_price' => request('unit_price'),
           'fine_percent' => request('fine_percent'),
           'money_unit_id'=> request('money_unit_id')
       ]);
       return back()->with('success', 'Successful updated.');
    }
      
}
