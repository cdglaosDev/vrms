@php
$provinces = \App\Model\Province::whereStatus(1)->get();
$vehicle_types = \App\Model\VehicleType::whereStatus(1)->get();
$lic_alphas= \App\Model\LicenseAlphabet::whereStatus(1)->get();
$lic_alpha_controls = \App\Model\LicenseAlphabetControlStatus::whereStatus(1)->get();
       
@endphp
<div class="modal fade bigger" id="addModel"  role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content w-150">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  action="{{route('license-no-control.store')}}"  method="POST">
                  @method('post')
                      @csrf
          <h3 class="text-center">Create License No Control</h3>
          <div class="modal-body">
            <div class="form-row">
            <div class="col-md-6 col-sm-6 mb-3">
                <label for="validationCustom01">Province Code:</label>
                <select name="province_code" class="js-example-basic-single form-control" style="width: 100%" required="">
                  <option value="" selected disabled hidden>Select Province Code </option>
                  @foreach($provinces as $pro)
                  <option value="{{$pro->province_code}}">{{$pro->name}}({{$pro->name_en}})</option>
                  @endforeach
                </select>
            </div>
            <div class="col-md-6 col-sm-6 mb-3">
                <label for="validationCustom01">Vehicle Type:</label>
                <select name="vehicle_type_id" class="form-control" required="">
                  <option value="" selected disabled hidden>Select Vehicle Type </option>
                  @foreach($vehicle_types as $vtype)
                  <option value="{{$vtype->id}}">{{$vtype->name}}({{$vtype->name_en}})</option>
                  @endforeach
                </select>
            </div>
              <div class="col-md-6 col-sm-6 mb-3">
                <label for="validationCustom01">License Alphabet:</label>
                <select name="license_alphabet_id" class="form-control" required="">
                  <option value="" selected disabled hidden>Select License Alphabet </option>
                  @foreach($lic_alphas as $data)
                  <option value="{{$data->id}}">{{$data->name}}({{$data->name_en}})</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6 col-sm-6 mb-3">
                <label for="validationCustom01">License Alphabet Control Status:</label>
                <select name="license_alphabet_control_status_id" class="form-control" required="">
                  <option value="" selected disabled hidden>Select License Alphabet Control Status </option>
                  @foreach($lic_alpha_controls as $data)
                  <option value="{{$data->id}}">{{$data->name}}({{$data->name_en}})</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6 col-sm-6 mb-3">
                <label for="validationCustom01">{{trans('common.status')}}:</label>
                <select name="status" class="form-control">
                      <option value="" selected disabled hidden>Choose Status </option>
                      <option value="1">Active</option>
                      <option value="0">Deactive</option>
                </select>
              </div>
                
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-secondary">{{trans('button.cancel')}}</button>
             <button type="submit" class="btn btn-success">{{trans('button.save')}}</button>
            
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
            <form action="" method="POST"  id="editform" name="editform">
                @method('PATCH')
               @csrf
               <h3 class="text-center">Create License No Control</h3>
          <div class="modal-body">
            <div class="form-row">
            <div class="col-md-6 col-sm-6 mb-3">
                <label for="validationCustom01">Province Code:</label>
                <select name="province_code" class="form-control" required="">
                  <option value="" selected disabled >Select Province Code </option>
                  @foreach($provinces as $pro)
                  <option value="{{$pro->province_code}}">{{$pro->name}}({{$pro->name_en}})</option>
                  @endforeach
                </select>
            </div>
            <div class="col-md-6 col-sm-6 mb-3">
                <label for="validationCustom01">Vehicle Type:</label>
                <select name="vehicle_type_id" class="form-control" required="">
                  <option value="" selected disabled >Select Vehicle Type </option>
                  @foreach($vehicle_types as $vtype)
                  <option value="{{$vtype->id}}">{{$vtype->name}}({{$vtype->name_en}})</option>
                  @endforeach
                </select>
            </div>
              <div class="col-md-6 col-sm-6 mb-3">
                <label for="validationCustom01">License Alphabet:</label>
                <select name="license_alphabet_id" class="form-control" required="">
                  <option value="" selected disabled >Select License Alphabet </option>
                  @foreach($lic_alphas as $data)
                  <option value="{{$data->id}}">{{$data->name}}({{$data->name_en}})</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6 col-sm-6 mb-3">
                <label for="validationCustom01">License Alphabet Control Status:</label>
                <select name="license_alphabet_control_status_id" class="form-control" required="">
                  <option value="" selected disabled >Select License Alphabet Control Status </option>
                  @foreach($lic_alpha_controls as $data)
                  <option value="{{$data->id}}">{{$data->name}}({{$data->name_en}})</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6 col-sm-6 mb-3">
                <label for="validationCustom01">{{trans('common.status')}}:</label>
                <select name="status" class="form-control">
                      <option value="" selected disabled >Choose Status </option>
                      <option value="1">Active</option>
                      <option value="0">Deactive</option>
                </select>
              </div>
                
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-secondary">{{trans('button.cancel')}}</button>
             <button type="submit" class="btn btn-success">{{trans('button.update')}}</button>
            
            </div>
          </div>
        </form>
        </div>
    </div>
</div>

