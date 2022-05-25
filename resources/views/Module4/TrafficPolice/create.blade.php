@extends('layouts.master')
@section('vims','active')
@section('title','Traffic Police')
@section('content')
<style>
    .table-icontable td {
        border-collapse: collapse;
        border: none !important;
    }
    .table-icontable tr td {
    padding-top: 0;
    }
</style>
@php
$brands = \App\Model\VehicleBrand::whereStatus(1)->get();
$veh_types = \App\Model\VehicleType::whereStatus(1)->get();
$models = \App\Model\VehicleModel::whereStatus(1)->get();
$colors = \App\Model\Color::whereStatus(1)->get();
@endphp
<h1 class="page-header">{{ trans('module4.traffic_accident') }}</h1>
  <div class="card"> 
    <div class="card-body">
        @include('flash')
    <form  action="{{route('traffic-police.store')}}"  method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="validationCustom01">{{ trans('module4.division_number')}}:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Division Number" name="division_no" required>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01">{{ trans('common.date')}}:</label>
                        <input type="text" class="form-control" id="datetime" value="" placeholder="" name="date" required>
                    </div> 
                    <div class="col-md-6">
                        <label for="validationCustom01">{{ trans('module4.license_no')}}:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="License Number" name="license_no" required>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01">{{ trans('module4.place')}}:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Traffic Place" name="place" required>
                    </div>  
                    <div class="col-md-6">
                        <label for="validationCustom01">{{ trans('module4.brand')}}:</label>
                        <select name="brand_id" class="form-control form-control-sm js-example-basic-single" id="vbrand"  style="width: 100%;" >
                            <option value="" selected disabled>Select Brand</option>
                            @foreach($brands as $brand)
                            <option value="{{$brand->id}}" >{{ $brand->name}}</option>
                            @endforeach
                        </select> 
                        
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01">{{ trans('module4.offender')}}:</label>
                        <input type="text" class="date form-control" id="validationCustom01" value="" placeholder="Offender" name="offender_name" required>
                    </div> 
                    <div class="col-md-6">
                        <label for="validationCustom01">{{ trans('module4.model')}}:</label>
                        <select name="model_id" class="form-control form-control-sm js-example-basic-single" id="vmodel" style="width: 100%;" >
                            <option value="" selected disabled>Select Model</option>
                            @foreach($models as $model)
                            <option value="{{$model->id}}" >{{ $model->name}}</option>
                            @endforeach
                        </select> 
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01">{{ trans('module4.officer')}}:</label>
                        <input type="text" class="date form-control" id="validationCustom01" value="" placeholder="Officer" name="officer_name" required>
                    </div> 
                    <div class="col-md-6">
                        <label for="validationCustom01">{{ trans('module4.color')}}:</label>
                        <select name="color_id" id="color" class="form-control form-control-sm js-example-basic-single" style="width: 100%;" >
                            <option value="" selected disabled>Select Color</option>
                            @foreach($colors as $color)
                            <option value="{{$color->id}}">{{ $color->name}}</option>
                            @endforeach
                        </select> 
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01">{{ trans('common.status')}}:</label>
                        <select class="form-control" id="validationCustom01" name="status" required>
                            <option value="1">Active</option>
                            <option value="0">Deactive</option>
                        </select>
                    </div> 
                    <div class="col-md-6">
                        <label for="validationCustom01">{{ trans('module4.vehicle_type')}}:</label>
                        <select name="vehicle_type_id" id="vehicle_type" class="form-control-sm js-example-basic-single" style="width: 100%;" >
                            <option value="" selected disabled>Select Vehicle Type</option>
                            @foreach($veh_types as $vtype)
                            <option value="{{$vtype->id}}" >{{ $vtype->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01">{{ trans('module4.note')}}:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Note" name="remark" required>
                    </div> 
                </div>
            </div>
        
            <div class="col-md-8">
            <h5 style="text-align: center;font-weight: bold;">Charges</h5>
            <table class="table table-icontable">
            <tbody>
                @foreach($traffic_accidence->chunk(3) as $chunked_accidence)
                    <tr>
                        @foreach( $chunked_accidence as $dealAccidence )
                            <td>
                                <label class="form-check-label">
                                    <input type="checkbox" name="accident_id[]" class="form-check-input" value="{{$dealAccidence->id}}" id="accident_id">
                                    {{$dealAccidence->name}}
                                </label>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        </div>
        
        
            <div class="form-row mt-3">
                <div class="col-md-6 col-sm-6">
                    <a href="{{route('traffic-police.index')}}" class="btn btn-secondary btn-sm">{{ trans('button.back')}}</a>
                </div>
                <div class="col-md-6 col-sm-6 text-right">
                <button type="submit" class="btn btn-success btn-sm" onClick="return validate_check()">{{trans('button.save')}}</button>
                </div>
            </div>
    </form>
    <hr>
            <div class="table-responsive">
                <table id="myTable" class="table table-bordered">
                  <tr>
                      <th>{{ trans('module4.traffic_name')}}</th>
                      <th>{{ trans('module4.traffic_place')}}</th>
                      <th>{{ trans('common.date')}}</th>
                      <th>{{ trans('common.status')}}</th>
                      <th width="250">{{ trans('common.action')}}</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($traffic_police as $value)
                    <tr>
                        <td> 
                            @foreach($value->illegal_trafic_acc as $item)
                              @if(isset($item->traffic_accident)){{$item->traffic_accident->name}},@else{{""}}@endif
                            @endforeach
                        </td>
                        <td>{{ $value->place }}</td>
                        <td>{{ \Carbon\Carbon::parse($value->date)->format("d-m-Y") }}</td>
                        <td>@if($value->status == 0){{ "Deactive" }}@else{{"Active"}}@endif</td>
                        <td>
                            
                            <button type="button" class="btn btn-info btn-sm view_btn"
                                data-toggle="modal" data-target="#viewModel{{$value->id}}"
                                data-act="View"
                               >{{trans('button.view')}}
                            </button>
                            <button type="button" class="btn btn-primary btn-sm edit_btn"
                                data-toggle="modal" data-target="#editModel{{$value->id}}"
                                data-act="Edit"
                                >{{trans('button.edit')}}
                            </button>
                            
                            <a href="" class="btn btn-danger btn-sm delete_btn"
                                data-toggle="modal" data-target="#deleteModel"
                                data-id="{{$value -> id}}"> </span>{{ trans('button.delete') }}
                            </a>
                           
                        </td>
                    </tr>
                    @include('Module4.TrafficPolice.view', ['traffic' => $value, 'traffic_accidence' =>$traffic_accidence])
                    @include('Module4.TrafficPolice.edit', ['traffic' => $value, 'traffic_accidence' =>$traffic_accidence])
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div> 
@include('Module4.TrafficPolice.delete')

@endsection

@push('page_scripts')
<script type="text/javascript">
var base_url = "{{url('/traffic-police')}}";

$(document).on("click", '.delete_btn', function (e) {  
        
        document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
    }); 

function validate_check(){
  var checkedCount = $('input[id=accident_id]:checkbox:checked').length;
  if(checkedCount > 0){
    return true;
  }else{
    alert("Please select at least one at charges!!!");
    return false;
  }
}
</script>
@endpush