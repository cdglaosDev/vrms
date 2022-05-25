<?php
namespace App\Http\Controllers\Module5;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\VehicleDetail;
use App\Model\PreRegisterApp;
use App\Model\ApplicationStatus;
use App\Model\Vehicle;
use App\Model\AppDocument;
use App\Helpers\DateHelper;
use App\Helpers\GenerateCodeNo;
use App\Helpers\getData;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;
use App\Library\UploadDoc;
use App\Notifications\VehicleImport;

class VehicleImportController extends Controller
{
    function __construct()
    {
      $this->middleware('permission:Importer-Application-Item-All|Importer-Application-Item-List-View|Importer-Application-Item-List-Create|Importer-Application-Item-Entry-Edit|Importer-Application-Item-Entry-Delete|Importer-Application-Item-Approve|Importer-Application-Item-Entry-Print');
        $this->middleware('permission:Importer-Application-Item-List-View');
        $this->middleware('permission:Importer-Application-Item-List-Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Importer-Application-Item-Entry-Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Importer-Application-Item-Entry-Delete', ['only' => ['destroy']]);
      
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $data['pre_app'] = PreRegisterApp::ImportList();
        $data['info'] = \App\Helpers\getData::vehInfo();
        return view('Module5.importvehicle.index', $data);
    }

