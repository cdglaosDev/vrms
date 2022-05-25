@extends('layouts.master')
@section('vims','active')
@section('content') 
@php
$app_status = \App\Model\ApplicationStatus::whereStatus(1)->get();
@endphp
    <h1 class="page-header">New Vehicle Registration</h1>
  <div class="panel panel-inverse">
  
    <div class="panel-body">
       <form  action="{{ route("new-register.update", [$app_form->id]) }}"  method="POST">
       @method('PATCH')
               @csrf
         
            <div class="form-row">
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">App Request No:</label>
                    <input type="text" class="form-control"  value="{{$app_form->app_no}}" placeholder="Enter App Request Number" name="app_request_no" required="">
                </div>

                <div class="form-group col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Date Request:</label>
                    <input type="text" class="date form-control" id="validationCustom01" value="{{date('d-m-Y')}}" placeholder="Enter Date Request" name="date_request" required="">
                </div>
               
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01"> Customer Name:</label>
                    <input type="text" class="form-control"  value="{{$app_form->vehicle->owner_name ?? ''}}" placeholder="Enter Customer Name" name="owner_name" readonly="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01"> App Form Status:</label>
                    <select name="app_status_id" id="" class="form-control">
                        @foreach($app_status as $data)
                        <option value="{{$data->id}}">{{$data->name}}({{$data->name_en}})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Application Type:</label>
                    <input type="text" class="form-control"  value="{{ $app_form->app_type->name}}" placeholder="Enter Application Type" name="app_type_id" readonly="">
                </div>
              
              
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Division No:</label>
                    <input type="text" class="form-control"  value="{{$app_form->vehicle->division_no??''}}" placeholder="Enter Division Number" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Province No:</label>
                    <input type="text" class="form-control"  value="{{$app_form->vehicle->province_no ?? ''}}" placeholder="Enter Province Number" name="province_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Vehicle Type:</label>
                    <input type="text" class="form-control"  value="{{$app_form->vehicle->vtype->name ?? ''}}" placeholder="Enter Vehicle Type" name="vehicle_type_id" readonly="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Category Name:</label>
                    <input type="text" class="form-control"  value="{{ $app_form->vehicle->vehicle_category_id ?? ''}}" placeholder="Enter Vehicle Category " name="vehicle_category_id" readonly="">
                </div>

                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Engine Number:</label>
                    <input type="text" class="form-control"  value="{{ $app_form->vehicle->engine_no}}" placeholder="Enter Engine No " name="engine_no" readonly>
                </div>

                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Chassis Number:</label>
                    <input type="text" class="form-control"  value="{{ $app_form->vehicle->chassis_no ?? ''}}" placeholder="Enter Chassis Number " name="chassis_no" readonly="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Province Name:</label>
                    <input type="text" class="form-control"  value="{{ $app_form->vehicle->province_code ?? ''}}" placeholder="Enter Province Name" name="province_code" readonly="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">District Name:</label>
                    <input type="text" class="form-control"  value="{{ $app_form->vehicle->district_code ?? ''}}" placeholder="Enter District Name" name="district_code" readonly="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Village Name:</label>
                    <input type="text" class="form-control"  value="{{ $app_form->vehicle->village_name ??''}}" placeholder="Enter village name" name="village_name" readonly="">
                </div>

                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Brand Name:</label>
                    <input type="text" class="form-control"  value="{{ $app_form->vehicle->vbrand->name ?? ''}}" placeholder="Enter Brand name" name="brand_id" readonly="">
                </div>

                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Model  Name:</label>
                    <input type="text" class="form-control"  value="{{ $app_form->vehicle->vmodel->name ?? ''}}" placeholder="Enter Model Name" name="model_id" readonly="">
                </div>
             
             
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Staff Name:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="{{auth()->user()->name}}" placeholder="Enter Staff Name" readonly="">
                    <input type="hidden" class="form-control" id="validationCustom01" value="{{auth()->user()->id}}" placeholder="Enter Staff Name" name="staff_id" readonly="">
              
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Note:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="{{$app_form->note}}" placeholder="Enter Note" name="note" require="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Comment:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="{{$app_form->comment}}" placeholder="Enter Comment" name="comment" required="">
                </div>
             
                </div>
                <hr>
                <div class="form-row">
                    <div class="col-md-12 col-sm-12"><h3>Vehicle Document</h3></div>
                    
                    <div class="col-md-12 col-sm-12 mb-2">
                    <a href="" class="btn btn-success">Add New</a>
                    </div>
                   
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td>Document Type</td>
                            <td>Document File</td>
                        </tr>
                       
                    </table>
                </div>
                <div class="form-row">
                <div class="col-md-8 col-sm-8">
                
                </div>
                
                <div class="col-md-4 col-sm-4 text-right">

                <a class="btn  btn-secondary" href="#">{{trans('button.cancel')}}</a>
                <button class="btn btn-success">{{trans('button.save')}}</button>
                </div>
                </div>
            </div>
          
 
            </div>
           
        </form>
        
    </div>
  </div>


@include('delete')
 @endsection 

