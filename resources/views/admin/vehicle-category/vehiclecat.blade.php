@extends('vrms2.layouts.master')
@section('v_cat','active')
@section('content')

@include('vrms2.mod3-submenu')
<h3>
   {{trans('title.vehicle_category')}}
   @can('Table-Management-Create')
   <a data-toggle="modal"  data-target="#addModel1" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-save" style="color: #fff !important">{{trans('common.add_new')}}</a>
   @endcan
</h3>
@include('flash')
<div class="card-body">
   <table id="myTable" class="table table-striped" style="width:100%">
      <thead>
         <tr>
            <th>{{trans('common.name')}} (Lao)</th>
            <th>{{trans('common.name')}}(Eng)</th>
            <th>{{trans('common.desc')}}</th>
            <th>{{trans('common.status')}}</th>
            <th>{{trans('common.action')}}</th>
         </tr>
      </thead>
      <tbody>
         @foreach($vehiclebrand as $data) 
         <tr>
            <td>{{$data->name}}</td>
            <td>{{$data->name_en}}</td>
            <td>{{$data->description}}</td>
            <td>@if($data->status ==1)Active @else Deactive @endif</td>
            <td class="sorting"> 
               @can('Table-Management-Edit') 
               <a href="#" class="edit_btn" data-toggle="modal" 
               data-backdrop="static" data-keyboard="false" data-target="#editModel" 
               data-act="Edit" data-name="{{$data->name}}" data-name_en="{{$data->name_en}}" 
               data-description="{{$data->description}}" data-log_activiy="{{$data->log_activiy}}" 
               data-status="{{$data->status}}" data-id="{{$data->id}}">
               <img src="{{ asset('images/edit.png') }}" alt="" title="{{trans('button.edit')}}" width="25px" height="25px">
              </a>
               @endcan 
               @can('Table-Management-Delete') 
               <a href="#" class="delete_btn" data-toggle="modal" 
               data-backdrop="static" 
               data-keyboard="false" 
               data-target="#deleteModel" 
               data-act="Delete" 
               data-id="{{$data->id}}">
               <img src="{{ asset('images/delete.png') }}" alt="" title="{{trans('button.delete')}}" width="25px" height="25px">
               </a>
               @endcan 
            </td>
         </tr>
         @endforeach 
      </tbody>
   </table>
</div>
@component('component.admin.vehiclecat') @endcomponent 
@include('delete') 
@endsection 
@push('page_scripts') 
<script type="text/javascript">
   var myTable = $('#myTable').DataTable();
   var base_url = "{{url('admin/vehicle-category')}}";
   $(document).on("click", '.delete_btn', function(e) {
     document.getElementById("deleteform").action = base_url + "/" + $(this).data('id');
   });
   $(document).on("click", '.edit_btn', function(e) {
     $('[name="name"]').val($(this).data('name'));
     $('[name="name_en"]').val($(this).data('name_en'));
     $('[name="description"]').val($(this).data('description'));
     $('[name="log_activiy"]').val($(this).data('log_activiy'));
     $('[name="status"]').val($(this).data('status'));
     document.getElementById("editform").action = base_url + "/" + $(this).data('id');
   });
</script> 
@endpush