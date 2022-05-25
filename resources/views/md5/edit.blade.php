 
@extends('layouts.master')
@section('importer','active')
{{-- <link rel="stylesheet" type="text/css" href="{{asset('css/normalize.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('js/jquery.steps.css')}}">--}}
@section('content')

@php
$kinds = \App\Model\VehicleKind::whereStatus(1)->get();
$brands = \App\Model\VehicleBrand::whereStatus(1)->get();
$all_brands = \App\Model\VehicleBrand::whereStatus(1)->pluck('name')->toArray();
$types = \App\Model\VehicleType::whereStatus(1)->get();
$all_types = \App\Model\VehicleType::whereStatus(1)->pluck('name')->toArray();
$models = \App\Model\VehicleModel::whereStatus(1)->get();
$all_models = \App\Model\VehicleModel::whereStatus(1)->pluck('name')->toArray();
$pros = \App\Model\Province::whereStatus(1)->get();
$eng_type = \App\Model\EngineBrand::whereStatus(1)->get();
$dists = \App\Model\District::whereStatus(1)->get();
$color = \App\Model\Color::whereStatus(1)->get();
$color_names = \App\Model\Color::whereStatus(1)->pluck('name')->toArray();
$village = \App\Model\Village::whereStatus(1)->get();
$gases =\App\Model\Gas::get();
$purposes = \App\Model\VehiclePurpose::get();
$app_status=\App\Model\ApplicationStatus::get();
$doc_type =\App\Model\ApplicationDocType::get();
$steer_id =\App\Model\Steering::get();
$staff = \App\Model\Staff::whereStatus(1)->get();
@endphp  
    <h1 class="page-header">Update Vehicle Detail</h1>
