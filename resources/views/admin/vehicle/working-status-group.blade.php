@extends('vrms2.layouts.master')
@section('working_group','active')
@section('content')

@include('vrms2.mod3-submenu')
<h3>
   {{trans('title.workingstatusgroup')}}
   <a data-toggle="modal" data-target="#addModel1" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-save" style="color: #fff !important">{{trans('common.add_new')}}</a>
 
</h3>
@include('flash')
<div class="card-body">
   <table id="myTable" class="table table-striped" style="width:100%">
      <thead>
         <tr>
            <th>{{trans('table.namel')}}</th>
            <th>{{trans('table.namee')}}</th>
            <th>{{trans('table.description')}}</th>
            <th>{{trans('table.status')}}</th>
            <th>{{trans('table.action')}}</th>
         </tr>
      </thead>
      <tbody>
         @foreach($workingstatusgroup as $data) 
         <tr>
            <td>{{$data->name}}</td>
            <td>{{$data->name_en}}</td>
            <td>{{$data->description}}</td>
            <td>@if($data->status ==1) {{trans('table.active')}} @else {{trans('table.deactive')}} @endif</td>
            <td class="sorting"> 
               <button type="button" class="btn btn-info edit_btn" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#editModel" data-act="Edit" data-name="{{$data->name}}" data-name_en="{{$data->name_en}}" data-description="{{$data->description}}" data-status="{{$data->status}}" data-id="{{$data->id}}">{{trans('button.edit')}}
               </button> 
               <button type="button" class="btn btn-danger delete_btn" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#deleteModel" data-act="Delete" data-id="{{$data->id}}">{{trans('button.delete')}}
               </button> 
            </td>
         </tr>
         @endforeach 
      </tbody>
   </table>
</div>
@component('component.admin.workingstatusgroup') @endcomponent 
@include('delete')
@endsection 
@push('page_scripts') 
<script type="text/javascript">
 
   var base_url = "{{url('admin/working-status-group')}}";
   $(document).on("click", '.delete_btn', function(e) {
     document.getElementById("deleteform").action = base_url + "/" + $(this).data('id');
   });
   $(document).on("click", '.edit_btn', function(e) {
     $('[name="name"]').val($(this).data('name'));
     $('[name="name_en"]').val($(this).data('name_en'));
     $('[name="description"]').val($(this).data('description'));
     $('[name="status"]').val($(this).data('status'));
     document.getElementById("editform").action = base_url + "/" + $(this).data('id');
   });
</script> 
@endpush