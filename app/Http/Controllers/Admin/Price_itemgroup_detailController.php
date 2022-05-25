<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\PriceItemGroupDetail;
use App\Model\Country;

class Price_itemgroup_detailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    $data['groupitems']=\App\Model\PriceItemGroupDetail::orderByDesc('created_at')->get();

   
        $data['priceitem'] =\App\Model\PriceItem::whereStatus(1)->pluck('id','name');
        $data['priceitemgroup'] =\App\Model\PriceItemGroup::whereStatus(1)->pluck('id','group_name');
        return view("admin.Price_Item_Group_Detail.price_item_group_detail",$data);


        
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
        
           $request->validate([
        
        
        
       ]); 
        PriceItemGroupDetail::create($request->all());
     return redirect('admin/price_itemgroup_detail')->with('success','Successful Price Item Group Detail  Added.'); 
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
     
        
        
     
        $province= PriceItemGroupDetail::find($id);
         \LogActivity::saveToLog($province,$tb_name="Price_ItemGroupDetails",$action="update");
          $province->update($request->all());
     return redirect('admin/price_itemgroup_detail')->with('success','Successful Price Item Group Detail Update.'); 
    }
       
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data =PriceItemGroupDetail::find($id);
        \LogActivity::saveToLog($data,$tb_name="Price_Item_Group_Details",$action="delete");
     $data->delete();
        return redirect('admin/price_itemgroup_detail')->with('success','Successful Delete.'); 
    }
}
