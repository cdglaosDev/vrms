<div class="tab-content clearfix">
    <!--=========================== Vehicle Info Start ===========================-->
    <div class="tab-pane active" id="vehicleInfo1">
        <form id="newVeh" action="" method="POST">
            <input type="hidden" id="csrf" value="<?php echo csrf_token(); ?>">
            <table class="form-table vehicle-form" style="margin-bottom: 10px;">
                <tbody>
                    <tr>
                        <!--=============================== First Column ===============================-->
                        <td style="padding-right:0px; width: 334px;">
                            <b style="color:red !important;font-weight:bold;min-width:113px !important;max-width:150px !important;"> {{ trans('module4.division_number') }}<small>(ຂສ)</small>:</b>
                            <input class="w150 nvt-focused" value="" focus="0" disabled><br>

                            <b style="color:red !important;font-weight:bold;min-width:113px !important;max-width:150px !important;">{{ trans('module4.province_number') }}<small>(ກພ)</small>:</b>
                            <input class="w150" value="" disabled><br>

                            <b>{{ trans('module4.number') }}:</b>
                            <input class="w120" value="" disabled><br>

                            <b> {{ trans('module4.vdvc_serial') }}:</b>
                            <input class="w120" value="" disabled><br>

                            <b> {{ trans('module4.issue_date') }}:</b>
                            <input class="w120" value="" disabled><br>

                            <b> {{ trans('module4.expire_date') }}:</b>
                            <input class="w120" value="" disabled><br>

                            <b style="float:left;margin-right: 6px;">{{ trans('module4.pre_lic_no') }}:</b>
                            <input type="text" name="licence_no" style="width: 120px; float:left; vertical-align:top;text-align:center;color:#f00;font-weight:bold;font-size:18px !important" class="license_no w120" id="licence_no" placeholder="" name="licence_no" onpaste="return false;"><br>

                            <b>{{ trans('module4.purpose') }}:</b>
                            <select class="w120" name="vehicle_kind_code" id="vehicle_kind_code">
                                <option value="" selected disabled hidden>--Select Purpose--</option>
                                @foreach($data['kinds'] as $kind)
                                <option value="{{$kind->vehicle_kind_code}}">{{ $kind->name }}&nbsp;({{$kind->name_en}})</option>
                                @endforeach
                            </select>ເອກະຊົນລາວ<br>

                            <b>{{ trans('module4.owner_name') }}:</b>
                            <input name="owner_name" id="owner_name" title="{{ trans('title.enter_owner') }}" class="w200" value=""><br>

                            <b>{{ trans('module4.village_name') }}:</b>
                            <input name="village_name" class="w200" id="customer_village" picktype="1" value=""><br>

                            <b>{{ trans('common.province') }}:</b>
                            <select name="province_code" id="province" title="{{ trans('title.select_province') }}" class="js-example-basic-single w200" required>
                                <option value="" selected disabled hidden>--Select Province--</option>
                                @foreach($data['provinces'] as $province)
                                <option value="{{ $province->province_code}}">{{ $province->name }}&nbsp;({{$province->name_en}})</option>
                                @endforeach
                            </select><br>

                            <b>{{ trans('common.district') }}:</b>
                            <select name="district_code" title="{{ trans('title.select_district') }}" class="js-example-basic-single w200" id="district" required>
                                <option value="" selected disabled hidden>--Select District--</option>
                                @foreach($data['districts'] as $district)
                                <option value="{{ $district->district_code}}">{{ $district->name }}&nbsp;({{$district->name_en}})</option>
                                @endforeach
                            </select>
                            <br>
                            <b>{{ trans('module4.vehicle_type') }}:</b>
                            <select class="js-example-basic-single w200 customer_vehicletype" title="{{ trans('title.select_vtype') }}" name="vehicle_type_id">
                                <option value="" selected disabled hidden>--{{ trans('vehicle.vehicle_type')}}--</option>
                                @foreach($data['types'] as $type)
                                <option value="{{ $type->id}}">{{ $type->name }}&nbsp;({{$type->name_en}})</option>
                                @endforeach
                            </select><br />

                            <label style="min-width:105px !important;max-width:150px !important;">{{ trans('module4.steering') }}:</label>
                            <select class="w150 steer" name="steering_id" required>
                                <option value="" selected disabled hidden>--Select Steer--</option>
                                @foreach($data['steerings'] as $steer)
                                <option value="{{ $steer->id}}">{{ $steer->name }}&nbsp;({{$steer->name_en}})</option>
                                @endforeach
                            </select><br />

                            <b>{{ trans('module4.gas') }}:</b>
                            <select class="w150 gas" name="gas_id">
                                <option value="" selected disabled hidden>-- Select Gas--</option>
                                @foreach($data['gases'] as $gas)
                                <option value="{{ $gas->id}}">{{ $gas->name }}</option>
                                @endforeach
                            </select><br />

                            <div id="license-checker" style="display:block;font-size:12px;text-shadow:none"></div>
                            <b>{{ trans('module4.vehicle_remark') }}:</b>
                            <input class="w220 f12 remark" name="remark" style="color:red; width: 200px !important;" tabindex="-1" f="222"><br>

                            <b>{{ trans('module4.vehicle_send') }}:</b>
                            <input class="w120" tabindex="-1" picktype="1" pick="=ນາລີ;ບົວພັນ" f="222"><br>

                            <div style="font-size:9px">
                                D5: <input class="f9" style="width: 43px;" tabindex="-1" value="">
                                D6: <input class="f9" style="width: 43px;" tabindex="-1" value="">
                                D2: <input class="f9" style="width: 43px;" tabindex="-1" value="">
                                D4: <input class="f9" style="width: 43px;" tabindex="-1" value="">
                            </div>

                        </td>
                        <!--============================ End of First Column ============================-->

                        <!--=============================== Second Column ===============================-->
                        <td style="padding-right:0px; width: 285px;">
                            <b>{{ trans('module4.cylinder') }}:</b>
                            <input type="number" class="w120 cylinder" step="any" name="cylinder" f="222" min="0" value=""><br>

                            <b>{{ trans('module4.cc') }}(cc):</b>
                            <input class="w120 cc num-dash-validate" type="text" title="{{ trans('title.enter_cc') }}" min="0" name="cc" f="222" value=""><br>

                            <b>{{ trans('module4.color') }}:</b>
                            <select class="w160 color js-example-basic-single" name="color_id" required>
                                <option value="" selected disabled hidden>--Select Color--</option>
                                @foreach($data['colors'] as $color)
                                <option value="{{ $color->id}}">{{ $color->name }}&nbsp;({{$color->name_en}})</option>
                                @endforeach
                            </select><br />

                            <b>{{ trans('module4.brand') }}:</b>
                            <select class="w160 js-example-basic-single" title="{{ trans('title.select_brand') }}" id="vbrand" name="brand_id" required>
                                <option value="" selected disabled hidden>--Select Vehicle Brand--</option>
                                @foreach($data['brands'] as $brand)
                                <option value="{{ $brand->id}}">{{ $brand->name }}</option>
                                @endforeach
                            </select><br />

                            <b>{{ trans('module4.model') }}:</b>
                            <select class="w160 js-example-basic-single" id="vmodel" title="{{ trans('title.select_modal') }}" name="model_id" required>
                                <option value="" selected disabled hidden>--Select Modal--</option>
                                @foreach($data['models'] as $model)
                                <option value="{{ $model->id}}">{{ $model->name }}</option>
                                @endforeach
                            </select><br />

                            <b style="width: 85px !important;">{{ trans('module4.engine_no') }}:</b>
                            <input style="width:182px;font-size:16px !important;font-family:dev_font !important" class="eng-validate engine_no" id="engine_no" name="engine_no" title="{{ trans('title.enter_engine') }}" onchange="this.value = this.value.replace(/[\;\:\.\,\/\\\s]/g, &quot;&quot;).toUpperCase()" onpaste="return false;"><br>

                            <b style="width: 85px !important;">{{ trans('module4.chassis_no') }}:</b>
                            <input style="width:182px;font-size:16px !important;font-family:dev_font !important" title="{{ trans('title.enter_chassis') }}" class="eng-validate chassis_no" id="chassis_no" name="chassis_no" onchange="this.value = this.value.replace(/[\;\:\.\,\/\\\s]/g, &quot;&quot;).toUpperCase()"><br>

                            <b>{{ trans('module4.width') }}:</b>
                            <input type="text" min="0" class="w120 width num-validate-vtype" title="{{ trans('title.enter_width') }}" name="width" f="222" value=""> <span style="color:#ddd">ມມ</span><br>

                            <b>{{ trans('module4.long') }}:</b>
                            <input type="text" min="0" class="w120 long num-validate-vtype" name="long" title="{{ trans('title.enter_long') }}" f="222" value=""> <span style="color:#ddd">ມມ</span><br>

                            <b>{{ trans('module4.height') }}:</b>
                            <input type="text" min="0" class="w120 height num-validate-vtype" name="height" title="{{ trans('title.enter_height') }}" f="222" value=""> <span style="color:#ddd">ມມ</span><br>

                            <b>{{ trans('module4.seat') }}:</b>
                            <input type="number" min="1" id="seat" class="w120" step="any" name="seat" f="222" value="">

                            <span id="err1" style="display:none; color:red;font-size: 12px;">This input value is not less than 1.</span><br>

                            <b>{{ trans('module4.weight') }}:</b>
                            <input class="w120 weight num-dash-validate" type="text" min="0" title="{{ trans('title.enter_weight') }}" name="weight" f="222" value=""><br>

                            <b>{{ trans('module4.weight_filled') }}:</b>
                            <input class="w120 weight_filled num-dash-validate" type="text" title="{{ trans('title.enter_weight_fill') }}" min="0" name="weight_filled" step="any" value="" f="222"><br>

                            <b>{{ trans('module4.total_weight') }}:</b>
                            <input class="w120 total_weight num-dash-validate" type="text" min="0" value="" title="{{ trans('title.enter_total_weight') }}" id="total_weight" step="any" name="total_weight" f="222"><br>

                            <b>{{ trans('module4.axis') }}:</b>
                            <input class="w20 axis" name="axis" f="222" type="number" step="any" min="0" value="">

                            <b class="w60" style="width: 60px !important">{{ trans('module4.wheel') }}:</b>
                            <input class="w20 wheels" name="wheels" f="222" value="" id="wheel"> <span id="err2" style="display:none; color:red;font-size: 12px;">This input value is not less than 1.</span><br>

                            <b>{{ trans('module4.year_mnf') }}:</b>
                            <input class="w120 date-year" type="number" step="any" name="year_manufacture" id="year_manufacture" f="222"><br>

                            <b>{{ trans('module4.motor_brand') }}:</b>
                            <select class="w160 motor_brand_id js-example-basic-single" name="motor_brand_id" required>
                                <option value="" selected disabled hidden>--Motor Brand--</option>
                                @foreach($data['moter_brand'] as $motor)
                                <option value="{{ $motor->id}}">{{ $motor->name }}</option>
                                @endforeach
                            </select>

                            <div>
                                <a href="#" class="button f10" tabindex="-1" loadto="center" load="forms/temporary-vehicle-form" note="0394290769b1e2f695f37fdc4d9aecd4">ພິມໃບຊົ່ວຄາວ</a>
                            </div>
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
                        </td>
                        <!--============================ End of Second Column ===========================-->

                        <!--================================ Third Column ===============================-->
                        <td style="padding-right:0px;  width: 245px;">
                            <span class="cDB">1.{{ trans('module4.import_permit') }}:</span>
                            <div style="height: 25px;">
                                <b>{{ trans('module4.hsny') }}:</b>
                                <input type="checkbox" name="import_permit_hsny" id="import_permit_hsny">
                            </div>

                            <b>{{ trans('module4.invest') }}:</b>
                            <input type="checkbox" name="import_permit_invest" id="import_permit_invest"><br>

                            <b>{{ trans('module4.veh_mod4_no') }}:</b>
                            <input class="w120" name="import_permit_no" id="import_permit_no"><br>

                            <b>{{ trans('module4.veh_mod4_date') }}:</b>
                            <input class="w120" name="import_permit_date" id="import_permit_date"><br>

                            <span class="cDB">2.{{ trans('module4.indus_doc') }}:</span><br>
                            <b>{{ trans('module4.veh_mod4_no') }}:</b>
                            <input class="w120" name="industrial_doc_no" id="industrial_doc_no"><br>

                            <b>{{ trans('module4.veh_mod4_date') }}:</b>
                            <input class="w120" name="industrial_doc_date" id="industrial_doc_date"><br>

                            <span class="cDB">3.{{ trans('module4.tech_doc') }}:</span><br>
                            <b>{{ trans('module4.veh_mod4_no') }}:</b>
                            <input class="w120" name="technical_doc_no" id="technical_doc_no"><br>

                            <b>{{ trans('module4.veh_mod4_date') }}:</b>
                            <input class="w120" name="technical_doc_date" id="technical_doc_date"><br>

                            <span class="cDB">4.{{ trans('module4.commerce_permit') }}:</span><br>
                            <b>{{ trans('module4.commerce_permit') }}:</b>
                            <input class="w120" name="commerce_permit" id="commerce_permit"><br>

                            <b>{{ trans('module4.veh_mod4_no') }}:</b>
                            <input class="w120" name="comerce_permit_no" id="comerce_permit_no"><br>

                            <b>{{ trans('module4.veh_mod4_date') }}:</b>
                            <input class="w120" name="comerce_permit_date" id="comerce_permit_date"><br>

                        </td>
                        <!--============================ End of Third Column ===========================-->

                        <!--============================== Foourth Column =============================-->
                        <td style=" width: 275px;">
                            <span class="cDB">5.{{ trans('module4.tax') }}:</span><br>
                            <!-- <div style="position:absolute;margin-left:140px;margin-top:-20px;background:#eef;font-size:13px;padding:10px">
                           <i>ສົ່ງທາງ Online</i><br>
                           <i>ຈາກ:</i> dai<br>
                           <i>ວັນທີ:</i> 06/10/2021<br>
                           <i>ເຈົ້າໜ້າທີ່ກວດກາ:</i> ຍັງ
                        </div>
                        <div style="position:absolute;margin-left:245px;margin-top:-20px;background:#5f5;font-size:13px;padding:10px">
                           ຈ່າຍ/ສົ່ງແລ້ວວັນທີ:<br>
                        </div>
                        <br> -->

                            <div style="height: 25px;">
                                <b>{{ trans('module4.tax_10_40') }}:</b>
                                <input type="checkbox" name="tax_10_40" id="tax_10_40">
                            </div>

                            <div style="height: 25px;">
                                <b>{{ trans('module4.tax_exam') }}:</b>
                                <input type="checkbox" name="tax_exam" id="tax_exam">
                            </div>

                            <div style="height: 25px;">
                                <b>{{ trans('module4.tax12') }}:</b>
                                <input type="checkbox" name="tax_12" id="tax_12">
                            </div>

                            <b>{{ trans('module4.tax50') }}:</b>
                            <input type="checkbox" name="tax_50" id="tax_50"><br>

                            <b>{{ trans('module4.veh_mod4_no') }}:</b>
                            <input class="w120" name="tax_no" id="tax_no"><br>

                            <b>{{ trans('module4.veh_mod4_date') }}:</b>
                            <input class="w120" name="tax_date"><br>

                            <span class="cDB">6.{{ trans('module4.tax_payment') }}:</span>
                            <div style="height: 25px;">
                                <b>{{ trans('module4.tax_receipt') }}:</b>
                                <input type="checkbox" name="tax_receipt">
                            </div>

                            <b>{{ trans('module4.tax_permit') }}:</b>
                            <input type="checkbox" name="tax_permit"><br>

                            <b>{{ trans('module4.veh_mod4_no') }}:</b>
                            <input class="w120" name="tax_payment_no" id="tax_payment_no"><br>

                            <b>{{ trans('module4.veh_mod4_date') }}:</b>
                            <input class="w120" name="tax_payment_date" id="tax_payment_date"><br>

                            <span class="cDB">7.{{ trans('module4.police_doc') }}:</span><br>
                            <b>{{ trans('module4.veh_mod4_no') }}:</b>
                            <input class="w120" name="police_doc_no" id="police_doc_no"><br>

                            <b>{{ trans('module4.veh_mod4_date') }}:</b>
                            <input class="w120" name="police_doc_date" id="police_doc_date"><br>

                            <span class="cDB">8.{{ trans('module4.note1') }}:</span><br>
                            <textarea name="note" id="note" class="h50 nvt-focused" style="width:225px;color:red"></textarea><br>

                            <b style="width: 40px !important;">{{ trans('module4.unit') }}:</b>
                            <input name="vehicle_units" tabindex="-1" style="width: 70px !important;" style="color:red">
                            <b style="width: 40px !important;" title="{{ trans('module4.predictor') }}">{{ trans('module4.predictor') }}:</b>
                            <input name="vehicle_predictor" tabindex="-1" style="width: 70px !important;" style="color:red"><br>

                            <b style="width: 40px !important;">{{ trans('module4.phone') }}:</b>
                            <input name="vehicle_phone" tabindex="-1" style="width: 70px !important;" style="color:red">
                            <b style="width: 40px !important;">Fax:</b>
                            <input name="vehicle_fax" tabindex="-1" style="width: 70px !important;" style="color:red"<br>

                            <b>{{ trans('module4.activation_date') }}:</b>
                            <input class="w120" name="vehicle_activation" id="vehicle_activation">

                            <div class="row" style="padding-top:10px;padding-left: 15px;">
                                <a style="margin-right: 10px;" class="btn btn-success btn-sm btn-save submit-button save-draft newModal" name="save_type" value="draft">{{ trans('button.save_draft')}}</a>
                                <a style="margin-right: 10px;" class="btn btn-success btn-sm submit-button btn-save save-draft newModal" name="save_type" value="submit">{{ trans('button.submit')}}</a>
                                <a style="margin-right: 10px;" class="btn btn-secondary btn-sm" href="{{url('/import-vehicle')}}" >{{ trans('button.cancel')}}</a>
                            </div>
                        </td>
                        <!--=========================== End of Fourth Column ==========================-->
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
    </form>
</div>
<!--=========================== Vehicle Info End ===========================-->
<div class="tab-pane" id="document1">
    <form id="myForm" action="" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="vehicle_id" class="vehicle_id" value="">

        <!-- @include('Module5.importvehicle.doc-form') -->

    </form>
</div>
<div class="tab-pane" id="tenant1">

    <input type="hidden" name="vehicle_detail_id" class="vehicle_id" value="">
    <!-- @include('Module5.importvehicle.detail-tenant') -->

</div>
</div>