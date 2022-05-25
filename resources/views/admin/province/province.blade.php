@extends('vrms2.layouts.master')
@section('province','active')
@section('content')
@include('vrms2.mod3-submenu')
<h3>
   {{trans('title.province')}}
   <a data-toggle="modal" data-target="#addModel1" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-save" style="color: #fff !important">{{trans('common.add_new')}}</a>
  </h3>
@include('flash')
<div class="card-body">
   <table id="myTable" class="table table-striped" style="width:100%">
      <thead>
         <tr>
            <th>{{trans('table_man.pro_code')}}</th>
            <th>{{trans('table_man.pro_name')}}</th>
            <th>{{trans('table_man.abbname')}}</th>
            <th>{{trans('table_man.index_country_name')}}</th>
            <th>{{trans('common.status')}}</th>
            <th width="150">{{trans('common.action')}}</th>
         </tr>
      </thead>
      <tbody>
         @foreach($provinces as $province)
         <tr>
            <td>{{$province->province_code}}</td>
            <td>{{$province->name}}({{$province->name_en}})</td>
            <td>@if($province->abb){{$province->abb}}({{$province->abb_en}})@else{{"_"}}@endif</td>
            <td>@if(isset($province->country->name))<span>{{$province->country['name']}}({{$province->country->name_en}})</span>@else{{"_"}}@endif</td>
            <td>@if($province->status ==1)Active @else Deactive @endif</td>
            <td>
               <a href="#" 
               class="edit_btn" 
               data-toggle="modal" 
               data-target="#editModel" 
               data-backdrop="static" 
               data-keyboard="false" 
               data-act="Edit" 
               data-name="{{$province->name}}" 
               data-abb="{{$province->abb}}" 
               data-abb_en="{{$province->abb_en}}" 
               data-province_code="{{$province->province_code}}" 
               data-name_en="{{$province->name_en}}" 
               data-desc="{{$province->desc}}" 
               data-old_name="{{$province->old_name}}" 
               data-country_id="{{$province->country_id}}" 
               data-status="{{$province->status}}" 
               data-id="{{$province->id}}" 
               data-backdrop="static" 
               data-keyboard="false">
               <img src="{{ asset('images/edit.png') }}" alt="" title="{{trans('button.edit')}}" width="25px" height="25px">
            </a>
               
               <a href="#" class="delete_btn" 
               data-toggle="modal" 
               data-target="#deleteModel" 
               data-backdrop="static" 
               data-keyboard="false" 
               data-act="Delete" 
               data-id="{{$province->id}}" 
               data-backdrop="static" 
               data-keyboard="false">
               <img src="{{ asset('images/delete.png') }}" alt="" title="{{trans('button.delete')}}" width="25px" height="25px">
            </a>
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>
</div>
@component('component.admin.province',['country'=>$country])
@endcomponent
@include('delete')
@endsection
@push('page_scripts')
<script type="text/javascript">
   var base_url = "{{url('admin/province')}}";
   $(document).on("click", '.delete_btn', function(e) {
      document.getElementById("deleteform").action = base_url + "/" + $(this).data('id');
   });

   $(document).on("click", '.edit_btn', function(e) {
      $('[name="name"]').val($(this).data('name'));
      $('[name="name_en"]').val($(this).data('name_en'));
      $('[name="abb"]').val($(this).data('abb'));
      $('[name="abb_en"]').val($(this).data('abb_en'));
      $('[name="province_code"]').val($(this).data('province_code'));
      $('[name="desc"]').val($(this).data('desc'));
      $('[name="old_name"]').val($(this).data('old_name'));
      $('[name="country_id"]').val($(this).data('country_id'));
      $('[name="status"]').val($(this).data('status'));
      $('[name="location"]').val($(this).data('location'));
      $('#edit-id').val($(this).data('id'));
      document.getElementById("editform").action = base_url + "/" + $(this).data('id');
   });

   $('#add-form').click(function(e) {
      e.preventDefault();
      var province_code = $('#addModel1 .province_code');
      var name = $("#addModel1 .province_name");
      var name_en = $("#addModel1 .province_name_en");
      var abb_name = $("#addModel1 .abb_name");
      var abb_name_en = $("#addModel1 .abb_name_en");
      var country = $("#addModel1 .country");
      var oldId = $("#new-id").val();
      var form = $("#addform");
      insertProvince(province_code, name, name_en, abb_name, abb_name_en, country, form, oldId);
   });

   $('#edit-form').click(function(e) {
      e.preventDefault();
      var province_code = $('#editModel .province_code');
      var name = $("#editModel .province_name");
      var name_en = $("#editModel .province_name_en");
      var abb_name = $("#editModel .abb_name");
      var abb_name_en = $("#editModel .abb_name_en");
      var country = $("#editModel .country");
      var oldId = $("#edit-id").val();
      var form = $("#editform");
      insertProvince(province_code, name, name_en, abb_name, abb_name_en, country, form, oldId);
   });

   function insertProvince(province_code, name, name_en, abb_name, abb_name_en, country, form, oldId = null) {
      var url = "/get-province?province_code=" + province_code.val() + "&name=" + name.val() + "&name_en=" + name_en.val() + "&abb_name=" + abb_name.val() + "&abb_name_en=" + abb_name_en.val() + "&id=" + oldId;
      $.get(url, function(response) {

         if (province_code.val().trim() == '') {
            alert($('.province_code').attr('title'));
            $('.province_code').focus();
            return false;
         } else if (name.val().trim() == '') {
            alert($('.province_name').attr('title'));
            $('.province_name').focus();
            return false;
         } else if (name_en.val().trim() == '') {
            alert($('.province_name_en').attr('title'));
            $('.province_name_en').focus();
            return false;
         } else if (abb_name.val().trim() == '') {
            alert($('.abb_name').attr('title'));
            $('.abb_name').focus();
            return false;
         } else if (abb_name_en.val().trim() == '') {
            alert($('.abb_name_en').attr('title'));
            $('.abb_name_en').focus();
            return false;
         } else if (country.val().trim() == null) {
            alert($('.country').attr('title'));
            $('.country').focus();
            return false;
         } else if (response.province > 0) {
            alert('ຂໍ້ມູນນີ້ມີຢູ່ແລ້ວ');
            return false;
         } else {
            form.submit();
         }

      });
   }

   $('.modal').on('hidden.bs.modal', function() {
      $(this).find('form').trigger('reset');
      $('.js-example-basic-single').val(null).trigger('change');
   });
</script>
@endpush