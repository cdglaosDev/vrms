@php
$app_form = \App\Model\AppForm::whereVehicleId($notification->data['vehicle_id'])->first();

@endphp
<a href="{{route("application.edit", $app_form->id)}}">
	
    <div class="notificaton markasread-handle" data-id="{{$notification->id}}">
        <div>
            <div class="title">{{$app_form->app_no}}</div>
           
        </div>
    </div>
</a>