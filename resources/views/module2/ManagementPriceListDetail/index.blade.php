@extends('layouts.master')
@section('finance','active')
@section('content') 
    <h1 class="page-header">{{trans('finance_title.manage_price_list_detail')}}</h1>
    <div class="panel panel-inverse">
    @include('flash') 
 
    

    <div class="panel-body">
         <table id="myTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                 <th>{{ trans('finance_title.item_code_name') }}</th>
                  <th>{{trans('finance_title.item_name')}}</th>
                <th>{{ trans('finance_title.detail_quantity') }}</th>
                <th>{{ trans('finance_title.detail_price') }}</th>
                <th>{{ trans('finance_title.detail_total') }}</th>
               
               
                <th>{{ trans('finance_title.status') }}</th>
               
              </tr>
        </thead>
        <tbody>
              @foreach ($pricelistdetail as $pricelistdetail)
                        <tr>
                           <td>{{$pricelistdetail->item_code != null?$pricelistdetail->item_code:''}}</td>
                           <td>{{$pricelistdetail->item_name != null?$pricelistdetail->item_name:''}}</td>
                              <td>{{$pricelistdetail -> quantity}}</td>
                              <td>{{$pricelistdetail -> price}}</td>
                              <td>{{$pricelistdetail -> sub_total != null?$pricelistdetail -> sub_total:''}}</td>
                             
                              
                              <td>{{$pricelistdetail -> status}}</td>
                      
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
     var base_url = "{{url('pricelistdetail')}}";


          $(".delete").on("submit", function(){
          return confirm("Are you sure to delete?");
    });

    </script>
@endpush