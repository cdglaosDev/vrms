@extends('layouts.master')
@section('importer','active')
@section('content') 
    <h1 class="page-header">{{trans('importer.update_imp_com')}}</h1>
    <div class="panel panel-inverse">
    @include('flash') 
        <div class="body">
            <form action="{{route('import-company.update',['import_company'=> $import_company])}}" method="POST">
            
                @method('PATCH')
                      @csrf
                <div class="modal-body">
                    <div class="row pb-3">

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="contact_name">{{ trans('importer.contact_name') }}:</label>
                                <input type="text" name="contact_name" id="validationCustom01" class="form-control" value="{{old('contact_name')?? $import_company -> contact_name}}" required="">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="contact_name_en">{{ trans('importer.contact_name_en') }}:</label>
                                <input type="text" name="contact_name_en" id="validationCustom01" class="form-control" value="{{old('contact_name_en')?? $import_company -> contact_name_en}}" required="">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="contact_phone">{{ trans('importer.contact_ph') }}:</label>
                                <input type="text" name="contact_phone" id="validationCustom01" class="form-control" value="{{old('contact_phone')?? $import_company -> contact_phone}}" required="">
                            </div>
                        </div>
                    </div>

                    <div class="row bp-3">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="name">{{ trans('importer.com_name') }}:</label>
                                <input type="text" name="name" id="validationCustom01" class="form-control" value="{{old('name')?? $import_company -> name}}" required="">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="name_en">{{ trans('importer.com_name_en') }}:</label>
                                <input type="text" name="name_en" id="validationCustom01" class="form-control" value="{{old('name_en')?? $import_company -> name_en}}" required="">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="code">{{ trans('importer.com_code') }}:</label>
                                <input type="text" name="code" id="validationCustom01" class="form-control" value="{{old('code')?? $import_company -> code}}" disabled="disabled">
                            </div>
                        </div>
                    </div>

                        
                <div class="row pb-3">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="tax_number">{{ trans('importer.com_tax_no') }}:</label>
                            <input type="text" name="tax_number" id="validationCustom01" class="form-control" value="{{old('tax_number')?? $import_company -> tax_number}}" required="">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                        <label for="country_id">{{ trans('importer.country') }}:</label>
                            <select name="country_id" id="country_id" class="form-control" required="">
                                @foreach ($importer_country as $imp_country)
                                    <option value="{{$imp_country-> id}}"{{$imp_country-> id == $import_company->country_id ? 'selected' : ''}}>{{$imp_country-> name}}<span>({{$imp_country-> name_en}})</span></option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="phone">{{ trans('importer.telephone') }}:</label>
                            <input type="text" name="phone" id="validationCustom01" class="form-control" value="{{old('phone')?? $import_company-> phone}}" required="">
                        </div>
                    </div>
                </div>

                <div class="row pb-3">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="validationCustom01">{{trans('importer.address')}}:</label>
                            <textarea name="address" id="validationCustom01" cols="10" rows="5" class="form-control" value="{{old('address')}}">{{old('address')?? $import_company -> address}}</textarea>  
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="fax">{{ trans('importer.fax') }}:</label>
                            <input type="text" name="fax" id="validationCustom01" class="form-control" value="{{old('fax')?? $import_company-> fax}}" required="">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="email">{{ trans('importer.email') }}:</label>
                            <input type="email" name="email" id="validationCustom01" class="form-control" value="{{old('email')?? $import_company-> email}}" required="">
                        </div>
                    </div>
                </div>
            </div>
                    
                <div class="modal-footer">
                    <a href="/import-company" class="btn btn-secondary">{{trans('button.cancel')}}</a>
                    <input type="submit" class="btn btn-success " value="{{trans('button.update')}}">
                </div>
            </form>
        </div>
    </div>
@endsection
   
 