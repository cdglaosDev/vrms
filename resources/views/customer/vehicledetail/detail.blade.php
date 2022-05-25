@php 
$doc_type =\App\Model\ApplicationDocType::get();
$appData = \App\Model\AppForm::whereAppNo($vehicle->regapps->app_number)->first();

@endphp
<style>
   #updateForm .col-sm-1,#updateForm .col-sm-1{
   padding-left:0px;
   padding-right:0px;
   margin-bottom: 0px;
   }
   @media screen {
   #printPaper { display: none; }
   }
</style>
<div class="modal-header" style="border-bottom:none; padding:1.15rem 1rem">
   <h3 style="margin-top:-8px; font-size: 19px; border-bottom:none">
      Import Vehicle App Number: <b>{{ $vehicle->regapps['app_number'] ?? '' }}</b>  Pre Registration App Number:<b> {{ $vehicle->regapps['regapp_number'] ?? ''}}</b>
      <ul class="nav nav-tabs pt-2" style="width: 104%">
         <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" aria-current="page" href="#appForm">{{ trans('app_form.app_form') }}</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="tab" aria-current="page" href="#vehDetail">ຂໍ້ມູນ</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#docDetail">ເອກະສານອ້າງອີງ</a>
         </li>
      </ul>
   </h3>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
