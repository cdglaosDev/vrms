@extends('layouts.master')
@section('user','active')
@section('title','Create New User')
@section('content')
<div class="panel panel-primary">
 <div class="panel-heading">Export and Import Excel file</div>
  <div class="panel-body"> 
   
   <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Import User Data</button>
                <a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a>
            </form>
       </div>
</div>


@endsection