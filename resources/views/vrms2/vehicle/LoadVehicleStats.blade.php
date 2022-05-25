@php
$v_12 = \App\Model\VehicleType::whereId(12)->first();
$v_1 = \App\Model\VehicleType::whereId(1)->first();
$v_109 = \App\Model\VehicleType::whereId(109)->first();
$v_2 = \App\Model\VehicleType::whereId(2)->first();
$v_10 = \App\Model\VehicleType::whereId(10)->first();
$v_38 = \App\Model\VehicleType::whereId(38)->first();
$v_46 = \App\Model\VehicleType::whereId(46)->first();
$v_76 = \App\Model\VehicleType::whereId(76)->first();
$v_68 = \App\Model\VehicleType::whereId(68)->first();
$v_29 = \App\Model\VehicleType::whereId(29)->first();
$v_27 = \App\Model\VehicleType::whereId(27)->first();
$v_new_total = 0;
@endphp
<h3 style="padding-left: 0px;font-size: 19px;">
    {{ trans('module4.province') }} {{ $province_name }} -
    {{ trans('module4.v_stats_during_the_date') }} {{ $during_date }} {{ trans('module4.v_stats_and') }} {{ $to_date }}
</h3>
<hr style="margin-top: 3px;margin-bottom: 10px;">
<!-- ================================ New Vehicles Table ================================ -->
<label style="padding-left: 0px;font-size: 17px;font-weight: bold;">{{ trans('module4.v_stats_new_vehicle') }}</label>
<table class="table table-striped" id="new_v_tbl" style="width: 75%;">
    <tbody>
        <tr>
            <td>-</td>
            @foreach($new_vehicles_result as $new_v_result)
            <td align="right">{{ $new_v_result->name }}</td>
            @endforeach
            <td align="right">{{ trans('module4.total') }}</td>
        </tr>
        <tr>
            <td>-</td>
            @foreach($new_vehicles_result as $new_v_result)
            <?php $v_new_total += $new_v_result->total; ?>
            <td align="right">{{ ($new_v_result->total == 0)? "" : $new_v_result->total }}</td>
            @endforeach
            <td align="right">{{ $v_new_total }}</td>
        </tr>
    </tbody>
</table>

