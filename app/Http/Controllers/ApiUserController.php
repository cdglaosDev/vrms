<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Helpers\Helper;
use App\Model\UserInfo;

class ApiUserController extends Controller
{
    function __construct()
        {   
               
            $this->middleware('permission:ApiUser-All|ApiUser-List-View|ApiUser-Create|ApiUser-Edit|ApiUser-Delete');
            $this->middleware('permission:ApiUser-List-View');
            $this->middleware('permission:ApiUser-Create', ['only' => ['create', 'store']]);
            $this->middleware('permission:ApiUser-Edit', ['only' => ['update']]);
            $this->middleware('permission:ApiUser-Delete', ['only' => ['destroy']]);
        }
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
       
        $api_user = User::whereUserType('api_user')->get();
        return view('users.apiUser.index', compact('api_user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.apiUser.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validateRequest();
        $input = request()->all();
        $input['user_type'] = "api_user";
        $input['api_token'] = md5(uniqid(rand(), true));
        $user = User::create($input);
        UserInfo::create([
            'address' => request('address'),
            'user_id' => $user->id
        ]);
        return redirect()->route('api-user.index')->with('success', 'Api User created successfully');
        
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
        User::whereId($id)->update([
         'first_name' => request('first_name'),
         'last_name' => request('last_name'),
         'email' => request('email'),
         'phone' => request('phone'),
         'status' => request('status')
        ]);
        UserInfo::whereUserId($id)->update([
            'address' => request('address')
        ]);
      
        return back()->with('success', 'Successful updated api user.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return back()->with('success', 'Deleted successfully.');
    }

    private function validateRequest(){
        return request() -> validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required'
        ]);
    }
}
