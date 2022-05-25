@extends('vrms2.layouts.master')
@section('passport_report','active') 
@section('content')
@php
$province = App\Model\Province::whereStatus('1')->get();
@endphp
@include('module6.mod6-submenu')    
<h3>{{trans('title.print_passport_report')}}</h3>
@include('flash') 
<div class="card-body">
   <form action="{{url('print-passport-report')}}" method="POST">
      {{ csrf_field() }}
      <div class="row">
         <div class="col-md-3 col-sm-12 mb-4">
            <label >{{ trans('finicialreports.select_options') }}:</label>
            <div>
               <select id="d_m_y_radio" name="type"  type="input" class="form-control" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required="">
                  <option value=""><span>--{{ trans('finicialreports.select_options') }}--</span></option>
                  <option value="today" {{ session()->get('pass_type') == 'today'?'selected':'' }}>{{ trans('finicialreports.daily') }}</option>
                  <option value="month" {{ session()->get('pass_type') == 'month'?'selected':'' }}>Monthly</option>
                  <option value="year" {{ session()->get('pass_type') == 'year'?'selected':'' }}>Yearly</option>
               </select>
            </div>
         </div>
         <div class="col-md-3 col-sm-12 mb-4">
            <label class="col-auto">{{ trans('finicialreports.from') }} :</label>
            <div class="col-auto">
               <input type="text" class="form-control date" format="dd-mm-yyyy" id="date" name="from" value="{{ session()->get('pass_from') }}" placeholder="Enter From date" required="">
            </div>
         </div>
         <div class="col-md-3 col-sm-12 mb-4">
            <label class="col-auto ">{{ trans('finicialreports.to') }} :</label>
            <div class="col-auto">
               <input type="text" class="form-control date" format="dd-mm-yyyy" id="issue_date" name="to" value="{{ session()->get('pass_to') }}" placeholder="Enter To Date" required="">
            </div>
         </div>
         <div class="col-md-3 col-sm-12 mb-4">
            <label class="col-auto ">{{ trans('common.province') }} :</label>
            <div class="col-auto">
               <select name="province" id="province" class="form-control js-example-basic-single"  aria-expanded="false" required="">
                  <option value="" selected disabled hidden>--Select Province--</option>
                  @foreach($province as $key => $value)
                  <option value="{{$value->province_code}}" {{ session()->get('pass_province') == $value->province_code?'selected':'' }}>{{$value->name}}({{$value->name_en}})</option>
                  @endforeach</option>
               </select>
            </div>
         </div>
         <div class="col-md-3 col-sm-12 mb-4">
            <button type="submit" class="btn btn-primary btn-sm">{{ trans('finicialreports.search') }}</button>
         </div>
      </div>
   </form>
   <br/>
   <hr/>
   <br/>
   <table id="myTable" class="table table-striped">
      <thead>
         <tr>
            <th>{{trans('Passport')}}</th>
            <th>{{ trans('register.license_no')}}</th>
            <th>{{trans('register.engine_no')}}</th>
            <th>{{ trans('register.name')}}</th>
            <th>{{trans('register.book_no_ref')}}</th>
            <th>{{trans('common.date')}}</th>
         </tr>
      </thead>
      <tbody>
         @foreach ($print_passport_report as $item)
         <tr>
            <td>{{$item['pass']}}</td>
            <td>{{$item['license_no']}}</td>
            <td>{{$item['engine_no']}}</td>
            <td>{{$item['name']}}</td>
            <td>{{$item['book_no_ref']}}</td>
            <td>{{Carbon\Carbon::parse($item['created_at'])->format('d-m-Y')}}</td>
         </tr>
         @endforeach
      </tbody>
   </table>
</div>
@endsection
@push('page_scripts')
<script type="text/javascript">
   var base_url = "{{url('print-passport-report')}}";
   $(".delete").on("submit", function(){
   return confirm("Are you sure to delete?");
      });
</script>
@endpush