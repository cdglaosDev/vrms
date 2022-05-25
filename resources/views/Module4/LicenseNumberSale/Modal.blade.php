@php
$price_item = \App\Model\PriceItem::whereLicenseSale("1")->get();
$provinces = \App\Model\Province::GetProvince();

@endphp
<div class="modal fade" id="addModel" role="modal-dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
         <div class="modal-header">
               <div class="col-md-11 text-center">
                  <h3 class="text-center">{{ trans('module4.add_license_number_sale')}}</h3>
               </div>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
         </div>
      <form  action="{{route('license-number-sale.store')}}"  method="POST" id="newForm">
            @method('post')
            @csrf
            <div class="modal-body">
               <div class="form-row">
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01">{{ trans('module4.license_no') }}.:</label>
                     <input type="text" title="Please enter no" validateNo="{{ trans('module4.min_number')}}" class="form-control lic-no number-only"  minlength="4" maxlength="5" value="" placeholder="" name="license_no_sale_number" required="">
                  </div>
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01"> {{ trans('common.province') }}:</label>
                     <select name="province_code"  title="{{ trans('module4.select_province') }}" class="js-example-basic-single form-control province" style="width: 100%" required>
                        <option value="" selected disabled>Select Province</option>
                        @foreach($provinces as $province)
                        <option value="{{ $province->province_code}}" @if(auth()->user()->user_level == "province"){{$province->province_code == auth()->user()->user_info->province_code?'selected':'hidden'}} @endif>{{ $province->name }}({{ $province->name_en}})</option>
                        @endforeach
                     </select>
                  </div>
                  
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01"> {{ trans('module4.price_item') }}:</label><br/>
                     <select name="price_item_id" title="{{ trans('module4.select_price_item') }}" class="js-example-basic-single form-control price_item" id="price-item" style="width:100%" required="">
                        <option value="" selected disabled>Select Price Item</option>
                        @foreach($price_item as $item)
                        <option value="{{ $item->id}}">{{ $item->code }}/ {{$item->name }}/ {{ \App\Library\TotalItemPrice::getTotal($item->id)}}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01"> {{ trans('module4.price') }}:</label>
                     <input type="text" class="form-control price"  value="" placeholder="" name="price" readonly>
                     <span class="error-text" style="color:red;font-size:11px;"></span>
                  </div>
                  <div class="col-md-3 mb-3">
                     <label for="validationCustom01">{{trans('common.status')}}:</label>
                     <select name="status" class="form-control">
                        <option value="1">{{trans('table.active')}}</option>
                        <option value="0">{{trans('table.deactive')}}</option>
                     </select>
                  </div>
               </div>
               <input type="hidden" id="new-id" value="">
            </div>
            
            <div class="modal-footer">
               <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
               <button type="submit"  class="btn btn-success btn-sm btn-save" id="add-new">{{trans('button.save')}}</button>
            </div>
      </form>
	</div>
</div>
</div>


<div class="modal fade" id="editModel" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
   <div class="modal-content">
         <div class="modal-header">
               <div class="col-md-11 text-center">
                  <h3 class="text-center">{{ trans('module4.edit_license_number_sale')}}</h3>
               </div>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
         </div>
         <form action="" method="POST"  id="editform" name="editform">
            @method('PATCH')
            @csrf
           
            <div class="modal-body">
               <div class="form-row">
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01">{{ trans('module4.license_no') }}.:</label>
                     <input type="text" class="form-control lic-no number-only"   minlength="4" maxlength="5" value="" placeholder="" name="license_no_sale_number" required="">
                  </div>
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01"> {{ trans('common.province') }}:</label>
                     <select name="province_code"  class="js-example-basic-single form-control province" style="width: 100%" required>
                        <option value="" selected disabled>Select Province</option>
                        @foreach($provinces as $province)
                        <option value="{{ $province->province_code}}" @if(auth()->user()->user_level == "province"){{$province->province_code == auth()->user()->user_info->province_code?'selected':'hidden'}} @endif>{{ $province->name }}({{ $province->name_en}})</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01"> {{ trans('module4.price_item') }}:</label>
                     <select name="price_item_id" id="edit-price-item" class="js-example-basic-single form-control price_item" style="width: 100%;" required>
                        <option value="" selected disabled>Select Price Item</option>
                        @foreach($price_item as $item)
                        <option value="{{ $item->id}}">{{ $item->code }}/ {{$item->name }}/ {{ \App\Library\TotalItemPrice::getTotal($item->id)}}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01"> {{ trans('module4.price') }}:</label>
                     <input type="text" class="form-control price"  value="" placeholder="" name="price" readonly>
                     <span class="error-text" style="color:red;font-size:11px;"></span>
                  </div>
                  <div class="col-md-3 mb-3">
                     <label for="validationCustom01">{{trans('common.status')}}:</label>
                     <select name="status" class="form-control">
                        <option value="1">{{trans('table.active')}}</option>
                        <option value="0">{{trans('table.deactive')}}</option>
                     </select>
                  </div>
               </div>
               <input type="hidden" id="edit-id" value="">
            </div>
            <div class="modal-footer">
               <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
               <input type="submit" class="btn btn-success btn-sm btn-save" id="update-form" value="{{trans('button.update')}}">
            </div>
         </form>
   </div>
	</div>
</div>
