<style>
   #print-new-paper label,
   #print-new-paper span {
      font-size: 19px;
   }

   #print-new-paper #f-h {
      font-size: 21px !important;
   }

   #print-new-paper #s-h {
      font-size: 19px !important;
   }

   #print-new-paper #t-h {
      font-size: 26px !important;
   }

   #print-new-paper #fo-h {
      font-size: 27px !important;
   }

   #print-new-paper #l-no,
   #print-new-paper #e-no,
   #print-new-paper #c-no {
      font-size: 25px !important;
   }

   .r-m {
      margin-left: 5px;
   }

   #print-new-paper input[type=checkbox] {
      transform: scale(1.25);
      margin-left: 5px;
      margin-top: 1px;
   }

   #print-new-paper {
      line-height: 183%;
   }

   #print-new-paper .col-md-12 {
      width: 100%;
   }

   #print-new-paper .text-center {
      text-align: center;
   }

   #print-new-paper .labelNo {
      width: 62px !important;
      display: inline-block;
   }

   #print-new-paper .labelDate {
      width: 100px;
      display: inline-block;
   }

   .print-new-paper {
      /* width: 1100px; */
      margin: 0px !important;
      padding: 0px !important;
   }

   @page vertical {
      size: A4 portrait;
      margin: 0 !important;
   }

   .printPink1 {
      page: vertical;
   }
</style>
@php
$steer_id =\App\Model\Steering::whereStatus(1)->get();
$gases =\App\Model\Gas::get();

@endphp

