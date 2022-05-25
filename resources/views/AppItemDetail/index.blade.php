@extends('layouts.master')
@section('vims','active')

@section('content') 
    <h1 class="page-header">{{trans('title.app_item_detail')}}</h1>
    <div class="panel panel-inverse">
    @include('flash') 
  <div class="row">
        <div class="col-lg-12 add-new">
           
            <div class="pull-left">
                <a href="{{route('app-item-detail.create')}}" class="btn btn-primary btn-save">Add New</a>
            </div>
        </div>
    </div>
    

    <div class="panel-body">
        <table id="myTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                
                <th>Detail Taxt</th>
                <th>Price</th>
                <th>Vehicle Type</th>
                <th>Vehicle Model</th>
                <th>Vehicle Brand</th>
                <th>Vehicle Generation</th>
                <th>Vehicle Power</th>
                <th>Action</th>
                
              </tr>
            </thead>
            <tbody>
              @foreach($app_detail  as $data)
              <tr>
                <td>@if($data->text){{$data->text}}@endif</td>
                 <td>@if($data->price){{$data->price}}@endif</td>
                <td>@if($data->vehicle_type_id){{$data->vtype->name}}@endif</td>
                
                <td>@if($data->vehicle_model_id){{$data->vmodel->name}}@endif</td>
                
                <td>@if($data->vehicle_brand_id){{$data->vbrand->name}}@endif</td>
                <td>@if($data->item_car_gen){{$data->item_car_gen}}@endif</td>
               <td>@if($data->item_car_power){{$data->item_car_power}}@endif</td>
                <td>
                   <a href="{{route('app-item-detail.show',['id'=>$data->id])}}" class="btn btn-info btn-sm">{{trans('button.show')}}
                    </a>
                    <a href="{{route('app-item-detail.edit',['id'=>$data->id])}}" class="btn btn-primary btn-sm">{{trans('button.edit')}}
                    </a>
                    <a href="" class="btn btn-danger btn-sm delete_btn"
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

     var base_url = "{{url('app-item-detail')}}";
      
     $(document).on("click", '.delete_btn', function (e) {  
            
            document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
        });

     

    </script>
@endpush