<div class="modal-header">
    <h3 class="text-center">{{trans('finance_title.add_item_price')}}</h3>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
</div>
<div class="modal-body">
    <div class="card-body">
        <form action="{{route('pricestore.store')}}" method="POST">
           @method('post')
           @csrf
           <div class="modal-body">
           <h4><span>{{ trans('finance_title.detail_of_item')}} {{$priceitem -> code }}</span></h4>
           <table class="table table-striped table-bordered" style="width: 50%">
              <tbody>
                 <tr>
                    <td width="200px">{{trans('finance_title.item_code')}}</td>
                    <td>{{$priceitem->code}} </td>
                 </tr>
                 <tr>
                    <td width="200px">{{trans('finance_title.item_name')}}</td>
                    <td>{{$priceitem->name}} </td>
                 </tr>
                 <tr>
                    <td width="200px">{{trans('finance_title.item_name_en')}}</td>
                    <td>{{$priceitem->name_en}} </td>
                 </tr>
                 <tr>
                    <td width="200px">{{trans('finance_title.description')}}</td>
                    <td>{{$priceitem->description}} </td>
                 </tr>
                 <tr>
                    <td width="200px">{{trans('finance_title.status')}}</td>
                    <td>{{$priceitem->status}} </td>
                 </tr>
                 <tr>
                    <td width="200px">{{trans('finance_title.option')}}</td>
                    <td>{{$priceitem->show_hide}} </td>
                 </tr>
                 <tr>
                    <td width="200px">Vehicle Type Group</td>
                    <td>{{$priceitem->VehTypeGroup->name ?? ''}} </td>
                 </tr>
              </tbody>
           </table>
           <br/>
           <hr/>
           <div class="row">
              <div class="col-md-12">
                 <h4><span>{{ trans('finance_title.add_price_for_item') }} {{$priceitem -> code}}({{$priceitem-> name_en}})</span></h4>
                 <table class="table table-striped table-hove" id="app-document">
                    <tbody>
                       <tr>
                          <td style="display:none;">
                             <div class="form-group code">
                                <div class="">
                                   <span class="input-group-addon" id="sizing-addon1">{{ trans('finance_title.item_id') }}</span>
                                   <input type="text" class="form-control" id="validationCustom01" value="{{$priceitem->id}}" name="price_item_id[]" required="" readonly="readonly">
                                </div>
                             </div>
                          </td>
                          <td>
                             <div class="form-group province">
                                <div class=" ">
                                   <span class="input-group-addon mr-1 mt-1" id="sizing-addon1">{{ trans('finance_title.item_province') }}</span>
                                   <select name="province_code[]" class="form-control "  required="">
                                      <option value="" selected disabled hidden>{{trans('finance_title.select_province')}}</option>
                                      @foreach($price_province as $data)
                                      <option value="{{$data-> province_code}}">{{$data->name_en}}<span>({{$data->name}})</span></option>
                                      @endforeach
                                   </select>
                                </div>
                             </div>
                          </td>
                          <td>
                             <div class="form-group unit_price">
                                <div class="">
                                   <span class="input-group-addon mr-1 mt-1" id="sizing-addon1">{{ trans('finance_title.price') }}</span>
                                   <input type="number" class="form-control" id="validationCustom01" value="{{old('unit_price')}}" placeholder="{{trans('finance_title.enter_price')}}" name="unit_price[]" required="">
                                </div>
                             </div>
                          </td>
                          <td>
                             <div class="form-group fine_percent">
                                <div class="form-group unit_price">
                                   <div class="input-group-sm">
                                      <span class="input-group-addon mr-1 mt-1" id="sizing-addon1">{{ trans('finance_title.fine_percent') }}</span>
                                      <input type="number" class="form-control" id="validationCustom01" value="{{old('fine_percent')}}" placeholder="{{trans('finance_title.enter_fine_percent')}}" name="fine_percent[]" required="" />
                                   </div>
                                </div>
                          </td>
                          <td>
                          <div class="form-group currency">
                          <div class="form-group unit_price">
                          <div class="">
                          <span class="input-group-addon mr-1 mt-1" id="sizing-addon1">{{ trans('finance_title.item_currency') }}</span>
                          <select name="money_unit_id[]" class="form-control " required="">
                          @foreach($currency as $data)
                          @if($data->id ==1)
                          <option value="{{$data->id}}">{{$data->name_en}}<span>({{$data->name}})</span></option>
                          @endif
                          @endforeach
                          </select>
                          </div>
                          </div>
                          </td>
                          <td>
                          <button type="button" name="add" id="add" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                          </td>
                       </tr>
                    </tbody>
                 </table>
                 </div>
                 </div>
                 <div class="col-md-12 col-sm-12 text-right">
                    <a href="/price-item" class="btn btn-secondary btn-sm">{{trans('finance_button.cancel')}}</a>
                    <button type="submit" class="btn btn-primary btn-sm">{{trans('button.save')}}</button>
                 </div>
              </div>
        </form>
        </div>
        <div class="panel-body">
           <table id="myTable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                 <tr>
                    <th>{{trans('finance_title.item_code')}}</th>
                    <th>{{trans('finance_title.item_name')}}</th>
                    <th>{{trans('finance_title.item_name_en')}}</th>
                    <th>{{trans('finance_title.item_price')}}</th>
                    <th>{{trans('finance_title.fine_percent')}}</th>
                    <th>{{trans('finance_title.item_currency')}}</th>
                    <th>{{trans('finance_title.item_province')}}</th>
                    <th width="150px">{{trans('finance_title.item_action')}}</th>
                 </tr>
              </thead>
              <tbody>
                 @foreach ($unitprice as $unitprice)
                 <tr>
                    <td>@if (isset($unitprice -> price_item -> code)){{$unitprice -> price_item -> code}}@else{{" _ "}}@endif</td>
                    <td>@if (isset($unitprice -> price_item -> name)){{$unitprice -> price_item -> name}}@else{{" _ "}}@endif</td>
                    <td>@if (isset($unitprice -> price_item -> name_en)){{$unitprice -> price_item -> name_en}}@else{{" _ "}}@endif</td>
                    <td>{{$unitprice -> unit_price}}</td>
                    <td>{{$unitprice -> fine_percent}}</td>
                    <td>@if (isset($unitprice -> money_unit -> name)){{$unitprice -> money_unit -> name_en}}<span>({{$unitprice -> money_unit -> name}})</span>@else{{"_"}}@endif</td>
                    <td>{{$unitprice ->province-> name??''}}({{$unitprice ->province-> name_en??''}})</td>
                    {{-- 
                    <td>@if (isset($unitprice -> province -> province_code)){{$uniptrice -> province -> name}}<span>({{$unitprice -> province -> name_en}})</span>@else{{"_"}}@endif</td>
                    --}}  
                    {{-- @can('price-item-delete') --}}
                    <td>
                       <a href="" class="btn btn-info btn-sm  edit_btn"
                          data-toggle="modal" data-target="#editModel"
                          data-act="Edit"
                          data-price_item_id ="{{$unitprice->price_item_id}}"
                          data-province_code="{{ $unitprice->province_code }}"
                          data-unit_price="{{$unitprice->unit_price}}"
                          data-fine_percent ="{{$unitprice->fine_percent}}"
                          data-money_unit_id ="{{$unitprice->money_unit_id}}"
                          data-province_name ="{{$unitprice->province->name ?? ''}}"
                          data-status ="{{$unitprice->status}}"
                          data-id="{{$unitprice->id}}">{{trans('button.edit')}}
                       </a>
                       <form style="display:inline" class="delete" action="/unit-price/{{$unitprice -> id}}" method="POST">
                          @method('DELETE')
                          @csrf
                          <button type="submit" class="btn btn-danger btn-sm"><span> {{trans('finance_button.delete')}}</span></button>
                       </form>
                    </td>
                    {{-- @endcan --}}
                 </tr>
                 @endforeach 
              </tbody>
           </table>
        </div>
