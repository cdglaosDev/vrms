@php
$districts = \App\Model\District::whereStatus(1)->whereProvinceCode($user->user_info->province_code)->get();
$provinces = \App\Model\Province::whereStatus(1)->get();
@endphp
<style>
   #editModal input{
   height: 12px;
   }
</style>
<div class="modal-header" style="border-bottom:none; padding:1.15rem 1rem">
   <h3 >Update Profile</h3>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
</div>
<div class="modal-body pt-0">
   <form  action="{{route('updateProfile')}}"  method="POST" enctype="multipart/form-data">
      @method('Post')
      @csrf
      <div class="row pb-3">
         <div class="col-md-4">
            <label>{{trans('user.first_name')}}:</label>
            <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}" placeholder="Enter First Name" required>
         </div>
         <div class="col-md-4">
            <label>{{trans('user.last_name')}}:</label>
            <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}" placeholder="Enter Last Name" required>
         </div>
         <div class="col-md-4">
            <label>{{trans('user.email')}}:</label>
            <input type="email" class="form-control" name="email" value="{{$user->email}}" placeholder="Enter Email" required>
         </div>
      </div>
      <div class="row pb-3">
         <div class="col-md-3">
            <label>{{trans('user.dob')}}:</label>
            <input type="text" class="form-control" id="datetime" name="birthdate" value="{{$user->birthdate}}" required>
         </div>
         <div class="col-md-3">
            <label>{{trans('user.phone')}}:</label>
            <input type="text" class="form-control" name="phone" value="{{$user->phone}}" placeholder="Enter Phone" title="Please Enter at least 8 digits" pattern="[0-9]{8,}" required>
         </div>
         <div class="col-md-3">
            <label>{{ trans('register.province')}}:</label>
            <select name="province_code" class="js-example-basic-single form-control" id="province" required>
               <option value=""  disabled >-- Select Province--</option>
               @foreach($provinces as $key => $value)
               <option value="{{ $value->province_code }}" class="style1" {{ $value->province_code == $value ? 'selected' : '' }} >{{ $value['name'] }}<span>({{$value['name_en']}})</span></option>
               @endforeach
            </select>
         </div>
         <div class="col-md-3">
            <label>{{trans('user.district')}}:</label>
            <select class="js-example-basic-single form-control" name="district_code"  id="district" required>
               <option value="" disabled>--Select District--</option>
               @foreach($districts as $dist)
               <option value="{{$dist->district_code}}" {{$dist->district_code==$user_info->district_code?"selected":""}}>{{ $dist->name }}&nbsp;({{$dist->name_en}})</option>
               @endforeach
            </select>
         </div>
      </div>
      <div class="row pb-3">
         <div class="col-md-4">
            <label>{{trans('user.address')}}:</label>
            <textarea name="address" class="form-control" placeholder="Enter Address" required>@if(isset($user->user_info->address)){{$user->user_info->address}}@endif</textarea>
         </div>
         <div class="col-md-4">
            <label>{{trans('user.gender')}}:</label><br>
            <div class="form-check-inline">
               <label class="form-check-label">
               <input type="radio" name="gender" class="form-check-input" value="male"  {{ $user->gender == 'male' ? 'checked' : '' }} required>Male
               </label>
            </div>
            <div class="form-check-inline">
               <label class="form-check-label">
               <input type="radio" name="gender" class="form-check-input" value="female"  {{ $user->gender == 'female' ? 'checked' : '' }}>Female
               </label>
            </div>
         </div>
         <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
               <label for="exampleInputPassword1">User Photo:</label><br>
               <div class="fileinput fileinput-new" data-provides="fileinput">
                  <div class="fileinput-new thumbnail" style="height: 100;">
                     <img class="abir_image" @if($user->user_photo) src="{{asset('images/customer/'.$user->user_photo)}}" @else src="{{asset('images/default.png')}}" @endif alt="logo" / width="100"> 
                  </div>
                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-height: 150px;"> </div>
                  <div>
                     <span class="btn btn-success btn-sm btn-file">
                     <span class="fileinput-new"> Select File </span>
                     <span class="fileinput-exists"> Change </span>
                     <input type="file" name="image" value="user-default.png" accept=".png,.jpg,.jpeg">
                     </span>
                     <a href="javascript:;" class="btn btn-danger btn-sm red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12 text-right">
            <a class="btn btn-secondary btn-sm" href="{{route('profile')}}">{{trans('button.cancel')}}</a>
            <button type="submit" class="btn btn-success btn-sm m-r-5">{{trans('button.update')}}</button>
         </div>
      </div>
   </form>
</div>