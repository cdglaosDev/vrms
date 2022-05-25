<?php

namespace App\Http\Controllers\Module4;

use App\Model\AppForm;
use App\Model\Vehicle;
use App\Helpers\getData;
use Illuminate\Http\Request;
use App\Model\AppFormPurpose;
use App\Model\TransferVehicle;
use App\Helpers\GenerateCodeNo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Model\TransferVehicleDetail;
use App\Model\VehicleHistory;

class VehicleTransfer extends Controller
{
    function __construct()
    {

        $this->middleware('permission:Vehicle-Transferring-List-View');
        $this->middleware('permission:Vehicle-Transferring-List-Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Vehicle-Transferring-Entry-Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Vehicle-Transferring-Entry-Delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Module4.VehicleTransfer.transfer-page');
    }

    //vehicle transfer In
    public function transferList($type)
    {
        switch ($type) {
            case "out":
                if (auth()->user()->user_level == "province") {
                    $vehicle = TransferVehicle::whereStatusAndTransferFrom('inprogress', \App\Helpers\Helper::current_province())->orderByDesc('id')->get();
                } else {
                    $vehicle = TransferVehicle::whereStatus('inprogress')->orderByDesc('id')->get();
                }

                break;
            case "in":
                if (auth()->user()->user_level == "province") {
                    $vehicle = TransferVehicle::whereStatusAndTransferTo('transfer_out_complete', \App\Helpers\Helper::current_province())->orderByDesc('id')->get();
                } else {
                    $vehicle = TransferVehicle::whereStatus('transfer_out_complete')->orderByDesc('id')->get();
                }

                break;
        }

        $total_records = count($vehicle);
        $num = ceil($total_records / 20);
        $total_pages = number_format($num, 0, ".", "");

        //We will show just only 20 records in each page. For next page, we will get data and show when click next/prev button.
        $vehicles = array_slice($vehicle->toArray(), 0, 20);

        //dd($vehicle[0]);
        return view('Module4.VehicleTransfer.index', compact('vehicle', 'total_records', 'total_pages'), ['type' => ucfirst($type)]);
    }

