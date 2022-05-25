<?php
namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\VehicleDetail;
use App\Model\PreRegisterApp;
use App\Model\ApplicationStatus;
use App\Model\Vehicle;
use App\Model\AppDocument;
use App\Model\AppForm;
use App\Model\ApplicationDocType;
use App\Helpers\DateHelper;
use App\Helpers\GenerateCodeNo;
use App\Helpers\getData;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Library\UploadDoc;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Notifications\VehicleImport;

class VehicleDetailController extends Controller
{

    public function index()
    {
      $data['pre_app'] = PreRegisterApp::with('vehicle_detail')->whereUserId(auth()->id())->get();
        $data['info'] = \App\Helpers\getData::vehInfo();
        return view('customer.vehicledetail.index', $data);
    }

    public function indexFiltering(Request $request)
    {
      $searchText = $request->query('app_no');
      $app_status = request('app_status');
      switch (true){

        case ($searchText != null &&  $app_status == null):
          $data['pre_app'] =  PreRegisterApp::whereHas('vehicle_detail', function($q) use($searchText){
                            $q->where('village_name', 'like', '%'.$searchText.'%')->orwhere('owner_name', 'like', '%'.$searchText.'%')->orwhere('licence_no_need', 'like', '%'.$searchText.'%');
                            })->whereUserId(auth()->id())
                              ->orwhere(function($query) use ($searchText) { //search app and pre app with user_id
                              $query->orwhere([['user_id', auth()->id()], ['app_number', 'like', '%' . $searchText . '%']])
                                    ->orwhere([['user_id', auth()->id()], ['regapp_number', 'like', '%' . $searchText . '%']]);
                            })->orderBy('app_number', 'desc')->paginate(100);
        break;
     
        case ($searchText == null &&  $app_status != null):
          $data['pre_app'] =  PreRegisterApp::with('vehicle_detail')->where([['app_status_id', '=', $app_status],['user_id', auth()->id()]])->orderBy('app_number', 'desc')->paginate(100);
        break;

        case($searchText != null &&  $app_status != null):
          $data['pre_app'] =  PreRegisterApp::whereHas('vehicle_detail', function($q) use($searchText, $app_status){
                            $q->where('village_name', 'like', '%'.$searchText.'%')->orwhere('owner_name', 'like', '%'.$searchText.'%')->orwhere('licence_no_need', 'like', '%'.$searchText.'%');
                            })->whereUserId(auth()->id())
                              ->orwhere(function($query) use ($searchText) {
                              $query->orwhere([['user_id', auth()->id()], ['app_number', 'like', '%' . $searchText . '%']])
                                    ->orwhere([['user_id', auth()->id()], ['regapp_number', 'like', '%' . $searchText . '%']]);
                            })->where('app_status_id', '=', $app_status)->orderBy('app_number', 'desc')->paginate(100);
        break;
        default:
        return redirect()->to('/customer/vehicle-detail');
        
      }
      $data['app_status'] =  $app_status;
      $data['info'] = \App\Helpers\getData::vehInfo();
      return view('customer.vehicledetail.index', $data);
    }
    
    public function create()
    {
        $data = getData::vehInfo();
        return view('customer.vehicledetail.create', compact('data'));
    }

    //Store Vehicle Information Form data 
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

    //Show "Application Document" View(Add New and Update Condition)
    public function attachDoc($id)
    {
        $vehicle = VehicleDetail::find($id);
        $app_doc = AppDocument::whereVehicleDetailId($id)->pluck('filename','doc_type_id');
        if ($app_doc->isNotEmpty()) {
          $app_doc = AppDocument::whereVehicleDetailId($id)->pluck('filename','doc_type_id');
        } else {
            $app_doc = null;
        }
        return view('customer.vehicledetail.attachDoc', compact('vehicle', 'app_doc'));
    }


    //Store Document(After Data Import from Excel Condition)
    public function ExcelstoreDocument(Request $request)
    { 
      $input_data = $request->all();

      $validator = Validator::make(
        $input_data, [
        'filename.*' => 'mimes:jpg,jpeg,png,pdf'
        ],[
            'filename.*.mimes' => 'Only jpeg,png and PDF File are allowed',
        ]
      );
      
      if ($validator->fails()) {
        return back()->withErrors($validator);
      } else {
        $doc = new UploadDoc();
        $doc->saveDB($request, $request->vehicle_detail_id);
        return redirect()->route('excel-import.index')->with('success', 'Successful updated document file.');
      }
    }


