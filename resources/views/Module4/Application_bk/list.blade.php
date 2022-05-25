@extends('layouts.master')
@section('vims','active')
@section('content') 
    <h1 class="page-header"> Application lists</h1>
    <div class="panel panel-inverse">
    @include('flash') 
    <div class="panel-body">
    <form action="{{url('search-licence')}}" method="get" class="mb-3">
            
            <div class="form-row">
                        
            <div class="col-md-3 col-sm-3">
            <input type="text" name="q" class="form-control" placeholder="Enter Licence Number">
            <input type="hidden" name="page" value="application">
            </div>
            <div class="col-md-3 col-sm-3">
            <input type="submit" class="btn btn-primary" value="Search">
            
            </div>
        </div>
        </form>
         <table id="myTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th> licence No</th>
                <th>App Number</th>
                <th>Customer Name</th>
                <th>Date Request</th>
                <th>App Type</th>
               
              </tr>
        </thead>
        <tbody>
              @foreach ($app_form as $data)
                        <tr>
                              <td><a href="{{route('application.edit',[$data->vehicle_id])}}" class="btn btn-info"> {{ $data->vehicle->licence_no ?? ''}}</a></td>
                              <td>{{ $data->app_no}}</td>
                              <td>{{ $data->customer_name }}</td>
                              <td>{{ $data->date_request}}</td>
                              <td>{{ $data->app_type->name ?? ''}}</td>
                             
                        </tr>  
              @endforeach 
        </tbody>
      </table>
        
        </div>
      </div>

@endsection

@push('page_scripts')

 <script type="text/javascript">

    var myTable = $('#myTable').DataTable(); 
    
    </script>
@endpush