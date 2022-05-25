<div class="modal-header">
   <h3 class="text-center">{{trans('module4.edit_license_booking')}}</h3>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
   </button>
</div>
<div class="modal-body">
   <form action="{{ route('license-number-booking.update', $license_booking->id)}}" id="editform" name="editform" method="POST">
      @method('PUT')
      @csrf
      <input type="hidden" id="edit-id" value="{{ $license_booking->id }}">
      <input type="hidden" id="edit-app-id" value="{{ $license_booking->app_id }}">
      <div class="form-row">
         <div class="col-md-6 col-sm-6 mb-3">
            <label for="validationCustom01">{{trans('module4.vehicle_kind')}}:</label>
            <select name="vehicle_kind_code" id="vehicle_kind" class="form-control vehicle_kind" title1="{{ trans('module4.choose_vehicle_kind') }}" >
               <option value="" selected disabled>Select Vehicle Kind</option>
               @foreach($vehicle_kinds as $kind)
               <option value="{{ $kind->vehicle_kind_code}}" {{ $kind->vehicle_kind_code == $license_booking->vehicle_kind_code?'selected':''}}>{{ $kind->name }}</option>
               @endforeach
            </select>
            <input type="hidden" class="upd_kind" value="">
         </div>
         <div class="col-md-6 col-sm-6 mb-3">
            <label for="validationCustom01">{{ trans('module4.vehicle_type_group')}}</label>
            <select name="vehicle_type_group_id" id="vehicle_type_group_id" class="form-control type_group" title1="{{ trans('module4.choose_type_group') }}" required="">
               <option value="" selected disabled hidden>Select Vehicle Type Group</option>
               @foreach($vehicle_type_group as $type_group)
               <option value="{{$type_group->id}}" {{ $type_group->id == $license_booking->vehicle_type_group_id?'selected':''}}>{{$type_group->name}}</option>
               @endforeach
            </select>
         </div>

         <div class="col-md-6 col-sm-6 mb-3">
            <label for="validationCustom01"> {{trans('common.province')}}:</label>
            <select name="province_code" class="js-example-basic-single form-control province" style="width: 100%" title1="{{ trans('module4.select_province') }}" required>
               <option value="" selected disabled>Select Province</option>
               @foreach($provinces as $province)
               <option value="{{ $province->province_code}}" @if(auth()->user()->user_level == "province"){{$province->province_code == auth()->user()->user_info->province_code?'selected':'hidden'}} @endif {{$province->province_code == $license_booking->province_code?'selected':''}}>{{ $province->name }}({{ $province->name_en }})</option>
               @endforeach
            </select>
         </div>
         <div class="col-md-6 col-sm-6 mb-3">
            <label for="validationCustom01">{{trans('module4.license_no')}}.:</label>
            <input type="text" class="form-control license_no" id="upd_license_no" value="{{ $license_booking->license_no_book_number }}" maxlength="7" placeholder="" name="license_no_book_number" required="">
            <input type="hidden" id="origin_lic">
         </div>
         <label for="">{{trans('common.status')}}:</label>&nbsp; <span class="upd-status" style="font-size: 14px;"></span>

         <a class=" col-md-12 btn btn-info btn-sm " id="upd-check-status">{{ trans('module4.check')}}</a>
         <div class="col-md-12 mb-3">
            <label for="validationCustom01"> {{trans('module4.app_form')}}:</label>
            <select name="app_id" class="js-example-basic-single form-control app_no" style="width: 100%" required>
               <option value="" selected disabled>Select Application Form</option>
               @foreach($app_form as $app)
               <option value="{{ $app->id}}" {{$app->id == $license_booking->app_id?'selected':''}}>{{ $app->app_no }}</option>
               @endforeach
            </select>
         </div>
         <div class="col-md-12 mb-3">
            <label for="validationCustom01"> {{trans('module4.customer_name')}}:</label>
            <input type="text" class="form-control" id="validationCustom01" value="{{ $license_booking->customer_name}}" placeholder="" name="customer_name">
         </div>
         <div class="col-md-12 mb-3">
            <label for="validationCustom01">{{trans('module4.expire_date')}}:</label>
            <input type="text" class="form-control" id="date" value="{{$license_booking->expire_date}}" placeholder="" name="expire_date">
         </div>
      </div>

      <div class="modal-footer">
         <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
         <a class="btn btn-success btn-sm btn-save control-save" id="upd-control-save">{{trans('button.save')}}</a>
      </div>
   </form>
</div>

<script src="{{asset('vrms2/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('vrms2/js/vehicle-datepicker.js') }}"></script>
<script src="{{ asset('vrms2/js/app-form.js') }}"></script>