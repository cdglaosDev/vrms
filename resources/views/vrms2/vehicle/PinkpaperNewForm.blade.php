@php
$app_purposes = \App\Model\AppPurpose::whereStatus(1)->where('id', '!=' , 1)->get();

$purposeIds = \App\Model\AppFormPurpose::whereAppFormId( $app_form->id )->pluck('app_purpose_id')->toArray();
@endphp

<form method="POST" name="paper">
    @csrf
    <div class="form-row">
        <input type="hidden" id="vehicle_id" name="vehicle_id" value="{{ $vehicle_id?? '' }}">
        <input type="hidden" id="owner_name" name="owner_name" value="{{ $owner_name?? '' }}">
        <input type="hidden" id="operation" name="operation" value="{{ $operation?? '' }}">
        
        <div class="col-md-12 mb-3">
            @foreach($app_purposes as $app_purpose)
            <div class="form-check form-check-primary col-sm-6 col-md-6 pull-left">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input app_purpose" style="margin-top: 0px;" value="{{ $app_purpose->id }}" name="app_purpose_id[]" 
                    @if($operation == "update") @if(isset($purposeIds)){{ in_array($app_purpose->id, $purposeIds) ?'checked':''}}@endif 
                    @endif>
                    @if(session()->get("locale") == "en")
                    {{ $app_purpose->name_en }}
                    @else
                    {{ $app_purpose->name }}
                    @endif
                    <i class="input-helper"></i></label>
            </div>
            @endforeach
        </div>
        <div class="col-md-12 mb-3">
            <label for="validationCustom01">{{ trans('module4.app_from_remark') }}:</label>
            <textarea name="remark" id="" cols="4" rows="5" class="form-control"></textarea>
            <input type="hidden" name="type" value="newform">
            <input type="hidden" name="new_form" value="{{ $app_form == null?1:0}}">
        </div>
    </div>
    <div class="row p-1">
        <div class="col-md-3">
            <button type="button" data-dismiss="modal" class="w130 btn btn-sm" style="border: 1px solid gray;">{{trans('button.back')}}</button>
        </div>

        <div class="col-md-9 text-right">
            <button type="button" id="pinkpaperForm" class="w130 btn btn-sm pinkpaperForm" style="background-color: #0a0770;color: white;margin-right: 20px;">{{trans('button.save_print')}}</button>
        
            <button type="button" id="btnNewApp" name="newform" class="w130 btn btn-success btn-sm newForm">{{trans('button.save')}}</button>
        </div>

    </div>
</form>