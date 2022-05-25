<?php

namespace App\Http\Controllers\Module4;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\VehicleDocument;
use Illuminate\Support\Facades\File;
use DB;

class VehDocument extends Controller
{
    protected $doc_folder;
    public function __construct()
    {
        $this->doc_folder = new \App\Library\DocFilename();
    }

    //store document file from excel import attach file, edit and detail page
    public function attchDocument(Request $request, $id)
    {
        //return response()->json(['status' => 'NOT OK', 'message' => $request->all()]);
        try {
            if (
                empty($request->file()) && $request['2'] == null && $request['3'] == null && $request['4'] == null &&
                $request['5'] == null && $request['6'] == null && $request['7'] == null && $request['8'] == null
            ) {
                return response()->json(['status' => 'NOT OK', 'message' => 'Need to choose at least one file.']);
            } else {
                $doc = VehicleDocument::whereVehicleId($id)->get();

                if (!$doc->isEmpty()) {
                    foreach ($request->doc_type_id as $doc_type_id => $value) {
                        $app_doc = VehicleDocument::whereVehicleId($id)->whereDocTypeId($value)->first();
                        if ($request[$value] == 0) {
                            //return response()->json(['status' => 'OK', 'message' => "Create null"]);
                            $path = public_path() . '/images/vehicle_doc/' . $id . '/' . $app_doc->filename;
                            File::delete($path); //remove old file from public folder
                            DB::table('vehicle_documents')->whereVehicleIdAndDocTypeId($id, $value)->update(['filename' => null]);
                        } else if ($request[$value] == 1) {
                            DB::table('vehicle_documents')->whereVehicleIdAndDocTypeId($id, $value)->update(['filename' => $app_doc->filename]);
                        } else {
                            //return response()->json(['status' => 'OK', 'message' => $request->file($value) . ": Create File"]);

                            $app_doc->filename = $this->unique_filename($request->file($value),  $value, $id);
                            $app_doc->location = request('location');
                            $app_doc->floor = request('floor');
                            $app_doc->channel = request('channel');
                            $app_doc->row = request('row');
                            $app_doc->location_note = request('location_note');
                            $app_doc->save();
                        }
                    }
                } else {
                    foreach ($request->doc_type_id as $doc_type_id => $value) {
                        $appdoc = array(
                            'vehicle_id' => $id,
                            'doc_type_id' => $value,
                            'location' => request('location'),
                            'floor' => request('floor'),
                            'channel' => request('channel'),
                            'row' => request('row'),
                            'location_note' => request('location_note'),
                            'filename' => $this->unique_filename($request->file($value), $value, $id)
                        );
                        VehicleDocument::insert($appdoc);
                    }
                }
            }

            return response()->json(['status' => 'OK', 'message' => 'Successful uploaded document file.']);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error', 'message' => "Error in updating \"Vehicle Document\".\n" . $e->getMessage(), 'errors' => $e
            ]);
        }
    }

    public function unique_filename($filename, $value, $id)
    {
        $file = $filename;
        if ($file != null) {
            //generate filename same as doc type
            $name = $this->doc_folder->DocFile($file, $value);
            $file->move(public_path() . '/images/vehicle_doc/' . $id . '/', $name);
            $filename = $name;
        } else {
            $filename = null;
        }

        return $filename;
    }

    //update document file from vehicle import detail and edit   page
    public function updateDocument(Request $request)
    {
        try {
            $this->validate($request, [
                'filename' => 'mimes:pdf,jpeg,png',
            ], [
                'filename.mimes' => 'Only pdf,jpeg and png images are allowed.',
            ]);
            $app_doc = VehicleDocument::whereVehicleIdAndDocTypeId($request->vehicle_detail_id, $request->doc_type_id)->first();
            if ($request->hasfile('filename')) {
                $file = $request->file('filename');
                $doc = new \App\Library\DocFilename();
                $name = $doc->DocFile($file, $request->doc_type_id);
                $file->move(public_path() . '/images/vehicle_doc/' . $request->vehicle_detail_id . '/', $name);
                $filename = $name;
            }
            $app_doc->filename = $filename;
            $app_doc->save();
            return response()->json(['status' => 'OK', 'message' => 'Successful updated document file.']);

            //return back()->with('success', 'Successful updated document file.');
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error', 'message' => "Error in updating \"Vehicle Document\".\n" . $e->getMessage(), 'errors' => $e
            ]);
        }
    }
}
