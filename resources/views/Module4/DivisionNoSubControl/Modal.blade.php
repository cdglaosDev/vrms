@php
$province = \App\Model\Province::whereProvinceCode(\App\Helpers\Helper::current_province())->get();

@endphp
<div class="modal fade bigger" id="addModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content w-150">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form  action="{{route('division-no-sub-control.store')}}"  method="POST">
                      @method('post')
                      @csrf
                      <h3 class="text-center">Add Division number sub control</h3>
                      <div class="modal-body">
                     <div class="row">
                      <div class="col-sm-6 col-md-6 ">
                         <label for="validationCustomUsername">{{ trans('register.province')}}</label>
                         <select  class="js-example-basic-single form-control" id="province"  name="province_code" style="width:100%" required="" >
                          
                           @foreach($province as $pro)
                           <option value="{{$pro->province_code}}">{{ $pro->name }}&nbsp;({{$pro->name_en}})</option>
                           @endforeach
                         </select>
                       </div>

                          <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="validationCustom01">Division No Start</label>
                                <input type="number" class="form-control" id="validationCustom01" value="{{old('province_no_start')}}" placeholder="Enter Division No Start" name="division_no_start" required="">
                              </div>
                          </div>
                          
                      </div>
                       
                        <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="validationCustom01">Division No End</label>
                                <input type="number" class="form-control" id="validationCustom01" value="{{old('province_no_start')}}" placeholder="Enter Division No End" name="division_no_end" required="">
                              </div>
                          </div>
                           <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="validationCustom01">Alert At</label>
                                <input type="text" class="form-control" id="validationCustom01" value="{{old('province_no_start')}}" placeholder="Enter Alert At" name="alert_at" required="">
                              </div>
                          </div>
                          
                          <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                              <label for="status">{{ trans('LicenseBooking.status') }}:</label>
                              <select name="status" class="form-control" required>
                                <option value="" selected disabled>Select Status</option>
                                    @foreach(\App\Model\DivisionNoControl::getEnumList("status") as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>

                          
                        </div>

                        <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
                        <button type="submit" class="btn btn-success btn-sm">{{trans('button.save')}}</button>
                        </div>
                      </div>  
            </form>
      </div>
    </div>
  </div>
</div>


 <div class="modal fade bigger" id="editModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" id="editform" name="editform" method="POST">
                               @method('patch')
                                @csrf
                        <h3 class="text-center">Edit Division number sub control</h3>
                      <div class="modal-body">
                     <div class="row">
                      <div class="col-sm-6 col-md-6">
                         <label for="validationCustomUsername">{{ trans('register.province')}}</label>
                         <select  class="js-example-basic-single form-control" id="province"  name="province_code" style="width:100%" required="" >
                          
                           @foreach($province as $pro)
                           <option value="{{$pro->province_code}}" class="style1" >{{ $pro->name }}&nbsp;({{$pro->name_en}})</option>
                           @endforeach
                         </select>
                       </div>

                          <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="validationCustom01">Division No Start</label>
                                <input type="number" class="form-control" id="validationCustom01" value="" placeholder="Enter Division No Start" name="division_no_start" required="">
                              </div>
                          </div>
                      </div>
                        
                        <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="validationCustom01">Division No End</label>
                                <input type="number" class="form-control" id="validationCustom01" value="" placeholder="Enter Division No End" name="division_no_end" required="">
                              </div>
                          </div>
                           <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="validationCustom01">Alert At</label>
                                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Alert At" name="alert_at" required="">
                              </div>
                          </div>
                       
                          <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                              <label for="status">{{ trans('LicenseBooking.status') }}:</label>
                              <select name="status" class="form-control" required>
                                <option value="" selected disabled>Select Status</option>
                                    @foreach(\App\Model\DivisionNoControl::getEnumList("status") as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                        </div>

                        <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
                        <button type="submit" class="btn btn-success btn-sm">{{trans('button.update')}}</button>
                        </div>
                      </div>  
            </form>
        </div>
    </div>
</div>