    public function indexFiltering(Request $request)
    {
      $searchText = $request->query('app_no');
      $app_status = request('app_status');
      switch (true){
        case ($searchText != null &&  $app_status == null):
            if(auth()->user()->user_level == "province"){
              $veh1 = PreRegisterApp::whereHas('vehicle_detail', function($q) use($searchText){
                $q->where([['province_code', \App\Helpers\Helper::current_province()],['village_name', 'like', '%'.$searchText.'%']])->orwhere([['province_code', \App\Helpers\Helper::current_province()],['owner_name', 'like', '%'.$searchText.'%']])->orwhere([['province_code', \App\Helpers\Helper::current_province()],['licence_no_need', 'like', '%'.$searchText.'%']]);
                      })->where(function($query) use ($searchText) {
                        $query->orwhere('app_number', 'like', '%' . $searchText . '%')
                        ->orwhere('regapp_number', 'like', '%' . $searchText . '%');
                      })->where('app_status_id', '!=', 6 )->orderBy('app_number', 'desc');
              $data['pre_app'] =  PreRegisterApp::whereHas('vehicle_detail', function($q) use($searchText){
                                  $q->where([['province_code', \App\Helpers\Helper::current_province()],['village_name', 'like', '%'.$searchText.'%']])->orwhere([['province_code', \App\Helpers\Helper::current_province()],['owner_name', 'like', '%'.$searchText.'%']])->orwhere([['province_code', \App\Helpers\Helper::current_province()],['licence_no_need', 'like', '%'.$searchText.'%']]);
                                  })->where(function($query) use ($searchText) {
                                    $query->orwhere('app_number', 'like', '%' . $searchText . '%')
                                          ->orwhere('regapp_number', 'like', '%' . $searchText . '%');
                                  })->whereUserId(auth()->id())
                                  ->orderBy('app_number', 'desc')
                                  ->union($veh1)
                                  ->paginate(100);
            } else {
              $veh1 = PreRegisterApp::whereHas('vehicle_detail', function($q) use($searchText){
                                $q->where('village_name', 'like', '%'.$searchText.'%')->orwhere('owner_name', 'like', '%'.$searchText.'%')->orwhere('licence_no_need', 'like', '%'.$searchText.'%');
                                  })->orwhere(function($query) use ($searchText) {
                                    $query->orwhere('app_number', 'like', '%' . $searchText . '%')
                                    ->orwhere('regapp_number', 'like', '%' . $searchText . '%');
                                  })->where('app_status_id', '!=', 6 )->orderBy('app_number', 'desc');
      
              $data['pre_app'] =  PreRegisterApp::whereHas('vehicle_detail', function($q) use($searchText){
                                  $q->where('village_name', 'like', '%'.$searchText.'%')->orwhere('owner_name', 'like', '%'.$searchText.'%')->orwhere('licence_no_need', 'like', '%'.$searchText.'%');
                                  })->orwhere(function($query) use ($searchText) {
                                    $query->orwhere('app_number', 'like', '%' . $searchText . '%')
                                          ->orwhere('regapp_number', 'like', '%' . $searchText . '%');
                                  })->orderBy('app_number', 'desc')
                                  ->whereUserId(auth()->id())
                                  ->union($veh1)
                                  ->paginate(100);
            }
          break;
        case ($searchText == null &&  $app_status != null):
          if(auth()->user()->user_level == "province"){
            $veh1 = PreRegisterApp::whereHas('vehicle_detail', function($q) {
                    $q->where('province_code', \App\Helpers\Helper::current_province());
                    })->where('app_status_id', '=', $app_status )->orderBy('app_number', 'desc');
          
            $data['pre_app'] =  PreRegisterApp::whereHas('vehicle_detail', function($q) {
                                $q->where([['province_code', \App\Helpers\Helper::current_province()]]);
                                })->where('app_status_id', '=', $app_status)->orderBy('app_number', 'desc')
                                ->whereUserId(auth()->id())
                                ->union($veh1)
                                ->paginate(100);
          } else {
            $veh1 = PreRegisterApp::where('app_status_id', '=', $app_status )->orderBy('app_number', 'desc');
            $data['pre_app'] =  PreRegisterApp::where('app_status_id', '=', $app_status)->orderBy('app_number', 'desc')
                                ->whereUserId(auth()->id())
                                ->union($veh1)
                                ->paginate(100);
          }
          break;
        case($searchText != null &&  $app_status != null):
          if(auth()->user()->user_level == "province"){
            $veh1 = PreRegisterApp::whereHas('vehicle_detail', function($q) use($searchText, $app_status){
                    $q->whereProvinceCode(\App\Helpers\Helper::current_province())->orwhere([['province_code', \App\Helpers\Helper::current_province()], ['village_name', 'like', '%'.$searchText.'%']])->orwhere([['province_code', \App\Helpers\Helper::current_province()], ['owner_name', 'like', '%'.$searchText.'%']])->orwhere([['province_code', \App\Helpers\Helper::current_province()], ['licence_no_need', 'like', '%'.$searchText.'%']]);
                    })->where(function($query) use ($searchText) {
                      $query->orwhere('app_number', 'like', '%' . $searchText . '%')
                      ->orWhere('regapp_number', 'like', '%' . $searchText . '%');
                    })->where('app_status_id', '=', $app_status )->orderBy('app_number', 'desc');
          
            $data['pre_app'] =  PreRegisterApp::whereHas('vehicle_detail', function($q) use($searchText, $app_status){
                                $q->whereProvinceCode(\App\Helpers\Helper::current_province())->orwhere([['province_code', \App\Helpers\Helper::current_province()],['village_name', 'like', '%'.$searchText.'%']])->orwhere([['province_code', \App\Helpers\Helper::current_province()],['owner_name', 'like', '%'.$searchText.'%']])->orwhere([['province_code', \App\Helpers\Helper::current_province()],['licence_no_need', 'like', '%'.$searchText.'%']]);
                                })->where(function($query) use ($searchText) {
                                  $query->orwhere('app_number', 'like', '%' . $searchText . '%')
                                        ->orWhere('regapp_number', 'like', '%' . $searchText . '%');
                                })->where('app_status_id', '=', $app_status)->orderBy('app_number', 'desc')
                                ->whereUserId(auth()->id())
                                ->union($veh1)
                                ->paginate(100);
          } else {
            
            $veh1 = PreRegisterApp::whereHas('vehicle_detail', function($q) use($searchText, $app_status){
                            $q->where([['village_name', 'like', '%'.$searchText.'%']])->orwhere('owner_name', 'like', '%'.$searchText.'%')->orwhere('licence_no_need', 'like', '%'.$searchText.'%');
                                })->orwhere(function($query) use ($searchText) {
                                  $query->where('app_number', 'like', '%' . $searchText . '%')
                                  ->orWhere('regapp_number', 'like', '%' . $searchText . '%');
                                })->where('app_status_id', '=', $app_status )->orderBy('app_number', 'desc');
    
            $data['pre_app'] =  PreRegisterApp::whereHas('vehicle_detail', function($q) use($searchText, $app_status){
                                $q->where('village_name', 'like', '%'.$searchText.'%')->orwhere('owner_name', 'like', '%'.$searchText.'%')->orwhere('licence_no_need', 'like', '%'.$searchText.'%');
                                })->orwhere('app_number', 'like', '%'.$searchText.'%')
                                ->orwhere('regapp_number', 'like', '%'.$searchText.'%')->where('app_status_id', '=', $app_status )->orderBy('app_number', 'desc')
                                ->whereUserId(auth()->id())
                                ->union($veh1)
                                ->paginate(100);
          }
        break;
        default:
        return redirect()->to('import-vehicle');
        
      }
      $data['app_status'] =  $app_status;
      $data['info'] = \App\Helpers\getData::vehInfo();
      return view('Module5.importvehicle.index', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = getData::vehInfo();
        return view('Module5.importvehicle.create', compact('data'));
    }

    /* for column search in import vehicle vehicle*/
    public function searchImportList(Request $request)
    {
        $pre_app_no = $request->pre_app_no;
        $pre_license_no = $request->pre_license_no;
        $province_name = $request->province_name;
        $village_name = $request->village_name;
        $owner_name = $request->owner_name;
        $vehicle_type_name = $request->vehicle_type_name;
        $brand_name = $request->brand_name;
        $model_name = $request->model_name;
        $engine_no = $request->engine_no;
        $pageno = $request->pageno;
        $pagination = "";
        if ($pageno == 1) {
            $pagination = 0;
        } else {
            $pagination = ($pageno * 100) - 100;
        }
        
        //============================= Call to Create Query ==============================
        $sql_query = $this->create_query();
        $where_query = "";

        //============================= Create WHERE Clause ==============================
        if (!empty($pre_app_no)) {
          $where_query = $where_query . "pre_register_apps.app_number like '%" . "$pre_app_no" . "%' OR pre_register_apps.regapp_number like '%" . "$pre_app_no" . "%' AND";
        }
     
        if (!empty($pre_license_no)) {
            $where_query = $where_query . "vehicle_details.licence_no_need like '%" . "$pre_license_no" . "%' AND ";
        }
        if (!empty($province_name)) {
            $where_query = $where_query . "provinces.name like '%" . "$province_name" . "%' AND ";
        }
       
        if (!empty($village_name)) {
            $where_query = $where_query . "vehicle_details.village_name like '%" . "$village_name" . "%' AND ";
        }
       
        if (!empty($owner_name)) {
            $where_query = $where_query . "vehicle_details.owner_name like '%" . "$owner_name" . "%' AND ";
        }
       
        if (!empty($vehicle_type_name)) {
            $where_query = $where_query . "vehicle_types.name like '%" . "$vehicle_type_name" . "%' AND ";
        }
        if (!empty($brand_name)) {
            $where_query = $where_query . "vehicle_brands.name like '%" . "$brand_name" . "%' AND ";
        }
        if (!empty($model_name)) {
            $where_query = $where_query . "vehicle_models.name like '%" . "$model_name" . "%' AND ";
        }
        if (!empty($engine_no)) {
            $where_query = $where_query . "vehicle_details.engine_no like '%" . "$engine_no" . "%' OR vehicle_details.chassis_no like '%" . "$engine_no" . "%' AND ";
        }
      
        if($where_query != ""){
          $sql_query = $sql_query . $where_query;
          $sql_query = trim($sql_query, " AND "). " ORDER BY pre_register_apps.app_number DESC";
        }else{
            $sql_query =  trim($sql_query, " WHERE ") . " ORDER BY pre_register_apps.app_number DESC";
        }
        $result = DB::select($sql_query);
        $no_of_records_per_page = 100;
        $vehicle_detail_result = array_slice($result, $pagination, $no_of_records_per_page);
        $total_vehicle = count($result);
        $total_pages  = ceil($total_vehicle / $no_of_records_per_page);
      return view('Module5.importvehicle.search-vehicle-list', compact('vehicle_detail_result', 'total_vehicle', 'total_pages', 'pageno'));
    
  }

  public function create_query()
    {
        $user_level = auth()->user()->user_level;

        $sql_query = "";
        $sql_vehicle = "";

        $sql_main = "";
       
        $sql_main = "SELECT vehicle_details.* FROM vehicle_details";
       
        //==================================== Create Main Query ======================================
        $sql_select = "SELECT DISTINCT vehicle_details.*,vehicle_details.id as vehicle_detail_id, pre_register_apps.*, pre_register_apps.id as pre_app_id, vehicle_brands.name as brand_name
        , vehicle_models.name as model_name, provinces.name as province_name, vehicle_types.name as vehicle_type_name ,districts.name as district_name, vehicle_kinds.name as kind_name
        FROM (";
        $sql_join = ")as vehicle_details
        INNER JOIN pre_register_apps on vehicle_details.id = pre_register_apps.vehicle_detail_id
        LEFT JOIN provinces ON vehicle_details.province_code = provinces.province_code 
        LEFT JOIN vehicle_types ON vehicle_details.vehicle_type_id = vehicle_types.id
        LEFT JOIN vehicle_brands ON vehicle_details.brand_id = vehicle_brands.id
        LEFT JOIN districts ON vehicle_details.district_code = districts.district_code
        LEFT JOIN vehicle_kinds ON vehicle_details.vehicle_kind_code = vehicle_kinds.vehicle_kind_code
        LEFT JOIN vehicle_models ON vehicle_details.model_id = vehicle_models.id WHERE ";
        
        if (auth()->user()->user_level == "province") {
          $sql_vehicle = $sql_main . " WHERE vehicle_details.province_code = '" . \App\Helpers\Helper::current_province() . "'";
        } else {
            $sql_vehicle =  $sql_main;
        }
        $sql_query = $sql_select . $sql_vehicle . $sql_join;
        
        return $sql_query;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
      $request['engine_no'] = strtoupper(str_replace(' ', '', $request->engine_no));
      $request['chassis_no'] = strtoupper(str_replace(' ', '', $request->chassis_no));
      try {
        DB::beginTransaction();
        if($request->old_vehicle_id){ // click submit button after draft button
          $vehicle = VehicleDetail::find($request->old_vehicle_id);
          $vehicle->update($request->except(['save_type','old_vehicle_id']));
          $pre_app_id =  \App\Model\PreRegisterApp::where('vehicle_detail_id', $request->old_vehicle_id)->update(['app_status_id' => 3]);
          
        } else { //just click only draft
          $vehicle =  VehicleDetail::create($request->except(['save_type','old_vehicle_id']));
          $save_type = $request->save_type; 
          $doc = new UploadDoc();
          $pre_app_id = $doc->savePreForm($vehicle->id,  $save_type );
          Auth::user()->notifyWithNotiUser(new VehicleImport($vehicle, "VehicleDetail", "Appform Created!"));
        }
        DB::commit();
        return response()->json([
          "statusCode"=>200,
          'vehicle_id' => $vehicle->id,
          'pre_app_id' => $pre_app_id,
          'message' => trans('module4.new_import_added')
      ]);
      
      }catch(\Exception $e){
        DB::rollBack();
      }
    }
    //attache application document file for vehicle
    public function attachDoc($id)
    {
        $app_doc = AppDocument::whereVehicleDetailId($id)->pluck('filename','doc_type_id');
        if ($app_doc->isNotEmpty()) {
          $app_doc = AppDocument::whereVehicleDetailId($id)->pluck('filename','doc_type_id');
        } else {
          $app_doc = null;
        }
        return view('Module5.importvehicle.attachDoc',compact('id','app_doc'));
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     
      $data = VehicleDetail::detailData($id);
      return view('Module5.importvehicle.detail', $data);
   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

   
    public function edit($id)
    {
      $data = VehicleDetail::detailData($id);
      return view('Module5.importvehicle.edit', $data);
    }

   

    // public function editDate($id){
    //      $vehicle= VehicleDetail::find($id);
    //      return view('staff.importvehicle.editdate',compact('vehicle'));
    // }

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
      $this->validate($request, [
          'district_code' => 'required',
          'model_id' =>'required',
      ]);
      
      $vehicle = VehicleDetail::find($id);
      $request['engine_no'] = strtoupper(str_replace(' ', '', $request->engine_no));
      $request['chassis_no'] = strtoupper(str_replace(' ', '', $request->chassis_no));
      $vehicle->update($request->except('save_type'));
      if ($request->save_type == "submit") {
        \App\Model\PreRegisterApp::where('vehicle_detail_id', $id)->update(['app_status_id' => 3]);
      }
      Auth::user()->notifyWithNotiUser(new VehicleImport($vehicle, "VehicleDetail", "Appform Created!"));
        return json_encode(array(
          "statusCode"=>200,
          'app_status' => request('save_type')
        ));
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     
    }

    public function docDelete(Request $request)
    {
        $doc = AppDocument::find($request->id);
        $doc->delete();
        return back()->with('success', 'Successful AppDocument Deleted.');
    }
    

  public function newDocument(Request $request)
  {
    if ($request->hasfile('filename')) {
      $filename =[];
      foreach ($request->file('filename') as $file) {
          $name=uniqid().'_'.$file->getClientOriginalName();
          $file->move(public_path().'/images/doc/', $name);  
          $filename[] = $name;  
      }
    }
    foreach($request -> doc_type_id as $doc_type_id => $value) {   
      $appdoc = array(
          'vehicle_detail_id' => $request ->vehicle_detail_id,
          'doc_type_id' => $request -> doc_type_id[$doc_type_id],
          'link' => $request -> link[$doc_type_id],
          'date' =>  DateHelper::getMySQLDateTimeFromUIDate($request->date[$doc_type_id]),
          'filename'=>$filename[$doc_type_id],
    );
      AppDocument::insert($appdoc);
    }
    return redirect()->back()->with('success', 'Successful inserted');

    }

  public function rejectApp(Request $request, $id)
  {
      PreRegisterApp::whereId($id)->update(['app_status_id'=>5, 'remark'=> $request->remark]);
      return redirect()->route('import-vehicle.index')->with('success', 'Successful rejected.');
  }
  //check engine_no and cheassis no when creating import
  public function checkEngineChassis() {
    $vehicle_detail = VehicleDetail::whereEngineNoOrChassisNo(request()->engine_no, request()->chassis_no)->select('chassis_no','engine_no')->first();
    return response()->json($vehicle_detail);
  }
  //update vehicle detail tenant
  public function updateDetailTenant()
  {
    
        $input = request()->all();
        if ($files = request()->file('image')) {
            $name = uniqid().'_'.$files->getClientOriginalName();
            $dest = public_path('images/tenant');
            $files->move($dest,$name);
            $input['image'] = $name;
          
        }
        \App\Model\VehicleDetailTenant::whereVehicleDetailId(request('vehicle_detail_id'))->update($input);
        return response()->json([
          'status' => 200
       ]);
    
  }
  //add vehicle detail tenant
  public function detailTenant()
  {
      
    $input = request()->all();
    if ($files = request()->file('image')) {
        $name = uniqid().'_'.$files->getClientOriginalName();
        $dest = public_path('images/tenant');
        $files->move($dest,$name);
        $input['image'] = $name;
      
    }
    \App\Model\VehicleDetailTenant::create($input);
    return response()->json([
        'status' => 200
    ]);
    
  }

}
