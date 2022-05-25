@php
$provinces = \App\Model\Province::ProvinceByCustomer();
@endphp
<div>
   <table class="form-table vehicle-form">
      <tbody>
         <tr>
        
            <td style="padding-right:0px; width: 334px;">
               <b style="color:red !important;font-weight:bold"> {{ trans('module4.division_number') }}<small>(ຂສ)</small>:</b> 
               <input class="w150 nvt-focused"  value="" focus="0" f="222" disabled>  
               <br>
               <b style="color:red !important;font-weight:bold">{{ trans('module4.province_number') }}<small>(<span id="province_abb"></span>)</small>:</b> 
               <input class="w150"  value="" f="222" disabled>
               <br>				
               <b>{{ trans('module4.number') }}:</b> 
               <input  class="w150" value="" f="222" disabled>
               <br>
               <!--<b>Encoder:</b> <input name='encoder' class='w50' value=''>-->
               <b> {{ trans('module4.vdvc_serial') }}:</b> 
               <input  class="w120" value="" f="222" disabled>
               <br>
               <b> {{ trans('module4.issue_date') }}:</b>  
               <input class="w120"  value="" f="222" disabled>
               <br>
               <b> {{ trans('module4.expire_date') }}:</b>
               <input class="w120"  value="" f="222" disabled>
               <br>
               <b> {{ trans('vehicle.pre_license') }}:</b>
               <input class="w120 license_no" id="new-license" title="{{ trans('title.enter_license') }}"  style="vertical-align:top;text-align:center;color:#f00;font-weight:bold;font-size:18px !important" name="licence_no_need"  f="222" value="" required><br>
               <b>{{ trans('module4.purpose') }}:</b>
               <select class="w120" f="222" name="vehicle_kind_code" id="vehicle_kind_code" title="{{ trans('title.select_kind') }}" required>
                  <option value="" selected disabled hidden>--Select Purpose--</option>
                  @foreach($data['kinds'] as $kind)
                  <option value="{{ $kind->vehicle_kind_code}}">{{$kind->vehicle_kind_code}} {{ $kind->name }}</option>
                  @endforeach
               </select>
               ເອກະຊົນລາວ<br>
               <b>{{ trans('module4.owner_name') }}:</b>
               <input name="owner_name" id="owner_name" title="{{ trans('title.enter_owner') }}" title="{{ trans('title.ener_owner') }}" class="w200" f="222" value=""><br>
               <div>
               <div style="float: left;">
                  <b>{{ trans('module4.village_name') }}:</b>
                  <input style="margin-right: 5px;" name="village_name" class="w120" id="customer_village" value="">
               </div>
               <div>
                  <b style="width: 28px !important;">{{ trans('module4.vehicle_unit') }}:</b>
                  <input type="number" name="unit" class="w40 unit" id="unit" value="">
               </div>
               </div>
             
               <b>{{ trans('common.province') }}:</b>
               <select name="province_code" id="province" title="{{ trans('title.select_province') }}"  class="js-example-basic-single w120"  required>
                  <option value="" selected disabled hidden>--Select Province--</option>
                  @foreach($provinces as $province)
                  <option value="{{ $province->province_code}}">{{ $province->name }}</option>
                  @endforeach
               </select>
              
               <br>
               <b>{{ trans('common.district') }}:</b> 
               <select name="district_code" title="{{ trans('title.select_district') }}"  class="w120 js-example-basic-single" id="district"  required>
                  <option value="" selected disabled hidden>--Select District--</option>
               </select>
               <br>
               <b>{{ trans('module4.vehicle_type') }}:</b> 
               <select class="js-example-basic-single w120 customer_vehicletype"  title="{{ trans('title.select_vtype') }}" name="vehicle_type_id">
                  <option value="" selected disabled hidden  >--{{ trans('vehicle.vehicle_type')}}--</option>
                  @foreach($data['types'] as $type)
                  <option value="{{ $type->id}}">{{ $type->name }}</option>
                  @endforeach
               </select>
               <br/>
               <b>{{ trans('module4.steering') }}:</b> 
               <select class="w120 steer " name="steering_id" required>
                  <option value="" selected disabled hidden  >--Select Steer--</option>
                  @foreach($data['steerings'] as $steer)
                  <option value="{{ $steer->id}}">{{ $steer->name }}</option>
                  @endforeach
               </select>
               <br/>
               <b>{{ trans('module4.gas') }}:</b> 
               <select class="w120 gas" name="gas_id">
                  <option value="" selected disabled hidden>-- Select Gas--</option>
                  @foreach($data['gases'] as $gas)
                  <option value="{{ $gas->id}}">{{ $gas->name }}</option>
                  @endforeach
               </select>
               <br/>
               <div id="license-checker" style="display:block;font-size:12px;text-shadow:none"></div>
               <b>{{ trans('module4.vehicle_remark') }}:</b>
               <input class="w220 f12 note" name="note" value="" style="width: 200px !important;"  f="222"><br>
               <b>{{ trans('module4.vehicle_send') }}:</b> 
               <input class="w120 vehicle_send" name="vehicle_send" value=""  f="222"><br>
              
            </td>
            <td style="padding-right:0px; width: 276px;">
               <b>{{ trans('module4.cylinder') }}:</b> 
               <input type="number" class="w120 cylinder" step="any" name="cylinder" f="222" min="0" value=""><br>
               <b>{{ trans('module4.cc') }}:</b> 
               <input class="w120 cc num-dash-validate" type="text"  title="{{ trans('title.enter_cc') }}"  min="0" name="cc" f="222" value=""><br>
               <b>{{ trans('module4.color') }}:</b> 
               <select class="w120 color js-example-basic-single" name="color_id" required>
                  <option value="" selected disabled hidden>-- Select Color--</option>
                  @foreach($data['colors'] as $color)
                  <option value="{{ $color->id}}">{{ $color->name }}</option>
                  @endforeach
               </select>
               <br/>
               <b>{{ trans('module4.brand') }}:</b> 
               <select class="w120 js-example-basic-single"  title="{{ trans('title.select_brand') }}" id="vbrand" name="brand_id"  required>
                  <option value="" selected disabled hidden  >--Select Vehicle Brand--</option>
                  @foreach($data['brands'] as $brand)
                  <option value="{{ $brand->id}}">{{ $brand->name }}</option>
                  @endforeach
               </select>
               <br/>
               <b>{{ trans('module4.model') }}:</b> 
               <select class="w120 js-example-basic-single" id="vmodel"  title="{{ trans('title.select_modal') }}" name="model_id"  required>
                  <option value="" selected disabled hidden>--Select Modal--</option>
                  @foreach($data['models'] as $model)
                  <option value="{{ $model->id}}">{{ $model->name }}</option>
                  @endforeach
               </select>
               <br/>
               <span>{{ trans('module4.engine_no') }}:</span>
               <input style="width:177px; font-size:16px !important;font-family:dev_font !important" title1="{{ trans('title.exist_engine') }}"  title="{{ trans('title.enter_engine') }}" name="engine_no" class="eng-validate engine_no" required><br>
               <span>{{ trans('module4.chassis_no') }}:</span> 
               <input style="width:177px;font-size:16px !important;font-family:dev_font !important" title1="{{ trans('title.exist_chassis') }}"  title="{{ trans('title.enter_chassis') }}" name="chassis_no" class="eng-validate chassis_no" required><br>
               <b>{{ trans('module4.width') }}:</b> 
               <input type="text" min="0" class="w120 width num-validate-vtype"  title="{{ trans('title.enter_width') }}" name="width" f="222" value=""> <span style="color:#ddd">ມມ</span><br>
               <b>{{ trans('module4.long') }}:</b> 
               <input type="text" min="0" class="w120 long num-validate-vtype" name="long"  title="{{ trans('title.enter_long') }}"  f="222" value=""> <span style="color:#ddd">ມມ</span><br>
               <b>{{ trans('module4.height') }}:</b> 
               <input type="text" min="0" class="w120 height num-validate-vtype" name="height"  title="{{ trans('title.enter_height') }}"  f="222" value=""> <span style="color:#ddd">ມມ</span><br>
               <b>{{ trans('module4.seat') }}:</b> 
               <input type="number" min="1" id="seat"  class="w120" step="any" name="seat" f="222" value="">
               <span id="err1" style="display:none; color:red;font-size: 12px;">This input value is not less than 1.</span><br>
               <b>{{ trans('module4.weight') }}:</b> 
               <input class="w120 weight num-dash-validate" type="text" min="0"  title="{{ trans('title.enter_weight') }}" name="weight"  f="222" value=""><br>
               <b>{{ trans('module4.weight_filled') }}:</b> 
               <input class="w120 weight_filled num-dash-validate" type="text" title="{{ trans('title.enter_weight_fill') }}" min="0" name="weight_filled" step="any" value="" f="222"><br>
               <b>{{ trans('module4.total_weight') }}:</b> 
               <input class="w120 total_weight num-dash-validate" type="text" min="0" value="" title="{{ trans('title.enter_total_weight') }}" id="total_weight" step="any" name="total_weight" f="222"><br>
               <b>{{ trans('module4.axis') }}:</b> 
               <input class="w20 axis" name="axis"  title="{{ trans('title.enter_axis') }}" type="number" step="any" min="0"  value="">
               <b class="w60" style="width: 60px !important">{{ trans('module4.wheel') }}:</b> 
               <input class="w20 wheels" name="wheels" f="222" title="{{ trans('title.enter_wheel') }}" value="" id="wheel"> <span id="err2" style="display:none; color:red;font-size: 12px;">This input value is not less than 1.</span><br>
               <b>{{ trans('module4.year_mnf') }}:</b> 
               <input class="w120 date-year" type="number" step="any" name="year_manufacture" id="year_manufacture"   f="222"><br>
               <b>{{ trans('module4.motor_brand') }}:</b> 
               <select class="w120 motor_brand_id js-example-basic-single" name="motor_brand_id" required>
                  <option value="" selected disabled hidden>--Motor Brand--</option>
                  @foreach($data['moter_brand'] as $motor)
                  <option value="{{ $motor->id}}">{{ $motor->name }}</option>
                  @endforeach
               </select>
               <br/>
              
            </td>
            <td style="padding-right:0px;  width: 234px;">
               <span class="cDB">1. {{ trans('module4.import_permit') }}:</span><br>
               <b>{{ trans('module4.hsny') }}:</b> <input type="checkbox"  f="222" v="" disabled><br>
               <b>{{ trans('module4.invest') }}:</b> <input type="checkbox" f="222" v="" disabled><br>
               <b>{{ trans('module4.veh_mod4_no') }}:</b> <input class="w120 import_permit_no" name="import_permit_no" f="222" value=""><br>
               <b><!--ລົງວັນທີ່:-->{{ trans('module4.veh_mod4_date') }}:</b>  <input class="w120 import_permit_date custom_date_vehicle"  name="import_permit_date" value=""  maxlength="10"><br>
               <span class="cDB">2. {{ trans('module4.indus_doc') }}:</span><br>
               <b><!--ເລກທີ່:-->{{ trans('module4.veh_mod4_no') }}:</b> <input class="w120 industrial_doc_no" name="industrial_doc_no" f="222" value=""><br>
               <b><!--ລົງວັນທີ່:-->{{ trans('module4.veh_mod4_date') }}:</b>  <input class="w120 industrial_doc_date custom_date_vehicle" name="industrial_doc_date"  maxlength="10"  value=""><br>
               <span class="cDB">3. {{ trans('module4.tech_doc') }}:</span><br>
               <b> {{ trans('module4.veh_mod4_no') }}:</b> <input class="w120 technical_doc_no" name="technical_doc_no" f="222" value=""><br>
               <b><!--ລົງວັນທີ່:-->{{ trans('module4.veh_mod4_date') }}:</b>  <input class="w120 technical_doc_date custom_date_vehicle" name="technical_doc_date"   maxlength="10" value=""><br>
               <span class="cDB">4. {{ trans('module4.commerce_permit') }}:</span><br>
               <b>{{ trans('module4.commerce_permit_title') }}:</b> <input class="w120 comerce_permit" type="text" name="comerce_permit"  f="222" value=""><br>
               <b>{{ trans('module4.veh_mod4_no') }}:</b> <input class="w120 comerce_permit_no" name="comerce_permit_no" f="222"><br>
               <b><!--ລົງວັນທີ່:-->{{ trans('module4.veh_mod4_date') }}:</b>  <input class="w120 comerce_permit_date custom_date_vehicle" name="comerce_permit_date" id="comerce_permit_date" value="" maxlength="10"><br>
