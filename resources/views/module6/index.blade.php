@extends('vrms2.layouts.master')
@section('passport_list','active') 
@section('content')
@include('module6.mod6-submenu')     
<h3>{{trans('title.reg_list')}}</h3>
@include('flash')
<div class="card-body">
   <div class="table-responsive">
      <table id="vehiclePassport" class="table table-striped" style="width:100%">
         <thead>
            <tr>
               <th>{{ trans('register.book_no')}}</th>
               <th>{{ trans('register.license_no')}}</th>
               <th>{{ trans('register.province')}}</th>
               <th> {{ trans('register.name')}} </th>
               <th> {{ trans('register.veh_purpose')}} </th>
               <th>{{trans('register.make')}}</th>
               <th>{{trans('register.model')}}</th>
               <th width="20">{{trans('register.engine_no')}}</th>
               <th width="20">{{trans('register.issue_date')}}</th>
               <th>{{trans('register.expire_date')}}</th>
               <th width="200"> {{trans('common.action')}}</th>
            </tr>
         </thead>
         <tbody>
            @foreach($car as $data)
            <tr>
               <td> {{ $data->book_no }} </td>
               <td>{{$data->license_no}}</td>
               <td>{{$data->pro['name'] ?? ''}}</td>
               <td> {{$data->name}}({{$data->name_en}}) </td>
               <td> {{ $data->vehicle_purpose->name ?? ''}} ({{ $data->vehicle_purpose->name_en ?? ''}}) </td>
               <td>{{$data->brand->name ?? ''}}</td>
               <td>{{$data->vehicle_model->name ?? ''}}</td>
               <td> @if($data->engine_no){{$data->engine_no}}@endif</td>
               <td>{{ Carbon\Carbon::parse($data->issue_date)->format('Y/m/d') }}</td>
               <td>{{ Carbon\Carbon::parse($data->expire_date)->format('Y/m/d') }}</td>
               <td> @can('New-Register-List-Print') 
                  <a href="{{url('print',$data->id)}}" class="btn btn-primary btn-sm mb-1">
                     {{trans('button.print')}}
                  </a>
                  @endcan
                  @can('New-Register-Entry-Edit') 
                  <a href="{{route('vehicle-passport.edit',[$data->id])}}" class="btn-sm mb-1">                     
                     <img src="{{ asset('images/edit.png') }}" alt="" title="{{trans('button.edit')}}" width="25px" height="25px">
                  </a> 
                     @endcan
                  @can('New-Register-Entry-Delete') 
                  <a href="" class="delete-btn mb-1" data-toggle="modal" data-target="#deleteModel" data-backdrop="static" data-keyboard="false" data-act="Delete" data-id="{{$data->id}}">
                     <img src="{{ asset('images/delete.png') }}" alt="" title="{{trans('button.delete')}}" width="25px" height="25px">
                  </a>
                  @endcan 
               </td>
            </tr>
            @endforeach 
         </tbody>
      </table>
      {!! $car->links() !!}
   </div>
</div>
@include('delete') 
@endsection 
@push('page_scripts')
<script>
   $('#vehiclePassport').dataTable( {
     "bPaginate": false,
     "bFilter": false
     });
   $(document).ready(function() {
   	var base_url = "{{url('vehicle-passport')}}";
   	$(document).on("click", '.delete-btn', function(e) {
   		document.getElementById("deleteform").action = base_url + "/" + $(this).data('id');
   	});
   });
</script> 
@endpush