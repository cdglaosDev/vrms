@extends('layouts.master')
@section('importer','active')
{{-- <link rel="stylesheet" type="text/css" href="{{asset('css/normalize.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('js/jquery.steps.css')}}">--}}
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
$app_status=\App\Model\ApplicationStatus::get();
$doc_type =\App\Model\ApplicationDocType::get();
$steer_id =\App\Model\Steering::get();
$staff = \App\Model\Staff::whereStatus(1)->get();
@endphp  
<script>
    $("#wizard").steps();
        </script>
     <div id="wizard">
<div class="panel panel-inverse">
   <div class="panel-body">
      <form id="form" action="{{route('appdetail-form.store')}}" method="post">
         @csrf
         <div class="form-row">
            <h3>Application Form</h3>
              <section>
                 
                        <div class="form-row">
                              <div class="col-md-4 col-sm-4 mb-3">
                                  <label for="">Date Request</label>
                                  <input type="date" class="date form-control" id="date_request" value="" placeholder="Enter " name="date_request" format="dd-mm-yyyy">
                              </div>
                              <div class="col-md-4 col-sm-4 mb-3">
                                  <label for="">Application Status</label>
                                  <select class="form-control selectpicker" id="status_id" data-live-search="true" name="status_id" required="" >
                                    <option value="" selected disabled hidden>--Select Application Status--</option>
                                    @foreach($app_status as $data)
                                    <option value="{{$data->id}}">{{ $data->name }}&nbsp;({{$data->name_en}})</option>
                                    @endforeach
                                 </select>
                              </div>
                              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Staff Name:</label>
                <select name="staff_approve_id"  class="form-control selectpicker" data-live-search="true" required="">
                  <option value="" selected disabled hidden>Select Staff Name </option>
                  @foreach($staff as $com)
                  <option value="{{$com->id}}">{{$com->name}}({{$com->name_en}})</option>
                  @endforeach
                </select>
              </div>
                              <div class="col-md-4 col-sm-4 mb-3">
                                  <label for="">App Number</label>
                                  <input type="text" class="form-control" id="app_number" value="" placeholder="Application Number" name="app_number" required="" >
                              </div>
                              <div class="col-md-4 col-sm-4 mb-3">
                                  <label for="">Regapp Number</label>
                                  <input type="text" class="form-control" id="regapp_number" value="" placeholder=" Enter Registration Application Number" name="regapp_number" required="">
                              </div>
                              <div class="col-md-4 col-sm-4 mb-3">
                                  <label for="comment">Comment:</label>
                                  <input type="text" class="form-control" id="comment" value="" placeholder="Enter Comment" name="comment" >
                              </div>
                              <div class="col-md-4 col-sm-4 mb-3">
                                  <label for="qr_code">QR Code:</label>
                                  <input type="text" class="form-control" id="qr_code" value="" placeholder="QR Code" name="qr_code" >
                              </div>
                        </div>
                        
                 
              </section>
            <h3>Vehicle Detail</h3>
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
                                 <label for="vehicle_purpose">Vehicle Purpose</label>
                                 <div class="input-group">
                                     <select class="form-control selectpicker" id="purpose_id" data-live-search="true" name="purpose_id" >
                                    <option value="" selected disabled hidden>--Select Purpose--</option>
                                    @foreach($purposes as $purpose)
                                    <option value="{{$purpose->id}}">{{ $purpose->name }}&nbsp;({{$purpose->name_en}})</option>
                                    @endforeach
                                  </select>
                                 </div>
                              </div>
                              <div class="col-md-3 col-sm-3 mb-3">
                               <label for="validationCustom01"> Owner Name:</label>
                                  <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Owner Name" name="owner_name" required="">
                                     </div>
                              <div class="col-md-3 col-sm-3 mb-3">
                                 <label for="validationCustom01">Tenant Name:</label>
                                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Tenant Name" name="tenant_name" required="">
                             </div>
                              <div class="col-md-3 col-sm-3 mb-3">
                              <label for="validationCustom01">Village Name:</label>
                                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Village Name" name="village_name" required="">
                                 </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">{{ trans('register.province')}}</label>
                                 <select class="form-control selectpicker" id="province_code" data-live-search="true" name="province_code"  >
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
                                 <select class="form-control selectpicker" data-live-search="true" name="steering_id" >
                                    @foreach($steer_id as $data)
                                    <option value="{{$data->id}}" >{{ $data->name }}({{$data->name_en}})</option>
                                    @endforeach
                                 </select>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustom02">{{ trans('register.vehicletype')}}()</label>
                                 <select class="form-control selectpicker" data-live-search="true" name="vehicle_type_id" >
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
                                    <select class="form-control selectpicker" data-live-search="true" name="brand_id" id="brand_id" >
                                       <option value="" selected disabled hidden  >--Select Vehicle Brand--</option>
                                       @foreach($brands as $brand)
                                       <option value="{{$brand->id}}" >({{$brand->name_en}})</option>
                                       @endforeach
                                    </select>
                                 </div>
                              </div>
                              
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustom01">{{ trans('register.color')}}</label>
                                 <select class="form-control selectpicker" data-live-search="true" name="color_id">
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
                                     <input type="text" name="import_permit_date" class="date form-control" placeholder="Select Permit Date" required="">  
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
                                    
                                    <input type="text" name="industrial_doc_date" class="date form-control" placeholder="Select Industrial Doc Date" required=""> 
                                 </div>
                              </div> 
                           </div>
                           <div class="form-row">
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustom01">Technical Doc No</label>
                                 <input type="text" class="form-control" id="technical_doc_no" name="technical_doc_no" placeholder="Enter Technical Doc No" value="">
                              </div>
                             
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">Technical Doc Date</label>
                                 <div class="input-group">
                                    
                                     <input type="text" name="technical_doc_date" class="date form-control" placeholder="Select Technical Doc Date" required=""> 

                                 </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">Commerce Permit No</label>
                                 <div class="input-group">
                                    <input type="text" class="form-control" id="comerce_permit_no" name="comerce_permit_no" placeholder="Enter Commerce Permit No" value="" aria-describedby="inputGroupPrepend" >
                                 </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">Commerce Permit Date</label>
                                 <div class="input-group">
                                   
                                     <input type="text" name="comerce_permit_date" class="date form-control" placeholder="Select Commerce Permit Date" required=""> 
                                 </div>
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustom01">Tax No</label>
                                 <input type="text" class="form-control" id="tax_no" name="tax_no" placeholder="Enter Tax No" value="">
                              </div>
                             
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">Tax Date</label>
                                 <div class="input-group">
                                    
                                     <input type="text" name="tax_date" class="date form-control" placeholder="Select Txa Date Date" required=""> 
                                 </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">Tax Payment No</label>
                                 <div class="input-group">
                                    <input type="text" class="form-control" id="tax_payment_no" name="tax_payment_no" placeholder=" Enter Tax Payment No" value="" aria-describedby="inputGroupPrepend" >
                                 </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">Tax Payment Date</label>
                                 <div class="input-group">
                                    <input type="date" class="date form-control" id="tax_payment_date" name="tax_payment_date" placeholder="" value="" aria-describedby="inputGroupPrepend" format="dd-mm-yyyy">
                                 </div>
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustom01">Police Doc No</label>
                                 <input type="text" class="form-control" id="police_doc_no" name="police_doc_no" placeholder="Enter Police Doc No" value="">
                              </div>
                             
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">Police Doc Date</label>
                                 <div class="input-group">
                                  
                                     <input type="text" name="police_doc_date" class="date form-control" placeholder="Select Police Doc Date" required=""> 
                                 </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">Vehicle Remark</label>
                                 <div class="input-group">
                                    <input type="text" class="form-control" id="remark" name="remark" placeholder="Enter Remark" value="" aria-describedby="inputGroupPrepend" >
                                 </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="validationCustomUsername">date time Update</label>
                                 <div class="input-group">
                                    
                                     <input type="text" name="datetime_update" class="date form-control" placeholder="Select Date Time Date" required=""> 
                                 </div>
                              </div>
                           </div> 
                         
                       
              </section>
             
            <h3>Application Document</h3>
              <section>
           <table  class="table table-bordered" id="app-document"> 
          <thead>
            <tr>
                <th style="width: 20%">Document Type</th>
                  <th style="width: 30%">Document link</th>
                   <th style="width: 20%">Document Date</th>
                <th style="width: 20%">Document Filename</th>
                
                <th>Action</i>
       </th>
            </tr>
            </thead> 
            <tr id="test">  
                <td>
                  <div class="form-group doc_type">
                  <select name="doc_type_id" class="form-control" >
                    <option value="" selected disabled hidden>Select Document Type </option>
                     @foreach($doc_type as $data)
                    <option value="{{$data->id}}">{{$data->name}}</option>
                    @endforeach
                  </select>
                </div>
                </td>
                <td>
                    <div class="form-group doc_link">
                 <input type="text" class="form-control"  value="" placeholder="Enter Link" name="link">
             </div>
                </td> 
                <td>
                    <div class="form-group doc_date">
                 <input type="date" class="form-control"  value="" placeholder="Enter Doc Link" name="date" >
             </div>
                </td> 
                  
                <td><div class="form-group filename">
                    <input type="text" name="filename" placeholder="Please Enter File"  class="form-control " required="" /></div></td>  
                <td><button type="button" name="add" id="add" class="btn btn-success"><i class="fas fa-plus"> </button></td>
               
            </tr>  
        </table> 
       
                
              </section>
         </div>
          <button type="submit" class="btn btn-success">Save</button>
      </form>
   </div>
</div>
@endsection

@push('page_scripts')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  </script>
     <script type="text/javascript" src="{{asset('js/jquery.steps.min.js')}}"></script> 
        <script type="text/javascript" src="{{asset('js/jquery.steps.js')}}"></script>

       
         <script type="text/javascript">
    
    $("#add").click(function(){
    var doc_type = '<div class="form-group">'+$('.doc_type').html()+'</div>';
     var doc_link = '<div class="form-group">'+$('.doc_link').html()+'</div>';
     var doc_date = '<div class="form-group ">'+$('.doc_date').html()+'</div>';
    var filename = '<div class="form-group ">'+$('.filename').html()+'</div>';
    
    $("#app-document").append(
      '<tr>'+
      '<td>'+ doc_type + '</td>'+
        '<td>'+ doc_link + '</td>'+
       '<td>'+ doc_date + '</td>'+
      '<td>'+ filename + '</td>'+
      
      
      '<td><button type="button" class="btn btn-danger remove-tr"><i class="fas fa-minus"></i></button></td>'+
      '</tr>'
    );
       
    });
   
    $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
    }); 

   
</script>
@endpush
