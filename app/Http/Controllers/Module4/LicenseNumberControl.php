<?php

namespace App\Http\Controllers\Module4;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\LicenseAlphabet;
use DB;
use App\Model\Vehicle;
use App\Model\VehicleKind;
use App\Model\Province;

class LicenseNumberControl extends Controller
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
    public function index(Request $request)
    {
        $vehicle_kind = VehicleKind::select('id', 'name')->get();
        $province = Province::select('id', 'name')->get();

        $alpabet_charfirst = DB::select('select SUBSTRING(name, 1, 1) as name from license_alphabets  group by SUBSTRING(name, 1, 1)');

        if($request->query('vehicle_kind') != null && $request->query('province') != null)
        {
            $query = "select la.name,SUBSTRING(la.name, 1, 1) as name_first,lacs.name as status_name FROM license_alphabets la".
            " LEFT JOIN license_alphabet_controls lac on lac.license_alphabet_id = la.id AND lac.province_code = '" .$request->query('province')."' AND lac.vehicle_kind_code = '" .$request->query('vehicle_kind')."'".
            " LEFT JOIN license_alphabet_control_statuses lacs on lac.license_alphabet_control_status_id = lacs.id";

            $alpabet = DB::select($query);
        }
        else {
            $alpabet = DB::select('select name,SUBSTRING(name, 1, 1) as name_first,null as status_name from license_alphabets');
        }
        
        return view('Module4.LicenseNumberControl.license_control', ['alpabet_charfirst' => $alpabet_charfirst,'alpabet' => $alpabet,'vehicle_kind' => $vehicle_kind,'province' => $province]);
    }

    public function sub1()
    {
        return view('Module4.LicenseNumberControl.license_control_sub1');
    }

    public function sub2()
    {
        return view('Module4.LicenseNumberControl.license_control_sub2');
    }

    public function subdetail()
    {
        // $alpabet = Vehicle::where('province_code',01)->where('license_alphabet_id',1)->where('vehicle_kind_code',1);
        $vehicle = Vehicle::paginate(10);
        return view('Module4.LicenseNumberControl.license_control_subdetail',['vehicle' => $vehicle]);
    }
}
