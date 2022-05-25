<style>

 .transfer-print .row-height{
      height: 25px;
  }
 .transfer-print .row-height.header{
      text-align: center;
  }
 .transfer-print .print-col-padding{
      padding-left: 15px;
  }
  .transfer-print h3, .transfer-print h4,  .transfer-print span,  .transfer-print label{
      font-size: 18px !important;
  }
</style>
@php $steer_id =\App\Model\Steering::whereStatus(1)->get(); 
$gases=\App\Model\Gas::get(); 
@endphp

<div class="card">
 <div class="card-body transfer-print" id="print-paper">
  <h3 class="text-center">ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ</h3>
  <h3 class="text-center">
   ສັນຕິພາບ ເອກກະລາດ ປະຊາທິປະໄຕ ເອກກະພາບ ວັດທະນາຖາວອນ
  </h3>
  <h3 class="text-center">******000******</h3>
  <br />
  <br />
  <div class="row">
   <div class="col-md-7 col-md-offset-4">
    <h4>ກະຊວງໂຍທິການ ແລະ ຂົນສົ່ງ</h4>
    <h4>ພະແນກ ໂຍທາທິການແລະຂົນສົ່ງນະຄອນຫຼວງວຽງຈັນ</h4>
    <h4>ກອງຄຸ້ມຄອງພາຫະນະ ແລະການຂັບຂີ່</h4>
   </div>
   <div class="col-md-5">
    <h4>&nbsp;</h4>
    <h4>&nbsp;</h4>
    <h4>
     ເລກທີິ່ : &nbsp;&nbsp;@if(isset($vehicle->division_no))<span
      class="dot-line-notuse"
      >{{$vehicle->division_no}}</span
     >@else<span>&nbsp;&nbsp;&nbsp;</span>@endif / ກຄພຂ.ນວ &nbsp;
    </h4>

    <h4>ລົງວັນທີ .................</h4>
   </div>
  </div>
  <br />
  <br />
  <div class="row">
   <div class="col-md-4">&nbsp;</div>
   <div
    class="col-md-4 text-center"
    style="border: 1px solid #000;padding:5px 0px 5px 0px;"
   >
    <label
     ><u><b>ໃບອະນຸຍາດຍົກຍ້າຍຂື້ນທະບຽນ</b></u></label
    ><br />
    <label
     ><u><b>ພາຫະນະກົນຈັກຢູ່ພາຍໃນປະເທດ</b></u></label
    >
   </div>
   <div class="col-md-4">&nbsp;</div>
  </div>
  <div class="row mb-1 mt-3">
   <div class="col-md-12">
    <span
     >ອີງຕາມດໍາລັດຂອງນາຍຍົດລັດຖະມົນເລກທີ 373/ນຍ, ລົງວັນທີ 22 ຕຸລາ 2007
     ກ່ຽວກັບພາລະບົດບາດຂອງ ກະຊວງໂຍທາທິການ ແລະ ຂົນສົ່ງ.</span
    >
   </div>
  </div>

  <div class="row mb-1">
   <div class="col-md-12">
    <div class="row mb-1">
     <div class="col-md-12">
      <span>ອີງຕາມໃບຍົກຍ້າຍພາຫະນະຂອງ:</span>
      @if(isset($customer_name))<span class="dot-line-notuse"
       ><b>{{$customer_name ?? ''}}</b></span
      >
      @else<span>&nbsp;</span>@endif
     </div>
    </div>
    <div class="row mb-1">
     <div class="col-md-5">
      <span>ສະບັບເລກທີ:</span>
      <span class="dot-line-notuse"
       ><b>{{ $TransferVehicle->transfer_no ?? '' }} </b></span
      >
     </div>
     <div class="col-md-7">
      <label for="test">ລົງວັນທີ:</label>
      <span class="dot-line-notuse"
       ><b>{{ $TransferVehicle->transfer_date ?? '' }}</b>
      </span>
     </div>
    </div>
    <div class="row mb-1 mt-4">
     <div class="col-md-12">
      <label for=""
       >ຜ່ານການຄົ້ນຄວ້າເອກະສານກັບການກວດກາພາຫະນະຕົວຈິງມີລັກສະນະດັ່ງນີ້:</label
      >
     </div>
    </div>
    <div class="row mb-1">
     <div class="col-md-3">
      <label for="test">ປະເພດລົດ:</label>
      <span class="dot-line-notuse"
       ><b>{{$vehicle->vtype->name ?? ''}}</b>
      </span>
     </div>
     <div class="col-md-2">
      <label for="test">ຍີ່ຫໍ້:</label>
      <span class="dot-line-notuse"
       ><b>{{$vehicle->vbrand->name ?? ''}}</b>
      </span>
     </div>
     <div class="col-md-6">
      <label for="test">ສີລົດ:</label>
      <span class="dot-line-notuse"
       ><b>{{$vehicle->color->name ?? ''}}</b>
      </span>
      <label for="test" style="padding-left: 5px;">ຄວາມແຮງ:</label>
      <span class="dot-line-notuse"><b>{{$vehicle->cc ?? ''}}</b></span>
      <label for="test" style="padding-left: 5px;">ພວງມະໄລ:</label>
      <span class="dot-line-notuse"
       ><b>{{$vehicle->steering->name ?? ''}}</b></span
      >
     </div>
    </div>
    <div class="row mb-1">
     <div class="col-md-5">
      <label for="test">ໝາຍເລກທະບຽນ: </label>
      <span class="dot-line-notuse"
       ><b>{{$vehicle->licence_no ?? ''}}</b>
      </span>
     </div>
     <div class="col-md-7">
      <label for="test">ອອກຊື່:</label>
      <span class="dot-line-notuse"
       ><b>{{$vehicle->owner_name ?? ''}}</b>
      </span>
     </div>
    </div>
    <div class="row mb-1">
     <div class="col-md-5">
      <label for="test">ເລກຈັກ: </label>
      <span class="dot-line-notuse"
       ><b>{{$vehicle->engine_no ?? ''}}</b>
      </span>
     </div>
     <div class="col-md-7">
      <label for="test">ເລກຈັກ:</label>
      <span class="dot-line-notuse"
       ><b>{{$vehicle->chassis_no ?? ''}}</b>
      </span>
     </div>
    </div>
    <div class="row mb-1 mt-4">
     <div class="col-md-12">
      <label for="test">ດັ່ງນັ້ນ, ຈຶ່ງອອກໃບອານຸຍາດດັ່ງກ່າວຍົກຍ້າຍຈາກ:</label>
      <span class="dot-line-notuse"
       ><b>{{$vehicle->province->name ?? ''}}</b>
      </span>
     </div>
    </div>
    <div class="row mb-1">
     <div class="col-md-12">
      <label for="test">ໄປຂື້ນທະບຽນຢູ່: ແຂວງ </label>
      <span class="dot-line-notuse"
       ><b>{{$TransferVehicle->province_tran_to->name ?? ''}}</b>
      </span>
     </div>
    </div>
    <div class="row mt-4">
     <div class="col-md-12">
      <h2 style="font-size:25px;">
       ເອກະສານທີ່ມີໃນລາຍການລຸ່ມນີ້ແມ່ນເພື່ອໃຊ້ແທນສະໂນດນໍາສົ່ງ.
      </h2>
     </div>
    </div>
 
    <div class="row mb-2">
     <div class="col-md-12">
      <table class="table-bordered" style="width: 100%">
       <thead>
        <tr class="row-height header">
         <th width="50" class="text-center">ລ/ດ</th>
         <th width="200">ລາຍການເອກະສານ</th>
         <th width="100">ຈໍານວນ</th>
         <th width="200">ໝາຍເຫດ</th>
        </tr>
       </thead>
       <tbody>
        <tr class="row-height">
         <td class="text-center">01</td>
         <td class="print-col-padding">ໃບທະບຽນຖາວອນ</td>
         <td class="print-col-padding"> {{$TransferVehicle->transfer_detail[0]->unit ?? ''}}</td>
         <td class="print-col-padding">{{$TransferVehicle->transfer_detail[0]->note ?? ''}}</td>
        </tr>
        <tr class="row-height">
         <td class="text-center">02</td>
         <td class="print-col-padding">ໃບທະບຽນຊົ່ວຄາວ</td>
         <td class="print-col-padding"> {{$TransferVehicle->transfer_detail[1]->unit ?? ''}}</td>
         <td class="print-col-padding">{{$TransferVehicle->transfer_detail[1]->note ?? ''}}</td>
        </tr>
        <tr class="row-height">
         <td class="text-center">03</td>
         <td class="print-col-padding">ໃບຮັບປະກັນ</td>
         <td class="print-col-padding"> {{$TransferVehicle->transfer_detail[2]->unit ?? ''}}</td>
         <td class="print-col-padding">{{$TransferVehicle->transfer_detail[2]->note ?? ''}}</td>
        </tr>
        <tr class="row-height">
         <td class="text-center">04</td>
         <td class="print-col-padding">ໃບຊື້ຂາຍ</td>
         <td class="print-col-padding"> {{$TransferVehicle->transfer_detail[3]->unit ?? ''}}</td>
         <td class="print-col-padding">{{$TransferVehicle->transfer_detail[3]->note ?? ''}}</td>
        </tr>
        <tr class="row-height">
         <td class="text-center">05</td>
         <td class="print-col-padding">ໃບຢັ້ງຢືນທີ່ຢູ່ຜູ້ຊື້</td>
         <td class="print-col-padding"> {{$TransferVehicle->transfer_detail[4]->unit ?? ''}}</td>
         <td class="print-col-padding">{{$TransferVehicle->transfer_detail[4]->note ?? ''}}</td>
        </tr>
        <tr class="row-height">
         <td class="text-center">06</td>
         <td class="print-col-padding">ໃບຢັ້ງຢືນທີ່ຢູ່ຜູ້ຂາຍ</td>
         <td class="print-col-padding"> {{$TransferVehicle->transfer_detail[5]->unit ?? ''}}</td>
         <td class="print-col-padding">{{$TransferVehicle->transfer_detail[5]->note ?? ''}}</td>
        </tr>
        <tr class="row-height">
         <td class="text-center">07</td>
         <td class="print-col-padding">ໃບມອບກໍາມະສິດ</td>
         <td class="print-col-padding"> {{$TransferVehicle->transfer_detail[6]->unit ?? ''}}</td>
         <td class="print-col-padding">{{$TransferVehicle->transfer_detail[6]->note ?? ''}}</td>
        </tr>
       </tbody>
      </table>
     </div>
    </div>

    <div class="row">
     <div class="col-md-12">
      <label for=""
       ><u><b>ໝາຍເຫດ:</b></u></label
      >
      <br />
      <br />
      <label for=""
       >1) ສະເໜີໃຫ້ຫ້ອງການຂົນສົ່ງຫຼືກອງຄຸ້ມຄອງພາຫະນະແລະການຂັບຂີ່
       ປະຕິບັດຕາມລະບຽບການ, ພ້ອມທັງນໍາລົດມາກວດກາຕົວຈີງ
       ຖ້າເຫັນວ່າຖືກຕ້ອງແລ້ວຈຶ່ງຂື້ນທະບຽນໃຫ້.</label
      >
     </div>
    </div>

    <div class="row" style="margin-top:30px">
     <div class="col-md-6">
      <label for=""><b>ຫົວໜ້າພະແນກ ຍທຂ ປະຈໍາແຂວງ(ນວ)</b></label>
     </div>
     <div class="col-md-6">
      <label for=""><b>ຫົວໜ້າກອງຄຸ້ມຄອງພາຫະນະແລະການຂັບຂີ່(ນວ)</b></label>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>
