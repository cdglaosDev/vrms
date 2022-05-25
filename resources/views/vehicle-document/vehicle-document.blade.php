@extends('layouts.master')
@section('vims','active')
@section('content')	
		<h1 class="page-header">{{ trans('module4.doc_mang')}}</h1>
    <div class="card">
<div class="card-body pt-1">
		@include('flash')

	 <div class="row">
        <div class="col-lg-12 add-new">
            <div class="pull-left">
              @can('Document-Management-Create')
                <a data-toggle="modal"  data-target="#addModel1" class="btn btn-primary btn-save btn-sm text-white">{{trans('common.add_new')}}</a>
              @endcan
            </div>
        </div>
    </div>
		<div class="panel-body">
         <table id="myTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
							<tr>
								<th>Vehicle</th>
								<th>Province</th>
								<th>Application Doc Type </th>
								<th>Channel</th>
								<th> Date</th>
								<th>Action</th>
							</tr>
				</thead>
				<tbody>
						  @foreach($document as $data)
                        <tr>
                          <td>{{ $data->license_no}}</td>
                          <td>@if(isset($data-> province ->name))<span>{{$data->province['name']}}({{$data->province['name_en']}})</span>@else{{"_"}}@endif</td>
                          <td>@if(isset($data-> doctype ->name))<span>{{$data->doctype['name']}}({{$data->doctype['name_en']}})</span>@else{{"_"}}@endif</td>
                          <td>@if(isset($data->channel))<span>{{$data->channel}}</span>@else{{"_"}}@endif</td>
                          <td>{{$data->date}}</td>
                          <td>
                            @can('Document-Management-Edit')
                              <button type="button" class="btn btn-primary  edit_btn"
                              data-toggle="modal" data-target="#editModel"
                              data-act="Edit"
                              data-license_no="{{$data->license_no}}"
                              data-doc_type_id="{{$data->doc_type_id}}"
                              data-filename="{{$data->filename}}"
                                data-date="{{$data->date}}"
                              data-province_code="{{$data->province_code}}"
                              data-status="{{$data->status}}"
                                data-channel="{{$data->channel}}"
                              data-link="{{$data->link}}"
                              data-note="{{$data->note}}"
                                data-location="{{$data->location}}"
                              data-floor="{{$data->floor}}"
                              data-id="{{$data->id}}">{{trans('button.edit')}}
                              </button>
                            @endcan
                            @can('Document-Management-Delete')
                             <button type="button" class="btn btn-danger delete_btn"
                              data-toggle="modal" data-target="#deleteModel"
                              data-act="Delete"
                              data-id="{{$data->id}}">{{trans('button.delete')}}
                            </button>
                            @endcan
                          </td>
    
                        </tr>  
                         @endforeach 
                         </tbody>
					</table>
    </div>
				</div>
			</div>

@component('component.admin.vehicle-document',['vehdocument'=>$vehdocument,'province'=>$province])
 @endcomponent
@include('delete')
 @endsection 
@push('page_scripts')

 <script type="text/javascript">

     var base_url = "{{url('/document-management')}}";
      
        $(document).on("click", '.delete_btn', function (e) {  
            document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
        });

       $(document).on("click", '.edit_btn', function (e) {           
           
            $('[name="license_no"]').val($(this).data('license_no'));
             $('[name="doc_type_id"]').val($(this).data('doc_type_id'));
              $('[name="province_code"]').val($(this).data('province_code'));
             $('[name="link"]').val($(this).data('link'));
               $('[name="date"]').val($(this).data('date'));
            $('[name="location"]').val($(this).data('location'));
             $('[name="floor"]').val($(this).data('floor'));
             $('[name="channel"]').val($(this).data('channel'));
            $('[name="status"]').val($(this).data('status'));
              $('[name="note"]').val($(this).data('note'));
            $('[name="filename"]').val($(this).data('filename'));
            document.getElementById("editform").action = base_url+"/"+$(this).data('id');
        });

    </script>
@endpush
