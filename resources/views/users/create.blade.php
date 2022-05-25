@extends('vrms2.layouts.master')
@section('staff', 'active')
@section('content')
@include('vrms2.mod1-submenu')
@php 
$dis =\App\Model\District::whereStatus(1)->pluck('district_code','name'); 
$pro =\App\Model\Province::whereStatus(1)->pluck('province_code','name'); 
$depart = \App\Model\Department::whereStatus(1)->get(); 
$counters = \App\Model\ServiceCounter::whereStatus(1)->get(); 
@endphp 
<style>
   .datepicker.dropdown-menu {
   top: 305.6251px !important
   }
</style>
<h3>{{trans('user.create_staff')}}</h3>
@include('flash')
<div class="card-body pb-1">
   <form id="staff-user" action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
      @csrf 
      <div class="modal-body">
         <div class="row mb-3">
            <div class="col-md-2">
               <div class="form-group">
                  <label for="exampleInputEmail1">{{trans('user.first_name')}}</label>
                  <input id="name" type="text" class="form-control  @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required placeholder="Enter First Name"> @error('name') <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span> @enderror
               </div>
            </div>
            <div class="col-md-2">
               <div class="form-group">
                  <label for="exampleInputEmail1">{{trans('user.last_name')}}</label>
                  <input type="text" name="last_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Last Name" required>
               </div>
            </div>
            <div class="col-md-2">
               <div class="form-group">
                  <label for="exampleInputEmail1">{{trans('user.email')}}</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Email" required=""> @error('email') <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span> @enderror
               </div>
            </div>
            <div class="col-md-2">
               <div class="form-group">
                  <label for="exampleInputEmail1">{{trans('user.user_level')}}</label>
                  <select name="user_level" id="" class="form-control" required>
                     <option value="admin">Admin</option>
                     <option value="province">Province</option>
                  </select>
               </div>
            </div>
            <div class="col-md-2">
               <div class="form-group">
                  <label for="exampleInputEmail1">{{trans('user.user_status')}}</label>
                  <select name="user_status" id="" class="form-control" required>
                     <option value="" selected disabled>Select User Status</option>
                     @foreach(\App\User::getEnumList("user_status") as $key => $value) 
                     <option value="{{$key}}">{{$value}}</option>
                     @endforeach
                  </select>
               </div>
            </div>
            <div class="col-md-2">
               <div class="form-group">
                  <label for="exampleInputEmail1">{{trans('user.user_group')}}</label>
                  <select name="user_group" id="" class="form-control" required>
                     <option value="" selected disabled>Select User Group</option>
                     @foreach(\App\User::getEnumList("user_group") as $key => $value) 
                     <option value="{{$key}}">{{$value}}</option>
                     @endforeach
                  </select>
               </div>
            </div>
         </div>
         <div class="row mb-3">
            <div class="col-md-3">
               <div class="form-group">
                  <label for="validationCustom01">{{trans('user.dob')}}</label>
                  <input type="text" id="date" class="form-control" name="birthdate" required>
                  </span>
               </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
                  <label for="exampleInputPassword1">{{trans('user.phone')}}</label>
                  <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number" title="Please Enter at least 8 digits" pattern="[0-9]{8,}" required>
               </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
                  <label for="exampleInputPassword1">{{trans('user.position')}}</label>
                  <input type="text" name="position" class="form-control" placeholder="Enter Position" required>
               </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
                  <label for="exampleInputPassword1">{{trans('user.dept')}}</label>
                  <select name="department_id" class="js-example-basic-single form-control" style="width:100%;" id="state" required>
                     <option value="" selected disabled hidden>-- Select Department-- </option>
                     @foreach($depart as $data) 
                     <option value="{{ $data->id }}" class="style1">{{ $data->name }} ({{$data->name_en}})</option>
                     @endforeach
                  </select>
               </div>
            </div>
         </div>
         <div class="row mb-3">
            <div class="col-md-2">
               <div class="form-group">
                  <label for="exampleInputPassword1">{{trans('user.province')}}</label>
                  <select name="province_code" class="js-example-basic-single form-control" style="width:100%;" id="province" required>
                     <option value="" selected disabled hidden>-- Select Province-- </option>
                     @foreach($pro as $key => $value) 
                     <option value="{{ $value }}" class="style1">{{ $key }}</option>
                     @endforeach
                  </select>
               </div>
               <input type="hidden" name="user_type" class="form-control" value="staff" readonly>
            </div>
            <div class="col-md-2 col-sm-2">
               <div class="form-group">
                  <label for="exampleInputPassword1">{{trans('user.role')}}:</label>
                   {!! Form::select('roles[]', $roles,[], array('class' => 'form-control multiselect','multiple','required'=>'required')) !!}
               </div>
            </div>
            <div class="col-md-2 col-sm-2">
               <div class="form-group">
                  <label for="exampleInputPassword1">{{trans('table.status')}}:</label>
                  <select name="customer_status" class="form-control" required>
                     <option value="" selected disabled>Select Status </option>
                     @foreach(\App\User::getEnumList("customer_status") as $key => $value) 
                     <option value="{{$key}}">{{$value}}</option>
                     @endforeach
                  </select>
               </div>
            </div>
            <div class="col-md-3 col-sm-3">
               <div class="form-group">
                  <label for="exampleInputPassword1">{{trans('user.gender')}}</label>
                  <br />
                  <input type="radio" name="gender" value="male" required>
                  <span class="gender">Male</span>
                  <input type="radio" name="gender" value="female">
                  <span class="gender">Female</span>
               </div>
            </div>
            <div class="col-md-3 col-sm-3">
               <div class="form-group">
                  <label>{{ trans('users.user_photo')}}</label>
                  <input type="file" name="image" class=" form-control file-upload-default"> @include('image_upload')
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="form-group">
                  <label for="exampleInputPassword1">{{trans('user.address')}} :</label>
                  <textarea name="address" class="form-control" rows="4" placeholder="Enter Address" required></textarea>
               </div>
            </div>
         </div>
         <div class="form-group text-right mt-4">
            <a class="btn  btn-secondary btn-sm" href="{{route('users.index')}}">{{trans('button.cancel')}}</a>&nbsp; 
            <button type="submit" class="btn  btn-success btn-sm m-r-5">{{trans('button.save')}}</button>
         </div>
      </div>
   </form>
</div>
@endsection