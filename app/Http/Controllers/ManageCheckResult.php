<?php

namespace App\Http\Controllers;
use App\Model\VehicleCheckResult;
use App\Model\AppForm;
use Illuminate\Http\Request;

class ManageCheckResult extends Controller
{
    public function index()
    {
        $checkresult = VehicleCheckResult::orderByDesc('created_at')->get();
        return view('ManageCheckResult.index', compact('checkresult'));
    }

    public function create()
    {
        $applictaion_form = AppForm::all();
        $checkresult = VehicleCheckResult::all();
        return view('ManageCheckResult.create', compact('applictaion_form', 'checkresult'));
    }

    public function store()
    {
        $data = request() -> validate([
            'app_form_id' => 'required',
            'name' => 'required',
            'name_en' => 'required',
            'result' => 'required',
            'remark' => 'required',
        ]);

        $checkresult = new VehicleCheckResult();
        $checkresult -> app_form_id = request('app_form_id');
        $checkresult -> name = request('name');
        $checkresult -> name_en = request('name_en');
        $checkresult -> result = request('result');
        $checkresult -> remark = request('remark');
        $checkresult -> save();
        return redirect('check-result')->with('success', 'Sucessful Created');
    }

    public function show(VehicleCheckResult $check_result)
    {
        $applictaion_form = AppForm::all();
        return view('ManageCheckResult.show', compact('application_form', 'checkresult'));
    }

    public function edit(VehicleCheckResult $check_result)
    {
        $applictaion_form = AppForm::all();
        return view('ManageCheckResult.edit', compact('applictaion_form', 'check_result'));
    }

    public function update(VehicleCheckResult $check_result)
    {
        $data = VehicleCheckResult::find($check_result -> id);
        \LogActivity::saveToLog($data, $tb_name = "vehicle_check_results", $action = "update");
        $check_result -> update($this -> validateRequest());
        return redirect('check-result')->with('success', 'Sucessful Updated');
    }

    public function destroy(VehicleCheckResult $check_result)
    {
        $data = VehicleCheckResult::find($check_result -> id);
        \LogActivity::saveToLog($data, $tb_name = "vehicle_check_results", $action = "delete");
        $check_result -> delete();
        return redirect('check-result')->with('success', 'Successful Deleted');
    }

    private function validateRequest(){
        return request() -> validate([
            'app_form_id' => 'required',
            'name' => 'required',
            'name_en' => 'required',
            'result' => 'required',
            'remark' => 'required',
        ]);
    }
}
