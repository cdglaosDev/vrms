@extends('vrms2.layouts.master')
@section('vims','active')
@section('content') 
<h3>{{ trans('module4.license_history_detail')}}</h3>
<div class="card-body">
   @include('flash') 
   <div class="row mb-3">
      <div class="col-md-3 col-sm-3">
         <label for="">{{ trans('module4.alphabet') }}</label>
         <input type="text" value="{{$license_history -> alphabet -> name ?? ''}}" class="form-control">
      </div>
      <div class="col-md-3 col-sm-3">
         <label for="">{{ trans('module4.license_no') }}</label>
         <input type="text" value="{{ $license_history -> alphabet -> name ?? ''}}-{{ $license_history->license_no_number}}" class="form-control">
      </div>
      <div class="col-md-3 col-sm-3">
         <label for="">Vehicle Type Group</label>
         <input type="text" value="{{$license_history -> vehicle->vtype->vehicle_type_group_id ?? ''}}" class="form-control">
      </div>
      <div class="col-md-3 col-sm-3">
         <label for="">{{ trans('common.province') }}</label>
         <input type="text" value="{{$license_history -> vehicle -> province->name ?? ''}}({{$license_history -> vehicle -> province->name_en ?? ''}})" class="form-control">
      </div>
   </div>
   <div class="table-responsive">
      <table id="myTable" class="table table-striped">
         <thead>
            <tr>
               <th>{{ trans('module4.no') }}</th>
               <th>{{ trans('module4.license_no') }}.</th>
               <th>{{ trans('module4.village_name') }}</th>
               <th>{{ trans('module4.customer_name') }}</th>
               <th>{{ trans('module4.expire_date') }}</th>
               <th >{{ trans('common.action') }}</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td></td>
               <td>{{ $license_history -> alphabet -> name ?? ''}}-{{ $license_history->license_no_number}}</td>
               <td>{{$license_history -> vehicle ->village_name ?? ''}}</td>
               <td></td>
               <td>{{$license_history -> vehicle -> expire_date ?? ''}}</td>
               <td>
                  <a href="{{url('/all-vehicles/edit', $license_history->vehicle_id)}}" class="btn btn-primary btn-sm">{{ trans('button.view') }}</a>  
               </td>
            </tr>
         </tbody>
      </table>
   </div>
</div>
@endsection