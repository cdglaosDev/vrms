@extends('vrms2.layouts.master')
@section('importer','active') 
@section('content')
@php
$preLicense =  \App\Model\VehicleDetail::getLicenseOnly();
$engineNo = \App\Model\VehicleDetail::getEngine();
$chassisNo = \App\Model\VehicleDetail::getChassis();
@endphp
<div class="row mt-3">
   <div class="col-md-3">
      <h3>
         {{trans('app_form.importer_list')}}
      </h3>
   </div>
   <div class="col-md-3 pt-2"> 
      @can('Importer-Application-Item-List-Create') 
      <a  class="btn btn-primary btn-sm btn-save" data-target="#newModal" data-backdrop="static" data-keyboard="false"  data-toggle="modal" >{{trans('customer.add_new')}}</a> <a href="" class="btn btn-primary btn-save btn-sm " data-toggle="modal" data-target="#ImportExcel">{{ trans('app_form.import_excel')}}</a>
      @endcan
   </div>
   <div class="col-md-6">
      <div class="row">
         <div class="col-md-8">
         <form  action="{{ url('/search-app')}}" method="GET">
           <div class="row">
               <div class="col-md-4 mt-2 px-0">
                  <select  name="app_status" class="form-control" style="height:27px">
                     <option value="">Select App Status</option>
                     <option value="4" @isset($app_status) {{ $app_status == 4?'selected':'' }} @endisset>Approved</option>
                     <option value="5" @isset($app_status) {{ $app_status == 5?'selected':'' }} @endisset>Rejected</option>
                     <option value="3" @isset($app_status) {{ $app_status == 3?'selected':'' }} @endisset>In Progress</option>
                     <option value="6" @isset($app_status) {{ $app_status == 6?'selected':'' }} @endisset>Draft</option>
                  </select>
               </div>
               <div class="col-md-5 mt-2 pl-2">
                  <input type="text" class="form-control" id="app_no" name="app_no" placeholder="App Number" value="">
               </div>
               <div class="col-md-3 mt-2">
               <button type="submit" class="btn btn-primary btn-sm">Search</button>
               </div>
            </div>
         </form>
         </div>
         <div class="col-md-4 pt-2">
            @can('Importer-Application-Item-Approve')
            <a href="#" class="btn btn-success btn-sm approve_all">{{trans('button.approve_all')}}</a>
            @endcan
         </div>
      </div>
   </div>
</div>
@include('flash')
@if(session()->has('failures'))
<div class="alert alert-dismissable alert-danger">
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
   <strong>
   @php $failures = session()->get('failures');  @endphp
   {{$failures[2]}}
   </strong>
</div>
@endif
@if(session()->has('message'))
<div class="alert alert-dismissable alert-danger">
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
   <strong>
   {{ session('message') }}
   </strong>
