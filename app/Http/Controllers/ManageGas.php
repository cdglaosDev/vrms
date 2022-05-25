<?php

namespace App\Http\Controllers;
use App\Model\Gas;
use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;

class ManageGas extends Controller
{
    public function index()
    {
        $ga = Gas::orderByDesc('created_at')->get();
        return view('ManageGas.index',compact('ga'));
    }

    public function create()
    {
        $ga = Gas::all();
        return view('ManageGas.create',compact('ga'));
    }

    public function store()
    {
        $data = request() -> validate([
                    'name' => 'required',
                    'name_en' => 'required',
                ]);

        $ga = new Gas();
        $ga -> name = request('name');
        $ga -> name_en = request('name_en');
        $ga -> save();

        return redirect('gas')->with('success','Sucessful Created');
    }

    public function show(Gas $ga)
    {
        return view('ManageGas.show',compact('ga'));
    }

    public function edit(Gas $ga)
    {
        return view('ManageGas.edit',compact('ga'));
    }

    public function update(Gas $ga)
    {
        $data = Gas::find($ga -> id);
        \LogActivity::saveToLog($data,$tb_name="gases",$action="update");
        $ga -> update($this -> validateRequest());
        return redirect('gas')->with('success','Sucessful Updated');
    }

    public function destroy(Gas $ga)
    {
        $data = Gas::find($ga -> id);
        \LogActivity::saveToLog($data,$tb_name="gases",$action="delete");
        $ga -> delete()->with('success','Successful Deleted');
        return redirect('gas');
    }

    private function validateRequest(){
        return request() -> validate([
            'name' => 'required',
            'name_en' => 'required',
        ]);
    }

}
