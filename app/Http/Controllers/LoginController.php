<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectTo()
    {
  
        $type = Auth::user()->user_type; 
        
        switch ($type) {
            case 'customer':
                    return '/customer';
                break;
            case 'staff':
                    return '/announcement-page-list';
                break; 
            default:
                    return '/'; 
                break;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function loginForm(){
        if (Auth::check()) {
            return redirect()->to('/home');
        } else 
        return view('login');
       
    }
         
    

    public function customerLoginForm()
    {
        if (Auth::check()) {
            return redirect()->to('/');
        } else {
           
        return view('customer.login');
       }
    }
    //login by version1
    public function authenticate(Request $request)
    {
        $loginIds = \App\User::whereNotNull('login_id')->pluck('login_id')->toArray();
        $user = \App\User::whereLoginId($request->login_id)->first();
        if (!in_array(request('login_id'), $loginIds)) {
            return response()->json(['status' => "invalid"]);
        }
            if ($user->customer_status != "pending") {
               
                if (Auth::attempt([
                    'login_id' => $request->login_id,
                    'password' => $request->password,
                ])) {
                    if( $user->session_id == null) {
                        $user->session_id = session()->getId();
                        $user->last_seen_at = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
                        $user->save();
                            return response()->json([
                                'status' => "success"
                            ]);
                    }else {
                        return response()->json(['status' => "logined"]);
                    }
               
                }  else {
                    return response()->json(['status' => "wrong-password"]);
                }

            } else {
                return response()->json(['status' => "pending"]);
            }
         
    }

    public function protectedLogin()
    {
        if (Auth::attempt([
            'login_id' => request('login_id'),
            'password' => request('password'),
        ])) {
            session()->getHandler()->destroy(Auth::User()->session_id);
            request()->session()->regenerate();
            Auth::user()->session_id = session()->getId();
            Auth::user()->last_seen_at = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            Auth::user()->save();
           
          return redirect()->to($this->redirectTo());
        } else {
            return redirect()->to('/')->with('error','Your password is wrong');
        }
       
    }

    public function getLogout() 
    {
        auth()->user()->session_id = null;
        auth()->user()->save();
        Auth::logout();
        session()->flush();
        return redirect('/');
    }

}