<div class="panel panel-inverse">
@include('flash')
<div class="panel-body">
      <form action="{{route('vehicle-detail.update',['id'=>$data->vehicle_detail_id])}}" method="POST" enctype="multipart/form-data">
                               @method('patch')
                                @csrf
  
                           <div class="form-row">

                              <div class="col-md-3 mb-3">
                               
                                 <label for="licence_no">Licence No</label>
                                 <input type="text" class="form-control"  name="licence_no"  placeholder="" value="{{$data->vehicle_detail->licence_no}}">
                              </div>
                             
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustom02">License No need</label>
                                 <input type="text" class="form-control" id="licence_no_need" name="licence_no_need"  placeholder="" value="{{$data->vehicle_detail->licence_no_need}}" >
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="vehicle_purpose">Vehicle Purpose</label>
                                 <div class="input-group">
                                     <select class="form-control " id="purpose_id"  name="purpose_id" >
                                   
                                    @foreach($purposes as $purpose)
                                    <option value="{{$data->vehicle_detail->purpose_id}}" class="style1" {{$data->vehicle_detail->purpose == $purpose->id ? 'selected' : '' }}>{{ $purpose->name }}&nbsp;({{$purpose->name_en}})</option>
                                    @endforeach
                                  </select>
                                 </div>
                              </div>
                              <div class="col-md-3 col-sm-3 mb-3">
                               <label for="validationCustom01"> Owner Name:</label>
                                  <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->owner_name}}" placeholder="Enter Owner Name" name="owner_name" required="">
                                     </div>
                              <div class="col-md-3 col-sm-3 mb-3">
                                 <label for="validationCustom01">Tenant Name:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->tenant_name}}" placeholder="Enter Tenant Name" name="tenant_name" required="">
                             </div>
                              <div class="col-md-3 col-sm-3 mb-3">
                              <label for="validationCustom01">Village Name:</label>
                                    <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->village_name}}" placeholder="Enter Village Name" name="village_name" required="">
                                 </div>
                              <div class="col-md-3 col-sm-3 mb-3">
                              <label for="validationCustom01"> Seat:</label>
                                  <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->seat}}" placeholder="Enter Owner Name" name="seat" required="">
                              </div>
                               <div class="col-md-3 col-sm-3 mb-3">
                               <label for="validationCustom01"> Year Manufacture:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->year_manufacture}}" placeholder="Enter Owner Name" name="year_manufacture" required="">
                               </div>
                                <div class="col-md-3 col-sm-3 mb-3">
                               <label for="validationCustom01"> Width:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->width}}" placeholder="Enter Owner Name" name="width" required="">
                               </div>
                                <div class="col-md-3 col-sm-3 mb-3">
                               <label for="validationCustom01"> Height:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->year_manufacture}}" placeholder="Enter Owner Name" name="height" required="">
                               </div>
                               <div class="col-md-3 col-sm-3 mb-3">
                               <label for="validationCustom01"> Long:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->long}}" placeholder="Enter Owner Name" name="long" required="">
                                </div>
                                <div class="col-md-3 col-sm-3 mb-3">
                               <label for="validationCustom01"> Weight:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->weight}}" placeholder="Enter Owner Name" name="weight" required="">
                               </div>
                               <div class="col-md-3 col-sm-3 mb-3">
                               <label for="validationCustom01"> Total Weight:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->total_weight}}" placeholder="Enter Owner Name" name="total_weight" required="">
                               </div>
                                <div class="col-md-3 col-sm-3 mb-3">
                               <label for="validationCustom01">Engine No:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->engine_no}}" placeholder="Enter Owner Name" name="engine_no" required="">
                               </div>
                                <div class="col-md-3 col-sm-3 mb-3">
                               <label for="validationCustom01">Chassis No:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->chassis_no}}" placeholder="Enter Owner Name" name="chassis_no" required="">
                               </div>
                                <div class="col-md-3 col-sm-3 mb-3">
                               <label for="validationCustom01">Permit No:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->import_permit_no}}" placeholder="Enter Owner Name" name="import_permit_no" required="">
                               </div>
                               <div class="col-md-3 col-sm-3 mb-3">
                               <label for="validationCustom01">Permit Date:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->import_permit_date}}" placeholder="Enter Owner Name" name="import_permit_date" required="">
                               </div>
                               <div class="col-md-3 col-sm-3 mb-3">
                               <label for="validationCustom01">Industrial Doc No:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->industrial_doc_no}}" placeholder="Enter Owner Name" name="industrial_doc_no" required="">
                               </div>
                               <div class="col-md-3 col-sm-3 mb-3">
                               <label for="validationCustom01">Industrial Doc Date:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->industrial_doc_date}}" placeholder="Enter Owner Name" name="industrial_doc_date" required="">
                               </div>
                                 <div class="col-md-3 col-sm-3 mb-3">
                               <label for="validationCustom01">Industrial Doc Date:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->industrial_doc_date}}" placeholder="Enter Owner Name" name="industrial_doc_date" required="">
                               </div>
                                <div class="col-md-3 col-sm-3 mb-3">
                               <label for="validationCustom01">Technical Doc No:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->technical_doc_no}}" placeholder="Enter Owner Name" name="technical_doc_no" required="">
                               </div>
                               <div class="col-md-3 col-sm-3 mb-3">
                               <label for="validationCustom01">Technical Doc Date:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->technical_doc_date}}" placeholder="Enter Owner Name" name="technical_doc_date" required="">
                               </div>
                               <div class="col-md-3 col-sm-3 mb-3">
                               <label for="validationCustom01">Commerce Permit No:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->comerce_permit_no}}" placeholder="Enter Owner Name" name="comerce_permit_no" required="">
                               </div>
                               <div class="col-md-3 col-sm-3 mb-3">
                               <label for="validationCustom01">Commerce Permit Date:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->comerce_permit_date}}" placeholder="Enter Owner Name" name="comerce_permit_date" required="">
                               </div>
                                <div class="col-md-3 col-sm-3 mb-3">
                               <label for="validationCustom01">Tax No:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->tax_no}}" placeholder="Enter Owner Name" name="tax_no" required="">
                               </div>
                                <div class="col-md-3 col-sm-3 mb-3">
                               <label for="validationCustom01">Tax Date:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->tax_date}}" placeholder="Enter Owner Name" name="tax_date" required="">
                               </div>
                                <div class="col-md-3 col-sm-3 mb-3">
                               <label for="validationCustom01">Tax Payment No:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->tax_payment_no}}" placeholder="Enter Owner Name" name="tax_payment_no" required="">
                               </div>
                                <div class="col-md-3 col-sm-3 mb-3">
                               <label for="validationCustom01">Tax Payment Date:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->tax_payment_date}}" placeholder="Enter Owner Name" name="tax_payment_date" required="">
                               </div>
                                <div class="col-md-3 col-sm-3 mb-3">
                               <label for="validationCustom01">Police Doc No:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->police_doc_no}}" placeholder="Enter Owner Name" name="police_doc_no" required="">
                               </div>
                                <div class="col-md-3 col-sm-3 mb-3">
                               <label for="validationCustom01">Police Doc Date:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->police_doc_date}}" placeholder="Enter Owner Name" name="police_doc_date" required="">
                               </div>
                                <div class="col-md-3 col-sm-3 mb-3">
                               <label for="validationCustom01">Vehicle Remark:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->remark}}" placeholder="Enter Owner Name" name="remark" required="">
                               </div>
                                <div class="col-md-3 col-sm-3 mb-3">
                               <label for="validationCustom01">Date Time Update:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{$data->vehicle_detail->datetime_update}}" placeholder="Enter Owner Name" name="datetime_update" required="">
                               </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">{{ trans('register.province')}}</label>
                                 <select class="form-control selectpicker" id="province_code" data-live-search="true" name="province_code"  >
                                    <option value="" selected disabled hidden>--Select Province--</option>
                                    @foreach($pros as $pro)
                                    <option value="{{$pro->province_code}}">{{ $pro->name }}&nbsp;({{$pro->name_en}})</option>
                                    @endforeach
                                 </select>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustom02">{{ trans('register.district')}}</label>
                                 <select class="form-control" name="district_code" id="district_code" >
                                    <option value="" selected disabled hidden>--Select District--</option>
                                    @foreach($dists as $dist)
                                    <option value="{{$dist->district_code}}">{{$dist->name}}&nbsp;({{$dist->name_en}})</option>
                                    @endforeach
                                 </select>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">Gas</label>
                                  <select class="form-control " data-live-search="true" name="gas_id">
                                    <option value="" selected disabled hidden  >--Select Gas--</option>
                                    @foreach($gases as $gas)
                                    <option value="{{$gas->id}}" >{{ $gas->name }}&nbsp;({{$gas->name_en}})</option>
                                    @endforeach
                                 </select>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">{{ trans('register.swheel')}}</label>
                                 <select class="form-control selectpicker" data-live-search="true" name="steering_id" >
                                    @foreach($steer_id as $data)
                                    <option value="{{$data->id}}" >{{ $data->name }}({{$data->name_en}})</option>
                                    @endforeach
                                 </select>
                              </div>

                               <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">{{ trans('register.make')}}</label>
                                 <div class="input-group">
                                    <select class="form-control selectpicker" data-live-search="true" name="brand_id" id="brand_id" >
                                       <option value="" selected disabled hidden  >--Select Vehicle Brand--</option>
                                       @foreach($brands as $brand)
                                       <option value="{{$brand->id}}" >({{$brand->name_en}})</option>
                                       @endforeach
                                    </select>
                                 </div>
                              </div>
                              
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustom01">{{ trans('register.color')}}</label>
                                 <select class="form-control selectpicker" data-live-search="true" name="color_id">
                                    <option value="" selected disabled hidden  >--Select Color--</option>
                                    @foreach($color as $co)
                                    <option value="{{$co->id}}" >{{ $co->name }}&nbsp;({{$co->name_en}})</option>
                                    @endforeach
                                 </select>
                              </div>
                              
                      
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustom02">{{ trans('register.vehicletype')}}()</label>
                                 <select class="form-control selectpicker" data-live-search="true" name="vehicle_type_id" >
                                    @foreach($types as $type)
                                    <option value="{{$type->id}}" >{{ $type->name }}({{$type->name_en}})</option>
                                    @endforeach
                                 </select>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">{{ trans('register.model')}}</label>
                                 <div class="input-group">
                                    <select class="form-control"  name="model_id" id="model_id" >
                                       <option value="" selected disabled hidden  >--Select Vehicle Model--</option>
                                       @foreach($models as $model)
                                       <option value="{{$model->id}}" >{{ $model->name }}({{$model->name_en}})</option>
                                       @endforeach
                                    </select>
                                 </div>
                              </div>
                              
                           </div>
                  
                          
                        <div class="col-md-12 col-sm-12 text-right">
          
             <a class="btn  btn-default" href="{{route('pre-reg-app.show',['id'=>$data->id])}}">{{trans('button.cancel')}}</a>
             <button type="submit" class="btn btn-primary">{{trans('button.update')}}</button>
            </div>
        </form>
        
    </div>
  </div>


@include('delete')
 @endsection 