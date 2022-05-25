<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use App\Model\UserInfo;
use App\Helpers\GenerateCodeNo;
use App\Helpers\DateHelper;
use App\Mail\ApproveMail;
use Mail;
class ManageImporter extends Controller
{
    // function __construct()
    // {
    //     $this->middleware('permission:user-list');
    //     $this->middleware('permission:user-create', ['only' => ['create','store']]);
    //     $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
    //     $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    //     $this->middleware('permission:reset-pass', ['only' => ['resetPassword']]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = User::whereUserType('staff')->orderBy('id', 'DESC')->paginate(5);
        return view('Importer.ManageImporter.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('Importer.ManageImporter.create', compact('roles'));
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
            'user_type'=>'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['login_id'] = $this->getLoginCode();
        $input['birthdate'] = DateHelper::getMySQLDateTimeFromUIDate($request->birthdate);
        if ($files=$request->file('image')) {
            $name=uniqid().'_'.$files->getClientOriginalName();
            $dest = public_path('images/user');
            $files->move($dest,$name);
            $input['user_photo'] = $name;
          
        }
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        $info = new UserInfo();
        $info->address =$request->address;
        $info->district_id =$request->district_id;
        $info->province_id =$request->province_id;
        $info->user_id =$user->id;
        $info->save();
        return redirect()->route('importer.index')->with('success', 'Importer created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('users.edit', compact('user', 'roles', 'userRole'));
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
            'first_name' => 'required',
             'last_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
        $input = $request->all();
        if (!empty($input['password'])) { 
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = array_except($input, array('password'));    
        }
        if ($files=$request->file('image')) {
        $name=uniqid().'_'.$files->getClientOriginalName();
        $dest =public_path('images/user');
        $files->move($dest, $name);
        $input['user_photo'] =$name;
        }
        $input['birthdate'] = DateHelper::getMySQLDateTimeFromUIDate($request->birthdate);
        $user = User::find($id);
        DB::table('user_infos')->where('user_id', $id)->update(['address' => $request->address, 'district_id' => $request->district_id, 'province_id' => $request->province_id]);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    public function resetPassword($id){
        $user = User::find($id);
        $user->password =bcrypt('111111');
        $user->save();
        return back()->with('success', 'Successful Reset Password');
    }
    
    public function getLoginCode(){

        $code = User::where('login_id', 'LIKE', GenerateCodeNo::getAccountPrefix() . '%')->orderBy('login_id', 'desc')->select('login_id')->first();
           
        $login_code= GenerateCodeNo::LoginCode($code['login_id']);

        return $login_code;
    }

    public function customerList(){
        $data = User::whereUserType('customer')->orderBy('id', 'DESC')->get();
        return view('users.customer_list', compact('data'));
    }

    public function customerStatus($id, $status)
    {
        $user = User::find($id);
        $user->customer_status = $status;
        $user->save();
        if ($user->customer_status == "approve") {
            $email = $user->email;
            Mail::to($email)->send(new \App\Mail\ApproveMail($user));
          return back()->with('success', 'Successful status changed');
        } else {
            return back()->with('success', 'Successful status changed');
        }
    }
}
