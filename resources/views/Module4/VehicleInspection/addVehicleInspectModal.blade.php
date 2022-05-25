<style>
    #inspect-info label {
        width: 30%;
    }

    #inspect-info input,
    #inspect-info select {
        width: 70%;
    }
</style>
@php
$inspect_place_list = \App\Model\InspectPlace::whereStatus(1)->get();
$inspect_rsult_list = \App\Model\Vehicle::$generalenum;
@endphp
<div class="card-body" style="padding: 15px 26px 20px 26px;">
    @include('flash')
    <form action="" method="POST" enctype="multipart/form-data" style="width: 100%; height: 100%;">
        @method('post')
        @csrf

        <input type="hidden" value="{{ $vehicle_id }}" name="vehicle_id" id="vehicle_id">
        <input type="hidden" value="{{ $vehicle_inspection_id }}" name="vehicle_inspection_id" id="vehicle_inspection_id">
        <input type="hidden" value="{{ $operation }}" name="operation" id="operation">
        <!--================================== First Row ==================================-->
        <div id="inspect-info">
            <div class="row mb-3">
                <label>{{ trans('module4.inspect_place') }}:</label>
                <select name="inspect_place" id="inspect_place" class="form-control">
                    <option value="" selected disabled>-- {{ trans('module4.inspect_place') }} --</option>
                    @foreach($inspect_place_list as $item)
                    <option value="{{$item->id}}" @if(isset($vehicle_inspect)) {{$item->id == $vehicle_inspect->inspect_place_id?"selected":""}} @endif>
                        {{ $item->name }}&nbsp;({{$item->name_en}})
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="row mb-3">
                <label>{{ trans('module4.inspect_issue_date') }}:</label>
                <input type="text" class="form-control" name="issue_date" id="issue_date" aria-required="true" value="<?php if(isset($vehicle_inspect)) echo date('Y-m-d',strtotime($vehicle_inspect->issue_date ?? '')) ?>">
            </div>
            <div class="row mb-3">
                <label>{{ trans('module4.inspect_expire_date') }}:</label>
                <input type="text" class="form-control" name="expire_date" id="expire_date" aria-required="true" value="<?php if(isset($vehicle_inspect)) echo date('Y-m-d',strtotime($vehicle_inspect->expire_date ?? '')) ?>">
            </div>
            <div class="row mb-3">
                <label>{{ trans('module4.inspect_result') }}:</label>
                <select name="result" id="result" class="form-control">
                    <option value="" selected disabled>-- {{ trans('module4.inspect_result') }} --</option>
                    @foreach($inspect_rsult_list as $item)
                    @foreach($item as $key=>$value)
                    <option value="{{ $key }}" @if(isset($vehicle_inspect)) {{ $key == $vehicle_inspect->result?"selected":""}} @endif>
                        {{ $value }}
                    </option>
                    @endforeach
                    @endforeach
                </select>
            </div>
        </div>
        <div id="loader" class="lds-dual-ring hidden overlay"></div>
        <div class="row pt-3">
            <div class="col-md-6 col-sm-6"></div>
            <div class="col-md-3 col-sm-3 text-right" style="padding-right: 0px;">
                <!-- <a style="width: 95%;" class="btn btn-success text-white" href="#" data-vehicle-id="{{$vehicle_id}}" 
                data-id="@if(isset($vehicle_inspect)) {{$vehicle_inspect->id}} @endif" onclick="saveVehicleInspect(this)" id="save_v_inspect">{{ trans('button.save')}}</a> -->
                <a style="width: 95%;" class="btn btn-success text-white" href="#" id="save_v_inspect">{{ trans('button.save')}}</a>
            </div>
            <div class="col-md-3 col-sm-3 text-right" style="padding-right: 0px;">
                <button type="button" data-dismiss="modal" class="btn btn-secondary text-white btn-sm" style="width: 95%;">{{trans('button.cancel')}}</button>
            </div>
        </div>
    </form>
</div>
<script src="{{asset('vrms2/js/bootstrap-datepicker.min.js')}}"></script>
<script>
      $("#issue_date, #expire_date").datepicker({
         
         format: 'dd-mm-yyyy',
         autoclose:true
      });
</script>

