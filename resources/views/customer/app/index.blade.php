@extends('customer.layouts.master')
@section('app','active')
@section('content')
    <h1 class="page-header">{{trans('customer.app')}}</h1>
    <div class="panel panel-inverse">
    @include('flash') 
  <div class="row">
        <div class="col-lg-12 add-new">
           
            <div class="pull-left">
                <a href="{{route('app.create')}}" class="btn btn-primary btn-add">{{trans('customer.add_new')}}</a>
            </div>
        </div>
    </div>
   <ul class="nav nav-pills">
            <li class="nav-items">
              <a href="{{url('customer/apps','all')}}"  class="nav-link">
                
                <span class="d-sm-block d-none">All</span>
              </a>
            </li>
            <li class="nav-items">
              <a href="{{url('customer/apps','approve')}}"  class="nav-link show">
                
                <span class="d-sm-block d-none">Approved</span>
              </a>
            </li>
            <li class="nav-items">
              <a href="{{url('customer/apps','pending')}}" class="nav-link">
              
                <span class="d-sm-block d-none">Pending</span>
              </a>
            </li>
            <li class="nav-items">
              <a href="{{url('customer/apps','cancel')}}"  class="nav-link">
                
                <span class="d-sm-block d-none">Cancel</span>
              </a>
            </li>
          </ul>
  
    <div class="panel-body">
        <table id="myTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                
            
                <th>Licence Number</th>
                <th>Vehicle Purpose</th>
                <th>Vehicle Type</th>
                <th>{{trans('customer.status')}}</th>
                <th>{{trans('customer.action')}}</th>
                
              </tr>
            </thead>
            <tbody>
              @foreach($app  as $data)
              <tr>
               
                <td>@if($data->vehicle_detail_id){{$data->vehicle_detail->licence_no}}@endif</td>
               
                <td>@if($data->vehicle_detail_id){{$data->vehicle_detail->apppurpose->name_en}}({{$data->vehicle_detail->apppurpose->name}})@endif</td>
                 <td>@if($data->vehicle_detail_id){{$data->vehicle_detail->type->name_en}}({{$data->vehicle_detail->type->name}})@endif</td>
                <td>{{$data->app_status->name_en}}</td>
                <td>
                   <a href="{{route('app.show',['id'=>$data->id])}}" class="btn btn-sm btn-info">{{trans('button.show')}}
                    </a>
                    @if($data->app_status !="approve")
                    <a href="{{route('app.edit',['id'=>$data->id])}}" class="btn btn-sm btn-primary">{{trans('button.edit')}}
                    </a>
                    <a href="" class="btn btn-danger btn-sm delete_btn"
                        data-toggle="modal" data-target="#deleteModel"
                      
                        data-id="{{$data->id}}">{{trans('button.delete')}}
                    </a>
                    @endif
                </td>
              </tr>
              @endforeach
            </tbody>
        </table>
        
        </div>
      </div>


@include('delete')
@endsection 
@push('page_scripts')

 <script type="text/javascript">
  var myTable = $('#myTable').DataTable(); 
     var base_url = "{{url('customer/app')}}";
      
     $(document).on("click", '.delete_btn', function (e) {  
            
            document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
        });

     

    </script>
@endpush