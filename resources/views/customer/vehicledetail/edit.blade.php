@php 
$districts = \App\Model\District::whereStatus(1)->whereProvinceCode($vehicle->province_code)->get();
$models = \App\Model\VehicleModel::whereStatus(1)->whereBrandId($vehicle->brand_id)->get();

@endphp

<style>
   #updateForm .col-sm-1,#updateForm .col-sm-1{
   padding-left:0px;
   padding-right:0px;
   margin-bottom: 0px;
   }
</style>
<div class="modal-header" style="border-bottom:none; padding:1.15rem 1rem">
   <h3 style="margin-top:-8px; font-size: 19px; border-bottom:none">
     Import Vehicle App Number: <b>{{ $vehicle->regapps['app_number'] ?? '' }}</b>  Pre Registration App Number:<b> {{ $vehicle->regapps['regapp_number'] ?? ''}}</b>
      <ul class="nav nav-tabs pt-2" style="width: 104%">
         <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" aria-current="page" href="#vehEdit">{{ trans('module4.vehicle_info') }}</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#docEdit">{{ trans('module4.document') }}</a>
         </li>
      </ul>
   </h3>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
</div>
<div class="modal-body pt-0">
   <div class="tab-content clearfix">
       <!-- Start Edit Vehicle info -->
      <div class="tab-pane active" id="vehEdit">
         <div id="updateForm">
            {{ csrf_field() }}
            <input type="hidden" id="vehicleDetailId" value="{{  $vehicle->id }}">
            <table class="form-table vehicle-form">
               <tbody>
                  <tr>
                     <td style="padding-right:0px; width: 334px;">
                        <b style="color:red !important;font-weight:bold">{{ trans('module4.division_number') }}<small>(ຂສ)</small>:</b> 
                        <input class="w150 nvt-focused"  value="" focus="0" f="222" disabled>  
                        <br>
                        <b style="color:red !important;font-weight:bold">{{ trans('module4.province_number') }}<small>(<span id="edit_province_abb">{{ $vehicle->province->abb ??'' }}</span>)</small>:</b> 
                        <input class="w150"  value="" f="222" disabled>
                        <br>				
                        <b>{{ trans('module4.number') }}:</b> 
                        <input  class="w120" value="" f="222" disabled>
                        <br>
                        <!--<b>Encoder:</b> <input name='encoder' class='w50' value=''>-->
                        <b>{{ trans('module4.vdvc_serial') }}:</b> 
                        <input  class="w120" value="" f="222" disabled>
                        <br>
                        <b>{{ trans('module4.issue_date') }}:</b> 
                        <input class="w120"  value="" f="222" disabled>
                        <br>
                        <b>{{ trans('module4.expire_date') }}:</b> 
                        <input class="w120"  value="" f="222" disabled>
                        <br>
                        <b>{{ trans('vehicle.pre_license') }}:</b> 
                        <input type="hidden" id="old-license" value="{{ $vehicle->licence_no_need}}">
                        <input class="w120 license_no" id="edit-license" title="{{ trans('title.enter_license') }}"  style="vertical-align:top;text-align:center;color:#f00;font-weight:bold;font-size:18px !important" name="licence_no_need"  f="222" value="{{ $vehicle->licence_no_need}}" required><br>
                        <b>{{ trans('module4.purpose') }}:</b>
                        <select class="w120" f="222" name="vehicle_kind_code"  title="{{ trans('title.select_kind') }}" id="vehicle_kind_code" required>
                           <option value="" selected disabled hidden>--Select Purpose--</option>
                           @foreach($data['kinds'] as $kind)
                           <option value="{{$kind->vehicle_kind_code}}" {{$kind->vehicle_kind_code== $vehicle->vehicle_kind_code?"selected":""}}>{{$kind->vehicle_kind_code}} {{ $kind->name }}</option>
                           @endforeach
                        </select>
                        ເອກະຊົນລາວ<br>
                        <b>{{ trans('module4.owner_name') }}:</b>
                        <input name="owner_name" id="owner_name" class="w200"  title="{{ trans('title.enter_owner') }}" f="222" value="{{ $vehicle->owner_name}}"><br>
                        <div>
                           <div style="float: left;">
                              <b>{{ trans('module4.village_name') }}:</b>
                              <input style="margin-right: 5px;" name="village_name" class="w100" id="customer_village"  value="{{ $vehicle->village_name }}">
                           </div>
                           <div>
                              <b style="width: 28px !important;">{{ trans('module4.vehicle_unit') }}:</b>
                              <input type="number" name="unit" class="w40 unit" id="unit" value="{{ $vehicle->unit?? ''}}">
                           </div>
                        </div>
                        <b>{{ trans('common.province') }}:</b>
                        <select name="province_code" id="edit-province"  title="{{ trans('title.select_province') }}" class="w120 js-example-basic-single" required>
                           <option value="" selected disabled hidden>--Select Province--</option>
                           @foreach(\App\Model\Province::ProvinceByCustomer() as $pro)
                           <option value="{{$pro->province_code}}" {{$pro->province_code==$vehicle->province_code?"selected":""}}>{{ $pro->name }}</option>
                           @endforeach
                        </select>
                        <br>
                        <b>{{ trans('common.district') }}:</b>
                        <select name="district_code" class="w120 js-example-basic-single"  title="{{ trans('title.select_district') }}" id="edit-district" required>
                           <option value="" selected disabled hidden>--Select District--</option>
                           @foreach($districts as $dist)
                           <option value="{{$dist->district_code}}" {{$dist->district_code==$vehicle->district_code?"selected":""}}>{{ $dist->name }}</option>
                           @endforeach
                        </select>
                        <br>
                        <b>{{ trans('module4.vehicle_type') }}:</b>
                        <select class="w120 js-example-basic-single customer_vehicletype"  title="{{ trans('title.select_vtype') }}" name="vehicle_type_id" >
                           <option value="" selected disabled hidden  >--{{ trans('vehicle.vehicle_type')}}--</option>
                           @foreach($data['types'] as $type)
                           <option value="{{$type->id}}" {{$type->id==$vehicle->vehicle_type_id?"selected":""}}>{{ $type->name }}</option>
                           @endforeach
                        </select>
                        <br/>
                        <b>{{ trans('module4.steering') }}:</b> 
                        <select class="w120 steer" name="steering_id" required>
                        <option value="" selected disabled hidden>--Select Steering--</option>
                        @foreach($data['steerings'] as $steer)
                        <option value="{{$steer->id}}" {{$vehicle->steering_id == $steer->id ?"selected":""}}>{{ $steer->name }}</option>
                        @endforeach
                        </select>
                        <br/>
                        <b>{{ trans('module4.gas') }}:</b> 
                        <select class="w120 gas" name="gas_id">
                           <option value="" selected disabled hidden>-- Select Gas--</option>
                           @foreach($data['gases'] as $gas)
                           <option value="{{ $gas->id}}" {{$vehicle->gas_id == $gas->id ?"selected":""}}>{{ $gas->name }}</option>
                           @endforeach
                        </select>
                        <br/>
                        <div id="license-checker" style="display:block;font-size:12px;text-shadow:none"></div>
                        <b>{{ trans('module4.vehicle_remark') }}:</b>
                        <input class="w180 f12 note" name="note" style=" width: 183px !important;" value="{{ $vehicle->note}}" f="222"><br>
                        <b>{{ trans('module4.vehicle_send') }}:</b> 
                        <input class="w120 vehicle_send" name="vehicle_send" value="{{ $vehicle->vehicle_send??'' }}"  f="222"><br>
                        
                     </td>
                     <td style="padding-right:0px; width: 276px;">
                        <b>{{ trans('module4.cylinder')}}:</b> 
                        <input type="number" class="w120 cylinder"  name="cylinder" step="any" f="222" min="0" value="{{$vehicle->cylinder}}"><br>
                        <b>{{ trans('module4.cc')}}:</b> 
                        <input type="text" class="w120 cc num-dash-validate"  title="{{ trans('title.enter_cc') }}"  min="0" name="cc"  f="222" value="{{$vehicle->cc ?? ''}}"><br>
                        <b>{{ trans('module4.color') }}:</b> 
                        <select class="w120 color js-example-basic-single" name="color_id" required>
                           <option value="" selected disabled hidden  >--Select Color--</option>
                           @foreach($data['colors'] as $co)
                           <option value="{{$co->id}}" {{$vehicle->color_id == $co->id ?"selected":""}}> {{ $co->name }}</option>
                           @endforeach
                        </select>
                        <br/>
                        <b>{{ trans('module4.brand') }}:</b> 
                        <select class="w120 js-example-basic-single" name="brand_id"  title="{{ trans('title.select_brand') }}" id="edit-vbrand" required>
                           <option value="" selected disabled hidden  >--Select Vehicle Brand--</option>
                           @foreach($data['brands'] as $brand)
                           <option value="{{$brand->id}}" {{$brand->id==$vehicle->brand_id?"selected":""}}>({{$brand->name_en}})</option>
                           @endforeach
                        </select>
                        <br/>
                        <b>{{ trans('module4.model') }}:</b>
                        <select class="w120 js-example-basic-single" name="model_id"  title="{{ trans('title.select_modal') }}" id="edit-vmodel" required>
                           <option value="" selected disabled hidden  >--Select Vehicle Model--</option>
                           @foreach($models as $model)
                           <option value="{{$model->id}}" {{$model->id==$vehicle->model_id?"selected":""}}>({{$model->name_en}})</option>
                           @endforeach
                        </select>
                        <br/>
                        <span>{{ trans('module4.engine_no') }}:</span> 
                        <input type="hidden" id="old-engine" value="{{ $vehicle->engine_no}}">
                        <input style="width:177px;font-size:16px !important;font-family:dev_font !important" name="engine_no" title1="{{ trans('title.exist_engine') }}"  title="{{ trans('title.enter_engine') }}" class="eng-validate engine_no" value="{{$vehicle->engine_no}}" required><br>
                        <span>{{ trans('module4.chassis_no') }}:</span> 
                        <input type="hidden" id="old-chassis" value="{{ $vehicle->chassis_no}}">
                        <input style="width:177px;font-size:16px !important;font-family:dev_font !important" name="chassis_no" class="eng-validate chassis_no" title1="{{ trans('title.exist_chassis') }}"  title="{{ trans('title.enter_chassis') }}" value="{{$vehicle->chassis_no}}" required><br>
                        <b>{{ trans('module4.width') }}:</b> 
                        <input type="text" min="0" class="w120 width num-validate-vtype" name="width"  f="222"  title="{{ trans('title.enter_width') }}" value="{{ $vehicle->width }}"> <span style="color:#ddd">ມມ</span><br>
                        <b>{{ trans('module4.long') }}:</b> 
                        <input type="text" min="0" class="w120 long num-validate-vtype" name="long"  f="222" title="{{ trans('title.enter_long') }}" value="{{$vehicle->long}}"> <span style="color:#ddd">ມມ</span><br>
                        <b>{{ trans('module4.height') }}:</b> 
                        <input type="text" min="0" class="w120 height num-validate-vtype" name="height"  f="222"  title="{{ trans('title.enter_height') }}" value="{{ $vehicle->height }}"> <span style="color:#ddd">ມມ</span><br>
                        <b>{{ trans('module4.seat') }}:</b>
                        <input type="number" min="1" id="seat"  class="w120" name="seat" step="any" f="222" value="{{ $vehicle->seat }}">
                        <span id="err1" style="display:none; color:red;font-size: 12px;">This input value is not less than 1.</span><br>
                        <b>{{ trans('module4.weight') }}:</b> 
                        <input class="w120 weight num-dash-validate" type="text" min="0" name="weight"  title="{{ trans('title.enter_weight') }}"  f="222" value="{{ $vehicle->weight }}"><br>
                        <b>{{ trans('module4.weight_filled') }}:</b> 
                        <input class="w120 weight_filled num-dash-validate" type="text" min="0" name="weight_filled"  title="{{ trans('title.enter_weight_fill') }}" value="{{ $vehicle->weight_filled }}" f="222"><br>
                        <b>{{ trans('module4.total_weight') }}:</b> 
                        <input class="w120 total_weight num-dash-validate" type="text"  min="0" value="{{ $vehicle->total_weight }}"  title="{{ trans('title.enter_total_weight') }}" id="total_weight" name="total_weight" f="222"><br>
                        <b>{{ trans('module4.axis') }}:</b> 
                        <input class="w20 axis" name="axis" type="number" step="any" min="0" title="{{ trans('title.enter_axis') }}" value="{{ $vehicle->axis }}">
                        <b class="w60" style="width: 60px !important">{{ trans('module4.wheel') }}:</b> 
                        <input class="w20 wheels" name="wheels"  value="{{ $vehicle->wheels }}" title="{{ trans('title.enter_wheel') }}" id="wheel"> <span id="err2" style="display:none; color:red;font-size: 12px;">This input value is not less than 1.</span><br>
                        <b>{{ trans('module4.year_mnf') }}:</b>  
                        <input class="w120 date-year" type="number" step="any" name="year_manufacture" id="year_manufacture"  picktype="1" value="{{ $vehicle->year_manufacture }}" f="222"><br>
                        <b>{{ trans('module4.motor_brand') }}:</b> 
                        <select class="w120 motor_brand_id js-example-basic-single" name="motor_brand_id" required>
                           <option value="" selected disabled hidden>--Motor Brand--</option>
                           @foreach($data['moter_brand'] as $mb)
                           <option value="{{$mb->id}}" {{$mb->id== $vehicle->motor_brand_id?"selected":""}}>{{ $mb->name }}</option>
                           @endforeach
                        </select>
                     
                     </td>
                     <td style="padding-right:0px;  width: 234px;">
                        <span class="cDB">1.  {{ trans('module4.import_permit') }}:</span><br>
                        <b>{{ trans('module4.hsny') }}:</b> <input type="checkbox"  f="222" v="" disabled><br>
                        <b>{{ trans('module4.invest') }}:</b><input type="checkbox" f="222" v="" disabled><br>
                        <b>{{ trans('module4.veh_mod4_no') }}:</b> <input class="w120 import_permit_no" name="import_permit_no" f="222" value="{{ $vehicle->import_permit_no }}"><br>
                        <b>{{ trans('module4.veh_mod4_date') }}:</b> <input class="w120 import_permit_date custom_date_vehicle" maxlength="10"  name="import_permit_date" value="{{ $vehicle->import_permit_date }}" f="222"><br>
                        <span class="cDB">2. {{ trans('module4.indus_doc') }}:</span><br>
                        <b>{{ trans('module4.veh_mod4_no') }}:</b> <input class="w120 industrial_doc_no" name="industrial_doc_no" f="222" value="{{ $vehicle->industrial_doc_no }}"><br>
                        <b>{{ trans('module4.veh_mod4_date') }}:</b> <input class="w120 industrial_doc_date custom_date_vehicle" maxlength="10" name="industrial_doc_date" f="222" value="{{ $vehicle->industrial_doc_date }}"><br>
                        <span class="cDB">3. {{ trans('module4.tech_doc') }}:</span><br>
                        <b>{{ trans('module4.veh_mod4_no') }}:</b> <input class="w120 technical_doc_no" name="technical_doc_no" f="222" value="{{ $vehicle->technical_doc_no }}"><br>
                        <b>{{ trans('module4.veh_mod4_date') }}:</b> <input class="w120 technical_doc_date custom_date_vehicle" maxlength="10" name="technical_doc_date"  f="222" value="{{ $vehicle->technical_doc_date }}"><br>
                        <span class="cDB">4.  {{ trans('module4.commerce_permit') }}:</span><br>
                        <b> {{ trans('module4.commerce_permit_title') }}:</b>  <input class="w120 comerce_permit" name="comerce_permit" value="{{ $vehicle->comerce_permit}}"  f="222"><br>
                        <b>{{ trans('module4.veh_mod4_no') }}:</b><input class="w120 comerce_permit_no" name="comerce_permit_no" value="{{ $vehicle->comerce_permit_no }}" f="222"><br>
                        <b>{{ trans('module4.veh_mod4_date') }}:</b><input class="w120 comerce_permit_date custom_date_vehicle" maxlength="10" name="comerce_permit_date"  value="{{$vehicle->comerce_permit_date}}" f="222"><br>
         </div>
         </td>
         <td style=" width: 270px;">
            <span class="cDB">5. {{ trans('module4.tax') }}:</span>
            <br>
            <b>{{trans('module4.tax_10_40')}}:</b> <input type="checkbox" f="222" v="" disabled><br>
            <b>{{trans('module4.tax_exam')}}:</b> <input type="checkbox" f="222" v="" disabled><br>
            <b>{{ trans('module4.tax12') }}:</b> <input type="checkbox"  f="222" v="" disabled><br>
            <b>{{ trans('module4.tax50') }}:</b> <input type="checkbox"  f="222" v="" disabled><br>
            <b>{{ trans('module4.veh_mod4_no') }}:</b> <input class="w120 tax_no" name="tax_no"  title="{{ trans('title.enter_tax_no') }}" f="222" value="{{$vehicle->tax_no}}"><br>
            <b>{{ trans('module4.veh_mod4_date') }}:</b> <input class="w120 tax_date custom_date_vehicle" maxlength="10" name="tax_date"  title="{{ trans('title.enter_tax_date') }}"  f="222" value="{{$vehicle->tax_date}}"><br>
            <span class="cDB">6. {{ trans('module4.tax_payment') }}:</span><br>
            <b>{{ trans('module4.tax_receipt') }}:</b> <input type="checkbox"  f="222" v="" disabled><br>
            <b>{{ trans('module4.tax_permit') }}:</b> <input type="checkbox"  f="222" v="" disabled><br>
            <b>{{ trans('module4.veh_mod4_no') }}:</b> <input class="w120 tax_payment_no" name="tax_payment_no"  title="{{ trans('title.enter_tax_payment_no') }}" f="222" value="{{ $vehicle->tax_payment_no }}"><br>
            <b>{{ trans('module4.veh_mod4_date') }}:</b> <input class="w120 tax_payment_date custom_date_vehicle" maxlength="10" name="tax_payment_date"  title="{{ trans('title.enter_tax_payment_date') }}"  f="222" value="{{$vehicle->tax_payment_date}}" ><br>
            <span class="cDB">7. {{trans('module4.police_doc') }}:</span><br>
            <b>{{ trans('module4.veh_mod4_no') }}:</b> <input class="w120 police_doc_no" name="police_doc_no" f="222" value="{{ $vehicle->police_doc_no }}"><br>
            <b>{{ trans('module4.veh_mod4_date') }}:</b> <input class="w120 police_doc_date custom_date_vehicle" maxlength="10" name="police_doc_date"   value="{{ $vehicle->police_doc_date }}" f="222"><br>
            <span class="cDB">8. {{ trans('module4.note1') }}:</span><br>
            <textarea name="remark" class="h40 nvt-focused" style="width:225px;color:red" value="{{ $vehicle->remark }}" f="222"></textarea><br>
            <input type="hidden" id="success_msg" title="{{ trans('module4.success_msg') }}">
            <input type="hidden" id="success_submit" title="{{ trans('module4.success_submit') }}">
         </td>
      </tr>
      <tr>
      <td style="padding-right:0px; width: 276px;"></td>
      <td style=" width: 270px;"></td>
      <td style=" width: 270px;"></td>
      <td>
      </td>
      </tr>
      </tbody>
      </table>
      <div class="row m-0">
      <div class="col-md-6 pt-2">
      <a href="{{ url('/customer/vehicle-detail') }}" class="btn btn-secondary btn-sm">{{ trans('button.back') }}</a>
     
      </div>
      <div class="col-md-6 pt-2 text-right">
      @if($vehicle->regapps['app_status_id'] !=4 &&  $vehicle->regapps['app_status_id'] !=3) 
         <button class="btn btn-success btn-sm edit-form draft" name="save_type" value="draft">{{ trans('button.update') }}</button> 
         <button class="btn btn-success btn-sm edit-form"   name="save_type" value="submit" >{{ trans('button.submit') }}</button>
      @endif
      </div>
      </div>
