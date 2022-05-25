<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\InspectPlace;
class InspectPlaceController extends Controller
{
    public function index()
    {
        $inspect_place = InspectPlace::whereStatus(1)->get();
        return view('InspectPlace.index', compact('inspect_place'));
    }

    public function store()
    {
        InspectPlace::create([
            'name'=> request('name'),
            'name_en'=> request('name_en'),
            'status' => request('status')
        ]);
        return back()->with('success', trans('table_man.inspect_place_added_msg'));
    }

    public function update(Request $request, $id)
    {
        
        $inspect_place = InspectPlace::find($id);
        \LogActivity::saveToLog($inspect_place, $tb_name = "inspect_places", $action = "update");
        $inspect_place->update($request->all());
        return back()->with('success', trans('table_man.inspect_place_update_msg'));
    }

    public function destroy($id)
    {
        $data = InspectPlace::find($id);
        \LogActivity::saveToLog($data, $tb_name ="inspect_places", $action = "delete");
        $data->delete();
        return back()->with('success', trans('table_man.inspect_place_delete_msg'));
    }
}
