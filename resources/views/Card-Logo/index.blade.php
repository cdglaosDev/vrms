@extends('layouts.master')
@section('setting','active')
@section('content') 
<style type="text/css">
   .circle-image{
   display: inline-block;
   border-radius: 50%;
   overflow: hidden;
   width: 50px;
   height: 50px;
   }
   .circle-image img{
   width:100%;
   height:100%;
   object-fit: cover;
   }
</style>
<h1 class="page-header">Card Logo</h1>
<div class="card">
   @include('flash') 
   <div class="container">
      <div class="row">
         <form action="{{url('smart-card-logo')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-md-5">
               <div class="col-xs-12 col-sm-4 col-md-4" style="margin-top: 19px">
                  <div class="form-group" style="border-top: 19px">
                     <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail" style="height: 100;">
                           <img class="circle-image" src="{{asset('images/logo1.png')}}" style="width: 150px;height: 200px;box-sizing: border-box;vertical-align: right" > 
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-height: 150px;"> </div>
                        <div>
                           <span class="btn btn-success btn-file">
                           <span class="fileinput-new"> Change Logo.. </span>
                           <span class="fileinput-exists"> Change </span>
                           <input type="file" name="logo" value="user-default.png">
                           </span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-5"></div>
            </div>
      </div>
      <br>
      <div class="row" >
      <div class="col-md-4">
      </div>
      <div class="col-md-6" style="margin-bottom: 18px">
      <button type="submit" class="btn btn-success ">{{trans('table.update')}}</button>
      </div><br>
      <div class="col-md-2">
      </div>
      </div>
      </form>
   </div>
</div>
@endsection 
@push('page_scripts')
<script type="text/javascript">
   var base_url = "{{url('vehicle-inspection')}}";
   
   $(".delete").on("submit", function(){
      return confirm("Are you sure to delete?");
   });
   
</script>
@endpush