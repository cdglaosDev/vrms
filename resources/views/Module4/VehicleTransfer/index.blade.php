@extends('vrms2.layouts.master')
@section('v_transfer_main_menu','active')
@section('content')

<style>
  @media screen {
    #printTransfer{
      display: none;
    }
  }

  .f-col {
    width: 70px;
  }

  .s-col,
  .t-col {
    min-width: 100px;
  }

  .fi-col,
  .si-col {
    min-width: 150px;
  }

  .te-col {
    width: 70px;
  }
</style>

<div class="row">
  <dvi class="col-md-6">

    <h3>@if($type =="In") {{ trans('module4.transfer_in')}} @else {{ trans('module4.transfer_out')}} @endif</h3>
  </dvi>
  <div class="col-md-6" style="padding-right: 30px;">

    <div class="row">
      <div class="col-md-2 col-sm-2"></div>
      <div class="col-md-6 col-sm-6" style="padding-top: 3px;">
        {{--<form action="#" method="get">--}}
        <div class="row">
          <div class="col-md-8 col-sm-8" style="padding: 0px;">
            <input type="text" name="transfer_no" class="form-control" placeholder="Enter Transfer Number" id="transfer_no">
            <input type="hidden" name="page" value="transfer">
          </div>
          <div class="col-md-4 col-sm-4" style="padding-left: 0px; padding-right: 0px;">
            <input type="submit" class="btn btn-primary btn-sm" value="{{ trans('button.search') }}" style="width: 100%;" onclick="searchVehicles('transfer_no_search', 0)">
          </div>
        </div>
        {{--</form>--}}
      </div>
      <div class="col-md-4 col-sm-4" style="padding: 0px 15px;">
        @can('Vehicle-Transferring-List-Approve')
        <a href="#" class="btn btn-success btn-sm approve_all" style="width: 100%;">{{trans('button.approve_all')}}</a>
        @endcan
      </div>
    </div>

  </div>
</div>

