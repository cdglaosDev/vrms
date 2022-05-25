<style>
   #printPaper h3,
   #printPaper h4 {

      font-size: 25px;
   }

   #printPaper label,
   #printPaper span {
      font-size: 20px;
   }

   #printPaper input[type=checkbox] {
      transform: scale(2);
      margin-left: 10px;
   }

   .print-page {
      line-height: 17px;
   }

   .print-page .col-md-1,
   .print-page .col-md-2,
   .print-page .col-md-3,
   .print-page .col-md-4,
   .print-page .col-md-5,
   .print-page .col-md-6,
   .print-page .col-md-7,
   .print-page .col-md-8,
   .print-page .col-md-9,
   .print-page .col-md-10,
   .print-page .col-md-11,
   .print-page .col-md-12 {
      float: left;
   }

   .print-page .col-md-12 {
      width: 100%;
   }

   .print-page .col-md-11 {
      width: 91.66666666666666%;
   }

   .print-page .col-md-10 {
      width: 83.33333333333334%;
   }

   .print-page .col-md-9 {
      width: 75%;
   }

   .print-page .col-md-8 {
      width: 66.66666666666666%;
   }

   .print-page .col-md-7 {
      width: 58.333333333333336%;
   }

   .print-page .col-md-6 {
      width: 50%;
   }

   .print-page .col-md-5 {
      width: 41.66666666666667%;
   }

   .print-page .col-md-4 {
      width: 33.33333333333333%;
   }

   .print-page .col-md-3 {
      width: 25%;
   }

   .print-page .col-md-2 {
      width: 16.666666666666664%;
   }

   .print-page .col-md-1 {
      width: 8.333333333333332%;
   }

   .print-page .text-center {
      text-align: center;
   }

   .print-page .mb-1 {
      margin-bottom: 0.25rem;
   }
</style>
@php

$type =\App\Model\VehicleType::whereStatus(1)->get();
$vehicle_kinds =\App\Model\VehicleKind::orderBy('order_by')->get();
$steer_id =\App\Model\Steering::whereStatus(1)->get();
$gases =\App\Model\Gas::whereStatus(1)->get();

