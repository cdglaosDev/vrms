<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\TransferVehicle;
use App\Model\Country;
use App\Helpers\DateHelper;
class TransfervehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    $data['transfers']=\App\Model\TransferVehicle::orderByDesc('created_at')->get();
      $data['province'] =\App\Model\Province::pluck('id','name');
        return view("admin.transfer_vehicle.transfer_vehicle",$data);


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
        
            $request->validate([
       
       ]); 

        $transfer=new TransferVehicle();
        $transfer->app_number=$request->app_number;
        $transfer->transer_from=$request->transer_from;
           $transfer->transer_to=$request->transer_to;
             $transfer->old_vehicle_number=$request->old_vehicle_number;
               $transfer->new_vehicle_number=$request->new_vehicle_number;
                 $transfer->date=$request->date;
                   $transfer->remark=$request->remark;
           $transfer->status=$request->status;
             $transfer->apply_by=$request->apply_by;
               $transfer->approved_officer=$request->approved_officer;
             $transfer['date']=DateHelper::getMySQLDateTimeFromUIDate($request->date);
   $transfer->save();
     return redirect('admin/transfer_vehicle')->with('success','Successful Transfer Vehicle  Added.'); 
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
       $request->validate([
        
       
       ]); 
       $transfer=TransferVehicle::find($id);
          $transfer->update($request->all());
           $transfer['date']=DateHelper::getMySQLDateTimeFromUIDate($request->date);
     return redirect('admin/transfer_vehicle')->with('success','Successful Transfer  Vehicle Update.'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TransferVehicle::destroy($id);
        return redirect('admin/transfer_vehicle')->with('success','Successful Transfer Vehicle  Delete.'); 
    }
}
