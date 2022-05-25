<style>
    .transfer-print{
        line-height: 100%;
    }
    .transfer-print .row-height {
        height: 25px;
    }

    .transfer-print .row-height.header {
        text-align: center;
    }

    .transfer-print .print-col-padding {
        padding-left: 15px;
    }
</style>
@php
$steer_id =\App\Model\Steering::whereStatus(1)->get();
$gases =\App\Model\Gas::get();
@endphp

<div class="card" style="width: 100%; border: none !important">
    <div class="card-body transfer-print">
        <div class="text-center mb-3" style="font-size: 20px;">ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ</div>
        <div class="text-center mb-3" style="font-size: 20px;">ສັນຕິພາບ ເອກກະລາດ ປະຊາທິປະໄຕ ເອກກະພາບ ວັດທະນາຖາວອນ</div>
        <div class="text-center" style="font-size: 20px;">******000******</div>

        <br />

        <h4 class="mb-1" style="margin-top: 15px;font-size: 20px;">ກະຊວງໂຍທິການ ແລະ ຂົນສົ່ງ</h4>
        <h4 class="mb-1" style="font-size: 20px;">ພະແນກ ໂຍທາທິການແລະຂົນສົ່ງນະຄອນຫຼວງວຽງຈັນ</h4>
        <div class="row mb-1" style="font-size: 20px;">
            <div class="col-md-7" style="width: 700px;">
                <h4 style="font-size: 20px;">ກອງຄຸ້ມຄອງພາຫະນະ ແລະການຂັບຂີ່</h4>
            </div>
            <div class="col-md-5" style="width: 320px;">
                <h4 style="font-size: 20px;">
                    ເລກທີິ່ : &nbsp;&nbsp;
                    @if(isset($data->vehicle->division_no))<span class="dot-line-notuse">{{$data->vehicle->division_no}}</span>
                    @else<span>&nbsp;&nbsp;&nbsp;</span>@endif / ກຄພຂ.ນວ &nbsp;
                </h4>
                <h4 style="font-size: 20px;">ລົງວັນທີ .............................</h4>
            </div>
        </div>

        <br />

        <div class="row" style="margin-top: 12px;font-size: 19px;">
            <div class="col-md-4" style="width: 300px;">&nbsp;</div>
            <div class="col-md-4 text-center" style="width: 420px;border: 1px solid #000;padding:10px 0px 10px 0px;">
                <label class="mb-3"><u><b>ໃບອະນຸຍາດຍົກຍ້າຍຂື້ນທະບຽນ</b></u></label><br />
                <label><u><b>ພາຫະນະກົນຈັກຢູ່ພາຍໃນປະເທດ</b></u></label>
            </div>
            <div class="col-md-4" style="width: 300px;">&nbsp;</div>
        </div>
        <!-- ------------------------------------------------------- -->
        <div style="font-size: 19px;">
        <div class="row mt-4 mb-3" style="line-height: normal;">
            <div class="col-md-12">
                <span style="font-size: 19px;">ອີງຕາມດໍາລັດຂອງນາຍຍົດລັດຖະມົນເລກທີ 373/ນຍ, ລົງວັນທີ 22 ຕຸລາ 2007
                    ກ່ຽວກັບພາລະບົດບາດຂອງ</span><br>
                <span style="font-size: 19px;">ກະຊວງໂຍທາທິການ ແລະ ຂົນສົ່ງ.</span>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <span>ອີງຕາມໃບຂໍອະນຸຍາດຍົກຍ້າຍສຳນວນພາຫະນະຂອງ:</span>
                @if(isset($data->customer_name))<span class="dot-line-notuse"><b>{{$data->customer_name ?? ''}}</b></span>
                @else<span>&nbsp;</span>@endif
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-5" style="width: 420px;">
                <span>ສະບັບເລກທີ:</span>
                <span class="dot-line-notuse"><b>{{ $data->TransferVehicle->transfer_dep_no ?? '' }} </b></span>
            </div>
            <div class="col-md-7" style="width: 600px;">
                <label for="test">ລົງວັນທີ:</label>
                <span class="dot-line-notuse"><b>{{ $data->TransferVehicle->transfer_date ?? '' }}</b></span>
            </div>
        </div>
        </div>
        <!-- ------------------------------------------------------- -->
        <div style="font-size: 19px; padding-top: 15px;">
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="">ຜ່ານການຄົ້ນຄວ້າເອກະສານກັບການກວດກາພາຫະນະຕົວຈິງມີລັກສະນະດັ່ງນີ້:</label>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3" style="width: 300px;">
                    <label for="test">ປະເພດລົດ:</label>
                    <span class="dot-line-notuse"><b>{{$data->vehicle->vtype->name ?? ''}}</b>
                    </span>
                </div>
                <div class="col-md-2" style="width: 210px;">
                    <label for="test">ຍີ່ຫໍ້:</label>
                    <span class="dot-line-notuse"><b>{{$data->vehicle->vbrand->name ?? ''}}</b></span>
                </div>
                <div class="col-md-6" style="width: 510px;">
                    <label for="test">ສີລົດ:</label>
                    <span class="dot-line-notuse"><b>{{$data->vehicle->color->name ?? ''}}</b></span>
                    <label for="test" style="padding-left: 5px;">ຄວາມແຮງ:</label>
                    <span class="dot-line-notuse"><b>{{$data->vehicle->cc ?? ''}}</b></span>
                    <label for="test" style="padding-left: 5px;">ພວງມະໄລ:</label>
                    <span class="dot-line-notuse"><b>{{$data->vehicle->steering->name ?? ''}}</b></span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-5" style="width: 510px;">
                    <label for="test">ໝາຍເລກທະບຽນ: </label>
                    <span class="dot-line-notuse"><b>{{$data->vehicle->licence_no ?? ''}}</b></span>
                </div>
                <div class="col-md-7" style="width: 510px;">
                    <label for="test">ອອກຊື່:</label>
                    <span class="dot-line-notuse"><b>{{$data->vehicle->owner_name ?? ''}}</b></span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-5" style="width: 510px;">
                    <label for="test">ເລກຈັກ: </label>
                    <span class="dot-line-notuse"><b>{{$data->vehicle->engine_no ?? ''}}</b></span>
                </div>
                <div class="col-md-7" style="width: 510px;">
                    <label for="test">ເລກຖັງ:</label>
                    <span class="dot-line-notuse"><b>{{$data->vehicle->chassis_no ?? ''}}</b></span>
                </div>
            </div>
        </div>
        <!-- ------------------------------------------------------- -->
        <div style="font-size: 19px; padding-top: 15px;">
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="test">ດັ່ງນັ້ນ, ຈຶ່ງອອກໃບອານຸຍາດດັ່ງກ່າວຍົກຍ້າຍຈາກ:</label>
                <span class="dot-line-notuse"><b>{{$data->vehicle->province->name ?? ''}}</b></span>
            </div>
        </div>

        <div class="row mb-3 style="font-size: 20px;"">
            <div class="col-md-12">
                <label for="test">ໄປຂື້ນທະບຽນຢູ່: ແຂວງ </label>
                <span class="dot-line-notuse"><b>{{$data->TransferVehicle->province_tran_to->name ?? ''}}</b></span>
            </div>
        </div>
        </div>
        <!-- ------------------------------------------------------- -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h2 style="font-size:25px;">ເອກະສານທີ່ມີໃນລາຍການລຸ່ມນີ້ແມ່ນເພື່ອໃຊ້ແທນສະໂນດນໍາສົ່ງ.</h2>
            </div>
        </div>

        <table class="table-bordered" style="width: 100%; font-size: 19px;">
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
                    <td class="print-col-padding"> {{$data->TransferVehicle->transfer_detail[0]->unit ?? ''}}</td>
                    <td class="print-col-padding">{{$data->TransferVehicle->transfer_detail[0]->note ?? ''}}</td>
                </tr>
                <tr class="row-height">
                    <td class="text-center">02</td>
                    <td class="print-col-padding">ໃບທະບຽນຊົ່ວຄາວ</td>
                    <td class="print-col-padding"> {{$data->TransferVehicle->transfer_detail[1]->unit ?? ''}}</td>
                    <td class="print-col-padding">{{$data->TransferVehicle->transfer_detail[1]->note ?? ''}}</td>
                </tr>
                <tr class="row-height">
                    <td class="text-center">03</td>
                    <td class="print-col-padding">ໃບຮັບປະກັນ</td>
                    <td class="print-col-padding"> {{$data->TransferVehicle->transfer_detail[2]->unit ?? ''}}</td>
                    <td class="print-col-padding">{{$data->TransferVehicle->transfer_detail[2]->note ?? ''}}</td>
                </tr>
                <tr class="row-height">
                    <td class="text-center">04</td>
                    <td class="print-col-padding">ໃບຊື້ຂາຍ</td>
                    <td class="print-col-padding"> {{$data->TransferVehicle->transfer_detail[3]->unit ?? ''}}</td>
                    <td class="print-col-padding">{{$data->TransferVehicle->transfer_detail[3]->note ?? ''}}</td>
                </tr>
                <tr class="row-height">
                    <td class="text-center">05</td>
                    <td class="print-col-padding">ໃບຢັ້ງຢືນທີ່ຢູ່ຜູ້ຊື້</td>
                    <td class="print-col-padding"> {{$data->TransferVehicle->transfer_detail[4]->unit ?? ''}}</td>
                    <td class="print-col-padding">{{$data->TransferVehicle->transfer_detail[4]->note ?? ''}}</td>
                </tr>
                <tr class="row-height">
                    <td class="text-center">06</td>
                    <td class="print-col-padding">ໃບຢັ້ງຢືນທີ່ຢູ່ຜູ້ຂາຍ</td>
                    <td class="print-col-padding"> {{$data->TransferVehicle->transfer_detail[5]->unit ?? ''}}</td>
                    <td class="print-col-padding">{{$data->TransferVehicle->transfer_detail[5]->note ?? ''}}</td>
                </tr>
                <tr class="row-height">
                    <td class="text-center">07</td>
                    <td class="print-col-padding">ໃບມອບກໍາມະສິດ</td>
                    <td class="print-col-padding"> {{$data->TransferVehicle->transfer_detail[6]->unit ?? ''}}</td>
                    <td class="print-col-padding">{{$data->TransferVehicle->transfer_detail[6]->note ?? ''}}</td>
                </tr>
            </tbody>
        </table>

        <div class="row" style="margin-top: 19px;">
            <div class="col-md-12" style="line-height: normal;font-size: 19px;">
                <label><u><b>ໝາຍເຫດ:</b></u></label>
                <br />
                <label>1) ສະເໜີໃຫ້ຫ້ອງການຂົນສົ່ງຫຼືກອງຄຸ້ມຄອງພາຫະນະແລະການຂັບຂີ່
                    ປະຕິບັດຕາມລະບຽບການ, ພ້ອມທັງນໍາລົດມາກວດກາຕົວຈີງ
                    ຖ້າເຫັນວ່າຖືກຕ້ອງແລ້ວຈຶ່ງຂື້ນທະບຽນໃຫ້.</label>
            </div>
        </div>

        <div class="row" style="margin-top:25px;font-size: 19px;">
            <div class="col-md-6" style="width: 510px;">
                <label for=""><b>ຫົວໜ້າພະແນກ ຍທຂ ປະຈໍາແຂວງ(ນວ)</b></label>
            </div>
            <div class="col-md-6" style="width: 510px;">
                <label for=""><b>ຫົວໜ້າກອງຄຸ້ມຄອງພາຫະນະແລະການຂັບຂີ່(ນວ)</b></label>
            </div>
        </div>

    </div>
</div>