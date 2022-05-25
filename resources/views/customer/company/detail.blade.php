@extends('customer.layouts.master')
@section('company','active')
@section('content') 
    <h1 class="page-header"> {{trans('customer.company_detail')}}</h1>
    <div class="panel panel-inverse">
     
    <div class="panel-body">
       
        <table class="table table-striped table-bordered" style="width: 50%">
           
            <tbody>
              <tr>
                <td width="200px">{{trans('customer.com_name')}}</td>
                <td>{{$data->name}}({{$data->name_en}})</td>
              </tr>
              <tr>
                <td>{{trans('customer.com_email')}}</td>
                <td>{{$data->email}}</td>
              </tr>
              <tr>
                <td>{{trans('customer.com_phone')}}</td>
                <td>{{$data->phone}}</td>
              </tr>
              <tr>
                <td>{{trans('customer.fax')}}</td>
                <td>{{$data->fax}}</td>
              </tr>
              <tr>
                <td>{{trans('user.address')}}</td>
                <td>{{$data->address}}</td>
              </tr>
              <tr>
                <td>{{trans('customer.owner_name')}}</td>
                <td>{{$data->contact_name}}({{$data->contact_name_en}})</td>
              </tr>
              <tr>
                <td>{{trans('customer.owner_phone')}}</td>
                <td>{{$data->contact_phone}}</td>
              </tr>
              <tr>
                <td>{{trans('customer.tax_number')}}</td>
                <td>{{$data->tax_number}}</td>
              </tr>
               <tr>
                <td>{{trans('customer.country')}}</td>
                <td>{{$data->country_id?$data->country->name:''}}</td>
              </tr>
              

            </tbody>
        </table>
    </div>
    </div>



 @endsection 
