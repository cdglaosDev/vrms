 @php
        $kinds = \App\Model\VehicleKind::whereStatus(1)->get();
        $brands = \App\Model\VehicleBrand::whereStatus(1)->get();
        $types = \App\Model\VehicleType::whereStatus(1)->get();
        $models= \App\Model\VehicleModel::whereStatus(1)->get();
        $provinces= \App\Model\Province::whereStatus(1)->get();
        $moter_brand = \App\Model\MoterBrand::whereStatus(1)->get();
 @endphp
 <!--start transfer modal box -->
 <div class="modal fade" id="veh_transfer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h1 class="text-center">Transfer Vehicle</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form  action="{{route('vehicle-transfer.store')}}"  method="POST">
                    @method('post')
                        @csrf
            
           
                <div class="form-row mb-4" >
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Transfer No:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="transfer_no" readonly="">
                    </div>

                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Transfer Date:</label>
                        <input type="text" class="date form-control" id="validationCustom01" value="" placeholder="" name="transfer_date" required="">
                    </div>
                
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01"> Customer Name:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="" required="">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01"> Status:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="status" required="">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">App Request No:</label>
                        <input type="text" name="app_request_no" class="form-control" value="{{\App\Helpers\getData::getAppNumber()}}" readonly required="">
                        <input type="hidden" name="app_id" value="">
                        </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">From:</label>
                        <select name="transer_from" id="" class="form-control">
                            <option value="" selected disabled>Select transfer From</option>
                            @foreach($provinces as $data)
                                <option value="{{$data->province_code}}">{{ $data->name }}({{$data->name_en}})</option>
                            @endforeach
                        </select>
                        </div>

                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">To:</label>
                        <select name="transer_to" id="" class="form-control">
                        <option value="" selected disabled>Select transfer To</option>
                            @foreach($provinces as $data)
                                <option value="{{$data->province_code}}">{{ $data->name }}({{$data->name_en}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Owner Name:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder=""  readonly="" required="">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">License No:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" readonly="" required="">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Old Vehicle No:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="old_vehicle_number" readonly="" required="">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">New Vehicle No:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="new_vehicle_number" required="">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Tenant Name:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="" readonly="test" required="">
                    </div>

                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Vehicle Type:</label>
                        <select name="vehicle_type_id" class="form-control" readonly>
                        <option value="" selected disabled>Select Vehicle Type</option>
                        @foreach($types as $type)
                        <option value="{{$type->id}}">{{ $type->name}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">vehicle Kind:</label>
                        <select name="vehicle_kind_id" class="form-control" readonly>
                        <option value="" selected disabled>Select Vehicle Type</option>
                        @foreach($kinds as $kind)
                        <option value="{{$kind->id}}" >{{ $kind->name}}</option>
                        @endforeach
                    </select></div>
                
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Model Brand Id:</label>
                        <select name="moter_brand_id" class="form-control" readonly>
                        <option value="" selected disabled>Select Vehicle Type</option>
                        @foreach($moter_brand as $motor)
                        <option value="{{$motor->id}}" >{{ $motor->name}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Province:</label>
                        <select name="province_code" class="form-control" readonly>
                        <option value="" selected disabled>Select Vehicle Type</option>
                        @foreach($provinces as $pro)
                        <option value="{{$pro->province_code}}" >{{ $pro->name}}</option>
                        @endforeach
                    </div>
                   
                    </div>
                    <div class="col-md-12 col-sm-12 mb-12">
                        <label for="validationCustom01">Remark:</label>
                        <textarea name="remark" id="" cols="5" rows="5" class="form-control" required="">{{ $vehicle->remark}}</textarea>
                    </div>
</div>

                    <hr style="width: 100%;color:#000" class="mb-4">

                    <h4>Vehicle Transfer Detail</h4>
                    <a href="" class="btn btn-success">Add new Document</a>
                    <div class="form-row mb-4">
                    <table  class="table  table-bordered bg-default text-white" style="width:100%">
                        <thead>
                            <th>No</th>
                            <th>Document Type</th>
                            <th>Document file</th>
                            <th>Status</th>
                            <th>Note</th>
                            <th>By Staff</th>
                        
                        </thead>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        
                        </tr>
                    </table>

                    </div>
                    <hr style="width: 100% ;color:#000" class="mb-3">

                    <div class="form-row">
                    <div class="col-md-8 col-sm-8">
                
                    <a class="col-md-2  btn  btn-default" href="#">Print Transfer</a>
                    <a class="col-md-2  btn  btn-default" href="#">Certificate</a>
                
                    </div>
                    <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">{{trans('button.cancel')}}</button>
                    <button type="submit" class="btn btn-success">{{trans('button.update')}}</button>
            
                    </div>
                    </div>
                </div>
            </form>
      </div>
    </div>
  </div>
</div>
<!--End transfer modal box -->