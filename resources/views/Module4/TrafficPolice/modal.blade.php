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

<div class="modal fade bigger" id="trafficModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document" style="position: fixed;top: -28px;display: block;left: 50px;">
        <div class="modal-content" style="width:1280px;height:710px;">
            <div class="modal-header">
                <h3 style="padding: 0px;text-align: center;">{{ trans('module4.traffic_accident') }}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @include('flash')
            <div class="modal-body">
                <form action="{{route('traffic-police.store')}}" method="POST" enctype="multipart/form-data" onload="yourFunction();">
                    @csrf
                    <div>
                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th>ຂໍ້ມູນລົດ</th>
                                        <th>ຂໍ້ມູນເຈົ້າຂອງ</th>
                                        <th>ປະຫວັດການຕິດຕາມ</th>
                                        <th>{{ trans('module4.traffic_accidents_name') }}:</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        {{-- ********** First Column ********** --}}
                                        <td id="f-col">
                                            <label>{{ trans('module4.issue_date') }}:</label>
                                            <span for="" name="issue_date"></span>
                                            <br>
                                            <label>{{ trans('module4.expire_date_traffic_pop_up') }}:</label>
                                            <span for="" name="expire_date"></span>
                                            <br><br>
                                            <label>{{ trans('module4.license_no_traffic_pop_up') }}:</label>
                                            <input class="w100 license_no" purpose_no="" name="licence_no">
                                            <br><br>

                                            <label>{{ trans('module4.vehicle_kind_traffic_pop_up') }}:</label>
                                            <span for="" name="vehicle_kind_name" style="font-weight:bold"></span>
                                            <br>
                                            <label>{{ trans('module4.vehicle_type') }}:</label>
                                            <span for="" name="vehicle_type_name" style="font-weight:bold"></span>
                                            <br>
                                            <label>{{ trans('module4.brand') }}:</label>
                                            <span for="" name="brand_name" style="font-weight:bold"></span>
                                            <br>
                                            <label>{{ trans('module4.model') }}:</label>
                                            <span for="" name="model_name" style="font-weight:bold"></span>
                                            <br>
                                            <label>{{ trans('module4.color') }}:</label>
                                            <span for="" name="color_name" style="font-weight:bold"></span>
                                            <br><br>

                                            <label>{{ trans('module4.steering') }}:</label>
                                            <span for="" name="steering_name"></span>
                                            <br>
                                            <label>{{ trans('module4.engine_no') }}:</label>
                                            <span for="" name="engine_no"></span>
                                            <br>
                                            <label>{{ trans('module4.chassis_no') }}:</label>
                                            <span for="" name="chassis_no"></span>
                                            <br><br>

                                            <div style="font-size:11px">
                                                <label>{{ trans('module4.engine_type') }}:</label>
                                                <span for="" name="gas_name"></span>
                                                <br>
                                                <label>{{ trans('module4.number_of_cylinders') }}:</label>
                                                <span for="" name="cylinder"></span>
                                                <br>
                                                <label>{{ trans('module4.cc_traffic_pop_up') }}:</label>
                                                <span for="" name="cc"></span>
                                                <br>
                                                <label>{{ trans('module4.width') }}:</label>
                                                <span for="" name="width"></span><span style="color:#ddd">ມມ</span>
                                                <br>
                                                <label>{{ trans('module4.length') }}:</label>
                                                <span for="" name="long"></span><span style="color:#ddd">ມມ</span>
                                                <br>
                                                <label>{{ trans('module4.height') }}:</label>
                                                <span for="" name="height"></span><span style="color:#ddd">ມມ</span>
                                                <br>
                                                <label>{{ trans('module4.seat') }}:</label>
                                                <span for="" name="seat"></span>
                                                <br>
                                            </div>
                                        </td>
                                        {{-- ********** End First Column ********** --}}

                                        {{-- ********** Second Column ********** --}}
                                        <td id="s-col">
                                            <label>{{ trans('module4.name') }}:</label>
                                            <span for="" name="owner_name" style="font-weight:bold"></span>
                                            <br><br>
                                            <label>{{ trans('module4.village') }}:</label>
                                            <span for="" name="village_name" style="font-weight:bold"></span>
                                            <br>
                                            <label>{{ trans('module4.district_name') }}:</label>
                                            <span for="" name="district_name" style="font-weight:bold"></span>
                                            <br>
                                            <label>{{ trans('module4.province') }}:</label>
                                            <span for="" name="province_name" style="font-weight:bold"></span>
                                            <br><br>

                                            <label>{{ trans('module4.division_number') }}<small>(ກພ)</small>:</label>
                                            <span for="" name="division_no"></span>
                                            <br>
                                            <label>{{ trans('module4.province_number') }}<small>(ຂສ)</small>:</label>
                                            <span for="" name="province_no"></span>
                                            <br><br>

                                            <label>{{ trans('module4.number') }}:</label>
                                            <span for="" name="number"></span>
                                            <br>
                                            <label>vdvc serial:</label>
                                            <span for="" name="vdvd_card"></span>
                                            <br><br>

                                            <label>{{ trans('module4.note') }}</label>
                                            <span for="" name="remark"></span>
                                        </td>
                                        {{-- ********** End Second Column ********** --}}

                                        {{-- ********** Third Column ********** --}}
                                        <td id="t-col">
                                            <label>{{ trans('module4.illegal_date') }}:</label>
                                            <input type="text" name="illegal_date" class="date w110 mb-2" readonly>
                                            <br>
                                            <label>{{ trans('module4.illegal_no') }}:</label>
                                            <input type="text" name="illegal_no" class="w110 mb-2" readonly>
                                            <br><br>

                                            <label>{{ trans('module4.bill_date') }}:</label>
                                            <input type="text" name="bill_date" class="date w110 mb-2" readonly>
                                            <br>
                                            <label>{{ trans('module4.bill_no') }}:</label>
                                            <input type="text" name="bill_no" class="w110 mb-2" readonly>
                                            <br>

                                            <label>{{ trans('module4.police_note') }}:</label><br>
                                            <textarea name="note" style="width:215px;height:50px"></textarea>
                                            <br>
                                            <label>{{ trans('module4.fine_date') }}:</label>
                                            <input type="text" name="date" class="date w110 mb-2">
                                            <br>
                                            <label>{{ trans('module4.place') }}:</label>
                                            <input type="text" name="place" class="w110 mb-2">
                                            <br>
                                            <label>{{ trans('module4.re_solution_remark') }}:</label><br>
                                            <textarea name="illegal_trafic_remark" style="width:215px;height:50px"></textarea>
                                            <br>
                                            <label>{{ trans('module4.to_date') }}:</label>
                                            <input type="text" name="to_date" class="date w110 mb-2">
                                            <br>

                                            <button type="submit" class="btn btn-success btn-sm btn-save">{{trans('button.save')}}</button>
                                            <br><input type="hidden" name="vehicle_id">
                                            <input type="hidden" name="illegal_trafic_id" id="illegal_trafic_id">
                                            <input type="hidden" name="traffic_accidence_list" id="traffic_accidence_list">
                                        </td>
                                        {{-- ********** End Third Column ********** --}}

                                        {{-- ********** Fourth Column ********** --}}
                                        <td>
                                            <?php $i = 0; ?>
                                            @foreach($traffic_accidence as $chunked_accidence)
                                            <?php $i = $i + 1; ?>
                                            <label class="form-check-label">
                                                <input type="checkbox" name="accident_id[]" class="form-check-input chk" value="{{$chunked_accidence->id}}" id="accident_id">
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
                                                <input type="checkbox" name="accident_id[]" class="form-check-input chk" value="{{$chunked_accidence->id}}" id="accident_id">
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
            </div>
        </div>
    </div>
</div>
@push('page_scripts')
<script type="text/javascript">
    $("#trafficModal").on('shown.bs.modal', function() {
        checkedFunction();
    });

    function checkedFunction() {
        var list = document.getElementById("traffic_accidence_list").value;
        var myArray = list.split(",");
        // console.log(myArray);
        for (var i = 0; i < myArray.length; i++) {
            $('input[type=checkbox]').each(function() {
                // console.log($(this).val() + "=" + myArray[i]);
                if ($(this).val() == myArray[i].trim()) {
                    $(this).prop("checked", true);
                }
            });

        }
    }
</script>
@endpush