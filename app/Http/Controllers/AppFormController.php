<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\AppForm;
use App\Http\Requests\AppFormRequest;
use App\Helpers\DateHelper;
class AppFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['app_form'] = AppForm::whereStatus(1)->orderByDesc('created_at')->get();
        return view('AppForm.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

        return view('AppForm.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppFormRequest $request)
    {
        $data = $request->validated();
        $data['date_req'] = DateHelper::getMySQLDateTimeFromUIDate($request->date_req);
        $data['detail_date_approve'] = DateHelper::getMySQLDateTimeFromUIDate($request->detail_date_approve);
        $data['date_expire'] = DateHelper::getMySQLDateTimeFromUIDate($request->date_expire);
        $data['app_status'] ="pending";
        AppForm::create($data);
        return redirect()->route('app-form.index')->with('success', 'Created Application form successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = AppForm::find($id);
        return view('AppForm.detail',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data =  AppForm::find($id);
        return view('AppForm.edit',compact('data'));
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
         $app_form = AppForm::find($id);
         \LogActivity::saveToLog($app_form,$tb_name="app_forms",$action="update");
        $data = $request->all();
        $data = $request->except(['_token', '_method' ]);
        $data['date_req'] = DateHelper::getMySQLDateTimeFromUIDate($request->date_req);
        $data['detail_date_approve'] = DateHelper::getMySQLDateTimeFromUIDate($request->detail_date_approve);
        $data['date_expire'] = DateHelper::getMySQLDateTimeFromUIDate($request->date_expire);
        AppForm::where('id',$id)->update($data);
        return redirect()->route('app-form.index')->with('success', 'updated Application form successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $app_form = AppForm::find($id);
         \LogActivity::saveToLog($app_form,$tb_name="app_forms",$action="delete");
        $app_form->delete();
         return back()->with('success', 'Delete Application form successfully');

    }
}