</div>
   </div>
     <!-- end Edit Vehicle info -->
     <!-- Start edit document -->
   <div class="tab-pane" id="docEdit">
      <form id="editForm" class="form-inline"   action="{{url('/customer/attach-document',  $vehicle->id)}}" method="post" enctype="multipart/form-data" onsubmit="return validateEdit()">
         @csrf
        
         <div class="col-sm-12 col-md-12 md-offset-12">
            <table class="table table-striped" id="app-document">
               <thead>
                  <tr>
                     <th width="400">{{ trans('app_form.doc_type')}}</th>
                     <th>{{ trans('app_form.doc_filename')}}</th>
                     <th>{{ trans('common.action')}}</th>
                  </tr>
               </thead>
               <tbody>
                  <tr class="attach_doc">
                     <td>
                        <div>
                           <input type="hidden" name="doc_type_id[]" class="form-control" value="2" />
                           <h5>{{ trans('doc_type.lic_import_car') }}</h5>
                        </div>
                     </td>
                     <td>
                        <div>
                        @if(!empty($app_doc))
                           <input type="file" name="2" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   id="filename" />
                           @if($app_doc[2])
                              <input type="hidden" class="old_file" name="2" value="1">
                              <a href="{{asset('images/doc/'.$vehicle->regapps['regapp_number'].'/'.$app_doc[2])}}" target="_blank" class="filename_image">{{$app_doc[2]}}</a>
                           @endif
                        @else
                           <input type="file" name="2" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   id="filename" />     
                        @endif
                        </div>
                     </td>
                     <td><a href="" class="btn btn-danger btn-sm remove">X</a> </td>
                  </tr>
                  <tr class="attach_doc">
                     <td>
                        <div>
                           <input type="hidden" name="doc_type_id[]"  class="form-control" value="5" />
                           <h5>{{ trans('doc_type.import_good') }}</h5>
                        </div>
                     </td>
                     <td>
                        <div>
                        @if(!empty($app_doc))
                              <input type="file" name="5" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   id="filename" />
                              @if($app_doc[5])
                                 <input type="hidden" class="old_file" name="5" value="1">
                                 <a href="{{asset('images/doc/'.$vehicle->regapps['regapp_number'].'/'.$app_doc[5])}}" target="_blank" class="filename_image">{{$app_doc[5]}}</a>
                              @endif
                        @else
                           <input type="file" name="5" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   id="filename" />
                        @endif
                        </div>
                     </td>
                     <td> <a href="" class="btn btn-danger btn-sm remove">X</a> </td>
                  </tr>
                  <tr class="attach_doc">
                     <td>
                        <div>
                           <input type="hidden" name="doc_type_id[]"  class="form-control" value="4" />
                           <h5>{{ trans('doc_type.veh_lic_tech') }}</h5>
                        </div>
                     </td>
                     <td>
                        <div>
                           @if(!empty($app_doc))
                              <input type="file" name="4" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   id="filename" />
                              @if($app_doc[4])
                              <input type="hidden" class="old_file" name="4" value="1">
                                 <a href="{{asset('images/doc/'.$vehicle->regapps['regapp_number'].'/'.$app_doc[4])}}" target="_blank" class="filename_image">{{$app_doc[4]}}</a>
                              @endif
                           @else
                              <input type="file" name="4" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   id="filename" />
                           @endif
                          
                        </div>
                     </td>
                     <td>  <a href="" class="btn btn-danger btn-sm remove">X</a></td>
                  </tr>
                  <tr class="attach_doc">
                     <td>
                        <div>
                           <input type="hidden" name="doc_type_id[]" class="form-control" value="3" />
                           <h5>{{ trans('doc_type.lic_ministry') }}</h5>
                        </div>
                     </td>
                     <td>
                        <div>
                           @if(!empty($app_doc))
                              <input type="file" name="3" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   id="filename" />
                              @if($app_doc[3])
                              <input type="hidden" class="old_file" name="3" value="1">
                                 <a href="{{asset('images/doc/'.$vehicle->regapps['regapp_number'].'/'.$app_doc[3])}}" target="_blank" class="filename_image">{{$app_doc[3]}}</a>
                              @endif
                           @else
                           <input type="file" name="3" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   id="filename" />
                           @endif
                        </div>
                     </td>
                     <td> <a href="" class="btn btn-danger btn-sm remove">X</a></td>
                  </tr>
                  <tr class="attach_doc">
                     <td>
                        <div>
                           <input type="hidden" name="doc_type_id[]" class="form-control" value="6" />
                           <h5>{{ trans('doc_type.tax_return') }}</h5>
                        </div>
                     </td>
                     <td>
                        <div>
                        @if(!empty($app_doc))
                              <input type="file" name="6" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   id="filename" />
                              @if($app_doc[6])
                              <input type="hidden" class="old_file" name="6" value="1">
                                 <a href="{{asset('images/doc/'.$vehicle->regapps['regapp_number'].'/'.$app_doc[6])}}" target="_blank" class="filename_image">{{$app_doc[6]}}</a>
                              @endif
                        @else
                           <input type="file" name="6" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   id="filename" />
                        @endif
                        </div>
                     </td>
                     <td>  <a href="" class="btn btn-danger btn-sm remove">X</a> </td>
                  </tr>
                  <tr class="attach_doc">
                     <td>
                        <div>
                           <input type="hidden" name="doc_type_id[]" class="form-control" value="7" />
                           <h5>{{ trans('doc_type.tax_relief') }}</h5>
                        </div>
                     </td>
                     <td>
                        <div>
                           @if(!empty($app_doc))
                              <input type="file" name="7" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   id="filename" />
                              @if($app_doc[7])
                                 <input type="hidden" class="old_file" name="7" value="1">
                                 <a href="{{asset('images/doc/'.$vehicle->regapps['regapp_number'].'/'.$app_doc[7])}}" target="_blank" class="filename_image">{{$app_doc[7]}}</a>
                              @endif
                           @else
                              <input type="file" name="7" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   id="filename" />
                           @endif
                        </div>
                     </td>
                     <td> <a href="" class="btn btn-danger btn-sm remove">X</a></td>
                  </tr>
                  <tr class="attach_doc">
                     <td>
                        <div>
                           <input type="hidden" name="doc_type_id[]" class="form-control" value="8" />
                           <h5>{{ trans('doc_type.record') }}</h5>
                        </div>
                     </td>
                     <td>
                        <div>
                           @if(!empty($app_doc))
                              <input type="file" name="8" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   id="filename" />
                              @if($app_doc[8])
                                 <input type="hidden" class="old_file" name="8" value="1">
                                 <a href="{{asset('images/doc/'.$vehicle->regapps['regapp_number'].'/'.$app_doc[8])}}" target="_blank" class="filename_image">{{$app_doc[8]}}</a>
                              @endif
                           @else
                              <input type="file" name="8" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   id="filename" />
                           @endif
                        </div>
                     </td>
                     <td> <a href="" class="btn btn-danger btn-sm remove">X</a> </td>
                  </tr>
               </tbody>
            </table>
         </div>
         <div class="row mt-3 mx-0">
            <div class="col-md-6">
               <a href="{{ url('/customer/vehicle-detail') }}" class="btn btn-secondary btn-sm">{{ trans('button.back')}}</a>
            </div>
            <div class="col-md-6 text-right">
                  @if($vehicle->regapps['app_status_id'] != 4 &&  $vehicle->regapps['app_status_id'] != 3)
                   <button class="btn btn-success btn-sm " >{{ trans('button.save')}}</button>
                  @endif
            </div>
         </div>
      </form>
   </div>
   <!-- end edit document -->
   <!-- start tenant section -->
   
   <!-- end tenant section -->