@include('flash')
<div class="card-body" style="padding-top: 0px;">
  <!-- Advanced Search row end -->
  <div class="row" id="search" style="background:#cdf;padding-left: 5px;padding-top: 5px ;margin:0px;">
    {{ trans('module4.license_no_search')}}:<input type="text" class="w60" id="s_licenseNo" onfocusout="searchVehicles('advance_search', 0)">
    {{ trans('module4.general')}}:<input type="text" class="w130" id="s_general">
    {{ trans('module4.province')}}:<input type="text" class="w90" id="s_province_name" onfocusout="searchVehicles('advance_search', 0)">
    {{ trans('module4.village')}}:<input type="text" class="w90" id="s_village_name" onfocusout="searchVehicles('advance_search', 0)">
    {{ trans('module4.name')}}:<input type="text" class="w100" id="s_owner_name" onfocusout="searchVehicles('advance_search', 0)">
    {{ trans('module4.target_number')}}:<input type="text" class="w40" id="s_vehicle_kind_code" onfocusout="searchVehicles('advance_search', 0)">
    {{ trans('module4.issue_date')}}:<input type="text" class="w70" id="s_issueDate" onfocusout="searchVehicles('advance_search', 0)">
    {{ trans('module4.sort')}}:
    <div class="form-group" style="display: inline;margin-right:5px;">
      <select class="form-control js-example-basic-single" style="width: 100%;height: 28px;padding:0px;" id="s_sort_by" onchange="searchVehicles('advance_search', 0)" required>
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
      {{ trans('module4.vehicle_type')}}: <input type="text" class="w70" id="s_vehicle_type_name" onfocusout="searchVehicles('advance_search', 0)">
      {{ trans('module4.brand')}}: <input type="text" class="w70" id="s_brand_name" onfocusout="searchVehicles('advance_search', 0)">
      {{ trans('module4.model')}}: <input type="text" class="w70" id="s_model_name" onfocusout="searchVehicles('advance_search', 0)">
      {{ trans('module4.engine_no')}}: <input type="text" class="w100" id="s_engine_no" onfocusout="searchVehicles('advance_search', 0)" style="font-family:Saysettha OT !important;">
      {{ trans('module4.chassis_no')}}: <input type="text" class="w100" id="s_chassis_no" onfocusout="searchVehicles('advance_search', 0)" style="font-family:Saysettha OT !important;">
      {{ trans('module4.traffic_color')}}: <input type="text" class="w70" id="s_color_name" onfocusout="searchVehicles('advance_search', 0)">
      {{ trans('module4.cc')}}: <input type="text" class="w70" id="s_cc" onfocusout="searchVehicles('advance_search', 0)">
      {{ trans('module4.year')}}: <input type="text" class="w70" id="s_year_manufacture" onfocusout="searchVehicles('advance_search', 0)">
      <br>

      {{ trans('module4.import_permit_no')}}: <input type="text" class="w120 mt-2 mb-2" id="s_import_permit_no" onfocusout="searchVehicles('advance_search', 0)">
      {{ trans('module4.industrial_doc_no')}}: <input type="text" class="w120 mt-2 mb-2" id="s_industrial_doc_no" onfocusout="searchVehicles('advance_search', 0)">
      {{ trans('module4.technical_doc_no')}}: <input type="text" class="w120 mt-2 mb-2" id="s_technical_doc_no" onfocusout="searchVehicles('advance_search', 0)">
      {{ trans('module4.comerce_permit_no')}}: <input type="text" class="w120 mt-2 mb-2" id="s_comerce_permit_no" onfocusout="searchVehicles('advance_search', 0)">
      <br>

      {{ trans('module4.special_case_car')}}: <input type="text" class="w120">
      {{ trans('module4.license_3_digits')}}: <input type="text" class="w120">
      <br>

      <a href="#" id="advanced-show" class="button" onclick="$(&quot;#advanced-search&quot;).slideUp();$(&quot;#advanced-show&quot;).show()">{{ trans('module4.close_advanced_search')}}</a>
    </div>
  </div>
  <div style="color:red;">{{ trans('module4.not_allow_to_publish')}}</div>
  <!-- Advanced Search row end -->

  <!-- pagination row -->
  <div class="row" style="margin-top: 0px;margin-bottom: 7px;">
    <div class="col col-md-1"></div>
    <div class="col col-md-3">
      <span class="total-records" title="Total No. of Vehicles">
        ລວມ: (<span id="total-records">{{$total_records}}</span>)
      </span>
    </div>
    <div class="col-md-5 text-center">
      <a class="pagin-prev" title="Go to previous page" onclick="searchVehicles(-1)" hidden>ກັບໜ້າ</a>
      <span id="cpage">1</span> / <span id="spages">{{ $total_pages == 0? 1 : $total_pages }}</span>
      <a class="pagin-next" title="Go to next page" onclick="searchVehicles(1)" @if($total_pages==1 || $total_pages==0)hidden @else show @endif>ໜ້າຕໍ່ໄປ</a>
    </div>
    <div class="col col-md-2"></div>
  </div>
  <!-- pagination row end -->

  <div id="search-result">
    <span style="display:none" id="t_records">{{$total_records}}</span>
    <span style="display:none" id="t_pages">{{$total_pages}}</span>
    <table class="table table-striped">
      <thead>
        <tr>
          <th><input type="checkbox" id="checkAll" /></th>
          <th class="f-col">{{ trans('module4.transfer_no')}}</th>
          @if($type == "Out")
          <th class="s-col">{{ trans('module4.transfer_to')}}</th>
          @elseif($type == "In")
          <th class="s-col">{{ trans('module4.transfer_from')}}</th>
          @endif
          <th class="t-col">{{ trans('common.date')}}</th>

          <th class="f-col">{{ trans('module4.vehicle_license_no') }}</th>
          <th class="fi-col">{{ trans('module4.name') }}</th>
          <th class="si-col">{{ trans('module4.village_district') }}</th>
          <th>{{ trans('module4.province_name') }}</th>
          <th>{{ trans('module4.v_type') }}</th>
          <th>{{ trans('module4.engine_no_chassis_no') }}</th>

          <th class="te-col">{{ trans('module4.app_status')}}</th>
          <th>{{ trans('common.action')}}</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($vehicle as $data)
        <tr>
          <td>
            <input type="checkbox" name="approve_list" class="app_list" value="{{ $data->id ?? '' }}">
          </td>
          <td>
            <span style="color: #3366BB;">{{ $data->AppForm->app_no }}</span><br>
            @can('Vehicle-Transferring-List-Approve')
            <a href="#" class="link transfer-modal" onclick="open_modal('view',{{ $data->id}})" data-toggle="modal" data-target="#transferModal" data-backdrop="static" data-keyboard="false">
              {{ $data->transfer_no }}
            </a>
            @endcan
          </td>
          @if($type == "Out")
          <td>{{ $data->province_tran_to->name ?? '' }}</td>
          @elseif($type == "In")
          <td> {{ $data->province_tran_from->name ?? '' }}</td>
          @endif
          <td>{{ $data->transfer_date}}</td>

          <td class="nowrap">
            <a href="#" class="link license_no" purpose_no="{{$data->AppForm->vehicle->vehicle_kind_code}}">
              @if(strlen($data->AppForm->vehicle->licence_no) == 0){{'0000'}} @else{{ $data->AppForm->vehicle->licence_no }} @endif
            </a><br>
            {{ $data->AppForm->vehicle->vehicle_kind->name ?? ''}}<br>
            <small style="color:#999">g5000</small>
          </td>
          <td>
            <a class="link">{{ $data->AppForm->vehicle->owner_name }}</a>
            <div style="text-decoration:underline;font-size:9px;color:#ccc;cursor:pointer">ປະຫວັດ</div>
          </td>
          <td>
            <div style="font-weight: bold;">{{ $data->AppForm->vehicle->village_name }}</div>
            <div style="color: #666;"><small>ມ.</small>{{ $data->AppForm->vehicle->district->name ?? '' }}</div>
          </td>
          <td>
            <div class="province" province_code="{{$data->AppForm->vehicle->province_code}}">{{ $data->AppForm->vehicle->province->name ?? ''}}</div>
            <div style="white-space:nowrap;color:#777;font-size:10px"><small>ກມ</small>{{ $data->AppForm->vehicle->division_no}}</div>
            <div style="white-space:nowrap;color:#aaa;font-size:10px"><small>ຂວ </small>{{ $data->AppForm->vehicle->province_no}}</div>
          </td>
          <td>{{ $data->AppForm->vehicle->vtype->name ?? '' }}</td>
          <td>
            <div style="font-family:Saysettha OT !important;">{{ $data->AppForm->vehicle->engine_no }}</div>
            <div>
              <a href="#" class="link" style="font-family:Saysettha OT !important;">{{ $data->AppForm->vehicle->chassis_no }}</a>
            </div>
          </td>
          <td>{{ $data->AppForm->app_status->name }}</td>
          <td width="220">
            <!-------------------- Approve Button -------------------->
            @can('Vehicle-Transferring-List-Approve')
            @if($type == "Out")
            <a href="#" class="btn-sm transfer-modal" title="" data-action="approve" data-id="{{ $data->id}}" data-tranno="{{ $data->transfer_no}}" data-appformid="{{ $data->app_form_id}}" data-tranto="{{ $data->transfer_to}}" data-toggle="modal" data-target="#approveconfirm" data-backdrop="static" data-keyboard="false">
              <img src="{{ asset('images/approved_btn.png') }}" alt="" title="{{trans('button.approve')}}" width="25px" height="25px">
            </a>

            @elseif($type == "In")
            <a href="#" onclick="open_modal('approve',{{ $data->id}})" class="btn-sm" data-toggle="modal" data-target="#transferModal" data-backdrop="static" data-keyboard="false">
              <img src="{{ asset('images/approved_btn.png') }}" alt="" title="{{trans('button.approve')}}" width="25px" height="25px">
            </a>
            @endif
            @endcan
            <!-------------------- End of Approve Button -------------------->

            <!-------------------- View Button -------------------->
            @can('Vehicle-Transfer-View')
            <a href="#" onclick="open_modal('view',{{ $data->id}})" class="btn-sm" data-toggle="modal" data-target="#transferModal" data-backdrop="static" data-keyboard="false">
              
              <img src="{{ asset('images/view.png') }}" alt="" title="{{trans('button.view')}}" width="25px" height="25px">
            </a>
            @endcan
            <!-------------------- End of View Button -------------------->

            <!-------------------- Cancle Button and Transit Button -------------------->
            @if($type == "Out")
            @can('Vehicle-Transfer-Cancel')
            <a href="#" class="transfer-modal" data-action="cancel" data-id="{{ $data->id}}" data-tranno="{{ $data->transfer_no}}" data-appformid="{{ $data->app_form_id}}" data-toggle="modal" data-target="#approveconfirm" data-backdrop="static" data-keyboard="false">
              <img src="{{ asset('images/rejected_btn.png') }}" alt="" title="{{trans('button.cancel')}}" width="25px" height="25px">
            </a>
            @endcan
            @elseif($type == "In")
            <a href="#" onclick="open_modal('transit',{{ $data->id}})" class="btn-sm" data-toggle="modal" data-target="#transferModal" data-backdrop="static" data-keyboard="false">
              <img src="{{ asset('images/submit.png') }}" alt="" title="{{trans('button.transit')}}" width="25px" height="25px">
            </a>
            @endif
            <!-------------------- End of Cancle Button and Transit Button -------------------->
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!------------------- Approve Confirm Modal ------------------->
<div class="modal fade" id="approveconfirm" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document" style="position: fixed;top: 200px;display: block;left: 500px;">
    <div class="modal-content" style="width:380px;height:170px;">
      <div class="modal-body text-center">
        <div class="row m-3">
          <div class="col-12">
            <h4>Do you want to <label id="txtoption"></label> the <br>
              Transfer No : <label id="txttranno"></label> ?</h4>
          </div>
        </div>
        <div class="row" style="margin-top: 20px; justify-content: space-between;">
          <div style="margin-left: 15px;">
            <button class="btn btn-default" style="background-color: #FA8072;width: 80px;" data-dismiss="modal">NO</button>
          </div>
          <div style="margin-right: 15px;">
            <a href="#" id="linkaction" class="btn btn-success w80">YES</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!------------------- Transfer Modal ------------------->
