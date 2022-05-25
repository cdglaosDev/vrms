@extends('vrms2.layouts.master')
@section('lic_booking','active')
@section('content')
@include('vrms2.mod4-submenu') 
<h3>{{ trans('module4.license_number_booking') }}
   @can('License-Number-Booking-Create')
   <a data-toggle="modal" data-target="#lic_booking_addModel" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-sm btn-save ">{{trans('common.add_new')}}</a>
   @endcan
</h3>
@include('flash')  
<div class="card-body">
   <table id="myTable" class="table table-striped">
      <thead>
         <tr>
            <th>{{trans('module4.no')}}</th>
            <th>{{trans('module4.license_no')}}.</th>
            <th>{{trans('module4.vehicle_kind')}}</th>
            <th>{{trans('common.province')}}</th>
            <th>{{trans('module4.customer_name')}}</th>
            <th>{{trans('module4.expire_date')}}</th>
            <th>{{trans('module4.booking_by')}}</th>
            <th>{{ trans('common.status') }}</th>
            <th width="150">{{trans('common.action')}}</th>
         </tr>
      </thead>
      <tbody>
         @foreach( $lic_bookings as $index=>$booking)
         <tr>
            <td>{{$index +1}}</td>
            <td> {{$booking->license_no_book_number}}</td>
            <td>{{ $booking->vehicle_kind->name ?? ''}}</td>
            <td>{{ $booking->province->name ?? ''}}({{ $booking->province->name_en ?? ''}})</td>
            <td>{{ $booking->customer_name}}</td>

            @if($booking->expire_date != "0000-00-00")
            <?php
               $arr = explode("/", $booking->expire_date);
               $str_date = $arr[2]. "/" . $arr[1]."/".$arr[0];

               $mydate = strtotime($str_date);
               $newformat = date('d/m/Y',$mydate);
            ?>
            <td data-sort="<?php echo $mydate; ?>" ><?php echo $newformat; ?></td>
            @else
            <td>{{ $booking->expire_date}}</td>
            @endif

            <td>{{ $booking->user->name ?? ''}}</td>
            <td>{{  $booking->status }}</td>
            
            <td>
               @can('License-Number-Booking-Edit')
               @if($booking->status == 'Uses')
               <a><img src="{{ asset('images/edit_gray.png') }}" alt="" width="25" height="25"></a> 
               @else
               <a href="" class="btn_edit" data-url="{{ route('license-number-booking.edit',['id'=>$booking->id])}}" data-toggle="modal" 
               data-target="#lic_booking_editModel" data-backdrop="static" data-keyboard="false">
               <img src="{{ asset('images/edit.png') }}" alt="" title="{{trans('button.edit')}}"  width="25px" height="25px"></a>
               @endif
               
               @endcan
               @can('License-Number-Booking-Delete')
               <a href="" class="delete_btn" @if($booking->status == 'Uses'){{ 'disabled' }} @endif data-backdrop="static" data-keyboard="false"
                  data-toggle="modal" data-target="#deleteModel" data-act="Delete" data-id="{{ $booking->id }}" >
                  <img src="{{ asset('images/delete.png') }}" alt="" title="{{trans('button.delete')}}" width="25px" height="25px">
               </a>
               @endcan
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>

  </body>
</html>
</div>

@include('Module4.LicenseNoBooking.Modal')
@include('delete')
@endsection
@push('page_scripts')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script> -->
<script src="{{ asset('vrms2/js/app-form.js') }}"></script>
<script src="{{ asset('vrms2/js/showModal.js')}}"></script>
<script type="text/javascript">
   $('#lic_booking_editModel, #lic_booking_addModel').on('hidden.bs.modal', function () {
      $("#lic_booking_editModel, #lic_booking_addModel").find('form').trigger('reset');
      $('.js-example-basic-single').val(null).trigger('change');
      $(".status, .upd-status").text("");
   });
 
</script>

@endpush