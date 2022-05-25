@extends('vrms2.layouts.master')
@section('tech','active')
@section('content')

<h3>{{trans('transfer_vehicle.technical_inspect')}}
    @can('Technical-Inspect-Create')
    <a data-toggle="modal" data-target="#addModel" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-save text-white">{{trans('transfer_vehicle.add_new_techincal_inspect')}}</a>
    @endcan
</h3>

@include('flash')
<div class="card-body">
    <div class="table-responsive">
        <table id="myTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>{{ trans('transfer_vehicle.inspcet_number') }}</th>
                    <th>{{ trans('transfer_vehicle.request_number') }}</th>
                    <th>{{ trans('transfer_vehicle.date') }}</th>
                    <th>{{ trans('transfer_vehicle.inspect_type') }}</th>
                    <th>{{ trans('transfer_vehicle.license_plate') }}</th>
                    <th>{{ trans('transfer_vehicle.status') }}</th>
                    <th>{{ trans('transfer_vehicle.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vehicleinspection as $vehicleinspection)
                <tr>
                    <td>{{$vehicleinspection -> inspect_number}}</td>
                    <td>{{$vehicleinspection -> app_request_no}}</td>
                    <td>{{date('d-m-Y', strtotime($vehicleinspection->date))}}</td>
                    <td>{{$vehicleinspection -> type}}</td>
                    <td>{{$vehicleinspection -> license_plate_no}}</td>
                    {{-- <td>@if(isset($vehicleinspection-> vehicle_type))<span>{{$vehicleinspection->vehicle_type['name']}}({{$vehicleinspection->vehicle_type['name_en']}})</span>@else{{"_"}}@endif</td> --}}

                    <td>@if($vehicleinspection->status ==1)Active @else Deactive @endif</td>
                    <td>
                        @can('Technical-Inspect-Edit')
                        <a href="" class="btn btn-info btn-sm edit_btn" data-toggle="modal" data-target="#editModel" data-backdrop="static" data-keyboard="false" data-act="Edit" 
                        data-id="{{ $vehicleinspection->id }}" 
                        data-app_request_no="{{ $vehicleinspection -> app_request_no }}" 
                        data-inspect_number="{{ $vehicleinspection -> inspect_number }}" 
                        data-date="{{ $vehicleinspection->date }}" 
                        data-type="{{ $vehicleinspection->type }}" 
                        data-log_activity="{{ $vehicleinspection->log_activity }}" 
                        data-license_plate_no="{{ $vehicleinspection->license_plate_no }}" 
                        data-result="{{ $vehicleinspection->result }}" 
                        data-comment="{{ $vehicleinspection->comment }}"
                        data-vehicle_type_id = "{{ $vehicleinspection->vehicle_type_id }}" 
                        data-status = "{{ $vehicleinspection->status }}" 
                        >{{ trans('button.edit') }}</a>
                        @endcan

                        @can('Technical-Inspect-Delete')
                        <form class="delete" style="display:inline" action="/technical-inspect/{{$vehicleinspection -> id}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">{{ trans('button.delete') }}</button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('Technicallnspect.modal')
@endsection

@push('page_scripts')

<script type="text/javascript">
    var myTable = $('#myTable').DataTable(); 
    var base_url = "{{url('technical-inspect')}}";
    //route('technical-inspect.update',['id'=>$vehicle_inspection->id])
    $(".delete").on("submit", function() {
        return confirm("Are you sure to delete?");
    });
   
    $(document).on("click", '.edit_btn', function(e) {
        $('[name="app_request_no"]').val($(this).data('app_request_no'));
        $('[name="inspect_number"]').val($(this).data('inspect_number'));
        $('[name="date"]').val($(this).data('date'));
        $('[name="type"]').val($(this).data('type'));
        $('[name="log_activity"]').val($(this).data('log_activity'));
        $('[name="license_plate_no"]').val($(this).data('license_plate_no'));
        $('[name="result"]').val($(this).data('result'));
        $('[name="comment"]').val($(this).data('comment'));
        $('[name="vehicle_type_id"]').val($(this).data('vehicle_type_id')).attr('selected', 'selected');
        $('[name="status"]').val($(this).data('status')).attr('selected', 'selected');

        document.getElementById("editform").action = base_url + "/" + $(this).data('id');
    });
</script>
@endpush