@include('module2.ManagePriceItem.EditPriceModal', ['price_province '=> $price_province, 'currency'=>$currency])
        
</div>
<script type="text/javascript">

       var base_url = "{{url('unit-price')}}";
       var upd_price = "{{ url('/update/unit-price') }}";
             $(".delete").on("submit", function(){
             return confirm("Are you sure to delete?");
       });
       
       $("#add").click(function(){
       var code = '<td style="display:none;">'+'<div class="form-group" style="display:none;">'+$('.code').html()+'</div>'+'</td>';
       var unit_price = '<div class="form-group">'+$('.unit_price').html()+'</div>';
       var fine_percent = '<div class="form-group ">'+$('.fine_percent').html()+'</div>';
       var currency = '<div class="form-group">'+$('.currency').html()+'</div>';
       var province = '<div class="form-group ">'+$('.province').html()+'</div>';
       $("#app-document").append(
         '<tr>'+ code + 
         '<td>'+ province + '</td>'+
         '<td>'+ unit_price  + '</td>'+
         '<td>'+ fine_percent+ '</td>'+
         '<td>'+ currency + '</td>'+
         '<td><button type="button" class="btn btn-danger btn-sm remove-tr"><i class="fa fa-minus"></i></button></td>'+
         '</tr>'
       );
          
       });
      
       $(document).on('click', '.remove-tr', function(){  
            $(this).parents('tr').remove();
       });  
       $(document).on("click", '.edit_btn', function (e) 
       { 
           $('[name="price_item_id"]').val($(this).data('price_item_id'));
           $('[name="province_code"]').val($(this).data('province_code'));
           $('[name="province_name"]').val($(this).data('province_name'));
           $('[name="unit_price"]').val($(this).data('unit_price'));
           $('[name="fine_percent"]').val($(this).data('fine_percent'));
           $('[name="money_unit_id"]').val($(this).data('money_unit_id'));
           $('[name="status"]').val($(this).data('status')).attr('selected','selected');
           document.getElementById("editform").action = upd_price+"/"+$(this).data('id');
           });
</script>