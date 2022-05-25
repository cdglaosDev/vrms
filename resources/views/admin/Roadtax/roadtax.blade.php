@extends('layouts.master')
@section('vims','active')
@section('content') 
   
     <h1 class="page-header">{{trans('title.roadtex')}}</h1>
    <div class="panel panel-inverse">
    @include('flash') 
  <div class="row">
        <div class="col-lg-12 add-new">
           
            <div class="pull-left">
                <a data-toggle="modal"  data-target="#addModel1" class="btn btn-primary btn-save">{{trans('button.roadtex')}}</a>
            </div>
        </div>
    </div>

       <div class="panel-body">
         <table id="myTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
           
                <th>{{trans('book.amount')}}</th>
                 <th>{{trans('book.currency')}}</th>
                  <th>{{trans('book.file')}}</th>
                   <th>{{trans('book.date')}}</th>
               <th>{{trans('book.remark')}}</th>

                
                <th>{{trans('table.status')}}</th>
                <th>{{trans('table.action')}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($roadtaxes as $key=>$data)
                        <tr>
                            
                              <td>{{$data->amount}}</td>
                               <td>{{$data->currency}}</td>
                              {{-- <td>{!! Str::limit($data->desc,15)!!}</td>--}} 

                         <td>{{$data->file}}</td>
                          <td>{{$data->date}}</td>
                            <td>{{$data->remark}}</td>
                             <td>@if($data->status ==1)Active @else Deactive @endif</td>
                                <td>

                        <button type="button" class="btn btn-info btn-sm  edit_btn"
                        data-toggle="modal" data-target="#editModel"
                        data-act="Edit"
                        data-amount="{{$data->amount}}"
                         data-currency="{{$data->currency}}"
                          data-remark="{{$data->remark}}"
                       data-file="{{$data->file}}"
                       data-date="{{$data->date}}"
                        data-status="{{$data->status}}"
                          data-app_form_id="{{$data->app_form_id}}"
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
  
    

@component('component.admin.roadtax',['appform'=>$appform])
 @endcomponent
 @endsection 
@push('page_scripts')

 <script type="text/javascript">

     var base_url = "{{url('admin/road-tax')}}";
      
     $(document).on("click", '.delete_btn', function (e) {  
            
            document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
        });

         $(document).on("click", '.edit_btn', function (e) {           
           
          
            $('[name="amount"]').val($(this).data('amount'));
            $('[name="currency"]').val($(this).data('currency'));
             $('[name="file"]').val($(this).data('file'));
           $('[name="date"]').val($(this).data('date'));
            $('[name="remark"]').val($(this).data('remark'));
             $('[name="app_form_id"]').val($(this).data('app_form_id'));
            $('[name="status"]').val($(this).data('status'));

            document.getElementById("editform").action = base_url+"/"+$(this).data('id');
        });

    </script>
@endpush