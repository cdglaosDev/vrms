@extends('customer.layouts.master')
@section('app','active')
@section('content') 
    <h1 class="page-header"> {{trans('customer.app_detail')}}</h1>
    <div class="panel panel-inverse">
     
    <div class="panel-body">
       
        <table class="table table-striped table-bordered" style="width: 50%">
           
            <tbody>
              <tr>
                <td width="200px">Application ID</td>
                <td>{{$data->regapp_number !=""?$data->regapp_number:""}} </td>
              </tr>
             
              <tr>
                <td>Applicaton Date</td>
                <td>@if($data->date_req){{\App\Helpers\DateHelper::showDate($data->date_req)}} @endif</td>
              </tr>
              <tr>
                <td>Applicaton Type</td>
                <td>@if($data->application_type_id){{$data->app_type->name}} @endif</td>
              </tr>
           
             
              <tr>
                <td>App Purpose</td>
                <td>@if($data->app_purpose_id){{$data->app_purpose->name}}@endif</td>
              </tr>
              <tr>
                <td>App Status</td>
                <td>{{$data->app_status->name_en}}</td>
              </tr>
               <tr>
                <td>Note</td>
                <td>{{$data->note}}</td>
              </tr>
               <tr>
                <td>Comment</td>
                <td>{{$data->comment}}</td>
              </tr>

            </tbody>
        </table>
        <h4>Document Types</h4>
        <table class="table table-striped table-bordered" style="width: 50%">
      <tr>
        <td>Document Type</td>
        <td>Filename</td>
      </tr>
      <tbody>
      @foreach($data->vehicle_detail->doc as $doc)
          <tr>
              <td>{{$doc->doctype->name_en}}</td>
              <td><a href="{{asset('images/doc/'.$doc->filename)}}" target="_blank">{{$doc->filename}}</a></td>
          </tr>

      @endforeach
      </tbody>
      </table>
    </div>
    
    </div>



 @endsection 
