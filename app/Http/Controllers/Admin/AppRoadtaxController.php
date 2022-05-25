<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AppForm;
use App\Model\AppRoadTax;
use App\Helpers\DateHelper;
class AppRoadtaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    $data['roadtaxes']=\App\Model\AppRoadTax::orderByDesc('created_at')->get();
      $data['appform'] =\App\Model\AppForm::pluck('id');
        return view("admin.Roadtax.roadtax",$data);


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
           $transfer=new AppRoadTax();
        $transfer->amount=$request->amount;
        $transfer->currency=$request->currency;
         $transfer->file=$request->file;
    $transfer->app_form_id=$request->app_form_id;
                 $transfer->remark=$request->remark;
                 
           $transfer->status=$request->status;
           
         $transfer['date']=DateHelper::getMySQLDateTimeFromUIDate($request->date);
          
            $transfer->save();
     return redirect('admin/road-tax')->with('success','Successful Application Road Taxes  Added.'); 
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
       $transfer=AppRoadTax::find($id);
        \LogActivity::saveToLog($transfer ,$tb_name="app_roadtexes",$action="update");
        $transfer->amount=$request->amount;
        $transfer->currency=$request->currency;
                  $transfer->file=$request->file;
    $transfer->app_form_id=$request->app_form_id;
                 $transfer->remark=$request->remark;
                 
           $transfer->status=$request->status;
           
         $transfer['date']=DateHelper::getMySQLDateTimeFromUIDate($request->date);
            $transfer->save();
     return redirect('admin/road-tax')->with('success','Successful Application Road Taxes Update.'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $data =AppRoadTax::find($id);
        \LogActivity::saveToLog($data,$tb_name="AppRoad_Taxes",$action="delete");
     $data->delete();
        return redirect('admin/road-tax')->with('success','Successful Application Road Taxes Delete.'); 
    }
}
