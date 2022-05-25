@extends('layouts.master')
@section('vims','active')
@section('content')
@php
$app_no = \App\Model\AppForm::get();
$districts = \App\Model\District::whereStatus(1)->whereProvinceCode($vehicle->province_code)->get();
$models = \App\Model\VehicleModel::whereStatus(1)->whereBrandId($vehicle->brand_id)->get();
$veh_tenant = \App\Model\VehicleTenant::whereVehicleId($vehicle->id)->first();
if($veh_tenant != null) {
$tenant_district =\App\Model\District::whereProvinceCode($veh_tenant->province_code)->get();
}

$smart_card_code = \App\Model\SmartCardSetting::select('code','security_pin')->first();

@endphp
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link href="{{ asset('/css/printCustom.css') }}" rel="stylesheet">
<style>
    @media screen {

        #printPaper2,
        #printcontent,
        #certificate,
        #book,
        #Pink2,
        #printTransfer,
        #document-certificate,
        #damaged-certificate,
        #certificate-used,
        #elimination-license {
            display: none;
        }
    }

    #vehInfo .form-row label {
        font-size: 13px;
    }

    #vehInfo input[type=checkbox] {
        transform: scale(1);
        margin-left: -15px;
    }

    #vehInfo label.checkbox-label {
        word-spacing: -5px;
        vertical-align: top;
    }

    .print-new-paper {
        display: none;
    }

    @media print {
        .print-new-paper {
            display: block;
        }
    }
