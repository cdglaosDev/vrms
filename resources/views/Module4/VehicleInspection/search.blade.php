<span style="display:none" id="t_vehicles">{{$total_vehicles}}</span>
<span style="display:none" id="t_pages">{{$total_pages}}</span>
<table class="vehicles-inspect">
    <thead>
        <tr>
            <th>{{ trans('module4.inspect_result')}}</th>
            <th>{{ trans('module4.vehicle_license_no')}}</th>
            <th>{{ trans('module4.name')}}</th>
            <th>{{ trans('module4.village_district')}}</th>
            <th>{{ trans('module4.province_name')}}</th>
            <th>{{ trans('module4.v_type')}}</th>
            <th>{{ trans('module4.brand')}}</th>
            <th>{{ trans('module4.model')}}</th>
            <th>{{ trans('module4.traffic_color')}}</th>
            <th>{{ trans('module4.engine_no_chassis_no')}}</th>
            <th>ເຂົ້າຂໍ້ມູນ</th>
            <th>ພິມ</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($vehicles as $vehicle)
        <tr>
            <td>
                @if(($vehicle->inspect_result ?? '') == 'pass') <img src="images/pass.png" height="30px" width="30px">
                @else <img src="images/fail.png" height="30px" width="30px">
                @endif
            </td>
            <td class="nowrap">
                <a href="#" data-url="{{ route('editVehicle',['id'=>$vehicle->id])}}" class="link license_no" data-id="{{$vehicle->id}}" purpose_no="{{$vehicle->vehicle_kind_code}}" onclick="vehicleModal(this)">
                    @if(strlen($vehicle->licence_no) == 0){{'0000'}} @else{{ $vehicle->licence_no }} @endif
                </a>
                <div style="text-align:center;white-space:nowrap;color:#444;font-size:11px;padding:0;max-width:80px">{{ $vehicle->vehicle_kind_name ?? '' }}</div>
                <small style="color:#999">g5000</small>
            </td>
            <td><a purpose_no="1" class="link">{{ $vehicle->owner_name }}</a>
                <div style="text-decoration:underline;font-size:9px;color:#ccc;cursor:pointer">ປະຫວັດ</div>
            </td>
            <td>
                <div style="font-weight:bold">{{ $vehicle->village_name}}</div>
                <div style="color:#666"><small>ມ</small>{{ $vehicle->district_name ?? '' }}</div>
            </td>
            <td>
                <div province="5">{{ $vehicle->province_name ?? '' }}</div>
                <div style="white-space:nowrap;color:#777;font-size:10px"><small>ກມ</small>{{ $vehicle->division_no}}</div>
                <div style="white-space:nowrap;color:#aaa;font-size:10px"><small>ຂວ </small>{{ $vehicle->province_no}}</div>
            </td>
            <td>{{ $vehicle->vehicle_type_name ?? '' }}</td>
            <td>
                <div>{{ $vehicle->brand_name ?? '' }}</div>
                <div style="white-space:nowrap;color:#f99;font-size:11px">ອອກ {{ $vehicle->issue_date}}</div>
            </td>
            <td>
                <div>{{ $vehicle->model_name ?? '' }}</div>
                <div style="white-space:nowrap;color:#f99;font-size:11px">ໝົດ {{ $vehicle->expire_date}}</div>
            </td>
            <td>{{ $vehicle->color_name ?? '' }}</td>
            <td>
                <div>{{ $vehicle->engine_no }}</div>
                <div>
                    <a href="#" data-url="{{ route('editEngine',['id'=>$vehicle->id])}}" class="link" data-id="{{$vehicle->id}}" onclick="engineModal(this)" style="font-weight: bold;">
                        {{ $vehicle->chassis_no }}
                    </a>
                </div>
            </td>
            <td></td>
            <td>{{ $vehicle->log }}</td>
            <td>{{ $vehicle->updated_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>