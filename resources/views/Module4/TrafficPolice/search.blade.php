<span style="display:none" id="t_vehicles">{{$total_vehicles}}</span>
<span style="display:none" id="t_pages">{{$total_pages}}</span>
<table class="vehicles-list" style="margin-top: 5px;">
    <thead>
        <tr>
            <th class="f-col">{{ trans('module4.license_no_header')}}</th>
            <th class="s-col">{{ trans('module4.model')}}</th>
            <th class="t-col">{{ trans('module4.engine_no_chassis_no')}}</th>
            <th class="fo-col">{{ trans('module4.name')}}</th>
            <th class="fi-col">{{ trans('module4.village_district_province')}}</th>
            <th class="si-col">{{ trans('module4.number')}}</th>
            <th class="se-col">{{ trans('module4.expire_date_header')}}</th>
            <th>{{ trans('module4.tool_techincalFee')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vehicles as $vehicle)
        <tr>
            <td>
                <a href="#" class="link license_no" purpose_no="{{$vehicle->vehicle_kind_code ?? ''}}" data-url="{{ route('showTrafficPolice',['id' => $vehicle->id ])}}" data-id="{{$vehicle->id}}" onclick="vehicleModal(this)">
                    @if(strlen($vehicle->licence_no) == 0){{'0000'}} @else{{ $vehicle->licence_no }} @endif
                </a>
                <br>
                {{ $vehicle->vehicle_kind_name ?? '' }}
            </td>
            <td>
                <div>{{ $vehicle->brand_name ?? '' }}</div>
                <div style="font-weight: bold;">{{ $vehicle->model_name ?? '' }}</div>
                <div>{{ $vehicle->color_name ?? '' }}</div>
            </td>
            <td>
                <div>{{ $vehicle->engine_no }}</div>
                <div>
                    <a href="#" class="link" data-url="{{ route('showTrafficPolice',['id' => $vehicle->id ])}}" data-id="{{$vehicle->id}}" onclick="vehicleModal(this)">{{ $vehicle->chassis_no }}</a>
                </div>
            </td>
            <td>
                <a href="#" class="link" data-url="{{ route('showTrafficPolice',['id' => $vehicle->id ])}}" data-id="{{$vehicle->id}}" onclick="vehicleModal(this)">{{ $vehicle->owner_name }}</a>
            </td>
            <td>
                <div style="font-weight: bold;">{{ $vehicle->village_name }}</div>
                <div style="color: #666;"><small>ມ.</small>{{ $vehicle->district_name ?? '' }}</div>
                <div class="province" province_code="{{$vehicle->province_code}}">{{ $vehicle->province_name ?? '' }}</div>
            </td>
            <td>
                <div style="white-space:nowrap;color: #777;">ກມ {{ $vehicle->division_no }}</div>
                <div style="color: #aaa;">ຂວ {{ $vehicle->province_no }}</div>
                <div style="color: #bbb;">ທີ {{ $vehicle->number }}</div>
            </td>
            <td>
                <div style="color: #f99;">ອອກ {{ $vehicle->issue_date }}</div>
                <div style="color: #f99;">ໝົດ {{ $vehicle->expire_date }}</div>
            </td>
            <td>
                <div>ຄ່າທາງ: </div>
                <div style="color: #f99;">{{ $vehicle->illegal_date ?? '' }}</div>
                <div>{{ $vehicle->remark }}</div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>