    //Show Import Vehicle List(Application Form,Vehicle Information,App Document)
    public function show($id)
    {
      $data = VehicleDetail::detailData($id);
      return view('customer.vehicledetail.detail', $data);
    }

    //Show Edit view of Vehicle Information
    public function edit($id)
    {
      $data = VehicleDetail::detailData($id);
      return view('customer.vehicledetail.edit', $data);
      
    }

    //Update Vehicle Information and PreRegisterApp
    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'district_code' => 'required',
        'model_id' =>'required',
      ]);
      $vehicle = VehicleDetail::find($id);
      $request['engine_no'] = strtoupper($request->engine_no);
      $request['chassis_no'] = strtoupper($request->chassis_no);
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

    public function EditattachDoc($id)
    {
      $doc_value = AppDocument::where('vehicle_detail_id', $id)->get();
      return view('customer.vehicledetail.edit_attachDoc',compact('id', 'doc_value'));
    }

    //Update Attach Document File (Add and Edit Vehicle Information)
    public function UpdateDocument(Request $request)
    {
      $this->validate($request, [
        'filename' => 'mimes:pdf,jpeg,png|max:20000',
      ]);
      $doc = AppDocument::whereVehicleDetailIdAndDocTypeId($request->vehicle_detail_id, $request->doc_type_id)->first();
      if ($request->hasfile('filename')) {
          $file = $request->file('filename');
          $name=uniqid().'_'.$file->getClientOriginalName();
          $file->move(public_path().'/images/doc/', $name);  
          $filename = $name;  
      }
      $doc->filename = $filename;
      $doc->save();
      return back()->with('success', 'Successful updated document file');
    }


    public function destroy($id)
    {
        $vehicle = VehicleDetail::find($id);
        $vehicle->regapps()->delete();
        $vehicle->appdocument()->delete();
        $vehicle->delete(); 
        return response()->json([
          'status' => 'success'
      ]);

    }

  //   public function submitApp($id)
  //  {
  //       $app_form = PreRegisterApp::find($id);
//       $app_form->update([ 
  //         'app_status_id' => 3,
  //         ]);
  //       return back()->with('success',"Successful Submitted.");

  //  }

   public function submitApp()
   {
      \App\Helpers\Helper::SubmitApp(request('pre_app_id'));
      return response()->json([
        'status' =>200,
        'message' => trans('module4.success_submit'),
        'pre_app_id' => request('pre_app_id')
    ]);
   }

    public function docDelete(Request $request)
    {
    
      $doc = AppDocument::find($request->id);
      $doc->delete();
      return back()->with('success', 'Successful AppDocument Deleted.');
    }
    public function getAppNumber()
    {

      $code = PreRegisterApp::where('regapp_number', 'LIKE', GenerateCodeNo::appNumberPrefix() . '%')->orderBy('regapp_number', 'desc')->select('regapp_number')->first();
    
      $app_num= GenerateCodeNo::appNumber($code['regapp_number']);

      return $app_num;
    }


    //update Pre Appliction Form in Detail view
    public function updateAppform(Request $request, $id){
      $pre_app = PreRegisterApp::find($id);
      $pre_app->update($request->all());
      return back()->with('success', 'Update Pre Register form successful.');
     }

    public function appformDetail($id)
    {
        $data = \App\Model\AppForm::find($id);
       
        return view('customer.vehicledetail.appform', compact('data'));
    }

    public function printForm($id)
    {
        $data = AppForm::find($id);
     
        return view('customer.vehicledetail.print', compact('data'));
    }
  //update vehicle detail tenant
  public function updateDetailTenant()
  {
      
        $input = request()->except('_method', '_token');
        if ($files = request()->file('image')) {
            $name = uniqid().'_'.$files->getClientOriginalName();
            $dest = public_path('images/tenant');
            $files->move($dest,$name);
            $input['image'] = $name;
          
        }
        \App\Model\VehicleDetailTenant::whereVehicleDetailId(request('vehicle_detail_id'))->update($input);
       return redirect('/customer/vehicle-detail')->with('success', 'Successful vehicle tenant updated.');
    
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
