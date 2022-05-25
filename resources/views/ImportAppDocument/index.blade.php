@extends('layouts.master')
@section('importer','active')

@section('content') 
    <h1 class="page-header">{{trans('title.import_app_doc')}}</h1>
    <div class="panel panel-inverse">
    @include('flash') 
    <div class="row">
        <div class="col-lg-12 add-new">
            <div class="pull-left">
                <a data-toggle="modal"  data-target="#addModel" class="btn btn-primary btn-save">{{trans('button.import_app_doc')}}</a>
            </div>
        </div>
    </div>
    <div class="panel-body">
         <table id="myTable" class="table table-striped table-bordered" style="width:100%">
          <thead>
              <tr>
                <th>Document Type</th>
                <th>FileName</th>
                <th>Link</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
          </thead>
          <tbody>
            @foreach($app_doc as $data)
            <tr>
             <td>{{$data->doc_type->name}}</td>
             <td>{{$data->filename}}</td>
             <td>{{$data->link}}</td>
             <td>{{$data->date}}</td>
              <td> <a href="" class="btn btn-primary edit_btn"
                        data-toggle="modal" data-target="#editModel"
                        data-act="Edit"
                        data-doc_type_id ="{{$data->doc_type_id}}"
                        data-filename = "{{$data->filename}}"
                        data-link = "{{$data->link}}"
                        data-date = "{{$data->date}}"
                        data-id="{{$data->id}}">{{trans('button.edit')}}
                        </a>
                      <a href="" class="btn btn-danger delete_btn"
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

@include('ImportAppDocument.model')
@include('delete')
 @endsection 
@push('page_scripts')

 <script type="text/javascript">
  var myTable = $('#myTable').DataTable(); 
     var base_url = "{{url('admin/importapp_document')}}";
      
     $(document).on("click", '.delete_btn', function (e) {  
            
            document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
        });

         $(document).on("click", '.edit_btn', function (e) {
            $('[name="filename"]').val($(this).data('filename'));
            $('[name="link"]').val($(this).data('link'));
            $('[name="date"]').val($(this).data('date'));
            $('[name="doc_type_id"]').val($(this).data('doc_type_id')).attr('selected', 'selected');
            
            document.getElementById("editform").action = base_url+"/"+$(this).data('id');
        });

    </script>
@endpush