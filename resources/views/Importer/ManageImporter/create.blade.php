@extends('layouts.master')
@section('importer','active')
@section('title','Create New Importer')
@section('content')
@php
$dis =\App\Model\District::pluck('id','name');
$pro =\App\Model\Province::pluck('id','name');
$depart = \App\Model\Department::get();
@endphp
<h1 class="page-header">{{trans('title.user_create')}}</h1>
<div class="panel panel-inverse">
@include('flash')
<div class="panel-body">
    <form action="{{route('importer.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">First Name</label>
                        <input id="name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required  placeholder="Enter First Name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Last Name</label>
                        <input id="name" type="text" class="form-control" @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required placeholder="Enter Last Name" />
                    </div>
                </div>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                                 
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">          
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>           
                <div class="col-md-4">                                     
                    <div class="form-group">
                        <label for="exampleInputPassword1">Confirm Password</label>
                        {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Birthdate:</label>
                        <input type="date" name="birthdate" class="form-control" placeholder="Enter Birthdate">    
                    </div>
                </div>                   
            </div>

            <div class="row"> 
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Phone Number:</label>
                        <input type="number" name="phone" class="form-control" placeholder="Enter Phone Number">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Department:</label>
                        <select name="department_id" class="form-control select2-hidden-accessible" id="state">
                            @foreach($depart as $data)
                                <option value="" selected disabled hidden>-- Select Department-- </option>
                                <option value="{{ $data->id }}" class="style1">{{ $data->name }} ({{$data->name_en}})</option>
                            @endforeach
                        </select>                                          
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Position:</label>
                        <input type="text" name="position" class="form-control" placeholder="Enter Position">
                    </div>
                </div>       
            </div>
                         {{-- <div class="row"> 
                         <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Address :</label>
                                         <textarea name="address" class="form-control" placeholder="Enter Address"></textarea>
                                    </div>
                                </div>  
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Province:</label>
                                          <select name="province_id" class="form-control select2-hidden-accessible" id="state">
                              @foreach($pro as $key => $value)
                    <option value="" selected disabled hidden>-- Select Province-- </option>
                    <option value="{{ $value }}" class="style1">{{ $key }}</option>
                @endforeach
                           </select> 
                                    </div>
                                </div>
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">District:</label>
                                           <select name="district_id" class="form-control select2-hidden-accessible" id="state">
                              @foreach($dis as $key => $value)
                    <option value="" selected disabled hidden>-- Select District-- </option>
                    <option value="{{ $value }}" class="style1">{{ $key }}</option>
                @endforeach
                           </select>
                                    </div>
                                </div>
                               
                               
                               
                        </div> --}}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Role:</label>
                        {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">User Type</label><br/>
                        <select class="form-control" name="user_type">
                            <option value="" selected disabled hidden>Select User Type</option>
                                @foreach(\App\User::getEnumList("user_type") as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Gender:</label><br/>
                           <span class="gender">Male</span> <input type="radio" name="gender"  value="male">Male
                           <span class="gender">Female</span> <input type="radio" name="gender" value="female">Female
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">User Photo:</label>
                            @include('image_upload')
                    </div>
                </div>
            </div>

            <div class="form-group">
                <a class="btn  btn-default" href="{{route('importer.index')}}">{{trans('button.cancel')}}</a>
                    <button type="submit" class="btn btn-sm btn-primary m-r-5">{{trans('button.save')}}</button>
            </div>

    </form>
</div>
</div>

                    


@endsection
@push('page_scripts')
<script type="text/javascript">
    $('.file-upload').file_upload();
</script>
@endpush