<!-- ================================ Divided by  label to date ================================ -->
<label style="padding-left: 0px;font-size: 17px;font-weight: bold;margin-top: 7px;">{{ trans('module4.v_stats_div_label') }}</label>
<table class="table table-striped" id="div_label_tbl" style="width: 75%;">
    <tbody>
        <tr>
            <td>ລັດບໍລິຫານ</td>
            <td>{{ $v_1->name ?? '' }}</td>
            <td>{{ $v_2->name ?? '' }}</td>
            <td>{{ $v_10->name ?? '' }}</td>
            <td>{{ $v_12->name ?? '' }}</td>
            <td>{{ $v_27->name ?? '' }}</td>
            <td>{{ $v_29->name ?? '' }}</td>
            <td>{{ $v_38->name ?? '' }}</td>
            <td>{{ $v_46->name ?? '' }}</td>
            <td>{{ $v_68->name ?? '' }}</td>
            <td>{{ $v_76->name ?? '' }}</td>
            <td>{{ $v_109->name ?? '' }}</td>
            <td>{{ trans('module4.total') }}</td>
        </tr>
        @foreach($div_by_label_result as $div_label)
        <tr>
            <td>{{ $div_label->name?? '' }}</td>
            <td align="right">{{ ($div_label->v_1  == 0)? "" : $div_label->v_1 }}</td>
            <td align="right">{{ ($div_label->v_2 == 0)? "" : $div_label->v_2 }}</td>
            <td align="right">{{ ($div_label->v_10 == 0)? "" : $div_label->v_10 }}</td>
            <td align="right">{{ ($div_label->v_12 == 0)? "" : $div_label->v_12 }}</td>
            <td align="right">{{ ($div_label->v_27 == 0)? "" : $div_label->v_27 }}</td>
            <td align="right">{{ ($div_label->v_29 == 0)? "" : $div_label->v_29 }}</td>
            <td align="right">{{ ($div_label->v_38 == 0)? "" : $div_label->v_38 }}</td>
            <td align="right">{{ ($div_label->v_46== 0)? "" : $div_label->v_46 }}</td>
            <td align="right">{{ ($div_label->v_68 == 0)? "" : $div_label->v_68 }}</td>
            <td align="right">{{ ($div_label->v_76 == 0)? "" : $div_label->v_76 }}</td>
            <td align="right">{{ ($div_label->v_109 == 0)? "" : $div_label->v_109 }}</td>
            <td align="right">{{ ($div_label->total == 0)? "" : $div_label->total }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- ================================ Divided by district to date ================================ -->
<label style="padding-left: 0px;font-size: 17px;font-weight: bold;margin-top: 7px;">{{ trans('module4.v_stats_div_district') }}</label>
<table class="table table-striped" id="div_district_tbl" style="width: 75%;">
    <tbody>
        <tr>
            <td>ເມືອງ</td>
            <td>{{ $v_1->name ?? '' }}</td>
            <td>{{ $v_2->name ?? '' }}</td>
            <td>{{ $v_10->name ?? '' }}</td>
            <td>{{ $v_12->name ?? '' }}</td>
            <td>{{ $v_27->name ?? '' }}</td>
            <td>{{ $v_29->name ?? '' }}</td>
            <td>{{ $v_38->name ?? '' }}</td>
            <td>{{ $v_46->name ?? '' }}</td>
            <td>{{ $v_68->name ?? '' }}</td>
            <td>{{ $v_76->name ?? '' }}</td>
            <td>{{ $v_109->name ?? '' }}</td>
            <td>{{ trans('module4.total') }}</td>
        </tr>
        @foreach($div_by_district_result as $div_district)
        <tr>
            <td>{{ $div_district->name?? '' }}</td>
            <td align="right">{{ ($div_district->v_1  == 0)? "" : $div_district->v_1 }}</td>
            <td align="right">{{ ($div_district->v_2 == 0)? "" : $div_district->v_2 }}</td>
            <td align="right">{{ ($div_district->v_10 == 0)? "" : $div_district->v_10 }}</td>
            <td align="right">{{ ($div_district->v_12 == 0)? "" : $div_district->v_12 }}</td>
            <td align="right">{{ ($div_district->v_27 == 0)? "" : $div_district->v_27 }}</td>
            <td align="right">{{ ($div_district->v_29 == 0)? "" : $div_district->v_29 }}</td>
            <td align="right">{{ ($div_district->v_38 == 0)? "" : $div_district->v_38 }}</td>
            <td align="right">{{ ($div_district->v_46== 0)? "" : $div_district->v_46 }}</td>
            <td align="right">{{ ($div_district->v_68 == 0)? "" : $div_district->v_68 }}</td>
            <td align="right">{{ ($div_district->v_76 == 0)? "" : $div_district->v_76 }}</td>
            <td align="right">{{ ($div_district->v_109 == 0)? "" : $div_district->v_109 }}</td>
            <td align="right">{{ ($div_district->total == 0)? "" : $div_district->total }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- ================================ Divided by district to date ================================ -->
<label style="padding-left: 0px;font-size: 17px;font-weight: bold;margin-top: 7px;">{{ trans('module4.v_stats_div_brand') }}</label>
<table class="table table-striped" id="div_brand_tbl" style="width: 75%;">
    <tbody>
        <tr>
            <td>ຍີ່ຫໍ້</td>
            <td>{{ $v_1->name ?? '' }}</td>
            <td>{{ $v_2->name ?? '' }}</td>
            <td>{{ $v_10->name ?? '' }}</td>
            <td>{{ $v_12->name ?? '' }}</td>
            <td>{{ $v_27->name ?? '' }}</td>
            <td>{{ $v_29->name ?? '' }}</td>
            <td>{{ $v_38->name ?? '' }}</td>
            <td>{{ $v_46->name ?? '' }}</td>
            <td>{{ $v_68->name ?? '' }}</td>
            <td>{{ $v_76->name ?? '' }}</td>
            <td>{{ $v_109->name ?? '' }}</td>
            <td>{{ trans('module4.total') }}</td>
        </tr>
        @foreach($div_by_brand_result as $div_brand)
        <tr>
            <td>{{ $div_brand->name?? '' }}</td>
            <td align="right">{{ ($div_brand->v_1  == 0)? "" : $div_brand->v_1 }}</td>
            <td align="right">{{ ($div_brand->v_2 == 0)? "" : $div_brand->v_2 }}</td>
            <td align="right">{{ ($div_brand->v_10 == 0)? "" : $div_brand->v_10 }}</td>
            <td align="right">{{ ($div_brand->v_12 == 0)? "" : $div_brand->v_12 }}</td>
            <td align="right">{{ ($div_brand->v_27 == 0)? "" : $div_brand->v_27 }}</td>
            <td align="right">{{ ($div_brand->v_29 == 0)? "" : $div_brand->v_29 }}</td>
            <td align="right">{{ ($div_brand->v_38 == 0)? "" : $div_brand->v_38 }}</td>
            <td align="right">{{ ($div_brand->v_46== 0)? "" : $div_brand->v_46 }}</td>
            <td align="right">{{ ($div_brand->v_68 == 0)? "" : $div_brand->v_68 }}</td>
            <td align="right">{{ ($div_brand->v_76 == 0)? "" : $div_brand->v_76 }}</td>
            <td align="right">{{ ($div_brand->v_109 == 0)? "" : $div_brand->v_109 }}</td>
            <td align="right">{{ ($div_brand->total == 0)? "" : $div_brand->total }}</td>
        </tr>
        @endforeach
    </tbody>
</table>