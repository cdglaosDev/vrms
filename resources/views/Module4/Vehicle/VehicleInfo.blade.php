@php
$app_purpose = \App\Model\AppFormPurpose::whereAppFormId($app_id)->pluck('app_purpose_id')->toArray();
$inspect_places = \App\Model\InspectPlace::whereStatus(1)->get();
@endphp
<style>
  .col-sm-1, .col-sm-1{
    padding-left:0px;
    padding-right:0px;
    margin-bottom: 0px;
  }
  #vehInfo .print-paper .col-sm-1,#vehInfo .print-paper .col-sm-2{
    padding: 5px;
}

 
</style>

<form  action="{{route('all-vehicles.update',[$vehicle->id])}}"  method="POST" id="updateVeh">
@method('Patch')
 @csrf
 <input type="hidden" value="{{ $vehicle->id }}" id="vehicle_id">
<input type="hidden" value="{{auth()->user()->user_status}}" id="user_status">
  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.division_number') }}:</label>
    <div class="col-sm-2" style="padding-right: 0px;">
    <input type="text" style="width: 143px;float:left" class="form-control form-control-sm"  id="division_no"  value="{{ $vehicle->division_no }}" placeholder=""  name="division_no" onpaste="return false;">
    <div>
    
          @if($vehicle->division_no != null && $vehicle->province_no != null)
              <a id="div_control_btn" class="disable-btn">A</a>
          @else
          <a id="div_control_btn" class="@if(isset($app_form_status_id)){{$app_form_status_id == 1 || $app_form_status_id == 2 ?'disable-btn':''}}@endif">A</a>
          @endif
    
    </div>
    <span id="divError" ></span>
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.cylinder') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm"  value="{{ $vehicle->cylinder }}" placeholder="" name="cylinder" >
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
    <input type="text" id="province_no" class="form-control form-control-sm"  value="{{ $vehicle->province_no }}" placeholder="" name="province_no"  onpaste="return false;">
    <span id="proError"></span>
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.cc') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm"  value="{{ $vehicle->cc }}" placeholder="" name="cc" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.hsny') }}:</label>
    <div class="col-sm-2">
    <input type="checkbox" class="form-check-input "  {{ $vehicle->import_permit_hsny ==1?'checked':'' }} value="1"  name="import_permit_hsny" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.tax_10_40') }}</label>
    <div class="col-sm-2">
    <input type="checkbox" class="form-check-input"  value="1" {{ $vehicle->tax_10_40 ==1?'checked':''}} placeholder="" name="tax_10_40" >
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.vdvc_serial') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="date form-control form-control-sm"  value="{{ $vehicle->card_serial_no }}" id="serial_no" placeholder="" name="card_serial_no" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.color') }}:</label>
    <div class="col-sm-2">
    <select name="color_id" id="color" class="form-control form-control-sm js-example-basic-single" style="width: 100%;" >
        <option value="" selected disabled>Select Color</option>
        @foreach($veh_info['colors'] as $color)
        <option value="{{$color->id}}" {{$color->id == $vehicle->color_id?'selected':''}}>{{ $color->name}}</option>
        @endforeach
    </select> 
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.invest') }}:</label>
    <div class="col-sm-2">
    <input type="checkbox" class="form-check-input " {{ $vehicle->import_permit_invest ==1?'checked':'' }}  value="1" name="import_permit_invest" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.tax_exam') }}:</label>
    <div class="col-sm-2">
    <input type="checkbox" class="form-check-input"  value="1" placeholder="" {{ $vehicle->tax_exam ==1?'checked':'' }} name="tax_exam" >
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.issue_date') }}:</label>
    <div class="col-sm-2">
        <input type="text" class="date form-control form-control-sm" id="show_issue_date"  data-date-format="yyyy-mm-dd" value="{{ $vehicle->issue_date ?? '' }} " placeholder="Enter Issue Date" name="issue_date" >
        <input type="hidden" id="issue_date" value="@if($vehicle->issue_date){{ $vehicle->issue_date }}@else{{ date('Y-m-d') }}@endif">
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.brand') }}:</label>
    <div class="col-sm-2">
    <select name="brand_id" class="form-control form-control-sm js-example-basic-single" id="vbrand"  style="width: 100%;" >
        <option value="" selected disabled>Select Brand</option>
        @foreach($veh_info['brands'] as $brand)
        <option value="{{$brand->id}}" {{$brand->id == $vehicle->brand_id?'selected':''}}>{{ $brand->name}}</option>
        @endforeach
    </select>     
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.veh_mod4_no') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm"  value="{{ $vehicle->import_permit_no }}" placeholder="Enter Import Permit No" name="import_permit_no" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.tax12') }}:</label>
    <div class="col-sm-2">
    <input type="checkbox" class="form-check-input"  value="1"  {{ $vehicle->tax_12 ==1?'checked':'' }} placeholder="" name="tax_12" >
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.expire_date') }}:</label>
    <div class="col-sm-2">
    <input type="text" class=" form-control form-control-sm" id="show_expire_date"  value="{{ $vehicle->expire_date ?? '' }}" placeholder="Enter Expire Date" name="expire_date" readonly="readonly" >
    <input type="hidden" id="expire_date" value="@if($vehicle->expire_date){{ $vehicle->expire_date }}@else{{\App\Helpers\DateHelper::expDate($vehicle->vehicle_kind_code)}}@endif">
                            
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.model') }}:</label>
    <div class="col-sm-2">
    <select name="model_id" class="form-control form-control-sm js-example-basic-single" id="vmodel" style="width: 100%;" >
        <option value="" selected disabled>Select Model</option>
        @foreach($models as $model)
        <option value="{{$model->id}}" {{$model->id == $vehicle->model_id?'selected':''}}>{{ $model->name}}</option>
        @endforeach
    </select> 
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.veh_mod4_date') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="date form-control form-control-sm" id="import_permit_date" value="{{ $vehicle->import_permit_date }}" placeholder="Enter Import Permit Data" name="import_permit_date" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.tax50') }}:</label>
    <div class="col-sm-2">
    <input type="checkbox" class="form-check-input"  value="1" name="tax_50" {{$vehicle->tax_50 ==1?'checked':'' }}  >
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('module4.pre_lic_no') }}:</label>
    <div class="col-sm-2">
    <div id="wrapper-license">
    <input type="text" style="width: 70px;margin:3px;height: 20px !important;" class="form-control form-control-sm  @if($vehicle->vehicle_kind_code == 2 || $vehicle->vehicle_kind_code==5 || $vehicle->vehicle_kind_code ==8) Vehkind1 @elseif($vehicle->vehicle_kind_code ==1)Vehkind2 @elseif($vehicle->vehicle_kind_code ==3)Vehkind3 @elseif($vehicle->vehicle_kind_code==4)Vehkind4 @elseif($vehicle->vehicle_kind_code==6)Vehkind5 @else noVehKind @endif "   id="licence_no" @if($vehicle->licence_no) value="{{ $vehicle->licence_no}}" @elseif (\App\Helpers\Helper::getBuyLicNo($vehicle->id, $vehicle->vehicle_kind_code) != null) value="{{ \App\Helpers\Helper::getBuyLicNo($vehicle->id, $vehicle->vehicle_kind_code) }}" @else value="" @endif placeholder="" name="licence_no" onpaste="return false;" >
    </div>
    <div>                      
        @if($vehicle->licence_no != null)
            <a id="lic_control_btn" class="disable-btn">A</a>
            @else
            <a id="lic_control_btn" class="@if(isset($app_form_status_id)){{$app_form_status_id == 1 || $app_form_status_id == 2 ?'disable-btn':''}}@endif">A</a>
        @endif
        </div>
        <span id="licError"></span>                              
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.engine_no') }}:</label>
    <div class="col-sm-2">
    <input type="text" id="engine_no" class="form-control form-control-sm eng-validate"  value="{{ $vehicle->engine_no }}" placeholder="Enter Engine No" name="engine_no"  onpaste="return false;">
    </div>
    <label for="colFormLabelSm" class="col-sm-2 px-0 ">2.{{ trans('module4.indus_doc') }}:</label>
    <div class="col-sm-1">
      &nbsp;
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.veh_mod4_no') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm"  value="{{ $vehicle->tax_no }}" placeholder="Enter Tax No" name="tax_no" >
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('module4.purpose') }}:</label>
    <div class="col-sm-2">
    <select name="vehicle_kind_code" class="form-control form-control-sm "  id="vehicle_kind" style="width: 100%;"  >
        <option value="" selected disabled>Select Vehicle Kind</option>
        @foreach($veh_info['kinds'] as $kind)
        <option value="{{$kind->vehicle_kind_code}}" {{$kind->vehicle_kind_code == $vehicle->vehicle_kind_code?'selected':''}}>{{ $kind->name}}</option>
        @endforeach
    </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.chassis_no') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm eng-validate" id="chassis_no" value="{{ $vehicle->chassis_no }}" placeholder="Enter Chassis no" name="chassis_no" onpaste="return false;">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.veh_mod4_no') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm"  value="{{ $vehicle->industrial_doc_no }}" placeholder="Enter Industrial Doc No" name="industrial_doc_no" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.veh_mod4_date') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="date form-control form-control-sm" id="tax_date" value="{{ $vehicle->tax_date }}" placeholder="Enter Tax Data" name="tax_date" >
    </div>
  </div>
  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('common.name') }}:</label>
    <div class="col-sm-2">
    <input type="text" id="owner_name" class="form-control form-control-sm"  value="{{ $vehicle->owner_name }}" placeholder="" name="owner_name" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('module4.width') }}:</label>
    <div class="col-sm-2">
    <input type="number" class="form-control form-control-sm"  value="{{ $vehicle->width }}" placeholder="" name="width" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.veh_mod4_date') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="date form-control form-control-sm" id="industrial_doc_date" value="{{ $vehicle->industrial_doc_date }}" placeholder="Enter Industrial Doc Data" name="industrial_doc_date" >
    </div>
    <label for="colFormLabelSm" class="col-sm-2 px-0 ">6.{{ trans('module4.tax_payment') }}:</label>
    <div class="col-sm-1">
     &nbsp;
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('module4.name2') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm"  value="{{ $vehicle->tenant_name }}" placeholder="" name="tenant_name" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('module4.long') }}:</label>
    <div class="col-sm-2">
    <input type="number" class="form-control form-control-sm"  value="{{ $vehicle->long }}" placeholder="" name="long" >
    </div>
    <label  class="col-sm-2 px-0">3.{{ trans('module4.tech_doc') }}:</label>
    <div class="col-sm-1">
     &nbsp;
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.tax_receipt') }}:</label>
    <div class="col-sm-2">
    <input type="checkbox" class="form-check-input"  value="1" {{$vehicle->tax_receipt ==1?'checked':''}} placeholder="" name="tax_receipt" >
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('module4.village_name') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" id="village_name" value="{{ $vehicle->village_name }}" placeholder="" name="village_name" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('module4.height') }}:</label>
    <div class="col-sm-2">
    <input type="number" class="form-control form-control-sm"  value="{{ $vehicle->height }}" placeholder="" name="height" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.veh_mod4_no') }}.:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm"  value="{{ $vehicle->technical_doc_no }}" placeholder="Enter Technical Doc No" name="technical_doc_no" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.tax_permit') }}:</label>
    <div class="col-sm-2">
    <input type="checkbox" class="form-check-input"  value="1" {{$vehicle->tax_permit ==1?'checked':''}} placeholder="" name="tax_permit" >
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('module4.unit') }}:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control form-control-sm" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('module4.seat') }}:</label>
    <div class="col-sm-2">
    <input type="number" min="1" class="form-control form-control-sm"  id="seat"  value="{{ $vehicle->seat }}" placeholder="" name="seat" >
    <span id="err1" style="display:none; color:red;font-size: 12px;">This input value is not less than 1.</span>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.tech_doc') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="date form-control form-control-sm" id="technical_doc_date" value="{{ $vehicle->technical_doc_date }}" placeholder="Enter Technical Doc Data" name="technical_doc_date" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.veh_mod4_no') }}.:</label>
    <div class="col-sm-2">
    <input type="text" class="date form-control form-control-sm"  value="{{ $vehicle->tax_payment_no }}" placeholder="Enter Tax payment Date" name="tax_payment_no" >
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('common.province') }}:</label>
    <div class="col-sm-2">
    <select name="province_code" class="form-control form-control-sm js-example-basic-single" id="province" style="width: 100%;" >
        <option value="" selected disabled>Select Province</option>
        @foreach($veh_info['provinces'] as $pro)
        <option value="{{$pro->province_code}}" {{$pro->province_code == $vehicle->province_code?'selected':''}}>{{ $pro->name}}</option>
        @endforeach
    </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('module4.wheel') }}:</label>
    <div class="col-sm-2">
    <input type="number" min="1" class="form-control form-control-sm" id="wheel"  value="{{ $vehicle->wheels }}" placeholder="Enter Wheels" name="wheels" >
    <span id="err2" style="display:none; color:red;font-size: 12px;">This input value is not less than 1.</span>
    </div>
    <label for="colFormLabelSm" class="col-sm-2 px-0 ">4.{{ trans('module4.commerce_permit') }}:</label>
    <div class="col-sm-1">
     &nbsp;
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.veh_mod4_date') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="date form-control form-control-sm" id="tax_payment_date" value="{{ $vehicle->tax_payment_date }}" placeholder="Enter Tax payment Date" name="tax_payment_date" >
    </div>
  </div>
  
  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('common.district') }}:</label>
    <div class="col-sm-2">
    <select class="form-control form-control-sm js-example-basic-single" style="width: 100%;" name="district_code" id="district" >
    <option value="" selected disabled hidden>--Select District--</option>
    @foreach($districts as $dis)
    <option value="{{$dis->district_code}}" {{$dis->district_code == $vehicle->district_code?'selected':''}}>{{ $dis->name}}</option>
    @endforeach                 
    </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('module4.weight') }}:</label>
    <div class="col-sm-2">
    <input type="number" class="form-control form-control-sm"  value="{{ $vehicle->weight }}" placeholder="" name="weight" >
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
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.vehicle_type') }}:</label>
    <div class="col-sm-2">
    <select name="vehicle_type_id" id="vehicle_type" class="form-control-sm js-example-basic-single" style="width: 100%;" >
        <option value="" selected disabled>Select Vehicle Type</option>
        @foreach($veh_info['types'] as $type)
        <option value="{{$type->id}}" {{$type->id == $vehicle->vehicle_type_id?'selected':''}}>{{ $type->name}}</option>
        @endforeach
    </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('module4.weight_filled') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm"  value="{{ $vehicle->weight }}" placeholder="" name="weight_filled" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.veh_mod4_no') }}.:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" style="width:135px;float:left;margin-right:27px;"  value="{{ $vehicle->comerce_permit_no }}" placeholder="Enter Commerce Permit No" name="comerce_permit_no" >
    <span><input type="checkbox" value="1"  name="locks"  {{ $vehicle->locks ==1?'checked':'' }}  ></span>
    </div>
   
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.veh_mod4_no') }}.:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm"  value="{{ $vehicle->police_doc_no }}" placeholder="Enter Police Doc No" name="police_doc_no" >
    </div>
  </div>
  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('module4.steering') }}:</label>
    <div class="col-sm-2">
    <select name="steering_id" class="form-control form-control-sm js-example-basic-single" style="width: 100%;" >
        <option value="" selected disabled>Select Steering</option>
        @foreach($veh_info['steerings'] as $steer)
        <option value="{{$steer->id}}" {{$steer->id == $vehicle->steering_id?'selected':''}}>{{ $steer->name}}</option>
        @endforeach
    </select>  
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('module4.total_weight') }}:</label>
    <div class="col-sm-2">
    <input type="number" class="form-control form-control-sm"  value="{{ $vehicle->total_weight }}" placeholder="Total Weight" name="total_weight" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.veh_mod4_date') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="date form-control form-control-sm" id="comerce_permit_date" value="{{ $vehicle->comerce_permit_date }}" placeholder="Enter Commerce Permit Data" name="comerce_permit_date" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.veh_mod4_date') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="date form-control form-control-sm" id="police_doc_date" value="{{ $vehicle->police_doc_date }}" placeholder="Enter Polic Doc Date" name="police_doc_date" >
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('module4.engine_type') }}:</label>
    <div class="col-sm-2">
    <select name="engine_type_id" class="form-control form-control-sm js-example-basic-single" style="width: 100%;" >
        <option value="" selected disabled>Select Engine Type</option>
        @foreach($veh_info['eng_type'] as $eng_type)
        <option value="{{$eng_type->id}}" {{$eng_type->id == $vehicle->engine_type_id?'selected':''}}>{{ $eng_type->name}}</option>
        @endforeach
    </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('module4.axis') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm"  value="{{ $vehicle->axis }}" placeholder="" name="axis" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.lock_no') }}.:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm" id="lock_no"  value="{{ $vehicle->lock_no }}" placeholder="" name="lock_no" >
    </div>
    <label for="colFormLabelSm" class="col-sm-2 px-0 ">8.{{ trans('module4.vehicle_remark') }}:</label>
    <div class="col-sm-1">
      
    </div>
  </div>
  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.log') }}:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control form-control-sm" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.year_mnf') }}:</label>
    <div class="col-sm-2">
    <input type="text" class="form-control form-control-sm date-year"  value="{{ $vehicle->year_manufacture }}" placeholder="" name="year_manufacture" >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.company_lock') }}:</label>
    <div class="col-sm-2">
    <input type="text" id="company_lock" class="date form-control form-control-sm"  value="{{ $vehicle->companylock}}" placeholder="Enter CompanyLock" name="companylock" >
    </div>
  
    <div class="col-sm-3">
    <input type="text" class="form-control form-control-sm"  value="{{ $vehicle->remark }}" placeholder="Enter Vehicle Remark" name="remark" >
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.send') }}:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control form-control-sm" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.motor_brand') }}:</label>
    <div class="col-sm-2">
    <select name="motor_brand_id" class="form-control form-control-sm js-example-basic-single" style="width: 100%;" >
        <option value="" selected disabled>Select Motor Brand</option>
        @foreach($veh_info['moter_brand'] as $mb)
        <option value="{{$mb->id}}" {{$mb->id == $vehicle->motor_brand_id?'selected':''}}>{{ $mb->name}}</option>
        @endforeach
    </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.start_lock') }}:</label>
    <div class="col-sm-2">
    <input type="text" id="startlock" class="form-control form-control-sm"  value="{{ $vehicle->startlock }}" placeholder="" name="startlock" >
    </div>
   
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.inspect_result') }}:</label>
    <div class="col-sm-2">
    <select name="inspect_result" class="form-control form-control-sm"  id="inspect_result">
                <option value="" selected disabled >Select Inspect Result </option>
                @foreach(\App\Model\Vehicle::getEnumList("inspect_result") as $key => $value)
                    <option value="{{$key}}" {{ $vehicle->inspect_result == $key?'selected':'' }}>{{$value}}</option>
                @endforeach
    </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('module4.inspect_issue_date') }}:</label>
    <div class="col-sm-2">
    <input type="text" class=" form-control" id="inspect_issue_date"  value="@if($vehicle->inspect_issue_date) {{ $vehicle->inspect_issue_date}} @else {{date('Y-m-d')}} @endif" placeholder="Enter Inspect Issue Date" name="inspect_issue_date" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.end_lock') }}:</label>
    <div class="col-sm-2">
    <input type="text" id="endlock" class="form-control form-control-sm"  value="{{ $vehicle->endlock }}" placeholder="" name="endlock">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.tel_no') }}.:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control form-control-sm" >
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">{{ trans('module4.inspect_place') }}:</label>
    <div class="col-sm-2">
    <select name="inspect_place" class="form-control form-control-sm"  id="inspect_place">
            <option value="" selected disabled >Select Inspect Result </option>
            @foreach($inspect_places as $inspect_place)
                <option value="{{$inspect_place->id}}" {{ $vehicle->inspect_place == $inspect_place->id?'selected':'' }}>{{$inspect_place->name}}</option>
            @endforeach
    </select>
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> {{ trans('module4.inspect_expire_date') }}:</label>
    <div class="col-sm-2">
    <input type="text" class=" form-control form-control-sm" id="inspect_expire_date"  value="@if($vehicle->inspect_expire_date){{$vehicle->inspect_expire_date}} @else  {{\App\Helpers\DateHelper::inspectDate($app_purpose)}}   @endif" placeholder="Enter Inspect Expire Date" name="inspect_expire_date" readonly>
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.note1') }}:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control form-control-sm"  >
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">{{ trans('module4.note2') }}:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control form-control-sm" >
      <input type="hidden" id="code" value="{{session('code') ?? ''}}">
    </div>
  </div>
  <br/>
  <div class="form-row">
      <div class="col-md-8 col-sm-8"> 
          <a class="btn btn-secondary btn-sm"   href="{{url('/all-vehicles')}}" >{{ trans('button.back') }} </a>
         
          <a class="btn btn-secondary book-print btn-sm  @if(auth()->user()->user_status == 'book_print' || auth()->user()->user_status == 'all') {{$app_form_status_id == 5 || $app_form_status_id == 6?'':'disabled'}} @else disabled @endif" >{{ trans('button.book') }}</a>
         
          <a class="btn btn-secondary btn-sm print-card  @if(auth()->user()->user_status == 'card_print' || auth()->user()->user_status == 'all') {{$app_form_status_id == 4 || $app_form_status_id == 5 || $app_form_status_id == 6?'':'disabled'}} @else disabled @endif" href="scard:{{$vehicle->licence_no}}|{{$vehicle->province->old_name}}|{{ $vehicle->vehicle_kind->name??''}}|{{$vehicle->vehicle_kind->vehicle_kind_code}}|{{ $vehicle->division_no}}|{{$vehicle->province_no}}|{{$vehicle->owner_name}}|{{$vehicle->engine_no}}|{{$vehicle->chassis_no}}|{{$vehicle->vtype->name??''}}|{{ $vehicle->vbrand->name ?? ''}}|{{$vehicle->vmodel->name ?? ''}}|{{$vehicle->color->name??''}}|{{$vehicle->issue_date}}|{{$vehicle->expire_date}}|{{$vehicle->district->name??''}}|{{$vehicle->village_name}}|{{$smart_card_code->code ?? ''}}|{{auth()->user()->name}}|{{$smart_card_code->security_pin ?? ''}}|{{$vehicle->id}}|{{auth()->id()}}|{{$vehicle->province->abb}}|{{$vehicle->province->abb_en}}">{{ trans('button.card') }}</a>
         
          <a  class="btn btn-secondary btn-sm transfer  @if(auth()->user()->user_status == 'all') {{$app_form_status_id == 1 ||$app_form_status_id == 2 ?'':''}} @else disabled @endif"  data-toggle="modal" data-target="#transferModal"  data-id="">{{ trans('button.transfer') }}</a>
         
          <a class="btn btn-secondary btn-sm @if(auth()->user()->user_status == 'card_print' || auth()->user()->user_status == 'all' || auth()->user()->user_status == 'book_print' || auth()->user()->user_status == 'license_control') @else disabled @endif" href="#" onclick="jQuery('#document-certificate').print()">Document Certificates</a>
         
          <a class="btn btn-secondary btn-sm @if(auth()->user()->user_status == 'card_print' || auth()->user()->user_status == 'all' || auth()->user()->user_status == 'book_print' || auth()->user()->user_status == 'license_control') @else disabled @endif" href="#" onclick="jQuery('#damaged-certificate').print()">Damaged Certificate</a>
          <a class="btn btn-secondary btn-sm mt-2 @if(auth()->user()->user_status == 'card_print' || auth()->user()->user_status == 'all' || auth()->user()->user_status == 'book_print' || auth()->user()->user_status == 'license_control') @else disabled @endif" href="#" onclick="jQuery('#certificate').print()">{{ trans('button.certificate') }}</a>
          <a class="btn btn-secondary btn-sm mt-2 @if(auth()->user()->user_status == 'card_print' || auth()->user()->user_status == 'all' || auth()->user()->user_status == 'book_print' || auth()->user()->user_status == 'license_control') @else disabled @endif" href="#" onclick="jQuery('#certificate-used').print()">Certificate Used Instead</a>
          <a class="btn btn-secondary btn-sm mt-2  @if(auth()->user()->user_status == 'card_print' || auth()->user()->user_status == 'all' || auth()->user()->user_status == 'book_print' || auth()->user()->user_status == 'license_control') @else disabled @endif" href="#" onclick="jQuery('#elimination-license').print()">Elimination License</a>
          <a class="btn btn-secondary btn-sm mt-2  @if(auth()->user()->user_status == 'card_print' || auth()->user()->user_status == 'all' || auth()->user()->user_status == 'license_control') @else disabled @endif"   href="#" onclick="jQuery('#printPaper2').print()" >Pink1</a>
          <a class="btn btn-secondary btn-sm mt-2 @if(auth()->user()->user_status == 'card_print' || auth()->user()->user_status == 'all' || auth()->user()->user_status == 'license_control') @else disabled @endif"   href="#" onclick="jQuery('#Pink2').print()" >Pink2</a>
          
      </div>
      <div class="col-md-2 col-sm-2">
      @if($form_type == "veh_type")<a href="" class="btn btn-secondary btn-sm  @if(auth()->user()->user_status == 'all') {{$vehicle->locks == 1?'disabled':''}} @if($app_form_status_id) {{$app_form_status_id == 7?'':'disabled'}} @else @endif @else disabled @endif"  data-toggle="modal" data-target="#PinkPaperNewForm"  data-id="">Pink Paper & New Form</a>  @endif
      @if($form_type == "veh_type")<a class="btn btn-secondary mt-2 btn-sm @if(auth()->user()->user_status == 'all') {{$vehicle->locks == 1?'disabled':''}} @if($app_form_status_id) {{$app_form_status_id == 7?'':'disabled'}} @else @endif @else disabled @endif"  data-toggle="modal" data-target="#NewForm" @if($app_form_status_id) data-app_form_status="" @else data-app_form_status="new_form" @endif  data-id="" href="#">New  Form</a>@endif
          
      </div>
    
      <div class="col-md-2 col-sm-2" >  
      <a href="/all-vehicles" class="btn btn-secondary btn-sm" style="margin-left:28px;">{{trans('button.cancel')}}</a>
      <button type="submit" class=" btn btn-success btn-sm">{{trans('button.save')}}</button>
      <input type="hidden" name="app_id" value="{{ $app_id}}">
      <input type="hidden" name="app_form_status_id" value="{{ $app_form_status_id ?? ''}}">
      </div>
  </div>