</div>
</td>
<td style=" width: 270px;">
<span class="cDB">5. {{ trans('module4.tax') }}:</span>
<br>
 <b><!--ບ 10 ຫຼື ບ 40 --> {{trans('module4.tax_10_40')}}:</b> <input type="checkbox" f="222" v="" disabled><br>
<b><!-- ຍົກເວັ້ນພາສີ --> {{trans('module4.tax_exam')}}:</b> <input type="checkbox" f="222" v="" disabled><br>
<b><!--ບ 12 --> {{ trans('module4.tax12') }}:</b> <input type="checkbox"  f="222" v="" disabled><br>
<b><!--ບ 50 --> {{ trans('module4.tax50') }}:</b> <input type="checkbox"  f="222" v="" disabled><br>
<b><!--ເລກທີ່:-->{{ trans('module4.veh_mod4_no') }}:</b> <input class="w120 tax_no" title="{{ trans('title.enter_tax_no') }}" name="tax_no" f="222" value=""><br>
<b><!--ລົງວັນທີ່: -->{{ trans('module4.veh_mod4_date') }}:</b>  <input class="w120 tax_date custom_date_vehicle" title="{{ trans('title.enter_tax_date') }}" name="tax_date" maxlength="10"  value=""><br>
<span class="cDB">6. {{ trans('module4.tax_payment') }}:</span><br>
<b> {{ trans('module4.tax_receipt') }}:</b> <input type="checkbox"  f="222" v="" disabled><br>
<b>{{ trans('module4.tax_permit') }}:</b> <input type="checkbox"  f="222" v="" disabled><br>
<b><!--ເລກທີ່:-->{{ trans('module4.veh_mod4_no') }}:</b>  <input class="w120 tax_payment_no " title="{{ trans('title.enter_tax_payment_no') }}" name="tax_payment_no"  value=""><br>
<b>{{ trans('module4.veh_mod4_date') }}:</b> <input class="w120 tax_payment_date custom_date_vehicle" title="{{ trans('title.enter_tax_payment_date') }}" name="tax_payment_date"  maxlength="10" value="" ><br>
<span class="cDB">7. {{trans('module4.police_doc') }}:</span><br>
<b><!--ເລກທີ່:-->{{ trans('module4.veh_mod4_no') }}:</b>  <input class="w120 police_doc_no" name="police_doc_no" f="222" value=""><br>
<b>{{ trans('module4.veh_mod4_date') }}:</b>  <input class="w120 police_doc_date custom_date_vehicle" name="police_doc_date"   value=""  maxlength="10"><br>
<span class="cDB">8. {{ trans('module4.note1') }}:</span><br>
<textarea name="remark" class="h40 nvt-focused" style="width:225px;color:red" f="222"></textarea><br>
</td>
</tr>
<tr>
<td style="padding-right:0px; width: 276px;"></td>
<td style=" width: 270px;"></td>
<td style=" width: 270px;"></td>
<td>
</td>
</tr>
</tbody>
</table>
</div>