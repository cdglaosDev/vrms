@extends('vrms2.layouts.master')
@section('div_control','active')
@section('content')
@include('vrms2.mod4-submenu')
<h3>{{ trans('module4.division_control_title') }}
   @can('Division-Number-Create')
   <a data-toggle="modal" data-target="#addModel" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-sm btn-save ">{{trans('common.add_new')}}</a>
   @endcan
</h3>
@include('flash')
<div class="card-body">
   <table id="myTable" class="table table-striped" style="width:100%">
      <thead>
         <tr>
            <th>{{ trans('common.province_code') }}</th>
            <th>{{ trans('module4.division_start') }}</th>
            <th>{{ trans('module4.division_end') }}</th>
            <th>{{ trans('module4.alert_at') }}</th>
            <th>{{ trans('module4.present_division') }}</th>
            <th>{{ trans('common.status') }}</th>
            <th width="200">{{ trans('common.action') }}</th>
         </tr>
      </thead>
      <tbody>
         @foreach ($division_control as $data)
         <tr>
            <td>@if(isset($data->province->name))<span>{{$data->province['name']}}({{$data->province['name_en']}})</span>@else{{"_"}}@endif</td>
            <td>{{$data ->division_no_start}}</td>
            <td>{{$data ->division_no_end}}</td>
            <td>{{$data ->alert_at}}</td>
            <td>{{$data ->present_division_no}}</td>
            <td>{{ $data->status }}</td>
            <td>
               @can('Division-Number-Edit')
               <a href="" class="edit_btn" data-toggle="modal" data-target="#editModel" data-backdrop="static" data-keyboard="false" data-act="Edit" data-province_code="{{ $data->province_code }}" data-division_no_start="{{$data->division_no_start}}" data-division_no_end="{{$data->division_no_end}}" data-alert_at="{{$data->alert_at}}" data-status="{{$data->status}}" data-id="{{$data->id}}">
                  <img src="{{ asset('images/edit.png') }}" alt="" title="{{trans('button.edit')}}" width="25px" height="25px"></a>
               @endcan
               @can('Division-Number-Delete')
               <a href="" class="delete_btn" data-toggle="modal" data-target="#deleteModel" data-backdrop="static" data-keyboard="false" data-act="Delete" data-id="{{$data->id}}"><img src="{{ asset('images/delete.png') }}" alt="" title="{{trans('button.delete')}}" width="25px" height="25px"></a>
               @endcan
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>
</div>
@include('delete')
@include('Module4.DivisionNoControl.Modal')
@endsection
@push('page_scripts')
<script type="text/javascript">
   var base_url = "{{url('/division-no-control')}}";

   $(document).on("click", '.delete_btn', function(e) {
      document.getElementById("deleteform").action = base_url + "/" + $(this).data('id');
   });

   $(document).on("click", '.edit_btn', function(e) {

      $('[name="province_code"]').val($(this).data('province_code')).change();
      $('[name="division_no_start"]').val($(this).data('division_no_start'));
      $('[name="division_no_end"]').val($(this).data('division_no_end'));
      $('[name="alert_at"]').val($(this).data('alert_at'));
      $('[name="present_division_no"]').val($(this).data('present_division_no'));
      $('[name="status"]').val($(this).data('status'));
      $('#edit-id').val($(this).data('id'));
      document.getElementById("editform").action = base_url + "/" + $(this).data('id');
   });
   $('.div_no').keyup(function() {
      var code = $(this).val();
      code = code.replace(/[^0-9_]/g, '');
      $(this).val(code);

   });

   $('#add-division').click(function(e) {
      e.preventDefault();
      var province = $("#addModel .province");
      var start_no = $("#addModel .start-no");
      var end_no = $("#addModel .end-no");
      var alert_no = $("#addModel .alert-no");
      var oldId = $("#new-id").val();
      var status = $("#addModel .status");
      var form = $("#newForm");
      checkDiv(province, start_no, end_no,alert_no, form, oldId, status);
   });

   $('#update-division').click(function(e) {
      e.preventDefault();
      var province = $("#editModel .province");
      var start_no = $("#editModel .start-no");
      var end_no = $("#editModel .end-no");
      var alert_no = $("#editModel .alert-no");
      var oldId = $("#edit-id").val();
      var status = $("#editModel .status");
      var form = $("#editform");
      checkDiv(province, start_no, end_no, alert_no, form, oldId, status);
   });

   function checkDiv(province, start_no, end_no, alert_no, form, oldId = null, status) {
      if (province.val() == null) {
         alert($('.province').attr('title'));
         province.focus();
         return false;
      } else if (start_no.val() == "") {
         alert($('.start-no').attr('title'));
         start_no.focus();
         return false;
      } else if (end_no.val() == "") {
         alert($('.end-no').attr('title'));
         end_no.focus();
         return false;
      } else if (alert_no.val() == "") {
         alert($('.alert-no').attr('title'));
         alert_no.focus();
         return false;
      } else if (status.val() == null) {
         alert($('.status').attr('title'));
         status.focus();
         return false;
      } else if (parseInt(start_no.val()) >= parseInt(end_no.val())) {
         alert("Division No. End should be greater than Division No. Start.");
         end_no.focus();
         return false;
      } else if (parseInt(alert_no.val()) < parseInt(start_no.val()) || parseInt(alert_no.val()) > parseInt(end_no.val())) {
         alert($('.alert-no').attr('title1'));
         alert_no.focus();
         return false;
      } 

      var num_start = start_no.val();
      var num_end = end_no.val();
      var num_alert = alert_no.val();
      if (num_start.length < 7) {
         num_start = createDivNumber(num_start);
         start_no.val(num_start);
      }
      if (num_end.length < 7) {
         num_end = createDivNumber(num_end);
         end_no.val(num_end);
      }
      if (num_alert.length < 7) {
         num_alert = createDivNumber(num_alert);
         alert_no.val(num_alert);
      }

      var url = "/check-division-status?province=" + province.val() + "&status=" + status.val() + "&id=" + oldId;
      $.get('/check-division?id=' + oldId + "&start_no=" + num_start + "&end_no=" + num_end, function(response) {

         $.get(url, function(data) {
            //console.log(response);
            if (data.status == "taken") {
               alert(data.message);
               return false;
            } else if (response.status == "start") {
               alert(response.message);
               start_no.focus();
               return false;
            } else if (response.status == "end") {
               alert(response.message);
               end_no.focus();
               return false;
            } else {
               form.submit();
            }
         });

      });
   }

   function createDivNumber(division_no) {
      division_no = division_no.padStart(7, 0);
      return division_no;
   }
</script>
@endpush