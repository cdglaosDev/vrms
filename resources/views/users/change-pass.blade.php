@extends('vrms2.layouts.master')
@section('user','active')
@section('content')
<style>
   .field-icon {
   float: right;
   margin-left: -25px;
   margin-top: -25px;
   position: relative;
   z-index: 2;
   margin-right: 10px;
   }
</style>
<h3>{{trans('title.change_pass')}}</h3>
   @include('flash')
   <div class="card-body">
       <div class="col-md-5">
        <form method="POST" action="{{ url('/change-password')}}">
            @csrf
            <div class="form-group mb-2">
                <label for="current-password">{{ trans('common.current_password') }}:</label>
                <input id="current-password" type="password" class="form-control" name="password" autocomplete="current-password" placeholder="Enter Current Password" required>
                <span toggle="#current-password" class="fa fa-eye field-icon current-password"></span>
            </div>
            <div class="form-group mb-2">
                <label for="new_password">{{ trans('common.new_password') }}:</label>
                <input id="password-field" type="password" class="form-control" name="new_password" autocomplete="current-password" placeholder="Enter New Password" required>
                <span toggle="#password-field" class="fa fa-eye field-icon password"></span>
            </div>
            <div class="form-group mb-2">
                <label for="new_confirm_password">{{ trans('common.confirm_password') }}:</label>
                <input id="password-field1" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password" placeholder="Enter New Confirmation Password" required>
                <span toggle="#password-field1" class="fa fa-eye field-icon confirm-password"></span>
            </div>
            <div class="form-actions">
                <div id="working"></div>
                <button class="btn btn-info " id="login-form-submit">{{trans('button.update')}}</button>
            </div>
        </form>
        </div>
   </div>

@endsection
@push('page_scripts')
<script type="text/javascript" src="{{asset('vrms2/js/visible-password.js')}}"></script>
@endpush