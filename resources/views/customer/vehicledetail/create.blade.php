@extends('customer.layouts.master')
@section('vehicle','active')
@section('content')
@php
$purposes = \App\Model\VehiclePurpose::get();
$provinces = \App\Model\Province::whereStatus(1)->get();
$steerings =\App\Model\Steering::get();
$brands = \App\Model\VehicleBrand::whereStatus(1)->get();
$types = \App\Model\VehicleType::whereStatus(1)->get();
$models = \App\Model\VehicleModel::whereStatus(1)->get();
$colors = \App\Model\Color::whereStatus(1)->get();
$gases =\App\Model\Gas::get();
$eng_type = \App\Model\EngineType::whereStatus(1)->get();
$moter_brand = \App\Model\EngineBrand::whereStatus(1)->get();
$vehicle_kind = \App\Model\VehicleKind::whereStatus(1)->get();
$user_id = Auth::user()->id;
$models= \App\Model\VehicleModel::whereStatus(1)->get();
$districts = \App\Model\District::whereStatus(1)->get();
@endphp
<style>
  #forms-sample .col-sm-1,#forms-sample .col-sm-1{
    padding-left:0px;
    padding-right:0px;
    margin-bottom: 0px;
  }
 
</style>
<h1 class="page-header">{{ trans('vehicle.veh_info') }}</h1>
<div class="card">
  <div class="card-body">
   @include('flash')
    <form id="forms-sample" action="{{route('vehicle-detail.store')}}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.division_number') }}:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.cylinder') }}:</label>
    <div class="col-sm-2">
    <input type="number" class="form-control" id="cylinder" name="cylinder" placeholder="" value="{{ old('cylinder') }}" min="1" >
    </div>
    <label for="colFormLabelSm" class="col-sm-2 px-0">1.{{ trans('module4.import_permit') }}:</label>
    <div class="col-sm-1">
      &nbsp;
    </div>
    <label for="colFormLabelSm" class="col-sm-2 px-0 ">5.{{ trans('module4.tax') }}:</label>
    <div class="col-sm-1">
      &nbsp;
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.province_number') }}:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.cc') }}:</label>
    <div class="col-sm-2">
    <input type="number" class="form-control" name="cc" min="1" value="{{ old('cc') }}" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.hsny') }}:</label>
    <div class="col-sm-2">
    <input type="checkbox" class="form-check-input disabled"  >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.tax_10_40') }}</label>
    <div class="col-sm-2">
    <input type="checkbox" class="form-check-input disabled"  >
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.vdvc_serial') }}:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.color') }}:</label>
    <div class="col-sm-2">
    <select class="js-example-basic-single form-control" style="width: 100%" name="color_id" required>
      <option value="" selected disabled hidden  >Select Color</option>
        @foreach($colors as $co)
        <option value="{{$co->id}}" {{old ('color_id') == $co->id ? 'selected' : ''}}>{{ $co->name }}&nbsp;({{$co->name_en}})</option>
        @endforeach
      </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.invest') }}:</label>
    <div class="col-sm-2">
    <input type="checkbox" class="form-check-input disabled"  >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.tax_exam') }}:</label>
    <div class="col-sm-2">
    <input type="checkbox" class="form-check-input disabled"  >
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.issue_date') }}:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.brand') }}:</label>
    <div class="col-sm-2">
    <select class="js-example-basic-single form-control" style="width: 100%" name="brand_id" id="vbrand" required>
      <option value="" selected disabled hidden  >--Select Vehicle Brand--</option>
        @foreach($brands as $brand)
        <option value="{{$brand->id}}" {{old ('brand_id') == $brand->id ? 'selected' : ''}}>({{$brand->name_en}})</option>
        @endforeach
      </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.veh_mod4_no') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control " id="import_permit_no" name="import_permit_no" placeholder="Permit No" value="{{ old('import_permit_no') }}">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.tax12') }}:</label>
    <div class="col-sm-2">
    <input type="checkbox" class="form-check-input disabled"  >
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.expire_date') }}:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.model') }}:</label>
    <div class="col-sm-2">
      <select class="js-example-basic-single form-control" style="width: 100%" name="model_id" id="vmodel" required>
      @if(old('model_id'))
       @foreach($models as $model)
      <option value="{{$model->id}}"  {{old ('model_id') == $model->id ? 'selected' : ''}}>{{ $model->name }}</option>
      @endforeach
       @endif 
      </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.veh_mod4_date') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="datetime form-control" id="import_permit_date" name="import_permit_date" placeholder="Permit date" value="{{ old('import_permit_date') }}" aria-describedby="inputGroupPrepend" format="yyyy-mm-dd">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.tax50') }}:</label>
    <div class="col-sm-2">
    <input type="checkbox" class="form-check-input disabled"  >
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('vehicle.pre_license') }}:</label>
    <div class="col-sm-2">
    <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{$user_id}}">
    <input type="text" class="form-control" id="licence_number" name="licence_no_need"  placeholder="Enter Licence No." value="{{ old('licence_no_need') }}" pattern="[A-Za-z0-9 ]{1,}" title="Invalid input format." required>
           
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('vehicle.engine_no')}}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control eng-validate" id="engine_no" name="engine_no" placeholder="Engine Number" value="{{ old('engine_no') }}" required>
    </div>
    <label for="colFormLabelSm" class="col-sm-2 px-0 ">2.Industrial Doc:</label>
    <div class="col-sm-1">
      &nbsp;
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.veh_mod4_no') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control " id="tax_no" name="tax_no" placeholder="Tax No" value="{{ old('tax_no') }}" required>
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('module4.purpose') }}:</label>
    <div class="col-sm-2">
    <select class="js-example-basic-single form-control" id="vehicle_kind_code" style="width:100%" name="vehicle_kind_code" required>
      <option value="" selected disabled hidden>--Select Vehicle Kind--</option>
        @foreach($vehicle_kind as $v_kind)
        <option value="{{$v_kind->vehicle_kind_code}}" {{old ('vehicle_kind_code') == $v_kind->vehicle_kind_code ? 'selected' : ''}}>{{ $v_kind->name }}&nbsp;({{$v_kind->name_en}})</option>
        @endforeach
      </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.chassis_no') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control eng-validate"  name="chassis_no" placeholder="Chassis No" value="{{ old('chassis_no') }}" required >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.veh_mod4_no') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control " id="industrial_doc_no" name="industrial_doc_no" placeholder="Industrial Doc No" value="{{ old('industrial_doc_no') }}">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.veh_mod4_date') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="datetime form-control " id="tax_date" name="tax_date" placeholder="Tax Date" value="{{ old('tax_date') }}" aria-describedby="inputGroupPrepend" format="yyyy-mm-dd">
    </div>
  </div>
  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('common.name') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control required" id="owner_name" placeholder="Enter Owner Name" value="{{ old('owner_name') }}" name="owner_name" required>
    </div>
    <label for="colFormLabelSm" class="col-sm-1">  {{ trans('module4.width') }}:</label>
    <div class="col-sm-2">
    <input type="number" class="form-control " id="width" name="width" placeholder="Width" value="{{ old('width') }}" min="1" required>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.veh_mod4_date') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="datetime form-control " id="industrial_doc_date" name="industrial_doc_date" placeholder="Industrial Doc Date" value="{{ old('industrial_doc_date') }}" aria-describedby="inputGroupPrepend" format="yyyy-mm-dd">
    </div>
    <label for="colFormLabelSm" class="col-sm-2 px-0 ">6.{{ trans('module4.tax_payment') }}:</label>
    <div class="col-sm-1">
     &nbsp;
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">  {{ trans('module4.name2') }}:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('module4.long') }}:</label>
    <div class="col-sm-2">
    <input type="number" class="form-control " id="long" placeholder="Long" value="{{ old('long') }}" name="long" min="1" required>
    </div>
    <label  class="col-sm-2 px-0">3.{{ trans('module4.tech_doc') }}:</label>
    <div class="col-sm-1">
     &nbsp;
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.tax_receipt') }}:</label>
    <div class="col-sm-2">
    <input type="checkbox" class="form-check-input" >
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('module4.village_name') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control" id="village_name" placeholder="Enter Village" value="{{ old('village_name') }}" name="village_name" required>
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('module4.height') }}:</label>
    <div class="col-sm-2">
    <input type="number" class="form-control " id="height" name="height" placeholder="Height" value="{{ old('height') }}" min="1" required>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.veh_mod4_no') }}.:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control " id="technical_doc_no" name="technical_doc_no" placeholder="Technical Doc No" value="{{ old('technical_doc_no') }}">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.tax_permit') }}:</label>
    <div class="col-sm-2">
    <input type="checkbox" class="form-check-input" >
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">  {{ trans('module4.unit') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.seat') }}:</label>
    <div class="col-sm-2">
    <input type="number" class="form-control " id="seat" placeholder="Seats" name="seat"  min="1" value="{{ old('seat') }}" required>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.veh_mod4_date') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="datetime form-control " id="technical_doc_date" name="technical_doc_date" placeholder="Technical Doc Date" value="{{ old('technical_doc_date') }}" aria-describedby="inputGroupPrepend" format="yyyy-mm-dd">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.veh_mod4_no') }}.:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control " id="tax_payment_no" name="tax_payment_no" placeholder="Tax Payment" value="{{ old('tax_payment_no') }}" aria-describedby="inputGroupPrepend" required>
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('common.province') }}:</label>
    <div class="col-sm-2">
    <select class="js-example-basic-single form-control" id="province" style="width: 100%"name="province_code" required>
      <option value="" selected disabled hidden>--Select Province--</option>
        @foreach($provinces as $pro)
        <option value="{{$pro->province_code}}" style="font-weight: bold" {{old ('province_code') == $pro->province_code ? 'selected' : ''}}>{{ $pro->name }}&nbsp;({{$pro->name_en}})</option>
        @endforeach
    </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.wheel') }}:</label>
    <div class="col-sm-2">
    <input type="number" class="form-control " id="wheels" placeholder="Wheels" name="wheels"  value="{{ old('wheels')}}" min="1" required>
    </div>
    <label for="colFormLabelSm" class="col-sm-2 px-0 ">4.{{ trans('module4.commerce_permit') }}:</label>
    <div class="col-sm-1">
     &nbsp;
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.veh_mod4_date') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="datetime form-control " id="tax_payment_date" name="tax_payment_date" value="{{ old('tax_payment_date')}}" placeholder="Tax Payment Date" required>
    </div>
  </div>
  
  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('common.district') }}:</label>
    <div class="col-sm-2">
    <select class="form-control js-example-basic-single" style="width: 100%;" name="district_code"  id="district" required>
      @if(old('district_code'))
       @foreach($districts as $dis)
      <option value="{{$dis->district_code}}"  {{old ('district_code') == $dis->district_code ? 'selected' : ''}}>{{ $dis->name }}</option>
      @endforeach
       @endif     
    </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1">  {{ trans('module4.weight') }}:</label>
    <div class="col-sm-2">
    <input type="number" min="0" class="form-control " id="weight" placeholder="Enter Weight" value="{{ old('weight')}}" name="weight" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Commerce Permit:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm"  readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-2 px-0 ">7.{{ trans('module4.police_doc') }}:</label>
    <div class="col-sm-1">
     &nbsp;
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('module4.vehicle_type') }}:</label>
    <div class="col-sm-2">
    <select class="js-example-basic-single vehicle_type"  name="vehicle_type_id" style="width:100%" required>
      <option value="" selected disabled hidden  >--Select Vehicle Type--</option>
        @foreach($types as $type)
        <option value="{{$type->id}}" {{old('vehicle_type_id') == $type->id ? 'selected' : ''}}>{{ $type->name }}({{$type->name_en}})</option>
        @endforeach
    </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('vehicle.weight_filled')}}:</label>
    <div class="col-sm-2">
    <input type="number" min="0" class="form-control" placeholder="Enter Weight" value="{{ old('weight_filled') }}" name="weight_filled" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.veh_mod4_no') }}.:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control " id="comerce_permit_no" name="comerce_permit_no" placeholder="Commerce Permit No" value="{{ old('comerce_permit_no') }}"  >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.veh_mod4_no') }}.:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control " id="police_doc_no" name="police_doc_no" placeholder="Police Doc No" value="{{ old('police_doc_no') }}">
    </div>
  </div>
  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.steering') }}:</label>
    <div class="col-sm-2">
    <select class="js-example-basic-single form-control" style="width: 100%" name="steering_id" id="steering" required>
        <option value="" selected disabled hidden>-Select Steering Wheels-</option>
        @foreach($steerings as $data)
        <option value="{{$data->id}}" {{old ('steering_id') == $data->id ? 'selected' : ''}}>{{ $data->name }}({{$data->name_en}})</option>
        @endforeach
      </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('module4.total_weight') }}:</label>
    <div class="col-sm-2">
    <input type="number" class="form-control " id="total_weight" name="total_weight" placeholder="Total Weight" value="{{ old('total_weight') }}" min="1">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.veh_mod4_date') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="datetime form-control " id="comerce_permit_date" name="comerce_permit_date" placeholder="Commerce Permit Date" value="{{ old('comerce_permit_date') }}" aria-describedby="inputGroupPrepend" format="yyyy-mm-dd">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.veh_mod4_date') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="datetime form-control " id="police_doc_date" name="police_doc_date" placeholder="Police Doc Date" value="{{old('police_doc_date')}}" aria-describedby="inputGroupPrepend" format="yyyy-mm-dd">
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('module4.engine_type') }}:</label>
    <div class="col-sm-2">
    <select class="js-example-basic-single form-control" id="engine_type_id" style="width: 100%" name="engine_type_id" required>
                      <option value="" selected disabled hidden>-- Engine Type--</option>
                      @foreach($eng_type as $et)
                      <option value="{{$et->id}}" {{old ('engine_type_id') == $et->id ? 'selected' : ''}}>{{ $et->name }}&nbsp;({{$et->name_en}})</option>
                      @endforeach
                   </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('module4.axis') }}:</label>
    <div class="col-sm-2">
    <input type="number" class="form-control " id="Axis" placeholder="Axis" name="axis"  value="{{ old('axis') }}" min="1" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.lock_no') }}.:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-2 px-0 ">8.{{ trans('module4.vehicle_remark') }}:</label>
    <div class="col-sm-1">
      
    </div>
  </div>
  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.log') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('module4.year_mnf') }}:</label>
    <div class="col-sm-2">
    <input type="number" class="form-control date-year" id="year_manufacture" placeholder="Year" name="year_manufacture" onKeyDown="if(this.value.length==4) return false;" value="{{ old('year_manufacture') }}" min="1" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.company_lock') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" readonly>
    </div>
  
    <div class="col-sm-3">
    <input type="text" class="form-control " id="remark" name="remark" placeholder="Vehicle Remark" value="{{ old('remark') }}" aria-describedby="inputGroupPrepend" >
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.send') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.motor_brand') }}:</label>
    <div class="col-sm-2">
    <select class="js-example-basic-single form-control" id="motor_brand_id" style="width: 100%" name="motor_brand_id" >
        <option value="" selected disabled hidden>--Motor Brand--</option>
        @foreach($moter_brand as $mb)
        <option value="{{$mb->id}}">{{ $mb->name }}&nbsp;({{$mb->name_en}})</option>
        @endforeach
      </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.start_lock') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" readonly>
    </div>
   
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.inspect_result') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.inspect_issue_date') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.end_lock') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.tel_no') }}.:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" readonly>
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.inspect_place') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('module4.inspect_expire_date') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.note1') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.note2') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" readonly>
    </div>
  </div>
  
  <div class="form-row pt-2">
  <div class="col-md-6">
  <a href="{{url('customer/vehicle-detail')}}" class="btn btn-secondary btn-sm" type="submit">{{ trans('button.back') }}</a>
  </div>
  <div class="col-md-6 text-right"> 
      <button  class="btn btn-success btn-sm btn-save" name="save_type" value="draft">{{ trans('button.save_draft') }}</button> &nbsp; 
      <button  class="btn btn-success btn-sm btn-save" name="save_type" value="submit">{{ trans('button.submit') }}</button>
  </div>
       
   </div>
      
    </form>
  </div>
</div>

@endsection

@push('page_scripts')

<script type="text/javascript">
   var dist_url="{{url('/getdistrict/')}}";
    var get_vmodal="{{url('/getVmodel/')}}";
    $('.date-year').datepicker({
         minViewMode: 2,
         format: 'yyyy',
         autoclose:true,
         endDate: '+0d', 
       });
</script>
<script src="{{ asset('js/numvalidate.js') }}"></script>
<script type="text/javascript" src="{{asset('js/dropdownlist.js')}}"></script>

@endpush