    //search licence no when did something
    public function searchLicence(Request $request)
    {
        $lic_no = $request->get('q');

        if ($lic_no == null) {
            return back()->with('error', "Please enter Licence no.");
        }
        $data['app_form'] = AppForm::whereHas('vehicle',  function ($q) use ($lic_no) {
            $q->where('licence_no', $lic_no);
        })->first();
        $data['data'] = getData::vehInfo();
        if (count($data['app_form']) > 0) {
            if ($request->page == "transfer") {

                return view('Module4.VehicleTransfer.create', $data);
            } else if ($request->page == "inspect") {
                return view('Module4.VehicleInspection.create', $data);
            } else if ($request->page == "application") {

                $data['veh_doc'] = \App\Model\VehicleDocument::whereVehicleId($data['app_form']['vehicle_id'])->get();
                return view('Module4.registration.edit', $data);
            } else {
                $data['vehicle'] = \App\Model\Vehicle::whereId($data['app_form']['vehicle_id'])->first();

                return view('Module4.Vehicle.edit', $data);
            }
        }
        return back()->with('error', "Not found you licence no.");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('Module4.VehicleTransfer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // create new app form for transfer
            $app_form = AppForm::whereVehicleId($request->vehicle_id)->whereNotIn('app_form_status_id', [1, 2])->get()->first();

            if ($app_form != null) {
                try {
                    $af = new AppForm();
                    $af->date_request = date('d/m/Y');//If use 'Y-m-d', will get error because of the Model's date getter/setter.
                    $af->vehicle_id = $request->vehicle_id;
                    $af->staff_id = auth()->id();
                    $af->app_no = $request->app_request_no;
                    $af->app_form_status_id = 1;
                    $af->customer_name = $request->owner_name;
                    $af->save();
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => 'error', 'message' => "Error in creating \"AppForm\".", 'errors' => $e
                    ]);
                }
                try {
                    $afpp = new AppFormPurpose();
                    $afpp->app_purpose_id = 6;
                    $afpp->app_form_id = $af->id;
                    $afpp->save();
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => 'error', 'message' => "Error in creating \"AppFormPurpose\".", 'errors' => $e
                    ]);
                }

                try {
                    $tfveh = new TransferVehicle();
                    $tfveh->app_form_id = $af->id;
                    $tfveh->transfer_no = $request->transfer_no;
                    $tfveh->transfer_date = date('d/m/Y');//If use 'Y-m-d', will get error because of the Model's date getter/setter.
                    $tfveh->transfer_from = $request->transfer_from;
                    $tfveh->transfer_to = $request->transfer_to;
                    $tfveh->old_vehicle_number = $request->old_vehicle_number;
                    $tfveh->remark = $request->remark;
                    $tfveh->status = "inprogress";
                    $tfveh->approved_officer = auth()->id();
                    $tfveh->app_request_no = $request->app_request_no;
                    $tfveh->transfer_dep_no = $request->transfer_dep_no;
                    $tfveh->transfer_tel_no = $request->transfer_tel_no;
                    $tfveh->save();
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => 'error', 'message' => "Error in creating \"TransferVehicle\".", 'errors' => $e
                    ]);
                }

                try {
                    foreach ($request->doc_name as $key => $value) {
                        $tran_doc = array(
                            'transfer_vehicle_id' => $tfveh->id,
                            'note' => $request->note[$key],
                            'unit' => $request->unit[$key],
                            'doc_name' => $value,
                        );
                        TransferVehicleDetail::insert($tran_doc);
                    }
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => 'error', 'message' => "Error in inserting \"TransferVehicleDetail\".", 'errors' => $e
                    ]);
                }

                return response()->json(['status' => 'OK', "message" => "Successful Vehicle Transfer submitted."]);
            } else {
                return response()->json(['status' => 'error', "message" => "Your Vehicle cannot transfer.Please check \"App Form\"."]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e]);
        }
    }

    public function transferOutAction($action, $app_form_id, $transfer_id)
    {
        DB::beginTransaction();
        $app_form = AppForm::find($app_form_id);
        $app_form->update(['staff_id' => auth()->id(), 'app_form_status_id' => 7]);

        if ($action == "approve"){
            $transfer_vehicle = TransferVehicle::find($transfer_id);
            $transfer_vehicle->update(['status' => "transfer_out_complete", 'approved_officer' => auth()->id()]);


            //======================== Save Vehicle History if app_form_status_id = "All Task Complete" ======================
            $vehicle =  Vehicle::find($app_form->vehicle_id);
            
            if(VehicleHistory::whereIdAndOwnerNameAndVehicleKindCodeAndLicenceNoAndProvinceNoAndEngineNo($vehicle->id
            , $vehicle->owner_name, $vehicle->vehicle_kind_code, $vehicle->licence_no
            , $vehicle->province_no, $vehicle->engine_no)->exists()){
                $vehicle->updateVehicleHistory($vehicle);
            }else {
                $vehicle->saveVehicleHistory($vehicle, $app_form->id);
            }
        }
        else if ($action == "cancel"){
            TransferVehicle::where('id', $transfer_id)->update(['status' => "transfer_cancel", 'approved_officer' => auth()->id()]);
        }
        DB::commit();
        return redirect('/vehicle-transfer-list/out');
    }

    public function transferInAction($action, $app_form_id, $transfer_id, $transfer_to)
    {
        if ($action == "approve") {
            $app_form = AppForm::where('id', $app_form_id)->first();
            $app_form = $app_form->replicate();
            $app_form->staff_id = auth()->id();
            $app_form->app_form_status_id = 1;
            $app_form->app_no = getData::getAppNumber();
            $app_form->save();

            $afpp = new AppFormPurpose();
            $afpp->app_purpose_id = 1;
            $afpp->app_form_id = $app_form->id;
            $afpp->save();

            $transfer = TransferVehicle::where('id', $transfer_id)->first();
            $transfer->update(['status' => "transfer_in_complete", 'approved_officer' => auth()->id()]);
            $vehicle = Vehicle::find($app_form->vehicle_id);
            // $vehicle->saveOldData($vehicle);
            $vehicle->update([
                'province_no' => "",
                'province_code' => $transfer->$transfer_to,
                'licence_no' => "",
                'district_code' => "0",
                'reg_complete' => "0",
                'transfer_no' => $transfer->transfer_no
            ]);
            return redirect('/vehicle-transfer-list/in');
        }
    }

    public function transferInfo($action, $id)
    {
        $data['transfer'] = TransferVehicle::with('AppForm.vehicle')->whereId($id)->first();
        $data['transfer_detail'] = TransferVehicleDetail::where('transfer_vehicle_id', $id)->get();
        $data['data'] = getData::vehInfo();
        $data['action'] = $action;
        $data['app_form'] = AppForm::whereId($data['transfer']->app_form_id)->orderBy('id', 'desc')->first();

        // dd($data['app_form']->vehicle->division_no."::".$data['app_form']->customer_name."::".$data['app_form']->TransferVehicle->transfer_no);
        return view('Module4.VehicleTransfer.show', $data);
        //return view('Module4.VehicleTransfer.show', compact('data', 'app_form'));
    }

    public function transferInActions(Request $request)
    {
        if ($request->action == "approve") {
            $app_form = AppForm::where('id', $request->app_form_id)->first();
            $app_form = $app_form->replicate();
            $app_form->staff_id = auth()->id();
            $app_form->app_form_status_id = 1;
            $app_form->app_no = getData::getAppNumber();
            $app_form->save();

            $afpp = new AppFormPurpose();
            $afpp->app_purpose_id = 1;
            $afpp->app_form_id = $app_form->id;
            $afpp->save();

            $transfer = TransferVehicle::where('id', $request->transfer_id)->first();
            $transfer->update(['status' => "transfer_in_complete", 'approved_officer' => auth()->id()]);

            $vehicle = Vehicle::find($app_form->vehicle_id);
            //$vehicle->saveOldData($vehicle);
            $vehicle->update([
                'province_no' => "",
                'province_code' => $transfer->transfer_to,
                'licence_no' => "",
                'district_code' => "0",
                'reg_complete' => "0",
                'transfer_no' => $transfer->transfer_no
            ]);
        } else { //Transit
            TransferVehicle::where('id', $request->transfer_id)->update(['transfer_to' => $request->transer_to, 'status' => "transfer_out_complete", 'approved_officer' => auth()->id()]);
        }

        return redirect('/vehicle-transfer-list/in');
    }

    public function approveAllTransfers(Request $request)
    {
        $transfer_ids = explode(',', $request->lst_transfer_id);
        if ($request->transfer_type == "Out") {
            foreach ($transfer_ids as $key => $transfer_id) {
                $transfer_vehicle =  TransferVehicle::find($transfer_id);

                AppForm::where('id', $transfer_vehicle->app_form_id)->update(['staff_id' => auth()->id(), 'app_form_status_id' => 7]);
                TransferVehicle::where('id', $transfer_id)->update(['status' => "transfer_out_complete", 'approved_officer' => auth()->id()]);
            }

            return redirect('/vehicle-transfer-list/out');
        } else {
            foreach ($transfer_ids as $key => $transfer_id) {
                $transfer = TransferVehicle::where('id', $transfer_id)->first();

                $app_form = AppForm::where('id', $transfer->app_form_id)->first();
                $app_form = $app_form->replicate();
                $app_form->staff_id = auth()->id();
                $app_form->app_form_status_id = 1;
                $app_form->app_no = getData::getAppNumber();
                $app_form->save();

                $afpp = new AppFormPurpose();
                $afpp->app_purpose_id = 1;
                $afpp->app_form_id = $app_form->id;
                $afpp->save();

                $transfer->update(['status' => "transfer_in_complete", 'approved_officer' => auth()->id()]);

                $vehicle = Vehicle::find($app_form->vehicle_id);
                //$vehicle->saveOldData($vehicle);
                $vehicle->update([
                    'province_no' => "",
                    'province_code' => $transfer->transfer_to,
                    'licence_no' => "",
                    'district_code' => "0",
                    'reg_complete' => "0",
                    'transfer_no' => $transfer->transfer_no
                ]);
            }

            return redirect('/vehicle-transfer-list/in');
        }
    }

    public function searchTransfer(Request $request)
    {
        $cpage = $request->current_page;
        $spage = $request->search_page;

        $transfer_in_out = $request->transfer_in_out;
        $transfer_no = $request->transfer_no;
        $license_no = $request->license_no;
        $general = $request->general;
        $province_name = $request->province_name;
        $village_name = $request->village_name;
        $owner_name = $request->owner_name;
        $vehicle_kind_code = $request->vehicle_kind_code;
        $issue_date = $request->issue_date;
        $sortBy = empty($request->sortBy) ? 'transfer_vehicles.id' : $request->sortBy;

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

        $sql_query = "SELECT vehicles.*, app_forms.app_no, transfer_vehicles.transfer_no
            , TT.name as province_tran_to, TF.name as province_tran_from
            , transfer_vehicles.transfer_date, vehicle_kinds.name as vehicle_kind_name
            , districts.name as district_name, provinces.name as province_name
            , vehicle_types.name as vehicle_type_name, app_form_status.name as app_form_status_name
            , transfer_vehicles.id as transfer_id, transfer_vehicles.app_form_id, transfer_vehicles.transfer_to
            FROM vehicles 
            LEFT JOIN provinces ON vehicles.province_code = provinces.province_code 
            LEFT JOIN vehicle_types ON vehicles.vehicle_type_id = vehicle_types.id
            LEFT JOIN vehicle_brands ON vehicles.brand_id = vehicle_brands.id
            LEFT JOIN vehicle_models ON vehicles.model_id = vehicle_models.id
            LEFT JOIN colors ON vehicles.color_id = colors.id
            LEFT JOIN vehicle_kinds ON vehicles.vehicle_kind_code = vehicle_kinds.vehicle_kind_code
            LEFT JOIN districts ON vehicles.district_code = districts.district_code
            LEFT JOIN app_forms ON vehicles.id = app_forms.vehicle_id
            LEFT JOIN app_form_status ON app_forms.app_form_status_id = app_form_status.id
            INNER JOIN transfer_vehicles ON app_forms.id = transfer_vehicles.app_form_id 
            LEFT JOIN provinces AS TT ON transfer_vehicles.transfer_to = TT.province_code
            LEFT JOIN provinces AS TF ON transfer_vehicles.transfer_from = TF.province_code
            WHERE ";

        switch (strtoupper($transfer_in_out)) {
            case "OUT":
                if (auth()->user()->user_level == "province") {
                    $sql_query = $sql_query . "transfer_vehicles.status = 'inprogress' AND transfer_vehicles.transfer_from = '" . \App\Helpers\Helper::current_province() . "' AND ";
                } else {
                    $sql_query = $sql_query . "transfer_vehicles.status = 'inprogress' AND ";
                }

                break;
            case "IN":
                if (auth()->user()->user_level == "province") {
                    $sql_query = $sql_query . "transfer_vehicles.status = 'transfer_out_complete' AND transfer_vehicles.transfer_to = '" . \App\Helpers\Helper::current_province() . "' AND ";
                } else {
                    $sql_query = $sql_query . "transfer_vehicles.status = 'transfer_out_complete' AND ";
                }
                break;
        }
        if (!empty($transfer_no)) {
            $sql_query = $sql_query . "transfer_vehicles.transfer_no like '%" . "$transfer_no" . "%' AND ";
        } else {
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
        }
        $sql_query = trim($sql_query, " AND ") . " ORDER BY " . $sortBy . " DESC";
        //dd($sql_query);
        $vehicle_result = DB::select($sql_query);

        //We will show just only 20 records in each page. For next page, we will get data and show when click next/prev button.
        $vehicles = array_slice($vehicle_result, $pagination, 20);

        $total_records = count($vehicle_result);
        $num = ceil($total_records / 20);
        $total_pages = number_format($num, 0, ".", "");

        return view('Module4.VehicleTransfer.search', compact('vehicles', 'total_records', 'total_pages', 'transfer_in_out'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($mode,$action,$id)
    // {
    //     $data['transfer'] = TransferVehicle::with('AppForm.vehicle')->whereId($id)->first();
    //     $data['transfer_detail'] = TransferVehicleDetail::where('transfer_vehicle_id',$id)->get();
    //     $data['data'] = getData::vehInfo();
    //     return view('Module4.VehicleTransfer.show', $data);
    // }

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

    // public function approveTransfer($id)
    // {

    //       TransferVehicle::whereId($id)->update(['status'=>'complete_transfer']);
    //       return response()->json($id);
    // }
}
