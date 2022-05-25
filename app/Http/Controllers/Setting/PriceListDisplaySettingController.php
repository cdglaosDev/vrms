<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\PriceListDisplaySetting;
use App\Model\PriceListDisplay;
class PriceListDisplaySettingController extends Controller
{
    function __construct()
    {    
       
        $this->middleware('permission:Display-Setting-All|Display-Setting-List-View|Display-Setting-Create|Display-Setting-Edit|Display-Setting-Delete|Smart-Card-Setting');
        $this->middleware('permission:Display-Setting-List-View');
        $this->middleware('permission:Display-Setting-Create', ['only' => ['store']]);
        $this->middleware('permission:Display-Setting-Edit', ['only' => ['update']]);
        $this->middleware('permission:Display-Setting-Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Smart-Card-Setting', ['only' => ['smartCardSetting']]);
    }

    public function priceListDisplaySetting()
    {
        $data = PriceListDisplaySetting::first();
       // dd($data);
      
        return view('DisplaySetting.price-list-display-setting', compact('data'));
    }
   

    public function uploadPriceListDisplaySetting(Request $request)
    { 
      
        $this->validate($request, [
            'logo1' => 'mimes:png|max:10000',
            'logo2' =>'mimes:png|max:10000',
        ],[
            'logo1.mimes' => 'Only png images are allowed.',
            'logo2.mimes' => 'Only png images are allowed.',
        ]);
        $display_setting = PriceListDisplaySetting::whereId(request('id'))->first();
        if ($file1 = $request->file('logo1')) {
            $path1 =$file1->getRealPath();
            $logo1 = file_get_contents($path1);
            $base64_logo1 = base64_encode($logo1);
            $display_setting->logo1 = $base64_logo1;
        }
        if ($file2 = $request->file('logo2')) {
            $path2 = $file2->getRealPath();
            $logo2 = file_get_contents($path2);
            $base64_logo2 = base64_encode($logo2);
            $display_setting->logo2 = $base64_logo2;
        }

        if ($file3 = $request->file('adv1')) {
            $path3 =$file3->getRealPath();
            $adv3 = file_get_contents($path3);
            $base64_adv3 = base64_encode($adv3);
            $display_setting->adv1 = $base64_adv3;
        }
        if ($file4 = $request->file('adv2')) {
            $path4 = $file4->getRealPath();
            $adv4 = file_get_contents($path4);
            $base64_adv4 = base64_encode($adv4);
            $display_setting->adv2 = $base64_adv4;
        }

           
            $display_setting->text1 = request('text1');
            $display_setting->text2 = request('text2');
            $display_setting->text3 = request('text3');
            $display_setting->save();
            return back()->with('success', 'Updated price list display setting.');
    }

      
    

    public function savePriceListDisplay(Request $request)
    { 

       // return $request->item_price[0] . "-" . $request->item_price[1];
      
        $province_code = \App\Helpers\Helper::current_province();
        $item_code = $request->item_code;
        $item_name = $request->item_name;
        $item_price = $request->item_price;

        $payer = $request->payer;
        $counter_id = $request->counter_id;

        //return (count($item_code));

        //$price_list_display = PriceListDisplay::whereId($counter_id)->first();
        
        $price_list_display = PriceListDisplay::where('counter_id',$counter_id)->where('province_code',$province_code);
        $price_list_display->delete();
        //$price_list_display = new PriceListDisplay();
        $price_list = array();
        for($i=0; $i < count($item_code); $i++){
            $price_list["counter_id"] = $counter_id;
            $price_list["province_code"] = $province_code;
            $price_list["payer"] = $payer;            
            $price_list["item_code"] = $item_code[$i];
            $price_list["item_name"] = $item_name[$i];
            //$price_list["item_price"] = $item_price[$i];
            $price_list["item_price"] = (int) str_replace(',', '',$item_price[$i]);
            //CounterMatching::create($price_list_display);
           // $price_list_display->save();
           PriceListDisplay::create($price_list);           
        }

        return json_encode("ok");

            //return back()->with('success', 'Updated price list display setting.');
    }

  
}
