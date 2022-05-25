@extends('layouts.master') 
@section('vims','active') 
@section('content') 
<h1 class="page-header">{{trans('gas_standard_check.create_gas')}}</h1>
<div class="panel panel-inverse">
   @include('flash') 
   <div class="body">
    <form action="\gas" method="POST"> 
      @method('post') 
      @csrf 
      <div class="modal-body">
        <div class="form-row">
          <div class="col-md-12 mb-3">
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('gas_standard_check.gas_name_lao')}}:</label>
              <input type="text" class="form-control" id="validationCustom01" value="{{old('name')}}" placeholder="{{trans('gas_standard_check.enter_gas_name_lao')}}" name="name" required="">
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('gas_standard_check.gas_name_en')}}:</label>
              <input type="text" class="form-control" id="validationCustom01" value="{{old('name_en')}}" placeholder="{{trans('gas_standard_check.enter_gas_name_en')}}" name="name_en" required="">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a href="/gas" class="btn btn-secondary">{{trans('button.cancel')}}</a>
          <input type="submit" class="btn btn-success " value="{{trans('button.save')}}">
        </div>
      </div>
    </form>
  </div>
</div> 
@endsection