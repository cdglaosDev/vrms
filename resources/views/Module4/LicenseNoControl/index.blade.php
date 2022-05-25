@extends('layouts.master')
@section('vims','active')
@section('content') 
<h1 class="page-header">License Number Control</h1>
<div class="panel panel-inverse">
   @include('flash') 
   <div class="row">
      <div class="col-lg-12 add-new">
         <div class="pull-left">
            <a data-toggle="modal"  data-target="#addModel" class="btn btn-primary btn-save">{{trans('common.add_new')}}</a>
         </div>
      </div>
   </div>
   <div class="panel-body">
      <table id="myTable" class="table table-striped table-bordered" style="width:100%">
         <thead>
            <tr>
               <th>Province Code</th>
               <th>Vehicle Type</th>
               <th>License Alphabet</th>
               <th>License Alphabet Control Status</th>
               <th>Status</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
            @foreach($license_no  as $data)
            <tr>
               <td>{{$data->province_code != null?$data->province_code:""}}</td>
               <td>{{$data->vehicle_type_id !=null?$data->vehicle_type->name:""}}</td>
               <td>{{$data->license_alphabet_id !=null?$data->lic_alphabet->name:""}}</td>
               <td>{{$data->license_alphabet_control_status_id !=null?$data->lic_alpha_control->name:""}}</td>
               <td>{{$data->status ==1?"Active":"Deactive"}}</td>
               <td>
                  <a href="" class="btn btn-primary btn-sm  edit_btn"
                     data-toggle="modal" data-target="#editModel"
                     data-act="Edit"
                     data-province_code="{{$data->province_code}}"
                     data-vehicle_type_id="{{$data->vehicle_type_id}}"
                     data-license_alphabet_id="{{$data->license_alphabet_id}}"
                     data-license_alphabet_control_status_id="{{$data->license_alphabet_control_status_id}}"
                     data-status ="{{$data->status}}"
                     data-id="{{$data->id}}">{{trans('button.edit')}}
                  </a>
                  <a href="" class="btn btn-danger btn-sm delete_btn"
                     data-toggle="modal" data-target="#deleteModel"
                     data-id="{{$data->id}}">{{trans('button.delete')}}
                  </a>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
</div>
@include('delete')
@include('LicenseNoControl.modal')
@endsection 
@push('page_scripts')
<script type="text/javascript">
  
     var base_url = "{{url('license-no-control')}}";
       
     $(document).on("click", '.delete_btn', function (e) {  
             
         document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
     });
   
     $(document).on("click", '.edit_btn', function (e) 
     { 
         $('[name="province_code"]').val($(this).data('province_code')).attr('selected', 'selected');
         $('[name="vehicle_type_id"]').val($(this).data('vehicle_type_id')).attr('selected', 'selected');
         $('[name="license_alphabet_id"]').val($(this).data('license_alphabet_id')).attr('selected', 'selected');
         $('[name="license_alphabet_control_status_id"]').val($(this).data('license_alphabet_control_status_id')).attr('selected', 'selected');
         $('[name="status"]').val($(this).data('status')).attr('selected', 'selected');
         document.getElementById("editform").action = base_url+"/"+$(this).data('id');
         });
   
      
   
     
</script>
@endpush