@extends('layouts.master')
@section('vims','active')
@section('content') 
    <h1 class="page-header">{{trans('LicenseBooking.create_license_history')}}</h1>
    <div class="panel panel-inverse">
    @include('flash') 
        <div class="body">
          <form action="{{route('license-history.update',['license_history'=> $license_history])}}" method="POST">
            
            @method('PATCH')
                      @csrf
                      <div class="modal-body">
                        <div class="row">

                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>{{ trans('LicenseBooking.license_alphabet') }}:</label>
                                <select name="license_alphabet_id" id="license_alphabet_id" class="form-control" required="">
                                  <option value="">{{trans('LicenseBooking.select_booking_number')}}</option>
                                    @foreach ($alphabet as $alphabet)
                                      <option value="{{$alphabet-> id}}"{{$alphabet-> id == $license_history->license_alphabet_id ? 'selected' : ''}}>{{$alphabet->name_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>

                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>{{ trans('LicenseBooking.car_number') }}:</label>
                                <select name="vehicle_id" id="vehicle_id" class="form-control" required="">
                                  <option value="">{{trans('LicenseBooking.select_car_number')}}</option>
                                    @foreach ($vehicle as $vehicle)
                                      <option value="{{$vehicle-> id}}"{{$vehicle -> id == $license_history -> vehicle_id ? 'selected' : ''}}>{{$vehicle->car_number}}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>

                          <div class="col-sm-3">
                            <div class="form-group">
                                <label for="validationCustom01">{{ trans('LicenseBooking.license_number') }}:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{old('license_no_number')?? $license_history -> license_no_number}}" name="license_no_number" required="">
                              </div>
                          </div>

                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>{{ trans('LicenseBooking.license_status') }}:</label>
                                <select name="license_no_status" id="license_no_status" class="form-control" required="">
                                    @foreach(["uses" => "Use", "not_uses" => "Not Use"] AS $Key => $Value)    
                                      <option value="{{ $Key }}" {{ old("license_no_status", $license_history->license_no_status) == $Key ? "selected" : "" }}>{{ $Value }}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>

                      </div>

                        <div class="row">

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label for="status">{{ trans('LicenseBooking.status') }}:</label>
                              <select name="status" id="status" class="form-control">
                                @foreach ($license_history -> activeOptions() as $activeOptionsKey => $activeOptionsValue)
                                  <option value="{{$activeOptionsKey}}" {{$license_history -> status == $activeOptionsValue ? 'selected' : ''}}>{{$activeOptionsValue}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                  <label for="validationCustom01">{{trans('LicenseBooking.start_date')}}:</label>
                                  <input type="text" class="form-control date" id="validationCustom01" value="{{old('start_date')?? date('d-m-Y',strtotime($license_history->start_date))}}" name="start_date" required="">
                                </div>
                            </div>

                            <div class="col-sm-4">
                              <div class="form-group">
                                <label for="validationCustom01">{{trans('LicenseBooking.end_date')}}:</label>
                                <input type="text" class="form-control date" id="validationCustom01" value="{{old('end_date')?? date('d-m-Y',strtotime($license_history->end_date))}}" name="end_date" required="">
                              </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                          <a href="/license-history" class="btn btn-secondary">{{trans('finance_button.cancel')}}</a>
                          <input type="submit" class="btn btn-success " value="{{trans('finance_button.update')}}">
                        </div>
                      </div>  
            </form>
    </div>
</div>
@endsection
   
 