</div>
@endif
<div class="card-body">
   <!-- column search -->
   <div id="search">
      <input type="text" name="app_number" id="s_app_no"  placeholder="Type app no"  style="width: 115px;margin-left: 30px">
      <input type="text" name="owner_name" placeholder="Owner name" id="s_owner_name"  style="width: 150px;">
      <input type="text" name="pre_license" placeholder="Pre License" id="s_pre_license" style="width: 110px;">
      <input type="text" name="village" placeholder="Village Name" id="s_village"  style="width: 92px;">
      <input type="text" name="province" placeholder="Province" id="s_province"  style="width: 60px;">
      <input type="text" name="vehicle_type" placeholder="vehicle type" id="s_vehicle_type"   style="width: 85px;">
      <input type="text" name="barnd" placeholder="Brand" id="s_brand"   style="width: 74px;">
      <input type="text" name="model" placeholder="Model" id="s_model"  style="width: 93px;">
      <input type="text" name="engine_chassis" placeholder="Engine/chassis"  id="s_engine_no"   style="width: 140px;">
      <input type="hidden" name="page_no" value="1">
   </div>
   <!-- end column search -->
   <!-- start table wrapper -->
   <div id="importWrapper">
      <table id="importVeh" class="table table-striped" style="width:100%">
         <thead>
            <tr>
               <th><input type="checkbox" id="checkAll" /></th>
               <th style="width: 115px;">{{ trans('app_form.app_number') }}</th>
               <th style="width: 164px;">{{ trans('app_form.owner_name')}}</th>
               <th style="width: 121px;">{{ trans('app_form.pre_licence_no')}}</th>
               <th style="width: 105px;">{{ trans('app_form.village_name') }}</th>
               <th style="width: 83px;">{{ trans('vehicle.province')}}</th>
               <th style="width: 88px;">{{ trans('vehicle.vehicle_type')}}</th>
               <th style="width: 79px;">{{ trans('vehicle.brand')}}</th>
               <th style="width: 100px;">{{ trans('vehicle.model')}}</th>
               <th style="width: 145px;">{{ trans('module4.engine_no_chassis_no') }}</th>
               <th style="width: 115px;">{{ trans('app_form.app_status')}}</th>
               <th width="250">{{ trans('common.action')}}</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($pre_app as $data)
            <tr>
               <td>
                  <input type="checkbox" name="approve_list" @if(isset($data->app_status_id)){{ $data->app_status_id ==4 || $data->app_status_id ==5 || $data->app_status_id ==6 ? 'disabled' : '' }}@endif class="app_list" value="{{ $data->id ?? '' }}">
               </td>
               <td>
                     <a class="sameSize" id="appNumber{{$data->id}}"  style="color:#007bff">{{ $data->app_number??'' }}</a>  
                     <a style="color:#07279d; font-weight: bold;" data-backdrop="static" data-keyboard="false" class="btn_edit sameSize" data-url="{{route('import-vehicle.edit',['id'=>$data->vehicle_detail->id])}}" data-toggle="modal"  data-target="#editModal"> {{ $data->regapp_number??'' }}</a>
               
               </td>
               <td><span style="font-weight:bold">{{ $data->vehicle_detail->owner_name ?? '' }}</span></td>
               <td>
                  <a href=""  class="link license_no"  purpose_no="{{$data->vehicle_detail->vehicle_kind_code ?? ''}}">{{$data->vehicle_detail->licence_no_need??''}}</a>
                  <div style="text-align:center;white-space:nowrap;color:#444;font-size:11px;padding:0;max-width:80px">{{ $data->vehicle_detail->vehicleKind->name ?? ''}}</div>
               </td>
               <td>
                  <div style="font-weight:bold">{{ $data->vehicle_detail->village_name }}</div>
                  <div style="color:#666"><small>ມ</small>{{$data->vehicle_detail->district->name ?? ''}}</div>
               </td>
               <td>
                  <div class="province" province_code="{{ $data->province_code }}">{{ $data->vehicle_detail->province->name ?? ''}}</div>
               </td>
               <td>{{ $data->vehicle_detail->type->name }}</td>
               <td>{{ $data->vehicle_detail->brand->name ?? '' }}</td>
               <td>{{ $data->vehicle_detail->model->name ?? '' }}</td>
               <td>
                  <div class="sameSize">{{ $data->vehicle_detail->engine_no }}</div>
                  <div><a href="#" class="link sameSize">{{ $data->vehicle_detail->chassis_no }}</a></div>
               </td>
               <td >@if($data->app_status_id ==6) <img src="{{ asset('images/draft.png') }}" class="status_image{{ $data->id }}" title="{{trans('button.draft')}}" width="25" height="25"> @elseif($data->app_status_id ==5) <img src="{{ asset('images/rejected.png') }}" class="status_image{{ $data->id }}" width="25" height="25"> @elseif($data->app_status_id ==4) <img src="{{ asset('images/approved.png') }}" class="status_image{{ $data->id }}" width="25" height="25"> @elseif($data->app_status_id ==3) <img src="{{ asset('images/in_progress.png') }}" class="status_image{{ $data->id }}" width="25" height="25"> @else complete @endif</td>
               <td>
                  @can('Importer-Application-Item-Approve')
                  <!-- approved button -->
                  @if($data->app_status_id ==4  ||$data->app_status_id ==5 || $data->app_status_id ==6)
                  <a class="disabled" title="Approved"><img src="{{ asset('images/approve_gray.png') }}" alt="" title="{{trans('button.approve')}}" width="25" height="25"></a>
                  @else
                  <a class="approve" data-id="{{ $data->id }}"  title="Approved"><img src="{{ asset('images/approved_btn.png') }}" alt="" title="{{trans('button.approve')}}" id="approve_img{{$data->id}}" width="25" height="25"></a>
                  @endif
                  <!-- reject button  -->
                  @if($data->app_status_id == 4 || $data->app_status_id ==5 || $data->app_status_id ==6)
                  <a><img src="{{ asset('images/reject_gray.png') }}" alt="" width="25" height="25"></a> 
                  @else
                  <a href="" class="reject" data-toggle="modal"  title="Rejected" data-target="#RejectModel" data-backdrop="static" data-keyboard="false" data-app_status_id="{{$data->app_status_id}}" data-id="{{$data->id}}"><img src="{{ asset('images/rejected_btn.png') }}" alt="" title="{{trans('button.reject')}}" id="reject_img{{ $data->id }}" width="25" height="25"></a> 
                  @endif
                  @endcan
                  @if($data->app_status_id !=5)
                  <a data-url="{{route('import-vehicle.show',['id'=>$data->vehicle_detail->id])}}" class="show_btn" data-backdrop="static" data-keyboard="false"  data-toggle="modal"  data-target="#showModal"   ><img src="{{ asset('images/view.png') }}" alt="" title="{{trans('title.view')}}" width="25" height="25px"></a> 
                  @endif
                  @can('Importer-Application-Item-Entry-Edit') 
                     @if($data->app_status_id ==4 || $data->app_status_id ==5 || $data->app_status_id ==3)
                     <a><img src="{{ asset('images/edit_gray.png') }}" alt="" width="25" height="25" title="{{trans('title.edit')}}"></a> 
                     @else
                     <a id="editImport{{ $data->id }}" data-url="{{route('import-vehicle.edit',['id'=>$data->vehicle_detail->id])}}" data-backdrop="static" data-keyboard="false"  data-toggle="modal"  data-target="#editModal"  class="btn_edit"><img src="{{ asset('images/edit.png') }}" id="edit_image{{ $data->id }}" alt="" title="{{trans('title.edit')}}" width="25" height="25px"></a>
                     @endif
                  @endcan
                  @if($data->app_status_id ==6 ) 
                  <a href="" id="submitApp{{$data->id}}" class="app-submit" title="{{ trans('title.submit') }}"  title1="{{ trans('title.need_fill_submit')}}" 
                     data-id="{{ $data->id }}"  data-licence_no_need="{{$data->vehicle_detail->licence_no_need}}" data-vehicle_type_id="{{$data->vehicle_detail->vehicle_type_id}}"
                     data-width="{{$data->vehicle_detail->width}}" data-height="{{$data->vehicle_detail->height}}" data-long="{{$data->vehicle_detail->long}}" data-vehicle_kind_code="{{ $data->vehicle_detail->vehicle_kind_code}}"
                     data-brand_id="{{$data->vehicle_detail->brand_id}}" data-weight="{{ $data->vehicle_detail->weight }}" data-weight_filled="{{$data->vehicle_detail->weight_filled}}"
                     data-owner_name="{{$data->vehicle_detail->owner_name}}" data-model_id="{{$data->vehicle_detail->model_id}}" data-total_weight="{{$data->vehicle_detail->total_weight}}" data-color_id="{{$data->color_id}}"
                     data-engine_no="{{ $data->vehicle_detail->engine_no}}" data-seat="{{$data->vehicle_detail->seat}}" data-steering_id="{{$data->vehicle_detail->steering_id}}"
                     data-province_code="{{$data->vehicle_detail->province_code}}" data-chassis_no="{{$data->vehicle_detail->chassis_no}}" data-engine_type_id="{{$data->vehicle_detail->engine_type_id}}" 
                     data-cylinder="{{$data->vehicle_detail->cylinder}}" data-district_code="{{$data->vehicle_detail->district_code}}" data-motor_brand_id="{{$data->vehicle_detail->motor_brand_id}}"
                     data-cc="{{$data->vehicle_detail->cc}}" data-year_manufacture="{{$data->vehicle_detail->year_manufacture}}" data-village_name="{{$data->vehicle_detail->village_name}}" 
                     data-remark="{{$data->vehicle_detail->remark}}" data-axis="{{$data->vehicle_detail->axis}}" data-wheels="{{$data->wheels}}"><img src="{{ asset('images/submit.png') }}" alt="" width="25px" height="25px"></a>
                  @endif
                  @can('Importer-Application-Item-Entry-Delete') 
                     @if($data->app_status_id == 4)
                     <a><img src="{{ asset('images/delete_gray.png') }}" alt="" title="{{trans('title.delete')}}" width="25" height="25"></a> 
                     @else
                     <a href="" class="delete_btn_staff" data-id="{{ $data->id }}"  >
                        <img src="{{ asset('images/delete.png') }}" alt="" title="{{trans('title.delete')}}"  width="25px" height="25px">
                     </a>
                     @endif
                  
                  @endcan
               </td>
            </tr>
            @endforeach 
         </tbody>
      </table>
      
      <!-- pagination for list page -->
      <div id="pagination">{!! $pre_app->links() !!}
         <div>Showing {{( $pre_app->currentpage()-1) * $pre_app->perpage()+1 }} to {{ $pre_app->currentpage()*$pre_app->perpage() }}
         of  {{$pre_app->total()}} entries
         </div>
      </div>
   </div>
   <!-- end table wrapper -->
