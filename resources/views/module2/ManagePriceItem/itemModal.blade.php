@php
$vtype_groups = \App\Model\VehicleTypeGroup::whereStatus(1)->get();
@endphp
<!-- start add modal -->
<div class="modal fade bigger" id="addModel" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h3 class="text-center">{{trans('finance_title.create_price_item')}}</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form  action="\price-item"  method="POST">
      @method('post')
      @csrf
      <div class="modal-body">
         <div class="form-row">
            <div class="col-md-4 col-sm-12 mb-4">
               <div class="form-group">
                  <label for="validationCustom01">{{trans('finance_title.item_code')}}:</label>
                  <input type="text" class="form-control" id="validationCustom01" value="{{old('code')}}" placeholder="{{trans('finance_title.enter_item_code')}}" name="code" required="">
               </div>
            </div>
            <div class="col-md-4 col-sm-12 mb-4">
               <div class="form-group">
                  <label for="validationCustom01">{{trans('finance_title.item_name')}}:</label>
                  <input type="text" class="form-control" id="validationCustom01" value="{{old('name')}}" placeholder="{{trans('finance_title.enter_item_name')}}" name="name" required="">
               </div>
            </div>
            <div class="col-md-4 col-sm-12 mb-4">
               <div class="form-group">
                  <label for="validationCustom01">{{trans('finance_title.item_name_en')}}:</label>
                  <input type="text" class="form-control" id="validationCustom01" value="{{old('name_en')}}" placeholder="{{trans('finance_title.enter_item_name_en')}}" name="name_en" required="">
               </div>
            </div>
         </div>
         <div class="row">
            {{-- 
            <div class="col-sm-4">
               <div class="form-group">
                  <label for="validationCustom01">{{trans('finance_title.item_price')}}:</label>
                  <input type="text" class="form-control" id="validationCustom01" value="{{old('price')}}" placeholder="{{trans('finance_title.enter_item_price')}}" name="price" required=""> 
               </div>
            </div>
            --}}
            <div class="col-md-4 col-sm-12 mb-4">
               <div class="form-group">
                  <label for="validationCustom01">{{trans('finance_title.description')}}:</label>
                  <textarea name="description" id="validationCustom01" cols="10" rows="5" class="form-control" placeholder="Enter description" value="{{old('description')}}"></textarea>  
               </div>
            </div>
            <div class="col-md-4 col-sm-12 mb-4">
               <div class="form-group">
                  <label for="status">{{ trans('finance_title.status') }}:</label>
                  <select name="status" id="status" class="form-control">
                     <option value="">{{trans('finance_title.select_status')}}</option>
                     <option value="1">Active</option>
                     <option value="0">Deactive</option>
                  </select>
                  <label for="vehicle_type_group_id">{{ trans('finance_title.vtypegroup')}}:</label>
                  <select name="vehicle_type_group_id" id="status" class="form-control" required>
                     <option value="">Select Vehicle Type Group</option>
                     @foreach($vtype_groups as $vtype_group)
                     <option value="{{ $vtype_group->id }}">{{ $vtype_group->name }}</option>
                     @endforeach
                  </select>
               </div>
            </div>
            <div class="col-md-4 col-sm-12 mb-4">
               <div class="form-group">
                  <label for="status">{{ trans('finance_title.option') }}:</label>
                  <select name="show_hide" id="show_hide" class="form-control">
                     <option value="">{{trans('finance_title.select_option')}}</option>
                     <option value="1">Show</option>
                     <option value="0">Hide</option>
                  </select>
                  <label for="license_sale">License No Sale:</label>
                  <select name="license_sale"  class="form-control">
                     <option value="0">No</option>
                     <option value="1">Yes</option>
                  </select>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <a href="/price-item" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</a>
            <input type="submit" class="btn btn-success btn-sm" value="{{trans('button.save')}}">
         </div>
      </div>
   </form>
      </div>
   </div>
</div>

<!-- end add modal -->

