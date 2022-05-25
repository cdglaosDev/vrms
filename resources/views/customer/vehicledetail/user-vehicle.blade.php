@extends('customer.layouts.master')
@section('vehicle','active')
@section('content')
@php 

$type =\App\Model\VehiclePurpose::get();
$gases =\App\Model\Gas::get();
@endphp
	<div class="panel panel-inverse">
   		<div class="panel-body">
   			@include('flash') 
   			<h2 class="text-center">Lao People's democretic Registration</h2>
   			
   			<form action="{{ route('updateAppform',[$data->app_form->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <h3>Technicle Detail</h3>
                  <table class="table table-striped table-bordered" style="width: 100%">
                    <tbody>
                    <tr>
                        <td width="200px">Vehicle Type</td>
                        <td>{{$data->vtype->name}} </td>
                    </tr>
                    <tr>
                        <td width="200px">Brand</td>
                        <td>{{$data->vbrand->name_en}}  </td>
                    </tr>
                    <tr>
                        <td width="200px">Model</td>
                        <td>{{$data->vmodel->name_en}}  </td>
                    </tr>
                    <tr>
                        <td width="200px">Color</td>
                         <td>{{$data->color->name_en}}  </td>
                    </tr>
                  
                    <tr>
                        <td width="200px">Use the Oil</td>
                          <td>@foreach($gases as $value)            
                            <label>
                              <input type="checkbox" name="gas_id[]" value="{{$value->id}}" {{$value->id == $data->gas_id ?"checked":""}}> {{$value->name_en}}
                            </label>
                            @endforeach     
                          </td>
                    </tr>
                    <tr>
                        <td width="200px">Type of Vehicle</td>
                        <td>@foreach($type as $value)            
                          <label>
                            <input type="checkbox" name="vehicle_type_id[]" value="{{$value->id}}" {{$value->id == $data->vehicle_type_id ?"checked":""}}> {{$value->name_en}}
                          </label>
                          @endforeach  
                        </td>
                    </tr>
                   
                    </tbody>

                  </table> 
              </div>
             
            </div>
   			 	
   

            
              
            <h3>Show Respect</h3>
               <div class="form-group">   
                  <label>
                    <input type="checkbox" name="change_info" value="1" {{$data->app_form->change_info == 1 ?"checked":""}}> Change Information
                  </label>
                   <label>
                      <input type="checkbox" name="transfer" value="1" {{$data->app_form->transfer == 1 ?"checked":""}} > Transfer Vehicle
                    </label>
                   
               </div>

	            <div class="form-group">
	                <button type="submit" class="btn btn-primary">Submit</button>
                  <!-- <a href="{{url('customer/print/'.$data->id)}}" class="btn btn-success">Print</a> -->

	            </div>  
            </form>

                     
            
   		</div>
   	</div>
@endsection   	