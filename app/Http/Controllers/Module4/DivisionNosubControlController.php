<?php

namespace App\Http\Controllers\Module4;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\DivisionNoControl;
use App\Model\Province;
use App\Model\Vehicle;
use Carbon\Carbon;

class DivisionNosubControlController extends Controller
{
    public function index()
    {
        $sub_control = DivisionNoControl::orderByDesc('created_at')->whereProvinceCode(\App\Helpers\Helper::current_province())->get();
        return view('Module4.DivisionNoSubControl.index', compact('sub_control'));
    }

    public function create()
    {
        $divisionnosubcontrol = DivisionNoControl::all();
        $province = Province::all();
        return view('DivisionNoSubControl.create', compact('vehicleinspection', 'province'));
    }

    public function store(Request $request)
    {
        $this->validateRequest();
       DivisionNoControl::create($request->all());
         return redirect('division-no-sub-control')->with('success','Successful Division No Control Added.');
    }

    
     public function update(Request $request, $id)
    {
       $this->validateRequest();
        $divisionno= DivisionNoControl::find($id);
        \LogActivity::saveToLog($divisionno, $tb_name = "division_no_controls", $action = "update");
        $divisionno->update($request->all());
        return redirect('division-no-control')->with('success', 'Successful Division No Control Update.');
    }

    public function destroy($id)
    {
        $data =DivisionNoControl::find($id);
        \LogActivity::saveToLog($data, $tb_name = "division_no_controls", $action = "delete");
        $data->delete();
        return redirect('division-no-control')->with('success', 'Successful Division No Control Delete.');
    }

    private function validateRequest(){
        return request() -> validate([
            'province_code' => 'required',
            'division_no_start' => 'required',
            'division_no_end' => 'required',
            'alert_at' => 'required',
        ]);
    }
}
