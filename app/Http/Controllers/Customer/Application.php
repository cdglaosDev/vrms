<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AppForm;
use App\Http\Requests\AppFormRequest;
use App\Helpers\DateHelper;
use App\Helpers\GenerateCodeNo;
use DB;
class Application extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allApp($status="all")
    {
     
        $app = \App\Model\PreRegisterApp::get();
      
        switch($status){

            case "":

                $app = $app;

            break;

            case "approve":

                $app = \App\Model\PreRegisterApp::whereAppStatusId(2)->get();

                break;

            case "pending":

                 $app = \App\Model\PreRegisterApp::whereAppStatusId(1)->get();

                break;

            case "cancel":

                $app =\App\Model\PreRegisterApp::whereAppStatusId(3)->get();

                break;
           
        }

         // $app = $app->orderByDesc('created_at')->get();
        $data['app'] = $app;
        return view('customer.app.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

        return view('customer.app.create');
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
        $data['app_number'] = $this->getAppNumber();
        $data['app_status'] = "pending";
        
        
     
        if($request->hasfile('filename'))
         {
            $filename =[];
            foreach($request->file('filename') as $file)
            {
                $name=uniqid().'_'.$file->getClientOriginalName();
                $file->move(public_path().'/images/doc/', $name);  
                $filename[] = $name;  
            }
         }
       
        foreach($filename as $image){
           $doc = new \App\Model\AppDocument();
           $doc->app_form_id = $app_id;
           $doc->filename =$image;
             foreach($request->doc_type_id  as $key=>$value){
                $doc->doc_type_id = $value;
                dd(  $doc->doc_type_id );die();
            }
           
           $doc->save();
        }
     
      
        return redirect()->to('customer/apps/all')->with('success', 'Created Application  successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = \App\Model\PreRegisterApp::find($id);
        
        return view('customer.app.detail',compact('data'));
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
        $app_doc = \App\Model\AppDocument::where('app_form_id',$id)->get();
       
        return view('customer.app.edit',compact('data','app_doc'));
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

        \LogActivity::saveToLog($data,$tb_name="app_forms",$action="update");
         $data->date_req = DateHelper::getMySQLDateTimeFromUIDate($request->date_req);
         $data->detail_date_approve = DateHelper::getMySQLDateTimeFromUIDate($request->detail_date_approve);
        $data->date_expire = DateHelper::getMySQLDateTimeFromUIDate($request->date_expire);
        $data->company_id = $request->company_id;
        $data->application_type_id = $request->application_type_id;
        $data->app_license_type_id = $request->app_license_type_id;
        $data->ministry_license =$request->ministry_license;
        $data->tax_office_id =$request->tax_office_id;
        $data->department_license =$request->department_license;
        $data->extra_time =$request->extra_time;
        $data->app_purpose_id =$request->app_purpose_id;
        $data->note =$request->note;
        $data->comment =$request->comment;
        $data->save();
       
        \DB::table('app_documents')->where('app_form_id',$id)->delete();
        if($request->hasfile('filename'))
        {
           $filename =[];
           foreach($request->file('filename') as $file)
           {
               $name=uniqid().'_'.$file->getClientOriginalName();
               $file->move(public_path().'/images/doc/', $name);  
               $filename[] = $name;  
           }
        }
        foreach ($request->doc_type_id as $key => $value) {
            $doc = new \App\Model\AppDocument();
            $doc->app_form_id = $id;
            $doc->doc_type_id = $request['doc_type_id'][$key];
            $doc->filename =$filename[$key];
            $doc->save();
            
        }
       


        return redirect()->to('customer/apps/all')->with('success', 'updated Application form successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = AppForm::find($id);
        \LogActivity::saveToLog($data,$tb_name="app_forms",$action="delete");
        $data->delete();
         return back()->with('success', 'Delete Application form successfully');

    }

    public function getAppNumber(){

             $code = AppForm::where('app_no', 'LIKE', GenerateCodeNo::appNumberPrefix() . '%')->orderBy('app_no', 'desc')->select('app_no')->first();
           
            $app_num= GenerateCodeNo::appNumber($code['app_no']);

            return $app_num;
    }
}
