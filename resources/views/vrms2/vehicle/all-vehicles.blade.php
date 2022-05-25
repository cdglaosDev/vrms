@extends('vrms2.layouts.master')
@section('all_vehicle', 'active')
@section('content')

@php
$province_code_list = \App\Model\Province::whereStatus(1)->get();
@endphp
<style type="text/css">
  .vehicles_list thead td,
  .vehicles_notIn_list thead td {
    font-weight: bold;
  }

  .vehicles_list thead,
  .vehicles_notIn_list thead {
    border-bottom: #ddd solid 1px;
  }

  .vehicles_list td,
  .vehicles_notIn_list td {
    padding: 2px 4px !important;
  }

  .vehicles_list {
    margin-bottom: 0px !important;
  }

  /*============ For starting scroll from table's second row ==============*/
  /* targetting the first <th>; to ensure <th> are scrolled along with <td> */
  .fundClassesTable tr:nth-child(1) th {
    z-index: 3;
    position: sticky;
    position: -webkit-sticky;
    top: 0px;
    
  }

  /* target all <td> in the first row to be sticky */
  .fundClassesTable tr:nth-child(1) td {
    position: sticky;
    position: -webkit-sticky;
    top: 0px;
    z-index: 2;
    /*font-weight: bold;*/
    /* background-color: #F0FFF0; */
  }

  /*============ For starting scroll from table's second row ==============*/
  #advanced-search input {
    margin-right: 0px;
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

  /*Loading Sign - Add an overlay to the entire page blocking any further presses to buttons or other elements.*/
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

  #new_v_tbl table,
  #div_label_tbl table,
  #div_district_tbl table,
  #div_brand_tbl table,
  #new_v_tbl th,
  #div_label_tbl th,
  #div_district_tbl th,
  #div_brand_tbl th,
  #new_v_tbl td,
  #div_label_tbl td,
  #div_district_tbl td,
  #div_brand_tbl td {
    border: 1px solid gray;
    border-collapse: collapse;
  }

  .btn-outline-secondary {
    color: black;
  }
</style>

<div class="row" style="padding-left: 10px;margin:0px">
  <h3 class="vehicle">{{ trans('module4.license')}}
    <!-- <a href="#" class="button" data-url="{{route('newVehicle')}}" data-id="0" onclick="vehicleNewModal(this)">{{ trans('button.new_vehicle')}}</a> -->
    <a class="button" data-toggle="tab" id="btn_latest_vehicle" href="#vehicle_list_tab" style="height: 29px;padding: 5px 10px;">{{ trans('button.latest_vehicle')}}</a>
    <a class="button" data-toggle="tab" id="btn_new_vehicle_stats" href="#new_vehicle_stats_tab" style="height: 29px;padding: 5px 10px;">{{ trans('button.new_vehicle_stats')}}</a>
    <a class="button" data-toggle="tab" id="btn_notIn_system" href="#vehicles_not_in_system_tab" style="height: 29px;padding: 5px 10px;">{{ trans('button.vehicles_not_in_system')}}</a>
  </h3>
</div>
<div class="card-body" style="padding-top: 0px; margin-top: 0px;">
  <div class="tab-content clearfix">
    <!-- **************************************** Vehicle List Tab **************************************** -->
    <div class="tab-pane active" id="vehicle_list_tab">
      <div class="row" id="search" style="background:#cdf;padding-left: 5px;padding-top: 5px ;margin:0px;width: 100%;">
        {{ trans('module4.general')}}:<input type="text" class="w130 mr-2" id="s_general" style="font-family: Saysettha OT !important;" title="Search for division_no, province_no, licence_no, owner_name, engine_no and chassis_no">
        {{ trans('module4.province')}}:<input type="text" class="w90 mr-2" id="s_province_name">
        {{ trans('module4.village')}}:<input type="text" class="w90 mr-2" id="s_village_name">
        {{ trans('module4.name')}}:<input type="text" class="w100 mr-2" id="s_owner_name">
        {{ trans('module4.target_number')}}:<input type="text" class="w40 mr-2" id="s_vehicle_kind_code">
        {{ trans('module4.issue_date')}}:<input type="text" class="w70 mr-2" id="s_issueDate">
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
          {{ trans('module4.license_no_search')}}:<input type="text" class="w60" id="s_licenseNo" maxlength="7">
          {{ trans('module4.vehicle_type')}}: <input type="text" class="w70" id="s_vehicle_type_name">
          {{ trans('module4.brand')}}: <input type="text" class="w70" id="s_brand_name">
          {{ trans('module4.model')}}: <input type="text" class="w70" id="s_model_name">
          {{ trans('module4.engine_no')}}: <input type="text" class="w100" id="s_engine_no" style="font-family:Saysettha OT !important;">
          {{ trans('module4.chassis_no')}}: <input type="text" class="w100" id="s_chassis_no" style="font-family:Saysettha OT !important;">
          {{ trans('module4.traffic_color')}}: <input type="text" class="w70" id="s_color_name">
          {{ trans('module4.cc')}}: <input type="text" class="w40" id="s_cc">
          {{ trans('module4.year')}}: <input type="text" class="w40 date-year" id="s_year_manufacture">
          <br>
          {{ trans('module4.import_permit_no')}}: <input type="text" class="w120 mt-2 mb-2" id="s_import_permit_no">
          {{ trans('module4.industrial_doc_no')}}: <input type="text" class="w120 mt-2 mb-2" id="s_industrial_doc_no">
          {{ trans('module4.technical_doc_no')}}: <input type="text" class="w120 mt-2 mb-2" id="s_technical_doc_no">
          {{ trans('module4.comerce_permit_no')}}: <input type="text" class="w120 mt-2 mb-2" id="s_comerce_permit_no">
          <br>
          {{ trans('module4.special_case_car')}}: <input type="text" class="w70" disabled>
          ສົ່ງ Online ໂດຍ: <input name="submit_by" id="ssubmit_by" class="w70" disabled>
          ສົ່ງ Online ວັນທີ: <input name="submit_date" id="ssubmit_date" class="w70" disabled>
          {{ trans('module4.license_3_digits')}}: <input type="text" class="w70" disabled>
          Last Print: <input name="last_printed_by" id="slast_printed_by" class="w70" disabled>
          Print Count: <input name="print_count" id="sprint_count" class="w70" disabled>
          ເຂົ້າຂໍ້ມູນ(Log): <input name="log" id="slog" class="w70" disabled>
          <br>

          <a href="#" id="advanced-show" class="button" onclick="$(&quot;#advanced-search&quot;).slideUp();$(&quot;#advanced-show&quot;).show()">{{ trans('module4.close_advanced_search')}}</a>

        </div>
      </div>

      <div style="color:red;">{{ trans('module4.not_allow_to_publish')}}</div>

      <!-- pagination row -->
      <div class="row" style="margin-top: 5px;margin-bottom: 10px;">
        <div class="col col-md-1"></div>
        <div class="col col-md-3">
          <span title="Total No. of Vehicles">
            ລວມ: (<span id="total-vehicles"></span>)
          </span>
        </div>
        <div class="col-md-5 text-center">
          <a class="pagin-prev" title="Go to previous page" onclick="searchVehicles(-1)">ກັບໜ້າ</a>
          <span id="cpage">1</span> / <span id="spages"></span>
          <a class="pagin-next" title="Go to next page" onclick="searchVehicles(1)">ໜ້າຕໍ່ໄປ</a>
        </div>
        <div class="col col-md-2"></div>
      </div>
      <!-- pagination row end -->

      <div id="loader" class="lds-dual-ring hidden overlay"></div>

      <div id="search-result"></div>
    </div>
    <!-- ************************************************************************************************** -->

    <!-- ************************************** New Vehicle Stats Tab ************************************* -->
    <div class="tab-pane" id="new_vehicle_stats_tab">
      <h3 style="border-top: 1px solid gray; border-bottom: 1px solid gray;padding-left: 0px;">
        {{ trans('module4.v_stats_title') }}{{ auth()->user()->user_info->province->name?? '' }} ({{ auth()->user()->user_info->province->name_en?? '' }})
      </h3>

      <div class="row" style="margin-top: 5px;">
        <div class="col-md-12">
          <label style="font-weight: bold;">{{ trans('module4.v_stats_during_date') }}:</label>
          <input class="custom_date w120" name="during_date" id="during_date" value="{{date('d/m/Y')}}" maxlength="10" title="{{ trans('module4.v_stats_during_date') }}">

          <label style="font-weight: bold;">{{ trans('module4.v_stats_to_date') }}:</label>
          <input class="custom_date w120" name="to_date" id="to_date" value="{{date('d/m/Y')}}" maxlength="10" title="{{ trans('module4.v_stats_to_date') }}">

          <label style="font-weight: bold;">{{ trans('module4.province') }}:</label>
          <select name="province" id="province" class="w200" title="{{ trans('module4.province') }}">
            <option value="" selected disabled hidden>--Select Province--</option>
            @foreach($province_code_list as $pc)
            <option value="{{$pc->province_code}}" {{ $pc->province_code == (auth()->user()->user_info->province_code?? '')?"selected":"" }}>{{ $pc->name }}&nbsp;({{$pc->name_en}})</option>
            @endforeach
          </select>

          <a class="button" id="v_stats_search" href="#" style="height: 29px;padding: 1px 10px;" onclick="loadVehicleStats()">{{ trans('button.v_stats_search')}}</a>
          <label style="font-style: italic;">( {{ trans('module4.v_stats_mindfulness') }} )</label>
        </div>
      </div>

      <div class="row" style="margin-top: 2px; margin-bottom: 4px;">
        <div class="col-md-12">
          <a href="#" class="link" onclick="">{{ trans('module4.v_stats_excel_download') }}</a>
        </div>
      </div>

      <div id="stats_loader" class="lds-dual-ring hidden overlay"></div>

      <div id="v_stats_Search_Result" style="overflow-y: auto;height: 450px;"></div>
    </div>
    <!-- ************************************************************************************************** -->

    <!-- ********************************** Vehicle Not in the system Tab ********************************* -->
    <div class="tab-pane" id="vehicles_not_in_system_tab">
      <hr style="margin-top: 0px;margin-bottom: 10px;">

      <div class="row">
        <div class="col-md-12">
          <a class="button" href="#" style="height: 29px;padding: 1px 10px;" data-id="0" onclick="vehicleOverSystemModal(this, 'new')">{{ trans('button.print_non_existent')}}</a>

          <label style="font-weight: bold;margin-left: 10px;">{{ trans('module4.search_license_no') }}:</label>
          <input class="w120" name="search_license_no" id="search_license_no" onfocusout="loadVehicleOverSystem(0)">

          <label style="font-weight: bold;margin-left: 10px;">{{ trans('module4.search_all') }}:</label>
          <input class="w120" name="search_all" id="search_all" onfocusout="loadVehicleOverSystem(0)">
        </div>
      </div>

      <!-- pagination row -->
      <div class="row" style="margin-top: 5px;margin-bottom: 10px;">
        <div class="col col-md-1"></div>
        <div class="col col-md-3">
          <span title="Total No. of Records">
            ລວມ: (<span id="total_records"></span>)
          </span>
        </div>
        <div class="col-md-5 text-center">
          <a class="prev_page" title="Go to previous page" onclick="loadVehicleOverSystem(-1)">ກັບໜ້າ</a>
          <span id="cur_page">1</span> / <span id="total_pages"></span>
          <a class="next_page" title="Go to next page" onclick="loadVehicleOverSystem(1)">ໜ້າຕໍ່ໄປ</a>
        </div>
        <div class="col col-md-2"></div>
      </div>
      <!-- pagination row end -->

      <div id="not_in_loader" class="lds-dual-ring hidden overlay"></div>

      <div id="v_not_in_system_Result"></div>
    </div>
    <!-- ************************************************************************************************** -->
  </div>
