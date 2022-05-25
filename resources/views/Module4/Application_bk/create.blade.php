@extends('layouts.master')
@section('vims','active')
@section('content') 

<style>
    .nav-pills .nav-link, .nav-pills>li>a{
        border: 1px solid !important;
        padding: 10px !important;
    }
</style>
    <h1 class="page-header">New Application Form</h1>
  <div class="panel panel-inverse">
  
    <div class="panel-body">
    <form  action="{{route('application.store')}}"  method="POST" enctype="multipart/form-data">
                  @method('post')
                      @csrf
         
                <ul  class="nav nav-pills">
            <li class="active"><a href="#vehicle" data-toggle="tab">Vehicle Info</a>
			</li>
			<li >
            <a  href="#document" data-toggle="tab">Tab Document</a>
			</li>
			<li><a href="#history" data-toggle="tab">Tab History of log activity</a>
			</li>
			
		</ul>

			<div class="tab-content mb-3 clearfix">
           
			  <div class="tab-pane" id="document">
              <table class="table table-bordered" id="app-document"> 
            <thead>
              <tr>
                <th>Document Type</th>
                <th>Document Filename</th>
               
                <th><button type="button" name="add" id="add" class="btn btn-success"><i class="fas fa-plus"></i>
                    </button></th>
              </tr>
            </thead> 
              <tr id="test">  
                <td>
                  <div class="form-group doc_type">
                  <select name="doc_type_id[]" class="form-control " required="">
                    <option value="" selected disabled hidden>Select Document Type </option>
                     @foreach($data['doc_type'] as $doc)
                    <option value="{{$doc->id}}">{{$doc->name}}</option>
                    @endforeach
                  </select>
                </div>
                </td>  
                <td><div class="form-group filename">
                  <input type="file" name="filename[]"  class="form-control " required="" /></div>
                </td>  
                
               
              </tr>  
          </table> 
				</div>
				<div class="tab-pane" id="history">
                <table  class="table table-bordered bg-default text-white" style="width:100%">
                    <thead>
                        <th>No</th>
                        <th>Field Name</th>
                        <th>Old data</th>
                        <th>New Data</th>
                        <th>Update By</th>
                        <th>Update times</th>
                    </thead>
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
            <div class="tab-pane active" id="vehicle">
            <h2>Application Form</h2>
            <div class="form-row">
            <div class="col-md-2 col-sm-2 mb-3">
                    <label for="validationCustom01">App  Number:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="{{\App\Helpers\getData::getAppNumber()}}" placeholder="" name="app_no" readonly>
                </div>
                <div class="col-md-2 col-sm-2 mb-3">
                    <label for="validationCustom01">Date:</label>
                    <input type="text" class="date form-control" id="validationCustom01" value="{{date('Y-m-d')}}" placeholder="" name="date_request" required="">
                </div>
                <div class="col-md-2 col-sm-2 mb-3">
                    <label for="validationCustom01">Customer Name:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Customer" name="customer_name" required="">
                </div>
                <div class="col-md-2 col-sm-2 mb-3">
                    <label for="validationCustom01">App Form Status:</label> 
                    <select name="app_status_id" class="form-control" required>
                        <option value="" selected disabled>Select Application status</option>
                        @foreach($data['app_status'] as $status)
                        <option value="{{$status->id}}">{{ $status->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 col-sm-2 mb-3">
                    <label for="validationCustom01">Application Type:</label>
                  
                    <input type="text" class="form-control" id="validationCustom01" value="registration" placeholder="" name="" readonly>
               
                </div>
                <div class="col-md-2 col-sm-2 mb-3">
                    <label for="validationCustom01">Vehicle Licence:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Licence No" name="division_no" >
                </div>
                <div class="col-md-2 col-sm-2 mb-3">
                    <label for="validationCustom01">Division Number:</label>
                    
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Division Number" name="division_no" >
                </div>
                <div class="col-md-2 col-sm-2 mb-3">
                    <label for="validationCustom01">Province Number:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Province Number" name="division_no">
                </div>
                <div class="col-md-2 col-sm-2 mb-3">
                    <label for="validationCustom01">Vehicle Type:</label>
                    <select name="vehicle_type_id" class="form-control" >
                        <option value="" selected disabled>Select Vehicle Type</option>
                        @foreach($data['types'] as $type)
                        <option value="{{$type->id}}">{{ $type->name}}</option>
                        @endforeach
                    </select>
                     </div>
                <div class="col-md-2 col-sm-2 mb-3">
                    <label for="validationCustom01">Category Name:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="enter vehicle category" name="division_no" >
                </div>
                <div class="col-md-2 col-sm-2 mb-3">
                    <label for="validationCustom01">Engine No:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Engine Number" name="division_no" >
                </div>
                <div class="col-md-2 col-sm-2 mb-3">
                    <label for="validationCustom01">Chaasis No:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Chaasis no" name="division_no" >
                </div>
                <div class="col-md-2 col-sm-2 mb-3">
                    <label for="validationCustom01">Province Name:</label>
                    <select name="province_code" class="form-control" required>
                        <option value="" selected disabled>Select Province</option>
                        @foreach($data['provinces'] as $pro)
                        <option value="{{$pro->id}}">{{ $pro->name}}</option>
                        @endforeach
                    </select>
                    
                </div>
                <div class="col-md-2 col-sm-2 mb-3">
                    <label for="validationCustom01">District Name:</label>
                    <select name="district_code" class="form-control" required>
                        <option value="" selected disabled>Select District</option>
                        @foreach($data['districts'] as $dist)
                        <option value="{{$dist->id}}">{{ $dist->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 col-sm-2 mb-3">
                    <label for="validationCustom01">Village Name:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter village name" name="division_no" required="">
                </div>
                <div class="col-md-2 col-sm-2 mb-3">
                    <label for="validationCustom01">Brand:</label>
                    <select name="brand_id" class="form-control" required>
                        <option value="" selected disabled>Select Brand</option>
                        @foreach($data['brands'] as $brand)
                        <option value="{{$brand->id}}">{{ $brand->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 col-sm-2 mb-3">
                    <label for="validationCustom01">Model:</label>
                    <select name="model_id" class="form-control" required>
                        <option value="" selected disabled>Select Model</option>
                        @foreach($data['models'] as $mod)
                        <option value="{{$mod->id}}">{{ $mod->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 col-sm-2 mb-3">
                    <label for="validationCustom01">Staff Name:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="{{auth()->user()->name}}" name="staff_id" readonly>
                </div>
                <div class="col-md-6 col-sm-6 mb-3">
                    <label for="validationCustom01"> Note:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Note" name="note" >
                </div>
                <div class="col-md-6 col-sm-6 mb-3">
                    <label for="validationCustom01"> Comment:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Comment" name="comment" >
                </div>


            </div>
            <hr />
            <h2>Vehicle Information</h2>
            <div class="form-row">
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Division No:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter division no" name="division_no" required="">
                </div>

                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Province No:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Province no" name="province_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">License No:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter licence no" name="licence_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01"> Owner Name:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter owner name" name="owner_name" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01"> Tenant Name:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter tenant name" name="tenant_name" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Vehicle Kind:</label>
                    <select name="vehicle_kind_id" class="form-control" required>
                        <option value="" selected disabled>Select Vehicle Kind</option>
                        @foreach($data['kinds'] as $kind)
                        <option value="{{$kind->id}}">{{ $kind->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Vehicle Type:</label>
                    <select name="vehicle_type_id" class="form-control" required>
                        <option value="" selected disabled>Select Vehicle Type</option>
                        @foreach($data['types'] as $type)
                        <option value="{{$type->id}}">{{ $type->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Province:</label>
                    <select name="province_code" class="form-control" required>
                        <option value="" selected disabled>Select Province Name</option>
                        @foreach($data['provinces'] as $pro)
                        <option value="{{$pro->id}}">{{ $pro->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">District:</label>
                   
                    <select name="district_code" class="form-control" required>
                        <option value="" selected disabled>Select District</option>
                        @foreach($data['districts'] as $dist)
                        <option value="{{$dist->id}}">{{ $dist->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Village:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Village Name" name="village_name" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Brand:</label>
                    <select name="brand_id" class="form-control" required>
                        <option value="" selected disabled>Select Brand</option>
                        @foreach($data['brands'] as $brand)
                        <option value="{{$brand->id}}">{{ $brand->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Model:</label>
                    <select name="model_id" class="form-control" required>
                        <option value="" selected disabled>Select Model</option>
                        @foreach($data['models'] as $model)
                        <option value="{{$model->id}}">{{ $model->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Color:</label>
                    <select name="color_id" class="form-control" required>
                        <option value="" selected disabled>Select Color</option>
                        @foreach($data['colors'] as $color)
                        <option value="{{$color->id}}">{{ $color->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Sub Color:</label>
                    <select name="sub_color_id" class="form-control" required>
                        <option value="" selected disabled>Select Color</option>
                        @foreach($data['colors'] as $color)
                        <option value="{{$color->id}}">{{ $color->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Steering:</label>
                    <select name="steering_id" class="form-control" >
                        <option value="" selected disabled>Select Sterring</option>
                        @foreach($data['steerings'] as $ster)
                        <option value="{{$ster->id}}">{{ $ster->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Gas:</label>
                    <select name="gas_id" class="form-control" >
                        <option value="" selected disabled>Select Gas</option>
                        @foreach($data['gases'] as $gas)
                        <option value="{{$gas->id}}">{{ $gas->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Motor Brand:</label>
                    <select name="moter_brand_id" class="form-control" >
                        <option value="" selected disabled>Select Motor Brand</option>
                        @foreach($data['moter_brand'] as $moter)
                        <option value="{{$moter->id}}">{{ $moter->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Engine No:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter engine no" name="engine_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Chaasis No:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Chassis no" name="chassis_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Year Manufacture:</label>
                    <input type="text" class="date form-control" id="validationCustom01" value="" placeholder="Enter year manfacture" name="year_manufacture" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Width:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter width" name="width" >
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Height:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter heigt" name="height" >
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Long:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter long" name="long" >
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Weight:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter weight" name="weight" >
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Total Weight:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter total weight" name="total_weight" >
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Seat:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter seat" name="seat" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Wheels:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter wheels" name="wheels" >
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Issue Date:</label>
                    <input type="text" class="date form-control" id="validationCustom01" value="" placeholder="Choose issue date" name="issue_date" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Expire Date:</label>
                    <input type="text" class="date form-control" id="validationCustom01" value="" placeholder="choose expire date" name="expire_date" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3 pt-4 pl-5">
                         <input type="checkbox" class="form-check-input" id="validationCustom01" value="" placeholder="" name="lock" >
                         <label for="validationCustom01">Lock:</label>
                </div>
                <div class="col-md-3 col-sm-3 mb-3 pt-4 pl-5">
                         <input type="checkbox" class="form-check-input" id="validationCustom01" value="" placeholder="" name="view" >
                         <label for="validationCustom01">View:</label>
                </div>
                <div class="col-md-12 col-sm-12 mb-3">
                    <label for="validationCustom01">Remark:</label>
                    <textarea class="form-control" id="validationCustom01" row="5" cols="5" placeholder="Enter remark" name="remark"></textarea>
                  
                </div>
                </div>
                <hr style="width: 100%">

                <h2>Vehicle Detail</h2>

                <div class="form-row">
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Import Permit No:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter import permit no" name="import_permit_no" required="">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Industrial Doc No:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Industrial doc no" name="industrial_doc_no" required="">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Technical Doc No:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter technical doc no" name="technical_doc_no" required="">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Commerce Permit No:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter commerce permit no" name="comerce_permit_no" required="">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Tax No:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter tax no" name="tax_no" required="">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Import Permit Date:</label>
                        <input type="text" class="date form-control" id="validationCustom01" value="" placeholder="Enter import permit date" name="import_permit_date" required="">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Police Doc No:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter polic doc no" name="police_doc_no" >
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Improt Permit hsny:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter import permit hsny" name="import_permit_hsny" >
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Tax receipt:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter tax receipt" name="tax_receipt" >
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Tax payment Date:</label>
                        <input type="text" class="date form-control" id="validationCustom01" value="" placeholder="choose tax payment date" name="tax_payment_date" >
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Polic Doc Date:</label>
                        <input type="text" class="date form-control" id="validationCustom01" value="" placeholder="Enter polic doc date" name="police_doc_date" >
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Import permit Invest:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Import Permit invest" name="import_permit_invest" >
                    </div>
                   
                    <div class="col-md-3 col-sm-3 mb-3 pl-4">
                       
                        <input type="checkbox" class="form-check-input" id="validationCustom01" value="" placeholder="" name="tax_10_40" >
                        <label for="validationCustom01">Tax 10 *40:</label>
                    </div>
                    <div class="col-md-2 col-sm-2 mb-3">
                         <input type="checkbox" class="form-check-input" id="validationCustom01" value="" placeholder="" name="tax_12" >
                         <label for="validationCustom01">Tax 12:</label>
                    </div>
                    <div class="col-md-2 col-sm-2 mb-3">
                         <input type="checkbox" class="form-check-input" id="validationCustom01" value="" placeholder="" name="tax_exam" >
                         <label for="validationCustom01">Tax Exem:</label>
                    </div>
                    <div class="col-md-2 col-sm-2 mb-3">
                        <input type="checkbox" class="form-check-input" id="validationCustom01" value="" placeholder="" name="tax_50" >
                        <label for="validationCustom01">Tax 50:</label>
                    </div>
                    <div class="col-md-4 col-sm-4 mb-6">
                        <label for="validationCustom01">Tax Permit:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter tax permit" name="tax_permit" >
                    </div>
                    <div class="col-md-8 col-sm-8 mb-7">
                        <label for="validationCustom01">Text:</label>
                       <textarea name="text" class="form-control" cols="5" row="5" placeholder="Enter Text"></textarea>
                    </div>

                </div>
                <div class="form-row mt-3">
                <div class="col-md-8 col-sm-8">
                <!-- <a class="col-md-2 btn  btn-default" href="#">Book</a>
                <a class=" col-md-2 btn  btn-default" href="#">Card</a>
                <a class="col-md-2  btn  btn-default" href="#">Pink Paper</a>
                <a class="col-md-2  btn  btn-default" href="#">Certificate</a>
                <button type="submit" class="col-md-2  btn btn-default">Transfer</button> -->
                </div>
                <div class="col-md-4 col-sm-4 text-right">

                <a class="btn  btn-secondary" href="#">{{trans('button.cancel')}}</a>
                <button type="submit" class="btn btn-success">{{trans('button.save')}}</button>
                </div>
                </div>
			</div>
               
			</div>
 
            </div>
       
            </form>
    </div>
  </div>
  </div>


 @endsection 
 @push('page_scripts')
<script src="{{asset('js/app_doc.js')}}"></script>
@endpush
 
