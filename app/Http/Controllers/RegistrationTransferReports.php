<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Session;
use App\Http\Requests\StorePostRequest;
use App\Model\Province;
use App\Model\AppForm;
use App\User;
use App\Exports\RegistrationReport;
use Maatwebsite\Excel\Facades\Excel;
class RegistrationTransferReports extends Controller
{
    function __construct()
    {   
        $this->middleware('permission:Report-All|Registration-Reports|Pre-Registration-Reports|Transfer-Change-Info-Reports|Printing-Passport-Reports');
        $this->middleware('permission:Registration-Reports', ['only' => ['index']]);
        $this->middleware('permission:Pre-Registration-Reports', ['only' => ['PreRegReport']]);
        $this->middleware('permission:Transfer-Change-Info-Reports', ['only' => ['TranChangeReport']]);
        $this->middleware('permission:Printing-Passport-Reports', ['only' => ['PrintPassportReport']]);
    }
    
     //============================= Registration Report for module4 ==============================
    public function index()
    {
        $registration_report = array();
        return view('ReportsAndStatic.registration_report', compact('registration_report'));
    }


    public function RegistrationReportSearch(Request $request)
    {
        session()->put(['reg_from' => $request->from, 'reg_to' => $request->to,'reg_type'=>$request->type, 'reg_province'=>$request->province]);
        $date_from = \App\Helpers\DateHelper::getMySQLDateFromUIDate(request()->from);
        $date_to = \App\Helpers\DateHelper::getMySQLDateFromUIDate(request()->to);       
        $month = Carbon::parse($request->month)->today() -> submonth(1)->toDateTimeString();
        $year = Carbon::parse($request->year)->today() -> subyear(1)->toDateTimeString();

        $province = Province::find($request->province);
        $user_info = $province->user_infos;
        $report = array();
        $registration_report = array();
        foreach ($user_info as $value) {
            if ($request->type == "month") {
                $report[] = $value->users->app_form()->whereDate(DB::raw('DATE(created_at)'),'>=',$month)->whereAppFormStatus_id(7)->get();
            } else if ($request->type == "year") {
                $report[] = $value->users->app_form()->whereDate(DB::raw('DATE(created_at)'),'>=',$year)->whereAppFormStatus_id(7)->get();
            } else {
                $report[] = $value->users->app_form()->whereBetween(DB::raw('DATE(created_at)'),array($date_from, $date_to))->whereAppFormStatus_id(7)->get();
            }
        
            foreach ($report as $reportkey => $reportvalue) {
                foreach ($reportvalue as $registrationkey => $registrationvalue) {
                    $registration_report[$reportkey][$registrationkey] = $registrationvalue;
                }
            }
        }
     
        return view('ReportsAndStatic.registration_report', compact('registration_report'));

    }

    //============================= Pre Registration report for module5 ==============================
    public function PreRegReport()
    {
        $pre_reg_report = array();
        return view('ReportsAndStatic.pre_registration_report', compact('pre_reg_report'));
    }

    public function PreRegReportSearch(Request $request)
    {
        session()->put(['pre_from' => $request->from, 'pre_to' => $request->to,'pre_type'=>$request->type, 'pre_province'=>$request->province]);
        $date_from =  \App\Helpers\DateHelper::getMySQLDateFromUIDate(request()->from);
        $date_to = \App\Helpers\DateHelper::getMySQLDateFromUIDate(request()->to);
        $month = Carbon::parse($request->month)->today() -> submonth(1)->toDateTimeString();
        $year = Carbon::parse($request->year)->today() -> subyear(1)->toDateTimeString();
       
        $province = Province::find($request->province);
        $user_info = $province->user_infos;
        $report = array();
        $pre_reg_report = array();
        foreach ($user_info as $value) {
            $report[] = $value->users->pre_app_form()->whereBetween(DB::raw('DATE(created_at)'), array($date_from, $date_to))->get();
            foreach ($report as $reportkey => $reportvalue) {
                foreach ($reportvalue as $registrationkey => $registrationvalue) {
                    $pre_reg_report[$reportkey][$registrationkey] = $registrationvalue;
                }
            }
        }
        
        return view('ReportsAndStatic.pre_registration_report', compact('pre_reg_report'));
    }

