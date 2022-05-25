@extends('customer.layouts.master')
@section('vehicle','active')
@section('title','Import Lists')
@section('content')
@php
$preLicense =  \App\Model\VehicleDetail::getLicenseOnly();
$engineNo = \App\Model\VehicleDetail::getEngine();
$chassisNo = \App\Model\VehicleDetail::getChassis();
@endphp
<div class="row">
   <div class="col-md-3">
      <h3>
         {{trans('app_form.importer_list')}}
      </h3>
   </div>
   <div class="col-md-4 pt-2"> 
      <a data-target="#newModal" data-backdrop="static" data-keyboard="false"  data-toggle="modal" class="btn btn-primary btn-save btn-sm">{{trans('customer.add_new')}}</a>
      <a href="" class="btn btn-primary btn-save btn-sm" data-toggle="modal" data-target="#ImportExcel">{{ trans('app_form.import_excel') }}</a>
      <a href="{{asset('images/sample/Sample_import_v1.0.xlsx')}}" class="btn btn-primary btn-save btn-sm">{{trans('Download Sample Excel File')}}</a>
   </div>
   <div class="col-md-5">
      <div class="row">
         <div class="col-md-8">
         <form  action="{{ url('/customer/search-app')}}" method="GET">
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
<div class="card-body">
   <div class="row">
      <div class="table-responsive" id="customerVehImport">
      <table id="myTable" class="table table-striped" style="width:100%">
            <!-- for column search  -->
            <tfoot>
               <tr>
                  <th style="width: 90px;">{{ trans('app_form.app_number') }}</th>
                  <th style="width: 110px;">{{ trans('app_form.owner_name') }}</th>
                  <th style="width: 100px;">{{ trans('app_form.pre_licence_no') }}</th>
                  <th style="width: 110px;">{{ trans('app_form.village_name') }}</th>
                  <th style="width: 110px">{{ trans('vehicle.province') }}</th>
                  <th style="width: 100px">{{ trans('vehicle.vehicle_type')}}</th>
                  <th style="width: 100px">{{ trans('vehicle.brand')}}</th>
                  <th style="width: 100px">{{ trans('vehicle.model') }}</th>
                  <th style="width: 130px;">{{ trans('module4.engine_no_chassis_no') }}</th>
                  <th style="width: 70px">{{ trans('app_form.app_status') }}</th>
                  <th style="width: 130px;">&nbsp;</th>
               </tr>
            </tfoot>
            <!-- for header -->
            <thead>
               <tr>
                  <th style="width: 90px;">{{ trans('app_form.app_number') }}</th>
                  <th style="width: 110px;">{{ trans('app_form.owner_name') }}</th>
                  <th style="width: 100px;">{{ trans('app_form.pre_licence_no') }}</th>
                  <th style="width: 93px;">{{ trans('app_form.village_name') }}</th>
                  <th style="width: 110px">{{ trans('vehicle.province') }}</th>
                  <th style="width: 100px">{{ trans('vehicle.vehicle_type')}}</th>
                  <th style="width: 100px">{{ trans('vehicle.brand')}}</th>
                  <th style="width: 100px">{{ trans('vehicle.model') }}</th>
                  <th style="width: 130px;">{{ trans('module4.engine_no_chassis_no') }}</th>
                  <th style="width: 70px">{{ trans('app_form.app_status') }}</th>
                  <th style="width: 130px;">{{trans('customer.action')}}</th>
               </tr>
            </thead>

            <tbody id="reload">
               @foreach ($pre_app as $data)
               <tr class="vehId{{ $data->vehicle_detail->id }}">
                  <td>
                     <a class="sameSize" style="color:#007bff" >{{ $data->app_number ?? '' }}</a>
                     <a style="color:#07279d; font-weight: bold;"  data-backdrop="static" data-keyboard="false" class="sameSize btn_edit" data-url="{{route('vehicle-detail.edit',['id'=>$data->vehicle_detail->id])}}" data-toggle="modal"  data-target="#editModal">{{ $data->regapp_number ??''}}</a>
                  </td>
                  <td>{{ $data->vehicle_detail->owner_name ?? ''}}</td>
                  <td>
                     <a href="" class="link license_no" purpose_no="{{$data->vehicle_detail->vehicle_kind_code}}">{{$data->vehicle_detail->licence_no_need??''}}</a>
                     <div style="text-align:center;white-space:nowrap;color:#444;font-size:11px;padding:0;max-width:80px">{{ $data->vehicle_detail->vehicleKind->name ?? ''}}</div>
                  </td>
                  <td>
                     <div style="font-weight:bold">{{ $data->vehicle_detail->village_name ?? ''}}</div>
                     <div style="color:#666"><small>ມ</small>{{$data->vehicle_detail->district->name ?? ''}}</div>
                  </td>
                  <td>
                     <div class="province" province_code="{{ $data->vehicle_detail->province_code }}">{{$data->vehicle_detail->province['name']??''}}</div>
                  </td>
                  <td>{{ $data->vehicle_detail->type->name ?? '' }}</td>
                  <td>{{ $data->vehicle_detail->brand->name ?? '' }}</td>
                  <td>{{ $data->vehicle_detail->model->name ?? '' }}</td>
                  <td>
                     <div class="sameSize">{{ $data->vehicle_detail->engine_no?? '' }}</div>
                     <div ><a href="#" class="link sameSize">{{ $data->vehicle_detail->chassis_no ?? ''}}</a></div>
                  </td>
                  <td align="center"> <span style="font-weight:bold">
                     @if($data->app_status_id ==4) 
                     <img src="{{ asset('images/approved.png') }}" class="status_image{{ $data->id }}" alt="" width="30" height="30">
                     @elseif($data->app_status_id ==5)
                     <img src="{{ asset('images/rejected.png') }}" class="status_image{{ $data->id }}" alt="" width="30" height="30">
                     @elseif($data->app_status_id == 3)
                     <img src="{{ asset('images/in_progress.png') }}"  class="status_image{{ $data->id }}" alt="" width="30" height="25">
                     @elseif($data->app_status_id == 1)
                     Complete
                     @elseif($data->app_status_id == 2)
                     Cancel
                     @elseif($data->app_status_id == 6)
                     <img src="{{ asset('images/draft.png') }}" class="status_image{{ $data->id }}" width="30" height="25">
                     @else
                     {{ ""}}
                     @endif</span>
                  </td>
                  <td>
                     <a data-url="{{route('vehicle-detail.show',['id'=>$data->vehicle_detail->id])}}" title="View" data-backdrop="static" data-keyboard="false"  data-toggle="modal"  data-target="#showModal" class="show_btn {{$data->app_status_id ==4 ?'disabled':''}}"><img src="{{ asset('images/view.png') }}" alt="" width="25" height="25" title="{{ trans('title.view') }}"></a>
                     @if($data->app_status_id ==4 ||$data->app_status_id ==3 )
                     <a><img src="{{ asset('images/edit_gray.png') }}" alt="" width="25" height="25" title="{{ trans('title.edit') }}"></a>
                     @else
                        <a class="btn-icon-text btn_edit" data-backdrop="static" data-keyboard="false"  data-url="{{ route('vehicle-detail.edit',['id'=>$data->vehicle_detail->id]) }}" data-toggle="modal"  data-target="#editModal"><img src="{{ asset('images/edit.png') }}" alt="" width="25" height="25" title="{{ trans('title.edit') }}"></a>          
                     @endif
                     @if($data->app_status_id ==4)
                     <a><img src="{{ asset('images/delete_gray.png') }}" alt="" width="25" height="25" title="{{ trans('title.delete') }}"></a>
                     @else
                        @if($data->app_status_id == 6)
                        <a href="" class="delete_btn px-0" data-id="{{$data->vehicle_detail->id ?? ''}}"><img src="{{ asset('images/delete.png') }}" alt="" width="25" height="25" title="{{ trans('title.delete') }}"></a>
                        @else
                        <a><img src="{{ asset('images/delete_gray.png') }}" alt="" title="{{trans('title.delete')}}" width="25" height="25"></a>
                        @endif
                     @endif
                     @if($data->app_status_id ==6) 
                     <a href="" class="app-submit" id="submitApp{{$data->id}}"  title="{{ trans('title.submit')}}"  title1="{{ trans('title.need_fill_submit')}}" 
                        data-id="{{ $data->id }}"  data-licence_no_need="{{$data->vehicle_detail->licence_no_need ??''}}" data-vehicle_type_id="{{$data->vehicle_detail->vehicle_type_id ??''}}"
                        data-width="{{$data->vehicle_detail->width ?? ''}}" data-height="{{$data->vehicle_detail->height ??''}}" data-long="{{$data->vehicle_detail->long ??''}}" data-vehicle_kind_code="{{ $data->vehicle_detail->vehicle_kind_code ??''}}"
                        data-brand_id="{{$data->vehicle_detail->brand_id ??''}}" data-weight="{{ $data->vehicle_detail->weight ??''}}" data-weight_filled="{{$data->vehicle_detail->weight_filled ??''}}"
                        data-owner_name="{{$data->vehicle_detail->owner_name ??''}}" data-model_id="{{$data->vehicle_detail->model_id ??''}}" data-total_weight="{{$data->vehicle_detail->total_weight}}" data-color_id="{{$data->color_id ??''}}"
                        data-engine_no="{{ $data->vehicle_detail->engine_no ??''}}" data-seat="{{$data->vehicle_detail->seat ??''}}" data-steering_id="{{$data->vehicle_detail->steering_id ??''}}"
                        data-province_code="{{$data->vehicle_detail->province_code ??''}}" data-chassis_no="{{$data->vehicle_detail->chassis_no ??''}}" data-engine_type_id="{{$data->vehicle_detail->engine_type_id ??''}}" 
                        data-cylinder="{{$data->vehicle_detail->cylinder ??''}}" data-district_code="{{$data->vehicle_detail->district_code ??''}}" data-motor_brand_id="{{$data->vehicle_detail->motor_brand_id ??''}}"
                        data-cc="{{$data->vehicle_detail->cc ??''}}" data-year_manufacture="{{$data->vehicle_detail->year_manufacture ??''}}" data-village_name="{{$data->vehicle_detail->village_name??''}}" 
                        data-remark="{{$data->vehicle_detail->remark ??''}}" data-axis="{{$data->vehicle_detail->axis??''}}" data-wheels="{{$data->vehicle_detail->wheels ?? ''}}"><img src="{{ asset('images/submit.png') }}" alt="" width="25px" height="25px"></a>
                     @endif
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
        
