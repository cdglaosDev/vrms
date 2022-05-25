<?php

namespace App\Http\Controllers\Module4;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\LicenseAlphabet as LicenseAlpha;
use DB;
class LicenseAlphabet extends Controller
{
    function __construct()
    {   
        $this->middleware('permission:Alphabet-List-View');
         $this->middleware('permission:Alphabet-Create', ['only' => ['store']]);
         $this->middleware('permission:Alphabet-Edit', ['only' => ['update']]);
         $this->middleware('permission:Alphabet-Delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $license = DB::table('license_alphabets')->select('id','name', 'name_en')->get();
        return view('Module4.LicenseAlphabet.index', compact('license'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        LicenseAlpha::create([
            'name' => request('name'),
            'name_en' => request('name_en'),
            'created_by' => auth()->id(),
        
        ]);
     
        return back()->with('success', 'Create License Alphabet');
    }

    public function checkAlphabet()
    {
        if (LicenseAlpha::whereName(request('alphabet'))->where('id' ,'!=', request('id'))->exists()) {
            return response()->json(['status' =>"used"]);
         } 
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:license_alphabets,name,' .$id,
        ]);

       $data = LicenseAlpha::find($id);
       \LogActivity::saveToLog($data, $tb_name = "license_alphabets", $action = "update");
       $data->name = $request->name;
       $data->name_en = $request->name_en;
       $data->created_by = auth()->id();
       $data->save();
        return back()->with('success', 'License Alphabet updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = LicenseAlpha::find($id);
        \LogActivity::saveToLog($data, $tb_name = "license_alphabets", $action = "delete");
        $data->delete();
        return back()->with('success', 'Successful delete');
    }
}
