@extends('vrms2.layouts.master')
@section('v_model','active')
@section('content')

@include('vrms2.mod3-submenu')
<h3>
   {{trans('title.vehiclemodel')}}
   <a data-toggle="modal" data-target="#addModel1" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-save" style="color: #fff !important">{{trans('common.add_new')}}</a>
</h3>
@include('flash')
<div class="card-body">
   <table id="myTable" class="table table-striped" style="width:100%">
      <thead>
         <tr>
            <th style="width: 20%;">{{trans('common.name')}}(Lao)</th>
            <th style="width: 20%;">{{trans('common.name')}}(Eng)</th>
            <th>{{trans('common.desc')}}</th>
            <th style="width: 20%;">{{trans('table_man.vbrand_name')}}</th>
            <th>{{trans('common.status')}}</th>
            <th width="200">{{trans('common.action')}}</th>
         </tr>
      </thead>
      <tbody>
         @foreach($result as $key=>$value)
         @foreach($value as $data)
         <tr>
            <td>{{$data['name']}}</td>
            <td>{{$data->name_en}}</td>
            <td>{{$data->description}}</td>
            <td>@if(isset($data->brand->name)) <span>{{$data->brand['name']}}({{$data->brand['name_en']}})</span>@else{{"_"}}@endif </td>
            <td>@if($data->status ==1)Active @else Deactive @endif</td>
            <td class="sorting">
               <a href="#" class="edit_btn" data-toggle="modal" data-backdrop="static" 
               data-keyboard="false" data-target="#editModel" 
               data-act="Edit" data-name="{{$data->name}}" 
               data-name_en="{{$data->name_en}}" data-description="{{$data->description}}" 
               data-brand_id="{{$data->brand_id}}" data-status="{{$data->status}}" 
               data-id="{{$data->id}}">
               <img src="{{ asset('images/edit.png') }}" alt="" title="{{trans('button.edit')}}" width="25px" height="25px"></a>
               <a href="#" class="delete_btn" data-toggle="modal" data-backdrop="static" 
               data-keyboard="false" data-target="#deleteModel" data-act="Delete" 
               data-id="{{$data->id}}">
               <img src="{{ asset('images/delete.png') }}" alt="" title="{{trans('button.delete')}}" width="25px" height="25px">
               </a>
            </td>
         </tr>
         @endforeach
         @endforeach
      </tbody>
   </table>
</div>
@component('component.admin.vehicle-model',['brand'=>$brand]) @endcomponent
@include('delete')
@endsection
@push('page_scripts')
<script type="text/javascript">
   var base_url = "{{url('admin/vehicle-model')}}";
   $(document).on("click", '.delete_btn', function(e) {
      document.getElementById("deleteform").action = base_url + "/" + $(this).data('id');
   });
   $(document).on("click", '.edit_btn', function(e) {

      $('[name="name"]').val($(this).data('name'));
      $('[name="name_en"]').val($(this).data('name_en'));
      $('[name="description"]').val($(this).data('description'));
      $('[name="brand_id"]').val($(this).data('brand_id'));
      $('[name="status"]').val($(this).data('status'));
      $('#edit-id').val($(this).data('id'));
      document.getElementById("editform").action = base_url + "/" + $(this).data('id');
   });

   $('#add-form').click(function(e) {
      e.preventDefault();
      var name = $('#addModel1 .name');
      var name_en = $("#addModel1 .name_en");
      var brand = $("#addModel1 .brand");
      var desc = $("#addModel1 .desc");
      var oldId = $("#new-id").val();
      var form = $("#addform");
      insertModel(name, name_en, brand, desc, form, oldId);
   });

   $('#edit-form').click(function(e) {
      e.preventDefault();
      var name = $('#editModel .name');
      var name_en = $("#editModel .name_en");
      var brand = $("#editModel .brand");
      var desc = $("#editModel .desc");
      var oldId = $("#edit-id").val();
      var form = $("#editform");
      insertModel(name, name_en, brand, desc, form, oldId);
   });

   function insertModel(name, name_en, brand, desc, form, oldId = null) {
      var url = "/get-model?brand=" + brand.val() + "&name=" + name.val() + "&name_en=" + name_en.val() + "&id=" + oldId;
      $.get(url, function(response) {

         if (name.val().trim() == '') {
            alert($('.name').attr('title'));
            $('.name').focus();
            return false;
         } else if (name_en.val().trim() == '') {
            alert($('.name_en').attr('title'));
            $('.name_en').focus();
            return false;
         } else if (desc.val().trim() == '') {
            alert($('.desc').attr('title'));
            $('.desc').focus();
            return false;
         } else if (brand.val() == null) {
            alert($('.brand').attr('title'));
            $('.brand').focus();
            return false;
         } else if (response.status == "used") {
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