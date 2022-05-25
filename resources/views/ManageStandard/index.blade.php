@extends('layouts.master') 
@section('vims','active') 
@section('content') 
<h1 class="page-header">{{trans('gas_standard_check.manage_standard')}}</h1>
<div class="panel panel-inverse"> 
  @include('flash') 
  <div class="row">
    <div class="col-lg-12 add-new">
      <div class="pull-left">
        <form action="standard/create">
          <button type="submit" class="btn btn-primary btn-save">{{trans('gas_standard_check.add_new_st')}}</button>
        </form>
      </div>
    </div>
  </div>
  <div class="panel-body">
    <table id="myTable" class="table table-striped table-bordered" style="width:100%">
      <thead>
        <tr>
          <th>{{trans('gas_standard_check.standard_name_lao')}}</th>
          <th>{{trans('gas_standard_check.standard_name_en')}}</th>
          <th>{{trans('gas_standard_check.action')}}</th>
        </tr>
      </thead>
      <tbody> 
        @foreach ($standard as $standard) 
        <tr>
          <td>{{$standard -> name}}</td>
          <td>{{$standard -> name_en}}</td>
          <td>
            <form class="delete" action="/standard/{{$standard -> id}}" method="POST"> @method('DELETE') @csrf <a href="{{route('standard.edit',['id'=>$standard -> id])}}" class="btn btn-primary btn-sm">{{ trans('button.edit') }}</a>
              <button type="submit" class="btn btn-sm btn-danger">{{trans('button.delete')}}</button>
            </form>
          </td>
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
  var base_url = "{{url('gas')}}";
  $(".delete").on("submit", function() {
    return confirm("Are you sure to delete?");
  });
</script> 
@endpush