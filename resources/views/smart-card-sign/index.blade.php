@extends('layouts.master')
@section('setting','active')
@section('content') 
<h1 class="page-header">Smart Card Sign List</h1>
<div class="card">
   @include('flash') 
   <div class="row">
      <div class="col-lg-12 add-new">
         <div class="pull-left">
            <a data-toggle="modal"  data-target="#addModel1" class="btn btn-primary btn-save" style="color: #fff !important">{{trans('common.add_new')}}</a>
         </div>
      </div>
   </div>
   <div class="card-body">
      <table id="myTable" class="table table-striped table-bordered" style="width:100%">
         <thead>
            <tr>
               <th>NO</th>
               <th>sign Image</th>
               <th>Province</th>
               <th>Status</th>
               <th>{{ trans('transfer_vehicle.action') }}</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($cardsign as $vehicleinspection)
            <tr>
               <td>{{$vehicleinspection -> id}}</td>
               <td><img src="{{asset('images/sign/sign.png')}}"></td>
               <td>@if(isset($vehicleinspection-> province -> name))<span>{{$vehicleinspection->province['name']}}({{$vehicleinspection->province['name_en']}})</span>@else{{"_"}}@endif</td>
               <td>@if($vehicleinspection->status ==1)Active @else Deactive @endif</td>
               <td>
                  <button type="button" class="btn btn-info  edit_btn"
                     data-toggle="modal" data-target="#editModel"
                     data-act="Edit"
                     data-province_code="{{$vehicleinspection->province_code}}"
                     data-sign_img="{{$vehicleinspection->sign_img}}"
                     data-status="{{$vehicleinspection->status}}"
                     data-id="{{$vehicleinspection->id}}">{{trans('button.edit')}}
                  </button>  
                  <button type="button" class="btn btn-danger delete_btn"
                     data-toggle="modal" data-target="#deleteModel"
                     data-act="Delete"
                     data-id="{{$vehicleinspection->id}}">{{trans('button.delete')}}
                  </button> 
               </td>
            </tr>
            @endforeach 
         </tbody>
      </table>
   </div>
</div>
@component('component.module4.smartcardsign',['province'=>$province])
@endcomponent
@include('delete')
@endsection
@push('page_scripts')
<script type="text/javascript">
   var base_url = "{{url('/smart-card-sign/')}}";
   $(document).on("click", '.delete_btn', function (e) { 
       document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
   });
   
   $(document).on("click", '.edit_btn', function (e) {  
       $('[name="province_code"]').val($(this).data('province_code'));
       $('[name="sign_img"]').val($(this).data('sign_img'));
       $('[name="status"]').val($(this).data('status'));
   
       document.getElementById("editform").action = base_url+"/"+$(this).data('id');
   });
   
</script>
@endpush