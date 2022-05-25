@extends('layouts.master')
@section('finance','active')
@section('content') 
@php
$item =\App\Model\PriceItem::get();
$group_item =\App\Model\PriceItemGroup::get();

@endphp
    <h1 class="page-header">{{trans('book.price_item_gruop_create')}}</h1>
    <div class="panel panel-inverse">
    @include('flash') 
        <div class="body">
            <form  action="{{route('Price-item-group.store')}}"  method="POST">
                      @method('post')
                      @csrf
                <div class="modal-body">
                    <div class="row pb-3">
                       
                        <div class="col-sm-4">
                            <div class="from-group">
                                <label for="contact_name_en">{{trans('book.group_code')}}:</label>
                                <input type="text" name="group_code" id="validationCustom01" class="form-control" value="{{old('group_code')}}" placeholder="{{trans('book.enter_group_code')}}" required="">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="from-group">
                                <label for="contact_phone">{{trans('book.group_name')}}:</label>
                                <input type="text" name="group_name" id="validationCustom01" class="form-control" value="{{old('group_name')}}" placeholder="{{trans('book.enter_group_code_name')}}" required="">
                            </div>
                        </div>
                            <div class="col-sm-4">
                                <div class="from-group">
                                    <label for="name">{{trans('book.group_name_en')}}:</label>
                                    <input type="text" name="group_name_en" id="validationCustom01" class="form-control" value="{{old('name')}}" placeholder="{{trans('book.enter_group_code_name_en')}}" required="">
                                </div>
                            </div>
                       
                    </div>

                        <div class="row pb-3">
                            

                            <div class="col-sm-4">
                                <div class="from-group">
                                    <label for="name_en">{{trans('book.group_note')}}:</label>
                                    <input type="text" name="group_note" id="validationCustom01" class="form-control" value="{{old('name_en')}}" placeholder="{{trans('book.enter_group_note')}}" required="">
                                </div>
                            </div>
                              <div class="col-md- mb-3">
                <label for="validationCustom01">{{trans('common.status')}}:</label>
                <select name="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Deactive</option>
                </select>
              </div>

                            </div>
                           {{--   <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="country_id">{{trans('table.group_item_name')}}:</label>
                                        <select name="group_item_id" id="country_id" class="form-control" required="">
                                        	 <option value="" selected disabled hidden>-- Select New Price Item Group Name-- </option>
                                            @foreach ($group_item as $imp_country)
                                                <option value="{{$imp_country-> id}}">{{$imp_country-> group_name}}<span>({{$imp_country-> group_name_en}})</span></option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                              --}} 
                         </div>
                       
                       
<div class="modal-body">
        <h4>{{trans('finance_title.add_price_item')}}</h4>
        <div class="row pList table-responsive">
                <table class="table table-striped table-bordered table-hover">

                    <tbody>

                        
                             
                             <div class="row">
                    <div class="col-md-12"> 
        
                        <table class="table table-striped table-bordered table-hove" id="app-document"> 
                          <tbody>
                            <tr> 
                             
                              <td>
                               <div class="form-group currency ">
                                    <div class="input-group input-group-sm">
                     <span class="input-group-addon" id="3;">{{trans('finance_title.select_price_item')}}</span>
                    
                             
                           <select name="price_item_id[]" id="sizing-addon1" class="form-control" required="">
                                        	 <option value="" selected disabled hidden>Select Item Name</option>
                                            @foreach ($item as $imp_country)
                                                <option value="{{$imp_country-> id}}" >{{$imp_country-> name}}<span>({{$imp_country->name_en}})</span></option>
                                            @endforeach
                                        </select>
                                
                  </div>
                                </div>
                              </td>  
                              <td>
                                <div class="form-group fine_percent">
                                    <div class="form-group unit_price">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon" id="sizing-addon1">{{ trans('finance_title.item_code') }}</span>
                                            <input type="text" class="form-control" id="" value="{{old('item_code')}}" placeholder="{{trans('finance_title.item_code')}}" name="" >
                                        </div>
                                </div>
                              </td>
                             {{--     <td>
                               <div class="form-group currency">
                                       <div class="form-group unit_price">
                                          <div class="input-group input-group-sm">
                                              <span class="input-group-addon" id="sizing-addon1">{{ trans('finance_title.item_currency') }}</span>
                                              <select name="money_unit_id[]" class="form-control " required="">
                                                <option value="" selected disabled hidden>{{trans('finance_title.select_currency')}}</option>
                                                 @foreach($currency as $data)
                                                <option value="{{$data->id}}">{{$data->name_en}}<span>({{$data->name}})</span></option>
                                                @endforeach
                                              </select>
                                          </div>
                                </div>
                                
                              </td>--}} 
                              {{--  <td>
                                <div class="form-group province">
                                       <div class="form-group unit_price">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon" id="sizing-addon1">{{ trans('finance_title.item_province') }}</span>
                                            <select name="province_code[]" class="form-control " required="">
                                              <option value="" selected disabled hidden>{{trans('finance_title.select_province')}}</option>
                                               @foreach($price_province as $data)
                                              <option value="{{$data-> province_code}}">{{$data->name_en}}<span>({{$data->name}})</span></option>
                                              @endforeach
                                            </select>
                                        </div>
                                </div>  
                              </td> --}}
                          
                              <td>
                                <button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button>
                              </td>
                            </tr>
                          </tbody>
                        </table> 
                      </div>
                  </div>
                       <div class="col-md-12 col-sm-12 text-right">
                    <a class="btn  btn-default" href="{{route('Price-item-group.index')}}">{{trans('button.cancel')}}</a>
                   <button type="submit" class="btn btn-primary">{{trans('button.save')}}</button>
                  </div>
    
                         
                          
                           
                       
                              

            </form>
        </div>
    </div>
@endsection
 @push('page_scripts')
<script type="text/javascript">


    var base_url = "{{url('admin/Price-item-group')}}";
 
          $(".delete").on("submit", function(){
          return confirm("Are you sure to delete?");
    });
    
    $("#add").click(function(){
    	 var currency = '<div class="form-group">'+$('.currency').html()+'</div>';
    var code = '<div class="form-group">'+$('.code').html()+'</div>';
    var unit_price = '<div class="form-group">'+$('.unit_price').html()+'</div>';
    var fine_percent = '<div class="form-group ">'+$('.fine_percent').html()+'</div>';
   
    var province = '<div class="form-group ">'+$('.province').html()+'</div>';
    $("#app-document").append(
      '<tr>'+
       '<td>'+ currency + '</td>'+
     
      '<td>'+ fine_percent+ '</td>'+
     
    
      '<td><button type="button" class="btn btn-danger remove-tr"><i class="fa fa-minus"></i></button></td>'+
      '</tr>'
    );
       
    });
   
    $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
    });  
   
</script>
@endpush
   
 