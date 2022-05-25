<style>
   .f-col {
      width: 160px;
   }

   .s-col {
      width: 350px;
   }

   .fs-1 {
      font-size: 25px;
   }

   .fs-2 {
      font-size: 21px;
   }
</style>
<div class="card" style="width: 100%; border: none !important">
   <div class="card-body">
      <div style="line-height: 230%;">
         <span class="text-center fs-1" style="display: block;"><b>ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ</b></span>
         <span class="text-center fs-1" style="display: block;">ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນາຖາວອນ</span>
         <span class="text-center fs-1" style="display: block;">--------------------</span>
      </div>
      <!-- ======================================================================== -->
      <h4 class="fs-1" style="margin-top: 60px;">ກະຊວງໂຍທາທິການ ແລະ ຂົນສົ່ງ</h4>
      <div class="row">
         <div class="col-md-7 col-md-offset-4" style="width: 595px;">
            <h4 class="fs-1">ພະແນກໂຍທາທິການ ແລະ ຂົນສົ່ງ</h4>
         </div>
         <div class="col-md-5" style="width: 425px;">
            <h4 class="fs-1">ເລກທີ່ &nbsp;&nbsp;<span>..................</span> /ກຄພຂ.ນວ</h4>
         </div>
      </div>
      <h4 class="fs-1">ກອງຄຸ້ມຄອງພາຫະນະ ແລະ ການຂັບຂີ່</h4>
      <!-- ======================================================================== -->
      <div class="row" style="margin-top: 65px;">
         <div class="col-md-12 text-center">
            <h2 style="font-size:27px;text-decoration:underline"><b>ໃບຢັ້ງຢືນເອກະສານລົດ</b></h2><br />
         </div>
      </div>
      <!-- ======================================================================== -->
      <div class="row mb-3">
         <div class="col-md-12 fs-2" style="line-height: 150%;">
            <label for="test">- ອີງຕາມໃບສະເໜີ ສະບັບເລກທີ່</label> <span style="padding: 10px 15px; "> 
            @if($vehicle_print_detail->no) <b>{{ $vehicle_print_detail->no }}</b> 
            @else <b>.......................................................................</b> @endif
            </span><br />
            
            <label for="test">- ອີງຕາມການກວດກາເອກະສານ ຂອງກອງຄຸ້ມຄອງພາຫະນະ ແລະ ການຂັບຂີ່ນະຄອນຫຼວງວຽງຈັນ,</label><br />

            <label for="test">- ຄັ້ງວັນທີ່</label> <span style="padding: 10px 15px; "> 
            @if($vehicle_print_detail->date) <b>{{ $vehicle_print_detail->date }}</b> 
            @else <b>..................</b> @endif
            </span>ຂອງວິຊາການກອງ ຂໍຢັ້ງຢືນວ່າລົດຈໍານວນ 01 ຄັນດັ່ງກ່າວ ອອກທະບຽນຊື່ ລາຍລະອຽດລຸ່ມນີ້:<br />

            <label for="test">ໝາຍເລກທະບຽນ: &nbsp; &nbsp;{{ $vehicle->licence_no ?? ''}} &nbsp; &nbsp;&nbsp; &nbsp; {{ $vehicle->vehicle_kind->name ?? '' }}</label>
         </div>
      </div>
      <!-- ======================================================================== -->
      <div class="row mb-1" style="border: 1px solid #ddd;line-height: 200%;">
         <div class="col-md-6 fs-2" style="width: 510px;">
            <div class="row my-2">
               <div class="col-md-3 f-col">
                  <label for="test">ອອກຊື່:</label>
               </div>
               <div class="col-md-9 s-col">
                  @if($vehicle->owner_name)<span class="dot-line"><b>{{ $vehicle->owner_name }} </b></span>@else <b></b> @endif <br />
               </div>
            </div>
            <div class="row mb-2">
               <div class="col-md-3 f-col">
                  <label for="test">ບ້ານ:</label>
               </div>
               <div class="col-md-9 s-col">
                  @if($vehicle->village_name)<span class="dot-line"><b>{{ $vehicle->village_name ?? '' }} </b></span>@else <b></b> @endif <br />
               </div>
            </div>
            <div class="row mb-2">
               <div class="col-md-3 f-col">
                  <label for="test">ເມືອງ:</label>
               </div>
               <div class="col-md-9 s-col">
                  @if($vehicle->district_code)<span class="dot-line"><b>{{ $vehicle->district->name ?? '' }} </b></span>@else <b></b> @endif <br />
               </div>
            </div>
            <div class="row mb-2">
               <div class="col-md-3 f-col">
                  <label for="test">ແຂວງ:</label>
               </div>
               <div class="col-md-9 s-col">
                  @if($vehicle->province_code)<span class="dot-line"><b>{{ $vehicle->province->name ?? '' }} </b></span>@else <b></b> @endif <br />
               </div>
            </div>
            <div class="row mb-2">
               <div class="col-md-3 f-col">
                  <label for="test">ເລກຈັກ:</label>
               </div>
               <div class="col-md-9 s-col">
                  @if($vehicle->engine_no)<span class="dot-line" style="font-weight: bold;font-family:Saysettha OT;">{{ $vehicle->engine_no }}</span>@else <b></b> @endif <br />
               </div>
            </div>
            <div class="row mb-2">
               <div class="col-md-3 f-col">
                  <label for="test">ສີ:</label>
               </div>
               <div class="col-md-9 s-col">
                  @if($vehicle->color_id)<span class="dot-line"><b>{{ $vehicle->color->name ?? '' }} </b></span>@else <b></b> @endif
               </div>
            </div>
         </div>
         <div class="col-md-6 fs-2" style="width: 510px;">
            <div class="row my-2">
               <div class="col-md-3 f-col">
                  <label for="test">ປະເພດ:</label>
               </div>
               <div class="col-md-9 s-col">
                  @if($vehicle->vehicle_type_id)<span class="dot-line"><b>{{ $vehicle->vtype->name ?? '' }} </b></span>@else <b></b> @endif <br />
               </div>
            </div>
            <div class="row mb-2">
               <div class="col-md-3 f-col">
                  <label for="test">ຍີ່ຫໍ້:</label>
               </div>
               <div class="col-md-9 s-col">
                  @if($vehicle->brand_id)<span class="dot-line"><b>{{ $vehicle->vbrand->name ?? ''}} </b></span>@else <b></b> @endif <br />
               </div>
            </div>
            <div class="row mb-2">
               <div class="col-md-3 f-col">
                  <label for="test">ລຸ້ນ:</label>
               </div>
               <div class="col-md-9 s-col">
                  @if($vehicle->model_id)<span class="dot-line"><b>{{ $vehicle->vmodel->name ?? '' }} </b></span>@else <b></b> @endif <br />
               </div>
            </div>
            <div class="row mb-2">
               <div class="col-md-3 f-col">
                  <label for="test">ແຮງ:</label>
               </div>
               <div class="col-md-9 s-col">
                  @if($vehicle->cc)<span class="dot-line"><b>{{ $vehicle->cc }} </b></span>@else <b></b> @endif <br />
               </div>
            </div>
            <div class="row mb-2">
               <div class="col-md-3 f-col">
                  <label for="test">ເລກຖັງ:</label>
               </div>
               <div class="col-md-9 s-col">
                  @if($vehicle->chassis_no)<span class="dot-line" style="font-weight: bold;font-family:Saysettha OT;">{{ $vehicle->chassis_no }}</span>@else <b></b> @endif 
               </div>
            </div>
            <div class="row mb-2">
               <div class="col-md-3 f-col">
                  <label for="test">ພວງມະໄລ:</label>
               </div>
               <div class="col-md-9 s-col">
                  @if($vehicle->steering_id)<span class="dot-line"><b>{{ $vehicle->steering->name ?? '' }} </b></span>@else <b></b> @endif 
               </div>
            </div>

            <div class="row mb-2">
               <div class="col-md-3 f-col">
                  <label for="test">ປີຜະລິດ:</label>
               </div>
               <div class="col-md-9 s-col">
                  @if($vehicle->year_manufacture)<span class="dot-line"><b>{{ $vehicle->year_manufacture ?? '' }} </b></span>@else <b></b> @endif 
               </div>
            </div>
            <div class="row mb-2">
               <div class="col-md-3 f-col">
                  <label for="test">ປະເທດຜະລິດ:</label>
               </div>
               <div class="col-md-9 s-col">
                  @if($vehicle_print_detail->country_origin)<span class="dot-line"><b>{{ $vehicle_print_detail->country_origin ?? '' }}</b></span>@else <b></b> @endif 
               </div>
            </div>
         </div>
      </div>
      <br />
      <!-- ======================================================================== -->
      <div class="row">
         <div class="col-md-1" style="width: 85px;">&nbsp;</div>
         <div class="col-md-11 text-justify fs-2" style="width: 935px;line-height: 150%;">
            <label for="test">
               @if($vehicle_print_detail->note) {{ $vehicle_print_detail->note }} @endif   
            </label><br />
            <label for="test">ສະນັ້ນຈື່ງໄດ້ອອກໃບຢັ້ງຢືນສະບັບນີ້ໃຫ້ພາກສ່ວນກ່ຽວຂ້ອງເພື່ອເປັນຫຼັກຖານ.</label>
         </div>
      </div>
      <br />
      <!-- ======================================================================== -->
      <div class="row">
         <div class="col-md-6" style="width: 510px;"></div>
         <div class="col-md-6 text-justify fs-2" style="width: 510px;">
            <label for="test">ນະຄອນຫຼວງວຽງຈັນ, ວັນທີ</label>
            @if($vehicle_print_detail->date) <span>{{ $vehicle_print_detail->date }}</span> 
            @else <span></span> @endif
         </div>
      </div>
      <!-- ======================================================================== -->
      <div class="row">
         <div class="col-md-6 fs-2" style="width: 510px;">
            <label for="test" style="text-decoration: underline">ຫົວໜ້າກອງຄຸ້ມຄອງພາຫະນະ ແລະ ການຂັບຂີ່</label>
            <span style="color: #000;"><b></b></span>
         </div>
         <div class="col-md-6 fs-2" style="width: 510px;">
            <label for="test" style="text-decoration: underline">ຫົວໜ້າໜ່ວຍງານທະບຽນ</label>
            <span style="color: #000;"><b></b></span>
         </div>
      </div>
      <!-- ======================================================================== -->
      <div class="row" style="position: fixed;bottom:0px">
         <div class="col-md-12 fs-2">
            <label for="test">Application Form version 1.0 Staff</label>
         </div>
      </div>

   </div>
</div>