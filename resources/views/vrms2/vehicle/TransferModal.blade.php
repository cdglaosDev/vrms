@php
$kinds = \App\Model\VehicleKind::whereStatus(1)->get();
$brands = \App\Model\VehicleBrand::whereStatus(1)->get();
$types = \App\Model\VehicleType::whereStatus(1)->get();
$models= \App\Model\VehicleModel::whereStatus(1)->get();
$provinces= \App\Model\Province::whereStatus(1)->get();
$moter_brand = \App\Model\EngineBrand::whereStatus(1)->get();
$doc_type =\App\Model\ApplicationDocType::get();

@endphp
<!--start transfer modal box -->
<form id="transfer-data" method="POST">
    @method('post')
    @csrf

    <input type="hidden" name="transfer_to_title" title="{{ trans('title.choose_transfer_to') }}">
    <div class="form-row mb-4">
        <div class="col-md-1 col-sm-1">
            <label for="validationCustom01">{{ trans('module4.transfer_no_with_dot')}}:</label>
            <input type="text" class="form-control" value="{{\App\Helpers\getData::tran_no() ?? ''}}" placeholder="" name="transfer_no" readonly="">
        </div>
        <div class="col-md-1 col-sm-1 ">
            <label for="validationCustom01">{{ trans('module4.app_no')}}:</label>
            <input type="text" name="app_request_no" class="form-control" value="{{\App\Helpers\getData::getAppNumber() ?? ''}}" readonly required="">
            <input type="hidden" name="app_id" value="">
        </div>
        <div class="col-md-2 col-sm-2 ">
            <label for="validationCustom01">{{ trans('module4.license_no')}}:</label>
            <input type="text" class="form-control" value="{{$vehicle->licence_no}}" placeholder="" name="licence_no" readonly="">
        </div>
        <div class="col-md-2 col-sm-2 ">
            <label for="validationCustom01">{{ trans('common.date')}}:</label>
            <input type="text" class="form-control" id="transfer_issue_date" value="{{ date('Y-m-d') }}" placeholder="" name="transfer_date" required="">
        </div>

        <div class="col-md-2 col-sm-2 ">
            <label for="validationCustom01">{{ trans('module4.customer_name')}}:</label>
            <input type="text" class="form-control" value="{{ $vehicle->owner_name}}" placeholder="" name="customer_name">
            <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
        </div>
        <div class="col-md-2 col-sm-2 ">
            <label for="validationCustom01">{{ trans('common.status')}}:</label>
            <select name="status" class="form-control" disabled>
                <option value="inprogress">Inprogress</option>
                {{-- <option value="" selected disabled>Select Status</option>
                            @foreach(\App\Model\TransferVehicle::getEnumList("status") as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                @endforeach --}}
            </select>
        </div>
        <div class="col-md-2 col-sm-2 ">
            <label for="validationCustom01">{{ trans('common.province')}}:</label>
            <input type="text" class="form-control" value="{{$vehicle->province->name ?? ''}}" readonly>

        </div>
        <div class="col-md-2 col-sm-2 ">
            <label for="validationCustom01">{{ trans('module4.motor_brand')}}:</label>
            <input type="text" class="form-control" value="{{$vehicle->vbrand->name ?? ''}}" readonly>

        </div>
        <div class="col-md-2 col-sm-2 ">
            <label for="validationCustom01">{{ trans('module4.vehicle_kind')}}:</label>
            <input type="text" class="form-control" value="{{$vehicle->vehicle_kind->name ?? ''}}" readonly>
        </div>
        <div class="col-md-2 col-sm-2 ">
            <label for="validationCustom01">{{ trans('module4.transfer_from')}}:</label>
            <input type="hidden" name="transfer_from" class="form-control" value="{{$vehicle->province_code}}">
            <select class="form-control" disabled>
                <option value="" disabled>Select transfer From</option>
                @foreach($provinces as $data)
                <option value="{{$data->province_code}}" {{$vehicle->province_code == $data->province_code ? 'selected' : '' }}>{{ $data->name }}({{$data->name_en}})</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2 col-sm-2 ">
            <label for="validationCustom01">{{ trans('module4.transfer_to')}}:</label>
            <select name="transfer_to" id="transfer_to" class="form-control" required>
                <option value="" selected disabled>Select transfer To</option>
                @foreach($provinces as $data)
                <option value="{{$data->province_code}}" @if($app_form !=null) @if($app_form->TransferVehicle != null) {{$app_form->TransferVehicle->transfer_to == $data->province_code?'selected':''}} @endif @endif>{{ $data->name }}({{$data->name_en}})</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 col-sm-2 ">
            <label for="validationCustom01">{{ trans('module4.owner_name')}}:</label>
            <input type="text" class="form-control" name="owner_name" value="{{ $vehicle->owner_name}}" placeholder="" readonly="">
        </div>
        <div class="col-md-2 col-sm-2 ">
            <label for="validationCustom01">{{ trans('common.district')}}:</label>
            <input type="text" class="form-control" value="{{$vehicle->district->name ?? ''}}" placeholder="" readonly="">
        </div>
        <div class="col-md-2 col-sm-2 ">
            <label for="validationCustom01">{{ trans('module4.vehicle_type')}}:</label>
            <input type="text" class="form-control" value="{{$vehicle->vtype->name ?? ''}}" placeholder="" readonly="">

        </div>
        <div class="col-md-2 col-sm-2 ">
            <label for="validationCustom01">{{ trans('module4.remark')}}:</label>
            <input type="text" class="form-control" value="remark" placeholder="" name="remark" readonly required="">
        </div>
        <div class="col-md-2 col-sm-2 ">
            <label for="validationCustom01">{{ trans('module4.old_vehicle')}}:</label>
            <input type="text" class="form-control" value="{{ $vehicle->licence_no}}" placeholder="" name="old_vehicle_number" readonly="">
        </div>
        <div class="col-md-2 col-sm-2 ">
            <label for="validationCustom01">{{ trans('module4.transfer_dept_no')}}:</label>
            <input type="text" class="form-control" value="@if($app_form !=null)@if($app_form->TransferVehicle != null){{$app_form->TransferVehicle->transfer_dep_no ?? ''}}@endif @endif" placeholder="" name="transfer_dep_no">
        </div>
        <div class="col-md-2 col-sm-2 ">
            <label for="validationCustom01">{{ trans('module4.tel_no')}}:</label>
            <input type="text" class="form-control" value="@if($app_form !=null)@if($app_form->TransferVehicle != null){{$app_form->TransferVehicle->transfer_tel_no ?? ''}}@endif @endif" placeholder="" name="transfer_tel_no">
        </div>
        <div class="col-md-2 col-sm-2 ">
            <label for="validationCustom01">{{ trans('module4.village_name')}}:</label>
            <input type="text" class="form-control" value="{{$vehicle->village_name}}" placeholder="" name="village_name" readonly>
        </div>

    </div>
    <hr>
    <h5>{{ trans('module4.vehicle_transfer_detail') }}</h5>

    <div class="form-row mb-4">
        <table class="table table-bordered" id="app-document">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Document Type</th>
                    <th>Unit</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody id="next-row">
                <tr>
                    <td>1</td>
                    <td><input type="text" name="doc_name[]" class="border-0 w-100 w-100" value="ໃບທະບຽນຖາວອນ"></td>
                    <td width="230"><input type="number" class="form-control" value="@if($app_form != null){{$app_form->TransferVehicle != null?$app_form->TransferVehicle->transfer_detail[0]->unit:''}}@endif" placeholder="" name="unit[]" tabindex="1"></td>
                    <td width="230"><input type="text" class="form-control" value="@if($app_form != null){{$app_form->TransferVehicle != null?$app_form->TransferVehicle->transfer_detail[0]->note:''}}@endif" placeholder="" name="note[]" tabindex="2"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><input type="text" name="doc_name[]" class="border-0 w-100" value="ໃບທະບຽນຊົ່ວຄາວ"></td>
                    <td width="230"><input type="number" class="form-control" value="@if($app_form != null){{$app_form->TransferVehicle != null?$app_form->TransferVehicle->transfer_detail[1]->unit:''}}@endif" placeholder="" name="unit[]" tabindex="3"></td>
                    <td width="230"><input type="text" class="form-control" value="@if($app_form != null){{$app_form->TransferVehicle != null?$app_form->TransferVehicle->transfer_detail[1]->note:''}}@endif" placeholder="" name="note[]" tabindex="4"></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><input type="text" name="doc_name[]" class="border-0 w-100" value="ໃບຮັບປະກັນ"></td>
                    <td width="230"><input type="number" class="form-control" value="@if($app_form != null){{$app_form->TransferVehicle != null?$app_form->TransferVehicle->transfer_detail[2]->unit:''}}@endif" placeholder="" name="unit[]" tabindex="5"></td>
                    <td width="230"><input type="text" class="form-control" value="@if($app_form != null){{$app_form->TransferVehicle != null?$app_form->TransferVehicle->transfer_detail[2]->note:''}}@endif" placeholder="" name="note[]" tabindex="6"></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><input type="text" name="doc_name[]" class="border-0 w-100" value="ໃບຊື້ຂາຍ"></td>
                    <td width="230"><input type="number" class="form-control" value="@if($app_form != null){{$app_form->TransferVehicle != null?$app_form->TransferVehicle->transfer_detail[3]->unit:''}}@endif" placeholder="" name="unit[]" tabindex="7"></td>
                    <td width="230"><input type="text" class="form-control" value="@if($app_form != null){{$app_form->TransferVehicle != null?$app_form->TransferVehicle->transfer_detail[3]->note:''}}@endif" placeholder="" name="note[]" tabindex="8"></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td><input type="text" name="doc_name[]" class="border-0 w-100" value="ໃບຢັ້ງຢືນທີ່ຢູ່ຜູ້ຊື້"></td>
                    <td width="230"><input type="number" class="form-control" value="@if($app_form != null){{$app_form->TransferVehicle != null? $app_form->TransferVehicle->transfer_detail[4]->unit:''}}@endif" placeholder="" name="unit[]" tabindex="9"></td>
                    <td width="230"><input type="text" class="form-control" value="@if($app_form != null){{$app_form->TransferVehicle != null? $app_form->TransferVehicle->transfer_detail[4]->note:''}}@endif" placeholder="" name="note[]" tabindex="10"></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td><input type="text" name="doc_name[]" class="border-0 w-100" value="ໃບຢັ້ງຢືນທີ່ຢູ່ຜູ້ຂາຍ"></td>
                    <td width="230"><input type="number" class="form-control" value="@if($app_form != null){{$app_form->TransferVehicle != null ? $app_form->TransferVehicle->transfer_detail[5]->unit:''}}@endif" placeholder="" name="unit[]" tabindex="11"></td>
                    <td width="230"><input type="text" class="form-control" value="@if($app_form != null){{$app_form->TransferVehicle != null ? $app_form->TransferVehicle->transfer_detail[5]->note:''}}@endif" placeholder="" name="note[]" tabindex="12"></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td><input type="text" name="doc_name[]" class="border-0 w-100" value="ໃບມອບກໍາມະສິດ"></td>
                    <td width="230"><input type="number" class="form-control" value="@if($app_form != null){{$app_form->TransferVehicle != null?$app_form->TransferVehicle->transfer_detail[6]->unit:''}}@endif" placeholder="" name="unit[]" tabindex="13"></td>
                    <td width="230"><input type="text" class="form-control" value="@if($app_form != null){{$app_form->TransferVehicle != null?$app_form->TransferVehicle->transfer_detail[6]->note:''}}@endif" placeholder="" name="note[]" tabindex="14"></td>
                </tr>
            </tbody>

        </table>

    </div>
    <div class="form-row mt-3">
        <div class="col-md-8 col-sm-8">
            <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.back')}}</button>
            <a class="btn btn-secondary btn-sm btn-print-transfer @if($app_form != null){{$app_form->TransferVehicle == null?'disabled':''}} @else disabled @endif" data-id="{{$vehicle->id}}" onclick="printTransfer(this)">Print Transfer</a>
        </div>
        <div class="col-md-4 col-sm-4 text-right">
            <button type="button" id="btnTransfer" class="btn btn-success btn-sm">{{trans('button.save')}}</button>
            <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>

        </div>
    </div>
</form>


<!--End transfer modal box -->