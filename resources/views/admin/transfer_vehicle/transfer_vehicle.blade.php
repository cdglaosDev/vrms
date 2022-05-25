@extends('layouts.master')
@section('list','active')
@section('content') 
   
     <h1 class="page-header">{{trans('title.transfervehicle')}}</h1>
    <div class="panel panel-inverse">
    @include('flash') 
  <div class="row">
        <div class="col-lg-12 add-new">
           
            <div class="pull-left">
                <a data-toggle="modal"  data-target="#addModel1" class="btn btn-primary btn-save">{{trans('button.transfervehicle')}}</a>
            </div>
        </div>
    </div>

       <div class="panel-body">
         <table id="myTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
           
                <th>Transfer From</th>
                 <th>Transfer To</th>
                  <th>Vehicle Number</th>
                <th>Date</th>
                <th>Remark</th>
                <th>Action</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($transfers as $key=>$transfer)
                        <tr>
                                 <td>{{$transfer->transer_from}}</td>
                                 <td>{{$transfer->transer_to}}</td>
                                  <td>{{$transfer->new_vehicle_number}}</td>
                         <td>{{$transfer->date}}</td>
                         <td>{{$transfer->remark}}</td>
                                <td>

                        <button type="button" class="btn btn-info  edit_btn"
                        data-toggle="modal" data-target="#editModel"
                        data-act="Edit"
                        data-app_number="{{$transfer->app_number}}"
                         data-transfer_from="{{$transfer->province_id}}"
                          data-transfer_to="{{$transfer->province_id}}"
                           data-old_vehicle_number="{{$transfer->old_vehicle_number}}"
                            data-new_vehicle_number="{{$transfer->new_vehicle_number}}"
                          data-date="{{$transfer->date}}"
                           data-remark="{{$transfer->remark}}"
                        data-apply_by="{{$transfer->apply_by}}"
                         data-approved_officer="{{$transfer->approved_officer}}"
                        data-status="{{$transfer->status}}"
                        data-id="{{$transfer->id}}">{{trans('button.edit')}}
                        </button>
                      
                             <button type="button" class="btn btn-danger delete_btn"
                        data-toggle="modal" data-target="#deleteModel"
                        data-act="Delete"
                        data-id="{{$transfer->id}}">{{trans('button.delete')}}
                    </button></td>
                          <td>@if($transfer->status ==1)Active @else Deactive @endif</td>
                        </tr>  
                         @endforeach 
              
            </tbody>
          </table>
         
        </div>
        
      </div>
  
    
@endsection
@component('component.admin.transfervehicle',['province'=>$province])
 @endcomponent
  
@push('page_scripts')

 <script type="text/javascript">

     var base_url = "{{url('admin/transfer_vehicle')}}";
      
     $(document).on("click", '.delete_btn', function (e) {  
            
            document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
        });

         $(document).on("click", '.edit_btn', function (e) {           
           
          
            $('[name="app_number"]').val($(this).data('app_number'));
            $('[name="province_id"]').val($(this).data('province_id'));
             $('[name="province_id"]').val($(this).data('province_id'));
             $('[name="old_vehicle_number"]').val($(this).data('old_vehicle_number'));
               $('[name="new_vehicle_number"]').val($(this).data('new_vehicle_number'));
            $('[name="date"]').val($(this).data('date'));
              $('[name="remark"]').val($(this).data('remark'));
                $('[name="apply_by"]').val($(this).data('apply_by'));
                 $('[name="approved_officer"]').val($(this).data('approved_officer'));
            $('[name="status"]').val($(this).data('status'));

            document.getElementById("editform").action = base_url+"/"+$(this).data('id');
        });

    </script>
@endpush