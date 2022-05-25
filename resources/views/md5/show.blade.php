@extends('layouts.master')
@section('importer','active')
@section('content') 
@php
$appstatus=\App\Model\ApplicationStatus::get();
$staff = \App\Model\Staff::whereStatus(1)->get();
$doc_type =\App\Model\ApplicationDocType::get();
@endphp
<style>
    .nav-pills .nav-link, .nav-pills>li>a{
        border: 1px solid !important;
        padding: 10px !important;
    }
</style>
    <h1 class="page-header">Show</h1>
  <div class="panel panel-inverse">
  
 {{--  <div class="panel-body">
       <form  action="{{route('application-form.store')}}"  method="POST">
                  @method('post')
                      @csrf
         
         
         
               
            </div>  --}}
            <hr style="width: 100% ;color:#000" class="mb-3">
                <ul  class="nav nav-pills">
         
			<li class="active">
            <a  href="#1a" data-toggle="tab">Pre Registration Application</a>
			</li>
			<li><a href="#2a" data-toggle="tab">Vehicle Detail</a>
			</li>
			<li><a href="#3a" data-toggle="tab">Application Document</a>
			</li>
  		   
		</ul>

			<div class="tab-content mb-3 clearfix">
           
			  <div class="tab-pane active" id="1a">
              
              <div class="row">
              <div class="col-md-2">
                <p>Staff Name</p>
              </div>
              <div class="col-md-3">
                <p>: &nbsp @if(isset($prereg-> staff -> name))<span>{{$prereg->staff['name']}}({{$prereg->staff['name_en']}})</span>@else{{"_"}}@endif</p>
              </div>
            </div>
             <div class="row">
              <div class="col-md-2">
                <p>Application Status</p>
              </div>
              <div class="col-md-3">
                <p>:  &nbsp @if(isset($prereg-> app_status -> name))<span>{{$prereg->app_status['name']}}({{$prereg->app_status['name_en']}})</span>@else{{"_"}}@endif</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <p>User Name</p>
              </div>
              <div class="col-md-3">
                <p>:  &nbsp @if(isset($prereg-> user -> name))<span>{{$prereg->user['first_name']}}({{$prereg->user['last_name']}})</span>@else{{"_"}}@endif</p>
              </div>
            </div>
             <div class="row">
              <div class="col-md-2">
                <p>App Number</p>
              </div>
              <div class="col-md-3">
                <p>: &nbsp @if(isset($prereg->app_number))<span>{{$prereg->app_number}}</span>@else{{"_"}}@endif</p>
              </div>
            </div>
             <div class="row">
              <div class="col-md-2">
                <p>Reg App Number</p>
              </div>
              <div class="col-md-3">
                <p>: &nbsp @if(isset($prereg->regapp_number))<span>{{$prereg->regapp_number}}</span>@else{{"_"}}@endif</p>
              </div>
            </div>
             <div class="row">
              <div class="col-md-2">
                <p>Date</p>
              </div>
              <div class="col-md-3">
                <p>: &nbsp {{$prereg->date_request}}</p>
              </div>
            </div>
             <div class="row">
              <div class="col-md-2">
                <p>Comment</p>
              </div>
              <div class="col-md-3">
                <p>: &nbsp {{$prereg->comment}}</p>
              </div>
            </div>
          <div class="row">
          	
              <button type="button" class="btn btn-primary edit_btn"
                        data-toggle="modal" data-target="#editModel"
                        data-act="Edit"
                        data-comment="{{$prereg->comment}}"
                        data-date_request="{{$prereg->date_request}}"
                         data-regapp_number="{{$prereg->regapp_number}}"
                         data-app_number="{{$prereg->app_number}}"
                         data-user_id="{{$prereg->user_id}}"
                          data-user_id="{{$prereg->user_id}}"
                         data-vehicle_detail_id="{{$prereg->vehicle_detail_id}}"
                          data-staff_approve_id="{{$prereg->staff_approve_id}}"
                          data-regapp_number="{{$prereg->regapp_number}}"
                       data-id="{{$prereg->id}}">{{trans('button.edit')}}
                        </button>
                      
              
            </div>
          
     
          </div>
      
				
				<div class="tab-pane" id="2a">
				<div class="col-md-12">
               <div class="row">
             
              <div class="col-md-2">
                <p>Owner Name</p>
              </div>
              <div class="col-md-4">
                <p>:&nbsp @if(isset($prereg-> vehicle_detail -> owner_name))<span>{{$prereg->vehicle_detail['owner_name']}}</span>@else{{"_"}}@endif</p>
              </div>
           
          
              <div class="col-md-2">
                <p>Tenant Name</p>
              </div>
              <div class="col-md-4">
                <p>: &nbsp @if(isset($prereg-> vehicle_detail -> tenant_name))<span>{{$prereg->vehicle_detail['tenant_name']}}</span>@else{{"_"}}@endif</p>
              </div>
          
        </div>
    </div>
         	<div class="col-md-12">
             <div class="row">
              <div class="col-md-2">
                <p>Village Name</p>
              </div>
              <div class="col-md-4">
                <p>: &nbsp @if(isset($prereg-> vehicle_detail -> village_name))<span>{{$prereg->vehicle_detail['village_name']}}</span>@else{{"_"}}@endif</p>
              </div>
           
           
              <div class="col-md-2">
                <p>License No</p>
              </div>
              <div class="col-md-4">
                <p>: &nbsp @if(isset($prereg-> vehicle_detail->licence_no))<span>{{$prereg->vehicle_detail['licence_no']}}</span>@else{{"_"}}@endif</p>
              </div>
            </div>
        </div>
        <div class="col-md-12">
             <div class="row">
              <div class="col-md-2">
                <p>License No Need</p>
              </div>
              <div class="col-md-4">
                <p>: &nbsp @if(isset($prereg-> vehicle_detail-> licence_no_need))<span>{{$prereg->vehicle_detail['licence_no_need']}}</span>@else{{"_"}}@endif</p>
              </div>
           
          
              <div class="col-md-2">
                <p>Vehicle Purpose Name</p>
              </div>
              <div class="col-md-4">
                <p>: &nbsp @if(isset($prereg-> vehicle_detail->apppurpose))<span>{{$prereg->vehicle_detail->apppurpose['name']}}({{$prereg->vehicle_detail->apppurpose['name_en']}})</span>@else{{"_"}}@endif</p>
              </div>
            </div>
        </div>
        <div class="col-md-12">
             <div class="row">
              <div class="col-md-2">
                <p>Province Name</p>
              </div>
              <div class="col-md-4">
                <p>:  &nbsp @if(isset($prereg-> vehicle_detail->province))<span>{{$prereg->vehicle_detail->province['name']}}({{$prereg->vehicle_detail->province['name_en']}})</span>@else{{"_"}}@endif</p>
              </div>
           
           
              <div class="col-md-2">
                <p>District Name</p>
              </div>
              <div class="col-md-4">
                <p>: &nbsp @if(isset($prereg-> vehicle_detail -> district))<span>{{$prereg->vehicle_detail->district['name']}}({{$prereg->vehicle_detail->district['name_en']}})</span>@else{{"_"}}@endif</p>
              </div>
            </div>
        </div>
        <div class="col-md-12">
             <div class="row">
              <div class="col-md-2">
                <p>Seat</p>
              </div>
              <div class="col-md-4">
                <p>:  &nbsp @if(isset($prereg-> vehicle_detail ->seat))<span>{{$prereg->vehicle_detail['seat']}}</span>@else{{"_"}}@endif</p>
              </div>
              <div class="col-md-2">
                <p>Vehicle Type</p>
              </div>
              <div class="col-md-4">
                <p>:  &nbsp @if(isset($prereg-> vehicle_detail ->vehicletype))<span>{{$prereg->vehicle_detail->vehicletype['name']}}({{$prereg->vehicle_detail->vehicletype['name_en']}})</span>@else{{"_"}}@endif</p>
              </div>
            </div>
        </div>
        <div class="col-md-12">
             <div class="row">
              <div class="col-md-2">
                <p>Steering</p>
              </div>
              <div class="col-md-4">
               <p>: &nbsp @if(isset($prereg-> vehicle_detail -> steering))<span>{{$prereg->vehicle_detail->steering['name']}}({{$prereg->vehicle_detail->steering['name_en']}})</span>@else{{"_"}}@endif</p>
              </div>
           
           
              <div class="col-md-2">
                <p>Color</p>
              </div>
              <div class="col-md-4">
                <p>: &nbsp @if(isset($prereg-> vehicle_detail -> color))<span>{{$prereg->vehicle_detail->color['name']}}({{$prereg->vehicle_detail->color['name_en']}})</span>@else{{"_"}}@endif</p>
              </div>
            </div>
        </div>
        <div class="col-md-12">
             <div class="row">
              <div class="col-md-2">
                <p>Year Manufacture</p>
              </div>
              <div class="col-md-4">
                <p>: &nbsp @if(isset($prereg-> vehicle_detail -> year_manufacture))<span>{{$prereg->vehicle_detail['year_manufacture']}}</span>@else{{"_"}}@endif</p>
              </div>
           
           
              <div class="col-md-2">
                <p>Gas</p>
              </div>
              <div class="col-md-4">
                <p>:  &nbsp @if(isset($prereg-> vehicle_detail ->gas))<span>{{$prereg->vehicle_detail->gas['name']}}({{$prereg->vehicle_detail->gas['name_en']}})</span>@else{{"_"}}@endif</p>
              </div>
            </div>
        </div>
        <div class="col-md-12">
             <div class="row">
              <div class="col-md-2">
                <p>Wheel</p>
              </div>
              <div class="col-md-4">
                <p>:&nbsp @if(isset($prereg-> vehicle_detail -> wheels))<span>{{$prereg->vehicle_detail['wheels']}}</span>@else{{"_"}}@endif</p>
              </div>
           
           
              <div class="col-md-2">
                <p>Engine No</p>
              </div>
              <div class="col-md-4">
                <p>: &nbsp @if(isset($prereg-> vehicle_detail -> engine_no))<span>{{$prereg->vehicle_detail['engine_no']}}</span>@else{{"_"}}@endif</p>
              </div>
            </div>
        </div>
        <div class="col-md-12">
             <div class="row">
              <div class="col-md-2">
                <p>Chassis No</p>
              </div>
              <div class="col-md-4">
                <p>: &nbsp @if(isset($prereg-> vehicle_detail -> chassis_no))<span>{{$prereg->vehicle_detail['chassis_no']}}</span>@else{{"_"}}@endif</p>
              </div>
           
           
              <div class="col-md-2">
                <p>Weight</p>
              </div>
              <div class="col-md-4">
                <p>: &nbsp @if(isset($prereg-> vehicle_detail -> weight))<span>{{$prereg->vehicle_detail['weight']}}</span>@else{{"_"}}@endif</p>
              </div>
            </div>
        </div>
        <div class="col-md-12">
             <div class="row">
              <div class="col-md-2">
                <p>Import Permit NO</p>
              </div>
              <div class="col-md-4">
                <p>: &nbsp @if(isset($prereg-> vehicle_detail -> import_permit_no))<span>{{$prereg->vehicle_detail['import_permit_no']}}</span>@else{{"_"}}@endif</p>
              </div>
           
           
              <div class="col-md-2">
                <p>Import Permit Date</p>
              </div>
              <div class="col-md-4">
                <p>: &nbsp @if(isset($prereg-> vehicle_detail -> import_permit_date))<span>{{$prereg->vehicle_detail['import_permit_date']}}</span>@else{{"_"}}@endif</p>
              </div>
            </div>
        </div>
        <div class="col-md-12">
             <div class="row">
              <div class="col-md-2">
                <p>Commerce Permit No</p>
              </div>
              <div class="col-md-4">
                <p>:&nbsp @if(isset($prereg-> vehicle_detail -> comerce_permit_no))<span>{{$prereg->vehicle_detail['comerce_permit_no']}}</span>@else{{"_"}}@endif</p>
              </div>
           
           
              <div class="col-md-2">
                <p>Commerce Permit Date</p>
              </div>
              <div class="col-md-4">
                <p>: &nbsp @if(isset($prereg-> vehicle_detail -> comerce_permit_date))<span>{{$prereg->vehicle_detail['comerce_permit_date']}}</span>@else{{"_"}}@endif</p>
              </div>
            </div>
        </div>
        <div class="col-md-12">
             <div class="row">
              <div class="col-md-2">
                <p>Tax No</p>
              </div>
              <div class="col-md-4">
                <p>:   &nbsp @if(isset($prereg-> vehicle_detail ->tax_no))<span>{{$prereg->vehicle_detail['tax_no']}}</span>@else{{"_"}}@endif</p>
              </div>
           
           
              <div class="col-md-2">
                <p>Tax Date</p>
              </div>
              <div class="col-md-4">
                <p>:  &nbsp @if(isset($prereg-> vehicle_detail ->tax_date))<span>{{$prereg->vehicle_detail['tax_date']}}</span>@else{{"_"}}@endif</p>
              </div>
            </div>
        </div>
        <div class="col-md-12">
             <div class="row">
              <div class="col-md-2">
                <p>Tax Payment No</p>
              </div>
              <div class="col-md-4">
                <p>:   &nbsp @if(isset($prereg-> vehicle_detail -> tax_payment_no))<span>{{$prereg->vehicle_detail['tax_payment_no']}}</span>@else{{"_"}}@endif</p>
              </div>
           
           
              <div class="col-md-2">
                <p>Tax Payment Date</p>
              </div>
              <div class="col-md-4">
                <p>: &nbsp @if(isset($prereg-> vehicle_detail -> tax_payment_date))<span>{{$prereg->vehicle_detail['tax_payment_date']}}</span>@else{{"_"}}@endif</p>
              </div>
            </div>
        </div>
         <div class="col-md-12">
             <div class="row">
              <div class="col-md-2">
                <p>Police Doc No</p>
              </div>
              <div class="col-md-4">
                <p>: &nbsp @if(isset($prereg-> vehicle_detail -> police_doc_no))<span>{{$prereg->vehicle_detail['police_doc_no']}}</span>@else{{"_"}}@endif</p>
              </div>
           
           
              <div class="col-md-2">
                <p>Police Doc Date</p>
              </div>
              <div class="col-md-4">
                <p>: &nbsp @if(isset($prereg-> vehicle_detail -> police_doc_date))<span>{{$prereg->vehicle_detail['police_doc_date']}}</span>@else{{"_"}}@endif</p>
              </div>
            </div>
        </div>
         <div class="col-md-12">
             <div class="row">
              <div class="col-md-2">
                <p>Remark</p>
              </div>
              <div class="col-md-4">
                <p>: &nbsp @if(isset($prereg-> vehicle_detail -> remark))<span>{{$prereg->vehicle_detail['remark']}}</span>@else{{"_"}}@endif</p>
              </div>
           
           
              <div class="col-md-2">
                <p>Date Time Update</p>
              </div>
              <div class="col-md-4">
                <p>: &nbsp @if(isset($prereg-> vehicle_detail ->datetime_update	))<span>{{$prereg->vehicle_detail['datetime_update']}}</span>@else{{"_"}}@endif</p>
              </div>
            </div>
        </div>
         <div class="col-md-12">
             <div class="row">
              <div class="col-md-2">
                <p>Log Activity</p>
              </div>
              <div class="col-md-4">
                <p>: &nbsp @if(isset($prereg-> vehicle_detail ->log_activity	))<span>{{$prereg->vehicle_detail['log_activity']}}</span>@else{{"_"}}@endif</p>
              </div>
           
           
            </div>
        </div>
         <div class="col-md-2">
         <a href="{{route('vehicle-detail.edit',['id'=>$prereg->id])}}" class="btn btn-primary btn-sm">{{ trans('finance_button.edit') }}</a>
                    </div>
       </div>
			
            <div class="tab-pane" id="3a">
            <div class="row">
              <div class="col-md-2">
                <p>Document Type</p>
              </div>
              <div class="col-md-3">
              
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <p>File Name</p>
              </div>
              <div class="col-md-3">
                <p>: &nbsp @if(isset($prereg-> vehicle_detail ->appdocument))<span>@foreach($prereg-> vehicle_detail ->appdocument as $value)
                {{$value['filename']}}@endforeach</span>@else{{"_"}}@endif</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <p>Link</p>
              </div>
              <div class="col-md-3">
                <p>: &nbsp @if(isset($prereg->vehicle_detail->appdocument))<span>@foreach($prereg-> vehicle_detail ->appdocument as $value)
                {{$value['link']}}@endforeach</span>@else{{"_"}}@endif</p>
              </div>
            </div>
             <div class="row">
              <div class="col-md-2">
                <p>Date</p>
              </div>
              <div class="col-md-3">
                <p>:  &nbsp @if(isset($prereg-> vehicle_detail->appdocument))<span>@foreach($prereg-> vehicle_detail ->appdocument as $value)
                {{$value['date']}}@endforeach</span>@else{{"_"}}@endif</p>
              </div>
            </div>
             <div class="row">
          	
              <button type="button" class="btn btn-primary edit_btn1"
                        data-toggle="modal" data-target="#editModel1"
                        data-act="Edit"
                        data-comment="{{$prereg->comment}}"
                        data-date_request="{{$prereg->date_request}}"
                         data-regapp_number="{{$prereg->regapp_number}}"
                         data-app_number="{{$prereg->app_number}}"
                         
                       data-id="{{$prereg->id}}">{{trans('button.edit')}}
                        </button>
                      
              
            </div>
			</div>
           
           
			</div>
 
            </div>
           
        </form>
        
    </div>
  </div>