<div class="card printPink1">
   <div class="card-body print-new-paper" id="print-new-paper">
      <div class="row" style="height:60px;">&nbsp;</div>
      <div style="line-height: 80%;">
         <h3 class="text-center" id="f-h" style="margin-bottom: 0px;"><b>ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ</b></h3>
         <span id="s-h" style="display: block; text-align: center;">ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາຍ ວັດທະນະຖາວອນ</span>
      </div>

      <!-- ======================================================================== -->
      <div class="row " style="height:15px;">&nbsp;</div>
      <!-- ======================================================================== -->
      <div class="row r-m">
         <div style="width:100%;">
            <label>ກະຊວງ ໂຍທາທິການ ແລະ ຂົນສົ່ງ</label>
         </div>
      </div>

      <div class="row r-m">
         <div style="width:24%;"><span>ພະແນກ ຍທຂ ປະຈຳແຂວງ</span></div>
         <div style="width:20%;padding-left:10px;">@if(isset($vehicle->province_no))<span class="dot-line-notuse">{{$vehicle->province_no}}</span>@else<span>&nbsp;</span>@endif</div>
         <div style="width:25%">&nbsp;</div>
         <div style="width:5%;"><span>ເລກທີ</span></div>
         <div style="width:20%">@if(isset($vehicle->division_no))<span class="dot-line-notuse">{{$vehicle->division_no}}</span>@else<span>&nbsp;</span>@endif <span>/ ຍທຂ</span></div>
      </div>
      <div class="row" style="margin-top: 5px;">
         <div style="width:100%;padding-left:60px;padding-top: 3px;">
            <label>ກອງຄູ້ມຄອງພາຫະນະ ແລະ ການຂັບຂີ່</label>
         </div>
      </div>

      <!-- ======================================================================== -->
      <div class="row" style="margin:15px 0px 15px 0px;">
         <div class="col-md-12 text-center">
            <h2 id="t-h"><b>ບົດບັນທຶກກວດກາທາງດ້ານເອກະສານ</b></h2>
         </div>
      </div>
      <!-- ======================================================================== -->
      <div class="row">
         <div class="col-md-12">
            <label>- ອົງຕາມຂໍ້ກຳນົດ ວ່າດ້ວຍການຂຶ້ນທະບຽນ ແລະ ຄູ້ມຄອງຍານພາຫະນະທາງບົກ ໃນ ສ ປ ປ ລາວ ສະບັບເລກທີ່ 829/ຄຂປກ ລົງວັນທີ 15/06/2000</label>
         </div>
      </div>
      <div class="row" style="height:56px;margin-top: 5px;margin-bottom: 10px;">
         <div style="width:30%;">&nbsp;</div>
         <div style="width:15%;padding-left:10px;padding-top:12px;"><span>ໝາຍເລກທະບຽນ</span></div>
         <div style="width:18%;padding-top:14px;padding-left:25px;border:1px solid #000">
            @if($vehicle->licence_no) <b><span id="l-no">{{$vehicle->licence_no ?? ''}} </span></b>@else<b>&nbsp;</b>
            @endif
         </div>
         <div style="width:27%;padding: 13px 15px 10px 15px;">
            <span class="dot-line-notuse">
               @if($vehicle->vehicle_kind_code) <b>{{$vehicle->vehicle_kind->name ?? ''}} </b>@else<b>&nbsp;</b>
               @endif
            </span>
         </div>
      </div>
      <!-- =======================================First Line================================= -->
      <div class="row r-m">
         <div style="width:20%;"><label>ອອກຊື່ເຈົ້າຂອງລົດ</label> </div>
         <div style="width:50%;">
            @if(isset($vehicle->owner_name))<span class="dot-line-notuse"><b>{{$vehicle->owner_name}}</b></span>
            @else<span>&nbsp;</span> @endif
         </div>
      </div>
      <!-- =======================================Second Line================================= -->
      <div class="row r-m">
         <div style="width: 17%;"><span>ທີ່ຢູ່ປະຈຸບັນ ບ້ານ</span></div>
         <div style="width: 21%;">
            @if($vehicle->village_name)<span class="dot-line-notuse"><b>&nbsp;{{$vehicle->village_name ?? ''}} </b></span>
            @else <b>&nbsp;</b> @endif
         </div>
         <div style="width: 5%;"><span>ເມືອງ</span></div>
         <div style="width: 23%; ">
            @if($vehicle->district_code)<span class="dot-line-notuse"><b>&nbsp;{{$vehicle->district->name ?? ''}}</b></span>
            @else <b>&nbsp;</b> @endif
         </div>
         <div style="width: 5%;"><span>ແຂວງ</span></div>
         <div style="width: 25%;">
            @if($vehicle->province_code) <span class="dot-line-notuse"><b>&nbsp;{{ $vehicle->province->name ?? ''}}</b></span>
            @else <b>&nbsp;</b> @endif
         </div>
      </div>
      <!-- ======================================Third Line================================== -->
      <div class="row r-m">
         <div style="width: 12%;"><label>ປະເພດລົດ</label></div>
         <div style="width: 12%;"><span class="dot-line-notuse"><b>{{$vehicle->vtype->name ?? ''}}</b></span></div>

         <div style="width: 3%;"><label>ຍີ່ຫໍ້</label></div>
         <div style="width: 25%;"><span class="dot-line-notuse"><b>{{$vehicle->vbrand->name ?? ''}}</b></span></div>

         <div style="width: 3%;"> <label>ລຸ້ນ</label> </div>
         <div style="width: 9%; "><span class="dot-line-notuse "><b>{{$vehicle->vmodel->name ?? ''}}</b></span></div>

         <div style="width: 4%;"> <label>ສີລົດ</label> </div>
         <div style="width: 9%; "><span class="dot-line-notuse "><b>{{$vehicle->color->name ?? ''}}</b></span></div>

         <div style="width: 9%;"> <label>ພວງມະໄລ</label> </div>
         <div style="width: 12%;"><span class="dot-line-notuse "><b>{{$vehicle->steering->name ?? ''}}</b></span></div>
      </div>
      <!-- ======================================Four Line================================== -->
      <div class="row r-m">
         <div style="width: 19%;"><span>ໃຊ້ພະລັງງານ/ນ້ຳມັນ:</span></div>

         <div style="width: 3%;"><input type="checkbox" {{ $vehicle->gas_id==1 ?"checked":""}}></div>
         <div style="width: 7%;"><span style="padding-left:5px;">ແອັດຊັງ</span></div>

         <div style="width: 2%;"><input type="checkbox" {{ $vehicle->gas_id==2 ?"checked":""}}></div>
         <div style="width: 7%;"><span style="padding-left:5px;">ກາຊວນ</span></div>

         <div style="width: 2%;"><input type="checkbox" {{ $vehicle->gas_id==3 ?"checked":""}}></div>
         <div style="width: 6%;"><span style="padding-left:5px;">ໄຟຟ້າ</span></div>

         <div style="width: 2%;"><input type="checkbox" {{ $vehicle->gas_id==4 ?"checked":""}}></div>
         <div style="width: 6%;"><span style="padding-left:5px;">ກາສ</span></div>

         <div style="width: 5%;"><label>ຍີ່ຫໍ້ຈັກ</label> </div>
         <div style="width: 9%;">
            @if($vehicle->motor_brand_id)<span class="dot-line-notuse pl-2"><b>{{$vehicle->moter_brand->name_en ?? ''}}</b></span>
            @else <b></b> @endif
         </div>

         <div style="width: 6%;"><label>ຈຳນວນ</label></div>
         <div style="width: 4%;">
            @if($vehicle->cylinder)<span class="dot-line-notuse" style="padding:0px">&nbsp;<b>{{$vehicle->cylinder ?? ''}}</b> </span>
            @endif
         </div>

         <div style="width: 12%;"><label>ສູບ, ຄວາມແຮງ</label></div>
         <div style="width: 7%;padding-left:5px;">
            @if($vehicle->cc)<span class="dot-line-notuse" style="padding:0px"><b>{{$vehicle->cc ?? ''}}</b></span>ຊີຊີ
            @else <b>ຊີຊີ</b> @endif
         </div>
      </div>
      <!-- ======================================Five Line================================== -->
      <div class="row r-m">
         <div style="width: 9%;"> <label>ເລກຈັກ</label> </div>
         <div style="width: 38%; padding-left:20px;">
            @if($vehicle->engine_no)<span class="dot-line-notuse"><b>&nbsp;{{$vehicle->engine_no ?? ''}}</b></span>
            @else <b></b> @endif
         </div>
         <div style="width: 6%;"> <label>ເລກຖັງ</label> </div>
         <div style="width: 42%;padding-left:20px;">
            @if($vehicle->chassis_no)<span class="dot-line-notuse"><b>&nbsp;{{$vehicle->chassis_no ?? ''}}</b></span>
            @else <b></b> @endif</div>
      </div>
      <!-- ======================================Six Line================================== -->
      <div class="row r-m">
         <div style="width: 20%;"> <label>ຂະໜາດຂອງລົດກ້ວາງ</label> </div>
         <div style="width: 10%;">
            @if($vehicle->width)<span class="dot-line-notuse"><b>&nbsp;{{$vehicle->width}}</b></span>&nbsp;
            @else <b>&nbsp;</b> @endif
         </div>
         <div style="width: 8%;"><label>ມມ, ຍາວ</label> </div>
         <div style="width: 9%; ">
            @if($vehicle->long)<span class="dot-line-notuse "><b>{{$vehicle->long}}</b></span>
            @else <b>&nbsp;</b> @endif
         </div>
         <div style="width: 8%;"><label>ມມ, ສູງ</label></div>
         <div style="width: 10%;">
            @if($vehicle->height)<span class="dot-line-notuse"><b>{{$vehicle->height}}</b></span>
            @else <b>&nbsp;</b> @endif
         </div>
         <div style="width: 16%;"><label>ມມ, ຈຳນວນບ່ອນນັ່ງ</label></div>
         <div style="width: 14%;">
            @if($vehicle->seat )<span class="dot-line-notuse"><b>&nbsp;{{$vehicle->seat}}</b></span>
            @else <b>&nbsp;</b> @endif
         </div>
         <div style="width: 5%;"><label for="">ຄົນ</label></div>
      </div>
      <!-- ======================================Seven Line================================== -->
      <div class="row r-m">
         <div style="width: 14%;"><label>ນ້ຳໜັກລົດເປົ່າ</label> </div>
         <div style="width: 16%;">
            @if($vehicle->weight) <span class="dot-line-notuse"><b>&nbsp;{{$vehicle->weight}}</b></span>&nbsp;
            @else @endif
         </div>
         <div style="width: 17%;"> <label>ກິໂລ, ນ້ຳໜັກບັນທຸກ</label> </div>
         <div style="width: 17%; ">
            @if($vehicle->weight_filled)<span class="dot-line-notuse pl-3"><b>&nbsp;{{$vehicle->weight_filled ??''}}</b></span>&nbsp;
            @else @endif
         </div>
         <div style="width: 14%;"> <label>ກິໂລ, ນ້ຳໜັກລວມ</label> </div>
         <div style="width: 15%;">
            @if($vehicle->total_weight) <span class="dot-line-notuse"><b>&nbsp;{{$vehicle->total_weight}}</b></span>&nbsp;
            @else @endif
         </div>
         <div style="width: 4%;"><label for="">ກິໂລ</label></div>
      </div>
      <!-- ======================================Eight Line================================== -->
      <div class="row r-m" style="margin-bottom: 3px;">
         <div style="width: 12%;"><label>ຈຳນວນເພົາ</label></div>
         <div style="width: 18%; ">
            @if($vehicle->axis)<span class="dot-line-notuse pl-3"><b>{{$vehicle->axis}}</b></span>&nbsp;
            @else @endif
         </div>
         <div style="width: 11%;"><label> ເພົາ, ຈຳນວນ</label></div>
         <div style="width: 22%;">
            @if($vehicle->wheels) <span class="dot-line-notuse"><b>{{$vehicle->wheels}}</b></span>&nbsp;
            @else @endif
         </div>
         <div style="width: 10%;"><label> ລໍ້, ປີຜະລິດ</label></div>
         <div style="width: 22%;">
            @if($vehicle->year_manufacture)<span class="dot-line-notuse"><b>{{$vehicle->year_manufacture}}</b></span>
            @else <b></b> @endif
         </div>
      </div>
      <!-- ============================================================================== -->
      <div class="row" style="height:63px;">
         <div style="width: 22%;padding-left:80px;padding-top:15px;"> <label>ຮອຍປະທັບເລກຈັກ</label></div>
         <div style="width: 65%;padding-left:15px;border:1px solid #000; padding-top:15px;">
            <span id="e-no">
               @if(isset($vehicle->engine_no))<b>{{$vehicle->engine_no}}</b>
               @else<b>&nbsp;</b>@endif
            </span>
         </div>
      </div>
      <br>
      <div class="row" style="height:63px;">
         <div style="width: 22%;padding-left:80px;padding-top:15px;"> <label>ຮອຍປະທັບເລກຖັງ </label></div>
         <div style="width: 65%; padding-left: 10px;border:1px solid #000; padding-top:15px;">
            <span id="c-no">
               @if(isset($vehicle->chassis_no))<b>{{$vehicle->chassis_no}}</b>
               @else<b>&nbsp;</b>@endif
            </span>
         </div>
      </div>
      <!-- ============================================================================== -->
      <div class="row" style="height:23px;">&nbsp;</div>
      <!-- ============================================================================== -->
      <div class="row" style="height:30px;padding-left:55px;">
         <label id="fo-h" style="text-decoration: underline;"><b>ເອກະສານທັງໝົດປະກອບນີ້:</b></label>
      </div>
      <!-- ========================================== 1. ==================================== -->
      <div class="row r-m">
         <div style="width: 33%;"><span>1.ໃບອະນຸຍາດ ນຳລົດເຂົ້າ ຂອງ ຫ ສນຍ</span> </div>
         <div style="width: 4%;padding-left:2px;"><input type="checkbox" value="" {{ $vehicle->import_permit_invest ==1?'checked':''}}> </div>
         <div style="width: 28%;"> <span>ກະຊວງແຜນການ ແລະ ການລົງທຶນ</span></div>
         <div style="width: 4%;padding-left:2px;"><input type="checkbox" value="" {{ $vehicle->import_permit_hsny ==1?'checked':''}}></div>
         <div style="width: 4%;"> <label>ເລກທີ</label></div>
         <div style="width: 9%;padding-left:5px;"> @if(isset($vehicle->import_permit_no))<span class="dot-line-notuse"><b>{{$vehicle->import_permit_no}}</b></span>@else <span class="dot-line-notuse">&nbsp;</span> @endif</div>
         <div style="width: 6%;"><label for="">ລົງວັນທີ</label></div>
         <div style="width: 11%;padding-left:5px;"> @if(isset($vehicle->import_permit_date))<span class="dot-line-notuse"><b>{{$vehicle->import_permit_date}}</b></span>@else <span class="dot-line-notuse labelDate"></span> @endif </div>
      </div>
      <!-- ========================================== 2. ==================================== -->
      <div class="row r-m">
         <div style="width: 69%;"><span>2.ໃບແຈ້ງການຂອງກະຊວງອຸດສາຫະກຳແລະການຄ້າກ່ຽວກັບການອະນຸຍາດນຳເຂົ້າພາຫະນະ</span></div>
         <div style="width: 4%;"> <label>ເລກທີ</label></div>
         <div style="width: 9%; padding-left:5px;">@if(isset($vehicle->industrial_doc_no))<span class="dot-line-notuse"><b>{{$vehicle->industrial_doc_no}}</b></span>@else <span class="dot-line-notuse">&nbsp;</span> @endif </div>
         <div style="width: 6%;"><label for="">ລົງວັນທີ</label></div>
         <div style="width: 11%;padding-left:5px;">@if(isset($vehicle->industrial_doc_date))<span class="dot-line-notuse"><b>{{$vehicle->industrial_doc_date}}</b></span>@else <span class="dot-line-notuse labelDate">&nbsp;</span> @endif </div>
      </div>
      <!-- ========================================== 3. ==================================== -->
      <div class="row r-m">
         <div style="width: 69%;"><span style="word-spacing: -4px;">3.ໃບອະນຸຍາດເຕັກນິກນຳເຂົ້າພາຫະນະກົນຈັກ ແລະ ຂຶ້ນທະບຽນຢູ່ ສ ປ ປ ລາວ ຂອງກົມຂົນສົ່ງ</span></div>
         <div style="width: 4%;"> <label>ເລກທີ</label></div>
         <div style="width: 9%; padding-left:5px;">@if(isset($vehicle->technical_doc_no))<span class="dot-line-notuse"><b>{{$vehicle->technical_doc_no}}</b></span>@else <span class="dot-line-notuse">&nbsp;</span> @endif </div>
         <div style="width: 6%;"><label for="">ລົງວັນທີ</label></div>
         <div style="width: 11%;padding-left:5px;">@if(isset($vehicle->technical_doc_date))<span class="dot-line-notuse"><b>{{$vehicle->technical_doc_date}}</b></span>@else <span class="dot-line-notuse labelDate">&nbsp;</span> @endif </div>
      </div>
      <!-- ========================================== 4. ==================================== -->
      <div class="row r-m">
         <div style="width: 69%;"><span>4.ໃບອະນຸຍາດ ນຳສິນຄ້າເຂົ້າປະເທດ ຂອງພະແນກການຄ້າ</span></div>
         <div style="width: 4%;"> <label>ເລກທີ</label></div>
         <div style="width: 9%; padding-left:5px;">@if(isset($vehicle->comerce_permit_no))<span class="dot-line-notuse"><b>{{$vehicle->comerce_permit_no}}</b></span>@else <span class="dot-line-notuse">&nbsp;</span> @endif </div>
         <div style="width: 6%;"><label for="">ລົງວັນທີ</label></div>
         <div style="width: 11%;padding-left:5px;">@if(isset($vehicle->comerce_permit_date))<span class="dot-line-notuse"><b>{{$vehicle->comerce_permit_date}}</b></span>@else <span class="dot-line-notuse labelDate">&nbsp;</span> @endif </div>
      </div>
      <!-- ========================================== 5. ==================================== -->
      <div class="row r-m">
         <div style="width: 31%;"><span>5.ໃບແຈ້ງເສັຍພາສີ ບ 10 ຫຼື ບ 40</span></div>
         <div style="width: 5%;"><input type="checkbox" value="" {{ $vehicle->tax_10_40 ==1?'checked':''}}> </div>
         <div style="width: 10%;"> <span>ຍົກເວັ້ນພາສີ</span></div>
         <div style="width: 5%;"> <input type="checkbox" value="" {{ $vehicle->tax_exam ==1?'checked':''}}> </div>
         <div style="width: 5%;"> <span> ບ 12 </span> </div>
         <div style="width: 4%;"><input type="checkbox" value="" {{ $vehicle->tax_12 ==1?'checked':''}}> </div>
         <div style="width: 5%;"> <span> ບ 50 </span></div>
         <div style="width: 4%;"><input type="checkbox" value="" {{ $vehicle->tax_50 ==1?'checked':''}}> </div>
         <div style="width: 4%;"> <label>ເລກທີ</label></div>
         <div style="width: 9%;padding-left:5px;">@if(isset($vehicle->tax_no))<span class="dot-line-notuse"><b>{{$vehicle->tax_no}}</b></span>@else <span class="dot-line-notuse labelNo">&nbsp;</span> @endif</div>
         <div style="width: 6%;"> <label for="">ລົງວັນທີ</label></div>
         <div style="width: 11%;padding-left:5px;">@if(isset($vehicle->tax_date))<span class="dot-line-notuse "><b>{{$vehicle->tax_date}}</b></span>@else <span class="dot-line-notuse labelDate"></span> @endif </div>
      </div>
      <!-- ========================================== 6. ==================================== -->
      <div class="row r-m">
         <div style="width: 22%;"><span>6.ໃບຢັ້ງຢືນ ການເສັຍພາສີ </span></div>
         <div style="width: 12%;padding-left:2px;"><input type="checkbox" value="" {{ $vehicle->tax_receipt ==1?'checked':''}}> </div>
         <div style="width: 22%;"><span>ຫຼື ໃບອະນຸຍາດຍົກເວັ້ນພາສີ</span></div>
         <div style="width: 13%;"><input type="checkbox" value="" {{ $vehicle->tax_permit ==1?'checked':''}}></div>
         <div style="width: 4%;"> <label>ເລກທີ</label></div>
         <div style="width: 9%;padding-left:5px;">@if(isset($vehicle->tax_payment_no))<span class="dot-line-notuse "><b>{{$vehicle->tax_payment_no}}</b></span>@else <span class="dot-line-notuse labelNo">&nbsp;</span> @endif</div>
         <div style="width: 6%;"> <label for="">ລົງວັນທີ</label></div>
         <div style="width: 11%;padding-left:5px;">@if(isset($vehicle->tax_payment_date))<span class="dot-line-notuse "><b>{{$vehicle->tax_payment_date}}</b></span>@else <span class="dot-line-notuse labelDate"></span> @endif </div>
      </div>
      <!-- ========================================== 7. ==================================== -->
      <div class="row r-m">
         <div style="width: 69%;"><span>7.ບັນທຶກການແກ້ຄະດີ ຂອງຄະນະກຳມະການ ກວດກາສະເພາະກິດ</span></div>
         <div style="width: 4%;"> <label>ເລກທີ</label></div>
         <div style="width: 9%;padding-left:5px;">@if(isset($vehicle->police_doc_no))<span class="dot-line-notuse"><b>{{$vehicle->police_doc_no}}</b></span>@else <span class="dot-line-notuse labelNo">&nbsp;</span> @endif </div>
         <div style="width: 6%;"> <label for="">ລົງວັນທີ</label></div>
         <div style="width: 11%;padding-left:5px;">@if(isset($vehicle->police_doc_date))<span class="dot-line-notuse"><b>{{$vehicle->police_doc_date}}</b></span>@else <span class="dot-line-notuse labelDate">&nbsp;</span> @endif </div>
      </div>
      <!-- ========================================== 8. ==================================== -->
      <div class="row r-m">
         <div style="width: 17%;"><label>8.ຂໍ້ມູນເພີ່ມເຕີມອື່ນ</label></div>
         <div style="width: 81%;height: 16px;margin-right: 20px; border-bottom: 1px dotted black;"></div>
      </div>
      <div class="row r-m" style="height:16px;width: 99%;margin-top: 3px;border-bottom: 1px dotted black;"></div>
      <div class="row r-m" style="height:16px;width: 99%;margin-top: 18px;border-bottom: 1px dotted black;"></div>
      <!-- ================================================================================= -->
      <div class="row r-m" style="margin-top: 12px;">
         <div style="width:100%;"> <label>ເອກະສານທັງໝົດນີ້ ໄດ້ກວດກາແລ້ວ ເຫັນວ່າຖືກຕ້ອງ ແລະ ອະນຸຍາດໃຫ້ຂື້ນທະບຽນໃໝ່ໄດ້</label></div>
      </div>
      <!-- ================================================================================= -->
      <div class="row">
         <div style="width:67%;;"> </div>
         <div style="width:2%"> <label>ທີ່</label></div>
         <div style="width:15%;">@if(isset($vehicle->location))<span class="dot-line-notuse"><b>{{ $vehicle->location }}</b></span>, @else <b>&nbsp;</b> @endif</div>
         <div style="width:4%;"> <label>ວັນທີ່</label> </div>
         <div style="width:11%;">@if(isset($vehicle->issue_date))<span class="dot-line-notuse"><b>{{$vehicle->issue_date}}</b> </span> @else <b>&nbsp;</b> @endif</div>
      </div>
      <!-- ================================================================================= -->
      <div class="row r-m">
         <div style="width:34%;"> <label>ຫົວໜ້າພະແນກ ຍ ທ ຂ.</label> </div>
         <div style="width:34%;"> <label>ຫົວໜ້າກອງຄູ້ມຄອງພາຫະນະ </label> </div>
         <div style="width:30%;"> <label>ລາຍເຊັນ ຄະນະກວດກາເອກະສານ </label> </div>
      </div>
      <!-- ================================================================================= -->
      <div class="row" style="padding-top:25px;">
         <div style="width:63%">&nbsp;</div>
         <div style="width:33%; text-align: right;">1.............................................................</div>
      </div>
      <div class="row" style="padding-top:20px;">
         <div style="width:63%">&nbsp;</div>
         <div style="width:33%; text-align: right;">2.............................................................</div>
      </div>
      <div class="row" style="padding-top:20px;">
         <div style="width:63%">&nbsp;</div>
         <div style="width:33%; text-align: right;">3.............................................................</div>
      </div>
      <!-- ================================================================================= -->
      <div class="row" style="position: fixed;bottom: 0px;">
         <div class="col-md-12">
            <label>Application Form version 1.0 Staff</label>
         </div>
      </div>
      <!-- ================================================================================= -->

   </div>
</div>