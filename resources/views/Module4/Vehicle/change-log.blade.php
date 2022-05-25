@php
$print_log = \App\Model\PrintLog::whereVehicleId($vehicle_id)->get();
$veh_logs = \App\Model\VehicleLog::whereVehicleId($vehicle_id)->get();
$activity_logs = \App\Model\LogTable::whereTableNameAndVehicleId('vehicles', $vehicle_id)->get();
@endphp
<div class="row">
<div class="col-md-12">
<table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Field</th>
                <th>Old Data</th>
                <th>New Data</th>
                <th>Datetime</th>
                <th>Username</th>
                <th>IP address</th>
            </tr>
        </thead>
        <tbody>
        @foreach($veh_logs  as $key=>$veh_log)
            <tr>
                <td>{{ $key+1}}</td>
                <td>{{ $veh_log->name ?? ''}}</td>
                <td>@if($veh_log->name == 'brand_id'){{$veh_log->brandOld->name ?? ''}} @elseif($veh_log->name == 'model_id'){{$veh_log->modelOld->name ?? ''}} 
                    @elseif($veh_log->name == 'province_code'){{$veh_log->provinceOld->name ?? ''}} @elseif($veh_log->name == 'district_code'){{$veh_log->districtOld->name ?? ''}}
                    @elseif($veh_log->name == 'vehicle_kind_code'){{$veh_log->kindOld->name ?? ''}} @elseif($veh_log->name == 'vehicle_type_id'){{$veh_log->typeOld->name ?? ''}}  
                    @elseif($veh_log->name == 'steering_id'){{$veh_log->steeringOld->name ?? ''}} @elseif($veh_log->name == 'engine_type_id'){{$veh_log->engineTypegOld->name ?? ''}}
                    @elseif($veh_log->name == 'motor_brand_id'){{$veh_log->motorBrandOld->name ?? ''}} @elseif($veh_log->name == 'color_id'){{$veh_log->colorOld->name ?? ''}}
                    @else {{ $veh_log->from ?? ''}}@endif
                </td>
                <td>@if($veh_log->name == 'brand_id'){{$veh_log->brandNew->name ?? ''}} @elseif($veh_log->name == 'model_id'){{$veh_log->modelNew->name ?? ''}} 
                    @elseif($veh_log->name == 'province_code'){{$veh_log->provinceNew->name ?? ''}} @elseif($veh_log->name == 'district_code'){{$veh_log->districtNew->name ?? ''}}
                    @elseif($veh_log->name == 'vehicle_kind_code'){{$veh_log->kindNew->name ?? ''}} @elseif($veh_log->name == 'vehicle_type_id'){{$veh_log->typeNew->name ?? ''}}  
                    @elseif($veh_log->name == 'steering_id'){{$veh_log->steeringNew->name ?? ''}} @elseif($veh_log->name == 'engine_type_id'){{$veh_log->engineTypegNew->name ?? ''}}
                    @elseif($veh_log->name == 'motor_brand_id'){{$veh_log->motorBrandNew->name ?? ''}} @elseif($veh_log->name == 'color_id'){{$veh_log->colorNew->name ?? ''}}
                    @else {{ $veh_log->to ?? ''}}@endif
                </td>
                <td>{{ $veh_log->created_at->format('Y-m-d')  ?? ''}}</td>
                <td>{{ $veh_log->user->name ?? ''}}</td>
                <td>{{ $veh_log->ip_address ?? ''}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="col-md-6 mt-4">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Edition</th>
                <th>DateTime</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
        @foreach($print_log  as $key=>$log)
            <tr>
                <td>{{ $key+1}}</td>
                <td>{{ $log->print_log_datetime->format('Y-m-d') ?? ''}}</td>
                <td>{{ $log->user->name ?? ''}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="col-md-6 mt-4">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Number</th>
                <th>DateTime</th>
                <th>Action Detail</th>
                <th>Name</th>
               
            </tr>
        </thead>
        <tbody>
        @foreach($activity_logs  as $key=>$act_log)
            <tr>
                <td>{{ $key+1}}</td>
                <td>{{ $act_log->date->format('Y-m-d') ?? ''}}</td>
                <td><a id="click-detail" style="color:blue">Detail</a><div id="details" style="display:none;width: 200px;">{{ $act_log->action_detail}}</div></td>
                <td>{{ $act_log->users->name ?? ''}}</td>
               
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</div>
