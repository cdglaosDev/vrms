@php
$obj_vehicle = new \App\Model\Vehicle();
@endphp
<span style="display:none" id="t_vehicles">{{$total_vehicles}}</span>
<span style="display:none" id="t_pages">{{$total_pages}}</span>
<div class="table-responsive">
    <table class="table vehicles_list fundClassesTable" id="vTable">
        {{--<tbody style="overflow-y: auto; height: 62vh;display: block;">--}}

       <thead>
        <tr style="background-color: #F0FFF0;">
            <th class="v_lic_no">{{ trans('module4.vehicle_license_no')}}</th>
            <th class="v_name">{{ trans('module4.name')}}</th>
            <th class="v_village_district">{{ trans('module4.village_district')}}</th>
            <th class="v_pro_name">{{ trans('module4.province_name')}}</th>
            <th class="v_t_name">{{ trans('module4.v_type')}}</th>
            <th class="v-brand">{{ trans('module4.brand')}}</th>
            <th class="v-model">{{ trans('module4.model')}}</th>
            <th class="v-color">{{ trans('module4.traffic_color')}}</th>
            <th class="v_eng_cha">{{ trans('module4.engine_no_chassis_no')}}</th>
            <th>ເຂົ້າຂໍ້ມູນ</th>
            <th>ພິມ</th>
            <th class="v_updated_at"></th>
        </tr>
       </thead>

        <tbody>
        <!-- When we use with <thead> for header row, we can adjust to equal column width header and detail columns. So, create header row in <tbody>. -->
           
            @foreach($vehicles as $vehicle)
            <tr>
                <td class="v_lic_no">
                    <a href="#" data-url="{{ route('editVehicle',['id'=>$vehicle->id])}}" class="link license_no" data-id="{{$vehicle->id}}" purpose_no="{{$vehicle->vehicle_kind_code}}" onclick="vehicleModal(this, 'Search')">
                        @if(strlen($vehicle->licence_no) == 0)
                        @if(isset($vehicle->pre_licence_no)) {{$vehicle->pre_licence_no}} @else{{'0000'}} @endif
                        @else{{ $vehicle->licence_no }} @endif
                    </a>
                    <div style="text-align:center;white-space:nowrap;color:#444;font-size:11px;padding:0;max-width:80px">{{ $vehicle->vehicle_kind_name ?? '' }}</div>
                </td>
                <td class="v_name">
                    <a href="#" class="link" data-url="{{ route('editVehicle',['id'=>$vehicle->id])}}" data-id="{{$vehicle->id}}" purpose_no="{{$vehicle->vehicle_kind_code}}" onclick="vehicleModal(this, 'Load')">
                    {{ $vehicle->owner_name }}
                    </a>
                    <div style="text-decoration:underline;font-size:9px;color:#ccc;cursor:pointer">ປະຫວັດ</div>
                </td>
                <td class="v_village_district">
                    <div style="font-weight:bold">{{ $vehicle->village_name}}
                    @if(isset($vehicle->vehicle_unit))<span>({{$vehicle->vehicle_unit ?? '' }})</span> @else @endif
                    </div>
                    <div style="color:#666"><small>ມ.</small>{{ $vehicle->district_name ?? '' }}</div>
                </td>
                <td class="v_pro_name">
                    <div class="province" province_code="{{ $vehicle->province_code ?? '' }}">{{ $vehicle->province_name ?? '' }}</div>
                    <div style="color:#777;font-size:10px"><small>ກມ </small>{{ $vehicle->division_no}}</div>
                    <div style="color:#aaa;font-size:10px"><small>ຂວ </small>{{ $vehicle->province_no}}</div>
                </td>
                <td class="v_t_name">
                    <div>{{ $vehicle->vehicle_type_name ?? '' }}</div>
                    <div style="color:red;font-weight: bold;font-size:10px !important;">{{ $vehicle->traffic_note ?? '' }}</div>
                </td>
                <td class="v-brand">
                    <div>{{ $vehicle->brand_name ?? '' }}</div>
                    <div style="color:#f99;font-size:11px">ອອກ {{ $vehicle->i_date}}</div>
                </td>
                <td class="v-model">
                    <div>{{ $vehicle->model_name ?? '' }}</div>
                    <div style="color:#f99;font-size:11px">ໝົດ {{ $vehicle->e_date}}</div>
                    <div style="color:red;font-weight: bold;font-size:11px !important;">{{ $vehicle->bill_date ?? '' }}</div>
                </td>
                <td class="v-color">
                    <div>{{ $vehicle->color_name ?? '' }}</div>
                    <div style="color:#aaa;font-size:10px;">{{ $vehicle->steering_name ?? '' }}</div>
                    <div style="color: green;font-weight: bold;font-size:11px !important;">{{ $vehicle->traffic_date ?? '' }}</div>
                </td>
                <td class="v_eng_cha" style="font-family: Saysettha OT !important;">{{ $vehicle->engine_no }} <br />
                    <a href="#" data-url="{{ route('editEngine',['id'=>$vehicle->id])}}" style="font-family: Saysettha OT !important;" class="link font-weight-bold" data-id="{{$vehicle->id}}" onclick="engineModal(this)">
                        {{ $vehicle->chassis_no }}
                    </a>
                </td>
                <td></td>
                <td>{{ $obj_vehicle->printLog($vehicle->id) }}</td>
                <td class="v_updated_at">{{ $vehicle->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>