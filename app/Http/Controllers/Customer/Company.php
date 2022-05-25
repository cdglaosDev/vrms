<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class Company extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['company'] = \App\Model\Company::where('user_id',auth()->user()->id)->orderByDesc('created_at')->get();
        return view('customer.company.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.company.create');
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
            'name' => 'required',
            'name_en' => 'required',
            'email' => 'required',
            'phone'=>'required',
            'contact_name'=>'required',
            'contact_name_en'=>'required'
          
        ]);
         $data = $request->all();
         $data['user_id'] = Auth::user()->id;
         \App\Model\Company::create($data);
         return redirect()->to('customer/company')->with('success','Successful created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = \App\Model\Company::find($id);
        return view('customer.company.detail',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = \App\Model\Company::find($id);
        return view('customer.company.edit',compact('data'));
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
            'name' => 'required',
            'name_en' => 'required',
            'email' => 'required',
            'phone'=>'required',
            'contact_name'=>'required',
            'contact_name_en'=>'required'
          
        ]);
         $data = \App\Model\Company::find($id);

        \LogActivity::saveToLog($data,$tb_name="companies",$action="update");
         $data->name = $request->name;
         $data->name_en = $request->name_en;
         $data->email = $request->email;
         $data->phone = $request->phone;
         $data->fax = $request->fax;
         $data->address = $request->address;
         $data->contact_name = $request->contact_name;
         $data->contact_name_en = $request->contact_name_en;
         $data->contact_phone = $request->contact_phone;
         $data->tax_number = $request->tax_number;
         $data->country_id = $request->country_id;
         $data->save();
         return redirect()->route('company.index')->with('sucess',"Successful Updated");


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = \App\Model\Company::find($id);

        \LogActivity::saveToLog($data,$tb_name="companies",$action="delete");
        $data->delete();
        return back()->with('success','Successful deleted');
    }
}
