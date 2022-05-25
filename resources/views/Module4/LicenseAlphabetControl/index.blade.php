@extends('vrms2.layouts.master')
@section('alphabet_status','active')
@section('content')
@include('vrms2.mod3-submenu')
<h3>{{ trans('module4.lic_alphabet_control_title') }}
   <a data-toggle="modal" data-target="#addModel" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-sm btn-save ">{{trans('common.add_new')}}</a>
</h3>
@include('flash')
<div class="card-body">
   <div class="table-responsive">
      <table id="myTable" class="table table-striped">
         <thead>
            <tr>
               <th>Alphabet Control Status</th>
               <th>{{ trans('common.action')}}</th>
            </tr>
         </thead>
         <tbody>
            @foreach($license_control as $data)
            <tr>
               <td>{{$data->name}}</td>
               <td>
                  <a href="" class="edit_btn " data-toggle="modal" 
                  data-target="#editModel" data-backdrop="static" data-keyboard="false" 
                  data-act="Edit" data-name="{{$data->name}}" data-id="{{$data->id}}">
                  <img src="{{ asset('images/edit.png') }}" alt="" title="{{trans('button.edit')}}" width="25px" height="25px"></a>
                
                  <a href="" class="delete_btn " data-toggle="modal" data-target="#deleteModel" 
                  data-backdrop="static" data-keyboard="false" data-id="{{$data->id}}">
                  <img src="{{ asset('images/delete.png') }}" alt="" title="{{trans('button.delete')}}" width="25px" height="25px">
                  </a>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
</div>
@include('delete')
@include('Module4.LicenseAlphabetControl.modal')
@endsection
@push('page_scripts')
<script type="text/javascript">
   var base_url = "{{url('/license-alphabet-control')}}";
   $(document).on("click", '.delete_btn', function(e) {
      document.getElementById("deleteform").action = base_url + "/" + $(this).data('id');
   });

   $(document).on("click", '.edit_btn', function(e) {
      $('[name="name"]').val($(this).data('name'));
      $("#edit-id").val($(this).data('id'));
      document.getElementById("editform").action = base_url + "/" + $(this).data('id');
   });

   $('#add-form').click(function(e) {
      e.preventDefault();
      var name = $('#addModel .name');
      var oldId = $("#new-id").val();
      var form = $("#addform");
      insertAlphabetControlStatus(name, form, oldId);
   });

   $('#edit-form').click(function(e) {
      e.preventDefault();
      var name = $('#editModel .name');
      var oldId = $("#edit-id").val();
      var form = $("#editform");
      insertAlphabetControlStatus(name, form, oldId);
   });

   function insertAlphabetControlStatus(name, form, oldId = null) {
      var url = "/get-alphabet-control-status?name=" + name.val() + "&id=" + oldId;
      $.get(url, function(response) {
         if (name.val().trim() == '') {
            alert($('.name').attr('title'));
            $('.name').focus();
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