<span style="display:none" id="t_records">{{$total_records}}</span>
<span style="display:none" id="t_pages">{{$total_pages}}</span>
<table class="table table-striped">
    <thead>
        <tr>
            <th><input type="checkbox" id="checkAll" /></th>
            <th class="f-col">{{ trans('module4.transfer_no')}}</th>
            @if($transfer_in_out == "Out")
            <th class="s-col">{{ trans('module4.transfer_to')}}</th>
            @elseif($transfer_in_out == "In")
            <th class="s-col">{{ trans('module4.transfer_from')}}</th>
            @endif
            <th class="t-col">{{ trans('common.date')}}</th>

            <th class="f-col">{{ trans('module4.vehicle_license_no') }}</th>
            <th class="fi-col">{{ trans('module4.name') }}</th>
            <th class="si-col">{{ trans('module4.village_district') }}</th>
            <th>{{ trans('module4.province_name') }}</th>
            <th>{{ trans('module4.v_type') }}</th>
            <th>{{ trans('module4.engine_no_chassis_no') }}</th>

            <th class="te-col">{{ trans('module4.app_status')}}</th>
            <th>{{ trans('common.action')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vehicles as $data)
        <tr>
            <td>
                <input type="checkbox" name="approve_list" class="app_list" value="{{ $data->id ?? '' }}">
            </td>
            <td>
                <span style="color: #3366BB;">{{ $data->app_no }}</span><br>
                @can('Vehicle-Transferring-List-Approve')
                <a href="#" class="link transfer-modal" onclick="open_modal('view',{{ $data->id}})" data-toggle="modal" data-target="#transferModal" data-backdrop="static" data-keyboard="false">
                    {{ $data->transfer_no }}
                </a>
                @endcan
            </td>
            @if($transfer_in_out == "Out")
            <td>{{ $data->province_tran_to ?? '' }}</td>
            @elseif($transfer_in_out == "In")
            <td> {{ $data->province_tran_from ?? '' }}</td>
            @endif
            <td>{{ $data->transfer_date}}</td>

            <td class="nowrap">
                <a href="#" class="link license_no" purpose_no="{{$data->vehicle_kind_code}}">{{ $data->licence_no}}</a><br>
                {{ $data->vehicle_kind_name ?? ''}}<br>
                <small style="color:#999">g5000</small>
            </td>
            <td>
                <a class="link">{{ $data->owner_name }}</a>
                <div style="text-decoration:underline;font-size:9px;color:#ccc;cursor:pointer">ປະຫວັດ</div>
            </td>
            <td>
                <div style="font-weight: bold;">{{ $data->village_name }}</div>
                <div style="color: #666;"><small>ມ.</small>{{ $data->district_name ?? '' }}</div>
            </td>
            <td>
                <div class="province" province_code="{{$data->province_code}}">{{ $data->province_name ?? ''}}</div>
                <div style="white-space:nowrap;color:#777;font-size:10px"><small>ກມ</small>{{ $data->division_no}}</div>                
                <div style="white-space:nowrap;color:#aaa;font-size:10px"><small>ຂວ </small>{{ $data->province_no}}</div>
            </td>
            <td>{{ $data->vehicle_type_name ?? '' }}</td>
            <td>
                <div>{{ $data->engine_no }}</div>
                <div>
                    <a href="#" class="link">{{ $data->chassis_no }}</a>
                </div>
            </td>
            <td>{{ $data->app_form_status_name }}</td>
            <td width="220">
                <!-------------------- Approve Button -------------------->
                @can('Vehicle-Transferring-List-Approve')
                @if($transfer_in_out == "Out")
                <a href="#" class="btn btn-success btn-sm transfer-modal" data-action="approve" data-id="{{ $data->transfer_id}}" data-tranno="{{ $data->transfer_no}}" data-appformid="{{ $data->app_form_id}}" data-tranto="{{ $data->transfer_to}}" data-toggle="modal" data-target="#approveconfirm" data-backdrop="static" data-keyboard="false">
                    {{ trans('button.approve')}}
                </a>

                @elseif($transfer_in_out == "In")
                <button onclick="open_modal('approve',{{ $data->transfer_id}})" class="btn btn-success btn-sm" data-toggle="modal" data-target="#transferModal" data-backdrop="static" data-keyboard="false">
                    {{ trans('button.approve')}}
                </button>
                @endif
                @endcan
                <!-------------------- End of Approve Button -------------------->

                <!-------------------- View Button -------------------->
                @can('Vehicle-Transfer-View')
                <button onclick="open_modal('view',{{ $data->transfer_id}})" class="btn btn-info btn-sm" data-toggle="modal" data-target="#transferModal" data-backdrop="static" data-keyboard="false">
                    {{ trans('button.view')}}
                </button>
                @endcan
                <!-------------------- End of View Button -------------------->

                <!-------------------- Cancle Button and Transit Button -------------------->
                @if($transfer_in_out == "Out")
                @can('Vehicle-Transfer-Cancel')
                <a href="#" class="btn btn-primary btn-sm transfer-modal" data-action="cancel" data-id="{{ $data->transfer_id}}" data-tranno="{{ $data->transfer_no}}" data-appformid="{{ $data->app_form_id}}" data-toggle="modal" data-target="#approveconfirm" data-backdrop="static" data-keyboard="false">
                    {{ trans('button.cancel')}}
                </a>
                @endcan
                @elseif($transfer_in_out == "In")
                <button onclick="open_modal('transit',{{ $data->transfer_id}})" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#transferModal" data-backdrop="static" data-keyboard="false">
                    {{ trans('button.transit')}}
                </button>
                @endif
                <!-------------------- End of Cancle Button and Transit Button -------------------->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>