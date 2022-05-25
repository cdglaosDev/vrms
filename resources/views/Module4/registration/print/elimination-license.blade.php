<style>
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
            <span class="text-center fs-1" style="display: block;"><b>ສາທາລະນະລັດປະຊາທິປະໄຕ ປະຊາຊົນລາວ</b></span>
            <span class="text-center fs-1" style="display: block;">ສັນຕິພາບເອກກະລາດ ປະຊາທິປະໄຕ ເອກກະພາບວັດທະນາຖາວອນ</span>
            <span class="text-center fs-1" style="display: block;">******000******</span>
        </div>
        <!-- ======================================================================== -->
        <h4 class="fs-2" style="margin-top: 38px;margin-bottom: 10px;">ກະຊວງໂຍທິການ ແລະ ຂົນສົ່ງ</h4>
        <h4 class="fs-2" style="margin-bottom: 10px;">ພະແນກ ໂຍທາທິການແລະຂົນສົ່ງນະຄອນຫຼວງວຽງຈັນ</h4>
        <div class="row">
            <div class="col-md-7 col-md-offset-4" style="width: 595px;">
                <h4 class="fs-2" style="margin-bottom: 10px;">ກອງຄຸ້ມຄອງພາຫະນະ ແລະການຂັບຂີ່</h4>
            </div>
            <div class="col-md-5" style="width: 425px;">
                <h4 class="fs-2">ເລກທີິ່ <span>..................</span> /ກຄພຂ.ກພ</h4>
            </div>
        </div>
        <!-- ======================================================================== -->
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 style="font-size:27px;text-decoration:underline"><b>ໃບອະນຸຍາດລົບລ້າງປ້າຍ</b></h2>
            </div>
        </div>
        <br />
        <!-- ======================================================================== -->
        <div style="line-height: 210%;">
            <div class="row fs-2">
                <div style="width:70%;"><label for="">- ອິງຕາມໃບສະເໜີຂອງ: ກະຊວງການຕ່າງປະເທດສະບັບເລກທີ: 
                    @if($vehicle_print_detail->no) <span>{{ $vehicle_print_detail->no }}</span> 
                    @else <span>..........</span> @endif
                </label></div>
                <div style="width:30%;"><label for="">ຕປທ ພທກ ລົງວັນທີ:
                    @if($vehicle_print_detail->date)<span>{{ $vehicle_print_detail->date }}</span>
                    @else <span>...................</span> @endif
                </label></div> 
            </div>
            <div class="row fs-2">
                <div style="width:100%;"><label for="">ວ່າດ້ວຍການຂໍອານຸຍາດຖອນເອກະສານລົດ: <span>................................</span> </label></div>
            </div>
            <div class="row fs-2">
                <div style="width:100%;"><label for="">ເພື່ອປະກອບເອກະສານສົ່ງລົດໄປກັບຄືນປະເທດ 
                    @if($vehicle_print_detail->send_to) <span>{{ $vehicle_print_detail->send_to }}</span> 
                    @else <span>................................</span> @endif
                </label></div>
            </div>
            <div class="row fs-2">
                <div style="width:80%;"><label for="">- ອິງຕາມໃບອະນຸຍາດພາຫະນະອອກນອກປະເທດຂອງກົມຂົນສົ່ງ ກະຊວງ ຍທຂ ເລກທີ: 
                    @if($vehicle_print_detail->transport_no) <span>{{ $vehicle_print_detail->transport_no }}</span> 
                    @else <span>............</span> @endif
                </label></div>
                <div style="width:20%;"><label for="">ລົງວັນທີ:
                    @if($vehicle_print_detail->dated) <span>{{ $vehicle_print_detail->dated }}</span> 
                    @else <span>.................</span> @endif
                </label></div>
            </div>
            <div class="row fs-2">
                <div style="width:100%;"><label for="">ກອງຄຸ້ມຄອງພະຫານະ ແລະ ການຂັບຂີ່ ຈື່ງລົງມັດຕິລາຍລະອຽດຂອງເອກະສານດັ່ງນີ້: </label></div>
            </div>
            <div style="height:35px">&nbsp;</div>
            <div class="row fs-2">
                <div style="width:20%;"><label for="">ໝາຍເລກທະບຽນ</label></div>
                <div style="width:10%;"><label for=""><b>{{ $vehicle->licence_no ?? ''}}</b></label></div>
                <div style="width:15%;"><label for=""><b> @if($vehicle->vehicle_kind_code){{ $vehicle->vehicle_kind->name ?? '' }} @endif </b></label></div>
                <div style="width:10%"><label for="">ປະເພດ </label></div>
                <div style="width:20%"><label for=""><b> @if($vehicle->vehicle_type_id){{ $vehicle->vtype->name ?? '' }} @endif</b></label></div>
            </div>
            <div class="row fs-2">
                <div style="width:20%;"><label for="">ຍີ່ຫໍ້ &nbsp; @if($vehicle->brand_id)<span class="dot-line"><b>{{ $vehicle->vbrand->name ?? ''}} </b></span>@endif</label></div>
                <div style="width:20%;"><label for="">ສີ &nbsp; @if($vehicle->color_id)<span class="dot-line"><b>{{ $vehicle->color->name ?? '' }} </b></span>@endif</label></div>
                <div style="width:20%;"><label for="">ພວງມະໄລ: &nbsp;@if($vehicle->steering_id)<span class="dot-line"><b>{{ $vehicle->steering->name ??'' }} </b></span>@endif </label></div>
            </div>
            <div class="row fs-2">
                <div style="width:40%;"><label for="">ເລກຈັກ: &nbsp; <span class="dot-line" style="font-weight: bold;font-family:Saysettha OT;">{{ $vehicle->engine_no ?? '' }}</span></label></div>
                <div style="width:40%;"><label for="">ເລກຖັງ: &nbsp; <span class="dot-line" style="font-weight: bold;font-family:Saysettha OT;">{{ $vehicle->chassis_no ?? '' }}</span></label></div>
            </div>
            <div class="row fs-2">
                <div style="width:100%"><label>ຊື່ເຈົ້າຂອງທະບຽນ: &nbsp; <span class="dot-line"><b>{{ $vehicle->owner_name ?? '' }} </b></span></label></div>
            </div>
            <div class="row fs-2">
                <div style="width:25%;"><label for="">ບ້ານ: &nbsp; @if($vehicle->village_name) <span class="dot-line"><b>{{ $vehicle->village_name ?? '' }} </b></span> @endif</label></div>
                <div style="width:25%;"><label for="">ເມື່ອງ: &nbsp; @if($vehicle->district_code)<span class="dot-line"><b>{{ $vehicle->district->name ?? '' }} </b></span> @endif</label></div>
                <div style="width:25%;"><label for="">ແຂວງ: &nbsp; @if($vehicle->province_code)<span class="dot-line"><b>{{ $vehicle->province->name ?? ''}} </b></span> @endif</label></div>
            </div>
            <div class="row fs-2">
                <div style="width:100%"><label>ຈໍານວນ:.....01............................................</label></div>
            </div>
            <div class="row fs-2">
                <label>- <span style="padding-left:15px">ຖອນປ້າຍ ແລະ ທະບຽນສົ່ງຄຶນ ກອງຄຸ້ມຄອງພາຫະນະ</span></label><br />
                <label>- <span style="padding-left:15px">ຖອນເອກະສານຕ່າງໆ ທີ່ກອງຄຸ້ມຄອງພາຫະນະປະກອບໃຫ້ແມ່ນສົ່ງຄືນໝົດ.</span></label><br />
                <label>&nbsp;&nbsp;<span style="padding-left:15px;">ສະເພາະໃບ ບໍ50 ພ້ອມດ້ວຍໃບເສັຍຄ່າພາສີແມ່ນສົ່ງໄປນໍາລົດ</span></label>
            </div>
            <div style="height:20px">&nbsp;</div>
            <div class="row fs-2">
                <div style="width:100%"><label>ດັ່ງນັ້ນ, ຈື່ງເຮັດໃບລົບລ້າງສະບັບນີ້ໄວ້ເພື່ອເປັນຫລັກຖານ</label></div>
            </div>

            <div style="height:20px">&nbsp;</div>
            <div class="row fs-2">
                <div style="width:50%;">&nbsp;</div>
                <div style="width:40%;"><label for=""> ນະຄອນຫລວງວຽງຈັນ,ວັນທີ<span>....................</span></label></div>
            </div>
            <div style="height:20px">&nbsp;</div>
            <div class="row fs-2">
                <div style="width:40%;"><span style="text-decoration:underline">ຫົວໜ້າພະແນກ ຍທຂ ນະຄອນຫລວງວຽງຈັນ</span></div>
                <div style="width:10%">&nbsp;</div>
                <div style="width:40%;"><span style="text-decoration:underline"> ຫົວໜ້າກອງຄຸ້ມຄອງພາຫະນະແລະການຂັບຂີ່ </span></div>
            </div>
        </div>

    </div>
</div>