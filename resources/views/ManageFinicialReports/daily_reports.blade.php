@extends('vrms2.layouts.master')
@section('daily_report','active')
@section('content')
<style>
   .row {
      display: block;
      flex-wrap: wrap;
      margin-right: -100px;
      margin-left: 0px;
   }
</style>

@include('vrms2.mod2-submenu')

<h3>{{trans('finicialreports.manage_daily_reports')}}</h3>
@include('flash')
<div class="card-body">
   <form action="{{url('daily-report')}}" method="POST">
      {{ csrf_field() }}
      <div class="row">
         <div class="form-row">
            <div class="col-md-2">
               <label>{{ trans('finance_title.service_counter') }}:</label>
               <select name="counter_id" class="form-control selectpicker" required="">
                  <option value="normal"><span>--Select Service Counter--</span></option>
                  @foreach(\App\Model\ServiceCounter::CounterList() as $counter)
                  <option value="{{ $counter->id}}" {{ session('counter_id') ==  $counter->id?'selected':'' }}>{{ $counter->name}}.{{ $counter->description}}</option>
                  @endforeach
               </select>
            </div>
          
            <div class="col-md-2">
               <label>{{ trans('finicialreports.from') }} :</label>
               <input type="text" class="form-control custom_date_vehicle" id="from_date" format="dd-mm-yyyy" name="from" value="{{ session()->get('from1') }}" placeholder="Enter From date" required="">
            </div>
            <div class="col-md-2">
               <label>{{ trans('finicialreports.to') }} :</label>
               <input type="text" class="form-control custom_date_vehicle" id="to_date" format="dd-mm-yyyy" name="to" value="{{ session()->get('to1') }}" placeholder="Enter To Date" required="">
            </div>
            <div class="col-md-3">
               <label>{{ trans('finicialreports.select_province') }} :</label>
               <select name="province_code" class="form-control selectpicker" required="">
                  <option value="" selected disabled hidden>--Select Province--</option>
                  @foreach(\App\Model\Province::GetProvince() as $data)
                  <option value="{{$data->province_code}}" {{ session()->get('province_code1') == $data->province_code?'selected':'' }}>{{$data->name}}({{$data->name_en}})</option>
                  @endforeach
               </select>
            </div>
            <div class="col-md-3">
               <label>&nbsp;</label>
               <br>
               <button type="submit" class="btn btn-primary btn-sm" name="type">{{ trans('finicialreports.search') }}</button>
               <button type="submit" class="btn btn-success btn-sm" name="type" value="excel">ExportExcel</button>
               
               <!-- <a class="btn btn-success btn-sm" id="btnExport" onclick="fnExcelReport('DailyReport');">
                  ExportExcel
               </a> -->
            </div>
         </div>
      </div>
   </form>
   <br />
   <hr />
   <br />
   <table id="table" class="table table-striped">
      <thead>
      <tr style="display:none">
            <td colspan="6">ພະແນກ ຍທຂ ນະຄອນຫລວງ</td>
            <td></td>
         </tr>
         <tr style="display:none">
            <td colspan="6">ກອງຄຸ້ມຄອງພາຫານະແລະການຂັບຂີ່ </td>
            <td></td>
         </tr>
         <tr style="display:none">
            <td></td>
            <td></td>
            <td colspan="4">ກອງຄຸ້ມຄອງພາຫານະແລະການຂັບຂີ່ </td>
            <td>ວັນທີ</td>
            <td>15/12/2014</td>
         </tr>
         <tr>
            <th style="display:none">No</th>
            <th>{{trans('finance_title.item_code')}}</th>
            <th>{{trans('finance_title.item_name')}}</th>
            <th  class="excludeExport">{{trans('finance_title.item_name_en')}}</th>
            <th  class="excludeExport">{{trans('finicialreports.price_per_item')}}</th>
            <th>{{trans('finicialreports.total_qty')}}</th>
            <th  class="excludeExport">{{trans('finicialreports.fine_per_item')}}</th>
            <th width="150" style="text-align:center;">{{trans('finicialreports.total')}}</th>
         </tr>
      </thead>
      <tbody>
         
      @foreach ($pricedetail as $key=>$pricedetails)
         <tr>
            <td style="display:none">{{ ++$key }}</td>
            <td>{{$pricedetails -> item_code}}</td>
            <td>{{$pricedetails -> item_name}}</td>
            <td  class="excludeExport">{{$pricedetails -> item_name_en}}</td>
            <td style='text-align:right;'  class="excludeExport">{{number_format($pricedetails -> price, 2, '.', ',')}}</td>
            <td>{{$pricedetails -> total_qty}}</td>
            <td  class="excludeExport">{{$pricedetails -> fine_percent}}%</td>
            <td style='text-align:right;'>{{number_format($pricedetails -> sub_total, 2, '.', ',')}}</td>
         </tr>
         @endforeach
         <tr>
           
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>{{trans('finicialreports.tital_amount')}}</td>
            <td style="text-align:right;">
               @if(isset($pricedetails->sub_total))
               {{number_format($pricedetail->sum('sub_total'), 2, '.', ',')}}
               @else
               {{"0.00"}}
               @endif
            </td>
         </tr>
         <tr>
           
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>{{trans('finicialreports.total_fine_fee')}}</td>
            <td style="text-align:right;">
               @if(isset($fine_percent))
               {{number_format($fine_percent->sum('percentage'), 2, '.', ',')}}
               @else
               {{"0"}}
               @endif
            </td>
         </tr>
         <tr>
          
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>{{trans('finicialreports.sub_total_amt')}}</td>
            <td style="text-align:right;">
               @php
               if(isset($fine_percent)) $sum_fine = $fine_percent->sum('percentage');else $sum_fine = null;
               if(isset($fine_percent))$total = $fine_percent->sum('sub_total');else$total = null;
               if(isset($fine_percent))$sub_total_amt = $total-$sum_fine;else$sub_total_amt = 0;
               @endphp
               {{number_format($sub_total_amt, 2, '.', ',')}}
            </td>
         </tr>
      </tbody>
   </table>
</div>

@endsection
@push('page_scripts')
<script src="{{ asset('vrms2/js/vehicle-datepicker.js') }}"></script>
<script type="text/javascript">
   var base_url = "{{url('/daily-report')}}";
   $(".delete").on("submit", function() {
      return confirm("Are you sure to delete?");
   });
  
</script>
@endpush