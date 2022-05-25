<?php

namespace App\Http\Controllers\Module4;

use App\Model\Vehicle;
use Illuminate\Http\Request;
use App\Model\VehiclePrintDetail;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\Types\Null_;

class VehiclePrintDetailController extends Controller
{
    public function saveVehiclePrintDetail()
    {
        try {
            $button_type = request('button_type');

            $vehicle_print_detail = new VehiclePrintDetail();
            if(!empty(request('print_detail_id'))){//Update
                $vehicle_print_detail = VehiclePrintDetail::whereVehiclesIdAndPrintType(request('vehicle_id'), $button_type)->first();
            }
           
            $vehicle_print_detail->no = request('no');
            $vehicle_print_detail->date = request('date');

            if ($button_type == "Document Certification" || $button_type == "Certificate Used Instead") {
                $vehicle_print_detail->permanent = empty(request('permanent')) ? null : request('permanent');
                $vehicle_print_detail->temporary = empty(request('temporary')) ? null : request('temporary');
                $vehicle_print_detail->old_license_no = empty(request('old_license_no')) ? null : request('old_license_no');
                $vehicle_print_detail->license_no = empty(request('license_no')) ? null : request('license_no');
                $vehicle_print_detail->dated = empty(request('dated')) ? null : request('dated');
                $vehicle_print_detail->certificate_dated = empty(request('certificate_dated')) ? null : request('certificate_dated');
            } else if ($button_type == "Elimination License") {
                $vehicle_print_detail->send_to = empty(request('send_to')) ? null : request('send_to');
                $vehicle_print_detail->transport_no = empty(request('transport_no')) ? null : request('transport_no');
                $vehicle_print_detail->dated = empty(request('dated')) ? null : request('dated');
            } else if ($button_type == "Certificate") {
                $vehicle_print_detail->country_origin = empty(request('country_origin')) ? null : request('country_origin');
                $vehicle_print_detail->note = empty(request('note')) ? null : request('note');
            } else if ($button_type == "Damaged Certificate") {
                $vehicle_print_detail->permanent = empty(request('permanent')) ? null : request('permanent');
                $vehicle_print_detail->dated = empty(request('dated')) ? null : request('dated');
            }

            $vehicle_print_detail->vehicles_id = request('vehicle_id');
            $vehicle_print_detail->print_type = request('button_type');
            // $vehicle_print_detail->print_count = 1;
            // $vehicle_print_detail->print_by = auth()->id();
            $vehicle_print_detail->save();

            return response()->json(['status' => 'OK', 'vehicle_print_detail_id' => $vehicle_print_detail->id]);
        } catch (\Exception $e) {
            //return response()->json(['error' => $e]);
            return response()->json(['status' => 'NOT OK']);
        }
    }

    public function vehiclePrints(Request $request)
    {
        try {
            $vehicle_id = request('vehicle_id');
            $print_detail_id = request('print_detail_id');
            $button_type = request('button_type');

            $vehicle = Vehicle::find($vehicle_id);

            $vehicle_print_detail = VehiclePrintDetail::find($print_detail_id);
            //$vehicle_print_detail->print_type = $button_type;
            $vehicle_print_detail->print_count = ($vehicle_print_detail->print_count?? 0) + 1;
            $vehicle_print_detail->print_by = auth()->id();
            $vehicle_print_detail->save();

            if ($button_type == "Document Certification") {
                return view('Module4.registration.print.document-certificate', compact('vehicle', 'vehicle_print_detail'));
            } else if ($button_type == "Certificate Used Instead") {
                return view('Module4.registration.print.certificate-used', compact('vehicle', 'vehicle_print_detail'));
            } else if ($button_type == "Elimination License") {
                return view('Module4.registration.print.elimination-license', compact('vehicle', 'vehicle_print_detail'));
            } else if ($button_type == "Certificate") {
                return view('Module4.registration.print.certificate', compact('vehicle', 'vehicle_print_detail'));
            } else if ($button_type == "Damaged Certificate") {
                return view('Module4.registration.print.damaged-certificate', compact('vehicle', 'vehicle_print_detail'));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'NOT OK']);
        }
    }
}
