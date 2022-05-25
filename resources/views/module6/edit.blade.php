@extends('vrms2.layouts.master')
@section('passport_list','active') 
@section('content') 
@php
$veh_purpose_yellow = \App\Model\VehiclePurpose::whereType('y')->pluck('id','name_en'); 
$veh_purpose_green = \App\Model\VehiclePurpose::whereType('g')->pluck('id','name_en'); 
$veh_purpose_pink = \App\Model\VehiclePurpose::whereType('p')->pluck('id','name_en'); 
$models = \App\Model\VehicleModel::whereStatus(1)->whereBrandId($vehicle->brand_id)->get(); 
$dists = \App\Model\District::whereStatus(1)->whereProvinceCode($vehicle->province)->get(); 
@endphp
<h3>{{trans('title.edit_reg')}}</h3>
<div class="card-body">
   <form id="register" method="POST" action="{{route('vehicle-passport.update',[$vehicle->id])}}">
      {{ csrf_field() }} @method('PATCH')
      <div class="card-body">
         <div class="form-row">
            <div class="col-md-3 mb-3">
               <label for="validationCustom02">{{ trans('register.license_no')}}</label>
               <input type="text" class="form-control" id="validationCustom02" name="license_no" placeholder="Enter License No." value="{{$vehicle->license_no !=null?$vehicle->license_no:''}}">
               <div class="valid-feedback"> Looks good! </div>
            </div>
            <div class="col-md-3 mb-3">
               <label for="validationCustomUsername">{{ trans('register.name')}}(Lao)</label>
               <div class="">
                  <input type="text" class="form-control" id="validationCustomUsername" placeholder="Enter Owner Name" value="{{$vehicle->name !=null?$vehicle->name:''}}" name="name" required="">
                  <div class="invalid-feedback"> Please choose a username. </div>
               </div>
            </div>
            <div class="col-md-3 mb-3">
               <label for="validationCustomUsername">{{ trans('register.name')}}(Eng)</label>
               <div class="">
                  <input type="text" class="form-control" id="validationCustomUsername" placeholder="Enter Owner Name" value="{{$vehicle->name_en !=null?$vehicle->name_en:''}}" name="name_en" required="">
                  <div class="invalid-feedback"> Please choose a username. </div>
               </div>
            </div>
            <div class="col-md-3 mb-3">
               <label for="validationCustomUsername">{{ trans('register.telephone')}}</label>
               <div class="">
                  <input type="number" class="form-control" id="validationCustomUsername" placeholder="Enter Telephone" value="{{$vehicle->telephone !=null?$vehicle->telephone:''}}" name="telephone">
                  <div class="invalid-feedback"> Please choose a username. </div>
               </div>
            </div>
         </div>
         <div class="form-row">
            <div class="col-md-3 col-sm-3 mb-2">
               <label>{{trans('register.veh_purpose')}}</label>
               <div class="">
                  <select id="vehicle-purpose" name="vehicle_purpose_id" class="form-control js-example-basic-single" style="width: 100%;" data-size="20" required="">
                     <option value="" selected disabled>Select Vehicle Purpose</option>
                     <optgroup class="pl-3" label="Yellow Book"> @foreach($veh_purpose_yellow as $key=>$value)
                        <option value="{{ $value }}" {{ $vehicle->vehicle_purpose_id == $value?'selected':''}}>{{ $key}}</option> @endforeach 
                     </optgroup>
                     <optgroup class="pl-3" label="Green Book"> @foreach($veh_purpose_green as $key=>$value)
                        <option value="{{ $value }}" {{ $vehicle->vehicle_purpose_id == $value?'selected':''}}>{{ $key}}</option> @endforeach 
                     </optgroup>
                     <optgroup class="pl-3" label="Pink Book"> @foreach($veh_purpose_pink as $key=>$value)
                        <option value="{{ $value }}" {{ $vehicle->vehicle_purpose_id == $value?'selected':''}}>{{ $key}}</option> @endforeach 
                     </optgroup>
                  </select>
               </div>
            </div>
            <div class="col-md-3 mb-3">
               <label for="validationCustom02">{{ trans('register.vehicletype')}}</label>
               <div class="">
                  <select class="form-control js-example-basic-single" style="width: 100%;"  name="vehicle_type_id" required="">
                     <option value="" selected disabled>--Select Vehicle Type--</option>
                     @foreach($data['types'] as $type)
                     <option value="{{$type->id}}" @if($vehicle->vehicle_type_id == $type->id) selected="selected" @endif>{{ $type->name }}({{$type->name_en}})</option> @endforeach 
                  </select>
               </div>
            </div>
            <div class="col-md-3 mb-3">
               <label for="validationCustomUsername">{{ trans('register.make')}}</label>
               <div class="">
                  <select class="form-control js-example-basic-single" style="width: 100%;"  name="brand_id" id="vbrand" required="">
                     <option value="" selected disabled>--Select Vehicle Brand--</option>
                     @foreach( $data['brands'] as $brand)
                     <option value="{{$brand->id}}" @if($vehicle->brand_id == $brand->id) selected="selected" @endif>{{ $brand->name }}({{$brand->name_en}})</option> @endforeach 
                  </select>
               </div>
            </div>
            <div class="col-md-3 mb-3">
               <label for="validationCustomUsername">{{ trans('register.model')}}</label>
               <div class="">
                  <select class="form-control js-example-basic-single" style="width: 100%;"   name="model_id" id="vmodel" required="">
                     <option value="" selected disabled>--Select Vehicle Model--</option>
                     @foreach( $models as $model)
                     <option value="{{$model->id}}" @if($vehicle->model_id == $model->id) selected="selected" @endif>{{ $model->name }}({{$model->name_en}})</option> @endforeach 
                  </select>
               </div>
            </div>
         </div>
         <div class="form-row">
            <div class="col-md-3 mb-3">
               <label for="validationCustom01">{{ trans('register.color')}}</label>
               <div class="">
                  <select class="form-control js-example-basic-single" style="width: 100%;"  name="color_id">
                     <option value="" disabled>--Select Color--</option>
                     @foreach($data['colors'] as $co)
                     <option value="{{$co->id}}" {{$vehicle->color_id ==$co->id?"Selected":''}}>{{ $co->name }}&nbsp;({{$co->name_en}})</option> @endforeach 
                  </select>
               </div>
            </div>
            <div class="col-md-3 mb-3">
               <label for="validationCustom02">{{ trans('register.motor_make')}}</label>
               <div class="">
                  <select class="form-control js-example-basic-single" style="width: 100%;" name="engine_brand_id" required>
                     <option value="" selected disabled>--Select Engine Brand--</option>
                     @foreach($data['moter_brand'] as $engine)
                     <option value="{{$engine->id}}" @if($vehicle->engine_brand_id == $engine->id) selected="selected" @endif>{{ $engine->name }}&nbsp;({{$engine->name_en}})</option> @endforeach 
                  </select>
               </div>
            </div>
            <div class="col-md-3 mb-3">
               <label for="validationCustomUsername">{{ trans('register.engine_no')}}</label>
               <input type="text" class="form-control" id="validationCustomUsername" placeholder="Enter Engine No" value="{{$vehicle->engine_no ?? ''}}" name="engine_no"> 
            </div>
            <div class="col-md-3 mb-3">
               <label for="validationCustomUsername">{{ trans('register.chassis_no')}}</label>
               <input type="text" class="form-control" id="validationCustomUsername" placeholder="Enter Chaasis no." value="{{$vehicle->chassis_no ?? ''}}" name="chassis_no">
               <div class="invalid-feedback"> Please choose a username. </div>
            </div>
         </div>
         <div class="form-row">
            <div class="col-md-3 mb-3">
               <label for="validationCustom01">{{ trans('register.width')}}</label>
               <input type="number" class="form-control" id="validationCustom01" name="width" placeholder="Enter Width" value="{{$vehicle->width ?? ''}}">
               <div class="valid-feedback"> Looks good! </div>
            </div>
            <div class="col-md-3 mb-3">
               <label for="validationCustom02">{{ trans('register.height')}}</label>
               <input type="number" class="form-control" id="validationCustom02" name="height" placeholder="Enter Height" value="{{$vehicle->height ?? ''}}">
               <div class="valid-feedback"> Looks good! </div>
            </div>
            <div class="col-md-3 mb-3">
               <label for="validationCustomUsername">{{ trans('register.length')}}</label>
               <input type="number" class="form-control" id="validationCustomUsername" placeholder="Enter Length" value="{{$vehicle->long ?? ''}}" name="long">
               <div class="invalid-feedback"> Please choose a username. </div>
            </div>
            <div class="col-md-3 mb-3">
               <label for="validationCustomUsername">{{ trans('register.seats')}}</label>
               <input type="number" class="form-control" id="validationCustomUsername" placeholder="Number of Seats" name="seat" value="{{$vehicle->seat ?? ''}}">
               <div class="invalid-feedback"> Please choose a username. </div>
            </div>
         </div>
         <div class="form-row">
            <div class="col-md-3 mb-3">
               <label for="validationCustom01">{{ trans('register.weight_empty')}}</label>
               <input type="text" class="form-control" id="validationCustom01" name="total_weight" placeholder="Net weight" value="{{$vehicle->total_weight ?? ''}}">
               <div class="valid-feedback"> Looks good! </div>
            </div>
            <div class="col-md-3 mb-3">
               <label for="validationCustomUsername">{{ trans('register.swheel')}}</label>
               <div class="">
                  <select name="steering" class="form-control " style="width: 100%;" required>
                     <option value="" selected disabled>--Select Steering--</option>
                     @foreach( $data['steerings'] as $steer)
                     <option value="{{$steer->name_en}}" {{$vehicle->steering== $steer->name_en?'selected':''}}>{{ $steer->name }}&nbsp;({{$steer->name_en}})</option>
                     @endforeach 
                  </select>
               </div>
            </div>
            <div class="col-md-3 mb-3">
               <label for="validationCustomUsername">{{ trans('register.cylinder')}}</label>
               <div class="">
                  <input type="text" class="form-control" id="validationCustomUsername" name="cylinder" placeholder="Number of Cylinder" value="{{$vehicle->cylinder ?? ''}}" aria-describedby="inputGroupPrepend"> 
               </div>
            </div>
            <div class="col-md-3 mb-3">
               <label for="validationCustomUsername">{{ trans('register.unit')}}</label>
               <input type="text" class="form-control" id="validationCustomUsername" placeholder="Enter Unit" name="unit" value="{{$vehicle->unit ?? ''}}">
               <div class="invalid-feedback"> Please choose a username. </div>
            </div>
         </div>
         <div class="form-row">
            <div class="col-md-3 mb-3">
               <label for="validationCustom01">{{ trans('register.street')}}</label>
               <input type="text" class="form-control" id="validationCustom01" name="street" placeholder="Street" value="{{$vehicle->street  ?? ''}}">
               <div class="valid-feedback"> Looks good! </div>
            </div>
            <div class="col-md-3 mb-3">
               <label for="validationCustomUsername">{{ trans('register.province')}}</label>
               <div class="">
                  <select class="form-control js-example-basic-single"  style="width: 100%;" id="province" name="province" required readonly>
                     <option value="" disabled>--Select Province--</option>
                     @foreach($data['provinces'] as $pro)
                     <option value="{{$pro->province_code}}" @if($vehicle->province == $pro->province_code) selected="selected" @endif>{{ $pro->name }}&nbsp;({{$pro->name_en}})</option> @endforeach 
                  </select>
               </div>
            </div>
            <div class="col-md-3 mb-3">
               <label for="validationCustom02">{{ trans('register.district')}}</label>
               <div class="">
                  <select class="form-control js-example-basic-single" style="width: 100%;" name="district" id="district" required>
                     <option value="" disabled>--Select District--</option>
                     @if(isset($vehicle->district)) @foreach($dists as $dis)
                     <option value="{{$dis->district_code}}" @if($vehicle->district == $dis->district_code) selected="selected" @endif>{{ $dis->name }}&nbsp;({{$dis->name_en}})</option> 
                     @endforeach @else @endif
                  </select>
               </div>
            </div>
            <div class="col-md-3 mb-3">
               <label for="validationCustomUsername">{{ trans('register.village')}}</label>
               <input type="text" name="village" class="form-control" value="{{$vehicle->village ?? ''}}" placeholder="Enter Village Name"> 
            </div>
         </div>
         <div class="form-row">
            <div class="col-md-3 mb-3">
               <label for="validationCustom01">{{ trans('register.issue_date')}}</label>
               <input type="text" class="form-control" id="validationCustom01" name="issue_date" placeholder="Date" value="{{ Carbon\Carbon::parse($vehicle->issue_date)->format('d-m-Y') }}" required readonly=""> 
            </div>
            <div class="col-md-3 mb-3">
               <label for="validationCustom02">{{ trans('register.expire_date')}}</label>
               <input type="text" id="datetime" class=" form-control" id="datetime" name="expire_date" placeholder="Expire Date" value="{{ Carbon\Carbon::parse($vehicle->expire_date)->format('d-m-Y') }}" required> 
            </div>
            <div class="col-md-3 mb-3">
               <label for="validationCustomUsername">{{ trans('register.doneat')}}</label>
               <div class="">
                  <select class="form-control js-example-basic-single" style="width: 100%;"  name="doneat">
                     <option value="" disabled>--Select Province--</option>
                     @foreach($data['provinces'] as $prov)
                     <option value="{{$prov->province_code}}" {{$vehicle->doneat==$prov->province_code?"Selected":''}}>{{ $prov->name }}&nbsp;({{$prov->name_en}})</option> @endforeach 
                  </select>
               </div>
            </div>
            <div class="col-md-3 mb-3">
               <label for="validationCustom02">{{ trans('register.fax')}}</label>
               <div class="">
                  <input type="text" class="form-control" id="validationCustom02" name="fax" placeholder="Fax" value="{{$vehicle->fax ?? ''}}"> 
               </div>
            </div>
         </div>
         <div class="form-row">
            <div class="col-md-3 col-sm-3">
               <label for="validationCustomUsername">{{ trans('register.cc')}}</label>
               <div class="">
                  <input type="text" class="form-control" id="validationCustomUsername" placeholder="CC" name="cc" value="{{$vehicle->cc ?? ''}}"> 
               </div>
            </div>
            <div class="col-md-3 col-sm-3">
               <label> {{trans('register.book_no_ref')}} </label>
               <input type="text" class="form-control" id="validationCustomUsername" placeholder="Enter Book Number Ref" name="book_no_ref" value="{{$vehicle->book_no_ref ?? ''}}"> 
            </div>
            <div class="col-md-6 col-sm-6">
               <div class="col-md-8 mb-8">
                  <label for="validationCustom01">{{trans('register.book_no')}} (format: 01-000001-2020)</label>
               </div>
               <div class="row">
                  <div class="col-sm-4">
                     <label for="validationCustom01">Province Code</label>
                     <input type="text" name="pro_code" id="pro_code" value="{{$vehicle->pro_code}}" class="form-control" readonly="" required=""> 
                  </div>
                  <div class="col-sm-4">
                     <label for="validationCustom01"> Code</label>
                     <input type="number" name="code_no" id="book_code" class="form-control" value="{{$vehicle->code_no}}" readonly=""> 
                  </div>
                  <div class="col-sm-2">
                     <label for="validationCustom01">Year</label>
                     <input type="text" name="year" class="form-control" value="{{$vehicle->year}}" readonly=""> 
                  </div>
               </div>
            </div>
         </div>
         <div class="form-row">
            <div class="col-md-12 mb-12">
               <label for="validationCustom01">{{ trans('register.remark')}}</label>
               <textarea name="remark" rows="3" class="form-control">{{$vehicle->remark ?? ''}}</textarea>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-6 ">
            <a href="{{ url('/vehicle-passport') }}" class="btn btn-secondary btn-sm">{{ trans('button.back') }}</a>
         </div>
         <div class="col-md-6 text-right">
            <a href="{{url('print',$vehicle->id)}}" class="btn btn-secondary btn-sm">{{trans('button.print')}}</a>
            <button class="btn btn-success btn-sm" type="submit">{{trans('button.save')}}</button>
         </div>
      </div>
   </form>
</div>
@endsection 
@push('page_scripts')
<script type="text/javascript">
   var getCode = "{{url('getCode')}}";
   var dist_url = "{{url('getDistrict')}}";
   var get_vmodal = "{{url('getVmodel')}}";
</script>
<script type="text/javascript" src="{{asset('vrms2/js/dropdownlist.js')}}"></script>
<!-- <script type="text/javascript" src="{{asset('js/book_no.js')}}"></script> -->
<script src="{{asset('vrms2/js/jquery.validate.min.js')}}"></script>
<script>
   $('#register').validate({
   	rules: {
   		province: "required",
   	},
   	messages: {
   		province: "Province is required.",
   	},
   });
</script> @endpush