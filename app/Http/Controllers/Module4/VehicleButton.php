<?php

namespace App\Http\Controllers\Module4;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Vehicle;
use App\Model\AppForm;
use App\Helpers\GenerateCodeNo\AppNo;
use Exception;

class VehicleButton extends Controller
{
  protected $app_purpose;

  public function __construct()
  {
    $app_purpose = new \App\Library\SaveAppPurpose;
  }

  // New application form generate by vehicle edit page
  public function newAppForm(Request $request, $vehicle_id)
  {
    //date must be ("d/m/Y"). It will be changed "Y-m-d" in Model". When we set "Y-m-d", we will get error when change in model.
    try {
      if ($request->operation == "new_form" || $request->operation == "pink1" || $request->operation == "pink2") {
        $app_no = new \App\Helpers\AppNo;
        try {
          $app_form_id = AppForm::create([
            'date_request' => date("d/m/Y"),
            'app_no' => $app_no->getAppNo(),
            'customer_name' => $request->owner_name, //When create AppFrom from vehicle(M4), customer_name will be saved with ownerName.
            'staff_id' => auth()->id(),
            'app_form_status_id' => 9,
            'note' => request('remark'),
            'vehicle_id' => $vehicle_id
          ])->id;
        } catch (\Exception $e) {
          return response()->json(['error' => $e->getMessage()]);
        }
        //Add New
        foreach ($request->app_purpose_id as $purpose => $value) {
          $app_purpose = array(
            'app_form_id' => $app_form_id,
            'app_purpose_id' => $value
          );
          \App\Model\AppFormPurpose::insert($app_purpose);
        }

        return response()->json(['status' => 'OK', "message" => trans('module4.app_form_create_msg')]);
      } else if ($request->operation == "update") {
        $old_app_data = \App\Model\AppForm::whereVehicleId($vehicle_id)->latest('id')->first();

        if (!empty($old_app_data)) {
          //Check app_purpose change or not
          $app_purposes = \App\Model\AppFormPurpose::whereAppFormId($old_app_data->id)->pluck('app_purpose_id')->toArray();
          if (count($app_purposes) > count($request->app_purpose_id)) {
            $differenceArray = array_diff($app_purposes, $request->app_purpose_id);
          } else {
            $differenceArray = array_diff($request->app_purpose_id, $app_purposes);
          }

          //Update App_Form
          $old_app_data->note = request('remark');
          if (count($differenceArray) > 0) {
            $old_app_data->app_form_status_id = 1; //When update application, will change status into "1".
          }
          $old_app_data->customer_name = $request->owner_name; //When create AppFrom from vehicle(M4), customer_name will be saved with ownerName.
          $old_app_data->staff_id = auth()->id();
          $old_app_data->update();

          //Delete Old. No need to delete for app_purpose_id = 1. Because it is not shown in form when call from vehicleEditModal.
          $delete_app_purpose = \App\Model\AppFormPurpose::whereAppFormId($old_app_data->id)->where("app_purpose_id", "!=", "1")->delete();

          //Add New
          foreach ($request->app_purpose_id as $purpose => $value) {
            $app_purpose = array(
              'app_form_id' => $old_app_data->id,
              'app_purpose_id' => $value
            );
            \App\Model\AppFormPurpose::insert($app_purpose);
          }
        } else {
          return response()->json(['status' => 'error', "message" => "There is no Application Form to update for this vehicle."]);
        }

        return response()->json(['status' => 'OK', "message" => trans('module4.app_form_update_msg')]);
      }
    } catch (\Exception $e) {
      return response()->json(['error' => $e]);
    }
  }

