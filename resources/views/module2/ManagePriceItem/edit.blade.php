<style>
  .datepicker.dropdown-menu{
top:305.6251px !important
}
</style>
@php
$vtype_groups = \App\Model\VehicleTypeGroup::whereStatus(1)->get();
@endphp

<div class="modal-header">
    <h3 class="text-center">{{trans('finance_title.update_item_detail')}}</h3>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
</div>
<div class="modal-body">
    <div class="card-body">
        <form action="{{route('price-item.update',['price_item'=> $price_item])}}" method="POST">
        
            @method('PATCH')
                  @csrf
          
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-4 col-sm-12 mb-4">
                        <div class="form-group">
                          <label for="validationCustom01">{{trans('finance_title.item_code')}}:</label>
                          <input type="text" readonly="readonly" class="form-control" id="validationCustom01" value="{{old('code')??$price_item -> code}}" placeholder="" name="code" required="">
                        </div>
                      </div>
                      
                      <div class="col-md-4 col-sm-12 mb-4">
                        <div class="form-group">
                          <label for="validationCustom01">{{trans('finance_title.item_name')}}:</label>
                          <input type="text" class="form-control" id="validationCustom01" value="{{old('name')??$price_item -> name}}" placeholder="" name="name" required="">
                        </div>
                      </div>
                      
                      <div class="col-md-4 col-sm-12 mb-4">
                        <div class="form-group">
                          <label for="validationCustom01">{{trans('finance_title.item_name_en')}}:</label>
                          <input type="text" class="form-control" id="validationCustom01" value="{{old('name_en')??$price_item -> name_en}}" placeholder="" name="name_en" required="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4 col-sm-12 mb-4">
                        <div class="form-group">
                          <label for="validationCustom01">{{trans('finance_title.description')}}:</label>
                          <textarea type="text" name="description" id="validationCustom01" cols="10" rows="5" class="form-control" value="{{old('description')}}">{{old('description')??$price_item -> description }}</textarea>
                        </div>
                      </div>

                      <div class="col-md-4 col-sm-12 mb-4">
                        <div class="form-group">
                          <label for="status">{{ trans('finance_title.status') }}:</label>
                              <select name="status" id="status" class="form-control">
                                      @foreach ($price_item -> activeOptions() as $activeOptionsKey => $activeOptionsValue)
                                          <option value="{{$activeOptionsKey}}" {{$price_item -> status == $activeOptionsValue ? 'selected' : ''}}>{{$activeOptionsValue}}</option>
                                      @endforeach
                              </select>
                              <label for="vehicle_type_group_id">{{ trans('finance_title.vtypegroup')}}:</label>
                          <select name="vehicle_type_group_id" id="status" class="form-control" required>
                              <option value="">Select Vehicle Type Group</option>
                              @foreach($vtype_groups as $vtype_group)
                              <option value="{{ $vtype_group->id }}" {{$price_item->vehicle_type_group_id == $vtype_group->id ?'selected': ''}}>{{ $vtype_group->name }}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="col-md-4 col-sm-12 mb-4">
                        <div class="form-group">
                          <label for="show_hide">{{ trans('finance_title.option') }}:</label>
                          <select name="show_hide" id="show_hide" class="form-control">
                                @foreach ($price_item -> ShowOptions() as $ShowOptionsKey => $ShowOptionsValue)
                                    <option value="{{$ShowOptionsKey}}" {{$price_item -> show_hide == $ShowOptionsValue ? 'selected' : ''}}>{{$ShowOptionsValue}}</option>
                                @endforeach
                          </select>

                          <label for="license_sale">License Sale:</label>
                          <select name="license_sale"  class="form-control">
                              <option value="">Select license sale</option>
                              <option value="0" {{ $price_item->license_sale == 0?'selected':'' }}>No</option>
                              <option value="1" {{ $price_item->license_sale == 1?'selected':'' }}>Yes</option>
                          </select>
                        </div>
                      </div>
                    </div>
                        {{-- <div class="col-md-12 mb-3"> 
                            <div class="form-check">
                                 <input type="hidden" value="" name="created_by">                      
                                <input  type="checkbox" class="form-check-input" name="status" value="1">
                              
                              <label class="form-check-label" name="status" for="defaultCheck1">
                                {{trans('finance_title.status')}}
                              </label>
                            </div>   --}}
                        </div>
                        <div class="modal-footer">
                            <a href="/price-item" class="btn btn-secondary btn-sm">{{ trans('finance_button.cancel') }}</a>
                          <input type="submit" class="btn btn-success btn-sm" value="{{trans('finance_button.update')}}">
                        </div>
        </form>
    </div>
</div>