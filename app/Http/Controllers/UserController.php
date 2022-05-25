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
use App\Mail\ConfirmMail;
use App\Mail\RejectMail;
use App\Mail\ResetPassMail;
use Mail;
use App\Helpers\Helper;
use App\Notifications\UserAction;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Carbon\Carbon;
class UserController extends Controller

{
    function __construct()
        {   
               
            $this->middleware('permission:Staff-All|Staff-List-View|Staff-Create|Staff-Edit|Staff-Delete|Customer-List-View');
            $this->middleware('permission:Staff-List-View');
            $this->middleware('permission:Staff-Create', ['only' => ['create', 'store']]);
            $this->middleware('permission:Staff-Edit', ['only' => ['edit', 'update']]);
            $this->middleware('permission:Staff-Delete', ['only' => ['destroy']]);
            $this->middleware('permission:Customer-List-View', ['only' => ['customerList']]);
                
        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     
        $roles = auth()->user()->getRoleNames();
        $zname_clean = preg_replace('/\s*/', '', $roles[0]);
        $admin = strtolower($zname_clean);
        if (auth()->user()->user_level == "province") {
            $data = User::whereHas('user_info', function($q){
                $q->whereProvinceCode(auth()->user()->user_info->province_code);
            })->whereUserType('staff')->get();
           
        } else {
            $data = User::whereUserType('staff')->get();
        }
        $roles = Role::pluck('name','name')->all();
        return view('users.index', compact('data','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
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
            'login_id' => 'required|unique:users,login_id',
            'roles' => 'required',
            'province_code'=>'required',
            'image' => 'mimes:jpeg,png',
            'password' => 'required|confirmed|min:6',
        ]);

        $input = $request->all();
        if ($files=$request->file('image')) {
            $name=uniqid().'_'.$files->getClientOriginalName();
            $dest = public_path('images/user');
            $files->move($dest,$name);
            $input['user_photo'] = $name;
            
        }
        $input['password'] = Hash::make($request->password);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        $info = new UserInfo();
        $info->address = $request->address;
        $info->district_code = $request->district_code;
        $info->province_code = $request->province_code;
        $info->user_id = $user->id;
        $info->save();
        $email = $user->email;
        if($email){
            Mail::to($email)->send(new \App\Mail\ConfirmMail($user));
        } 
        return redirect()->route('users.index')->with('success', 'New Staff created successfully.');
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
        return view('users.show', compact('user'));
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
       
        $input = $request->all();
        if (!empty($input['password'])) { 
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = array_except($input,array('password'));    
        }
        if ($files = $request->file('image')) {
            $name = uniqid().'_'.$files->getClientOriginalName();
            $dest = public_path('images/user');
            $files->move($dest,$name);
            $input['user_photo'] = $name;
        }
        
        $user = User::find($id);
         \LogActivity::saveToLog($user, $tb_name = "users", $action = "update");
        DB::table('user_infos')->where('user_id', $id)->update(['address' => $request->address, 'district_code' => $request->district_code, 'province_code' => $request->province_code]);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));
        // $user->notifyWithNotiUser(new UserAction($user, "Informatioion User", "Success in User Update!"));
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
        $data = User::find($id);
        \LogActivity::saveToLog($data, $tb_name = "users", $action = "delete");
        $data->user_info()->delete();
        $data->delete();
        return back()->with('success', 'User deleted successfully');
    }

    public function resetPassword($id)
    {
        $user = User::find($id);
        $user->password = Hash::make(111111);
        $user->save();
       // Mail::to($user->email)->send(new \App\Mail\ResetPassMail($user));
        return back()->with('success', 'Successful Reset Password.');
    }

    public function getLoginCode()
    {
        $code = User::where('login_id', 'LIKE', GenerateCodeNo::getAccountPrefix() . '%')->orderBy('login_id', 'desc')->select('login_id')->first();
        $login_code= GenerateCodeNo::LoginCode($code['login_id']);
        return $login_code;
    }

    //get customer lists in admin side
    public function customerList()
    {
        $data = User::CustomerLists();
         return view('users.customer_list', compact('data'));
    }

    //update status in customer page
    public function customerStatus($id, $status)
    {
        $user = User::find($id);
        $user->customer_status = $status;
        $user->save();
        $email = $user->email;
        if ($user->customer_status == "approve") {
            Mail::to($email)->send(new \App\Mail\ApproveMail($user));
            return back()->with('success', 'Successful status changed');
        } else {
            Mail::to($email)->send(new \App\Mail\RejectMail($user));
            return back()->with('success', 'Successful status changed');
        }
    }
   
}
