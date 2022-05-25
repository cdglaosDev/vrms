@extends('layouts.master')
@section('finance','active')
@section('title','Create New Price List')
@section('content') 

<h1 class="page-header">{{trans('finance_title.create_new_pri_list')}}</h1>
    <div class="card">
      @include('flash')
      <div class="card-body" id="price-item">
     
        <div class="form-inline pb-3">
        <form action="{{ route('price-list.create') }}" method="GET" class="form-horizontal" >
       
						<input type="text"  name="app_no" value="{{  $app_form->app_no ?? ''}}" placeholder="Type App No" class="form-control"  required> 
				  	<input type="submit" class="btn btn-primary btn-save btn-sm mb-2 mr-sm-2 search" value="Search">
      </form>
      <input type="submit" class="btn btn-primary btn-save btn-sm mb-2 mr-sm-2" value="New Bill">
      
        <div class="row">
        <div class="col-md-6">
        <label  for="">Customer Name:</label>
          <input type="text" class="form-control" id="" placeholder="" name="customer" value="{{ $app_form->customer_name ?? ''}}" readonly>
        
        </div>
         <div class="col-md-6">
         <label  for="">Date:</label>
          <input type="text" class="datetime form-control" id="datetime" value="{{date('Y-m-d')}}" placeholder="Date" name="date" required="">
      
         </div>
         </div>
          </div>
          <form  id="storePricelist" action="{{route('price-list.store')}}" method="POST"> 
        @csrf
        <input type="hidden" name="user_payer" name="customer_id" value="{{ $app_form->customer_id ?? ''}}">
         <input type="hidden" name="app_form_id" class="form-control" value="{{ $app_form->id ?? ''}}">
         <input type="hidden" class="datetime form-control" id="datetime" value="{{date('Y-m-d')}}" placeholder="Date" name="date" required="">
        <div class="form-inline pb-3">
          <a class="page-link mb-2 mr-sm-2" href="#"><i class="mdi mdi-chevron-left"></i></a>
          <label class="mb-2 mr-sm-2" for="">Bill Number:</label>
          <input type="text" class="form-control mb-1 mr-sm-1" id="" readonly placeholder="" name="price_list_no" value="">
          <a class="page-link mb-2 mr-sm-3" href="#"><i class="mdi mdi-chevron-right"></i></a>         
          <label class="mb-2 mr-sm-1" for="">Status:</label>
          <label class="mb-2 mr-sm-4" for="" style="color:rgb(102, 228, 102)">Print</label>
          <label class="mb-2 mr-sm-1" for="">Place of Bill:</label>
          <input type="text" class="form-control mb-1 mr-sm-1" id="" name="service_counter" placeholder="" value="{{$service_counter->service_counter['name'] ?? '' }}" readonly>
          <input type="hidden" class="form-control mb-1 mr-sm-1" name="service_counter_id" id="" placeholder="" value="{{$service_counter['service_counter_id'] ?? ''}}">
        </div>

          <div class="table-responsive" id="pList">
          <table id="myTable" class="table table-bordered" >
              <thead>
                <tr>
                  <th width="20"></th>
                  <th width="50">Code</th>  
                  <th width="100">Name</th>
                  <th width="50">Unit</th>
                  <th width="50">Price</th>
                  <th width="50">Total Price</th>
                  <th width="20">Action</th>
                </tr>
              </thead>
              <tbody>   
          @if(isset($price_item_unit))
         @foreach($price_item_unit as $data)
       
          <tr>
          <td></td>
           <td><input type="text" class="border-0" name="item_code[]" value="{{ $data->price_item->code ?? ''}}"></td>
           <td>
             <input type="text" class="border-0" name="item_name[]"  value="{{ $data->price_item->name ?? ''}}">
             <input type="hidden" class="border-0" name="item_name_en[]"  value="{{ $data->price_item->name_en ?? ''}}">
             <input type="hidden" class="border-0" name="price_item_id[]"  value="{{ $data->price_item->id ?? ''}}">
          </td>
           <td><input type="text" name="quantity[]" class="form-control qty" value="1" ></td>
           <td><input type="text" class="border-0 price" name="unit_price[]" value="{{ $data->unit_price ?? ''}}"></td>
           <td><input type="text" class="border-0 sub_total" name="sub_total[]"  value="{{ $data->unit_price ?? ''}}" readonly></td>
            <td><a href="" class="btn btn-danger btn-sm">Delete</a></td>
          </tr>
         @endforeach
          @endif
              </tbody>
          </table>
        </div>
       
        <div class="form-inline">
          <label class="mb-2 mr-sm-2" for="">License Number:</label>
          <input type="text" class="form-control mb-1 mr-sm-1" id="" placeholder="">      
          <input type="submit" class="btn btn-success btn-sm mb-2 mr-sm-4" value="Booking">
          <label class="mb-2 mr-sm-4 col-md-3" for="">Total: <input type="text" class="border-0" value=" {{ $total_amt ?? ''}}" name="total_amt"></label>
         
          <label class="mb-2 mr-sm-4 col-md-1" for="">Kip</label>
        </div>

        <div class="form-inline"> 
          <a href="" class="btn btn-secondary btn-sm mb-2 mr-sm-1">Back</a>    
          <a href="" class="btn btn-secondary btn-sm mb-2 mr-sm-1">Reprint</a> 
          <a href="" class="btn btn-info btn-sm mb-2 mr-sm-4">Print</a>  
          <input type="submit" class="btn btn-primary btn-save btn-sm mb-2 mr-sm-4 " id="Save" value="Save">
          <label class="mb-2 mr-sm-5 col-md-4" for=""></label>
          <input type="submit" class="btn btn-danger btn-sm mb-2 mr-sm-1" value="Cancel Bill">
        </div>
      </form> 
      </div>
</div>

    

@if(session('code')) 

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
                <th>Action</th>
            </tr>
            @if(0<>count(session('price_list')))
              @foreach(session('price_list') as $data)
              <tr>
                <td> {{ $data->appForm->app_no ?? '' }}</td>
                <td>  {{ $data->price_list_no }}</td>
                <td>  {{ $data->reciept_status }}</td>
                <td> <a href="" class="btn btn-success pricelist-select btn-sm" data-id="{{ $data->id }}">Select</a></td>
              </tr>
              @endforeach
            @endif
        </table>
      </div><!-- end modal-bpdy -->
    </div><!-- end modal-content -->
  </div><!-- end modal-dialog -->
</div><!-- end edit-profile -->

@endsection
@push('page_scripts')
<script>
   var getItem = "{{url('/get-price-item')}}";
</script>
<script type="text/javascript" src="{{asset('js/priceList.js')}}"></script>
@endpush