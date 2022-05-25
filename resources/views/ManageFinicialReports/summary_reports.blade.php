@extends('vrms2.layouts.master')
@section('summary_report','active')
@section('content')
@include('vrms2.mod2-submenu')
<h3>{{trans('finicialreports.manage_summary_reports')}}</h3>
@include('flash')
<div class="card-body">
   <form action="{{url('summary-report')}}" method="POST">
      {{ csrf_field() }}
      <div class="row">
         <div class="col-md-2">
            <label>{{ trans('finance_title.service_counter') }}:</label>
            <select name="counter_id" class="form-control selectpicker" required="">
               <option ><span>--Select Service Counter--</span></option>
               @foreach(\App\Model\ServiceCounter::CounterList() as $counter)
               <option value="{{ $counter->id}}" {{ session('counter_id') ==  $counter->id?'selected':'' }}>{{ $counter->name}}.{{ $counter->description}}</option>
               @endforeach
            </select>
         </div>
        
         <div class="col-sm-3">
            <div class="form-group">
               <label class="col-auto">{{ trans('finicialreports.from') }} :</label>
               <div class="col-auto">
                  <input type="text" class="form-control custom_date_vehicle" id="from_date" name="from" value="{{ session('from') }}" placeholder="{{ trans('finicialreports.enter_from_date') }}" required="">
               </div>
            </div>
         </div>
         <div class="col-sm-3">
            <div class="form-group">
               <label class="col-auto ">{{ trans('finicialreports.to') }} :</label>
               <div class="col-auto">
                  <input type="text" class="form-control custom_date_vehicle" id="to_date" format="dd-mm-yyyy" name="to" value="{{ session('to') }}" placeholder="{{ trans('finicialreports.enter_to_date') }}" required="">
               </div>
            </div>
         </div>
         <div class="col-sm-3">
            <div class="form-group">
               <label class="col-auto">&nbsp;</label>
               <div class="col-auto">
                  <button type="submit" class="btn btn-primary btn-sm" name="type">{{ trans('finicialreports.search') }}</button>
                  <button type="submit" class="btn btn-success btn-sm" name="type" value="excel"> ExportExcel </button>
               </div>
            </div>
         </div>
      </div>
   </form>
   <br />
   <hr />
   <br />
   <table id="table" class="table table-striped">
      <thead>
         <tr>
            <th style="display:none">ລ/ດ</th>
            <th> ເລກທີ່ບິນ</th>
            <th>ວັນທີ</th>
            <th>ພະນັກງານ</th>
            <th>ອອກຊື່</th>
            <th>ລາຍການ</th>
            <th>ລວມເງຶນ</th>
         </tr>
      </thead>
      <tbody>
         @foreach ($price_list as $key=>$price_lists)
         <tr>
            <td style="display:none">{{ ++$key }}</td>
            <td>{{ $price_lists->ServiceCounter->name ?? ''}}.{{$price_lists -> price_receipt_no}}</td>
            <td>{{ $price_lists -> date }}</td>
            <td>@if(isset($price_lists -> users_payee))<span>{{$price_lists -> users_payee -> first_name}} {{$price_lists -> users_payee -> last_name}}</span>@else{{"_"}}@endif</td>
            <td>{{$price_lists -> user_payer ?? '' }}</td>
            <td>
               @foreach($price_lists-> PriceListDetails as $value)
               {{$value -> item_code}}({{number_format($value -> sub_total)}}),
               @endforeach
            </td>
            <td>{{ number_format($price_lists->total_amt)}}</td>
         </tr>
         @endforeach
      </tbody>
   </table>
</div>

@endsection
@push('page_scripts')

<script src="{{ asset('vrms2/js/vehicle-datepicker.js') }}"></script>
<script type="text/javascript">
   var base_url = "{{url('summary-report')}}";

   $(".delete").on("submit", function() {
      return confirm("Are you sure to delete?");
   });
</script>
@endpush