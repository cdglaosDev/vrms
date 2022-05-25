@extends('layouts.master')
@section('finance','active')

@section('content') 
    <h1 class="page-header">{{trans('title.reciept_status')}}</h1>
    <div class="panel panel-inverse">
    @include('flash') 
  <div class="row">
        <div class="col-lg-12 add-new">
           
            <div class="pull-left">
                <a data-toggle="modal"  data-target="#addModel" class="btn btn-primary btn-save">{{trans('common.add_new')}}</a>
            </div>
        </div>
    </div>
    

    <div class="panel-body">
         <table id="myTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                
                <th>{{trans('common.name')}}(lao)</th>
                <th>{{trans('common.name')}} (Eng)</th>
                <th>{{trans('common.status')}}</th>
                <th>{{trans('common.action')}}</th>
                
              </tr>
        </thead>
          <tbody>
            @foreach($data as $ps)
            <tr>
              <td>{{$ps->name}}</td>
              <td>{{$ps->name_en}}</td>
              <td>{{$ps->status}}</td>
              <td> <a href="" class="btn btn-primary btn-sm  edit_btn"
                        data-toggle="modal" data-target="#editModel"
                        data-act="Edit"
                        data-name="{{$ps->name}}"
                         data-name_en="{{$ps->name_en}}"
                       @if($ps->status == "Active") data-status="1" @else data-status=0 @endif
                        data-id="{{$ps->id}}">{{trans('button.edit')}}
                        </a>
                      <a href="" class="btn btn-danger btn-sm  delete_btn"
                        data-toggle="modal" data-target="#deleteModel"
                      
                        data-id="{{$ps->id}}">{{trans('button.delete')}}
                        </a>
                      </td>
            </tr>
            @endforeach
          </tbody>
          </table>
        
        </div>
      </div>

@include('RecieptStatus.model')
@include('delete')
 @endsection 
@push('page_scripts')

 <script type="text/javascript">
  var myTable = $('#myTable').DataTable(); 
     var base_url = "{{url('reciept-status')}}";
      
     $(document).on("click", '.delete_btn', function (e) {  
            
            document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
        });

         $(document).on("click", '.edit_btn', function (e) {           
          
           
            $('[name="name"]').val($(this).data('name'));
            $('[name="name_en"]').val($(this).data('name_en'));

            $('[name="status"]').val($(this).data('status')).attr('selected', 'selected');
            
            document.getElementById("editform").action = base_url+"/"+$(this).data('id');
        });

    </script>
@endpush