</form>

@include('Module4.Vehicle.TransferModal',['vehicle' => $vehicle, 'app_form' => $app_form]) 
@include('Module4.Vehicle.NewAppFormModal',['vehicle_id' => $vehicle->id]) 
@include('Module4.Vehicle.PinkpaperNewForm',['vehicle_id' => $vehicle->id]) 

@push('page_scripts')
<script>
 var dist_url="{{url('/getdistrict/')}}";
var get_vmodal="{{url('/getVmodel/')}}";
var check_vehicle_type = "{{url('/check-vehicle-type/')}}";
$("#division_no, #province_no, #licence_no").keydown(function(event) { 
    return false;
});
if($("#user_status").val() == "license_control"){
    $('#vehicle_kind, #division_no, #province_no, #serial,#show_issue_date, #show_expire_date, #inspect_issue_date, #inspect_expire_date, #lock_no, #company_lock,#startlock, #endlock').attr('readonly',true);
    $("#inspect_place, #inspect_result").attr('disabled',true);
}else if($("#user_status").val() == "card_print"){
    $("#division_no, #province_no, #show_issue_date #show_expire_date #licence_no #vehicle_kind #owner_name #village_name #district #province #vehicle_type #color #vbrand #engine_no #chassis_no").prop('required',true);
    $('#inspect_place, #inspect_result, #inspect_issue_date, #inspect_expire_date, #lock_no, #company_lock,#startlock, #endlock').attr('disabled',true);  
}else if($("#user_status").val() == "book_print"){
    $('input[type="text"], input[type="number"],input[type="checkbox"],select').not('#inspect_issue_date,#inspect_expire_date,#inspect_place,#inspect_result, #licence_no').attr('readonly', true);
    
}else if($("#user_status").val() == "lock_vehicle"){
 
    $('input[type="text"], input[type="number"],input[type="checkbox"],select').not('#lock_no, #company_lock,#startlock, #endlock, #licence_no').attr('readonly', true);
     
}
//check vehicle_type and license no exist or not in license no present table
$('#vehicle_type').change(function(){
    var vehicle_type = $(this).val(); 
    var license_no = $("#licence_no").val();
  
    if(vehicle_type != null && license_no !=null){
        $.ajax({
           type:"POST",
            url:check_vehicle_type+ "/"+vehicle_type,
            data:{license_no:license_no},
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}" },
           success:function(data){  
            if(data == "exist"){
                alert('This License no and vehicle type already exist.');
                location.reload();
                return false;
              }
           }
        });
    }    
   });
   $("#vehicle_kind").change(function(){
    $("#licence_no").val("");
    var app_id =  $('[name="app_id"]').val();
    var veh_kind = $(this).val();
    changeColor(veh_kind);
    if(app_id){
      $.ajax({
                type:'GET',
                url:'/getBuyLicenseNo/' + app_id,
                data:{vehicle_kind: veh_kind},
                success:function(data){
                  console.log(data);
                  if(data == "not-exist"){
                    $("#lic_control_btn").removeClass("disable-btn");
                    }else{
                      $("#licence_no").val(data);
                        $("#lic_control_btn").addClass('disable-btn');
                      
                    }
                    
                }
            });
    }
   });
  
   
   function changeColor(veh_kind)
   {
    $("#licence_no").removeClass("noVehKind");
    switch(veh_kind){
      case "1":
      $("#licence_no").removeClass("Vehkind1 Vehkind3 Vehkind4 Vehkind5 noVehKind");
      $("#licence_no").addClass("Vehkind2");
      break;
      case "2":
      case "5":
      case "8":
      $("#licence_no").removeClass("Vehkind2 Vehkind3 Vehkind4 Vehkind5 noVehKind");
      $("#licence_no").addClass("Vehkind1");
      break;
      
      case "3":
      $("#licence_no").removeClass("Vehkind1 Vehkind2 Vehkind4 Vehkind5 noVehKind");
      $("#licence_no").addClass("Vehkind3");
      break;
      case "4":
      $("#licence_no").removeClass("Vehkind1 Vehkind2 Vehkind3 Vehkind5 noVehKind");
      $("#licence_no").addClass("Vehkind4");
      break;
      case "6":
        $("#licence_no").removeClass("Vehkind1 Vehkind2 Vehkind3 Vehkind4 noVehKind");
      $("#licence_no").addClass("Vehkind5");
      break;
      default: 
      $("#licence_no").addClass("noVehKind");
    }
     
   }
  
  //print vehicle transfer
  $(document).on('click','.btn-print-transfer', function(e){
    jQuery('#printTransfer').print();
    $('#transferModal,.modal-backdrop').hide();
     

  });
