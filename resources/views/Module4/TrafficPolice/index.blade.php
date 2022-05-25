@extends('vrms2.layouts.master')
@section('traffic_police','active')
@section('title','Traffic Police')
@section('content')
<style>
  #search input {
    margin-right: 5px;
  }

  .modal {
    pointer-events: none;
  }

  .modal-backdrop {
    background: none;
  }

  .vehicles-list th {
    padding-bottom: 0px;
  }

  .f-col {
    min-width: 120px;
  }

  .s-col {
    min-width: 150px;
  }

  .t-col {
    min-width: 180px;
  }
  .fo-col {
    min-width: 200px;
  }

  .fi-col {
    min-width: 180px;
  }

  .si-col {
    min-width: 120px;
  }

  .se-col {
    min-width: 120px;
  }
</style>
<h3>{{ trans('module4.traffic_police') }}</h3>
<div class="card-body" style="padding-top: 0px;margin-top: 0px;">
  <div class="row" id="search" style="background:#cdf;padding-left: 5px;padding-top: 5px ;margin:0px;">
    {{ trans('module4.license_no_search')}}:<input type="text" class="w60" id="s_licenseNo" onfocusout="searchVehicles(0)">
    {{ trans('module4.general')}}:<input type="text" class="w130" id="s_general">
    {{ trans('module4.province')}}:<input type="text" class="w90" id="s_province_name" onfocusout="searchVehicles(0)">
    {{ trans('module4.village')}}:<input type="text" class="w90" id="s_village_name" onfocusout="searchVehicles(0)">
    {{ trans('module4.name')}}:<input type="text" class="w100" id="s_owner_name" onfocusout="searchVehicles(0)">
    {{ trans('module4.target_number')}}:<input type="text" class="w40" id="s_vehicle_kind_code" onfocusout="searchVehicles(0)">
    {{ trans('module4.issue_date')}}:<input type="text" class="w70" id="s_issueDate" onfocusout="searchVehicles(0)">
    {{ trans('module4.sort')}}:
    <div class="form-group" style="display: inline;margin-right:5px;">
      <select class="form-control js-example-basic-single" style="width: 100%;height: 28px;padding:0px;" id="s_sort_by" onchange="searchVehicles(0)" required>
        <option value="0" selected></option>
        <option value="1" disabled>modify_date</option>
        <option value="2">division_no</option>
        <option value="3">province_no</option>
        <option value="4">owner_name</option>
        <option value="5">license_no</option>
        <option value="6">issue_date</option>
      </select>
    </div>

    <a href="#" id="advanced-show" class="button" onclick="$(&quot;#advanced-search&quot;).slideDown();$(this).hide();" style="display: inline-block; margin-top:0px; padding-top: 1px;padding-bottom: 1px;">{{ trans('module4.advanced_search')}}</a>

    <div id="advanced-search" style="width: 100%; background: rgb(204, 221, 255); border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.3) 4px 4px 10px; padding: 3px; display: none;">
      {{ trans('module4.vehicle_type')}}: <input type="text" class="w70" id="s_vehicle_type_name" onfocusout="searchVehicles(0)">
      {{ trans('module4.brand')}}: <input type="text" class="w70" id="s_brand_name" onfocusout="searchVehicles(0)">
      {{ trans('module4.model')}}: <input type="text" class="w70" id="s_model_name" onfocusout="searchVehicles(0)">
      {{ trans('module4.engine_no')}}: <input type="text" class="w100" id="s_engine_no" onfocusout="searchVehicles(0)">
      {{ trans('module4.chassis_no')}}: <input type="text" class="w100" id="s_chassis_no" onfocusout="searchVehicles(0)">
      {{ trans('module4.traffic_color')}}: <input type="text" class="w70" id="s_color_name" onfocusout="searchVehicles(0)">
      {{ trans('module4.cc')}}: <input type="text" class="w70" id="s_cc" onfocusout="searchVehicles(0)">
      {{ trans('module4.year')}}: <input type="text" class="w70" id="s_year_manufacture" onfocusout="searchVehicles(0)">
      <br>

      {{ trans('module4.import_permit_no')}}: <input type="text" class="w120 mt-2 mb-2" id="s_import_permit_no" onfocusout="searchVehicles(0)">
      {{ trans('module4.industrial_doc_no')}}: <input type="text" class="w120 mt-2 mb-2" id="s_industrial_doc_no" onfocusout="searchVehicles(0)">
      {{ trans('module4.technical_doc_no')}}: <input type="text" class="w120 mt-2 mb-2" id="s_technical_doc_no" onfocusout="searchVehicles(0)">
      {{ trans('module4.comerce_permit_no')}}: <input type="text" class="w120 mt-2 mb-2" id="s_comerce_permit_no" onfocusout="searchVehicles(0)">
      <br>

      {{ trans('module4.special_case_car')}}: <input type="text" class="w120">
      {{ trans('module4.license_3_digits')}}: <input type="text" class="w120">
      <br>

      <a href="#" id="advanced-show" class="button" onclick="$(&quot;#advanced-search&quot;).slideUp();$(&quot;#advanced-show&quot;).show()">{{ trans('module4.close_advanced_search')}}</a>
    </div>
  </div>
  <div style="color:red;">{{ trans('module4.not_allow_to_publish')}}</div>

  @if(session()->has('success'))
  <div class="alert alert-dismissable alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>
      {{ session()->get('success') }}
    </strong>
  </div>
  @endif

  <!-- pagination row -->
  <div class="row" style="margin-top: 5px;margin-bottom: 10px;">
    <div class="col col-md-1"></div>
    <div class="col col-md-3">
      <span class="total-vehicles" title="Total No. of Vehicles">
        ລວມ: (<span id="total-vehicles">{{$total_vehicles}}</span>)
      </span>
    </div>
    <div class="col-md-5 text-center">
      <a class="pagin-prev" title="Go to previous page" onclick="searchVehicles(-1)">ກັບໜ້າ</a>
      <span id="cpage">1</span> / <span id="spages">{{$total_pages}}</span>
      <a class="pagin-next" title="Go to next page" onclick="searchVehicles(1)">ໜ້າຕໍ່ໄປ</a>
    </div>
    <div class="col col-md-2"></div>
  </div>
  <!-- pagination row end -->

  <div id="search-result">
    <span style="display:none" id="t_vehicles">{{$total_vehicles}}</span>
    <span style="display:none" id="t_pages">{{$total_pages}}</span>
    <table class="vehicles-list" style="margin-top: 5px;">
      <thead>
        <tr>
          <th class="f-col">{{ trans('module4.license_no_header')}}</th>
          <th class="s-col">{{ trans('module4.model')}}</th>
          <th class="t-col">{{ trans('module4.engine_no_chassis_no')}}</th>
          <th class="fo-col">{{ trans('module4.name')}}</th>
          <th class="fi-col">{{ trans('module4.village_district_province')}}</th>
          <th class="si-col">{{ trans('module4.number')}}</th>
          <th class="se-col">{{ trans('module4.expire_date_header')}}</th>
          <th>{{ trans('module4.tool_techincalFee')}}</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($vehicles as $vehicle)
        <tr>
          <td>
            <a href="#" class="link license_no" purpose_no="{{$vehicle->vehicle_kind_code}}" data-url="{{ route('showTrafficPolice',['id' => $vehicle->id ])}}" data-id="{{$vehicle->id}}" onclick="vehicleModal(this)">
              @if(strlen($vehicle->licence_no) == 0){{'0000'}} @else{{ $vehicle->licence_no }} @endif
            </a>
            <br>
            {{ $vehicle->vehicle_kind->name ?? '' }}
          </td>
          <td>
            <div>{{ $vehicle->vbrand->name ?? '' }}</div>
            <div style="font-weight: bold;">{{ $vehicle->vmodel->name ?? '' }}</div>
            <div>{{ $vehicle->color->name ?? '' }} <span>{{ $vehicle->steering->name ?? '' }}</span></div>
          </td>
         
          <td>
            <div>{{ $vehicle->engine_no }}</div>
            <div>
              <a href="#" class="link" data-url="{{ route('showTrafficPolice',['id' => $vehicle->id ])}}" data-id="{{$vehicle->id}}" onclick="vehicleModal(this)">{{ $vehicle->chassis_no }}</a>
            </div>
          </td>
          <td>
            <a href="#" class="link" data-url="{{ route('showTrafficPolice',['id' => $vehicle->id ])}}" data-id="{{$vehicle->id}}" onclick="vehicleModal(this)">{{ $vehicle->owner_name }}</a>
          </td>
          <td>
            <div style="font-weight: bold;">{{ $vehicle->village_name }}</div>
            <div style="color: #666;"><small>ມ.</small>{{ $vehicle->district->name ?? '' }}</div>
            <div class="province" province_code="{{$vehicle->province_code}}">{{ $vehicle->province->name ?? '' }}</div>
          </td>
          <td>
            <div style="white-space:nowrap;color: #777;">ກມ {{ $vehicle->division_no }}</div>
            <div style="color: #aaa;">ຂວ {{ $vehicle->province_no }}</div>
            <div style="color: #bbb;">ທີ {{ $vehicle->number }}</div>
          </td>
          <td>
            <div style="color: #f99;">ອອກ {{ $vehicle->issue_date }}</div>
            <div style="color: #f99;">ໝົດ {{ $vehicle->expire_date }}</div>
          </td>
          <td>
            <div>ຄ່າທາງ: </div>
            <div style="color: #f99;">{{ $vehicle->illegalTrafic->illegal_date ?? '' }}</div>
            <div>{{ $vehicle->remark }}</div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

