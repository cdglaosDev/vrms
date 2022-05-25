@php
$price_item = \App\Model\PriceItem::whereStatus(1)->get();
$provinces = \App\Model\Province::GetProvince();
@endphp
<div class="modal fade" id="addModel"  role="modal-dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
            <div class="modal-header">
               <h3 class="text-center">{{trans('module4.add_license_number_not_sale')}}</h3>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
         <form  action="{{route('license-number-not-sale.store')}}"  method="POST" id="newForm">
            @method('post')
            @csrf
            
            <div class="modal-body">
               <div class="form-row">
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01">{{trans('module4.license_no')}}:</label>
                     <input type="text" class="form-control lic-no number-only" title="Please enter number"  maxlength="5" value="" placeholder="Enter License Not sale no" name="license_no_not_sale_number" required="">
                  </div>
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01"> {{trans('common.province')}}:</label>
                     <select name="province_code" title="Please select province" id="new-province" class="js-example-basic-single form-control province" style="width: 100%" required>
                        <option value="" selected disabled>Select Province</option>
                        @foreach($provinces as $province)
                        <option value="{{ $province->province_code}}">{{ $province->name }}({{ $province->name_en}})</option>
                        @endforeach
                     </select>
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

<div class="modal fade" id="editModel"  role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
            <div class="modal-header">
              <h3 class="text-center">{{trans('module4.edit_license_number_not_sale')}}</h3>
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
                     <label for="validationCustom01">{{trans('module4.license_no')}}.:</label>
                     <input type="text" class="form-control lic-no number-only" title="Please enter number" value="" maxlength="5"  placeholder="" name="license_no_not_sale_number" required="">
                  </div>
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01"> {{trans('common.province')}}:</label>
                     <select name="province_code" title="Please select province" id="edit-province" class="js-example-basic-single form-control province" style="width: 100%" required>
                        <option value="" selected disabled>Select Province</option>
                        @foreach($provinces as $province)
                        <option value="{{ $province->province_code}}">{{ $province->name }}({{ $province->name_en}})</option>
                        @endforeach
                     </select>
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
