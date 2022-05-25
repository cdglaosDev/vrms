@extends('layouts.master')
@section('vims','active')
@section('content') 
   
     <h1 class="page-header">{{trans('title.olddocument')}}</h1>
    <div class="card">
    @include('flash') 
  <div class="row">
        <div class="col-lg-12 add-new">
           
            <div class="pull-left">
                <a data-toggle="modal"  data-target="#addModel1" class="btn btn-primary btn-save">{{trans('button.olddocument')}}</a>
            </div>
        </div>
    </div>

       <div class="card-body">
         <table id="order-listing" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
           
                <th>{{trans('book.olddepartment')}}</th>
                 <th>{{trans('book.olddocumentcat')}}</th>
                  <th>{{trans('book.remark')}}</th>
                  <th>{{trans('book.date')}}</th>
                  <th>{{trans('table.status')}}</th>
                 <th>{{trans('table.action')}}</th>
                
              </tr>
            </thead>
            <tbody>
              @foreach($documents as $key=>$data)
                        <tr>
                            <td>{{$data->departments['name']}}</td>
                            <td>{{$data->olds['name']}}</td>
                              
                               <td>{!! Str::limit($data->remark,15)!!}</td>
                         <td>{{$data->date}}</td>
                         <td>@if($data->status ==1)Active @else Deactive @endif</td>
                                <td>

                        <button type="button" class="btn btn-info btn-sm  edit_btn"
                        data-toggle="modal" data-target="#editModel"
                        data-act="Edit"
                        data-department="{{$data->department}}"
                         data-type="{{$data->type}}"
                          data-remark="{{$data->remark}}"
                        data-date="{{$data->date}}"
                          data-file="{{$data->file}}"
                        data-status="{{$data->status}}"
                        data-id="{{$data->id}}">{{trans('button.edit')}}
                        </button>
                      
                             <button type="button" class="btn btn-danger btn-sm delete_btn"
                        data-toggle="modal" data-target="#deleteModel"
                        data-act="Delete"
                        data-id="{{$data->id}}">{{trans('button.delete')}}
                    </button></td>
                          
                        </tr>  
                         @endforeach 
              
            </tbody>
          </table>
         
        </div>
        
      </div>
  
    

@component('component.admin.olddocument',['department'=>$department,'olddocument'=>$olddocument])
 @endcomponent
 @endsection
@push('page_scripts')

 <script type="text/javascript">
    var myTable = $('#myTable').DataTable(); 
     var base_url = "{{url('admin/olddocument')}}";
      
     $(document).on("click", '.delete_btn', function (e) {  
            
            document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
        });

         $(document).on("click", '.edit_btn', function (e) {           
           
          
            $('[name="department"]').val($(this).data('department'));
            $('[name="type"]').val($(this).data('type'));
             $('[name="remark"]').val($(this).data('remark'));
            $('[name="file"]').val($(this).data('file'));
              $('[name="date"]').val($(this).data('date'));
            $('[name="status"]').val($(this).data('status'));

            document.getElementById("editform").action = base_url+"/"+$(this).data('id');
        });

    </script>
@endpush