</div>

@include('Module5.importvehicle.approveModal')
@include('Module5.importvehicle.new-modal', ['data' => $info])

<!--start  modal box for approve all -->
<div class="modal fade" id="approve-box" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <form action="" method="POST" id="approve_all" name="approve_all">
            @method('POST') @csrf
            <div class="modal-header">
               <div class="col-md-11 text-center">
                  <h3 class="text-center">{{ trans('title.all_approve_selected') }}</h3>
               </div>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <input type="hidden" name="app_form_id" id="app_form_id" value="">
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{ trans('title.approve_cancel') }}</button>
               <button type="submit" class="btn btn-success btn-sm">{{ trans('title.approve_confirm') }}</button>
            </div>
         </form>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- end modal box for approve all -->

<!--start Excel import modal -->
<div class="modal fade" id="ImportExcel" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <form method='post' action='/excel-import-vehicle' id="excelImport" enctype='multipart/form-data'>
            {{ csrf_field() }}
            <div class="modal-header">
               <div class="col-md-11 text-center">
                  <h3 class="text-center">{{ trans('app_form.vehicle_import_excel')}}</h3>
               </div>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body">
               <div class="form-row">
                  <div class="col-md-9">
                     <input  type='file' name='file' id="excelfile" accept=".csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"><br/>
                  </div>
                  <div class="col-md-3">
                     <button  class="btn btn-success btn-sm import-excel">Import File</button>
                  </div>
               </div>
            </div>
         </form>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Excel import modal -->
