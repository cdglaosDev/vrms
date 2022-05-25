@extends('vrms2.layouts.master')
@section('lic_not_sale','active')
@section('content')
@include('vrms2.mod4-submenu') 
@php
$license_sale = \App\Model\LicenseNoSale::SaleNo();
@endphp
<h3>{{ trans('module4.license_number_not_sale') }}
   @can('License-Number-Not-Sale-Create')
   <a data-toggle="modal" data-target="#addModel" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-sm btn-save ">{{trans('common.add_new')}}</a>
   @endcan
</h3>
@include('flash') 
<div class="card-body">
   <table id="myTable" class="table table-striped" style="width:100%">
      <thead>
         <tr>
            <th>{{trans('module4.no')}}.</th>
            <th>{{trans('module4.license_no')}}.</th>
            <th>{{trans('common.province')}}</th>
            <th>{{ trans('common.status') }}</th>
            <th>{{trans('common.action')}}</th>
         </tr>
      </thead>
      <tbody>
         @foreach($license_not_sales as $key=>$license_not_sale)
         <tr>
            <td>{{ ++$key }}</td>
            <td>{{ $license_not_sale->license_no_not_sale_number }}</td>
            <td>{{ $license_not_sale->province->name ?? ''}} ({{  $license_not_sale->province->name_en ?? '' }})</td>
            <td>{{ $license_not_sale->status ==1?'Active':'Deactive'}}</td>
            <td>
               @can('License-Number-Not-Sale-Edit')
               <a href="" class="edit_btn" data-toggle="modal" data-target="#editModel" data-backdrop="static" data-keyboard="false"
                  data-act="Edit" data-license_no_not_sale_number="{{ $license_not_sale->license_no_not_sale_number }}"
                  data-status="{{$license_not_sale->status}}" data-province_code ="{{$license_not_sale->province_code }}" data-id="{{$license_not_sale->id}}">
                  <img src="{{ asset('images/edit.png') }}" alt="" title="{{trans('button.edit')}}"  width="25px" height="25px"></a>  
               @endcan
               @can('License-Number-Not-Sale-Delete')
               <a href="" class="delete_btn" data-toggle="modal" data-target="#deleteModel" data-backdrop="static" data-keyboard="false" data-act="Delete" data-id="{{$license_not_sale->id}}">
                  <img src="{{ asset('images/delete.png') }}" alt="" title="{{trans('button.delete')}}" width="25px" height="25px"></a> 
               @endcan
            </td>
         </tr>
         @endforeach 
      </tbody>
   </table>
</div>
@include('Module4.LicenseNumberNotSale.Modal')
@include('delete')
@endsection
@push('page_scripts')
<script type="text/javascript">
   var base_url = "{{url('/license-number-not-sale')}}";
      $(document).on("click", '.delete_btn', function (e) {  
          document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
      });
    
      $(document).on("click", '.edit_btn', function (e) {   
          $('[name="license_no_not_sale_number"]').val($(this).data('license_no_not_sale_number'));
          $('[name="status"]').val($(this).data('status'));
          $('[name="province_code"]').val($(this).data('province_code')).change();
          $('#edit-id').val($(this).data('id'));
          document.getElementById("editform").action = base_url+"/"+$(this).data('id');
      });
    
    
      var existingNo = [];
      $('#add-new').click(function(e){
         e.preventDefault();
         var licNo = $('#addModel .lic-no');
         var province = $("#addModel .province");
         var oldId = $("#new-id").val();
         var form = $("#newForm");
         updateLicenseNotSale(province, licNo, form, oldId);
      });
     
      $('#update-form').click(function(e){
         e.preventDefault();
         var licNo = $('#editModel .lic-no');
         var province = $("#editModel .province");
         var oldId = $("#edit-id").val();
         var form = $("#editform");
         updateLicenseNotSale(province, licNo, form, oldId);
      });
        //validate just type only number and hypen key
      $('input.number-only').on('keyup', function(e) {
         $(this).val($(this).val().replace(/[^0-9]/g, ''));
      }); 

      function updateLicenseNotSale(province, licNo, form, oldId=null)
      {
         var url = "/getNotSale?province=" + province.val() + "&id=" + oldId;
         $.get(url, function(response) {
               existingNo = response.license_not_sale;
               existBooking = response.license_booking;
               var lastTwoNo = licNo.val().slice(licNo.val().length - 2);
                  if(licNo.val() == '') {
                     alert($('.lic-no').attr('title'));
                     licNo.focus();
                     return false;
               
                  } else if(province.val() == null) {
                     alert($('.province').attr('title'));
                     province.focus();
                     return false;
                  
                  } else if (existingNo.includes(licNo.val())) {
                     alert('ຂໍ້ມູນນີ້ມີຢູ່ແລ້ວ');
                     return false;
                  } else if(existBooking.includes(licNo.val())){
                     alert('This license number already used in license booking.');
                     return false;
                  } else {
                     form.submit();
                  }
               
            });
      }
        
 

</script>
@endpush