@include('delete')
   <div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" action="" id="editform" name="editform" method="POST">
                 
              <form  action="" method="POST"  id="editform" name="editform">
                @method('PATCH')
               @csrf
                  
          <h3 class="text-center">Update Pre Registrarion App</h3>
          <div class="modal-body">
            <div class="form-row">
                <div class="col-md-12 col-sm-4 mb-3">
                <label for="validationCustom01">Staff Name:</label>
                <select name="staff_approve_id"  class="form-control"  required="">
                  @foreach($staff as $com)
                  <option value="{{$com->id}}" class="style1" {{$prereg->staff_approve_id == $com->id ? 'selected' : '' }}>{{$com->name}}({{$com->name_en}})</option>
                  @endforeach
                </select>
              </div>
            
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">Date Request:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{$prereg->date_request}}" placeholder="" name="date_request" required="">
              </div>
               <div class="col-md-12 mb-3">
                <label for="validationCustom01">App Number:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{$prereg->app_number}}" placeholder="" name="app_number" required="">
              </div>
               <div class="col-md-12 mb-3">
                <label for="validationCustom01">Reg App Number:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{$prereg->regapp_number}}" placeholder="" name="regapp_number" required="">
              </div>
               <div class="col-md-12 col-sm-4 mb-3">
                                  <label for="">Application Status</label>
                                  <select class="form-control " id="status_id"  name="status_id" required="" >
                                   
                                    @foreach($appstatus as $data)
                                    <option value="{{$data->id}}" class="style1" {{$prereg->status_id == $data->id ? 'selected' : '' }}>{{ $data->name }}({{$data->name_en}})</option>
                                    @endforeach
                                 </select>
                              </div>
               

         
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" data-dismiss="modal" class="btn btn-secondary">{{trans('button.cancel')}}</button>
                    <button type="submit" class="btn btn-success">{{trans('button.save')}}</button>
                  
                  </div>
                </div>
              </form>
        </div>
    </div>
