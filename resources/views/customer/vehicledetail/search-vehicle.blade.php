@extends('customer.layouts.master')
@section('vehicle','active')
@section('content')
	<div class="card">
   		<div class="card-body">
        @include('flash')
   			<form class="form-inline" action="{{url('customer/search')}}" method="get">
			  <div class="form-group pr-5">
			    <label for="" class="pr-3">Division Number:</label>
			    <input type="text" class="form-control" name="division_no" id="text">
			  </div>
			  <div class="form-group pr-3">
			    <label for="" class="pr-3">Licence Number:</label>
			    <input type="text" name="licence_no" class="form-control" id="">
			  </div>
			  
			  <button class="btn btn-success btn-sm  my-0" type="submit">Search</button>
			</form> 

			 <div class="row mt-3">
              <div class="col-md-12 md-offset-12 "> 
                <table class="table table-bordered"> 
                  <thead>
                    <tr>
                     	<th>Application Number</th>
                      <th>Pre Licence No.</th>
                     	<th>Application Type</th>
                     	<th>Status</th>
                     	<th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                  	@foreach($app as $data )
                 
                  	<tr>
                  		<td>{{$data->app_no}}</td>Pre 
                      <td>{{$data->vehicle['licence_no_need']}}</td>
                  		<td>{{$data->app_type['name']}}</td>
                  		<td>{{$data->app_status['name_en']}}</td>
                  		<td><a href="{{url('customer/appform/'.$data->id)}}" ><i class="fa fa-eye"></i></a></td>
                  		
                  	</tr>
                 
					           @endforeach                  
                  </tbody>
                  
                </table> 
              </div>
            </div> 
  
   			
   		</div>
   	</div>
@endsection