</div>


@if($data != null)
<!-- start print area for Pink1 in module4 -->
<div id="printPaper2"></div>
<!-- end print area -->
<!-- start print area for Pink2 in module4 -->
<div id="Pink2"></div>
<!-- end print area -->
<!-- start print area for certificate in module4 -->
<div id="certificate"></div>
<!-- end print area -->
<!-- start print area for certificate in module4 -->
<div id="book"></div>
<!-- end print area -->
<div id="printTransfer"></div>
<!-- start print area for document certificate in module4 -->
<div id="document-certificate"></div>
<!-- end print area -->
<!-- start print area for damaged certificate in module4 -->
<div id="damaged-certificate"></div>
<!-- end print area -->
<!-- start print area for  certificate used in module4 -->
<div id="certificate-used"></div>
<!-- end print area -->
<!-- start print area for  Elimination license  in module4 -->
<div id="elimination-license"></div>
<!-- end print area -->
@endif
<div id="printNewPaper"></div>

@endsection

@push('page_scripts')

<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="{{asset('vrms2/js/jquery_print.js')}}"></script>
<script type="text/javascript">
  var dist_url = "{{url('/getdistrict/')}}";
  var get_vmodal = "{{url('/getVmodel/')}}";

  (function() {
    loadPage();
  })();

  //========================================= Header Buttons Click Event =========================================
  $(document).on('click', '#btn_latest_vehicle', function(e) {
    $(this).addClass("btn-secondary");
    $("#btn_new_vehicle_stats").removeClass('active');
    $("#btn_new_vehicle_stats").removeClass('btn-secondary');
    $("#btn_notIn_system").removeClass('active');
    $("#btn_notIn_system").removeClass('btn-secondary');

    loadPage();
  });

  $(document).on('click', '#btn_new_vehicle_stats', function(e) {
    $(this).addClass("btn-secondary");
    $("#btn_latest_vehicle").removeClass('active');
    $("#btn_latest_vehicle").removeClass('btn-secondary');
    $("#btn_notIn_system").removeClass('active');
    $("#btn_notIn_system").removeClass('btn-secondary');

    loadVehicleStats();
  });

  $(document).on('click', '#btn_notIn_system', function(e) {
    $(this).addClass("btn-secondary");
    $("#btn_latest_vehicle").removeClass('active');
    $("#btn_latest_vehicle").removeClass('btn-secondary');
    $("#btn_new_vehicle_stats").removeClass('active');
    $("#btn_new_vehicle_stats").removeClass('btn-secondary');

    loadVehicleOverSystem(0);
  });

  //Add auto space after two letter in SearchLicenseNo.
  $('#s_licenseNo').keyup(function() {
    var code = $(this).val().split(" ").join("");
    if (code.length > 0) {
      if (code.length == 5) {
        code = code.split(/(?=.{3}$)/).join(' ').replace(/[!@\/\\#+()$~%^&,`.'";|\[\]:*?<>{}=_-]/g, '');
      }else if (code.length == 6 || code.length == 7) {
        code = code.split(/(?=.{4}$)/).join(' ').replace(/[!@\/\\#+()$~%^&,`.'";|\[\]:*?<>{}=_-]/g, '');
      }else {
        code = code.split(/(?=.{4}$)/).join(' ').replace(/[!@\/\\#+()$~%^&,`.'";|\[\]:*?<>{}=_-]/g, '');
      }
    }
    $(this).val(code);
  });

  //All Search Input Control Event
  $('#search').on('keydown', 'input', function(e) {
    if (e.keyCode === 13) {
      e.preventDefault();
      e.stopImmediatePropagation();

      searchVehicles(0);
    }
  });
  //==============================================================================================================
  function loadPage() {
    $(".pagin-prev").hide();
    $.ajax({
        url: "/load-vehicles",
        type: 'GET',
        cache: false,
        dataType: 'html',
        beforeSend: function() { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
          $('#loader').removeClass('hidden')
        },
        success: function(data) {
          var current_page = 1;
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
          $('#loader').addClass('hidden');
        },
      })
      .fail(function() {
        $('#serch-result').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
        $('#loader').addClass('hidden');
      });
  }

  function searchVehicles(c_page) {
    var surl = "/search-vehicles";

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
          //console.log(data);
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

  function loadVehicleStats() {
    var during_date = $("#during_date").val();
    var to_date = $("#to_date").val();
    var province_code = $("#province :selected").val();
    var province_name = $("#province :selected").text();

    if (!during_date) {
      alert('You need to choose "' + $('#during_date').attr('title') + '".');
      $("#during_date").focus();
      return false;
    }
    if (!to_date) {
      alert('You need to choose "' + $('#to_date').attr('title') + '".');
      $("#to_date").focus();
      return false;
    }
    if (!province_code) {
      alert('You need to choose "' + $('#province').attr('title') + '".');
      $("#province").focus();
      return false;
    }

    $.ajax({
        url: "/load-vehicle-stats",
        type: 'GET',
        cache: false,
        data: {
          during_date: during_date,
          to_date: to_date,
          province_code: province_code,
          province_name: province_name
        },
        dataType: 'html',
        beforeSend: function() { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
          $('#stats_loader').removeClass('hidden')
        },
        success: function(data) {
          $('#v_stats_Search_Result').html(data);
        },
        complete: function() { // Set our complete callback, adding the .hidden class and hiding the spinner.
          $('#stats_loader').addClass('hidden');
        },
      })
      .fail(function() {
        $('#v_stats_Search_Result').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
        $('#stats_loader').addClass('hidden');
      });
  }

  function loadVehicleOverSystem(c_page) {
    var license_no = $("#search_license_no").val();
    var search_all = $("#search_all").val();
    var current_page = parseInt($('#cur_page').html()) + parseInt(c_page);

    //call Serach function
    $.ajax({
        url: "/load_vehicle_over_system",
        type: 'GET',
        cache: false,
        data: {
          current_page: current_page,
          license_no: license_no,
          search_all: search_all
        },
        dataType: 'html',
        beforeSend: function() { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
          $('#not_in_loader').removeClass('hidden');
        },
        success: function(data) {
          var total_pages = 0;
          $('#v_not_in_system_Result').html(data);
          total_records = $('#t_records').html();
          total_pages = $('#t_notIn_pages').html();

          $('#total_records').html(total_records);
          $('#cur_page').html(current_page);
          $('#total_pages').html(total_pages);

          if (total_pages == 1 || total_pages == 0 || total_pages == current_page) {
            $(".next_page").hide();
          } else {
            $(".next_page").show();
          }

          if (current_page == 1) {
            $(".prev_page").hide();
          } else {
            $(".prev_page").show();
          }
        },
        complete: function() { // Set our complete callback, adding the .hidden class and hiding the spinner.
          $('#not_in_loader').addClass('hidden');
        },
      })
      .fail(function() {
        $('#v_not_in_system_Result').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
        $('#not_in_loader').addClass('hidden');
      });
  }

  //========================================= Vehicle Modal Start =========================================
  function vehicleModal(data, operation) {
    var id = 0;
    var url_id = "";
    if (operation == "Search_License") {
      id = data;
      url_id = "/edit-vehicle/" + id;
    }else if (operation == "re_load") {
      id = data+"re_load";
      url_id = "/edit-vehicle/" + data;
    } else {
      id = $(data).data('id');
      url_id = $(data).data('url');
    }

    var vModal = getVehicleModal(id);

    // Init the modal if it hasn't been already.
    if (!vModal) {
      vModal = initVehicleModal(id);
    }

    var html =
      '<div class="modal-header" style="border-bottom:none; padding:1.15rem 1rem">' +
      '<h3  class="modal-title" style="width:98%; margin-top:-8px; font-size: 19px; border-bottom:none;color:blue;font-weight:bold;">' +
      '{{ trans("module4.vehicle_title") }}' +
      '<ul class="nav nav-tabs pt-2" style="width: 1100px;">' +
      '<li class="nav-item">' +
      '<a class="nav-link active" data-toggle="tab" aria-current="page" href="#vehicleInfo' + id + '">{{ trans("module4.veh_info") }}</a>' +
      '</li>' +
      '<li class="nav-item">' +
      '<a class="nav-link" data-toggle="tab" href="#log' + id + '">{{ trans("module4.history_of_change") }}</a>' +
      '</li>' +
      '<li class="nav-item">' +
      '<a class="nav-link" data-toggle="tab" href="#document' + id + '">{{ trans("module4.document") }}</a>' +
      '</li>' +
      '<li class="nav-item">' +
      '<a class="nav-link" data-toggle="tab" href="#tenant-info' + id + '">{{ trans("module4.tenant_info") }}</a>' +
      '</li>' +
      '<li class="nav-item">' +
      '<label style = "margin-left:60px;font-size:13px;margin-right:10px;">{{ trans("module4.search_license") }}:</label>' +
      '<input type="text" name="search_license" id="search_license" style="width:170px; font-size:13px;" maxlength="7" placeholder="Search License No."/>' +
      '</li>' +
      '</ul>' +
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

    setVehicleModalContent(html, id);

    // Show the modal.
    $(vModal).modal('show');
    // ---------------

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
      $("#dModaldm").remove();
      $(this).remove();
    });

  }

  function getVehicleModal(id) {
    return document.getElementById('vModal' + id);
  }

  function setVehicleModalContent(html, id) {
    getVehicleModal(id).querySelector('.modal-content').innerHTML = html;
  }

  function initVehicleModal(id) {
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
      '<div class="modal-dialog modal-xl modal-dialog-scrollable" role="document" style="position: fixed;top: -23px;display: block;left: 5%;">' +
      '<div class="modal-content">' +
      '</div>' +
      '</div>';
    document.body.appendChild(modal);
    return modal;
  }
  //width:1190px;height:830px
  //========================================= Vehicle Modal End =========================================

  //========================================= Vehicle New Modal Start =========================================
  function vehicleNewModal(data) {
    var url_id = $(data).data('url');
    var id = $(data).data('id');

    var vnModal = getVehicleNewModal(id);

    // Init the modal if it hasn't been already.
    if (!vnModal) {
      vnModal = initVehicleNewModal(id);
    }

    var html =
      '<div class="modal-header" style="border-bottom:none; padding:1.15rem 1rem">' +
      '<h3  class="modal-title" style="margin-top:-8px; font-size: 19px; border-bottom:none;color:blue;font-weight:bold;">ທະບຽນລົດ' +
      '<ul class="nav nav-tabs pt-2" style="width: 1100px;">' +
      '<li class="nav-item">' +
      '<a class="nav-link active" data-toggle="tab" aria-current="page" href="#vehicleInfo1">{{ trans("module4.veh_info") }}</a>' +
      '</li>' +
      '<li class="nav-item">' +
      '<a class="nav-link" data-toggle="tab" href="#log' + id + '">{{ trans("module4.history_of_change") }}</a>' +
      '</li>' +
      '<li class="nav-item">' +
      '<a class="nav-link" data-toggle="tab" href="#document' + id + '">{{ trans("module4.document") }}</a>' +
      '</li>' +
      '<li class="nav-item">' +
      '<a class="nav-link" data-toggle="tab" href="#tenant-info' + id + '">{{ trans("module4.tenant_info") }}</a>' +
      '</li>' +
      '</ul>' +
      '</h3>' +
      '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
      '<span aria-hidden="true">&times;</span>' +
      '</button>' +

      '</div>' +
      '<div class="modal-body vn' + id + '"  style="padding: 0px 10px !important;">' +
      /* modal body start */
      '<div class="text-center">' +
      '<div class="spinner-border text-primary" role="status" style="width: 4rem; height: 4rem;">' +
      '<span class="sr-only">Loading...</span>' +
      '</div>' +
      '</div>' +
      /* modal body end */
      '</div>';

    setVehicleNewModalContent(html, id);

    // Show the modal.
    $(vnModal).modal('show');
    // ---------------

    $.ajax({
        url: url_id,
        type: 'GET',
        dataType: 'html'
      })
      .done(function(data) {
        //$('.show-modal').html('');
        $('.vn' + id).html(data);
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

    $(vnModal).on('hidden.bs.modal', function(e) {
      $("#dModaldm").remove();
      $(this).remove();
    });

  }

  function getVehicleNewModal(id) {
    return document.getElementById('vnModal' + id);
  }

  function setVehicleNewModalContent(html, id) {
    getVehicleNewModal(id).querySelector('.modal-content').innerHTML = html;
  }

  function initVehicleNewModal(id) {
    var modal = document.createElement('div');
    modal.classList.add('modal', 'fade');
    modal.setAttribute('id', 'vnModal' + id);
    modal.setAttribute('tabindex', '-1');
    modal.setAttribute('role', 'dialog');
    modal.setAttribute('data-backdrop', 'false');
    modal.setAttribute('data-backdrop', 'false');
    modal.setAttribute('data-keyboard', 'false');
    modal.setAttribute('aria-labelledby', 'vehicleModalLabel');
    modal.setAttribute('aria-hidden', 'true');
    modal.innerHTML =
      '<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document" style="position: fixed;top: -28px;display: block;left: 75px;">' +
      '<div class="modal-content" style="width:1190px;height:800px">' +
      '</div>' +
      '</div>';
    document.body.appendChild(modal);
    return modal;
  }
  //========================================= Vehicle New Modal End =========================================

  //========================================= Chassis Modal Start =======================================
  function engineModal(obj) {
    //var name = btn.innerHTML;
    // data start
    var url_id = $(obj).data('url');
    var id = $(obj).data('id');

    //alert(id);

    var eModal = getEngineModal(id);

    // Init the modal if it hasn't been already.
    if (!eModal) {
      eModal = initEngineModal(id);
    }

    var html =
      '<div class="modal-header" style="border-bottom:none; padding:1.15rem 1rem">' +
      '<h3  class="modal-title" style="margin-top:-8px; font-size: 19px; border-bottom:none">' +
      '<span style="font-weight:bold;">ທະບຽນລົດ</span>' +
      '<ul class="nav nav-tabs pt-2" style="width: 104%">' +

      '<li class="nav-item" style="color:#000;">' +
      'ຄົ້ນຫາ========>' +
      '</li>' +
      '<li class="nav-item">' +
      '<a class="nav-link active" data-toggle="tab" aria-current="page" href="#engineInfo' + id + '">ຂໍ້ມູນ</a>' +
      '</li>' +

      '<li class="nav-item">' +
      '<input class="w250" name="province_no" value="">' +
      '</li>' +

      '<li class="nav-item" style="color:#000;">' +
      '&nbsp;<a href="#"><-- ເລກກົມ</a>&nbsp;' +
      '<a href="#">ເລກກົມ --></a>' +
      '</li>' +

      '</ul>' +
      '</h3>' +
      '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
      '<span aria-hidden="true">&times;</span>' +
      '</button>' +

      '</div>' +
      '<div class="modal-body e' + id + '" >' +
      /* modal body start */
      '<div class="text-center">' +
      '<div class="spinner-border text-primary" role="status" style="width: 4rem; height: 4rem;">' +
      '<span class="sr-only">Loading...</span>' +
      '</div>' +
      '</div>' +
      /* modal body end */
      '</div>';

    setEngineModalContent(html, id);

    // Show the modal.
    $(eModal).modal('show');
    // ---------------
    $.ajax({
        url: url_id,
        type: 'GET',
        dataType: 'html'
      })
      .done(function(data) {
        //$('.show-modal').html('');
        $('.e' + id).html(data);
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

    $(eModal).on('hidden.bs.modal', function(e) {
      $(this).remove();
    });

  }

  function getEngineModal(id) {
    return document.getElementById('eModal' + id);
  }

  function setEngineModalContent(html, id) {
    getEngineModal(id).querySelector('.modal-content').innerHTML = html;
  }

  function initEngineModal(id) {
    var modal = document.createElement('div');
    modal.classList.add('modal', 'fade');
    modal.setAttribute('id', 'eModal' + id);
    modal.setAttribute('tabindex', '-1');
    modal.setAttribute('role', 'dialog');
    modal.setAttribute('data-backdrop', 'false');
    modal.setAttribute('data-backdrop', 'false');
    modal.setAttribute('data-keyboard', 'false');
    modal.setAttribute('aria-labelledby', 'engineModalLabel');
    modal.setAttribute('aria-hidden', 'true');
    modal.innerHTML =
      '<div class="modal-dialog modal-lg" role="document">' +
      '<div class="modal-content" >' +
      '</div>' +
      '</div>';
    document.body.appendChild(modal);
    return modal;
  }
  //========================================= Chassis Modal End =========================================

  //========================================= "New Application Form" button event to call modal =========================================
  function pinkPaperAndNewFormModal(obj, operation) {
    //operation (update, new_form, pink1, pink2)
    
    var id = $(obj).data('id');
    var owner_name = $("#owner_name").val();

    var pModal = getPinkPaperModal(id);

    // Init the modal if it hasn't been already.
    if (!pModal) {
      pModal = initPinkPaperModal(id);
    }

    var html =
      '<div class="modal-header">' +
      '<h3 style="padding: 0px;text-align: center;">' +
      '<span style="font-weight:bold;">{{ trans("module4.please_select_one") }}</span>' +
      '</h3>' +
      '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
      '<span aria-hidden="true">&times;</span>' +
      '</button>' +

      '</div>' +
      '<div class="modal-body p' + id + '" style="margin-top:0px;padding-top:0px;">' +
      /* modal body start */
      '<div class="text-center">' +
      '<div class="spinner-border text-primary" role="status" style="width: 4rem; height: 4rem;">' +
      '<span class="sr-only">Loading...</span>' +
      '</div>' +
      '</div>' +
      /* modal body end */
      '</div>';

    setPinkPaperModalContent(html, id);
    // Show the modal.
    $(pModal).modal('show');
    // ---------------
    $.ajax({
        url: "/pink-paper-modal",
        type: 'GET',
        data: {
          vehicle_id: id,
          owner_name: owner_name,
          operation: operation
        },
        dataType: 'html'
      })
      .done(function(data) {
        $('.p' + id).html(data);
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

    $(pModal).on('hidden.bs.modal', function(e) {
      $(this).remove();
    });

  }

  function getPinkPaperModal(id) {
    return document.getElementById('pModal' + id);
  }

  function setPinkPaperModalContent(html, id) {
    getPinkPaperModal(id).querySelector('.modal-content').innerHTML = html;
  }

  function initPinkPaperModal(id) {
    var modal = document.createElement('div');
    modal.classList.add('modal', 'fade');
    modal.setAttribute('id', 'pModal' + id);
    modal.setAttribute('tabindex', '-1');
    modal.setAttribute('role', 'dialog');
    modal.setAttribute('data-backdrop', 'false');
    modal.setAttribute('data-backdrop', 'false');
    modal.setAttribute('data-keyboard', 'false');
    modal.setAttribute('aria-labelledby', 'pinkPaperModalLabel');
    modal.setAttribute('aria-hidden', 'true');
    modal.innerHTML =
      '<div class="modal-dialog modal-lg" role="document" style="position: fixed;top: 10px;display: block;left: 20%;">' +
      '<div class="modal-content">' +
      '</div>' +
      '</div>';
    document.body.appendChild(modal);
    return modal;
  }
  //========================================= Pink Paper modal end =========================================

  //======================================== Transfer Modal Start ========================================
  function transferModal(obj) {

    //var url_id = $(obj).data('url');
    var id = $(obj).data('id');

    var base_url = window.location.origin;
    var turl = base_url + "/transfer-modal/" + id;

    var tModal = getTransferModal(id);

    // Init the modal if it hasn't been already.
    if (!tModal) {
      tModal = initTransferModal(id);
    }

    var html =
      '<div class="modal-header">' +
      '<h3 style="padding: 0px;text-align: center;">' +
      '<span style="font-weight:bold;">{{ trans("module4.transfer_info")}}</span>' +
      '</h3>' +
      '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
      '<span aria-hidden="true">&times;</span>' +
      '</button>' +

      '</div>' +
      '<div class="modal-body t' + id + '" style="margin-top:0px;padding-top:0px;">' +
      /* modal body start */
      '<div class="text-center">' +
      '<div class="spinner-border text-primary" role="status" style="width: 4rem; height: 4rem;">' +
      '<span class="sr-only">Loading...</span>' +
      '</div>' +
      '</div>' +
      /* modal body end */
      '</div>';

    setTransferModalContent(html, id);

    // Show the modal.
    $(tModal).modal('show');
    // ---------------
    $.ajax({
        url: turl,
        type: 'GET',
        dataType: 'html'
      })
      .done(function(data) {
        //$('.show-modal').html('');
        $('.t' + id).html(data);
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

    $(tModal).on('hidden.bs.modal', function(e) {
      $(this).remove();
    });

  }

  function getTransferModal(id) {
    return document.getElementById('tModal' + id);
  }

  function setTransferModalContent(html, id) {
    getTransferModal(id).querySelector('.modal-content').innerHTML = html;
  }

  function initTransferModal(id) {
    var modal = document.createElement('div');
    modal.classList.add('modal', 'fade');
    modal.setAttribute('id', 'tModal' + id);
    modal.setAttribute('tabindex', '-1');
    modal.setAttribute('role', 'dialog');
    modal.setAttribute('data-backdrop', 'false');
    modal.setAttribute('data-backdrop', 'false');
    modal.setAttribute('data-keyboard', 'false');
    modal.setAttribute('aria-labelledby', 'transferModalLabel');
    modal.setAttribute('aria-hidden', 'true');
    modal.innerHTML =
      '<div class="modal-dialog modal-xl modal-dialog-scrollable" role="document" style="position: fixed;top: 10px;display: block;left: 6%;">' +
      '<div class="modal-content">' +
      '</div>' +
      '</div>';
    document.body.appendChild(modal);
    return modal;
  }
  //========================================= Transfer Modal End =========================================

  //========================================= Document Modal Start =========================================
  function docModal(btn) {
    //var url_id = $(btn).data('url');
    var id = $(btn).data('id');
    var doc_type_id = $(btn).data('doc_type_id');
    var vehicle_detail_id = $(btn).data('vehicle_detail_id');
    var filename = $(btn).data('filename');
    var dModal = getDocModal(id);
    var route = "{{route('updatevDocument')}}";
    // Init the modal if it hasn't been already.
    if (!dModal) {
      dModal = initDocModal(id);
    }

    var html =
      '<div class="modal-header">' +
      '<h3 style="padding: 0px;text-align: center;">' +
      'Edit Document File' +
      '</h3>' +
      '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
      '<span aria-hidden="true">&times;</span>' +
      '</button>' +

      '</div>' +
      '<form name="frmEditDoc"  id="frmEditDoc" method="POST" enctype="multipart/form-data">' +
      '<div class="modal-body d' + id + '">' +
      /* modal body start */
      /* modal body end */
      '</div>' +
      '<div class="modal-footer">' +
      '<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">{{trans("button.cancel")}}</button>' +
      '<button type="button" id="btnEditDoc" class="btn btn-success btn-sm">{{trans("button.save")}}</button>' +
      '</div>' +
      '</form>';


    var da = '<div class="modal-body">' +
      '<div class="form-row">' +
      '<input  type="file" name="filename" id="filename" accept=".pdf,.png,.jpg,.jpeg"  class="form-control" required>' +
      '<br/>' +
      '<div id="filearea" class="text-info">' + filename + '</div>' +
      '<input type="hidden" name="doc_type_id" value="' + doc_type_id + '">' +
      '<input type="hidden" name="vehicle_detail_id" value="' + vehicle_detail_id + '">' +
      '</div>' +
      '</div>';

    setDocModalContent(html, id);

    // Show the modal.
    $(dModal).modal('show');
    $('.d' + id).html(da);
    // Jquery draggable
    $('.modal-dialog').draggable({
      handle: ".modal-body, .modal-header"
    });

    $(dModal).on('hidden.bs.modal', function(e) {
      $(this).remove();
    });

  }

  function getDocModal(id) {
    return document.getElementById('dModal' + id);
  }

  function setDocModalContent(html, id) {
    getDocModal(id).querySelector('.modal-content').innerHTML = html;
  }

  function initDocModal(id) {
    var modal = document.createElement('div');
    modal.classList.add('modal', 'fade');
    modal.setAttribute('id', 'dModal' + id);
    modal.setAttribute('tabindex', '-1');
    modal.setAttribute('role', 'dialog');
    modal.setAttribute('data-backdrop', 'false');
    // modal.setAttribute('pointer-events', 'auto');  
    modal.setAttribute('data-keyboard', 'false');
    modal.setAttribute('aria-labelledby', 'documentModalLabel');
    modal.setAttribute('aria-hidden', 'true');
    modal.innerHTML =
      '<div class="modal-dialog modal-lg" role="document" style="position: fixed;top: 20px;display: block;left: 20%;">' +
      '<div class="modal-content" style="width:800px;height:400px;">' +
      '<form action="" method="POST" id="EditDoc" name="editdoc" enctype="multipart/form-data">' +

      '</form>' +
      '</div>' +
      '</div>';
    document.body.appendChild(modal);
    return modal;
  }
  //========================================= Document Modal End =========================================

  //========================================= Print Buttons Modal Start ===================================
  function buttonModal(obj, button_type) {
    var vehicle_id = $(obj).data('id');
    var button_type = button_type;
    var title = "";

    if (button_type == "Document Certification") {
      title = '{{ trans("module4.document_certification") }}';
    } else if (button_type == "Certificate Used Instead") {
      title = '{{ trans("module4.certificate_used_instead") }}';
    } else if (button_type == "Elimination License") {
      title = '{{ trans("module4.elination_license") }}';
    } else if (button_type == "Certificate") {
      title = '{{ trans("module4.certificate") }}';
    } else if (button_type == "Damaged Certificate") {
      title = '{{ trans("module4.damaged_certificate") }}';
    }
    var bModal = getButtonModal(vehicle_id);

    // Init the modal if it hasn't been already.
    if (!bModal) {
      bModal = initButtonModal(vehicle_id);
    }

    var html =
      '<div class="modal-header">' +
      '<h3 style="padding: 0px;text-align: center;">' +
      '<span style="font-weight:bold;">' + title + '</span>' +
      '</h3>' +
      '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
      '<span aria-hidden="true">&times;</span>' +
      '</button>' +

      '</div>' +
      '<div class="modal-body b' + vehicle_id + '" style="margin-top:0px !important;padding-top:0px !important;">' +
      /* modal body start */
      '<div class="text-center">' +
      '<div class="spinner-border text-primary" role="status" style="width: 4rem; height: 4rem;">' +
      '<span class="sr-only">Loading...</span>' +
      '</div>' +
      '</div>' +
      /* modal body end */
      '</div>';

    setButtonModalContent(html, vehicle_id);
    // Show the modal.
    $(bModal).modal('show');
    // ---------------
    $.ajax({
        url: "/print-buttons-modal",
        type: 'GET',
        data: {
          vehicle_id: vehicle_id,
          button_type: button_type
        },
        dataType: 'html'
      })
      .done(function(data) {
        //console.log(data);
        $('.b' + vehicle_id).html(data);
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

    $(bModal).on('hidden.bs.modal', function(e) {
      $(this).remove();
    });

  }

  function getButtonModal(vehicle_id) {
    return document.getElementById('bModal' + vehicle_id);
  }

  function setButtonModalContent(html, vehicle_id) {
    getButtonModal(vehicle_id).querySelector('.modal-content').innerHTML = html;
  }

  function initButtonModal(vehicle_id) {
    var modal = document.createElement('div');
    modal.classList.add('modal', 'fade');
    modal.setAttribute('id', 'bModal' + vehicle_id);
    modal.setAttribute('tabindex', '-1');
    modal.setAttribute('role', 'dialog');
    modal.setAttribute('data-backdrop', 'false');
    modal.setAttribute('data-backdrop', 'false');
    modal.setAttribute('data-keyboard', 'false');
    modal.setAttribute('aria-labelledby', 'printButtonModalLabel');
    modal.setAttribute('aria-hidden', 'true');
    modal.innerHTML =
      '<div class="modal-dialog modal-lg" role="document" style="position: fixed;top: 50px;display: block;left: 300px;">' +
      '<div class="modal-content" style="width:700px;height:480px;">' +
      '</div>' +
      '</div>';
    document.body.appendChild(modal);
    return modal;
  }
  //========================================= Print Buttons Modal End =====================================

  //====================================== Vehicle Over System Modal Start ================================
  function vehicleOverSystemModal(obj, operation) {
    var v_over_system_id = $(obj).data('id');

    var nonModal = getVehicleOverSystemModal(v_over_system_id);

    // Init the modal if it hasn't been already.
    if (!nonModal) {
      nonModal = initVehicleOverSystemModal(v_over_system_id);
    }

    var html =
      '<div class="modal-header">' +
      '<h3 style="padding: 0px;text-align: center;">' +
      '<span style="font-weight:bold;">{{ trans("module4.certificate_doc_notIn_system") }}</span>' +
      '</h3>' +
      '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
      '<span aria-hidden="true">&times;</span>' +
      '</button>' +

      '</div>' +
      '<div class="modal-body non' + v_over_system_id + '" style="margin-top:0px !important;padding-top:0px !important;">' +
      /* modal body start */
      '<div class="text-center">' +
      '<div class="spinner-border text-primary" role="status" style="width: 4rem; height: 4rem;">' +
      '<span class="sr-only">Loading...</span>' +
      '</div>' +
      '</div>' +
      /* modal body end */
      '</div>';

    setVehicleOverSystemModalContent(html, v_over_system_id);
    // Show the modal.
    $(nonModal).modal('show');
    // ---------------
    $.ajax({
        url: "/vehicle-over-system-modal",
        type: 'GET',
        data: {
          v_over_system_id: v_over_system_id,
          operation: operation
        },
        dataType: 'html'
      })
      .done(function(data) {
        $('.non' + v_over_system_id).html(data);
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

    $(nonModal).on('hidden.bs.modal', function(e) {
      $(this).remove();
    });

  }

  function getVehicleOverSystemModal(v_over_system_id) {
    return document.getElementById('nonModal' + v_over_system_id);
  }

  function setVehicleOverSystemModalContent(html, v_over_system_id) {
    getVehicleOverSystemModal(v_over_system_id).querySelector('.modal-content').innerHTML = html;
  }

  function initVehicleOverSystemModal(v_over_system_id) {
    var modal = document.createElement('div');
    modal.classList.add('modal', 'fade');
    modal.setAttribute('id', 'nonModal' + v_over_system_id);
    modal.setAttribute('tabindex', '-1');
    modal.setAttribute('role', 'dialog');
    modal.setAttribute('data-backdrop', 'false');
    modal.setAttribute('data-backdrop', 'false');
    modal.setAttribute('data-keyboard', 'false');
    modal.setAttribute('aria-labelledby', 'vehicleOverSystemModalLabel');
    modal.setAttribute('aria-hidden', 'true');
    modal.innerHTML =
      '<div class="modal-dialog modal-lg" role="document" style="position: fixed;top: -23px;display: block;left: 280px;">' +
      '<div class="modal-content" style="width:700px;height:580px;">' +
      '</div>' +
      '</div>';
    document.body.appendChild(modal);
    return modal;
  }
  //====================================== Vehicle Over System Modal End ===============================

  //====================================== License Alert Modal Start ================================
  function licenseAlertModal(licenseNoPresent_id) {
    var alertModal = getLicenseAlertModal(licenseNoPresent_id);

    // Init the modal if it hasn't been already.
    if (!alertModal) {
      alertModal = initLicenseAlertModal(licenseNoPresent_id);
    }

    var html =
      '<div class="modal-header">' +
      '<h3 style="padding: 0px;text-align: center;">' +
      '<span style="font-weight:bold;">{{ trans("module4.lic_alert_msg_title") }}</span>' +
      '</h3>' +
      '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
      '<span aria-hidden="true">&times;</span>' +
      '</button>' +

      '</div>' +
      '<div class="modal-body alert' + licenseNoPresent_id + '" style="margin-top:0px !important;padding-top:0px !important;">' +
      /* modal body start */
      '<div style="margin-top:16px;" ><label>{{ trans("module4.lic_alert_msg") }}</label></div>' +
      '<div style="margin-top:10px;" class="row">' +
      '<div class="col-md-1 col-sm-1">' +
      '<input type="hidden" name="licenseNoPresent_id" id="licenseNoPresent_id" value="' + licenseNoPresent_id + '">' +
      '<input type="hidden" name="alert_token" id="alert_token" value="<?php echo csrf_token(); ?>">' +
      '<input type="checkbox" name="alert_at" id="alert_at" style = "margin-top:4px;">' +
      '</div>' +
      '<div class="col-md-5 col-sm-5" style="padding-top:8px;">' +
      '{{ trans("module4.lic_do_not_warm") }}' +
      '</div>' +
      '<div class="col-md-6 col-sm-6 text-right" style="margin-top:4px;">' +
      '<button type="button" id="changeAlertAt" class="btn btn-success btn-sm">{{trans("button.close")}}</button>' +
      '</div>' +
      '</div>'
    /* modal body end */
    '<div class="text-center">' +
    '<div class="spinner-border text-primary" role="status" style="width: 4rem; height: 4rem;">' +
    '<span class="sr-only">Loading...</span>' +
    '</div>' +
    '</div>' +
    /* modal body end */
    '</div>';

    setLicenseAlertModalContent(html, licenseNoPresent_id);
    // Show the modal.
    $(alertModal).modal('show');

    // Jquery draggable
    $('.modal-dialog').draggable({
      handle: ".modal-body, .modal-header"
    });

    $(alertModal).on('hidden.bs.modal', function(e) {
      $(this).remove();
    });

  }

  function getLicenseAlertModal(licenseNoPresent_id) {
    return document.getElementById('alertModal' + licenseNoPresent_id);
  }

  function setLicenseAlertModalContent(html, licenseNoPresent_id) {
    getLicenseAlertModal(licenseNoPresent_id).querySelector('.modal-content').innerHTML = html;
  }

  function initLicenseAlertModal(licenseNoPresent_id) {
    var modal = document.createElement('div');
    modal.classList.add('modal', 'fade');
    modal.setAttribute('id', 'alertModal' + licenseNoPresent_id);
    modal.setAttribute('tabindex', '-1');
    modal.setAttribute('role', 'dialog');
    modal.setAttribute('data-backdrop', 'false');
    modal.setAttribute('data-backdrop', 'false');
    modal.setAttribute('data-keyboard', 'false');
    modal.setAttribute('aria-labelledby', 'licenseAlertModalLabel');
    modal.setAttribute('aria-hidden', 'true');
    modal.innerHTML =
      '<div class="modal-dialog" role="document" style="position: fixed;top: 30%;display: block;left: 30%;">' +
      '<div class="modal-content">' +
      '</div>' +
      '</div>';
    document.body.appendChild(modal);
    return modal;
  }
  //====================================== License Alert System Modal End ===============================

  //====================================== Smart Card Modal Start ================================
  function cardModal(obj) {
    var vehicle_id = $(obj).data('id');

    var scardModal = getCardModal(vehicle_id);

    // Init the modal if it hasn't been already.
    if (!scardModal) {
      scardModal = initCardModal(vehicle_id);
    }

    var html =
      '<div class="modal-header" style="border-bottom:none;height:30px;">' +
      '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
      '<span aria-hidden="true">&times;</span>' +
      '</button>' +

      '</div>' +
      '<div class="modal-body scardModal' + vehicle_id + '" style="margin-top:0px !important;padding-top:0px !important;">' +
      /* modal body start */
      '<div class="text-center">' +
      '<div class="spinner-border text-primary" role="status" style="width: 4rem; height: 4rem;">' +
      '<span class="sr-only">Loading...</span>' +
      '</div>' +
      '</div>' +
      /* modal body end */
      '</div>';

    setCardModalContent(html, vehicle_id);
    // Show the modal.
    $(scardModal).modal('show');

    // ---------------
    $.ajax({
        url: "/card_modal",
        type: 'GET',
        data: {
          vehicle_id: vehicle_id
        },
        dataType: 'html'
      })
      .done(function(data) {
        $('.scardModal' + vehicle_id).html(data);
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

    $(scardModal).on('hidden.bs.modal', function(e) {
      $(this).remove();
    });

  }

  function getCardModal(vehicle_id) {
    return document.getElementById('scardModal' + vehicle_id);
  }

  function setCardModalContent(html, vehicle_id) {
    getCardModal(vehicle_id).querySelector('.modal-content').innerHTML = html;
  }

  function initCardModal(vehicle_id) {
    var modal = document.createElement('div');
    modal.classList.add('modal', 'fade');
    modal.setAttribute('id', 'scardModal' + vehicle_id);
    modal.setAttribute('tabindex', '-1');
    modal.setAttribute('role', 'dialog');
    modal.setAttribute('data-backdrop', 'false');
    modal.setAttribute('data-backdrop', 'false');
    modal.setAttribute('data-keyboard', 'false');
    modal.setAttribute('aria-labelledby', 'licenseAlertModalLabel');
    modal.setAttribute('aria-hidden', 'true');
    modal.innerHTML =
      '<div class="modal-dialog" role="document" style="position: fixed;top: 10%;display: block;left: 30%;">' +
      '<div class="modal-content" style="width:666px;">' +
      '</div>' +
      '</div>';
    document.body.appendChild(modal);
    return modal;
  }
  //====================================== License Alert System Modal End ===============================

  //========================================= Print =========================================

  function pink1(id) {
    $.ajax({
        url: "/print-pink2/" + id,
        type: 'GET',
        cache: false,
        dataType: 'html'
      })
      .done(function(data) {
        $('#printPaper2').html(data);
        $('#printPaper2').print();
        $('#printPaper2').html("");

      })
      .fail(function() {
        $('#printPaper2s').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
        // $('#modal-loader').hide();
      });

    //jQuery('#printPaper2').print()
  }

  function pink2(id) {
    $.ajax({
        url: "/pink2/" + id,
        type: 'GET',
        cache: false,
        dataType: 'html'
      })
      .done(function(data) {
        $('#Pink2').html(data);
        $('#Pink2').print();
        $('#Pink2').html("");

      })
      .fail(function() {
        $('#Pink2').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
        // $('#modal-loader').hide();
      });

    //jQuery('#Pink2').print())
  }

  function book(obj) {
    var id = $(obj).data('id');
    //alert(id);
    //return false;
    var base_url = window.location.origin;
    var purl = base_url + "/book/" + id;
    $.ajax({
        url: purl,
        type: 'GET',
        cache: false,
        dataType: 'html'
      })
      .done(function(data) {
        $('#book').html(data);
        $('#book').print();
        $('#book').html("");

      })
      .fail(function() {
        $('#book').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
        // $('#modal-loader').hide();
      });

    //jQuery('#book').print())
  }

  function printTransfer(obj) {
    var id = $(obj).data('id');
    //alert(id);
    //return false;
    var base_url = window.location.origin;
    var purl = base_url + "/print-transfer/" + id;
    $.ajax({
        url: purl,
        type: 'GET',
        cache: false,
        dataType: 'html'
      })
      .done(function(data) {
        $('#printTransfer').html(data);
        $('#printTransfer').print();
        $('#printTransfer').html("");

      })
      .fail(function() {
        $('#printTransfer').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
        // $('#modal-loader').hide();
      });

    //jQuery('#vprint-transfer').print())
  }

  function vehiclePrints(obj) {
    var vehicle_id = $("#vehicle_id").val();
    var print_detail_id = $("#print_detail_id").val();
    var button_type = $("#button_type").val();
    let _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/vehicle_prints",
        type: "POST",
        data: {
          vehicle_id: vehicle_id,
          print_detail_id: print_detail_id,
          button_type: button_type,
          _token: _token
        },
        dataType: 'html'
      })
      .done(function(data) {
        //console.log(data);
        if (button_type == "Document Certification") {
          $('#document-certificate').html(data);
          $('#document-certificate').print();
          $('#document-certificate').html("");
        } else if (button_type == "Certificate Used Instead") {
          $('#certificate-used').html(data);
          $('#certificate-used').print();
          $('#certificate-used').html("");
        } else if (button_type == "Elimination License") {
          $('#elimination-license').html(data);
          $('#elimination-license').print();
          $('#elimination-license').html("");
        } else if (button_type == "Certificate") {
          $('#certificate').html(data);
          $('#certificate').print();
          $('#certificate').html("");
        } else if (button_type == "Damaged Certificate") {
          $('#damaged-certificate').html(data);
          $('#damaged-certificate').print();
          $('#damaged-certificate').html("");
        }
      })
      .fail(function() {
        //console.log(data);
        if (button_type == "Document Certification") {
          $('#document-certificate').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
        } else if (button_type == "Certificate Used Instead") {
          $('#certificate-used').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
        } else if (button_type == "Elimination License") {
          $('#elimination-license').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
        } else if (button_type == "Certificate") {
          $('#certificate').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
        } else if (button_type == "Damaged Certificate") {
          $('#damaged-certificate').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
        }
      });

  }

  function documentCertificateForOverSystem(obj) {
    var v_over_system_id = $("#v_over_system_id").val();

    $.ajax({
        url: "/document_certificate_over_system/" + v_over_system_id,
        type: 'GET',
        cache: false,
        dataType: 'html'
      })
      .done(function(data) {
        $('#document-certificate').html(data);
        $('#document-certificate').print();
        $('#document-certificate').html("");

      })
      .fail(function() {
        $('#document-certificate').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
        // $('#modal-loader').hide();
      });

    //jQuery('#document-certificate').print()
  }
  //==============================================================================================================================

  //========================================= js for getting division_no and province_no =========================================
  $(document).on("click", '#div_control_btn', function() {
    var form = $(this).closest('form')[0];
    var province_code = $(form).find('select[name=province_code]').val();
    var province_Name = $(form).find('select[name=province_code]').find('option:selected').text();

    if (province_code == null) {
      alert($(form).find('select[name=province_code]').attr('title'));
      $(form).find('select[name=province_code]').focus();
      return false;
    }

    $.ajax({
      type: 'GET',
      url: '/getDivNo/' + province_code + '/' + province_Name,
      success: function(data) {
        //console.log(data);
        if (data.div_no == null || data.pro_no == null) {
          if (data.div_msg != "") {
            alert(data.div_msg);
            return false;
          } else if (data.pro_msg != "") {
            alert(data.div_msg);
            return false;
          }
          // $('#divError').text('You need to check division_no control.');
          // $("#proError").text("You need to check province_no control.");
        } else {
          if ($('[name="division_no"]').val() == '') {
            $('[name="division_no"]').val(data.div_no);
            if (data.div_msg != "") {
              alert(data.div_msg);
            }
          }

          // ================ Create Today Date =================
          var now = new Date();
          var day = ("0" + now.getDate()).slice(-2);
          var month = ("0" + (now.getMonth() + 1)).slice(-2);
          var today = (day)+ "/" + (month)+ "/" + now.getFullYear();

          $('[name="province_no"]').val(data.pro_no);
          $('[name="issue_date"]').val(today).change();
          $("#div_control_btn").addClass('disable-btn');
        }
      }
    });
  });
  //==============================================================================================================================

  //========================================= js for getting new license auto generating =========================================
  $(document).on("click", '#lic_control_btn', function() {
    var vehicle_id = $(this).data('id');
    var form = $(this).closest('form')[0];
    var vehicle_kind = $(form).find('select[name=vehicle_kind_code]').val();
    var vehicle_type_id = $(form).find('select[name=vehicle_type_id]').val();
    var province_code = $(form).find('select[name=province_code]').val();

    if (vehicle_kind == null) {
      alert($(form).find('select[name=vehicle_kind_code]').attr('title'));
      $(form).find('select[name=vehicle_kind_code]').focus();
      return false;
    } else if (vehicle_kind == 5 || vehicle_kind == 8) {
      alert("Don't let to generate Licnese No. for vehicle kind code '5' and '8'.");
      $(form).find('select[name=vehicle_kind_code]').focus();
      return false;
    } else if (province_code == null) {
      alert($(form).find('select[name=province_code]').attr('title'));
      $(form).find('select[name=province_code]').focus();
      return false;
    } else if (vehicle_type_id == null) {
      alert($(form).find('select[name=vehicle_type_id]').attr('title'));
      $(form).find('select[name=vehicle_type_id]').focus();
      return false;
    }

    $.ajax({
      type: 'GET',
      url: '/getLicenceNo/' + vehicle_id,
      data: {
        vehicle_kind_code: vehicle_kind,
        vehicle_type_id: vehicle_type_id,
        province_code: province_code
      },
      success: function(data) {
        console.log(data);
        if (data.status == "OK") {
          $("#licence_no").val(data.licence_no);
          $("#lic_control_btn").addClass('disable-btn');

          if (data.license_msg == "alert_at_over" && data.alert_at == 1) {
            licenseAlertModal(data.licenseNoPresent_id);
          }
        } else {
          alert(data.error);
        }

      },
      error: function(error) {
        console.log("ERROR:" + error.responseText);
        var err = JSON.parse(error.responseText);
        alert(err.message);
      }
    });
  });
  //==============================================================================================================================

  //========================================= Save Button Event for Print Button Modal =========================================
  $(document).on('click', '#save_print_buttons', function(e) {
    e.preventDefault();

    var vehicle_id = $("#vehicle_id").val();
    var button_type = $("#button_type").val();
    var print_detail_id = $("#print_detail_id").val();

    var no = $("#no").val();
    var date = $("#date").val();
    var permanent = $("#permanent").val();
    var temporary = $("#temporary").val();
    var old_license_no = $("#old_license_no").val();
    var license_no = $("#license_no").val();

    var send_to = $("#send_to").val();
    var transport_no = $("#transport_no").val();

    var dated = $("#dated").val();
    var certificate_dated = $("#certificate_dated").val();

    var country_origin = $("#country_origin").val();
    var note = $("#note").val();

    let _token = $('meta[name="csrf-token"]').attr('content');

    if (!no) {
      alert('You need to add "' + $('#no').attr('title') + '".');
      $("#no").focus();
      return false;
    }
    if (!date) {
      alert('You need to choose "' + $('#date').attr('title') + '".');
      $("#date").focus();
      return false;
    }
    if (button_type == "Document Certification" || button_type == "Certificate Used Instead") {
      if (!permanent) {
        alert('You need to add "' + $('#permanent').attr('title') + '".');
        $("#permanent").focus();
        return false;
      }
      if (!temporary) {
        alert('You need to add "' + $('#temporary').attr('title') + '".');
        $("#temporary").focus();
        return false;
      }
      if (!old_license_no) {
        alert('You need to add "' + $('#old_license_no').attr('title') + '".');
        $("#old_license_no").focus();
        return false;
      }
      if (!license_no) {
        alert('You need to add "' + $('#license_no').attr('title') + '".');
        $("#license_no").focus();
        return false;
      }
      if (!dated) {
        alert('You need to choose "' + $('#dated').attr('title') + '".');
        $("#dated").focus();
        return false;
      }
      if (!certificate_dated) {
        alert('You need to choose "' + $('#certificate_dated').attr('title') + '".');
        $("#certificate_dated").focus();
        return false;
      }
    } else if (button_type == "Elimination License") {
      if (!send_to) {
        alert('You need to add "' + $('#send_to').attr('title') + '".');
        $("#send_to").focus();
        return false;
      }
      if (!transport_no) {
        alert('You need to add "' + $('#transport_no').attr('title') + '".');
        $("#transport_no").focus();
        return false;
      }
      if (!dated) {
        alert('You need to choose "' + $('#dated').attr('title') + '".');
        $("#dated").focus();
        return false;
      }
    } else if (button_type == "Certificate") {
      if (!country_origin) {
        alert('You need to add "' + $('#country_origin').attr('title') + '".');
        $("#country_origin").focus();
        return false;
      }
      if (!note) {
        alert('You need to add "' + $('#note').attr('title') + '".');
        $("#note").focus();
        return false;
      }
    } else if (button_type == "Damaged Certificate") {
      if (!permanent) {
        alert('You need to add "' + $('#permanent').attr('title') + '".');
        $("#permanent").focus();
        return false;
      }
      if (!dated) {
        alert('You need to choose "' + $('#dated').attr('title') + '".');
        $("#dated").focus();
        return false;
      }
    }

    $.ajax({
      url: "/save-vehicle_print_detail",
      type: "POST",
      data: {
        print_detail_id, print_detail_id,
        no: no,
        date: date,
        permanent: permanent,
        temporary: temporary,
        old_license_no: old_license_no,
        license_no: license_no,
        send_to: send_to,
        transport_no: transport_no,
        dated: dated,
        certificate_dated: certificate_dated,
        country_origin: country_origin,
        note: note,

        vehicle_id: vehicle_id,
        button_type: button_type,
        _token: _token
      },
      success: function(response) {
        console.log(response);
        if (response.status == "OK") {
          alert('Save ' + button_type + ' Success!');

          var vehicle_print_detail_id = response.vehicle_print_detail_id;
          $('#print_detail_id').val(vehicle_print_detail_id);

          const btn_save_print_buttons = document.getElementById('bModal' + vehicle_id).querySelector('#save_print_buttons');
          btn_save_print_buttons.classList.add('disabled');
          const btn_vehicle_print = document.getElementById('bModal' + vehicle_id).querySelector('#v_print');
          btn_vehicle_print.classList.remove('disabled');
        } else {
          alert('Error in saving ' + button_type + '!');
        }
      },
      error: function(error) {
        alert('Error in saving ' + button_type + ' Function!');
      }
    });

  });
  //============================================================================================================================

  //====================================== Save Button Event for Vehicle Over System Modal =====================================
  $(document).on('click', '#save_v_over_system', function(e) {
    e.preventDefault();

    var v_over_system_id = $("#v_over_system_id").val();
    var operation = $("#operation").val();
    var certificate_no = $("#certificate_no").val();
    var date = $("#date").val();
    var vehicle_type_id = $("#vehicle_type_id :selected").val();
    var chassis_no = $("#chassis_no").val();
    var engine_no = $("#engine_no").val();
    var year_manufacture = $("#year_manufacture").val();
    var origin = $("#origin").val();
    var cc = $("#cc").val();
    var brand_id = $("#brand_id :selected").val();
    var model_id = $("#model_id :selected").val();
    var color_id = $("#color_id :selected").val();
    var steering_id = $("#steering_id :selected").val();
    var note = $("#note").val();
    let _token = $('meta[name="csrf-token"]').attr('content');

    if (!certificate_no) {
      alert('You need to add "' + $('#certificate_no').attr('title') + '".');
      $("#certificate_no").focus();
      return false;
    }
    if (!date) {
      alert('You need to choose "' + $('#date').attr('title') + '".');
      $("#date").focus();
      return false;
    }
    if (!vehicle_type_id) {
      alert('You need to choose "' + $('#vehicle_type_id').attr('title') + '".');
      $("#vehicle_type_id").focus();
      return false;
    }
    if (!engine_no) {
      alert('You need to add "' + $('#engine_no').attr('title') + '".');
      $("#engine_no").focus();
      return false;
    }
    if (!chassis_no) {
      alert('You need to add "' + $('#chassis_no').attr('title') + '".');
      $("#chassis_no").focus();
      return false;
    }
    if (!year_manufacture) {
      alert('You need to choose "' + $('#year_manufacture').attr('title') + '".');
      $("#year_manufacture").focus();
      return false;
    }
    if (!origin) {
      alert('You need to add "' + $('#origin').attr('title') + '".');
      $("#origin").focus();
      return false;
    }
    if (!brand_id) {
      alert('You need to choose "' + $('#brand_id').attr('title') + '".');
      $("#brand_id").focus();
      return false;
    }
    if (!model_id) {
      alert('You need to choose "' + $('#model_id').attr('title') + '".');
      $("#model_id").focus();
      return false;
    }
    if (!cc) {
      alert('You need to add "' + $('#cc').attr('title') + '".');
      $("#cc").focus();
      return false;
    }
    if (!color_id) {
      alert('You need to choose "' + $('#color_id').attr('title') + '".');
      $("#color_id").focus();
      return false;
    }
    if (!steering_id) {
      alert('You need to choose "' + $('#steering_id').attr('title') + '".');
      $("#steering_id").focus();
      return false;
    }
    if (!note) {
      alert('You need to add "' + $('#note').attr('title') + '".');
      $("#note").focus();
      return false;
    }

    $.ajax({
      url: "/save_vehicle_over_system",
      type: "POST",
      data: {
        v_over_system_id: v_over_system_id,
        operation: operation,

        certificate_no: certificate_no,
        date: date,
        vehicle_type_id: vehicle_type_id,
        chassis_no: chassis_no,
        engine_no: engine_no,
        year_manufacture: year_manufacture,
        origin: origin,
        brand_id: brand_id,
        model_id: model_id,
        cc: cc,
        color_id: color_id,
        steering_id: steering_id,
        note: note,
        _token: _token
      },
      success: function(response) {
        //console.log(response);
        if (response.status == "OK") {
          if (operation == "new") {
            alert('Save Vehicle Over System Success!');
            const btn_save = document.getElementById('nonModal' + v_over_system_id).querySelector('#save_v_over_system');
            btn_save.classList.add('disabled');
            const btn_print = document.getElementById('nonModal' + v_over_system_id).querySelector('#v_over_system_print');
            btn_print.classList.remove('disabled');
          } else {
            alert('Update Vehicle Over System Success!');
          }

          loadVehicleOverSystem(0);
        } else {
          if (operation == "new") {
            alert('Error in saving Vehicle Over System!');
          } else {
            alert('Error in updating Vehicle Over System!');
          }
        }
      },
      error: function(error) {
        console.log(error.responseText);
        var err = JSON.parse(error.responseText);
        alert(err.message + "\n" + error.responseText);
      }
    });

  });
  //============================================================================================================================

  //====================================== Change Alert At for Alert Modal =====================================
  $(document).on('click', '#changeAlertAt', function(e) {
    var alert_at = $('#alert_at').prop('checked');
    var licenseNoPresent_id = $('#licenseNoPresent_id').val();
    let _token = $('meta[name="csrf-token"]').attr('content');

    if (alert_at == false) {
      $('#' + 'alertModal' + licenseNoPresent_id).modal('toggle'); //Close Modal
      return false;
    }

    $.ajax({
      type: 'POST',
      url: '/change_alert_at',
      data: {
        licenseNoPresent_id: licenseNoPresent_id,
        _token: _token
      },
      success: function(data) {
        //console.log(data);
        if (data.status == "OK") {
          alert(data.message);
        } else {
          alert("Something missing in update Alert At for License No. Present.");
        }

        $('#' + 'alertModal' + licenseNoPresent_id).modal('toggle'); //Close Modal
      },
      error: function(error) {
        //console.log(error.responseText);
        var err = JSON.parse(error.responseText);
        alert(err.message + "\n" + error.responseText);
      }
    });

  });
  //============================================================================================================================
</script>

<script type="text/javascript">
  //========================================= PinkpaperNewForm's Save Button Event =========================================
  $(document).on("click", "#btnNewApp", function(e) {
    e.preventDefault();
    var form = $(this).closest('form')[0];
    var formData = new FormData(form);
    var vid = $(form).find('input[name=vehicle_id]').val();
    
    if (($(form).find("input[name*='app_purpose_id']:checked").length) == 0) {
      alert("You must check at least 1 app purpose.");
      return false;
    }

    $.ajax({
      url: "new-appform/" + vid,
      type: "POST",
      data: formData,
      dataType: "json",
      processData: false,
      contentType: false,
      cache: false,
      success: function(data) {
        // console.log(data);
        if (data.status == "OK") {
          alert(data.message);

          $('#' + 'pModal' + vid).modal('toggle'); //Close Modal
        } else {
          if(data.status == "error"){
            alert(data.message);
          }else{
            alert("Something missing in Creating new application form.");
          }
        }
      },
      error: function(error) {
        // console.log(error.responseText);
        var err = JSON.parse(error.responseText);
        alert(err.message + "\n" + error.responseText);
      }
    });

  });
  //========================================================================================================================

  //========================= PinkpaperNewForm's Save & Print Button Event (PinkpaperNewForm.blade.php) ====================
  $(document).on('click', '#pinkpaperForm', function(e) {
    e.preventDefault();
    var form = $(this).closest('form')[0];
    var formData = new FormData(form);
    var vid = $(form).find('input[name=vehicle_id]').val();
    var operation = $(form).find('input[name=operation]').val();
    formData.append('_token', '{{csrf_token()}}');

    if (($(form).find("input[name*='app_purpose_id']:checked").length) == 0) {
      alert("You must check at least 1 app purpose.");
      return false;
    }

    $.ajax({
      url: '/new-form-pink-paper/' + vid,
      type: "POST",
      data: formData,
      dataType: "json",
      processData: false,
      contentType: false,
      cache: false,
      success: function(data) {
        // console.log(data);
        if (data.status == "OK") {
          alert(data.message);

          if(operation == "update" || operation == "new_form" || operation == "pink2"){
            pink2(vid);
          }else{//pink1
            pink1(vid);
          }
          
          $('#' + 'pModal' + vid).modal('toggle'); //Close Modal
        } else {
          if(data.status == "error"){
            alert(data.message);
          }else{
            alert("Something missing in Creating new application form.");
          }
        }
      },
      error: function(error) {
        //console.log(error.responseText);
        var err = JSON.parse(error.responseText);
        alert(err.message + "\n" + error.responseText);
      }
    });
  });

  // get print page and try to print out the application form
  function getprintPage(id) {
    var route = "{{url('/get-new-form-pink-paper')}}";

    $.ajax({
      url: route + '/' + id,
      type: "GET",
      data: '',
      dataType: "html",
      processData: false,
      contentType: false,
      cache: false,
      success: function(data) {
        $('#printNewPaper').html(data);
        $('.print-new-paper').print();
        $('#printNewPaper').html("");
      },
      error: function(data) {
        alert(data['error']);
        //console.log("error:"+data);
      }
    });

  }
  //========================================================================================================================

  //===================================== "Save" button event (TransferModal.blade.php) ====================================
  $(document).on("click", "#btnTransfer", function(e) {
    e.preventDefault();
    var form = $(this).closest('form')[0];
    var formData = new FormData(form);
    var transfer_to = $("#transfer_to :selected").val();
    if (!transfer_to) {
      alert($(form).find('input[name=transfer_to_title]').attr('title'));
      $(form).find('input[name=transfer_to]').focus();
      return false;
    }

    var route = "{{route('vehicle-transfer.store')}}";
    $.ajax({
      url: route,
      type: "POST",
      data: formData,
      dataType: "json",
      processData: false,
      contentType: false,
      cache: false,
      success: function(data) {
        //console.log(data);
        alert(data.message);
      },
      error: function(error) {
        //console.log(error.responseText);
        var err = JSON.parse(error.responseText);
        alert(err.message + "\n" + error.responseText);
      }
    });

  });

  //submit tenant info start
  $(document).on("click", "#btnTenant", function(e) {
    e.preventDefault();
    var form = $(this).closest('form')[0];
    var formData = new FormData(form);
    var im = "{{url('/images/tenant')}}";

    var tenant_name = $(form).find('input[name=tenant_name]').val();
    if (!tenant_name) {
      //alert($(form).find('input[name=tenant_name]').attr('title'));
      alert("Tenant Name should not be null.");
      $(form).find('input[name=tenant_name]').focus();
      return false;
    }

    var province_code = $("#tenant-province :selected").val();
    if (!province_code) {
      // alert($(form).find('input[name=province_code]').attr('title'));
      alert("Province should not be null.");
      $(form).find('input[name=province_code]').focus();
      return false;
    }

    var district_code = $("#tenant-district :selected").val();
    if (!district_code) {
      // alert($(form).find('input[name=district_code]').attr('title'));
      alert("District should not be null.");
      $(form).find('input[name=district_code]').focus();
      return false;
    }

    var village_name = $(form).find('input[name=village]').val();
    if (!village_name) {
      //alert($(form).find('input[name=village]').attr('title'));
      alert("Village Name should not be null.");
      $(form).find('input[name=village]').focus();
      return false;
    }

    var phone = $(form).find('input[name=phone]').val();
    if (!phone) {
      //alert($(form).find('input[name=phone]').attr('title'));
      alert("Village Name should not be null.");
      $(form).find('input[name=phone]').focus();
      return false;
    }

    $.ajax({
      url: "{{route('vehicle-tenant.store') }}",
      type: "POST",
      data: formData,
      dataType: "json",
      processData: false,
      contentType: false,
      cache: false,
      success: function(data) {
        //console.log(data);
        alert(data.success);
        if (data['img'] != "") {
          $(form).find('img[name=im]').attr('src', im + "/" + data['img']);
        } else {}
      },
      error: function(data) {
        alert(data);
        console.log(data);
      }
    });

  });
  // submit tenant info end

  //Save button for docModal (Document Modal) 
  $(document).on("click", "#btnEditDoc", function(e) {
    e.preventDefault();
    var form = $(this).closest('form')[0];
    var formData = new FormData(form);
    formData.append('_token', '{{csrf_token()}}');

    // var fileInput = $(form).find('input[name=filename]').val();

    // if (fileinput.length > 0) {
    //     alert("Has file!");
    // }else{
    //   alert("NO");
    // }
    // return false;

    //console.log($(form));  
    //return false;

    $.ajax({
      url: "{{route('updatevDocument') }}",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      cache: false,
      success: function(data) {
        console.log(data.message);
        alert(data.message);
        /*
        if(data['img'] !=""){
          $(form).find('img[name=im]').attr('src',im+"/"+data['img']);
        }else{}
        */

      },
      error: function(data) {
        alert(data);
        console.log(data);
      }
    });

  });
  // submit edit document  info end

  //=============================== Save Button Event of Document Tab =====================
  $(document).on("click", "#btnDoc", function(e) {
    e.preventDefault();
    var form = $(this).closest('form')[0];
    var formData = new FormData(form);
    formData.append('_token', '{{csrf_token()}}');

    var sid = $(form).find('input[name=id]').val();
    var surl = "{{url('veh-document')}}";

    $.ajax({
      url: surl + "/" + sid,
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      cache: false,
      success: function(data) {
        //console.log(data);

        alert(data.message);
      },
      error: function(data) {
        alert(data);
        console.log(data);
      }
    });

  });
  //=======================================================================================

  //===================== VehicleEdit Modal (Add VillageName, Color and Model Buttons Click Events) ===========
  $(document).on('click', '#add_village', function(e) {
    var district_code = $("#district :selected").val();

    if (district_code) {
      addVehicleModal("VillageName");
    } else {
      alert("You need to choose District.");
      $("#district").focus();
    }
  });

  $(document).on('click', '#add_color', function(e) {
    addVehicleModal("Color");
  });

  $(document).on('click', '#add_vehicle_model', function(e) {
    var vehicle_brand = $("#vbrand :selected").val();
    if (vehicle_brand) {
      addVehicleModal("Model");
    } else {
      alert("Firstly, you need to add \"Brand\" to add \"Model\".");
      $("#vbrand").focus();
    }

  });
  //=======================================================================================

  //================================= Save VillageName, Color and Model (add_vehicle_modal's Event) ============================
  $(document).on('click', '#btnAdd', function(e) {
    saveData("Modal");
  });

  function saveData(s_fun) {
    var vehicle_id = $("#vehicle_id").val();
    var district_code = $("#district :selected").val();
    var vehicle_brand = $("#vbrand :selected").val();
    let _token = $('meta[name="csrf-token"]').attr('content');

    var village_name = "";
    var color_name = "";
    var model_name = "";
    var s_type = "";

    if (s_fun == "Modal") {
      village_name = $("#new_village_name").val();
      color_name = $("#new_color_name").val();
      model_name = $("#new_model_name").val();
      s_type = $("#s_type").val();

      if (s_type == "VillageName") {
        if (!village_name) {
          alert("You need to add " + $('#new_village_name').attr('title') + ".");
          $("#new_village_name").focus();
          return false;
        }
      } else if (s_type == "Color") {
        if (!color_name) {
          alert("You need to add " + $('#new_color_name').attr('title') + ".");
          $("#new_color_name").focus();
          return false;
        }
      } else if (s_type == "Model") {
        if (!model_name) {
          alert("You need to add " + $('#new_model_name').attr('title') + ".");
          $("#new_model_name").focus();
          return false;
        }
      }
    } else {
      s_type = "VillageName";
      village_name = $("#village_name").val();
      if (!village_name) {
        alert("You need to add " + $('#village_name').attr('title'));
        $("#village_name").focus();
        return false;
      }
    }

    $.ajax({
      type: 'POST',
      url: '/add_village_color_model',
      data: {
        vehicle_id: vehicle_id,
        district_code: district_code,
        village_name: village_name,
        color_name: color_name,
        model_name: model_name,
        vehicle_brand: vehicle_brand,
        s_type: s_type,
        _token: _token
      },
      success: function(data) {
        //console.log(data);
        if (data.status == "OK") {
          if (data.operation == "add") {
            alert(data.success_msg);

            if (s_type == "VillageName") {
              $("#village_name").val(village_name);
            } else if (s_type == "Color") {
              $('#color_id').append(new Option(color_name, data.id));
              $("#color_id").val(data.id);
            } else if (s_type == "Model") {
              $('#vmodel').append(new Option(model_name, data.id));
              $("#vmodel").val(data.id);
            }
          } else {
            if (s_type == "VillageName") {
              $("#village_name").val(village_name);
            } else if (s_type == "Color") {
              $("#color_id").val(data.id);
            } else if (s_type == "Model") {
              $("#vmodel").val(data.id);
            }
          }

          //Close Modal
          if (s_fun == "Modal") {
            $('#' + 'addModal' + vehicle_id).modal('toggle');
          }
        } else {
          alert("Something missing in Adding new \"" + s_type + "\".");
        }
      },
      error: function(error) {
        //console.log(error.responseText);
        var err = JSON.parse(error.responseText);
        alert(err.message + "\n" + error.responseText);
      }
    });

  }
  //============================================================================================================================

  //================================================== Search General ==========================================================
  function generalFunction() {
    // Declare variables 
    var input, filter, table, tbody, tr, td, i, th;
    input = document.getElementById("s_general");
    filter = input.value.toUpperCase();
    table = document.getElementById("vTable");
    tbody = table.getElementsByTagName("tbody");
    //alert(tbody);
    tr = tbody[0].getElementsByTagName("tr");
    //th = table.getElementsByTagName("th");
    // th.style.display = "";

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      td1 = tr[i].getElementsByTagName("td")[1];
      td2 = tr[i].getElementsByTagName("td")[2];
      td3 = tr[i].getElementsByTagName("td")[3];
      td4 = tr[i].getElementsByTagName("td")[4];
      td5 = tr[i].getElementsByTagName("td")[5];
      td6 = tr[i].getElementsByTagName("td")[6];
      td7 = tr[i].getElementsByTagName("td")[7];
      td8 = tr[i].getElementsByTagName("td")[8];
      td9 = tr[i].getElementsByTagName("td")[9];
      td10 = tr[i].getElementsByTagName("td")[10];


      if (td && td1 && td2 && td3 && td4 && td5 && td6 && td7 && td8 && td9 && td10) {
        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else if (td1.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else if (td2.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else if (td3.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else if (td4.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else if (td5.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else if (td6.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else if (td7.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else if (td8.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else if (td9.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else if (td10.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }

      } else {

      }
    }
  }
  //============================================================================================================================

</script>

<script>
  /*
    
    
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
    */
  /*============= vehicle general search =========*/
</script>

<script src="{{ asset('vrms2/js/update_vehicle.js') }}"></script>
<script src="{{ asset('vrms2/js/vehicle-datepicker.js') }}"></script>
<script src="{{asset('vrms2/js/bootstrap-datepicker.min.js')}}"></script>
@endpush