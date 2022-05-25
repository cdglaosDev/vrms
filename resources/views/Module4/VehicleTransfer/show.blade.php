@if($action == "approve")
    <div class="modal-content" style="width:900px;">
@else
    <div class="modal-content" style="width:1200px;">
@endif

<div class="modal-header">
    <h3 style="padding: 0px;text-align: center;">{{ trans('module4.vehicle_transfer')}}</h3>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="card-body" style="padding: 10px 26px 20px 26px;">
    @include('flash')
    <form action="{{ url('transfer-in-actions') }}" method="POST" enctype="multipart/form-data" style="width: 100%; height: 100%;">
        @method('post')
        @csrf

        <input type="hidden" name="app_form_id" value="{{ $transfer->app_form_id }}">
        <input type="hidden" name="transfer_id" value="{{ $transfer->id }}">
        <input type="hidden" name="action" value="{{ $action }}">

        @if($action == "approve")
        <div class="form-row mb-4">
            <div class="col-md-3 col-sm-3 ">
                <label for="validationCustom01">{{ trans('module4.license_no')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{ $transfer->AppForm->vehicle->licence_no }}" name="licence_no" readonly="">
            </div>
            <div class="col-md-9 col-sm-9">
                <label for="validationCustom01">{{ trans('module4.vehicle_kind')}}:</label>
                <select name="vehicle_kind_id" class="form-control js-example-basic-single" disabled="disabled">
                    <option value="" selected disabled>Select Vehicle Kind</option>
                    @foreach($data['kinds'] as $kind)
                    <option value="{{$kind->id}}" @if($transfer->AppForm == null) @else {{$kind->id == $transfer->AppForm->vehicle->vehicle_kind_code ?'selected':''}} @endif>{{ $kind->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 col-sm-3">
                <label for="validationCustom01">{{ trans('module4.transfer_no_with_dot')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{ $transfer->transfer_no}}" name="transfer_no" readonly="">
            </div>

            <div class="col-md-9 col-sm-9">
                <label for="validationCustom01"> {{ trans('module4.customer_name')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{ $transfer->AppForm->customer_name ?? ''}}" name="customer_name" readonly="">
                <input type="hidden" value="" name="vehicle_id">
            </div>

            <div class="col-md-3 col-sm-3">
                <label for="validationCustom01">{{ trans('module4.app_no')}}:</label>
                <input type="text" name="app_request_no" class="form-control" value="{{ $transfer->app_request_no}}" readonly>
            </div>
            <div class="col-md-3 col-sm-3">
                <label for="validationCustom01">{{ trans('module4.date_req')}}:</label>
                <input type="text" class="date form-control" id="validationCustom01" value="{{ $transfer->AppForm->created_at}}" name="request_date" disabled>
            </div>
            <div class="col-md-3 col-sm-3">
                <label for="validationCustom01">{{ trans('module4.transfer_from')}}:</label>
                <select name="transfer_from " id="" class="form-control js-example-basic-single" disabled>
                    <option value="" disabled>Select transfer From</option>
                    @foreach($data['provinces'] as $pro1)
                    <option value="{{$pro1->province_code}}" {{$pro1->province_code == $transfer->transfer_from ?'selected':''}}>{{ $pro1->name }}({{$pro1->name_en}})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 col-sm- ">
                <label for="validationCustom01">{{ trans('module4.transfer_to')}}:</label>
                <select name="transfer_to" id="" class="form-control js-example-basic-single" disabled>
                    <option value="" disabled>Select transfer To</option>
                    @foreach($data['provinces'] as $pro)
                    <option value="{{$pro->province_code}}" {{$pro->province_code == $transfer->transfer_to ?'selected':''}}>{{ $pro->name }}({{$pro->name_en}})</option>
                    @endforeach
                </select>
            </div>
        </div>
        @else
        <div class="form-row mb-4">
            <div class="col-md-1 col-sm-2 ">
                <label for="validationCustom01">{{ trans('module4.transfer_no_with_dot')}}:</label>
                {{-- <input type="text" class="form-control" id="validationCustom01" value="{{\App\Helpers\getData::tran_no()}}" placeholder="" name="transfer_no" readonly=""> --}}
                <input type="text" class="form-control" id="validationCustom01" value="{{ $transfer->transfer_no}}" placeholder="" name="transfer_no" readonly="">
            </div>
            <div class="col-md-1 col-sm-2 ">
                <label for="validationCustom01">{{ trans('module4.app_no')}}:</label>
                <input type="text" name="app_request_no" class="form-control" value="{{ $transfer->app_request_no}}" readonly required="">
            </div>
            <div class="col-md-2 col-sm-2 ">
                <label for="validationCustom01">{{ trans('module4.license_no')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="@if(strlen($transfer->AppForm->vehicle->licence_no) == 0){{'0000'}} @else{{ $transfer->AppForm->vehicle->licence_no }} @endif" placeholder="" name="licence_no" readonly="">
            </div>

            <div class="col-md-2 col-sm-2 ">
                <label for="validationCustom01">{{ trans('common.date')}}:</label>
                <input type="text" class="date form-control" id="validationCustom01" value="{{ $transfer->transfer_date}}" placeholder="" name="transfer_date" required="" disabled>
            </div>

            <div class="col-md-2 col-sm-2 ">
                <label for="validationCustom01">{{ trans('module4.customer_name')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{ $transfer->AppForm->customer_name ?? ''}}" placeholder="" name="customer_name" readonly="">
                <input type="hidden" value="" name="vehicle_id">
            </div>
            <div class="col-md-2 col-sm-2 ">
                <label for="validationCustom01">{{ trans('common.status')}}:</label>
                <select name="status" class="form-control" disabled>
                    <option value="">{{ $transfer->status }}</option>
                    {{-- <option value="">Select Status</option>
            @foreach(\App\Model\TransferVehicle::getEnumList("status") as $key => $value)
                <option value="{{$key}}" {{$key == $transfer->status ?'selected':''}}>{{$value}}</option>
                    @endforeach --}}
                </select>
            </div>
            <div class="col-md-2 col-sm-2 ">
                <label for="validationCustom01">{{ trans('common.province')}}:</label>
                <input type="text" class="form-control" value="{{ $transfer->AppForm->vehicle->province->name }}" readonly>
            </div>
            <div class="col-md-2 col-sm-2 ">
                <label for="validationCustom01">{{ trans('module4.motor_brand')}}:</label>
                <select name="moter_brand_id" class="form-control js-example-basic-single" disabled="disabled">
                    <option value="" selected disabled>Select Model Brand</option>
                    @foreach($data['moter_brand'] as $motor)
                    <option value="{{$motor->id}}" @if($transfer->AppForm == null) @else {{$motor->id == $transfer->AppForm->vehicle->motor_brand_id ?'selected':''}} @endif>{{ $motor->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 col-sm-2 ">
                <label for="validationCustom01">{{ trans('module4.vehicle_kind')}}:</label>
                <select name="vehicle_kind_id" class="form-control js-example-basic-single" disabled="disabled">
                    <option value="" selected disabled>Select Vehicle Kind</option>
                    @foreach($data['kinds'] as $kind)
                    <option value="{{$kind->id}}" @if($transfer->AppForm == null) @else {{$kind->id == $transfer->AppForm->vehicle->vehicle_kind_code ?'selected':''}} @endif>{{ $kind->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 col-sm-2 ">
                <label for="validationCustom01">{{ trans('module4.transfer_from')}}:</label>
                <select name="transfer_from " id="" class="form-control js-example-basic-single" required disabled>
                    <option value="" disabled>Select transfer From</option>
                    @foreach($data['provinces'] as $pro1)
                    <option value="{{$pro1->province_code}}" {{$pro1->province_code == $transfer->transfer_from ?'selected':''}}>{{ $pro1->name }}({{$pro1->name_en}})</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 col-sm-2 ">
                <label for="validationCustom01">{{ trans('module4.transfer_to')}}:</label>
                <select name="transfer_to" id="" class="form-control js-example-basic-single" required required {{$action == 'view' ?'disabled':''}}>
                    <option value="" disabled>Select transfer To</option>
                    @foreach($data['provinces'] as $pro)
                    <option value="{{$pro->province_code}}" {{$pro->province_code == $transfer->transfer_to ?'selected':''}}>{{ $pro->name }}({{$pro->name_en}})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 col-sm-2 ">
                <label for="validationCustom01">{{ trans('module4.owner_name')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{ $transfer->AppForm->vehicle->owner_name ?? ''}}" placeholder="" readonly="">
            </div>
            <div class="col-md-2 col-sm-2 ">
                <label for="validationCustom01">{{ trans('common.district')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{ $transfer->AppForm->vehicle->district->name ?? ''}}" placeholder="" readonly="">
            </div>
            <div class="col-md-2 col-sm-2 ">
                <label for="validationCustom01">{{ trans('module4.vehicle_type')}}:</label>
                <select name="vehicle_type_id" class="form-control js-example-basic-single" disabled="disabled">
                    <option value="" selected disabled>Select Vehicle Type </option>
                    @foreach($data['types'] as $type)
                    <option value="{{$type->id}}" @if($transfer->AppForm == null) @else {{$type->id == $transfer->AppForm->vehicle->vehicle_type_id ?'selected':''}} @endif>{{ $type->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 col-sm-2 ">
                <label for="validationCustom01">{{ trans('module4.remark')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{$transfer->remark}}" placeholder="" name="remark" readonly="">
            </div>
            <div class="col-md-2 col-sm-2 ">
                <label for="validationCustom01">{{ trans('module4.old_vehicle')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{ $transfer->old_vehicle_number}}" placeholder="" name="old_vehicle_number" readonly="">
            </div>
            <div class="col-md-2 col-sm-2 ">
                <label for="validationCustom01">{{ trans('module4.transfer_dept_no')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{ $transfer->transfer_dep_no ?? ''}}" placeholder="" name="transfer_dep_no" readonly>
            </div>
            <div class="col-md-2 col-sm-2 ">
                <label for="validationCustom01">{{ trans('module4.tel_no')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{ $transfer->transfer_tel_no ?? ''}}" placeholder="" name="transfer_tel_no" readonly="test" required="">
            </div>
            <div class="col-md-2 col-sm-2 ">
                <label for="validationCustom01">{{ trans('module4.village_name')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{ $transfer->AppForm->vehicle->village_name  ?? ''}}" placeholder="" name="" readonly="test" required="">
            </div>
        </div>
        @endif
        <h5>{{ trans('module4.vehicle_transfer_detail') }}</h5>
        <div class="form-row mb-1">
            <table class="table table-bordered" id="app-document">
                <thead>
                    <tr>
                        <th>{{ trans('module4.no') }}</th>
                        <th>{{ trans('module4.document_type') }}</th>
                        <th>{{ trans('module4.unit') }}</th>
                        <th>{{ trans('module4.note') }}</th>
                    </tr>
                </thead>
                <tbody id="next-row">
                    @foreach($transfer_detail as $index => $item)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $item->doc_name }}</td>
                        <td>{{ $item->unit }}</td>
                        <td>{{ $item->note }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="form-row pt-3">
            <div class="col-md-8 col-sm-8">
                <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.back')}}</button>

                @if($action == "transit")
                <a class="col-md-2  btn  btn-primary btn-sm btn-print-transfer">Print Transfer</a>

                @endif
            </div>
            <div class="col-md-4 col-sm-4 text-right">
                @if($action == "approve")
                <button class="btn btn-success btn-sm text-white transfer-approve" type="submit">{{ trans('button.approve')}}</button>
                @endif

                @if($action == "transit")
                <button class="btn btn-success btn-sm text-white transfer-approve" type="submit">{{ trans('button.save')}}</button>
                @endif
            </div>
        </div>
    </form>
</div>
</div>

<div id="printTransfer">
    @include('Module4.registration.print.print-transfer', ['data' => $app_form])
</div>