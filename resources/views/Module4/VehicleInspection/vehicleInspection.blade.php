<table class="table table-bordered" id="vehicle_inspect">
    <thead>
        <tr>
            <th>{{ trans('module4.veh_mod4_no') }}</th>
            <th>{{ trans('module4.inspect_place') }}</th>
            <th>{{ trans('module4.inspect_issue_date') }}</th>
            <th>{{ trans('module4.inspect_expire_date') }}</th>
            <th>{{ trans('module4.inspect_result') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vehicle_inspection as $index => $item)
        <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td>{{ $item->inspect_place->name ?? '' }}</td>
            <td>{{ $item->issue_date ?? '' }}</td>
            <td>{{ $item->expire_date ?? '' }}</td>
            <td>
                <a class="link font-weight-bold" href="#" data-id="{{$vehicle_id}}" data-vehicle_inspect_id="{{$item->id}}" onclick="editVehicleInspectModal(this)">
                    @if(($item->result ?? '') == "pass"){{"Pass"}}
                    @elseif(($item->result ?? '') == "not_pass"){{"Not Pass"}}
                    @elseif(($item->result ?? '') == "none"){{"None"}}
                    @else {{""}}
                    @endif
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>