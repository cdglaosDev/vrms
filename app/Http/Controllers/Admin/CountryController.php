<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Country;
use App\Helpers\Helper;

class CountryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Country-All');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   
    public function index()
    {
        $data = \App\Model\Country::orderByDesc('created_at')->get();
        return view("admin.country.country", compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
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
 

    //check duplicate records in country
    public function checkRecord()
    {
      if( Country::where([['id', '!=', request('id')], ['iso' , request('iso')]])
                ->orwhere([['id', '!=', request('id')], ['name' , request('name')]])
                ->orwhere([['id', '!=', request('id')], ['name_en' , request('name_en')]])->exists()){
            return response()->json([
          'status' =>  "used",
        ]);
      }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $country = new Country();
        $country->iso=$request->iso;
        $country->name=$request->name;
        $country->name_en=$request->name_en;
        $country->status=$request->status;
        $country->save();
        return redirect('admin/country')->with('success', trans('table_man.country_added_msg')); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $data['countrys'] =Country::find($id);
        return view('admin.service_counter.update',$data);
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
        
        $update=Country::find($id);
        \LogActivity::saveToLog($update,$tb_name="country",$action="update");
        $update->iso=$request->iso;
        $update->name=$request->name;
        $update->name_en=$request->name_en;
        $update->status=$request->status;
        $data = $request->except(['_token', '_method' ]);
        $update->save();
        return redirect('/admin/country')->with('success', trans('table_man.country_update_msg')); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
    {
        $data =Country::find($id);
        \LogActivity::saveToLog($data,$tb_name="Countrys",$action="delete");
        $data->delete();
        return redirect('admin/country')->with('success', trans('table_man.country_delete_msg')); 
    }
}
