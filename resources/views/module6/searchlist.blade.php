@extends('vrms2.layouts.master')
@section('new_register','active') 
@section('content')
@include('module6.mod6-submenu') 
<h3>Vehicle lists by searching division no</h3>
@include('flash')
@can('New-Register')
@if(isset($vehicle))
<div class="card-body">
   <div class="table-responsive mt-4">
      <table id="myTable" class="table table-striped">
         <thead>
            <tr>
               <td>Division No</td>
               <td>Licence No</td>
               <td>Brand</td>
               <td>Model</td>
               <td>Owner Name</td>
               <td>Action</td>
            </tr>
         </thead>
         <tbody>
            @foreach($vehicle as $data)
            <tr>
               <td>{{ $data->division_no ??''}}</td>
               <td>{{ $data->licence_no ??''}}</td>
               <td>{{ $data->vbrand->name ??''}}</td>
               <td>{{ $data->vmodel->name ??''}}</td>
               <td>{{ $data->owner_name ??''}}</td>
               <td>
                  <form action="{{ route('getSearchData') }}" method="POST" class="form-horizontal" id="search" >
                     @csrf
                     <input type="hidden" id="vehicle_id" name="vehicle_id" value="{{$data->id}}">
                     <button class="btn btn-success btn-sm btn-sm">Use</button>
                  </form>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
   <a href="{{url('/search')}}" class="btn btn-secondary btn-sm">{{ trans('button.back') }}</a>
   @endif
</div>
@endcan 
@endsection