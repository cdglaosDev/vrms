@extends('layouts.master')
@section('vims','active')
@section('content') 
    <h1 class="page-header">Division No Sub Control</h1>
    <div class="card">
    <div class="card-body">
    @include('flash') 
    <div class="row">
        <div class="col-lg-12">
          
            <div class="pull-left">
                <a data-toggle="modal"  data-target="#addModel" class="btn btn-primary btn-save btn-sm" style="color: #fff !important">Add New</a>
            </div>
          
        </div>
    </div>
   <div class="card-body">
         <table id="order-listing" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th>{{ trans('DivisionNoControl.province_code') }}</th>
                <th>{{ trans('DivisionNoControl.division_no_start') }}</th>
                <th>{{ trans('DivisionNoControl.division_no_end') }}</th>
                <th>{{ trans('DivisionNoControl.alert_at') }}</th>
                <th>{{ trans('DivisionNoControl.present_division_no') }}</th>
                <th>{{ trans('DivisionNoControl.status') }}</th>
                <th width="200">{{ trans('DivisionNoControl.action') }}</th>
              </tr>
        </thead>
        <tbody>
              @foreach ($sub_control as $data)
                        <tr>
                              <td>@if(isset($data->province->name))<span>{{$data->province['name']}}({{$data->province['name_en']}})</span>@else{{"_"}}@endif</td>
                              <td>{{$data ->division_no_start}}</td>
                              <td>{{$data ->division_no_end}}</td>
                              <td>{{$data ->alert_at}}</td>
                              <td>{{$data ->present_division_no}}</td>
                              <td>{{ $data->status}}</td>
                        <td>
                        <a  class="text-white btn btn-info edit_btn"
                        data-toggle="modal" data-target="#editModel"
                        data-act="Edit"
                        data-province_code="{{ $data->province_code }}"
                        data-division_no_start="{{$data->division_no_start}}"
                        data-division_no_end="{{$data->division_no_end}}"
                        data-alert_at="{{$data->alert_at}}"
                        data-status="{{$data->status}}"
                        data-id="{{$data->id}}">{{trans('button.edit')}}</a>  
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
      </div>
@include('delete')
@include('Module4.DivisionNoSubControl.Modal')
@endsection

  
@push('page_scripts')

 <script type="text/javascript">

     var base_url = "{{url('/division-no-sub-control')}}";
      
     $(document).on("click", '.delete_btn', function (e) {  
            document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
        });

        $(document).on("click", '.edit_btn', function (e) {  
           $('[name="province_code"]').val($(this).data('province_code'));
           $('[name="division_no_start"]').val($(this).data('division_no_start'));
           $('[name="division_no_end"]').val($(this).data('division_no_end'));
           $('[name="alert_at"]').val($(this).data('alert_at'));
           $('[name="present_division_no"]').val($(this).data('present_division_no'));
           $('[name="status"]').val($(this).data('status'));

           document.getElementById("editform").action = base_url+"/"+$(this).data('id');
       });

    </script>
@endpush