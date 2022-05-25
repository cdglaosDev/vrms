@extends('vrms2.layouts.master')
@section('vehicle_inspect', 'active')
@section('content')
<style type="text/css">
  #search input {
    margin-right: 5px;
  }

  .modal {
    pointer-events: none;
  }

  .modal-backdrop {
    background: none;
  }

  /* ============================== Loading Sign ========================= */
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
<h3>{{trans('module4.vehicle_inspect')}}</h3>
<div class="card-body" style="padding-top: 0px;margin-top: 0px;">
  <div class="row" id="search" style="background:#cdf;padding-left: 5px;padding-top: 5px ;margin:0px;width: 100%;">
    {{ trans('module4.general')}}:<input type="text" class="w100" id="s_general">
    {{ trans('module4.province')}}:<input type="text" class="w90" id="s_province_name" onfocusout="searchVehicles(0)">
    {{ trans('module4.village')}}:<input type="text" class="w90" id="s_village_name" onfocusout="searchVehicles(0)">
    {{ trans('module4.name')}}:<input type="text" class="w100" id="s_owner_name" onfocusout="searchVehicles(0)">
    {{ trans('module4.target_number')}}:<input type="text" class="w40" id="s_vehicle_kind_code" onfocusout="searchVehicles(0)">
    {{ trans('module4.issue_date')}}:<input type="text" class="w70" id="s_issueDate" onfocusout="searchVehicles(0)">
    {{ trans('module4.sort')}}:
    <div class="form-group" style="display: inline;margin-right:5px;">
      <select class="form-control js-example-basic-single" style="width: 120px;height: 28px;padding:0px;" id="s_sort_by" onchange="searchVehicles(0)" required>
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
      {{ trans('module4.license_no_search')}}:<input type="text" class="w60" id="s_licenseNo" onfocusout="searchVehicles(0)">
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

      {{ trans('module4.special_case_car')}}: <input type="text" class="w70">
      ສົ່ງ Online ໂດຍ: <input name="submit_by" id="ssubmit_by" class="w70">
      ສົ່ງ Online ວັນທີ: <input name="submit_date" id="ssubmit_date" class="w70">
      {{ trans('module4.license_3_digits')}}: <input type="text" class="w70">
      Last Print: <input name="last_printed_by" id="slast_printed_by" class="w70">
      Print Count: <input name="print_count" id="sprint_count" class="w70">
      ເຂົ້າຂໍ້ມູນ(Log): <input name="log" id="slog" class="w70">
      <br>

      <a href="#" id="advanced-show" class="button" onclick="$(&quot;#advanced-search&quot;).slideUp();$(&quot;#advanced-show&quot;).show()">{{ trans('module4.close_advanced_search')}}</a>
    </div>
  </div>

  <!-- ================================== Pagination Row ================================== -->
  <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
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
  <!-- ================================== Pagination Row End ================================== -->

  <div id="loader" class="lds-dual-ring hidden overlay"></div>

  <div id="search-result">

    <span style="display:none" id="t_vehicles">{{$total_vehicles}}</span>
    <span style="display:none" id="t_pages">{{$total_pages}}</span>
    <table class="vehicles-inspect">
      <thead>
        <tr>
          <th>{{ trans('module4.inspect_result')}}</th>
          <th>{{ trans('module4.vehicle_license_no')}}</th>
          <th>{{ trans('module4.name')}}</th>
          <th>{{ trans('module4.village_district')}}</th>
          <th>{{ trans('module4.province_name')}}</th>
          <th>{{ trans('module4.v_type')}}</th>
          <th>{{ trans('module4.brand')}}</th>
          <th>{{ trans('module4.model')}}</th>
          <th>{{ trans('module4.traffic_color')}}</th>
          <th>{{ trans('module4.engine_no_chassis_no')}}</th>
          <th>ເຂົ້າຂໍ້ມູນ</th>
          <th>ພິມ</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($vehicles as $vehicle)
        <tr>
          <td>
            @if(($vehicle->inspect_result ?? '') == "pass") 
              @if( ($vehicle->expire_date) > date("Y-m-d") )
              <img src="images/pass.png" height="30px" width="30px">
              @else
              <img src="images/over_pass.png" height="30px" width="30px">
              @endif
            @elseif(($vehicle->inspect_result ?? '') == "not_pass") <img src="images/not_pass.png" height="30px" width="30px">
            @else <img src="images/na.png" height="30px" width="30px">
            @endif
          </td>
          <td class="nowrap">
            <a href="#" class="link license_no" data-url="{{ route('vehicleInspectionModal',['id'=>$vehicle->id]) }}" data-id="{{$vehicle->id}}" purpose_no="{{$vehicle->vehicle_kind_code}}" onclick="vehicleInspectModal(this)">
              @if(strlen($vehicle->licence_no) == 0){{'0000'}} @else{{ $vehicle->licence_no }} @endif
            </a>
            <div style="text-align:center;white-space:nowrap;color:#444;font-size:11px;padding:0;max-width:80px">{{ $vehicle->vehicle_kind->name ?? '' }}</div>
            <small style="color:#999">g5000</small>
          </td>
          <td><a purpose_no="1" class="link">{{ $vehicle->owner_name }}</a>
            <div style="text-decoration:underline;font-size:9px;color:#ccc;cursor:pointer">ປະຫວັດ</div>
          </td>
          <td>
            <div style="font-weight:bold">{{ $vehicle->village_name }}</div>
            <div style="color:#666"><small>ມ</small>{{ $vehicle->district->name ?? '' }}</div>
          </td>
          <td>
            <div province="5">{{ $vehicle->province->name ?? '' }}</div>
            <div style="white-space:nowrap;color:#777;font-size:10px"><small>ກມ</small>{{ $vehicle->division_no}}</div>
            <div style="white-space:nowrap;color:#aaa;font-size:10px"><small>ຂວ </small>{{ $vehicle->province_no}}</div>
          </td>
          <td>{{ $vehicle->vtype->name ?? '' }}</td>
          <td>
            <div>{{ $vehicle->vbrand->name ?? '' }}</div>
            <div style="white-space:nowrap;color:#f99;font-size:11px">ອອກ {{ $vehicle->issue_date}}</div>
          </td>
          <td>
            <div>{{ $vehicle->vmodel->name ?? '' }}</div>
            <div style="white-space:nowrap;color:#f99;font-size:11px">ໝົດ {{ $vehicle->expire_date}}</div>
          </td>
          <td>{{ $vehicle->color->name ?? '' }}</td>
          <td>
            <div>{{ $vehicle->engine_no }}</div>
            <div>
              <a href="#" class="link" style="font-weight: bold;">
                {{ $vehicle->chassis_no }}
              </a>
            </div>
          </td>
          <td></td>
          <td>{{ $vehicle->log }}</td>
          <td>{{ $vehicle->updated_at }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
</div>

@endsection
@push('page_scripts')
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript">
  //========================================= Search Vehicle Info =========================================
  function searchVehicles(c_page) {
    var base_url = window.location.origin;
    var surl = base_url + "/search-vehicle-inspection";

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

    var current_page = parseInt($('#cpage').html()) + parseInt(c_page);
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
        dataType: 'html',
        beforeSend: function() { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
          $('#loader').removeClass('hidden')
        },
        success: function(data) {
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
        },
        complete: function() { // Set our complete callback, adding the .hidden class and hiding the spinner.
          $('#loader').addClass('hidden')
        },
      })
      .fail(function() {
        $('#serch-result').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');

      });
  }
  //=======================================================================================================

  //========================================= Vehicle Modal Pop Up =========================================
  function vehicleInspectModal(data) {
    var url_id = $(data).data('url');
    var vehicle_id = $(data).data('id');

    var vModal = getVehicleInspectModal(vehicle_id);

    // Init the modal if it hasn't been already.
    if (!vModal) {
      vModal = initVehicleInspectModal(vehicle_id);
    }

    var html =
      '<div class="modal-header">' +
      '<h3 style="padding: 0px;text-align: center;">{{ trans("module4.vehicle_inspect_license_info") }}</h3>' +
      '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
      '<span aria-hidden="true">&times;</span>' +
      '</button>' +
      '</div>' +
      '<div class="modal-body v' + vehicle_id + '" style="padding:0px !important;">' +
      /* modal body start */
      '<div class="text-center">' +
      '<div class="spinner-border text-primary" role="status" style="width: 4rem; height: 4rem;">' +
      '<span class="sr-only">Loading...</span>' +
      '</div>' +
      '</div>' +
      /* modal body end */
      '</div>';

    setVehicleInspectModalContent(html, vehicle_id);

    // Show the modal.
    $(vModal).modal('show');
    // ---------------
    //var url = $(this).data('url');
    //$('.show-modal').html(''); 
    //$('#modal-loader').show();  
    $.ajax({
        url: url_id,
        type: 'GET',
        dataType: 'html'
      })
      .done(function(data) {
        //$('.show-modal').html('');
        $('.v' + vehicle_id).html(data);
        //$('#modal-loader').hide(); 
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

  function getVehicleInspectModal(vehicle_id) {
    return document.getElementById('vModal' + vehicle_id);
  }

  function setVehicleInspectModalContent(html, vehicle_id) {
    getVehicleInspectModal(vehicle_id).querySelector('.modal-content').innerHTML = html;
  }

  function initVehicleInspectModal(vehicle_id) {
    var modal = document.createElement('div');
    modal.classList.add('modal', 'fade');
    modal.setAttribute('id', 'vModal' + vehicle_id);
    modal.setAttribute('tabindex', '-1');
    modal.setAttribute('role', 'dialog');
    modal.setAttribute('data-backdrop', 'false');
    modal.setAttribute('data-backdrop', 'false');
    modal.setAttribute('data-keyboard', 'false');
    modal.setAttribute('aria-labelledby', 'VehicleInspectModalLabel');
    modal.setAttribute('aria-hidden', 'true');
    modal.innerHTML =
      '<div class="modal-dialog modal-lg" role="document" style="position: fixed;top: -28px;display: block;left: 130px;">' +
      '<div class="modal-content" style="width:1000px;height:650px">' +
      '</div>' +
      '</div>';
    document.body.appendChild(modal);
    return modal;
  }
  //========================================================================================================

  //========================================= Add Vehicle Inspect Modal Pop Up =====================================
  function addVehicleInspectModal(obj) {
    var vehicle_id = $(obj).data('id');
    var vehicle_inspect_id = $(obj).data('vehicle_inspect_id');
    var base_url = window.location.origin;
    var nurl = base_url + "/add-vehicle-inspection-modal/" + vehicle_id;

    var nModal = getAddVehicleInspectModal(vehicle_id);

    // Init the modal if it hasn't been already.
    if (!nModal) {
      nModal = initAddVehicleInspectModal(vehicle_id);
    }

    var html =
      '<div class="modal-header">' +
      '<h3 style="padding: 0px;text-align: center;">{{ trans("module4.add_vehicle_inspect") }}</h3>' +
      '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
      '<span aria-hidden="true">&times;</span>' +
      '</button>' +
      '</div>' +
      '<div class="modal-body n' + vehicle_id + '" style="margin-top:0px;padding-top:0px;">' +
      /* modal body start */
      '<div class="text-center">' +
      '<div class="spinner-border text-primary" role="status" style="width: 4rem; height: 4rem;">' +
      '<span class="sr-only">Loading...</span>' +
      '</div>' +
      '</div>' +
      /* modal body end */
      '</div>';

    setAddVehicleInspectModalContent(html, vehicle_id);
    // Show the modal.
    $(nModal).modal('show');
    // ---------------
    $.ajax({
        url: nurl,
        type: 'GET',
        dataType: 'html'
      })
      .done(function(data) {
        $('.n' + vehicle_id).html(data);
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

    $(nModal).on('hidden.bs.modal', function(e) {
      $(this).remove();
    });

  }

  function getAddVehicleInspectModal(vehicle_id) {
    return document.getElementById('nModal' + vehicle_id);
  }

  function setAddVehicleInspectModalContent(html, vehicle_id) {
    getAddVehicleInspectModal(vehicle_id).querySelector('.modal-content').innerHTML = html;
  }

  function initAddVehicleInspectModal(vehicle_id) {
    var modal = document.createElement('div');
    modal.classList.add('modal', 'fade');
    modal.setAttribute('id', 'nModal' + vehicle_id);
    modal.setAttribute('tabindex', '-1');
    modal.setAttribute('role', 'dialog');
    modal.setAttribute('data-backdrop', 'false');
    modal.setAttribute('data-backdrop', 'false');
    modal.setAttribute('data-keyboard', 'false');
    modal.setAttribute('aria-labelledby', 'AddVehicleInspectModalLabel');
    modal.setAttribute('aria-hidden', 'true');
    modal.innerHTML =
      '<div class="modal-dialog modal-lg" role="document" style="position: fixed;top: 100px;display: block;left: 330px;">' +
      '<div class="modal-content" style="width:600px;height:300px">' +
      '</div>' +
      '</div>';
    document.body.appendChild(modal);
    return modal;
  }
  //=================================================================================================================
  //========================================= Edit Vehicle Inspect Modal Pop Up =====================================
  function editVehicleInspectModal(obj) {
    var vehicle_id = $(obj).data('id');
    var vehicle_inspect_id = $(obj).data('vehicle_inspect_id');
    var base_url = window.location.origin;
    var nurl = base_url + "/update-vehicle-inspection-modal/" + vehicle_id + "/" + vehicle_inspect_id;

    var editModal = getEditVehicleInspectModal(vehicle_id);

    // Init the modal if it hasn't been already.
    if (!editModal) {
      editModal = initEditVehicleInspectModal(vehicle_id);
    }

    var html =
      '<div class="modal-header">' +
      '<h3 style="padding: 0px;text-align: center;">{{ trans("module4.edit_vehicle_inspect") }}</h3>' +
      '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
      '<span aria-hidden="true">&times;</span>' +
      '</button>' +
      '</div>' +
      '<div class="modal-body edit' + vehicle_id + '" style="margin-top:0px;padding-top:0px;">' +
      /* modal body start */
      '<div class="text-center">' +
      '<div class="spinner-border text-primary" role="status" style="width: 4rem; height: 4rem;">' +
      '<span class="sr-only">Loading...</span>' +
      '</div>' +
      '</div>' +
      /* modal body end */
      '</div>';

    setEditVehicleInspectModalContent(html, vehicle_id);
    // Show the modal.
    $(editModal).modal('show');
    // ---------------
    $.ajax({
        url: nurl,
        type: 'GET',
        dataType: 'html'
      })
      .done(function(data) {
        $('.edit' + vehicle_id).html(data);
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

    $(editModal).on('hidden.bs.modal', function(e) {
      $(this).remove();
    });

  }

  function getEditVehicleInspectModal(vehicle_id) {
    return document.getElementById('editModal' + vehicle_id);
  }

  function setEditVehicleInspectModalContent(html, vehicle_id) {
    getEditVehicleInspectModal(vehicle_id).querySelector('.modal-content').innerHTML = html;
  }

  function initEditVehicleInspectModal(vehicle_id) {
    var modal = document.createElement('div');
    modal.classList.add('modal', 'fade');
    modal.setAttribute('id', 'editModal' + vehicle_id);
    modal.setAttribute('tabindex', '-1');
    modal.setAttribute('role', 'dialog');
    modal.setAttribute('data-backdrop', 'false');
    modal.setAttribute('data-backdrop', 'false');
    modal.setAttribute('data-keyboard', 'false');
    modal.setAttribute('aria-labelledby', 'AddVehicleInspectModalLabel');
    modal.setAttribute('aria-hidden', 'true');
    modal.innerHTML =
      '<div class="modal-dialog modal-lg" role="document" style="position: fixed;top: 100px;display: block;left: 330px;">' +
      '<div class="modal-content" style="width:600px;height:300px">' +
      '</div>' +
      '</div>';
    document.body.appendChild(modal);
    return modal;
  }
  //========================================================================================================
  //========================================= Save Vehicle Inspection Info =========================================
  $(document).on('click', '#save_v_inspect', function(e) {
    e.preventDefault();

    var vehicle_id = $("#vehicle_id").val();
    var vehicle_inspect_id = $("#vehicle_inspection_id").val();
    var operation = $("#operation").val();
    var inspect_place_id = $("#inspect_place :selected").val();
    var issue_date = $("#issue_date").val();
    var expire_date = $("#expire_date").val();
    var inspect_result = $("#result :selected").val();
    let _token = $('meta[name="csrf-token"]').attr('content');

    if(!inspect_place_id){
      alert("You need to choose Inspect Place.");
      return false;
    }
    if(!issue_date){
      alert("You need to choose Issue Date.");
      return false;
    }
    if(!expire_date){
      alert("You need to choose Expire Date.");
      return false;
    }
    if(!inspect_result){
      alert("You need to choose Inspect Result.");
      return false;
    }

    $.ajax({
      url: "/save-vehicle-inspection",
      type: "POST",
      data: {
        vehicle_id: vehicle_id,
        vehicle_inspect_id: vehicle_inspect_id,
        inspect_place_id: inspect_place_id,
        issue_date: issue_date,
        expire_date: expire_date,
        inspect_result: inspect_result,
        _token: _token
      },
      success: function(response) {
        //console.log(response);
        if (response) {
          //   alert('Save Vehicle Inspection Success!');

          if (operation == "add") {
            $('#' + 'nModal' + vehicle_id).modal('toggle');
          } else {
            $('#' + 'editModal' + vehicle_id).modal('toggle');
          }

          var vModal = document.getElementById('vModal' + vehicle_id);
          document.getElementById('vModal' + vehicle_id).querySelector('#v_inspect_info').innerHTML = response;
        }
      },
      error: function(error) {
        alert('Error in saving Vehicle Inspection!');
        if (operation == "add") {
          $('#' + 'nModal' + vehicle_id).modal('toggle');
        } else {
          $('#' + 'editModal' + vehicle_id).modal('toggle');
        }
        $('#v_inspect_info').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
      }
    });

  });
  //=======================================================================================================
</script>
@endpush