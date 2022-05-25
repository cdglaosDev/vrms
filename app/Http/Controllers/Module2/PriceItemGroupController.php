<?php

namespace App\Http\Controllers\Module2;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\PriceItemGroup;
use App\Model\PriceListGroupDetail;

class PriceItemGroupController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:Price-Group-List-View');
         $this->middleware('permission:Price-Group-List-Create', ['only' => ['create', 'store']]);
         $this->middleware('permission:Price-Group-Entry-Edit', ['only' => ['edit', 'update']]);
         $this->middleware('permission:Price-Group-Entry-Delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['price_item_group'] = PriceItemGroup::whereStatus(1)->get();
        return view('module2.PriceItemGroup.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['price_item'] = \App\Model\PriceItem::whereStatus(1)->get();
       
        return view('module2.PriceItemGroup.create', $data);
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
            'group_code' => 'required|unique:price_item_groups,group_code',
            'group_name' => 'required',
            'group_name_en' =>"required",
            'price_item_id' =>"required|array|min:1",
        ], 
        [
            'price_item_id.required' => 'Price Item is required.'
            
        ]);

        $data =$request->all();
        $group = PriceItemGroup::create($data);
        foreach ($request->price_item_id as $key => $value) {
            $group_detail = new \App\Model\PriceItemGroupDetail();
            $group_detail->item_group_id =$group->id;
            $group_detail->price_item_id = $request['price_item_id'][$key];
            $group_detail->save();
            
        }
        return redirect()->route('items-group.index')->with('success', 'Price Item group created successfully');
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
       
        $data['priceitemIds'] = [];
        $data['item_group'] = PriceItemGroup::find($id);
        $data['price_item'] = \App\Model\PriceItem::whereStatus(1)->get();
        foreach ($data['item_group']->group_details as $priceItem) {
            $data['priceitemIds'][] = $priceItem->price_item_id;
        } 
        return view('module2.PriceItemGroup.create', $data);
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
            'group_code' => 'required|unique:price_item_groups,group_code,'.$id,
            'group_name' => 'required',
            'group_name_en' => "required",
            'price_item_id' => "required|array|min:1",
        ], 
        [
            'price_item_id.required' => 'Price Item is required.'
            
        ]);

        $data = PriceItemGroup::find($id);
        $data->group_code = $request->group_code;
        $data->group_name = $request->group_name;
        $data->group_name_en = $request->group_name_en;
        $data->save();
      
       foreach ($request->price_item_id as $key => $value) {
            $group_detail = new \App\Model\PriceItemGroupDetail();
            $group_detail->item_group_id = $data->id;
            $group_detail->price_item_id = $request['price_item_id'][$key];
            $group_detail->save();
        }
        return redirect()->route('items-group.index')->with('success', 'Price Item group update successfully');
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = PriceItemGroup::find($id);
        \LogActivity::saveToLog($data, $tb_name = "price_item_groups", $action = "delete");
        $data -> delete();
        return redirect('price-items-group')->with('success', 'Successful Deleted');
    }
}
