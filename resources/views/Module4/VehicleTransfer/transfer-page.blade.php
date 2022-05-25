@extends('vrms2.layouts.master')
@section('v_transfer_main_menu','active')
@section('content')

<style>
  #order-listing_filter {
    display: none;
  }
</style>
<h3> {{ trans('module4.vehicle_transfer_list')}}</h3>
<div class="card-body">
  <div class="col-md-8 offset-md-4">
    @can('Vehicle-Transfer-Out') <a href="{{ url('/vehicle-transfer-list/'.'out') }}" class="btn btn-secondary btn-lg">
      <h3>{{ trans('module4.out')}}</h3>
    </a>@endcan
    @can('Vehicle-Transfer-In') <a href="{{ url('vehicle-transfer-list/'. 'in') }}" class="btn btn-secondary btn-lg">
      <h3>{{ trans('module4.in')}}</h3>
    </a>@endcan
  </div>
</div>

@endsection