</div>

 <div class="modal fade" id="editModel1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" action="" id="editform" name="editform" method="POST">
                 
              <form  action="" method="POST"  id="editform1" name="editform">
                @method('PATCH')
               @csrf
                  
          <h3 class="text-center">Update App Document</h3>
          <div class="modal-body">
            <div class="form-row">
               <table  class="table table-bordered" id="app-document"> 
          <thead>
            <tr>
                <th style="width: 30%">Document Type</th>
                  <th style="width: 20%">Document link</th>
                   <th style="width: 20%">Document Date</th>
                <th style="width: 30%">Document Filename</th>
                
                <th>Action</i>
       </th>
            </tr>
            </thead> 
            <tr id="test">  
                <td>
                  <div class="form-group doc_type">
                  <select name="doc_type_id" class="form-control"  >
                    
                     @foreach($doc_type as $data)
                    <option value="{{$data->id}}">{{$data->name}}</option>
                    @endforeach
                  </select>
                </div>
                </td>
                <td>
                    <div class="form-group doc_link">
                 <input type="text" class="form-control"  value="@foreach($prereg-> vehicle_detail ->appdocument as $value)
                {{$value['link']}}@endforeach" placeholder="Enter Link" name="link">
             </div>
                </td> 
                <td>
                    <div class="form-group doc_date">
                 <input type="date" class="form-control"  value="@foreach($prereg-> vehicle_detail ->appdocument as $value)
                {{$value['date']}}@endforeach" placeholder="" name="date" >
             </div>
                </td> 
                  
                <td><div class="form-group filename">
                    <input type="text" name="filename" placeholder="Please Enter File"  class="form-control " value="@foreach($prereg-> vehicle_detail ->appdocument as $value)
                {{$value['filename']}}@endforeach" required="" /></div>
               </td>  
                <td><button type="button" name="add" id="add" class="btn btn-success"><i class="fas fa-plus"> </button></td>
               
            </tr>  
        </table> 
       
                
              </section>
                 <div class="modal-footer">
                  <button type="button" data-dismiss="modal" class="btn btn-secondary">{{trans('button.cancel')}}</button>
                    <button type="submit" class="btn btn-success">{{trans('button.save')}}</button>
                  
                  </div>
                </div>
              </form>
        </div>
    </div>
