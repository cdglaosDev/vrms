@extends('vrms2.layouts.master')
@section('new_register','active') 
@section('content')
@include('module6.mod6-submenu') 
<h3>{{trans('title.search')}}</h3>
@include('flash')
@can('New-Register')
<div class="card-body">
<form action="{{ route('getData') }}" method="POST" class="form-horizontal" id="search" >
   @csrf
   <div class="form-body">
      <div class="form-group row">
         <label class="control-label  col-md-2">Division No :</label>
         <div class="col-md-5">
            <input type="text" id="division_no" name="division_no" value="" placeholder="Enter Dividion No" class="form-control" required> 
         </div>
         <div class="col-md-2">
            <button class="btn btn-primary btn-sm btn-block">{{trans('button.search')}}</button>
         </div>
      </div>
</form>
</div>
@endcan 
@endsection