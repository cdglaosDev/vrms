@extends('customer.layouts.master')
@section('app','active')
@section('content')
@php
$company = \App\Model\Company::where('user_id',auth()->user()->id)->get();
$app_type = \App\Model\ApplicationType::whereStatus(1)->get();
$licen_type = \App\Model\AppLicenseType::get();
$tax_office = \App\Model\TaxOffice::get();
$app_purpose = \App\Model\AppPurpose::whereStatus(1)->get();
$app_status = \App\Model\ApplicationStatus::whereStatus(1)->get();
$doc_type = \App\Model\ApplicationDocType::whereStatus(1)->get();
@endphp
    <h1 class="page-header">{{trans('customer.app_edit')}}</h1>
  <div class="panel panel-inverse">
  @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif 
    <div class="panel-body">
       <form enctype="multipart/form-data" action="{{route('app.update',['id'=>$data->id])}}"  method="POST" >
                  @method('Patch')
                      @csrf
         
         
            <div class="form-row">
              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">{{trans('customer.com_name')}}:</label>
                <select name="company_id" class="form-control" required="">
                  <option value="" selected disabled >Select Company </option>
                  @foreach($company as $com)
                  <option value="{{$com->id}}" {{ $data->company_id == $com->id ? 'selected' : '' }}>{{$com->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">{{trans('customer.app_date')}}:</label>
                <input type="text" class="date form-control" id="validationCustom01"  placeholder="Enter Application Date" name="date_req" value="{{\App\Helpers\DateHelper::showDate($data->date_req)}}" required="">
              </div>
               <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">{{trans('customer.app_type')}}:</label>
                <select name="application_type_id" class="form-control" required="">
                  <option value="" selected disabled>Select App Type </option>
                  @foreach($app_type as $type)
                  <option value="{{$type->id}}" {{ $data->application_type_id == $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">{{trans('customer.lic_type')}}:</label>
                <select name="app_license_type_id" class="form-control" required="">
                  <option value="" selected disabled>Select License Type </option>
                  @foreach($licen_type as $licen)
                  <option value="{{$licen->id}}" {{ $data->app_license_type_id == $licen->id ? 'selected' : '' }}>{{$licen->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">{{trans('customer.min_lic')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{$data->ministry_license}}" placeholder="Enter Ministry License" name="ministry_license" required="">
              </div>
               <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">{{trans('customer.tax_office')}}:</label>
                <select name="tax_office_id" class="form-control" required="">
                  <option value="" selected disabled>Select Tax Office </option>
                  @foreach($tax_office as $tax)
                  <option value="{{$tax->id}}" {{ $data->tax_office_id == $tax->id ? 'selected' : '' }}>{{$tax->office_name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">{{trans('customer.dept_lic')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{$data->department_license}}" placeholder="Enter Department License" name="department_license" required="">
              </div>
              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">{{trans('customer.date_approve')}}:</label>
                <input type="text" class="date form-control" id="validationCustom01" value="{{\App\Helpers\DateHelper::showDate($data->detail_date_approve)}}" placeholder="Choose Approved Date" name="detail_date_approve" required="">
              </div>
              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">{{trans('customer.date_expire')}}:</label>
                <input type="text" class="date form-control" id="validationCustom01" value="{{\App\Helpers\DateHelper::showDate($data->date_expire)}}" placeholder="Choose Expire Date" name="date_expire" required="">
              </div>
               <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">{{trans('customer.extra_time')}}:</label>
                <input type="text" class=" form-control" id="validationCustom01" value="{{$data->extra_time}}" placeholder="Choose Extra time" name="extra_time">
              </div>

               <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">{{trans('customer.purpose')}}:</label>
                <select name="app_purpose_id" class="form-control" required="">
                  <option value="" selected disabled>Select Purpose</option>
                  @foreach($app_purpose as $pur)
                  <option value="{{$pur->id}}" {{ $data->app_purpose_id == $pur->id ? 'selected' : '' }}>{{$pur->name}}({{$pur->name_en}})</option>
                  @endforeach
                </select>
              </div>
             
              <div class="col-md-6 col-sm-6 mb-3">
                <label for="validationCustom01">{{trans('customer.note')}}:</label>
                <textarea class="form-control" id="validationCustom01" value="" placeholder="Enter Note" name="note" rows="5">{{$data->note}}</textarea> 
              </div>
              <div class="col-md-6 col-sm-6 mb-3">
                <label for="validationCustom01">{{trans('customer.comment')}}:</label>
                <textarea class="form-control" value="" placeholder="Enter  Comment" name="comment" rows="5">{{$data->comment}}</textarea> 
              </div>
            </div>
         
          <hr/>

         <h4>App Document</h4>
         <div class="row">
          <div class="col-sm-6 col-md-6 md-offset-6"> 
          <table class="table table-bordered" id="app-document"> 
          <thead>
            <tr>
                <th>Document Type</th>
                <th>Document Filename</th>
               
                <th><button type="button" name="add" id="add" class="btn btn-success"><i class="fas fa-plus"></i></button></th>
            </tr>
            </thead> 
            @foreach($data->app_docs as $app)
            <tr id="test">  
                <td>
                  <div class="form-group">
                  <select name="doc_type_id[]" class="form-control">
                    <option value="" selected disabled hidden>Select Document Type </option>
                     @foreach($doc_type as $data)
                    <option value="{{$data->id}}" {{$data->id == $app->doc_type_id?'selected':''}}>{{$data->name}}</option>
                    @endforeach
                  </select>
                </div>
                </td>  
                <td>
                  <div class="form-group ">
                   <input type="file" name="filename[]" value="" required="" />
                    
                   
                        </div></td>  
                
                <td><button type="button" class="btn btn-danger remove-tr"><i class="fas fa-minus"></i></button></td>
            </tr> 
            @endforeach
            <tr id="test" style="display: none">  
                <td>
                  <div class="form-group doc_type">
                  <select name="doc_type_id[]" class="form-control ">
                    <option value="" selected disabled hidden>Select Document Type </option>
                     @foreach($doc_type as $data)
                    <option value="{{$data->id}}">{{$data->name}}</option>
                    @endforeach
                  </select>
                </div>
                </td>  
                <td>
                  <div class="form-group filename">
                   <input type="file" name="filename[]" value="" />
                  </div>
                </td>  
                
                 
            </tr> 
        </table> 
        </div>
         </div>
            
           <div class="col-md-12 col-sm-12 text-right">
          
             <a class="btn  btn-secondary" href="{{url('customer/apps/all')}}">{{trans('button.cancel')}}</a>
             <button type="submit" class="btn btn-success">{{trans('button.update')}}</button>
            </div>
           
          </div>
        </form>
        
    </div>
  </div>


@include('delete')
 @endsection 
 @push('page_scripts')
<script type="text/javascript">
    
    $("#add").click(function(){
    var doc_type = '<div class="form-group">'+$('.doc_type').html()+'</div>';
    var filename = '<div class="form-group ">'+$('.filename').html()+'</div>';
    $("#app-document").append(
      '<tr>'+
      '<td>'+ doc_type + '</td>'+
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
