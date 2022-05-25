@extends('vrms2.layouts.master')
@section('service','active')
@section('content')

@include('vrms2.mod3-submenu')
<h3>
  {{trans('title.service')}}
  <a data-toggle="modal" data-target="#addModel1" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-save" style="color: #fff !important">{{trans('common.add_new')}}</a>
 </h3>

@include('flash')
<div class="card-body">
  <table id="myTable" class="table table-striped" style="width:100%">
    <thead>
      <tr>
        <th>{{trans('table.namel')}}</th>
        <th>{{trans('table.namee')}}</th>
        <th>{{ trans('common.province') }}</th>
        <th>{{trans('common.status')}}</th>
        <th>{{trans('common.action')}}</th>
      </tr>
    </thead>
    <tbody>
      @foreach($services as $key=>$service)
      <tr>
        <td>{{ $service->name }}</td>
        <td>{{ $service->name_en }}</td>
        <td>{{ $service->province->name ?? '' }}({{ $service->province->name_en ?? ''}})</td>
        <td>@if($service->status ==1)Active @else Deactive @endif</td>
        <td>
          <a href="#" class="edit_btn" 
          data-toggle="modal" 
          data-backdrop="static" 
          data-keyboard="false" 
          data-target="#editModel" 
          data-act="Edit" 
          data-name="{{$service->name}}" 
          data-name_en="{{$service->name_en}}" 
          data-description="{{$service->description}}" 
          data-status="{{$service->status}}" 
          data-id="{{$service->id}}" 
          data-province_code="{{ $service->province_code }}">
          <img src="{{ asset('images/edit.png') }}" alt="" title="{{trans('button.edit')}}" width="25px" height="25px"></a>
          <a href="#" class="delete_btn" 
          data-toggle="modal" 
          data-backdrop="static" 
          data-keyboard="false" 
          data-target="#deleteModel" 
          data-act="Delete" 
          data-id="{{$service->id}}">
          <img src="{{ asset('images/delete.png') }}" alt="" title="{{trans('button.delete')}}" width="25px" height="25px"> </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@component('component.admin.service_counter',['provinces'=>$province,'user'=>$user]) @endcomponent
@include('delete')
@endsection
@push('page_scripts')
<script type="text/javascript">
  var base_url = "{{url('/admin/service-counter')}}";
  $(document).on("click", '.delete_btn', function(e) {
    document.getElementById("deleteform").action = base_url + "/" + $(this).data('id');
  });

  $(document).on("click", '.edit_btn', function(e) {
    $('[name="name"]').val($(this).data('name'));
    $('[name="name_en"]').val($(this).data('name_en'));
    $('[name="province_code"]').val($(this).data('province_code')).change();
    $('[name="description"]').val($(this).data('description'));
    $('[name="status"]').val($(this).data('status'));
    $('#edit-id').val($(this).data('id'));
    document.getElementById("editform").action = base_url + "/" + $(this).data('id');
  });

  $('#add-form').click(function(e) {
    e.preventDefault();
    var province_code = $('#addModel1 .province_code');
    var name = $("#addModel1 .name");
    var name_en = $("#addModel1 .name_en");
    var desc = $("#addModel1 .desc");
    var oldId = $("#new-id").val();
    var form = $("#addform");
    insertServiceCounter(province_code, name, name_en, desc, form, oldId);
  });

  $('#edit-form').click(function(e) {
    e.preventDefault();
    var province_code = $('#editModel .province_code');
    var name = $("#editModel .name");
    var name_en = $("#editModel .name_en");
    var desc = $("#editModel .desc");
    var oldId = $("#edit-id").val();
    var form = $("#editform");
    insertServiceCounter(province_code, name, name_en, desc, form, oldId);
  });

  function insertServiceCounter(province_code, name, name_en, desc, form, oldId = null) {
    var url = "/get-service-counter?province_code=" + province_code.val() + "&name=" + name.val() + "&name_en=" + name_en.val() + "&id=" + oldId;
    $.get(url, function(response) {
      if (province_code.val() == null) {
        alert($('.province_code').attr('title'));
        $('.province_code').focus();
        return false;
      } else if (name.val().trim() == '') {
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