<!-- start edit modal popup -->
<div class="modal fade" id="editModal" role="dialog"  aria-hidden="true">
   <div class="modal-dialog modal-xl" style="position: fixed;top: -28px;display: block;left: 82px;">
      <!-- Modal content-->
      <div class="modal-content mod5 edit-modal" >
      </div>
   </div>
</div>
<!-- end edit modal popup -->
<!-- start show modal popup -->
<div class="modal fade" id="showModal" role="dialog">
   <div class="modal-dialog modal-xl"  style="position: fixed;top: -28px;display: block;left: 82px;">
      <!-- Modal content-->
      <div class="modal-content mod5 show-modal" >
      </div>
   </div>
</div>

@include('Module5.importvehicle.RejectModal')
@endsection 
@push('page_scripts')

<script type="text/javascript">
      //use only bootstrap datepicker
   var submit_url = "{{ url('/submit-importer-app/') }}";
   var base_url = "{{url('/Importer/Application')}}";
   var approve_url = "{{url('/approve-importer-app')}}";
   var delete_url = "{{url('/import-vehicle')}}";
   var approve_all = "{{url('/approve-all')}}";
   var reject_url = "{{url('/reject-app')}}";
   var data = {!! $preLicense !!};
   var engineData = {!! json_encode($engineNo) !!};
   var chassisData = {!! json_encode($chassisNo) !!};
  
   $("#checkAll").click(function () {
   	var checked_status = this.checked;
   	$('.app_list').not(":disabled").prop("checked", checked_status);
        
   });
   
   //get checked value when click approve all button
   $(".approve_all").click(function() {
   	var lists = [];
   	var isChecked = $(".app_list").is(":checked");
   	if(isChecked) {
   		$.each($("input[name='approve_list']:checked"), function() {
   			lists.push($(this).val());
   		});
   		
   		$("#approve-box").modal('show');
   		document.getElementById("approve_all").action = approve_all;
   		$('[name="app_form_id"]').val(lists);
   	} else {
   		alert('No selected');
   	}
   });
   
   //reject app
   $(document).on("click", '.reject', function(e) {
   	document.getElementById("reject_form").action = reject_url + "/" + $(this).data('id');
   });  

    //import excel
    $(document).on("click", '.import-excel', function(e) {
      e.preventDefault();
   	if($("#excelfile").val() != ''){
         $("#excelImport").submit();
        
      } else{
         alert("Need to choose attach file.");
         return false;
      }
   });  
   
   //reset approve modal
   $('#approve-box').on('hidden.bs.modal', function () {
      $("#approve-box").find('form').trigger('reset');
   });

   //Print Paper
   $(document).on("click", '.printPaper', function (e) { 
      jQuery('#printPaper').print();
   });


   //delete box when click delete button
