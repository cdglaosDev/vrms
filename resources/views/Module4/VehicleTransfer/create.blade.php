    @extends('layouts.master')
    @section('vims','active')
    @section('content') 
    @php
    $app_no = \App\Model\AppForm::get();
    $province = \App\Model\Province::whereStatus(1)->get();
    @endphp
        <h1 class="page-header">Vehiche Transfer</h1>
    <div class="card">
    <div class="card-body">
    @include('flash') 
       
        <form  action="{{route('vehicle-transfer.store')}}"  method="POST">
                    @method('post')
                        @csrf
            
            
                <div class="form-row mb-4" >
                    <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01">Transfer No:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="{{\App\Helpers\TransferNo::tran_no()}}" placeholder="" name="transfer_no" readonly="">
                    </div>

                    <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01">Transfer Date:</label>
                        <input type="text" class="date form-control" id="validationCustom01" value="" placeholder="" name="transfer_date" required="">
                    </div>
                
                    <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01"> Customer Name:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="" required="">
                    </div>
                    <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01"> Status:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="status" required="">
                    </div>
                    <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01">App Request No:</label>
                        <input type="text" name="app_request_no" class="form-control" value="@if(isset($vehicle)){{ $vehicle->app_form->app_no ?? ''}} @endif" readonly required="">
                        <input type="hidden" name="app_id" value="{{ $vehicle->app_form->id ?? '' }}">
                        </div>
                        <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01">From:</label>
                        <select name="transer_from" id="" class="form-control">
                            <option value="" selected disabled>Select transfer From</option>
                            @foreach($province as $data)
                                <option value="{{$data->province_code}}">{{ $data->name }}({{$data->name_en}})</option>
                            @endforeach
                        </select>
                        </div>

                        <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01">To:</label>
                        <select name="transer_to" id="" class="form-control">
                        <option value="" selected disabled>Select transfer To</option>
                            @foreach($province as $data)
                                <option value="{{$data->province_code}}">{{ $data->name }}({{$data->name_en}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01">Owner Name:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="@if(isset($vehicle)) {{ $vehicle->owner_name}} @endif" placeholder=""  readonly="" required="">
                    </div>
                    <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01">License No:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="@if(isset($vehicle)){{ $vehicle->licence_no}} @endif" placeholder="" name="division_no" readonly="" required="">
                    </div>
                    <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01">Old Vehicle No:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="123456" placeholder="" name="old_vehicle_number" readonly="" required="">
                    </div>
                    <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01">New Vehicle No:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="new_vehicle_number" required="">
                    </div>
                    <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01">Tenant Name:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="@if(isset($vehicle)){{ $vehicle->tenant_name }} @endif" placeholder="" name="" readonly="test" required="">
                    </div>

                    <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01">Vehicle Type:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="@if(isset($vehicle)){{ $vehicle->vtype->name ?? ''}}({{ $vehicle->vtype->name_en ?? ''}}) @endif" placeholder="" name="division_no" readonly="" required="">
                    </div>
                    <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01">vehicle Kind:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="@if(isset($vehicle)) {{ $vehicle->vtype->name ?? ''}}({{ $vehicle->vtype->name_en ?? ''}}) @endif" placeholder="" name="" readonly="" required="">
                    </div>
                
                    <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01">Model Brand Id:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="@if(isset($vehicle)) {{ $vehicle->moter_brand->name ?? ''}} @endif" placeholder="" name="division_no" readonly="" required="">
                    </div>
                    <div class="col-md-2 col-sm-2 mb-3">
                        <label for="validationCustom01">Province:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="@if(isset($vehicle)) {{ $vehicle->province->name ?? '' }} @endif" placeholder="" name="division_no" readonly="" required="">
                    </div>
                    <div class="col-md-12 col-sm-12 mb-12">
                        <label for="validationCustom01">Remark:</label>
                        <textarea name="" id=""  rows="3" class="form-control" required=""></textarea>
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
                
                    <a class="col-md-2  btn  btn-secondary btn-sm" href="#">Print Transfer</a>
                    <a class="col-md-2  btn  btn-secondary btn-sm" href="#">Certificate</a>
                
                    </div>
                    <div class="col-md-4 col-sm-4 text-right">

                    <a class="btn  btn-secondary btn-sm" href="#">{{trans('button.cancel')}}</a>
                    <button class="btn btn-success btn-sm">{{trans('button.save')}}</button>
                    </div>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
    @include('delete')
    @endsection 

