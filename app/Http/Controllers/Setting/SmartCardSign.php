<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CardSign;
class SmartCardSign extends Controller
{
    function __construct()
    {    
       
        $this->middleware('permission:Smart-Card-Logo-Sign', ['only' => ['smartCard']]);
    }

    public function smartCard()
    {
        $data = CardSign::first();
      
        return view('DisplaySetting.card-sign', compact('data'));
    }
   

    public function uploadsmartCard(Request $request)
    { 
      
        $this->validate($request, [
            'logo' => 'mimes:png|max:1000',
            'sign' =>'mimes:png|max:1000',
        ],[
            'logo.mimes' => 'Only png images are allowed.',
            'sign.mimes' => 'Only png images are allowed.',
        ]);
        $card_sign = CardSign::whereId(request('id'))->first();
        if ($file1 = $request->file('logo')) {
            $path =$file1->getRealPath();
            $logo = file_get_contents($path);
            $base64_logo = base64_encode($logo);
            $card_sign->logo = $base64_logo;
        }
        if ($files = $request->file('sign')) {
            $path1 = $files->getRealPath();
            $logo1 = file_get_contents($path1);
            $base64_sign = base64_encode($logo1);
            $card_sign->sign = $base64_sign;
        }
           
            $card_sign->dept_name = request('dept_name');
            $card_sign->officer_name = request('officer_name');
            $card_sign->save();
            return back()->with('success', 'Updated smart card.');
    }

        

  
}
