<?php

namespace App\Http\Controllers\Module4;

use DB;
use Auth;
use App\Model\Vehicle;
use Illuminate\Http\Request;
use App\Model\IllegalTraffic;
use App\Http\Controllers\Controller;
use App\Model\IllegalTrafficAccident;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\ToArray;

class TrafficPoliceController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Traffic-Police-List-View');
        $this->middleware('permission:Traffic-Police-Create', ['only' => ['SearchDivision', 'store']]);
    }

    public function index()
    {
        $total_vehicles = Vehicle::count();
        $num = ceil($total_vehicles / 20);
        $total_pages = number_format($num, 0, ".", "");

        //We will show just only 20 records in each page. For next page, we will get data and show when click next/prev button.
        $vehicles = Vehicle::with(['illegalTrafic'])->orderBy('id', 'ASC')->skip(0)->take(20)->get();
       
        return view('Module4.TrafficPolice.index', compact('vehicles', 'total_vehicles', 'total_pages'));
    }

    public function SearchDivision(Request $request)
    {
        $traffic_police = IllegalTraffic::where('division_no', $request['division_no'])->get();

        $traffic_accidence = DB::table('traffic_accidents')
            ->select(['id', 'name', 'name_en'])
            ->get();
        return view('Module4.TrafficPolice.create', compact('traffic_police', 'traffic_accidence'));
    }

    public function store(Request $request)
    {
       
        $illegal_trafic_id = request('illegal_trafic_id');
        $date = \App\Helpers\DateHelper::getMySQLDateFromUIDate(request('date'));

        if ($illegal_trafic_id != null || $illegal_trafic_id != '') {
            $data = IllegalTraffic::where('id', $illegal_trafic_id)->first();
            $data->vehicle_id = request('vehicle_id');
            $data->place = request('place');
            $data->offender_name = '';
            $data->officer_name = auth()->user()->id;;
            $data->date = $date;
            $data->status = '1';
            $data->remark = request('illegal_trafic_remark');
            $data->illegal_date = request()->has('illegal_date')? request('illegal_date'):'';
            $data->illegal_no = request()->has('illegal_no')? request('illegal_no'):'';
            $data->bill_date = request()->has('bill_date')? request('bill_date'):'';
            $data->bill_no = request()->has('bill_no')? request('bill_no'):'';
            $data->note = request('note');
            $data->to_date = request('to_date');
            $data->log = request('log');
            $data->update();

            IllegalTrafficAccident::where('illegal_traffic_id', $illegal_trafic_id)->delete();

            $accident_id = request('accident_id');
            foreach ($accident_id as $purpose => $value) {
                $accident = array(
                    'illegal_traffic_id' => $illegal_trafic_id,
                    'traffic_accidence_id' => $value
                );
                IllegalTrafficAccident::insert($accident);
            }

            // dd($illegal_trafic_id);
            return redirect('/traffic-police')->with('success', 'Traffic Police Updated Successful.');
        } else {
            $illegal_traffic = new IllegalTraffic();
            $illegal_traffic->vehicle_id = request('vehicle_id');
            $illegal_traffic->place = request('place');
            $illegal_traffic->offender_name = '';
            $illegal_traffic->officer_name = auth()->user()->id;;
            $illegal_traffic->date = $date;
            $illegal_traffic->status = '1';
            $illegal_traffic->remark = request('illegal_trafic_remark');
            $illegal_traffic->illegal_date = request()->has('illegal_date')? request('illegal_date'):'';
            $illegal_traffic->illegal_no = request()->has('illegal_no')? request('illegal_no'):'';
            $illegal_traffic->bill_date = request()->has('bill_date')? request('bill_date'):'';
            $illegal_traffic->bill_no = request()->has('bill_no')? request('bill_no'):'';
            $illegal_traffic->note = request('note');
            $illegal_traffic->to_date = request('to_date');
            $illegal_traffic->log = request('log');
            $illegal_traffic->save();

            foreach ($request->accident_id as $purpose => $value) {
                $accident = array(
                    'illegal_traffic_id' => $illegal_traffic->id,
                    'traffic_accidence_id' => $value
                );

                IllegalTrafficAccident::insert($accident);
            }
            // dd($illegal_trafic_id.$request->accident_id);
            return redirect('/traffic-police')->with('success', 'Traffic Police Created Successful.');
        }
    }

    public function showTrafficPolice($id)
    {
        $vehicle = Vehicle::with(['illegalTrafic'])->where('id', $id)->get()->first();

        $illegal_traffic_accidents = IllegalTrafficAccident::whereillegal_traffic_id($vehicle->illegalTrafic->id)->get('traffic_accidence_id');
        $charges = array();
        foreach ($illegal_traffic_accidents as $item) {
            $charges[] = $item->traffic_accidence_id;
        }

        return view('Module4.TrafficPolice.edit', compact('vehicle', 'charges'));
    }

    public function searchTrafficPolice(Request $request)
    {
        $cpage = $request->current_page;
        $spage = $request->search_page;

        $license_no = $request->license_no;
        $general = $request->general;
        $province_name = $request->province_name;
        $village_name = $request->village_name;
        $owner_name = $request->owner_name;
        $vehicle_kind_code = $request->vehicle_kind_code;
        $issue_date = $request->issue_date;
        $sortBy = empty($request->sortBy) ? 'id' : $request->sortBy;

        $vehicle_type_name = $request->vehicle_type_name;
        $brand_name = $request->brand_name;
        $model_name = $request->model_name;
        $engine_no = $request->engine_no;
        $chassis_no = $request->chassis_no;
        $color_name = $request->color_name;
        $cc = $request->cc;
        $year_manufactured = $request->year_manufactured;
        $import_permit_no = $request->import_permit_no;
        $industrial_doc_no = $request->industrial_doc_no;
        $technical_doc_no = $request->technical_doc_no;
        $commerce_permit_no = $request->commerce_permit_no;

        $pagination = "";
        if ($cpage == 1) {
            $pagination = 0;
        } else {
            $pagination = ($cpage * 20) - 20;
        }

        $sql_query = "SELECT vehicles.*, vehicle_kinds.name as vehicle_kind_name, vehicle_brands.name as brand_name
            , vehicle_models.name as model_name, colors.name as color_name, districts.name as district_name
            , provinces.name as province_name, illegal_traffic.illegal_date FROM vehicles 
            LEFT JOIN provinces ON vehicles.province_code = provinces.province_code 
            LEFT JOIN vehicle_types ON vehicles.vehicle_type_id = vehicle_types.id
            LEFT JOIN vehicle_brands ON vehicles.brand_id = vehicle_brands.id
            LEFT JOIN vehicle_models ON vehicles.model_id = vehicle_models.id
            LEFT JOIN colors ON vehicles.color_id = colors.id
            LEFT JOIN vehicle_kinds ON vehicles.vehicle_kind_code = vehicle_kinds.vehicle_kind_code
            LEFT JOIN districts ON vehicles.district_code = districts.district_code
            LEFT JOIN illegal_traffic ON vehicles.id = illegal_traffic.vehicle_id WHERE ";
        if (!empty($license_no)) {
            $sql_query = $sql_query . "vehicles.licence_no like '%" . "$license_no" . "%' AND ";
        }
        if (!empty($province_name)) {
            $sql_query = $sql_query . "provinces.name like '%" . "$province_name" . "%' AND ";
        }
        if (!empty($village_name)) {
            $sql_query = $sql_query . "vehicles.village_name like '%" . "$village_name" . "%' AND ";
        }
        if (!empty($owner_name)) {
            $sql_query = $sql_query . "vehicles.owner_name like '%" . "$owner_name" . "%' AND ";
        }
        if (!empty($vehicle_kind_code)) {
            $sql_query = $sql_query . "vehicles.vehicle_kind_code like '%" . "$vehicle_kind_code" . "%' AND ";
        }
        if (!empty($issue_date)) {
            $sql_query = $sql_query . "vehicles.issue_date like '%" . "$issue_date" . "%' AND ";
        }
        if (!empty($vehicle_type_name)) {
            $sql_query = $sql_query . "vehicle_types.name like '%" . "$vehicle_type_name" . "%' AND ";
        }
        if (!empty($brand_name)) {
            $sql_query = $sql_query . "vehicle_brands.name like '%" . "$brand_name" . "%' AND ";
        }
        if (!empty($model_name)) {
            $sql_query = $sql_query . "vehicle_models.name like '%" . "$model_name" . "%' AND ";
        }
        if (!empty($engine_no)) {
            $sql_query = $sql_query . "vehicles.engine_no like '%" . "$engine_no" . "%' AND ";
        }
        if (!empty($chassis_no)) {
            $sql_query = $sql_query . "vehicles.chassis_no like '%" . "$chassis_no" . "%' AND ";
        }
        if (!empty($color_name)) {
            $sql_query = $sql_query . "colors.name like '%" . "$color_name" . "%' AND ";
        }
        if (!empty($cc)) {
            $sql_query = $sql_query . "vehicles.cc like '%" . "$cc" . "%' AND ";
        }
        if (!empty($year_manufactured)) {
            $sql_query = $sql_query . "vehicles.year_manufacture like '%" . "$year_manufactured" . "%' AND ";
        }
        if (!empty($import_permit_no)) {
            $sql_query = $sql_query . "vehicles.import_permit_no like '%" . "$import_permit_no" . "%' AND ";
        }
        if (!empty($industrial_doc_no)) {
            $sql_query = $sql_query . "vehicles.industrial_doc_no like '%" . "$industrial_doc_no" . "%' AND ";
        }
        if (!empty($technical_doc_no)) {
            $sql_query = $sql_query . "vehicles.technical_doc_no like '%" . "$technical_doc_no" . "%' AND ";
        }
        if (!empty($commerce_permit_no)) {
            $sql_query = $sql_query . "vehicles.comerce_permit_no like '%" . "$commerce_permit_no" . "%' AND ";
        }
        $sql_query = trim($sql_query, " WHERE ");//Sometime maybe all search conditions are blank. 
        $sql_query = trim($sql_query, " AND ") . " ORDER BY " . $sortBy . " ASC";
        //dd($sql_query);
        $vehicle_result = DB::select($sql_query);

        //We will show just only 20 records in each page. For next page, we will get data and show when click next/prev button.
        $vehicles = array_slice($vehicle_result, $pagination, 20);

        $total_vehicles = count($vehicle_result);
        $num = ceil($total_vehicles / 20);
        $total_pages = number_format($num, 0, ".", "");

        return view('Module4.TrafficPolice.search', compact('vehicles', 'total_vehicles', 'total_pages'));
    }

    public function update($id)
    {
        $date = \App\Helpers\DateHelper::getMySQLDateFromUIDate(request('date'));
        $data = IllegalTraffic::find($id)->first();
        $data->division_no = request('division_no');
        $data->date = $date;
        $data->license_no = request('license_no');
        $data->place = request('place');
        $data->brand_id = request('brand_id');
        $data->offender_name = request('offender_name');
        $data->model_id = request('model_id');
        $data->officer_name = request('officer_name');
        $data->color_id = request('color_id');
        $data->status = request('police_status');
        $data->vehicle_type_id = request('vehicle_type_id');
        $data->remark = request('remark');
        $data->update();

        $accident_id = request('accident_id');
        IllegalTrafficAccident::where('illegal_traffic_id', $id)->delete();
        foreach ($accident_id as $purpose => $value) {
            $accident = array(
                'illegal_traffic_id' => $id,
                'traffic_accidence_id' => $value
            );
            IllegalTrafficAccident::insert($accident);
        }

        return redirect('/traffic-police')->with('success', 'Traffic Police Updated Successful.');
    }

    public function destroy($id)
    {
        $success = IllegalTrafficAccident::where('illegal_traffic_id', $id)->get('id');
        foreach ($success as $s) {
            $data = IllegalTrafficAccident::find($s)->each->delete();
        }
        IllegalTraffic::destroy($id);
        return redirect('/traffic-police')->with('success', 'Traffic Police Deleted Successful.');
    }
}
