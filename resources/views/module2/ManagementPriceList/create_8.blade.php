@extends('vrms2.layouts.master')
@section('price_list_main', 'active')
@section('content')
@php
$currency = \App\Model\MoneyUnit::whereStatus(1)->first();
@endphp
<style>
@media print {

@page {size:794px 525px; margin: 10px 0px 5px 0px;}
#print-paper input{
  font-size: 18px;
}

} 
   @font-face {
        font-family:'Saysettha OT';
        src: url('/fonts/saysettha_ot.ttf') format('ttf');
    }
    
    @media screen {
        #print-paper { display: none;  }
        
        }
      /* #print-paper input,#printList  input{
        background-color: rgba(0,0,0,0);
        color: #000;
        border: none;
      }  */
      #print-paper input{
        background-color: rgba(0,0,0,0);
        color: #000;
        border: none;
      }

      .price{
        background-color: rgba(0,0,0,0);
        color: #000;
        border: none;
        text-align: right;
      }

      .sub_total{
        background-color: rgba(0,0,0,0);
        color: #000;
        border: none;
        text-align: right;
      }
      
      #print-paper .col-md-12 {
           width: 100%;
      }

      #print-paper .col-md-11 {
           width: 91.66666666666666%;
      }

      #print-paper .col-md-10 {
           width: 83.33333333333334%;
      }

      #print-paper .col-md-9 {
            width: 75%;
      }

      #print-paper .col-md-8 {
            width: 66.66666666666666%;
      }

      #print-paper .col-md-7 {
            width: 58.333333333333336%;
       }

       #print-paper .col-md-6 {
            width: 50%;
       }

       #print-paper .col-md-5 {
            width: 41.66666666666667%;
       }

       #print-paper .col-md-4 {
            width: 33.33333333333333%;
       }

       #print-paper .col-md-3 {
            width: 22%;
       }

       #print-paper .col-md-2 {
            width: 16.666666666666664%;
       }

       #print-paper .col-md-1 {
            width: 8.333333333333332%;
        } 
        #print-paper .text-center{
         text-align: center;
      }
      #print-paper  .mb-1{
         margin-bottom: 0.25rem;
      }
     
      .ui-widget.ui-widget-content{
        border: 1px solid #0c3a7e;
      }
    * {
      -webkit-print-color-adjust: exact !important;   /* Chrome, Safari */
      color-adjust: exact !important;                 /*Firefox*/
      }
      #confirm
      {
        background-color: #ddd;
        display: none;
        border: 1px solid rgba(0,0,0,.2);
        position: fixed;
        top: 120px;
        width: 350px;
        left: 50%;
        margin-left: -100px;
        padding: 16px 8px;
        box-sizing: border-box;
        text-align: center;
        border-radius: 0.3rem;
      }
      #confirm button {
        display: inline-block;
        border-radius: 5px;
        border: 1px solid #aaa;
        padding: 5px;
        text-align: center;
        width: 100px;
        cursor: pointer;
      }
</style>
@include('flash')
@php
  $counter_bill = \App\Helpers\Helper::bNo($scounters[0]['service_counter_id']);
  $payment_date = \App\Model\PriceList::getLastDate($scounters[0]['service_counter_id']);
  $assign_counter = \App\Model\CounterMatching::whereStaffIdAndProvinceCode(auth()->id(),  \App\Helpers\Helper::current_province())->pluck('service_counter_id')->toArray();
