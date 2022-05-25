@extends('layouts.master')
@section('user','active')
@section('title','Create New User')
@section('content')
@php
$dis =\App\Model\District::pluck('id','name');
$pro =\App\Model\Province::pluck('id','name');
$depart = \App\Model\Department::get();
@endphp
    <h1 class="page-header">{{trans('title.user_edit')}}</h1>
    <div class="panel panel-inverse">
    @include('flash')
    <div class="panel-body">


    {!! Form::model($user, ['method' => 'PATCH','enctype'=>'multipart/form-data','route' => ['users.update', $user->id]]) !!}

    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
                  <label for="exampleInputEmail1">First Name</label>
                {!! Form::text('first_name', null, array('placeholder' => 'First Name','class' => 'form-control')) !!}
            </div>
        </div>
         <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
                  <label for="exampleInputEmail1">Last Name</label>
                {!! Form::text('last_name', null, array('placeholder' => 'Last Name','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Birthdate</label>
                {!! Form::text('birthdate', null, array('placeholder' => 'Enter Birthdate','class' => 'date form-control')) !!}
            </div>
        </div>
      
        <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Phone Number</label>
                {!! Form::text('phone', null, array('placeholder' => 'Phone Number','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Department</label>
               <select name="department_id" class="form-control select2-hidden-accessible">
                  <option value="" selected disabled >-- Select Department-- </option>
                  @foreach($depart as $data)
                  
                    <option value="{{ $data->id }}" class="style1" {{ $user->department_id == $data->id ? 'selected' : '' }}>{{ $data->name }} ({{$data->name_en}})</option>
                @endforeach
                           </select> 
            </div>
        </div>

                         <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Address :</label>
                                         <textarea name="address" class="form-control" placeholder="Enter Address">@if(isset($user->user_info->address)){{$user->user_info->address}}@endif</textarea>
                                    </div>
                                </div>  
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Province:</label>
                                          <select name="province_id" class="form-control select2-hidden-accessible" id="state">
                                             <option value="" selected disabled >-- Select Province-- </option>
                                        @foreach($pro as $key => $value)
                   
                                            <option value="{{ $value }}" class="style1" @if(isset($user->user_info->province_id)){{ $user->user_info->province_id == $value ? 'selected' : '' }} @endif>{{ $key }}</option>
                                        @endforeach
                                      </select> 
                                    </div>
                                </div>
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">District:</label>
                                           <select name="district_id" class="form-control select2-hidden-accessible" id="state">
                                             <option value="" selected disabled >-- Select District-- </option>
                              @foreach($dis as $key => $value)
                    

                     <option value="{{ $value }}"  @if(isset($user->user_info->district_id)) 
                                            @if($user->user_info->district_id== $value)
                                                selected="selected"
                                            @endif
                                         @endif >{{ $key }}</option>
                    
                @endforeach
                           </select>
                                    </div>
                                </div>
                               
                               
                               
                      
        <div class="col-xs-12 col-sm-3 col-md-3">
            <div class="form-group">
                <label for="exampleInputEmail1">Position</label>
                {!! Form::text('position', null, array('placeholder' => 'Enter Position','class' => 'form-control')) !!}
            </div>
        </div>
         <div class="col-xs-12 col-sm-2 col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">User Type</label><br/>

                <select class="form-control" name="user_type">
                          <option value="" selected disabled>Select User Type</option>
                            @foreach($user::getEnumList("user_type") as $key => $value)
                                <option value="{{$key}}" {{$key==$user->user_type?"selected":""}}>{{$value}}</option>
                            @endforeach
                </select>
                                   
            </div>
        </div>
         <div class="col-xs-12 col-sm-3 col-md-3">
            <div class="form-group">
                <label for="exampleInputEmail1">Gender</label><br/>

              <span class="gender">Male</span> <input type="radio" name="gender" value="male"  {{ $user->gender == 'male' ? 'checked' : '' }}>
              <span class="gender">Female</span> <input type="radio" name="gender" value="male"  {{ $user->gender == 'female' ? 'checked' : '' }}>
                                   
            </div>
        </div>
       
         <div class="col-xs-12 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">User Photo:</label>
                                             <div class="fileinput fileinput-new" data-provides="fileinput">

                                <div class="fileinput-new thumbnail" style="height: 100;">
                                   
                                   <img class="abir_image" @if($user->user_photo) src="{{asset('images/user/'.$user->user_photo)}}" @else src="{{asset('images/default.png')}}" @endif alt="logo" / width="100"> </div>

                                   <div class="fileinput-preview fileinput-exists thumbnail" style="max-height: 150px;"> </div>

                                    <div>

                                        <span class="btn btn-success btn-file">

                                                    <span class="fileinput-new"> Select File </span>

                                                    <span class="fileinput-exists"> Change </span>

                                                    <input type="file" name="image" value="user-default.png">
                                                 </span>

                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>

                                        </div>

                                    </div>
    </div>
                                        </div>
       
        
         <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Role</label>
                {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
            </div>
        </div>

     <div class="col-xs-12 col-sm-12 col-md-12">
                                     <a class="btn  btn-default" href="{{route('users.index')}}">{{trans('button.cancel')}}</a>
                                        <button type="submit" class="btn btn-sm btn-primary m-r-5">{{trans('button.update')}}</button>
                                      
                                        </div>
    </div>
    {!! Form::close() !!}
    </div>
    </div>

    @endsection
