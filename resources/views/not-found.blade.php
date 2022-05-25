@extends('layouts.master')
@section('title','Search Register')
@section('reg','active')
@section('content')
<h1 class="page-header">{{trans('title.search')}}</h1>
    
    <div class="card">
        <div class="card-body">
                <h4>Division number not found.</h4> 
                <p><a href="{{url('search')}}" class="btn btn-secondary btn-sm">Go back</a></p>                       
        </div>
	</div>				
@endsection