@endphp

      <div class="card-body" id="pricelist">
      <div class="row">
      <div class="col-md-7">
        <div class="row mb-2">
          <div class="col-md-12 form-inline">
          <label class="mr-sm-2"><span style="font-size: 2rem;font-weight: 600;">{{trans('finance_title.create_new_pri_list')}}</span>&nbsp;  ຄົ້ນຫາບິນດ້ວຍລະຫັດ / ບາໂຄດ</label>
            <form class="col-md-4 col-sm-4 form-inline" action="{{ route('price-list.create') }}" id="searchForm" method="GET" class="searchForm" >
                <input type="text"  name="app_no" value="{{  $app_form->app_no ?? ''}}" placeholder="Type App No"  class="form-control col-md-7 col-sm-7 AppNo" autofocus required> 
                <input type="hidden" id="active_counter" name="active_counter" value="{{ isset($active_counter)? $active_counter->id: $scounters[0]['service_counter_id'] }}">
                <input type="hidden" id="active_bill" name="active_bill" value="{{ isset($active_bill)? $active_bill: $counter_bill}}">
                <input type="submit" class="{{$disableButton&& $disableButton_app?'btn-save btn-sm ml-2 search disabled':'btn-save btn-sm ml-2 search'}}" value="{{ trans('button.search')}}" id="price-list-search" style="background-color:blue;color:#fff">
            </form>
          </div>
        </div>
          <div class="row" style="margin-bottom:20px;">
          <!--counter list start -->
            <div class="col-md-8 user_counter">
              @foreach($scounters as $key=>$value)
              <button href="#" class="btn btn-secondary btn-sm btn-counter @isset($active_counter->id) {{ $active_counter->id == $value->service_counter_id?'active-counter':''}} @else {{$scounters[0]['service_counter_id'] ==  $value->service_counter_id?'active-counter':''}}  @endisset"
              data-id="{{ $value->service_counter_id }}" id="btn_counter{{$value->service_counter_id}}" onclick="clickBtn(this)" > 
              {{ $value->service_counter->description ?? ''}} 
              </button>
              @endforeach 

            </div>
            <div class="col-md-4">
              ອອກທີ່: {{auth()->user()->department->name ?? ''}}<br/>
              <!-- ປ່ອງບໍລິການ: <span id="counter_name">{{ $scounters[0]->service_counter->name ?? ''}}</span> -->
            </div>
          <!-- counter list end-->
          
          </div>
      <div class="form-group row mb-1">
          <div class="col-md-3">{{auth()->user()->department->name ?? ''}}_<span class="current_counter_name">{{ isset($active_counter)? $active_counter->name: $scounters[0]->service_counter->name }}</span></div>
          <div class="col-md-9">
            <input type="text" class="mb-1 mr-sm-1  col-md-3 col-sm-3 price_receipt_no"  value="{{ isset($active_bill)? $active_bill: $counter_bill}}" readonly>
            <a class="btn-save btn-sm mr-sm-4 text-black  {{$disableButton && $disableButton_app ?'disabled':''}}" id="saveRecord"><span style="margin-left: 20px; color: #000">{{ trans('button.save') }}</span></a>
          </div> 
      </div>