</div>
</div>
</div>

<!-- delete modal -->
<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
          <form action="" id="deleteform"  method="post">
          <meta name="del-csrf-token" content="{{ csrf_token() }}">
            <div class="modal-header" style="border-bottom: 0px">
                    <button type="button" class="close" data-dismiss="modal" >
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div> 
               <div class="modal-body text-center" style="padding:0px !important">
                  <p>{{ trans('common.are_you_sure_to_delete') }}</p>
               </div>
               <div class="modal-footer">
                  <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
                  <a  class="btn btn-danger btn-sm mod5_delete" >{{trans('button.ok')}}</a>
               </div>
           
         </form>
      </div>
   </div>
</div>

<!-- edit modal popup -->
<div class="modal fade" id="editModal" role="dialog">
   <div class="modal-dialog modal-xl" style="position: fixed;top: -28px;display: block;left: 82px;">
      <!-- Modal content-->
      <div class="modal-content mod5 edit-modal">
      </div>
   </div>
</div>
<!-- end edit modal popup -->
<!-- start show modal popup -->
<div class="modal fade" id="showModal" role="dialog">
   <div class="modal-dialog modal-xl" style="position: fixed;top: -28px;display: block;left: 82px;">
      <!-- Modal content-->
      <div class="modal-content mod5 show-modal">
      </div>
   </div>