    //============================= Transfer report ==============================
    public function TranChangeReport()
    {
        $app_forms = array();
        return view('ReportsAndStatic.transfer_change_report', compact('app_forms'));
    }

    public function TranChangeReportSearch(Request $request)
    {
        session()->put(['tra_from' => $request->from, 'tra_to' => $request->to,'tra_type'=>$request->type, 'tra_province'=>$request->province, 'tra_app_type' =>$request->app_purpose_id ]);
        $date_from = \App\Helpers\DateHelper::getMySQLDateFromUIDate(request()->from);
        $date_to = \App\Helpers\DateHelper::getMySQLDateFromUIDate(request()->to);
        $province = Province::find($request->province);
        $app_purpose = \App\Model\AppFormPurpose::whereAppPurposeId($request->app_purpose_id)->pluck('app_form_id');
        $users = $province->user_infos->pluck('user_id')->toArray();
        $purpose_id = $request->app_purpose_id;
        
        $app_forms = \App\Model\AppForm::whereHas('AppFormPurpose', function($q) use($purpose_id){
            $q->where('app_purpose_id', '=', $purpose_id);
        })->whereIn('staff_id', $users)->whereBetween(DB::raw('DATE(created_at)'), array($date_from, $date_to))->get();
        
        return view('ReportsAndStatic.transfer_change_report', compact('app_forms'));
    }
    
    //============================= Print Passport report ==============================

    public function PrintPassportReport()
    {
        $print_passport_report = array();
        return view('ReportsAndStatic.print_passport_report', compact('print_passport_report'));
    }

    public function PrintPassportReportSearch(Request $request)
    {
        session()->put(['pass_from' => $request->from, 'pass_to' => $request->to,'pass_type'=>$request->type, 'pass_province'=>$request->province ]);
        $date_from = \App\Helpers\DateHelper::getMySQLDateFromUIDate(request()->from);
        $date_to = \App\Helpers\DateHelper::getMySQLDateFromUIDate(request()->to);
        $month = Carbon::parse($request->month)->today() -> submonth(1)->toDateTimeString();
        $year = Carbon::parse($request->year)->today() -> subyear(1)->toDateTimeString();
        $province = Province::find($request->province);
        $print_passport_report = $province->v_passport()->whereBetween(DB::raw('DATE(created_at)'), array($date_from, $date_to))->get();
        return view('ReportsAndStatic.print_passport_report', compact('print_passport_report'));
    }

   //============================= Print Card report ==============================
    public function printCardReport()
    {
        $card_print = array();
        return view('ReportsAndStatic.card_report', compact('card_print'));
    }

    public function printCardReportSearch()
    {
        session()->put(['user_id' => request('user_id'), 'date' =>request('date')]);
        $date = \App\Helpers\DateHelper::getMySQLDateFromUIDate(request()->date);
        $data['card_print'] = DB::table('print_logs as p')
                    ->leftJoin('vehicles as v' ,'p.vehicle_id', '=', 'v.id')
                    ->leftJoin('vehicle_types as vtype', 'v.vehicle_type_id', '=', 'vtype.id')
                    ->leftJoin('vehicle_brands as brand', 'v.brand_id', '=', 'brand.id')
                    ->leftJoin('vehicle_models as model', 'v.model_id', '=', 'model.id')
                    ->leftJoin('vehicle_kinds as kind', 'v.vehicle_kind_code', '=', 'kind.vehicle_kind_code')
                    ->leftJoin('users', 'p.user_id', '=', 'users.id')
                    ->select(DB::raw("SUM(print_log_count) as print_count"), 'v.division_no', 'v.province_no', 'v.owner_name', 'v.village_name', 'v.licence_no', 'vtype.name as vtype_name', 'brand.name as brand_name', 'model.name as model_name', 'kind.name as vkind_name', 'v.remark', 'users.first_name', 'users.last_name')
                    ->where([['p.user_id', request('user_id')], [DB::raw('DATE(p.created_at)'), $date]])
                    ->groupBy('vehicle_id')
                    ->get();
        $data['date'] = $date;
        if( request('type') != "excel"){
            return view('ReportsAndStatic.card_report', $data);
        } else {
            return Excel::download(new \App\Exports\CardReportExport($data), 'print_card_report.xlsx');
        }

    }

}
