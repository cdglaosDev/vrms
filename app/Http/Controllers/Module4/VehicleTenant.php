<?php

namespace App\Http\Controllers\Module4;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\VehicleTenant as VehTenant;
class VehicleTenant extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store()
    {

        //dd(request()->file('image'));
        $name="";
        if (VehTenant::whereVehicleId(request('vehicle_id'))->exists()) {
            $input = request()->all();
            //upload new image
            if ($files = request()->file('image')) { 
                $tenant = VehTenant::whereVehicleId(request('vehicle_id'))->first();
                // remove old image
                if($tenant->image != ''  && $tenant->image != null){
                    $old_image = public_path('images/tenant')."/".$tenant->image;

                    if (file_exists($old_image)) {
                        unlink($old_image);
                    } else {}   
                }

                $name = uniqid().'_'.$files->getClientOriginalName();
                $dest = public_path('images/tenant');
                $files->move($dest,$name);
                $input['image'] = $name;
                VehTenant::whereVehicleId(request('vehicle_id'))->update(['image' => $name]);                
            }            
          
            VehTenant::whereVehicleId(request('vehicle_id'))->update(request()->only('tenant_name', 'province_code', 'district_code', 'village', 'phone','note'));
            //return back()->with('success', 'Update vehicle tenant information.');
            return response()->json(['success' => 'Update vehicle tenant information.','img'=>$name]);
        } else {
            $input = request()->all();
            if ($files = request()->file('image')) {
                $name = uniqid().'_'.$files->getClientOriginalName();
                $dest = public_path('images/tenant');
                $files->move($dest,$name);
                $input['image'] = $name;
              
            }
        VehTenant::create($input);
        //return back()->with('success', 'Added vehicle tenant information.');
        return response()->json(['success' => 'Added vehicle tenant information.','img'=>$name]);
        }
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
