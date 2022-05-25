@extends('layouts.master')
@section('vims','active')
@section('content') 
    <h1 class="page-header"> Request Approve for Vehicle Transfer</h1>
    <div class="panel panel-inverse">
    @include('flash') 
    <div class="panel-body">
    <form action="{{url('search-licence')}}" method="get" class="mb-3">
            
            <div class="form-row">
                        
            <div class="col-md-3 col-sm-3">
            <input type="text" name="q" class="form-control" placeholder="Enter Licence Number">
            <input type="hidden" name="page" value="transfer">
            </div>
            <div class="col-md-3 col-sm-3">
            <input type="submit" class="btn btn-primary" value="Search">
            
            </div>
        </div>
        </form>
         <table id="myTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th>Licence Number</th>
                <th>Owner Name</th>
                <th>Province</th>
                <th>Brand</th>
                <th>Model</th>
               <th>Engine Number</th>
               <th>Chassis Number</th>
               <th>Status</th>
            

              </tr>
        </thead>
        <tbody>
              @foreach ($vehicle as $data)
                        <tr>
                              <td> {{ $data->licence_no }}</td>
                              <td>{{ $data->owner_name ?? '' }}</td>
                              <td>{{ $data->province_code}}</td>
                              <td>{{ $data->vbrand->name ??''}}</td>
                              <td>{{ $data->vmodel->name ??''}}</td>
                              <td>{{ $data->engine_no }}</td>
                              <td>{{ $data->chassis_no }}</td>
                              <td><a href="">pending</a></td>
                             
                        </tr>  
              @endforeach 
        </tbody>
      </table>
        
        </div>
      </div>

@endsection
