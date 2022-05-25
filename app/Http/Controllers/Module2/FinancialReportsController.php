<?php

namespace App\Http\Controllers\Module2;

use App\Http\Controllers\Controller;
use App\Model\PriceListDetail;
use App\Model\PriceList;
use App\Model\PriceItem;
use App\User;
use App\Model\MoneyUnit;
use App\Http\Requests\StorePostRequest;
use App\Model\CounterMatching;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Session;
use Maatwebsite\Excel\Facades\Excel;
class FinancialReportsController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:Daily-Reports-All', ['only' => ['index']]);
        $this->middleware('permission:Summary-Report', ['only' => ['SummaryReport']]);
    }

    //daily report page
    public function index()
    {
        $pricedetail = array();
        $fine_percent = null;
        return view('ManageFinicialReports.daily_reports', compact('pricedetail', 'fine_percent'));
    }

    public function create()
    {
    }

   

    //search result dailyreport page
    public function store(Request $request)
    {
        session()->put(['from1' => $request->from, 'to1' => $request->to,  'province_code1' => $request->province_code, 'counter_id'=>$request->counter_id]);
        $from = \App\Helpers\DateHelper::getMySQLDateFromUIDate(request()->from);
        $to = \App\Helpers\DateHelper::getMySQLDateFromUIDate(request()->to);
        if(request()->to <  request()->from){
            return back()->with('error', 'To date must be greater than from date.');
        }
        $data['pricedetail'] = PriceListDetail::whereHas('PriceList', function($q) use ($from,$to){
            $q->where([['service_counter_id', request('counter_id')], ['reciept_status', 'printed']])->whereBetween(DB::raw('DATE(date)'), [$from, $to]);  
            })->where('province_code', request()->province_code)
            ->select('item_code', 'item_name', 'price', 'item_name_en', 'fine_percent', DB::raw("SUM(quantity) as total_qty"), DB::raw("SUM(sub_total) as sub_total"))
            ->groupBy('item_code', 'fine_percent')
            ->get();
        
        $data['fine_percent'] = DB::table('price_list_details')
        ->join('price_lists', 'price_list_details.price_list_id','=','price_lists.id')
        ->select(['fine_percent', 'sub_total', DB::raw('round((fine_percent/100)*sub_total,4) as percentage')])
        ->where([['price_list_details.province_code', '=', request()->province_code], ['price_lists.service_counter_id','=', request()->counter_id], ['price_lists.reciept_status', 'printed']])
        ->whereBetween(DB::raw('DATE(price_lists.date)'), [$from, $to])
        ->get();
        $data['from_date'] = $from;
        $data['to_date'] = $to;
        if( $request->type != "excel"){
            return view('ManageFinicialReports.daily_reports', $data);
        } else {
            return Excel::download(new \App\Exports\DailyReportExport($data), 'daily_report.xlsx');
        }
        
    }
    
    //summary report page
    public function SummaryReport()
    {
        $price_list = PriceList::whereDate('created_at', \Carbon\Carbon::today());
        return view('ManageFinicialReports.summary_reports', compact('price_list'));
    }

    //search result summary report 
    public function SummarySearch(Request $request)
    {
        session()->put(['from' => $request->from, 'to' => $request->to, 'counter_id'=> $request->counter_id]);
        
        $from = \App\Helpers\DateHelper::getMySQLDateFromUIDate($request->from);
        $to = \App\Helpers\DateHelper::getMySQLDateFromUIDate($request->to);

        if($request->to <  $request->from){
            return back()->with('error', 'To date must be greater than from date.');
        }

        $price_list = PriceList::whereServiceCounterIdAndRecieptStatus($request->counter_id, 'printed')->whereBetween(DB::raw('DATE(date)'), [$from, $to])->get();
        $staff_name = CounterMatching::with('user:id,first_name,last_name')->whereServiceCounterId($request->counter_id)->first();
       
        if( $request->type != "excel"){
            return view('ManageFinicialReports.summary_reports', compact('price_list'));
        }else {
            return Excel::download(new \App\Exports\SummaryReportExport($price_list, $from, $to, $staff_name), 'summary_report.xlsx');
        }
        
    }

  
}
