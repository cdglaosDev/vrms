@extends('layouts.master')
@section('finance','active')
@section('content') 
    <h1 class="page-header">{{trans('title.price_item_group_detail')}}</h1>
    <div class="card">
    @include('flash') 
      <div class="card-body">
         <table id="myTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th>{{trans('finance_title.group_name')}}</th>
                <th>{{ trans('finance_title.item_code') }}</th>
                <th>{{trans('finance_title.item_group_name')}}</th>
              </tr>
        </thead>
        <tbody>
                @foreach ($price_detail as $detail)
                        <tr>
                              <td>@if(isset($detail -> pricegroup -> group_code)){{$detail -> pricegroup -> group_code}}<span>({{$detail -> pricegroup -> group_name}})</span>@else{{"_"}}@endif</td>
                              <td>@if(isset($detail -> priceitem -> code)){{$detail -> priceitem -> code}}@else{{"_"}}@endif</td>
                              <td>@if(isset($detail -> priceitem -> name)){{$detail -> priceitem -> name}}<span>({{$detail -> priceitem -> name_en}})</span>@else{{"_"}}@endif</td>
                        </tr>  
                @endforeach 
        </tbody>
        </table>
        
        </div>
      </div>
@endsection

  
@push('page_scripts')
<script type="text/javascript">

    var base_url = "{{url('price-item-group-detail')}}";
 
          $(".delete").on("submit", function(){
          return confirm("Are you sure to delete?");
    });

      </script>
@endpush