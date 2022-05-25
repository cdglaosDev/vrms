@php
        $kinds = \App\Model\VehicleKind::whereStatus(1)->get();
        $brands = \App\Model\VehicleBrand::whereStatus(1)->get();
        $types = \App\Model\VehicleType::whereStatus(1)->get();
        $models= \App\Model\VehicleModel::whereStatus(1)->get();
        $provinces= \App\Model\Province::whereStatus(1)->get();
        $moter_brand = \App\Model\EngineBrand::whereStatus(1)->get();
        $doc_type =\App\Model\ApplicationDocType::get();
 @endphp
 <!--start transfer modal box -->
 <div class="modal fade" id="transferModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg bigger" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="text-center">Transfer Vehicle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form  action="{{route('vehicle-transfer.store')}}"  method="POST" enctype="multipart/form-data">
                    @method('post')
                        @csrf
                        <div class="form-row mb-4" >
                    <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01">Transfer No:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="{{\App\Helpers\getData::tran_no()}}" placeholder="" name="transfer_no" readonly="">
                    </div>

                    <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01">Transfer Date:</label>
                        <input type="text" class="date form-control" id="validationCustom01" value="" placeholder="" name="transfer_date" required="">
                    </div>
                
                    <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01"> Customer Name:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="{{ $app_form->customer_name}}" placeholder="" name="customer_name" readonly="">
                        <input type="hidden" value="{{$app_form->vehicle_id}}" name="vehicle_id">
                    </div>
                    <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01"> Status:</label>
                        <select name="status" id="" class="form-control" required>
                            <option value="" selected disabled>Select Status</option>
                            <option value="1"> Active</option>
                            <option value="0"> Deactive</option>
                        </select>
                        </div>
                    <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01">App Request No:</label>
                        <input type="text" name="app_request_no" class="form-control" value="{{\App\Helpers\getData::getAppNumber()}}" readonly required="">
                        <input type="hidden" name="app_id" value="">
                        </div>
                        <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01">From:</label>
                        <select name="transer_from" id="" class="form-control" required>
                            <option value="" selected disabled>Select transfer From</option>
                            @foreach($provinces as $data)
                                <option value="{{$data->province_code}}">{{ $data->name }}({{$data->name_en}})</option>
                            @endforeach
                        </select>
                        </div>

                        <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01">To:</label>
                        <select name="transer_to" id="" class="form-control" required>
                        <option value="" selected disabled>Select transfer To</option>
                            @foreach($provinces as $data)
                                <option value="{{$data->province_code}}">{{ $data->name }}({{$data->name_en}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01">Owner Name:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="{{ $app_form->vehicle->owner_name ?? ''}}" placeholder=""  readonly="">
                    </div>
                    <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01">License No:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="{{ $app_form->vehicle->licence_no ?? ''}}" placeholder="" name="division_no" readonly="" >
                    </div>
                    <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01">Old Vehicle No:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="{{ $app_form->vehicle->licence_no ?? ''}}" placeholder="" name="old_vehicle_number" readonly="" >
                    </div>
                    <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01">New Vehicle No:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="new_vehicle_number" required="">
                    </div>
                    <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01">Tenant Name:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="{{ $app_form->vehicle->tenant_name ?? ''}}" placeholder="" name="" readonly="test" required="">
                    </div>

                    <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01">Vehicle Type:</label>
                        <select name="vehicle_type_id" class="form-control" disabled="disabled">
                        <option value="" selected disabled>Select Vehicle Type </option>
                        @foreach($types as $type)
                        <option value="{{$type->id}}" {{$type->id == $app_form->vehicle->vehicle_type_id ? 'selected':''}}>{{ $type->name}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01">vehicle Kind:</label>
                        <select name="vehicle_kind_id" class="form-control" disabled="disabled">
                        <option value="" selected disabled>Select Vehicle Kind</option>
                        @foreach($kinds as $kind)
                        <option value="{{$kind->id}}" {{$kind->id == $app_form->vehicle->vehicle_kind_id? 'selected':''}}>{{ $kind->name}}</option>
                        @endforeach
                    </select></div>
                
                    <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01">Model Brand Id:</label>
                        <select name="moter_brand_id" class="form-control" disabled="disabled">
                        <option value="" selected disabled>Select Model Brand</option>
                        @foreach($moter_brand as $motor)
                        <option value="{{$motor->id}}" >{{ $motor->name}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01">Province:</label>
                        <select name="province_code" class="form-control" disabled="disabled">
                        <option value="" selected disabled>Select Province</option>
                        @foreach($provinces as $pro)
                        <option value="{{$pro->province_code}}" {{$pro->province_code == $app_form->vehicle->province_code? 'selected':''}}>{{ $pro->name}}</option>
                        @endforeach
                        </select>
                    </div>
                   
                    </div>
                    <hr>
                    <h5>Vehicle Transfer Detail</h5>
                    
                    <div class="form-row mb-4">
                    <table class="table table-bordered" id="app-document"> 
                    <thead>
                    <tr>
                        <th>Document Type</th>
                        <th>Document file</th>
                        <th>Status</th>
                        <th>Note</th>
                        <th>By Staff</th>
                      
                    
                    </tr>
                    </thead> 
                    <tbody id="next-row">
                    <tr>  
                    <td>
                        <div class="form-group doc_type">
                        <select class="form-control required"  name="doc_type_id[]" required >
                            <option value="" selected disabled hidden>--Select Document Type--</option>
                            @foreach($doc_type as $data)
                            <option value="{{$data->id}}">{{ $data->name }}&nbsp;({{$data->name_en}})</option>
                            @endforeach
                        </select>
                        </div>
                    </td>  
                    <td>
                        <div class="form-group filename">
                        <input type="file" name="filename[]"  class="form-control required" required="" /></div>
                    </td> 
                    
                    <td>
                        <div class="form-group status">
                        <select name="tran_status[]" id="" class="form-control" required>
                            <option value="" selected disabled>Select Status</option>
                            <option value="1"> Active</option>
                            <option value="0"> Deactive</option>
                        </select>
                        </td>
                    <td>
                        <div class="form-group tran_note">
                        <input type="text" name="tran_note[]"  class="form-control" placeholder="Enter Note" /></div>
                    </td> 
                    <td>
                        <div class="form-group staff">
                        <input type="text" name="staff[]"  class="form-control" value="{{$app_form->staff->name}}" readonly /></div>
                    </td> 
                    <td><button type="button" name="add" id="add" class="btn btn-success btn-sm"><i class="fas fa-plus"></i>
                        </button>
                    </td>
                     </tr>  
                     </tbody>
                </table> 

                    </div>
                    <div class="form-row mt-3">
                <div class="col-md-8 col-sm-8">
                 
                <a class="col-md-2  btn  btn-light btn-sm" href="#">Print Transfer</a>
                <a class="col-md-2  btn  btn-light btn-sm" href="#">Certificate</a>
              
                </div>
                <div class="col-md-4 col-sm-4 text-right">
                <button type="submit" class="btn btn-success btn-sm">{{trans('button.save')}}</button>
                <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
                
                </div>
                </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--End transfer modal box -->
