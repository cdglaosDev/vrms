@php
    $app_no = \App\Model\AppForm::get();
   $veh_tenant = \App\Model\VehicleTenant::whereVehicleId($app_form->vehicle_id)->first();
   $smart_card_code = \App\Model\SmartCardSetting::pluck('code')->first();
   $districts = \App\Model\District::whereStatus(1)->whereProvinceCode($vehicle->province_code)->get();
    $models = \App\Model\VehicleModel::whereStatus(1)->whereBrandId($vehicle->brand_id)->get();
@endphp
<style>
  
    #changeInfo input[type=checkbox] {
    transform: scale(1);
    margin-left: -15px;
    }
   label.checkbox-label{
    word-spacing: -5px;
    vertical-align: top;
   }
   #changeInfo .form-row label{
       font-size: 13px;
   }
   #changeInfo span.select2-selection__rendered{
    font-size: 0.825rem;
   }

   

</style>
<div class="modal fade" id="changeInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg bigger" role="document">
    <div class="modal-content ">
    <div class="modal-header text-right py-0">
    
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="padding-top: 0px !important;">
      <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#vehInfo" role="tab" aria-controls="home-1" aria-selected="true" >Vehicle Information</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#document">Document</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#change_log">Change Log</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tenant_info">Tenant Information</a>
        </li>
    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                    <div class="tab-pane show active" id="vehInfo" role="tabpanel">
                    @include('Module4.Vehicle.VehicleInfo',['vehicle'=> $vehicle, 'app_form' => $app_form, 'data' => $data,'form_type' =>'app'])
                        </div>
                       
                        <div class="tab-pane fade" id="document" role="tabpanel">
                        @include('Module4.Vehicle.VehDoc', ['app_doc' => $app_doc, 'id'=>$app_form->vehicle_id])
                        </div>
                        <div class="tab-pane " id="change_log" role="tabpanel">Change Log</div>
                        <div class="tab-pane " id="tenant_info" role="tabpanel">
                        <form action="{{ route('vehicle-tenant.store') }}" method="POST">
                            @csrf
                    <div class="form-row">
                    <div class="col-md-12 col-sm-12 mb-1">
                        <label for="validationCustom01">Name:</label>
                        <input type="hidden" name="vehicle_id" value="{{$app_form->vehicle_id}}">
                        <input type="text" class="date form-control"  value="{{ $veh_tenant->tenant_name ?? ''}}" placeholder="Enter Name" name="tenant_name" required>
                    </div>
                    <div class="col-md-6 col-sm-6 mb-1">
                        <label for="validationCustom01">Province:</label>
                       
                        <select name="province_code" class="form-control" required>
                                <option value="" selected disabled>Select Province</option>
                                @foreach($veh_info['provinces'] as $pro)
                                <option value="{{$pro->province_code}}" @if(isset($veh_tenant)) {{$veh_tenant->province_code == $pro->province_code?'selected':''}} @endif>{{ $pro->name}}({{ $pro->name_en }})</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="col-md-6 col-sm-6 mb-1">
                        <label for="validationCustom01">District:</label>
                        <select class="form-control" name="district_code" id="district" required="required">
                                    <option value="" selected disabled hidden>--Select District--</option>
                                    @foreach($veh_info['districts'] as $district)
                                <option value="{{$district->district_code}}" @if(isset($veh_tenant)) {{$veh_tenant->district_code == $district->district_code?'selected':''}} @endif>{{ $district->name}} ({{ $district->name_en }})</option>
                                @endforeach                 
                                </select>
                    </div>
                    <div class="col-md-6 col-sm-6 mb-1">
                        <label for="validationCustom01">Village:</label>
                        <input type="text" class="date form-control"  value="{{ $veh_tenant->village ?? ''}}" placeholder="Enter Village" name="village" required>
                    </div>
                    <div class="col-md-6 col-sm-6 mb-1">
                        <label for="validationCustom01">Tel:</label>
                        <input type="number" class="date form-control"  value="{{ $veh_tenant->phone ?? ''}}" placeholder="Enter Phone" name="phone" required>
                    </div>
                    <div class="col-md-12 col-sm-12 mb-1">
                        <label for="validationCustom01">Note:</label>
                       <textarea name="note" id="" class="form-control" cols="3" rows="6">{{$veh_tenant->note ?? ''}}</textarea>
                    </div>
                    <div class="col-md-12 col-sm-12 text-right mt-2">
                     <button class="btn btn-success btn-sm">Save</button>
                    </div>
                    </div>
                </form>
                        </div>
                    </div>
                </div>
    </div>
    </div>
  </div>
</div>
@include('Module4.Vehicle.NewAppFormModal',['vehicle_id' => $app_form->vehicle_id]) 
