@extends('layouts.master')
@section('vims','active')
@section('content') 
<style>
    .nav-pills .nav-link, .nav-pills>li>a{
        border: 1px solid !important;
        padding: 10px !important;
    }
</style>
    <h1 class="page-header">Application Form</h1>
  <div class="panel panel-inverse">
  
    <div class="panel-body">
       <form  action="{{route('application-form.store')}}"  method="POST">
                  @method('post')
                      @csrf
         
         
            <div class="form-row">
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">App Request No:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>

                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Date Request:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
               
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01"> Customer Name:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">App Type:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">App Purpose:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
               
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Staff Name:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Note:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Comment:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Qr Code:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                
                </div>
                <div class="form-row">
                <div class="col-md-8 col-sm-8">
                
                </div>
                <div class="col-md-4 col-sm-4 text-right">

                <a class="btn  btn-secondary" href="#">{{trans('button.cancel')}}</a>
                <button type="submit" class="btn btn-success">{{trans('button.save')}}</button>
                </div>
                </div>
            </div>
            <hr style="width: 100% ;color:#000" class="mb-3">
                <ul  class="nav nav-pills">
         
			<li class="active">
            <a  href="#1a" data-toggle="tab">Tab Application Detail</a>
			</li>
			<li><a href="#2a" data-toggle="tab">Tab Vehicle</a>
			</li>
			<li><a href="#3a" data-toggle="tab">Tab Vehilce Technical</a>
			</li>
  		    <li><a href="#4a" data-toggle="tab">Document</a>
            </li>
            <li><a href="#5a" data-toggle="tab">History of Application Form</a>
			</li>
		</ul>

			<div class="tab-content mb-3 clearfix">
           
			  <div class="tab-pane active" id="1a">
              <table  class="table table-bordered bg-default text-white" style="width:100%">
                    <thead>
                        <th>No</th>
                        <th>Note</th>
                        <th>By staff</th>
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
				<div class="tab-pane" id="2a">
                <div class="form-row">
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01"> Tenant Name:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01"> Owner Name:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
              
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Issue Date:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-2 col-sm-2 mb-3">
                    <label for="validationCustom01">Expire Date:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-1 col-sm-2 mb-1">
                   <div class="form-check">
                   <input type="checkbox" class="form-check-input" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                    <label for="validationCustom01">Lock Transfer:</label>
                   </div>
                   
                </div>

                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Vehicle Licence:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Division No:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Province No:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Vehicle Type:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Vehilce Kind:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Engine no:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>

                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Chassis number:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Province Name:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">District Name:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Village Name:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Brand:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
                <div class="col-md-3 col-sm-3 mb-3">
                    <label for="validationCustom01">Model:</label>
                    <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="division_no" required="">
                </div>
               
              
                </div>
				</div>
            <div class="tab-pane" id="3a">
            <table  class="table  table-bordered bg-default text-white" style="width:100%">
                    <thead>
                        <th>No</th>
                        <th>App Request No</th>
                        <th>Inspection</th>
                        <th>Result</th>
                        <th>Comment</th>
                        <th>By Staff</th>
                        <th>Action</th>
                    </thead>
                    <tr>
                        <td></td>
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
                        <td></td>
                      
                    </tr>
                </table>
			</div>
            <div class="tab-pane" id="4a">
                    <a href="" class="btn btn-success">Add Document</a>
                <table  class="table table-bordered bg-default text-white" style="width:100%">
                    <thead>
                        <th>No</th>
                        <th>Document type</th>
                        <th>Document File</th>
                       
                    </thead>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        
                    </tr>
                </table>
				</div>
            <div class="tab-pane" id="5a">
            <table  class="table table-bordered bg-default text-white" style="width:100%">
                    <thead>
                        <th>No</th>
                        <th>App Request No</th>
                        <th>App Type</th>
                        <th>Date Request</th>
                        <th>Status</th>
                        <th>Note</th>
                        <th>By staff</th>
                    </thead>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                       
                    </tr>
                </table>
			</div>
			</div>
 
            </div>
           
        </form>
        
    </div>
  </div>


@include('delete')
 @endsection 
 @push('page_scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
@endpush