<!-- end first row -->

    <!-- end second row -->
        <form  id="price-list" action="" method="POST"> 
          {{ csrf_field() }}
          <div class="form-inline">
           <a class="mr-sm-2 ml-2" id="previous_btn"><<</a>&nbsp;ເລກທີ&nbsp;<span class="current_counter_name">{{ isset($active_counter)? $active_counter->name: $scounters[0]->service_counter->name }}</span>.<span id="current_bill">{{ isset($active_bill)? $active_bill: $counter_bill}}</span><a id="next_btn" class="mr-sm-2 ml-2">>></a>
           
          </div>
          <!-- start third row -->
          <input type="hidden" class="reciept_status" name="reciept_status" value="pending">
          <div class="form-inline mt-3">
            <label class="mb-2 mr-sm-2 " for="">ຊື່:</label>
            <input type="text" class="form-control col-md-4 col-sm-4"  placeholder=""  id="customer_name" name="user_payer" value="{{$app_form->customer_name ?? ''}}" >
            <label class="mb-2 mr-sm-2 ml-sm-2" for="">{{ trans('common.date') }}:</label>
            <input  class="form-control col-md-2 col-sm-2 price_date" id="print_date"  value="{{ isset($active_payment_date)? $active_payment_date: $payment_date }}" placeholder="Date" name="date" required="">
            <label class="mb-2 mr-sm-3 ml-sm-3" for="">{{ trans('common.status') }}:</label>  
            <input type="text" class="mb-1 mr-sm-1 col-md-3 col-sm-3 border-0 reciept_status" name="reciept_status"  value="pending" readonly>
          </div>
         
          <input type="hidden" value="{{ isset($active_bill)? $active_bill: $counter_bill}}" name="price_receipt_no"  id="autoBill">
            <input type="hidden"  value="{{ $app_form->vehicle->vehicle_kind_code ?? ''}}" id="vehicle_kind">
            <input type="hidden" name="price_list_id" id="price_list_id" value="">
            <input type="hidden" name="user_payee"  value="{{ auth()->id() }}">
            <input type="hidden" name="updated_by"  value="{{ auth()->id() }}">
            <input type="hidden" id="saveBill" value="">
            <input type="hidden" name="app_form_id" class="form-control app_form_id" value="{{ $app_form->id ?? ''}}">
          <!-- end third row -->
          <!-- start fourth row -->
          <div class="form-inline mt-1" style="padding-left: 40px;">
            <input type="hidden" class="form-control mb-1 mr-sm-1" name="service_counter_id" id="service_counter_id" placeholder="" value="{{ isset($active_counter)? $active_counter->id: $scounters[0]['service_counter_id'] }}">
            <span class="mr-1">CC:</span>  
            <input type="text"  name="cc" class="form-control col-md-3 col-sm-3" style="margin-left: 0px !important;" id="cc" value="{{$app_form->vehicle->cc ?? ''}}"  placeholder="Enter CC">
            <label class="mb-2 mr-sm-2 ml-sm-2" for="">RoadTax:</label>  
            <input type="text"  name="road_tax" class="form-control col-md-2 col-sm-2" id="roadTax" value=""  placeholder="Enter RoadTax">
          </div>
          <!-- end third row -->
          <!-- start item table -->
          <div class="row  table-responsive mt-4 px-3" style="min-height:300px;">
            <div class="col-md-12 scrollTable" >
              <table class="table  table-bordered" id="pList" style="table-layout:fixed;">
                <thead>
                  <tr>
                  <th width="50">{{trans('finance_title.code')}}</th>  
                  <th width="250">ລາຍການ</th>
                  <th width="50">ຈຳນວນ</th>
                  <th width="100">ລາຄາຫນ່ວຍ</th>
                  <th width="100">ລວມ</th>
                  <th width="50"></th>
                  </tr>
                </thead>
                <tbody>   
                @if(isset($price_item_unit))
                  @for($i =0;$i<count($price_item_unit);$i++)
                    <tr>
                      <td><input type="text" id="item-code-{{$i}}" class="border-0 item_code" name="item_code[]" value="{{ $price_item_unit[$i]->price_item['code'] ?? '' }}" readonly ></td>
                      <td>
                        <input type="text" id="item-{{$i}}" class="border-0 price_item_name" name="item_name[]"  value="{{ $price_item_unit[$i]->price_item['name'] ?? ''}}" readonly>
                        <input type="hidden"  id="item-name-en-{{$i}}" class="border-0 price_item_name_en" name="item_name_en[]"  value="{{ $price_item_unit[$i]->price_item['name_en'] ?? ''}}">
                        <input type="hidden"  id="itemId-{{$i}}" class=" border-0 itemid" name="price_item_id[]"  value="{{ $price_item_unit[$i]->price_item['id'] ?? ''}}">
                      </td>
                      <td><input type="text" id="qty-{{$i}}" name="quantity[]" class="form-control qty" value="1">
                      <input type="hidden" id="fine_percent-{{$i}}" name="fine_percent[]" class="form-control fine_percent" value="{{ $price_item_unit[$i]['fine_percent'] ?? ''}}" ></td>
                      <td><input type="text" id="price-{{$i}}" class="border-0 price" name="unit_price[]" value="{{ number_format($price_item_unit[$i]['unit_price']) ?? ''}}"  readonly></td>
                      
                      <td> <input type="text" id="sub_total-{{$i}}" class="border-0 sub_total" name="sub_total[]"  value="{{ number_format(\App\Model\PriceList::subTotal($price_item_unit[$i]['unit_price'], $price_item_unit[$i]['fine_percent'])) }}" readonly></td>
                      <td><a title="delete" href="javascript:void(0);" class="remove" style="color:#000" id="remove">ລບລ້າງ</a></td>
                    </tr>
                  @endfor
                @endif
                </tbody>
              </table>
              </div>
            </div>
      <!-- end item table -->
     
          <!-- start six row -->
          <div class="form-inline mt-3" style="border-top:1px solid #dee2e6">
            <input type="text" class="form-control col-md-2 col-sm-2" id="icode" name="code" value="" placeholder="Enter Code">      
            <label class="mb-2 mr-sm-4 ml-sm-3" for=""> ພະນັກງານ: <span class="updated_by">{{ auth()->user()->name ?? ''}} </span></label>
              <input type="hidden" id="after-save" value="0">
              <label class="col-md-4">&nbsp;</label>
              <label class="my-2 mr-sm-4 col-md-3 px-0" for="">ລວມຍອດ:&nbsp; <input type="text" class="form-control border-0" id="total_amt" style="width:100px;margin-right: 15px;" name="total_amt" placeholder="" value="{{ $total_amt ?? ''}}" readonly>&nbsp; <span style="font-size:16px;">{{ $currency->name_en }}</span><input type="hidden" name="money_unit_id" value="{{ $currency->id }}"></label>
            
          </div>
          <!-- end six row -->
          <!-- start seven row -->
          <label class="mb-2 mr-sm-2" for="">{{ trans('module4.license_no')}}:</label>
          <div class="form-inline">
              <input type="text" class="form-control mb-1 mr-sm-1 col-md-10 col-sm-10" name="license" id="license"  maxlength="7"  value="{{ $book_no ?? ''}}"  placeholder="Enter license no">   
              <a tabindex="0"  class=" btn btn-success btn-sm mb-1 lic_booking " id="check-lic-booking">{{ trans('finance_title.check')}}</a>
          </div>
          <!-- end seven row -->
          <!-- start eigth row -->
          <div class="form-inline mt-3">
            <a  class="btn-save btn-sm  mr-sm-3 new-bill"><span style="margin-left: 20px; color: #000"> {{ trans('finance_title.new_bill') }}</span></a>
            @can('PriceList-Entry-Print')<a class="mr-sm-4 printBtn {{$disableButton && $disableButton_app ?'disabled':''}}" id="price-list-print"><span style="margin-left: 20px; color: #000">{{ trans('button.print') }}</span></a> @endcan 
            <a href="" class="btn-sm  mr-sm-1 cancel-bill disabled" id="price-cancel-bill" style="margin-left: 150px;border:1px solid #ddd">{{ trans('finance_title.cancel_bill') }}</a>
          </div>
          <!-- end eight row -->
          <!-- start seven row -->
          <div class="mt-3"> 
          <p style="color: green">ພິມບິນແລ້ວແປງບໍ່ໄດ້, ຖ້າພິມບິນຜິດ ກົດ "ອອກບິນຜິດ" ແລ້ວໃຫ້ ເລີ່ມບິນໃໝ່ ບິນໝາຍຜິດຈະບໍ່ເຂົ້າໃນລາຍງານ</p>
              <label class="mb-2 mr-sm-2" for="">ໝາຍເຫດ (ບໍ່ອອກໃນບິນໃຊ້ໄວ້ໝາຍກວດສອບ):</label><br/>
            <input type="text" class="form-control mb-1 mr-sm-1 " name="note" id="note" placeholder="Enter Note">   
          </div>
          <!-- for translation -->
          <input type="hidden" id="save_first" title="{{ trans('finance_title.save_first') }}">
          <input type="hidden" id="enter_lic" title="{{ trans('finance_title.enter_lic') }}">
          <input type="hidden" id="at_least_item" title="{{ trans('finance_title.at_least_item') }}">
          <input type="hidden" id="success_lic_book" title="{{ trans('finance_title.success_lic_booking') }}">
          <input type="hidden" id="select_date" title="{{ trans('finance_title.select_date') }}">
          <input type="hidden" id="item_code_duplicate" title="{{ trans('finance_title.item_code_duplicate') }}">
          <input type="hidden" id="alphabet_not_exist" title="{{ trans('finance_title.alphabet_not_exist') }}">
          <input type="hidden" id="unable_to_book" title="{{ trans('finance_title.unable_to_book') }}">
          <input type="hidden" id="unable_next_character" title="{{ trans('finance_title.unable_next_character') }}">
          <input type="hidden" id="ending_27_67" title="{{ trans('finance_title.ending_27_67') }}">

        </form> 
      </div>
    <!-- end price list form -->
      <!-- price item table  -->
      <div class="col-md-5 price-item-table" style="top:80px;">
      <ul class="nav nav-tabs pt-2" style="width: 104%">
          <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" aria-current="page" href="#FeeList">ລາຍການຄ່າທໍານຽມຕ່າງໆ</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#ReceiptList">ລາຍການໃບຮັບ</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#SummarizeList">ສະຫຼຸບຄ່າທໍານຽມຕ່າງໆ</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#SearchLicense">ຄົ້ນຫາທະບຽນ</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#SearchDriver">ຄົ້ນຫາຂັບຂີ່</a>
          </li>
        </ul>

        <div class="tab-content clearfix">
          <div class="tab-pane active" id="FeeList">
              @include('module2.ManagementPriceList.price-item-list', ['item_list'=> $item_list])
          </div>

          <div class="tab-pane" id="ReceiptList">
            @include('module2.ManagementPriceList.receipt-list')
          </div>
          <div class="tab-pane" id="SummarizeList">
            @include('module2.ManagementPriceList.summarized-list')
          </div>
          <div class="tab-pane" id="SearchLicense">
          <h5>Search license</h5>
          </div>  
          <div class="tab-pane" id="SearchDriver">
              @include('module2.ManagementPriceList.search-driver-list')
          </div>      
          

        </div>
      </div>
      <!-- end price item table -->
  </div>
