@extends('layouts.master')
@section('reg','active')
@section('title','Print')
@section('content')
<style type="text/css">
  /* for print preview image */
  @media print{
* {
    -webkit-print-color-adjust: exact !important;   /* Chrome, Safari */
    color-adjust: exact !important;                 /*Firefox*/
  } 
}
      .left {
    margin-left: 10px;
    margin-top: 10px;
    width:460px;
    height: 812px;
    border: 1px solid #000;
    font-family:"Myanmar3";
    font-size:12px;
   background-image: url(/images/p4.png);
  }

  #evld{ border:0px solid #F90; margin:165px 15px 0px 230px;color:#000;font-size: 14px;}
  #p4box1{ border:0px solid #F90; margin:65px 10px 0px 135px;}
  #edon{ border:0px solid #F10; float:left; width:100px; margin:0px 0px 0px 32px;color:#000;font-size: 14px;}
  #edat{ border:0px solid #F10; width:50px; margin:5px 10px 0px 70px;color:#000;font-size: 14px;} 
 
}         

</style>
<style>
@media print{
  * {
        -webkit-print-color-adjust: exact;
    }
  
}
</style>
  <div class="card">
    <input type="hidden" name="id" id="register_id" value="{{$data->id}}">
   <div id="print" class="left" >

  <div id="evld"> @if($data->eexpire){{$data->eexpire}} @else &nbsp; @endif</div>
  <div id="p4box1">
    <div id="edon">@if($data->edoneat){{$data->edoneat}} @else &nbsp; @endif</div>
    <span id="edat">@if($data->eissue){{$data->eissue}}@else &nbsp; @endif</span>
  </div>



 </div><!--print-->
    <div class="no-print">
        <hr/>
        <div class="form-group">
          <label for="page" class="col-sm-1 control-label">Page :</label>
          <div class="col-xs-2">
            <select id="page" class="form-control">
                <option value="p1" >Page 1</option>
                <option value="p2" >Page 2</option>
                <option value="p3">Page 3</option>
                <option value="p4" selected="selected">Page 4</option>
            </select>
          </div>
        </div>

        <div class="form-group col-xs-2">
        <button class="form-control print-link no-print btn btn-primary" onclick="jQuery('#print').print()">{{trans('button.print')}}</button>
        </div>
    </div>
</div>

  

@endsection
@push("page_scripts")
  <script src="js/bootstrap.min.js"></script>
    <script src="{{asset('js/print.js')}}"> </script>
    <script src="{{asset('js/jQuery.print.js')}}"></script>
@endpush

