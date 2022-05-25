@extends('vrms2.layouts.master')
@section('reg_no','active')
@section('content') 
<style>
   .blocknumber {
   padding: 20px;
   margin-bottom: 15px;
   margin-right: 15px;
   border-radius: 5px
   }
</style>
<h3>Sub License Number Control</h3>
<div class="card-body">
   <div class="form-row justify-content-center align-items-center">
      <div class="col-4 col-xxl-3">
         <div class="input-group mb-2">
            <div class="input-group-prepend">
               <div class="text-dark">{{ trans('module4.province_name') }}</div>
            </div>
            <input type="text" style="width: 100%;"  class="form-control" value="{{ $province_name }}" disabled>
         </div>
      </div>
      <div class="col-4 col-xxl-3">
         <div class="input-group mb-2">
            <div class="input-group-prepend">
               <div class="text-dark">{{ trans('module4.sub_lic_vehicle_kind') }}</div>
            </div>
            <input type="text" style="width: 100%;"  class="form-control" value="{{ $vehicle_kind_name }}" disabled>
         </div>
      </div>
      <div class="col-4 col-xxl-3">
         <div class="input-group mb-2">
            <div class="input-group-prepend">
               <div class="text-dark">{{ trans('module4.sub_lic_alphabet') }}</div>
            </div>
            <input type="text" style="width: 100%;"  class="form-control" value="{{ $license_alphabet_name }}" disabled>
         </div>
      </div>
   </div>
   <div class="row justify-content-center text-center mt-4">
      <div class="col-6 col-xxl-4">
         <div class="row justify-content-center">
            <div class="col-3 p-10 blocknumber linktosub @if($license_present >= $license_present_max-999 && $license_present <= $license_present_max-900) bg-green @elseif($license_present > $license_present_max-900) bg-warning @else bg-yellow @endif" onclick="window.location.href='{{ url('sub-license-number-control-detail').'/'.$province_code.'/'.$vehicle_kind_code.'/'.$license_alphabet_id.'/'.($license_present_max-900) }}'">{{str_pad($license_present_max-999,4,"0",STR_PAD_LEFT)}}-{{str_pad($license_present_max-900,4,"0",STR_PAD_LEFT)}}</div>
            <div class="col-3 p-10 blocknumber linktosub @if($license_present >= $license_present_max-899 && $license_present <= $license_present_max-800) bg-green @elseif($license_present > $license_present_max-800) bg-warning @else bg-yellow @endif" onclick="window.location.href='{{ url('sub-license-number-control-detail').'/'.$province_code.'/'.$vehicle_kind_code.'/'.$license_alphabet_id.'/'.($license_present_max-800) }}'">{{str_pad($license_present_max-899,4,"0",STR_PAD_LEFT)}}-{{str_pad($license_present_max-800,4,"0",STR_PAD_LEFT)}}</div>
            <div class="col-3 p-10 blocknumber linktosub @if($license_present >= $license_present_max-799 && $license_present <= $license_present_max-700) bg-green @elseif($license_present > $license_present_max-700) bg-warning @else bg-yellow @endif" onclick="window.location.href='{{ url('sub-license-number-control-detail').'/'.$province_code.'/'.$vehicle_kind_code.'/'.$license_alphabet_id.'/'.($license_present_max-700) }}'">{{str_pad($license_present_max-799,4,"0",STR_PAD_LEFT)}}-{{str_pad($license_present_max-700,4,"0",STR_PAD_LEFT)}}</div>
         </div>
         <div class="row justify-content-center">
            <div class="col-3 p-10 blocknumber linktosub @if($license_present >= $license_present_max-699 && $license_present <= $license_present_max-600) bg-green @elseif($license_present > $license_present_max-600) bg-warning @else bg-yellow @endif" onclick="window.location.href='{{ url('sub-license-number-control-detail').'/'.$province_code.'/'.$vehicle_kind_code.'/'.$license_alphabet_id.'/'.($license_present_max-600) }}'">{{str_pad($license_present_max-699,4,"0",STR_PAD_LEFT)}}-{{str_pad($license_present_max-600,4,"0",STR_PAD_LEFT)}}</div>
            <div class="col-3 p-10 blocknumber linktosub @if($license_present >= $license_present_max-599 && $license_present <= $license_present_max-500) bg-green @elseif($license_present > $license_present_max-500) bg-warning @else bg-yellow @endif" onclick="window.location.href='{{ url('sub-license-number-control-detail').'/'.$province_code.'/'.$vehicle_kind_code.'/'.$license_alphabet_id.'/'.($license_present_max-500) }}'">{{str_pad($license_present_max-599,4,"0",STR_PAD_LEFT)}}-{{str_pad($license_present_max-500,4,"0",STR_PAD_LEFT)}}</div>
            <div class="col-3 p-10 blocknumber linktosub @if($license_present >= $license_present_max-499 && $license_present <= $license_present_max-400) bg-green @elseif($license_present > $license_present_max-400) bg-warning @else bg-yellow @endif" onclick="window.location.href='{{ url('sub-license-number-control-detail').'/'.$province_code.'/'.$vehicle_kind_code.'/'.$license_alphabet_id.'/'.($license_present_max-400) }}'">{{str_pad($license_present_max-499,4,"0",STR_PAD_LEFT)}}-{{str_pad($license_present_max-400,4,"0",STR_PAD_LEFT)}}</div>
         </div>
         <div class="row justify-content-center">
            <div class="col-3 p-10 blocknumber linktosub @if($license_present >= $license_present_max-399 && $license_present <= $license_present_max-300) bg-green @elseif($license_present > $license_present_max-300) bg-warning @else bg-yellow @endif" onclick="window.location.href='{{ url('sub-license-number-control-detail').'/'.$province_code.'/'.$vehicle_kind_code.'/'.$license_alphabet_id.'/'.($license_present_max-300) }}'">{{str_pad($license_present_max-399,4,"0",STR_PAD_LEFT)}}-{{str_pad($license_present_max-300,4,"0",STR_PAD_LEFT)}}</div>
            <div class="col-3 p-10 blocknumber linktosub @if($license_present >= $license_present_max-299 && $license_present <= $license_present_max-200) bg-green @elseif($license_present > $license_present_max-200) bg-warning @else bg-yellow @endif" onclick="window.location.href='{{ url('sub-license-number-control-detail').'/'.$province_code.'/'.$vehicle_kind_code.'/'.$license_alphabet_id.'/'.($license_present_max-200) }}'">{{str_pad($license_present_max-299,4,"0",STR_PAD_LEFT)}}-{{str_pad($license_present_max-200,4,"0",STR_PAD_LEFT)}}</div>
            <div class="col-3 p-10 blocknumber linktosub @if($license_present >= $license_present_max-199 && $license_present <= $license_present_max-100) bg-green @elseif($license_present > $license_present_max-100) bg-warning @else bg-yellow @endif" onclick="window.location.href='{{ url('sub-license-number-control-detail').'/'.$province_code.'/'.$vehicle_kind_code.'/'.$license_alphabet_id.'/'.($license_present_max-100) }}'">{{str_pad($license_present_max-199,4,"0",STR_PAD_LEFT)}}-{{str_pad($license_present_max-100,4,"0",STR_PAD_LEFT)}}</div>
         </div>
         @php($numberlast = $license_present_max == 10000 ? $license_present_max-1 : $license_present_max)
         <div class="row justify-content-center">
            <div class="col-3 p-10 blocknumber linktosub @if($license_present >= $license_present_max-99 && $license_present <= $numberlast) bg-green @elseif($license_present > $numberlast) bg-warning @else bg-yellow @endif" onclick="window.location.href='{{ url('sub-license-number-control-detail').'/'.$province_code.'/'.$vehicle_kind_code.'/'.$license_alphabet_id.'/'.$numberlast }}'">{{$license_present_max-99}}-{{$numberlast}}</div>
            <div class="col-3 blocknumber"> </div>
            <div class="col-3 blocknumber"> </div>
         </div>
      </div>
   </div>
</div>
@endsection
