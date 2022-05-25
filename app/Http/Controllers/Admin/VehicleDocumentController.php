<?php

namespace App\Http\Controllers\Module4;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Model\StoreDocument;
use App\Helpers\DateHelper;
class VehicleDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $data['document']= StoreDocument::orderByDesc('created_at')->get();
         $data['vehicle'] =\App\Model\Vehicle::get();
            $data['vehdocument'] =\App\Model\ApplicationDocType::get();
             $data['province'] =\App\Model\Province::whereStatus(1)->get();
        return view('vehicle-document.vehicle-document',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['document'] =StoreDocument::get();
        
        return view('vehicle-document.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'vehicle_id' => 'required',
            'doc_type_id' =>'required',
            'province_code' =>'required',
           
            
        ]);
       // dd($request);
            $app=new StoreDocument();
            $app->vehicle_id =$request->vehicle_id;
            $app->doc_type_id =$request->doc_type_id;
            $app->filename =$request->filename;
            $app['date']=DateHelper::getMySQLDateTimeFromUIDate($request->date);
            $app->province_code =$request->province_code;
            $app->location =$request->location;
            $app->floor =$request->floor;
            $app->channel =$request->channel;
            $app->link =$request->link;
            $app->note =$request->note;
            $app->status =$request->status;
        $app->save();
         return redirect('/vehicle-document')->with('success','Successful Application Status Added.');
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
        //
        $this->validate($request,[
           
           
            
        ]);
         $app =StoreDocument::find($id);
        \LogActivity::saveToLog($app ,$tb_name="store_documents",$action="update");
            $app->vehicle_id =$request->vehicle_id;
            $app->doc_type_id =$request->doc_type_id;
            $app->filename =$request->filename;
            $app['date']=DateHelper::getMySQLDateTimeFromUIDate($request->date);
            $app->province_code =$request->province_code;
            $app->location =$request->location;
            $app->floor =$request->floor;
            $app->channel =$request->channel;
            $app->link =$request->link;
            $app->note =$request->note;
            $app->status =$request->status;
        $app->save();
         return back()->with('success','Successful Vehicle Document updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data =StoreDocument::find($id);
        \LogActivity::saveToLog($data,$tb_name="Store_documents",$action="delete");
     $data->delete();
        return back()->with('success','Successful Vehicle Document delete');
    }
}