//show transfer modal after successful transfer
  $(document).ready(function(){
    if($("#code").val() == 1){
      $('#transferModal').modal('show');
    }
  });

  //change issue date
  $("#show_issue_date").change(function() {
  
    var issue_date = new Date($(this).val());
    var year  = new Date(issue_date).getFullYear();
    var month = new Date(issue_date).getMonth();
    var day   = new Date(issue_date).getDate();
    var vehicle_kind = $("#vehicle_kind").val();
    if(vehicle_kind == 5){
      var add_year  = new Date(year + 2, month, day);
    } else if(vehicle_kind == 8) {
      var add_year  = new Date(year + 1, month, day);
    } else {
      var add_year  = new Date(year + 5, month, day);
    }
    
    var expire = changeFormatDate(add_year);
    $("#show_expire_date").val(expire);
  });

  //format date from js date to yyyy-mm-d format
  function changeFormatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}
$('#engine_no, #chassis_no').keyup(function() {
            if (this.value.match(/[^a-zA-Z0-9]/g)) {
                this.value = this.value.replace(/[^a-zA-Z0-9]/g,'');
            }
        });
</script>
<script src="{{ asset('js/numvalidate.js') }}"></script>
<script src="{{ asset('js/filevalidate.js') }}"></script>
@endpush


