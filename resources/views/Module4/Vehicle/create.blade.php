@extends('layouts.master')
@section('vims','active')
@section('content') 
<style>
    .nav-pills .nav-link, .nav-pills>li>a{
        border: 1px solid !important;
        padding: 10px !important;
    }
</style>
    <h1 class="page-header">New Vehicle</h1>
  <div class="panel panel-inverse">
  
    <div class="panel-body">
    <form  action="{{route('vehicle.store')}}"  method="POST">
                  @method('post')
                      @csrf
         
        <ul  class="nav nav-pills">
            <li class="active"><a href="#vehicle" data-toggle="tab">New Vehicle</a>
			</li>
			<li >
            <a  href="#document" data-toggle="tab">Tab Document</a>
			</li>
			<li><a href="#history" data-toggle="tab">Tab History of log activity</a>
			</li>
			
		</ul>

			<div class="tab-content mb-3 clearfix">
           
			  <div class="tab-pane" id="document">
              <table  class="table table-bordered bg-default text-white" style="width:100%">
                    <thead>
                        <th>No</th>
                        <th>Document Type</th>
                        <th>Document Files</th>
                        <th>By staff</th>
                        <th>Last Update</th>
                        <th>Action</th>
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
          
         
            <div class="form-row">
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">{{ trans('module4.division_number') }}:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>

                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">{{ trans('module4.province_number') }}:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">{{ trans('module4.license_no') }}:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01"> {{ trans('module4.owner_name') }}:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01"> Tenant Name:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">{{ trans('module4.vehicle_kind') }}:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">{{ trans('module4.vehicle_type') }}:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>

                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">{{ trans('common.province') }}:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">{{ trans('common.district') }}:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">{{ trans('module4.village_name') }}:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">{{ trans('module4.brand') }}:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">{{ trans('module4.model') }}:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">{{ trans('module4.color') }}:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>

                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Sub Color:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">{{ trans('module4.steering') }}:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Gas:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">{{ trans('module4.motor_brand') }}:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">{{ trans('module4.engine_no') }}:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">{{ trans('module4.chassis_no') }}:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">{{ trans('module4.year_mnf') }}:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">{{ trans('module4.width') }}:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Height:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Long:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Weight:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Total Weight:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Seat:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Wheels:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Issue Date:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Expire Date:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Lock:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">View:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-12 col-sm-12 mb-3">
                    <label for="validationCustom01">Remark:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                </div>
                <hr style="width: 100%">

                <h4>Vehicle Detail</h4>

                <div class="form-row">
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Import Permit No:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Industrial Doc No:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Technical Doc No:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Commerce Permit No:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Tax No:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Import Permit Data:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Police Doc No:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Improt Permit hsny:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Tax receipt:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Tax payment Date:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Polic Doc Date:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Import permit Invest:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Tax Permit:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                    </div>
                    <div class="col-md-2 col-sm-2 mb-3">
                       
                        <input type="checkbox" class="form-check-input" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                        <label for="validationCustom01">Tax 10 *40:</label>
                    </div>
                    <div class="col-md-2 col-sm-2 mb-3">
                         <input type="checkbox" class="form-check-input" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                         <label for="validationCustom01">Tax 12:</label>
                    </div>
                    <div class="col-md-2 col-sm-2 mb-3">
                         <input type="checkbox" class="form-check-input" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                         <label for="validationCustom01">Tax Exem:</label>
                    </div>
                    <div class="col-md-2 col-sm-2 mb-3">
                        <input type="checkbox" class="form-check-input" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                        <label for="validationCustom01">Tax 50:</label>
                    </div>
                    <div class="col-md-3 col-sm-3 mb-3">
                        <label for="validationCustom01">Text:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                    </div>

                </div>
                <div class="form-row">
                <div class="col-md-8 col-sm-8">
                <!-- <a class="col-md-2 btn  btn-default" href="#">Book</a>
                <a class=" col-md-2 btn  btn-default" href="#">Card</a>
                <a class="col-md-2  btn  btn-default" href="#">Pink Paper</a>
                <a class="col-md-2  btn  btn-default" href="#">Certificate</a>
                <button type="submit" class="col-md-2  btn btn-default">Transfer</button> -->
                </div>
                <div class="col-md-4 col-sm-4 text-right">

                <a class="btn  btn-secondary btn-sm" href="#">{{trans('button.cancel')}}</a>
                <button type="submit" class="btn btn-success btn-sm">{{trans('button.save')}}</button>
                </div>
                </div>
			</div>
               
			</div>
 
            </div>
       
            </form>
    </div>
  </div>
  </div>

@include('delete')
 @endsection 
 @push('page_scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
@endpush
