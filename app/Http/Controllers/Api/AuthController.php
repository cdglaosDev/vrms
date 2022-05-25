<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use DB;
use Illuminate\Support\Carbon;
class AuthController extends Controller
{
    public function register(Request $request)
    {
       
        $validateRequest = $request->validate([
            'first_name' => 'required|max:55',
            'last_name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed',
            'user_type' => 'required',
        ]);

        $validateRequest['password'] = bcrypt($request->password);
      
        $user = User::create($validateRequest);
        $accessToken = $user->createToken('authToken')->accessToken;
        return response()->json(['success' => $accessToken], 201);
    }
    //User login by Api
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        
        if (auth()->attempt($credentials)) {
            if(auth()->user()->api_token == null){
                $token = auth()->user()->createToken('AccessToken')->accessToken;
               DB::table('users')->where('id',auth()->id())->update(['api_token'=>$token]);
                return response()->json(['login_token' => $token], 200);
            }else{
                return response()->json(['login_token' => auth()->user()->api_token], 200);
            }
           
        } else {
            return response()->json(['message' => 'UnAuthorised'], 401);
        }
    }
       
}
