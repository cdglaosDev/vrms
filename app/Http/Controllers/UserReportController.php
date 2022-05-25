<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\AppForm;
use App\User;
use DB;

class UserReportController extends Controller
{
    function __construct()
    {   
        $this->middleware('permission:Report-All|User-Reports');
        $this->middleware('permission:User-Reports');
    }

    public function index()
    {
        $value = array();
        return view('ReportsAndStatic.user_report')->with([
            "value" => $value,
        ]);
    }

    public function UserReportSearch(Request $request)
    {
        session()->put(['user_name' => $request->user_name, 'date' => $request->date]);
        $date = Carbon::parse($request->date)->format('Y-m-d');
        $user_id = User::find($request->user_name);
        $vehicle_reg_count = $user_id->app_form()->whereDate(DB::raw('DATE(created_at)'), '=', $date)->count();
        $import_count = $user_id->pre_app_form()->whereDate(DB::raw('DATE(created_at)'), '=', $date)->count();
        $finance_record_count = $user_id->price_lists_payee()->where('status', "=", '1')->whereDate(DB::raw('DATE(created_at)'),'=',$date)->count();
        $vehicle_pass_count = $user_id->passports()->whereDate(DB::raw('DATE(created_at)'), '=', $date)->count();
        $task = ['Vehicle Registration', 'Vehicle Import', 'Finicial Record', 'Vehicle Passport Book'];
        $vehicle_reg_count = [$vehicle_reg_count, $import_count, $finance_record_count, $vehicle_pass_count];
        $value = array();
        foreach ($task as $task_key => $task_value) {
            $value[$task_key] = ['task' => $task_value , 'count' => $vehicle_reg_count];
        }
        return view('ReportsAndStatic.user_report')->with([
            "value" => $value,
        ]);
      
    }
}
