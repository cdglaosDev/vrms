@php
$vehicle_kinds =\App\Model\VehicleKind::get();
$book = \App\Model\BookCss::first();
@endphp
<style>
   #book,
   .certificate {
      margin-top: 0px;
      padding: 0px;
   }

   .row,
   .col-md-2,
   .col-md-4,
   .col-md-3,
   .col-md-5,
   .col-md-7.col-md-6,
   .col-md-9,
   .col-md-8,
   .row label {
      margin-top: 0px;
      margin-bottom: 0px;
      padding-top: 0px;
      padding-bottom: 0px;
   }

   @page {
      size: auto;
      margin-top: 7mm;
   }

   #book input[type=checkbox] {
      transform: scale(1.25);
   }

   #book .padding-row {
      padding-top: 0px;
   }

   /* css from database*/
   .owner_name_width {
      width: <?php echo $book->owner_name_width . '%'; ?>;
   }

   .title {
      padding-bottom: <?php echo $book->title_padding_bottom . 'px'; ?>;
      font-size: <?php echo $book->title_font_size . 'px'; ?>;
      margin-left: <?php echo $book->title_margin_left . '%'; ?>;
   }

   #book label,
   #book span {
      font-size: 20px !important;
   }

   .dot {
      font-size: 19px !important;
   }
</style>

