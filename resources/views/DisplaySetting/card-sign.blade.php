@extends('vrms2.layouts.master')
@section('smart_card_logo','active')
@section('content')
@include('DisplaySetting.submenu')
<h3>{{trans('title.card_logo_sign')}}</h3>
@include('flash')
<div class="card-body">
   <form action="{{route('smartCard.store')}}" method="POST" enctype="multipart/form-data">
      @method('post')
      @csrf

      <div class="form-row">
         <div class="col-md-4 col-sm-4 mb-3">
            <div class="fileinput fileinput-new" data-provides="fileinput">
               <div class="fileinput-new thumbnail" style="height: 100;">
                  @if(isset($data))

                  <img class="circle-image" src="data:image/png;base64,{{$data->logo}}" />
                  @endif
               </div>
               <div class="fileinput-preview fileinput-exists thumbnail" style="max-height: 150px;"> </div>
               <div>
                  <span class="btn btn-success btn-file">
                     <span class="fileinput-new"> Change New Logo.. </span>
                     <span class="fileinput-exists"> Change </span>
                     <input type="file" name="logo" value="" accept=".png">
                  </span>

               </div>
            </div>

         </div>
         <div class="col-md-4 col-sm-4 mb-3">

            <div class="fileinput fileinput-new" data-provides="fileinput">
               <div class="fileinput-new thumbnail" style="height: 100;">
                  @if(isset($data))
                  <img class="circle-image" src="data:image/png;base64,{{ $data->sign }}" />
                  @endif
               </div>
               <div class="fileinput-preview fileinput-exists thumbnail" style="max-height: 150px;"> </div>
               <div>
                  <span class="btn btn-success btn-file">
                     <span class="fileinput-new"> Change Sign </span>
                     <span class="fileinput-exists"> Change </span>
                     <input type="file" name="sign" value="" accept=".png">
                  </span>

               </div>
            </div>

         </div>
         <div class="col-md-4 col-sm-4 mb-3">
            <label for="validationCustom01">Department Name:</label>
            <input type="text" name="dept_name" class="form-control" value="{{ $data->dept_name ?? ''}}" placeholder="Enter Department Name">
            <br>
            <label for="validationCustom01">Officer Name:</label>
            <input type="text" name="officer_name" class="form-control" value="{{ $data->officer_name }}" placeholder="Enter Officer Name">
            <input type="hidden" value="{{$data->id}}" name="id">

         </div>
      </div>
      <div class="modal-footer">
         <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">Cancel</button>
         <button type="submit" class="btn btn-success btn-sm btn-save">Save</button>
      </div>

   </form>
</div>

@endsection