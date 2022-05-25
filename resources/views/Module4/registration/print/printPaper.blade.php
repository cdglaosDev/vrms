<style>
   #print-paper label,
   #print-paper span {
      font-size: 17px;
   }

   #print-paper .sp-span {
      font-size: 17px;
   }

   #print-paper input[type=checkbox] {
      transform: scale(1.25);
      margin-left: 5px;
      margin-top: -5px;
   }

   #print-paper {
      line-height: 17px;
   }

   #print-paper .col-md-12 {
      width: 100%;
   }

   #print-paper .text-center {
      text-align: center;
   }

   #print-paper .labelNo {
      width: 62px !important;
      display: inline-block;
   }

   #print-paper .labelDate {
      width: 100px;
      display: inline-block;
   }

   .print-paper {
      /* background-image: url(/images/pink2_16_1.jpg); */
      width: 1000px;
      margin-top: 0px !important;
      padding-top: 0px !important;
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

<div class="printPink1">
   <div class="card-body print-paper" id="print-paper">
      <div class="row" style="height:80px;">&nbsp;</div>
      <div style="line-height: 80%;">
         <h3 class="text-center" style="font-size:19px;margin-bottom: 0px;"><b>ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ</b></h3>
         <span style="display: block; text-align: center; font-size:17px;">ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາຍ ວັດທະນະຖາວອນ</span>
      </div>

      <div class="row " style="height:25px;">&nbsp;</div>

      <div class="row " style="height:15px;">
         <div style="width:100%;padding-left:30px;">
            <label>ກະຊວງ ໂຍທາທິການ ແລະ ຂົນສົ່ງ</label>
         </div>
      </div>
      <div class="row" style="height:30px;">
         <div style="width:24%;padding-left:30px;padding-top:13px;"><span>ພະແນກ ຍທຂ ປະຈຳແຂວງ</span></div>
         <div style="width:20%;padding-left:10px;padding-top:13px;">@if(isset($vehicle->province_no))<span class="dot-line-notuse">{{$vehicle->province_no}}</span>@else<span>&nbsp;</span>@endif</div>
         <div style="width:25%">&nbsp;</div>
         <div style="width:5%;"><span>ເລກທີ</span></div>
         <div style="width:20%"><span style="margin-right: 50px;">&nbsp;</span> <span>/ ຍທຂ</span></div>
         <!-- <div style="width:20%">@if(isset($vehicle->division_no))<span class="dot-line-notuse">{{$vehicle->division_no}}</span>@else<span>&nbsp;</span>@endif <span>/ ຍທຂ</span></div> -->
      </div>
      <div class="row" style="height:30px;">
         <div style="width:100%;padding-left:70px;padding-top:15px;font-size:17px;">
            <label>ກອງຄຸ້ມຄອງພາຫະນະ ແລະ ການຂັບຂີ່</label>
         </div>
      </div>

      <!-- ======================================================================== -->
      <div class="row " style="height:40px;">
         <div class="col-md-12 text-center">
            <h2 style="font-size:20px;padding-top:20px;font-size:24px;"><b>ບົດບັນທຶກກວດກາທາງດ້ານເອກະສານ</b></h2><br />
         </div>
      </div>

      <div class="row" style="height:25px;">&nbsp;</div>

      <div class="row" style="height:40px;">
         <div class="col-md-12">
            <label>- ອົງຕາມຂໍ້ກຳນົດ ວ່າດ້ວຍການຂຶ້ນທະບຽນ ແລະ ຄຸ້ມຄອງຍານພາຫະນະທາງບົກ ໃນ ສ ປ ປ ລາວ ສະບັບເລກທີ່ 829/ຄຂປກ ລົງວັນທີ 15/03/2020</label>
         </div>
      </div>
      <div class="row " style="height:50px;margin-top: 5px;margin-bottom: 5px;">
         <div style="width:30%;">&nbsp;</div>
         <div style="width:15%;padding-left:10px;padding-top:13px;"><span>ໝາຍເລກທະບຽນ</span></div>
         <div style="width:18%;padding-top:15px;padding-left:25px;border:1px solid #000">@if($vehicle->licence_no) <b><span style="font-size:28px;">{{$vehicle->licence_no}} </span></b>@else<b>&nbsp;</b>@endif</div>
         <div style="width:27%;padding: 13px 15px 10px 15px;">
            <span class="dot-line-notuse">
               @if($vehicle->vehicle_kind_code) <b>{{$vehicle->vehicle_kind->name ?? ''}} </b>@else<b>&nbsp;</b>
               @endif
            </span>
         </div>
      </div>

      <!-- ======================================================================== -->
      <div class="row " style="height:7px;">&nbsp;</div>

      <div class="row" style="height:30px;">
         <div style="width:20%;padding-left:30px;"><label>ອອກຊື່ເຈົ້າຂອງລົດ</label> </div>
         <div style="width:50%;">
            @if(isset($vehicle->owner_name)) <span class="dot-line-notuse"><b>{{$vehicle->owner_name}}</b></span>
            @else<span>&nbsp;</span> @endif
         </div>
      </div>

      <div class="row" style="height:28px;">
         <div style="width: 17%;padding-left:30px;"><span>ທີ່ຢູ່ປະຈຸບັນ ບ້ານ</span></div>
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

      <div class="row" style="height:30px;">
         <div style="width: 12%;padding-left:30px;"><label>ປະເພດລົດ</label></div>
         <div style="width: 12%;"><span class="dot-line-notuse"><b>{{$vehicle->vtype->name ?? ''}}</b></span></div>

         <div style="width: 3%;"><label>ຍີ່ຫໍ້</label></div>
         <div style="width: 20%;"><span class="dot-line-notuse"><b>{{$vehicle->vbrand->name ?? ''}}</b></span></div>

         <div style="width: 3%;"> <label>ລຸ້ນ</label> </div>
         <div style="width: 14%; "><span class="dot-line-notuse"><b>{{$vehicle->vmodel->name ?? ''}}</b></span></div>

         <div style="width: 4%;"> <label>ສີລົດ</label> </div>
         <div style="width: 9%; "><span class="dot-line-notuse "><b>{{$vehicle->color->name ?? ''}}</b></span></div>

         <div style="width: 9%;"> <label>ພວງມະໄລ</label> </div>
         <div style="width: 12%;"><span class="dot-line-notuse "><b>{{$vehicle->steering->name ?? ''}}</b></span></div>
      </div>

      <div class="row" style="height:30px;">
         <div style="width: 16%;padding-left:30px;"><label style="font-size:16px;">ໃຊ້ພະລັງງານ/ນ້ຳມັນ:</labe>
         </div>

         <div style="width: 3%;"><input type="checkbox" {{$vehicle->gas->name == "ແອັດຊັງ" ?"checked":""}}></div>
         <div style="width: 7%;"><span style="padding-left:5px;">ແອັດຊັງ</span></div>

         <div style="width: 2%;"><input type="checkbox" {{ $vehicle->gas->name == "ກາຊວນ" ?"checked":""}}></div>
         <div style="width: 7%;"><span style="padding-left:5px;">ກາຊວນ</span></div>

         <div style="width: 2%;"><input type="checkbox" {{ $vehicle->gas->name == "ໄຟຟ້າ" ?"checked":""}}></div>
         <div style="width: 6%;"><span style="padding-left:5px;">ໄຟຟ້າ</span></div>

         <div style="width: 2%;"><input type="checkbox" {{ $vehicle->gas->name == "ກາສ" ?"checked":""}}></div>
         <div style="width: 5%;"><span style="padding-left:5px;">ກາສ</span></div>

         <div style="width: 5%;"><label>ຍີ່ຫໍ້ຈັກ</label> </div>
         <div style="width: 14%;">
            @if($vehicle->motor_brand_id)<span class="dot-line-notuse pl-2"><b>{{$vehicle->moter_brand->name_en ?? ''}}</b></span>
            @else <b></b> @endif
         </div>

         <div style="width: 5%;"><label>ຈຳນວນ</label></div>
         <div style="width: 5%;">
            @if($vehicle->cylinder)<span class="dot-line-notuse" style="padding:0px">&nbsp;<b>{{$vehicle->cylinder ?? ''}}</b> </span>
            @endif
         </div>

         <div style="width: 10%;"><label>ສູບ, ຄວາມແຮງ</label></div>
         <div style="width: 8%;padding-left:5px;">
            @if($vehicle->cc)<span class="dot-line-notuse" style="padding:0px"><b>{{$vehicle->cc ?? ''}}</b>ຊີຊີ</span>
            @else <span><b>ຊີຊີ</b></span> @endif
         </div>
      </div>

      <div class="row" style="height: 25px;">
         <div style="width: 9%;padding-left:30px;"> <label>ເລກຈັກ</label> </div>
         <div style="width: 38%; padding-left:20px;">
            @if($vehicle->engine_no)<label style="font-weight: bold;font-family:Saysettha OT;">&nbsp;{{$vehicle->engine_no ?? ''}}</label>
            @else <b></b> @endif
         </div>
         <div style="width: 6%;"> <label>ເລກຖັງ</label></div>
         <div style="width: 42%;padding-left:20px;">
            @if($vehicle->chassis_no)<label style="font-weight: bold;font-family:Saysettha OT;">&nbsp;{{$vehicle->chassis_no ?? ''}}</label>
            @else <b></b> @endif
         </div>
      </div>

      <div class="row" style="height: 30px;padding-top:5px;">
         <div style="width: 20%;padding-left:30px;"> <label>ຂະໜາດຂອງລົດກ້ວາງ</label> </div>
         <div style="width: 9%;">
            @if($vehicle->width)<span class="dot-line-notuse"><b>&nbsp;{{$vehicle->width}}</b></span>&nbsp;
            @else <b>&nbsp;</b> @endif
         </div>
         <div style="width: 8%;"><label>ມມ, ຍາວ</label> </div>
         <div style="width: 8%; ">
            @if($vehicle->long)<span class="dot-line-notuse "><b>{{$vehicle->long}}</b></span>
            @else <b>&nbsp;</b> @endif
         </div>
         <div style="width: 8%;"><label>ມມ, ສູງ</label></div>
         <div style="width: 9%;">
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

      <div class="row" style="height: 30px;padding-top:5px;">
         <div style="width: 14%;padding-left:30px;"><label>ນ້ຳໜັກລົດເປົ່າ</label> </div>
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

      <div class="row " style="height: 30px; padding-top:4px;margin-bottom: 3px;">
         <div style="width: 12%;padding-left:27px;"><label>ຈຳນວນເພົາ</label></div>
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

      <div class="row" style="height:54px; margin-bottom: 3px;">
         <div style="width: 22%;padding-left:75px;padding-top:15px;"> <label>ຮອຍປະທັບເລກຈັກ</label></div>
         <div style="width: 68%;padding-left:15px;border:1px solid #000; padding-top:15px;"><label style="font-size:28px;font-family:Saysettha OT !important;font-weight: bold;">@if($vehicle->engine_no){{$vehicle->engine_no}} @else<b>&nbsp;</b>@endif </label></div>
      </div>
      <br>
      <div class="row" style="height:54px;">
         <div style="width: 22%;padding-left:75px;padding-top:15px;"> <label>ຮອຍປະທັບເລກຖັງ </label></div>
         <div style="width: 68%; padding-left: 10px;border:1px solid #000; padding-top:15px;"><span style="font-size:28px;font-family:Saysettha OT !important;font-weight: bold;">@if($vehicle->chassis_no){{$vehicle->chassis_no}} @else<b>&nbsp;</b>@endif </span></div>
      </div>

      <div class="row" style="height:23px;">&nbsp;</div>
      <div class="row" style="height:30px;padding-left:60px;">
         <label style="font-size:27px !important; text-decoration: underline;"><b>ເອກະສານທັງໝົດປະກອບມີ:</b></label>
      </div>

      <div class="row" style="height:25px;">
         <div style="width: 23%;margin-left:27px;"><span>1.ໃບອະນຸຍາດ ນຳລົດເຂົ້າ ຂອງ ຫ ສນຍ</span> </div>
         <div style="width: 12%;padding-left:2px;"><input type="checkbox" value="" {{ $vehicle->import_permit_hsny ==1?'checked':''}}> </div>
         <div style="width: 21%;"> <span>ກະຊວງແຜນການ ແລະ ການລົງທຶນ</span></div>
         <div style="width: 9%;padding-left:2px;"><input type="checkbox" value="" {{ $vehicle->import_permit_invest ==1?'checked':''}}></div>
         <div style="width: 4%;"> <label>ເລກທີ</label></div>
         <div style="width: 9%;padding-left:5px;">@if($vehicle->import_permit_no)<span class="dot-line-notuse"><b>{{$vehicle->import_permit_no}}</b></span>@else <span class="dot-line-notuse">&nbsp;</span> @endif</div>
         <div style="width: 6%;"><label for="">ລົງວັນທີ</label></div>
         <div style="width: 11%;padding-left:5px;">@if($vehicle->import_permit_date)<span class="dot-line-notuse"><b>{{$vehicle->import_permit_date}}</b></span>@else <span class="dot-line-notuse labelDate"></span> @endif </div>
      </div>

      <div class="row" style="height:25px;padding-top:5px;">
         <div style="width: 68%;padding-left:27px;"><span class="sp-span">2.ໃບແຈ້ງການຂອງກະຊວງອຸດສາຫະກຳແລະການຄ້າກ່ຽວກັບການອະນຸຍາດນຳເຂົ້າພາຫະນະ</span></div>
         <div style="width: 4%;"> <label>ເລກທີ</label></div>
         <div style="width: 9%; padding-left:5px;">@if($vehicle->industrial_doc_no)<span class="dot-line-notuse"><b>{{$vehicle->industrial_doc_no}}</b></span>@else <span class="dot-line-notuse">&nbsp;</span> @endif </div>
         <div style="width: 6%;"><label for="">ລົງວັນທີ</label></div>
         <div style="width: 11%;padding-left:5px;">@if($vehicle->industrial_doc_date)<span class="dot-line-notuse"><b>{{$vehicle->industrial_doc_date}}</b></span>@else <span class="dot-line-notuse labelDate">&nbsp;</span> @endif </div>
      </div>
      <div class="row" style="height:30px;padding-top:10px;">
         <div style="width: 68%;padding-left:27px;"><span class="sp-span" style="word-spacing: -4px;">3.ໃບອະນຸຍາດເຕັກນິກນຳເຂົ້າພາຫະນະກົນຈັກ ແລະ ຂຶ້ນທະບຽນຢູ່ ສ ປ ປ ລາວ ຂອງກົມຂົນສົ່ງ</span></div>
         <div style="width: 4%;"> <label>ເລກທີ</label></div>
         <div style="width: 9%; padding-left:5px;"> @if($vehicle->technical_doc_no)<span class="dot-line-notuse"><b>{{$vehicle->technical_doc_no}}</b></span>@else <span class="dot-line-notuse">&nbsp;</span> @endif </div>
         <div style="width: 6%;"><label for="">ລົງວັນທີ</label></div>
         <div style="width: 11%;padding-left:5px;"> @if($vehicle->technical_doc_date)<span class="dot-line-notuse"><b>{{$vehicle->technical_doc_date}}</b></span>@else <span class="dot-line-notuse labelDate">&nbsp;</span> @endif </div>
      </div>
      <div class="row" style="height:25px;padding-top:10px;">
         <div style="width: 68%;padding-left:27px;"><span>4.ໃບອະນຸຍາດ ນຳສິນຄ້າເຂົ້າປະເທດ ຂອງພະແນກການຄ້າ</span></div>
         <div style="width: 4%;"> <label>ເລກທີ</label></div>
         <div style="width: 9%; padding-left:5px;"> @if($vehicle->comerce_permit_no)<span class="dot-line-notuse"><b>{{$vehicle->comerce_permit_no}}</b></span>@else <span class="dot-line-notuse">&nbsp;</span> @endif </div>
         <div style="width: 6%;"><label for="">ລົງວັນທີ</label></div>
         <div style="width: 11%;padding-left:5px;"> @if($vehicle->comerce_permit_date)<span class="dot-line-notuse"><b>{{$vehicle->comerce_permit_date}}</b></span>@else <span class="dot-line-notuse labelDate">&nbsp;</span> @endif </div>
      </div>
      <div class="row" style="height:29px;padding-top:15px;">
         <div style="width: 23%;padding-left:27px;"><span>5.ໃບແຈ້ງເສັຍພາສີ ບ 10 ຫຼື ບ 40</span></div>
         <div style="width: 12%;"><input type="checkbox" value="" {{ $vehicle->tax_10_40 ==1?'checked':''}}> </div>
         <div style="width: 8%;"> <span>ຍົກເວັ້ນພາສີ</span></div>
         <div style="width: 7%;"> <input type="checkbox" value="" {{ $vehicle->tax_exam ==1?'checked':''}}> </div>
         <div style="width: 4%;"> <span> ບ 12 </span> </div>
         <div style="width: 5%;"><input type="checkbox" value="" {{ $vehicle->tax_12 ==1?'checked':''}}> </div>
         <div style="width: 4%;"> <span> ບ 50 </span></div>
         <div style="width: 5%;"><input type="checkbox" value="" {{ $vehicle->tax_50 ==1?'checked':''}}> </div>
         <div style="width: 4%;"> <label>ເລກທີ</label></div>
         <div style="width: 9%;padding-left:5px;"> @if($vehicle->tax_no)<span class="dot-line-notuse"><b>{{$vehicle->tax_no}}</b></span>@else <span class="dot-line-notuse labelNo">&nbsp;</span> @endif</div>
         <div style="width: 6%;"> <label for="">ລົງວັນທີ</label></div>
         <div style="width: 11%;padding-left:5px;"> @if($vehicle->tax_date)<span class="dot-line-notuse "><b>{{$vehicle->tax_date}}</b></span>@else <span class="dot-line-notuse labelDate"></span> @endif </div>
      </div>

      <div class="row " style="height:40px;padding-top:15px">
         <div style="width: 18%;padding-left:27px;"><span style="font-size:16px;">6.ໃບຢັ້ງຢືນ ການເສັຍພາສີ </span></div>
         <div style="width: 16%;padding-left:2px;"><input type="checkbox" value="" {{ $vehicle->tax_receipt ==1?'checked':''}}> </div>
         <div style="width: 17%;"><span>ຫຼື ໃບອະນຸຍາດຍົກເວັ້ນພາສີ</span></div>
         <div style="width: 17%;"><input type="checkbox" value="" {{ $vehicle->tax_permit ==1?'checked':''}}></div>
         <div style="width: 4%;"> <label>ເລກທີ</label></div>
         <div style="width: 9%;padding-left:5px;"> @if($vehicle->tax_payment_no)<span class="dot-line-notuse "><b>{{$vehicle->tax_payment_no}}</b></span>@else <span class="dot-line-notuse labelNo">&nbsp;</span> @endif</div>
         <div style="width: 6%;"> <label for="">ລົງວັນທີ</label></div>
         <div style="width: 11%;padding-left:5px;"> @if($vehicle->tax_payment_date)<span class="dot-line-notuse "><b>{{$vehicle->tax_payment_date}}</b></span>@else <span class="dot-line-notuse labelDate"></span> @endif </div>
      </div>

      <div class="row" style="height:30px;padding-top:5px;">
         <div style="width: 68%;padding-left:27px;"><span>7.ບັນທຶກການແກ້ຄະດີ ຂອງຄະນະກຳມະການ ກວດກາສະເພາະກິດ</span></div>
         <div style="width: 4%;"> <label>ເລກທີ</label></div>
         <div style="width: 9%;padding-left:5px;"> @if($vehicle->police_doc_no)<span class="dot-line-notuse"><b>{{$vehicle->police_doc_no}}</b></span>@else <span class="dot-line-notuse labelNo">&nbsp;</span> @endif </div>
         <div style="width: 6%;"> <label for="">ລົງວັນທີ</label></div>
         <div style="width: 11%;padding-left:5px;">@if($vehicle->police_doc_date)<span class="dot-line-notuse"><b>{{$vehicle->police_doc_date}}</b></span>@else <span class="dot-line-notuse labelDate">&nbsp;</span> @endif </div>
      </div>
      <div class="row" style="height:30px;padding-top:5px;">
         <div style="width: 20%;padding-left:27px;"><label>8.ຂໍ້ມູນເພີ່ມເຕີມອື່ນ</label></div>
         <div style="width: 77%;height: 13px;margin-right: 25px; border-bottom: 1px dotted black;"></div>
      </div>
      <div class="row" style="height:15px;width: 97%;margin-top: 3px;margin-left:15px; border-bottom: 1px dotted black;"></div>
      <div class="row" style="height:15px;width: 97%;margin-top: 15px;margin-left:15px;border-bottom: 1px dotted black;"></div>

      <div class="row" style="height:30px;margin-top: 12px; padding-top:5px;">
         <div style="width:100%;padding-left:27px;"> <label>ເອກະສານທັງໝົດນີ້ ໄດ້ກວດກາແລ້ວ ເຫັນວ່າຖືກຕ້ອງ ແລະ ອະນຸຍາດໃຫ້ຂື້ນທະບຽນໃໝ່ໄດ້</label></div>
      </div>
      <div class="row" style="height:30px;">
         <div style="width:63%;padding-left:27px;"> </div>
         <div style="width:2%"> <label>ທີ່</label></div>
         <div style="width:15%;"> @if($vehicle->location) <span class="dot-line-notuse"><b>{{ $vehicle->location }}</b></span>, @else <b>&nbsp;</b> @endif</div>
         <div style="width:4%;"> <label>ວັນທີ່</label> </div>
         <div style="width:11%;">@if($vehicle->issue_date) <span class="dot-line-notuse"><b>{{$vehicle->issue_date}}</b> </span> @else <b>&nbsp;</b> @endif</div>
      </div>
      <div class="row" style="height:20px;">
         <div style="width:33%;padding-left:27px;"> <label>ຫົວໜ້າພະແນກ ຍ ທ ຂ.</label> </div>
         <div style="width:34%;"> <label>ຫົວໜ້າກອງຄູ້ມຄອງພາຫະນະ </label> </div>
         <div style="width:30%;"> <label>ລາຍເຊັນ ຄະນະກວດກາເອກະສານ </label> </div>
      </div>

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
      <div class="row" style="position: fixed;bottom:1px;">
         <div class="col-md-12">
            <label>Application Form version 1.0 Staff</label>
         </div>
      </div>
   </div>
</div>