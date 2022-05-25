@extends('vrms2.layouts.master')
@section('importer','active')
@section('content')
<style>
  #myForm .col-sm-1,#myForm .col-sm-1{
    padding-left:0px;
    padding-right:0px;
    margin-bottom: 0px;
  }
 
</style>
<h3>
{{ trans('module4.vehicle_info')}}
</h3>
@include('flash')
<div class="card-body">
   <form id="myForm" action="{{route('import-vehicle.store')}}" method="post" enctype="multipart/form-data">
 @csrf
  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">Division No:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('vehicle.cylinder')}}:</label>
    <div class="col-sm-2">
    <input type="number" class="form-control" id="validationCustomUsername" min="0" name="cylinder" placeholder="" value="{{ old('cylinder') }}" >
    </div>
    <label for="colFormLabelSm" class="col-sm-2 px-0">1.Import Permit:</label>
    <div class="col-sm-1">
      &nbsp;
    </div>
    <label for="colFormLabelSm" class="col-sm-2 px-0 ">5.Tax:</label>
    <div class="col-sm-1">
      &nbsp;
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">Province No:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('vehicle.cc')}}:</label>
    <div class="col-sm-2">
    <input type="number" class="form-control required" min="0"  id="validationCustomUsername" name="cc" placeholder="CC" value="{{ old('cc') }}" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">HSNY:</label>
    <div class="col-sm-2">
    <input type="checkbox" class="form-check-input disabled"  >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Tax 10* 40</label>
    <div class="col-sm-2">
    <input type="checkbox" class="form-check-input disabled"  >
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">VdVC Serial:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('vehicle.color')}}:</label>
    <div class="col-sm-2">
    <select class="form-control js-example-basic-single" style="width: 100%;"  name="color_id" required>
                     <option value="" selected disabled hidden  >--Select Color--</option>
                     @foreach($data['colors'] as $co)
                     <option value="{{$co->id}}" {{old ('color_id') == $co->id ? 'selected' : ''}}>{{ $co->name }}&nbsp;({{$co->name_en}})</option>
                     @endforeach
                  </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Invest:</label>
    <div class="col-sm-2">
    <input type="checkbox" class="form-check-input disabled"  >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">TaxExam:</label>
    <div class="col-sm-2">
    <input type="checkbox" class="form-check-input disabled"  >
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">Issue Date:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('vehicle.brand')}}:</label>
    <div class="col-sm-2">
    <select class="form-control js-example-basic-single" style="width: 100%;" name="brand_id" id="vbrand" required>
         <option value="" selected disabled hidden  >--Select Vehicle Brand--</option>
         @foreach($data['brands'] as $brand)
         <option value="{{$brand->id}}" {{old ('brand_id') == $brand->id ? 'selected' : ''}}>({{$brand->name_en}})</option>
         @endforeach
      </select>  
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">No:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control " id="import_permit_no" name="import_permit_no" placeholder="Permit No" value="{{ old('import_permit_no') }}">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Tax 12:</label>
    <div class="col-sm-2">
    <input type="checkbox" class="form-check-input disabled"  >
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">Expire Date:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('vehicle.model')}}:</label>
    <div class="col-sm-2">
    <select class="form-control js-example-basic-single" style="width: 100%;"  name="model_id" id="vmodel" required>
    @if(old('model_id'))
       @foreach($data['models'] as $model)
      <option value="{{$model->id}}"  {{old ('model_id') == $model->id ? 'selected' : ''}}>{{ $model->name }}</option>
      @endforeach
       @endif    
      </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Date:</label>
    <div class="col-sm-2">
    <input type="text" class="datetime form-control" id="import_permit_date" name="import_permit_date" placeholder="Permit date" value="{{ old('import_permit_date') }}">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Tax  50:</label>
    <div class="col-sm-2">
    <input type="checkbox" class="form-check-input disabled"  >
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">{{trans('app_form.pre_licence_no')}}:</label>
    <div class="col-sm-2">
         <input type="text" class="form-control" id="licence_number" name="licence_no_need"  placeholder="Enter Licence No." value="{{ old('licence_no_need') }}" pattern="[A-Za-z0-9 ]{1,}" title="Invalid input format." required>
              
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('vehicle.engine_no')}}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control eng-validate" id="engine_no"  name="engine_no" placeholder="Engine Number" value="{{ old('engine_no') }}" required>
    </div>
    <label for="colFormLabelSm" class="col-sm-2 px-0 ">2.Industrial Doc:</label>
    <div class="col-sm-1">
      &nbsp;
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">No:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control " id="tax_no" name="tax_no" placeholder="Tax No" value="{{ old('tax_no') }}" required>
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> Purpose:</label>
    <div class="col-sm-2">
    <select class="form-control js-example-basic-single" style="width: 100%;"   name="vehicle_kind_code"  required>
      <option value="" selected disabled hidden>--Select Purpose--</option>
                        @foreach($data['kinds'] as $kind)
                        <option value="{{ $kind->vehicle_kind_code }}" {{old ('vehicle_kind_code') == $kind->vehicle_kind_code ? 'selected' : ''}}>{{ $kind->name }}&nbsp;({{$kind->name_en}})</option>
                        @endforeach
                     </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('vehicle.chassis_no')}}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control eng-validate"  id="chassis_no" name="chassis_no" placeholder="Chassis No" value="{{ old('chassis_no') }}" required >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">No:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control " id="industrial_doc_no" name="industrial_doc_no" placeholder="Industrial Doc No" value="{{ old('industrial_doc_no') }}"  >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Date:</label>
    <div class="col-sm-2">
    <input type="text" class="datetime form-control " id="tax_date" name="tax_date" placeholder="Tax Date" value="{{ old('tax_date') }}" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> Name:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control" id="owner_name" placeholder="Enter Owner Name" value="{{ old('owner_name') }}" name="owner_name" required>
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('vehicle.width')}}:</label>
    <div class="col-sm-2">
    <input type="number" class="form-control " id="width" name="width" min="0" placeholder="Enter Width" value="{{ old('width') }}" required>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Date:</label>
    <div class="col-sm-2">
    <input type="text" class="datetime form-control" id="industrial_doc_date" name="industrial_doc_date" placeholder="Industrial Doc Date" value="{{ old('industrial_doc_date') }}" >
    </div>
    <label for="colFormLabelSm" class="col-sm-2 px-0 ">6.Tax Payment:</label>
    <div class="col-sm-1">
     &nbsp;
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> Name2:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('vehicle.long')}}:</label>
    <div class="col-sm-2">
    <input type="number" class="form-control " id="long" min="0" placeholder="Enter Long" value="{{ old('long') }}" name="long" required>
    </div>
    <label  class="col-sm-2 px-0">3.TechnicalDoc:</label>
    <div class="col-sm-1">
     &nbsp;
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Tax Receipt:</label>
    <div class="col-sm-2">
    <input type="checkbox" class="form-check-input" >
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('vehicle.village')}}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control" id="village_name" placeholder="Enter Village" value="{{ old('village_name') }}" name="village_name" required>
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('vehicle.height')}}:</label>
    <div class="col-sm-2">
    <input type="number" class="form-control " id="height" name="height" min="0" placeholder="Enter Height" value="{{ old('height') }}" required>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">No.:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control " id="technical_doc_no" name="technical_doc_no" placeholder="Technical Doc No" value="{{ old('technical_doc_no') }}">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Tax Permit:</label>
    <div class="col-sm-2">
    <input type="checkbox" class="form-check-input" >
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> Unit:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('vehicle.seat')}}:</label>
    <div class="col-sm-2">
    <input type="number" class="form-control" id="seat"   placeholder="Seats" name="seat"  min="1"  value="{{ old('seat') }}" required>
      <span id="err1" style="display:none; color:red;font-size: 12px;">This input value is not less than 1.</span>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Date:</label>
    <div class="col-sm-2">
    <input type="text" class="datetime form-control " id="technical_doc_date" name="technical_doc_date" placeholder="Technical Doc Date" value="{{ old('technical_doc_date') }}" aria-describedby="inputGroupPrepend" format="yyyy-mm-dd">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">No.:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control " id="tax_payment_no" name="tax_payment_no" placeholder="Tax Payment" value="{{ old('tax_payment_no') }}"  required>
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('vehicle.province')}}:</label>
    <div class="col-sm-2">
    <select class="form-control js-example-basic-single" style="width: 100%;" id="province"  name="province_code"  required>
      <option value="" selected disabled hidden>--Select Province--</option>
      @foreach($data['provinces'] as $pro)
      <option value="{{$pro->province_code}}"  {{old ('province_code') == $pro->province_code ? 'selected' : ''}}>{{ $pro->name }}&nbsp;({{$pro->name_en}})</option>
      @endforeach
   </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('vehicle.wheel')}}:</label>
    <div class="col-sm-2">
    <input type="number" min="1" class="form-control" id="wheel"   placeholder="Wheels" name="wheels"  value="{{ old('wheels')}}" required>
                  <span id="err2" style="display:none; color:red;font-size: 12px;">This input value is not less than 1.</span>
    </div>
    <label for="colFormLabelSm" class="col-sm-2 px-0 ">4.Commerce Permit:</label>
    <div class="col-sm-1">
     &nbsp;
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Date:</label>
    <div class="col-sm-2">
    <input type="text" class="datetime form-control " id="tax_payment_date" name="tax_payment_date" placeholder="Tax Payment Date" value="{{ old('tax_payment_date')}}" required>
    </div>
  </div>
  
  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('vehicle.district')}}:</label>
    <div class="col-sm-2">
    <select class="form-control js-example-basic-single" style="width: 100%;" name="district_code"  id="district" required>
       @if(old('district_code'))
       @foreach($data['districts'] as $dis)
      <option value="{{$dis->district_code}}"  {{old ('district_code') == $dis->district_code ? 'selected' : ''}}>{{ $dis->name }}</option>
      @endforeach
       @endif           
    </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('vehicle.weight')}}:</label>
    <div class="col-sm-2">
    <input type="number" min="0" class="form-control " id="weight" placeholder="Enter Weight" value="{{ old('weight')}}" name="weight" required>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Commerce Permit:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm"  readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-2 px-0 ">7.Police Doc:</label>
    <div class="col-sm-1">
     &nbsp;
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('vehicle.vehicle_type')}}:</label>
    <div class="col-sm-2">
    <select class="form-control js-example-basic-single vehicle_type" style="width: 100%;"    name="vehicle_type_id" required>
      <option value="" selected disabled hidden  >--{{ trans('vehicle.vehicle_type')}}--</option>
      @foreach($data['types'] as $type)
      <option value="{{$type->id}}" {{old('vehicle_type_id') == $type->id ? 'selected' : ''}}>{{ $type->name }}({{$type->name_en}})</option>
      @endforeach
   </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('vehicle.weight_filled')}}:</label>
    <div class="col-sm-2">
    <input type="number" min="0" class="form-control" placeholder="Enter Weight" value="{{ old('weight_filled') }}" name="weight_filled" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">No.:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control " id="comerce_permit_no" name="comerce_permit_no" placeholder="Commerce Permit No" value="{{ old('comerce_permit_no') }}"  >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">No.:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm"  value="{{ old('police_doc_no') }}" placeholder="Enter Police Doc No" name="police_doc_no" >
    </div>
  </div>
  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('vehicle.steering')}}:</label>
    <div class="col-sm-2">
    <select class="form-control js-example-basic-single" style="width: 100%;" id="steering"  name="steering_id" required>
         <option value="" selected disabled hidden  >--Select Steer--</option>
         @foreach($data['steerings'] as $steer)
         <option value="{{$steer->id}}"  {{old ('steering_id') == $steer->id ? 'selected' : ''}}>{{ $steer->name }}({{$steer->name_en}})</option>
         @endforeach
      </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('vehicle.total_weight')}}:</label>
    <div class="col-sm-2">
    <input type="number" min="0" class="form-control " id="total_weight" name="total_weight"placeholder="Net weight" value="{{ old('total_weight') }}" placeholder="Enter Total Weight">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Date:</label>
    <div class="col-sm-2">
    <input type="text" class="datetime form-control " id="comerce_permit_date" name="comerce_permit_date" placeholder="Commerce Permit Date" value="{{ old('comerce_permit_date') }}">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Date:</label>
    <div class="col-sm-2">
    <input type="text" class="datetime form-control " id="police_doc_date" name="police_doc_date" placeholder="Police Doc Date" value="{{old('police_doc_date')}}" >
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('vehicle.engine_type')}}:</label>
    <div class="col-sm-2">
    <select class="form-control js-example-basic-single" style="width: 100%;" id="engine_type_id"  name="engine_type_id" required>
                        <option value="" selected disabled hidden>-- Engine Type--</option>
                        @foreach($data['eng_type'] as $et)
                        <option value="{{$et->id}}"  {{old ('engine_type_id') == $et->id ? 'selected' : ''}}>{{ $et->name }}&nbsp;({{$et->name_en}})</option>
                        @endforeach
                     </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('vehicle.axis')}}:</label>
    <div class="col-sm-2">
    <input type="number" min="0" class="form-control " id="Axis" placeholder="Axis" name="axis"  value="{{ old('axis') }}" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Lock No.:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-2 px-0 ">8.{{ trans('vehicle.vehicle_remark')}}:</label>
    <div class="col-sm-1">
      
    </div>
  </div>
  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">Log:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('vehicle.year_mnf')}}:</label>
    <div class="col-sm-2">
    <input type="number" class="form-control date-year"  placeholder="Year" name="year_manufacture"  onKeyDown="if(this.value.length==4) return false;"  value="{{ old('year_manufacture') }}" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">CompanyLock:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" readonly>
    </div>
  
    <div class="col-sm-3">
    <input type="text" class="form-control " id="remark" name="remark" placeholder="Vehicle Remark" value="{{ old('remark') }}"  >
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">Send:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('vehicle.motor_brand')}}:</label>
    <div class="col-sm-2">
    <select class="form-control js-example-basic-single" style="width: 100%;" id="motor_brand_id"  name="motor_brand_id">
                        <option value="" selected disabled hidden>--Motor Brand--</option>
                        @foreach($data['moter_brand'] as $mb)
                        <option value="{{$mb->id}}"  {{old ('motor_brand_id') == $mb->id ? 'selected' : ''}}>{{ $mb->name }}&nbsp;({{$mb->name_en}})</option>
                        @endforeach
                     </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">StartLock:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" readonly>
    </div>
   
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">Inspect Result:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> Inspect Issue Date:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">EndLock:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Telephone No.:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" readonly>
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">Inspect Place:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> Inspect Expire Date:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Note1:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Note2:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" readonly>
    </div>
  </div>
  <br/>
  <div class="form-row">
  <div class="col-md-6"> <a href="{{url('/import-vehicle')}}" class="btn btn-secondary btn-sm mt-1">{{ trans('button.back')}}</a></div>
  <div class="col-md-6 text-right">  <button  class="btn btn-success btn-sm btn-save save-draft" name="save_type" value="draft">{{ trans('button.save_draft')}}</button> &nbsp; <button  class="btn btn-success btn-sm btn-save save-draft" name="save_type" value="submit">{{ trans('button.submit')}}</button></div>
       
   </div>
