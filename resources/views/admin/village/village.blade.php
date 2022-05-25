@extends('vrms2.layouts.master')
@section('village','active')
@section('content')
@include('vrms2.mod3-submenu')
<h3>
  {{trans('title.village')}}
  <a data-toggle="modal" data-target="#addModel1" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-save" style="color: #fff !important">{{trans('common.add_new')}}</a>
 </h3>
 
@include('flash')
<div class="card-body">
  <table id="myTable" class="table table-striped" style="width:100%">
    <thead>
      <tr>
        <th>{{trans('table_man.vill_code')}}</th>
        <th>{{trans('table_man.vill_name')}}</th>
        <th>{{trans('table_man.vill_namee')}}</th> 
        <th>{{ trans('table_man.pro_name') }}</th>
        <th>{{trans('table_man.dist_name')}}</th>
        <th>{{trans('common.status')}}</th>
        <th>{{trans('common.action')}}</th>
      </tr>
    </thead>
    <tbody>
      @foreach($villages as $key=>$village)
      <tr>
        <td>{{$village->village_code}}</td>
        <td>{{$village->name}}</td>
        <td>{{$village->name_en}}</td>
        <td>{{ $village->province->name ?? ''}}( {{ $village->province->name_en ?? ''}})</td>
        <td><span>{{$village->district['name'] ?? ''}}({{$village->district['name_en'] ?? ''}})</span></td>
        <td>@if($village->status ==1)Active @else Deactive @endif</td>
        <td>
        
          <a href="#"  
          class="edit_btn" 
          data-toggle="modal" 
          data-backdrop="static" 
          data-keyboard="false" 
          data-target="#editModel" 
          data-act="Edit" 
          data-name="{{$village->name}}" 
          data-village_code="{{$village->village_code}}" 
          data-name_en="{{$village->name_en}}" 
          data-description="{{$village->description}}" 
          data-province_code="{{$village->province_code}}" 
          data-district_code="{{$village->district_code}}" 
          data-status="{{$village->status}}" 
          data-id="{{$village->id}}">
          <img src="{{ asset('images/edit.png') }}" alt="" title="{{trans('button.edit')}}" width="25px" height="25px"></a>
          <a class="delete_btn" 
          data-toggle="modal" 
          data-backdrop="static" 
          data-keyboard="false" 
          data-target="#deleteModel" 
          data-act="Delete" 
          data-id="{{$village->id}}">
          <img src="{{ asset('images/delete.png') }}" alt="" title="{{trans('button.delete')}}" width="25px" height="25px">
        </a>
         
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@component('component.admin.village',['province'=>$province]) @endcomponent
@include('delete')
@endsection
@push('page_scripts')
<script type="text/javascript" src="{{asset('vrms2/js/dropdownlist.js')}}"></script>
<script type="text/javascript">
  var base_url = "{{url('/admin/village')}}";
  var dist_url = "{{url('/getdistrict/')}}";
  $(document).on("click", '.delete_btn', function(e) {
    document.getElementById("deleteform").action = base_url + "/" + $(this).data('id');
  });
  $(document).on("click", '.edit_btn', function(e) {
    $('[name="name"]').val($(this).data('name'));
    $('[name="name_en"]').val($(this).data('name_en'));
    $('[name="village_code"]').val($(this).data('village_code'));
    $('[name="description"]').val($(this).data('description'));
    $('[name="province_code"]').val($(this).data('province_code')).change();
    getProvinceCode($(this).data('province_code'), $(this).data('district_code'));
    $('[name="district_code"]').val($(this).data('district_code')).change();
    $('[name="status"]').val($(this).data('status'));
    $('#edit-id').val($(this).data('id'));
    document.getElementById("editform").action = base_url + "/" + $(this).data('id');
  });
  //change for edit province dropdown
  $('#edit-province').change(function() {
    var province_code = $(this).val();
    getProvinceCode(province_code);
  });

  function getProvinceCode(province_code, district_code) {
    $("#edit-district").empty();
    if (province_code > 0) {
        $.ajax({
            type: "GET",
            url: dist_url + "/" + province_code,
            success: function(data) {
                $("#edit-district").empty();
                if (data) {
                    $("#edit-district").append('<option value="" selected disabled hidden> Select</option>');
                    $.each(data.district, function(key, value) {
                        $("#edit-district").append('<option value="' + key + '">' + value + '</option>');
                    });
                    if (district_code > 0) {
                        $('[name="district_code"]').val(district_code);
                    }
                }
            }
        });
    }
  }
  // end change for province edit dropdown
  
  $('#add-form').click(function(e) {
    e.preventDefault();
    var code = $('#addModel1 .code');
    var name = $("#addModel1 .name");
    var name_en = $("#addModel1 .name_en");
    var province_code = $("#addModel1 .province_code");
    var district_code = $("#addModel1 .district_code");
    var desc = $("#addModel1 .desc");
    var oldId = $("#new-id").val();
    var form = $("#addform");
    insertVillage(code, name, name_en, desc, form, oldId, province_code, district_code);
  });

  $('#edit-form').click(function(e) {
    e.preventDefault();
    var code = $('#editModel .code');
    var name = $("#editModel .name");
    var name_en = $("#editModel .name_en");
    var province_code = $("#editModel .province_code");
    var district_code = $("#editModel .district_code");
    var desc = $("#editModel .desc");
    var oldId = $("#edit-id").val();
    var form = $("#editform");
    insertVillage(code, name, name_en, desc, form, oldId, province_code, district_code);
  });

  function insertVillage(code, name, name_en, desc, form, oldId = null, province_code, district_code) {
    var url = "/get-village?code=" + code.val() + "&id=" + oldId;
    $.get(url, function(response) {
      if (code.val().trim() == '') {
        alert($('.code').attr('title'));
        $('.code').focus();
        return false;
      } else if (name.val().trim() == '') {
        alert($('.name').attr('title'));
        $('.name').focus();
        return false;
      } else if (name_en.val().trim() == '') {
        alert($('.name_en').attr('title'));
        $('.name_en').focus();
        return false;
      } else if (province_code.val() == null) {
        alert($('.province_code').attr('title'));
        $('.province_code').focus();
        return false;
      }else if (district_code.val() == null) {
        alert($('.district_code').attr('title'));
        $('.district_code').focus();
        return false;
      } else if (desc.val().trim() == '') {
        alert($('.desc').attr('title'));
        $('.desc').focus();
        return false;
      } else if (response.data > 0) {
        alert('ຂໍ້ມູນນີ້ມີຢູ່ແລ້ວ');
        return false;
      } else {
        form.submit();
      }
    });
  }

  $('.modal').on('hidden.bs.modal', function() {
    $('.modal').find('form').trigger('reset');
    $('.js-example-basic-single').val(null).trigger('change');
  });
  
</script>
@endpush