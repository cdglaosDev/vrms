<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Staff;
use App\Helpers\DateHelper;
class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = Staff::orderByDesc('created_at')->get();
        return view('customer.staff.index',compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = \App\Model\Company::where('user_id',auth()->user()->id)->get();
        return view('customer.staff.create',compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
         $this->validate($request, [
            'company_id' => 'required',
            'name' => 'required',
            'name_en' =>'required',
            'email' => 'required',
            'phone' => 'required'
           
        ]);

        $data = $request->all();
      
        $data['birthdate']=DateHelper::getMySQLDateTimeFromUIDate($request->birthdate);
        $data['create_by'] = auth()->user()->id;
        if($files=$request->file('image')){
            $name=uniqid().'_'.$files->getClientOriginalName();
           
            $dest =public_path('images/staff');
             
            $files->move($dest,$name);
           $data['image'] =$name;
          
        }
         Staff::create($data);
         return redirect()->route('staff.index')->with('success',"Successfuly staff created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Staff::find($id);
        return view('customer.staff.detail',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $data = Staff::find($id);
        return view('customer.staff.edit',compact('data'));
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
            'company_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'name_en' =>'required',
            'phone' => 'required'
           
        ]);

        $data = Staff::find($id);
        \LogActivity::saveToLog($data,$tb_name="staff",$action="update");
        $data['birthdate']=DateHelper::getMySQLDateTimeFromUIDate($request->birthdate);
        $data['name'] = $request->name;
        $data['name_en'] = $request->name_en;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['gender'] = $request->gender;
        $data['address'] = $request->address;
        $data['position'] =$request->position;
        $data['create_by'] = auth()->user()->id;
        if($files=$request->file('image')){
            $name=uniqid().'_'.$files->getClientOriginalName();
           
            $dest =public_path('images/staff');
             
            $files->move($dest,$name);
           $data['image'] =$name;
          
        }
       $data->save();
         return redirect()->route('staff.index')->with('success',"Successfuly staff updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $data = Staff::find($id);
        \LogActivity::saveToLog($data,$tb_name="staff",$action="delete");
        $data->delete();
         return back()->with('success',"Successfuly Delete!");
    }
}