</div>

 @endsection 
 @push('page_scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	 <script type="text/javascript">
  var myTable = $('#myTable').DataTable(); 
     var base_url = "{{url('/pre-reg-app')}}";
      
     $(document).on("click", '.delete_btn', function (e) {  
            
            document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
        });

         $(document).on("click", '.edit_btn', function (e) {           
           
            $('[name="comment"]').val($(this).data('comment'));
            $('[name="user_id"]').val($(this).data('user_id'));
            $('[name="staff_approve_id"]').val($(this).data('staff_approve_id'));
            $('[name="regapp_number"]').val($(this).data('regapp_number'));
            $('[name="app_number"]').val($(this).data('app_number'));
            $('[name="date_request"]').val($(this).data('date_request'));
            $('[name="vehicle_detail_id"]').val($(this).data('vehicle_detail_id'));
         
 $('[name="status"]').val($(this).data('status'));
             
 
            document.getElementById("editform").action = base_url+"/"+$(this).data('id');
        });
    </script>

<script type="text/javascript">
  var myTable = $('#myTable').DataTable(); 
     var base_url1 = "#";
         $(document).on("click", '.edit_btn1', function (e) {           
           
            $('[name="comment"]').val($(this).data('comment'));
            $('[name="user_id"]').val($(this).data('user_id'));
            $('[name="staff_approve_id"]').val($(this).data('staff_approve_id'));
            $('[name="regapp_number"]').val($(this).data('regapp_number'));
           
            document.getElementById("editform1").action = base_url1+"/"+$(this).data('id');
        });

    </script>

         <script type="text/javascript">
    
    $("#add").click(function(){
    var doc_type = '<div class="form-group">'+$('.doc_type').html()+'</div>';
     var doc_link = '<div class="form-group">'+$('.doc_link').html()+'</div>';
     var doc_date = '<div class="form-group ">'+$('.doc_date').html()+'</div>';
    var filename = '<div class="form-group ">'+$('.filename').html()+'</div>';
    
    $("#app-document").append(
      '<tr>'+
      '<td>'+ doc_type + '</td>'+
        '<td>'+ doc_link + '</td>'+
       '<td>'+ doc_date + '</td>'+
      '<td>'+ filename + '</td>'+
      
      
      '<td><button type="button" class="btn btn-danger remove-tr"><i class="fas fa-minus"></i></button></td>'+
      '</tr>'
    );
       
    });
   
    $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
    }); 

   
</script>
@endpush
