@extends('vrms2.layouts.master') 
@section('pre_report','active') 
@section('content') 
@php $province = App\Model\Province::whereStatus('1')->get(); 
@endphp
@include('vrms2.report-submenu')
<h3>{{trans('title.pre_reg_report')}}</h3>
@include('flash')
<div class="card-body">
   <form action="{{url('/pre-registration-report')}}" method="POST">
      {{ csrf_field() }}
      <div class="row">
         <div class="col-md-3 col-sm-12 mb-4">
            <label>{{ trans('finicialreports.select_options') }}:</label>
            <div>
               <select id="d_m_y_radio" name="type" type="input" class="form-control" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required="">
                  <option value=""><span>--{{ trans('finicialreports.select_options') }}--</span></option>
                  <option value="today" {{ session()->get('pre_type') == 'today'?'selected':'' }}>{{ trans('finicialreports.daily') }}</option>
                  <option value="month" {{ session()->get('pre_type') == 'month'?'selected':'' }}>Monthly</option>
                  <option value="year" {{ session()->get('pre_type') == 'year'?'selected':'' }}>Yearly</option>
               </select>
            </div>
         </div>
         <div class="col-md-3 col-sm-12 mb-4">
            <label class="col-auto">{{ trans('finicialreports.from') }} :</label>
            <div class="col-auto">
               <input type="text" class="form-control date" format="dd-mm-yyyy" name="from" value="{{ session()->get('pre_from') }}" placeholder="Enter From date" required=""> 
            </div>
         </div>
         <div class="col-md-3 col-sm-12 mb-4">
            <label class="col-auto ">{{ trans('finicialreports.to') }} :</label>
            <div class="col-auto">
               <input type="text" class="form-control date" format="dd-mm-yyyy" name="to" value="{{ session()->get('pre_to') }}" placeholder="Enter To Date" required=""> 
            </div>
         </div>
         <div class="col-md-3 col-sm-12 mb-4">
            <label class="col-auto ">{{ trans('common.province') }} :</label>
            <div class="col-auto">
               <select name="province" id="province" class="form-control js-example-basic-single" required="">
                  <option value="" selected disabled hidden>--Select Province--</option>
                  @foreach($province as $key => $value)
                  <option value="{{$value->id}}" {{ session()->get('pre_province') == $value->id?'selected':'' }}>{{$value->name}}({{$value->name_en}})</option> @endforeach</option>
               </select>
            </div>
         </div>
         <div class="col-md-3 col-sm-12 mb-4">
            <button type="submit" class="btn btn-primary btn-sm">{{ trans('button.search') }}</button>
            <a class="btn btn-success btn-sm text-white" id="btnExport" onclick="fnExcelReport('PreRegistrationReport');">
            {{ trans('button.export_excel') }}
            </a> 
         </div>
      </div>
   </form>
   <br/>
   <hr/>
   <br/>
   <table id="table" class="table table-striped">
      <thead>
         <tr>
            <th>{{trans('module4.license_no')}}</th>
            <th>{{trans('common.district_code')}}</th>
            <th>{{trans('common.province_code')}}</th>
            <th>{{trans('module4.owner_name')}}</th>
            <th>{{trans('common.date')}}</th>
            <th>{{trans('common.staff')}}</th>
         </tr>
      </thead>
      <tbody>
         @foreach ($pre_reg_report as $item) @foreach ($item as $pre_reg)
         <tr>
            <td>@if(isset($pre_reg->vehicle_detail)){{$pre_reg->vehicle_detail->licence_no_need}}@else{{"_"}}@endif</td>
            <td>@if(isset($pre_reg->vehicle_detail)){{$pre_reg->vehicle_detail->district->name ?? ''}}@else{{"_"}}@endif</td>
            <td>@if(isset($pre_reg->vehicle_detail)){{$pre_reg->vehicle_detail->province->name ?? ''}}@else{{"_"}}@endif</td>
            <td>@if(isset($pre_reg->vehicle_detail)){{$pre_reg->vehicle_detail->owner_name}}@else{{"_"}}@endif</td>
            <td>{{Carbon\Carbon::parse($pre_reg['created_at'])->format('d-m-Y')}}</td>
            <td>@if(isset($pre_reg-> user)){{$pre_reg-> user -> name}}@else{{"_"}}@endif</td>
         </tr>
         @endforeach @endforeach 
      </tbody>
   </table>
</div>
@include('includes.exportExcel') 
@endsection 
@push('page_scripts')
<script type="text/javascript">
   var base_url = "{{url('registration-report')}}";
   $(".delete").on("submit", function() {
   	return confirm("Are you sure to delete?");
   });
</script> 
@endpush