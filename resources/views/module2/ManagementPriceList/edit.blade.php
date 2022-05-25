@extends('layouts.master')
@section('finance','active')
@section('content') 
    <h1 class="page-header">{{trans('finance_title.update_pri_list_no').$price_list -> no}}</h1></h1>
    <div class="card">
      @include('flash')
      <div class="card-body">
         
            <form  action="{{route('price-list.update',['price_list'=> $price_list])}}"  method="POST" id="price-list">
                      @method('PATCH')
                      @csrf
                      <div class="modal-body">
                        <div class="form-row">
                         
                          <div class="col-md-4 col-sm-12 mb-3">
                            <label for="validationCustom01">{{ trans('finance_title.ref_no') }}:</label>
                            <input type="text" class="typeahead  form-control" id="ref_no" value="{{$price_list->ref_no}}" placeholder="{{ trans('finance_title.enter_ref_no') }}" name="ref_no" required="">
                            <div id="ref_list">
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-12 mb-4">
                              <label for="validationCustom01">{{ trans('finance_title.user_payer') }}:</label>
                              <input type="text"  id="customer" class="form-control customer"  readonly="" value="{{$price_list->users_payer->name}}">
                              <input type="hidden" name="user_payer" id="customer_id" value="{{$price_list->user_payer}}">
                             
                          </div>
                          <div class="col-md-4 col-sm-12 mb-3">
                            <label for="validationCustom01">{{ trans('finance_title.date') }}:</label>
                            <input type="text" class="date form-control" id="validationCustom01" value="{{$price_list->date}}" placeholder="{{ trans('finance_title.enter_date') }}" name="date" required="">
                          </div>
                    
                         
                          <div class="col-md-3 col-sm-12 mb-3">
                            <label for="validationCustom01">{{trans('title.province_code')}}:</label>
                             <input type="text" class="form-control" id="province_code" value="{{$price_list['province_code']}}" placeholder="{{ trans('finance_title.enter_date') }}" name="province_code" readonly="">
                        </div>
                          
                           
                        <div class="col-md-3 col-sm-12 mb-3">
                            <label for="validationCustom01">{{ trans('finance_title.counter_name') }}:</label>
                           
                            <select name="service_counter_id" id="" class="form-control">
                                 @foreach($service_counter as $data)
                              <option value="{{$data->service_counter_id}}">{{$data->service_counter->name}}</option>
                                @endforeach
                            </select>
                            
                           
                        </div>


                      <div class="col-md-3 col-sm-12 mb-3">
                          <label for="validationCustom01">{{ trans('title.reciept_status') }}:</label>
                           <select class="form-control" name="reciept_status">
                          <option value="" selected disabled >Select Reciept Status</option>
                            @foreach(\App\Model\PriceList::getEnumList("reciept_status") as $key => $value)
                                <option value="{{$key}}" @if($key == $price_list->reciept_status) selected="selected" @endif>{{$value}}</option>
                            @endforeach
                        </select>
                      </div>
                       <div class="col-md-3 col-sm-12 mb-3">
                          <label for="validationCustom01">{{ trans('finance_title.currency') }}:</label>
                          <select name="money_unit_id" id="money_unit_id" class="form-control" required="">
                            <option value="" selected disabled >Select Currency</option>
                              @foreach ($money_unit as $money)
                                  <option value="{{$money-> id}}" @if($money->id == $price_list->money_unit_id) selected="selected" @endif>{{$money->name_en}}</option>
                              @endforeach
                          </select>
                      </div>
                    
                          
                              </div>
                              <hr/>
                              <h4>{{trans('finance_title.price_item_list')}}</h4>
                              <a class="btn btn-success bold btn-sm" href="javascript:void(0);" id="add"><i class="fa fa-plus"></i></a>
                              @for($i =0;$i<count($price_detail);$i++)
        <div class="row pList table-responsive">
                <table class="table table-striped table-bordered table-hover">

                    <tbody>

                        <tr>
                            
                            <td>

                                <div class="form-group">
                                    <div class="input-group input-group-sm">
                     <span class="input-group-addon" id="sizing-addon1">{{trans('finance_title.item_code')}}</span>
                     <input type="text" class='form-control item' name="item_code[]" id="item-1" value="{{$price_detail[$i]['item_code']}}" placeholder="Enter Item Code" title="Type to search Item" data-type="item" required>
                                    <input type="hidden" id="itemId-1" class="itemid" name="price_item_id[]" value="{{$price_detail[$i]['price_item_id']}}">
                                    <input type="hidden" id="item-name-en-1" class="item-name-en" name="item_name_en[]" value="{{$price_detail[$i]['item_name_en']}}">
                                    <input type="hidden" id="item-name-1" class="item-name" name="item_name[]" value="{{$price_detail[$i]['item_name']}}">
                  </div>
                                </div>
                                <input type="hidden" id="_token" value="{{ csrf_token() }}">
                            </td>
                          
                            <td>
                                <div class="form-group">
                                   <div class="input-group input-group-sm">
                     <span class="input-group-addon" id="sizing-addon1">{{trans('finance_title.price')}}</span>
                      <input type="text" id="price-1" class='form-control price' name="unit_price[]"  value="{{$price_detail[$i]['price']}}" readonly="">
                  </div>
                                </div>
                            </td>
                          
                            
                            <td >
                               <div class="form-group ">
                  <div class="input-group input-group-sm">
                     <a title="delete" href="javascript:void(0);" data-id="{{$price_detail[$i]['id']}}"  data-toggle="modal" data-target="#deleteModel" class="btn btn-danger bold btn-sm remove "><i class="fa fa-minus"></i></a>
                  </div>
               </div>

                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
            @endfor
           
            <div id="shwInput"></div>
            <br>
                <div class="row">
                  <div class="col-md-6"> &nbsp; </div>
                  <div class="col-md-2"><h3>Total Price :</h3></div>
                  <div class="col-md-4" > <input type="text" class="form-control total_amt" name="total_amt" id="total_amt" value="{{$price_list->total_amt}}" readonly></div>
                </div>
    </div>
    
  </div>
     
                            <div class="modal-footer">
                                <a href="/price-list" class="btn btn-secondary btn-sm">{{ trans('button.cancel') }}</a>
                              <input type="submit" class="btn btn-success btn-sm" value="{{ trans('button.next') }}">
                              </div>
                            </div>
            </form>
    </div>
</div>
 @include('delete')
@endsection
@push('page_scripts')
<script type="text/javascript">
   var get_item="{{ route('item') }}";
   var get_ref_no="{{ route('getRefno') }}";
   var base_url = "{{url('delete-price')}}";
      
     $(document).on("click", '.remove', function (e) {  
            
            document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
    });
</script>
<script type="text/javascript" src="{{asset('js/price-list.js')}}"></script>
@endpush

   
