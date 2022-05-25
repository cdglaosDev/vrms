@extends('vrms2.layouts.master')
@section('v_type','active')
@section('content')

@include('vrms2.mod3-submenu')
<h3>
   {{trans('title.vehicletype')}}
   <a data-toggle="modal" data-target="#addModel1" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-save" style="color: #fff !important">{{trans('common.add_new')}}</a>
</h3>
@include('flash')
<div class="card-body">
   <table id="myTable" class="table table-striped" style="width:100%">
      <thead>
         <tr>
            <th>{{trans('common.name')}} (Lao)</th>
            <th>{{trans('common.name')}} (Eng)</th>
            <th>{{ trans('title.veh_type_group') }}</th>
            <th>{{trans('common.status')}} </th>
            <th>{{trans('common.action')}}</th>
         </tr>
      </thead>
      <tbody>
         @foreach($vehicletype as $data)
         <tr>
            <td>{{$data->name}}</td>
            <td>{{$data->name_en}}</td>
            <td>{{$data->vtype_group->name ?? ''}}</td>
            <td>@if($data->status ==1)Active @else Deactive @endif</td>
            <td>
               <a href="#" class="edit_btn" data-toggle="modal" data-backdrop="static" 
               data-keyboard="false" data-target="#editModel" data-act="Edit" 
               data-name="{{$data->name}}" data-name_en="{{$data->name_en}}" 
               data-veh_type_group_id="{{$data->veh_type_group_id}}" data-status="{{$data->status}}" 
               data-vehicle_type_group_id="{{ $data->vehicle_type_group_id }}" 
               data-id="{{$data->id}}">
               <img src="{{ asset('images/edit.png') }}" alt="" title="{{trans('button.edit')}}" width="25px" height="25px"></a>
               <a href="#" class="delete_btn" 
               data-toggle="modal" 
               data-backdrop="static" 
               data-keyboard="false" 
               data-target="#deleteModel" data-act="Delete" 
               data-id="{{$data->id}}">
               <img src="{{ asset('images/delete.png') }}" alt="" title="{{trans('button.delete')}}" width="25px" height="25px">
               </a>
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>
</div>
@component('component.admin.vehicletype',['VehicleTypeGroup'=>$VehicleTypeGroup]) @endcomponent
@include('delete')
@endsection
@push('page_scripts')
<script type="text/javascript">
   var base_url = "{{url('admin/vehicle-type')}}";
   $(document).on("click", '.delete_btn', function(e) {
      document.getElementById("deleteform").action = base_url + "/" + $(this).data('id');
   });

   $(document).on("click", '.edit_btn', function(e) {
      $('[name="name"]').val($(this).data('name'));
      $('[name="name_en"]').val($(this).data('name_en'));
      $('[name="status"]').val($(this).data('status'));
      $('#edit-id').val($(this).data('id'));
      $('[name="vehicle_type_group_id"]').val($(this).data('vehicle_type_group_id')).attr('selected', 'selected');
      document.getElementById("editform").action = base_url + "/" + $(this).data('id');
   });
   $('#add-form').click(function(e) {
      e.preventDefault();
      var name = $('#addModel1 .name');
      var name_en = $('#addModel1 .name_en');
      var type_group = $('#addModel1 .type_group');
      var oldId = $("#new-id").val();
      var form = $("#addform");
      insertType(name, name_en, type_group, form, oldId);
   });

   $('#edit-form').click(function(e) {
      e.preventDefault();
      var name = $('#editModel .name');
      var name_en = $('#editModel .name_en');
      var type_group = $('#editModel .type_group');
      var oldId = $("#edit-id").val();
      var form = $("#editform");
      insertType(name, name_en, type_group, form, oldId);
   });

   function insertType(name, name_en, type_group, form, oldId = null) {
      var url = "/get-vtype?name=" + name.val() + "&name_en=" + name_en.val() + "&id=" + oldId;
      $.get(url, function(response) {

         if (name.val().trim() == '') {
            alert($('.name').attr('title'));
            $('.name').focus();
            return false;
         } else if (name_en.val().trim() == '') {
            alert($('.name_en').attr('title'));
            $('.name_en').focus();
            return false;
         } else if (type_group.val() == null) {
            alert($('.type_group').attr('title'));
            $('.type_group').focus();
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