</div>
<!-- confirm box for print save -->
<div id="confirm">
  <div class="print_message mb-2"></div>
  <button class="no">{{ trans('finance_title.print_no') }}</button>
  <button class="yes">{{ trans('finance_title.print_yes') }}</button>
</div>
<!-- start print page -->
<div id="print-paper" style="border:1px solid #000;width:1050px;height: 680px" >
<div  class="row">
      <!-- first row -->
      <div class="row" style="height: 100px; width:100%;">&nbsp;</div>
        <!-- second row -->
      <div class="row" style="height: 25px;width:100%;border:1px solid #000">
        <div style="width: 200px;">&nbsp;</div>
        <div style="width: 150px;">
          <div id="printBill" style="text-align: right;"> <input type="text" class="form-control mb-1 mr-sm-1 border-0 font-weight-bold"   placeholder=""  name="print_price_receipt_no" value=""> </div>
          
        </div>
        <div style="width: 38px;">&nbsp;</div>
        <div style="width: 170px;">
          <div id="printDate"> <input type="text" class="form-control border-0 font-weight-bold" id="issue_date" value="" name="date"></div>
        </div>
        <div style="width: 57px;">&nbsp;</div>
        <div style="width: 113px;">
          <div id="printAppNo" style="text-align:right;"> <input type="text"  name="app_no" value=""  class="form-control border-0 font-weight-bold " style="font-family:'Saysettha OT' !important;"> </div>
      
        </div>
        <div style="width: 40px;">&nbsp;</div>
        <div style="width: 200px;">
          <div id="printAppDate" style="text-align:right;"> <input type="text" id="print_app_date"  name="ref_date" value=""  class="price-print-date form-control border-0 font-weight-bold "> </div>
          
        </div>
      </div>
        <!-- third row -->
      <div class="row" style="height:40px;width: 100%; ">&nbsp;</div>
        <!-- fourth row -->
      <div class="row" style="height:30px;">
        <div style="width: 144px">&nbsp;</div>
          <div style="width: 377px;">
          <span id="printCustomer"> <input type="text" class="form-control border-0 font-weight-bold" id="" placeholder="" name="print_user_payer" value="" style="font-family:'Saysettha OT' !important"> </span>
          </div>
      </div>
       <!-- firth row -->
       <div class="row" style="height:70px;width: 100%;">&nbsp;</div>
        <!-- six row -->
        <div class="row" style="height:330px; width: 100%; ">
          <div id="printList">
            <div style="width: 57px">&nbsp;</div>
            <div style="width: 38px;">
            
            </div>
            <div style="width: 333px;">
            
            </div>
            <div style="width: 53px;">
            
            </div>
            <div style="width: 106px;">
            
            </div>
            <div style="width: 189px;">
            
            </div>
          </div>
      </div>
      <!-- seven row -->
      <div class="row" style="height:20px;width: 100%;">&nbsp;</div>
      <!-- eight row -->
      <div class="row" style="height: 30px;background:red"> 
      <div style="width:250px;text-align:center;"></div>
        <div style="width:200px;text-align:center;"><span style="font-size: 18px;font-family:'Saysettha OT' !important" class="updated_by"></span></div>
        <div style="width: 450px;">&nbsp;</div>
        <div style="width:150px;padding-right: initial;padding-bottom: 20px;"> <div id="printTotal"> <input type="text" class="form-control border-0" id="total_amt" name="total_amt" placeholder="" value="{{ $total_amt ?? ''}}" style="text-align: right;"> </div></div>
        <div  style="width:20px;font-size: 16px;padding-top: 6px;">{{"ກີບ"}}</div>
    </div>
  </div>
 
