@extends('customer.layouts.master')
@section('company','active')
@section('content') 
    <h1 class="page-header">{{trans('customer.company')}}</h1>
    <div class="panel panel-inverse">
    @include('flash') 
  <div class="row">
        <div class="col-lg-12 add-new">
           
            <div class="pull-left">
                <a href="{{url('customer/company/create')}}" class="btn btn-primary btn-add">{{trans('customer.add_new')}}</a>
            </div>
        </div>
    </div>
    

    <div class="panel-body">
         <table id="myTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                
                <th>{{trans('customer.com_name')}}</th>
                <th>{{trans('customer.owner_name')}}</th>
                <th>{{trans('customer.com_phone')}}</th>
                <th>{{trans('customer.com_email')}}</th>
                <th>{{trans('customer.action')}}</th>
                
              </tr>
        </thead>
         <tbody>
            @foreach($company as $data)
             <tr>
                <td>{{$data->name}}({{$data->name_en}})</td>
                <td>{{$data->contact_name}}({{$data->contact_name_en}})</td>
                <td>{{$data->phone}}</td>
                <td>{{$data->email}}</td>
                 <td><a href="{{route('company.show',['id'=>$data->id])}}" class="btn btn-sm btn-info">{{trans('button.show')}}
                        </a> <a href="{{route('company.edit',['id'=>$data->id])}}" class="btn btn-sm btn-primary">{{trans('button.edit')}}
                        </a>
                      <a href="" class="btn btn-sm btn-danger delete_btn"
                        data-toggle="modal" data-target="#deleteModel"
                      
                        data-id="{{$data->id}}">{{trans('button.delete')}}
                        </a>
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
     var base_url = "{{url('customer/company')}}";
      
     $(document).on("click", '.delete_btn', function (e) {  
            
            document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
        });

        

    </script>
@endpush
