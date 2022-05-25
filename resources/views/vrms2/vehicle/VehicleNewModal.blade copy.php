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
               <table class="form-table vehicle-form">
                  <tbody>
                
                  <tr>
                     <td style="padding-right:0px; width: 334px;">
                        <b style="color:red !important;font-weight:bold">ເລກກົມ<small>(ຂສ)</small>:</b> 
                           <input class="w150 nvt-focused" name="division_no"  focus="0" f="222">  
                        <div init="35000"></div><br>
                        <b style="color:red !important;font-weight:bold">ເລກແຂວງ<small>(ກພ)</small>:</b> 
                           <input class="w150" name="province_no"  f="222">
                        <div init="25001"></div><br>				
                        <b>ເລກທີ:</b> 
                           <input name="number" class="w120" f="222">
                        <div init="111"></div><br>
                        <!--<b>Encoder:</b> <input name='encoder' class='w50' value=''>-->                        
                        <b>vdvc serial:</b> 
                           <input name="vdvd_card" class="w80"  f="222">
                        <div init="111"></div><br>
                        <b>ອອກໃຫ້ວັນທີ:</b> 
                           <input class="w120" name="issue_date"  f="222">
                        <div init="18/02/2021"></div><br>
                        <b>ໝົດອາຍຸວັນທີ:</b> 
                           <input class="w120" name="expire_date"  f="222">
                        <div init="17/02/2021"></div><br>
                        <b>ໝາຍເລກທະບຽນ:</b>
                        <input class="w120 license_no" style="vertical-align:top;text-align:center;color:#f00;font-weight:bold;font-size:18px !important" name="number" f="222" >
                        <span style="color:#999">cdg   </span><br>
                        <b>ເປົ້າໝາຍ:</b>
                           <select class="w120" f="222" name="vehicle_kind_code" id="">                              
                           <option value="" selected disabled hidden>Vehicle Kind</option>
                              @foreach($vkind as $vk)
                              <option value="{{$vk->vehicle_kind_code}}">{{ $vk->name }}&nbsp;({{$vk->name_en}})</option>
                              @endforeach                              
                           </select>ເອກະຊົນລາວ<br>
                           
                        <b>ຊື່ພາສາລາວ:</b>
                           <input name="owner_name" id="customer_name" class="w200" onkeyup="$.nameAddTitle(this)" f="222" ><br>
                        <b>ປະຈຸບັນຢູ່ ບ້ານ:</b>
                           <input name="village_name" class="w120" id="customer_village" picktype="1" pick0="notes/field/name-typecache/type=village,collection=settings" f="222" ><br>
                        <b>ເມືອງ:</b> 
                           <select name="district_code" class="w120" id="customer_district">                           
                              <option value="" selected disabled hidden>District</option>
                              @foreach($dcode as $dc)
                              <option value="{{$dc->district_code}}">{{ $dc->name }}&nbsp;({{$dc->name_en}})</option>
                              @endforeach                           
                           </select>
                           
                           <br>
                        <b>ແຂວງ:</b>
                           <select name="province_code" id="customer_province"  class="w120">
                             <option value="" selected disabled hidden>Province</option>                            
                              @foreach($pcode as $pc)
                              <option value="{{$pc->province_no}}">{{ $pc->name }}&nbsp;({{$pc->name_en}})</option>
                              @endforeach                               
                           </select> 1ກພ
                           <div init="ກໍາແພງນະຄອນ"></div><br>

                        <b>ປະເພດລົດ:</b> 
                           <select class="w120" name="vehicle_type_id" id="customer_vehicletype">
                             <option value="" selected disabled hidden>Vehicle Type</option>
                              @foreach($vtype as $vt)
                              <option value="{{$vt->id}}">{{ $vt->name }}&nbsp;({{$vt->name_en}})</option>
                              @endforeach
                           </select><br/>
                        <b>ພວງມະໄລ:</b> 
                           <select class="w120" name="steering_id">                                                            
                              <option value="" selected disabled hidden>Steering</option>
                                 @foreach($vsteering as $vs)
                                 <option value="{{$vs->id}}">{{ $vs->name }}&nbsp;({{$vs->name_en}})</option>
                                 @endforeach  

                           </select><br/>
                        <b>ໃຊ້ນໍ້າມັນ:</b> 
                           <select class="w120" name="gas_id">
                              <option value="" selected disabled hidden>Vehicle Gas</option>
                                 @foreach($vgas as $vg)
                                 <option value="{{$vg->id}}" >{{ $vg->name }}&nbsp;({{$vg->name_en}})</option>
                                 @endforeach 
                           </select><br/>
                        <div id="license-checker" style="display:block;font-size:12px;text-shadow:none"></div>
                        <b>ໝາຍເຫດ:</b>
                        <input class="w220 f12" name="remark" style="color:red" tabindex="-1" picktype="1" pick="notes/field/value-typecache/type=vehiclechange,collection=settings" f="222"><br>
                        <b>ສົ່ງ:</b> 
                        <input class="w120" name="vehicle_send" tabindex="-1" picktype="1" pick="=ນາລີ;ບົວພັນ" f="222"><br>
                        <div style="font-size:9px">
                           D5: <input class="w50 f9" name="d5" tabindex="-1" value="" f="222">
                           D6: <input class="w50 f9" name="d6" tabindex="-1" value="" f="222">
                           D2: <input class="w50 f9" name="d2" tabindex="-1" value="" f="222">
                           D4: <input class="w50 f9" name="d4" tabindex="-1" value="" f="222"><br>
                        </div>
                           
                     </td>


                     <td style="padding-right:0px; width: 276px;">
                        <b>ຈໍານວນສູບ:</b> 
                           <input class="w120" name="cylinder" f="222" ><br>
                        <b>ຄວາມແຮງ(cc):</b> 
                           <input class="w120" name="cc" f="222" ><br>
                           <b>ສີລົດ:</b> 
                           <select class="w120" name="color_id">
                              <option value="" selected disabled hidden>Vehicle Color</option>
                                 @foreach($vcolor as $vco)
                                 <option value="{{$vco->id}}">{{ $vco->name }}&nbsp;({{$vco->name_en}})</option>
                                 @endforeach                             
                           </select><br/>
                        <b>ຍີ່ຫໍ້:</b> 
                           <select class="w120" name="brand_id">
                           <option value="" selected disabled hidden>Vehicle Brand</option>
                           @foreach($vbrand as $vb)
                           <option value="{{$vb->id}}" >{{ $vb->name }}&nbsp;({{$vb->name_en}})</option>
                           @endforeach 
                           </select><br/>
                        <b>ລຸ້ນ:</b> 
                           <select class="w120" name="model_id">
                           <option value="" selected disabled hidden>Vehicle Model</option>
                           @foreach($vmodel as $vm)
                           <option value="{{$vm->id}}" >{{ $vm->name }}&nbsp;({{$vm->name_en}})</option>
                           @endforeach                              
                           </select><br/>
                        <b>ເລກຈັກ:</b> 
                           <input style="width:162px;font-size:16px !important;font-family:dev_font !important" name="engine_no" onchange="this.value = this.value.replace(/[\;\:\.\,\/\\\s]/g, &quot;&quot;).toUpperCase()" f="222" ><br>
                        <b>ເລກຖັງ:</b> 
                           <input style="width:162px;font-size:16px !important;font-family:dev_font !important" name="chassis_no" onchange="this.value = this.value.replace(/[\;\:\.\,\/\\\s]/g, &quot;&quot;).toUpperCase()" f="222" ><br>
                        
                                                
               
                        <b>ຂະໜາດລົດກວ້າງ:</b> 
                           <input class="w120" name="width" f="222" > <span style="color:#ddd">ມມ</span><br>
                        <b>ຍາວ:</b> 
                           <input class="w120" name="long" f="222" > <span style="color:#ddd">ມມ</span><br>
                        <b>ສູງ:</b> 
                           <input class="w120" name="height" f="222" > <span style="color:#ddd">ມມ</span><br>
                        <b>ຈໍານວນບ່ອນນັ່ງ:</b> 
                           <input class="w120" name="seat" f="222" ><br>
                        <b>ນໍ້າໜັກລົດເປົ່າ:</b> 
                           <input class="w120" name="weight" f="222" ><br>
                        <b>ນໍ້າໜັກບັກທຸກ:</b> 
                           <input class="w120" name="weight_filled" f="222" ><br>
                        <b>ນໍ້າໜັກລວມ:</b> 
                           <input class="w120" name="total_weight" f="222" ><br>
                        <b>ຈໍານວນເພົາ:</b> 
                           <input class="w20" name="axis" f="222" >
                        <b class="w60" style="width: 60px !important">ຈໍານວນລໍ້:</b> 
                           <input class="w20" name="wheels" f="222" ><br>
                           <b>Year:</b> 
                           <input class="w120" name="year_manufacture" picktype="1" pick="notes/field/name-typecache/type=make,collection=settings" f="222" ><br>
                        <b>ຍີ່ຫໍ້ຈັກ:</b> 
                           <select class="w120" name="brand_id">                             
                           <option value="" selected disabled hidden>Vehicle Brand</option>
                           @foreach($vbrand as $vb)
                           <option value="{{$vb->id}}">{{ $vb->name }}&nbsp;({{$vb->name_en}})</option>
                           @endforeach   
                            
                           </select><br/>
                           
                        <div>
                        </div>
                        <div>
                        <a href="#" class="button f10" tabindex="-1" loadto="center" load="forms/temporary-vehicle-form" note="0394290769b1e2f695f37fdc4d9aecd4">ພິມໃບຊົ່ວຄາວ</a>					
                           
                        </div>
                        <div hideempty="">ອອກໃບຄໍາຮອງຍົກຍ້າຍເລກທີ:  ວັນທີ: </div>
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
                        
                        </div></div>
                        <div hideempty="" style="position:realtive">
                        <div style="background:#f00;color:#fff;font-size:13px;padding:5px;max-width:250px;position:absolute">
                        
                        </div>
                      </div>
                     </td>

                     <td style="padding-right:0px;  width: 234px;">
                        <span class="cDB">1. ໃບອະນຸຍາດນໍາເຂົ້າ:</span><br>
                        <b>ຂອງ ຫ ສ ນ ຍ:</b> <input type="checkbox" name="import_permit_hsny" f="222" v=""><br>
                        <b>ແຜນການ/ລົງທຶນ:</b> <input type="checkbox" name="import_permit_invest" f="222" v=""><br>
                        <b>ເລກທີ່:</b> <input class="w120" name="import_permit_no" f="222" ><br>
                        <b>ລົງວັນທີ່:</b> <input class="w120" name="import_permit_date" f="222" ><br>
                        <span class="cDB">2. ໃບແຈ້ງ ກະຊວງອຸດສາຫະກໍາ:</span><br>                       
                        <b>ເລກທີ່:</b> <input class="w120" name="industrial_doc_no" f="222" ><br>
                        <b>ລົງວັນທີ່:</b> <input class="w120" name="industrial_doc_date" f="222" ><br>
                        <span class="cDB">3. ໃບອະນຸຍາດເຕັກນິກນໍາເຂົ້າ:</span><br>
                        <b>ເລກທີ່:</b> <input class="w120" name="technical_doc_no" f="222" ><br>
                        <b>ລົງວັນທີ່:</b> <input class="w120" name="technical_doc_date" f="222" ><br>
                        <span class="cDB">4. ໃບອະນຸຍາດນໍາເຂົ້າພະແນກການຄ້າ:</span><br>
                        <b>ພະແນກການຄ້າ:</b> <input class="w120" name="tax_permit" f="222" ><br>
                        <b>ເລກທີ່:</b> <input class="w120" name="comerce_permit_no" f="222" ><br>
                        <b>ລົງວັນທີ:</b> <input class="w120" name="comerce_permit_date" f="222" ><br>
                           <div formid="14" formforce="forms/print-count" src="notes/j/note_id=0394290769b1e2f695f37fdc4d9aecd4" pid="10" class="nvt-plugin nvt-form-new" plugin="Form" updatecallback="$.nvtForm" liveupdate="1">
                              <div scrollid="101" style="height:100px;font-size:11px;width:180px;overflow:hidden" owner="" note="0394290769b1e2f695f37fdc4d9aecd4" notecollection="notes" f="223">
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
                                       <td><!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=1'>Del</a></td-->
                                    </td></tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td><!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=2'>Del</a></td-->
                                    </td></tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td><!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=3'>Del</a></td-->
                                    </td></tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td><!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=4'>Del</a></td-->
                                    </td></tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td><!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=5'>Del</a></td-->
                                    </td></tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td><!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=6'>Del</a></td-->
                                    </td></tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td><!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=7'>Del</a></td-->
                                    </td></tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td><!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=8'>Del</a></td-->
                                    </td></tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td><!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=9'>Del</a></td-->
                                    </td></tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td><!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=10'>Del</a></td-->
                                    </td></tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td><!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=11'>Del</a></td-->
                                    </td></tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td><!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=12'>Del</a></td-->
                                    </td></tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td><!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=13'>Del</a></td-->
                                    </td></tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td><!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=14'>Del</a></td-->
                                    </td></tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td><!--a class='link' cmd='forms/delete-print-count/note_id=0394290769b1e2f695f37fdc4d9aecd4,ino=15'>Del</a></td-->
                                    </td></tr>
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

                                       
                
                        <b>ບ 10 ຫຼື ບ 40:</b> <input type="checkbox" name="tax_10_40" f="222" ><br>
                        <b>ຍົກເວັ້ນພາສີ:</b> <input type="checkbox" name="tax_exem" f="222" ><br>
                        <b>ບ 12:</b> <input type="checkbox" name="tax_12" f="222" ><br>
                        <b>ບ 50:</b> <input type="checkbox" name="tax_50" f="222" ><br>
                        <b>ເລກທີ່:</b> <input class="w120" name="tax_no" f="222" ><br>
                        <b>ລົງວັນທີ່:</b> <input class="w120" name="tax_date" f="222" ><br>
                        <span class="cDB">6. ໃບຢັ້ງຢືນການເສຍພາສີ:</span><br>
                        <b>ຢັ້ງຢືນການເສຍພາສີ:</b> <input type="checkbox" name="tax_receipt" f="222" ><br>
                        <b>ອານຸຍາດຍົກເວັ້ນພາສີ:</b> <input type="checkbox" name="tax_permit" f="222" ><br>
                        <b>ເລກທີ່:</b> <input class="w120" name="tax_payment_no" f="222" ><br>
                        <b>ລົງວັນທີ່:</b> <input class="w120" name="tax_payment_date" f="222"><br>
                        <span class="cDB">7. ບັກທຶກການແກ້ໄຂຄະດີ:</span><br>
                        <b>ເລກທີ່:</b> <input class="w120" name="police_doc_no" f="222" ><br>
                        <b>ລົງວັນທີ່:</b> <input class="w120" name="police_doc_date" f="222" ><br>
                        <span class="cDB">8. ຂໍ້ມູນເພີ່ມເຕີມ:</span><br>
                        <textarea name="remark" class="h60 nvt-focused" style="width:225px;color:red" f="222"></textarea><br>
                        <b class="w40" style="width: 40px !important;">ຫນ່ວຍ:</b><input name="mistakeby" tabindex="-1" style="width: 70px !important;" class="w70" style="color:red" f="222"><b class="w40"  style="width: 40px !important;">
                        ຜູ້ເບີກ:</b>
                        <input name="advance" tabindex="-1"  style="width: 70px !important;" class="w70" style="color:red" f="222"><br>
                        <!--b class='w40'>ເບີໂທ:</b><input name='telephone' tabindex="-1" class='w70'><b class='w40'>fax:</b><input name='fax1' tabindex="-1" class='w70'><BR-->
                        <b>4u:</b> <input class="w120" name="4u'" value="" f="222"><div init="111"></div><br>
                        <b>ເລີ່ມນຳໃຊ້ວັນທີ:</b>
                        <input class="w120" name="fax" value="" f="222"><div init="111"></div><br>
                                    
                     </td>
                  </tr>
                 
                  </tbody>
               </table>
            </div>


                    <!-- vehicle info end -->
                </div>
                <div class="tab-pane" id="nlog">
                    <h3>Change Log</h3>
                </div>
                <div class="tab-pane" id="ndocument">
               <!-- document start -->

                              
               <form id="myForm" class="form-inline" action="" method="post" enctype="multipart/form-data">
                  @csrf
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
                     
                        <input type="file" name="2" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"  />
                        
                     </div>
                  </td>
                  <td>
                  
               </td>  
               </tr>
               <tr class="attach_doc">
                  <td>
                     <div>
                           <input type="hidden" name="doc_type_id[]"  class="form-control" value="5" />
                           <h5>{{ trans('doc_type.import_good') }}</h5>
                     </div>
                  </td>

                  <td>
                     <div>
                     
                     <input type="file" name="5" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"  />
                  
                     </div>
                  </td>
                  <td>
               
               
               </td>  
               </tr>
               <tr class="attach_doc">
                  <td>
                     <div>
                           <input type="hidden" name="doc_type_id[]"  class="form-control" value="4" />
                           <h5>{{ trans('doc_type.veh_lic_tech') }}</h5>
                     </div>
                  </td>
                  <td>
                     <div>
                     
                        <input type="file" name="4" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   />
                     
                     </div>
                  </td>
                  <td>  
               
                  
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
                  
                     <input type="file" name="3" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   />
                  
                     </div>
                  </td>
                  <td> 
               
                  
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
                  
                     <input type="file" name="6" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"  />
                     
                     </div>
                  </td>
                  <td> 
               
                  
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
                     
                     <input type="file" name="7" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"  />
                     
                     </div>
                  </td>
                  <td> 
                  
                  
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
                     
                     <input type="file" name="8" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   />
                     
                     </div>
                  </td>
                  <td>
                  
               
               </td>  
               </tr> </tbody>
                                 
               </table>
                     </div>
                     <div class="row mt-3 mx-0">
                     <div class="col-md-9">
                     <div class="form-row">
                        <label  for="email">Location:</label>
                        <input type="text" type="text" class="form-control col-md-1" name="location" placeholder="Location"  @if(!empty($app_doc))  value="{{ $veh_doc->location ?? ''}}" @else value="" @endif>&nbsp;
                        <label for="email">Floor:</label>
                        <input type="text" type="text" class="form-control col-md-1" name="floor" placeholder="floor" @if(!empty($app_doc)) value="{{ $veh_doc->floor ?? '' }}" @else value="" @endif>&nbsp;
                        <label for="email">Channel:</label>
                        <input type="text" type="text" class="form-control col-md-1" name="channel" placeholder="Channel" @if(!empty($app_doc)) value="{{ $veh_doc->channel ?? '' }}" @else value="" @endif>&nbsp;
                        <label for="email">Row:</label>
                        <input type="text" type="text" class="form-control col-md-1" name="row" placeholder="row" @if(!empty($app_doc)) value="{{ $veh_doc->row ?? '' }}" @else value="" @endif>&nbsp;
                        <label for="email">Note:</label>
                        <input type="text" type="text" class="form-control col-md-3" name="location_note" placeholder="note" @if(!empty($app_doc)) value="{{ $veh_doc->location_note ?? '' }}" @else value="" @endif>
                        
                     </div>
                        
                     </div>
                     <div class="col-md-3 text-right">
                     <a class="btn btn-info btn-sm">Scan Documents</a>                     
                     <input type="submit" value="{{ trans('button.save')}}" class="btn btn-success btn-sm" onClick="return validate()">
                     
                     </div>
                     </div>
                     
                     </form>
               

                <!-- document end -->
                </div>
               <div class="tab-pane ml-5" id="ntenant-info">
                    <form action="{{ route('vehicle-tenant.store') }}" method="POST">
                    @csrf
                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 mb-1">
                                    <label for="validationCustom01">{{ trans('common.name')}}:</label>
                                    <input type="hidden" name="vehicle_id" id="vehicle_id" value="">
                                    <input type="text" class="form-control"  value="" placeholder="Enter Name" name="tenant_name" required>
                                    </div>
                                    <div class="col-md-6 col-sm-6 mb-1">
                                    <label for="validationCustom01">{{ trans('common.province')}}:</label>
                                    <select name="province_code" class="form-control" id="tenant_province" required>
                                        <option value="" disabled>Select Province</option>
                                        
                                        <option value="pro-province_code">pro->name</option>
                                     
                                    </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6 mb-1">
                                    <label for="validationCustom01">{{ trans('common.district')}}:</label>
                                    <select class="form-control" name="district_code"  required="required" id="tenant_district">
                                        <option value="" selected disabled hidden>--Select District--</option>
                                    </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6 mb-1">
                                    <label for="validationCustom01">{{ trans('module4.village_name')}}:</label>
                                    <input type="text" class="form-control"  value="" placeholder="Enter Village" name="village" required>
                                    </div>
                                    <div class="col-md-6 col-sm-6 mb-1">
                                    <label for="validationCustom01">{{ trans('module4.tel')}}:</label>
                                    <input type="number" class="form-control"  value="" placeholder="Enter Phone" name="phone" required>
                                    </div>
                                    <div class="col-md-12 col-sm-12 mb-1">
                                    <label for="validationCustom01">{{ trans('module4.note')}}:</label>
                                    <textarea name="note"  class="form-control" cols="3" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-4 mt-5"><input type="file" name="image"></div>
                        </div>
                        <div class="col-md-12 col-sm-12 text-right mt-2">
                            <button class="btn btn-success btn-sm">{{ trans('button.save')}}</button>
                        </div>
                    </form>
                </div>
        </div>
 
  

 @push('page_scripts')
<script type="text/javascript">
   var dist_url = "{{url('getDistrict')}}";
</script>
<script type="text/javascript" src="{{asset('js/dropdownlist.js')}}"></script>
@endpush

