<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\PriceItemGroupDetail;
use App\Model\PriceItemGroup;
use App\Model\PriceItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

use App\Helpers\GenerateCodeNo;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\StorePostRequest;
class Price_itemgroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data['appbooks']=\App\Model\PriceItemGroup::orderByDesc('created_at')->get();
        return view('admin.Price-item-group.Price-item-group',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $data['appbooks'] = PriceItemGroup::get();
        
        return view('admin.Price-item-group.create',$data);
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
       
      'group_code' => 'required',
            'group_name' => 'required',
            
            'group_name_en' => 'required',

        ]);
        
         $pricelist = new PriceItemGroup();
            $pricelist ->group_code = request('group_code');
        $pricelist ->group_name = request('group_name');
         $pricelist ->group_name_en = request('group_name_en');
            $pricelist ->group_note = request('group_note');
        $pricelist ->status = request('status');
    $pricelist -> save();
                 foreach ($request->price_item_id as $key => $value) {
                 $pl_detail = new PriceItemGroupDetail();
                
                
               
               
                 
               
                $pl_detail->price_item_id = $request['price_item_id'][$key];

                $pl_detail->item_group_id = $pricelist->id;
                    // dd($pl_detail);
                $pl_detail->save();
                 
             }
      
   return redirect('admin/Price-item-group')->with('success','Successful Price List Item Group Added.'); 
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
        
       
       
  $data['datas'] = PriceItemGroup::find($id);
        return view('admin.Price-item-group.edit',$data);
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
         $request->validate([
       
      
        ]);
        $pricelist =PriceItemGroup::find($id);
 $pricelist ->group_code = request('group_code');
        $pricelist ->group_name = request('group_name');
         $pricelist ->group_name_en = request('group_name_en');
            $pricelist ->group_note = request('group_note');
        $pricelist ->status = request('status');
    $pricelist -> save();
     \DB::table('price_item_group_details')->where('item_group_id',$id)->delete();
                 foreach ($request->price_item_id as $key => $value) {
                 $pl_detail = new PriceItemGroupDetail();
                
                $pl_detail->price_item_id = $request['price_item_id'][$key];

                $pl_detail->item_group_id = $pricelist->id;
                    // dd($pl_detail);
                $pl_detail->save();
                 
             }
   return redirect('admin/Price-item-group')->with('success','Successful Price Iist Group Update.'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
    {
    $data =PriceItemGroup::find($id);
        \LogActivity::saveToLog($data,$tb_name="Olddocument_Categorys",$action="delete");
     $data->delete();
        return redirect('admin/Price-item-group')->with('success','Successful Delete.'); 
    }
}
