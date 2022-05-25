
<div class="modal-header">
<h3 class="text-center">{{trans('module4.edit_alphabet_control')}}</h3>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
</div>
<div class="modal-body">
    <form action="{{ route('alphabet-control.update', $alphabet_control->id)}}" id="editform" name="editform"  method="POST">
        @method('PATCH')
        @csrf
            <input type="hidden" id = "alphabet_control_id" value="{{ $alphabet_control->id }}">
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label for="validationCustom01"> {{trans('common.province')}} :</label>
                    <select name="province_code" id="" class="js-example-basic-single form-control province" style="width: 100%" required>
                    <option value="" selected disabled>Select Province</option>
                    @foreach($provinces as $province)
                    <option value="{{ $province->province_code }}" {{ $province->province_code == $alphabet_control->province_code?'selected':''}}>{{ $province->name }}({{ $province->name_en }})</option>
                    @endforeach
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="validationCustom01"> {{trans('module4.vehicle_kind')}}:</label>
                    <select name="vehicle_kind_code" id="" class="form-control vehicle_kind" required>
                    <option value="" selected disabled>Select Vehicle Kind</option>
                    @foreach($veh_kinds as $kind)
                    <option value="{{ $kind->vehicle_kind_code }}" {{ $kind->vehicle_kind_code == $alphabet_control->vehicle_kind_code?'selected':''}}>{{ $kind->name }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="validationCustom01">{{ trans('module4.vehicle_type_group') }}:</label>
                    <select name="vehicle_type_group_id"  class="form-control vtype" required>
                    <option value="" selected disabled>Select Type group</option>
                    @foreach($type_groups as $type)
                    <option value="{{ $type->id }}" {{ $type->id == $alphabet_control->vehicle_type_group_id?'selected':''}}>{{ $type->name }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <a class="btn btn-primary check-alphabet">Check</a>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="validationCustom01">{{trans('module4.alphabet')}}:</label>
                    <select name="license_alphabet_id" id="" class="js-example-basic-single form-control lic-alphabet" style="width: 100%" required>
                    <option value="" selected disabled>Select Alphabet</option>
                        @foreach($alphabet as $key=>$value)
                            <option value="{{$key}}" {{ $alphabet_control->license_alphabet_id == $key?'selected':''}}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="validationCustom01">{{trans('common.status')}}:</label>
                    <select name="license_alphabet_control_status_id"  class="form-control status" required>
                    <option value="" selected disabled>Select Status</option>
                    @foreach($alphabet_controls_status as $control)
                    <option value="{{ $control->id }}" {{ $control->id == $alphabet_control->license_alphabet_control_status_id ?'selected':''}}>{{ $control->name }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <a class="btn btn-primary check-alphabet-next">Check Alphabet Next</a>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="validationCustom01">{{ trans('module4.alphabet_next') }}:</label>
                    <select name="license_alphabet_next_id"  class="js-example-basic-single form-control alphabet_next" style="width: 100%" required>
                    <option value="" selected disabled>Select Alphabet Next</option>
                         @foreach($alphabet_next as $key=>$value)
                            <option value="{{$key}}" {{ $alphabet_control->license_alphabet_next_id == $key?'selected':''}}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
            <button type="submit" class="btn btn-success btn-sm btn-save" id="update-form">{{trans('button.save')}}</button>
        </div>
    </form>
</div>

<script type="text/javascript">
   $('#update-form').click(function(e) {
      e.preventDefault();
      var alphabetControlId = $('#editModel #alphabet_control_id').val();
      var licAlphabet = $('#editModel .lic-alphabet');
      var province = $("#editModel .province");
      var vehicleKind = $("#editModel .vehicle_kind");
      var vtype = $("#editModel .vtype");
      var alphabetNext = $("#editModel .alphabet_next");
      var status = $("#editModel .status");
      var form = $("#editform");
      checkLicenseAlphabet(alphabetControlId, licAlphabet, province, vehicleKind, vtype, alphabetNext, status, form);
   });
</script>







