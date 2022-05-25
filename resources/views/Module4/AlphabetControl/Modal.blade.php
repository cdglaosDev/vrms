@php
$lic_alphabets = \App\Model\LicenseAlphabet::get();
$provinces = \App\Model\Province::GetProvince();
$type_groups = \App\Model\VehicleTypeGroup::whereNotIn('name', ["ALL", "ETC"])->whereStatus(1)->get();
$alphabet_controls = \App\Model\LicenseAlphabetControlStatus::get();
$veh_kinds = \App\Model\VehicleKind::whereStatus(1)->get();
@endphp
<div class="modal fade" id="addModel"  role="modal-dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <div class="col-md-11 text-center">
               <h3 class="text-center">{{trans('module4.add_alphabet_control')}}</h3>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="alert-duplicate" style="display:none">{{ trans('module4.duplicate_alphabet') }}</div>
         <form  action="{{route('alphabet-control.store')}}"  method="POST" id="newForm">
            @method('post')
            @csrf
            <div class="modal-body">
               <div class="form-row">
                  
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01"> {{ trans('common.province') }} :</label>
                     <select name="province_code" id="" class="form-control js-example-basic-single province" title="Please select province" style="width: 100%" required>
                        <option value="" selected disabled>Select Province</option>
                        @foreach($provinces as $province)
                        <option value="{{ $province->province_code }}" @if(auth()->user()->user_level == "province"){{$province->province_code == auth()->user()->user_info->province_code?'selected':'hidden'}} @endif>{{ $province->name }}({{ $province->name_en }})</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01">{{ trans('module4.vehicle_kind') }}:</label>
                     <select name="vehicle_kind_code" id="" class="form-control vehicle_kind" title="Please select vehicle kind" required>
                        <option value="" selected disabled>Select Vehicle Kind</option>
                        @foreach($veh_kinds as $kind)
                        <option value="{{ $kind->vehicle_kind_code }}">{{ $kind->name }}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01"> {{ trans('module4.vehicle_type_group') }}:</label>
                     <select name="vehicle_type_group_id" id="" class="form-control vtype" title="Please select vehicle type" required>
                        <option value="" selected disabled>Select Type group</option>
                        @foreach($type_groups as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-md-12 mb-3">
                     <a class="btn btn-primary check-alphabet">Check</a>
                  </div>
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01">{{ trans('module4.alphabet') }}:</label>
                     <select name="license_alphabet_id"  class="js-example-basic-single form-control lic-alphabet" style="width: 100%" title="Please select alphabet" title1="{{ trans('module4.duplicate_alphabet') }}"  required>
                        <option value="" selected disabled>Select Alphabet</option>
                        
                     </select>
                  </div>
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01">{{trans('common.status')}}:</label>
                     <select name="license_alphabet_control_status_id" class="form-control status" title="Please select status" required>
                        <option value="" selected disabled>Select Status</option>
                        @foreach($alphabet_controls as $control)
                        <option value="{{ $control->id }}">{{ $control->name }}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-md-12 mb-3">
                     <a class="btn btn-primary check-alphabet-next">Check Alphabet Next</a>
                  </div>
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01">{{ trans('module4.alphabet_next') }}:</label>
                     <select name="license_alphabet_next_id"  class="form-control js-example-basic-single alphabet_next" style="width:100%" title="Please select alphabet next" required>
                        <option value="" selected disabled>Select Alphabet Next</option>
                     </select>
                  </div>
                
               </div>
            </div>
            <input type="hidden" id="used_lic_alpha" value="">
            <div class="modal-footer">
               <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
               <button type="submit"  class="btn btn-success btn-sm btn-save" id="add-form">{{trans('button.save')}}</button>
            </div>
         </form>
      </div>
   </div>
</div>

