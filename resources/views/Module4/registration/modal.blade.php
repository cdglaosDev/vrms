<style>
    .chk {
        margin-top: 0px;
    }

    .nav-pills .nav-link, .nav-pills>li>a{
        border: 1px solid !important;
        padding: 10px !important;
    }
    @media screen {
        #printPaper2, #printcontent, #certificate, #book { display: none; }
        }
</style>
@php
$appNo = new \App\Helpers\AppNo;
$app_purposes = \App\Model\AppPurpose::whereStatus(1)->get();
$veh_data = \App\Helpers\getData::vehInfo();
@endphp
<div class="modal fade" id="addModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document" style="position: fixed;top: -28px;display: block;left: 5%;">
        <div class="modal-content">
            <div class="modal-header">
                <h3 style="padding: 0px;">{{ trans('module4.app_form')}}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -6px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('applications.store')}}" method="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 col-sm-8">
                            <div class="form-row">
                                <div class="col-md-3 col-sm-3 mb-1">
                                    <label for="validationCustom01">{{ trans('module4.app_no')}}:</label>
                                    <input type="text" class="form-control" id="validationCustom01" value="{{ $appNo->getAppNo() }}" placeholder="" name="app_no" readonly>
                                </div>
                                <div class="col-md-3 col-sm-3 mb-1">
                                    <label for="validationCustom01">{{ trans('module4.date_req')}}:</label>
                                    <input type="text" class="form-control" id="date" value="" placeholder="Choose date" name="date_request" required="">
                                </div>
                                <div class="col-md-3 col-sm-3 mb-1">
                                    <label for="validationCustom01">{{ trans('module4.customer_name')}}:</label>
                                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Customer" name="customer_name" required="">
                                </div>
                                <div class="col-md-3 col-sm-3 mb-1">
                                    <label for="validationCustom01">{{ trans('module4.app_form_status')}}:</label>
                                    <select name="app_form_status_id" class="form-control" required>
                                        <option value="" selected disabled>Select App Form status</option>
                                        @foreach($veh_data['app_form_status'] as $status)
                                        <option value="{{$status->id}}">{{ $status->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3 col-sm-3 mb-1">
                                    <label for="validationCustom01">{{ trans('module4.vehicle_lic') }}:</label>
                                    <input type="text" class="form-control" id="validationCustom01" required value="" placeholder="Enter Licence No" name="licence_no">
                                </div>
                                <div class="col-md-3 col-sm-3 mb-1">
                                    <label for="validationCustom01">{{ trans('module4.division_number') }}:</label>

                                    <input type="text" class="form-control" id="validationCustom01" name="division_no" required value="" placeholder="Enter Division Number">
                                </div>
                                <div class="col-md-3 col-sm-3 mb-1">
                                    <label for="validationCustom01">{{ trans('module4.province_number') }}:</label>
                                    <input type="text" class="form-control" id="validationCustom01" required value="" placeholder="Enter Province Number" name="province_no">
                                </div>

                                <div class="col-md-3 col-sm-3 mb-1">
                                    <label for="validationCustom01">Category Name:</label>
                                    <select name="vehicle_kind_id" class="form-control" required>
                                        <option value="" selected disabled>Select Category Name</option>
                                        @foreach($veh_data['kinds'] as $veh_kind)
                                        <option value="{{$veh_kind->id}}">{{ $veh_kind->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-6 mb-1">
                                    <label for="validationCustom01">{{ trans('module4.engine_no') }}:</label>
                                    <input type="text" class="form-control" id="validationCustom01" style="font-family:Saysettha OT !important;" value="" name="engine_no" placeholder="Enter Engine Number" required="required">
                                </div>
                                <div class="col-md-6 col-sm-6 mb-1">
                                    <label for="validationCustom01">{{ trans('module4.chassis_no') }}:</label>
                                    <input type="text" class="form-control" id="validationCustom01" style="font-family:Saysettha OT !important;" value="" placeholder="Enter Chaasis no" name="chassis_no" required>
                                </div>
                                <div class="col-md-3 col-sm-3 mb-1">
                                    <label for="validationCustom01">{{ trans('module4.brand') }}:</label>
                                    <div class="form-group">
                                        <select name="brand_id" class="form-control js-example-basic-single" id="vbrand" required>
                                            <option value="" selected disabled>-- Select Brand --</option>
                                            @foreach($veh_data['brands'] as $brand)
                                            <option value="{{$brand->id}}">{{ $brand->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 mb-1">
                                    <label for="validationCustom01">{{ trans('module4.model') }}:</label>
                                    <div class="form-group">
                                        <select name="model_id" id="vmodel" class="form-control js-example-basic-single" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 mb-1">
                                    <label for="validationCustom01">{{ trans('module4.vehicle_type') }}:</label>
                                    <div class="form-group">
                                        <select name="vehicle_type_id" class="form-control js-example-basic-single" style="width: 100%;" required>
                                            <option value="" selected disabled>-- Select Vehicle Type --</option>
                                            @foreach($veh_data['types'] as $type)
                                            <option value="{{$type->id}}">{{ $type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 mb-1">
                                    <label for="validationCustom01">{{ trans('module4.staff_name') }}:</label>
                                    <input type="text" class="form-control" id="validationCustom01" value="{{auth()->user()->name}}" name="" readonly>
                                    <input type="hidden" class="form-control" id="validationCustom01" value="{{auth()->id()}}" name="staff_id" readonly>
                                </div>
                                <div class="col-md-3 col-sm-3 mb-1">
                                    <label for="validationCustom01">{{ trans('common.province') }}:</label>
                                    <div class="form-group">
                                        <select name="province_code" class="form-control js-example-basic-single" id="province" required>
                                            <option value="" selected disabled>-- Select Province --</option>
                                            @foreach($veh_data['provinces'] as $pro)
                                            <option value="{{$pro->province_code}}">{{ $pro->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 mb-1">
                                    <label for="validationCustom01">{{ trans('common.district') }}:</label>
                                    <div class="form-group">
                                        <select name="district_code" id="district" class="form-control js-example-basic-single" required>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 mb-1">
                                    <label for="validationCustom01">{{ trans('module4.village_name') }}:</label>
                                    <input type="text" class="form-control" id="validationCustom01" value="" name="village_name" placeholder="Enter village name" required>
                                </div>

                                <div class="col-md-3 col-sm-3 mb-1">
                                    <label for="validationCustom01"> {{ trans('module4.note') }}:</label>
                                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Note" name="note">
                                </div>
                                <div class="col-md-12 col-sm-12 mb-1">
                                    <label for="validationCustom01"> {{ trans('module4.comment') }}:</label>
                                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Comment" name="comment">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <label for="">{{ trans('module4.app_purpose') }}:</label>
                            @foreach($app_purposes as $app_purpose)
                            <div class="form-check form-check-primary" style="margin-bottom: 5px;">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input app-purpose chk" value="{{ $app_purpose->id }}" name="app_purpose_id[]">
                                    @if(session()->get("locale") == "en")
                                    {{ $app_purpose->name_en }}
                                    @else
                                    {{ $app_purpose->name }}
                                    @endif
                                    <i class="input-helper"></i>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="modal-footer" style="justify-content: space-between;">
                    <div style="margin-left: 15px;">
                        <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.back')}}</button>
                    </div>
                    <div style="margin-right: 15px;">
                        <button type="submit" class="btn btn-success btn-sm storeApp">{{trans('button.save')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('page_scripts')
<script type="text/javascript">
    var dist_url = "{{url('/getdistrict/')}}";
    var get_vmodal = "{{url('/getVmodel/')}}";
    $(".storeApp").click(function() {
        if (($("input[name*='app_purpose_id']:checked").length) == 0) {
            alert("You must check at least 1 app purpose");
            return false;
        }
    });
</script>

<script type="text/javascript" src="{{asset('js/dropdownlist.js')}}"></script>
@endpush