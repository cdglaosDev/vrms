@php
$provinces = \App\Model\Province::GetProvince();
$vehicle_type_group = \App\Model\VehicleTypeGroup::whereStatus(1)->get();
$lic_alphas_control= \App\Model\LicenseAlphabetControl::whereProvinceCode(\App\Helpers\Helper::current_province())->pluck('license_alphabet_id')->toArray();

if(auth()->user()->user_level == "admin"){
$lic_alphas= \App\Model\LicenseAlphabet::get();
}else{
$lic_alphas= \App\Model\LicenseAlphabet::get();
}
$veh_kinds = \App\Model\VehicleKind::whereStatus(1)->get();
@endphp
<div class="modal hide fade bigger" id="addModel" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content w-150">
         <div class="modal-header">
            <h3 class="text-center">{{ trans('module4.add_lic_present')}}</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('license-no-present.store')}}" method="POST" id="newForm">
            @method('post')
            @csrf
            <input type="hidden" id="new-id" value="">
            <div class="modal-body">
               <div class="form-row">
                  <div class="col-md-6 col-sm-6 mb-3">
                     <label for="validationCustom01">{{ trans('common.province')}}</label>
                     <select name="province_code" class="js-example-basic-single form-control province_code" id="province" title="{{ trans('module4.select_province') }}" style="width: 100%" required="">
                        <option value="" selected disabled hidden>Select Province</option>
                        @foreach($provinces as $pro)
                        <option @if($pro->province_code == \App\Helpers\Helper::current_province()) selected @endif value="{{$pro->province_code}}">{{$pro->name}}({{$pro->name_en}})</option>
                        @endforeach
                     </select>
                  </div>

                  <div class="col-md-6 col-sm-6 mb-3">
                     <label for="validationCustom01">{{ trans('module4.vehicle_kind')}}</label>
                     <select name="vehicle_kind_code" class="form-control vehicle_kind" title="{{ trans('module4.choose_vehicle_kind') }}" required="">
                        <option value="" selected disabled hidden>Select Vehicle Kind </option>
                        @foreach($veh_kinds as $kind)
                        <option value="{{$kind->vehicle_kind_code}}">{{$kind->name}}</option>
                        @endforeach
                     </select>
                     <input type="hidden" class="upd_kind" value="">
                  </div>
                  <div class="col-md-6 col-sm-6 mb-3">
                     <label for="validationCustom01">{{ trans('module4.vehicle_type')}}</label>
                     <select name="vehicle_type_group_id" class="form-control type_group" title="{{ trans('module4.choose_type_group') }}" required="">
                        <option value="" selected disabled hidden>Select Vehicle Type </option>
                        @foreach($vehicle_type_group as $type_group)
                        <option value="{{$type_group->id}}">{{$type_group->name}}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-md-6 col-sm-6 mb-3">
                     <label for="validationCustom01">{{ trans('module4.lic_alphabet')}}</label>
                     <select name="license_alphabet_id" class="js-example-basic-single form-control lic_alphabet" title="{{ trans('module4.choose_alphabet') }}" style="width: 100%" required="">
                        <option value="" selected disabled hidden>Select License Alphabet </option>
                        
                     </select>
                  </div>
                  <div class="col-md-6 col-sm-6 mb-3">
                     <label for="validationCustom01">{{ trans('module4.license_no')}}</label>
                     <input type="text" name="license_no_present_number" class="form-control license_no lic_no" title="{{ trans('module4.enter_lic') }}" title1="{{ trans('module4.msg_lic_already_taken') }}" maxlength="5" minlength="4" required="" placeholder="Enter License Number Present">
                     <span id="err2" style="display:none; color:red;font-size: 12px;">This input value is not less than 1.</span>
                  </div>

                  <div class="col-md-6 col-sm-6 mb-3">
                     <label for="validationCustom01">{{ trans('module4.alert_lic_present') }}</label>
                     <input type="text" name="alert_license_present" class="form-control license_no alert_lic_no" title="{{ trans('module4.enter_alert_lic') }}" title1="{{ trans('module4.alert_lic_greater') }}" maxlength="5" minlength="4" required="" placeholder="Enter Alert License Present">
                     <span id="err2" style="display:none; color:red;font-size: 12px;">This input value is not less than 1.</span>
                  </div>
                  <div class="col-md-6 col-sm-6 mb-3">
                     <label for="validationCustom01">{{trans('common.status')}}</label>
                     <select name="status" class="form-control status" title="{{ trans('module4.select_status') }}">
                        <option value="" selected disabled>Choose Status </option>
                        @foreach(\App\Model\LicenseNumberPresent::getEnumList("status") as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
               <button type="submit" class="btn btn-success btn-sm" id="present-new">{{trans('button.save')}}</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal hide fade bigger" id="editModel" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h3 class="text-center">{{ trans('module4.edit_lic_present')}}</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="" method="POST" id="editform" name="editform">
            @method('PATCH')
            @csrf
            <input type="hidden" id="edit-id" value="">
            <div class="modal-body">
               <div class="form-row">
                  <div class="col-md-6 col-sm-6 mb-3">
                     <label for="validationCustom01">{{ trans('common.province')}}</label>
                     <select name="province_code" class="js-example-basic-single form-control province_code" id="edit-province" style="width: 100%" required="">
                        <option value="" selected disabled>Select Province </option>
                        @foreach($provinces as $pro)
                        <option value="{{$pro->province_code}}">{{$pro->name}}({{$pro->name_en}})</option>
                        @endforeach
                     </select>
                  </div>

                  <div class="col-md-6 col-sm-6 mb-3">
                     <label for="validationCustom01">{{ trans('module4.vehicle_kind')}}</label>
                     <select name="vehicle_kind_code" class="form-control vehicle_kind" required="">
                        <option value="" selected disabled>Select Vehicle Kind </option>
                        @foreach($veh_kinds as $kind)
                        <option value="{{$kind->vehicle_kind_code}}">{{$kind->name}}</option>
                        @endforeach
                     </select>
                     <input type="hidden" class="upd_kind" value="">
                  </div>
                  <div class="col-md-6 col-sm-6 mb-3">
                     <label for="validationCustom01">{{ trans('module4.vehicle_type')}}</label>
                     <select name="vehicle_type_group_id" class="form-control type_group" required="">
                        <option value="" selected disabled>Select Vehicle Type </option>
                        @foreach($vehicle_type_group as $vtype)
                        <option value="{{$vtype->id}}">{{$vtype->name}}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-md-6 col-sm-6 mb-3">
                     <label for="validationCustom01">{{ trans('module4.lic_alphabet')}}</label>
                     <select name="license_alphabet_id" class="js-example-basic-single form-control lic_alphabet" style="width: 100%" required="">
                     <option value="" selected disabled hidden>Select License Alphabet </option>   
                     <!-- @foreach($lic_alphas as $data)
                        <option value="{{$data->id}}">{{$data->name}}</option>
                        @endforeach -->
                     </select>
                  </div>
                  <div class="col-md-6 col-sm-6 mb-3">
                     <label for="validationCustom01">{{ trans('module4.license_no')}}</label>
                     <input type="text" name="license_no_present_number" class="form-control license_no lic_no" title1="{{ trans('module4.msg_lic_already_taken') }}" maxlength="5" minlength="4" required="" placeholder="Enter License Number Present">
                  </div>

                  <div class="col-md-6 col-sm-6 mb-3">
                     <label for="validationCustom01">{{ trans('module4.alert_lic_present') }}</label>
                     <input type="text" name="alert_license_present" class="form-control license_no alert_lic_no" maxlength="5" minlength="4" required="" placeholder="Enter Alert License Present">
                  </div>
                  <div class="col-md-6 col-sm-6 mb-3">
                     <label for="validationCustom01">{{trans('common.status')}}</label>
                     <select name="status" class="form-control status">
                        <option value="" selected disabled>Choose Status </option>
                        @foreach(\App\Model\LicenseNumberPresent::getEnumList("status") as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
               <button type="submit" class="btn btn-success btn-sm" id="present-update">{{trans('button.update')}}</button>
            </div>
         </form>
      </div>
   </div>
</div>