<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\AppForm;
use App\Model\VehicleDocument;
use App\Model\Vehicle;
class ApplicationFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $app_form = AppForm::orderByDesc('created_at')->get();
       
        //return view('ApplicationForm.index',compact('app_form'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("ApplicationForm.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $app_form = AppForm::find($id);

       $vehicle = Vehicle::whereId($app_form['vehicle_id'])->get()->first();
       return view('ApplicationForm.detail',compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
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
        $data = AppForm::find($id);
        $data->staff_id = $request->staff_id;
        $data->note = $request->note;
        $data->comment = $request->comment;
        $data->date_request = \App\Helpers\DateHelper::getMySQLDateFromUIDate($request->date_request);
        $data->app_status_id = $request->app_status_id;
        $data->save();
        $vehicle = \App\Model\Vehicle::whereId($data['vehicle_id'])->first();
        $vehicle->division_no = $request->division_no;
        $vehicle->province_no = $request->province_no;
       
        $vehicle->save();
        return redirect()->to('application-form')->with('success','Registration form updated.');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
}