@endphp
@if(isset($app_number))
@php
$app_purposes = \App\Model\AppFormPurpose::whereAppFormId($data->id)->pluck('app_purpose_id')->toArray();
@endphp
<div class="card" style="width: 100%; border: none !important">
   <div class="card-body print-page">
      <h3 class="text-center"><b>ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ</b></h3>
      <h3 class="text-center">ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນະຖາວອນ</h3>
      <br />
      <br />
      <div class="row">
         <div class="col-md-10 col-md-offset-4">
            <h4>ກະຊວງ ໂຍທາທິການ ແລະ ຂົນສົ່ງ</h4>
            <h4>ພະແນກ ຍທຂ ແຂວງ : &nbsp;&nbsp;@if(isset($data->vehicle->province_code))<span class="dot-line"><b>{{$data->vehicle->province->name}}</b></span>@else<span>........................................................</span>@endif</h4>
            <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ກອງຄຸ້ມຄອງພາຫະນະ ແລະ ການຂັບຂີ່</h4>
         </div>

         <div class="col-md-2" style="margin-top:-20px">
            <div> {!! QrCode::size(150)->generate('http://vrms.bm/search-app-number?q='.$data->app_no) !!}
               <span style="margin-left: 30px"> {{ $data->app_no ?? ''}}</span>
            </div>
         </div>

      </div>
      <br />
      <br />
      <div class="row">
         <div class="col-md-12 text-center">
            <h2 style="font-size:40px;"><b>ໃບຄຳຮ້ອງ</b></h2><br />
            <h4>ຮຽນ : ທ່ານຫົວໜ້າກອງ ຄຸ້ມຄອງພາຫະນະ ແລະ ການຂັບຂີ່</h4>
         </div>

      </div>

      <div class="row">
         <div class="col-md-12">
            <div class="row mb-1">
               <div class="col-md-12">
                  <label for="test">ຂ້າພະເຈົ້າຊື່:</label>
                  @if(isset($data->vehicle->owner_name))<span class="dot-line"><b>{{$data->vehicle->owner_name}}</b></span>
                  @else<span>......................................................................................................................................................................................................................................................</span>@endif
               </div>
            </div>
            <div class="row mb-1">
               <div class="col-md-5">
                  <label for="test">ທີ່ຢູ່ປະຈຸບັນ ບ້ານ</label>
                  @if($data->vehicle->village_name)<span class="dot-line"><b>&nbsp;{{$data->vehicle->village_name}} </b></span>@else <b>.........................</b> @endif
               </div>
               <div class="col-md-7">
                  <label for="test">ເມືອງ</label>
                  @if($data->vehicle->district_code)<span class="dot-line"><b>&nbsp;{{$data->vehicle->district->name}}</b>
                  </span> @else <b>..................</b> @endif
                  <label for="test">ແຂວງ</label>
                  @if($data->vehicle->province_code) <span class="dot-line"><b>&nbsp;{{ $data->vehicle->province->name}}</b>
                  </span> @else <b>..................</b> @endif
                  <label for="test">ໂທລະສັບ:</label>
                  <span style="color: #000;"><b>.........</b>
                  </span>
               </div>


            </div>
            <br />
            <div class="row mb-1">
               <div class="col-md-12">
                  <h4 for="test">&nbsp;&nbsp;&nbsp;&nbsp;ຂໍຖືເປັນກຽດຮຽນມາຍັງທ່ານເພື່ອ:</h4>
               </div>

               <div class="col-md-4 mb-3">
                  <input type="checkbox" value="1" {{ in_array(1, $app_purposes)? 'checked':''}}>&nbsp;<span style="margin-left: 5px">{{str_replace(array('{','}','"','[',']'),'',json_encode(\App\Model\ApplicationType::where('id',1)->pluck('name'),JSON_PRESERVE_ZERO_FRACTION+JSON_UNESCAPED_UNICODE))}}</span>
               </div>
               <div class="col-md-3 mb-3">
                  <input type="checkbox" value="2" {{ in_array(2, $app_purposes)? 'checked':''}}>&nbsp; <span style="margin-left: 5px">{{str_replace(array('{','}','"','[',']'),'',json_encode(\App\Model\ApplicationType::where('id',2)->pluck('name'),JSON_PRESERVE_ZERO_FRACTION+JSON_UNESCAPED_UNICODE))}}</span>
               </div>
               <div class="col-md-3 mb-3">
                  <input type="checkbox" value="3" {{ in_array(3, $app_purposes)? 'checked':''}}>&nbsp; <span style="margin-left: 5px">{{str_replace(array('{','}','"','[',']'),'',json_encode(\App\Model\ApplicationType::where('id',3)->pluck('name'),JSON_PRESERVE_ZERO_FRACTION+JSON_UNESCAPED_UNICODE))}}</span>
               </div>
               <div class="col-md-2 mb-3">
                  <input type="checkbox" value="4" {{ in_array(4, $app_purposes)? 'checked':''}}>&nbsp; <span style="margin-left: 5px">{{str_replace(array('{','}','"','[',']'),'',json_encode(\App\Model\ApplicationType::where('id',4)->pluck('name'),JSON_PRESERVE_ZERO_FRACTION+JSON_UNESCAPED_UNICODE))}}</span>
               </div>

               <div class="col-md-4 mb-3">
                  <input type="checkbox" value="5" {{ in_array(5, $app_purposes)? 'checked':''}}>&nbsp;<span style="margin-left: 5px">{{str_replace(array('{','}','"','[',']'),'',json_encode(\App\Model\ApplicationType::where('id',5)->pluck('name'),JSON_PRESERVE_ZERO_FRACTION+JSON_UNESCAPED_UNICODE))}}</span>
               </div>
               <div class="col-md-3 mb-3">
                  <input type="checkbox" value="6" {{ in_array(6, $app_purposes)? 'checked':''}}>&nbsp; <span style="margin-left: 5px">{{str_replace(array('{','}','"','[',']'),'',json_encode(\App\Model\ApplicationType::where('id',6)->pluck('name'),JSON_PRESERVE_ZERO_FRACTION+JSON_UNESCAPED_UNICODE))}}</span>
               </div>
               <div class="col-md-5 mb-3">
                  <input type="checkbox" value="7" {{ in_array(7, $app_purposes)? 'checked':''}}>&nbsp; <span style="margin-left: 5px">{{str_replace(array('{','}','"','[',']'),'',json_encode(\App\Model\ApplicationType::where('id',7)->pluck('name'),JSON_PRESERVE_ZERO_FRACTION+JSON_UNESCAPED_UNICODE))}}</span>
               </div>

               <div class="col-md-4 mb-3">
                  <input type="checkbox" value="8" {{ in_array(8, $app_purposes)? 'checked':''}}>&nbsp; <span style="margin-left: 5px; margin-right: 15px">{{str_replace(array('{','}','"','[',']'),'',json_encode(\App\Model\ApplicationType::where('id',8)->pluck('name'),JSON_PRESERVE_ZERO_FRACTION+JSON_UNESCAPED_UNICODE))}}</span>
               </div>
               <div class="col-md-3 mb-3">
                  <input type="checkbox" value="9" {{ in_array(9, $app_purposes)? 'checked':''}}>&nbsp; <span style="margin-left: 5px; margin-right: 30px">{{str_replace(array('{','}','"','[',']'),'',json_encode(\App\Model\ApplicationType::where('id',9)->pluck('name'),JSON_PRESERVE_ZERO_FRACTION+JSON_UNESCAPED_UNICODE))}}</span>
               </div>
               <div class="col-md-5 mb-3">
                  <input type="checkbox" value="10" {{ in_array(10, $app_purposes)? 'checked':''}}>&nbsp; <span style="margin-left: 5px">{{str_replace(array('{','}','"','[',']'),'',json_encode(\App\Model\ApplicationType::where('id',10)->pluck('name'),JSON_PRESERVE_ZERO_FRACTION+JSON_UNESCAPED_UNICODE))}} </span>
               </div>
            </div>
            <div class="row mb-2">
               <div class="col-md-12">
                  <h4 for="test">&nbsp;&nbsp;&nbsp;&nbsp;ລົດຄັນດັ່ງກ່າວເປັນກໍາມະສິດ:</h4>
               </div>
               @foreach($vehicle_kinds as $value)
               @if($value->vehicle_kind_code == 6)
               <div class="col-md-2  mb-3">
                  <input type="checkbox" name="vehicle_type_id[]" value="{{$value->vehicle_kind_code}}" {{$value->vehicle_kind_code == $data->vehicle->vehicle_kind_code ?"checked":""}}><span style="margin-left: 20px">{{"ລັດ"}}</span>
               </div>
               @endif
               @if($value->vehicle_kind_code == 2)
               <div class="col-md-4  mb-3">
                  <input type="checkbox" name="vehicle_type_id[]" value="{{$value->vehicle_kind_code}}" {{$value->vehicle_kind_code == $data->vehicle->vehicle_kind_code ?"checked":""}}><span style="margin-left: 20px">{{"ລົງທຶນຕ່າງປະເທດ 1%"}}</span>
               </div>
               @endif
               @if($value->vehicle_kind_code == 3)
               <div class="col-md-3  mb-3">
                  <input type="checkbox" name="vehicle_type_id[]" value="{{$value->vehicle_kind_code}}" {{$value->vehicle_kind_code == $data->vehicle->vehicle_kind_code ?"checked":""}}><span style="margin-left: 20px">{{"ວິສາຫະກິດ, ທຸລະກິດ"}}</span>
               </div>
               @endif
               @if($value->vehicle_kind_code == 5)
               <div class="col-md-3  mb-3">
                  <input type="checkbox" name="vehicle_type_id[]" value="{{$value->vehicle_kind_code}}" {{$value->vehicle_kind_code == $data->vehicle->vehicle_kind_code ?"checked":""}}><span style="margin-left: 20px">{{"ອົງການຈັດຕັ້ງສາກົນ"}}</span>
               </div>
               @endif
               @if($value->vehicle_kind_code == 1)
               <div class="col-md-2  mb-3">
                  <input type="checkbox" name="vehicle_type_id[]" value="{{$value->vehicle_kind_code}}" {{$value->vehicle_kind_code == $data->vehicle->vehicle_kind_code ?"checked":""}}><span style="margin-left: 20px">{{"ເອກະຊົນ"}}</span>
               </div>
               @endif
               @if($value->vehicle_kind_code == 4)
               <div class="col-md-3  mb-3">
                  <input type="checkbox" name="vehicle_type_id[]" value="{{$value->vehicle_kind_code}}" {{$value->vehicle_kind_code == $data->vehicle->vehicle_kind_code ?"checked":""}}><span style="margin-left: 20px">{{"ເອກະຊົນຕ່າງດ້າວ"}}</span>
               </div>
               @endif
               @if($value->vehicle_kind_code == 8)
               <div class="col-md-4  mb-3">
                  <input type="checkbox" name="vehicle_type_id[]" value="{{$value->vehicle_kind_code}}" {{$value->vehicle_kind_code == $data->vehicle->vehicle_kind_code ?"checked":""}}><span style="margin-left: 20px">{{"ໂຄງການ (ນໍາເຂົ້າຊົ່ວຄາວ)"}}</span>
               </div>
               @endif
               @endforeach
            </div>
            <div class="row mb-2">
               <div class="col-md-12">
                  <h4 for="test">&nbsp;&nbsp;&nbsp;&nbsp;ຂໍ້ມູນດ້ານເຕັກນິກ ມີລາຍການລະອຽດດັ່ງລຸ່ມນີ້</h4>
                  <div class="row mb-2">
                     <div class="col-md-3 mt-3">
                        <label for="test">ປະເພດລົດ</label>
                        <span class="dot-line"><b>&nbsp;{{$data->vehicle->vtype->name ?? ''}}</b>
                        </span>
                     </div>
                     <div class="col-md-2 mt-3">
                        <label for="test">ຍີ່ຫໍ້</label>
                        <span class="dot-line"><b>&nbsp;{{$data->vehicle->vbrand->name ?? ''}}</b>
                        </span>
                     </div>
                     <div class="col-md-3 mt-3">
                        <label for="test">ລຸ້ນ</label>
                        <span class="dot-line"><b>&nbsp;{{$data->vehicle->vmodel->name ?? ''}}</b>
                        </span>&nbsp;&nbsp;
                        <label for="test">ສີ</label>
                        <span class="dot-line"><b>&nbsp;{{$data->vehicle->color->name ?? ''}}</b>
                        </span>
                     </div>

                     <div class="col-md-4">
                        <label for="test">ພວງມະໄລ</label>
                        <span style="color: #000;">
                           @foreach($steer_id as $value)
                           @if($value->name != "-")
                           <label>
                              <input type="checkbox" name="steering_id[]" value="{{$value->id}}" {{$value->id == $data->vehicle->steering_id ?"checked":""}}> <span style="margin-left: 10px; margin-right:5px;">{{$value->name}}</span>
                           </label>
                           @endif
                           @endforeach

                        </span>
                     </div>
                  </div>

                  <div class="row mb-3">
                     <div class="col-md-6">
                        <label for="test">ໃຊ້ນ້ຳມັນ</label>
                        <span style="color: #000;">@foreach($gases as $value)
                           <label>
                              <input type="checkbox" name="gas_id[]" value="{{$value->id}}" {{$value->id == $data->vehicle->gas_id ?"checked":""}}><span style="margin-left: 10px"> {{$value->name}}</span>
                           </label>
                           @endforeach
                        </span>
                     </div>
                     <div class="col-md-6 mt-3">
                        <label for="test">ຍີ່ຫໍ້ຈັກ</label>
                        @if($data->vehicle->motor_brand_id) <span class="dot-line">&nbsp;<b>{{$data->vehicle->moter_brand->name_en}}</b></span> @else <b>.......................</b> @endif
                        &nbsp; <label for="test">ຈຳນວນ</label>
                        @if($data->vehicle->cylinder) <span class="dot-line"><b>&nbsp;{{$data->vehicle->cylinder}}</b> </span> @else <b>.......................</b>@endif
                        <label for="test">ສູບ</label>
                        @if($data->vehicle->cc) <span class="dot-line""><b>&nbsp;{{$data->vehicle->cc}}</b>
                        </span>&nbsp;<span>ຊີຊີ</span> @else <b>.............<span>ຊີຊີ</span></b> @endif
                     </div>
                  </div>
                  
                  <div class="row mb-2">
                           <div class="col-md-6 mb-3">
                              <label for="test">ເລກຈັກ</label>
                              @if($data->vehicle->engine_no)<span class="dot-line" style="font-weight: bold;font-family:Saysettha OT;">&nbsp;{{$data->vehicle->engine_no}}
                              </span> @else <b>..............</b> @endif
                           </div>
                           <div class="col-md-6 mb-3">
                              <label for="test">ເລກຖັງ</label>
                              @if($data->vehicle->chassis_no)<span class="dot-line" style="font-weight: bold;font-family:Saysettha OT;">&nbsp;{{$data->vehicle->chassis_no}}
                              </span>@else <b>..............</b> @endif
                           </div>
                           <div class="col-md-4 mb-3">
                              <label for="test">ລົດມີຂະໜາດ ກ້ວາງ</label>
                              @if($data->vehicle->width)<span class="dot-line"><b>&nbsp;{{$data->vehicle->width}}</b>
                              </span>&nbsp; <span>ມມ</span>, @else <b>...........<span>ມມ</span>,</b> @endif
                           </div>
                           <div class="col-md-4 mb-3">
                              <label for="test">ຍາວ</label>
                              @if($data->vehicle->long)<span class="dot-line"><b>&nbsp;{{$data->vehicle->long}}</b>
                              </span>&nbsp; <span>ມມ</span>, @else <b>............<span>ມມ</span>,</b> @endif
                           </div>
                           <div class="col-md-4 mb-3">
                              <label for="test">ສູງ</label>
                              @if($data->vehicle->height)<span class="dot-line"><b>&nbsp;{{$data->vehicle->height}}</b>
                              </span>&nbsp;<span>ມມ</span> @else <b>............<span>ມມ</span></b> @endif
                           </div>
                     </div>
                     <div class="row mb-2">
                        <div class="col-md-4 mb-2">
                           <label for="test">ຈຳນວນບ່ອນນັ່ງຜູ້ໂດຍສານ</label>
                           @if($data->vehicle->seat ) <span class="dot-line"><b>&nbsp;{{$data->vehicle->seat}}</b>
                           </span>&nbsp;<span>ຄົນ</span>, @else <b>.............<span>ຄົນ</span>,</b> @endif
                        </div>
                        <div class="col-md-4">
                           <label for="test">ນ້ຳໜັກລົດ</label>
                           @if($data->vehicle->weight) <span class="dot-line"><b>&nbsp;{{$data->vehicle->weight}}</b>
                           </span>&nbsp;<span>ກິໂລ</span>, @else <b>............<span>ກິໂລ</span>,</b> @endif
                        </div>
                        <div class="col-md-4">
                           <label for="test">ນ້ຳໜັກບັນທຸກ</label>
                           <span class="dot-line"><b>&nbsp;{{$data->vehicle->weight_filled ??''}}</b>
                           </span>&nbsp;ກິໂລ
                        </div>
                     </div>
                     <div class="row mb-2">
                        <div class="col-md-4">
                           <label for="test">ນ້ຳໜັກລວມ</label>
                           @if($data->vehicle->total_weight) <span class="dot-line"><b>&nbsp;{{$data->vehicle->total_weight}}</b>
                           </span>&nbsp;<span>ກິໂລ</span> @else <b>............<span>ກິໂລ</span></b> @endif
                        </div>
                        <div class="col-md-4">
                           <label for="test">ນ້ຳໜັກເພົາໜ້າ</label>
                           <span style="color: #000;"><b></b>..............ກິໂລ
                           </span>
                        </div>
                        <div class="col-md-4">
                           <label for="test">ນ້ຳໜັກເພາຫຼັງ</label>
                           <span style="color: #000;"><b></b>..............ກິໂລ
                           </span>
                        </div>
                     </div>
                     <div class="row mb-2">
                        <div class="col-md-6">
                           <label for="test">ຫມາຍເລກທະບຽນທີ່ໃຊ້ປະຈຸບັນ</label>
                           @if($data->vehicle->licence_no) <span class="dot-line"><b>&nbsp;{{ $data->vehicle->licence_no}}</b>
                           </span> @else <b>..............</b> @endif
                        </div>
                        <div class="col-md-6">
                           <label for="test">ວັນທີ່ຈົດທະບຽນ</label>
                           <span style="color: #000;"><b>......................................................</b>
                           </span>
                        </div>
                     </div>
                     <div class="row mb-4">
                        <div class="col-md-12 mt-1">
                           <label for="test">&nbsp;&nbsp;&nbsp;&nbsp;ຜົນການກວດກາລົດຕົວຈິງຂອງໜ່ວຍງານກວດກາສະພາບເຕັກນິກລົດ ເຫັນວ່າ</label>
                           <span style="color: #000;"><b>.............................................................</b></span><br /><br />
                           <span style="color: #000;"><b> ...............................................................................................................................................................................</b></span><br /><br />
                           <span style="color: #000;"><b> ...............................................................................................................................................................................</b>
                           </span>
                        </div>
                     </div>

                     <div class="row mb-3">
                        <div class="col-md-6">
                           <label for="test" style="font-size:30px;"><b>ເລກທະບຽນໃໝ່</b></label>&nbsp;
                           <span style=" border: 2px solid #666666; padding: 7px 200px 7px 15px; ">
                           </span>

                        </div>
                        <div class="col-md-3">
                           <label for="test">ທີ່</label>
                           @if($data->vehicle->location) <span style=" border-bottom: 2px dotted #666666;"><b>{{ $data->vehicle->location }}</b></span>, @else <b>................</b> @endif

                        </div>
                        <div class="col-md-3">
                           <label for="test">ວັນທີ</label>
                           @if($data->vehicle->issue_date) <span style="color: #000"><b>{{$data->vehicle->issue_date}}</b> </span> @else <b>...............</b> @endif

                        </div>
                     </div>
                     <br />
                     <div class="row">
                        <div class="col-md-4">
                           <label for="test">ຫົວໜ້າກອງ</label>
                           <span style="color: #000;"><b></b>
                           </span>
                        </div>
                        <div class="col-md-4">
                           <label for="test">ຜູ້ກວດກາເຕັກນິກ</label>
                           <span style="color: #000;"><b></b>
                           </span>
                        </div>
                        <div class="col-md-4">
                           <label for="test">ຜູ້ຮ້ອງຂໍ </label>
                           <span style="color: #000;"><b></b>
                           </span>
                        </div>
                     </div>

                     <div class="row" style="position: fixed;bottom:0px">
                        <div class="col-md-12">
                           <label for="test">Application Form version 1.0 Staff</label>
                           </span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   @endif