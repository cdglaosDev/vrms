@extends('vrms2.layouts.master')
@section('inspect_place', 'active')
@section('content')
@include('vrms2.mod3-submenu')
<h3>
   {{trans('title.inspect_place_title')}}
   @can('Table-Management-Create')
   <a data-toggle="modal" data-target="#addModel1" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-save" style="color: #fff !important">{{trans('common.add_new')}}</a>
   @endcan
</h3>
@include('flash')
<div class="card-body">
   <table id="myTable" class="table table-striped" style="width:100%">
      <thead>
         <tr>
            <th>{{trans('table.namel')}}</th>
            <th>{{trans('table.namee')}}</th>
            <th>{{trans('table.status')}}</th>
            <th>{{trans('table.action')}}</th>
         </tr>
      </thead>
      <tbody>
         @foreach($inspect_place as $data)
         <tr>
            <td>{{$data->name}}</td>
            <td>{{$data->name_en}}</td>
            <td>@if($data->status ==1){{trans('table.active')}} @else {{trans('table.deactive')}} @endif</td>
            <td class="sorting">
               @can('Table-Management-Edit')
               <a href="#" class="edit_btn" data-toggle="modal" data-target="#editModel" 
               data-backdrop="static" data-keyboard="false" data-act="Edit" data-name="{{$data->name}}" 
               data-name_en="{{$data->name_en}}" data-status="{{$data->status}}" data-id="{{$data->id}}">
               <img src="{{ asset('images/edit.png') }}" alt="" title="{{trans('button.edit')}}" width="25px" height="25px"></a> 
               @endcan
               @can('Table-Management-Delete')
               <a href="#" class="delete_btn" data-toggle="modal" data-target="#deleteModel" 
               data-backdrop="static" data-keyboard="false" data-act="Delete" data-id="{{$data->id}}">
               <img src="{{ asset('images/delete.png') }}" alt="" title="{{trans('button.delete')}}" width="25px" height="25px">
               </a> 
               @endcan
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>
</div>
@include('InspectPlace.modal')
@include('delete')
@endsection
@push('page_scripts')
<script type="text/javascript">
   var base_url = "{{url('/inspect-place')}}";
   $(document).on("click", '.delete_btn', function(e) {
      document.getElementById("deleteform").action = base_url + "/" + $(this).data('id');
   });

   $(document).on("click", '.edit_btn', function(e) {
      $('[name="name"]').val($(this).data('name'));
      $('[name="name_en"]').val($(this).data('name_en'));
      $('[name="status"]').val($(this).data('status'));
      document.getElementById("editform").action = base_url + "/" + $(this).data('id');
   });

   $('#add-form').click(function(e) {
      e.preventDefault();
      var name = $('#addModel1 .name');
      var name_en = $("#addModel1 .name_en");
      var form = $("#addform");
      insertInspectPlace(name, name_en, form);
   });

   $('#edit-form').click(function(e) {
      e.preventDefault();
      var name = $('#editModel .name');
      var name_en = $("#editModel .name_en");
      var form = $("#editform");
      insertInspectPlace(name, name_en, form);
   });

   function insertInspectPlace(name, name_en, form) {
      if (name.val().trim() == '') {
         alert($('.name').attr('title'));
         $('.name').focus();
         return false;
      } else if (name_en.val().trim() == '') {
         alert($('.name_en').attr('title'));
         $('.name_en').focus();
         return false;
      } else {
         form.submit();
      }
   }

   $('.modal').on('hidden.bs.modal', function() {
      $(this).find('form').trigger('reset');
   });
</script>
@endpush