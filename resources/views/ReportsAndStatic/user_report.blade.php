@extends('vrms2.layouts.master')
@section('user_report','active') 
@section('content') 
@php $users = App\User::where('user_type',"!=",'customer')->get(); 
@endphp
@include('vrms2.report-submenu')
<h3>{{trans('title.user_report')}}</h3>
@include('flash')
<div class="card-body">
   <form action="{{url('user-report')}}" method="POST">
      {{ csrf_field() }}
      <div class="row">
         <div class="form-group col-md-4">
            <label class="col-auto">{{ trans('common.username') }} :</label>
            <div class="col-auto">
               <select name="user_name" class="form-control js-example-basic-single" required="">
                  <option value="" selected disabled hidden>{{ trans('common.username') }}</option>
                  @foreach($users as $data)
                  <option value="{{$data-> id}}" {{ session()->get('user_name') == $data->id?'selected':'' }}><span>{{$data->name}}</span></option> 
                  @endforeach 
               </select>
            </div>
         </div>
         <div class="form-group col-md-4">
            <label class="col-auto">{{ trans('common.date') }} :</label>
            <div class="col-auto">
               <input type="text" class="form-control date" format="dd-mm-yyyy" name="date" value="{{ session()->get('date') }}" placeholder="Enter Date" required=""> 
            </div>
         </div>
         <div class="form-group col-md-4">
            <label class="col-auto">&nbsp;</label>
            <div class="col-auto">
               <button type="submit" class="btn btn-primary btn-sm">{{ trans('button.search') }}</button>
               <a class="btn btn-success btn-sm text-white" id="btnExport" onclick="fnExcelReport('UserReport');">{{ trans('button.export_excel') }}</a>
            </div>
         </div>
      </div>
   </form>
   <br/>
   <table id="table" class="table table-striped">
      <thead>
         <tr>
            <th>{{trans('common.task')}}</th>
            <th>{{trans('common.total_count')}}</th>
         </tr>
      </thead>
      <tbody>
         @foreach ($value as $value_key=>$item)
         <tr>
            <td>{{$item['task']}}</td>
            @foreach ($item['count'] as $data_key => $data) @if($value_key == $data_key)
            <td>{{$data}}</td>
            @endif @endforeach 
         </tr>
         @endforeach 
      </tbody>
   </table>
</div>
@include('includes.exportExcel') 
@endsection 
@push('page_scripts')
<script type="text/javascript">
   var base_url = "{{url('user-report')}}";
   $(".delete").on("submit", function() {
   	return confirm("Are you sure to delete?");
   });
</script> 
@endpush