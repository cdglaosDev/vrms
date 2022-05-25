@extends('layouts.master')
    @section('vims','active')
    @section('content') 
    @php
$kinds = \App\Model\VehicleKind::whereStatus(1)->get();
$brands = \App\Model\VehicleBrand::whereStatus(1)->get();
$all_brands = \App\Model\VehicleBrand::whereStatus(1)->pluck('name')->toArray();
$types = \App\Model\VehicleType::whereStatus(1)->get();
$all_types = \App\Model\VehicleType::whereStatus(1)->pluck('name')->toArray();
$models = \App\Model\VehicleModel::whereStatus(1)->get();
$all_models = \App\Model\VehicleModel::whereStatus(1)->pluck('name')->toArray();
$pros = \App\Model\Province::whereStatus(1)->get();
$eng_type = \App\Model\EngineBrand::whereStatus(1)->get();
$dists = \App\Model\District::whereStatus(1)->get();
$color = \App\Model\Color::whereStatus(1)->get();
$color_names = \App\Model\Color::whereStatus(1)->pluck('name')->toArray();
$village = \App\Model\Village::whereStatus(1)->get();
$gases =\App\Model\Gas::get();
$purposes = \App\Model\VehiclePurpose::get();
$app_status = \App\Model\ApplicationStatus::whereStatus(1)->get();
$doc_type =\App\Model\ApplicationDocType::get();
$steer_id =\App\Model\Steering::get();
@endphp  
        <h1 class="page-header">Change Vehicle Information</h1>
    <div class="panel panel-inverse">
    @include('flash') 
        <div class="panel-body">
        <form action="{{url('search-licence')}}" method="get" class="mb-3">
            
            <div class="form-row">
                        
            <div class="col-md-3 col-sm-3">
            <input type="text" name="q" class="form-control" placeholder="Enter Licence Number">
            <input type="hidden" name="page" value="info">
            </div>
            <div class="col-md-3 col-sm-3">
            <input type="submit" class="btn btn-primary" value="Search">
            
            </div>
        </div>
        </form>
        <form id="form" action="{{route('vehicle-detail.store')}}" method="post">
         @csrf
         <div class="form-row">
          
             
          
              <section class="detail">
                           <div class="form-row">
                              <div class="col-md-3 mb-3">
                                 <label for="licence_no">Licence No</label>
                                 <input type="text" class="form-control" id="licence_no" name="licence_no"  placeholder="Enter Licence No." value="" >
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustom02">License No need</label>
                                 <input type="text" class="form-control" id="licence_no_need" name="licence_no_need"  placeholder="Enter Licence No." value="" >
                              </div>
                            
                              <div class="col-md-3 mb-3">
                                 <label for="owner_name">{{ trans('register.name')}} (Eng)</label>
                                 <div class="input-group">
                                    <input type="text" class="form-control" id="owner_name" placeholder="Enter Owner Name" value="" name="owner_name">
                                 </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="tenant_name">Tenant Name</label>
                                 <div class="input-group">
                                    <input type="text" class="form-control" id="tenant_name" placeholder="Enter Tenant Name" value="" name="tenant_name" >
                                 </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="village_name">Village name</label>
                                 <div class="input-group">
                                    <input type="text" class="form-control" id="village_name" placeholder="Enter Village" value="" name="village_name" >
                                 </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">{{ trans('register.province')}}</label>
                                 <select class="form-control" id="province_code"  name="province_code"  >
                                    <option value="" selected disabled hidden>--Select Province--</option>
                                    @foreach($pros as $pro)
                                    <option value="{{$pro->province_code}}">{{ $pro->name }}&nbsp;({{$pro->name_en}})</option>
                                    @endforeach
                                 </select>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustom02">{{ trans('register.district')}}</label>
                                 <select class="form-control" name="district_code" id="district_code" >
                                    <option value="" selected disabled hidden>--Select District--</option>
                                    @foreach($dists as $dist)
                                    <option value="{{$dist->district_code}}">{{$dist->name}}&nbsp;({{$dist->name_en}})</option>
                                    @endforeach
                                 </select>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">Gas</label>
                                  <select class="form-control " data-live-search="true" name="gas_id">
                                    <option value="" selected disabled hidden  >--Select Gas--</option>
                                    @foreach($gases as $gas)
                                    <option value="{{$gas->id}}" >{{ $gas->name }}&nbsp;({{$gas->name_en}})</option>
                                    @endforeach
                                 </select>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">{{ trans('register.swheel')}}</label>
                                 <select class="form-control"  name="steering_id" >
                                    @foreach($steer_id as $data)
                                    <option value="{{$data->id}}" >{{ $data->name }}({{$data->name_en}})</option>
                                    @endforeach
                                 </select>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustom02">{{ trans('register.vehicletype')}}()</label>
                                 <select class="form-control"  name="vehicle_type_id" >
                                    @foreach($types as $type)
                                    <option value="{{$type->id}}" >{{ $type->name }}({{$type->name_en}})</option>
                                    @endforeach
                                 </select>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">{{ trans('register.model')}}</label>
                                 <div class="input-group">
                                    <select class="form-control"  name="model_id" id="model_id" >
                                       <option value="" selected disabled hidden  >--Select Vehicle Model--</option>
                                       @foreach($models as $model)
                                       <option value="{{$model->id}}" >{{ $model->name }}({{$model->name_en}})</option>
                                       @endforeach
                                    </select>
                                 </div>
                              </div>
                           </div>
                  
                           
                           <div class="form-row">
                              
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">{{ trans('register.seats')}}</label>
                                 <input type="number" class="form-control" id="validationCustomUsername" placeholder="Number of Seats" name="seat"  value="" >
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">Year Manufacture</label>
                                 <input type="text" class="form-control" id="year_manufacture" placeholder="Number of Seats" name="year_manufacture"  value="" >
                              </div>
                               <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">{{ trans('register.make')}}</label>
                                 <div class="input-group">
                                    <select class="form-control"  name="brand_id" id="brand_id" >
                                       <option value="" selected disabled hidden  >--Select Vehicle Brand--</option>
                                       @foreach($brands as $brand)
                                       <option value="{{$brand->id}}" >({{$brand->name_en}})</option>
                                       @endforeach
                                    </select>
                                 </div>
                              </div>
                              
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustom01">{{ trans('register.color')}}</label>
                                 <select class="form-control"  name="color_id">
                                    <option value="" selected disabled hidden  >--Select Color--</option>
                                    @foreach($color as $co)
                                    <option value="{{$co->id}}" >{{ $co->name }}&nbsp;({{$co->name_en}})</option>
                                    @endforeach
                                 </select>
                              </div>
                              
                           </div>
                           <div class="form-row">
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustom01">{{ trans('register.width')}}</label>
                                 <input type="text" class="form-control" id="width" name="width" placeholder="Enter Width" value="" >
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustom02">{{ trans('register.height')}}</label>
                                 <input type="text" class="form-control" id="height" name="height" placeholder="Enter Height" value="" >
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">Long</label>
                                 <input type="text" class="form-control" id="long" placeholder="Enter Length" value="" name="long" >
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">Weight</label>
                                 <input type="text" class="form-control" id="weight" placeholder="Enter Length" value="" name="weight" >
                              </div>
                            
                           </div>
                           <div class="form-row">
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustom01">Total Weight</label>
                                 <input type="text" class="form-control" id="total_weight" name="total_weight"placeholder="Net weight" value="">
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">Engine Number</label>
                                 <div class="input-group">
                                    <input type="text" class="form-control" id="validationCustomUsername" name="cylinder" placeholder="Number of Cylinder" value="" aria-describedby="inputGroupPrepend" >
                                 </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">Chassis No</label>
                                 <div class="input-group">
                                    <input type="text" class="form-control" id="validationCustomUsername" name="cylinder" placeholder="Number of Cylinder" value="" aria-describedby="inputGroupPrepend" >
                                 </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">Motor Brand</label>
                                 <div class="input-group">
                                    <input type="text" class="form-control" id="validationCustomUsername" name="cylinder" placeholder="Number of Cylinder" value="" aria-describedby="inputGroupPrepend" >
                                 </div>
                              </div>
                              
                           </div>
                           <div class="form-row">
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustom01">Permit No</label>
                                 <input type="text" class="form-control" id="import_permit_no" name="import_permit_no" placeholder="Net weight" value="">
                              </div>
                             
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">Permit date</label>
                                 <div class="input-group">
                                    <input type="text" class="date form-control" id="import_permit_date" name="import_permit_date" placeholder="" value="" aria-describedby="inputGroupPrepend" format="dd-mm-yyyy">
                                 </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">Industrial Doc No</label>
                                 <div class="input-group">
                                    <input type="text" class="form-control" id="industrial_doc_no" name="industrial_doc_no" placeholder="" value="" aria-describedby="inputGroupPrepend" >
                                 </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">Industrial Doc Date</label>
                                 <div class="input-group">
                                    <input type="text" class="date form-control" id="industrial_doc_date" name="industrial_doc_date" placeholder="" value="" aria-describedby="inputGroupPrepend" format="dd-mm-yyyy">
                                 </div>
                              </div> 
                           </div>
                           <div class="form-row">
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustom01">Technical Doc No</label>
                                 <input type="text" class="form-control" id="technical_doc_no" name="technical_doc_no" placeholder="" value="">
                              </div>
                             
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">Technical Doc Date</label>
                                 <div class="input-group">
                                    <input type="text" class="date form-control" id="technical_doc_date" name="technical_doc_date" placeholder="" value="" aria-describedby="inputGroupPrepend" format="dd-mm-yyyy">
                                 </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">Commerce Permit No</label>
                                 <div class="input-group">
                                    <input type="text" class="form-control" id="comerce_permit_no" name="comerce_permit_no" placeholder="" value="" aria-describedby="inputGroupPrepend" >
                                 </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">Commerce Permit Date</label>
                                 <div class="input-group">
                                    <input type="text" class="date form-control" id="comerce_permit_date" name="comerce_permit_date" placeholder="" value="" aria-describedby="inputGroupPrepend" format="dd-mm-yyyy">
                                 </div>
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustom01">Tax No</label>
                                 <input type="text" class="form-control" id="tax_no" name="tax_no" placeholder="" value="">
                              </div>
                             
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">Tax Date</label>
                                 <div class="input-group">
                                    <input type="text" class="date form-control" id="tax_date" name="tax_date" placeholder="" value="" aria-describedby="inputGroupPrepend" format="dd-mm-yyyy">
                                 </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">Tax Payment No</label>
                                 <div class="input-group">
                                    <input type="text" class="form-control" id="tax_payment_no" name="tax_payment_no" placeholder="" value="" aria-describedby="inputGroupPrepend" >
                                 </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">Tax Payment Date</label>
                                 <div class="input-group">
                                    <input type="text" class="date form-control" id="tax_payment_date" name="tax_payment_date" placeholder="" value="" aria-describedby="inputGroupPrepend" format="dd-mm-yyyy">
                                 </div>
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustom01">Police Doc No</label>
                                 <input type="text" class="form-control" id="police_doc_no" name="police_doc_no" placeholder="" value="">
                              </div>
                             
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">Police Doc Date</label>
                                 <div class="input-group">
                                    <input type="text" class="date form-control" id="police_doc_date" name="police_doc_date" placeholder="" value="" aria-describedby="inputGroupPrepend" format="dd-mm-yyyy">
                                 </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">Vehicle Remark</label>
                                 <div class="input-group">
                                    <input type="text" class="form-control" id="remark" name="remark" placeholder="Remark" value="" aria-describedby="inputGroupPrepend" >
                                 </div>
                              </div>
                              <div class="col-md-12 col-sm-12 text-right">

                    <a class="btn  btn-secondary" href="#">{{trans('button.cancel')}}</a>
                    <button class="btn btn-success">{{trans('button.update')}}</button>
                    </div>
                              
                           </div> 
                         
                       
              </section>
            
        </div>
    </div>
    @include('delete')
    @endsection 