<div class="modal fade" id="transferModal" tabindex="-1" role="dialog" aria-labelledby="transferModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" id="md-dl" style="position: fixed;top: -28px;display: block;left: 80px;">
    <div id="transfer_content"></div>
  </div>
</div>

<!------------------- "Approve All Selected" Confirmation Modal ------------------->
<div class="modal fade" id="approve-all-modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document" style="position: fixed;top: 200px;display: block;left: 500px;">
    <div class="modal-content" style="width:380px;height:180px;">
      <form action="{{url('transfer-approve-all')}}" method="POST" id="approve_all-form">
        @method('POST') @csrf
        <div class="modal-header">
          <div class="col-md-11 text-center">
            <span class="text-center" style="font-size: 20px;">Do you really want to approve for all selected records?</span>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        </div>

        <input type="hidden" name="lst_transfer_id" id="lst_transfer_id" value="">
        <input type="hidden" name="transfer_type" id="transfer_type" value="{{ $type }}">

        <div class="row" style="margin: 10px 0px; justify-content: space-between;">
          <div style="margin-left: 15px;">
            <button class="btn btn-sm w80" style="background-color: #FA8072;" data-dismiss="modal">{{ trans('button.cancel') }}</button>
          </div>
          <div style="margin-right: 15px;">
            <button type="submit" class="btn btn-success btn-sm w80">Confirm</button>
          </div>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

