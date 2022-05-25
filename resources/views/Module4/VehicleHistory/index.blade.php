@extends('vrms2.layouts.master')
@section('vehicle_history','active')
@section('content')
@include('vrms2.mod4-submenu')

@php
$vkind = \App\Model\VehicleKind::whereStatus(1)->get();
$pcode = \App\Model\Province::whereStatus(1)->get();
@endphp

<style type="text/css">
    .vehicles_list thead td {
        font-weight: bold;
    }

    .vehicles_list thead {
        border-bottom: #ddd solid 1px;
    }

    .vehicles_list td {
        padding: 2px 4px !important;
    }

    .vehicles_list {
        margin-bottom: 0px !important;
    }

    /*============ For starting scroll from table's second row ==============*/
    /* targetting the first <th>; to ensure <th> are scrolled along with <td> */
    .tbl_vehicle_history tr:nth-child(1) th {
        z-index: 3;
        position: sticky;
        position: -webkit-sticky;
        top: 0px;
    }

    /* target all <td> in the first row to be sticky */
    .tbl_vehicle_history tr:nth-child(1) td {
        position: sticky;
        position: -webkit-sticky;
        top: 0px;
        z-index: 2;
        /*font-weight: bold;*/
        background-color: #F0FFF0;
    }

    .modal {
        pointer-events: none;
    }

    .modal-backdrop {
        background: none;
    }

    /*Hidden class for adding and removing*/
    .lds-dual-ring.hidden {
        display: none;
    }

    /*Add an overlay to the entire page blocking any further presses to buttons or other elements.*/
    .overlay {
        position: fixed;
        top: 210px;
        left: 650px;
        /* width: 1100px;
    height: 1000px; */
        background: rgba(0, 0, 0, 0.1);
        z-index: 999;
        opacity: 1;
        transition: all 0.5s;
    }

    /*Spinner Styles*/
    .lds-dual-ring {
        display: inline-block;
        width: 100px;
        height: 100px;
        padding-top: 20px;
    }

    .lds-dual-ring:after {
        content: " ";
        display: block;
        width: 50px;
        height: 50px;
        margin: 5% auto;
        border-radius: 50%;
        border: 6px solid blue;
        border-color: blue transparent blue transparent;
        animation: lds-dual-ring 1s linear infinite;
    }

    @keyframes lds-dual-ring {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<div class="row" style="padding-left: 10px;margin:0px">
    <h3 class="vehicle">{{ trans('module4.vehicle_history') }}</h3>
</div>
<div class="card-body" style="padding-top: 0px; margin-top: 0px;">
    <div class="row" id="search">
        <div class="col-md-12">
            {{ trans('module4.license_no_search')}}:
            <input type="text" class="w150 mr-4" id="s_licenseNo" maxlength="7">

            {{ trans('module4.province')}}:
            <select name="province_code" id="s_province_code" class="w180 mr-4" title="{{ trans('title.select_province') }}">
                <option value="" selected disabled hidden>--Select Province--</option>
                @foreach($pcode as $pc)
                <option value="{{$pc->province_code}}">{{ $pc->name }}</option>
                @endforeach
            </select>

            {{ trans('module4.v_kind') }}:
            <select class="w180 mr-4" name="vehicle_kind_code" id="s_vehicle_kind_code" title="{{ trans('title.select_kind') }}">
                <option value="" selected disabled hidden>--Select Vehicle Kind--</option>
                @foreach($vkind as $vk)
                <option value="{{$vk->vehicle_kind_code}}">{{$vk->vehicle_kind_code}}&nbsp;{{ $vk->name }}</option>
                @endforeach
            </select>

            <a href="#" id="search" class="button" onclick="searchVehicleHistory(0)">{{ trans('module4.search_license')}}</a>
        </div>
    </div>

    <!-- pagination row -->
    <div class="row" style="margin-top: 5px;margin-bottom: 10px;">
        <div class="col col-md-1"></div>
        <div class="col col-md-3">
            <span title="Total No. of Vehicles">
                ລວມ: (<span id="total-records">{{$total_records}}</span>)
            </span>
        </div>
        <div class="col-md-5 text-center">
            <a class="pagin-prev" title="Go to previous page" onclick="searchVehicleHistory(-1)">ກັບໜ້າ</a>
            <span id="cpage">1</span> / <span id="spages">{{$total_pages}}</span>
            <a class="pagin-next" title="Go to next page" onclick="searchVehicleHistory(1)">ໜ້າຕໍ່ໄປ</a>
        </div>
        <div class="col col-md-2"></div>
    </div>
    <!-- pagination row end -->

    <div id="loader" class="lds-dual-ring hidden overlay"></div>

    <div id="search-result">
        <span style="display:none" id="t_records">{{$total_records}}</span>
        <span style="display:none" id="t_pages">{{$total_pages}}</span>
        <div class="table-responsive">
            <table class="table vehicles_list tbl_vehicle_history" id="vTable">
                <thead>
                    <tr>
                        <th class="v_lic_no">{{ trans('module4.vehicle_license_no')}}</th>
                        <th class="v_name">{{ trans('module4.name')}}</th>
                        <th class="v_village_district">{{ trans('module4.village_district')}}</th>
                        <th class="v_pro_name">{{ trans('module4.province_name')}}</th>
                        <th class="v_t_name">{{ trans('module4.v_type')}}</th>
                        <th class="v_eng_cha">{{ trans('module4.engine_no_chassis_no')}}</th>
                    </tr>
                </thead>

                <tbody>
                    <!-- When we use with <thead> for header row, we can adjust to equal column width header and detail columns. So, create header row in <tbody>. -->

                    @foreach($vehicle_histories as $vehicle_history)
                    <tr>
                        <td class="v_lic_no">
                            <a href="#" class="link license_no" purpose_no="{{$vehicle_history->vehicle_kind_code}}" onclick="vehicleHistoryModal(this)"
                            data-id="{{$vehicle_history->id}}" data-vehicle_id="{{$vehicle_history->vehicle_id}}" >
                                @if(strlen($vehicle_history->licence_no) == 0){{'0000'}} @else{{ $vehicle_history->licence_no }} @endif
                            </a>
                            <div style="text-align:center;white-space:nowrap;color:#444;font-size:11px;padding:0;max-width:80px">{{ $vehicle_history->vehicle_kind->name ?? '' }}</div>
                        </td>
                        <td class="v_name">
                            <a href="#" class="link">{{ $vehicle_history->owner_name ?? '' }}</a>
                        </td>
                        <td class="v_village_district">
                            <div style="font-weight:bold">{{ $vehicle_history->village_name ?? ''}}
                                @if(isset($vehicle_history->vehicle_unit))<span>({{$vehicle_history->vehicle_unit ?? '' }})</span> @else @endif
                            </div>
                            <div style="color:#666"><small>ມ.</small>{{ $vehicle_history->district->name ?? '' }}</div>
                        </td>
                        <td class="v_pro_name">
                            <div class="province" province_code="{{ $vehicle_history->province_code ?? '' }}">{{ $vehicle_history->province->name ?? '' }}</div>
                            <div style="color:#777;font-size:10px"><small>ກມ </small>{{ $vehicle_history->vehicle->division_no}}</div>
                            <div style="color:#aaa;font-size:10px"><small>ຂວ </small>{{ $vehicle_history->vehicle->province_no}}</div>
                        </td>
                        <td class="v_t_name">{{ $vehicle_history->vehicle->vtype->name ?? '' }}</td>
                        <td class="v_eng_cha" style="font-family: Saysettha OT !important;">
                            {{ $vehicle_history->engine_no }} <br />
                            <a href="#" style="font-family: Saysettha OT !important;" class="link font-weight-bold">{{ $vehicle_history->vehicle->chassis_no }}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- ************************************************************************************************** -->

</div>
</div>

@endsection

@push('page_scripts')
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript">
    //========================== Add auto space after two letter in SearchLicenseNo. ===========================
    $('#s_licenseNo').keyup(function() {
        var code = $(this).val().split(" ").join("");
        if (code.length > 0) {
            code = code.split(/(?=.{4}$)/).join(' ').replace(/[!@\/\\#+()$~%^&,`.'";|\[\]:*?<>{}=_-]/g, '');
        }
        $(this).val(code);
    });

    //========================================= Search Vehicle History =========================================
    function searchVehicleHistory(c_page) {
        var surl = "/search_vehicle_history";

        var license_no = $("#s_licenseNo").val();
        var province_code = $("#s_province_code :selected").val();
        var vehicle_kind_code = $("#s_vehicle_kind_code :selected").val();

        var current_page = 0;
        if (parseInt(c_page) != 0) {
            current_page = parseInt($('#cpage').html()) + parseInt(c_page);
        } else {
            current_page = 1; //When search, always show first page whatever current page
        }
        var search_page = parseInt($('#spages').html());

        //call Serach function
        $.ajax({
                url: surl,
                type: 'GET',
                cache: false,
                data: {
                    current_page: current_page,
                    search_page: search_page,

                    license_no: license_no,
                    province_code: province_code,
                    vehicle_kind_code: vehicle_kind_code
                },
                dataType: 'html',
                beforeSend: function() { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function(data) {
                    console.log(data);
                    var total_pages = 0;
                    var total_records = 0;
                    $('#search-result').html(data);
                    total_records = $('#t_records').html();
                    total_pages = $('#t_pages').html();

                    $('#total-records').html(total_records);
                    $('#cpage').html(current_page);
                    $('#spages').html(total_pages);

                    if (total_pages == 1 || total_pages == 0 || total_pages == current_page) {
                        $(".pagin-next").hide();
                    } else {
                        $(".pagin-next").show();
                    }

                    if (current_page == 1) {
                        $(".pagin-prev").hide();
                    } else {
                        $(".pagin-prev").show();
                    }
                },
                complete: function() { // Set our complete callback, adding the .hidden class and hiding the spinner.
                    $('#loader').addClass('hidden')
                },
            })
            .fail(function() {
                $('#serch-result').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');

            });
    }

    //========================================= Vehicle History Modal Start =========================================
    function vehicleHistoryModal(data) {
        var id = $(data).data('id');
        var vehicle_id = $(data).data('vehicle_id');

        //alert(id + "::" + vehicle_id);
        var vModal = getVehicleHistoryModal(id);

        // Init the modal if it hasn't been already.
        if (!vModal) {
            vModal = initVehicleHistoryModal(id);
        }

        var html =
            '<div class="modal-header" style="border-bottom:none; padding:1.15rem 1rem">' +
            '<h3 class="modal-title" style="width:98%; margin-top:-8px; font-size: 19px; border-bottom:none;color:blue;font-weight:bold;">' +
            '{{ trans("module4.vehicle_history") }}' +
            '</h3>' +
            '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span>' +
            '</button>' +

            '</div>' +
            '<div class="modal-body v' + id + '"  style="padding: 0px 10px !important;">' +
            /* modal body start */
            '<div class="text-center">' +
            '<div class="spinner-border text-primary" role="status" style="width: 4rem; height: 4rem;">' +
            '<span class="sr-only">Loading...</span>' +
            '</div>' +
            '</div>' +
            /* modal body end */
            '</div>';

        setVehicleHistoryModalContent(html, id);

        // Show the modal.
        $(vModal).modal('show');
        // ---------------

        $.ajax({
                url: '/edit_vehicle_history',
                type: 'GET', 
                data: {
                    id: id,
                    vehicle_id: vehicle_id
                },
                dataType: 'html'
            })
            .done(function(data) {
                $('.v' + id).html(data);
            })
            .fail(function() {
                $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                $('#modal-loader').hide();
            });
        /* -------- */

        // Jquery draggable
        $('.modal-dialog').draggable({
            handle: ".modal-body, .modal-header"
        });

        $(vModal).on('hidden.bs.modal', function(e) {
            $("#dModaldm").remove();
            $(this).remove();
        });

    }

    function getVehicleHistoryModal(id) {
        return document.getElementById('vModal' + id);
    }

    function setVehicleHistoryModalContent(html, id) {
        getVehicleHistoryModal(id).querySelector('.modal-content').innerHTML = html;
    }

    function initVehicleHistoryModal(id) {
        var modal = document.createElement('div');
        modal.classList.add('modal', 'fade');
        modal.setAttribute('id', 'vModal' + id);
        modal.setAttribute('tabindex', '-1');
        modal.setAttribute('role', 'dialog');
        modal.setAttribute('data-backdrop', 'false');
        modal.setAttribute('data-backdrop', 'false');
        modal.setAttribute('data-keyboard', 'false');
        modal.setAttribute('aria-labelledby', 'vehicleModalLabel');
        modal.setAttribute('aria-hidden', 'true');
        modal.innerHTML =
            '<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document" style="position: fixed;top: -23px;display: block;left: 15%;">' +
            '<div class="modal-content">' +
            '</div>' +
            '</div>';
        document.body.appendChild(modal);
        return modal;
    }
    //width:1190px;height:830px
    //========================================= Vehicle Modal End =========================================
</script>
@endpush