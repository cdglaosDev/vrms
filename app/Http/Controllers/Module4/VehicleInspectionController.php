<?php

namespace App\Http\Controllers\Module4;

use Carbon\Carbon;
use App\Model\Vehicle;
use App\Helpers\DateHelper;
use Illuminate\Http\Request;
use App\Model\VehicleInspection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class VehicleInspectionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Vehicle-Technical-Check-List-View');
        $this->middleware('permission:Vehicle-Technical-Check-List-Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Vehicle-Technical-Check-Entry-Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Vehicle-Technical-Check-Entry-Delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $total_vehicles = Vehicle::count();
        $num = ceil($total_vehicles / 20);
        $total_pages = number_format($num, 0, ".", "");

        //We will show just only 20 records in each page. For next page, we will get data and show when click next/prev button.
        $vehicles = Vehicle::orderBy('updated_at', 'DESC')->skip(0)->take(20)->get();

        return view('Module4.VehicleInspection.index', compact('vehicles', 'total_vehicles', 'total_pages'));
    }

    public function searchVehicleInspection(Request $request)
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
        $sortBy = empty($request->sortBy) ? 'updated_at' : $request->sortBy;

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
            , provinces.name as province_name FROM vehicles 
            LEFT JOIN provinces ON vehicles.province_code = provinces.province_code 
            LEFT JOIN vehicle_types ON vehicles.vehicle_type_id = vehicle_types.id
            LEFT JOIN vehicle_brands ON vehicles.brand_id = vehicle_brands.id
            LEFT JOIN vehicle_models ON vehicles.model_id = vehicle_models.id
            LEFT JOIN colors ON vehicles.color_id = colors.id
            LEFT JOIN vehicle_kinds ON vehicles.vehicle_kind_code = vehicle_kinds.vehicle_kind_code
            LEFT JOIN districts ON vehicles.district_code = districts.district_code WHERE ";
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
        $sql_query = trim($sql_query, " WHERE "); //Sometime maybe all search conditions are blank. 
        $sql_query = trim($sql_query, " AND ") . " ORDER BY " . $sortBy . " DESC";
        //dd($sql_query);
        $vehicle_result = DB::select($sql_query);

        //We will show just only 20 records in each page. For next page, we will get data and show when click next/prev button.
        $vehicles = array_slice($vehicle_result, $pagination, 20);

        $total_vehicles = count($vehicle_result);
        $num = ceil($total_vehicles / 20);
        $total_pages = number_format($num, 0, ".", "");

        return view('Module4.VehicleInspection.search', compact('vehicles', 'total_vehicles', 'total_pages'));
    }

    public function vehicleInspectionModal($id)
    {
        $vehicle = Vehicle::find($id);

        if ($vehicle == null) {
            return redirect()->to('/vehicle-inspection')->with('error', "Your vehicle doesn't exist.");
        }

        return view('Module4.VehicleInspection.vehicleInspectModal', compact('vehicle'));
    }

    public function addVehicleInspectionModal($vehicle_id)
    {
        $vehicle_inspect = null;
        $vehicle_inspection_id = "";
        $operation = "add";

        return view('Module4.VehicleInspection.addVehicleInspectModal', compact('vehicle_inspect', 'vehicle_id', 'vehicle_inspection_id', 'operation'));
    }

    public function updateVehicleInspectionModal($vehicle_id, $vehicle_inspection_id)
    {
        $vehicle_inspect = VehicleInspection::whereId($vehicle_inspection_id)->first();
        $operation = "edit";

        return view('Module4.VehicleInspection.addVehicleInspectModal', compact('vehicle_inspect', 'vehicle_id', 'vehicle_inspection_id', 'operation'));
    }

    public function saveVehicleInspection(Request $request)
    {
        $vehicle_id = request('vehicle_id');

        //Create New
        if (empty($vehicle_inspect_id)) {
                $inspect = new VehicleInspection();
                $inspect->vehicle_id = request('vehicle_id');
                $inspect->inspect_place_id = request('inspect_place_id');
                $inspect->issue_date = request('issue_date');
                $inspect->expire_date = request('expire_date');
                $inspect->result = request('inspect_result');
                $inspect->user_id = auth()->id();
                $inspect->save();

            Vehicle::where('id', request('vehicle_id'))
                ->update([
                    'inspect_place_id' => request('inspect_place_id'),
                    'inspect_issue_date' => request('issue_date'),
                    'inspect_expire_date' => request('expire_date'),
                    'inspect_result' => request('inspect_result')
                ]);
          
            $vehicle_inspection = VehicleInspection::whereVehicleId(request('vehicle_id'))->orderBy('created_at', 'ASC')->get();
            return view('Module4.VehicleInspection.vehicleInspection', compact('vehicle_inspection', 'vehicle_id'));
        } else {
            $vehicle_inspect = VehicleInspection::find($request->vehicle_inspect_id);
            \LogActivity::saveToLog($vehicle_inspect, $tb_name = "vehicle_inspections", $action = "update");

            $vehicle_inspect->vehicle_id = request('vehicle_id');
            $vehicle_inspect->inspect_place_id = request('inspect_place_id');
            $vehicle_inspect->issue_date = request('issue_date');
            $vehicle_inspect->expire_date = request('expire_date');
            $vehicle_inspect->result = request('inspect_result');
            $vehicle_inspect->user_id = auth()->id();
            $vehicle_inspect->save();

            Vehicle::where('id', request('vehicle_id'))
                ->update([
                    'inspect_place_id' => request('inspect_place_id'),
                    'inspect_issue_date' => request('issue_date'),
                    'inspect_expire_date' => request('expire_date'),
                    'inspect_result' => request('inspect_result')
                ]);

            $vehicle_inspection = VehicleInspection::whereVehicleId(request('vehicle_id'))->orderBy('created_at', 'ASC')->get();
            return view('Module4.VehicleInspection.vehicleInspection', compact('vehicle_inspection', 'vehicle_id'));
        }
    }

    public function create()
    {
        return view('Module4.VehicleInspection.create');
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'app_request_no' => 'required',
            'date' => 'required|date',
            'result' => 'required',
            'type' => 'required',
            'comment' => 'required'
        ]);
        $data = $request->all();
        $data['inspect_number'] = \App\Helpers\TransferNo::inpect_no();
        $data['date'] = \App\Helpers\DateHelper::getMySQLDateFromUIDate(request('date'));
        $data['user_id'] = auth()->id();
        VehicleInspection::create($data);
        return redirect('vehicle-inspection')->with('success', 'Successful Created');
    }

    public function show(VehicleInspection $vehicle_inspection)
    {
        return view('Module4.VehicleInspection.show', compact('vehicle_inspection'));
    }

    public function edit($id)
    {
        $data['vehicle_inspection'] = VehicleInspection::find($id);
        $vehicle = \App\Model\VehicleType::get();
        $user = \App\User::get();
        return view('Module4.VehicleInspection.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();
        $user = VehicleInspection::find($id);
        \LogActivity::saveToLog($user, $tb_name = "vehicle_inspections", $action = "update");
        $input['date'] = DateHelper::getMySQLDateTimeFromUIDate($request->date);
        $data['user_id'] = auth()->id();
        $user->update($data);
        return redirect('vehicle-inspection')->with('success', 'Successful Vehicle Inspecion Update.');
    }



    public function destroy($id)
    {
        $data = VehicleInspection::find($id);
        \LogActivity::saveToLog($data, $tb_name = "vehicle_inspections", $action = "delete");
        $data->delete();
        return redirect('vehicle-inspection')->with('success', 'Successful deleted');
    }

    private function validateRequest()
    {
        return request()->validate([
            'app_request_no' => 'required',
            'result' => 'required',
            'type' => 'required',
            'comment' => 'required',
            'vehicle_id' => 'required',
            'status' => 'required',
        ]);
    }
}
