<?php

namespace App\Http\Controllers\Module4;

use App\Helpers\DateHelper;
use Illuminate\Http\Request;
use App\Model\VehicleOverSystem;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Vehicle;

class VehicleOverSystemController extends Controller
{
    public function vehicleOverSystemModal(Request $request)
    {
        $v_over_system_id = $request->v_over_system_id;
        $operation = $request->operation;
        $vehicle_over_system = null;

        if ($operation == "edit") {
            $vehicle_over_system = VehicleOverSystem::find($v_over_system_id);
        }

        return view('vrms2.vehicle.VehicleOverSystemModal', compact('vehicle_over_system', 'operation'));
    }

    public function loadVehicleOverSystem(Request $request)
    {
        $vehicle_over_systems = VehicleOverSystem::orderBy('updated_at', 'DESC')->skip(0)->take(20)->get();

        $current_page = $request->current_page;
        $license_no = $request->license_no;
        $search_all = $request->search_all;
        if(!$search_all){
            $total_records = VehicleOverSystem::count();
            $num = ceil($total_records / 20);
            $total_pages = number_format($num, 0, ".", "");
            $operation = "Normal";
            return view('vrms2.vehicle.LoadVehicleOverSystem', compact('vehicle_over_systems', 'total_records', 'total_pages', 'operation'));
        }else{
            $pagination = "";
            if ($current_page == 1) {
                $pagination = 0;
            } else {
                $pagination = ($current_page * 20) - 20;
            }
    
            //============================= Create Query ==============================
            $sql_query = "SELECT DISTINCT v.id, v.certificate_no, v.date, vehicle_types.name as vehicle_type_name 
            , vehicle_brands.name as brand_name, vehicle_models.name as model_name, colors.name as color_name
            , s.name as steering_name, v.engine_no, v.chassis_no, CONCAT(u.first_name, ' ', u.last_name) as user_name , v.updated_at
            FROM vehicle_over_system as v
            LEFT JOIN vehicle_types ON v.vehicle_type_id = vehicle_types.id
            LEFT JOIN vehicle_brands ON v.brand_id = vehicle_brands.id
            LEFT JOIN vehicle_models ON v.model_id = vehicle_models.id
            LEFT JOIN colors ON v.color_id = colors.id
            LEFT JOIN steerings s ON v.steering_id = s.id
            LEFT JOIN users u ON v.created_by = u.id
            WHERE v.certificate_no like '%" . $search_all . "%' OR v.date like '%" . $search_all . "%' OR vehicle_types.name like '%" . $search_all . "%' 
            OR vehicle_brands.name like '%" . $search_all . "%' OR vehicle_models.name like '%" . $search_all . "%' OR colors.name like '%" . $search_all . "%' 
            OR s.name like '%" . $search_all . "%' OR v.engine_no like '%" . $search_all . "%' OR v.chassis_no like '%" . $search_all . "%'
            OR u.first_name like '%" . $search_all . "%' OR u.last_name like '%" . $search_all . "%' OR v.updated_at like '%" . $search_all . "%' ORDER BY 'updated_at' DESC";
    
            //dd($sql_query);
            $v_result = DB::select($sql_query);
    
            //We will show just only 20 records in each page. For next page, we will get data and show when click next/prev button.
            $vehicle_over_systems = array_slice($v_result, $pagination, 20);
    
            $total_records = count($v_result);
            $num = ceil($total_records / 20);
            $total_pages = number_format($num, 0, ".", "");
            $operation = "Search";
            return view('vrms2.vehicle.LoadVehicleOverSystem', compact('vehicle_over_systems', 'total_records', 'total_pages', 'operation'));
        }       
    }