<div id="book" style="margin:0px; padding:11px 0px 0px 0px;">
   <div class="certificate" style="margin:0px; ">
      <h2 class="text-left title"><b>ລາຍການຈົດທະບຽນພາຫະນະ</b></h2>
      <h2 style="font-size:25px;margin-top:-16px;padding-top:0px;margin-left:30px"><b> 1. ມາດຕະຖານທາງດ້ານເຕັກນິກ:</b></h2>

      <!-- ===================================== 1 ===================================== -->
      <div class="row" style="margin:0px;padding: 24px 0px 0px 0px;">
         <div style="width:33%;">
            <label style="width: auto;">ຈົດທະບຽນທີ່</label>
            <label style="width: 70%;border-bottom: 2px dotted #666666;"></label>
         </div>
         <div style="width:33%;">
            <label style="width: auto;">ວັນທີ່ຈົດທະບຽນ</label>
            @if($vehicle->issue_date)<label style="width: 60%; height: 22px;border-bottom: 2px dotted #666666;"><span><b>&nbsp;{{ $vehicle->issue_date}}</b></span></label>
            @else<label style="width: 60%;border-bottom: 2px dotted #666666;"></label> @endif
         </div>
         <div style="width:33%;">
            <label style="width: auto;">ເລກທະບຽນ</label>
            @if($vehicle->licence_no)<label style="width: 70%; height: 22px;border-bottom: 2px dotted #666666;"><span><b>&nbsp;{{ $vehicle->licence_no}}</b></span></label>
            @else<label style="width: 70%;border-bottom: 2px dotted #666666;"></label> @endif
            </label>
         </div>
      </div>

      <!-- ===================================== 2 ===================================== -->
      <div class="row" style="margin: 0px; padding: 0px;">
         <div style="width:33%;">
            <label for="test">ປະເພດລົດ</label>
            @if(strlen($vehicle->vtype->name ?? '') != 0)<label style="width: 75%; height: 22px;border-bottom: 2px dotted #666666;"><span><b>&nbsp;{{$vehicle->vtype->name}} </b></span></label>
            @else<label style="width: 75%;border-bottom: 2px dotted #666666;"></label> @endif
         </div>
         <div style="width:33%;">
            <label for="test">ຍີ່ຫໍ້</label>
            @if(strlen($vehicle->vbrand->name ?? '') != 0)<label style="width: 88%; height: 22px;border-bottom: 2px dotted #666666;"><span><b>&nbsp;{{$vehicle->vbrand->name}}</b></span></label>
            @else<label style="width: 88%;border-bottom: 2px dotted #666666;"></label> @endif
         </div>
         <div style="width:33%;">
            <label for="test">ລຸ້ນ</label>
            @if(strlen($vehicle->vmodel->name ?? '') != 0)<label style="width: 90%; height: 22px;border-bottom: 2px dotted #666666;"><span><b> &nbsp;{{ $vehicle->vmodel->name}} </b></span></label>
            @else<label style="width: 90%;border-bottom: 2px dotted #666666;"></label> @endif
         </div>
      </div>

      <!-- ===================================== 3 ===================================== -->
      <div class="row" style="margin: 0px; padding: 0px;">
         <div style="width:49%;">
            <label for="test">ສີລົດ</label>
            @if(strlen($vehicle->color->name ?? '') != 0)<label style="width: 90%; height: 22px;border-bottom: 2px dotted #666666;"><span><b>&nbsp;{{$vehicle->color->name}}</b></span></label>
            @else <label style="width: 90%;border-bottom: 2px dotted #666666;"></label> @endif
         </div>
         <div style="width:25%;">
            <label for="test">ພວງມະໄລ</label>
            @if(strlen($vehicle->steering->name ?? '') != 0)<label style="width: 65%; height: 22px;border-bottom: 2px dotted #666666;"><span><b>&nbsp;{{$vehicle->steering->name}}</b></span> </label>
            @else <label style="width: 65%;border-bottom: 2px dotted #666666;"></label> @endif
         </div>
         <div style="width:25%;">
            <label for="test">ນໍ້າມັນ</label>
            @if(strlen($vehicle->gas->name ?? '') != 0)<label style="width: 80%; height: 22px;border-bottom: 2px dotted #666666;"><span><b>&nbsp;{{ $vehicle->gas->name}}</b></span></label>
            @else <label style="width: 80%;border-bottom: 2px dotted #666666;"></label> @endif
         </div>
      </div>

      <!-- ===================================== 4 ===================================== -->
      <div class="row" style="margin: 0px; padding: 0px;">
         <div style="width:33%;">
            <label for="test">ຍີ່ຫໍ້ຈັກ</label>
            @if(strlen($vehicle->moter_brand->name_en ?? '') != 0)<label style="width: 82%; height: 22px;border-bottom: 2px dotted #666666;"><span>&nbsp;{{$vehicle->moter_brand->name_en}}</span></label>
            @else <label style="width: 82%;border-bottom: 2px dotted #666666;"></label> @endif
         </div>
         <div style="width:20%;">
            <label for="test">ຈຳນວນ</label>
            @if($vehicle->wheels)<label style="width: 70%; height: 22px;border-bottom: 2px dotted #666666;"><span><b>&nbsp;{{$vehicle->wheels}}</b> </span></label>
            @else <label style="width: 70%;border-bottom: 2px dotted #666666;"></label> @endif
         </div>
         <div style="width:18%;">
            <label for="test">ສູບ</label>
            @if($vehicle->cc)<label style="width: 80%; height: 22px;border-bottom: 2px dotted #666666;"><span><b>&nbsp;{{$vehicle->cc}}</b></span></label>
            @else <label style="width: 80%;border-bottom: 2px dotted #666666;"></label> @endif
         </div>
         <div style="width:11%;">
            <label for="test">ຊີຊີ</label>
            @if($vehicle->cylinder)<label style="width: 70%; height: 22px;border-bottom: 2px dotted #666666;"><span><b>&nbsp;{{$vehicle->cylinder}}</b></span></label>
            @else <label style="width: 70%;border-bottom: 2px dotted #666666;"></label> @endif
         </div>
         <div style="width:17%;">
            <label for="test">ເພົາ</label>
            @if($vehicle->axis)<label style="width: 67%; height: 22px;border-bottom: 2px dotted #666666;"><span><b>&nbsp;{{$vehicle->axis}}</b></span></label><span> ລໍ້</span>
            @else <label style="width: 67%;border-bottom: 2px dotted #666666;"></label><span> ລໍ້</span>@endif
         </div>
      </div>

      <!-- ===================================== 5 ===================================== -->
      <div class="row" style="margin: 0px; padding: 0px;">
         <div style="width:49%;">
            <label for="test">ເລກຈັກ</label>
            @if($vehicle->engine_no)<label style="width: 88%; height: 25px;border-bottom: 2px dotted #666666;"><span style="font-weight: bold;font-family:Saysettha OT;">&nbsp;{{$vehicle->engine_no}}</span></label>
            @else <label style="width: 88%;border-bottom: 2px dotted #666666;"></label> @endif
         </div>
         <div style="width:50%;">
            <label for="test">ເລກຖັງ</label>
            @if($vehicle->chassis_no)<label style="width: 88%; height: 25px;border-bottom: 2px dotted #666666;"><span style="font-weight: bold;font-family:Saysettha OT;">&nbsp;{{$vehicle->chassis_no}}</span></label>
            @else <label style="width: 88%;border-bottom: 2px dotted #666666;"></label> @endif
         </div>
      </div>

      <!-- ===================================== 6 ===================================== -->
      <div class="row" style="margin: 0px; padding: 0px;">
         <div style="width:40%;">
            <label for="test">ຂະໜາດຂອງລົດ:ກ້ວາງ</label>
            @if($vehicle->width)<label style="width: 50%; height: 22px;border-bottom: 2px dotted #666666;"><span><b>&nbsp;{{$vehicle->width}}</b></span></label><span> ມມ,</span>
            @else <label style="width: 50%;border-bottom: 2px dotted #666666;"></label><span> ມມ,</span> @endif
         </div>
         <div style="width:20%;">
            <label for="test">ຍາວ</label>
            @if($vehicle->long)<label style="width: 63%; height: 22px;border-bottom: 2px dotted #666666;"><span><b>&nbsp;{{$vehicle->long}}</b></span></label><span> ມມ,</span>
            @else <label style="width: 63%;border-bottom: 2px dotted #666666;"></label><span> ມມ,</span> @endif
         </div>
         <div style="width:39%;">
            <label for="test">ສູງ</label>
            @if($vehicle->height)<label style="width: 84%; height: 22px;border-bottom: 2px dotted #666666;"><span><b>&nbsp;{{ $vehicle->height}}</b></span></label><span> ມມ</span>
            @else <label style="width: 84%;border-bottom: 2px dotted #666666;"></label><span> ມມ</span> @endif
         </div>
      </div>

      <!-- ===================================== 7 ===================================== -->
      <div class="row" style="margin: 0px; padding: 0px;">
         <div style="width:37%;">
            <label for="test">ຈຳນວນບ່ອນນັ່ງຜູ້ໂດຍສານ</label>
            @if($vehicle->seat)<label style="width: 39%; height: 22px;border-bottom: 2px dotted #666666;"><span><b>&nbsp;{{$vehicle->seat}}</b></span></label><span> ຄົນ,</span>
            @else <label style="width: 39%;border-bottom: 2px dotted #666666;"></label><span>ຄົນ,</span> @endif
         </div>
         <div style="width:28%;">
            <label for="test">ນ້ຳໜັກລົດ</label>
            @if($vehicle->weight)<label style="width: 57%; height: 22px;border-bottom: 2px dotted #666666;"><span><b>&nbsp;{{$vehicle->weight}}</b></span></label><span> ກິໂລ,</span>
            @else <label style="width: 57%;border-bottom: 2px dotted #666666;"></label><span>ກິໂລ,</span> @endif
         </div>
         <div style="width:34%;">
            <label for="test">ນ້ຳໜັກບັນທຸກ</label>
            @if($vehicle->weight_filled)<label style="width: 57%; height: 22px;border-bottom: 2px dotted #666666;"><span><b>&nbsp;{{$vehicle->weight_filled}}</b></span></label><span> ກິໂລ,</span>
            @else <label style="width: 57%;border-bottom: 2px dotted #666666;"></label><span> ກິໂລ,</span> @endif
         </div>
      </div>

      <!-- ===================================== 8 ===================================== -->
      <div class="row" style="margin: 0px; padding: 0px;">
         <div style="width:37%;">
            <label for="test">ນ້ຳໜັກລວມ</label>
            @if($vehicle->total_weight)<label style="width: 63%; height: 22px;border-bottom: 2px dotted #666666;"><span><b>&nbsp;{{$vehicle->total_weight}}</b></span></label><span> ກິໂລ,</span>
            @else <label style="width: 63%;border-bottom: 2px dotted #666666;"></label><span> ກິໂລ,</span> @endif
         </div>
         <div style="width:28%;">
            <label for="test">ນ້ຳໜັກເພົາໜ້າ</label>
            <label style="width: 47%;border-bottom: 2px dotted #666666;"></label><span> ກິໂລ,</span>
         </div>
         <div style="width:34%;">
            <label for="test">ນ້ຳໜັກເພົາຫຼັງ</label>
            <label style="width: 58%;border-bottom: 2px dotted #666666;"></label><span> ກິໂລ</span>
         </div>
      </div>
      <!-- ============================================================================= -->
      <h2 style="font-size:24px;margin-top:195px;padding-top:0px;margin-left:30px"><b>2. ເຈົ້າຂອງພາຫະນະ:</b></h2><br />
      <!-- ============================================================================= -->

      <!-- ===================================== 1 ===================================== -->
      <div class="row padding-row" style="padding-left:15px;margin-top: -26px;">
         <!-- <div class="owner_name_width"> -->
         <div style="width:80%;">
            <label for="test">ຊື່ເຈົ້າຂອງພາຫະນະ</label>
            @if($vehicle->owner_name)<label style="width: 82%; height: 22px;border-bottom: 2px dotted #666666;"><span><b>&nbsp;{{$vehicle->owner_name}}</b></span></label>
            @else <label style="width: 82%;border-bottom: 2px dotted #666666;"></label> @endif
         </div>
         <div style="width:18%;"">
            <label for="test">ເປັນເຈົ້າຂອງພາຫະນະຜູ້ທີ່</label>
         </div>
      </div>

      <!-- ===================================== 2 ===================================== -->
      <div class="row" style="margin: 0px; padding: 0px;">
         <div style="width:49%;">
            <label for="test">ຢູ່ບ້ານ</label>
            @if($vehicle->village_name)<label style="width: 88%; height: 22px;border-bottom: 2px dotted #666666;"><span><b>&nbsp;{{$vehicle->village_name}} </b></span></label>
            @else <label style="width: 88%;border-bottom: 2px dotted #666666;"></label> @endif
         </div>
         <div style="width:25%;">
            <label for="test">ໜ່ວຍ</label>
            @if($vehicle->vehicle_unit)<label style="width: 80%; height: 22px;border-bottom: 2px dotted #666666;"><span><b>&nbsp;{{$vehicle->vehicle_unit}}</b></span></label>
            @else <label style="width: 80%;border-bottom: 2px dotted #666666;"></label> @endif
         </div>
         <div style="width:25%;">
            <label for="test">ເມືອງ</label>
            @if($vehicle->district_code)<label style="width: 83%; height: 22px;border-bottom: 2px dotted #666666;"><span><b>&nbsp;{{$vehicle->district->name}}</b></span></label>
            @else <label style="width: 83%;border-bottom: 2px dotted #666666;"></label> @endif
         </div>
      </div>

      <!-- ===================================== 3 ===================================== -->
      <div class="row" style="margin: 0px; padding: 0px;">
         <div style="width:30%;">
            <label for="test">ແຂວງ</label>
            @if($vehicle->province_code)<label style="width: 82%; height: 22px;border-bottom: 2px dotted #666666;"><span><b>&nbsp;{{ $vehicle->province->name}}</b></span></label>
            @else <label style="width: 82%;border-bottom: 2px dotted #666666;"></label> @endif
         </div>
         <div style="width:30%;">
            <label for="test">ໂທລະສັບ</label>
            @if($vehicle->vehicle_phone)<label style="width: 75%; height: 22px;border-bottom: 2px dotted #666666;"><span><b>&nbsp;{{ $vehicle->vehicle_phone}}</b></span></label>
            @else <label style="width: 75%;border-bottom: 2px dotted #666666;"></label> @endif
         </div>
         <div style="width:25%;">
            <label for="test">ແຟ້ກ</label>
            <label style="width: 80%;border-bottom: 2px dotted #666666;"></label>
         </div>
         <div style="width:14%;">
            <label for="test">ມືຖື</label>
            <label style="width: 75%;border-bottom: 2px dotted #666666;"></label>
         </div>
      </div>

      <!-- ===================================== 4 ===================================== -->
      <div class="row padding-row" style="padding-left:15px;">
         <div style="width:20%;padding: 0px;">
            <label for="test">ເປົ້າໝາຍການນຳໃຊ້ລົດ: </label>
         </div>

         <div style="width:2%;margin-top: 5px;">
            <input type="checkbox" name="vehicle_kind_id[]" {{ $vehicle->vehicle_kind_code == 6 ?"checked":""}}>
         </div>
         <div style="width:11%;">
            <span style="margin-left: 5px">{{"ລັດບໍລິຫານ"}}</span>
         </div>

         <div style="width:2%;margin-top: 5px;">
            <input type="checkbox" name="vehicle_kind_id[]" {{ $vehicle->vehicle_kind_code ==4 || $vehicle->vehicle_kind_code ==5 ?"checked":""}}>
         </div>
         <div style="width:65%;">
            <span style="margin-left: 5px">{{"ອົງການຈັດຕັ້ງສາກົນ. ສະຖານທູດ ແລະແຂກຕ່າງປະເທດ"}}</span>
         </div>
      </div>

      <!-- ===================================== 5 ===================================== -->
      <div class="row padding-row" style="padding-left:15px;">
         <div style="width:2%;margin-top: 5px;padding-left: 1px;">
            <input type="checkbox" name="vehicle_kind_id[]" {{ $vehicle->vehicle_kind_code == 1 ?"checked":""}}>
         </div>
         <div style="width:18%;">
            <span style="margin-left: 5px">{{"ສ່ວນບຸກຄົນ"}}</span>
         </div>

         <div style="width:2%;margin-top: 5px;">
            <input type="checkbox" name="vehicle_kind_id[]" {{ $vehicle->vehicle_kind_code ==2 ||$vehicle->vehicle_kind_code ==3 ?"checked":""}}>
         </div>
         <div style="width:18%;">
            <span style="margin-left: 5px">{{"ຮັບໃຊ້ວຽກບໍລິສັດ"}}</span>
         </div>

         <div style="width:2%;margin-top: 5px;">
            <input type="checkbox" name="vehicle_kind_id[]" {{ $vehicle->vehicle_kind_code == null?"checked":""}}>
         </div>
         <div style="width:18%;">
            <span style="margin-left: 5px">{{"ຂົນສົ່ງສິນຄ້າ"}}</span>
         </div>

         <div style="width:2%;margin-top: 5px;">
            <input type="checkbox" name="vehicle_kind_id[]" {{ $vehicle->vehicle_kind_code == null ?"checked":""}}>
         </div>
         <div style="width:18%;">
            <span style="margin-left: 5px">{{"ຂົນສົ່ງໂດຍສານ"}}</span>
         </div>

         <div style="width:2%;margin-top: 5px;">
            <input type="checkbox" name="vehicle_kind_id[]" {{ $vehicle->vehicle_kind_code ==8 ?"checked":""}}>
         </div>
         <div style="width:18%;padding:0px">
            <span style="margin-left: 5px">{{"ໂຄງການ (ຊຄ)"}}</span>
         </div>
      </div>

      <!-- ============================================================================= -->
      <div class="row">
         <div class="col-md-12">
            <div class="row">
               <div style="width:40%"> <label for="test">
                     <span>{!! QrCode::size(150)->generate('$vehicle->chassis_no') !!}</span>
                  </label>
               </div>
               <div style="width:30%">
                  <label for="test"> ທີ່ນະຄອນຫລວງວຽງຈັນ </label>
               </div>
               <div style="width:30%">
                  <label for="test"> ວັນທີ </label>
                  @if($vehicle->issue_date)<span class="dot-line"><b>{{ $vehicle->issue_date }}</b></span>
                  @else <b class="dot">.................................</b> @endif<br />
                  <label for="test"> ເຈົ້າໜ້າທີ່ຜູ້ອອກອະນຸຍາດ</label>
               </div>
            </div>
         </div>
      </div>

   </div>
</div>