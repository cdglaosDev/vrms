<style>
    #veh_over label {
        width: 35%;
    }

    #veh_over input,
    #veh_over textarea, #veh_over select {
        width: 64%;
    }
</style>
@php
$vtype = \App\Model\VehicleType::whereStatus(1)->get();
$vbrand = \App\Model\VehicleBrand::whereStatus(1)->get();
$vmodel = \App\Model\VehicleModel::whereStatus(1)->get();
$vcolor = \App\Model\Color::whereStatus(1)->get();
$vsteering = \App\Model\Steering::whereStatus(1)->get();
@endphp
<div class="card-body" style="padding: 5px 10px 5px 10px;">
    @include('flash')
    <form action="" method="POST" enctype="multipart/form-data" style="width: 100%; height: 100%;">
        @method('post')
        @csrf

        <input type="hidden" id="v_over_system_id" @if(isset($vehicle_over_system)) value="{{ $vehicle_over_system->id ?? '0' }}" @else value="{{ 0 }}" @endif>
        <input type="hidden" id="operation" value="{{ $operation }}">
        <!--================================== Control ==================================-->
        <div id="veh_over">
            <div class="row mb-2">
                <label for="certificate_no">{{ trans('module4.veh_mod4_no') }}:</label>
                <input type="text" class="form-control" name="certificate_no" id="certificate_no" @if(isset($vehicle_over_system)) value="{{ $vehicle_over_system->certificate_no ?? '' }}" @endif title="{{ trans('module4.veh_mod4_no')}}" style="margin:0px;">
            </div>

            <div class="row mb-2">
                <label for="date">{{ trans('module4._date') }}:</label>
                <input type="text" class="form-control custom_date" name="date" id="date" maxlength="10" @if(isset($vehicle_over_system)) value="{{ $vehicle_over_system->date ?? '' }}" @endif title="{{ trans('module4._date') }}" autocomplete="false" autofill="off">
            </div>

            <div class="row mb-2">
                <label for="vehicle_type_id">{{ trans('module4.v_type') }}:</label>
                <select class="form-control" name="vehicle_type_id" id="vehicle_type_id" title="{{ trans('module4.v_type') }}">
                    <option value="" selected disabled hidden>-- Vehicle Type --</option>
                    @foreach($vtype as $vt)
                    <option value="{{$vt->id}}" @if(isset($vehicle_over_system)) {{$vt->id== ($vehicle_over_system->vehicle_type_id ?? '')?"selected":""}} @endif>{{ $vt->name }}&nbsp;({{$vt->name_en}})</option>
                    @endforeach
                </select>
            </div>

            <div class="row mb-2">
                <label for="engine_no">{{ trans('module4.engine_no') }}:</label>
                <input type="text" class="form-control eng-validate" name="engine_no" id="engine_no" @if(isset($vehicle_over_system)) value="{{ $vehicle_over_system->engine_no ?? '' }}" @endif title="{{ trans('module4.engine_no') }}" onchange="this.value = this.value.replace(/[\;\:\.\,\/\\\s]/g, &quot;&quot;).toUpperCase()" onpaste="return false;"><br>
            </div>
            <div class="row mb-2">
                <label for="chassis_no">{{ trans('module4.chassis_no') }}:</label>
                <input type="text" class="form-control eng-validate" name="chassis_no" id="chassis_no" @if(isset($vehicle_over_system)) value="{{ $vehicle_over_system->chassis_no ?? '' }}" @endif title="{{ trans('module4.chassis_no') }}" onchange="this.value = this.value.replace(/[\;\:\.\,\/\\\s]/g, &quot;&quot;).toUpperCase()"><br>
            </div>

            <div class="row mb-2">
                <label for="year_manufacture">{{ trans('module4.year_of_mnf') }}:</label>
                <input type="text" class="form-control date-year" name="year_manufacture" id="year_manufacture" @if(isset($vehicle_over_system)) value="{{ $vehicle_over_system->year_manufacture ?? '' }}" @endif title="{{ trans('module4.year_of_mnf') }}" maxlength="5">
            </div>
            <div class="row mb-2">
                <label for="origin">{{ trans('module4.country_origin') }}:</label>
                <input type="text" class="form-control" name="origin" id="origin" @if(isset($vehicle_over_system)) value="{{ $vehicle_over_system->origin ?? '' }}" @endif title="{{ trans('module4.country_origin') }}" maxlength="50">
            </div>

            <div class="row mb-2">
                <label for="brand_id">{{ trans('module4.brand') }}:</label>
                <select class="form-control" name="brand_id" id="brand_id" title="{{ trans('module4.brand') }}">
                    <option value="" selected disabled hidden>--Select Vehicle Brand--</option>
                    @foreach($vbrand as $vb)
                    <option value="{{$vb->id}}" @if(isset($vehicle_over_system)) {{$vb->id== ($vehicle_over_system->brand_id ?? '')?"selected":""}} @endif>{{ $vb->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="row mb-2">
                <label for="model_id">{{ trans('module4.model') }}:</label>
                <select class="form-control" name="model_id" id="model_id" title="{{ trans('module4.model') }}">
                    <option value="" selected disabled hidden>--Select Vehicle Modal--</option>
                    @foreach($vmodel as $vm)
                    <option value="{{$vm->id}}" @if(isset($vehicle_over_system)) {{$vm->id== ($vehicle_over_system->model_id ?? '')?"selected":""}} @endif>{{ $vm->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="row mb-2">
                <label for="cc">{{ trans('module4.cc') }}:</label>
                <input type="text" class="form-control" name="cc" id="cc" @if(isset($vehicle_over_system)) value="{{ $vehicle_over_system->cc ?? '' }}" @endif title="{{ trans('module4.cc') }}" maxlength="5" style="margin-left: 0px;font-size: 14px;font-weight: normal;">
            </div>

            <div class="row mb-2">
                <label for="color_id">{{ trans('module4.traffic_color') }}:</label>
                <select class="form-control" name="color_id" id="color_id" title="{{ trans('module4.traffic_color') }}">
                    <option value="" selected disabled hidden>--Select Color--</option>
                    @foreach($vcolor as $vco)
                    <option value="{{$vco->id}}" @if(isset($vehicle_over_system)) {{$vco->id== ($vehicle_over_system->color_id ?? '')?"selected":""}} @endif>{{ $vco->name }}&nbsp;({{$vco->name_en}})</option>
                    @endforeach
                </select>
            </div>

            <div class="row mb-2">
                <label for="steering_id">{{ trans('module4.steering_wheel') }}:</label>
                <select class="form-control" name="steering_id" id="steering_id" title="{{ trans('module4.steering_wheel') }}">
                    <option value="" selected disabled hidden>--Select Steering Wheel--</option>
                    @foreach($vsteering as $vs)
                    <option value="{{$vs->id}}" @if(isset($vehicle_over_system)) {{$vs->id== ($vehicle_over_system->steering_id ?? '')?"selected":""}} @endif>{{ $vs->name }}&nbsp;({{$vs->name_en}})</option>
                    @endforeach
                </select>
            </div>

            <div class="row mb-2">
                <label for="note">{{ trans('module4.additional_desc') }}:</label>
                <textarea class="form-control" name="note" id="note" title="{{ trans('module4.additional_desc') }}">@if(isset($vehicle_over_system)){{ $vehicle_over_system->note ?? '' }}@endif</textarea>
            </div>
           
        </div>

        <!--================================== Buttons ==================================-->
        <div class="row pt-1">
            <div class="col-md-6 col-sm-6"></div>
            <div class="col-md-3 col-sm-3" style="padding-right: 0px;">
                <a style="width: 100%;" class="btn btn-outline-secondary" href="#" id="save_v_over_system">{{ trans('button.save')}}</a>
            </div>

            <div class="col-md-3 col-sm-3" style="padding-right: 5px;">
                <a id="v_over_system_print" style="width: 100%;" title="Print Document Certificate" class="btn btn-outline-secondary @if($operation == 'new')disabled @endif" href="#" 
                onclick="documentCertificateForOverSystem(this)">{{ trans('button.print') }}
                </a>
            </div>
        </div>
    </form>
</div>

<script src="{{asset('vrms2/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('vrms2/js/vehicle-datepicker.js') }}"></script>