@extends('layouts.master')
@section('importer','active')
@section('content') 
    <h1 class="page-header"> {{trans('importer.company_detail')}}</h1>
    <div class="panel panel-inverse">
     
    <div class="panel-body">
       
        <table class="table table-striped table-bordered" style="width: 100%">
           
            <tbody>
              <tr>
                <td width="400px">{{trans('importer.contact_name')}}</td>
                <td>{{$import_company->contact_name}} </td>
              </tr>
              <tr>
                <td width="400px">{{trans('importer.contact_name_en')}}</td>
                <td>{{$import_company->contact_name_en}}</td>
              </tr>
              <tr>
                <td>{{ trans('importer.contact_ph') }}</td>
                <td>{{$import_company->contact_phone}}</td>
              </tr>
              <tr>
                <td>{{ trans('importer.com_name') }}</td>
                <td>{{$import_company->name}}</td>
              </tr>
              <tr>
                <td>{{ trans('importer.com_name_en') }}</td>
                <td>{{$import_company->name_en}}</td>
              </tr>
              <tr>
                <td>{{ trans('importer.com_code') }}</td>
                <td>{{$import_company->code}}</td>
              </tr>
              <tr>
                <td>{{ trans('importer.com_tax_no') }}</td>
                <td>{{$import_company->tax_number}}</td>
              </tr>
              <tr>
                <td>{{ trans('importer.country') }}</td>
                <td>@if(isset($import_company->country->name)){{$import_company->country->name}}({{$import_company->country->name_en}})@endif</td>
              </tr>
              <tr>
                <td>{{ trans('importer.telephone') }}</td>
                <td>{{$import_company->phone}}</td>
              </tr>
              <tr>
                <td>{{ trans('importer.address') }}</td>
                <td>{{$import_company->address}}</td>
              </tr>
              <tr>
                <td>{{ trans('customer.fax') }}</td>
                <td>{{$import_company->fax}}</td>
              </tr>
              <tr>
                <td>{{ trans('importer.email') }}</td>
                <td>{{$import_company->email}}</td>
              </tr>

            </tbody>
        </table>
        
        <div class="modal-footer">
            <a href="/import-company" class="btn btn-secondary">{{trans('button.cancel')}}</a>
        </div>
    </div>
    </div>



 @endsection 
