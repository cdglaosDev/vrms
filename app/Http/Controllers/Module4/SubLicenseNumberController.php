<?php

namespace App\Http\Controllers\Module4;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Vehicle;
use App\Model\LicenseNumberPresent;
use App\Model\LicenseAlphabet;
use App\Model\VehicleKind;
use App\Model\Province;
use DB;

class SubLicenseNumberController extends Controller
{
    public function index()
    {
        return view('Module4.SubLicenseControl.index');
    }
    

    public function sub1($province,$vehicle_kind,$alphabet)
    {
        $_vehicle_kind_name = VehicleKind::select('name')->where('id',$vehicle_kind)->first();
        $_province_name = Province::select('name')->where('id',$province)->first();
        $_license_name = LicenseAlphabet::select('name')->where('id',$alphabet)->first();

        $licenseNoPresent = LicenseNumberPresent::select('license_no_present_number','status','province_code','vehicle_kind_code','license_alphabet_id')->where('province_code',$province)->where('vehicle_kind_code',$vehicle_kind)->where('license_alphabet_id',$alphabet)->first();
        
        $license_present = '';
        $status = '';
        $vehicle_kind_name = '';
        $province_name = '';
        $license_alphabet_name = '';

        if($_vehicle_kind_name != null)
            $vehicle_kind_name = $_vehicle_kind_name->name;
        if($_province_name != null)
            $province_name = $_province_name->name;
        if($_license_name != null)
            $license_alphabet_name = $_license_name->name;

        if($licenseNoPresent != null) {
            $license_present = $licenseNoPresent->license_no_present_number;
            $status = $licenseNoPresent->status;
        }

        return view('Module4.SubLicenseControl.number_sub1',[
            'license_present' => $license_present,
            'status' => $status,
            'vehicle_kind_name' => $vehicle_kind_name,
            'province_name' => $province_name,
            'license_alphabet_name' => $license_alphabet_name,
            'vehicle_kind_code' => $vehicle_kind,
            'province_code' => $province,
            'license_alphabet_id' => $alphabet
        ]);
    }

    public function sub2($province,$vehicle_kind,$alphabet,$licensepresent)
    {
        $_vehicle_kind_name = VehicleKind::select('name')->where('id',$vehicle_kind)->first();
        $_province_name = Province::select('name')->where('id',$province)->first();
        $_license_name = LicenseAlphabet::select('name')->where('id',$alphabet)->first();

        $licenseNoPresent = LicenseNumberPresent::select('license_no_present_number','status','province_code','vehicle_kind_code','license_alphabet_id')->where('province_code',$province)->where('vehicle_kind_code',$vehicle_kind)->where('license_alphabet_id',$alphabet)->first();
        
        $license_present = '';
        $status = '';
        $vehicle_kind_name = '';
        $province_name = '';
        $license_alphabet_name = '';

        if($_vehicle_kind_name != null)
            $vehicle_kind_name = $_vehicle_kind_name->name;
        if($_province_name != null)
            $province_name = $_province_name->name;
        if($_license_name != null)
            $license_alphabet_name = $_license_name->name;

        if($licenseNoPresent != null) {
            $license_present = $licenseNoPresent->license_no_present_number;
            $status = $licenseNoPresent->status;
        }

        return view('Module4.SubLicenseControl.number_sub2',[
            'license_present' => $license_present,
            'status' => $status,
            'vehicle_kind_name' => $vehicle_kind_name,
            'province_name' => $province_name,
            'license_alphabet_name' => $license_alphabet_name,
            'vehicle_kind_code' => $vehicle_kind,
            'province_code' => $province,
            'license_alphabet_id' => $alphabet,
            'license_present_max' => $licensepresent
        ]);
    }

    public function subdetail($province,$vehicle_kind,$alphabet,$licensemax)
    {
        // $alpabet = Vehicle::where('province_code',01)->where('license_alphabet_id',1)->where('vehicle_kind_code',1);
        // $vehicle = Vehicle::where('province_code',$province)->where('vehicle_kind_code',$vehicle_kind)->where('license_alphabet_id',$alphabet);
        
        $query = sprintf("select vehicles.id,la.id as license_alphabets_id,vehicles.province_code,vehicles.vehicle_kind_code,RIGHT(licence_no, 4) as licence_number,licence_no,owner_name,village_name,prov.name as province_name,dist.name as district_name,kind.name as vehicle_kind_name
        FROM vehicles
        LEFT JOIN license_alphabets la on la.name = LEFT(licence_no, 2)
        LEFT JOIN provinces prov on prov.province_code = vehicles.province_code
        LEFT JOIN districts dist on dist.district_code = vehicles.district_code
        LEFT JOIN vehicle_kinds kind on kind.id = vehicles.vehicle_kind_code
        WHERE vehicles.province_code = '%s'
        and vehicles.vehicle_kind_code = %s
        and la.id = %s
        and RIGHT(licence_no, 4) BETWEEN %s and %s
        and licence_no is not null 
        and RIGHT(licence_no, 4) > 0",$province,$vehicle_kind,$alphabet,str_pad($licensemax-999,4,"0",STR_PAD_LEFT),str_pad($licensemax,4,"0",STR_PAD_LEFT));

        $vehicle = DB::select($query);
        
        return view('Module4.SubLicenseControl.number_subdetail',['vehicle' => $vehicle]);
    }
}