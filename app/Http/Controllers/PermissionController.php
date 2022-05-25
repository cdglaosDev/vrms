<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Permission;
class PermissionController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:Permission-List-View');
         $this->middleware('permission:Permission-List-Create', ['only' => ['create', 'store']]);
         $this->middleware('permission:Permission-Entry-Edit', ['only' => ['edit', 'update']]);
         $this->middleware('permission:Permission-Entry-Delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data['permission']= Permission::orderByDesc('created_at')->get();

        return view('permission.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permission.create');
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
            'name' => 'required|unique:permissions,name',
            'type' => 'required',    
        ]);
        
        $request['guard_name'] = "web";
        Permission::create($request->all());

       return back()->with('success', "Successful added.");
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
        $data['data']= Permission::find($id);
        return view('permission.edit', $data);
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
        $data = Permission::find($id);
        \LogActivity::saveToLog($data, $tb_name = "permissions", $action = "update");
        DB::table('permissions')->where('id', $id)->update(array('name' => $request->name,'type' => $request->type));
        return redirect('permission');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Permission::find($id);
        \LogActivity::saveToLog($data, $tb_name = "permissions", $action = "delete");
        $data->delete();
        return back();
    }
}
