<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class Dashboard extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function customer()
	{
		
    	$data['staff'] = \App\Model\Staff::whereCreateBy(auth()->user()->id)->latest()->limit(5)->get();
    	$data['company'] =\App\Model\Company::where('user_id',auth()->user()->id)->latest()->limit(6)->get();
		$data['app'] = Auth::user()->pre_app_form()->get();
		$data['in_progress'] = Auth::user()->pre_app_form()->where('app_status_id','3')->get();
		$data['approve'] = Auth::user()->pre_app_form()->where('app_status_id','4')->get();
		$data['reject'] = Auth::user()->pre_app_form()->where('app_status_id','5')->get();
		$data['latest_app'] = \App\Model\PreRegisterApp::where('user_id',auth()->user()->id)->orderByDesc('created_at')->limit(5)->get();
		
        return view('customer.dashboard', $data);
    }

   
}
