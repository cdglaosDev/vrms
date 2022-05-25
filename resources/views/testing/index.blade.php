@extends('layouts.master')
@section('user','active')
@section('content')

    <div class="card">
    @include('flash') 
      <div class="card-body">
      <h4 class="bold">Export and Import Excel file</h4>
      <form method='post' action="{{route('import')}}" enctype='multipart/form-data' >
       {{ csrf_field() }}
       <input type='file' name='file'  >
       <input type='submit' name='submit' value='Import file' class="btn btn-success">
     </form>
     <hr/>
     <h4 class="bold">Added old vehicle Id into vehicle document</h4>
     <form method='post' action="{{route('save.vehicleId')}}"  >
       {{ csrf_field() }}
       <input type='submit' name='submit' value='Add VehicleId' class="btn btn-primary">
     </form>
      </div>
    </div>


@endsection

