@extends('vrms2.layouts.master')
@section('register','active')
@section('title','Print')
@section('passport_list','active')
@section('content')
@include('module6.mod6-submenu')

@if(in_array($data->vehicle_purpose_id,$yellow))
<style>
  .right {
    background-image: url(/images/yellow.png);
  }
</style>
@endif
@if(in_array($data->vehicle_purpose_id,$green))
<style>
  .right {
    background-image: url(/images/green.jpg);
  }
</style>
@endif
@if(in_array($data->vehicle_purpose_id,$pink))
<style>
  .right {
    background-image: url(/images/pink.jpg);
  }
</style>
@endif
<h3>Passport Print</h3>
<div>
  <input type="hidden" name="id" id="register_id" value="{{$data->id}}">

  <div id="print" class="right">
    <div id="no"> {{$data->book_no}} </div>

    <div id="ty">
      @if(in_array($data->vehicle_purpose_id,$yellow))
      <div id="ty1"> @if($data->vehicle_purpose_id == 1)<i class="fa fa-check" aria-hidden="true"></i>@else<i class="fa fa-times" aria-hidden="true"></i>@endif </div>
      <div id="ty2"> @if($data->vehicle_purpose_id == 2)<i class="fa fa-check" aria-hidden="true"></i>@else<i class="fa fa-times" aria-hidden="true"></i>@endif </div>
      <div id="ty3"> @if($data->vehicle_purpose_id == 3)<i class="fa fa-check" aria-hidden="true"></i>@else<i class="fa fa-times" aria-hidden="true"></i>@endif </div>
      @elseif(in_array($data->vehicle_purpose_id,$green))
      <div id="ty1"> @if($data->vehicle_purpose_id == 4)<i class="fa fa-check" aria-hidden="true"></i>@else <i class="fa fa-times" aria-hidden="true"></i>@endif </div>
      <div id="ty2"> @if($data->vehicle_purpose_id == 5)<i class="fa fa-check" aria-hidden="true"></i> @else <i class="fa fa-times" aria-hidden="true"></i>@endif </div>
      <div id="ty3"> @if($data->vehicle_purpose_id == 6)<i class="fa fa-check" aria-hidden="true"></i> @else <i class="fa fa-times" aria-hidden="true"></i>@endif </div>
      @else
      <div id="ty1"> @if($data->vehicle_purpose_id == 7) <i class="fa fa-check" aria-hidden="true"></i>@else <i class="fa fa-times" aria-hidden="true"></i>@endif </div>
      <div id="ty2"> @if($data->vehicle_purpose_id == 8)<i class="fa fa-check" aria-hidden="true"></i> @else <i class="fa fa-times" aria-hidden="true"></i>@endif </div>
      <div id="ty2">&nbsp; </div>
      @endif
    </div>

    <div id="regno">
      <div id="regno1">
        <p>{{$data->pro->name ?? ''}}</p>
        <p>{{$data->license_no}}</p>
      </div>
    </div>

  </div>
  <div class="row mb-2">
    <div class="col-md-3 mt-2">
      <div class="text-left ml-2">
        <a href="{{ url('/vehicle-passport') }}" class="btn btn-secondary btn-sm">{{ trans('button.back') }}</a>&nbsp;
        <a class=" no-print btn btn-info btn-sm text-white" onclick="jQuery('#print').print()">{{trans('button.print')}}</a>
      </div>
    </div>

    <div class="col-md-9 no-print mt-2">
      <div class="text-center">
        <a href="{{url('/getPrint/'.$data->id.'/p1')}}" title="p1" class="btn btn-outline-primary btn-fw btn-sm active">Page1</a>
        <a href="{{url('/getPrint/'.$data->id.'/p2')}}" title="p2" class="btn btn-outline-primary btn-fw btn-sm">Page2</a>
        <a href="{{url('/getPrint/'.$data->id.'/p3')}}" title="p3" class="btn btn-outline-primary btn-fw btn-sm">Page3</a><br />
      </div>
    </div>
  </div>
</div>

@endsection
@push("page_scripts")
<script src="{{asset('js/jQuery.print.js')}}"></script>

@endpush