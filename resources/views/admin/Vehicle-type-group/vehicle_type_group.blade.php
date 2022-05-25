@extends('vrms2.layouts.master')
@section('v_type_group', 'active')
@section('content')
@include('vrms2.mod3-submenu')
<h3>
   {{trans('title.vehicle_type_group')}}
   <a data-toggle="modal" data-target="#addModel1" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-save" style="color: #fff !important">{{trans('common.add_new')}}</a>
</h3>

@include('flash')
<div class="card-body">
   <table id="myTable" class="table table-striped" style="width:100%">
      <thead>
         <tr>
            <th>{{trans('table.name')}} </th>
            <th>{{trans('common.status')}} </th>
            <th>{{trans('common.action')}} </th>
         </tr>
      </thead>
      <tbody>
         @foreach($data as $key=>$typegroup)
         <tr>
            <td>{{$typegroup->name}}</td>
            <td>@if($typegroup->status ==1)Active @else Deactive @endif</td>
            <td>
               @if($typegroup->id==5 || $typegroup->id==6)
               <a class="edit_btn disabled" data-toggle="modal" title="{{trans('button.edit')}}" data-backdrop="static" data-keyboard="false" data-target="#editModel" data-act="Edit" data-name="{{$typegroup->name}}" data-status="{{$typegroup->status}}" data-id="{{$typegroup->id}}">
               <img src="{{ asset('images/edit_gray.png') }}" alt="" width="25px" height="25px"></a>
               @else
               <a  class="edit_btn" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#editModel" data-act="Edit" data-name="{{$typegroup->name}}" data-status="{{$typegroup->status}}" data-id="{{$typegroup->id}}">
                  <img src="{{ asset('images/edit.png') }}" alt="" title="{{trans('button.edit')}}" width="25px" height="25px"></a>
               @endif
               @if($typegroup->id==5 || $typegroup->id==6)
               <a class="delete_btn disabled" 
                  data-toggle="modal" data-backdrop="static" data-keyboard="false" 
                  data-target="#deleteModel" data-act="Delete" data-id="{{$typegroup->id}}">
                  <img src="{{ asset('images/delete_gray.png') }}" alt="" title="{{trans('button.delete')}}" width="25px" height="25px"></a>

               @else
               <a  class="delete_btn" 
                  data-toggle="modal" data-backdrop="static" data-keyboard="false" 
                  data-target="#deleteModel" data-act="Delete" data-id="{{$typegroup->id}}">
                  <img src="{{ asset('images/delete.png') }}" alt="" title="{{trans('button.delete')}}" width="25px" height="25px">
               </a>
               @endif
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>
</div>
@component('component.admin.vehicle_type_group') @endcomponent
@include('delete')
@endsection
@push('page_scripts')
<script type="text/javascript">
   var base_url = "{{url('/admin/vehicle-type-group/')}}";
   $(document).on("click", '.delete_btn', function(e) {
      document.getElementById("deleteform").action = base_url + "/" + $(this).data('id');
   });

   $(document).on("click", '.edit_btn', function(e) {
      $('[name="name"]').val($(this).data('name'));
      $('[name="status"]').val($(this).data('status'));
      $('#edit-id').val($(this).data('id'));
      document.getElementById("editform").action = base_url + "/" + $(this).data('id');
   });

   $('#add-form').click(function(e) {
      e.preventDefault();
      var name = $('#addModel1 .name');
      var oldId = $("#new-id").val();
      var form = $("#addform");
      insertDistrict(name, form, oldId);
   });

   $('#edit-form').click(function(e) {
      e.preventDefault();
      var name = $('#editModel .name');
      var oldId = $("#edit-id").val();
      var form = $("#editform");
      insertDistrict(name, form, oldId);
   });

   function insertDistrict(name, form, oldId = null) {
      var url = "/get-vtype-group?name=" + name.val() + "&id=" + oldId;
      $.get(url, function(response) {

         if (name.val().trim() == '') {
            alert($('.name').attr('title'));
            $('.name').focus();
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
      //$('.js-example-basic-single').val(null).trigger('change');
   });
</script>
@endpush