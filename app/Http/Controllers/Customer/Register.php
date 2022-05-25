<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Hash;
use App\Model\UserInfo;
use App\Helpers\GenerateCodeNo;
use Mail;
use App\Rules\MatchOldPassword;

class Register extends Controller
{
    public function registerCustomer()
    {
      
    	return view('customer.register');
    }

    public function storeCustomer(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' =>'unique:users,email',
            'login_id' => 'unique:users,login_id',
            'password' => 'required|same:confirm-password',
            'image' => 'mimes:jpeg,png',
        ],[
            'image.mimes' => 'Only jpeg and png images are allowed.',
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['login_id'] = $this->getLoginCode();
        $input['customer_status'] = "pending";
        $input['user_type'] = "customer";
        if ($files = $request->file('image')) {
            $name = uniqid().'_'.$files->getClientOriginalName();
           
            $dest = public_path('images/customer');
             
            $files->move($dest,$name);
           $input['user_photo'] = $name;
          
        }
        $user = User::create($input);
        $info = new UserInfo();
        $info->address =$request->address;
        $info->district_code =$request->district_code;
        $info->province_code =$request->province_code;
        $info->user_id =$user->id;
        $info->save();
    
        $email = $user->email;
        Mail::to($email)->send(new \App\Mail\ConfirmMail($user));
        return redirect()->to('/')->with('success', 'Successful created.Please check your email');
    }

    public function getLoginCode(){

        $code = User::where('login_id', 'LIKE', GenerateCodeNo::getAccountPrefix() . '%')->whereRaw('LENGTH(login_id) = 7')->orderBy('login_id', 'desc')->select('login_id')->first();
        $login_code = GenerateCodeNo::LoginCode($code['login_id']);
        return $login_code;
    }

    public function ChangePassword()
    {
        return view('customer.change-password');
    }
    
    public function savePassword(Request $request)
    {
       $request->validate([
           'password' => ['required', new MatchOldPassword],
           'new_password' => ['required'],
           'new_confirm_password' => ['same:new_password'],
       ]);
  
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return back()->with('success', 'Change password successfully.');
   }
}