</div>
<div class="modal-body pt-0">
   <div class="tab-content clearfix">
      <div class="tab-pane active" id="appForm">
         <table class="table table-bordered" style="width:auto;">
            <tbody>
               <tr>
                  <td width="200px">{{ trans('app_form.date_request') }}</td>
                  <td>{{$vehicle->regapps->date_request ?? ''}} </td>
               </tr>
               <tr>
                  <td width="200px">{{ trans('app_form.staff') }}</td>
                  <td> {{ $vehicle->regapps->user['name'] ?? '' }} </td>
               </tr>
               <tr>
                  <td width="200px">{{ trans('app_form.comment') }}</td>
                  <td> {{$vehicle->regapps->comment ?? ''}} </td>
               </tr>
               <tr>
                  <td width="200px">{{ trans('app_form.remark') }}</td>
                  <td> {{$vehicle->regapps->remark ?? ''}} </td>
               </tr>
               <tr>
                  <td width="300px">{{ trans('app_form.pre_app_no') }}</td>
                  <td>{{$vehicle->regapps->regapp_number ?? ''}} </td>
               </tr>
            </tbody>
         </table>
         <div class="row pt-4 pl-3">
            <a href="{{route('vehicle-detail.index')}}" class="btn btn-secondary btn-sm" type="submit">{{ trans('button.back') }}</a>&nbsp;&nbsp;&nbsp;&nbsp;
            @if($vehicle->regapps['app_status_id'] == 4)
            <a class="btn btn-info btn-sm print-link no-print mr-2 text-white printPaper" >{{ trans('button.print') }}</a>
            @endif
            @if($vehicle->regapps['app_status_id'] == 6)
            <a class="text-white btn btn-info btn-sm edit {{$vehicle->regapps['app_status_id'] ==4?'text-white btn btn-secondary btn-sm disabled':'text-white btn btn-info btn-sm edit'}} mr-3"
               data-toggle="modal" data-target="#editModel"
               data-act="edit"
               data-id="{{$vehicle->regapps->id ??''}}"
               data-staff_approve_id="{{$vehicle->regapps['staff_approve_id']}}"
               data-date_request="{{$vehicle->regapps->date_request}}"
               data-remark="{{$vehicle->regapps['remark']}}"
               data-comment="{{$vehicle->regapps['comment']}}"
               >{{ trans('button.edit') }} </a>
            @endif
         </div>
      </div>

      <!-- Start Edit Vehicle info -->
      <div class="tab-pane " id="vehDetail">
         <table class="form-table vehicle-form">
            <tbody>
               <tr>
                  <!-- first column -->
                  <td style="padding-right:0px; width: 334px;">
                     <b style="color:red !important;font-weight:bold">{{ trans('module4.division_number') }}<small>(ຂສ)</small>:</b> 
                        <input class="w150 nvt-focused"  value="" focus="0" f="222" disabled> 
                     <br>
                     <b style="color:red !important;font-weight:bold">{{ trans('module4.province_number') }}<small>(<span id="edit_province_abb">{{$vehicle->province->abb ??'' }}</span>)</small>:</b> 
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
                        <input class="w120 license_no"  style="vertical-align:top;text-align:center;color:#f00;font-weight:bold;font-size:18px !important" name="licence_no_need"  f="222" value="{{ $vehicle->licence_no_need}}" disabled><br>
                     <b>{{ trans('module4.purpose') }}:</b>
                        <select class="w120" f="222" name="vehicle_kind_code" id="vehicle_kind_code" disabled>
                           <option value="" selected disabled hidden>--Select Purpose--</option>
                           @foreach($data['kinds'] as $kind)
                           <option value="{{$kind->vehicle_kind_code}}" {{$kind->vehicle_kind_code== $vehicle->vehicle_kind_code?"selected":""}}>{{$kind->vehicle_kind_code}} {{ $kind->name }}</option>
                           @endforeach
                        </select>
                        ເອກະຊົນລາວ<br>
                     <b>{{ trans('module4.owner_name') }}:</b>
                        <input name="owner_name" id="owner_name" class="w200" f="222" value="{{ $vehicle->owner_name}}" disabled><br>
                        <div>
                        <div style="float: left;">
                           <b>{{ trans('module4.village_name') }}:</b>
                           <input style="margin-right: 5px;" name="village_name" class="w120" id="customer_village" value="{{ $vehicle->village_name}}">
                        </div>
                        <div>
                           <b style="width: 28px !important;">{{ trans('module4.vehicle_unit') }}:</b>
                           <input type="number" name="unit" class="w40 unit" id="unit" value="{{ $vehicle->unit?? ''}}">
                        </div>
                        </div>
                        <b>{{ trans('common.province') }}:</b>
                        <select name="province_code" id="province"  class="w120" disabled>
                           <option value="" selected disabled hidden>--Select Province--</option>
                           @foreach($data['provinces'] as $pro)
                           <option value="{{$pro->province_code}}" {{$pro->province_code==$vehicle->province_code?"selected":""}}>{{ $pro->name }}</option>
                           @endforeach
                        </select>
                    
                     <br>
                     <b>{{ trans('common.district') }}:</b> 
                        <select name="district_code" class="w120" id="district" disabled>
                           <option value="" selected disabled hidden>--Select District--</option>
                           @foreach($data['districts'] as $dist)
                           <option value="{{$dist->district_code}}" {{$dist->district_code==$vehicle->district_code?"selected":""}}>{{ $dist->name }}</option>
                           @endforeach
                        </select>
                     <br>
                     <b>{{ trans('module4.vehicle_type') }}:</b> 
                        <select class="w120" name="vehicle_type_id" id="customer_vehicletype" disabled>
                           <option value="" selected disabled hidden  >--{{ trans('vehicle.vehicle_type')}}--</option>
                           @foreach($data['types'] as $type)
                           <option value="{{$type->id}}" {{$type->id==$vehicle->vehicle_type_id?"selected":""}}>{{ $type->name }}</option>
                           @endforeach
                        </select>
                     <br/>
                     <b>{{ trans('module4.steering') }}:</b>
                        <select class="w120 steer" name="steering_id" disabled>
                        @foreach($data['steerings'] as $steer)
                        <option value="{{$steer->id}}" {{$vehicle->steering_id == $steer->id ?"selected":""}}>{{ $steer->name }}</option>
                        @endforeach
                        </select>
                     <br/>
                     <b>{{ trans('module4.gas') }}:</b> 
                        <select class="w120 gas" name="gas_id" disabled>
                           <option value="" selected disabled hidden>-- Select Gas--</option>
                           @foreach($data['gases'] as $gas)
                           <option value="{{ $gas->id}}" {{$vehicle->gas_id == $gas->id ?"selected":""}}>{{ $gas->name }}</option>
                           @endforeach
                        </select>
                     <br/>
                     <b>{{ trans('module4.vehicle_remark') }}:</b>
                     <input class="w180 f12 note" name="note" style=" width: 183px !important;" value="{{ $vehicle->note}}" f="222"><br>
                     <b>{{ trans('module4.vehicle_send') }}:</b> 
                     <input class="w120 vehicle_send" name="vehicle_send" value="{{ $vehicle->vehicle_send??'' }}"  f="222"><br>
                   
                  </td>
                  <!-- second column -->
                  <td style="padding-right:0px; width: 276px;">
                     <b>{{ trans('module4.cylinder')}}:</b> 
                        <input type="number" class="w120 cylinder" name="cylinder" f="222" min="0" value="{{$vehicle->cylinder}}" readonly><br>
                        <b>{{ trans('module4.cc') }}:</b> 
                        <input class="w120 cc" type="number" min="0" name="cc" f="222" value="{{$vehicle->cc ?? ''}}" readonly><br>
                        <b>{{ trans('module4.color') }}:</b> 
                        <select class="w120 color" name="color_id" disabled>
                           <option value="" selected disabled hidden  >--Select Color--</option>
                           @foreach($data['colors'] as $co)
                           <option value="{{$co->id}}" {{$vehicle->color_id == $co->id ?"selected":""}}> {{ $co->name }}</option>
                           @endforeach
                        </select>
                     <br/>
                     <b>{{ trans('module4.brand') }}:</b>  
                        <select class="w120" name="brand_id" id="vbrand" disabled>
                           <option value="" selected disabled hidden  >--Select Vehicle Brand--</option>
                           @foreach($data['brands'] as $brand)
                           <option value="{{$brand->id}}" {{$brand->id==$vehicle->brand_id?"selected":""}}>{{$brand->name}}</option>
                           @endforeach
                        </select>
                     <br/>
                     <b>{{ trans('module4.model') }}:</b>
                        <select class="w120" name="model_id" id="vmodel" disabled>
                           <option value="" selected disabled hidden  >--Select Vehicle Model--</option>
                           @foreach($data['models'] as $model)
                           <option value="{{$model->id}}" {{$model->id==$vehicle->model_id?"selected":""}}>{{$model->name}}</option>
                           @endforeach
                        </select>
                     <br/>
                     <span>{{ trans('module4.engine_no') }}:</span>
                     <input style="width:177px;font-size:16px !important;font-family:dev_font !important" name="engine_no"  class="eng-validate engine_no" value="{{$vehicle->engine_no}}" required><br>
                     <span>{{ trans('module4.chassis_no') }}:</span>
                     <input type="hidden" id="old-chassis" value="{{ $vehicle->chassis_no}}">
                     <input style="width:169px;font-size:16px !important;font-family:dev_font !important" name="chassis_no" class="eng-validate chassis_no" value="{{$vehicle->chassis_no}}" required><br>
                     <b>{{ trans('module4.width') }}:</b> 
                        <input type="number" min="0" class="w120 width" name="width" f="222" value="{{ $vehicle->width }}" readonly> <span style="color:#ddd">ມມ</span><br>
                     <b>{{ trans('module4.long') }}:</b> 
                        <input type="number" min="0" class="w120 long" name="long" f="222" value="{{$vehicle->long}}" readonly> <span style="color:#ddd">ມມ</span><br>
                     <b>{{ trans('module4.height') }}:</b>
                        <input type="number" min="0" class="w120 height" name="height" f="222" value="{{ $vehicle->height }}" readonly> <span style="color:#ddd">ມມ</span><br>
                     <b>{{ trans('module4.seat') }}:</b> 
                        <input type="number" min="1" id="seat"  class="w120" name="seat" f="222" value="{{ $vehicle->seat }}" readonly>
                     <span id="err1" style="display:none; color:red;font-size: 12px;">This input value is not less than 1.</span><br>
                     <b>{{ trans('module4.weight') }}:</b> 
                        <input class="w120 weight" type="number" min="0" name="weight" f="222" value="{{ $vehicle->weight }}" readonly><br>
                        <b>{{ trans('module4.weight_filled') }}:</b> 
                        <input class="w120 weight_filled" type="number" min="0" name="weight_filled" value="{{ $vehicle->weight_filled }}" f="222" readonly><br>
                        <b>{{ trans('module4.total_weight') }}:</b>
                        <input class="w120 total_weight" type="number" min="0" value="{{ $vehicle->total_weight }}" id="total_weight" name="total_weight" f="222" readonly><br>
                        <b>{{ trans('module4.axis') }}:</b>  
                        <input class="w20 axis" name="axis" f="222" type="number" min="0"  value="{{ $vehicle->axis }}" readonly>
                        <b class="w60" style="width: 60px !important">{{ trans('module4.wheel') }}:</b> 
                        <input class="w20 wheels" name="wheels" f="222" value="{{ $vehicle->wheels }}" id="wheel" readonly> <span id="err2" style="display:none; color:red;font-size: 12px;">This input value is not less than 1.</span><br>
                        <b>{{ trans('module4.year_mnf') }}:</b> 
                        <input class="w120 date-year" type="number"  name="year_manufacture" id="year_manufacture"  picktype="1" value="{{ $vehicle->year_manufacture }}" f="222" readonly><br>
                        <b>{{ trans('module4.motor_brand') }}:</b> 
                        <select class="w120 motor_brand_id" name="motor_brand_id" disabled>
                           <option value="" selected disabled hidden>--Motor Brand--</option>
                           @foreach($data['moter_brand'] as $mb)
                           <option value="{{$mb->id}}" {{$mb->id== $vehicle->motor_brand_id?"selected":""}}>{{ $mb->name }}</option>
                           @endforeach
                        </select>
                     <br/>
                     <div>
                     </div>
                  </td>
                  <!-- third column -->
                  <td style="padding-right:0px;  width: 234px;">
                     <span class="cDB">1. {{ trans('module4.import_permit') }}:</span><br>
                     <b>{{ trans('module4.hsny') }}:</b>  <input type="checkbox"  f="222" v="" disabled><br>
                     <b>{{ trans('module4.invest') }}:</b> <input type="checkbox" f="222" v="" disabled><br>
                     <b>{{ trans('module4.veh_mod4_no') }}:</b>
                        <input class="w120 import_permit_no" name="import_permit_no" f="222" value="{{ $vehicle->import_permit_no }}" readonly><br>
                     <b>{{ trans('module4.veh_mod4_date') }}:</b> 
                        <input class="w120 import_permit_date" id="import_permit_date" name="import_permit_date" value="{{ $vehicle->import_permit_date }}" f="222" readonly><br>
                     <span class="cDB">2. {{ trans('module4.indus_doc') }}:</span><br>
                     <b>{{ trans('module4.veh_mod4_no') }}:</b> 
                        <input class="w120 industrial_doc_no" name="industrial_doc_no" f="222" value="{{ $vehicle->industrial_doc_no }}" readonly><br>
                     <b>{{ trans('module4.veh_mod4_date') }}:</b> 
                        <input class="w120 industrial_doc_date" name="industrial_doc_date" id="industrial_doc_date" f="222" value="{{ $vehicle->industrial_doc_date }}" readonly><br>
                     <span class="cDB">3. {{ trans('module4.tech_doc') }}:</span><br>
                     <b>{{ trans('module4.veh_mod4_no') }}:</b> 
                        <input class="w120 technical_doc_no" name="technical_doc_no" f="222" value="{{ $vehicle->technical_doc_no }}" readonly><br>
                     <b>{{ trans('module4.veh_mod4_date') }}:</b> 
                        <input class="w120 technical_doc_date" name="technical_doc_date" id="technical_doc_date" f="222" value="{{ $vehicle->technical_doc_date }}" readonly><br>
                     <span class="cDB">4. {{ trans('module4.commerce_permit') }}:</span><br>
                     <b>{{ trans('module4.commerce_permit_title') }}:</b> 
                        <input class="w120"  f="222" readonly><br>
                     <b>{{ trans('module4.veh_mod4_no') }}:</b> 
                        <input class="w120 comerce_permit_no" name="comerce_permit_no" value="{{ $vehicle->comerce_permit_no }}" f="222" readonly><br>
                     <b>{{ trans('module4.veh_mod4_date') }}:</b> 
                        <input class="w120 comerce_permit_date" name="comerce_permit_date" id="comerce_permit_date" value="{{$vehicle->comerce_permit_date}}" f="222" readonly><br>
   
                  </td>
                  <!-- fourth column -->
                  <td style=" width: 270px;">
                     <span class="cDB">5. {{ trans('module4.tax') }}:</span>
                     <br>
                     <b>{{trans('module4.tax_10_40')}}:</b> <input type="checkbox" f="222" v="" disabled><br>
                     <b>{{trans('module4.tax_exam')}}:</b> <input type="checkbox" f="222" v="" disabled><br>
                     <b>{{ trans('module4.tax12') }}:</b> <input type="checkbox"  f="222" v="" disabled><br>
                     <b>{{ trans('module4.tax50') }}:</b> <input type="checkbox"  f="222" v="" disabled><br>
                     <b>{{ trans('module4.veh_mod4_no') }}:</b> 
                        <input class="w120 tax_no" name="tax_no" f="222" value="{{$vehicle->tax_no}}" readonly><br>
                     <b>{{ trans('module4.veh_mod4_date') }}:</b> 
                        <input class="w120 tax_date" name="tax_date" id="tax_date" f="222" value="{{$vehicle->tax_date}}" readonly><br>
                     <span class="cDB">6. {{ trans('module4.tax_payment') }}:</span><br>
                     <b>{{ trans('module4.tax_receipt') }}:</b> <input type="checkbox"  f="222" v="" disabled><br>
                     <b>{{ trans('module4.tax_permit') }}:</b> <input type="checkbox"  f="222" v="" disabled><br>
                     <b>{{ trans('module4.veh_mod4_no') }}:</b> 
                        <input class="w120 tax_payment_no" name="tax_payment_no" f="222" value="{{ $vehicle->tax_payment_no }}" readonly><br>
                     <b>{{ trans('module4.veh_mod4_date') }}:</b> 
                        <input class="w120 tax_payment_date" name="tax_payment_date" id="tax_payment_date" readonly f="222" value="{{$vehicle->tax_payment_date}}" ><br>
                     <span class="cDB">7. {{trans('module4.police_doc') }}:</span><br>
                     <b>{{ trans('module4.veh_mod4_no') }}:</b> 
                        <input class="w120 police_doc_no" name="police_doc_no" f="222" value="{{ $vehicle->police_doc_no }}" readonly><br>
                     <b>{{ trans('module4.veh_mod4_date') }}:</b> 
                        <input class="w120 police_doc_date" name="police_doc_date"  id="police_doc_date" value="{{ $vehicle->police_doc_date }}" f="222" readonly><br>
                     <span class="cDB">8. {{ trans('module4.note1') }}:</span><br>
                        <textarea name="remark" class="h40 nvt-focused" style="width:225px;color:red" value="{{ $vehicle->remark }}" f="222" readonly></textarea><br>
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
            <a href="{{route('import-vehicle.index')}}" class="btn btn-secondary btn-sm">{{ trans('button.back') }}</a>
         </div>
      </div>

   </div>
      <!-- end Edit Vehicle info -->
      <!-- Start edit document -->
      <div class="tab-pane" id="docDetail">
         <form action="{{url('/customer/attach-document', $vehicle->id)}}" id="myForm" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="vehicle_detail_id" value="{{ $vehicle->id }}">
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th>{{ trans('app_form.doc_type') }}</th>
                     <th>{{ trans('app_form.doc_filename') }}</th>
                     <th width="200">{{ trans('common.action') }}</th>
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
                           @if($app_doc[2])
                           <a href="{{asset('images/doc/'.$vehicle->regapps['regapp_number'].'/'.$app_doc[2])}}" target="_blank">{{$app_doc[2]}}</a>
                           @else
                           <input type="file" name="2" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"  />
                           @endif
                           @else
                           <input type="file" name="2" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"  />
                           @endif
                        </div>
                     </td>
                     <td>
                        @if(!empty($app_doc))
                           @if($app_doc[2])
                           
                           @if($vehicle->regapps['app_status_id'] != 4)
                           <a href="" data-filename ="{{ $app_doc[2] }}" data-doc_type_id ="2" data-vehicle_detail_id ="{{ $vehicle->id }}"  data-toggle="modal" data-target="#editDoc"  class="btn btn-info btn-sm editDocument">{{ trans('button.edit')}}</a>
                           @endif
                        
                           <a href="{{asset('images/doc/'.$vehicle->regapps['regapp_number'].'/'.$app_doc[2])}}" class="btn btn-primary btn-sm">{{ trans('button.view')}}</a>
                           @endif
                        @endif
                     </td>
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
                           @if($app_doc[5])
                           <a href="{{asset('images/doc/'.$vehicle->regapps['regapp_number'].'/'.$app_doc[5])}}" target="_blank">{{$app_doc[5]}}</a>
                           @else
                           <input type="file" name="5" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"  />
                           @endif
                           @else
                           <input type="file" name="5" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"  />
                           @endif
                        </div>
                     </td>
                     <td>  
                        @if(!empty($app_doc))
                           @if($app_doc[5])
                              @if($vehicle->regapps['app_status_id'] != 4)
                              <a href="" data-filename ="{{ $app_doc[5] }}" data-doc_type_id ="5" data-vehicle_detail_id ="{{ $vehicle->id }}"  data-toggle="modal" data-target="#editDoc"  class="btn btn-info btn-sm editDocument">{{ trans('button.edit')}}</a>
                           
                              @endif
                           <a href="{{asset('images/doc/'.$vehicle->regapps['regapp_number'].'/'.$app_doc[5])}}" class="btn btn-primary btn-sm">{{ trans('button.view')}}</a>
                           @endif
                        @endif
                     </td>
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
                              @if($app_doc[4])
                              <a href="{{asset('images/doc/'.$vehicle->regapps['regapp_number'].'/'.$app_doc[4])}}" target="_blank">{{$app_doc[4]}}</a>
                              @else
                              <input type="file" name="4" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   />
                              @endif
                           @else
                              <input type="file" name="4" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   />
                           @endif
                        </div>
                     </td>
                     <td>  
                        @if(!empty($app_doc))
                           @if($app_doc[4])
                              @if($vehicle->regapps['app_status_id'] != 4)
                              <a href="" data-filename ="{{ $app_doc[4] }}" data-doc_type_id ="4" data-vehicle_detail_id ="{{ $vehicle->id }}"  data-toggle="modal" data-target="#editDoc"  class="btn btn-info btn-sm editDocument">{{ trans('button.edit')}}</a>
                           
                              @endif
                           <a href="{{asset('images/doc/'.$vehicle->regapps['regapp_number'].'/'.$app_doc[4])}}" class="btn btn-primary btn-sm">{{ trans('button.view')}}</a>
                           @endif
                        @endif
                     </td>
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
                              @if($app_doc[3])
                              <a href="{{asset('images/doc/'.$vehicle->regapps['regapp_number'].'/'.$app_doc[3])}}" target="_blank">{{$app_doc[3]}}</a>
                              @else
                                 <input type="file" name="3" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   />
                              @endif
                           @else
                              <input type="file" name="3" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   />
                           @endif
                        </div>
                     </td>
                     <td> 
                        @if(!empty($app_doc))
                           @if($app_doc[3])
                              @if($vehicle->regapps['app_status_id'] != 4)
                                 <a href="" data-filename ="{{ $app_doc[3] }}" data-doc_type_id ="3" data-vehicle_detail_id ="{{ $vehicle->id }}"  data-toggle="modal" data-target="#editDoc"  class="btn btn-info btn-sm editDocument">{{ trans('button.edit')}}</a>
                           
                              @endif
                              <a href="{{asset('images/doc/'.$vehicle->regapps['regapp_number'].'/'.$app_doc[3])}}" class="btn btn-primary btn-sm">{{ trans('button.view')}}</a>
                           @endif
                        @endif
                     </td>
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
                              @if($app_doc[6])
                              <a href="{{asset('images/doc/'.$vehicle->regapps['regapp_number'].'/'.$app_doc[6])}}" target="_blank">{{$app_doc[6]}}</a>
                              @else
                                 <input type="file" name="6" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   />
                              @endif
                           @else
                              <input type="file" name="6" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   />
                           @endif
                        </div>
                     </td>
                     <td>  
                        @if(!empty($app_doc))
                           @if($app_doc[6])
                              @if($vehicle->regapps['app_status_id'] != 4)
                           
                                 <a href="" data-filename ="{{ $app_doc[6] }}" data-doc_type_id ="6" data-vehicle_detail_id ="{{ $vehicle->id }}"  data-toggle="modal" data-target="#editDoc"  class="btn btn-info btn-sm editDocument">{{ trans('button.edit')}}</a>
                           
                              @endif
                              <a href="{{asset('images/doc/'.$vehicle->regapps['regapp_number'].'/'.$app_doc[6])}}" class="btn btn-primary btn-sm">{{ trans('button.view')}}</a>
                           @endif
                        @endif
                     </td>
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
                              @if($app_doc[7])
                              <a href="{{asset('images/doc/'.$vehicle->regapps['regapp_number'].'/'.$app_doc[7])}}" target="_blank">{{$app_doc[7]}}</a>
                              @else
                                 <input type="file" name="7" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" "  />
                              @endif
                           @else
                              <input type="file" name="7" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" "  />
                           @endif
                        </div>
                     </td>
                     <td> 
                        @if(!empty($app_doc))
                           @if($app_doc[7])
                              @if($vehicle->regapps['app_status_id'] != 4)
                                 <a href="" data-filename ="{{ $app_doc[7] }}" data-doc_type_id ="7" data-vehicle_detail_id ="{{ $vehicle->id }}"  data-toggle="modal" data-target="#editDoc"  class="btn btn-info btn-sm editDocument">{{ trans('button.edit')}}</a>
                           
                              @endif
                              <a href="{{asset('images/doc/'.$vehicle->regapps['regapp_number'].'/'.$app_doc[7])}}" class="btn btn-primary btn-sm">{{ trans('button.view')}}</a>
                           @endif
                        @endif
                     </td>
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
                              @if($app_doc[8])
                              <a href="{{asset('images/doc/'.$vehicle->regapps['regapp_number'].'/'.$app_doc[8])}}" target="_blank">{{$app_doc[8]}}</a>
                              @else
                                 <input type="file" name="8" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"  />
                              @endif
                           @else
                              <input type="file" name="8" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"  />
                           @endif
                        </div>
                     </td>
                     <td>
                        @if(!empty($app_doc))
                           @if($app_doc[8])
                              @if($vehicle->regapps['app_status_id'] != 4)
                                 <a href="" data-filename ="{{ $app_doc[8] }}" data-doc_type_id ="8" data-vehicle_detail_id ="{{ $vehicle->id }}"  data-toggle="modal" data-target="#editDoc"  class="btn btn-info btn-sm editDocument">{{ trans('button.edit')}}</a>
                              @endif
                           <a href="{{asset('images/doc/'.$vehicle->regapps['regapp_number'].'/'.$app_doc[8])}}" class="btn btn-primary btn-sm">{{ trans('button.view')}}</a>
                           @endif
                        @endif
                     </td>
                  </tr>
               </tbody>
            </table>
            <div class="row  pt-4">
               <div class="col-md-6 text-left">
                  <a href="{{ url('/customer/vehicle-detail') }}" class="btn btn-secondary btn-sm" type="submit">{{ trans('button.back') }}</a>
               </div>
               
            </div>
         </form>
      </div>
      <!-- end edit document -->
      <!-- start tenant section -->
    
      <!-- end tenant section -->
   </div>
