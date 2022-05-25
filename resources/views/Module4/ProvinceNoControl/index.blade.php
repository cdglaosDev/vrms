@extends('vrms2.layouts.master')
@section('pro_control','active')
@section('content')
@include('vrms2.mod4-submenu')
<h3>{{ trans('module4.province_control_title') }}
   @can('Province-Number-Create')
   <a data-toggle="modal" data-target="#addModel" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-sm btn-save ">{{trans('common.add_new')}}</a>
   @endcan
</h3>
@include('flash')
<div class="card-body">
   <table id="myTable" class="table table-striped" style="width:100%">
      <thead>
         <tr>
            <th>{{ trans('common.province') }} </th>
            <th>{{ trans('module4.province_no_start') }}</th>
            <th>{{ trans('module4.present_province') }}</th>
            <th>{{ trans('common.status') }}</th>
            <th>{{ trans('common.action') }}</th>
         </tr>
      </thead>
      <tbody>
         @foreach ($provincenocontrol as $data)
         <tr>
            <td>@if(isset($data->province->name))<span>{{$data->province['name']}}({{$data->province['name_en']}})</span>@else{{"_"}}@endif</td>
            <td>{{$data ->province_no_start}}</td>
            <td>{{$data ->present_province_no}}</td>
            <td>{{ $data->status }}</td>
            <td>
               @can('Province-Number-Edit')
               <a href="" class="edit_btn" data-toggle="modal" data-target="#editModel" data-backdrop="static" data-keyboard="false" data-act="Edit" data-province_code="{{ $data->province_code }}" data-province_no_start="{{$data->province_no_start}}" data-present_province_no="{{$data->present_province_no}}" data-status="{{ $data->status}}" data-id="{{$data->id}}"><img src="{{ asset('images/edit.png') }}" alt="" title="{{trans('button.edit')}}" width="25px" height="25px"></a>
               @endcan
               @can('Province-Number-Delete')
               <a href="" class="delete_btn" data-toggle="modal" data-target="#deleteModel" data-backdrop="static" data-keyboard="false" data-act="Delete" data-id="{{$data->id}}"><img src="{{ asset('images/delete.png') }}" alt="" title="{{trans('button.delete')}}" width="25px" height="25px"></a>
               @endcan
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>
</div>
@include('Module4.ProvinceNoControl.Modal')
@include('delete')
@endsection
@push('page_scripts')
<script type="text/javascript">
   var base_url = "{{url('/province-no-control/')}}";
   $(document).on("click", '.delete_btn', function(e) {
      document.getElementById("deleteform").action = base_url + "/" + $(this).data('id');
   });
   $(document).on("click", '.edit_btn', function(e) {
      $('[name="province_code"]').val($(this).data('province_code')).change();
      $('[name="province_no_start"]').val($(this).data('province_no_start'));
      $('[name="present_province_no"]').val($(this).data('present_province_no'));
      $('[name="status"]').val($(this).data('status'));
      $("#edit-id").val($(this).data('id'));
      document.getElementById("editform").action = base_url + "/" + $(this).data('id');
   });

   $('.pro_no').keyup(function() {
      var code = $(this).val();
      code = code.replace(/[^0-9_]/g, '');
      $(this).val(code);
   });

   // record save into database
   $('#province-new').click(function(e) {
      e.preventDefault();
      var province_code = $('#province');
      var province_start = $("#addModel .province-start");
      var province_present = $("#addModel .province-present");
      var status = $("#addModel .status");
      var oldId = $("#new-id").val();
      var form = $("#newForm");
      insertProvinceNoControl(province_code, province_start, province_present, status, form, oldId);
   });

   $('#province-update').click(function(e) {
      e.preventDefault();
      var province_code = $('#edit-province');
      var province_start = $("#editModel .province-start");
      var province_present = $("#editModel .province-present");
      var status = $("#editModel .status");
      var oldId = $("#edit-id").val();
      var form = $("#editform");
      insertProvinceNoControl(province_code, province_start, province_present, status, form, oldId);
   });

   function insertProvinceNoControl(province_code, province_start, province_present, status, form, oldId = null) {
      var url = "/check-province-control?province=" + province_code.val() + "&id=" + oldId + "&status=" + status.val();
      $.get(url, function(response) {

         if (province_code.val() == null) {
            alert('Please choose province');
            return false;
         } else if (province_start.val() == '') {
            alert("Please enter province start no.");
            return false;
         } else if (province_present.val() == '') {
            alert("Please enter province present");
            return false;
         } else if (parseInt(province_present.val()) < parseInt(province_start.val())) {
            alert($('#pro_ctrl_msg_title').attr('title'));
            $('.province-present').focus();
            return false;
         } else if (status.val() == null) {
            alert('Please choose status');
            return false;
         } else if (response.status == "used") {
            alert(response.message);
            return false;
         } 

         var num_start = province_start.val();
         var num_present = province_present.val();
         if (num_start.length < 7) {
            num_start = createProNumber(num_start);
            province_start.val(num_start);
         }
         if (num_present.length < 7) {
            num_present = createProNumber(num_present);
            province_present.val(num_present);
         }

         form.submit();

      });
   }

   function createProNumber(province_no) {
      province_no = province_no.padStart(7, 0);
      return province_no;
   }
</script>
@endpush