function doConfrimBox(msg, printYes, printNo)
{
   var deleteBox = $("#deleteBox");
   deleteBox.find(".delete_message").text(msg);
   deleteBox.find(".yes,.no").unbind().click(function()
   {
      deleteBox.hide();
   });
   deleteBox.find(".yes").click(printYes);
   deleteBox.find(".no").click(printNo);
   deleteBox.show();
}
/*for column search */
//All Search Input Control Event
$('#search').on('keydown', 'input', function(e) {
    if (e.keyCode === 13) {
      e.preventDefault();
      e.stopImmediatePropagation();
      searchVehicles(1);
    }
  });
  //show result when click pagination no depend on column search
  $(document).on("click", '.searchByFilter', function (e) { 
      e.preventDefault();
      searchVehicles($(this).data('page_no'));
   });

  function searchVehicles(cpage) {
    var surl = "/search-import-list";
    var pre_app_no = $("#s_app_no").val();
    var owner_name = $("#s_owner_name").val();
    var pre_license_no = $("#s_pre_license").val();
    var province_name = $("#s_province").val();
    var village_name = $("#s_village").val();
    var vehicle_type_name = $("#s_vehicle_type").val();
    var brand_name = $("#s_brand").val();
    var model_name = $("#s_model").val();
    var engine_no = $("#s_engine_no").val();
    var pageno = cpage;
    $.ajax({
        url: surl,
        type: 'GET',
        cache: false,
        data: {
            pre_app_no: pre_app_no,
            pre_license_no: pre_license_no,
            province_name: province_name,
            village_name: village_name,
            owner_name: owner_name,
            vehicle_type_name: vehicle_type_name,
            brand_name: brand_name,
            model_name: model_name,
            engine_no: engine_no,
            chassis_no: engine_no,
            pageno:pageno
        },
        dataType: 'html',
        beforeSend: function() { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
          $('#loader').removeClass('hidden')
        },
        success: function(data) {
           console.log(data);
          $("#importWrapper table").remove();
          $("#importWrapper").html(data);
        },
        complete: function() { // Set our complete callback, adding the .hidden class and hiding the spinner.
          $('#loader').addClass('hidden')
        },
      })
      .fail(function() {
        $('#serch-result').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');

      });
  }

  

</script>

<script src="{{ asset('vrms2/js/submit-app.js') }}"></script>
<script src="{{ asset('vrms2/js/import-approve.js') }}"></script>
<script src="{{ asset('vrms2/js/showModal.js')}}"></script>
<script src="{{ asset('vrms2/js/jquery-ui.js') }}"></script>
<script>
    // can move modal pop
    $('#newModal .modal-dialog, #editModal .modal-dialog, #showModal .modal-dialog').draggable({
         handle: ".modal-body, .modal-header"
      });
</script>
@endpush

