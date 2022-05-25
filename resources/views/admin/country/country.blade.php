@extends('vrms2.layouts.master')
@section('country','active')
@section('content')

@include('vrms2.mod3-submenu')
<h3>
   {{trans('title.country')}}
   <a data-toggle="modal" data-target="#addModel1" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-save" style="color: #fff !important">{{trans('common.add_new')}}</a>
  
</h3>
@include('flash')
<div class="card-body">
   <table id="myTable" class="table table-striped" style="width:100%">
      <thead>
         <tr>
            <th>{{trans('table_man.iso')}}</th>
            <th>{{trans('table.namel')}} </th>
            <th> {{trans('table.namee')}}</th>
            <th>{{trans('common.status')}} </th>
            <th>{{trans('common.action')}} </th>
         </tr>
      </thead>
      <tbody>
         @foreach($data as $key=>$country)
         <tr>
            <td>{{$country->iso}}</td>
            <td>{{$country->name}}</td>
            <td>{{$country->name_en}}</td>
            <td>@if($country->status ==1)Active @else Deactive @endif</td>
            <td>
               <a href="#" class="edit_btn" data-toggle="modal" data-target="#editModel" data-backdrop="static" data-keyboard="false" data-act="Edit" data-iso="{{$country->iso}}" data-name="{{$country->name}}" data-name_en="{{$country->name_en}}" title="{{trans('button.edit')}}" data-status="{{$country->status}}" data-id="{{$country->id}}">
               <img src="{{ asset('images/edit.png') }}" alt="" width="25px" height="25px"></a>

               <a href="#" class="delete_btn" data-toggle="modal" data-target="#deleteModel" data-backdrop="static" data-keyboard="false" data-act="Delete" title="{{trans('button.delete')}}" data-id="{{$country->id}}">
                  <img src="{{ asset('images/delete.png') }}" alt="" width="25px" height="25px">
               </a>
            
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>
</div>
@component('component.admin.country1')
@endcomponent
@include('delete')
@endsection
@push('page_scripts')
<script type="text/javascript">
   var base_url = "{{url('admin/country/')}}";
   $(document).on("click", '.delete_btn', function(e) {
      document.getElementById("deleteform").action = base_url + "/" + $(this).data('id');
   });

   $(document).on("click", '.edit_btn', function(e) {
      $('[name="iso"]').val($(this).data('iso'));
      $('[name="name"]').val($(this).data('name'));
      $('[name="name_en"]').val($(this).data('name_en'));
      $('#edit-id').val($(this).data('id'));
      $('[name="status"]').val($(this).data('status'));
      document.getElementById("editform").action = base_url + "/" + $(this).data('id');
   });

   $('#add-form').click(function(e) {
      e.preventDefault();
      var iso = $('#addModel1 .iso');
      var name = $("#addModel1 .name");
      var name_en = $("#addModel1 .name_en");
      var oldId = $("#new-id").val();
      var form = $("#addform");
      insertCountry(iso, name, name_en, form, oldId);
   });

   $('#update-form').click(function(e) {
      e.preventDefault();
      var iso = $('#editModel .iso');
      var name = $("#editModel .name");
      var name_en = $("#editModel .name_en");
      var oldId = $("#edit-id").val();
      var form = $("#editform");
      insertCountry(iso, name, name_en, form, oldId);
   });

   function insertCountry(iso, name, name_en, form, oldId = null) {
      var url = "/get-country?iso=" + iso.val() + "&name=" + name.val() + "&name_en=" + name_en.val() + "&id=" + oldId;
      $.get(url, function(response) {
         if (iso.val().trim() == '') {
            alert($('.iso').attr('title'));
            $('.iso').focus();
            return false;
         } else if (name.val().trim() == '') {
            alert($('.name').attr('title'));
            $('.name').focus();
            return false;
         } else if (name_en.val().trim() == '') {
            alert($('.name_en').attr('title'));
            $('.name_en').focus();
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
   });
</script>
@endpush