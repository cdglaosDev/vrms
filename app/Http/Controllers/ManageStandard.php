<?php

namespace App\Http\Controllers;
use App\Model\Standard;
use Illuminate\Http\Request;

class ManageStandard extends Controller
{
    public function index()
    {
        $standard = Standard::orderByDesc('created_at')->get();
        return view('ManageStandard.index',compact('standard'));
    }

    public function create()
    {
        $standard = Standard::all();
        return view('ManageStandard.create',compact('standard'));
    }

    public function store()
    {
        $data = request() -> validate([
                    'name' => 'required',
                    'name_en' => 'required',
                ]);

        $standard = new Standard();
        $standard -> name = request('name');
        $standard -> name_en = request('name_en');
        $standard -> save();

        return redirect('standard')->with('success','Sucessful Created');
    }

    public function show(Standard $standard)
    {
        return view('ManageStandard.show',compact('standard'));
    }

    public function edit(Standard $standard)
    {
        return view('ManageStandard.edit',compact('standard'));
    }

    public function update(Standard $standard)
    {
        $data = Standard::find($standard -> id);
        \LogActivity::saveToLog($data,$tb_name="standards",$action="update");
        $standard -> update($this -> validateRequest());
        return redirect('standard')->with('success','Sucessful Updated');
    }

    public function destroy(Standard $standard)
    {
        $data = Standard::find($standard -> id);
        \LogActivity::saveToLog($data,$tb_name="standards",$action="delete");
        $standard -> delete();
        return redirect('standard')->with('success','Successful Deleted');
    }

    private function validateRequest(){
        return request() -> validate([
            'name' => 'required',
            'name_en' => 'required',
        ]);
    }
}
