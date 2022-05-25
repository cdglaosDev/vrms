@extends('layouts.master')
@section('tech','active')
@section('content') 
@php
$vehicle =\App\Model\VehicleType::get();
$user =\App\User::get();
@endphp
    <h1 class="page-header">{{trans('transfer_vehicle.create_vehicle_inspection')}}</h1>
    <div class="card">
        <div class="card-body">
        @include('flash') 
       
            <form  action="\technical-inspect"  method="POST">
                      @method('post')
                      @csrf
                      <div class="modal-body">
                        <div class="row">
                        
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label for="validationCustom01">{{trans('transfer_vehicle.request_number')}}:</label>
                             
                              <input type="text" name="app_request_no" class="form-control" value="" required="" placeholder="Enter Application Request Nunber" >
                            </div>
                          </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                          <label class="validationCustom01">{{ trans('transfer_vehicle.inspect_number') }}:</label>
                            <input type="hidden" name="inspect_number" value="" class="form-control" readonly req>
                            <input type="text" name="inspect_number" class="form-control" value=""  required="" placeholder="Inspect Number Auto Fill" readonly="" readonly="">
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                                <label for="validationCustom01">{{ trans('transfer_vehicle.date') }}:</label>
                                <input type="date" class="date form-control" id="validationCustom01" value="" placeholder="Enter Date" name="date" required="">
                              </div>
                          </div>
                          <div class="col-sm-3">
                                <div class="form-group">
                                  <label for="validationCustom01">{{trans('transfer_vehicle.inspect_type')}}:</label>
                                  <input type="text" class="form-control" id="validationCustom01" value="" placeholder="{{trans('Enter Type')}}" name="type" required="">
                                </div>
                            </div>
                         <div class="col-sm-3">
                         <div class="form-group">
                              <label for="validationCustom01">{{trans('transfer_vehicle.log_activity')}}:</label>
                              <input type="text" name="log_activity" class="form-control" value="" required="" placeholder="Enter Technical Inspect Log Activity" >
                            </div>
                          </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                          <label class="validationCustom01">{{ trans('transfer_vehicle.license_plate_no') }}:</label>
                            <input type="text" name="license_plate_no" class="form-control" value=""  required="" placeholder="Enter License Plate Number" >
                            </div>
                          </div>
                       <div class="col-sm-3">
                        <label for="validationCustom02">{{trans('transfer_vehicle.vehicle_name') }}:</label>
                         <div class="input-group">
                        <select class="form-control js-example-basic-single" style="width: 100%;"   name="vehicle_id" required>
                          <option value="" selected disabled hidden  >--{{ trans('vehicle.vehicle_type')}}--</option>
                           @foreach($vehicle as $type)
                         <option value="{{$type->id}}" >{{ $type->name }}({{$type->name_en}})</option>
                          @endforeach
                        </select>
                          </div>
                       </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="status">{{ trans('transfer_vehicle.status') }}:</label>
                          <select name="status" id="status" class="form-control" required=""
                          >
                          <option value="">{{trans('transfer_vehicle.select_status')}}</option>
                              <option value="1">Active</option>
                              <option value="0">Deactive</option>
                          </select>
                        </div>
                      </div>

                        </div>

                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="validationCustom01">{{trans('transfer_vehicle.result')}}:</label>
                              <textarea name="result" id="validationCustom01" cols="10" rows="5" class="form-control" value="" placeholder="Enter Result" required=""></textarea>  
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="validationCustom01">{{trans('transfer_vehicle.comment')}}:</label>
                              <textarea name="comment" id="validationCustom01" cols="10" rows="5" class="form-control" value="" placeholder="Enter Comment" required=""></textarea>  
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                          <a href="/technical-inspect" class="btn btn-secondary btn-sm">{{trans('finance_button.cancel')}}</a>
                        <input type="submit" class="btn btn-success  btn-sm" value="{{trans('finance_button.save')}}">
                        </div>
                     
            </form>
    </div>
</div>
@endsection
   
 