</form>
   </div>

@endsection
@push('page_scripts')

<script type="text/javascript">
  var dist_url="{{url('/getdistrict/')}}";
  var get_vmodal="{{url('/getVmodel/')}}";
  var checkEngine = "{{url('/check-engine-chassis-no/')}}";
    $('.date-year').datepicker({
         minViewMode: 2,
         format: 'yyyy'
       });
  //   $('.save-draft').click(function(e) {
     
  //     e.preventDefault();
  //   var engineNo = $("#engine_no").val();
  //   var chassisNo = $("#chassis_no").val();
  //   if (engineNo && chassisNo) {
  //       $.ajax({
  //          type:"GET",
  //           url:checkEngine,
  //           data:{engine_no:engineNo, chassis_no:chassisNo },
  //           headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}" },
  //          success:function(data){ 
  //           if(data.chassis_no || data.engine_no){
  //             alert('Engine no and Chassis no already taken.');
  //             return false;
  //           } else {
  //             window.location.href = "/import-vehicle";
  //           }
  //          }
  //       });
  //   } else {
  //       $("#vmodel").empty();
  //   }      
  //  });
</script>
<script src="{{ asset('js/numvalidate.js') }}"></script>
<script type="text/javascript" src="{{asset('js/dropdownlist.js')}}"></script>

@endpush