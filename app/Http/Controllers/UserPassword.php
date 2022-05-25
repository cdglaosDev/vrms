<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\User;
use Mail;
use Auth;
class UserPassword extends Controller
{
    public function resetPasswordForm($email)
    {
        return view('users.forgot-password', compact('email'));
    }

    public function saveResetPassword(Request $request, $email)
    {
            $this->validate($request, [
                'password' => 'required|confirmed'
            ]);
            $user = User::whereEmail($email)->first();
            $user->password = Hash::make($request['password']);
            $user->customer_status = "approve";
            $user->save();
            Auth::login($user);
            if ($user->user_type == 'staff') {
                return redirect('/home')->with('success', "Successful Login!");
            } else {
                return redirect('/customer')->with('success', "Successful Login!");
            }
           
    }
    //email form for forgot password by login page
    public function resetEmailForm()
    {
        return view('password.emailForm');
    }

    //
    public function ToSendResetMail(Request $request)
    {   
        $user = User::whereEmail($request->email)->first();
        if ($user != null) {
        Mail::to($user->email)->send(new \App\Mail\ResetPassMail($user));
        return redirect('/')->with('success', 'Successful Reset Password.Please check you email.');
        } else {
        return back()->with('error', 'Your email was wrong.Please try again.');
        }
        
    }
}