    public function saveVehicleOverSystem(Request $request)
    {
        try {
            $v_over_system_id = $request->v_over_system_id;
            $operation = $request->operation;

            if ($operation == "new") {
                $vehicle_over_system = new VehicleOverSystem();
                $vehicle_over_system->certificate_no = empty(request('certificate_no')) ? null : request('certificate_no');
                $vehicle_over_system->date =  empty(request('date')) ? null : request('date');
                $vehicle_over_system->vehicle_type_id = empty(request('vehicle_type_id')) ? null : request('vehicle_type_id');
                $vehicle_over_system->chassis_no = empty(request('chassis_no')) ? null : request('chassis_no');
                $vehicle_over_system->engine_no = empty(request('engine_no')) ? null : request('engine_no');
                $vehicle_over_system->year_manufacture = empty(request('year_manufacture')) ? null : request('year_manufacture');
                $vehicle_over_system->origin = empty(request('origin')) ? null : request('origin');
                $vehicle_over_system->brand_id = empty(request('brand_id')) ? null : request('brand_id');
                $vehicle_over_system->model_id = empty(request('model_id')) ? null : request('model_id');
                $vehicle_over_system->cc = empty(request('cc')) ? null : request('cc');
                $vehicle_over_system->color_id = empty(request('color_id')) ? null : request('color_id');
                $vehicle_over_system->steering_id = empty(request('steering_id')) ? null : request('steering_id');
                $vehicle_over_system->note = empty(request('note')) ? null : request('note');
                $vehicle_over_system->created_by = auth()->id();
                $vehicle_over_system->save();

                return response()->json(['status' => 'OK']);
            } else {//edit
                $vehicle_over_system = VehicleOverSystem::find($v_over_system_id);
                $vehicle_over_system->certificate_no = empty(request('certificate_no')) ? null : request('certificate_no');
                $vehicle_over_system->date =  empty(request('date')) ? null : request('date');
                $vehicle_over_system->vehicle_type_id = empty(request('vehicle_type_id')) ? null : request('vehicle_type_id');
                $vehicle_over_system->chassis_no = empty(request('chassis_no')) ? null : request('chassis_no');
                $vehicle_over_system->engine_no = empty(request('engine_no')) ? null : request('engine_no');
                $vehicle_over_system->year_manufacture = empty(request('year_manufacture')) ? null : request('year_manufacture');
                $vehicle_over_system->origin = empty(request('origin')) ? null : request('origin');
                $vehicle_over_system->brand_id = empty(request('brand_id')) ? null : request('brand_id');
                $vehicle_over_system->model_id = empty(request('model_id')) ? null : request('model_id');
                $vehicle_over_system->cc = empty(request('cc')) ? null : request('cc');
                $vehicle_over_system->color_id = empty(request('color_id')) ? null : request('color_id');
                $vehicle_over_system->steering_id = empty(request('steering_id')) ? null : request('steering_id');
                $vehicle_over_system->note = empty(request('note')) ? null : request('note');
                $vehicle_over_system->created_by = auth()->id();
                $vehicle_over_system->save();

                return response()->json(['status' => 'OK']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e]);
        }
    }

    public function documentCertificateOverSystem($id)
    {
        $vehicle_over_system = VehicleOverSystem::find($id);

        //Tent to use only one print page for both Vehicle's Document Certificate and VehicleOverSystem's Document Certificate print
        $vehicle = new Vehicle();
        $vehicle->engine_no = $vehicle_over_system->engine_no;
        $vehicle->color_id = $vehicle_over_system->color_id;
        $vehicle->vehicle_type_id = $vehicle_over_system->vehicle_type_id;
        $vehicle->brand_id = $vehicle_over_system->brand_id;
        $vehicle->model_id = $vehicle_over_system->model_id;
        $vehicle->cc = $vehicle_over_system->cc;
        $vehicle->chassis_no =$vehicle_over_system->chassis_no;
        $vehicle->steering_id = $vehicle_over_system->steering_id;
        $vehicle->year_manufacture = $vehicle_over_system->year_manufacture;

        return view('Module4.registration.print.document-certificate', compact('vehicle', 'app_doc'));
    }
}