</div>

 <!-- end print page -->

@include('module2.ManagementPriceList.BookingModal')
@if(session('code')) 
<script src="{{ asset('vrms2/js/jquery.min.js') }}"></script>
<script>
  $(function() {
    $('#priceList').modal('show');
  });
</script>
@endif

<div id="priceList" class="modal custom-modal fade"  role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title">Please Select Bill Number</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       
      </div><!-- end modal-header -->
      <div class="modal-body">
        <table id="order-listing" class="table table-bordered">
            <tr>
                <th>App Request Number</th>
                <th>Bill Number</th>
                <th>Status</th>
                <th width="140">Action</th>
            </tr>
            @if(is_countable(session('price_list'))> 0)
              @foreach(session('price_list') as $data)
              <tr>
                <td> {{ $data->appForm->app_no ?? '' }}</td>
                <td >{{ $data->ServiceCounter->name??''}}.{{ $data->price_receipt_no }}</td>
                <td>  {{ $data->reciept_status }}</td>
                <td> 
                  <a href="" class="btn btn-success pricelist-select btn-sm" data-id="{{ $data->id }}" data-reciept-status="{{ $data->reciept_status }}" id="select-price-list">Select</a>
                  @if( $data->reciept_status == "cancel bill")<a href="" class="btn btn-secondary new_bill_from_select btn-sm" data-id="{{ $data->id }}" >New Bill</a>@endif
                </td>
              </tr>
              @endforeach
            @endif
        </table>
      </div><!-- end modal-bpdy -->
    </div><!-- end modal-content -->
  </div><!-- end modal-dialog -->
