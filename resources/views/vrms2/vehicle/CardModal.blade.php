@php
$smart_card_code = \App\Model\SmartCardSetting::select('code','security_pin')->first();
@endphp
<style>
.card_div{
    font-size: 20px;
    color: blue;
    font-weight: bold;
}
.card_div label{
    margin-bottom: 0px;
}
</style>
<div class="row card_div">
    <div class="col-md-9"></div>
    <div class="col-md-3">
        <label style="color: black;">ຂສ</label>
        <label style="color: black;">{{ $vehicle->division_no ?? ''}}</label>
    </div>

    <div class="col-md-9"></div>
    <div class="col-md-3">
        <label style="color: black;">{{$vehicle->province->abb}}</label><!-- ກພ -->
        <label style="color: black;">{{ $vehicle->province_no ?? ''}}</label>
    </div>

    <div class="col-md-12">
        <label>ຊື່ເຈົ້າຂອງລົດ</label>
        <label>{{ $vehicle->owner_name ?? ''}}</label>
    </div>

    <div class="col-md-12">
        <label>Nom & Prénom</label>
    </div>
    
    <div class="col-md-5">
        <label>ບ້ານຢູ່</label>
        <label>{{ $vehicle->village_name ?? ''}}</label>
    </div>
    <div class="col-md-7">
        <label>ເມືອງ</label>
        <label>{{ $vehicle->district->name  ?? ''}}</label>
    </div>

    <div class="col-md-5">
        <label>ເເຂວງ</label>
        <label>{{ $vehicle->province->name  ?? ''}}</label>
    </div>
    <div class="col-md-7">
        <label>ປະເພດ</label>
        <label>{{ $vehicle->vtype->name  ?? ''}}</label>
    </div>

    <div class="col-md-5">
        <label>ຍີ່ຫໍ້</label>
        <label>{{ $vehicle->vbrand->name ?? ''}}</label>
    </div>
    <div class="col-md-4">
        <label>ລຸ້ນ</label>
        <label>{{$vehicle->vmodel->name ?? ''}}</label>
    </div>
    <div class="col-md-3">
        <label>{{$vehicle->color->name?? ''}}</label>
    </div>

    <div class="col-md-5">
        <label>ເລກຈັກ</label>
        <label style="font-family:Saysettha OT !important;">{{$vehicle->engine_no ?? ''}}</label>
    </div>
    <div class="col-md-7">
        <label>ເລກຖັງ</label>
        <label style="font-family:Saysettha OT !important;">{{$vehicle->chassis_no ?? ''}}</label>
    </div>

    <div class="col-md-5">
        <label>ອອກໃຫ້ວັນທີ</label>
        <label style="color: red;font-family:Saysettha OT !important;">{{$vehicle->issue_date}}</label>
    </div>
    <div class="col-md-7">
        <label>ເຖິງ</label>
        <label style="color: red;font-family:Saysettha OT !important;">{{$vehicle->expire_date}}</label>
    </div>

    <div class="col-md-12">
        <label>ເລກທະບຽນ:</label>
        <a href="#" class="license_no" purpose_no="{{$vehicle->vehicle_kind_code}}" style="text-decoration: none;padding: 0px 10px;">
            @if(strlen($vehicle->licence_no) == 0)
            @if(isset($vehicle->pre_licence_no)) {{$vehicle->pre_licence_no}} @else{{'0000'}} @endif
            @else{{ $vehicle->licence_no }} @endif
        </a>
        <label style="color: gray;">{{ $vehicle->vehicle_kind->name??''}}</label>
    </div>

    <div class="col-md-12 mt-2" style="text-align: center;">
        <a style="height: 33px;margin-top: 3px;margin-right: 3px;" class="btn btn-outline-secondary" 
        href="scard:{{$vehicle->licence_no}}|{{$vehicle->province->old_name}}|{{ $vehicle->vehicle_kind->name??''}}|{{$vehicle->vehicle_kind->vehicle_kind_code}}|{{ $vehicle->division_no}}|{{$vehicle->province_no}}|{{$vehicle->owner_name}}|{{$vehicle->engine_no}}|{{$vehicle->chassis_no}}|{{$vehicle->vtype->name??''}}|{{ $vehicle->vbrand->name ?? ''}}|{{$vehicle->vmodel->name ?? ''}}|{{$vehicle->color->name??''}}|{{$vehicle->issue_date}}|{{$vehicle->expire_date}}|{{$vehicle->district->name??''}}|{{$vehicle->village_name}}|{{$smart_card_code->code ?? ''}}|{{auth()->user()->name}}|{{$smart_card_code->security_pin ?? ''}}|{{$vehicle->id}}|{{auth()->id()}}|{{$vehicle->province->abb}}|{{$vehicle->province->abb_en}}">
        <img src="{{ asset('images/print.png') }}" alt="" title="{{trans('button.print')}}" width="20px" height="20px"> {{trans('button.print')}}
        </a>
    </div>
</div>
