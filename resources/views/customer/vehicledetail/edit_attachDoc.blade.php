@extends('customer.layouts.master')
@section('vehicle','active')
@section('content')
@include('flash')
<h1 class="page-header">Application Document</h1>
<div class="panel panel-inverse">
   <div class="panel-body">
      {{-- <form id="myForm" action="{{url('customer/attach-doc/edit')}}" method="post" enctype="multipart/form-data"> --}}
    <form  id="myForm" method="post" action="{{route('updateAttachDoc.update',[$id])}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        @method('PATCH')
         <div class="col-sm-12 col-md-12 md-offset-12"> 
             <input type="hidden" name="vehicle_detail_id" value="{{ $id }}">
             <table class="table table-bordered" id="app-document"> 
                <thead>
                  <tr>
                    <th width="300">{{ trans('app_form.doc_type') }}</th>
                    <th>Edit Document</th>
                    <th>{{ trans('app_form.doc_filename') }}</th>
                  </tr>
                </thead> 
                  <tbody>
                  @foreach ($doc_value as $item)
                  <tr>
                    <td><div>@if(isset($item->doctype->name))<input type="hidden" name="doc_type_id[]" class="form-control" value="{{$item->doc_type_id}}"><h5>{{$item->doctype->name_en}}</h5>@else{{"_"}}</div></td>@endif
                    <td><div><input type="file" name="filename[]"  class="form-control" required></div></td>
                    <td><div>{{$item->filename}}</div></td>
                  </tr>
                  @endforeach
                  </tbody>
             </table>
        </div>
        <div class="row">
        <div class="col-md-6">
            <a href="{{ route('vehicle-detail.index') }}" class="btn btn-default">{{ trans('button.back') }}</a>
            
        </div>
        <div class="col-md-6 text-right">
            <button class="btn btn-success ">{{ trans('button.update') }}</button>
        </div>
        </div>
       
      </form>
   </div>
</div>
@endsection
