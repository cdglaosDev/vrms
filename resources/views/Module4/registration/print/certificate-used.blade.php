<style>
   .fs-1 {
      font-size: 25px;
   }

   .fs-2 {
      font-size: 21px;
   }

   .certificate_used_instead {
      line-height: 110%;
   }

   .certificate_used_instead .l_height{
      height: 32px;
   }

</style>
<div class="card" style="width: 100%; border: none !important">
   <div class="card-body certificate_used_instead fs-1">
      <div style="line-height: 150%;">
         <span class="text-center fs-1" style="display: block;"><b>ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ</b></span>
         <span class="text-center fs-1" style="display: block;">ສັນຕິພາບ ເອກກະລາດ ປະຊາທິປະໄຕ ເອກກະພາບ ວັດທະນາຖາວອນ</span>
         <span class="text-center fs-1" style="display: block;">******000******</span>
      </div>
      <!-- ======================================================================== -->
      <h4 class="fs-2" style="margin-top: 38px;margin-bottom: 10px;">ກະຊວງໂຍທິການ ແລະ ຂົນສົ່ງ</h4>
      <h4 class="fs-2" style="margin-bottom: 10px;">ພະແນກ ໂຍທາທິການແລະຂົນສົ່ງ</h4>
      <div class="row">
         <div class="col-md-7 col-md-offset-4" style="width: 750px;">
            <h4 class="fs-2" style="margin-bottom: 10px;">ກອງຄຸ້ມຄອງພາຫະນະ ແລະການຂັບຂີ່,{{ $vehicle->province->abb ?? ''}}</h4>
         </div>
         <div class="col-md-5" style="width: 270px;">
            <h4 class="fs-2" style="margin-bottom: 10px;">ເລກທີິ່ {{$vehicle_print_detail->no}}/ກຄພຂ.{{ $vehicle->province->abb ?? ''}}</h4>
            <h4 class="fs-2" style="margin-bottom: 10px;">ວັນທີ {{$vehicle_print_detail->date}}</h4>
         </div>
      </div>
      <!-- ======================================================================== -->
      <div class="row">
         <div class="col-md-12 text-center">
            <h2 style="font-size:27px;text-decoration:underline"><b>ໃບຢັ້ງຢືນໃຊ້ແທນສໍານວນເດີມ</b></h2>
         </div>
      </div>
      <br />
      <!-- ======================================================================== -->
      <div class="row mb-3">
         <div class="col-md-12 fs-2" style="line-height: 150%;">
            <label for="test">- <span style="padding-left:15px;">ອີງຕາມຂໍ້ຕົກລົງຂອງລັດຖະມົນຕີກະຊວງ ຄຂປກ. ສະບັບເລກທີ່ 1687/ຄຂປກ. ລົງວັນທີ 29/12/1994.ວ່າດ້ວຍການຈັດຕັ້ງບັນດາກອງຄຸ້ມຄອງພາຫະນະ ແລະ ການຂັບຂີ່ ໃນທົ່ວປະເທດ.</span></label> <br />
            <label for="test">- <span style="padding-left:15px;">ອີງຕາມຂໍ້ກຳນົດວ່າດ້ວຍການຂື້ຍທະບຽນ ແລະ ຄຸ້ມຄອງຍານພາຫະນະຂົນສົ່ງທາງບົກໃນ ສປປ ລາວ, ສະບັບ ເລກທີ່ 829/ຄຂປກ ລົງວັນທີ 15/05/2000.</span></label><br />
            <label for="test">- <span style="padding-left:15px;">ອີງຕາມເຫດການໄຟໄໝ້ຫ້ອງເກັບມ້ຽນເອກະສານ ຢູ່ກອງຄຸ້ມຄອງພາຫະນະ ແລະ ການຂັບຂີ່ {{ $vehicle->province->name ?? ''}} ທີ່ທົ່ງປົ່ງ ຄັ້ງວັນທີ: 23/05/2000.</span></label><br />
         </div>
      </div>
      <!-- ======================================================================== -->
      <div class="row mb-1">
         <div class="col-md-12 fs-2">
            <label style="margin-left: 40px;" for="test">ກອງຄຸ້ມຄອງພາຫະນະ ແລະ ການຂັບຂີ່ {{ $vehicle->province->name ?? ''}} ຂໍຢັ້ງຢືນວ່າ: ເອກະສານພາຫະນະ</label>
         </div>
      </div>
      <!-- ======================================================================== -->
      <div style="line-height: 200%;">
         <div class="row fs-2 l_height">
            <div style="width:20%;"><label>1).ໝາຍເລກທະບຽນ</label></div>
            <div style="width:10%;"><label><b>{{ $vehicle->licence_no ?? ''}}</b></label></div>
            <div style="width:15%;"><label><b> @if($vehicle->vehicle_kind_code){{ $vehicle->vehicle_kind->name ?? '' }} @endif </b></label></div>
            <div style="width:10%;"><label>ປະເພດ </label></div>
            <div style="width:20%;"><label><b> @if($vehicle->vehicle_type_id){{ $vehicle->vtype->name ?? '' }} @endif</b></label></div>
         </div>
         <div class="row fs-2 ml-2 l_height">
            <div style="width:20%;"><label>ຍີ່ຫໍ້ &nbsp; @if($vehicle->brand_id)<b>{{ $vehicle->vbrand->name ?? ''}} </b>@endif</label></div>
            <div style="width:20%;"><label>ສີ &nbsp; @if($vehicle->color_id)<b>{{ $vehicle->color->name ?? '' }} </b>@endif</label></div>
            <div style="width:20%;"><label>ພວງມະໄລ: &nbsp;@if($vehicle->steering_id)<b>{{ $vehicle->steering->name ??'' }} </b>@endif </label></div>
         </div>
         <div class="row fs-2 ml-2 l_height">
            <div style="width: 40%;"><label>ເລກຈັກ: <span style="font-weight: bold;font-family:Saysettha OT;">{{ $vehicle->engine_no ?? '' }}</span></div></label>
            <div><label>ເລກຖັງ: <span style="font-family: Saysettha OT;font-weight: bold;">{{ $vehicle->chassis_no ?? '' }}</span></div></label>         
         </div>
         <div class="row fs-2 ml-2 l_height">
            <div style="width:40%;"><label>ຊື່ເຈົ້າຂອງທະບຽນ &nbsp; <b>{{ $vehicle->owner_name ?? '' }} </b></label></div>
            <div style="width:25%;"><label>ບ້ານ: &nbsp; @if($vehicle->village_name) <b>{{ $vehicle->village_name ?? '' }} </b> @endif</label></div>
            <div style="width:25%;"><label>ເມືອງ: &nbsp; @if($vehicle->district_code)<b>{{ $vehicle->district->name }} </b> @endif</label></div>
         </div>

         <div class="row mb-2 fs-2 l_height">
            <span style="text-decoration:underline">2) ເອກກະສານສໍານວນເດີມຍັງເຫຼືອຈາກໄຟໄໝ້ມີ</span>
         </div>
         <div class="row fs-2 ml-2 l_height">
            <div style="width:45%;"><label for="">1 ໃບທະບຽນຖາວອນ: <b>{{$vehicle_print_detail->permanent}}</b></label></div>
            <div style="width:45%;"><label for="">ໃບຊົ່ວຄາວ <b>{{$vehicle_print_detail->temporary}}</b></label></div>
         </div>
         <div class="row fs-2 ml-2 l_height">
            <div style="width:100%;"><label for="">2 ໃບຊົ່ວຄາວ &nbsp;</label></div>
         </div>
         <div class="row fs-2 ml-2">
            <div style="width:100%;"><label for="">3 ເອກກະສານສໍານວນ: ຕົ້ນສະບັບທີນໍາເຂົ້າມາ ແມ່ນຖືກໄຟໄໝ້ໝົດ ຄັ້ງວັນທີ 23/05/2000.</label></div>
         </div>
         
         <div class="row fs-2">
            <div style="width:90%; margin-left: 50px;"><label for="">ດັ່ງນັ້ນ ທາງກອງຄຸ້ມຄອງພາຫະນະ ແລະ ການຂັບຂີ່,{{ $vehicle->province->abb ?? ''}} ຈື່ງໄດ້ເຮັດໃບຢັ້ງຢືນໄວ້ ເພື່ອເປັນຫຼັກຖານ.</label></div>
         </div>

         <div class="row fs-2">
            <div style="width:50%;"><span style="text-decoration:underline">ຫົວໜ້າກອງຄຸ້ມຄອງພາຫະນະແລະການຂັບຂີ່</span></div>
            <div style="width:40%;text-align: right;"><span style="text-decoration:underline"> ຫົວໜ້າໜ່ວຍງານຄຸ້ມຄອງພາຫະນະ</span></div>
         </div>
      </div>

   </div>
</div>