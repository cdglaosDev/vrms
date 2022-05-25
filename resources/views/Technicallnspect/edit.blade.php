@extends('layouts.master')
@section('tech','active')
@section('content') 
@php
$vehicle =\App\Model\VehicleType::get();
$user =\App\User::get();
@endphp
    <h1 class="page-header">{{trans('transfer_vehicle.update_technical_inspection')}}</h1>
    <div class="card">
        <div class="card-body">
        @include('flash') 
       
             <form action="{{route('technical-inspect.update',['id'=>$vehicle_inspection->id])}}" method="POST" enctype="multipart/form-data">
                               @method('patch')
                               
                      @csrf
                      <div class="modal-body">
                        <div class="row">
                        
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label for="validationCustom01">{{trans('transfer_vehicle.request_number')}}:</label>
                             
                              <input type="text" name="app_request_no" class="form-control" value="{{$vehicle_inspection->app_request_no }}" required="" placeholder="Enter Application Request Nunber" >
                            </div>
                          </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                          <label class="validationCustom01">{{ trans('transfer_vehicle.inspect_number') }}:</label>
                            <input type="text" name="inspect_number" class="form-control"  value="{{$vehicle_inspection->inspect_number }}"  required="" placeholder="Enter Inspect Number" readonly="">
                           
                          
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                                <label for="validationCustom01">{{ trans('transfer_vehicle.date') }}:</label>
                                <input type="date" class="date form-control" id="validationCustom01" value="{{$vehicle_inspection->date}}" placeholder="Enter Date" name="date" required="">
                              </div>
                          </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                  <label for="validationCustom01">{{trans('transfer_vehicle.inspect_type')}}:</label>
                                  <input type="text" class="form-control" id="validationCustom01" value="{{$vehicle_inspection->type}}"  placeholder="{{trans('Enter Type')}}" name="type" required="">
                                </div>
                            </div>
                             <div class="col-sm-3">
                            <div class="form-group">
                              <label for="validationCustom01">{{trans('transfer_vehicle.log_activity')}}:</label>
                             
                              <input type="text" name="log_activity" class="form-control"  value="{{$vehicle_inspection->log_activity}}" required="" placeholder="Enter Technical Inspect Log Activity" >
                            </div>
                          </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                          <label class="validationCustom01">{{ trans('transfer_vehicle.license_plate_no') }}:</label>
                            <input type="text" name="license_plate_no" class="form-control"  value="{{$vehicle_inspection->license_plate_no}}"  required="" placeholder="Enter License Plate Number" >
                            </div>
                          </div>
                       
                  <div class="col-sm-3">
                  <label for="validationCustom02">{{trans('transfer_vehicle.vehicle_name') }}:</label>
                  <div class="input-group">
                  <select class="form-control js-example-basic-single" style="width: 100%;"   name="vehicle_id" required>
                     <option value="" selected disabled hidden  >--{{ trans('vehicle.vehicle_type')}}--</option>
                     @foreach($vehicle as $type)
                     <option value="{{$type->id}}" class="style1" {{ $vehicle_inspection->vehicle_id == $type->id ? 'selected' : '' }}>{{ $type->name }}({{$type->name_en}})</option>
                     @endforeach
                  </select>
                  </div>
                 </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="status">{{ trans('transfer_vehicle.status') }}:</label>
                          <select name="status" id="status" class="form-control">
                              <option value="1" @if($vehicle_inspection->status == 1) selected="selected" @endif>Active</option>
                              <option value="0"  @if($vehicle_inspection->status == 0) selected="selected" @endif>Deactive</option>
                          </select>
                        </div>
                      </div>
                      </div>
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="validationCustom01">{{trans('transfer_vehicle.result')}}:</label>
                              <textarea name="result" id="validationCustom01" cols="10" rows="5" class="form-control" value="{{$vehicle_inspection->type}}" placeholder="Enter Result"> {{$vehicle_inspection->result}}</textarea>  
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="validationCustom01">{{trans('transfer_vehicle.comment')}}:</label>
                              <textarea name="comment" id="validationCustom01" cols="10" rows="5" class="form-control" value="{{$vehicle_inspection->comment}}" placeholder="Enter Comment">{{$vehicle_inspection->comment}}</textarea> 
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="modal-footer">
                          <a href="/technical-inspect" class="btn btn-secondary btn-sm">{{trans('finance_button.cancel')}}</a>
                        <input type="submit" class="btn btn-success  btn-sm" value="{{trans('finance_button.update')}}">
                        </div>
                     
            </form>
    </div>
</div>
@endsection
   @push('page_scripts')

 <script type="text/javascript">

         $(document).on("click", '.edit_btn', function (e) {           
           
         
            $('[name="status"]').val($(this).data('status'));
            

            document.getElementById("editform").action = base_url+"/"+$(this).data('id');
        });

    </script>
@endpush
 