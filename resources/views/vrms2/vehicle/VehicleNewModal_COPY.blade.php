@php
$vkind = \App\Model\VehicleKind::whereStatus(1)->get();
$pcode = \App\Model\Province::whereStatus(1)->get();
$dcode = \App\Model\District::whereStatus(1)->get();
$vtype = \App\Model\VehicleType::whereStatus(1)->get();
$vbrand = \App\Model\VehicleBrand::whereStatus(1)->get();
$vmodel = \App\Model\VehicleModel::whereStatus(1)->get();
$vsteering = \App\Model\Steering::whereStatus(1)->get();
$vgas = \App\Model\Gas::whereStatus(1)->get();
$vcolor = \App\Model\Color::whereStatus(1)->get();
@endphp
<div class="tab-content clearfix">
   <div class="tab-pane active" id="nvehicleInfo">
      <!-- vehicle info start -->
      <div>
         <form name="frmVinfo" id="frmVinfo">
            @csrf
            <input type="hidden" value="{{auth()->user()->user_status}}" id="user_status">
            <table class="form-table vehicle-form">
               <tbody>
                  <tr>
                     <td>
                        <table>
                           <tr>
                              <td style="padding-right:0px; width: 334px;">
                                 <b style="color:red !important;font-weight:bold; float:left">
                                    <!-- ເລກກົມ<small>(ຂສ)</small>: -->
                                    {{ trans('module4.division_number') }}:
                                 </b>
                                 <input class="w150 nvt-focused" style="width: 143px;float:left" name="division_no" onpaste="return false;">
                                 <!--<div init="{{$vehicle->division_no}}"></div><br>-->
                                 <div>
                                    <a id="div_control_btn">A</a>
                                 </div>
                                 <span id="divError"></span>

                                 <b style="color:red !important;font-weight:bold">
                                    <!--ເລກແຂວງ<small>(ກພ)</small>:-->
                                    {{ trans('module4.province_number') }}:
                                 </b>
                                 <input class="w150" name="province_no">
                                 <div init="0000"></div><br>

                                 <b>
                                    <!--ເລກທີ:--> {{ trans('module4.number') }}:
                                 </b>
                                 <input name="number" class="w120">
                                 <div init="0000"></div><br>

                                 <b>
                                    <!--vdvc serial:--> {{ trans('module4.vdvc_serial') }}:
                                 </b>
                                 <input class="w80" id="serial_no" placeholder="" name="card_serial_no">
                                 <div init="0000"></div><br>

                                 <b>
                                    <!--ອອກໃຫ້ວັນທີ:-->{{ trans('module4.issue_date') }}:
                                 </b>
                                 <input class="w120" name="issue_date">
                                 <div init="0000"></div><br>

                                 <b>{{ trans('module4.expire_date') }}:</b>
                                 <input class="w120" name="expire_date">
                                 <div init="0000"></div><br>

                                 <div>
                                    <b style="float:left">
                                       <!--ໝາຍເລກທະບຽນ:-->{{ trans('module4.pre_lic_no') }}:
                                    </b>
                                    <input type="text" name="licence_no" style="width: 100px; float:left; vertical-align:top;text-align:center;color:#f00;font-weight:bold;font-size:18px !important" class="w120 license_no" id="licence_no" placeholder="" name="licence_no" onpaste="return false;">

                                    <span style="color:#999">
                                       <a id="lic_control_btn" class="disable-btn">A</a>
                                       <span id="licError"></span>
                                    </span><br>
                                 </div>

                                 <b>{{ trans('module4.purpose') }}:</b>
                                 <select class="w120" name="vehicle_kind_code" id="vehicle_kind">
                                    <option value="" selected disabled hidden>Vehicle Kind</option>
                                    @foreach($vkind as $vk)
                                    <option value="{{$vk->vehicle_kind_code}}">{{ $vk->name }}&nbsp;({{$vk->name_en}})</option>
                                    @endforeach
                                 </select>ເອກະຊົນລາວ<br>

                                 <b>{{ trans('common.name') }}:</b>
                                 <input name="owner_name" id="owner_name" class="w200"><br>

                                 <b>{{ trans('module4.village_name') }}:</b>
                                 <input name="village_name" class="w120" id="village_name"><br>

                                 <b>
                                    <!--ເມືອງ:-->{{ trans('common.district') }}:
                                 </b>
                                 <select name="district_code" class="w120" id="district_code">
                                    <option value="" selected disabled hidden>District</option>
                                    @foreach($dcode as $dc)
                                    <option value="{{$dc->district_code}}">{{ $dc->name }}&nbsp;({{$dc->name_en}})</option>
                                    @endforeach
                                 </select>
                                 <br>

                                 <b>{{ trans('common.province') }}:</b>
                                 <select name="province_code" id="province_code" class="w120">
                                    <option value="" selected disabled hidden>Province</option>
                                    @foreach($pcode as $pc)
                                    <option value="{{$pc->province_no}}">{{ $pc->name }}&nbsp;({{$pc->name_en}})</option>
                                    @endforeach
                                 </select> 1ກພ
                                 <div init="ກໍາແພງນະຄອນ"></div><br>

                                 <b>{{ trans('module4.vehicle_type') }}:</b>
                                 <select class="w120" name="vehicle_type_id" id="vehicle_type">
                                    <option value="" selected disabled hidden>Vehicle Type</option>
                                    @foreach($vtype as $vt)
                                    <option value="{{$vt->id}}">{{ $vt->name }}&nbsp;({{$vt->name_en}})</option>
                                    @endforeach
                                 </select><br />

                                 <b>{{ trans('module4.steering') }}:</b>
                                 <select class="w120" name="steering_id" id="steering_id">
                                    <option value="" selected disabled hidden>Steering</option>
                                    @foreach($vsteering as $vs)
                                    <option value="{{$vs->id}}">{{ $vs->name }}&nbsp;({{$vs->name_en}})</option>
                                    @endforeach
                                 </select><br />

                                 <b>{{ trans('module4.gas') }}:</b>
                                 <select class="w120" name="gas_id" id="gas_id">
                                    <option value="" selected disabled hidden>Vehicle Gas</option>
                                    @foreach($vgas as $vg)
                                    <option value="{{$vg->id}}">{{ $vg->name }}&nbsp;({{$vg->name_en}})</option>
                                    @endforeach
                                 </select><br />
                                 <div id="license-checker" style="display:block;font-size:12px;text-shadow:none"></div>

                                 <b>
                                    <!--ໝາຍເຫດ:-->{{ trans('module4.vehicle_remark') }}:
                                 </b>
                                 <input class="w220 f12" name="remark" style="color:red"><br>

                                 <b>
                                    <!--ສົ່ງ-->{{ trans('module4.vehicle_send') }}:
                                 </b>
                                 <input class="w120" name="vehicle_send" tabindex="-1" picktype="1"><br>
                                 <div style="font-size:9px">
                                    D5: <input class="w50 f9" name="d5" tabindex="-1" value="" f="222">
                                    D6: <input class="w50 f9" name="d6" tabindex="-1" value="" f="222">
                                    D2: <input class="w50 f9" name="d2" tabindex="-1" value="" f="222">
                                    D4: <input class="w50 f9" name="d4" tabindex="-1" value="" f="222"><br>
                                 </div>
                              </td>

                              <td style="padding-right:0px; width: 276px;">
                                 <b>{{ trans('module4.cylinder') }}:</b>
                                 <input class="w120" name="cylinder" id="cylinder"><br>

                                 <b>
                                    <!--ຄວາມແຮງ(cc)-->{{ trans('module4.cc') }}:
                                 </b>
                                 <input class="w120" name="cc" id="cc" f="222"><br>

                                 <b>{{ trans('module4.color') }}:</b>
                                 <select class="w120" name="color_id" id="color_id">
                                    <option value="" selected disabled hidden>Vehicle Color</option>
                                    @foreach($vcolor as $vco)
                                    <option value="{{$vco->id}}">{{ $vco->name }}&nbsp;({{$vco->name_en}})</option>
                                    @endforeach
                                 </select><br />

                                 <b>{{ trans('module4.brand') }}:</b>
                                 <select class="w120" name="brand_id" id="brand_id">
                                    <option value="" selected disabled hidden>Vehicle Brand</option>
                                    @foreach($vbrand as $vb)
                                    <option value="{{$vb->id}}">{{ $vb->name }}&nbsp;({{$vb->name_en}})</option>
                                    @endforeach
                                 </select><br />

                                 <b>{{ trans('module4.model') }}:</b>
                                 <select class="w120" name="model_id" id="model_id">
                                    <option value="" selected disabled hidden>Vehicle Model</option>
                                    @foreach($vmodel as $vm)
                                    <option value="{{$vm->id}}">{{ $vm->name }}&nbsp;({{$vm->name_en}})</option>
                                    @endforeach
                                 </select><br />

                                 <b>{{ trans('module4.engine_no') }}:</b>
                                 <input class="eng-validate" id="engine_no" style="width:162px;font-size:16px !important;font-family:dev_font !important" name="engine_no" onchange="this.value = this.value.replace(/[\;\:\.\,\/\\\s]/g, &quot;&quot;).toUpperCase()" onpaste="return false;"><br>

                                 <b>{{ trans('module4.chassis_no') }}:</b>
                                 <input class="eng-validate" id="chassis_no" style="width:162px;font-size:16px !important;font-family:dev_font !important" name="chassis_no" onchange="this.value = this.value.replace(/[\;\:\.\,\/\\\s]/g, &quot;&quot;).toUpperCase()" onpaste="return false;"><br>



                                 <b>{{ trans('module4.width') }}:</b>
                                 <input class="w120" name="width" id="width">
                                 <span style="color:#ddd">ມມ</span><br>

                                 <b>{{ trans('module4.long') }}:</b>
                                 <input class="w120" name="long" id="long">
                                 <span style="color:#ddd">ມມ</span><br>

                                 <b>{{ trans('module4.height') }}:</b>
                                 <input class="w120" name="height" id="height">
                                 <span style="color:#ddd">ມມ</span><br>

                                 <b>{{ trans('module4.seat') }}:</b>
                                 <input class="w120" name="seat" id="seat"><br>

                                 <b>{{ trans('module4.weight') }}:</b>
                                 <input class="w120" name="weight" id="weight"><br>

                                 <b>{{ trans('module4.weight_filled') }}:</b>
                                 <input class="w120" name="weight_filled" id="weight_filled"><br>

                                 <b>{{ trans('module4.total_weight') }}:</b>
                                 <input class="w120" name="total_weight" id="total_weight"><br>

                                 <b>{{ trans('module4.axis') }}:</b>
                                 <input class="w20" name="axis" id="axis">

                                 <b class="w60" style="width: 60px !important">{{ trans('module4.wheel') }}:</b>
                                 <input class="w20" name="wheels" id="wheels"><br>

                                 <b>{{ trans('module4.year_mnf') }}:</b>
                                 <input class="w120" name="year_manufacture" id="year_manufacture"><br>

                                 <b>
                                    <!-- ຍີ່ຫໍ້ຈັກ -->{{ trans('module4.brand') }}:
                                 </b>
                                 <select class="w120" name="brand_id" id="brand_id">
                                    <option value="" selected disabled hidden>Vehicle Brand</option>
                                    @foreach($vbrand as $vb)
                                    <option value="{{$vb->id}}">{{ $vb->name }}&nbsp;({{$vb->name_en}})</option>
                                    @endforeach

                                 </select><br />

                                 <div>
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
                           </tr>

                           <tr>
                              <td colspan="2">
                                 <div style="padding-top:20px;">
                                    <!--
                                 <a href="#" class="button f10" tabindex="-1" loadto="center">
                                    ພິມໃບຊົ່ວຄາວ
                                 </a>
                              -->
                                    <!-- start button -->

                                    <button type="button" id="btnVinfoSave" class="button f10">{{trans('button.save')}}</button>

                                    <!-- end button -->
                                 </div>
                              </td>
                           </tr>

                        </table>

                     </td>

                     <td style="padding-right:0px;  width: 234px;">
                        <span class="cDB">1.
                           <!--ໃບອະນຸຍາດນໍາເຂົ້າ:--> {{ trans('module4.import_permit') }}:
                        </span><br>

                        <b>
                           <!--ຂອງ ຫ ສ ນ ຍ:--> {{ trans('module4.hsny') }}:
                        </b>
                        <input type="checkbox" name="import_permit_hsny" id="import_permit_hsny"><br>

                        <b>
                           <!--ແຜນການ/ລົງທຶນ:--> {{ trans('module4.invest') }}:
                        </b>
                        <input type="checkbox" name="import_permit_invest" id="import_permit_invest"><br>

                        <b>
                           <!--ເລກທີ່:--> {{ trans('module4.veh_mod4_no') }}:
                        </b>
                        <input class="w120" name="import_permit_no" id="import_permit_no"><br>

                        <b>
                           <!--ລົງວັນທີ່:-->{{ trans('module4.veh_mod4_date') }}:
                        </b>
                        <input class="w120" name="import_permit_date" id="import_permit_date"><br>
                        <span class="cDB">2. ໃບແຈ້ງ ກະຊວງອຸດສາຫະກໍາ:</span><br>

                        <b>
                           <!--ເລກທີ່:-->{{ trans('module4.veh_mod4_no') }}:
                        </b>
                        <input class="w120" name="industrial_doc_no" id="industrial_doc_no"><br>

                        <b>
                           <!--ລົງວັນທີ່:-->{{ trans('module4.veh_mod4_date') }}:
                        </b>
                        <input class="w120" name="industrial_doc_date" id="industrial_doc_date"><br>
                        <span class="cDB">3. ໃບອະນຸຍາດເຕັກນິກນໍາເຂົ້າ:</span><br>

                        <b>
                           <!--ເລກທີ່--> {{ trans('module4.veh_mod4_no') }}:
                        </b>
                        <input class="w120" name="technical_doc_no" id="technical_doc_no"><br>

                        <b>
                           <!--ລົງວັນທີ່ -->{{ trans('module4.tech_doc') }}:
                        </b>
                        <input class="w120" name="technical_doc_date" id="technical_doc_date"><br>
                        <span class="cDB">4. ໃບອະນຸຍາດນໍາເຂົ້າພະແນກການຄ້າ:</span><br>

                        <b>
                           <!--ພະແນກການຄ້າ:-->{{ trans('module4.tax_permit') }}:
                        </b>
                        <input class="w120" name="tax_permit" id="tax_permit"><br>

                        <b>
                           <!--ເລກທີ່:--> {{ trans('module4.veh_mod4_no') }}:
                        </b>
                        <input class="w120" name="comerce_permit_no" id="comerce_permit_no"><br>

                        <b>
                           <!--ລົງວັນທີ:-->{{ trans('module4.veh_mod4_date') }}:
                        </b>
                        <input class="w120" name="comerce_permit_date" id="comerce_permit_date"><br>

                        <div formid="14" pid="10" class="nvt-plugin nvt-form-new">
                           <div scrollid="101" style="height:100px;font-size:11px;width:180px;overflow:hidden" owner="">
                              <table>
                                 <thead style="border-bottom:#ddd solid 1px;padding:0px">
                                    <tr>
                                       <th>ພິມຄັ້ງທີ</th>
                                       <th>ວັນທີ</th>
                                       <th>ຜູ້ພິມ</th>
                                    </tr>
                                 </thead>
                                 <tbody class="zebra">
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td>
                                          <!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=1'>Del</a></td-->
                                       </td>
                                    </tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td>
                                          <!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=2'>Del</a></td-->
                                       </td>
                                    </tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td>
                                          <!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=3'>Del</a></td-->
                                       </td>
                                    </tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td>
                                          <!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=4'>Del</a></td-->
                                       </td>
                                    </tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td>
                                          <!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=5'>Del</a></td-->
                                       </td>
                                    </tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td>
                                          <!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=6'>Del</a></td-->
                                       </td>
                                    </tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td>
                                          <!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=7'>Del</a></td-->
                                       </td>
                                    </tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td>
                                          <!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=8'>Del</a></td-->
                                       </td>
                                    </tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td>
                                          <!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=9'>Del</a></td-->
                                       </td>
                                    </tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td>
                                          <!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=10'>Del</a></td-->
                                       </td>
                                    </tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td>
                                          <!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=11'>Del</a></td-->
                                       </td>
                                    </tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td>
                                          <!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=12'>Del</a></td-->
                                       </td>
                                    </tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td>
                                          <!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=13'>Del</a></td-->
                                       </td>
                                    </tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td>
                                          <!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=14'>Del</a></td-->
                                       </td>
                                    </tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td>
                                          <!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=15'>Del</a></td-->
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </td>
                     <td style=" width: 270px;">
                        <span class="cDB">5. ໃບແຈ້ງເສຍພາສີ:</span>
                        <div style="position:absolute;margin-left:140px;margin-top:-20px;background:#eef;font-size:13px;padding:10px">
                           <i>ສົ່ງທາງ Online</i><br>
                           <i>ຈາກ:</i> dai<br>
                           <i>ວັນທີ:</i> 06/10/2021<br>
                           <i>ເຈົ້າໜ້າທີ່ກວດກາ:</i> ຍັງ
                        </div>
                        <div style="position:absolute;margin-left:245px;margin-top:-20px;background:#5f5;font-size:13px;padding:10px">
                           ຈ່າຍ/ສົ່ງແລ້ວວັນທີ:<br>
                        </div>
                        <br>

                        <b>
                           <!--ບ 10 ຫຼື ບ 40:--> {{ trans('module4.tax_10_40') }}:
                        </b>
                        <input type="checkbox" name="tax_10_40" id="tax_10_40"><br>

                        <b>
                           <!--ຍົກເວັ້ນພາສີ:-->{{ trans('module4.tax_exam') }}:
                        </b>
                        <input type="checkbox" name="tax_exam" id="tax_exam"><br>

                        <b>
                           <!--ບ 12:-->{{ trans('module4.tax12') }}:
                        </b>
                        <input type="checkbox" name="tax_12" id="tax_12"><br>

                        <b>
                           <!--ບ 50:-->{{ trans('module4.tax50') }}:
                        </b>
                        <input type="checkbox" name="tax_50" id="tax_50"><br>

                        <b>
                           <!--ເລກທີ່:-->{{ trans('module4.veh_mod4_no') }}:
                        </b>
                        <input class="w120" name="tax_no" id="tax_no"><br>

                        <b>
                           <!--ລົງວັນທີ່: -->{{ trans('module4.veh_mod4_date') }}:
                        </b>
                        <input class="w120" name="tax_date"><br>
                        <span class="cDB">6. ໃບຢັ້ງຢືນການເສຍພາສີ:</span><br>

                        <b>{{ trans('module4.tax_receipt') }}:</b>
                        <input type="checkbox" name="tax_receipt"><br>

                        <b>{{ trans('module4.tax_permit') }}:</b>
                        <input type="checkbox" name="tax_permit"><br>

                        <b>
                           <!--ເລກທີ່:-->{{ trans('module4.veh_mod4_no') }}:
                        </b>
                        <input class="w120" name="tax_payment_no" id="tax_payment_no"><br>

                        <b>
                           <!--ລົງວັນທີ່:--> {{ trans('module4.veh_mod4_date') }}:
                        </b>
                        <input class="w120" name="tax_payment_date" id="tax_payment_date"><br>

                        <span class="cDB">7. ບັກທຶກການແກ້ໄຂຄະດີ:</span><br>
                        <b>
                           <!--ເລກທີ່:-->{{ trans('module4.veh_mod4_no') }}:
                        </b>
                        <input class="w120" name="police_doc_no" id="police_doc_no"><br>

                        <b>{{ trans('module4.veh_mod4_date') }}:</b>
                        <input class="w120" name="police_doc_date" id="police_doc_date"><br>

                        <span class="cDB">8.
                           <!--ຂໍ້ມູນເພີ່ມເຕີມ--> {{ trans('module4.note1') }}:
                        </span><br>
                        <textarea name="note" id="note" class="h50 nvt-focused" style="width:225px;color:red"></textarea><br>

                        <b class="w40" style="width: 40px !important;">ຫນ່ວຍ:</b>
                        <input name="mistakeby" tabindex="-1" style="width: 70px !important;" class="w70" style="color:red">
                        <b class="w40" style="width: 40px !important;">

                           ຜູ້ເບີກ:</b>
                        <input name="advance" tabindex="-1" style="width: 70px !important;" class="w70" style="color:red" f="222"><br>

                        <b class="w40" style="width: 40px !important;">ຫນ່ວຍ:</b>
                        <input name="mistakeby" tabindex="-1" style="width: 70px !important;" class="w70" style="color:red" f="222">

                        <b class="w40" style="width: 40px !important;">ຜູ້ເບີກ:</b>
                        <input name="advance" tabindex="-1" style="width: 70px !important;" class="w70" style="color:red" f="222"><br>

                        <!--
                           <b>4u:</b> 
                           <input class="w120" name="4u'" value="" f="222"><div init="111"></div><br>
                           -->

                        <b>ເລີ່ມນຳໃຊ້ວັນທີ:</b>
                        <input class="w120" name="fax" id="fax" f="222">
                        <div init="111"></div><br>

                     </td>
                  </tr>

               </tbody>
            </table>
         </form>
      </div>
      <!-- vehicle info end -->
   </div>

   <div class="tab-pane" id="ndocument">
      <!-- document start -->
      <form id="myForm" class="form-inline" method="post" enctype="multipart/form-data">
         @csrf
         <input type="hidden" name="id" class="form-control" value="" />  <!-- {{$vehicle->id}} -->
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
                           @if($app_doc[2])
                           <a href="">{{$app_doc[2]}}</a>
                           @else

                           <input type="file" name="2" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" />
                           @endif
                           @else
                           <input type="file" name="2" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" />
                           @endif
                        </div>

                     </td>
                     <td>
                        @if(!empty($app_doc))
                        @if($app_doc[2])
                        <a href="#" data-filename="{{ $app_doc[2] }}" data-vehicle_detail_id="{{$vehicle->id}}" data-doc_type_id="2" data-id="dm" onclick="docModal(this)" class="btn btn-info btn-sm editDocument">{{ trans('button.edit')}}</a>

                        @endif
                        @endif
                     </td>
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
                           @if($app_doc[5])
                           <a href="#">{{$app_doc[5]}}</a>
                           @else
                           <input type="file" name="5" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" />
                           @endif
                           @else
                           <input type="file" name="5" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" />
                           @endif
                        </div>

                        <!--
                                    <div>                                 
                                    <input type="file" name="5" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"  />                              
                                    </div>
                                    -->
                     </td>
                     <td>
                        @if(!empty($app_doc))
                        @if($app_doc[5])
                        <a href="#" data-filename="{{ $app_doc[5] }}" data-doc_type_id="5" data-vehicle_detail_id="{{$vehicle->id}}" data-id="dm" onclick="docModal(this)" class="btn btn-info btn-sm editDocument">{{ trans('button.edit')}}</a>

                        @endif
                        @endif
                     </td>
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
                           @if($app_doc[4])
                           <a href="">{{$app_doc[4]}}</a>
                           @else
                           <input type="file" name="4" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" />
                           @endif
                           @else
                           <input type="file" name="4" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" />
                           @endif
                        </div>

                        <!--
                                 <div>
                                    
                                       <input type="file" name="4" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   />
                                    
                                    </div>
                                    -->
                     </td>
                     <td>
                        @if(!empty($app_doc))
                        @if($app_doc[4])
                        <a href="#" data-filename="{{ $app_doc[4] }}" data-doc_type_id="4" data-vehicle_detail_id="{{$vehicle->id}}" data-id="dm" onclick="docModal(this)" class="btn btn-info btn-sm editDocument">{{ trans('button.edit')}}</a>

                        @endif
                        @endif
                     </td>
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
                           @if($app_doc[3])
                           <a href="#">{{$app_doc[3]}}</a>
                           @else

                           <input type="file" name="3" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" />
                           @endif
                           @else
                           <input type="file" name="3" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" />
                           @endif
                        </div>

                        <!--
                                    <div>
                                 
                                    <input type="file" name="3" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   />
                                 
                                    </div>-->
                     </td>
                     <td>
                        @if(!empty($app_doc))
                        @if($app_doc[3])
                        <a href="#" data-filename="{{ $app_doc[3] }}" data-doc_type_id="3" data-vehicle_detail_id="{{$vehicle->id}}" data-id="dm" onclick="docModal(this)" class="btn btn-info btn-sm editDocument">{{ trans('button.edit')}}</a>
                        @endif
                        @endif

                     </td>
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
                           @if($app_doc[6])
                           <a href="#">{{$app_doc[6]}}</a>
                           @else
                           <input type="file" name="6" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" />
                           @endif
                           @else
                           <input type="file" name="6" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" />
                           @endif
                        </div>

                     </td>
                     <td>
                        @if(!empty($app_doc))
                        @if($app_doc[6])
                        <a href="#" data-filename="{{ $app_doc[6] }}" data-doc_type_id="6" data-vehicle_detail_id="{{$vehicle->id}}" data-id="dm" onclick="docModal(this)" class="btn btn-info btn-sm editDocument">{{ trans('button.edit')}}</a>
                        @endif
                        @endif
                     </td>
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
                           @if($app_doc[7])
                           <a href="">{{$app_doc[7]}}</a>
                           @else
                           <input type="file" name="7" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" />
                           @endif
                           @else
                           <input type="file" name="7" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" />
                           @endif
                        </div>

                     </td>
                     <td>
                        @if(!empty($app_doc))
                        @if($app_doc[7])
                        <a href="#" data-filename="{{ $app_doc[7] }}" data-doc_type_id="7" data-vehicle_detail_id="{{$vehicle->id}}" data-id="dm" onclick="docModal(this)" class="btn btn-info btn-sm editDocument">{{ trans('button.edit')}}</a>
                        @endif
                        @endif
                     </td>
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
                           @if($app_doc[8])
                           <a href="#">{{$app_doc[8]}}</a>
                           @else
                           <input type="file" name="8" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" />
                           @endif
                           @else
                           <input type="file" name="8" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" />
                           @endif
                        </div>

                     </td>
                     <td>
                        @if(!empty($app_doc))
                        @if($app_doc[8])
                        <a href="#" data-filename="{{ $app_doc[8] }}" data-doc_type_id="8" data-vehicle_detail_id="{{$vehicle->id}}" data-id="dm" onclick="docModal(this)" class="btn btn-info btn-sm editDocument">
                           {{ trans('button.edit')}}
                        </a>
                        @endif
                        @endif
                     </td>
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

               <a class="btn btn-info btn-sm  @if(empty($app_doc)) disabled @endif" href="dscan:{{$vehicle->license_no ??''}}|{{$vehicle->id}}|{{$app_doc[2] ?? ''}}|{{$app_doc[5]?? ''}}|{{$app_doc[4]?? ''}}|{{$app_doc[3] ?? ''}}|{{$app_doc[6]}}|{{$app_doc[7]?? ''}}|{{$app_doc[8]?? ''}}">Scan Documents</a>

               <button id="btnDoc" class="btn btn-success btn-sm" onClick="return validate()">{{ trans('button.save')}}</button>

            </div>
         </div>
      </form>
      <!-- document end -->
   </div>


   <div class="tab-pane ml-5" id="ntenant-info">
      <form name="frmTenant" id="frmTenant" enctype="multipart/form-data">
         @csrf
         <div class="row">
            <div class="col-12 col-md-8">
               <div class="row">
                  <div class="col-md-12 col-sm-12 mb-1">
                     <label for="validationCustom01">{{ trans('common.name')}}:</label>
                     <input type="hidden" name="vehicle_id" id="vehicle_id" value="{{$vehicle->id}}">
                     <input type="text" class="form-control" value="{{ $veh_tenant->tenant_name ?? ''}}" placeholder="Enter Name" name="tenant_name" required>
                  </div>
                  <div class="col-md-6 col-sm-6 mb-1">
                     <label for="validationCustom01">{{ trans('common.province')}}:</label>
                     <select name="province_code" class="form-control" id="tenant_province" required>
                        <option value="" disabled>Select Province</option>
                        @foreach($pcode as $pro)
                        <option value="{{$pro->province_code}}" @if($veh_tenant) {{$veh_tenant->province_code == $pro->province_code?'selected':''}} @endif>{{ $pro->name}}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-md-6 col-sm-6 mb-1">
                     <label for="validationCustom01">{{ trans('common.district')}}:</label>
                     @if($veh_tenant)
                     <select class="form-control" name="district_code" required="required" id="tenant_district">
                        <option value="" selected disabled hidden>--Select District--</option>
                        @foreach($tenant_district as $district)
                        <option value="{{$district->district_code}}" @if($veh_tenant) {{$veh_tenant->district_code == $district->district_code?'selected':''}} @endif>{{ $district->name}}</option>
                        @endforeach
                     </select>
                     @else
                     <select class="form-control" name="district_code" required="required" id="tenant_district">
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
            <div class="col-6 col-md-4 mt-5">

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
</div>