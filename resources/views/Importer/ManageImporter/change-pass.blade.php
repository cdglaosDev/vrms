@extends('layouts.master')
@section('user','active')

@section('content')
@php
$dis =\App\Model\District::pluck('id','name');
$pro =\App\Model\Province::pluck('id','name');
@endphp
<h1 class="page-header">{{trans('title.change_pass')}}</h1>
<div class="panel panel-inverse">
@include('flash')
<div class="panel-body">
      <div class="card-body">
                      <form method="POST" action="{{ url('change-password')}}">
        
        @csrf

        <div class="form-group">
             <label for="validationCustom01">Current Password:</label>
                                                      <input id="password" type="password" class="form-control" name="password" autocomplete="current-password" placeholder="Enter Current Password">
        </div>

        <div class="form-group">
           <label for="validationCustom01">New Password:</label>
                                                     <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password" placeholder="Enter New Password">
        </div>
        <div class="form-group">
            <label for="validationCustom01">New Confirm Password:</label>
                                                      <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password" placeholder="Enter New Confirmation Password">
        </div>

        <div class="form-actions">
            <div id="working"></div>
            <button class="btn btn-info " id="login-form-submit">{{trans('button.update')}}</button>
        </div>

    </form>
                </div>                   
</div>
</div>
                    


@endsection
@push('page_scripts')
<script type="text/javascript">
    $('.file-upload').file_upload();
</script>
@endpush