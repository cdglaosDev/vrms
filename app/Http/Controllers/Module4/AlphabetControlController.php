<?php
namespace App\Http\Controllers\Module4;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\LicenseAlphabet;
use App\Model\LicenseAlphabetControl;
use Illuminate\Validation\Rule;
class AlphabetControlController extends Controller
{
    function __construct()
    {   
        $this->middleware('permission:Alphabet-Control-List-View');
         $this->middleware('permission:Alphabet-Control-Create', ['only' => ['store']]);
         $this->middleware('permission:Alphabet-Control-Edit', ['only' => ['update']]);
         $this->middleware('permission:Alphabet-Control-Delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        if (auth()->user()->user_level == "admin") {
            $alphabet_control = LicenseAlphabetControl::orderByDesc('created_at')->get();
        } else {
            $alphabet_control = LicenseAlphabetControl::whereProvinceCode(\App\Helpers\Helper::current_province())->orderByDesc('created_at')->get();
        }
       
        return view('Module4.AlphabetControl.index', compact('alphabet_control'));
    }
    // check license alphabet by same kind, province and type group and status
    public function checkLicense()
    {
        if(request('id') != "0"){//Edit
            if (LicenseAlphabetControl::where([
                ['province_code', request('province_code')], ['vehicle_type_group_id', request('vtype')], ['vehicle_kind_code', request('veh_kind')], ['license_alphabet_id', request('alphabet')],['license_alphabet_control_status_id', request('status')],['id', '!=', request('id')]
                ])->exists()) {
                return response()->json(['status' =>"used"]);
             } 
        }else{
            if (LicenseAlphabetControl::where([
                ['province_code', request('province_code')], ['vehicle_type_group_id', request('vtype')], ['vehicle_kind_code', request('veh_kind')], ['license_alphabet_id', request('alphabet')],['license_alphabet_control_status_id', request('status')]
                ])->exists()) {
                return response()->json(['status' =>"used"]);
             } 
        }
    }

    public function store(Request $request)
    {
        LicenseAlphabetControl::create($request->only('province_code', 'vehicle_type_group_id', 'license_alphabet_id', 'license_alphabet_control_status_id','license_alphabet_next_id','vehicle_kind_code'));
        return back()->with('success', "Successfully created License Alphabet.");
    }

    public function edit($id)
    {
        $alphabet_control = LicenseAlphabetControl::find($id);
        $alphabetControl = \App\Model\LicenseAlphabetControl::whereProvinceCodeAndVehicleKindCodeAndVehicleTypeGroupId($alphabet_control->province_code, $alphabet_control->vehicle_kind_code, $alphabet_control->vehicle_type_group_id)->pluck('license_alphabet_id');
        $alphabetNextControl = \App\Model\LicenseAlphabetControl::whereProvinceCodeAndVehicleKindCodeAndVehicleTypeGroupId($alphabet_control->province_code, $alphabet_control->vehicle_kind_code, $alphabet_control->vehicle_type_group_id)->pluck('license_alphabet_next_id');
        $alphabet = \App\Model\LicenseAlphabet::whereNotIn('id', $alphabetControl)->orwhere('id', '=', $alphabet_control->license_alphabet_id)->pluck('name', 'id');
        
        $alphabet_next = \App\Model\LicenseAlphabet::whereNotIn('id', $alphabetNextControl)->where('id', '!=', $alphabet_control->license_alphabet_id)->orwhere('id', '=', $alphabet_control->license_alphabet_next_id)->pluck('name', 'id');
        $provinces = \App\Model\Province::GetProvince();
        $type_groups = \App\Model\VehicleTypeGroup::whereNotIn('name', ["ALL", "ETC"])->whereStatus(1)->get();
        $alphabet_controls_status = \App\Model\LicenseAlphabetControlStatus::get();
        $veh_kinds = \App\Model\VehicleKind::whereStatus(1)->get();
       
        return view('Module4.AlphabetControl.edit', compact('alphabet_control','alphabet', 'alphabet_next', 'provinces', 'type_groups', 'alphabet_controls_status', 'veh_kinds'));
    }
    public function update(Request $request, $id)
    {
       try{
            $alphabet = LicenseAlphabetControl::find($id);
            $alphabet->update($request->all());
            return back()->with('success', "Successfully Updated License Alphabet Form.");
        } catch (\Exception $e) {
            return response()->json(['error' => $e]);
        }
    }

    public function destroy($id)
    {
        LicenseAlphabetControl::destroy($id);
        return back()->with('success', 'Successful  deleted');
    }

    public function show($id)
    {
        //
    }
}