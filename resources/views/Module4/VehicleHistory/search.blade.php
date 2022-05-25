<span style="display:none" id="t_records">{{$total_records}}</span>
<span style="display:none" id="t_pages">{{$total_pages}}</span>
<div class="table-responsive">
    <table class="table vehicles_list tbl_vehicle_history" id="vTable">
        <thead>
            <tr>
                <th class="v_lic_no">{{ trans('module4.vehicle_license_no')}}</th>
                <th class="v_name">{{ trans('module4.name')}}</th>
                <th class="v_village_district">{{ trans('module4.village_district')}}</th>
                <th class="v_pro_name">{{ trans('module4.province_name')}}</th>
                <th class="v_t_name">{{ trans('module4.v_type')}}</th>
                <th class="v_eng_cha">{{ trans('module4.engine_no_chassis_no')}}</th>
            </tr>
        </thead>

        <tbody>
            <!-- When we use with <thead> for header row, we can adjust to equal column width header and detail columns. So, create header row in <tbody>. -->

            @foreach($vehicle_histories as $vehicle_history)
            <tr>
                <td class="v_lic_no">
                    <a href="#" data-url="{{ route('editVehicle',['id'=>$vehicle_history->vehicle_id])}}" class="link license_no" data-id="{{$vehicle_history->vehicle_id}}" purpose_no="{{$vehicle_history->vehicle_kind_code}}" onclick="vehicleModal(this, 'Load')">
                        @if(strlen($vehicle_history->licence_no) == 0){{'0000'}} @else{{ $vehicle_history->licence_no }} @endif
                    </a>
                    <div style="text-align:center;white-space:nowrap;color:#444;font-size:11px;padding:0;max-width:80px">{{ $vehicle_history->vehicle_kind->name ?? '' }}</div>
                </td>
                <td class="v_name">
                    <a href="#" class="link">{{ $vehicle_history->owner_name ?? '' }}</a>
                </td>
                <td class="v_village_district">
                    <div style="font-weight:bold">{{ $vehicle_history->village_name ?? ''}}
                        @if(isset($vehicle_history->vehicle_unit))<span>({{$vehicle_history->vehicle_unit ?? '' }})</span> @else @endif
                    </div>
                    <div style="color:#666"><small>ມ.</small>{{ $vehicle_history->district->name ?? '' }}</div>
                </td>
                <td class="v_pro_name">
                    <div class="province" province_code="{{ $vehicle_history->province_code ?? '' }}">{{ $vehicle_history->province->name ?? '' }}</div>
                    <div style="color:#777;font-size:10px"><small>ກມ </small>{{ $vehicle_history->vehicle->division_no}}</div>
                    <div style="color:#aaa;font-size:10px"><small>ຂວ </small>{{ $vehicle_history->vehicle->province_no}}</div>
                </td>
                <td class="v_t_name">{{ $vehicle_history->vehicle->vtype->name ?? '' }}</td>
                <td class="v_eng_cha" style="font-family: Saysettha OT !important;">
                    {{ $vehicle_history->engine_no }} <br />
                    <a href="#" style="font-family: Saysettha OT !important;" class="link font-weight-bold">{{ $vehicle_history->vehicle->chassis_no }}</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>