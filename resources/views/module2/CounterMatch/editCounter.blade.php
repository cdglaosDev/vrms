<!-- start edit modal pop -->
<div class="modal-header">
    <div class="col-md-11 text-center">
        <h3 class="text-center">{{ trans('finance_title.upd_counter_matching') }}</h3>
    </div>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="{{ route('counter-matching.update', $counter->id)}}" method="POST"  id="editform" name="editform">
<div class="modal-body">

@method('PATCH')
@csrf
<div class="col-md-12 col-sm-12 mb-3">
        <label for="validationCustom01">{{ trans('common.province') }}:</label>
        <select name="province_code" class="form-control" required="" disabled>
            @foreach($provinces as $province)
            <option value="{{$province->province_code}}" {{$province->province_code == $counter->province_code ?'selected':''}}>{{$province->name}}({{$province->name_en}})</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-12 col-sm-12 mb-3">
        <label for="validationCustom01">{{ trans('finance_title.service_counter') }}:</label>
        <select name="service_counter_id" id="service" class="form-control" disabled>
            @foreach($scounters as $scounter)
            <option value="{{$counter->id}}" {{$scounter->id == $counter->service_counter_id?'selected':''}}>{{$scounter->name}}({{$scounter->name_en}})</option>
            @endforeach
        </select>
    </div>
    
    <div class="col-md-12 col-sm-12 mb-3">
        <label for="validationCustom01">{{ trans('app_form.staff') }}:</label>
        <select name="staff_id" id="staff" class="form-control" required="">
            @foreach($users as $user)
            <option value="{{$user->id}}" {{$user->id == $counter->staff_id?'selected':''}}>{{$user->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-12 col-sm-12 mb-3">
        <label for="validationCustom01">{{ trans('finance_title.start_bill_no') }}:</label>
        <input type="number" name="start_bill_no" class="form-control bill_no"   readonly value="{{$counter->start_bill_no}}" placeholder="Enter Start bill numbe">
    </div>
    <div class="col-md-12 col-sm-12 mb-3">
        <label for="validationCustom01">{{ trans('finance_title.bill_no_present') }}:</label>
        <input type="number" name="bill_no_present" class="form-control"   value="{{$counter->bill_no_present}}"  readonly>
    </div>
    
</div>

<div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
    <button type="submit" class="btn btn-success btn-sm">{{trans('button.update')}}</button>
</div>
</form>
        
<!-- end edit modal -->