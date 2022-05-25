<?php

namespace App\Http\Controllers\Module4;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Model\VehicleKind;
use App\Model\Province;

class RegistrationNumberController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:Registration-Number-List-View');
        
    }
    public function index(Request $request)
    {
       
        $vehicle_kind = VehicleKind::select('id','name')->get();
        $province = Province::select('id','name')->get();

        $alpabet_charfirst = DB::select('select SUBSTRING(name, 1, 1) as name1 from license_alphabets  group by SUBSTRING(name, 1, 1) ORDER BY FIELD(name1, "ກ","ຂ","ຄ","ງ","ຈ","ສ","ຊ","ຍ","ດ","ຕ","ຖ","ທ","ນ","ບ","ປ","ຜ","ຝ","ພ","ຟ","ມ","ຢ","ຣ","ລ","ວ","ຫ","ອ","ຮ")');
       
        if($request->query('vehicle_kind') != null && $request->query('province') != null)
        {
            $query = "";

            if($request->query('licensenum') != "")
            {
                $query = "select la.id,la.name, SUBSTRING(la.name, -1) as name1, SUBSTRING(la.name, 1, 1) as name_first,case WHEN vehicle.alphabet_name is not null then 'Full' else '' end as status_name,'" .$request->query('province')."' as province_code,'" .$request->query('vehicle_kind')."' as vehicle_kind_code,vehicle.alphabet_name
                FROM license_alphabets la 
                LEFT JOIN (SELECT LEFT(licence_no, 2) as alphabet_name FROM vehicles WHERE licence_no LIKE '%" .$request->query('licensenum')."%' AND province_code = '" .$request->query('province')."' AND vehicle_kind_code = '" .$request->query('vehicle_kind')."' GROUP BY licence_no) vehicle on la.name = vehicle.alphabet_name ORDER BY FIELD(name1, 'ກ','ຂ','ຄ','ງ','ຈ','ສ','ຊ','ຍ','ດ','ຕ','ຖ','ທ','ນ','ບ','ປ','ຜ','ຝ','ພ','ຟ','ມ','ຢ','ຣ','ລ','ວ','ຫ','ອ','ຮ')";
            }
            else
            {
                $query = "select la.id,la.name,SUBSTRING(la.name, 1, 1) as name_first, SUBSTRING(la.name, -1) as name1, lacs.name as status_name,lac.province_code,lac.vehicle_kind_code 
                FROM license_alphabets la 
                LEFT JOIN license_alphabet_controls lac on lac.license_alphabet_id = la.id AND lac.province_code = '" .$request->query('province')."' AND lac.vehicle_kind_code = '" .$request->query('vehicle_kind')."'
                LEFT JOIN license_alphabet_control_statuses lacs on lac.license_alphabet_control_status_id = lacs.id ORDER BY FIELD(name1, 'ກ','ຂ','ຄ','ງ','ຈ','ສ','ຊ','ຍ','ດ','ຕ','ຖ','ທ','ນ','ບ','ປ','ຜ','ຝ','ພ','ຟ','ມ','ຢ','ຣ','ລ','ວ','ຫ','ອ','ຮ')";
            }
          
            $alpabet = DB::select($query);
        }
        else {
            $alpabet = DB::select('select id,name, SUBSTRING(name, -1) as name1, SUBSTRING(name, 1, 1) as name_first,null as status_name,null as province_code,null as vehicle_kind_code from license_alphabets ORDER BY FIELD(name1, "ກ","ຂ","ຄ","ງ","ຈ","ສ","ຊ","ຍ","ດ","ຕ","ຖ","ທ","ນ","ບ","ປ","ຜ","ຝ","ພ","ຟ","ມ","ຢ","ຣ","ລ","ວ","ຫ","ອ","ຮ")');
         
        }
      
        return view('Module4.RegistrationNumber.index', ['alpabet_charfirst' => $alpabet_charfirst,'alpabet' => $alpabet,'vehicle_kind' => $vehicle_kind,'province' => $province]);
    }
}