</div>
<!-- end show modal popup -->

<!-- start submit modal -->
<div class="modal fade" id="submit-box" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="" method="POST" id="submitForm" >
                @method('POST') @csrf
				<div class="modal-header">
					<div class="col-md-11 text-center">
                  <input type="hidden" name="pre_app_id" id="pre_app_id" value="">
						<h5 class="text-center py-2">{{ trans('app_form.submit_app')}}</h5> </div>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{ trans('button.cancel') }}</button>
					<a  class="btn btn-success btn-sm submitButton">{{ trans('button.submit') }}</a>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<!-- start import excel modal -->
<div class="modal fade" id="ImportExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <form method='post' action='/customer/excel-import-vehicle' enctype='multipart/form-data' >
            {{ csrf_field() }}
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel-2">Vehicle Import Excel</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <p><input type='file' name='file' accept=".csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required=""></p>
            </div>
            <div class="modal-footer">
               <input type='submit' name='submit' value='Import file' class="btn btn-success btn-sm">
               <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- end import excel modal -->

@include('customer.vehicledetail.newModal', ['data' => $info])
@endsection 

@push('page_scripts')
<script type="text/javascript" src="{{asset('vrms2/js/dropdownlist.js')}}"></script>
<script type="text/javascript">
  
   $('#myTable tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="'+title+'" />' );
    } );
 
    // DataTable
    var table = $('#myTable').DataTable({
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    });
  
     var dist_url="{{url('getdistrict/')}}";
     var get_vmodal="{{url('getVmodel/')}}";
     var base_url = "{{url('customer/vehicle-detail')}}";
     var delete_url = "{{url('/vehicle-detail')}}";
     var submit_url = "{{ url('/customer/submit-importer-app/') }}";
      
     //delete record
     $(document).on("click", ".delete_btn", function(e) {
      e.preventDefault();
      var id = $(this).data("id");
      $("#deleteModel").modal('show');
      var token = $("meta[name='del-csrf-token']").attr("content");
         $('.mod5_delete').click(function(e) {
            e.preventDefault();
            $.ajax(
            {
               url: "/customer/vehicle-detail/"+id,
               type: 'DELETE',
               data: {
                     "id": id,
                     "_token": token,
               },
               cache: false,
               success: function (response){
                 if(response.status == "success"){
                    //$("#myTable tbody tr"+".vehId"+id).remove();
                    $(".vehId" + id).fadeOut();
                    $("#deleteModel").modal('hide');
                    //$("#myTable").load(window.location + " #myTable");
                 }
               }
            });
         });
      });
      
     var data = {!! $preLicense !!};
     var engineData = {!! json_encode($engineNo) !!};
     var chassisData = {!! json_encode($chassisNo) !!};
     
   //print Print Paper
   $(document).on("click", '.printPaper', function (e) {
      jQuery('#printPaper').print();
   });

   $('#newModal, #editModal').on('hidden.bs.modal', function () {
      $("#newModal, #editModal").find('form')[0].reset();
      $("#myForm .vehicle_id").val(null);
      $('.js-example-basic-single').val(null).trigger('change');
   });
  
</script>
<script src="{{ asset('vrms2/js/submit-app.js') }}"></script>
<script src="{{ asset('vrms2/js/showModal.js')}}"></script>
<script src="{{ asset('vrms2/js/save-import.js') }}"></script>
<script src="{{ asset('vrms2/js/jquery-ui.js') }}"></script>
<script>
    // can move modal pop
    $('#newModal .modal-dialog, #editModal .modal-dialog, #showModal .modal-dialog').draggable({
         handle: ".modal-body, .modal-header"
      });
     
</script>
@endpush