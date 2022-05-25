@php
$dis =\App\Model\District::whereStatus(1)->pluck('district_code','name');
$pro =\App\Model\Province::whereStatus(1)->pluck('province_code','name');
$depart = \App\Model\Department::whereStatus(1)->get();
$counters = \App\Model\ServiceCounter::whereStatus(1)->get();
@endphp

<div class="modal-header">
<h3>{{trans('title.user_edit')}}</h3>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
</div>
<div class="modal-body">
<div class="card-body">
      {!! Form::model($user, ['method' => 'PATCH','enctype'=>'multipart/form-data','id' => 'edit-staff-user','route' => ['users.update', $user->id]]) !!}
      <div class="row mb-3">
         <div class="col-xs-12 col-sm-2 col-md-2">
            <div class="form-group">
               <label for="exampleInputEmail1">{{trans('user.first_name')}}:</label>
               {!! Form::text('first_name', null, array('placeholder' => 'First Name','class' => 'form-control first_name','required' => 'required')) !!}
            </div>
         </div>
         <div class="col-xs-12 col-sm-2 col-md-2">
            <div class="form-group">
               <label for="exampleInputEmail1">{{trans('user.last_name')}}:</label>
               {!! Form::text('last_name', null, array('placeholder' => 'Last Name','class' => 'form-control last_name','required' => 'required')) !!}
            </div>
         </div>
         <div class="col-xs-12 col-sm-2 col-md-">
            <div class="form-group">
               <label for="exampleInputEmail1">{{trans('user.email')}}:</label>
               {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control email')) !!}
            </div>
            <input type="hidden" value="{{ $user->email }}" class="old-email">
         </div>
         <div class="col-md-3">
            <div class="form-group">
               <label for="facebook">Facebook:</label>
               <input  type="text" class="form-control" name="facebook" value="{{ $user->facebook }}" placeholder="Enter Facebook Link" >
            </div>
         </div>
         <div class="col-md-3">
            <div class="form-group">
               <label for="whatApps">whatApps:</label>
               <input  type="text" class="form-control" name="whatapps" value="{{ $user->whatapps }}" placeholder="Enter whatApps Link" >
            </div>
         </div>
      </div>
      <div class="row mb-3">
      <div class="col-xs-12 col-sm-3 col-md-3">
            <div class="form-group">
               <label for="exampleInputEmail1">{{trans('user.user_level')}}:</label>
               <select name="user_level" id="" class="form-control user-level" required {{auth()->user()->user_level =="province" ?'disabled':''}}>
                  <option value="admin" {{$user->user_level == "admin"?'selected':''}} >Admin</option>
                  <option value="province" {{$user->user_level == "province"?'selected':''}}>Province</option>
               </select>
            </div>
         </div>
         <div class="col-xs-12 col-sm-3 col-md-3">
            <div class="form-group">
               <label for="exampleInputEmail1">{{trans('user.user_status')}}:</label>
               <select name="user_status" id="" class="form-control user-status" required>
                  <option value="" disabled >Select user status</option>
                  @foreach(\App\User::getEnumList("user_status") as $key => $value)
                     <option value="{{$key}}" {{$user->user_status == $key?'selected':''}}>{{$value}}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-xs-12 col-sm-3 col-md-3">
            <div class="form-group">
                  <label for="exampleInputPassword1">{{trans('user.user_group')}}:</label>
                  <select name="user_group" class="form-control user-group" required {{ auth()->user()->user_level =="province"?'disabled':''}}>
                     <option value="" selected disabled >Select User Group </option>
                     @foreach(\App\User::getEnumList("user_group") as $key => $value)
                        <option value="{{$key}}" {{ $user->user_group == $key ?'selected':''}} >{{$value}}</option>
                     @endforeach
                  </select>
            </div>
         </div>
      </div>
      <div class="row mb-3">
         <div class="col-xs-12 col-sm-3 col-md-3">
            <div class="form-group">
               <label for="exampleInputEmail1">{{trans('user.dob')}}:</label>
              
                  <input type="text" class="form-control custom_date" maxlength="10" name="birthdate" value="{{$user->birthdate}}" required>
               
            </div>
         </div>
         <div class="col-xs-12 col-sm-3 col-md-3">
            <div class="form-group">
               <label for="exampleInputEmail1">{{trans('user.phone')}}:</label>
               <input type="number" name="phone" class="form-control phone" placeholder="Phone Number" value="{{$user->phone}}" title="Please Enter at least 8 digits" pattern="[0-9]{8,}" required>
            </div>
         </div>
         <div class="col-xs-12 col-sm-3 col-md-3">
            <div class="form-group">
               <label for="exampleInputEmail1">{{trans('user.position')}}:</label>
               {!! Form::text('position', null, array('placeholder' => 'Enter Position','class' => 'form-control position','required' => 'required')) !!}
            </div>
         </div>
         <div class="col-xs-12 col-sm-3 col-md-3">
            <div class="form-group">
               <label for="exampleInputEmail1">{{trans('user.dept')}}:</label>
               <select name="department_id" class="js-example-basic-single form-control department" style="width:100%;">
                  <option value="" selected disabled >-- Select Department-- </option>
                  @foreach($depart as $data)
                  <option value="{{ $data->id }}" class="style1" {{ $user->department_id == $data->id ? 'selected' : '' }}>{{ $data->name }} ({{$data->name_en}})</option>
                  @endforeach
               </select>
            </div>
         </div>
      </div>
      <div class="row mb-3">
         <div class="col-md-2 col-sm-2">
            <div class="form-group">
               <label for="exampleInputPassword1">{{trans('user.province')}}::</label>
               <select name="province_code" class="js-example-basic-single form-control province_code" style="width:100%;"  id="province" >
                  <option value=""  disabled >-- Select Province-- </option>
                  @foreach($pro as $key => $value)
                  <option value="{{ $value }}" class="style1" {{auth()->user()->user_level =="province" ?'hidden':''}} {{ $user->user_info->province_code == $value ? 'selected' : '' }} >{{ $key }}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group userRole">
               <label for="exampleInputEmail1">{{trans('user.role')}}:</label>
               {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control multiselect','id'=>'role','multiple','id'=>"multipleRole")) !!}
            </div>
         </div>
         <div class="col-md-2 col-sm-2">
            <div class="form-group">
                  <label for="exampleInputPassword1">{{trans('table.status')}}:</label>
                  <select name="customer_status" class="form-control customer-status" required>
                     <option value="" selected disabled >Select Status </option>
                     @foreach(\App\User::getEnumList("customer_status") as $key => $value)
                        <option value="{{$key}}" {{ $user->customer_status == $key ?'selected':''}}>{{$value}}</option>
                     @endforeach
                  </select>
            </div>
         </div>
        
         <input type="hidden" name="user_type" class="form-control" value="staff" readonly>
         <div class="col-xs-12 col-sm-2 col-md-2">
            <div class="form-group">
               <label for="exampleInputEmail1">{{trans('user.gender')}}:</label><br/>
               <input type="radio" name="gender" value="male"  {{ $user->gender == 'male' ? 'checked' : '' }}> <span class="gender">Male</span>
               <input type="radio" name="gender" value="female"  {{ $user->gender == 'female' ? 'checked' : '' }}> <span class="gender">Female</span>
            </div>
         </div>
         <div class="col-xs-12 col-sm-2 col-md-2">
            <div class="form-group">
               <label for="exampleInputPassword1">{{trans('user.user_photo')}}:</label>
               <div class="fileinput fileinput-new" data-provides="fileinput">
                  <div class="fileinput-new thumbnail" style="height: 100;">
                     <img class="abir_image" @if($user->user_photo) src="{{asset('images/user/'.$user->user_photo)}}" @else src="{{asset('images/default.png')}}" @endif alt="logo" / width="100"> 
                  </div>
                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-height: 150px;"> </div>
                  <div>
                     <span class="btn btn-success btn-file">
                     <span class="fileinput-new"> Select File </span>
                     <span class="fileinput-exists"> Change </span>
                     <input type="file" id="edit-image" name="image" value="user-default.png">
                     </span>
                    
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-3 col-sm-3">
               <div class="form-group">
                  <label>User Id</label>
                  <input type="text"  name="login_id"  value="{{ $user->login_id }}" class="form-control eng-validate login_id" placeholder="Choose UserId">
                  <input type="hidden" id="old-loginId" value="{{ $user->login_id }}">
               </div>
            </div>
            <div class="col-md-3 col-sm-3">
               <div class="form-group">
                  <label>New Password</label>
                  <input id="password-field2" type="password" placeholder="Enter New Password" class="form-control password" name="password" value="">
                  <span toggle="#password-field2" class="fa fa-eye field-icon password"></span>
               </div>
            </div>
            <div class="col-md-3 col-sm-3">
               <div class="form-group">
                  <label>Confirm Password</label>
                  <input id="password-field3" type="password" class="form-control password-confirm" name="password_confirmation" placeholder="Enter Confrim password"  autocomplete="new-password">
                  <span toggle="#password-field3" class="fa fa-eye field-icon confirm-password"></span>
               </div>
            </div>
         </div>
      <div class="row">
         <div class="col-md-12 col-sm-12">
            <div class="form-group">
               <label for="exampleInputPassword1">{{trans('user.address')}} :</label>
               <textarea name="address" class="form-control address" rows="2" placeholder="Enter Address" required>@if(isset($user->user_info->address)){{$user->user_info->address}}@endif</textarea>
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12 text-right mt-2">
            <a class="btn  btn-secondary btn-sm" href="{{route('users.index')}}">{{trans('button.cancel')}}</a>
            <a  class="btn  btn-success btn-sm m-r-5 edit-user">{{trans('button.update')}}</a>
         </div>
      </div>
      {!! Form::close() !!}
   </div>
</div>
<script src="{{ asset('vrms2/js/jquery.multiselect.js') }}"></script>
<script src="{{ asset('vrms2/js/match-password.js') }}"></script>
<script src="{{asset('vrms2/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('vrms2/js/vehicle-datepicker.js') }}"></script>
<script>
    $('#multipleRole').multiselect({
    columns: 1,
    placeholder: 'Select Roles',
    search: true
});
</script>