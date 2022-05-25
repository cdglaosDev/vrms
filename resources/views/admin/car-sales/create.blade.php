@extends('layouts.master') 
@section('user','active') 
@section('title','Create New User') 
@section('content') 
@php 
$dis =\App\Model\District::pluck('id','name');
 $pro =\App\Model\Province::pluck('id','name');
@endphp 
<h1 class="page-header">{{trans('title.user_create')}}</h1>
<div class="panel panel-inverse"> 
  @include('flash') 
  <div class="panel-body">
    <form action="{{route('transfer_vehicle.store')}}" method="POST" enctype="multipart/form-data"> 
    @method('post')
    @csrf 
    <div class="form-body">
        <div class="form-row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-4">
                <label for="validationCustom01">Vehicle Sales Name(Laos):</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{old('name')}}" placeholder="Enter Title_En" name="name" required="">
              </div>
              <div class="col-md-4">
                <label for="validationCustom01">Vehicle Sales Name(English):</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{old('name_sp')}}" placeholder="Enter  Title_sp" name="name_sp" required="">
              </div>
              <div class="col-md-4">
                <label for="validationCustom01">Address:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{old('address')}}" placeholder="Enter  Title_sp" name="address" required="">
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-4">
                <label for="validationCustom01">Phone:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{old('name')}}" placeholder="Enter Title_En" name="phone" required="">
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Email:</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Email"> 
                  @error('email') 
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span> 
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <label for="validationCustom01">Contact:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{old('contact')}}" placeholder="Enter  Title_sp" name="contact" required="">
              </div>
            </div>
          </div> div class="col-md-12"> <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputPassword1">Province:</label>
                <select name="province_id" class="form-control select2-hidden-accessible" id="state">
                  @foreach($province as $key => $value) <option value="" selected disabled hidden>-- Select Province-- </option>
                  <option value="{{ $value }}" class="style1">{{ $key }}</option> 
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputPassword1">District:</label>
                <select name="district_id" class="form-control select2-hidden-accessible" id="state"> 
                  @foreach($district as $key => $value) 
                  <option value="" selected disabled hidden>-- Select District-- </option>
                  <option value="{{ $value }}" class="style1">{{ $key }}</option> 
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputPassword1">Village:</label>
                <select name="village_id" class="form-control select2-hidden-accessible" id="state"> 
                  @foreach($village as $key => $value) 
                  <option value="" selected disabled hidden>-- Select Village-- </option>
                  <option value="{{ $value }}" class="style1">{{ $key }}</option> 
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 mb-3">
          <div class="form-check">
            <input type="hidden" value="" name="">
            <input type="hidden" name="status" value="0">
            <input type="checkbox" class="cr-styled" name="status" value="1">
            <label class="form-check-label" name="status" for="defaultCheck1"> Status </label>
          </div>
        </div>
      </div>
  </div>
  <div class="modal-footer">
    <a href="/inspiration" class="btn btn-primary">{{trans('button.cancel')}}</a>
    <input type="submit" class="btn btn-success " value="{{trans('button.save')}}">
  </div>
</div>
</form>
</div> 
@endsection