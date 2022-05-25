@extends('layouts.master')
@section('register','active')
@section('title','Reports')
@section('content')
<h1 class="page-header">{{trans('title.report')}}</h1>
<div class="card">
    <div class="card-body">
	<form action="{{url('report/result')}}" method="GET" role="search">
        <div class="row">
            <div class="form-group col-md-3">
                <label >Select Option</label>
                <div>
                    <select id="d_m_y_radio" name="type"  type="button" class="form-control" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <option>- Select Option -</option>
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-3">
                <label class="col-auto">From :</label>
                <div class="col-auto">
                    <input required="" type="text" class="form-control date" name="date_from" value="" placeholder="Enter From date">
                </div>
            </div>
            <div class="form-group col-md-3">
                <label class="col-auto ">To :</label>
                <div class="col-auto">
                    <input required="" type="text" class="form-control date" format="dd-mm-yyyy" name="date_to" value="" placeholder="Enter To Date">
                </div>
            </div>
            <div class="form-group col-md-3">
                <label class="col-auto">&nbsp;</label>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary btn-sm">Search</button>
                   
                </div>
            </div>
        </div>
    </form>
<br/>

<hr/>
<br/>
	<div class="table-responsive">
      <table id="myTable" class="table table-striped table-bordered" style="width:100%">
											<thead>
												<tr>
													<th>Register Date</th>
													<th>Total Register</th>
													

												</tr>
											</thead>
											<tbody>
											
												<tr>
													<td>@if(isset($data->created_at)){{$data->created_at}} @else @endif</td>
													<td>@if(isset($data->total)){{$data->total}} @else @endif</td>
												</tr>
											</tbody>
	</table>

</div>
</div>
</div>

@include('delete')

@endsection
@push('page_scripts')

<script>
    
   $(document).ready(function() {
        var base_url = "{{url('car-register')}}";
        
       $(document).on("click", '.delete-btn', function (e) {  
        document.getElementById("delform").action = base_url+"/"+$(this).data('id');
        });

   });

</script>

@endpush
