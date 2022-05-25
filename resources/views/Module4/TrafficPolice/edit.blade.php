<style>
    .table-icontable td {
        border-collapse: collapse;
        border: none !important;
    }

    .table-icontable tr td {
        padding-top: 0;
    }

    .chk {
        margin-top: 0px;
    }

    #f-col label,
    #s-col label {
        min-width: 100px;
    }

    #t-col label {
        min-width: 80px;
    }
</style>

@php
$brands = \App\Model\VehicleBrand::whereStatus(1)->get();
$veh_types = \App\Model\VehicleType::whereStatus(1)->get();
$models = \App\Model\VehicleModel::whereStatus(1)->get();
$colors = \App\Model\Color::whereStatus(1)->get();

$traffic_accidence = \App\Model\TrafficAccident::whereStatus(1)->orderBy('id', 'asc')->take(20)->get();
$traffic_accidence_last = \App\Model\TrafficAccident::whereStatus(1)->orderBy('id', 'desc')->take(18)->get();
@endphp

<form action="{{route('traffic-police.store')}}" method="POST" enctype="multipart/form-data" onload="yourFunction();">
    @csrf
    <div>
        <div class="table-responsive">
            <table id="order-listing" class="table">
                <thead>
                    <tr>
                        <th style="padding-left: 20px;">{{ trans('module4.car_info') }}:</th>
                        <th>{{ trans('module4.owner_info') }}:</th>
                        <th>{{ trans('module4.track_history') }}:</th>
                        <th>{{ trans('module4.traffic_accidents_name') }}:</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        {{-- ********** First Column ********** --}}
                        <td id="f-col" style="padding-left: 20px;">
                            <label>{{ trans('module4.issue_date') }}:</label>
                            <span for="" name="issue_date">{{ $vehicle->issue_date }}</span>
                            <br>
                            <label>{{ trans('module4.expire_date_traffic_pop_up') }}:</label>
                            <span for="" name="expire_date">{{ $vehicle->expire_date }}</span>
                            <br><br>
                            <label>{{ trans('module4.license_no_traffic_pop_up') }}:</label>
                            <input class="w100 license_no" purpose_no="{{ $vehicle->vehicle_kind_code }}" name="licence_no" value="@if(strlen($vehicle->licence_no) == 0){{'0000'}} @else{{ $vehicle->licence_no }} @endif">
                            <br><br>

                            <label>{{ trans('module4.vehicle_kind_traffic_pop_up') }}:</label>
                            <span for="" name="vehicle_kind_name" style="font-weight:bold">{{ $vehicle->vehicle_kind->name ?? '' }}</span>
                            <br>
                            <label>{{ trans('module4.vehicle_type') }}:</label>
                            <span for="" name="vehicle_type_name" style="font-weight:bold">{{ $vehicle->vtype->name ?? '' }}</span>
                            <br>
                            <label>{{ trans('module4.brand') }}:</label>
                            <span for="" name="brand_name" style="font-weight:bold">{{ $vehicle->vbrand->name ?? '' }}</span>
                            <br>
                            <label>{{ trans('module4.model') }}:</label>
                            <span for="" name="model_name" style="font-weight:bold">{{ $vehicle->vmodel->name ?? '' }}</span>
                            <br>
                            <label>{{ trans('module4.color') }}:</label>
                            <span for="" name="color_name" style="font-weight:bold">{{ $vehicle->color->name ?? '' }}</span>
                            <br><br>

                            <label>{{ trans('module4.steering') }}:</label>
                            <span for="" name="steering_name">{{ $vehicle->steering->name ?? '' }}</span>
                            <br>
                            <label>{{ trans('module4.engine_no') }}:</label>
                            <span for="" name="engine_no">{{ $vehicle->engine_no }}</span>
                            <br>
                            <label>{{ trans('module4.chassis_no') }}:</label>
                            <span for="" name="chassis_no">{{ $vehicle->chassis_no }}</span>
                            <br><br>

                            <div style="font-size:11px">
                                <label>{{ trans('module4.engine_type') }}:</label>
                                <span for="" name="gas_name">{{ $vehicle->gas->name ?? '' }}</span>
                                <br>
                                <label>{{ trans('module4.number_of_cylinders') }}:</label>
                                <span for="" name="cylinder">{{ $vehicle->cylinder }}</span>
                                <br>
                                <label>{{ trans('module4.cc_traffic_pop_up') }}:</label>
                                <span for="" name="cc">{{ $vehicle->cc }}</span>
                                <br>
                                <label>{{ trans('module4.width') }}:</label>
                                <span for="" name="width">{{ $vehicle->width }}</span><span style="color:#ddd">ມມ</span>
                                <br>
                                <label>{{ trans('module4.length') }}:</label>
                                <span for="" name="long">{{ $vehicle->long }}</span><span style="color:#ddd">ມມ</span>
                                <br>
                                <label>{{ trans('module4.height') }}:</label>
                                <span for="" name="height">{{ $vehicle->height }}</span><span style="color:#ddd">ມມ</span>
                                <br>
                                <label>{{ trans('module4.seat') }}:</label>
                                <span for="" name="seat">{{ $vehicle->seat }}</span>
                                <br>
                            </div>
                        </td>
                        {{-- ********** End First Column ********** --}}

                        {{-- ********** Second Column ********** --}}
                        <td id="s-col">
                            <label>{{ trans('module4.name') }}:</label>
                            <span for="" name="owner_name" style="font-weight:bold">{{$vehicle->owner_name}}</span>
                            <br><br>
                            <label>{{ trans('module4.village') }}:</label>
                            <span for="" name="village_name" style="font-weight:bold">{{$vehicle->village_name}}</span>
                            <br>
                            <label>{{ trans('module4.district_name') }}:</label>
                            <span for="" name="district_name" style="font-weight:bold">{{ $vehicle->district->name ?? '' }}</span>
                            <br>
                            <label>{{ trans('module4.province') }}:</label>
                            <span for="" name="province_name" style="font-weight:bold">{{ $vehicle->province->name ?? '' }}</span>
                            <br><br>

                            <label>{{ trans('module4.division_number') }}<small>(ກພ)</small>:</label>
                            <span for="" name="division_no">{{$vehicle->division_no}}</span>
                            <br>
                            <label>{{ trans('module4.province_number') }}<small>(ຂສ)</small>:</label>
                            <span for="" name="province_no">{{$vehicle->province_no}}</span>
                            <br><br>

                            <label>{{ trans('module4.number') }}:</label>
                            <span for="" name="number">{{$vehicle->number}}</span>
                            <br>
                            <label>vdvc serial:</label>
                            <span for="" name="vdvd_card">{{$vehicle->vdvd_card}}</span>
                            <br><br>

                            <label>{{ trans('module4.note') }}</label>
                            <span for="" name="remark">{{$vehicle->remark}}</span><br/>
                            <label>Log:</label><br>
                            <textarea name="log" style="width:215px;height:50px">{{ $vehicle->illegalTrafic->log ?? '' }}</textarea>
                        </td>
                        {{-- ********** End Second Column ********** --}}

                        {{-- ********** Third Column ********** --}}
                        <td id="t-col">
                            <label>{{ trans('module4.illegal_date') }}:</label>
                            <input type="text" name="illegal_date" class="date w110 mb-2"  value="{{ $vehicle->illegalTrafic->illegal_date ?? '' }}" readonly>
                            <br>
                            <label>{{ trans('module4.illegal_no') }}:</label>
                            <input type="text" name="illegal_no" class="w110 mb-2" value="{{ $vehicle->illegalTrafic->illegal_no ?? '' }}"  readonly>
                            <br><br>

                            <label>{{ trans('module4.bill_date') }}:</label>
                            <input type="text" name="bill_date" class="date w110 mb-2"  value="{{ $vehicle->illegalTrafic->bill_date ?? '' }}" readonly>
                            <br>
                            <label>{{ trans('module4.bill_no') }}:</label>
                            <input type="text" name="bill_no" class="w110 mb-2"  value="{{ $vehicle->illegalTrafic->bill_no ?? '' }}" readonly>
                            <br>

                            <label>{{ trans('module4.police_note') }}:</label><br>
                            <textarea name="note" style="width:215px;height:50px" value="">{{ $vehicle->illegalTrafic->note ?? '' }}</textarea>
                            <br>
                            <label>{{ trans('module4.fine_date') }}:</label>
                            <input type="text" name="date" class="date w110 mb-2" value="{{ $vehicle->illegalTrafic->date ?? '' }}">
                            <br>
                            <label>{{ trans('module4.place') }}:</label>
                            <input type="text" name="place" class="w110 mb-2" value="{{ $vehicle->illegalTrafic->place ?? '' }}">
                            <br>
                            <label>{{ trans('module4.re_solution_remark') }}:</label><br>
                            <textarea name="illegal_trafic_remark" style="width:215px;height:50px" value="">{{ $vehicle->illegalTrafic->remark ?? '' }}</textarea>
                            <br>
                            <label>{{ trans('module4.to_date') }}:</label>
                            <input type="text" name="to_date" class="date w110 mb-2" value="{{ $vehicle->illegalTrafic->to_date ?? '' }}">
                            <br>

                            <button type="submit" class="btn btn-success btn-sm btn-save">{{trans('button.save')}}</button>
                            <br><input type="hidden" name="vehicle_id" value="{{$vehicle->id}}">
                            <input type="hidden" name="illegal_trafic_id" id="illegal_trafic_id" value="{{ $vehicle->illegalTrafic->id ?? '' }}">
                        </td>
                        {{-- ********** End Third Column ********** --}}

                        {{-- ********** Fourth Column ********** --}}
                        <td>
                            <?php $i = 0; ?>
                            @foreach($traffic_accidence as $chunked_accidence)
                            <?php $i = $i + 1; ?>

                            <label class="form-check-label">
                                <input type="checkbox" name="accident_id[]" class="form-check-input chk" value="{{$chunked_accidence->id}}" {{ in_array($chunked_accidence->id, $charges) ?'checked':''}} id="accident_id">
                                {{$i}}. {{$chunked_accidence->name}}
                            </label><br>
                            @endforeach
                        </td>
                        {{-- ********** End Fourth Column ********** --}}

                        {{-- ********** Fifth Column ********** --}}
                        <td>
                            <?php $i = 20; ?>
                            @foreach($traffic_accidence_last->reverse() as $chunked_accidence)
                            <?php $i = $i + 1; ?>
                            <label class="form-check-label">
                                <input type="checkbox" name="accident_id[]" class="form-check-input chk" value="{{$chunked_accidence->id}}" {{ in_array($chunked_accidence->id, $charges) ?'checked':''}} id="accident_id">
                                {{$i}}. {{$chunked_accidence->name}}
                            </label><br>
                            @endforeach
                        </td>
                        {{-- ********** End Fifth Column ********** --}}
                    </tr>
                </tbody>
            </table>
            <div>
            </div>
        </div>
</form>


@push('page_scripts')
<script type="text/javascript">
    $(document).on("click", '.btn_cancel', function(e) {
        location.reload();
        return false;
    });

    function validate_check() {
        var checkedCount = $('input[id=accident_id]:checkbox:checked').length;
        if (checkedCount > 0) {
            return true;
        } else {
            alert("Please select at least one at charges!!!");
            return false;
        }
    }
    $('input[type="illegal_date"]', '').keydown(function(e) {
        e.preventDefault();
        return false;
    });
</script>
@endpush