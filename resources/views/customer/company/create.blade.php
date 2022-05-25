@extends('customer.layouts.master')
@section('company','active')
@section('content') 
@php
$country = \App\Model\Country::whereStatus(1)->get();
@endphp
    <h1 class="page-header">{{trans('customer.company_create')}}</h1>
    <div class="panel panel-inverse">
     
    <div class="panel-body">
        <form  action="{{route('company.store')}}"  method="POST">
                 
                      @csrf
          
            <div class="form-row">
              
              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">{{trans('customer.com_name')}}(Lao):</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Company Name" name="name" required="">
              </div>
               <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">{{trans('customer.com_name')}}(Eng):</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Company Name" name="name_en" required="">
              </div>
              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">{{trans('customer.com_email')}}:</label>
                <input type="email" class="form-control" id="validationCustom01" value="" placeholder="Enter Company Email" name="email" required="">
              </div>
              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">{{trans('customer.com_phone')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Company Phone" name="phone" required="">
              </div>
                <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">{{trans('customer.owner_name')}}(Lao):</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Owner Name" name="contact_name" required="">
              </div>
              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">{{trans('customer.owner_name')}} (Eng):</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Owner Name" name="contact_name_en" required="">
              </div>
              <div class="col-md-3 col-sm-3 mb-3">
                <label for="validationCustom01">{{trans('customer.owner_phone')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Owner Phone" name="contact_phone" required="">
              </div>
              <div class="col-md-3 col-sm-3 mb-3">
                <label for="validationCustom01">{{trans('customer.fax')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Fax" name="fax" required="">
              </div>
              <div class="col-md-3 col-sm-3 mb-3">
                <label for="validationCustom01">{{trans('customer.tax_number')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Tax Number" name="tax_number" required="">
              </div>
               <div class="col-md-3 col-sm-3 mb-3">
                <label for="validationCustom01">{{trans('customer.country')}}:</label>
                  <select name="country_id" class="form-control selectpicker" data-live-search="true" required="">
                  <option value="" selected disabled hidden>Select Country </option>
                  @foreach($country as $data)
                  <option value="{{$data->id}}">{{$data->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-12 col-sm-12 mb-3">
                <label for="validationCustom01">{{trans('user.address')}}:</label>
                <textarea class="form-control" id="validationCustom01" value="" placeholder="Enter Address" name="address">
                  
                </textarea>
               
              </div>
                 
            </div>
            <div class="col-md-12 col-sm-12 text-right">
             <a class="btn  btn-secondary" href="{{route('company.index')}}">{{trans('button.cancel')}}</a>
             <button type="submit" class="btn btn-success">{{trans('button.save')}}</button>
            </div>
          
          </div>
        </form>
        
        </div>
      </div>



@endsection 

