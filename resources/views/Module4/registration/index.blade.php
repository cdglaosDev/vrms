@extends('vrms2.layouts.master')
@section('app_form','active')
@section('content')

<h3> {{ trans('module4.app_list')}}
  @can('App-Form-List-Create')
  <a href="#" class="btn btn-primary btn-sm btn-save" data-toggle="modal" data-target="#addModel" data-backdrop="static" data-keyboard="false">{{trans('common.add_new')}}</a>
  @endcan
</h3>
@include('flash')
<div class="card-body">
  <div class="table-responsive">
    <table id="App-Table" class="table table-striped">
      <thead>
        <tr>
          <th>{{ trans('module4.app_no')}}</th>
          <th>{{ trans('module4.app_type')}}</th>
          <th>{{ trans('module4.customer_name')}}</th>
          <th>{{ trans('module4.date_req')}}</th>
          <th>{{ trans('module4.license_no_header')}}</th>
          <th>{{ trans('module4.name')}}</th>
          <th>{{ trans('module4.village_district')}}</th>
          <th>{{ trans('module4.province_name')}}</th>
          <th>{{ trans('module4.v_type')}}</th>
          <th>{{ trans('module4.brand')}}</th>
          <th>{{ trans('module4.engine_no_chassis_no')}}</th>
          <th>{{ trans('module4.app_form_status')}}</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($app_form as $data)
        <tr>
          <td>
            <?php
              $arr_purpose_ids = \App\Model\AppFormPurpose::whereAppFormId( $data->id )->pluck('app_purpose_id')->toArray();
              $purpose_ids = '';
              foreach($arr_purpose_ids as $item)
              {
                $purpose_ids = $purpose_ids.$item.',';
              }
            ?>
            @can('App-Form-Entry-Edit')
            <a class="link btn_edit" data-url="{{route('applications.edit',[$data->id])}}" data-toggle="modal"  
            data-target="#editModel" data-backdrop="static" data-keyboard="false" style="font-family:Saysettha OT !important;font-weight: bold;">{{ $data->app_no }}</a>
            @endcan
          </td>
          <td>
            <?php
            $text = '';
            foreach ($data->appFormPurpose as $app_purpose) {
              $text = $text . ', ' . $app_purpose->app_purpose->name ?? '';
            }
            echo trim($text, ', ');
            ?>
          </td>
          <td>{{ $data->customer_name ?? ''  }}</td>
          <td>{{ $data->date_request}}</td>
          <td>
            <a href="#" class="link license_no w90" purpose_no="{{ $data->vehicle->vehicle_kind_code}}">
              {{ $data->vehicle->licence_no ?? '0000'}}
            </a><br>
            {{ $data->vehicle->vehicle_kind->name ?? '' }}
          </td>
          <td><a href="#" class="link">{{ $data->vehicle->owner_name ?? '' }}</a></td>
          <td>
            <div style="font-weight: bold;">{{ $data->vehicle->village_name ?? '' }}</div>
            <div style="color: #666;"><small>ມ.</small>{{ $data->vehicle->district->name ?? '' }}</div>
          </td>
          <td>
            <div class="province" province_code="{{ $data->vehicle->province_code }}">{{ $data->vehicle->province->name ?? '' }}</div>
            <div style="white-space:nowrap;color: #777;">ກມ {{ $data->vehicle->division_no ?? '' }}</div>
            <div style="color: #aaa;">ຂວ {{ $data->vehicle->province_no ?? '' }}</div>
          </td>
          <td>{{ $data->vehicle->vtype->name ?? '' }}</td>
          <td>
            <div>{{ $data->vehicle->vbrand->name ?? ''}}</div>
            <div style="color: #f99;">ອອກ {{ $data->vehicle->issue_date }}</div>
          </td>
          <td>
            <div style="font-family:Saysettha OT !important;">{{ $data->vehicle->engine_no ?? '' }}</div>
            <div><a href="#" class="link" style="font-family:Saysettha OT !important;">{{ $data->vehicle->chassis_no ?? '' }}</a></div>
          </td>
          <td>{{ $data->app_status->name ?? '' }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="editModel" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-xl" role="document" style="position: fixed;top: -28px;display: block;left: 5%;">
        <div class="modal-content edit-modal">
            
        </div>
    </div>
</div>

@include('Module4.registration.modal')
@endsection
@push('page_scripts')
<script src="{{ asset('vrms2/js/showModal.js')}}"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript">
   $('#App-Table').dataTable( {
    "ordering": false
    });
  
  var base_url = "{{url('/applications')}}";
  $(document).on("click", '.edit_btn', function(e) {
    $('[name="app_no"]').val($(this).data('app_no'));
    $('[name="date_request"]').val($(this).data('date_request'));
    $('[name="customer_name"]').val($(this).data('customer_name'));
    $('[name="licence_no"]').val($(this).data('licence_no'));
    $('[name="division_no"]').val($(this).data('division_no'));
    $('[name="province_no"]').val($(this).data('province_no'));
    $('[name="v_kind_name"]').val($(this).data('v_kind_name'));
    $('[name="engine_no"]').val($(this).data('engine_no'));
    $('[name="chassis_no"]').val($(this).data('chassis_no'));
    $('[name="staff_name"]').val($(this).data('staff_name'));
    $('[name="staff_id"]').val($(this).data('staff_id'));
    $('[name="village_name"]').val($(this).data('village_name'));
    $('[name="note"]').val($(this).data('note'));
    $('[name="comment"]').val($(this).data('comment'));

    $('[name="app_form_status_id"]').val($(this).data('app_form_status_id')).change();
    $('[name="brand_id"]').val($(this).data('brand_id')).change();
    $('[name="model_id"]').val($(this).data('model_id')).change();
    $('[name="vehicle_type_id"]').val($(this).data('vehicle_type_id')).change();
    $('[name="province_code"]').val($(this).data('province_code')).change();
    $('[name="district_code"]').val($(this).data('district_code')).change();
    $('[name="purpose_ids"]').val($(this).data('purpose_ids'));

    document.getElementById("editform").action = base_url + "/" + $(this).data('id');
  });

  // Jquery draggable
  $('.modal-dialog').draggable({
      handle: ".modal-header"
  });

  $(document).on('click', '#paper2', function() {
        jQuery('#printPaper2').print();
    });

    $(document).on('click', '#print_app_form', function() {
        jQuery('#printPaper').print();
    });
</script>
@endpush