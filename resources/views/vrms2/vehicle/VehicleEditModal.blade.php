@php
$vkind = \App\Model\VehicleKind::whereStatus(1)->get();
$pcode = \App\Model\Province::whereStatus(1)->get();
$vtype = \App\Model\VehicleType::whereStatus(1)->get();
$vbrand = \App\Model\VehicleBrand::whereStatus(1)->get();
$mbrand = \App\Model\EngineBrand::whereStatus(1)->get();
$vsteering = \App\Model\Steering::whereStatus(1)->get();
$vgas = \App\Model\Gas::whereStatus(1)->get();
$vcolor = \App\Model\Color::whereStatus(1)->get();

$veh_doc = \App\Model\VehicleDocument::whereVehicleId($vehicle->id)->first();
//$app_doc = \App\Model\VehicleDocument::whereVehicleId($vehicle->id)->first();

//$app_doc = \App\Model\AppDocument::whereVehicleDetailId($vehicle->id)->pluck('filename','doc_type_id');

//print_r($app_doc);

$print_log = \App\Model\PrintLog::whereVehicleId($vehicle->id)->get();
$veh_logs = \App\Model\VehicleLog::whereVehicleId($vehicle->id)->get();
$activity_logs = \App\Model\LogTable::whereTableNameAndVehicleId('vehicles', $vehicle->id)->get();

$app_no = \App\Model\AppForm::get();
$districts = \App\Model\District::whereStatus(1)->whereProvinceCode($vehicle->province_code)->get();
$models = \App\Model\VehicleModel::whereStatus(1)->whereBrandId($vehicle->brand_id)->get();
$veh_tenant = \App\Model\VehicleTenant::whereVehicleId($vehicle->id)->first();
if($veh_tenant != null) {
$tenant_district =\App\Model\District::whereStatus(1)->whereProvinceCode($veh_tenant->province_code)->get();
}

$smart_card_code = \App\Model\SmartCardSetting::select('code','security_pin')->first();
$data = \App\Model\AppForm::whereVehicleId($vehicle->id)->orderBy('id', 'desc')->first();
$app_form_status_id = ($data == null) ? '' : $data->app_form_status_id;
$app_id = ($data == null) ? '' : $data->id;

$licenseNo = \App\Model\Vehicle::getLicenseNotCurrent($vehicle->id);
$engineNo = \App\Model\Vehicle::getEngineNotCurrent($vehicle->id);
$chassisNo = \App\Model\Vehicle::getChassisNotCurrent($vehicle->id);
@endphp

