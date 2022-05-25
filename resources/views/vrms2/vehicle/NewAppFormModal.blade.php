@php
$app_purposes = \App\Model\AppPurpose::whereStatus(1)->where('id', '!=' , 1)->get();
@endphp
<form method="POST" name="paper">
    @method('POST')
    @csrf
    <input type="hidden" id="vehicle_id" name="vehicle_id" value="{{$app_form->vehicle_id?? ''}}">
    <div class="form-row">
        <div class="col-md-12 mb-3">
            @foreach($app_purposes as $app_purpose)
            <div class="form-check form-check-primary col-sm-6 col-md-6 pull-left">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" value="{{ $app_purpose->id }}" name="app_purpose_id[]" {{$app_purpose->id ==1?'checked':''}}>
                    {{ $app_purpose->name_en }}
                    <i class="input-helper"></i></label>
            </div>
            @endforeach
        </div>
        <div class="col-md-12 mb-3">
            <label for="validationCustom01">Remark:</label>
            <textarea name="remark" id="" cols="4" rows="5" class="form-control"></textarea>
            <input type="hidden" name="type" value="newform">
            <input type="hidden" name="new_form" value="{{ $app_form == null?1:0}}">
        </div>
    </div>
    <div class="row p-1">
        <div class="col-md-4 ">
            <button type="button" data-dismiss="modal" class="btn btn-light btn-sm">Back</button>
        </div>
        <div class="col-md-8 text-right">
            <button type="button" id="btnNewApp" name="newform" class="btn btn-success btn-sm newForm">{{trans('button.save')}}</button>
        </div>
    </div>
</form>