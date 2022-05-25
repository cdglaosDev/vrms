<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\DisplaySetting;
use App\Model\SmartCardSetting;

class DisplaySettingController extends Controller
{
    function __construct()
        {   
               
            $this->middleware('permission:Display-Setting-All|Display-Setting-List-View|Display-Setting-Create|Display-Setting-Edit|Display-Setting-Delete|Smart-Card-Setting');
            $this->middleware('permission:Display-Setting-List-View');
            $this->middleware('permission:Display-Setting-Create', ['only' => ['store']]);
            $this->middleware('permission:Display-Setting-Edit', ['only' => ['update']]);
            $this->middleware('permission:Display-Setting-Delete', ['only' => ['destroy']]);
            $this->middleware('permission:Smart-Card-Setting', ['only' => ['smartCardSetting']]);
           
        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $display_setting = DisplaySetting::whereStatus(1)->get();
        return view('DisplaySetting.index', compact('display_setting'));
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
        $this->validate(request(), [
            'department_id' => 'required|unique:display_settings,department_id',
            'text1' => 'required|string',
            'text2' => 'required|string',
            'text3' => 'required|string',
            'title' =>'required|string'
        ]);
        $data = request()->all();
        $data['created_by'] = auth()->id();
        DisplaySetting::create($data);
        return back()->with('success', 'Display Setting created successfully');
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
    public function update( $id)
    {
        $this->validate(request(), [
            'department_id' =>  'nullable|unique:display_settings, department_id,'.$id,
            'text1' => 'nullable|string',
            'text2' => 'nullable|string',
            'text3' => 'nullable|string',
            'title' =>'nullable|string'
        ]);
        $data = DisplaySetting::find($id);
        $data['updated_by'] = auth()->id();
        $data->update(request()->all());
        return back()->with('success', 'Display Setting successful updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data =DisplaySetting::find($id);
        \LogActivity::saveToLog($data, $tb_name = "display_settings", $action = "delete");
        $data->delete();
        return redirect('/display-setting')->with('success', 'Successful Display Setting  Delete.'); 
    }

    //smartcard setting
    public function smartCardSetting()
    {
        $code = \App\Model\SmartCardSetting::first();
       return view('DisplaySetting.smartcard-setting', compact('code'));
    }

    //update smartcard setting
    public function updateSmartCartSetting($id)
    {
        \App\Model\SmartCardSetting::whereId($id)->update([
            'code' => request('code'),
            'security_pin' => request('security_pin'),
            'updated_by' => auth()->id()
        ]);
        return redirect('/smartcard-setting')->with('success', 'Successful Display Setting updated.'); 
    }
}