</style>
<h1 class="page-header">{{ trans('module4.vehicle_info') }}</h1>
<div class="card">
    <div class="card-body py-2">
        @include('flash')
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#vehInfo" role="tab" aria-controls="home-1" aria-selected="true">{{ trans('module4.vehicle_info')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#document">{{ trans('module4.document')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#change_log">Change Log</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tenant_info">{{ trans('module4.tenant_info')}}</a>
            </li>

            <form action="{{url('/search-license')}}" method="GET" class="ml-2">
                <input type="text" name="search" class=" form-control-sm p-0" placeholder="Enter license no" required>
                <button type="submit" class="btn bnt-info btn-sm">Search</button>
            </form>
        </ul>
        <div class="tab-content">
            <div class="tab-pane show active" id="vehInfo" role="tabpanel">
                @include('Module4.Vehicle.VehicleInfo',['vehicle'=> $vehicle, 'form_type' =>'veh_type', 'app_form_status_id' => $data->app_form_status_id ?? '', 'app_id'=> $data->id ?? '','app_form' => $data])
            </div>
            <div class="tab-pane fade" id="document" role="tabpanel">

                @include('Module4.Vehicle.VehDoc', ['app_doc' => $vehicle_doc, 'id'=>$vehicle->id,'license_no' =>$vehicle->licence_no ])
            </div>
            <div class="tab-pane " id="change_log" role="tabpanel">

                @include('Module4.Vehicle.change-log', ['vehicle_id' => $vehicle->id])

            </div>

            <div class="tab-pane " id="tenant_info" role="tabpanel">
                <form action="{{ route('vehicle-tenant.store') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 col-sm-12 mb-1">
                            <label for="validationCustom01">{{ trans('common.name')}}:</label>
                            <input type="hidden" name="vehicle_id" value="{{$vehicle->id}}">
                            <input type="text" class="form-control" value="{{ $veh_tenant->tenant_name ?? ''}}" placeholder="Enter Name" name="tenant_name" required>
                        </div>
                        <div class="col-md-6 col-sm-6 mb-1">
                            <label for="validationCustom01">{{ trans('common.province')}}:</label>

                            <select name="province_code" class="form-control" id="tenant_province" required>
                                <option value="" selected disabled>Select Province</option>
                                @foreach($veh_info['provinces'] as $pro)
                                <option value="{{$pro->province_code}}" @if($veh_tenant) {{$veh_tenant->province_code == $pro->province_code?'selected':''}} @endif>{{ $pro->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 col-sm-6 mb-1">
                            <label for="validationCustom01">{{ trans('common.district')}}:</label>
                            @if($veh_tenant)

                            <select class="form-control" name="district_code" required="required" id="tenant_district">
                                <option value="" selected disabled hidden>--Select District--</option>
                                @foreach($tenant_district as $district)
                                <option value="{{$district->district_code}}" @if($veh_tenant) {{$veh_tenant->district_code == $district->district_code?'selected':''}} @endif>{{ $district->name}}</option>
                                @endforeach
                            </select>
                            @else
                            <select class="form-control" name="district_code" required="required" id="tenant_district">
                                <option value="" selected disabled hidden>--Select District--</option>
                            </select>
                            @endif
                        </div>
                        <div class="col-md-6 col-sm-6 mb-1">
                            <label for="validationCustom01">{{ trans('module4.village_name')}}:</label>
                            <input type="text" class="form-control" value="{{ $veh_tenant->village ?? ''}}" placeholder="Enter Village" name="village" required>
                        </div>
                        <div class="col-md-6 col-sm-6 mb-1">
                            <label for="validationCustom01">{{ trans('module4.tel')}}:</label>
                            <input type="number" class="form-control" value="{{ $veh_tenant->phone ?? ''}}" placeholder="Enter Phone" name="phone" required>
                        </div>
                        <div class="col-md-12 col-sm-12 mb-1">
                            <label for="validationCustom01">{{ trans('module4.note')}}:</label>
                            <textarea name="note" class="form-control" cols="3" rows="6">{{$veh_tenant->note ?? ''}}</textarea>
                        </div>
                        <div class="col-md-12 col-sm-12 text-right mt-2">
                            <button class="btn btn-success btn-sm">{{ trans('button.save')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
</div>

@if($data != null)
<!-- start print area for Pink1 in module4 -->
<div id="printPaper2">
    @include('Module4.registration.print.printPaper', ['veh_data' => $data])
</div>
<!-- end print area -->
<!-- start print area for Pink1 in module4 -->

<!-- end print area -->
<!-- start print area for Pink2 in module4 -->
<div id="Pink2">
    @include('Module4.registration.print.pink2',['veh_data' => $data])
</div>
<!-- end print area -->
<!-- start print area for certificate in module4 -->
<div id="certificate">
    @include('Module4.registration.print.certificate', ['veh_data' => $data])
</div>
<!-- end print area -->
<!-- start print area for certificate in module4 -->
<div id="book">
    @include('Module4.registration.print.book', ['veh_data' => $data])
</div>
<!-- end print area -->
<div id="printTransfer">
    @include('Module4.registration.print.print-transfer', ['veh_data' => $data])
</div>
<!-- start print area for document certificate in module4 -->
<div id="document-certificate">
    @include('Module4.registration.print.document-certificate', ['veh_data' => $data])
</div>
<!-- end print area -->
<!-- start print area for damaged certificate in module4 -->
<div id="damaged-certificate">
    @include('Module4.registration.print.damaged-certificate', ['veh_data' => $data])
</div>
<!-- end print area -->
<!-- start print area for  certificate used in module4 -->
<div id="certificate-used">
    @include('Module4.registration.print.certificate-used', ['veh_data' => $data])
</div>
<!-- end print area -->
<!-- start print area for  Elimination license  in module4 -->
<div id="elimination-license">
    @include('Module4.registration.print.elimination-license', ['veh_data' => $data])
</div>
<!-- end print area -->
@endif
@include('Module4.registration.print.printNewPaper', ['vehicle' => $vehicle])


@endsection

@push('page_scripts')
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script>
    var dist_url = "{{url('/getdistrict/')}}";
    var lic_value = $("#licence_no").val();
    if (lic_value) {
        $("#lic_control_btn").addClass('disable-btn');
    }
    $("#issu_date").datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect: function(dateStr) {
            var d = $.datepicker.parseDate('yy-mm-dd', dateStr);
            d.setFullYear(d.getFullYear() + 5);
            $('#exp_date').datepicker('setDate', d);
        }
    });

    $("#exp_date").datepicker({
        dateFormat: 'yy-mm-dd'
    });
</script>
<script src="{{asset('js/jquery_print.js')}}"></script>

<script>
    $(document).ready(function() {

        var edit_doc = "{{url('/vehDocument')}}";
        $(document).on("click", '.editDocument', function() {

            $('[name="doc_type_id"]').val($(this).data('doc_type_id'));
            $('[name="vehicle_id"]').val($(this).data('vehicle_id'));
            $('#filearea').html($(this).data('filename'));
            document.getElementById("EditDoc").action = edit_doc;
        });

        // js for getting division_no and province_no 
        $(document).on("click", '#div_control_btn', function() {
            var vehicle_id = $('#vehicle_id').val();

            $.ajax({
                type: 'GET',
                url: '/getDivNo/' + vehicle_id,
                success: function(data) {
                    console.log(data);
                    if (data.div_no == null || data.pro_no == null) {
                        $('#divError').text('You need to check division_no control.');
                        $("#proError").text("You need to check province no control.");
                    } else {
                        if ($('[name="division_no"]').val() == '') {
                            $('[name="division_no"]').val(data.div_no);
                        }

                        $('[name="province_no"]').val(data.pro_no);
                        $('[name="issue_date"]').val($("#issue_date").val());
                        $('[name="expire_date"]').val($("#expire_date").val());
                        $("#div_control_btn").addClass('disable-btn');
                    }
                }
            });
        });

        // js for getting new license auto generating
        $(document).on("click", '#lic_control_btn', function() {
            var vehicle_id = $('#vehicle_id').val();
            var vehicle_kind = $('#vehicle_kind').val();
            $.ajax({
                type: 'GET',
                url: '/getLicenceNo/' + vehicle_id,
                data: {
                    vehicle_kind_code: vehicle_kind
                },
                success: function(data) {

                    if (data.licence_no != null) {
                        $("#licence_no").val(data.licence_no);
                        $("#lic_control_btn").addClass('disable-btn');
                    } else {
                        $("#licError").text("Check your vehicle infomation & License Present table.");
                    }
                }
            });
        });
        // js for print Pinkpaper and newform

        $(document).on('click', '.pinkpaperForm', function(e) {

            if (($("input[name*='app_purpose_id']:checked").length) == 0) {
                alert("You must check at least 1 app purpose");
                return false;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var vehicle_id = $("#vehicle_id").val();
            var remark = $('[name="remark"]').val();
            var new_form = $('[name="new_form"]').val();
            app_purposes = [];

            $('input[name="app_purpose_id[]"]:checked').each(function() {
                app_purposes.push($(this).val());
            });
            $.ajax({
                type: "POST",
                url: '/new-form-pink-paper/' + vehicle_id,
                data: {
                    app_purposes: app_purposes,
                    remark: remark,
                    new_form: new_form
                },
                success: function(data) {
                    jQuery('.print-new-paper').print();
                    $('#PinkPaperNewForm').hide();
                    $('.modal-backdrop').removeClass('show');

                }
            });
        });

        //for book button with print
        $(document).on('click', '.book-print', function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var vehicle_id = $('#vehicle_id').val();
            $.ajax({
                type: "POST",
                url: '/book-print/' + vehicle_id,
                data: {
                    app_form_status: 6
                },
                success: function(data) {
                    jQuery('#book').print();
                }
            });
        });

        $(".newForm").click(function() {
            if (($("input[name*='app_purpose_id']:checked").length) == 0) {
                alert("You must check at least 1 app purpose");
                return false;
            }
        });

        $(document).on("click", '#click-detail', function() {
            $('#details').slideToggle('slow');
        });
    });
</script>
<script type="text/javascript" src="{{asset('js/dropdownlist.js')}}"></script>
@endpush