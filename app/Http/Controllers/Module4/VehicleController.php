<?php

namespace App\Http\Controllers\Module4;

use DataTables;
use App\Model\Color;
use App\Model\AppForm;
use App\Model\Vehicle;
use App\Model\Village;
use Carbon\Traits\Date;
use App\Helpers\getData;
use App\Model\VehicleType;
use App\Helpers\DateHelper;
use App\Model\VehicleModel;
use Illuminate\Http\Request;
use App\Model\VehicleHistory;
use App\Model\VehicleDocument;
use App\Helpers\SyncImportData;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Province;
use App\Model\VehiclePrintDetail;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class VehicleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Vehicle-List-View');
        $this->middleware('permission:Vehicle-List-Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Vehicle-Entry-Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Vehicle-Entry-Delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //vehicle list for version2
    public function allVehicleList()
    {
        $data = \App\Helpers\getData::vehInfo();
        $vehicles = Vehicle::skip(0)->take(20)->get();
        //dd($vehicles);
        return view('vrms2.vehicle.all-vehicles', compact('vehicles', 'data'));
    }

    public function loadVehicles()
    {
        //============================= Call to Create Query ==============================
        $sql_query = $this->create_query();

        $sql_query = trim($sql_query, " WHERE "); // . " ORDER BY updated_at DESC"; //Temporary Comment for Testing Server
        // dd($sql_query);
        $vehicle_result = DB::select($sql_query);

        //We will show just only 20 records in each page. For next page, we will get data and show when click next/prev button.
        $vehicles = array_slice($vehicle_result, 0, 20);

        $total_vehicles = count($vehicle_result);
        $num = ceil($total_vehicles / 20);
        $total_pages = number_format($num, 0, ".", "");

        return view('vrms2.vehicle.LoadVehicles', compact('vehicles', 'total_pages', 'total_vehicles'));
    }

    public function searchVehicles(Request $request)
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

        //============================= Call to Create Query ==============================
        $sql_query = $this->create_query();
        $where_query = "";
        $general_query = "";

        //============================= Create WHERE Clause ==============================
        if (!empty($license_no)) {
            $where_query = $where_query . "v.licence_no like '%" . "$license_no" . "%' AND ";
        }
        if (!empty($province_name)) {
            $where_query = $where_query . "v.province_name like '%" . "$province_name" . "%' AND ";
        }
        if (!empty($village_name)) {
            $where_query = $where_query . "v.village_name like '%" . "$village_name" . "%' AND ";
        }
        if (!empty($owner_name)) {
            $where_query = $where_query . "v.owner_name like '%" . "$owner_name" . "%' AND ";
        }
        if (!empty($vehicle_kind_code)) {
            $where_query = $where_query . "v.vehicle_kind_code like '%" . "$vehicle_kind_code" . "%' AND ";
        }
        if (!empty($issue_date)) {
            $where_query = $where_query . "v.issue_date like '%" . "$issue_date" . "%' AND ";
        }
        if (!empty($vehicle_type_name)) {
            $where_query = $where_query . "v.vehicle_type_name like '%" . "$vehicle_type_name" . "%' AND ";
        }
        if (!empty($brand_name)) {
            $where_query = $where_query . "v.brand_name like '%" . "$brand_name" . "%' AND ";
        }
        if (!empty($model_name)) {
            $where_query = $where_query . "v.model_name like '%" . "$model_name" . "%' AND ";
        }
        if (!empty($engine_no)) {
            $where_query = $where_query . "v.engine_no like '%" . "$engine_no" . "%' AND ";
        }
        if (!empty($chassis_no)) {
            $where_query = $where_query . "v.chassis_no like '%" . "$chassis_no" . "%' AND ";
        }
        if (!empty($color_name)) {
            $where_query = $where_query . "v.color_name like '%" . "$color_name" . "%' AND ";
        }
        if (!empty($cc)) {
            $where_query = $where_query . "v.cc like '%" . "$cc" . "%' AND ";
        }
        if (!empty($year_manufactured)) {
            $where_query = $where_query . "v.year_manufacture like '%" . "$year_manufactured" . "%' AND ";
        }
        if (!empty($import_permit_no)) {
            $where_query = $where_query . "v.import_permit_no like '%" . "$import_permit_no" . "%' AND ";
        }
        if (!empty($industrial_doc_no)) {
            $where_query = $where_query . "v.industrial_doc_no like '%" . "$industrial_doc_no" . "%' AND ";
        }
        if (!empty($technical_doc_no)) {
            $where_query = $where_query . "v.technical_doc_no like '%" . "$technical_doc_no" . "%' AND ";
        }
        if (!empty($commerce_permit_no)) {
            $where_query = $where_query . "v.comerce_permit_no like '%" . "$commerce_permit_no" . "%' AND ";
        } 

        if (!empty($general)) {
            $general_query = "v.division_no like '%" . "$general" . "%' "
            . " OR v.province_no like '%" . "$general" . "%' "
            . " OR v.licence_no like '%" . "$general" . "%' "
            . " OR v.owner_name like '%" . "$general" . "%' "
            . " OR v.engine_no like '%" . "$general" . "%' "
            . " OR v.chassis_no like '%" . "$general" . "%' "
            . " OR v.pre_licence_no like '%" . "$general" . "%' ";
        }

        if($where_query != ""){
            if($general_query != ""){
                $sql_query = $sql_query . $where_query . $general_query;
            }else{
                $sql_query = $sql_query . $where_query;
            }

            $sql_query = trim($sql_query, " AND ");
        }else if($general_query != ""){
            $sql_query = $sql_query . $general_query;
        }else{
            $sql_query = trim($sql_query, " WHERE ");
        }

        //Temporary Comment for Testing Server 
        //$sql_query = $sql_query . " ORDER BY " . $sortBy . " DESC"; 
        
        // dd($sql_query);
         //dd($sql_query);
        
        $vehicle_result = DB::select($sql_query);

        //We will show just only 20 records in each page. For next page, we will get data and show when click next/prev button.
        $vehicles = array_slice($vehicle_result, $pagination, 20);

        $total_vehicles = count($vehicle_result);
        $num = ceil($total_vehicles / 20);
        $total_pages = number_format($num, 0, ".", "");

        return view('vrms2.vehicle.SearchVehicles', compact('vehicles', 'total_vehicles', 'total_pages'));
    }

    public function create_query()
    {
        $user_status = auth()->user()->user_status;

        $sql_query = "";
        $sql_vehicle = "";

        $sql_main = "";
        $sql_app_form = "";
        $sql_1 = "";
        $sql_2 = "";

        $app_purpose_id_1 = "";
        $app_form_status_id_1 = "";
        $app_purpose_id_2 = "";
        $app_form_status_id_2 = "";

        $sql_main = "SELECT vehicle_info.*, CASE WHEN vehicle_info.issue_date = '0000-00-00' THEN NULL ELSE  DATE_FORMAT(vehicle_info.issue_date, '%d/%m/%Y')
        END AS i_date, CASE WHEN vehicle_info.expire_date = '0000-00-00' THEN NULL ELSE DATE_FORMAT(vehicle_info.expire_date, '%d/%m/%Y') END AS e_date 
        , illegal_traffic.note AS traffic_note, illegal_traffic.date AS traffic_date, illegal_traffic.bill_date
        FROM vehicle_info LEFT JOIN illegal_traffic ON vehicle_info.id = illegal_traffic.vehicle_id
        ";

        $sql_app_form = " LEFT JOIN app_forms ON vehicle_info.id = app_forms.vehicle_id
        LEFT JOIN app_form_purposes ON app_forms.id = app_form_purposes.app_form_id WHERE ";

        switch ($user_status) {
            case "book_print":
                $app_purpose_id_1 = "(1, 2, 3, 4, 7, 8)";
                $app_form_status_id_1 = "(5)";

                $app_purpose_id_2 = "(5)";
                $app_form_status_id_2 = "(3)";
                break;
            case "card_print":
                $app_purpose_id_1 = "(3, 4, 7, 8)";
                $app_form_status_id_1 = "(3)";

                $app_purpose_id_2 = "(1, 2, 4)";
                $app_form_status_id_2 = "(4)";
                break;
            case "license_control":
                $app_purpose_id_1 = "(1, 2)";
                $app_form_status_id_1 = "(3, 4)";

                $app_purpose_id_2 = "";
                $app_form_status_id_2 = "";
                break;
            case "counter_calling":
                $app_purpose_id_1 = "(5)";
                $app_form_status_id_1 = "(4)";

                $app_purpose_id_2 = "(1, 2, 3, 4, 7, 8)";
                $app_form_status_id_2 = "(6)";
                break;
            case "lock_vehicle":
                $app_purpose_id_1 = "(1, 2, 3, 4)";
                $app_form_status_id_1 = "(3)";

                $app_purpose_id_2 = "";
                $app_form_status_id_2 = "";
                break;
            default:
                $app_purpose_id_1 = "";
                $app_form_status_id_1 = "";

                $app_purpose_id_2 = "";
                $app_form_status_id_2 = "";
        }

        //==================================== Create Vehicle Query ======================================
        //If user_level is admin, need to extract only vehicle list.
        if ($app_purpose_id_1 == "" && $app_form_status_id_1 == "" && $app_purpose_id_2 == "" && $app_form_status_id_2 == "") {
            if (auth()->user()->user_level == "province") {
                $sql_vehicle = $sql_main . " WHERE vehicle_info.province_code = '" . \App\Helpers\Helper::current_province() . "'";
            } else {
                $sql_vehicle =  $sql_main;
            }
        } else {
            $sql_main = $sql_main . $sql_app_form;

            if (auth()->user()->user_level == "province") {
                $sql_main = $sql_main . "vehicle_info.province_code = '" . \App\Helpers\Helper::current_province() . "' AND ";
            }

            $sql_1 = $sql_main . "app_form_purposes.app_purpose_id IN " . $app_purpose_id_1 .
                " AND app_forms.app_form_status_id IN " . $app_form_status_id_1;

            //For license_control and lock_vehicle, no need to UNION.
            if (!($app_purpose_id_2 == "" && $app_form_status_id_2 == "")) {
                $sql_2 = " UNION " . $sql_main . "app_form_purposes.app_purpose_id IN " . $app_purpose_id_2 .
                    " AND app_forms.app_form_status_id IN " . $app_form_status_id_2;
            }

            $sql_vehicle = $sql_1 . $sql_2;
        }
        //==================================== End Create Vehicle Query ======================================

        //==================================== Create Main Query ======================================

        $sql_query = "SELECT DISTINCT v.* FROM (" . $sql_vehicle . ")as v WHERE ";

        return $sql_query;
    }

    public function loadVehicleStats(Request $request)
    {
        $during_date = \App\Helpers\DateHelper::getMySQLDateFromUIDate($request->during_date);
        $to_date = \App\Helpers\DateHelper::getMySQLDateFromUIDate($request->to_date);
        $province_code = $request->province_code;
        $province_name = $request->province_name;

        //============================================= New Vehicles ==============================================
        $sql_new_vehicles = "SELECT vehicle_types.id, vehicle_types.name, COUNT(vehicles.vehicle_type_id) AS total
        FROM vehicle_types LEFT JOIN vehicles ON vehicle_types.id = vehicles.vehicle_type_id 
        AND DATE(vehicles.updated_at) BETWEEN '$during_date' and '$to_date'
        WHERE vehicle_types.id IN ('12', '1', '109', '2', '10', '38', '46', '76', '68', '29', '27')
        GROUP BY vehicle_types.id ASC";
        $new_vehicles_result = DB::select($sql_new_vehicles);
        //dd($sql_new_vehicles);
        //======================================= Divided by  label to date =======================================
        $sql_div_by_label = "SELECT vehicle_kinds.vehicle_kind_code, vehicle_kinds.name, COUNT(vehicles.id) as total,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='12' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='12' )END)as v_12,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='1' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='1')END)as v_1,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='109' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='109')END)as v_109,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='2' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='2')END)as v_2,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='10' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='10')END)as v_10,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='38' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='38')END)as v_38,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='46' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='46')END)as v_46,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='76' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='76')END)as v_76,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='68' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='68')END)as v_68,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='29' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='29')END)as v_29,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='27' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='27')END)as v_27
        FROM vehicles
        LEFT JOIN vehicle_kinds on vehicles.vehicle_kind_code = vehicle_kinds.vehicle_kind_code 
        WHERE vehicles.vehicle_type_id IN ('12', '1', '109', '2', '10', '38', '46', '76', '68', '29', '27') 
        AND DATE(vehicles.updated_at) BETWEEN '$during_date' AND '$to_date' GROUP BY vehicle_kinds.name ORDER BY vehicle_kinds.name DESC";

        // dd($sql_div_by_label);
        $div_by_label_result = DB::select($sql_div_by_label);

        $sql_div_by_district = "SELECT districts.district_code, districts.name, COUNT(vehicles.id)as total,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='12' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='12')END)as v_12,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='1' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='1')END)as v_1,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='109' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='109')END)as v_109,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='2' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='2')END)as v_2,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='10' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='10')END)as v_10,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='38' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='38')END)as v_38,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='46' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='46')END)as v_46,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='76' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='76')END)as v_76,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='68' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='68')END)as v_68,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='29' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='29')END)as v_29,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='27' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='27')END)as v_27
        FROM vehicles 
        LEFT JOIN districts ON vehicles.district_code = districts.district_code AND districts.province_code = '$province_code'
        WHERE vehicles.vehicle_type_id IN ('12', '1', '109', '2', '10', '38', '46', '76', '68', '29', '27')
        AND DATE(vehicles.updated_at) BETWEEN '$during_date' AND '$to_date' GROUP BY districts.name ORDER BY districts.name DESC";
        //dd($sql_div_by_district);
        $div_by_district_result = DB::select($sql_div_by_district);

        $sql_div_by_brand = "SELECT vehicle_brands.id, vehicle_brands.name,COUNT(vehicles.id)as total,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='12' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='12')END)as v_12,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='1' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='1')END)as v_1,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='109' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='109')END)as v_109,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='2' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='2')END)as v_2,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='10' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='10')END)as v_10,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='38' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='38')END)as v_38,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='46' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='46')END)as v_46,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='76' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='76')END)as v_76,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='68' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='68')END)as v_68,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='29' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='29')END)as v_29,
        COUNT(CASE WHEN vehicles.vehicle_type_id ='27' THEN (SELECT COUNT(*)FROM vehicles where vehicles.vehicle_type_id ='27')END)as v_27
        FROM vehicles
        LEFT JOIN vehicle_brands on vehicles.brand_id = vehicle_brands.id 
        WHERE vehicles.vehicle_type_id IN ('12', '1', '109', '2', '10', '38', '46', '76', '68', '29', '27')
        AND DATE(vehicles.updated_at) BETWEEN '$during_date' AND '$to_date' GROUP BY vehicle_brands.name ORDER BY vehicle_brands.name DESC";
        //dd($sql_div_by_brand);
        $div_by_brand_result = DB::select($sql_div_by_brand);

        //To show in UI with UI date format
        $during_date = $request->during_date;
        $to_date = $request->to_date;

        return view('vrms2.vehicle.LoadVehicleStats', compact('new_vehicles_result', 'div_by_label_result', 'div_by_district_result', 'div_by_brand_result', 'during_date', 'to_date', 'province_name'));
    }

    public function transferModal($id)
    {
        $vehicle = Vehicle::find($id);
        if ($vehicle == null) {
            return redirect()->to('/all-vehicles')->with('error', "Your vehicle doesn't exist.");
        }
        $app_doc = VehicleDocument::whereVehicleId($id)->pluck('filename', 'doc_type_id');
        if ($app_doc->isNotEmpty()) {
            $app_doc =   $app_doc;
        } else {
            $app_doc = null;
        }
        $app_form = AppForm::whereVehicleId($id)->orderBy('id', 'desc')->first();
        return view('vrms2.vehicle.TransferModal', compact('vehicle', 'app_doc', 'app_form'));
    }

    //================================ Print Section End ================================
    //Show the form modal for pink paper 2 the specified resource.
    public function printPink2($id)
    {
        $vehicle = Vehicle::find($id);
        if ($vehicle == null) {
            return redirect()->to('/all-vehicles')->with('error', "Your vehicle doesn't exist.");
        }

        return view('Module4.registration.print.printPaper', compact('vehicle'));
    }

    //Show the form modal for editing the specified resource.
    public function pink2($id)
    {

        $vehicle = Vehicle::find($id);
        if ($vehicle == null) {
            return redirect()->to('/all-vehicles')->with('error', "Your vehicle doesn't exist.");
        }
        $app_doc = VehicleDocument::whereVehicleId($id)->pluck('filename', 'doc_type_id');
        if ($app_doc->isNotEmpty()) {
            $app_doc =   $app_doc;
        } else {
            $app_doc = null;
        }

        return view('Module4.registration.print.pink2', compact('vehicle', 'app_doc'));
    }

    public function certificate($id)
    {

        $vehicle = Vehicle::find($id);
        if ($vehicle == null) {
            return redirect()->to('/all-vehicles')->with('error', "Your vehicle doesn't exist.");
        }
        $app_doc = VehicleDocument::whereVehicleId($id)->pluck('filename', 'doc_type_id');
        if ($app_doc->isNotEmpty()) {
            $app_doc =   $app_doc;
        } else {
            $app_doc = null;
        }
        //$data = AppForm::whereVehicleId($id)->orderBy('id', 'desc')->first();
        return view('Module4.registration.print.certificate', compact('vehicle', 'app_doc'));
    }

    public function book($id)
    {
        $vehicle = Vehicle::find($id);
        if ($vehicle == null) {
            return redirect()->to('/all-vehicles')->with('error', "Your vehicle doesn't exist.");
        }

        AppForm::whereVehicleIdAndAppFormStatusId($id, 5)->update(['app_form_status_id' => 6]);
        
        return view('Module4.registration.print.book', compact('vehicle'));
    }

    public function printTransfer($id)
    {      
        $data = AppForm::whereVehicleId($id)->orderBy('id', 'desc')->first();

        return view('Module4.registration.print.print-transfer', compact('data'));
    }

    public function pinkPaperModal(Request $request)
    {
        $operation = $request->operation ;// update, new_form, pink1, pink2
        $vehicle_id = $request->vehicle_id;
        $owner_name = $request->owner_name;
        $app_form = AppForm::whereVehicleId($vehicle_id)->orderBy('id', 'desc')->first();
        
        return view('vrms2.vehicle.PinkpaperNewForm', compact('app_form', 'vehicle_id', 'owner_name', 'operation'));
    }

    public function documentCertificate($id)
    {
        $vehicle = Vehicle::find($id);

        if ($vehicle == null) {
            return redirect()->to('/all-vehicles')->with('error', "Your vehicle doesn't exist.");
        }

        $app_doc = VehicleDocument::whereVehicleId($id)->pluck('filename', 'doc_type_id');
        if ($app_doc->isNotEmpty()) {
            $app_doc =   $app_doc;
        } else {
            $app_doc = null;
        }

        //$data = AppForm::whereVehicleId($id)->orderBy('id', 'desc')->first();

        return view('Module4.registration.print.document-certificate', compact('vehicle', 'app_doc'));
    }

    public function damagedCertificate($id)
    {
        $vehicle = Vehicle::find($id);
        if ($vehicle == null) {
            return redirect()->to('/all-vehicles')->with('error', "Your vehicle doesn't exist.");
        }
        $app_doc = VehicleDocument::whereVehicleId($id)->pluck('filename', 'doc_type_id');
        if ($app_doc->isNotEmpty()) {
            $app_doc =   $app_doc;
        } else {
            $app_doc = null;
        }
        //$data = AppForm::whereVehicleId($id)->orderBy('id', 'desc')->first();
        return view('Module4.registration.print.damaged-certificate', compact('vehicle', 'app_doc'));
    }

    public function certificateUsed($id)
    {
        $vehicle = Vehicle::find($id);
        if ($vehicle == null) {
            return redirect()->to('/all-vehicles')->with('error', "Your vehicle doesn't exist.");
        }
        $app_doc = VehicleDocument::whereVehicleId($id)->pluck('filename', 'doc_type_id');
        if ($app_doc->isNotEmpty()) {
            $app_doc =   $app_doc;
        } else {
            $app_doc = null;
        }
        //$data = AppForm::whereVehicleId($id)->orderBy('id', 'desc')->first();
        return view('Module4.registration.print.certificate-used', compact('vehicle', 'app_doc'));
    }

    public function eliminateLicense($id)
    {
        $vehicle = Vehicle::find($id);

        if ($vehicle == null) {
            return redirect()->to('/all-vehicles')->with('error', "Your vehicle doesn't exist.");
        }

        $app_doc = VehicleDocument::whereVehicleId($id)->pluck('filename', 'doc_type_id');
        if ($app_doc->isNotEmpty()) {
            $app_doc =   $app_doc;
        } else {
            $app_doc = null;
        }

        return view('Module4.registration.print.elimination-license', compact('vehicle', 'app_doc'));
    }
    //================================ Print Section End ================================     

    public function editVehicle($id)
    {
        $vehicle = Vehicle::find($id);

        if ($vehicle == null) {
            return redirect()->to('/all-vehicles')->with('error', "Your vehicle doesn't exist.");
        }
        //dd($vehicle->getLicense($vehicle->province_code, $vehicle->vtype->vehicle_type_group_id, $vehicle->vehicle_kind_id));
        // $veh_info = getData::vehInfo();
        $app_doc = VehicleDocument::whereVehicleId($id)->pluck('filename', 'doc_type_id');
        if ($app_doc->isNotEmpty()) {
            $app_doc =   $app_doc;
        } else {
            $app_doc = null;
        }

        //$data = AppForm::whereVehicleId($id)->orderBy('id', 'desc')->first();


        //dd($vehicles);
        //dd($veh_info);
        //dd($vehicle_doc);
        //dd($data);
        return view('vrms2.vehicle.VehicleEditModal', compact('vehicle', 'app_doc'));
    }

    public function editEngine($id)
    {
        $vehicle = Vehicle::find($id);

        if ($vehicle == null) {
            return redirect()->to('/all-vehicles')->with('error', "Your vehicle doesn't exist.");
        }
        //dd($vehicle->getLicense($vehicle->province_code, $vehicle->vtype->vehicle_type_group_id, $vehicle->vehicle_kind_id));
        $veh_info = getData::vehInfo();
        $vehicle_doc = VehicleDocument::whereVehicleId($id)->pluck('filename', 'doc_type_id');
        if ($vehicle_doc->isNotEmpty()) {
            $vehicle_doc =   $vehicle_doc;
        } else {
            $vehicle_doc = null;
        }

        $data = AppForm::whereVehicleId($id)->orderBy('id', 'desc')->first();


        //dd($vehicles);
        //dd($veh_info);
        //dd($vehicle_doc);
        //dd($data);
        return view('vrms2.vehicle.EngineEditModal', compact('vehicle', 'veh_info', 'vehicle_doc', 'data'));
    }

    public function edit($id)
    {
        $vehicle = Vehicle::find($id);

        if ($vehicle == null) {
            return redirect()->to('/all-vehicles')->with('error', "Your vehicle doesn't exist.");
        }
        //dd($vehicle->getLicense($vehicle->province_code, $vehicle->vtype->vehicle_type_group_id, $vehicle->vehicle_kind_id));
        $veh_info = getData::vehInfo();
        $vehicle_doc = VehicleDocument::whereVehicleId($id)->pluck('filename', 'doc_type_id');
        if ($vehicle_doc->isNotEmpty()) {
            $vehicle_doc =   $vehicle_doc;
        } else {
            $vehicle_doc = null;
        }

        $data = AppForm::whereVehicleId($id)->orderBy('id', 'desc')->first();
        return view('Module4.Vehicle.edit', compact('vehicle', 'veh_info', 'vehicle_doc', 'data'));
    }

    public function updateVehicle(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            //In UI, show "0000" if licence_no is blank or null. 
            $request['licence_no'] = (request('licence_no') == "0000") ? null : request('licence_no');

            $vehicle = Vehicle::find($id);//To update
            $data =  Vehicle::find($id);//To get old record
            
            //======================== Check License No. Duplicate when License Generate =====================
            if ((!$data->licence_no && $request['licence_no'])////First Time Generate
            || (($data->vehicle_kind_code != request('vehicle_kind_code') || $data->province_code != request('province_code')) 
            && $request['licence_no']) //Generate license_no again after changing "vehicle_kind_code" and "province_code"
            ) {
                $lic_vehicle = Vehicle::where('id', '!=', $id)->where('licence_no', '=',$request['licence_no'])
                ->where('vehicle_kind_code', '=',$request['vehicle_kind_code'])
                ->where('province_code', '=',$request['province_code'])->get();

                if (count($lic_vehicle) > 0) {
                    return response()->json(['status' => 'lic_duplicate', 'message' => trans('module4.msg_lic_already_taken')]);
                }
            }

            //=================================== Update Division No. Present=================================
            if (!$data->division_no && request('division_no')) { //old_value = null && new_value != null
                $division = Vehicle::whereProvinceCodeAndDivisionNo(request('province_code'), request('division_no'))->get();

                if (count($division) > 0) {
                    return response()->json(['status' => 'div_duplicate', 'message' => str_replace('division_no', request('division_no'), trans('module4.div_ctrl_alerady_exist'))]);
                } else {
                    try {
                        $data->updateDivPresent(request('province_code'), request('division_no'));
                    } catch (\Exception $e) {
                        return response()->json([
                            'status' => 'error', 'message' => "Error in updating \"DivisionNoControl\" for \"present_division_no\".\n" . $e->getMessage(), 'errors' => $e
                        ]);
                    }
                }
            }

            //=================================== Update Province No. Present =================================
            if (!$data->province_no && request('province_no')) { //old_value = null && new_value != null
                $province = Vehicle::whereProvinceCodeAndProvinceNo(request('province_code'), request('province_no'))->get();

                if (count($province) > 0) {
                    return response()->json(['status' => 'pro_duplicate', 'message' => "Your province_no \"" . request('province_no') . "\" is already used in vehicle."]);
                } else {
                    try {
                        $data->updateProPresent(request('province_code'), request('province_no'));
                    } catch (\Exception $e) {
                        return response()->json([
                            'status' => 'error', 'message' => "Error in updating \"ProvinceNoControl\" for \"present_province_no\".\n" . $e->getMessage(), 'errors' => $e
                        ]);
                    }
                }
            }

            //========================================= Update Vehicle =======================================
            try {
                $request['view'] = empty($request->view) ? 0 : 1;
                $request['locks'] = empty($request->locks) ? 0 : 1;
                $request['tax_10_40'] = empty($request->tax_10_40) ? 0 : 1;
                $request['tax_exam'] = empty($request->tax_exam) ? 0 : 1;
                $request['tax_12'] = empty($request->tax_12) ? 0 : 1;
                $request['tax_50'] = empty($request->tax_50) ? 0 : 1;
                $request['tax_receipt'] = empty($request->tax_receipt) ? 0 : 1;
                $request['tax_permit'] = empty($request->tax_permit) ? 0 : 1;
                $request['import_permit_hsny'] = empty($request->import_permit_hsny) ? 0 : 1;
                $request['import_permit_invest'] = empty($request->import_permit_invest) ? 0 : 1;

                $vehicle->update($request->except('app_id', 'app_form_status_id', 'd2', 'd4', 'd5', 'd6', 'mistakeby', 'fax', 'old_license', 'old_engine_no', 'old_chassis_no', 'engine_already_title', 'chassis_already_title', 'license_no_already_title', 'expire_title'));
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => "Error in updating Vehicle.\n" . $e->getMessage(), 'errors' => $e]);
            }

            //========================== Update LicenseNoPresent when License Generate ========================
            if ((!$data->licence_no && $request['licence_no'])////First Time Generate
            || (($data->vehicle_kind_code != request('vehicle_kind_code') || $data->province_code != request('province_code')) 
            && $request['licence_no']) //Generate license_no again after changing "vehicle_kind_code" and "province_code"
            ) {
                try {//Update LicenseNoPresent
                    $data->updateLicenseNoPresent(request('province_code'), $request['licence_no'], request('vehicle_kind_code'), $vehicle->vtype->vehicle_type_group_id, $data->vehicle_kind_code, $data->id);
                } catch (\Exception $e) {
                    return response()->json(['status' => 'error', 'message' => "Error in updating License No. present.\n" . $e->getMessage(), 'errors' => $e]);
                }
            }

            //======================== Save Vehicle History if app_form_status_id = "All Task Complete" ======================
            if (request('app_form_status_id') == 7) {
                if ($data->owner_name != request('owner_name') || $data->vehicle_kind_code != request('vehicle_kind_code') ||
                $data->licence_no != request('licence_no') || $data->province_no != request('province_no') || $data->engine_no != request('engine_no')) {
                    try {
                        $vehicle->saveVehicleHistory($vehicle, request('app_id'));
                    } catch (\Exception $e) {
                        return response()->json(['status' => 'error', 'message' => "Error in saving Vehicle History.\n" . $e, 'errors' => $e]);
                    }
                }else if ($data->issue_date != request('issue_date') || $data->expire_date != request('expire_date')) {
                    try {
                        $vehicle->updateVehicleHistory($vehicle);
                    } catch (\Exception $e) {
                        return response()->json(['status' => 'error', 'message' => "Error in updating Vehicle History.\n" . $e, 'errors' => $e]);
                    }
                }
            }
            //========================== Update LicenseNoPresent and Save LicenseNoHistory when License Generate ========================
            if ((!$data->licence_no && $request['licence_no'])////First Time Generate
            || (($data->vehicle_kind_code != request('vehicle_kind_code') || $data->province_code != request('province_code')) 
            && $request['licence_no']) //Generate license_no again after changing "vehicle_kind_code" and "province_code"
            ) {
                try {//Save LicenseNoHistory
                    $vehicle->saveLicenseNoHistory($vehicle);
                } catch (\Exception $e) {
                    return response()->json(['status' => 'error', 'message' => "Error in saving License No. History.\n" . $e->getMessage(), 'errors' => $e]);
                }
            }
            //======================================== Save Vehicle Log ========================================
            if ($vehicle->wasChanged()) {
                $veh_log = new \App\Helpers\StoreVehicleLog;
                $veh_log->saveData($vehicle->getChanges(),  $data);
            }

            if (!$data->licence_no && $request['licence_no']) {
                if (request('app_form_status_id') == 1) {
                    AppForm::whereVehicleIdAndAppFormStatusId($id, 1)->update(['app_form_status_id' => 4]);
                } elseif (request('app_form_status_id') == 3) {
                    AppForm::whereVehicleIdAndAppFormStatusId($id, 3)->update(['app_form_status_id' => 4]);
                }
            }

            if ($vehicle->division_no) {
                if (request('app_form_status_id') == 5) {
                    AppForm::whereVehicleIdAndAppFormStatusId($id, 5)->update(['app_form_status_id' => 6]);
                }
            }
            DB::commit();

            return response()->json(['status' => 'OK', "message" => trans('module4.vehicle_update_msg')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    //when click change info, save as new app form, vehicle_history and vehicle
    public function changeInfo(Request $request, $licence)
    {
        $old_vehicle_id = Vehicle::where('licence_no', $licence)->pluck('id')->first();
        $original_data = AppForm::whereVehicleId($old_vehicle_id)->whereAppTypeId(1)->first();
        $this->saveOldData($licence);
        //$this->deleteOld($licence);
        $request->except(['_token', '_method']);
        $request['issue_date'] = DateHelper::getMySQLDateFromUIDate($request->issue_date);
        $request['expire_date'] = DateHelper::getMySQLDateFromUIDate($request->expire_date);
        $request['police_doc_date'] = DateHelper::getMySQLDateFromUIDate($request->police_doc_date);
        $request['tax_payment_date'] = DateHelper::getMySQLDateFromUIDate($request->tax_payment_date);
        $request['tax_date'] = DateHelper::getMySQLDateFromUIDate($request->tax_date);
        $request['comerce_permit_date'] = DateHelper::getMySQLDateFromUIDate($request->comerce_permit_date);
        $request['technical_doc_date'] = DateHelper::getMySQLDateFromUIDate($request->technical_doc_date);
        $request['industiral_doc_date'] = DateHelper::getMySQLDateFromUIDate($request->industiral_doc_date);
        $request['import_permit_date'] = DateHelper::getMySQLDateFromUIDate($request->import_permit_date);
        $vehicle = Vehicle::where('licence_no', '=', $licence)->first();
        $vehicle->update($request->all());

        $app_form = new AppForm();
        $app_form->app_no = \App\Helpers\getData::getAppNumber();
        $app_form->staff_id = auth()->id();
        $app_form->date_request = date('Y-m-d');
        $app_form->app_status_id = 3;
        $app_form->app_type_id = 3;
        $app_form->vehicle_id = $original_data->vehicle_id;
        $app_form->customer_name = $original_data->customer_name;
        $app_form->customer_id = $original_data->customer_id;
        $app_form->note = $original_data->note;
        $app_form->comment = $original_data->comment;
        $app_form->save();
        return redirect()->to('applications')->with('success', "Vehicle information has been changed.");
    }

    // save Old data into vehicle_history table
    public function saveOldData($licence)
    {
        $old_data = Vehicle::where('licence_no', $licence)->get()->first();
        $data = $old_data->replicate()->toArray();
        \App\Model\VehicleHistory::create($data);
    }
    // Delete old data from vehicle table
    public function deleteOld($licence)
    {
        Vehicle::whereLicenceNo($licence)->delete();
    }

    //get licence no when click button in vehicle info
    public function getLicenceNo($id)
    {
        try {
            $province_code = request('province_code');
            $vehicle_type_id = request('vehicle_type_id');
            $vehicle_kind_code = request('vehicle_kind_code');

            $vehicle_types = VehicleType::find($vehicle_type_id);

            $vehicle = new Vehicle();
            $license_arr = $vehicle->getLicense($province_code, $vehicle_types->vehicle_type_group_id, $vehicle_kind_code);

            return response()->json(['status' => "OK", 'license_msg' => $license_arr[0], 'licence_no' => $license_arr[1], 'alert_at' => $license_arr[2], 'licenseNoPresent_id' => $license_arr[3], 'text' => $license_arr[4]]);
        } catch (\Exception $e) {
            return response()->json(['status' => "error", 'error' => $e->getMessage()]);
        }
    }

    //get province_no and division_no from control table when click "A" button
    public function getDivAndProNo($province_code, $province_Name)
    {
        $vehicle = new Vehicle();
        $div_no_arr =  $vehicle->getDivNo($province_code);
        $pro_no_arr =  $vehicle->getProNo($province_code);

        //Division Message
        $division_status = $div_no_arr[0];
        $division_no = $div_no_arr[1];
        $division_msg = "";//

        if ($division_status == "normal") {
            $division_msg = "";
        } else if ($division_status == "full") {
            $division_msg = str_replace('province_name', $province_Name, trans('module4.div_ctrl_over_end'));
        } else if ($division_status == "not_exist") {
            $division_msg = str_replace('province_name', $province_Name, trans('module4.div_ctrl_no_div'));
        } else if ($division_status == "must_between") {
            $division_msg = trans('module4.div_ctrl_must_between');
        } else if ($division_status == "alert_at_equal") {
            $division_msg = str_replace('province_name', $province_Name,(str_replace('division_no', $division_no, trans('module4.div_ctrl_equal_alert'))));   
        } else if ($division_status == "alert_at_over") {
            $division_msg = str_replace('province_name', $province_Name,(str_replace('division_no', $division_no, trans('module4.div_ctrl_over_alert'))));
        } else {
            $division_msg = 'You need to check division_no control.';
        }

        //Province Message
        $province_status = $pro_no_arr[0];
        $province_no = $pro_no_arr[1];
        $province_msg = "";
        if ($province_status == "normal") {
            $province_msg = "";
        } else if ($province_status == "not_exist") {
            $province_msg = 'There is no \"Province No. Control\" for province \"' . $province_Name . '\".';
        } else {
            $province_msg = "You need to check province_no control.";
        }

        return response()->json(['div_msg' => $division_msg, 'div_no' => $division_no, 'pro_msg' => $province_msg, 'pro_no' => $province_no]);
    }

    //get buying booking license no when changing vehicle kind
    public function getLicNoChangeVehicleKind($app_id)
    {
        $app_form = \App\Model\AppForm::whereAppFormStatusIdAndId(3, $app_id)->latest()->first();
        $buy_lic_no = \App\Model\LicenseNoBooking::whereAppIdAndVehicleKindCode($app_id, request('vehicle_kind'))->pluck('license_no_book_number')->last();
        if ($buy_lic_no != null && $app_form != null) {
            return $buy_lic_no;
        } else {
            return $lic_no = "not-exist";
        }
    }

    public function printButtonsModal(Request $request)
    {
        $vehicle_id = $request->vehicle_id;
        $button_type = $request->button_type;

        $vehicle = Vehicle::find($vehicle_id);

        $vehicle_print_detail = VehiclePrintDetail::whereVehiclesIdAndPrintType($vehicle_id, $button_type)->first();

        return view('vrms2.vehicle.PrintButtonsModal', compact('vehicle', 'button_type', 'vehicle_print_detail'));
    }

    public function searchLicenseNo(Request $request)
    {
        try {
            $license_no = $request->license_no;
            $vehicle = Vehicle::whereLicenceNo($license_no)->first();

            if ($vehicle) {
                return response()->json(['status' => 'OK', 'vehicle_id' => $vehicle->id]);
            } else {
                return response()->json(['status' => "NOT_OK", 'not_found_msg' => trans('module4.no_lic_msg')]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e]);
        }
    }

    public function add_vehicle_modal(Request $request)
    {
        $vehicle_id = $request->vehicle_id;
        $s_type = $request->s_type;
        return view('vrms2.vehicle.add_vehicle_modal', compact('vehicle_id', 's_type'));
    }

    public function addVillageColorModel(Request $request)
    {
        try {
            $vehicle_id = $request->vehicle_id;
            $district_code = $request->district_code;
            $village_name = $request->village_name;
            $color_name = $request->color_name;
            $model_name = $request->model_name;
            $vehicle_brand = $request->vehicle_brand;
            $s_type = $request->s_type;

            if ($s_type == "VillageName") {
                $village = Village::where(function ($query) use ($district_code, $village_name) {
                    $query->where([['district_code', '=', $district_code], ['name', '=', $village_name]])
                        ->orWhere([['district_code', '=', $district_code], ['name_en', '=', $village_name]]);
                })->first();

                if ($village) {
                    return response()->json(['status' => 'OK', 'operation' => 'not_add', 'id' => $village->id, 'success_msg' => trans('module4.sus_village_msg')]);
                } else {
                    $new_village = Village::create([
                        'name' => $village_name,
                        'district_code' => $district_code,
                        'created_by' => auth()->id()
                    ])->id;

                    return response()->json(['status' => 'OK', 'operation' => 'add', 'id' => $new_village, 'success_msg' => trans('module4.sus_village_msg')]);
                }
            } else if ($s_type == "Color") {
                $color = Color::where(function ($query) use ($color_name) {
                    $query->where('name', '=', $color_name)
                        ->orWhere('name_en', '=', $color_name);
                })->first();

                if ($color) {
                    return response()->json(['status' => 'OK', 'operation' => 'not_add', 'id' => $color->id, 'success_msg' => trans('module4.sus_color_msg')]);
                } else {
                    $new_color = Color::create([
                        'name' => $color_name,
                        'created_by' => auth()->id()
                    ])->id;

                    return response()->json(['status' => 'OK', 'operation' => 'add', 'id' => $new_color, 'success_msg' => trans('module4.sus_color_msg')]);
                }
            } else if ($s_type == "Model") {
                $vehicleModel = VehicleModel::where(function ($query) use ($vehicle_brand, $model_name) {
                    $query->where([['brand_id', '=', $vehicle_brand], ['name', '=', $model_name]])
                        ->orWhere([['brand_id', '=', $vehicle_brand], ['name_en', '=', $model_name]]);
                })->first();

                if ($vehicleModel) {
                    return response()->json(['status' => 'OK', 'operation' => 'not_add', 'id' => $vehicleModel->id, 'success_msg' => trans('module4.sus_model_msg')]);
                } else {
                    $new_vehicleModel = VehicleModel::create([
                        'name' => $model_name,
                        'brand_id' => $vehicle_brand,
                        'created_by' => auth()->id()
                    ])->id;

                    return response()->json(['status' => 'OK', 'operation' => 'add', 'id' => $new_vehicleModel, 'success_msg' => trans('module4.sus_model_msg')]);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e]);
        }
    }

    public function showVehicle($id)
    {
        $vehicle = Vehicle::find($id);

        if ($vehicle == null) {
            return redirect()->to('/all-vehicles')->with('error', "Your vehicle doesn't exist.");
        }

        $app_doc = VehicleDocument::whereVehicleId($id)->pluck('filename', 'doc_type_id');
        if ($app_doc->isNotEmpty()) {
            $app_doc =   $app_doc;
        } else {
            $app_doc = null;
        }

        return view('vrms2.vehicle.ShowVehicleModal', compact('vehicle', 'app_doc'));
    }

    public function card_modal(Request $request)
    {
        $vehicle = Vehicle::find($request->vehicle_id);
        return view('vrms2.vehicle.CardModal', compact('vehicle'));
    }

    //=========================== Not Use ==========================

    public function index()
    {
        return view('Module4.Vehicle.index');
    }

    public function vehicleList()
    {

        if (request()->ajax()) {
            $user_status = auth()->user()->user_status;
            switch ($user_status) {
                case "book_print":
                    if (auth()->user()->user_level == "province") {
                        $data1 = Vehicle::whereProvinceCode(\App\Helpers\Helper::current_province())->with('province', 'vbrand')->whereHas('app_form', function ($q) {
                            $q->whereHas('appFormPurpose', function ($purpose) {
                                $purpose->whereIn('app_purpose_id', [1, 2, 3, 4, 7, 8]);
                            })->whereAppFormStatusId(5);
                        });
                        $data = Vehicle::whereProvinceCode(\App\Helpers\Helper::current_province())->with('province', 'vbrand')->whereHas('app_form', function ($q) {
                            $q->whereHas('appFormPurpose', function ($purpose) {
                                $purpose->where('app_purpose_id', 5);
                            })->whereAppFormStatusId(3);
                        })->union($data1)->orderByDesc('updated_at');
                    } else {
                        $data1 = Vehicle::with('province', 'vbrand')->whereHas('app_form', function ($q) {
                            $q->whereHas('appFormPurpose', function ($purpose) {
                                $purpose->whereIn('app_purpose_id', [1, 2, 3, 4, 7, 8]);
                            })->whereAppFormStatusId(5);
                        });
                        $data = Vehicle::with('province', 'vbrand')->whereHas('app_form', function ($q) {
                            $q->whereHas('appFormPurpose', function ($purpose) {
                                $purpose->where('app_purpose_id', 5);
                            })->whereAppFormStatusId(3);
                        })->union($data1)->orderByDesc('updated_at');
                    }
                    break;
                case "card_print":
                    if (auth()->user()->user_level == "province") {
                        $data1 = Vehicle::whereProvinceCode(\App\Helpers\Helper::current_province())->with('province', 'vbrand')->whereHas('app_form', function ($q) {
                            $q->whereHas('appFormPurpose', function ($purpose) {
                                $purpose->whereIn('app_purpose_id', [3, 4, 7, 8]);
                            })->whereAppFormStatusId(3);
                        });
                        $data = Vehicle::whereProvinceCode(\App\Helpers\Helper::current_province())->with('province', 'vbrand')->whereHas('app_form', function ($q) {
                            $q->whereHas('appFormPurpose', function ($purpose) {
                                $purpose->whereIn('app_purpose_id', [1, 2, 4]);
                            })->whereAppFormStatusId(4);
                        })->union($data1)->orderByDesc('updated_at');
                    } else {
                        $data1 = Vehicle::with('province', 'vbrand')->whereHas('app_form', function ($q) {
                            $q->whereHas('appFormPurpose', function ($purpose) {
                                $purpose->whereIn('app_purpose_id', [3, 4, 7, 8]);
                            })->whereAppFormStatusId(3);
                        });
                        $data = Vehicle::with('province', 'vbrand')->whereHas('app_form', function ($q) {
                            $q->whereHas('appFormPurpose', function ($purpose) {
                                $purpose->whereIn('app_purpose_id', [1, 2, 4]);
                            })->whereAppFormStatusId(4);
                        })->union($data1)->orderByDesc('updated_at');
                    }
                    break;
                case "license_control":
                    if (auth()->user()->user_level == "province") {
                        $data = Vehicle::whereProvinceCode(\App\Helpers\Helper::current_province())->with('province', 'vbrand')->whereHas('app_form', function ($q) {
                            $q->whereHas('appFormPurpose', function ($purpose) {
                                $purpose->whereIn('app_purpose_id', [1, 2]);
                            })->whereAppFormStatusId(3);
                        })->orderByDesc('updated_at');
                    } else {
                        $data = Vehicle::with('province', 'vbrand')->whereHas('app_form', function ($q) {
                            $q->whereHas('appFormPurpose', function ($purpose) {
                                $purpose->whereIn('app_purpose_id', [1, 2]);
                            })->whereAppFormStatusId(3);
                        })->orderByDesc('updated_at');
                    }
                    break;
                case "counter_calling":
                    if (auth()->user()->user_level == "province") {
                        $data1 = Vehicle::whereProvinceCode(\App\Helpers\Helper::current_province())->with('province', 'vbrand')->whereHas('app_form', function ($q) {
                            $q->whereHas('appFormPurpose', function ($purpose) {
                                $purpose->where('app_purpose_id', 5);
                            })->whereAppFormStatusId(4);
                        });
                        $data = Vehicle::whereProvinceCode(\App\Helpers\Helper::current_province())->with('province', 'vbrand')->whereHas('app_form', function ($q) {
                            $q->whereHas('appFormPurpose', function ($purpose) {
                                $purpose->whereIn('app_purpose_id', [1, 2, 3, 4, 7, 8]);
                            })->whereAppFormStatusId(6);
                        })->union($data1)->orderByDesc('updated_at');
                    } else {
                        $data1 = Vehicle::with('province', 'vbrand')->whereHas('app_form', function ($q) {
                            $q->whereHas('appFormPurpose', function ($purpose) {
                                $purpose->where('app_purpose_id', 5);
                            })->whereAppFormStatusId(4);
                        });
                        $data = Vehicle::with('province', 'vbrand')->whereHas('app_form', function ($q) {
                            $q->whereHas('appFormPurpose', function ($purpose) {
                                $purpose->whereIn('app_purpose_id', [1, 2, 3, 4, 7, 8]);
                            })->whereAppFormStatusId(6);
                        })->union($data1)->orderByDesc('updated_at');
                    }
                    break;
                case "lock_vehicle":
                    if (auth()->user()->user_level == "province") {
                        $data = Vehicle::whereProvinceCode(\App\Helpers\Helper::current_province())->with('province', 'vbrand')->whereHas('app_form', function ($q) {
                            $q->whereHas('appFormPurpose', function ($purpose) {
                                $purpose->whereIn('app_purpose_id', [1, 2, 3, 4]);
                            })->whereAppFormStatusId(3);
                        })->orderByDesc('updated_at');
                    } else {
                        $data = Vehicle::with('province', 'vbrand')->whereHas('app_form', function ($q) {
                            $q->whereHas('appFormPurpose', function ($purpose) {
                                $purpose->whereIn('app_purpose_id', [1, 2, 3, 4]);
                            })->whereAppFormStatusId(3);
                        })->orderByDesc('updated_at');
                    }
                    break;
                default:
                    if (auth()->user()->user_level == "province") {
                        $data = Vehicle::whereProvinceCode(\App\Helpers\Helper::current_province())->with('province', 'vbrand')->orderByDesc('updated_at');
                    } else {
                        $data = Vehicle::with('province', 'vbrand')->orderByDesc('updated_at');
                    }
            }

            return DataTables::eloquent($data)
                ->addColumn('province', function (Vehicle $vehicle) {
                    return $vehicle->province->name;
                })
                ->addColumn('vbrand', function (Vehicle $vehicle) {
                    return $vehicle->vbrand->name;
                })
                ->addColumn('action', function (Vehicle $vehicle) {
                    return '<a href="/all-vehicles/edit/' . $vehicle->id . '" class="btn btn-info">Edit</a>';
                })
                ->toJson();
        }

        //return DataTables::of(Vehicle::query())->make(true);

    }

    /* new vehicle form */
    public function newVehicle()
    {
        $data = \App\Helpers\getData::vehInfo();
        return view('vrms2.vehicle.VehicleNewModal', compact('data'));
    }
    /* new vehicle form end */


    /* load vehicle list */
    public function loadVehicles_old()
    {
        //============================= Getting Data By Stroed Procedure ==============================
        // $vehicle_result = DB::select("CALL getVehicleData()");

        // //We will show just only 20 records in each page. For next page, we will get data and show when click next/prev button.
        // $vehicles = array_slice($vehicle_result,0, 20);

        // $total_vehicles = count($vehicle_result);
        // $num = ceil($total_vehicles / 20);
        // $total_pages = number_format($num, 0, ".", "");

        // return view('vrms2.vehicle.LoadVehicles', compact('vehicles', 'total_pages', 'total_vehicles'));  
        //============================= Call to Create Query ==============================
        $sql_query = $this->create_query_old();

        $sql_query = trim($sql_query, " WHERE ") . " ORDER BY updated_at DESC LIMIT 20";
        //dd($sql_query);
        $vehicle_result = DB::select($sql_query);

        //We will show just only 20 records in each page. For next page, we will get data and show when click next/prev button.
        $vehicles = array_slice($vehicle_result, 0, 20);

        $total_vehicles = count($vehicle_result);
        $num = ceil($total_vehicles / 20);
        $total_pages = number_format($num, 0, ".", "");

        return view('vrms2.vehicle.LoadVehicles', compact('vehicles', 'total_pages', 'total_vehicles'));
    }

    /* load vehicle list end */


    /* search vehicle list here */
    public function searchVehicles_old(Request $request)
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

        //============================= Call to Create Query ==============================
        $sql_query = $this->create_query_old();

        //============================= Create WHERE Clause ==============================
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

        return view('vrms2.vehicle.SearchVehicles', compact('vehicles', 'total_vehicles', 'total_pages'));
    }

    /* search vehicle list end */

    public function create_query_old()
    {
        $user_status = auth()->user()->user_status;

        $sql_query = "";
        $sql_vehicle = "";

        $sql_main = "";
        $sql_app_form = "";
        $sql_1 = "";
        $sql_2 = "";

        $app_purpose_id_1 = "";
        $app_form_status_id_1 = "";
        $app_purpose_id_2 = "";
        $app_form_status_id_2 = "";

        $sql_main = "SELECT vehicles.* FROM vehicles";

        $sql_app_form = " LEFT JOIN app_forms ON vehicles.id = app_forms.vehicle_id
        LEFT JOIN app_form_purposes ON app_forms.id = app_form_purposes.app_form_id WHERE ";

        switch ($user_status) {
            case "book_print":
                $app_purpose_id_1 = "(1, 2, 3, 4, 7, 8)";
                $app_form_status_id_1 = "5";

                $app_purpose_id_2 = "(5)";
                $app_form_status_id_2 = "3";
                break;
            case "card_print":
                $app_purpose_id_1 = "(3, 4, 7, 8)";
                $app_form_status_id_1 = "3";

                $app_purpose_id_2 = "(1, 2, 4)";
                $app_form_status_id_2 = "4";
                break;
            case "license_control":
                $app_purpose_id_1 = "(1, 2)";
                $app_form_status_id_1 = "3";

                $app_purpose_id_2 = "";
                $app_form_status_id_2 = "";
                break;
            case "counter_calling":
                $app_purpose_id_1 = "(5)";
                $app_form_status_id_1 = "4";

                $app_purpose_id_2 = "(1, 2, 3, 4, 7, 8)";
                $app_form_status_id_2 = "6";
                break;
            case "lock_vehicle":
                $app_purpose_id_1 = "(1, 2, 3, 4)";
                $app_form_status_id_1 = "3";

                $app_purpose_id_2 = "";
                $app_form_status_id_2 = "";
                break;
            default:
                $app_purpose_id_1 = "";
                $app_form_status_id_1 = "";

                $app_purpose_id_2 = "";
                $app_form_status_id_2 = "";
        }

        //==================================== Create Vehicle Query ======================================
        //If user_level is admin, need to extract only vehicle list.
        if ($app_purpose_id_1 == "" && $app_form_status_id_1 == "" && $app_purpose_id_2 == "" && $app_form_status_id_2 == "") {
            if (auth()->user()->user_level == "province") {
                $sql_vehicle = $sql_main . " WHERE vehicles.province_code = '" . \App\Helpers\Helper::current_province() . "'";
            } else {
                $sql_vehicle =  $sql_main;
            }
        } else {
            $sql_main = $sql_main . $sql_app_form;

            if (auth()->user()->user_level == "province") {
                $sql_main = $sql_main . "vehicles.province_code = '" . \App\Helpers\Helper::current_province() . "' AND ";
            }

            $sql_1 = $sql_main . "app_form_purposes.app_purpose_id IN " . $app_purpose_id_1 .
                " AND app_forms.app_form_status_id = " . $app_form_status_id_1;

            //For license_control and lock_vehicle, no need to UNION.
            if (!($app_purpose_id_2 == "" && $app_form_status_id_2 == "")) {
                $sql_2 = " UNION " . $sql_main . "app_form_purposes.app_purpose_id IN " . $app_purpose_id_2 .
                    " AND app_forms.app_form_status_id = " . $app_form_status_id_2;
            }

            $sql_vehicle = $sql_1 . $sql_2;
        }
        //==================================== End Create Vehicle Query ======================================

        //==================================== Create Main Query ======================================
        $sql_select = "SELECT DISTINCT vehicles.*, vehicle_kinds.name as vehicle_kind_name, vehicle_brands.name as brand_name
        , vehicle_models.name as model_name, colors.name as color_name, districts.name as district_name
        , provinces.name as province_name, vehicle_types.name as vehicle_type_name 
        FROM (";
        $sql_join = ")as vehicles
        LEFT JOIN provinces ON vehicles.province_code = provinces.province_code 
        LEFT JOIN vehicle_types ON vehicles.vehicle_type_id = vehicle_types.id
        LEFT JOIN vehicle_brands ON vehicles.brand_id = vehicle_brands.id
        LEFT JOIN vehicle_models ON vehicles.model_id = vehicle_models.id
        LEFT JOIN colors ON vehicles.color_id = colors.id
        LEFT JOIN vehicle_kinds ON vehicles.vehicle_kind_code = vehicle_kinds.vehicle_kind_code
        LEFT JOIN districts ON vehicles.district_code = districts.district_code WHERE ";

        $sql_query = $sql_select . $sql_vehicle . $sql_join;

        return $sql_query;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Module4.Vehicle.create');
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
    //=========================== Not Use ==========================
}