</div>

<!-- @include('Module4.TrafficPolice.modal') -->
@endsection
@push('page_scripts')

<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript">
  (function() {
    $(".pagin-prev").hide();
  })();
  //==========================================================================================
  function searchVehicles(c_page) {
    $('#search-result').html(
      '<div class="text-center">'+
          '<div class="spinner-border text-primary" role="status" style="width: 4rem; height: 4rem;">'+
          '<span class="sr-only">Loading...</span>'+
          '</div>'+
      '</div>');

    var base_url = window.location.origin;
    var purl = base_url + "/search-traffic-police";

    var license_no = $("#s_licenseNo").val();
    var general = $("#s_general").val();
    var province_name = $("#s_province_name").val();
    var village_name = $("#s_village_name").val();
    var owner_name = $("#s_owner_name").val();
    var vehicle_kind_code = $("#s_vehicle_kind_code").val();
    var issue_date = $("#s_issueDate").val();
    var sortBy = $("#s_sort_by :selected").text();

    var vehicle_type_name = $("#s_vehicle_type_name").val();
    var brand_name = $("#s_brand_name").val();
    var model_name = $("#s_model_name").val();
    var engine_no = $("#s_engine_no").val();
    var chassis_no = $("#s_chassis_no").val();
    var color_name = $("#s_color_name").val()
    var cc = $("#s_cc").val();
    var year_manufactured = $("#s_year_manufacture").val();
    var import_permit_no = $("#s_import_permit_no").val();
    var industrial_doc_no = $("#s_industrial_doc_no").val();
    var technical_doc_no = $("#s_technical_doc_no").val();
    var commerce_permit_no = $("#s_comerce_permit_no").val();

    var current_page = 0;
    if(parseInt(c_page) != 0){
      current_page = parseInt($('#cpage').html()) + parseInt(c_page);
    }else{
      current_page = 1;//When search, always show first page whatever current page
    }
    var search_page = parseInt($('#spages').html());

    //call Serach function
    $.ajax({
        url: purl,
        type: 'GET',
        data: {
          current_page: current_page,
          search_page: search_page,

          license_no: license_no,
          general: general,
          province_name: province_name,
          village_name: village_name,
          owner_name: owner_name,
          vehicle_kind_code: vehicle_kind_code,
          issue_date: issue_date,
          sortBy: sortBy,

          vehicle_type_name: vehicle_type_name,
          brand_name: brand_name,
          model_name: model_name,
          engine_no: engine_no,
          chassis_no: chassis_no,
          color_name: color_name,
          cc: cc,
          year_manufactured: year_manufactured,
          import_permit_no: import_permit_no,
          industrial_doc_no: industrial_doc_no,
          technical_doc_no: technical_doc_no,
          commerce_permit_no: commerce_permit_no
        },
        dataType: 'html'
      })
      .done(function(data) {
        var total_pages = 0;
        $('#search-result').html(data);
        total_vehicles = $('#t_vehicles').html();
        total_pages = $('#t_pages').html();

        $('#total-vehicles').html(total_vehicles);
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
      })
      .fail(function() {
        $('#serch-result').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');

      });
  }
  //==========================================================================================
  //To click button to show next modal while showing first modal
  function vehicleModal(btn) {
    var url_id = $(btn).data('url');
    var id = $(btn).data('id');

    var vModal = getVehicleModal(id);

    // Init the modal if it hasn't been already.
    if (!vModal) {
      vModal = initVehicleModal(id);
    }

    var html =
      '<div class="modal-header">' +
      '<h3 style="padding: 0px;text-align: center;">{{ trans("module4.traffic_accident") }}</h3>' +
      '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
      '<span aria-hidden="true">&times;</span>' +
      '</button>' +
      '</div>' +
      '<div class="modal-body v' + id + '" style="padding:0px !important;">' +
      /* modal body start */
      '<div class="text-center">' +
      '<div class="spinner-border text-primary" role="status" style="width: 4rem; height: 4rem;">' +
      '<span class="sr-only">Loading...</span>' +
      '</div>' +
      '</div>' +
      /* modal body end */
      '</div>';

    setVehicleModalContent(html, id);

    // Show the modal.
    $(vModal).modal('show');

    $.ajax({
        url: url_id,
        type: 'GET',
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
      $(this).remove();
    });

  }

  function getVehicleModal(id) {
    return document.getElementById('vModal' + id);
  }

  function initVehicleModal(id) {
    var modal = document.createElement('div');
    modal.classList.add('modal', 'fade');
    modal.setAttribute('id', 'vModal' + id);
    modal.setAttribute('tabindex', '-1');
    modal.setAttribute('role', 'dialog');
    modal.setAttribute('data-backdrop', 'false');
    modal.setAttribute('data-keyboard', 'false');
    modal.setAttribute('aria-labelledby', 'myModalLabel');
    modal.setAttribute('aria-hidden', 'true');
    modal.innerHTML =
      '<div class="modal-dialog modal-lg" role="document" style="position: fixed;top: -28px;display: block;left: 50px;">' +
      '<div class="modal-content" style="width:1280px;height:690px;">' +
      '</div>' +
      '</div>';
    document.body.appendChild(modal);
    return modal;
  }

  function setVehicleModalContent(html, id) {
    getVehicleModal(id).querySelector('.modal-content').innerHTML = html;
  }


</script>
@endpush