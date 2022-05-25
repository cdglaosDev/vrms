@extends('layouts.master')
@section('importer','active')
@section('content') 
    <h1 class="page-header">{{trans('importer.create_imp_com')}}</h1>
    <div class="panel panel-inverse">
    @include('flash') 
        <div class="body">
            <form  action="\import-company"  method="POST">
                      @method('post')
                      @csrf
                <div class="modal-body">
                    <div class="row pb-3">
                        <div class="col-sm-4">
                            <div class="from-group">
                                <label for="contact_name">{{ trans('importer.contact_name') }}:</label>
                                <input type="text" name="contact_name" id="validationCustom01" class="form-control" value="{{old('contact_name')}}" placeholder="{{trans('importer.enter_contact_name')}}" required="">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="from-group">
                                <label for="contact_name_en">{{ trans('importer.contact_name_en') }}:</label>
                                <input type="text" name="contact_name_en" id="validationCustom01" class="form-control" value="{{old('contact_name_en')}}" placeholder="{{trans('importer.enter_contact_name_en')}}" required="">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="from-group">
                                <label for="contact_phone">{{ trans('importer.contact_ph') }}:</label>
                                <input type="text" name="contact_phone" id="validationCustom01" class="form-control" value="{{old('contact_phone')}}" placeholder="{{trans('importer.enter_contact_ph')}}" required="">
                            </div>
                        </div>
                    </div>

                        <div class="row pb-3">
                            <div class="col-sm-4">
                                <div class="from-group">
                                    <label for="name">{{ trans('importer.com_name') }}:</label>
                                    <input type="text" name="name" id="validationCustom01" class="form-control" value="{{old('name')}}" placeholder="{{trans('importer.enter_com_name')}}" required="">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="from-group">
                                    <label for="name_en">{{ trans('importer.com_name_en') }}:</label>
                                    <input type="text" name="name_en" id="validationCustom01" class="form-control" value="{{old('name_en')}}" placeholder="{{trans('importer.enter_com_name_en')}}" required="">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">                                
                                    <label for="code">{{ trans('importer.com_code') }}:</label>
                                    <input type="text" name="code" id="validationCustom01" class="form-control" value="{{old('code')}}" placeholder="{{trans('importer.enter_com_code')}}" required="">
                                </div>
                            </div>
                        </div>

                        <div class="row pb-3">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="tax_number">{{ trans('importer.com_tax_no') }}:</label>
                                    <input type="text" name="tax_number" id="validationCustom01" class="form-control" value="{{old('tax_number')}}" placeholder="{{trans('importer.enter_com_tax_no')}}" required="">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="country_id">{{ trans('importer.country') }}:</label>
                                        <select name="country_id" id="country_id" class="form-control" required="">
                                            @foreach ($importer_country as $imp_country)
                                                <option value="{{$imp_country-> id}}">{{$imp_country-> name}}<span>({{$imp_country-> name_en}})</span></option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="phone">{{ trans('importer.telephone') }}:</label>
                                    <input type="text" name="phone" id="validationCustom01" class="form-control" value="{{old('phone')}}" placeholder="{{trans('importer.enter_telephone')}}" required="">
                                </div>
                            </div>
                        </div>
                        
                        
                    <div class="row pb-3">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="validationCustom01">{{trans('importer.address')}}:</label>
                                <textarea name="address" id="validationCustom01" cols="10" rows="5" class="form-control" value="{{old('address')}}" placeholder="{{trans('importer.enter_address')}}"></textarea>  
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="fax">{{ trans('importer.fax') }}:</label>
                                <input type="text" name="fax" id="validationCustom01" class="form-control" value="{{old('fax')}}" placeholder="{{trans('importer.enter_fax')}}" required="">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="email">{{ trans('importer.email') }}:</label>
                                <input type="email" name="email" id="validationCustom01" class="form-control" value="{{old('email')}}" placeholder="{{trans('importer.enter_email')}}" required="">
                            </div>
                        </div>

                    </div>
                </div>
                    
                <div class="modal-footer">
                    <a href="/import-company" class="btn btn-secondary">{{trans('button.cancel')}}</a>
                    <input type="submit" class="btn btn-success " value="{{trans('button.save')}}">
                </div>
            </form>
        </div>
    </div>
@endsection
   
 