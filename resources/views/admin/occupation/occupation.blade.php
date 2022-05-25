@extends('vrms2.layouts.master')
@section('occupation','active')
@section('content')

@include('vrms2.mod3-submenu')
<h3>
  {{trans('sidebar.occupation')}}
  <a data-toggle="modal" data-target="#addModel1" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-save" style="color: #fff !important">{{trans('common.add_new')}}</a>
</h3>

@include('flash')
<div class="card-body">
  <table id="myTable" class="table table-striped" style="width:100%">
    <thead>
      <tr>
        <th>{{trans('table.namel')}}</th>
        <th>{{trans('table.namee')}}</th>
        <th>{{trans('table.status')}}</th>
        <th>{{trans('table.action')}}</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $key=>$occupation)
      <tr>
        <td>{{$occupation->name}}</td>
        <td>{{$occupation->name_en}}</td>
        <td>@if($occupation->status ==1){{trans('table.active')}} @else {{trans('table.deactive')}}@endif</td>
        <td>
         
          <a href="#" 
          class="edit_btn" 
          data-toggle="modal"
          data-backdrop="static" 
          data-keyboard="false" 
          data-target="#editModel" 
          data-act="Edit" 
          data-name="{{$occupation->name}}" 
          data-name_en="{{$occupation->name_en}}" 
          data-status="{{$occupation->status}}" 
          data-id="{{$occupation->id}}">
          <img src="{{ asset('images/edit.png') }}" alt="" title="{{trans('button.edit')}}" width="25px" height="25px"></a>
         
          <a href="#" 
          class="delete_btn" 
          data-toggle="modal" 
          data-backdrop="static" 
          data-keyboard="false" 
          data-target="#deleteModel" 
          data-act="Delete" 
          data-id="{{$occupation->id}}">
          <img src="{{ asset('images/delete.png') }}" alt="" title="{{trans('button.delete')}}" width="25px" height="25px"> 
          </a>
        </td>
        @endforeach
    </tbody>
  </table>
</div>

@component('component.admin.occupation') @endcomponent
@include('delete')
@endsection
@push('page_scripts')
<script type="text/javascript">
  var base_url = "{{url('admin/occupation')}}";
  $(document).on("click", '.delete_btn', function(e) {
    document.getElementById("deleteform").action = base_url + "/" + $(this).data('id');
  });

  $(document).on("click", '.edit_btn', function(e) {
    $('[name="name"]').val($(this).data('name'));
    $('[name="name_en"]').val($(this).data('name_en'));
    $('[name="status"]').val($(this).data('status'));
    $('#edit-id').val($(this).data('id'));
    document.getElementById("editform").action = base_url + "/" + $(this).data('id');
  });
  $('#add-form').click(function(e) {
    e.preventDefault();
    var name = $('#addModel1 .name');
    var name_en = $("#addModel1 .name_en");
    var oldId = $("#new-id").val();
    var form = $("#addform");
    insertRecord(name, name_en, form, oldId);
  });

  $('#edit-form').click(function(e) {
    e.preventDefault();
    var name = $('#editModel .name');
    var name_en = $("#editModel .name_en");
    var oldId = $("#edit-id").val();
    var form = $("#editform");
    insertRecord(name, name_en, form, oldId);
  });
  
  function insertRecord(name, name_en, form, oldId = null) {
    var url = "/get-occupation?name=" + name.val() + "&name_en=" + name_en.val() + "&id=" + oldId;
    $.get(url, function(response) {
      if (name.val().trim() == '') {
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