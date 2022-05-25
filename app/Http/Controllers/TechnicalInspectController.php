<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\VehicleInspection;
use App\Model\Vehicle;
use Carbon\Carbon;
use App\Helpers\DateHelper;
class TechnicalInspectController extends Controller
{
   
    function __construct()
    {
        $this->middleware('permission:Technical-Inspect-All|Technical-Inspect-List-View|Technical-Inspect-Create|Technical-Inspect-Edit|Technical-Inspect-Delete');
        $this->middleware('permission:Technical-Inspect-List-View');
        $this->middleware('permission:Technical-Inspect-Create', ['only' => ['create','store']]);
        $this->middleware('permission:Technical-Inspect-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Technical-Inspect-Delete', ['only' => ['destroy']]);  
    }

    public function index()
    {
        $vehicleinspection = VehicleInspection::orderByDesc('created_at')->get();
        return view('Technicallnspect.index',compact('vehicleinspection'));
    }

    

    public function create()
    {
      
        return view('Technicallnspect.create');
    }

    public function store(Request $request)
    {
       
        $data = request() -> validate([
                   
                    'app_request_no' => 'required',
                    'date' => 'required|date',
                    'result' => 'required',
                    'type' => 'required',
                    'comment' => 'required'
                
                ]);

       $data = $request->all();
       $data['inspect_number'] = \App\Helpers\TransferNo::inpect_no();
       $data['date'] = \App\Helpers\DateHelper::getMySQLDateFromUIDate(request('date'));
       $data['user_id'] = auth()->id();
       VehicleInspection::create($data);

        return redirect('technical-inspect')->with('success','Successful Created');
    }

    public function show(VehicleInspection $vehicle_inspection)
    {
        return view('Module4.VehicleInspection.show',compact('vehicle_inspection'));
    }

     public function edit($id)
    {
         $data['vehicle_inspection'] = VehicleInspection::find($id);
         $vehicle =\App\Model\VehicleType::get();
         $user =\App\User::get();
        return view('Technicallnspect.edit',$data);
    }

   
     public function update(Request $request, $id)
    {
         $request->validate([
       
        ]);
        $data = $request->all();
        $user = VehicleInspection::find($id);
         \LogActivity::saveToLog($user ,$tb_name="vehicle_inspections",$action="update");
         $input['date']=DateHelper::getMySQLDateTimeFromUIDate($request->date);
       $data['user_id'] = auth()->id();
        $user->update($data);
   return redirect('technical-inspect')->with('success','Successful Technical Inspect Update.'); 
    }


    
    public function destroy($id)
    {
    $data =VehicleInspection::find($id);
        \LogActivity::saveToLog($data,$tb_name="vehicle_inspections",$action="delete");
     $data->delete();
        return redirect('technical-inspect') -> with('success','Successful deleted');
    }

    private function validateRequest(){
        return request() -> validate([
            'app_request_no' => 'required',
            'result' => 'required',
            'type' => 'required',
            'comment' => 'required',
            'vehicle_id' => 'required',
            'status' => 'required',
        ]);
    }
}
