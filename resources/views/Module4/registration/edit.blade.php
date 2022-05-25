<style>
  

    @media screen {

        #printPaper2,
        #printPaper,
        #certificate,
        #book {
            display: none;
        }
    }
    .chk{
        margin-top: 0px;
    }

    @media print{
        .printPink1 .print_eng_cha_no{
      font-family:Saysettha OT !important;
   }
    }
</style>
@php
$purposeIds = \App\Model\AppFormPurpose::whereAppFormId( $app_form->id )->pluck('app_purpose_id')->toArray();
@endphp
<div class="modal-header">
    <h3 style="padding: 0px;">{{ trans('module4.app_form')}}</h3>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -6px;">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<form action="{{route('applications.update',['id' => $app_form->id])}}" method="POST" id="appForm" enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <div class="form-row">
                    <div class="col-md-3 col-sm-3 mb-0">
                        <label for="validationCustom01">{{ trans('module4.app_no')}}:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="{{ $app_form->app_no }}" placeholder="" name="app_no" readonly>
                    </div>
                    <div class="col-md-3 col-sm-3 mb-0">
                        <label for="validationCustom01">{{ trans('module4.date_req')}}:</label>
                        <input type="text" class="date form-control" id="validationCustom01" value="{{ $app_form->date_request ?? '' }}" placeholder="" name="date_request" required="">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-0">
                        <label for="validationCustom01">{{ trans('module4.customer_name')}}:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="{{ $app_form->customer_name }}" placeholder="Enter Customer" name="customer_name" required="">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-0">
                        <label for="validationCustom01">{{ trans('module4.app_form_status')}}:</label>
                        <select name="app_form_status_id" class="form-control" required>
                            <option value="" disabled>Select App Form status</option>
                            @foreach($veh_info['app_form_status'] as $status)
                            <option value="{{$status->id}}" {{ $status->id == $app_form->app_form_status_id? 'selected':''}}>{{ $status->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 col-sm-3 mb-0">
                        <label for="validationCustom01">{{ trans('module4.vehicle_lic')}}:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="{{$app_form->vehicle->licence_no??''}}" placeholder="Enter Licence No" name="licence_no">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-0">
                        <label for="validationCustom01">{{ trans('module4.division_number')}}:</label>

                        <input type="text" class="form-control" id="validationCustom01" name="division_no" value="{{$app_form->vehicle->division_no??''}}" placeholder="Enter Division Number">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-0">
                        <label for="validationCustom01">{{ trans('module4.province_number')}}:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="{{$app_form->vehicle->province_no??''}}" placeholder="Enter Province Number" name="province_no">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-0">
                        <label for="validationCustom01">{{ trans('module4.category_name')}}:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="{{ $app_form->vehicle->vehicle_kind->name ?? '' }}" placeholder="enter vehicle category" readonly>
                    </div>

                    <div class="col-md-6 col-sm-6 mb-0">
                        <label for="validationCustom01">{{ trans('module4.engine_no')}}:</label>
                        <input type="text" class="form-control" id="validationCustom01" style="font-family:Saysettha OT !important;" value="{{ $app_form->vehicle->engine_no ?? ''}}" placeholder="Enter Engine Number" readonly>
                    </div>
                    <div class="col-md-6 col-sm-6 mb-0">
                        <label for="validationCustom01">{{ trans('module4.chassis_no')}}:</label>
                        <input type="text" class="form-control" id="validationCustom01" style="font-family:Saysettha OT !important;" value="{{$app_form->vehicle->chassis_no ??''}}" placeholder="Enter Chaasis no" name="chassis_no" readonly>
                    </div>
                    <div class="col-md-3 col-sm-3 mb-0">
                        <label for="validationCustom01">{{ trans('module4.brand')}}:</label>
                        <div class="form-group">
                            <select name="brand_id" class="form-control" disabled="disabled">
                                <option value="" selected disabled>Select Brand</option>
                                @foreach($veh_info['brands'] as $brand)
                                <option value="{{$brand->id}}" {{$brand->id ==$app_form->vehicle->brand_id?'selected':'' }}>{{ $brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 mb-0">
                        <label for="validationCustom01">{{ trans('module4.model')}}:</label>
                        <div class="form-group">
                            <select name="model_id" class="form-control" disabled="disabled">
                                <option value="" selected disabled>Select Model</option>
                                @foreach($veh_info['models'] as $mod)
                                <option value="{{$mod->id}}" {{$mod->id ==$app_form->vehicle->model_id?'selected':'' }}>{{ $mod->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 mb-0">
                        <label for="validationCustom01">{{ trans('module4.v_type')}}:</label>
                        <div class="form-group">
                            <select name="vehicle_type_id" class="form-control js-example-basic-single" style="width: 100%;" disabled="disabled">
                                <option value="" selected disabled>Select Vehicle Type</option>
                                @foreach($veh_info['types'] as $type)
                                <option value="{{$type->id}}" {{$type->id == $app_form->vehicle->vehicle_type_id?'selected':''}}>{{ $type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 mb-0">
                        <label for="validationCustom01">{{ trans('module4.staff_name')}}:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="{{$app_form->staff->name ?? ''}}" name="" readonly>
                        <input type="hidden" class="form-control" id="validationCustom01" value="{{$app_form->staff_id ??''}}" name="staff_id" readonly>
                    </div>
                    <div class="col-md-3 col-sm-3 mb-0">
                        <label for="validationCustom01">{{ trans('module4.province_name')}}:</label>
                        <div class="form-group">
                            <select name="province_code" class="form-control" disabled="disabled">
                                <option value="" selected disabled>Select Province</option>
                                @foreach($veh_info['provinces'] as $pro)
                                <option value="{{$pro->province_code}}" {{$pro->province_code == $app_form->vehicle->province_code?'selected':''}}>{{ $pro->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="col-md-3 col-sm-3 mb-0">
                        <label for="validationCustom01">{{ trans('module4.district_name')}}:</label>
                        <div class="form-group">
                            <select name="district_code" class="form-control" disabled="disabled">
                                <option value="" selected disabled>Select District</option>
                                @foreach($veh_info['districts'] as $dist)
                                <option value="{{$dist->id}}" {{$dist->district_code ==$app_form->vehicle->district_code?'selected':'' }}>{{ $dist->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 mb-0">
                        <label for="validationCustom01">{{ trans('module4.village_name')}}:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="{{ $app_form->vehicle->village_name ?? ''}}" name="village_name" placeholder="Enter village name" readonly="">
                    </div>

                    <div class="col-md-3 col-sm-3 mb-0">
                        <label for="validationCustom01"> {{ trans('module4.note')}}:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="{{ $app_form->note }}" placeholder="Enter Note" name="note">
                    </div>
                    <div class="col-md-13 col-sm-12 mb-0">
                        <label for="validationCustom01"> {{ trans('module4.comment')}}:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="{{$app_form->comment}}" placeholder="Enter Comment" name="comment">
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <label for="">{{ trans('module4.app_purpose') }}:</label>
                @foreach($app_purposes as $app_purpose)
                <div class="form-check form-check-primary" style="margin-bottom: 5px;">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input chk" value="{{ $app_purpose->id }}" name="app_purpose_id[]" {{ in_array($app_purpose->id, $purposeIds) ?'checked':''}}>
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
            @can('App-Form-Entry-Print')
            <a class="btn  btn-secondary btn-sm print-link no-print" id="paper2">{{ trans('button.pink_paper2')}}</a>
            <a class="btn  btn-secondary btn-sm print-link no-print" id="print_app_form">{{ trans('button.print_app_form')}}</a>
            @endcan
            <button type="submit" class="btn btn-success btn-sm storeApp">{{trans('button.save')}}</button>
        </div>
    </div>
</form>


@if($data != null)
<!-- start print area for app form that is the same as module5 print -->
<div id="printPaper">

    @include('Module5.importvehicle.print',['data' => $data, 'app_number'=> $app_form->app_no])
</div>
<!-- end print area -->
<!-- start print area for print paper2 in module4 -->
<div id="printPaper2">
    @include('Module4.registration.print.printPaper', ['veh_data' => $data])
</div>
<!-- end print area -->

@endif

@component('component.module4.vehicleDoc',['vehicle_id'=>$app_form->vehicle_id])
@endcomponent

@include('delete')


<script src="{{ asset('vrms2/js/jquery_print.js')}}"></script>
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript">
    var edit_doc = "{{url('/vehDocument')}}";
    $(".storeApp").click(function() {
        if (($("input[name*='app_purpose_id']:checked").length) == 0) {
            alert("You must check at least 1 app purpose");
            return false;
        }
    });
    //for issue date and expire date
    $("#issu_date").datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect: function(dateStr) {
            var d = $.datepicker.parseDate('yy-mm-dd', dateStr);
            d.setFullYear(d.getFullYear() + 5);

            $('#exp_date').datepicker('setDate', d);

        }
    });
    $("#exp_date").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    // add transfer document 
    $("#add").click(function() {

        var doc_type = '<div class="form-group">' + $('.doc_type').html() + '</div>';

        var filename = '<div class="form-group ">' + $('.filename').html() + '</div>';
        var status = '<div class="form-group ">' + $('.status').html() + '</div>';
        var note = '<div class="form-group ">' + $('.tran_note').html() + '</div>';
        var staff = '<div class="form-group ">' + $('.staff').html() + '</div>';

        $("#next-row").append(
            '<tr>' +
            '<td>' + doc_type + '</td>' +
            '<td>' + filename + '</td>' +
            '<td>' + status + '</td>' +
            '<td>' + note + '</td>' +
            '<td>' + staff + '</td>' +
            '<td><button type="button" id="remove" class="btn btn-danger remove-tr"><i class="fas fa-minus"></i></button></td>' +
            '</tr>'
        );

    });

    $(document).on('click', '.remove-tr', function() {
        $(this).parents('tr').remove();
    });


    $(document).on("click", '.editDocument', function(e) {

        $('[name="doc_type_id"]').val($(this).data('doc_type_id'));
        $('[name="vehicle_id"]').val($(this).data('vehicle_id'));
        $('#filearea').html($(this).data('filename'));
        document.getElementById("EditDoc").action = edit_doc;
    });
</script>

<!-- <script src="{{ asset('js/numvalidate.js') }}"></script>
<script type="text/javascript" src="{{asset('js/dropdownlist.js')}}"></script>
<script src="{{ asset('js/filevalidate.js') }}"></script> -->