  public function newFormWithPinkpaper(Request $request, $vehicle_id)
  {
    //return response()->json(['fun;'=>$request->all()]);
    //date must be ("d/m/Y"). It will be changed "Y-m-d" in Model". When we set "Y-m-d", we will get error when change in model.
    try {
      if ($request->operation == "new_form" || $request->operation == "pink1" || $request->operation == "pink2") {
        $app_no = new \App\Helpers\AppNo;
        try {
          $app_form_id = AppForm::create([
            'date_request' => date("d/m/Y"),
            'app_no' => $app_no->getAppNo(),
            'customer_name' => $request->owner_name,//When create AppFrom from vehicle(M4), customer_name will be saved with ownerName.
            'staff_id' => auth()->id(),
            'app_form_status_id' => 9,
            'note' => request('remark'),
            'vehicle_id' => $vehicle_id
          ])->id;
        } catch (\Exception $e) {
          return response()->json(['error' => $e->getMessage()]);
        }

        foreach ($request->app_purpose_id as $purpose => $value) {
          $app_purpose = array(
            'app_form_id' => $app_form_id,
            'app_purpose_id' => $value
          );
          \App\Model\AppFormPurpose::insert($app_purpose);
        }

        return response()->json(['status' => 'OK', "message" => trans('module4.app_form_create_print_msg')]);
      } else if ($request->operation == "update") {
        $old_app_data = \App\Model\AppForm::whereVehicleId($vehicle_id)->latest('id')->first();

        if (!empty($old_app_data)) {
          //Check app_purpose change or not
          $app_purposes = \App\Model\AppFormPurpose::whereAppFormId($old_app_data->id)->pluck('app_purpose_id')->toArray();
          if (count($app_purposes) > count($request->app_purpose_id)) {
            $differenceArray = array_diff($app_purposes, $request->app_purpose_id);
          } else {
            $differenceArray = array_diff($request->app_purpose_id, $app_purposes);
          }

          //Update App_Form
          $old_app_data->note = request('remark');
          if (count($differenceArray) > 0) {
            $old_app_data->app_form_status_id = 1; //When update application, will change status into "1".
          }
          $old_app_data->customer_name = $request->owner_name; //When create AppFrom from vehicle(M4), customer_name will be saved with ownerName.
          $old_app_data->staff_id = auth()->id();
          $old_app_data->update();

          //Delete Old. No need to delete for app_purpose_id = 1. Because it is not shown in form when call from vehicleEditModal.
          $delete_app_purpose = \App\Model\AppFormPurpose::whereAppFormId($old_app_data->id)->where("app_purpose_id", "!=", "1")->delete();

          //Add New
          foreach ($request->app_purpose_id as $purpose => $value) {
            $app_purpose = array(
              'app_form_id' => $old_app_data->id,
              'app_purpose_id' => $value
            );
            \App\Model\AppFormPurpose::insert($app_purpose);
          }
        } else {
          return response()->json(['status' => 'error', "message" => "There is no Application Form to update for this vehicle."]);
        }

        return response()->json(['status' => 'OK', "message" => trans('module4.app_form_update_print_msg')]);
      }
    } catch (\Exception $e) {
      return response()->json(['error' => $e]);
    }
  }

  public function getNewPrintPaper($id)
  {
    $vehicle = Vehicle::find($id);
    return view('Module4.registration.print.printNewPaper', compact('vehicle'));
  }


  //update appform status book complete when click book button in vehicle page
  public function bookPrint($id)
  {
    AppForm::whereVehicleIdAndAppFormStatusId($id, 5)->update(['app_form_status_id' => 6]);
    return response()->json([
      'success' => "Success print book."
    ]);
  }

  // check vehicle type and license no exist or not license present table when change vehicle type
  public function checkLicenseAndVehType($vehicle_type_id)
  {
    $input = explode(" ", request('license_no'));
    $alphabet_id = \App\Model\LicenseAlphabet::whereName($input[0])->pluck('id')->first();
    $vehicle_type_group = \App\Model\VehicleType::whereId($vehicle_type_id)->pluck('vehicle_type_group_id')->first();
    if ($alphabet_id != null) {
      if (\App\Model\LicenseNumberPresent::whereVehicleTypeGroupIdAndLicenseAlphabetIdAndLicenseNoPresentNumber($vehicle_type_group, $alphabet_id, $input[1])->exists()) {
        $message = "exist";
        return response()->json($message);
      }
      $message = "not-exist";
      return response()->json($message);
    } else {
      $message = "not-exist";
      return response()->json($message);
    }
  }

  public function searchLicense()
  {
    $vehicle = \App\Model\Vehicle::where('licence_no', request('search'))->orWhere('quick_id', request('search'))->orWhere('transfer_no', request('search'))->latest()->first();
    if ($vehicle) {
      return redirect()->to('/all-vehicles/edit/' . $vehicle->id);
    } else {
      return back()->with(['error' => "Data not found."]);
    }
  }
}
