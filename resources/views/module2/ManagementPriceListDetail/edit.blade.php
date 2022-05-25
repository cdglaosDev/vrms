@extends('layouts.master')
@section('finance','active')
@section('content') 
    <h1 class="page-header">{{trans('finance_title.update_pri_detail')}}</h1>
    <div class="panel panel-inverse">
    @include('flash') 
        <div class="body">
            <form action="{{route('pricelistdetail.update',['pricelistdetail'=> $pricelistdetail])}}" method="POST">
            
                @method('PATCH')
                      @csrf
              
                      <div class="modal-body">
                        <div class="form-row">
                          <div class="col-md-12 mb-3">
                            <label for="validationCustom01">{{trans('finance_title.detail_quantity')}}:</label>
                            <input type="text" class="form-control" id="validationCustom01" value="{{old('quantity')?? $pricelistdetail-> quantity}}" placeholder="" name="quantity" required="">
                          </div>
                    
                          <div class="col-md-12 mb-3">
                            <label for="validationCustom01">{{trans('finance_title.detail_price')}}:</label>
                            <input type="text" class="form-control" id="validationCustom01" value="{{old('price')?? $pricelistdetail-> price}}" placeholder="" name="price" required="">
                          </div>
                    
                          <div class="col-md-12 mb-3">
                            <label for="validationCustom01">{{trans('finance_title.detail_total')}}:</label>
                            <input type="text" class="form-control" id="validationCustom01" value="{{old('total')?? $pricelistdetail-> total}}" placeholder="" name="total" required="">
                          </div>

                          <div class="col-md-12 mb-3">
                            <label for="validationCustom01">{{trans('finance_title.item_code_name')}}:</label>
                            <select name="price_item_id" id="price_item_id" class="form-control" required="">
                                @foreach ($priceitem as $item)
                                    <option value="{{$item-> id}}" {{$item->id == $pricelistdetail->price_item_id ? 'selected' : ''}}>{{$item-> code}}<span class="text-muted">({{$item-> name_en}})</span></option>
                                @endforeach
                              </option>
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                          <label for="validationCustom01">{{trans('finance_title.price_list_no')}}:</label>
                          <select name="price_list_id" id="price_list_id" class="form-control" required="">
                              @foreach ($pricelist as $list)
                                  <option value="{{$list-> id}}" {{$list-> id == $pricelistdetail->price_list_id ? 'selected' : ''}}>{{$list-> no}}</option>
                              @endforeach
                            </option>
                          </select>
                      </div>s
                    
                      <div class="col-md-12 mb-3"> 
                        <div class="form-group">
                          <label for="status">{{ trans('finance_title.status') }}:</label>
                          <select name="status" id="status" class="form-control">
                                  @foreach ($pricelistdetail -> activeOptions() as $activeOptionsKey => $activeOptionsValue)
                                      <option value="{{$activeOptionsKey}}" {{$pricelistdetail -> status == $activeOptionsValue ? 'selected' : ''}}>{{$activeOptionsValue}}</option>
                                  @endforeach
                          </select>
                      </div>
                        </div>
                          
                              </div>
                            </div>
                            <div class="modal-footer">
                                <a href="/pricelistdetail" class="btn btn-secondary">{{trans('finance_button.cancel')}}</a>
                              <input type="submit" class="btn btn-success " value="{{trans('finance_button.update')}}">
                              </div>
                            </div>
            </form>
        </div>
    </div>
@endsection