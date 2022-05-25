@extends('vrms2.layouts.master')
@section('price_list_display_setting','active')
@section('content')
@include('DisplaySetting.submenu')
<h3>{{trans('title.price_list_display_setting')}}</h3>
@include('flash')
<div class="card-body">
   <form action="{{route('priceListDisplaySetting.store')}}" method="POST" enctype="multipart/form-data">
      @method('post')
      @csrf

      <div class="form-row">

         <div class="col-md-3 col-sm-3 mb-3">
            <div class="fileinput fileinput-new" data-provides="fileinput">
               <div class="fileinput-new thumbnail" style="height: 100px;">
                  @if(isset($data))
                  <img class="circle-image" src="data:image/png;base64,{{$data->logo1}}" />
                  @endif
               </div>
               <div class="fileinput-preview fileinput-exists thumbnail" style="max-height: 150px;"> </div>
               <div>
                  <span class="btn btn-success btn-file">
                     <span class="fileinput-new"> Change Logo 1.. </span>
                     <span class="fileinput-exists"> Change </span>
                     <input type="file" name="logo1" value="" accept=".png">
                  </span>
               </div>
            </div>
         </div>

         <div class="col-md-3 col-sm-3 mb-3">
            <div class="fileinput fileinput-new" data-provides="fileinput">               
               <div class="fileinput-new thumbnail" style="height: 100px;">
                  @if(isset($data))
                  <img class="circle-image" src="data:image/png;base64,{{ $data->logo2 }}" />
                  @endif
               </div>

               <div class="fileinput-preview fileinput-exists thumbnail" style="max-height: 150px;"> </div>
               <div>
                  <span class="btn btn-success btn-file">
                     <span class="fileinput-new"> Change Logo 2 </span>
                     <span class="fileinput-exists"> Change </span>
                     <input type="file" name="logo2" value="" accept=".png">
                  </span>
               </div>
            </div>
         </div>

         <div class="col-md-3 col-sm-3 mb-3">
            <div class="fileinput fileinput-new" data-provides="fileinput">               
               <div class="fileinput-new thumbnail" style="height: 100px;">
                  @if(isset($data))
                  <img class="square-image" src="data:image/png;base64,{{ $data->adv1 }}" />
                  @endif
               </div>

               <div class="fileinput-preview fileinput-exists thumbnail" style="max-height: 150px;"> </div>
               <div>
                  <span class="btn btn-success btn-file">
                     <span class="fileinput-new"> Change Advertisement 1 </span>
                     <span class="fileinput-exists"> Change </span>
                     <input type="file" name="adv1" value="" accept=".png">
                  </span>
               </div>
            </div>
         </div>



         <div class="col-md-3 col-sm-3 mb-3">
            <div class="fileinput fileinput-new" data-provides="fileinput">               
               <div class="fileinput-new thumbnail" style="height: 100px;">
                  @if(isset($data))
                  <img class="square-image" src="data:image/png;base64,{{ $data->adv2 }}" />
                  @endif
               </div>

               <div class="fileinput-preview fileinput-exists thumbnail" style="max-height: 150px;"> </div>
               <div>
                  <span class="btn btn-success btn-file">
                     <span class="fileinput-new"> Change Advertisement 2 </span>
                     <span class="fileinput-exists"> Change </span>
                     <input type="file" name="adv2" value="" accept=".png">
                  </span>
               </div>
            </div>
         </div>

      </div>

      <div class="form-row">
         <div class="col-md-4 col-sm-4 mb-3">
            <label for="validationCustom01">Text 1:</label>
            <input type="text" name="text1" class="form-control" value="{{ $data->text1 ?? ''}}" placeholder="Enter Text 1">
            <br>
            <label for="validationCustom01">Text 2:</label>
            <input type="text" name="text2" class="form-control" value="{{ $data->text2 }}" placeholder="Enter Text 2">
            <br>
            <label for="validationCustom01">Text 3:</label>
            <input type="text" name="text3" class="form-control" value="{{ $data->text3 }}" placeholder="Enter Text 3">
           
           
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