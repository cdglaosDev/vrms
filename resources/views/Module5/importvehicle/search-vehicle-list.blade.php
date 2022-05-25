<div>
<table id="importVeh" class="table table-striped" style="width:100%">
      <thead>
        <tr>
               <th><input type="checkbox" id="checkAll" /></th>
               <th style="width: 115px;">{{ trans('app_form.app_number') }}</th>
               <th style="width: 164px;">{{ trans('app_form.owner_name')}}</th>
               <th style="width: 121px;">{{ trans('app_form.pre_licence_no')}}</th>
               <th style="width: 105px;">{{ trans('app_form.village_name') }}</th>
               <th style="width: 83px;">{{ trans('vehicle.province')}}</th>
               <th style="width: 88px;">{{ trans('vehicle.vehicle_type')}}</th>
               <th style="width: 79px;">{{ trans('vehicle.brand')}}</th>
               <th style="width: 100px;">{{ trans('vehicle.model')}}</th>
               <th style="width: 145px;">{{ trans('module4.engine_no_chassis_no') }}</th>
               <th style="width: 115px;">{{ trans('app_form.app_status')}}</th>
               <th width="250">{{ trans('common.action')}}</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($vehicle_detail_result as $data)
        <tr>
            <td>
                <input type="checkbox" name="approve_list" @if(isset($data->app_status_id)){{ $data->app_status_id ==4 || $data->app_status_id ==5 || $data->app_status_id ==6 ? 'disabled' : '' }}@endif class="app_list" value="{{ $data->pre_app_id ?? '' }}">
            </td>
            <td>
                <a class="sameSize" id="appNumber{{$data->pre_app_id}}"  style="color:#007bff">{{ $data->app_number??'' }}</a>  
                <a style="color:#07279d; font-weight: bold;" data-backdrop="static" data-keyboard="false" class="btn_edit sameSize" data-url="{{route('import-vehicle.edit',['id'=>$data->pre_app_id])}}" data-toggle="modal"  data-target="#editModal"> {{ $data->regapp_number??'' }}</a>
                
            </td>
            <td><span style="font-weight:bold">{{ $data->owner_name ?? '' }}</span></td>
            <td>
                <a href=""  class="link license_no"  purpose_no="{{$data->vehicle_kind_code ?? ''}}">{{$data->licence_no_need??''}}</a>
                <div style="text-align:center;white-space:nowrap;color:#444;font-size:11px;padding:0;max-width:80px">{{ $data->kind_name ?? ''}}</div>
            </td>
            <td>
                <div style="font-weight:bold">{{ $data->village_name }}</div>
                <div style="color:#666"><small>ມ</small>{{$data->district_name ?? ''}}</div>
            </td>
            <td>
                <div class="province" province_code="{{ $data->province_code }}">{{ $data->province_name ?? ''}}</div>
            </td>
            <td>{{ $data->vehicle_type_name }}</td>
            <td>{{ $data->brand_name ?? '' }}</td>
            <td>{{ $data->model_name ?? '' }}</td>
            <td>
                <div class="sameSize">{{ $data->engine_no }}</div>
                <div><a href="#" class="link sameSize">{{ $data->chassis_no }}</a></div>
            </td>
            <td >@if($data->app_status_id ==6) <img src="{{ asset('images/draft.png') }}" class="status_image{{ $data->pre_app_id }}" title="{{trans('button.draft')}}" width="25" height="25"> @elseif($data->app_status_id ==5) <img src="{{ asset('images/rejected.png') }}" class="status_image{{ $data->pre_app_id }}" width="25" height="25"> @elseif($data->app_status_id ==4) <img src="{{ asset('images/approved.png') }}" class="status_image{{ $data->pre_app_id }}" width="25" height="25"> @elseif($data->app_status_id ==3) <img src="{{ asset('images/in_progress.png') }}" class="status_image{{ $data->pre_app_id }}" width="25" height="25"> @else complete @endif</td>
            <td>
                @can('Importer-Application-Item-Approve')
                <!-- approved button -->
                @if($data->app_status_id ==4  ||$data->app_status_id ==5 || $data->app_status_id ==6)
                <a class="disabled" title="Approved"><img src="{{ asset('images/approve_gray.png') }}" alt="" title="{{trans('button.approve')}}" width="25" height="25"></a>
                @else
                <a class="approve" data-id="{{ $data->pre_app_id }}"  title="Approved"><img src="{{ asset('images/approved_btn.png') }}" alt="" title="{{trans('button.approve')}}" id="approve_img{{$data->pre_app_id}}" width="25" height="25"></a>
                @endif
                <!-- reject button  -->
                @if($data->app_status_id == 4 || $data->app_status_id ==5 || $data->app_status_id ==6)
                <a><img src="{{ asset('images/reject_gray.png') }}" alt="" width="25" height="25"></a> 
                @else
                <a href="" class="reject" data-toggle="modal"  title="Rejected" data-target="#RejectModel" data-backdrop="static" data-keyboard="false" data-app_status_id="{{$data->app_status_id}}" data-id="{{$data->pre_app_id}}"><img src="{{ asset('images/rejected_btn.png') }}" alt="" title="{{trans('button.reject')}}" id="reject_img{{ $data->pre_app_id }}" width="25" height="25"></a> 
                @endif
                @endcan
                @if($data->app_status_id !=5)
                <a data-url="{{route('import-vehicle.show',['id'=>$data->vehicle_detail_id])}}" class="show_btn" data-backdrop="static" data-keyboard="false"  data-toggle="modal"  data-target="#showModal"   ><img src="{{ asset('images/view.png') }}" alt="" title="{{trans('title.view')}}" width="25" height="25px"></a> 
                @endif
                @can('Importer-Application-Item-Entry-Edit') 
                    @if($data->app_status_id ==4 || $data->app_status_id ==5 || $data->app_status_id ==3)
                    <a><img src="{{ asset('images/edit_gray.png') }}" alt="" width="25" height="25" title="{{trans('title.edit')}}"></a> 
                    @else
                    <a id="editImport{{ $data->pre_app_id }}" data-url="{{route('import-vehicle.edit',['id'=>$data->vehicle_detail_id])}}" data-backdrop="static" data-keyboard="false"  data-toggle="modal"  data-target="#editModal"  class="btn_edit"><img src="{{ asset('images/edit.png') }}" id="edit_image{{ $data->pre_app_id }}" alt="" title="{{trans('title.edit')}}" width="25" height="25px"></a>
                    @endif
                @endcan
                @if($data->app_status_id ==6 ) 
                <a href="" id="submitApp{{$data->pre_app_id}}" class="app-submit" title="{{ trans('title.submit') }}"  title1="{{ trans('title.need_fill_submit')}}" 
                    data-id="{{ $data->pre_app_id }}"  data-licence_no_need="{{$data->licence_no_need}}" data-vehicle_type_id="{{$data->vehicle_type_id}}"
                    data-width="{{$data->width}}" data-height="{{$data->height}}" data-long="{{$data->long}}" data-vehicle_kind_code="{{ $data->vehicle_kind_code}}"
                    data-brand_id="{{$data->brand_id}}" data-weight="{{ $data->weight }}" data-weight_filled="{{$data->weight_filled}}"
                    data-owner_name="{{$data->owner_name}}" data-model_id="{{$data->model_id}}" data-total_weight="{{$data->total_weight}}" data-color_id="{{$data->color_id}}"
                    data-engine_no="{{ $data->engine_no}}" data-seat="{{$data->seat}}" data-steering_id="{{$data->steering_id}}"
                    data-province_code="{{$data->province_code}}" data-chassis_no="{{$data->chassis_no}}" data-engine_type_id="{{$data->engine_type_id}}" 
                    data-cylinder="{{$data->cylinder}}" data-district_code="{{$data->district_code}}" data-motor_brand_id="{{$data->motor_brand_id}}"
                    data-cc="{{$data->cc}}" data-year_manufacture="{{$data->year_manufacture}}" data-village_name="{{$data->village_name}}" 
                    data-remark="{{$data->remark}}" data-axis="{{$data->axis}}" data-wheels="{{$data->wheels}}"><img src="{{ asset('images/submit.png') }}" alt="" width="25px" height="25px"></a>
                @endif
                @can('Importer-Application-Item-Entry-Delete') 
                    @if($data->app_status_id == 4)
                    <a><img src="{{ asset('images/delete_gray.png') }}" alt="" title="{{trans('title.delete')}}" width="25" height="25"></a> 
                    @else
                    <a href="" class="delete_btn_staff" data-id="{{ $data->pre_app_id }}"  >
                        <img src="{{ asset('images/delete.png') }}" alt="" title="{{trans('title.delete')}}"  width="25px" height="25px">
                    </a>
                    @endif
                
                @endcan
            </td>
        </tr>
        @endforeach 
      </tbody>
    </table>

    <ul class="pagination">
        <li class="page-item {{ $pageno <= 1?'disabled':''}}">
            <a class="page-link"> << </a>
        </li>
        @for($i = 1; $i <= $total_pages; $i++ )
        <li class="page-item {{ $pageno == $i?'active':''}}">
            <a class="page-link searchByFilter" data-page_no="{{$i}}" style="cursor:pointer"> {{ $i }}</a>
        </li>
       @endfor
        <li class="page-item <?php if($pageno >= $total_pages) { echo 'disabled'; } ?>">
            <a class="page-link">>></a>
        </li>
    </ul>
 </div>