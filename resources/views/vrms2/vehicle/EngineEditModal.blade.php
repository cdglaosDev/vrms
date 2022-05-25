@php 
$vkind = \App\Model\VehicleKind::whereStatus(1)->get();
$pcode = \App\Model\Province::whereStatus(1)->get();
$dcode = \App\Model\District::whereStatus(1)->get();
$vtype = \App\Model\VehicleType::whereStatus(1)->get();
$vbrand = \App\Model\VehicleBrand::whereStatus(1)->get();
$vmodel = \App\Model\VehicleModel::whereStatus(1)->get();
@endphp

      <div class="modal-body">
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="engineInfo{{$vehicle->id}}">            
            <!-- engine info start -->
            <div>
               <table class="form-table vehicle-form">
                  <tbody>
                
                  <tr>
                     <td style="padding-right:0px; width: 350px;">
                        <b style="font-weight:bold">ອອກໃຫ້ວັນທີ:</b> 
                           <input class="w150 nvt-focused" name="issue_date" value="{{$vehicle->issue_date}}" focus="0" f="222">  
                        <div init="35000"></div><br>

                        <b style="font-weight:bold">ໝົດອາຍຸວັນທີ:</b> 
                           <input class="w150" name="expire_date" value="{{$vehicle->expire_date}}" f="222">
                        <div init="25001"></div><br>	

                        <b>ໝາຍເລກທະບຽນ:</b> 
                        <input class="w120 license_no" purpose_no="{{$vehicle->vehicle_kind_code}}" style="vertical-align:top;text-align:center;color:#f00;font-weight:bold;font-size:18px !important" name="number" f="222" value="{{$vehicle->licence_no}}">
                        <span style="color:#999">g2000</span><br>
                   
                                         
                        <b>ເປົ້າໝາຍ:</b>  
                        <select class="w120" f="222" name="vehicle_kind_code" id="">                             
                             <option value="" selected disabled hidden>Vehicle Kind</option>
                              @foreach($vkind as $vk)
                              <option value="{{$vk->vehicle_kind_code}}" {{$vk->vehicle_kind_code== $vehicle->vehicle_kind_code?"selected":""}}>{{ $vk->name }}&nbsp;({{$vk->name_en}})</option>
                              @endforeach                                            
                        </select>ເອກະຊົນລາວ<br>
                        
                         
                        <b>ຊື່ພາສາລາວ:</b> 
                           <input class="w120" name="owner_name issue_date" value="{{$vehicle->owner_name}}" f="222">
                        <br>


                        <b>ປະຈຸບັນຢູ່ ບ້ານ:</b> 
                           <input class="w120" name="" value="" f="222"><br>
                        
                        <b>ເມືອງ:</b>
                        <select name="district_code" class="w120" id="customer_district">                           
                              <option value="" selected disabled hidden>District</option>
                              @foreach($dcode as $dc)
                              <option value="{{$dc->district_code}}" {{$dc->district_code== $vehicle->district_code?"selected":""}}>{{ $dc->name }}&nbsp;({{$dc->name_en}})</option>
                              @endforeach

                        </select><br>
                        
                        
                        <b>ແຂວງ:</b>
                           <select class="w120" f="222" name="province_no" id="">  
                              <option value="" selected disabled hidden>Province</option>                            
                              @foreach($pcode as $pc)
                              <option value="{{$pc->province_no}}" {{$pc->province_no== $vehicle->province_no?"selected":""}}>{{ $pc->name }}&nbsp;({{$pc->name_en}})</option>
                              @endforeach                           
                           </select>6ຈປ<br>
                           
                        <b>ປະເພດລົດ:</b>
                        <select class="w120" name="vehicle_type_id" id="customer_vehicletype">
                              <option value="" selected disabled hidden>Vehicle Type</option>
                              @foreach($vtype as $vt)
                              <option value="{{$vt->id}}" {{$vt->id== $vehicle->vehicle_type_id?"selected":""}}>{{ $vt->name }}&nbsp;({{$vt->name_en}})</option>
                              @endforeach  
                        </select><br/>

                     </td>

                     <td style="padding-right:0px; width: 350px;">
                        <b>ຄວາມແຮງ(cc):</b> 
                        <input class="w120" name="cc" f="222" value="{{$vehicle->cc}}"><br>

                        <b>ຍີ່ຫໍ້:</b> 
                        <select class="w120" name="brand_id">
                           <option value="" selected disabled hidden>Vehicle Brand</option>
                           @foreach($vbrand as $vb)
                           <option value="{{$vb->id}}" {{$vb->id== $vehicle->brand_id?"selected":""}}>{{ $vb->name }}&nbsp;({{$vb->name_en}})</option>
                           @endforeach                             
                        </select><br/>

                        <b>ລຸ້ນ:</b> 
                        <select class="w120" name="model_id">
                           <option value="" selected disabled hidden>Vehicle Model</option>
                           @foreach($vmodel as $vm)
                           <option value="{{$vm->id}}" {{$vm->id== $vehicle->model_id?"selected":""}}>{{ $vm->name }}&nbsp;({{$vm->name_en}})</option>
                           @endforeach  
                        </select><br/>

                        <b>ເລກຈັກ:</b> 
                        <input style="width:162px;font-size:16px !important;font-family:dev_font !important" name="engine_no" onchange="this.value = this.value.replace(/[\;\:\.\,\/\\\s]/g, &quot;&quot;).toUpperCase()" f="222" value="{{$vehicle->engine_no}}"><br>
                        
                        <b>ເລກຖັງ:</b> 
                        <input style="width:162px;font-size:16px !important;font-family:dev_font !important" name="chassis_no" onchange="this.value = this.value.replace(/[\;\:\.\,\/\\\s]/g, &quot;&quot;).toUpperCase()" f="222" value="{{$vehicle->chassis_no}}"><br>

                        <b>ຈໍານວນບ່ອນນັ່ງ:</b> 
                        <input class="w120" name="seat" f="222" value="{{$vehicle->seat}}"><br>

                        <b>ນໍ້າໜັກລົດເປົ່າ:</b> 
                        <input class="w120" name="weight" f="222" value="{{$vehicle->weight}}"><br>
                        
                        <b>ນໍ້າໜັກບັກທຸກ:</b> 
                        <input class="w120" name="weight_filled" f="222" value="{{$vehicle->weight_filled}}"><br>

                        <b>ນໍ້າໜັກລວມ:</b> 
                        <input class="w120" name="total_weight" f="222" value="{{$vehicle->total_weight}}"><br>
             
                        <b>ຈໍານວນເພົາ:</b> 
                        <input class="w20" name="axis" f="222" value="{{$vehicle->axis}}">                           
                         
                        <b class="w60" style="width: 60px !important">ຈໍານວນລໍ້:</b> 
                        <input class="w20" name="wheels" f="222" value="{{$vehicle->wheels}}"><br>

                        <b>ເງິນການເງິນເກັບ:</b> 
                        <input class="w120" name="money_collection" f="222" value=""> 
                        <br>

                        <b>ເລີ່ມນຳໃຊ້ວັນທີ:</b> 
                        <input class="w120" name="fax" value="" f="222"><div init="111"></div><br>                          
                                
                                           
                     </td>

                     
                  </tr>
                 
                  </tbody>
               </table>
            </div>

           <!-- engine info end -->
         </div>
                     
        </div>
      </div>
  

 @push('page_scripts')
<script type="text/javascript">
   var dist_url = "{{url('getDistrict')}}";
</script>
<script type="text/javascript" src="{{asset('js/dropdownlist.js')}}"></script>
@endpush

