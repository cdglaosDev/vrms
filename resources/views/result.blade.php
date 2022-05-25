@extends('layouts.master')
@section('register','active')
@section('title','Reports')
@section('content')
<h1 class="page-header">{{trans('title.reg_list')}}</h1>
<div class="panel panel-inverse">
     <div class="panel-body">
	<form action="{{url('report/result')}}" method="GET" role="search">
		
            <div class="row">
           
          
            <div class="form-group col-md-3">
                <label >Select Option</label>
                <div>
                    <select id="d_m_y_radio" name="daily"  type="button" class="form-control" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                    <input required="" type="text" class="form-control date" name="date_from" placeholder="Select from Date" value="">
                </div>
            </div>
            <div class="form-group col-md-3">
                <label class="col-auto ">To :</label>
                <div class="col-auto">
                    <input required="" type="text" class="form-control date" format="dd-mm-yyyy" name="date_to" value="" placeholder="Select To Date">
                </div>
            </div>
            <div class="form-group col-md-3">
                <label class="col-auto">&nbsp;</label>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Search</button>
                   
                </div>
            </div>
        </div>
    </form>

		  <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Register Date</th>
                                                    <th>Total Register</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                               <tr>
                                                    <td>{{session('start')}} - {{session('end')}}</td>
                                                    <td>@if(isset($data)){{$data}} @else @endif</td>
                                                    
                                                    
                                                </tr>

                                            </tbody>

    </table>
</div></div>


@endsection
@push('page_scripts')

<script>
  var myTable = $('#myTable').DataTable(); 

</script>

@endpush