<div class="tab-content clearfix">
   <!--======================= Vehicle Info Tab Start =======================-->
   <div class="tab-pane active" id="vehicleInfo{{$vehicle->id}}">
      <form name="frmVinfo" id="frmVinfo">
         @csrf
         <input type="hidden" name="id" value="{{ $vehicle->id }}" id="vehicle_id">
         <input type="hidden" value="{{auth()->user()->user_status}}" id="user_status">
         <input type="hidden" name="engine_already_title" title="{{ trans('title.engine_already_take') }}">
         <input type="hidden" name="chassis_already_title" title="{{ trans('title.chassis_already_take') }}">
         <input type="hidden" name="license_no_already_title" title="{{ trans('title.license_already_take') }}">
         <input type="hidden" name="expire_title" title="{{ trans('title.issue_greater_expire') }}">

         <table class="form-table vehicle-form" style="margin-bottom: 10px;">
            <tbody>
               <tr>
                  <!--=============================== First Column width: 334px;===============================-->
                  <td style="padding-right:0px; width: 28%;">
                     <b style="color:red !important;font-weight:bold; float:left;min-width:119px !important;max-width:150px !important;">{{ trans('module4.division_number') }}<small>(ຂສ)</small>:</b>
                     <input class="w150 nvt-focused" style="width: 143px;float:left" id="division_no" name="division_no" value="{{$vehicle->division_no}}" onpaste="return false;">
                     <div>
                        @if($vehicle->division_no != null && $vehicle->province_no != null)
                        <a id="div_control_btn" data-id="{{$vehicle->id}}" class="disable-btn">A</a>
                        @else
                        <a id="div_control_btn" data-id="{{$vehicle->id}}" class="@if(isset($app_form_status_id)){{$app_form_status_id == 1 || $app_form_status_id == 2 ?'disable-btn':''}}@endif">A</a>
                        @endif
                     </div>
                     <span id="divError"></span>

                     <b style="color:red !important;font-weight:bold;min-width:113px !important;max-width:150px !important;">{{ trans('module4.province_number') }}<small>(<span id="edit_province_abb">{{ $vehicle->province->abb ??'' }}</span>)</small>:</b>
                     <input style="width: 149px;" name="province_no" id="province_no" value="{{$vehicle->province_no}}" f="222"><br>

                     <b>{{ trans('module4.number') }}:</b>
                     <input name="number" id="number" class="w120" value="{{$vehicle->number}}"><br>

                     <b>{{ trans('module4.vdvc_serial') }}:</b>
                     <input class="w120" value="{{ $vehicle->card_serial_no }}" id="card_serial_no" placeholder="" name="card_serial_no"><br>

                     <b>{{ trans('module4.issue_date') }}:</b>
                     <input class="w120 custom_date" name="issue_date" id="issue_date" value="{{$vehicle->issue_date}}" maxlength="10"><br>

                     <b>{{ trans('module4.expire_date') }}:</b>
                     <input class="w120 custom_date" name="expire_date" id="expire_date" value="{{$vehicle->expire_date}}" maxlength="10"><br>

                     <div>
                        <?php
                        $booking_license_no = \App\Helpers\Helper::getBuyLicNo($vehicle->id, $vehicle->vehicle_kind_code);
                        ?>
                        <b style="float:left;margin-right: 6px;">{{ trans('module4.pre_lic_no') }}:</b>
                        <input type="hidden" name="old_license" id="old_license" @if($vehicle->licence_no) value="{{ $vehicle->licence_no}}" @else value="" @endif>
                        <input type="text" name="licence_no" id="licence_no" title="{{ trans('title.enter_license') }}" style="width: 120px; float:left; vertical-align:top;text-align:center;color:#f00;font-weight:bold;font-size:18px !important" class="license_no" purpose_no="{{$vehicle->vehicle_kind_code}}" 
                        @if($vehicle->licence_no) value="{{ $vehicle->licence_no}}"
                        @elseif($booking_license_no != null) value="{{ $booking_license_no }}"
                        @else value="{{'0000'}}" @endif onpaste="return false;" >

                        <span style="color:#999">
                           @if(($vehicle->licence_no != null && $vehicle->licence_no != "0000") || ($booking_license_no != null)
                           || (($vehicle->vehicle_kind_code ?? '') == 5) || (($vehicle->vehicle_kind_code ?? '') == 8)
                           || ($app_form_status_id != 3 && $app_form_status_id != 4))
                           <a id="lic_control_btn" data-id="{{$vehicle->id}}" class="disable-btn">A</a>
                           @else
                           <a id="lic_control_btn" data-id="{{$vehicle->id}}" class="">A</a>
                           @endif
                           <span id="licError"></span>
                        </span><br>
                     </div>

                     <b>{{ trans('module4.purpose') }}:</b>
                     <input type="hidden" id="old_vehicle_kind_code" value="{{ $vehicle->vehicle_kind_code ?? '' }}">
                     <select class="w180" name="vehicle_kind_code" id="vehicle_kind" title="{{ trans('title.select_kind') }}" 
                     @if(isset($app_form_status_id)){{($app_form_status_id == 5 || $app_form_status_id == 6 
                        || $app_form_status_id == 7 || $app_form_status_id == 8) ?"disabled":""}}@endif>
                        <option value="" selected disabled hidden>--Select Purpose--</option>
                        @foreach($vkind as $vk)
                        <option value="{{$vk->vehicle_kind_code}}" {{$vk->vehicle_kind_code== $vehicle->vehicle_kind_code?"selected":""}}>{{$vk->vehicle_kind_code}}&nbsp;{{ $vk->name }}</option>
                        @endforeach
                     </select><br>

                     <b>{{ trans('common.name') }}:</b>
                     <input name="owner_name" id="owner_name" class="w180" value="{{$vehicle->owner_name}}" title="{{ trans('title.enter_owner') }}"><br>

                     <b>{{ trans('module4.owner_last_name') }}:</b>
                     <input name="owner_lastname" id="owner_lastname" class="w180" value="{{$vehicle->owner_lastname}}"><br>

                     <div>
                        <div style="float: left;">
                           <b style="width:90px !important;">{{ trans('module4.village_name') }}:</b>
                           <input style="margin-right: 3px;width:100px;" name="village_name" id="village_name" value="{{$vehicle->village_name}}" title="{{ trans('module4.village_name') }}">
                        </div>
                        <div>
                           <b style="width: 28px !important;">{{ trans('module4.vehicle_unit') }}:</b>
                           <input name="vehicle_unit" class="w30" id="vehicle_unit" value="{{$vehicle->vehicle_unit}}">
                           <a href="#" id="add_village" title="{{ trans('module4.add_village_name') }}"><img src="/images/plus_48.png" height="25px" width="25px"></a>
                        </div>
                     </div>

                     <b style="width:90px !important;">{{ trans('common.province') }}:</b>
                     <select name="province_code" id="province" class="w200 cls_province_code" title="{{ trans('title.select_province') }}" 
                     @if(isset($app_form_status_id)){{($app_form_status_id == 5 || $app_form_status_id == 6 
                        || $app_form_status_id == 7 || $app_form_status_id == 8) ?"disabled":""}}@endif>
                        <option value="" selected disabled hidden>--Select Province--</option>
                        @foreach($pcode as $pc)
                        <option value="{{$pc->province_code}}" {{$pc->province_code== $vehicle->province_code?"selected":""}}>{{ $pc->name }}</option>
                        @endforeach
                     </select><br>

                     <b style="width:90px !important;">{{ trans('common.district') }}:</b>
                     <select name="district_code" class="w200" id="district" title="{{ trans('title.select_district') }}">
                        <option value="" selected disabled hidden>--Select District--</option>
                        @foreach($districts as $dc)
                        <option value="{{$dc->district_code}}" {{$dc->district_code== $vehicle->district_code?"selected":""}}>{{ $dc->name }}</option>
                        @endforeach
                     </select>
                     <br>

                     <label style="width: 110px;">{{ trans('module4.vehicle_type') }}:</label>
                     <input type="hidden" id="old_vehicle_type_id" value="{{ $vehicle->vehicle_type_id ?? '' }}">
                     <select class="w180" name="vehicle_type_id" id="vehicle_type" title="{{ trans('title.select_vtype') }}">
                        <option value="" selected disabled hidden>Vehicle Type</option>
                        @foreach($vtype as $vt)
                        <option value="{{$vt->id}}" {{$vt->id== $vehicle->vehicle_type_id?"selected":""}}>{{ $vt->name }}</option>
                        @endforeach
                     </select><br />

                     <label style="width: 110px;">{{ trans('module4.steering') }}:</label>
                     <select class="w180" name="steering_id" id="steering_id">
                        <option value="" selected disabled hidden>--Select Steer--</option>
                        @foreach($vsteering as $vs)
                        <option value="{{$vs->id}}" {{$vs->id== $vehicle->steering_id?"selected":""}}>{{ $vs->name }}</option>
                        @endforeach
                     </select><br />

                     <label style="width: 110px;">{{ trans('module4.gas') }}:</label>
                     <select class="w180" name="gas_id" id="gas_id">
                        <option value="" selected disabled hidden>-- Select Gas--</option>
                        @foreach($vgas as $vg)
                        <option value="{{$vg->id}}" {{$vg->id == $vehicle->gas_id?"selected":""}}>{{ $vg->name }}</option>
                        @endforeach
                     </select><br />
                     <div id="license-checker" style="display:block;font-size:12px;text-shadow:none"></div>

                     <label style="width: 110px;">{{ trans('module4.vehicle_remark') }}:</label>
                     <input class="w180" name="note_id" id="note_id" style="color:red" value="{{$vehicle->note_id}}"><br>

                     <label style="width: 110px;">{{ trans('module4.vehicle_send') }}:</label>
                     <input class="w180" name="vehicle_send" value="{{$vehicle->vehicle_send}}" tabindex="-1" picktype="1" pick="=ນາລີ;ບົວພັນ"><br>

                     <label style="width:133px !important;">{{ trans('module4.inspect_place') }}:</label>
                     <input class="w150" name="inspect_place_id" id="inspect_place_id" value="{{$vehicle->inspectPlace->name ?? ''}}" disabled><br>

                     <label style="width:133px !important;">{{ trans('module4.inspect_result') }}:</label>
                     <input class="w150" name="inspect_result" id="inspect_result" value="{{$vehicle->inspect_result ?? '' }}" disabled><br>

                     <label style="width:133px !important;">{{ trans('module4.inspect_issue_date') }}:</label>
                     <input type="text" class="w150" value="{{ $vehicle->inspect_issue_date ?? '' }}" name="inspect_issue_date" disabled><br>

                     <label style="width:133px !important;">{{ trans('module4.inspect_expire_date') }}:</label>
                     <input type="text" class="w150" value="{{ $vehicle->inspect_expire_date ?? '' }}" name="inspect_expire_date" disabled><br>

                     <div class="row" style="padding-top:10px;padding-left: 15px;">
                        @can('Vehicle-Entry-Transfer')
                           @if((auth()->user()->user_status == 'all' && $app_form_status_id == 7)
                           || ($app_id == ''))
                           <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary transfer" href="#" data-id="{{$vehicle->id}}" onclick="transferModal(this)">{{ trans('button.transfer') }}</a>
                           @else
                           <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary disabled">{{ trans('button.transfer') }}</a>
                           @endif
                        @else
                           <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary disabled">{{ trans('button.transfer') }}</a>
                        @endcan

                        @can('Vehicle-Entry-Print-Certificate')
                           @if(auth()->user()->user_status == 'all' || auth()->user()->user_status == 'license_control'
                           || auth()->user()->user_status == 'card_print' || auth()->user()->user_status == 'book_print')
                              <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary" href="#" data-id="{{$vehicle->id}}" onclick="buttonModal(this, 'Document Certification')">{{ trans('button.document_certifiate') }}</a>
                           @else
                           <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary disabled">{{ trans('button.document_certifiate') }}</a>
                           @endif
                        @else
                           <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary disabled">{{ trans('button.document_certifiate') }}</a>
                        @endcan
                       
                        @can('Vehicle-Entry-Print-Certificate')
                           @if(auth()->user()->user_status == 'all' || auth()->user()->user_status == 'license_control'
                           || auth()->user()->user_status == 'card_print' || auth()->user()->user_status == 'book_print')
                           <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary" href="#" data-id="{{$vehicle->id}}" onclick="buttonModal(this, 'Certificate Used Instead')">{{ trans('button.certificate_used') }}</a>
                           @else
                           <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary disabled">{{ trans('button.certificate_used') }}</a>
                           @endif
                        @else 
                           <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary disabled">{{ trans('button.certificate_used') }}</a>
                        @endcan

                     </div>
                     <div class="row" style="padding-left: 15px;">
                        @can('Vehicle-Entry-Print-Certificate')
                           @if(auth()->user()->user_status == 'all' || auth()->user()->user_status == 'license_control'
                           || auth()->user()->user_status == 'card_print' || auth()->user()->user_status == 'book_print')
                           <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary" href="#" data-id="{{$vehicle->id}}" onclick="buttonModal(this, 'Elimination License')">{{ trans('button.eli_license') }}</a>
                           @else
                           <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary disabled">{{ trans('button.eli_license') }}</a>
                           @endif
                        @else 
                           <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary disabled">{{ trans('button.eli_license') }}</a>
                        @endcan

                        @can('Vehicle-Entry-Print-Certificate')
                           @if(auth()->user()->user_status == 'all' || auth()->user()->user_status == 'license_control'
                           || auth()->user()->user_status == 'card_print' || auth()->user()->user_status == 'book_print')
                           <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary" href="#" data-id="{{$vehicle->id}}" onclick="buttonModal(this, 'Certificate')">{{ trans('button.certificate') }}</a>
                           @else
                           <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary disabled">{{ trans('button.certificate') }}</a>
                           @endif
                        @else
                           <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary disabled">{{ trans('button.certificate') }}</a>
                        @endcan

                        @can('Vehicle-Entry-Print-Certificate')
                           @if(auth()->user()->user_status == 'all' || auth()->user()->user_status == 'license_control'
                           || auth()->user()->user_status == 'card_print' || auth()->user()->user_status == 'book_print')
                           <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary" href="#" data-id="{{$vehicle->id}}" onclick="buttonModal(this, 'Damaged Certificate')">{{ trans('button.damage_certifiate') }}</a>
                           @else
                           <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary disabled">{{ trans('button.damage_certifiate') }}</a>
                           @endif
                        @else
                           <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary disabled">{{ trans('button.damage_certifiate') }}</a>
                        @endcan
                     </div>
                  </td>
                  <!--============================ End of First Column ============================-->

                  <!--=============================== Second Column width: 285px;===============================-->
                  <td style="padding-right:0px; width: 26%;">
                     <b>{{ trans('module4.cylinder') }}:</b>
                     <input class="w120" name="cylinder" id="cylinder" value="{{$vehicle->cylinder}}" onpaste="return false;" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.keyCode == 45)"><br>

                     <b>{{ trans('module4.cc') }}:</b>
                     <input class="w120" name="cc" id="v-cc" value="{{$vehicle->cc}}" title="{{ trans('title.enter_cc') }}" onpaste="return false;" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.keyCode == 45)"><br>

                     <b style="width: 85px !important;">{{ trans('module4.color') }}:</b>
                     <select class="w150" name="color_id" id="color_id">
                        <option value="" selected disabled hidden>--Select Color--</option>
                        @foreach($vcolor as $vco)
                        <option value="{{$vco->id}}" {{$vco->id== $vehicle->color_id?"selected":""}}>{{ $vco->name }}</option>
                        @endforeach
                     </select>
                     <a href="#" id="add_color" title="{{ trans('module4.add_color') }}"><img src="/images/plus_48.png" height="25px" width="25px"></a><br />

                     <b style="width: 85px !important;">{{ trans('module4.brand') }}:</b>
                     <select style="width:182px;" name="brand_id" id="vbrand" title="{{ trans('title.select_brand') }}">
                        <option value="" selected disabled hidden>--Select Vehicle Brand--</option>
                        @foreach($vbrand as $vb)
                        <option value="{{$vb->id}}" {{$vb->id== $vehicle->brand_id?"selected":""}}>{{ $vb->name }}</option>
                        @endforeach
                     </select><br />

                     <b style="width: 85px !important;">{{ trans('module4.model') }}:</b>
                     <select class="w150" name="model_id" id="vmodel" title="{{ trans('title.select_modal') }}">
                        <option value="" selected disabled hidden>--Select Modal--</option>
                        @foreach($models as $vm)
                        <option value="{{$vm->id}}" {{$vm->id== $vehicle->model_id?"selected":""}}>{{ $vm->name }}</option>
                        @endforeach
                     </select>
                     <a href="#" id="add_vehicle_model" title="{{ trans('module4.add_model') }}"><img src="/images/plus_48.png" height="25px" width="25px"></a><br />

                     <b style="width: 85px !important;">{{ trans('module4.engine_no') }}:</b>
                     <input class="eng-validate engine_no" id="engine_no" style="width:182px;font-family:Saysettha OT !important;" name="engine_no" value="{{$vehicle->engine_no}}" title="{{ trans('title.enter_engine') }}" onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57)" onchange="this.value = this.value.replace(/[\;\:\.\,\/\\\s-]/g, &quot;&quot;).toUpperCase()" onpaste="return false;"><br>

                     <b style="width: 85px !important;">{{ trans('module4.chassis_no') }}:</b>
                     <input class="eng-validate chassis_no" id="chassis_no" style="width:182px;font-family:Saysettha OT !important;" name="chassis_no" value="{{$vehicle->chassis_no}}" title="{{ trans('title.enter_chassis') }}" onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57)" onchange="this.value = this.value.replace(/[\;\:\.\,\/\\\s-]/g, &quot;&quot;).toUpperCase()"><br>

                     <b>{{ trans('module4.width') }}:</b>
                     <input class="w120" name="width" id="width" value="{{$vehicle->width}}" title="{{ trans('title.enter_width') }}" onpaste="return false;" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.keyCode == 45)">
                     <span style="color:#ddd">ມມ</span><br>

                     <b>{{ trans('module4.long') }}:</b>
                     <input class="w120" name="long" id="long" value="{{$vehicle->long}}" title="{{ trans('title.enter_long') }}" onpaste="return false;" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.keyCode == 45)">
                     <span style="color:#ddd">ມມ</span><br>

                     <b>{{ trans('module4.height') }}:</b>
                     <input class="w120" name="height" id="height" value="{{$vehicle->height}}" title="{{ trans('title.enter_height') }}" onpaste="return false;" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.keyCode == 45)">
                     <span style="color:#ddd">ມມ</span><br>

                     <b>{{ trans('module4.seat') }}:</b>
                     <input class="w120" name="seat" id="seat" value="{{$vehicle->seat}}" onpaste="return false;" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.keyCode == 45)"><br>

                     <b>{{ trans('module4.weight') }}:</b>
                     <input class="w120" name="weight" id="weight" value="{{$vehicle->weight}}" title="{{ trans('title.enter_weight') }}" onpaste="return false;" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.keyCode == 45)"><br>

                     <b>{{ trans('module4.weight_filled') }}:</b>
                     <input class="w120" name="weight_filled" id="weight_filled" value="{{$vehicle->weight_filled}}" title="{{ trans('title.enter_weight_fill') }}" onpaste="return false;" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.keyCode == 45)"><br>

                     <b>{{ trans('module4.total_weight') }}:</b>
                     <input class="w120" name="total_weight" id="total_weight" value="{{$vehicle->total_weight}}" title="{{ trans('title.enter_total_weight') }}" onpaste="return false;" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.keyCode == 45)"><br>

                     <b>{{ trans('module4.axis') }}:</b>
                     <input class="w20" name="axis" id="axis" value="{{$vehicle->axis}}" title="{{ trans('title.enter_axis') }}" onpaste="return false;" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.keyCode == 45)">

                     <b class="w60" style="width: 60px !important">{{ trans('module4.wheel') }}:</b>
                     <input class="w20" name="wheels" id="wheels" value="{{$vehicle->wheels}}" title="{{ trans('title.enter_wheel') }}" onpaste="return false;" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.keyCode == 45)"><br>

                     <b>{{ trans('module4.year_mnf') }}:</b>
                     <input class="w120 date-year" name="year_manufacture" id="year_manufacture" value="{{$vehicle->year_manufacture}}"><br>

                     <b>{{ trans('module4.motor_brand') }}:</b>
                     <select style="width: 150px !important" name="motor_brand_id" id="motor_brand_id">
                        <option value="" selected disabled hidden>Motor Brand</option>
                        @foreach($mbrand as $mb)
                        <option value="{{$mb->id}}" {{$mb->id== $vehicle->motor_brand_id?"selected":""}}>{{ $mb->name }}</option>
                        @endforeach
                     </select>

                     <div>
                        <div style="float: left;">
                           <b>{{ trans('module4.lock_no') }}:</b>
                           <input class="w120" name="lock_no" id="lock_no" value="{{$vehicle->lock_no}}">
                        </div>
                        <div style="height: 10px;">
                           <input style="margin-left: 10px;" type="checkbox" name="locks" id="locks" {{$vehicle->locks == 1? "checked":""}}>
                        </div>
                     </div>

                     <b>{{ trans('module4.company_lock') }}:</b>
                     <input class="w120" name="companylock" id="companylock" value="{{$vehicle->companylock}}"><br>

                     <b>{{ trans('module4.start_lock') }}:</b>
                     <input class="w120" name="startlock" id="startlock" value="{{$vehicle->startlock}}"><br>

                     <b>{{ trans('module4.end_lock') }}:</b>
                     <input class="w120" name="endlock" id="endlock" value="{{$vehicle->endlock}}"><br>

                     <!-- Not Use -->
                     <div hideempty="">ອອກໃບຄໍາຮອງຍົກຍ້າຍເລກທີ: ວັນທີ: </div>
                     <div hideempty="">
                        <div style="vertical-align:top;position:relative" class="dIB f11" hideempty="">
                           <div style="position:absolute;width:900px;overflow-y:auto;font-size:15px;color:red;margin-top:2px;">
                              ຍົກຍ້າຍ ໄປແຂວງ
                              ເລກທີ່:
                              ຊື່ຜູ້ຮ້ອງຂໍ:
                           </div>
                        </div>
                     </div>
                     <div hideempty="" style="position:realtive">
                        <div style="background:#fff;color:#f00;border-radius:3px;font-size:12px;padding:5px;max-width:250px;position:absolute">
                           <b style="color:red !important;font-weight:bold">ລົບລ້າງ</b> ປ້າຍເລກທີ
                           ວັນທີ
                           ໄປປະເທດ
                           ອອກນອກ ປະເທດຂອງກົມຂົນສົ່ງ ສະບັບເລກທີ
                        </div>
                     </div>
                     <div hideempty="" style="position:realtive">
                        <div style="background:#f00;color:#fff;font-size:13px;padding:5px;max-width:250px;position:absolute">
                        </div>
                     </div>
                     <!-- Not Use -->

                     <div class="row" style="padding-top:10px;padding-left: 15px;">
                        <!-- <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary print-card @if(auth()->user()->user_status == 'card_print' || auth()->user()->user_status == 'all') {{$app_form_status_id == 4 || $app_form_status_id == 5 || $app_form_status_id == 6?'':'disabled'}} @else disabled @endif" href="scard:{{$vehicle->licence_no}}|{{$vehicle->province->old_name}}|{{ $vehicle->vehicle_kind->name??''}}|{{$vehicle->vehicle_kind->vehicle_kind_code}}|{{ $vehicle->division_no}}|{{$vehicle->province_no}}|{{$vehicle->owner_name}}|{{$vehicle->engine_no}}|{{$vehicle->chassis_no}}|{{$vehicle->vtype->name??''}}|{{ $vehicle->vbrand->name ?? ''}}|{{$vehicle->vmodel->name ?? ''}}|{{$vehicle->color->name??''}}|{{$vehicle->issue_date}}|{{$vehicle->expire_date}}|{{$vehicle->district->name??''}}|{{$vehicle->village_name}}|{{$smart_card_code->code ?? ''}}|{{auth()->user()->name}}|{{$smart_card_code->security_pin ?? ''}}|{{$vehicle->id}}|{{auth()->id()}}|{{$vehicle->province->abb}}|{{$vehicle->province->abb_en}}">{{ trans('button.card') }}</a> -->
                        <!-- <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary book-print @if(auth()->user()->user_status == 'book_print' || auth()->user()->user_status == 'all') {{$app_form_status_id == 5 || $app_form_status_id == 6?'':'disabled'}} @else disabled @endif" href="#" onclick="book(this)" data-id="{{$vehicle->id}}">{{ trans('button.book') }}</a> -->
                        <!-- <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary @if(auth()->user()->user_status == 'card_print' || auth()->user()->user_status == 'all' || auth()->user()->user_status == 'license_control') @else disabled @endif" href="#" data-id="{{$vehicle->id}}" onclick="printPink2(this)">{{ trans('button.pink1') }}</a> -->
                        <!-- <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary @if(auth()->user()->user_status == 'card_print' || auth()->user()->user_status == 'all' || auth()->user()->user_status == 'license_control') @else disabled @endif" href="#" data-id="{{$vehicle->id}}" onclick="pink2(this)">{{ trans('button.pink2') }}</a> -->
                        @can('Vehicle-Entry-Print-Card')
                        @if(auth()->user()->user_status == 'card_print' || auth()->user()->user_status == 'all')
                        @if($app_form_status_id == 4 || $app_form_status_id == 5 || $app_form_status_id == 6)
                        <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary" href="#" onclick="cardModal(this)" data-id="{{$vehicle->id}}">{{ trans('button.card') }}</a>
                        @else
                        <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary disabled">{{ trans('button.card') }}</a>
                        @endif
                        @else
                        <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary disabled">{{ trans('button.card') }}</a>
                        @endif
                        @else 
                        <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary disabled">{{ trans('button.card') }}</a>
                        @endcan

                        @can('Vehicle-Entry-Print-Book')
                           @if(auth()->user()->user_status == 'book_print' || auth()->user()->user_status == 'all')
                           @if($app_form_status_id == 5 || $app_form_status_id == 6)
                           <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary book-print" href="#" onclick="book(this)" data-id="{{$vehicle->id}}">{{ trans('button.book') }}</a>
                           @else
                           <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary disabled">{{ trans('button.book') }}</a>
                           @endif
                           @else
                           <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary disabled">{{ trans('button.book') }}</a>
                           @endif
                        @else
                        <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary disabled">{{ trans('button.book') }}</a>
                        @endcan

                        @can('Vehicle-Entry-Print-Pinkpaper1')
                           @if(auth()->user()->user_status == 'card_print' || auth()->user()->user_status == 'all' || auth()->user()->user_status == 'license_control')
                              @if($app_form_status_id != 7 && $app_form_status_id != 8)
                              <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary" href="#" onclick="pink1({{$vehicle->id}})">{{ trans('button.pink1') }}</a>
                              @else
                              <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary" href="#" data-id="{{$vehicle->id}}" onclick="pinkPaperAndNewFormModal(this, 'pink1')">{{ trans('button.pink1') }}</a>
                              @endif
                           @else
                           <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary disabled">{{ trans('button.pink1') }}</a>
                           @endif
                        @else
                           <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary disabled">{{ trans('button.pink1') }}</a>
                        @endcan

                        @can('Vehicle-Entry-Print-Pinkpaper2')
                           @if(auth()->user()->user_status == 'card_print' || auth()->user()->user_status == 'all' || auth()->user()->user_status == 'license_control')
                              @if($app_form_status_id != 7 && $app_form_status_id != 8)
                              <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary" href="#" onclick="pink2({{$vehicle->id}})">{{ trans('button.pink2') }}</a>
                              @else
                              <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary" href="#" data-id="{{$vehicle->id}}" onclick="pinkPaperAndNewFormModal(this, 'pink2')">{{ trans('button.pink2') }}</a>
                              @endif
                           @else
                           <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary disabled">{{ trans('button.pink2') }}</a>
                           @endif
                        @else
                           <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary disabled">{{ trans('button.pink2') }}</a>
                        @endcan

                        <div style="display: inline;">
                           <b style="width: 60px !important; margin-left: 5px;margin-top: 6px;">{{ trans('module4.send_license') }}:</b>
                           <input style="margin-top: 6px;" class="w90" name="send_license" id="send_license" value="{{$vehicle->send_license}}">
                        </div>
                        <input style="margin-top: 5px; margin-left: 10px;" type="checkbox" name="view" id="view" {{$vehicle->view == 1? "checked":""}} {{ auth()->user()->user_level == 'province'? "disabled":""}}><br>
                     </div>
                  </td>
                  <!--============================ End of Second Column ===========================-->

                  <!--================================ Third Column width: 245px;===============================-->
                  <td style="padding-right:0px; width: 23%;">
                     <span class="cDB">1.{{ trans('module4.import_permit') }}:</span>
                     <div style="height: 25px;">
                        <b>{{ trans('module4.hsny') }}:</b>
                        <input type="checkbox" name="import_permit_hsny" id="import_permit_hsny" {{$vehicle->import_permit_hsny == 1? "checked":""}}>
                     </div>

                     <b>{{ trans('module4.invest') }}:</b>
                     <input type="checkbox" name="import_permit_invest" id="import_permit_invest" {{$vehicle->import_permit_invest == 1? "checked":""}}><br>

                     <b>{{ trans('module4.veh_mod4_no') }}:</b>
                     <input class="w120" name="import_permit_no" id="import_permit_no" value="{{$vehicle->import_permit_no}}"><br>

                     <b>{{ trans('module4.veh_mod4_date') }}:</b>
                     <input class="w120 custom_date_vehicle" name="import_permit_date" id="import_permit_date" value="{{$vehicle->import_permit_date}}" maxlength="10"><br>

                     <span class="cDB">2.{{ trans('module4.indus_doc') }}:</span><br>
                     <b>{{ trans('module4.veh_mod4_no') }}:</b>
                     <input class="w120" name="industrial_doc_no" id="industrial_doc_no" value="{{$vehicle->industrial_doc_no}}"><br>

                     <b>{{ trans('module4.veh_mod4_date') }}:</b>
                     <input class="w120 custom_date_vehicle" name="industrial_doc_date" id="industrial_doc_date" value="{{$vehicle->industrial_doc_date}}" maxlength="10"><br>

                     <span class="cDB">3.{{ trans('module4.tech_doc') }}:</span><br>
                     <b>{{ trans('module4.veh_mod4_no') }}:</b>
                     <input class="w120" name="technical_doc_no" id="technical_doc_no" value="{{$vehicle->technical_doc_no}}"><br>

                     <b>{{ trans('module4.veh_mod4_date') }}:</b>
                     <input class="w120 custom_date_vehicle" name="technical_doc_date" id="technical_doc_date" value="{{$vehicle->technical_doc_date}}" maxlength="10"><br>

                     <span class="cDB">4.{{ trans('module4.commerce_permit') }}:</span><br>
                     <b>{{ trans('module4.commerce_permit') }}:</b>
                     <input class="w120" name="commerce_permit" id="commerce_permit" value="{{$vehicle->commerce_permit}}"><br>

                     <b>{{ trans('module4.veh_mod4_no') }}:</b>
                     <input class="w120" name="comerce_permit_no" id="comerce_permit_no" value="{{$vehicle->comerce_permit_no}}"><br>

                     <b>{{ trans('module4.veh_mod4_date') }}:</b>
                     <input class="w120 custom_date_vehicle" name="comerce_permit_date" id="comerce_permit_date" value="{{$vehicle->comerce_permit_date}}" maxlength="10"><br>

                     <div style="margin-top: 5px;">
                        <table class="table table-striped" style="width: 90%;">
                           <thead style="padding:0px;">
                              <tr>
                                 <th style="text-align: center;padding: 0px;">{{ trans('module4.print_log_no') }}:</th>
                                 <th style="padding: 0px;">{{ trans('module4._date') }}:</th>
                                 <th style="padding: 0px;">{{ trans('module4.print_log_user') }}:</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($vehicle->print_log as $item)
                              <tr>
                                 <td style="text-align: center;padding: 1px;">{{ $item->print_log_count ?? '' }}</td>
                                 <td style="padding: 1px;">
                                    <!-- {{ $item->print_log_datetime ?? '' }} -->
                                    <?php
                                    $date = strtotime($item->print_log_datetime ?? '');
                                    $print_date = date('d/m/y', $date); // $print_time = date('H:m:s A', $date);
                                    echo $print_date;
                                    ?>
                                 </td>
                                 <td style="padding: 1px;">{{ $item->user->Name ?? '' }}</td>
                              </tr>
                              @endforeach
                              <!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=1'>Del</a></td-->
                           </tbody>
                        </table>
                     </div>

                  </td>
                  <!--============================ End of Third Column ===========================-->

                  <!--======================== Fourth Column width: 275px;========================-->
                  <td style="width: 23%;">
                     <span class="cDB">5.{{ trans('module4.tax') }}:</span>
                     <br>
                     <div style="height: 25px;">
                        <b>{{ trans('module4.tax_10_40') }}:</b>
                        <input type="checkbox" name="tax_10_40" id="tax_10_40" {{$vehicle->tax_10_40 == 1?"checked":""}}>
                     </div>

                     <div style="height: 25px;">
                        <b>{{ trans('module4.tax_exam') }}:</b>
                        <input type="checkbox" name="tax_exam" id="tax_exam" {{$vehicle->tax_exam == 1?"checked":""}}>
                     </div>

                     <div style="height: 25px;">
                        <b>{{ trans('module4.tax12') }}:</b>
                        <input type="checkbox" name="tax_12" id="tax_12" {{$vehicle->tax_12 == 1?"checked":""}}>
                     </div>

                     <b>{{ trans('module4.tax50') }}:</b>
                     <input type="checkbox" name="tax_50" id="tax_50" {{$vehicle->tax_50 == 1?"checked":""}}><br>

                     <b>{{ trans('module4.veh_mod4_no') }}:</b>
                     <input class="w110" name="tax_no" id="tax_no" value="{{$vehicle->tax_no}}" title="{{ trans('title.enter_tax_no') }}"><br>

                     <b>{{ trans('module4.veh_mod4_date') }}:</b>
                     <input class="w110 custom_date_vehicle" name="tax_date" id="tax_date" value="{{$vehicle->tax_date}}" maxlength="10" title="{{ trans('title.enter_tax_date') }}"><br>

                     <span class="cDB">6.{{ trans('module4.tax_payment') }}:</span>
                     <div style="height: 25px;">
                        <b>{{ trans('module4.tax_receipt') }}:</b>
                        <input type="radio" name="tax_receipt" id="tax_receipt" {{$vehicle->tax_receipt == 1?"checked":""}} />
                     </div>

                     <div style="height: 25px;">
                        <b>{{ trans('module4.tax_permit') }}:</b>
                        <input type="radio" name="tax_permit" id="tax_permit" {{$vehicle->tax_permit == 1?"checked":""}} />
                     </div>

                     <b>{{ trans('module4.veh_mod4_no') }}:</b>
                     <input class="w110" name="tax_payment_no" id="tax_payment_no" value="{{$vehicle->tax_payment_no}}" title="{{ trans('title.enter_tax_payment_no') }}"><br>

                     <b>{{ trans('module4.veh_mod4_date') }}:</b>
                     <input class="w110 custom_date_vehicle" name="tax_payment_date" id="tax_payment_date" value="{{$vehicle->tax_payment_date}}" maxlength="10" title="{{ trans('title.enter_tax_payment_date') }}"><br>

                     <span class="cDB">7.{{ trans('module4.police_doc') }}:</span><br>
                     <b>{{ trans('module4.veh_mod4_no') }}:</b>
                     <input class="w110" name="police_doc_no" id="police_doc_no" value="{{$vehicle->police_doc_no}}"><br>

                     <b>{{ trans('module4.veh_mod4_date') }}:</b>
                     <input class="w110 custom_date_vehicle" name="police_doc_date" id="police_doc_date" value="{{$vehicle->police_doc_date}}" maxlength="10"><br>

                     <span class="cDB">8.{{ trans('module4.remark') }}:</span><br>
                     <textarea name="remark" id="remark" class="h50 nvt-focused" style="width:225px;color:red" f="222">{{$vehicle->remark}}</textarea><br>

                     <b> {{ trans('module4.unit') }}:</b>
                     <input class="w110" name="vehicle_units" style="color:red" value="{{$vehicle->vehicle_units}}"><br>

                     <b title="{{ trans('module4.predictor') }}">{{ trans('module4.predictor') }}:</b>
                     <input class="w110" name="vehicle_predictor" style="color:red" value="{{$vehicle->vehicle_predictor}}"><br>

                     <b style="width: 40px !important;">{{ trans('module4.phone') }}:</b>
                     <input name="vehicle_phone" style="width: 60px !important;" style="color:red" value="{{$vehicle->vehicle_phone}}">
                     <b style="width: 43px !important;">Fax:</b>
                     <input name="vehicle_fax" style="width: 60px !important;" style="color:red" value="{{$vehicle->vehicle_fax}}"><br>

                     <b>{{ trans('module4.activation_date') }}:</b>
                     <input class="w110" name="vehicle_activation" id="vehicle_activation" value="{{$vehicle->vehicle_activation}}">

                     <div class="row" style="padding-top:10px;padding-left: 15px;">
                        @if($vehicle->locks == 1 || auth()->user()->user_status != 'all')
                        <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary disabled">{{ trans('button.new_app_form') }}</a>
                        @else
                           @if($app_form_status_id != 7 && $app_form_status_id != 8)
                           <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary" href="#" onclick="pinkPaperAndNewFormModal(this, 'update')" data-id="{{$vehicle->id}}">{{ trans('button.new_app_form') }}</a>
                           @else
                           <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary" href="#" onclick="pinkPaperAndNewFormModal(this, 'new_form')" data-id="{{$vehicle->id}}">{{ trans('button.new_app_form') }}</a>
                           @endif
                        @endif

                        <button type="button" id="btnVinfoSave" class="button">{{trans('button.save')}}</button>
                        <input type="hidden" name="app_id" value="{{$app_id}}">
                        <input type="hidden" name="app_form_status_id" value="{{ $app_form_status_id ?? ''}}">
                        <!-- end button -->
                     </div>

                  </td>
                  <!--=========================== End of Fourth Column ==========================-->
               </tr>
            </tbody>
         </table>
      </form>
   </div>
   <!--======================== Vehicle Info Tab End ========================-->

   <!--==================== History of Change Tab Start =====================-->
   <div class="tab-pane" id="log{{$vehicle->id}}">
      <div class="row" style="margin:10px 15px 10px 30px;">
         <div class="col-md-4">
            <div class="row mb-3">
               <label style="width: 30%;">ລົດກໍລະນີພິເສດ:</label>
               <input style="width: 68%;" type="text" class="form-control" name="" id="" value="{{$vehicle->special ?? ''}}" readonly>
            </div>
            <div class="row mb-3">
               <label style="width: 30%;">ຄໍາອະທິບາຍເພີ່ມຕື່ມ:</label>
               <textarea style="width: 68%;height:100px !important;" class="form-control" name="" id="" readonly>{{$vehicle->special_remark ?? ''}}</textarea>
            </div>
            <div class="row mb-3">
               <label style="width: 30%;">ລົງວັນທີ່:</label>
               <input style="width: 68%;" type="text" class="form-control" name="" id="" value="{{$vehicle->special_date ?? ''}}" readonly>
            </div>

            <div class="row mb-3" style="height: 50px;"></div>

            <div class="row mb-3">
               <table class="table table-striped" style="width: 100%;min-height: 250px; margin-right: 10px;">
                  <thead style="padding:0px;">
                     <tr>
                        <th style="text-align: center;padding: 0px;width: 20%;">{{ trans('module4.print_log_no') }}:</th>
                        <th style="padding: 0px;width: 44%;">{{ trans('module4._date') }}:</th>
                        <th style="padding: 0px;width: 44%;">{{ trans('module4.print_log_user') }}:</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($vehicle->print_log as $item)
                     <tr>
                        <td style="text-align: center;padding: 1px;">{{ $item->print_log_count ?? '' }}</td>
                        <td style="padding: 1px;">
                           <!-- {{ $item->print_log_datetime ?? '' }} -->
                           <?php
                           $date = strtotime($item->print_log_datetime ?? '');
                           $print_date = date('d/m/y', $date); // $print_time = date('H:m:s A', $date);
                           echo $print_date;
                           ?>
                        </td>
                        <td style="padding: 1px;">{{ $item->user->Name ?? '' }}</td>
                     </tr>
                     @endforeach
                     <!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=1'>Del</a></td-->
                  </tbody>
               </table>
            </div>

         </div>

         <div class="col-md-8">
            <label style="width: 100%;">{{ $vehicle->log_activity }}</label>
         </div>
      </div>
   </div>
   <!--==================== History of Change Tab End =====================-->

   <!--======================== Document Tab Start ========================-->
   <div class="tab-pane" id="document{{$vehicle->id}}">
      <!-- document start -->
      <form id="myForm" class="form-inline" method="post" enctype="multipart/form-data" style="height: 450px; margin-bottom: 10px;">
         @csrf
         <input type="hidden" name="id" class="form-control" value="{{$vehicle->id}}" />
         <div class="col-sm-12 col-md-12 md-offset-12">

            <table class="table table-bordered" id="app-document">
               <thead>
                  <tr>
                     <th width="400">{{ trans('app_form.doc_type')}}</th>
                     <th>{{ trans('app_form.doc_filename')}}</th>
                     <th>{{ trans('common.action')}}</th>
                  </tr>
               </thead>
               <tbody>
                  <tr class="attach_doc">
                     <td>
                        <div>
                           <input type="hidden" name="doc_type_id[]" class="form-control" value="2" />
                           <h5>{{ trans('doc_type.lic_import_car') }}</h5>
                        </div>
                     </td>
                     <td>
                        <div>
                           @if(!empty($app_doc))
                           <input type="file" name="2" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" value="" id="filename"/>
                           @if($app_doc[2])
                           <input type="hidden" class="old_file" name="2" value="1">
                           <a href="{{asset('images/vehicle_doc/'.$vehicle->id.'/'.$app_doc[2])}}" target="_blank" class="filename_image">{{$app_doc[2]}}</a>                      
                           @endif
                           @else
                           <input type="file" name="2" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" id="filename"/>
                           @endif
                        </div>
                     </td>
                     <td><a href="" class="btn btn-danger btn-sm remove">X</a></td>
                  </tr>
                  <tr class="attach_doc">
                     <td>
                        <div>
                           <input type="hidden" name="doc_type_id[]" class="form-control" value="5" />
                           <h5>{{ trans('doc_type.import_good') }}</h5>
                        </div>
                     </td>
                     <td>
                        <div>
                           @if(!empty($app_doc))
                           <input type="file" name="5" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" value="" id="filename" />
                           @if($app_doc[5])
                           <input type="hidden" class="old_file" name="5" value="1">
                           <a href="{{asset('images/vehicle_doc/'.$vehicle->id.'/'.$app_doc[5])}}" target="_blank" class="filename_image">{{$app_doc[5]}}</a>
                           @endif
                           @else
                           <input type="file" name="5" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" id="filename" />
                           @endif
                        </div>
                     </td>
                     <td><a href="" class="btn btn-danger btn-sm remove">X</a></td>
                  </tr>
                  <tr class="attach_doc">
                     <td>
                        <div>
                           <input type="hidden" name="doc_type_id[]" class="form-control" value="4" />
                           <h5>{{ trans('doc_type.veh_lic_tech') }}</h5>
                        </div>
                     </td>
                     <td>
                        <div>
                           @if(!empty($app_doc))
                           <input type="file" name="4" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" value="" id="filename" />
                           @if($app_doc[4])
                           <input type="hidden" class="old_file" name="4" value="1">
                           <a href="{{asset('images/vehicle_doc/'.$vehicle->id.'/'.$app_doc[4])}}" target="_blank" class="filename_image">{{$app_doc[4]}}</a>
                           @endif
                           @else
                           <input type="file" name="4" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" id="filename" />
                           @endif
                        </div>
                     </td>
                     <td><a href="" class="btn btn-danger btn-sm remove">X</a></td>
                  </tr>

                  <tr class="attach_doc">
                     <td>
                        <div>
                           <input type="hidden" name="doc_type_id[]" class="form-control" value="3" />
                           <h5>{{ trans('doc_type.lic_ministry') }}</h5>
                        </div>
                     </td>
                     <td>
                        <div>
                           @if(!empty($app_doc))
                           <input type="file" name="3" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" value="" id="filename" />
                           @if($app_doc[3])
                           <input type="hidden" class="old_file" name="3" value="1">
                           <a href="{{asset('images/vehicle_doc/'.$vehicle->id.'/'.$app_doc[3])}}" target="_blank" class="filename_image">{{$app_doc[3]}}</a>
                           @endif
                           @else
                           <input type="file" name="3" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" id="filename" />
                           @endif
                        </div>
                     </td>
                     <td><a href="" class="btn btn-danger btn-sm remove">X</a></td>
                  </tr>
                  <tr class="attach_doc">
                     <td>
                        <div>
                           <input type="hidden" name="doc_type_id[]" class="form-control" value="6" />
                           <h5>{{ trans('doc_type.tax_return') }}</h5>
                        </div>
                     </td>
                     <td>
                        <div>
                           @if(!empty($app_doc))
                           <input type="file" name="6" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" value="" id="filename" />
                           @if($app_doc[6])
                           <input type="hidden" class="old_file" name="6" value="1">
                           <a href="{{asset('images/vehicle_doc/'.$vehicle->id.'/'.$app_doc[6])}}" target="_blank" class="filename_image">{{$app_doc[6]}}</a>
                           @endif
                           @else
                           <input type="file" name="6" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" id="filename" />
                           @endif
                        </div>
                     </td>
                     <td><a href="" class="btn btn-danger btn-sm remove">X</a></td>
                  </tr>
                  <tr class="attach_doc">
                     <td>
                        <div>
                           <input type="hidden" name="doc_type_id[]" class="form-control" value="7" />
                           <h5>{{ trans('doc_type.tax_relief') }}</h5>
                        </div>
                     </td>
                     <td>
                        <div>
                           @if(!empty($app_doc))
                           <input type="file" name="7" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" value="" id="filename" />
                           @if($app_doc[7])
                           <input type="hidden" class="old_file" name="7" value="1">
                           <a href="{{asset('images/vehicle_doc/'.$vehicle->id.'/'.$app_doc[7])}}" target="_blank" class="filename_image">{{$app_doc[7]}}</a>
                           @endif
                           @else
                           <input type="file" name="7" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" id="filename" />
                           @endif
                        </div>
                     </td>
                     <td><a href="" class="btn btn-danger btn-sm remove">X</a></td>
                  </tr>
                  <tr class="attach_doc">
                     <td>
                        <div>
                           <input type="hidden" name="doc_type_id[]" class="form-control" value="8" />
                           <h5>{{ trans('doc_type.record') }}</h5>
                        </div>
                     </td>
                     <td>
                        <div>
                           @if(!empty($app_doc))
                           <input type="file" name="8" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" value="" id="filename" />
                           @if($app_doc[8])
                           <input type="hidden" class="old_file" name="8" value="1">
                           <a href="{{asset('images/vehicle_doc/'.$vehicle->id.'/'.$app_doc[8])}}" target="_blank" class="filename_image">{{$app_doc[8]}}</a>
                           @endif
                           @else
                           <input type="file" name="8" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" id="filename" />
                           @endif
                        </div>
                     </td>
                     <td><a href="" class="btn btn-danger btn-sm remove">X</a></td>
                  </tr>
               </tbody>

            </table>
         </div>
         <div class="row mt-3 mx-0">
            <div class="col-md-9">
               <div class="form-row">
                  <label for="email">Location:</label>
                  <input type="text" type="text" class="form-control col-md-1" name="location" @if(!empty($app_doc)) value="{{ $veh_doc->location??''}}" @else value="" @endif>&nbsp;
                  <label for="email">Floor:</label>
                  <input type="text" type="text" class="form-control col-md-1" name="floor" @if(!empty($app_doc)) value="{{ $veh_doc->floor??''}}" @else value="" @endif>&nbsp;
                  <label for="email">Channel:</label>
                  <input type="text" type="text" class="form-control col-md-1" name="channel" @if(!empty($app_doc)) value="{{ $veh_doc->channel??''}}" @else value="" @endif>&nbsp;
                  <label for="email">Row:</label>
                  <input type="text" type="text" class="form-control col-md-1" name="row" @if(!empty($app_doc)) value="{{ $veh_doc->row??''}}" @else value="" @endif>&nbsp;
                  <label for="email">Note:</label>
                  <input type="text" type="text" class="form-control col-md-3" name="location_note" @if(!empty($app_doc)) value="{{ $veh_doc->location_note??''}}" @else value="" @endif>
               </div>
            </div>
            <div class="col-md-3 text-right">
               <a class="btn btn-info btn-sm" href="dscan:{{$vehicle->license_no ??''}}|{{$vehicle->id}}|{{$app_doc[2] ?? ''}}|{{$app_doc[5]?? ''}}|{{$app_doc[4]?? ''}}|{{$app_doc[3] ?? ''}}|{{$app_doc[6]}}|{{$app_doc[7]?? ''}}|{{$app_doc[8]?? ''}}">Scan Documents</a>

               <button id="btnDoc" class="btn btn-success btn-sm" onClick="return validate()">{{ trans('button.save')}}</button>
            </div>
         </div>
      </form>
      <!-- document end -->
   </div>
   <!--========================= Document Tab End =========================-->

   <!--========================= Tenant Tab Start =========================-->
   <div class="tab-pane ml-5" id="tenant-info{{$vehicle->id}}">
      <form name="frmTenant" id="frmTenant" enctype="multipart/form-data" style="height: 450px; margin-bottom: 10px;">
         @csrf
         <div class="row" style="margin-right:0px;">
            <div class="col-md-8 col-sm-8">
               <div class="row">
                  <div class="col-md-12 col-sm-12 mb-1">
                     <label for="validationCustom01">{{ trans('common.name')}}:</label>
                     <input type="hidden" name="vehicle_id" id="vehicle_id" value="{{$vehicle->id}}">
                     <input type="text" class="form-control" value="{{ $veh_tenant->tenant_name ?? ''}}" placeholder="Enter Name" name="tenant_name" required>
                  </div>
                  <div class="col-md-6 col-sm-6 mb-1">
                     <label for="validationCustom01">{{ trans('common.province')}}:</label>
                     <select name="province_code" class="form-control" id="tenant-province" required>
                        <option value="" disabled>Select Province</option>
                        @foreach($pcode as $pro)
                        <option value="{{$pro->province_code}}" @if($veh_tenant) {{$veh_tenant->province_code == $pro->province_code?'selected':''}} @endif>{{ $pro->name}}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-md-6 col-sm-6 mb-1">
                     <label for="validationCustom01">{{ trans('common.district')}}:</label>
                     @if($veh_tenant)
                     <select class="form-control" name="district_code" required="required" id="tenant-district">
                        <option value="" selected disabled hidden>--Select District--</option>
                        @foreach($tenant_district as $district)
                        <option value="{{$district->district_code}}" @if($veh_tenant) {{$veh_tenant->district_code == $district->district_code?'selected':''}} @endif>{{ $district->name}}</option>
                        @endforeach
                     </select>
                     @else
                     <select class="form-control" name="district_code" required="required" id="tenant-district">
                        <option value="" selected disabled hidden>--Select District--</option>
                     </select>
                     @endif
                  </div>
                  <div class="col-md-6 col-sm-6 mb-1">
                     <label for="validationCustom01">{{ trans('module4.village_name')}}:</label>
                     <input type="text" class="form-control" value="{{ $veh_tenant->village ?? ''}}" placeholder="Enter Village" name="village" required>
                  </div>
                  <div class="col-md-6 col-sm-6 mb-1">
                     <label for="validationCustom01">{{ trans('module4.tel')}}:</label>
                     <input type="text" class="form-control" value="{{ $veh_tenant->phone ?? ''}}" placeholder="Enter Phone" name="phone" required>
                  </div>
                  <div class="col-md-12 col-sm-12 mb-1">
                     <label for="validationCustom01">{{ trans('module4.note')}}:</label>
                     <textarea name="note" class="form-control" cols="3" rows="3">{{$veh_tenant->note ?? ''}}</textarea>
                  </div>
               </div>
            </div>
            <div class="col-md-4 col-sm-4 mt-5">
               @if($veh_tenant!=null)
               @if($veh_tenant->image != null)
               <img name="im" src="{{url('/images/tenant')}}/{{$veh_tenant->image}}" alter="no image" style="width:200px;"><br />
               @endif
               @endif
               <input type="file" name="image">
            </div>
         </div>
         <div class="col-md-12 col-sm-12 text-right mt-2">
            <button id="btnTenant" class="btn btn-success btn-sm">{{ trans('button.save')}}</button>
         </div>
      </form>
   </div>
   <!--========================== Tenant Tab End ==========================-->
