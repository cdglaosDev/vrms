@extends('layouts.master')
@section('list','active')
@section('content') 
    <h1 class="page-header">{{trans('title.applicationstatus')}}</h1>
    <div class="card">
    @include('flash') 
  <div class="row">
        <div class="col-lg-12 add-new">
           
            <div class="pull-left">
                <a data-toggle="modal"  data-target="#addModel1" class="btn btn-primary btn-save">{{trans('button.applicationstatus')}}</a>
            </div>
        </div>
    </div>

<div class="card-body">
         <table id="order-listing" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>               
                    <th>Name(English)</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach($applicationstatus as $data)
              <tr>
                <td>{{$data->name}}</td>
                <td>{{$data->name_en}}</td>
                 <td>@if($data->status ==1)Active @else Deactive @endif</td>
                  <td class="sorting">
                       
                        <button type="button" class="btn btn-info  edit_btn"
                        data-toggle="modal" data-target="#editModel"
                        data-act="Edit"
                        data-name="{{$data->name}}"
                        data-name_en="{{$data->name_en}}"
                        data-status="{{$data->status}}"
                        data-id="{{$data->id}}">{{trans('button.edit')}}
                        </button>
                        <button type="button" class="btn btn-danger  delete_btn"
                        data-toggle="modal" data-target="#deleteModel"
                        data-act="Delete"
                        data-id="{{$data->id}}">{{trans('button.delete')}}
                        </button>
                    </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
  
    </div>
   
</div>
@component('component.admin.applicationstatus')
@endcomponent
@endsection

@push('page_scripts')
<script type="text/javascript">
 
     var base_url = "{{url('admin/application-status')}}";
      
     $(document).on("click", '.delete_btn', function (e) {  
            
            document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
        });
     $(document).on("click", '.edit_btn', function (e) {
           
           
            $('[name="name"]').val($(this).data('name'));
            $('[name="name_en"]').val($(this).data('name_en'));
           $('[name="status"]').val($(this).data('status'));

            document.getElementById("editform").action = base_url+"/"+$(this).data('id');
        });
     </script>
@endpush


      