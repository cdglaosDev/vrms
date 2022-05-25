@extends('vrms2.layouts.master')
@section('lic_sale','active')
@section('content')
@include('vrms2.mod4-submenu') 

<h3>{{ trans('module4.license_number_sale') }}
   @can('License-Number-Sale-Create')
   <a data-toggle="modal" data-target="#addModel" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-sm btn-save ">{{trans('common.add_new')}}</a>
   @endcan
</h3>
@include('flash') 
<div class="card-body">
   <table id="myTable" class="table table-striped" style="width:100%">
      <thead>
         <tr>
            <th>{{ trans('module4.no') }}.</th>
            <th>{{ trans('module4.license_no') }}.</th>
            <th>{{ trans('common.province') }}</th>
            <th>{{ trans('module4.price_item') }}</th>
            <th>{{ trans('common.status')}}</th>
            <th>{{ trans('common.action') }}</th>
         </tr>
      </thead>
      <tbody>
         @foreach($license_sales as $key=>$license_sale)
         <tr>
            <td>{{ ++$key }}</td>
            <td>{{ $license_sale->license_no_sale_number }}</td>
            <td>{{$license_sale->province->name ?? '' }} ({{ $license_sale->province->name_en ?? '' }}) </td>
            <td>{{ $license_sale->priceItem->name ?? ''}}</td>
            <td>{{ $license_sale->status ==1?'Active':'Deactive'}}</td>
            <td>
               @can('License-Number-Sale-Edit')
               <a href="" class="edit_btn" data-toggle="modal" data-target="#editModel" data-backdrop="static" data-keyboard="false"
                  data-act="Edit" data-price_item_id="{{ $license_sale->price_item_id }}"
                  data-license_no_sale_number="{{$license_sale->license_no_sale_number}}" data-status="{{$license_sale->status}}"
                  data-province_code ="{{ $license_sale->province_code}}" data-id="{{$license_sale->id}}">
                  <img src="{{ asset('images/edit.png') }}" alt="" title="{{trans('button.edit')}}"  width="25px" height="25px"></a>  
               @endcan
               @can('License-Number-Sale-Delete')
               <a href="" class="delete_btn"
                  data-toggle="modal" data-target="#deleteModel" data-backdrop="static" data-keyboard="false" data-act="Delete" data-id="{{$license_sale->id}}">
                  <img src="{{ asset('images/delete.png') }}" alt="" title="{{trans('button.delete')}}" width="25px" height="25px"></a> 
               @endcan
            </td>
         </tr>
         @endforeach 
      </tbody>
   </table>
</div>
@include('Module4.LicenseNumberSale.Modal')
@include('delete')
@endsection
@push('page_scripts')

<script type="text/javascript">
   var base_url = "{{url('/license-number-sale')}}";
   var get_price = "{{url('/get-unit-price')}}";

      $(document).on("click", '.delete_btn', function (e) {  
           document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
      });
      
      $(document).on("click", '.edit_btn', function (e) {

           $('[name="price_item_id"]').val($(this).data('price_item_id')).change();
           $('[name="province_code"]').val($(this).data('province_code')).change();
           $('[name="license_no_sale_number"]').val($(this).data('license_no_sale_number'));
           $('[name="status"]').val($(this).data('status'));
           $('#edit-id').val($(this).data('id'));
           priceValue($(this).data('province_code'), $(this).data('price_item_id'));
           document.getElementById("editform").action = base_url+"/"+$(this).data('id');
      });

      $('#add-new').click(function(e){
          e.preventDefault();
          var licNo = $('#addModel .lic-no');
          var province = $("#addModel .province");
          var priceItem = $("#addModel #price-item");
          var oldId = $("#new-id").val();
          var form = $("#newForm");
          checkLicenseSale(province, licNo, priceItem, form, oldId);
      });

      $('#update-form').click(function(e){
          e.preventDefault();
          var licNo = $('#editModel .lic-no');
          var province = $("#editModel .province");
          var priceItem = $("#edit-price-item");
          var oldId = $("#edit-id").val();
          var form = $("#editform");
          checkLicenseSale(province, licNo, priceItem, form, oldId);
      });

      function checkLicenseSale(province, licNo, priceItem, form, oldId=null)
      { 
          var url = "/getLicSale?province=" + province.val() + "&id=" + oldId + "&licNo=" + licNo.val();
          $.get(url, function(response) {
           
            var lastTwoNo = licNo.val().slice(licNo.val().length - 2);
              if (licNo.val() == '') {
                alert($('.lic-no').attr('title'));
                licNo.focus();
                return false;
              }else if (licNo.val().length < 4) {
                alert($('.lic-no').attr('validateNo'));
                licNo.focus();
                return false;
              } else if (province.val() == null) {
                alert($('.province').attr('title'));
                province.focus();
                return false;
              } else if (response.lic_sale.includes(licNo.val()) || response.lic_not_sale.includes(licNo.val())) {
                alert('ຂໍ້ມູນນີ້ມີຢູ່ແລ້ວ');
                return false;
              } else if (priceItem.val() == null) {
                alert($(".price_item").attr('title'));
                priceItem.focus();
                return false;
              } else if (lastTwoNo == 27 || lastTwoNo == 67) {
                  alert('This number unable to sell.');
                  insertNotSaleNumber(licNo.val(), province.val());
                return false;
              } else {
                form.submit();
              }
        });
      }

      
      $('#price-item, #edit-price-item').change(function(){
      var price_item_id = $(this).val(); 
      var province =  $(".province option:selected").val();
      if(price_item_id){
          $.ajax({
            type:"GET",
              url:get_price+ "/"+price_item_id,
              data:{province:province},
              dataType: 'json',
              headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}" },
            
            success:function(data){  
             
              if(data){
                $(".price").val(data);
            
              }else{
                $(".price").empty();
              }
            }
          });
      }else{
          $(".price").empty();
        
      }      
      });
   
  function priceValue(province, price_item_id) {
  $.ajax({
         type:"GET",
           url:get_price+ "/"+price_item_id,
           data:{province:province},
           dataType: 'json',
           headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}" },
         success:function(data){ 
           if(data){
             $(".price").val(data);
           }else{
             $(".error-text").text("Need to add unit price for this price item");
           }
         }
  });
  }

   //validate just type only number and hypen key
  $('input.number-only').on('keyup', function(e) {
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
  }); 

  function insertNotSaleNumber(licNo, province_code) {
  $.ajax({
         type:"POST",
           url:'/save-license-not-sale',
           data:{province_code:province_code, licNo:licNo},
           dataType: 'json',
           headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}" },
         success:function(data){ 
           
         }
  });
  }
</script>
@endpush