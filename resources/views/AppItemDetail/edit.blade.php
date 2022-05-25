@extends('layouts.master')
@section('vims','active')
@section('content') 

    <h1 class="page-header">{{trans('title.app_item_edit')}}</h1>
  <div class="panel panel-inverse">
  @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif 
    <div class="panel-body">
       <form  action="{{route('app-item-detail.update',['id'=>$app_item->id])}}"  method="POST">
                  @method('Patch')
                      @csrf
              <div class="form-row">
               <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Detail Text:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{$app_item->text}}" placeholder="Enter Detail text" name="text" required="">
              </div>

              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Currency:</label>
                <select name="money_unit_id" class="form-control" required="">
                  <option value="" selected disabled>Select Currency </option>
                  @foreach($currency as $data)
                  <option value="{{$data->id}}" {{ $app_item->money_unit_id == $data->id?'selected':''}}>{{$data->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Detail Price:</label>
                <input type="number" class="form-control" id="validationCustom01" value="{{$app_item->price}}" placeholder="Enter Detail Price" name="price" >
              </div>
              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Vehicle Type:</label>
                <select name="vehicle_type_id" class="form-control" required="">
                  <option value="" selected disabled>Select Vehicle Type </option>
                  @foreach($vtype as $data)
                  <option value="{{$data->id}}" {{ $app_item->vehicle_type_id == $data->id?'selected':''}}>{{$data->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Vehicle Model:</label>
                <select name="vehicle_model_id" class="form-control" required="">
                  <option value="" selected disabled>Select Vehicle Model </option>
                  @foreach($vmodel as $data)
                  <option value="{{$data->id}}" {{ $app_item->vehicle_model_id == $data->id?'selected':''}}>{{$data->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Vehicle Brand:</label>
                <select name="vehicle_brand_id" class="form-control" required="">
                  <option value="" selected disabled>Select Vehicle Brand </option>
                  @foreach($vbrand as $data)
                  <option value="{{$data->id}}" {{ $app_item->vehicle_brand_id == $data->id?'selected':''}}>{{$data->name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Vehicle Generation:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{$app_item->item_car_gen}}" placeholder="Enter Car generation" name="item_car_gen">
              </div>
              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Vehicle Power:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{$app_item->item_car_power}}" placeholder="Enter Car generation" name="item_car_power" required="">
              </div>
               

              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Vehicle Standard:</label>
                <select name="standard_id" class="form-control" required="">
                  <option value="" selected disabled >Select Vehicle Standard </option>
                  @foreach($vstandard as $data)
                  <option value="{{$data->id}}" {{$app_item->standard_id == $data->id?'selected':''}}>{{$data->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Vehicle Used:</label>
                <input type="radio"  name="item_car_used" value="1" {{$app_item->item_car_used ==1?'checked':''}}><span style="color:#000;" >Used</span>
                 <input type="radio"  name="item_car_used" value="0" {{$app_item->item_car_used ==0?'checked':''}}><span style="color:#000;" {{$app_item->item_car_used ==0?'checked':''}}>Not Used</span>
                
              </div>

               <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Vehicle Sterring:</label>
                <select name="steering_id" class="form-control" required="">
                  <option value="" selected disabled>Select Vehicle Sterring </option>
                  @foreach($steering as $data)
                  <option value="{{$data->id}}" {{$app_item->steering_id ==$data->id?'selected':''}}>{{$data->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Vehicle Seat:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{$app_item->item_car_seat}}" placeholder="Enter Vehicle Seat" name="item_car_seat" required="">
              </div>
              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Vehicle Manufacture:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{$app_item->item_car_manufacture}}" placeholder="Enter Vehicle Manufacture" name="item_car_manufacture" required="">
              </div>
              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Vehicle Height:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{$app_item->car_height}}" placeholder="Enter Vehicle Height" name="car_height" required="">
              </div>
              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Vehicle Long:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{$app_item->car_long}}" placeholder="Enter Vehicle Long" name="car_long" required="">
              </div>
               <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Vehicle Gas:</label>
                <select name="gas_id" class="form-control" required="">
                  <option value="" selected disabled>Select Vehicle Gas </option>
                  @foreach($gas as $data)
                  <option value="{{$data->id}}" {{$app_item->gas_id == $data->id?'selected':''}}>{{$data->name}}</option>
                  @endforeach
                </select>
              </div>

               <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Vehicle Wheels:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{$app_item->car_wheels}}" placeholder="Enter Vehicle Wheels" name="car_wheels" required="">
              </div>

              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Vehicle Acels:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{$app_item->car_acels}}" placeholder="Enter Vehicle Acels" name="car_acels" required="">
              </div>

              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Vehicle Color:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{$app_item->car_color}}" placeholder="Enter Vehicle Color" name="car_color" required="">
              </div>
               <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Vehicle Engine Number:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{$app_item->car_engine_number}}" placeholder="Enter Vehicle Engin Number" name="car_engine_number" required="">
              </div>
               <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Vehicle Thank Number:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{$app_item->car_tank_number}}" placeholder="Enter Vehicle Thank Number" name="car_tank_number" required="">
              </div>

              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Vehicle Weight:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{$app_item->car_weight}}" placeholder="Enter Vehicle Weight" name="car_weight" required="">
              </div>

              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Vehicle Total Weight:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{$app_item->car_total_weight}}" placeholder="Enter Vehicle Total Weight" name="car_total_weight" required="">
              </div>

              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Vehicle Technical:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{$app_item->car_tech}}" placeholder="Enter Vehicle Technical" name="car_tech">
              </div>
               <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Vehicle Width:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{$app_item->car_width}}" placeholder="Enter Vehicle Width" name="car_width" required="">
              </div>
              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Vehicle Number:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{$app_item->car_number}}" placeholder="Enter Vehicle Number" name="car_number" required="">
              </div>

               <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Vehicle Number Type:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{$app_item->car_number_type}}" placeholder="Enter Vehicle Number Type" name="car_number_type" required="">
              </div>

            </div>
             <div class="col-md-12 col-sm-12 text-right">
          
             <a class="btn  btn-secondary" href="{{route('app-item-detail.index')}}">{{trans('button.cancel')}}</a>
             <button type="submit" class="btn btn-success">{{trans('button.update')}}</button>
            </div>
        </form>
        
    </div>
  </div>


@include('delete')
 @endsection 
