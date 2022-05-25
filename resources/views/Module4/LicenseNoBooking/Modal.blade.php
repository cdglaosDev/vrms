@php

$vehicle_kinds = \App\Model\VehicleKind::whereStatus(1)->get();
$provinces = \App\Model\Province::GetProvince();
$vehicle_type_group = \App\Model\VehicleTypeGroup::whereStatus(1)->get();
$apps = \App\Model\AppForm::AppForm();
$app_edit = \App\Model\AppForm::whereAppFormStatusId('1')->whereNotIn('id', \App\Model\LicenseNoBooking::usedBooking())->get();
@endphp
<div class="modal fade" id="lic_booking_addModel"  role="modal-dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
            <div class="modal-header">
               <div class="col-md-11 text-center">
                  <h3 class="text-center">{{trans('module4.add_license_booking')}}</h3>
               </div>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
         <form  action="{{route('license-number-booking.store')}}"  method="POST" id="lic_booking">
            @method('post')
            @csrf
           <input type="hidden" id="new-id" value="">
           <input type="hidden" id="new-app-id" value="">
            <div class="modal-body">
               <div class="form-row">
                  <div class="col-md-6 col-sm-6 mb-3">
                     <label for="validationCustom01">{{trans('module4.vehicle_kind')}}:</label>
                     <select name="vehicle_kind_code" id="vehicle_kind" class="form-control vehicle_kind" title1="{{ trans('module4.choose_vehicle_kind') }}" required>
                        <option value="" selected disabled>Select Vehicle Kind</option>
                        @foreach($vehicle_kinds as $kind)
                        <option value="{{ $kind->vehicle_kind_code}}">{{ $kind->name }}</option>
                        @endforeach
                     </select>
                     <input type="hidden" class="upd_kind" value="">
                  </div>
                  <div class="col-md-6 col-sm-6 mb-3">
                     <label for="validationCustom01">{{ trans('module4.vehicle_type_group')}}</label>
                     <select name="vehicle_type_group_id" id="vehicle_type_group_id" class="form-control type_group" title1="{{ trans('module4.choose_type_group') }}" required="">
                        <option value="" selected disabled hidden>Select Vehicle Type Group</option>
                        @foreach($vehicle_type_group as $type_group)
                        <option value="{{$type_group->id}}">{{$type_group->name}}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-md-6 col-sm-6 mb-3">
                     <label for="validationCustom01"> {{trans('common.province')}}:</label>
                     <select name="province_code" class="js-example-basic-single form-control province" style="width: 100%" title1="{{ trans('module4.select_province') }}" required>
                        <option value="" selected disabled>Select Province</option>
                        @foreach($provinces as $province)
                        <option value="{{ $province->province_code}}"  @if(auth()->user()->user_level == "province"){{ $province->province_code == auth()->user()->user_info->province_code?'selected':'hidden'}} @endif>{{ $province->name }}({{ $province->name_en }})</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-md-6 col-sm-6 mb-3">
                     <label for="validationCustom01">{{trans('module4.license_no')}}.:</label>
                     <input type="text" class="form-control license_no" id="license_no" maxlength="7" value="" placeholder="" name="license_no_book_number" required="">
                  </div>
                  <label for="">Status:</label>&nbsp; <span class="status" style="font-size: 14px;"></span>
                  <a class=" col-md-12 btn btn-info btn-sm check-status">{{ trans('module4.check')}}</a>
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01"> {{trans('module4.app_form')}}:</label>
                     <select name="app_id"  class="js-example-basic-single form-control app_no" style="width: 100%" required>
                        <option value="" selected disabled>Select Application Form</option>
                       
                     </select>
                  </div>
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01"> {{trans('module4.customer_name')}}:</label>
                     <input type="text" class="form-control"  value="" placeholder="" name="customer_name">
                  </div>
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01"> {{trans('module4.expire_date')}}:</label>
                     <input type="text" class="form-control"   value="{{date('d/m/Y', strtotime('+3 months'))}}" placeholder="" name="expire_date" readonly>
                     <input type="hidden" value="{{auth()->id()}}" name="user_id">
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
               <button type="submit"  class="btn btn-success btn-sm btn-save control-save" id="control-save">{{trans('button.save')}}</button>
            </div>
      </form>
      </div>
   </div>   
</div>

<!-- show role modal popup -->
<div class="modal fade" id="lic_booking_editModel" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
        <div class="modal-content edit-modal">
            
        </div>
    </div>
</div>
<!-- end show role modal popup -->


