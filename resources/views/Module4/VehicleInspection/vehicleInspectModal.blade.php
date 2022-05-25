<style>
    .f-col,
    .s-col,
    .t-col {
        padding: 0px 0px 0px 10px;
    }

    .f-col label {
        min-width: 30%;
    }

    .f-col input {
        min-width: 65%;
    }

    .s-col label {
        min-width: 30%;
    }

    .s-col input {
        min-width: 65%;
    }

    .t-col label {
        min-width: 30%;
    }

    .t-col input {
        min-width: 65%;
    }

    #vehicle_inspect th {
        text-align: center;
    }
</style>
<div class="card-body" style="padding: 15px 26px 20px 26px;">
    @include('flash')
    <form action="" method="" enctype="multipart/form-data" style="width: 100%; height: 100%;">
        <!--================================== First Row ==================================-->
        <div class="row mb-3">
            <div class="col-md-4 col-sm-4 f-col">
                <label>{{ trans('module4.issue_date') }}:</label>
                <input type="text" class="date" value="{{ $vehicle->issue_date }}" name="issue_date" disabled>
            </div>
            <div class="col-md-4 col-sm-4 s-col">
                <label>{{ trans('module4.village') }}:</label>
                <input type="text" value="{{ $vehicle->village_name ?? '' }}" name="village_name" readonly="">
            </div>
            <div class="col-md-4 col-sm-4 t-col">
                <label>{{ trans('module4.brand') }}:</label>
                <input type="text" value="{{ $vehicle->vbrand->name ?? '' }}" name="brand_name" readonly="">
            </div>
        </div>
        <!--================================== Second Row ==================================-->
        <div class="row mb-3">
            <div class="col-md-4 col-sm-4 f-col">
                <label>{{ trans('module4.expire_date_traffic_pop_up') }}:</label>
                <input type="text" class="date" value="{{ $vehicle->expire_date }}" name="expire_date" disabled>
            </div>
            <div class="col-md-4 col-sm-4 s-col">
                <label>{{ trans('module4.district_name') }}:</label>
                <input type="text" value="{{ $vehicle->district->name ?? '' }}" name="district_name" readonly="">
            </div>
            <div class="col-md-4 col-sm-4 t-col">
                <label>{{ trans('module4.model') }}:</label>
                <input type="text" value="{{ $vehicle->vmodel->name ?? '' }}" name="model_name" readonly="">
            </div>
        </div>
        <!--================================== Third Row ==================================-->
        <div class="row mb-3">
            <div class="col-md-4 col-sm-4 f-col">
                <label>{{ trans('module4.vehicle_inspect_license_no') }}:</label>
                <input class="license_no" purpose_no="{{ $vehicle->vehicle_kind_code }}" name="licence_no" value="@if(strlen($vehicle->licence_no) == 0){{'0000'}} @else{{ $vehicle->licence_no }} @endif" readonly>
            </div>
            <div class="col-md-4 col-sm-4 s-col">
                <label>{{ trans('module4.province') }}:</label>
                <input type="text" value="{{ $vehicle->province->name ?? '' }}" name="province_name" readonly="">
            </div>
            <div class="col-md-4 col-sm-4 t-col">
                <label>{{ trans('module4.engine_no') }}:</label>
                <input type="text" value="{{ $vehicle->engine_no ?? '' }}" name="engine_no" readonly="">
            </div>
        </div>
        <!--================================== Fourth Row ==================================-->
        <div class="row mb-3" style="vertical-align: middle;">
            <div class="col-md-4 col-sm-4 f-col">
                <label>{{ trans('module4.purpose') }}:</label>
                <input type="text" value="{{ $vehicle->purpose->name ?? '' }}" name="purpose_name" readonly="">
            </div>
            <div class="col-md-4 col-sm-4 s-col">
                <label>{{ trans('module4.vehicle_inspect_vehicle_type') }}:</label>
                <input type="text" value="{{ $vehicle->vtype->name ?? '' }}" name="vehicle_type_name" readonly="">
            </div>
            <div class="col-md-4 col-sm-4 t-col">
                <label>{{ trans('module4.chassis_no') }}:</label>
                <input type="text" value="{{ $vehicle->chassis_no ?? '' }}" name="chassis_no" readonly="">
            </div>
        </div>
        <!--================================== Fifth Row ==================================-->
        <div class="row mb-3">
            <div class="col-md-4 col-sm-4 f-col">
                <label>{{ trans('module4.name') }}:</label>
                <input type="text" value="{{$vehicle->owner_name}}" name="owner_name" readonly="">
            </div>
            <div class="col-md-4 col-sm-4 s-col">
                <label>{{ trans('module4.vehicle_inspect_use_date') }}:</label>
                <input type="text" class="date" value="{{ $vehicle->created_at }}" name="created_at" disabled>
            </div>
            <div class="col-md-4 col-sm-4 t-col">
                <label></label>
                <a style="width: 65%;" class="btn btn-success text-white" href="#" data-id="{{$vehicle->id}}" onclick="addVehicleInspectModal(this)">{{ trans('button.add_inspect') }}</a>
            </div>
        </div>
        <!--================================== Table Row ==================================-->
        <div id="loader" class="lds-dual-ring hidden overlay"></div>
        <div class="row mb-1" style="padding-left: 10px; padding-right: 10px;" id="v_inspect_info">
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
                    @if(isset($vehicle->inspection))
                    @foreach($vehicle->inspection as $index => $item)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $item->inspect_place->name ?? '' }}</td>
                        <td>{{ $item->issue_date ?? '' }}</td>
                        <td>{{ $item->expire_date ?? '' }}</td>
                        <td>
                            <a class="link font-weight-bold" href="#" data-id="{{$vehicle->id}}" data-vehicle_inspect_id="{{$item->id}}" onclick="editVehicleInspectModal(this)">
                                @if(($item->result ?? '') == "pass"){{"Pass"}} 
                                @elseif(($item->result ?? '') == "not_pass"){{"Not Pass"}}  
                                @elseif(($item->result ?? '') == "none"){{"None"}}  
                                @else {{""}} 
                                @endif
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>

    </form>
</div>