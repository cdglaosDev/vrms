@extends('layouts.master') 
@section('register','active') 
@section('title','Register Lists') 
@section('content')
<h1 class="page-header">{{trans('title.reg_list')}}</h1>
<div class="card">
	<div class="card-body"> @include('flash')
		<div class="table-responsive">
			<table id="myTable" class="table table-striped table-bordered" style="width:100%">
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
				<tbody> @foreach($car as $data)
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
							<a href="{{url('print',$data->id)}}" class="btn btn-primary btn-sm mb-1"><i class="fa fa-print"></i></a>
							 @endcan
							 @can('New-Register-Entry-Edit') <a href="{{route('car-register.edit',[$data->id])}}" class="btn btn-info btn-sm mb-1"><i class="fa fa-pencil-square-o"></i></a> @endcan
							  @can('New-Register-Entry-Delete') <a href="" class="btn btn-danger btn-sm delete-btn mb-1" data-toggle="modal" data-target="#deleteModel" data-act="Delete" data-id="{{$data->id}}"><i class="fa fa-trash-o"></i>
							</a>
							@endcan 
						</td>
					</tr> @endforeach </tbody>
			</table>
		</div>
	</div>
</div> 
@include('delete') 
@endsection 
@push('page_scripts')
<script>
var myTable = $('#myTable').DataTable();
$(document).ready(function() {
	var base_url = "{{url('car-register')}}";
	$(document).on("click", '.delete-btn', function(e) {
		document.getElementById("deleteform").action = base_url + "/" + $(this).data('id');
	});
});
</script> @endpush