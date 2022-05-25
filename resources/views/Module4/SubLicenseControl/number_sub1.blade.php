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
<h3>{{ trans('module4.sub_lic_title') }}</h3>
<div class="card-body">
   <div class="form-row justify-content-center align-items-center">
      <div class="col-4 col-xxl-3">
         <div class="input-group mb-2">
            <div class="input-group-prepend">
               <div class="text-dark">{{ trans('module4.province_name') }}</div>
            </div>
            <input type="text" style="width: 100%;" class="form-control" value="{{ $province_name }}" disabled>
         </div>
      </div>
      <div class="col-4 col-xxl-3">
         <div class="input-group mb-2">
            <div class="input-group-prepend">
               <div class="text-dark">{{ trans('module4.sub_lic_vehicle_kind') }}</div>
            </div>
            <input type="text" style="width: 100%;" class="form-control" value="{{ $vehicle_kind_name }}" disabled>
         </div>
      </div>
      <div class="col-4 col-xxl-3">
         <div class="input-group mb-2">
            <div class="input-group-prepend">
               <div class="text-dark">{{ trans('module4.sub_lic_alphabet') }}</div>
            </div>
            <input type="text" style="width: 100%;" class="form-control" value="{{ $license_alphabet_name }}" disabled>
         </div>
      </div>
   </div>

   <div class="row justify-content-center text-center mt-4">
      <div class="col-6 col-xxl-4">
         <div class="row justify-content-center">
            <!-- <div class="col-3 p-10 blocknumber linktosub @if($license_present > 0 && $license_present <= 1000) bg-green @elseif($license_present > 1000) bg-warning @else bg-yellow @endif" onclick="window.location.href='{{ url('sub-license-number-control-2').'/'.$province_code.'/'.$vehicle_kind_code.'/'.$license_alphabet_id.'/1000' }}'">0001-1000</div> -->
            <div class="col-3 p-10 blocknumber linktosub @if($license_present > 0 && $license_present <= 1000) bg-green @elseif($license_present > 1000) bg-warning @else bg-yellow @endif" onclick="window.location.href='{{ url('sub-license-number-control-detail').'/'.$province_code.'/'.$vehicle_kind_code.'/'.$license_alphabet_id.'/1000' }}'">0001-1000</div>
            <div class="col-3 p-10 blocknumber linktosub @if($license_present > 1000 && $license_present <= 2000) bg-green @elseif($license_present > 2000) bg-warning @else bg-yellow @endif" onclick="window.location.href='{{ url('sub-license-number-control-detail').'/'.$province_code.'/'.$vehicle_kind_code.'/'.$license_alphabet_id.'/2000' }}'">1001-2000</div>
            <div class="col-3 p-10 blocknumber linktosub @if($license_present > 2000 && $license_present <= 3000) bg-green @elseif($license_present > 3000) bg-warning @else bg-yellow @endif" onclick="window.location.href='{{ url('sub-license-number-control-detail').'/'.$province_code.'/'.$vehicle_kind_code.'/'.$license_alphabet_id.'/3000' }}'">2001-3000</div>
         </div>
         <div class="row justify-content-center">
            <div class="col-3 p-10 blocknumber linktosub @if($license_present > 3000 && $license_present <= 4000) bg-green @elseif($license_present > 4000) bg-warning @else bg-yellow @endif" onclick="window.location.href='{{ url('sub-license-number-control-detail').'/'.$province_code.'/'.$vehicle_kind_code.'/'.$license_alphabet_id.'/4000' }}'">3001-4000</div>
            <div class="col-3 p-10 blocknumber linktosub @if($license_present > 4000 && $license_present <= 5000) bg-green @elseif($license_present > 5000) bg-warning @else bg-yellow @endif" onclick="window.location.href='{{ url('sub-license-number-control-detail').'/'.$province_code.'/'.$vehicle_kind_code.'/'.$license_alphabet_id.'/5000' }}'">4001-5000</div>
            <div class="col-3 p-10 blocknumber linktosub @if($license_present > 5000 && $license_present <= 6000) bg-green @elseif($license_present > 6000) bg-warning @else bg-yellow @endif" onclick="window.location.href='{{ url('sub-license-number-control-detail').'/'.$province_code.'/'.$vehicle_kind_code.'/'.$license_alphabet_id.'/6000' }}'">5001-6000</div>
         </div>
         <div class="row justify-content-center">
            <div class="col-3 p-10 blocknumber linktosub @if($license_present > 6000 && $license_present <= 7000) bg-green @elseif($license_present > 7000) bg-warning @else bg-yellow @endif" onclick="window.location.href='{{ url('sub-license-number-control-detail').'/'.$province_code.'/'.$vehicle_kind_code.'/'.$license_alphabet_id.'/7000' }}'">6001-7000</div>
            <div class="col-3 p-10 blocknumber linktosub @if($license_present > 7000 && $license_present <= 8000) bg-green @elseif($license_present > 8000) bg-warning @else bg-yellow @endif" onclick="window.location.href='{{ url('sub-license-number-control-detail').'/'.$province_code.'/'.$vehicle_kind_code.'/'.$license_alphabet_id.'/8000' }}'">7001-8000</div>
            <div class="col-3 p-10 blocknumber linktosub @if($license_present > 8000 && $license_present <= 9000) bg-green @elseif($license_present > 9000) bg-warning @else bg-yellow @endif" onclick="window.location.href='{{ url('sub-license-number-control-detail').'/'.$province_code.'/'.$vehicle_kind_code.'/'.$license_alphabet_id.'/9000' }}'">8001-9000</div>
         </div>
         <div class="row justify-content-center">
            <div class="col-3 p-10 blocknumber linktosub @if($license_present > 9000 && $license_present <= 10000) bg-green @elseif($license_present == 9999) bg-warning @else bg-yellow @endif" onclick="window.location.href='{{ url('sub-license-number-control-detail').'/'.$province_code.'/'.$vehicle_kind_code.'/'.$license_alphabet_id.'/9999' }}'">9001-9999</div>
            <div class="col-3 blocknumber"> </div>
            <div class="col-3 blocknumber"> </div>
         </div>
      </div>
   </div>
</div>
@endsection
@push('page_scripts')
<script></script>
@endpush