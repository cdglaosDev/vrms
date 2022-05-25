@extends('layouts.master')
@section('finance','active')
@section('content') 
    <h1 class="page-header">Create Price Item Group</h1>
    <div class="card">
    @include('flash') 
  <div class="row">
        <div class="col-lg-12 add-new">
          @can('Price-Group-List-Create')
        <div class="pull-left">
                <a href="{{route('items-group.create')}}" class="btn btn-primary btn-save btn-sm">{{trans('common.add_new')}}</a>
            </div>
            @endcan
        </div>
    </div>
    

    <div class="card-body">
         <table id="myTable" class="table table-bordered">
            <thead>
              <tr>
                <th>Group Code</th>
                <th>{{trans('common.name')}}(lao)</th>
                <th>{{trans('common.name')}} (Eng)</th>
                <th>{{trans('common.status')}}</th>
                <th>{{trans('common.action')}}</th>
                
              </tr>
        </thead>
          <tbody>
            @foreach($price_item_group as $data)
            <tr>
              <td>{{$data->group_code}}</td>
              <td>{{$data->group_name}}</td>
              <td>{{$data->group_name_en}}</td>
              <td>{{$data->status ==1?'Active':'Deactive'}}</td>
              <td> 
                   @can('Price-Group-Entry-Edit')
                    <a href="{{route('items-group.edit',['id'=>$data->id])}}" class="btn btn-primary btn-sm">{{trans('button.edit')}}</a>
                    @endcan
                    @can('Price-Group-Entry-Delete')
                    <a href="" class="btn btn-danger btn-sm  delete_btn"
                        data-toggle="modal" data-target="#deleteModel"
                      
                        data-id="{{$data->id}}">{{trans('button.delete')}}
                        </a>
                        @endcan
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

     var base_url = "{{url('items-group')}}";
      
     $(document).on("click", '.delete_btn', function (e) {  
            
            document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
        });
      

      

    </script>
@endpush