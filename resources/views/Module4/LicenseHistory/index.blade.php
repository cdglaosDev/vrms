@extends('vrms2.layouts.master')
@section('vims','active')
@section('content') 
<h3>{{trans('module4.license_history_title')}}</h3>
<div class="card-body">
   @include('flash') 
   <div class="table-responsive">
      <table id="myTable" class="table table-striped">
         <thead>
            <tr>
               <th>{{trans('module4.no')}}</th>
               <th>{{trans('module4.license_no')}}.</th>
               <th>{{trans('common.province')}}</th>
               <th>{{trans('module4.customer_name')}}</th>
               <th>{{trans('module4.expire_date')}}</th>
               <th >{{trans('common.action')}}</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($licensehistory as $licensehistory)
            <tr>
               <td></td>
               <td>{{ $licensehistory -> alphabet -> name ?? ''}}-{{ $licensehistory->license_no_number}}</td>
               <td>{{$licensehistory -> vehicle -> province->name ?? ''}}</td>
               <td></td>
               <td>{{$licensehistory -> vehicle ->expire_date ?? ''}}</td>
               <td>
                  <a href="{{route('license-history.show',['id'=>$licensehistory -> id])}}" class="btn btn-primary btn-sm">{{ trans('button.view') }}</a>  
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
   var base_url = "{{url('/license-history')}}";
        $(".delete").on("submit", function(){
        return confirm("Are you sure to delete?");
   });
   
</script>
@endpush