<?php

namespace App\Http\Controllers\Module4;

use Carbon\Carbon;
use App\Model\Vehicle;
use App\Helpers\Helper;
use App\Model\Province;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Model\DivisionNoControl;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DivisionControlController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:Division-Number-List-View');
        $this->middleware('permission:Division-Number-Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Division-Number-Edit', ['only' => ['update']]);
        $this->middleware('permission:Division-Number-Delete', ['only' => ['destroy']]);
    }

    public function index()
    {

        if (Helper::userLevel() == 'admin') {
            $division_control = DivisionNoControl::orderByDesc('created_at')->get();
        } else {
            $division_control = DivisionNoControl::whereProvinceCode(Helper::current_province())->orderByDesc('created_at')->get();
        }
        return view('Module4.DivisionNoControl.index', compact('division_control'));
    }

    public function create()
    {
        $divisionnocontrol = DivisionNoControl::all();
        $province = Province::all();
        return view('Module4.DivisionNoControl.create', compact('vehicleinspection', 'province'));
    }

    public function store(Request $request)
    {
        DivisionNoControl::create($request->all());
        return redirect('division-no-control')->with('success', trans('module4.success_div_control'));
    }

    //check start division no greater than all of large number
    public function checkDivision()
    {
        if (request('id')) {
            $sql_start = "SELECT * FROM division_no_controls WHERE id != " . request('id') . " AND ".
            "CAST(TRIM(LEADING '0' FROM ". request('start_no') . ") AS UNSIGNED) ".
            "BETWEEN CAST(TRIM(LEADING '0' FROM `division_no_start`) AS UNSIGNED) ". 
            "AND CAST(TRIM(LEADING '0' FROM `division_no_end`)AS UNSIGNED) LIMIT 1";
            $old_start = DB::select($sql_start);

            $sql_end = "SELECT * FROM division_no_controls WHERE id != " . request('id') . " AND ".
            "CAST(TRIM(LEADING '0' FROM ". request('end_no') . ") AS UNSIGNED) ".
            "BETWEEN CAST(TRIM(LEADING '0' FROM `division_no_start`) AS UNSIGNED) ". 
            "AND CAST(TRIM(LEADING '0' FROM `division_no_end`)AS UNSIGNED) LIMIT 1";
            $old_end = DB::select($sql_end);
        } else {
            $sql_start = "SELECT * FROM division_no_controls WHERE ".
            "CAST(TRIM(LEADING '0' FROM ". request('start_no') . ") AS UNSIGNED) ".
            "BETWEEN CAST(TRIM(LEADING '0' FROM `division_no_start`) AS UNSIGNED) ". 
            "AND CAST(TRIM(LEADING '0' FROM `division_no_end`)AS UNSIGNED) LIMIT 1";
            $old_start = DB::select($sql_start);

            // return response()->json(['status' => "start", 'message' => $sql_start]);

            $sql_end = "SELECT * FROM division_no_controls WHERE ".
            "CAST(TRIM(LEADING '0' FROM ". request('end_no') . ") AS UNSIGNED) ".
            "BETWEEN CAST(TRIM(LEADING '0' FROM `division_no_start`) AS UNSIGNED) ". 
            "AND CAST(TRIM(LEADING '0' FROM `division_no_end`)AS UNSIGNED) LIMIT 1";
            $old_end = DB::select($sql_end);
        }

        // $old_start = DivisionNoControl::where('id', '!=' , request('id'))
        // ->where('division_no_start', '<=' , request('start_no'))->where('division_no_end', '>=' , request('start_no'))->get();

        // $old_end = DivisionNoControl::where('id', '!=' , request('id'))
        // ->where('division_no_start', '<=' , request('end_no'))->where('division_no_end', '>=' , request('end_no'))->get();

        if (count($old_start) > 0) {
            $message = "Division No. Start is already exist in this range : " . $old_start[0]->division_no_start . " and " . $old_start[0]->division_no_end;
            return response()->json(['status' => "start", 'message' => $message, 'sql_start' => $sql_start, 'sql_end' => $sql_end]);
        } else if (count($old_end) > 0) {
            $message = "Division No. End is already exist in this range : " . $old_end[0]->division_no_start . " and " . $old_end[0]->division_no_end;
            return response()->json(['status' => "end", 'message' => $message, 'sql_start' => $sql_start, 'sql_end' => $sql_end]);
        } else {
            return response()->json(['status' => "OK"]);
        }

        // $all_div_no = DivisionNoControl::where('id', '!=' , request('id'))->pluck('division_no_end')->toArray();
        // $start_div = DivisionNoControl::where('id', '!=' , request('id'))->pluck('division_no_start')->toArray();
        // $old_start_div = DivisionNoControl::whereId(request('id'))->pluck('division_no_start')->first();
        //  if(request('division_no_start') <= max($all_div_no) || request('division_no_start') <= max($start_div)){
        //      return response()->json([
        //         'large_no'=> max($all_div_no),
        //         'old_start_div' => $old_start_div
        //      ]);

        //  }
    }

    //check status by province in division control
    public function checkDivisionStatus()
    {
        if (DivisionNoControl::whereProvinceCodeAndStatus(request('province'), request('status'))->where('id', '!=', request('id'))->exists()) {
            return response()->json(['status' => "taken", 'message' => trans('module4.msg_already_exist')]);
        }
    }

    public function update(Request $request, $id)
    {
        $divisionno = DivisionNoControl::find($id);
        if ($divisionno->present_division_no != null) {
            if ($request->division_no_start > $divisionno->present_division_no) {
                $request['present_division_no'] = null;
            }
        }
        \LogActivity::saveToLog($divisionno, $tb_name = "division_no_controls", $action = "update");
        $divisionno->update($request->all());
        return redirect('division-no-control')->with('success', 'Successful Division No Control Update.');
    }



    public function destroy($id)
    {
        $data = DivisionNoControl::find($id);
        \LogActivity::saveToLog($data, $tb_name = "Division_no-controls", $action = "delete");
        $data->delete();
        return redirect('division-no-control')->with('success', 'Successful Division No Control Delete.');
    }
}
