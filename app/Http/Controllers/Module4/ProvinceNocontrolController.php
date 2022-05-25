<?php

namespace App\Http\Controllers\Module4;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Province;
use App\Model\ProvinceNoControl;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
class ProvinceNoControlController extends Controller
{
    function __construct()
    {   
        $this->middleware('permission:Province-Number-List-View');
         $this->middleware('permission:Province-Number-Create', ['only' => ['store']]);
         $this->middleware('permission:Province-Number-Create', ['only' => ['update']]);
         $this->middleware('permission:Province-Number-Delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        if (auth()->user()->user_level == 'admin') {
            $provincenocontrol = ProvinceNoControl::orderByDesc('created_at')->get();
        } else {
            $provincenocontrol = ProvinceNoControl::whereProvinceCode(auth()->user()->user_info->province_code)->orderByDesc('created_at')->get();  
        }
        return view('Module4.ProvinceNoControl.index',compact('provincenocontrol'));
    }
    
  

    public function store(Request $request)
    {
        ProvinceNoControl::create($request->all());
        return redirect('province-no-control')->with('success', 'Successful Province No Control Added.');
    }

    

    public function edit($id)
    {
        
    }

   public function update(Request $request, $id)
    {
        $provinceno= ProvinceNoControl::find($id);
        \LogActivity::saveToLog($provinceno, $tb_name = "province_no_controls", $action = "update");
        $provinceno->update($request->all());
        return redirect('province-no-control')->with('success', 'Successful Province No Control Update.');
    }

    public function destroy($id)
    {
        $data =ProvinceNoControl::find($id);
        \LogActivity::saveToLog($data, $tb_name = "Villages", $action = "delete");
        $data->delete();
        return redirect('province-no-control')->with('success', 'Successful Province No Control Delete.'); 
    }

   
}