</div><!-- end edit-profile -->
</div>
@endsection
@push('page_scripts')

<script src="{{asset('vrms2/js/jquery_print.js')}}"></script>
<script>
  //redirect page if url have query string when page refresh
    var type  = window.performance.getEntriesByType("navigation")[0].type;
    if (type == 'reload'){
      window.location.replace("/price-list/create");
    }
  //   $('.AppNo').keyup(function(event) {
  //     event.preventDefault();
  //     var app_number = $(this).val();
  //     if (event.keyCode == 13) {
  //       $("#searchForm").submit();
  //   }
  // });

  var delete_detail = "{{ url('/delete-price-detail/') }}";
  var assignCounter =  {!! json_encode($assign_counter) !!};
 
 
  //sorting item code for pricelist create form
 
  $(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
    var $tbody = $('#pList tbody');
      $tbody.find('tr').sort(function (x, y) {
          var rowx = $(x).find("td:eq(0) input[type='text']").val();
        
          var rowy = $(y).find("td:eq(0)  input[type='text']").val();
          // if a < b return 1
          return rowx > rowy ? 1
                
                  : rowx < rowy ? -1
                
                  : 0;
      }).appendTo($tbody);
  });
 
  //alert when qty is null
  function checkQty(){
    var totalQty = [];
    $('#pList > tbody  > tr').each(function() {
      totalQty.push($(this).find('.qty').val());
    });
    if (totalQty.includes("") == true) {
      return false;
    } else{
      return true;
    } 
  }
  function checkItem(){
    if($('#pList >tbody tr').length <= 0){
        return false;
    }
    return true
  }
  function checkName(){
    if($('#customer_name').val() == ''){
        return false;
    } 
    return true
  }
  function checkDate(){
    if($("#print_date").val() == ''){
      return false;
    }
    return true
  }

    //saveRecord
    $('#saveRecord').click(function (e) {
      e.preventDefault();
      if(checkName() == false){
        alert('ກະລຸນາປ້ອນຊື່');
        return false;
      } 
      if(checkDate() == false){
        alert($('#select_date').attr('title'));
        return false;
      }
      if(checkItem() == false){
        alert($('#at_least_item').attr('title'));
        return false;
      }
     
      if(checkQty() == false){
        alert('ກະລຸນາປ້ອນຈໍານວນ');
        return false;
      }
      
      if(checkDuplicateItem() == true){
        updateQty();
        $.ajax({
            url: "{{route('price-list.store')}}",
            method: "POST",
            data: $('#price-list').serialize(),
            type: 'json',
            success:function(data) {
            //  console.log(data);
              if(data.status == "success"){
                $('.reciept_status').val('save');
                $("#price_list_id").val(data.id);
                $("#after-save").val(1);
                if($('.reciept_status').val() == "pending"){
                  $("#check-lic-booking").addClass('disabled');
                }
                $(".AppNo").focus();
                alert(data.msg);
              }else{
                alert(data.msg);
                
              }
          }

        });
      }     

    });

    function checkDuplicateItem()
    {
      var result = true;
      var arrfilenames = [];
      var arrlength = $(".item_code").length;
      var s = 0;     
      var arrfilenames = new Array();
      for (var i = 0, j = arrlength; i<j; i++)
      {    
        code = $(".item_code");
        arrfilenames[s]= code[i].value;
        s++;
      }
      
      for(var m = 0; m < arrfilenames.length; m++)
      {
        for( var l = m +1; l<arrfilenames.length; l++) 
          {
            if(arrfilenames[m] != ""){
              if (arrfilenames[m] == arrfilenames[l]){
                alert($('#item_code_duplicate').attr('title'));
                return result = false;
              }
            }
          }
      }
      return result;
    }
 

