@extends('vrms2.layouts.master')
@section('reg_report','active') 
@section('content') 
@php $province = App\Model\Province::whereStatus('1')->get(); 
@endphp
@include('vrms2.report-submenu')
<h3>{{trans('title.reg_report')}}</h3>
@include('flash')
	<div class="card-body">
		<form action="{{url('registration-report')}}" method="POST"> {{ csrf_field() }}
			<div class="row">
				<div class="col-md-3 col-sm-12 mb-4">
					<div class="form-group">
						<label>{{ trans('finicialreports.select_options') }}:</label>
						<div>
							<select id="d_m_y_radio" name="type" type="input" class="form-control" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required="">
								<option value=""><span>--{{ trans('finicialreports.select_options') }}--</span></option>
								<option value="today" {{ session()->get('reg_type') == 'today'?'selected':'' }}>{{ trans('finicialreports.daily') }}</option>
								<option value="month" {{ session()->get('reg_type') == 'month'?'selected':'' }}>Monthly</option>
								<option value="year" {{ session()->get('reg_type') == 'year'?'selected':'' }}>Yearly</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-12 mb-4">
					<div class="form-group">
						<label class="col-auto">{{ trans('finicialreports.from') }} :</label>
						<div class="col-auto">
							<input type="text" id="date" class="form-control" format="dd-mm-yyyy" name="from" value="{{ session()->get('reg_from') }}" placeholder="Enter From date" required=""> </div>
					</div>
				</div>
				<div class="col-md-3 col-sm-12 mb-4">
					<div class="form-group">
						<label class="col-auto ">{{ trans('finicialreports.to') }} :</label>
						<div class="col-auto">
							<input type="text" id="issue_date" class="form-control" format="dd-mm-yyyy" name="to" value="{{ session()->get('reg_to') }}" placeholder="Enter To Date" required=""> </div>
					</div>
				</div>
				<div class="col-md-3 col-sm-12 mb-4">
					<div class="form-group">
						<label class="col-auto ">{{ trans('common.province') }} :</label>
						<div class="col-auto">
							<select name="province" id="province" class="form-control js-example-basic-single" required="">
								<option value="" selected disabled hidden>--Select Province--</option> @foreach($province as $key => $value)
								<option value="{{$value->id}}" {{ session()->get('reg_province') == $value->id?'selected':'' }}>{{$value->name}}({{$value->name_en}})</option> @endforeach</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-12 mb-4">
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-sm">{{ trans('button.search') }}</button> <a class="btn btn-success btn-sm text-white" id="btnExport" onclick="fnExcelReport('RegistrationReport');">
						{{ trans('button.export_excel') }}
                </a> </div>
				</div>
			</div>
		</form>
		<br/>
		<hr/>
		<br/>
		<table id="table" class="table table-striped">
			<thead>
				<tr>
				<th>{{trans('module4.app_purpose')}}</th>
					<th>{{trans('module4.app_no')}}</th>
					<th>{{trans('module4.vehicle_type')}}</th>
					<th>{{trans('common.date')}}</th>
					<th>{{trans('common.staff')}}</th>
				</tr>
			</thead>
			<tbody> @foreach ($registration_report as $item) @foreach ($item as $reg_app_report)
				<tr>
					<td>@foreach($reg_app_report->appFormPurpose as $data){{$data-> app_purpose-> name ?? ''}}, @endforeach</td>
					<td>{{$reg_app_report['app_no']}}</td>
					<td>@if(isset($reg_app_report->vehicle->vtype)){{$reg_app_report->vehicle->vtype->name}}@else{{"_"}}@endif</td>
					<td>{{Carbon\Carbon::parse($reg_app_report['created_at'])->format('d-m-Y')}}</td>
					<td>@if(isset($reg_app_report-> staff)){{$reg_app_report-> staff-> name}}@else{{"_"}}@endif</td>
				</tr> @endforeach @endforeach </tbody>
		</table>
	</div>

@include('includes.exportExcel')
@endsection @push('page_scripts')
<script type="text/javascript">
var base_url = "{{url('registration-report')}}";
$(".delete").on("submit", function() {
	return confirm("Are you sure to delete?");
});
</script>
 @endpush