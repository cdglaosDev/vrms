@extends('layouts.master') 
@section('vims','active') 
@section('content') 
<h1 class="page-header">{{trans('gas_standard_check.update_st')}}</h1>
<div class="panel panel-inverse"> 
  @include('flash') 
  <div class="body">
    <form action="{{route('standard.update',['standard'=> $standard])}}" method="POST"> 
      @method('PATCH') 
      @csrf 
      <div class="modal-body">
        <div class="form-row">
          <div class="col-md-12 mb-3">
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('gas_standard_check.standard_name_lao')}}:</label>
              <input type="text" class="form-control" id="validationCustom01" value="{{old('name')??$standard -> name}}" placeholder="" name="name" required="">
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('gas_standard_check.standard_name_en')}}:</label>
              <input type="text" class="form-control" id="validationCustom01" value="{{old('name_en')??$standard -> name_en}}" placeholder="" name="name_en" required="">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a href="/standard" class="btn btn-secondary">{{ trans('button.cancel') }}</a>
          <input type="submit" class="btn btn-success " value="{{trans('button.update')}}">
        </div>
      </div>
    </form>
  </div>
</div> 
@endsection