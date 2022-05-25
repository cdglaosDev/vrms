<style>
    .c_open {
        width: 40px;
    }

    .c_cer_no {
        width: 70px;
        text-align: center;
    }

    .c_dated {
        width: 100px;
    }

    .c_v_type {
        width: 110px;
    }

    .c_brand {
        width: 110px;
    }

    .c_model {
        width: 120px;
    }

    .c_color {
        width: 90px;
    }

    .c_s_wheel {
        width: 90px;
    }

    .c_engine_no {
        width: 130px;
    }

    .c_chassis_no {
        width: 130px;
    }

    .c_enter_info {
        width: 110px;
    }

    .c_y_mnf {
        width: 75px;
    }

    .c_country_origin {
        width: 75px;
    }

    .c_updated_at {
        width: 150px;
    }
</style>
<span style="display:none" id="t_records">{{$total_records}}</span>
<span style="display:none" id="t_notIn_pages">{{$total_pages}}</span>
<div class="table-responsive">
    <table class="table vehicles_notIn_list fundClassesTable" style="width: 100%;">
        <tbody style="overflow-y: auto;height: 450px;display: block;">
            <tr>
                <td class="c_open"></td>
                <td class="c_cer_no">{{ trans('module4.certificate_no')}}</td>
                <td class="c_dated">{{ trans('module4.dated')}}</td>
                <td class="c_v_type">{{ trans('module4.v_type')}}</td>
                <td class="c_brand">{{ trans('module4.brand')}}</td>
                <td class="c_model">{{ trans('module4.model')}}</td>
                <td class="c_color">{{ trans('module4.traffic_color')}}</td>
                <td class="c_s_wheel">{{ trans('module4.steering_wheel')}}</td>
                <td class="c_engine_no">{{ trans('module4.engine_no')}}</td>
                <td class="c_chassis_no">{{ trans('module4.chassis_no')}}</td>
                <td class="c_enter_info">{{ trans('module4.enter_info')}}</td>
                <td class="c_y_mnf">{{ trans('module4.year_of_mnf')}}</td>
                <td class="c_country_origin">{{ trans('module4.country_origin')}}</td>
            </tr>
            @if($operation == "Normal")
            @foreach($vehicle_over_systems as $v_over_sys)
            <tr>
                <td class="c_open">
                    <a class="link" href="#" data-id="{{$v_over_sys->id}}" onclick="vehicleOverSystemModal(this, 'edit')">{{ trans('module4.open')}}</a>
                </td>
                <td class="c_cer_no">{{ $v_over_sys->certificate_no ?? '' }}</td>
                <td class="c_dated">{{ $v_over_sys->date ?? '' }}</td>
                <td class="c_v_type">{{ $v_over_sys->vtype->name ?? '' }}</td>
                <td class="c_brand">{{ $v_over_sys->vbrand->name ?? '' }}</td>
                <td class="c_model">{{ $v_over_sys->vmodel->name ?? '' }}</td>
                <td class="c_color">{{ $v_over_sys->color->name ?? '' }}</td>
                <td class="c_s_wheel">{{ $v_over_sys->steering->name ?? '' }}</td>
                <td class="c_engine_no">{{ $v_over_sys->engine_no ?? '' }}</td>
                <td class="c_chassis_no">
                    <a class="link" href="#" data-id="{{$v_over_sys->id}}" onclick="vehicleOverSystemModal(this, 'edit')">{{ $v_over_sys->chassis_no ?? '' }}</a>
                </td>
                <td class="c_enter_info">{{ $v_over_sys->user->name ?? '' }}</td>
                <td class="c_updated_at" colspan="2">{{ $v_over_sys->updated_at ?? '' }}</td>
            </tr>
            @endforeach
            @else
            @foreach($vehicle_over_systems as $v_over_sys)
            <tr>
                <td class="c_open">
                    <a class="link" href="#" data-id="{{$v_over_sys->id}}" onclick="vehicleOverSystemModal(this, 'edit')">{{ trans('module4.open')}}</a>
                </td>
                <td class="c_cer_no">{{ $v_over_sys->certificate_no ?? '' }}</td>
                <td class="c_dated">{{ $v_over_sys->date ?? '' }}</td>
                <td class="c_v_type">{{ $v_over_sys->vehicle_type_name ?? '' }}</td>
                <td class="c_brand">{{ $v_over_sys->brand_name ?? '' }}</td>
                <td class="c_model">{{ $v_over_sys->model_name ?? '' }}</td>
                <td class="c_color">{{ $v_over_sys->color_name ?? '' }}</td>
                <td class="c_s_wheel">{{ $v_over_sys->steering_name ?? '' }}</td>
                <td class="c_engine_no">{{ $v_over_sys->engine_no ?? '' }}</td>
                <td class="c_chassis_no">
                    <a class="link" href="#" data-id="{{$v_over_sys->id}}" onclick="vehicleOverSystemModal(this, 'edit')">{{ $v_over_sys->chassis_no ?? '' }}</a>
                </td>
                <td class="c_enter_info">{{ $v_over_sys->user_name ?? '' }}</td>
                <td class="c_updated_at" colspan="2">{{ $v_over_sys->updated_at ?? '' }}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>