</div>

<script type="text/javascript">
   var licenseData = {!!$licenseNo!!};
   var engineData = {!!json_encode($engineNo) !!};
   var chassisData = {!!json_encode($chassisNo) !!};

   $('input[name=tax_receipt]').on('change', function() {
      var n = $(this).val();
      $('#tax_permit').prop('checked', false);
   });

   $('input[name=tax_permit]').on('change', function() {
      var n = $(this).val();
      $('#tax_receipt').prop('checked', false);
   });

   $("#division_no, #province_no, #licence_no").keydown(function(event) {
      return false;
   });

   //============================== change issue date ======================================
   $("#issue_date").change(function() {
      var issue_date = $(this).val();

      var date_arr = issue_date.split("/");//30/03/2022
      var days = date_arr[0];
      var months = date_arr[1];
      var years = date_arr[2];

      //Add Year by Vehicle Kind
      var vehicle_kind = $("#vehicle_kind").val();
      if (vehicle_kind == 5 || vehicle_kind == 8) {
         var add_year = parseInt(years) + 2;
      } else {
         var add_year = parseInt(years) + 5;
      }
      
      //Expire Date
      var expire_date = new Date(months + "/" + days + "/" + add_year);  
      var sub_day = 1;//Subtract Day 1 according to customer request
      var new_expire_date = new Date(expire_date - sub_day * 24*60*60*1000);

      $("#expire_date").val([padTo2Digits(new_expire_date.getDate()),padTo2Digits(new_expire_date.getMonth() + 1),new_expire_date.getFullYear()].join('/'));
   });

   function padTo2Digits(num) {
      return num.toString().padStart(2, '0');
   }
   //=======================================================================================

   //============================== Vehicle Type Change Event ==============================
   //check vehicle_type and license no exist or not in license no present table
   $('#vehicle_type').change(function(e) {
      var vehicle_type = $(this).val();
      var vehicle_type_name = $(this).find("option:selected").text();
      var old_vehicle_type = $("#old_vehicle_type_id").val();
      var license_no = $("#licence_no").val();

      var check_vehicle_type = "{{url('/check-vehicle-type/')}}";
      if (vehicle_type != null && license_no != null) {
         $.ajax({
            type: "POST",
            url: check_vehicle_type + "/" + vehicle_type,
            data: {
               license_no: license_no
            },
            dataType: 'json',
            headers: {
               'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(data) {
               //console.log(data);
               if (data == "exist") {
                  alert("This License no \"" + license_no + "\" and vehicle type \"" + vehicle_type_name + "\" already exist.");
                  $(this).val($.data(this, 'old_vehicle_type_id')); //Currently it not work.                 
                  $("#licence_no").val("");
                  return false;
               }
            }
         });
      }
   });
   //=======================================================================================

   //============================== Vehicle Kind Change Event ==============================
   $("#vehicle_kind").change(function() {
      $("#licence_no").val("");
      var app_id = $('[name="app_id"]').val();
      var app_form_status_id = $('[name="app_form_status_id"]').val();
      var veh_kind = $(this).val();

      $("#licence_no").attr("purpose_no", veh_kind);

      if (app_id) {
         $.ajax({
            type: 'GET',
            url: '/getBuyLicenseNo/' + app_id,
            data: {
               vehicle_kind: veh_kind
            },
            success: function(data) {
               //console.log(data);
               if (data == "not-exist") {
                  if (veh_kind == 5 || veh_kind == 8 || app_form_status_id != 3 || app_form_status_id != 4) { //If veh_kind 5 or 8, no need to generate because of the format.
                     $("#lic_control_btn").addClass('disable-btn');
                  } else {
                     $("#lic_control_btn").removeClass("disable-btn");
                  }

               } else {
                  $("#licence_no").val(data);
                  $("#lic_control_btn").addClass('disable-btn');
               }
            }
         });
      }
   });
   //=======================================================================================

   //========================== Check space for Search License No. =========================
   $('#search_license').keyup(function() {
      var code = $(this).val().split(" ").join("");

      if (code.length > 0) {
         if (code.length == 5) {
            code = code.split(/(?=.{3}$)/).join(' ').replace(/[!@\/\\#+()$~%^&,`.'";|\[\]:*?<>{}=_-]/g, '');
         }else if (code.length == 6 || code.length == 7) {
            code = code.split(/(?=.{4}$)/).join(' ').replace(/[!@\/\\#+()$~%^&,`.'";|\[\]:*?<>{}=_-]/g, '');
         }else {
            code = code.split(/(?=.{4}$)/).join(' ').replace(/[!@\/\\#+()$~%^&,`.'";|\[\]:*?<>{}=_-]/g, '');
         }
      }

      $(this).val(code);
   });
   //=======================================================================================

   //================================== Search License No. =================================
   $('#search_license').keypress(function(event) {
      var keycode = (event.keyCode ? event.keyCode : event.which);
      if (keycode == '13') {
         var cur_vehicle_id = $("#vehicle_id").val();
         var cur_licence_no = $("#licence_no").val();
         var search_license_no = $("#search_license").val();

         if (cur_licence_no == search_license_no) {
            return false;
         }

         $.ajax({
            type: 'GET',
            url: '/searchLicenseNo',
            data: {
               license_no: search_license_no
            },
            success: function(data) {
               //console.log(data);
               if (data.status == "OK") {
                  var new_vehicle_id = data.vehicle_id;

                  $('#' + 'vModal' + cur_vehicle_id).modal('toggle');

                  vehicleModal(new_vehicle_id, "Search_License");
               } else {
                  alert(data.not_found_msg + " \"" + search_license_no + "\".");
               }
            },
            error: function(error) {
               //console.log(error.responseText);
               var err = JSON.parse(error.responseText);
               alert(err.message + "\n" + error.responseText);
            }
         });
      }
   });
   //=======================================================================================

   //================================== Village Name Keypress ==============================
   $('#village_name').keypress(function(event) {
      var keycode = (event.keyCode ? event.keyCode : event.which);
      if (keycode == '13') {
         saveData("Textbox");
      }
   });
   //=======================================================================================

   //======================== Add VillageName, Color and Model Modal =======================
   function addVehicleModal(s_type) {
      var title = "";
      if (s_type == "VillageName") {
         title = "{{ trans('module4.add_village_name') }}";
      } else if (s_type == "Color") {
         title = "{{ trans('module4.add_color') }}";
      } else {
         title = "{{ trans('module4.add_model') }}";
      }

      var id = $("#vehicle_id").val();

      var addModal = getAddVehicleModal(id);

      // Init the modal if it hasn't been already.
      if (!addModal) {
         addModal = initAddVehicleModal(id);
      }

      var html =
         '<div class="modal-header">' +
         '<h3 style="padding: 0px;text-align: center;width:100%;">' +
         '<span style="font-weight:bold;">' + title + '</span>' +
         '</h3>' +
         '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
         '<span aria-hidden="true">&times;</span>' +
         '</button>' +

         '</div>' +
         '<div class="modal-body add' + id + '" style="margin-top:0px;padding-top:0px;">' +
         /* modal body start */
         '<div class="text-center">' +
         '<div class="spinner-border text-primary" role="status" style="width: 4rem; height: 4rem;">' +
         '<span class="sr-only">Loading...</span>' +
         '</div>' +
         '</div>' +
         /* modal body end */
         '</div>';

      setAddVehicleModalContent(html, id);

      // Show the modal.
      $(addModal).modal('show');
      // ---------------
      $.ajax({
            url: "/add_vehicle_modal",
            type: 'GET',
            data: {
               vehicle_id: id,
               s_type: s_type
            },
            dataType: 'html'
         })
         .done(function(data) {
            $('.add' + id).html(data);
         })
         .fail(function() {
            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader').hide();
         });
      /* -------- */

      // Jquery draggable
      $('.modal-dialog').draggable({
         handle: ".modal-body, .modal-header"
      });

      $(addModal).on('hidden.bs.modal', function(e) {
         $(this).remove();
      });

   }

   function getAddVehicleModal(id) {
      return document.getElementById('addModal' + id);
   }

   function setAddVehicleModalContent(html, id) {
      getAddVehicleModal(id).querySelector('.modal-content').innerHTML = html;
   }

   function initAddVehicleModal(id) {
      var modal = document.createElement('div');
      modal.classList.add('modal', 'fade');
      modal.setAttribute('id', 'addModal' + id);
      modal.setAttribute('tabindex', '-1');
      modal.setAttribute('role', 'dialog');
      modal.setAttribute('data-backdrop', 'false');
      modal.setAttribute('data-backdrop', 'false');
      modal.setAttribute('data-keyboard', 'false');
      modal.setAttribute('aria-labelledby', 'transferModalLabel');
      modal.setAttribute('aria-hidden', 'true');
      modal.innerHTML =
         '<div class="modal-dialog" role="document" style="position: fixed;top: 200px;display: block;left: 30%;">' +
         '<div class="modal-content" style="width:450px;">' +
         '</div>' +
         '</div>';
      document.body.appendChild(modal);
      return modal;
   }
   //=======================================================================================

   //================= clear input file when click "X" for attached document ===============
   $(document).on('click', '.remove', function(e){  
      e.preventDefault();
      $(this).closest("tr").find("td:eq(1) .filename").val('');
      $(this).closest("tr").find("td:eq(1) .filename_image").text('');
      $(this).closest("tr").find("td:eq(1) .old_file").val(0);
   }); 
   //=======================================================================================
</script>
<script src="{{ asset('vrms2/js/numvalidate.js') }}"></script>
<script src="{{ asset('vrms2/js/filevalidate.js') }}"></script>
<script type="text/javascript" src="{{asset('vrms2/js/dropdownlist.js')}}"></script>
<script src="{{ asset('vrms2/js/vehicle-datepicker.js') }}"></script>
<script src="{{asset('vrms2/js/bootstrap-datepicker.min.js')}}"></script>