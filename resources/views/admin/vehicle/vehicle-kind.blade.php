@extends('vrms2.layouts.master')
@section('v_kind','active')
@section('content')

@include('vrms2.mod3-submenu')
<h3>
   {{trans('title.vehiclekind')}}
   <a data-toggle="modal" data-target="#addModel1" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-save" style="color: #fff !important">{{trans('common.add_new')}}</a>
  
</h3>
@include('flash')
<div class="card-body">
   <table id="myTable" class="table table-striped" style="width:100%">
      <thead>
         <tr>
            <th>{{trans('table.vehicle_kind')}}</th>
            <th>{{trans('table.namel')}}</th>
            <th>{{trans('table.namee')}}</th>
            <th>{{trans('table.status')}}</th>
            <th width="200">{{trans('table.action')}}</th>
         </tr>
      </thead>
      <tbody>
         @foreach($vehiclekind as $data)
         <tr>
            <td>{{$data->vehicle_kind_code}}</td>
            <td>{{$data->name}}</td>
            <td>{{$data->name_en}}</td>
            <td>@if($data->status ==1){{trans('table.active')}} @else {{trans('table.deactive')}} @endif</td>
            <td>
               <a href="#" class="edit_btn" data-toggle="modal" data-backdrop="static" 
               data-keyboard="false" data-target="#editModel" data-act="Edit" 
               data-vehicle_kind_code="{{$data->vehicle_kind_code}}" data-name="{{$data->name}}" 
               data-name_en="{{$data->name_en}}" data-status="{{$data->status}}" 
               data-id="{{$data->id}}">
               <img src="{{ asset('images/edit.png') }}" alt="" title="{{trans('button.edit')}}" width="25px" height="25px"></a>
               
               <a href="#" class="delete_btn" disabled data-toggle="modal" data-backdrop="static" 
               data-keyboard="false" data-target="#deleteModel" data-act="Delete" 
               data-id="{{$data->id}}">
               <img src="{{ asset('images/delete.png') }}" alt="" title="{{trans('button.delete')}}" width="25px" height="25px">
               </a>
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>
</div>
@component('component.admin.vehiclekind') @endcomponent
@include('delete')
@endsection
@push('page_scripts')
<script type="text/javascript">
   var base_url = "{{url('admin/vehicle-kind')}}";
   $(document).on("click", '.delete_btn', function(e) {
      document.getElementById("deleteform").action = base_url + "/" + $(this).data('id');
   });
   $(document).on("click", '.edit_btn', function(e) {
      $('[name="vehicle_kind_code"]').val($(this).data('vehicle_kind_code'));
      $('[name="name"]').val($(this).data('name'));
      $('[name="name_en"]').val($(this).data('name_en'));
      $('[name="status"]').val($(this).data('status'));
      $("#edit-id").val($(this).data('id'));
      document.getElementById("editform").action = base_url + "/" + $(this).data('id');
   });
   $('#add-form').click(function(e) {
      e.preventDefault();
      var name = $('#addModel1 .name');
      var name_en = $("#addModel1 .name_en");
      var veh_kind_code = $("#addModel1 .veh_kind_code");
      var oldId = $("#new-id").val();
      var form = $("#addform");
      insertVehicleKind(name, name_en, veh_kind_code, form, oldId);
   });

   $('#edit-form').click(function(e) {
      e.preventDefault();
      var name = $('#editModel .name');
      var name_en = $("#editModel .name_en");
      var veh_kind_code = $("#editModel .veh_kind_code");
      var oldId = $("#edit-id").val();
      var form = $("#editform");
      insertVehicleKind(name, name_en, veh_kind_code, form, oldId);
   });

   function insertVehicleKind(name, name_en, veh_kind_code, form, oldId = null) {
      var url = "/get-vehicle-kind?veh_kind_code=" + veh_kind_code.val() + "&id=" + oldId;
      $.get(url, function(response) {
         if (veh_kind_code.val().trim() == '') {
            alert($('.veh_kind_code').attr('title'));
            $('.veh_kind_code').focus();
            return false;
         } else if (name.val().trim() == '') {
            alert($('.name').attr('title'));
            $('.name').focus();
            return false;
         } else if (name_en.val().trim() == '') {
            alert($('.name_en').attr('title'));
            $('.name_en').focus();
            return false;
         } else if (response.status == "used") {
            alert('ຂໍ້ມູນນີ້ມີຢູ່ແລ້ວ');
            return false;
         } else {
            form.submit();
         }
      });
   }

   $('.modal').on('hidden.bs.modal', function() {
      $(this).find('form').trigger('reset');
   });
</script>
@endpush