</div>
<!-- start print area -->
<div id="printPaper">
   @include('Module5.importvehicle.print',['data' => $appData,  'app_number'=> $vehicle->regapps['app_number']]) 
</div>
<!-- end print area -->
<!-- edit app form modal -->
@include('Module5.importvehicle.editDocFile')
@component('component.customer.editform',['vehicle'=>$vehicle])
@endcomponent
<!-- end edit app form modal -->

<script src="{{asset('vrms2/js/jquery_print.js')}}"></script>
<script>
  var edit_doc = "{{url('/customer/edit-document')}}";
  var pre_app = "{{ url('/customer/app-form-update') }}";
  
  $(document).on("click", '.edit', function (e) { 
    $('[name="id"]').val($(this).data('id'));
    $('[name="date_request"]').val($(this).data('date_request'));
    $('[name="staff_approve_id"]').val($(this).data('staff_approve_id'));
    $('[name="comment"]').val($(this).data('comment'));
    $('[name="remark"]').val($(this).data('remark'));
    document.getElementById("editform").action = pre_app+"/"+$(this).data('id');
  });
  
  $(document).on("click", '.editDocument', function (e) { 
    $('[name="doc_type_id"]').val($(this).data('doc_type_id'));
    $('[name="vehicle_detail_id"]').val($(this).data('vehicle_detail_id'));
    $('#filearea').html($(this).data('filename'));
    document.getElementById("EditDoc").action = edit_doc;
  });
 
  
</script>
<script src="{{ asset('vrms2/js/filevalidate.js') }}"></script>