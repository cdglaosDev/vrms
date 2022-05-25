@php
$details = \App\Model\PreRegisterApp::whereVehicleDetailId($notification->data['vehicle_detail_id'])->first();

@endphp
<div class="row">
    <div class="col-md-10">
        <p>Pre AppNumber : {{$details->regapp_number}}</p>
        @if($details->app_status_id ==4)
        <p>App Status : Approved</p>
        @elseif($details->app_status_id ==5)
        <p>App Status : Rejected</p>
        @elseif($details->app_status_id == 3)
        <p>App Status : In progress</p>
        @elseif($details->app_status_id == 6)
        <p>App Status : Draft</p>
        @elseif($details->app_status_id == 1)
        <p>App Status : Complete</p>
        @elseif($details->app_status_id == 2)
        <p>App Status : Cancel</p>
        @endif
        <p>Date : {{\Carbon\Carbon::parse($details->created_at)->format("d-m-Y")}}</p>
    </div>
    <div class="col-md-2">
        <div class="notificaton markasread-handle markasread" data-id="{{$notification->id}}" style="cursor: pointer">
            <a href="{{route('import-vehicle.edit',['id'=>$notification->data['vehicle_detail_id']])}}" class="btn btn-info btn-sm"> 
                <i class="fa fa-eye"></i>
            </a>           
        </div>
    </div>
</div>
        
