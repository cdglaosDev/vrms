<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\DateHelper;
use App\Model\UserInfo;
use DB;
class AccountSetting extends Controller
{
   public function profile(){
        $data = \App\User::where('id',auth()->user()->id)->first();
        
        return view('customer.profile',compact('data'));
   }
   public function editProfile(){
         $user = \App\User::where('id',auth()->user()->id)->first();
         $user_info = UserInfo::where('user_id',auth()->user()->id)->first();
        
        return view('customer.edit-profile',compact('user','user_info'));
   }
   public function updateProfile(Request $request){
      
   	$id = auth()->user()->id;
   		$this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'image' => 'mimes:jpeg,png',
        ]);


        $input = $request->all();
        
        
          if($files=$request->file('image')){
            $name=uniqid().'_'.$files->getClientOriginalName();
           
            $dest =public_path('images/customer');
             
            $files->move($dest,$name);
           $input['user_photo'] =$name;
          
        }
        $input['birthdate']=DateHelper::getMySQLDateTimeFromUIDate($request->birthdate);
        $user = \App\User::find($id);
        DB::table('user_infos')->where('user_id',$id)->update(['address'=>$request->address,'district_code'=>$input['district_code'],'province_code'=>$input['province_code']]);
        $user->update($input);
        return redirect()->route('profile')
                        ->with('success','Profile updated successfully');
   }

   public function changePassword(){
   		return view('customer.change-password');
   }
}