</div>
</div>

@include('Module5.importvehicle.editDocFile')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('vrms2/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('vrms2/js/vehicle-datepicker.js') }}"></script>
<script type="text/javascript">
   var dist_url="{{url('/getdistrict/')}}";
   var get_vmodal="{{url('/getVmodel/')}}";
   var edit_doc = "{{url('/customer/edit-document')}}";
   var editImport = "{{ url('/customer/vehicle-detail') }}";
   $('.js-example-basic-single').select2();

   $(document).on("click", '.editDocument', function (e) { 
    $('[name="doc_type_id"]').val($(this).data('doc_type_id'));
    $('[name="vehicle_detail_id"]').val($(this).data('vehicle_detail_id'));
    $('#filearea').html($(this).data('filename'));
    document.getElementById("EditDoc").action = edit_doc;
  });

   //clear input file when click "X" for attached document
   $(document).on('click', '.remove', function(e){  
   e.preventDefault();
   $(this).closest("tr").find("td:eq(1) .filename").val('');
   $(this).closest("tr").find("td:eq(1) .filename_image").text('');
   $(this).closest("tr").find("td:eq(1) .old_file").val(0);
   }); 
   
    //update record for import
    $('.edit-form').on('click', function(e) {
	   e.preventDefault();
      var vehicle_kind = $('#updateForm #vehicle_kind_code').val();
      var owner_name = $('#updateForm #owner_name').val();
      var province = $('#updateForm #edit-province').val();
      var district = $('#updateForm #edit-district').val();
      var v_type = $('#updateForm .customer_vehicletype').val();
      var steer = $('#updateForm .steer').val();
      var gas = $('#updateForm .gas').val();
      var remark = $('#updateForm .remark').val();
      var cylinder = $('#updateForm .cylinder').val();
      var cc = $('#updateForm .cc').val();
      var color = $('#updateForm .color').val();
      var brand = $('#updateForm #edit-vbrand').val();
      var vmodel = $('#updateForm #edit-vmodel').val();
      var width = $('#updateForm .width').val();
      var long = $('#updateForm .long').val();
      var height = $('#updateForm .height').val();
      var seat = $('#updateForm #seat').val();
      var weight = $('#updateForm .weight').val();
      var weight_filled = $('#updateForm .weight_filled').val();
      var total_weight = $('#updateForm .total_weight').val();
      var axis = $('#updateForm .axis').val();
      var wheel = $('#updateForm .wheels').val();
      var year = $('#updateForm .date-year').val();
      var motor_brand_id = $('#updateForm .motor_brand_id').val();
      var import_permit_no = $('#updateForm .import_permit_no').val();
      var import_permit_date = $('#updateForm .import_permit_date').val();
      var industrial_doc_no = $('#updateForm .industrial_doc_no').val();
      var industrial_doc_date = $('#updateForm .industrial_doc_date').val();
      var technical_doc_no = $('#updateForm .technical_doc_no').val();
      var technical_doc_date = $('#updateForm .technical_doc_date').val();
      var comerce_permit_no = $('#updateForm .comerce_permit_no').val();
      var comerce_permit_date = $('#updateForm .comerce_permit_date').val();
      var tax_date = $('#updateForm .tax_date').val();
      var tax_no = $('#updateForm .tax_no').val();
      var tax_payment_no = $('#updateForm .tax_payment_no').val();
      var tax_payment_date = $('#updateForm .tax_payment_date').val();
      var police_doc_no = $('#updateForm .police_doc_no').val();
      var police_doc_date = $('#updateForm .police_doc_date').val();
      var engine_no = $('#updateForm .engine_no').val().replace(/\s/g, '');
      $('#updateForm .engine_no').val(engine_no);
      var chassis_no = $('#updateForm .chassis_no').val().replace(/\s/g, '');
      $('#updateForm .chassis_no').val(chassis_no);
      var license_no = $('#updateForm .license_no').val();
      var unit = $('#updateForm .unit').val();
      var vehicle_note = $('#updateForm .note').val();
      var vehicle_send = $('#updateForm .vehicle_send').val();
      var comerce_permit = $('#updateForm .comerce_permit').val();
      var old_license = $("#old-license").val();
      var old_engine = $("#old-engine").val();
      var old_chassis = $("#old-chassis").val();
      var village = $('#updateForm #customer_village').val();
      var save_type = $(this).val();
      var newLicense =  license_no.replace(/\s/g, '');
      var oldLicense = old_license.replace(/\s/g, '');
      var licenseArr = data.filter(function(e) { return e !== oldLicense });
      var engineArr = engineData.filter(function(e) { return e !== old_engine });
      var chassisArr = chassisData.filter(function(e) { return e !== old_chassis });
       
        if(license_no.trim() == '' ){
           alert($('#edit-license').attr('title'));
            $(".license_no").focus();
            return false;
           
        } else if(licenseArr.includes(newLicense)){
            alert('License no already taken.plz choose another one.');
            return false;
        } else if(vehicle_kind == null){
            alert($('#vehicle_kind_code').attr('title'));
            $("#vehicle_kind_code").focus();
            return false;
        } else if(owner_name.trim() == '' ){
            alert($('#owner_name').attr('title'));
            $("#owner_name").focus();
            return false;
        } else if(province == null ){
            alert($('#edit-province').attr('title'));
            $("#province").focus();
            return false;
        } else if(district == null ){
            alert($('#edit-district').attr('title'));
            $("#district").focus();
            return false;
        } else if(v_type == null ){
            alert($('.customer_vehicletype').attr('title'));
            $(".customer_vehicletype").focus();
            return false;
        } else if(cc.trim() == '' ){
            alert($('.cc').attr('title'));
            $(".cc").focus();
            return false;
        }else if(brand == null ){
            alert($('#edit-vbrand').attr('title'));
            $("#edit-vbrand").focus();
            return false;
        } else if(vmodel == null ){
            alert($('#edit-vmodel').attr('title'));
            $("#vmodel").focus();
            return false;
        } else if(engine_no.trim() == '' ){
            alert($('.engine_no').attr('title'));
            $('.engine_no').focus();
            return false;
        }else if(chassis_no.trim() == '' ){
            alert($('.chassis_no').attr('title'));
            $(".chassis_no").focus();
            return false;
        }else if(engineArr.includes(engine_no)){
            alert($('.engine_no').attr('title1'));
            return false;
        }else if(chassisArr.includes(chassis_no)){
            alert($('.chassis_no').attr('title1'));
            return false;
        } else if(v_type != 12 && width.trim() == '' ){
            alert($('.width').attr('title'));
            $(".width").focus();
            return false;
        } else if(v_type != 12 && long.trim() == ''){
            alert($('.long').attr('title'));;
            $(".long").focus();
            return false;
        } else if(v_type != 12 && height.trim() == '') {
            alert($('.height').attr('title'));
            $(".height").focus();
            return false;
        }  else if(weight.trim() == '' ){
            alert($('.weight').attr('title'));
            $(".weight").focus();
            return false;
        } else if(weight_filled.trim() == '' ){
            alert($('.weight_filled').attr('title'));
            $(".weight_filled").focus();
            return false;
        } else if(total_weight.trim() == '' ){
            alert($('.total_weight').attr('title'));
            $(".total_weight").focus();
            return false;
        } else if(axis.trim() == '' ){
            alert($('.axis').attr('title'));
           $(".axis").focus();
           return false;
         } else if(wheel.trim() == '' ){
            alert($('.wheels').attr('title'));
            $(".wheels").focus();
            return false;
        }else if(tax_no.trim() == '' ){
            alert($('.tax_no').attr('title'));
            $(".tax_no").focus();
            return false;
        }else if(tax_date.trim() == '' ){
            alert($('.tax_date').attr('title'));
            $(".tax_date").focus();
            return false;
        }else if(tax_payment_no.trim() == '' ){
            alert($('.tax_payment_no').attr('title'));
            $(".tax_payment_no").focus();
            return false;
        } else if(tax_payment_date.trim() == '' ){
            alert($('.tax_payment_date').attr('title'));
            $(".tax_payment_date").focus();
            return false;
        }  else {
      
          $.ajax({
              url: editImport +'/'+ $("#vehicleDetailId").val(),
              type: "PATCH",
              data: {
                _token: $("#updateForm input[name='_token']").val(),
                vehicle_kind_code: vehicle_kind,owner_name: owner_name,province_code: province,district_code: district,
                vehicle_type_id:v_type, steering_id:steer, gas_id:gas, remark:remark, cylinder:cylinder,
                cc:cc,color_id:color,brand_id:brand,model_id:vmodel,width:width,long:long, height:height,
                seat:seat,weight:weight,weight_filled:weight_filled,total_weight:total_weight,axis:axis,
                year_manufacture:year,motor_brand_id:motor_brand_id,import_permit_no:import_permit_no,
                import_permit_date:import_permit_date,industrial_doc_no:industrial_doc_no,industrial_doc_date:industrial_doc_date,
                technical_doc_no:technical_doc_no,technical_doc_date:technical_doc_date,comerce_permit_no:comerce_permit_no,
                comerce_permit_date:comerce_permit_date,tax_date:tax_date,tax_no:tax_no,tax_payment_no:tax_payment_no,
                tax_payment_date:tax_payment_date,police_doc_no:police_doc_no,police_doc_date:police_doc_date,
                engine_no:engine_no,chassis_no:chassis_no,licence_no_need:license_no,village_name:village, save_type:save_type,
                unit:unit, vehicle_send:vehicle_send, note: vehicle_note, comerce_permit:comerce_permit,wheels:wheel
              },
          
              success: function(response){
               var response = JSON.parse(response);
                  if(response.statusCode==200){
                      if(response.app_status == "submit"){
                        alert($("#success_submit").attr('title'));
                        $(".draft").addClass("disabled");
                      } else {
                        alert($("#success_msg").attr('title'));
                      }
                  } else if(response.statusCode==201){
                     alert(response.msg);
                  }
                  
              }
          });
        }
  });

</script>
<script src="{{ asset('vrms2/js/filevalidate.js') }}"></script>
<script src="{{ asset('vrms2/js/numvalidate.js') }}"></script>
<script type="text/javascript" src="{{asset('vrms2/js/dropdownlist.js')}}"></script>
<script src="{{ asset('vrms2/js/jquery-ui.js') }}"></script>
<script>
    // can move modal pop
    $('#newModal .modal-dialog, #editModal .modal-dialog, #showModal .modal-dialog').draggable({
         handle: ".modal-body, .modal-header"
      });
</script>

