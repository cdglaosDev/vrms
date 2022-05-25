<style>
    #veh-info label {
        width: 35%;
    }

    #veh-info input, #veh-info textarea {
        width: 64%;
    }
</style>
@php
$inspect_place_list = \App\Model\InspectPlace::whereStatus(1)->get();
$inspect_rsult_list = \App\Model\Vehicle::$generalenum;
@endphp
<div class="card-body" style="padding: 5px 10px 5px 10px;">
    @include('flash')
    <form action="" method="POST" enctype="multipart/form-data" style="width: 100%; height: 100%;">
        @method('post')
        @csrf

        <input type="hidden" value="{{ $vehicle->id }}" name="vehicle_id" id="vehicle_id">
        <input type="hidden" value="{{ $button_type }}" name="button_type" id="button_type">
        <input type="hidden" name="print_detail_id" id="print_detail_id" @if(isset($vehicle_print_detail)) value="{{$vehicle_print_detail->id}}" @else value="" @endif>
        <!--================================== Control ==================================-->

        <div id="veh-info">
            <div class="row" style="margin-top: 14px;margin-bottom: 20px;">
                <label for="no" style="text-align: left; font-weight: bold; font-size: 18px;width: 100% !important;">
                    @if(strlen($vehicle->licence_no) == 0){{'0000'}} @else{{ $vehicle->licence_no }} @endif {{ $vehicle->vehicle_kind->name ?? '' }}
                </label>
            </div>
            <div class="row mb-2">
                @if($button_type == "Elimination License") <label for="no">{{ trans('module4.foreign_affairs_no') }}:</label>
                @else <label for="no">{{ trans('module4.v_btn_no') }}:</label>@endif
                <input type="number" class="form-control" name="no" id="no" title="@if($button_type == 'Elimination License'){{ trans('module4.foreign_affairs_no')}} @else{{ trans('module4.v_btn_no') }} @endif" style="margin:0px;" 
                @if(isset($vehicle_print_detail)) value="{{$vehicle_print_detail->no}}" @else value="" @endif>
            </div>
            <div class="row mb-2">
                @if($button_type == "Certificate" || $button_type == "Damaged Certificate")<label for="date">{{ trans('module4._date') }}:</label>
                @else <label for="date">{{ trans('module4.dated') }}:</label>@endif
                <input type="text" class="form-control custom_date" name="date" id="date" title="@if($button_type == 'Certificate' || $button_type == 'Damaged Certificate'){{ trans('module4._date') }} @else{{ trans('module4.dated') }}@endif" 
                @if(isset($vehicle_print_detail)) value="{{$vehicle_print_detail->date}}" @else value="" @endif aria-required="true" maxlength="10">
            </div>

            @if($button_type == "Document Certification" || $button_type == "Certificate Used Instead" || $button_type == "Damaged Certificate")
            <div class="row mb-2">
                @if($button_type == "Damaged Certificate") <label for="permanent">{{ trans('module4.certificate_no') }}:</label>
                @else <label for="permanent">{{ trans('module4.permanent_leaves') }}:</label>@endif
                <input type="text" class="form-control" name="permanent" id="permanent" title="@if($button_type == 'Damaged Certificate'){{ trans('module4.certificate_no') }} @else{{ trans('module4.permanent_leaves') }} @endif" 
                @if(isset($vehicle_print_detail)) value="{{$vehicle_print_detail->permanent}}" @else value="" @endif maxlength="20">
            </div>
            @endif

            @if($button_type == "Document Certification" || $button_type == "Certificate Used Instead")
            <div class="row mb-2">
                <label for="temporary">{{ trans('module4.temporary_leaves') }}:</label>
                <input type="text" class="form-control" name="temporary" id="temporary" title="{{ trans('module4.temporary_leaves') }}" maxlength="20"
                @if(isset($vehicle_print_detail)) value="{{$vehicle_print_detail->temporary}}" @else value="" @endif >
            </div>
            <div class="row mb-2">
                <label for="old_license_no">{{ trans('module4.old_lic_no') }}:</label>
                <input type="text" class="form-control" name="old_license_no" id="old_license_no" title="{{ trans('module4.old_lic_no') }}" maxlength="10"
                @if(isset($vehicle_print_detail)) value="{{$vehicle_print_detail->old_license_no}}" @else value="" @endif >
            </div>
            <div class="row mb-2">
                <label for="license_no">{{ trans('module4.reg_no') }}:</label>
                <input type="text" class="form-control" name="license_no" id="license_no" title="{{ trans('module4.reg_no') }}" maxlength="10" 
                value="@if(strlen($vehicle->licence_no) == 0){{'0000'}} @else{{ $vehicle->licence_no }} @endif" disabled>
            </div>
            @endif

            @if($button_type == "Elimination License")
            <div class="row mb-2">
                <label for="send_to">{{ trans('module4.send_to') }}:</label>
                <input type="text" class="form-control" name="send_to" id="send_to" title="{{ trans('module4.send_to') }}" maxlength="50"
                @if(isset($vehicle_print_detail)) value="{{$vehicle_print_detail->send_to}}" @else value="" @endif >
            </div>
            <div class="row mb-2">
                <label for="transport_no">{{ trans('module4.transport_no') }}:</label>
                <input type="text" class="form-control" name="transport_no" id="transport_no" title="{{ trans('module4.transport_no') }}" maxlength="20"
                @if(isset($vehicle_print_detail)) value="{{$vehicle_print_detail->transport_no}}" @else value="" @endif >
            </div>
            @endif

            @if($button_type == "Certificate")
            <div class="row mb-2">
                <label for="country_origin">{{ trans('module4.country_origin') }}:</label>
                <input type="text" class="form-control" name="country_origin" id="country_origin" title="{{ trans('module4.country_origin') }}" maxlength="50"
                @if(isset($vehicle_print_detail)) value="{{$vehicle_print_detail->country_origin}}" @else value="" @endif >
            </div>
            <div class="row mb-2">
                <label for="note">{{ trans('module4.additional_desc') }}:</label>
                <textarea  class="form-control" name="note" id="note" title="{{ trans('module4.additional_desc') }}">@if(isset($vehicle_print_detail)){{$vehicle_print_detail->note}}@endif</textarea>
            </div>           
            @else
            <div class="row mb-2">
                <label for="dated">{{ trans('module4.dated') }}:</label>
                <input type="text" class="form-control custom_date" name="dated" id="dated" title="{{ trans('module4.dated') }}" aria-required="true" maxlength="10"
                @if(isset($vehicle_print_detail)) value="{{$vehicle_print_detail->dated}}" @else value="" @endif >
            </div>
            @endif

            @if($button_type == "Document Certification" || $button_type == "Certificate Used Instead")
            <div class="row mb-2">
                <label for="certificate_dated">{{ trans('module4.cetrificate_dated') }}:</label>
                <input type="text" class="form-control custom_date" name="certificate_dated" id="certificate_dated" title="{{ trans('module4.cetrificate_dated') }}" aria-required="true" maxlength="10"
                @if(isset($vehicle_print_detail)) value="{{$vehicle_print_detail->certificate_dated}}" @else value="" @endif >
            </div>
            @endif
        </div>

        <!--================================== Buttons ==================================-->
        <div class="row pt-3">
            <div class="col-md-6 col-sm-6"></div>
            <div class="col-md-3 col-sm-3" style="padding-right: 0px;">
                <a style="width: 100%;" class="btn btn-outline-secondary" href="#" id="save_print_buttons">{{ trans('button.save')}}</a>
            </div>

            <div class="col-md-3 col-sm-3" style="padding-right: 0px;">
                <a id="v_print" style="width: 100%;" title="{{ $button_type }}" class="btn btn-outline-secondary 
                @if(isset($vehicle_print_detail)) @else disabled @endif" href="#" onclick="vehiclePrints(this)">{{ trans('button.print') }}
                </a>
            </div>
        </div>
    </form>
</div>

<script src="{{asset('vrms2/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('vrms2/js/vehicle-datepicker.js') }}"></script>
