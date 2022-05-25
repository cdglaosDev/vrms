@extends('layouts.master')
@section('importer','active')

@section('content') 
    <h1 class="page-header"> {{trans('title.app_item_detail1')}}</h1>
    <div class="panel panel-inverse">
     
    
    

    <div class="panel-body">
       
        <table class="table table-striped table-bordered" style="width: 50%">
           
            <tbody>
              <tr>
                <td width="200px">Detail Taxt</td>
                <td>@if($data->text){{$data->text}} @endif</td>
              </tr>
              <tr>
                <td>Price</td>
                <td>@if($data->price){{$data->price}} @endif</td>
              </tr>
              <tr>
                <td>Vehicle Type</td>
                <td>@if($data->vehicle_type_id){{$data->vtype->name}} @endif</td>
              </tr>
              <tr>
                <td>Vehicle Model</td>
                <td>@if($data->vehicle_model_id){{$data->vmodel->name}} @endif</td>
              </tr>
              <tr>
                <td>Vehicle Brand</td>
                <td>@if($data->vehicle_brand_id){{$data->vbrand->name}} @endif</td>
              </tr>
              <tr>
                <td>Vehicle Generation</td>
                <td>@if($data->item_car_gen){{$data->item_car_gen}} @endif</td>
              </tr>
              <tr>
                <td>Vehicle Power</td>
                <td>@if($data->item_car_power){{$data->item_car_power}} @endif</td>
              </tr>
              <tr>
                <td>Vehicle Standard</td>
                <td>@if($data->standard_id){{$data->standard->name}}@endif</td>
              </tr>
              <tr>
                <td>Vehicle Used</td>
                <td>@if($data->item_car_used =="1")Used @else Not Used @endif</td>
              </tr>
              <tr>
                <td>Vehicle Sterring</td>
                <td>@if($data->steering_id){{$data->steering->name}} @endif</td>
              </tr>
              <tr>
                <td>Vehicle Seat</td>
                <td>@if($data->item_car_seat){{$data->item_car_seat}} @endif</td>
              </tr>
              <tr>
                <td>Vehicle Gas</td>
                <td>@if($data->gas_id){{$data->gas->name}} @endif</td>
              </tr>
               <tr>
                <td>Vehicle Manufacture</td>
                <td>{{$data->item_car_manufacture}}</td>
              </tr>
               <tr>
                <td>Vehicle Height</td>
                <td>{{$data->car_height}}</td>
              </tr>
               <tr>
                <td>Vehicle Long</td>
                <td>{{$data->car_long}}</td>
              </tr>
               <tr>
                <td>Vehicle Wheels</td>
                <td>{{$data->car_wheels}}</td>
              </tr>
               <tr>
                <td>Vehicle Acels</td>
                <td>{{$data->car_acels}}</td>
              </tr>
               <tr>
                <td>Vehicle Color</td>
                <td>{{$data->car_color}}</td>
              </tr>
               <tr>
                <td>Vehicle Engine Number</td>
                <td>{{$data->car_engine_number}}</td>
              </tr>
               <tr>
                <td>Vehicle Thank Number</td>
                <td>{{$data->car_tank_number}}</td>
              </tr>
               <tr>
                <td>Vehicle Weight</td>
                <td>{{$data->car_weight}}</td>
              </tr>
               <tr>
                <td>Vehicle Total Weight</td>
                <td>{{$data->car_total_weight}}</td>
              </tr>
               <tr>
                <td>Vehicle Technical</td>
                <td>{{$data->car_tech}}</td>
              </tr>
              <tr>
                <td>Vehicle Number</td>
                <td>{{$data->car_number}}</td>
              </tr>
              <tr>
                <td>Vehicle Number Type</td>
                <td>{{$data->car_number_type}}</td>
              </tr>


            </tbody>
        </table>
    </div>
    </div>



 @endsection 
