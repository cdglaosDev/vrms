@extends('vrms2.layouts.master')
@section('passport_list','active')
@section('title','Print')
@section('content')
@include('module6.mod6-submenu')
<style>
  .left {
    background-image: url(/images/p2.png);
  }
</style>
<h3>Passport Print</h3>
<div>
  <input type="hidden" name="id" id="register_id" value="{{$data->id}}">

  <div id="print" class="left">
    <!-- ******************** Start Box 1 ******************** -->
    <div class="row" id="box1">
      <div class="cl" id="cat-div">
        <span id="cat">@if($data->vehicle_type_id){{$data->vehicle_type->name}} @else &nbsp;@endif</span>
      </div>
      <div class="cl" id="brd-div">
        <span id="brd">@if($data->brand_id){{$data->brand->name}} @else &nbsp;@endif</span>
      </div>
      <div class="cl" id="mdl-div">
        <span id="mdl">@if($data->model_id){{$data->vehicle_model->name}} @else &nbsp; @endif</span>
      </div>
    </div>
    <div id="box1-1">
      <span id="cat-1">@if($data->vehicle_type_id){{$data->vehicle_type->name_en}} @else &nbsp;@endif</span>
    </div>
    <!-- ******************** End Box 1 ******************** -->

    <!-- ******************** Start Box 2 ******************** -->
    <div class="row" id="box2">
      <div class="cl" id="clr-div">
        <span id="clr">@if($data->color_id){{$data->color->name}} @else &nbsp;@endif</span>
      </div>
      <div class="cl" id="lb-div"></div>
      <div class="cl" id="lft-div">
        <span id="lft">
          @if($data->steering == "Left")<i class="fa fa-check" aria-hidden="true"></i>
          @else<i class="fa fa-times" aria-hidden="true"></i> @endif
        </span>
      </div>
      <div class="cl" id="rgt-div">
        <span id="rgt">
          @if($data->steering == "Right")<i class="fa fa-check" aria-hidden="true"></i>
          @else<i class="fa fa-times" aria-hidden="true"></i> @endif
        </span>
      </div>
    </div>
    <div id="box2-1">
      <span id="clr-1">@if($data->color_id){{$data->color->name_en}} @else &nbsp;@endif</span>
    </div>
    <!-- ******************** End Box 2 ******************** -->

    <!-- ******************** Start Box 3 ******************** -->
    <div class="row" id="box3">
      <div class="cl" id="ebrd-div">
        <span id="ebrd">@if($data->engine_brand_id){{$data->engine_brand->name}} @else &nbsp; @endif</span>
      </div>
      <div class="cl" id="cy-div">
        <span id="cy">@if($data->cylinder){{$data->cylinder}} @else &nbsp; @endif</span>
      </div>
      <div class="cl" id="cc-div">
        <span id="cc">@if($data->cc){{$data->cc}} @else &nbsp; @endif</span>
      </div>
    </div>
    <!-- ******************** End Box 3 ******************** -->

    <div id="eno">@if($data->engine_no){{$data->engine_no}} @else &nbsp; @endif</div>
    <div id="cno">@if($data->chassis_no){{$data->chassis_no}} @else &nbsp; @endif</div>

    <!-- ******************** Start Box 4 ******************** -->
    <div class="row" id="box4">
      <div class="cl" id="wt-div">
        <span id="wt">@if($data->width){{$data->width}} @else &nbsp; @endif</span>
      </div>
      <div class="cl" id="lt-div">
        <span id="lt">@if($data->long){{$data->long}} @else &nbsp; @endif</span>
      </div>
      <div class="cl" id="ht-div">
        <span id="ht">@if($data->height){{$data->height}} @else &nbsp; @endif</span>
      </div>
    </div>
    <!-- ******************** End Box 4 ******************** -->

    <div id="st">@if($data->seat){{$data->seat}} @else &nbsp; @endif</div>

    <div id="nw">@if($data->total_weight){{$data->total_weight}} @else &nbsp; @endif</div>

    <div id="da1">@if($data->remark){{$data->remark}} @else &nbsp; @endif</div>
  </div>
  <!--print-->

  <div class="row mb-2">
    <div class="col-md-3 mt-2">
      <div class="text-left ml-2">
        <a href="{{ url('/vehicle-passport') }}" class="btn btn-secondary btn-sm">{{ trans('button.back') }}</a>&nbsp;
        <a class=" no-print btn btn-info btn-sm text-white" onclick="jQuery('#print').print()">{{trans('button.print')}}</a>
      </div>
    </div>

    <div class="col-md-9 no-print mt-2">
      <div class="text-center">
        <a href="{{url('/getPrint/'.$data->id.'/p1')}}" title="p1" class="btn btn-outline-primary btn-fw btn-sm ">Page1</a>
        <a href="{{url('/getPrint/'.$data->id.'/p2')}}" title="p2" class="btn btn-outline-primary btn-fw btn-sm active">Page2</a>
        <a href="{{url('/getPrint/'.$data->id.'/p3')}}" title="p3" class="btn btn-outline-primary btn-fw btn-sm">Page3</a><br />
      </div>
    </div>
  </div>
</div>
@endsection
@push("page_scripts")

<script src="{{asset('js/jQuery.print.js')}}"></script>

@endpush