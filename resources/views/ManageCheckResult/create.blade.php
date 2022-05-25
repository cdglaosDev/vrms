@extends('layouts.master')
@section('vims','active')
@section('content') 
    <h1 class="page-header">{{trans('gas_standard_check.create_new_check')}}</h1>
    <div class="panel panel-inverse">
    @include('flash') 
        <div class="body">
            <form  action="\check-result"  method="POST">
                      @method('post')
                      @csrf
                      <div class="modal-body">
                        <div class="form-row">
                          <div class="col-md-12 mb-3">

                          <div class="col-md-12 mb-3">
                              <label for="validationCustom01">{{ trans('gas_standard_check.app_form_id') }}:</label>
                              <select name="app_form_id" id="app_form_id" class="form-control selectpicker" data-live-search="true" required="">
                                <option value="" selected disabled>Selecte App Number</option>
                                  @foreach ($applictaion_form as $app)
                                      <option value="{{$app-> id}}">{{$app-> app_number}}</option>
                                  @endforeach
                              </select>
                          </div>

                          <div class="col-md-12 mb-3">
                            <label for="validationCustom01">{{trans('gas_standard_check.check_name')}}:</label>
                            <input type="text" class="form-control" id="validationCustom01" value="{{old('name')}}" placeholder="{{trans('gas_standard_check.enter_check_name')}}" name="name" required="">
                          </div>

                          <div class="col-md-12 mb-3">
                            <label for="validationCustom01">{{trans('gas_standard_check.check_name_en')}}:</label>
                            <input type="text" class="form-control" id="validationCustom01" value="{{old('name_en')}}" placeholder="{{trans('gas_standard_check.enter_check_name_en')}}" name="name_en" required="">
                          </div>
                    
                          <div class="col-md-12 mb-3">
                            <label for="validationCustom01">{{trans('gas_standard_check.check_result')}}:</label>
                            <input type="text" class="form-control" id="validationCustom01" value="{{old('result')}}" placeholder="{{trans('gas_standard_check.enter_check_result')}}" name="result" required="">
                          </div>

                          <div class="col-md-12 mb-3">
                            <label for="validationCustom01">{{trans('gas_standard_check.check_remark')}}:</label>
                            <input type="text" class="form-control" id="validationCustom01" value="{{old('remark')}}" placeholder="{{trans('gas_standard_check.enter_check_remark')}}" name="remark" required="">
                          </div>
                          
                          
                        </div>
                    </div>
                            <div class="modal-footer">
                                <a href="/check-result" class="btn btn-secondary">{{trans('button.cancel')}}</a>
                              <input type="submit" class="btn btn-success " value="{{trans('button.save')}}">
                              </div>
                            </div>
            </form>
    </div>
</div>
@endsection
   
 