@endsection
@push('page_scripts')
<script src="{{ asset('vrms2/js/jquery-ui.js') }}"></script>
<script src="{{asset('js/jquery_print.js')}}"></script>
<script>
  $("#checkAll").click(function() {
    var checked_status = this.checked;
    $('.app_list').prop("checked", checked_status);

  });

  $(document).ready(function() {
    $('.transfer-modal').on('click', function(e) {
      var tran_in_out = "{{ $type }}";

      $("#txttranno").text($(this).data('tranno'))
      $("#txtoption").text($(this).data('action'))

      if (tran_in_out == "In")
        $("#linkaction").attr("href", "{{ url('transfer-in-action') }}" + "/" + $(this).data('action') + "/" + $(this).data('appformid') + "/" + $(this).data('id') + "/" + $(this).data('tranto'))
      else if (tran_in_out == "Out")
        $("#linkaction").attr("href", "{{ url('transfer-out-action') }}" + "/" + $(this).data('action') + "/" + $(this).data('appformid') + "/" + $(this).data('id'))
    });
  });

  function open_modal(action, id) {
    var htmlloading = '<div class="row"><div class="col-12 text-center" style="padding: 120px;"><i class="fa fa-spinner fa-spin fa-lg" style="color:#9b9b9b"></i></div></div>'

    $("#transfer_content").html(htmlloading)
    $.ajax({
      url: "{{ url('transfer-info').'/' }}" + action + '/' + id,
      method: "get",
      success: function(data) {
        $("#transfer_content").html(data)
        if (action == "approve")
          document.getElementById("md-dl").style.left = "250px";
        else
          document.getElementById("md-dl").style.left = "80px";
      }
    });
  }

  $('.modal-dialog').draggable({
    handle: ".modal-body, .modal-header"
  });

  //Click "Approve All Selected" button
  $(".approve_all").click(function() {
    var lists = [];
    var isChecked = $(".app_list").is(":checked");
    if (isChecked) {
      $.each($("input[name='approve_list']:checked"), function() {
        lists.push($(this).val());
      });

      $("#approve-all-modal").modal('show');
      $('[name="lst_transfer_id"]').val(lists);
    } else {
      alert('There is no selected record to do approve.');
    }
  });

  //==========================================================================================
  function searchVehicles(search, c_page) {
    $('#search-result').html(
      '<div class="text-center">' +
      '<div class="spinner-border text-primary" role="status" style="width: 4rem; height: 4rem;">' +
      '<span class="sr-only">Loading...</span>' +
      '</div>' +
      '</div>');

    var base_url = window.location.origin;
    var purl = base_url + "/search-transfer";

    if (search == 'transfer_no_search') {
      var transfer_no = $("#transfer_no").val();

      //If "Transfer No." search, clear advance search's textboxes
      $("#s_licenseNo").val('');
      $("#s_general").val('');
      $("#s_province_name").val('');
      $("#s_village_name").val('');
      $("#s_owner_name").val('');
      $("#s_vehicle_kind_code").val('');
      $("#s_issueDate").val('');

      $("#s_vehicle_type_name").val('');
      $("#s_brand_name").val('');
      $("#s_model_name").val('');
      $("#s_engine_no").val('');
      $("#s_chassis_no").val('');
      $("#s_color_name").val('')
      $("#s_cc").val('');
      $("#s_year_manufacture").val('');
      $("#s_import_permit_no").val('');
      $("#s_industrial_doc_no").val('');
      $("#s_technical_doc_no").val('');
      $("#s_comerce_permit_no").val('');
    } else {
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

      //If not "Transfer No." search, clear  "Transfer No." search textbox
      $("#transfer_no").val('');
    }

    var transfer_in_out = "{{ $type }}";
    var current_page = parseInt($('#cpage').html()) + parseInt(c_page);
    var search_page = parseInt($('#spages').html());

    //call Serach function
    $.ajax({
        url: purl,
        type: 'GET',
        data: {
          current_page: current_page,
          search_page: search_page,

          transfer_in_out: transfer_in_out,
          transfer_no: transfer_no,
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
      })
      .fail(function() {
        $('#serch-result').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
      });
  }
  //==========================================================================================
  //print vehicle transfer
  $(document).on('click', '.btn-print-transfer', function(e) {
    jQuery('#printTransfer').print();
  });
</script>
@endpush