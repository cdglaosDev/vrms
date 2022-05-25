@php
$vehicle =\App\Model\VehicleType::get();
$user =\App\User::get();
@endphp

<!-- Add Modal -->
<div class="modal fade" id="addModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-center">{{trans('transfer_vehicle.create_vehicle_inspection')}}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="\technical-inspect" method="POST">
                @method('post')
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <div class="form-group">
                                <label for="validationCustom01">{{trans('transfer_vehicle.request_number')}}:</label>
                                <input type="text" name="app_request_no" class="form-control" value="" required="" placeholder="Enter Application Request Number">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <div class="form-group">
                                <label class="validationCustom01">{{ trans('transfer_vehicle.inspect_number') }}:</label>
                                <input type="hidden" name="inspect_number" value="" class="form-control" readonly req>
                                <input type="text" name="inspect_number" class="form-control" value="" required="" placeholder="Inspect Number Auto Fill" readonly="" readonly="">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <div class="form-group">
                                <label for="validationCustom01">{{ trans('transfer_vehicle.date') }}:</label>
                                <input type="date" class="date form-control" id="validationCustom01" value="" placeholder="Enter Date" name="date" required="">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <div class="form-group">
                                <label for="validationCustom01">{{trans('transfer_vehicle.inspect_type')}}:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="{{trans('Enter Type')}}" name="type" required="">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <div class="form-group">
                                <label for="validationCustom01">{{trans('transfer_vehicle.log_activity')}}:</label>
                                <input type="text" name="log_activity" class="form-control" value="" required="" placeholder="Enter Technical Inspect Log Activity">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <div class="form-group">
                                <label class="validationCustom01">{{ trans('transfer_vehicle.license_plate_no') }}:</label>
                                <input type="text" name="license_plate_no" class="form-control" value="" required="" placeholder="Enter License Plate Number">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="validationCustom02">{{trans('transfer_vehicle.vehicle_name') }}:</label>
                            <div class="form-group">
                                <select class="form-control js-example-basic-single" style="width: 100%;" name="vehicle_id" required>
                                    <option value="" selected disabled hidden>--{{ trans('vehicle.vehicle_type')}}--</option>
                                    @foreach($vehicle as $type)
                                    <option value="{{$type->id}}">{{ $type->name }}({{$type->name_en}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <div class="form-group">
                                <label for="status">{{ trans('transfer_vehicle.status') }}:</label>
                                <select name="status" id="status" class="form-control" required="">
                                    <option value="">{{trans('transfer_vehicle.select_status')}}</option>
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-1">
                            <div class="form-group">
                                <label for="validationCustom01">{{trans('transfer_vehicle.result')}}:</label>
                                <textarea name="result" id="validationCustom01" cols="10" rows="3" class="form-control" value="" placeholder="Enter Result" required=""></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-1">
                            <div class="form-group">
                                <label for="validationCustom01">{{trans('transfer_vehicle.comment')}}:</label>
                                <textarea name="comment" id="validationCustom01" cols="10" rows="3" class="form-control" value="" placeholder="Enter Comment" required=""></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
                    <button type="submit" class="btn btn-success btn-sm">{{trans('button.save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-11 text-center">
                    <h3 class="text-center">{{trans('transfer_vehicle.update_technical_inspection')}}</h3>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="editform" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <div class="form-group">
                                <label for="validationCustom01">{{trans('transfer_vehicle.request_number')}}:</label>
                                <input type="text" name="app_request_no" class="form-control" value="" required="" placeholder="Enter Application Request Nunber">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <div class="form-group">
                                <label class="validationCustom01">{{ trans('transfer_vehicle.inspect_number') }}:</label>
                                <input type="text" name="inspect_number" class="form-control" value="" required="" placeholder="Enter Inspect Number" readonly="">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <div class="form-group">
                                <label for="validationCustom01">{{ trans('transfer_vehicle.date') }}:</label>
                                <input type="date" name="date" class="date form-control" id="validationCustom01" value="" placeholder="Enter Date" required="">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <div class="form-group">
                                <label for="validationCustom01">{{trans('transfer_vehicle.inspect_type')}}:</label>
                                <input type="text" name="type" class="form-control" id="validationCustom01" value="" placeholder="{{trans('Enter Type')}}" required="">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <div class="form-group">
                                <label for="validationCustom01">{{trans('transfer_vehicle.log_activity')}}:</label>

                                <input type="text" name="log_activity" class="form-control" value="" required="" placeholder="Enter Technical Inspect Log Activity">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <div class="form-group">
                                <label class="validationCustom01">{{ trans('transfer_vehicle.license_plate_no') }}:</label>
                                <input type="text" name="license_plate_no" class="form-control" value="" required="" placeholder="Enter License Plate Number">
                            </div>
                        </div>

                        <div class="col-md-6 mb-1">
                            <label for="validationCustom02">{{trans('transfer_vehicle.vehicle_name') }}:</label>
                            <div class="form-group">
                                <select name="vehicle_type_id" class="form-control js-example-basic-single" style="width: 100%;" required>
                                    <option value="" selected disabled hidden>--{{ trans('vehicle.vehicle_type')}}--</option>
                                @foreach($vehicle as $type)
                                <option value="{{$type->id}}" class="style1">{{ $type->name }}({{$type->name_en}})</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <div class="form-group">
                                <label for="status">{{ trans('transfer_vehicle.status') }}:</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-1">
                            <div class="form-group">
                                <label for="validationCustom01">{{trans('transfer_vehicle.result')}}:</label>
                                <textarea name="result" id="validationCustom01" cols="10" rows="3" class="form-control" value="" placeholder="Enter Result"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-1">
                            <div class="form-group">
                                <label for="validationCustom01">{{trans('transfer_vehicle.comment')}}:</label>
                                <textarea name="comment" id="validationCustom01" cols="10" rows="3" class="form-control" value="" placeholder="Enter Comment"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
                    <button type="submit" class="btn btn-success btn-sm">{{trans('button.update')}}</button>
                </div>

            </form>
        </div>
    </div>
</div>