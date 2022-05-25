@extends('layouts.master') 
@section('title','Search Register') 
@section('register','active') 
@section('content')
<h1 class="page-header">{{trans('title.search')}}</h1>
<div class="card"> 
	@can('New-Register-List-Create')
	<div class="card-body">
		<form action="{{url('getData')}}" method="get" class="form-horizontal" id="search">
			<div class="form-body">
				<div class="form-group row">
					<!-- <label class="control-label text-right col-md-3">Pass :</label> -->
					<div class="col-md-5">
						<input id="name" type="hidden" class="form-control" name="pass" value="ati123" required placeholder="Enter Pass"> </div>
				</div>
				<div class="form-group row">
					<!-- <label class="control-label text-right col-md-3">Type :</label> -->
					<div class="col-md-5">
						<input id="type" type="hidden" class="form-control" name="type" value="vehiclereg" placeholder="Enter Type"> </div>
				</div>
				<div class="form-group row">
					<label class="control-label text-right col-md-3">Division No :</label>
					<div class="col-md-5">
						<input type="text" id="division_no" name="division_no" value="" placeholder="Enter Dividion No" class="form-control" required> </div>
					<div class="col-md-2">
						<button class="btn btn-primary btn-sm btn-block">{{trans('button.search')}}</button>
					</div>
				</div>
		</form>
		</div>
	</div> 
	@endcan 
	@endsection