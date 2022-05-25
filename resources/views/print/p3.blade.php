@extends('vrms2.layouts.master')
@section('passport_list','active')
@section('title','Print')
@section('content')
@include('module6.mod6-submenu')
<style>
  .right {
    background-image: url(/images/p3.png);
  }
</style>
<h3>Passport Print</h3>
<div>
  <input type="hidden" name="id" id="register_id" value="{{$data->id}}">

  <div id="print" class="right page3">
    <div id="n1">@if($data->name){{$data->name}} @else &nbsp; @endif</div>
    <div id="n2">@if($data->name_en){{$data->name_en}} @else &nbsp; @endif</div>

    <!-- ******************** Start Box 1 ******************** -->
    <div class="row" id="p3box1">
      <div class="cl" id="vle-div">
        <span id="vle">{{$data->village}}</span>
      </div>
      <div class="cl" id="unt-div">
        <span id="unt">@if($data->unit){{$data->unit}} @else &nbsp; @endif</span>
      </div>
      <div class="cl" id="ste-div">
        <span id="ste">@if($data->street){{$data->street}} @else &nbsp; @endif</span>
      </div>
    </div>
    <!-- ******************** End Box 1 ******************** -->

    <!-- ******************** Start Box 2 ******************** -->
    <div class="row" id="p3box2">
      <div class="cl" id="dst-div">
        <span id="dst">@if($data->district){{$data->dis->name}} @else &nbsp; @endif</span>
      </div>
      <div class="cl" id="prv-div">
        <span id="prv">@if($data->province){{$data->pro->name}} @else &nbsp; @endif</span>
      </div>

    </div>
    <div class="row" id="p3box2-1">
      <div class="cl" id="dst-1-div">
        <span id="dst-1">@if($data->district){{$data->dis->name_en}} @else &nbsp; @endif</span>
      </div>
      <div class="cl" id="prv-1-div">
        <span id="prv-1">@if($data->province){{$data->pro->name_en}} @else &nbsp; @endif</span>
      </div>
    </div>
    <!-- ******************** End Box 2 ******************** -->

    <!-- ******************** Start Box 3 ******************** -->
    <div class="row" id="p3box3">
      <div class="cl" id="tel-div">
        <span id="tel">@if($data->telephone){{$data->telephone}} @else &nbsp; @endif</span>
      </div>
      <div class="cl" id="fx-div">
        <span id="fx">@if($data->fax){{$data->fax}} @else &nbsp; @endif</span>
      </div>
    </div>
    <!-- ******************** End Box 3 ******************** -->

    <div id="vld">@if($data->expire_date){{\App\Helpers\DateHelper::showExpireDate($data->expire_date)}} @else &nbsp; @endif</div>

    <!-- ******************** Start Box 4 ******************** -->
    <div class="row" id="p3box4">
      <div class="cl" id="don-div">
        <span id="don">@if($data->doneat){{$data->done_at->name}} @else &nbsp; @endif</span>
      </div>
      <div class="cl" id="dat-div">
        <span id="dat">@if($data->issue_date){{\App\Helpers\DateHelper::showDate($data->issue_date)}} @else &nbsp; @endif</span>
      </div>
    </div>

    <div id="don-en">{{$data->done_at->name_en}}</div>
    <!-- ******************** End Box 4 ******************** -->

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
        <a href="{{url('/getPrint/'.$data->id.'/p2')}}" title="p2" class="btn btn-outline-primary btn-fw btn-sm">Page2</a>
        <a href="{{url('/getPrint/'.$data->id.'/p3')}}" title="p3" class="btn btn-outline-primary btn-fw btn-sm active">Page3</a><br />
      </div>
    </div>
  </div>
</div>

@endsection
@push("page_scripts")

<script src="{{asset('js/jQuery.print.js')}}"></script>

@endpush