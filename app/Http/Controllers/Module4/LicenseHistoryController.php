<?php

namespace App\Http\Controllers\Module4;

use Illuminate\Http\Request;
use App\Model\LicenseNoHistory;
use App\Model\LicenseAlphabet;
use App\Model\Vehicle;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class LicenseHistoryController extends Controller
{
    function __construct()
    {   
        $this->middleware('permission:License-History-List-View');
         $this->middleware('permission:License-History-Create', ['only' => ['create', 'store']]);
         $this->middleware('permission:License-History-Edit', ['only' => ['edit', 'update']]);
         $this->middleware('permission:License-History-Delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $licensehistory = LicenseNoHistory::orderByDesc('created_at')->get();
        return view('Module4.LicenseHistory.index', compact('licensehistory'));
    }

    public function create()
    {
        $licensehistory = LicenseNoHistory::all();
        $vehicle = Vehicle::all();
        $alphabet = LicenseAlphabet::all();
        return view('Module4.LicenseHistory.create', compact('vehicleinspection','vehicle','alphabet'));
    }

    public function store()
    {
        $data = request() -> validate([
                    'license_alphabet_id' => 'required',
                    'vehicle_id' => 'required',
                    'start_date' => 'required|date',
                    'end_date' => 'required|date',
                    'license_no_status' => 'required',
                    'license_no_number' => 'required',
        ]);

        $id = auth()->user()->id;
        $licensehistory = new LicenseNoHistory();
        $licensehistory -> license_alphabet_id = request('license_alphabet_id');
        $licensehistory -> vehicle_id = request('vehicle_id');
        $licensehistory -> start_date = request('start_date');
        $licensehistory -> end_date = request('end_date');
        $licensehistory -> license_no_status = request('license_no_status');
        $licensehistory -> license_no_number = request('license_no_number');
        $licensehistory -> status = request('status');
        $licensehistory -> created_by = $id;
        $licensehistory -> save();
        return redirect('license-history')->with('success', 'Successful Created');
    }

    public function show(LicenseNoHistory $license_history)
    {
        return view('Module4.LicenseHistory.show', compact('license_history'));
    }

    public function edit(LicenseNoHistory $license_history)
    {
        $vehicle = Vehicle::all();
        $alphabet = LicenseAlphabet::all();
        return view('Module4.LicenseHistory.edit', compact('license_history', 'vehicle','alphabet'));
    }

    public function update(LicenseNoHistory $license_history)
    {
        $data = LicenseNoHistory::find($license_history -> id);
        \LogActivity::saveToLog($data, $tb_name = "license_no_histories", $action = "update");
        $id = auth()->user()->id;
        $start_date = Carbon::parse(request('start_date')) -> format('Y-m-d');
        $end_date = Carbon::parse(request('end_date')) -> format('Y-m-d');
        $license_history -> update_by = $id;
        $license_history -> start_date = $start_date;
        $license_history -> end_date = $end_date;
        $license_history -> update($this -> validateRequest());
        // $data = $finance->all();
        // $data = $finance->except(['_token', '_method' ]);
        return redirect('license-history')->with('success', 'Successful updated');
    }

    public function destroy(LicenseNoHistory $license_history)
    {
        $data = LicenseNoHistory::find($license_history -> id);
        \LogActivity::saveToLog($data, $tb_name = "license_no_histories", $action = "delete");
        $license_history -> delete();
        return redirect('license-history') -> with('success', 'Successful deleted');
    }

    private function validateRequest(){
        return request() -> validate([
            'license_alphabet_id' => 'required',
            'vehicle_id' => 'required',
            'license_no_status' => 'required',
            'license_no_number' => 'required',
            'status' => 'required',
        ]);
    }
}