// click counter number button action
function clickBtn(btn){
  var id = $(btn).data("id");
  clearValue();
  $.get("/get-bill-no?id=" + id, function(response) {
  $(".current_counter_name").text(response.counter_name);
  $(".price_receipt_no, #autoBill, #active_bill").val(response.bill_no);
  $('#current_bill').text(response.bill_no);
  $(".price_date").val(response.payment_date);
  $("#service_counter_id, #active_counter").val(id);
  $(".user_counter button:not(#btn_counter"+id+ ")").attr('disabled', false).removeClass('active-counter');
  $(".user_counter #btn_counter"+id).attr('disabled', true).addClass('active-counter');
  $(".reciept_status").val('pending');
  $(".AppNo").focus();
  });

}
 //validate just type only number and hypen key
 $('#license').on('keyup', function(e) {
   $(this).val($(this).val().replace(/[!@\/\\#+()$~%^&,`.'";|\[\]:*?<>{}=_-]/g,''));
  }); 
 
 function clearValue()
 {
    $("#customer_name, #total_amt, #cc, #roadTax, #note, #license, .price_date, #price_list_id,.AppNo, #vehicle_kind, .app_form_id").val('');
    $("#pList >tbody > tr").remove();
    $("#icode,.remove-detail, #saveRecord, .lic_booking").removeClass('disabled');
 }
</script>

<script>
  
  $(document).ready(function(){
          setInterval(function() {
              myFunction();             
          }, 7000);
      });  

  function myFunction() {      
      var item_code = $("input[name='item_code[]']").map(function(){return $(this).val();}).get();
      var item_name = $("input[name='item_name[]']").map(function(){return $(this).val();}).get();
      var item_price = $("input[name='unit_price[]']").map(function(){return $(this).val();}).get();
      var payer = $("input[name='user_payer']").val();
      var counter_id = $(".active-counter").data('id');
      //console.log(jQuery.isEmptyObject(item_code));
    if(jQuery.isEmptyObject(item_code)){
        return false;
    }else{
        $.ajax({
        type: "POST",
        data: {item_code, item_name, item_price, payer, counter_id},
        url: "{{route('priceListDisplay.store')}}",
        success: function(msg){
          //console.log(msg);
          //$('.answer').html(msg);
        }
      });
    }

  }
  


</script>

<script type="text/javascript" src="{{asset('vrms2/js/priceList.js')}}"></script>
<script>
  // code click and add row

  $('#icode').keyup(function(event) {   
    //updateQtyOne();
    var itemCode = [];
    $('#pList > tbody  > tr').each(function() {
      itemCode.push($(this).find('.item_code').val());
    });
  
    if(event.keyCode == 13){
      var tblbody   = $("#pList > tbody"); //Input boxes wrapper ID
      var len = $("#pList > tbody > tr").length; //initlal tr count
      var FCount= len+1; //to keep track of text box added
      //alert("pressed enter key");
      var code = this.value;
      if(!itemCode.includes(code)){
          $.ajax({
          url: '/get-price-item',
          dataType: "json",
          data: {
              code : code
          },
          success: function(data) {  
          
              if(data.result != "not-found"){
                $(tblbody).append(
                '<tr>'+
                '<td><input type="text" id="item-code-'+FCount+'" class="item_code" name="item_code[]" value="'+data.item+'"  class="form-control item" readonly></td>'+
                '<td><input type="text" class="border-0 price_item_name" name="item_name[]"  required id="item-'+FCount+'" value="'+data.name+'" readonly>'+
                '<input type="hidden" id="itemId-'+FCount+'" value="'+data.price_item_id+'"  class="itemid" name="price_item_id[]">'+
                '<input type="hidden" id="item-name-en-'+FCount+'" class="item-name-en" value="'+data.name_en+'" name="item_name_en[]"></td>'+
                '<td><input type="number" name="quantity[]" id="qty-'+FCount+'" value="1" class="form-control qty" required>'+
                '<input type="hidden" name="fine_percent[]" id="fine_percent-'+FCount+'" value="'+data.fine_percent+'" class="form-control fine_percent"></td>'+
                '<td><input type="text" name="unit_price[]" id="price-'+FCount+'" value="'+thousands_separator(data.price)+'" class="price border-0" required="required" readonly></td>'+
                '<td><input type="text" class="sub_total border-0"  value="'+thousands_separator(data.price)+'" name="sub_total[]" id="sub_total-'+FCount+'" readonly></td>'+
                '<td><a title="delete" href="javascript:void(0);" class="remove" style="color:#000">ລບລ້າງ</a></td>'+
                '</tr>');
                len++; //text box increment
                FCount++;         
                updateQty();
                $("#icode").val('');
              }  
              $("#icode").val('');     
              return false;
          }       
        });
      }else {
        alert($('#item_code_duplicate').attr('title'));
        $("#icode").val('');     
        return false;
      }
    }else{
        return false;
    }       
       
  });
</script>



@endpush

