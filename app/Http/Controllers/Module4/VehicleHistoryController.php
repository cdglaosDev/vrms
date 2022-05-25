<?php

namespace App\Http\Controllers\Module4;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\VehicleHistory;

class VehicleHistoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Vehicle-History-List-View');
        $this->middleware('permission:Vehicle-History-Create', ['only' => ['store']]);
        $this->middleware('permission:Vehicle-History-Edit', ['only' => ['update']]);
        $this->middleware('permission:Vehicle-History-Delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //To get total records
        $vehicle_histories_list = VehicleHistory::orderByDesc('created_at')->get();

        $cpage = 1;
        $show_record = 20;
        $pagination = "";
        if ($cpage == 1) {
            $pagination = 0;
        } else {
            $pagination = ($cpage * $show_record) - $show_record;
        }

        //We will show just only 20 records in each page. For next page, we will get data and show when click next/prev button.
        $vehicle_histories = VehicleHistory::orderByDesc('created_at')->skip($pagination)->take($show_record)->get();

        $total_records = count($vehicle_histories_list);
        $num = ceil($total_records / $show_record);
        $total_pages = number_format($num, 0, ".", "");

        return view('Module4.VehicleHistory.index', compact('vehicle_histories', 'total_records', 'total_pages'));
    }

    public function searchVehicleHistory(Request $request)
    {
        $cpage = $request->current_page;
        $spage = $request->search_page;

        $license_no = $request->license_no;
        $province_code = $request->province_code;
        $vehicle_kind_code = $request->vehicle_kind_code;

        $show_record = 20;
        $pagination = "";
        if ($cpage == 1) {
            $pagination = 0;
        } else {
            $pagination = ($cpage * $show_record) - $show_record;
        }

        $query = VehicleHistory::select();
        if (!empty($license_no)) {
            $query->where('licence_no', '=', $license_no);
        }
        if (!empty($province_code)) {
            $query->where('province_code', '=', $province_code);
        }
        if (!empty($vehicle_kind_code)) {
            $query->where('vehicle_kind_code', '=', $vehicle_kind_code);
        }

        $total_record_list = $query->pluck('id')->toArray();

        //We will show just only 20 records in each page. For next page, we will get data and show when click next/prev button.
        $vehicle_history_ids = array_slice($total_record_list, $pagination, $show_record);
        $vehicle_histories = VehicleHistory::whereIn('id', $vehicle_history_ids)->orderByDesc('created_at')->get();

        $total_records = count($total_record_list);
        $num = ceil($total_records / $show_record);
        $total_pages = number_format($num, 0, ".", "");

        return view('Module4.VehicleHistory.search', compact('vehicle_histories', 'total_records', 'total_pages'));
    }

    public function editVehicleHistory(Request $request)
    {
        $id = $request->id;
        $vehicle_id = $request->vehicle_id;


        $last_vehicle_history = VehicleHistory::whereVehicleId($vehicle_id)->orderByDesc('created_at')->first();

        $vehicle_histories = VehicleHistory::whereVehicleId($vehicle_id)->where('id', '!=', $last_vehicle_history->id)->orderByDesc('created_at')->get();

        //return response()->json(['status' => $last_vehicle_history]);
        return view('Module4.VehicleHistory.show', compact('last_vehicle_history', 'vehicle_histories'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
