<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\PriceListDisplay;
use App\Model\PriceListDisplaySetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use DateTime;
use DateTimeZone;

class PriceListDisplayScreenController extends Controller
{
    function __construct()
        {   
            $this->middleware('permission:Display-On-Screen', ['only' => ['DisplayScreen']]);
            $this->middleware('permission:Manage-Display-Screen', ['only' => ['ManageScreenDisplay']]);
        }
    
  

 //Screen Display  for finance module page
 public function PriceListDisplayScreen(Request $request)
 {
     /*
     $dt_now = new \DateTime('NOW');
     $time_zone = new DateTimeZone('Asia/Vientiane'); 
     $dt_now->setTimezone($time_zone);
     $time = \Carbon\Carbon::parse($dt_now)->format("d M Y, H:i"); 
     $dep_url_id = $request->route('id');
     */

    $display_setting = PriceListDisplaySetting::get();
    $display_screen = PriceListDisplay::where('province_code', $request->pcode)->where('counter_id', $request->cid)->get(); 
  
    //$display_setting = PriceListDisplaySetting::where('province_code', $request->pcode)->where('counter_id', $request->cid)->get();
     //$display_screen = PriceListDisplay::get();
     //$latest_display = PriceListDisplay::where('department_id', $dep_url_id)->orderBy('time_call','desc')->pluck('time_call')->first();
   //dd($display_setting);
     return view('Display.price_list_display', compact('display_screen', 'display_setting'));
 }




    //Manage screen display lists Page
    public function ManageScreenDisplay()
    {
        $display_screen = Display::all();
        return view('Display.manage_screen_display', compact('display_screen'));
    }

   //delete from screen display list
    public function destroy(Display $display_screen)
    {
        $display_screen -> delete();
        return response()->json($display_screen);
    }
}
