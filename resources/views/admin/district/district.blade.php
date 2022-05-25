@extends('vrms2.layouts.master')
@section('district','active')
@section('content')

@include('vrms2.mod3-submenu')
<h3>
	{{trans('title.district')}}
	<a data-toggle="modal" data-target="#addModel1" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-save" style="color: #fff !important">{{trans('common.add_new')}}</a>
</h3>
@include('flash')
<div class="card-body">
	<table id="myTable" class="table table-striped" style="width:100%">
		<thead>
			<tr>
				<th>{{trans('table_man.dist_code')}}</th>
				<th>{{trans('table_man.dist_name')}}</th>
				<th>{{trans('table_man.dist_namee')}}</th> {{--
				<th>{{trans('common.desc')}}</th> --}}
				<th>{{trans('table_man.pro_name')}}</th>
				<th>{{trans('common.status')}}</th>
				<th>{{trans('common.action')}}</th>
			</tr>
		</thead>
		<tbody>
			@foreach($districts as $key=>$district)
			<tr>
				<td>{{$district->district_code}}</td>
				<td>{{$district->name}}</td>
				<td>{{$district->name_en}}</td> {{--
					<td>{!! Str::limit($district->desc,15)!!}</td> --}}
				<td>@if(isset($district->province->name))<span>{{$district->province['name']}}({{$district->province['name_en']}})</span>@else{{"_"}}@endif</td>
				<td>@if($district->status ==1)Active @else Deactive @endif</td>
				<td>
					<a href="#" class="edit_btn" 
					data-toggle="modal" 
					data-backdrop="static" 
					data-keyboard="false" 
					data-target="#editModel" 
					data-act="Edit" 
					data-district_code="{{$district->district_code}}" 
					data-name="{{$district->name}}" 
					data-name_en="{{$district->name_en}}" 
					data-desc="{{$district->desc}}" 
					data-province_code="{{$district->province_code}}" 
					data-status="{{$district->status}}" 
					data-id="{{$district->id}}">
					<img src="{{ asset('images/edit.png') }}" alt="" title="{{trans('button.edit')}}" width="25px" height="25px"></a>
					
					<a href="#" class="delete_btn" 
					data-toggle="modal" 
					data-target="#deleteModel" 
					data-backdrop="static" 
					data-keyboard="false" 
					data-act="Delete" 
					data-id="{{$district->id}}">
					<img src="{{ asset('images/delete.png') }}" alt="" title="{{trans('button.delete')}}" width="25px" height="25px">
					</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@component('component.admin.district',['province'=>$province]) @endcomponent
@include('delete')
@endsection
@push('page_scripts')
<script type="text/javascript">
	var base_url = "{{url('/admin/district/')}}";
	$(document).on("click", '.delete_btn', function(e) {
		document.getElementById("deleteform").action = base_url + "/" + $(this).data('id');
	});
	$(document).on("click", '.edit_btn', function(e) {
		$('[name="name"]').val($(this).data('name'));
		$('[name="name_en"]').val($(this).data('name_en'));
		$('[name="desc"]').val($(this).data('desc'));
		$('[name="province_code"]').val($(this).data('province_code')).change();
		$('[name="district_code"]').val($(this).data('district_code'));
		$('[name="status"]').val($(this).data('status'));
		$('#edit-id').val($(this).data('id'));
		document.getElementById("editform").action = base_url + "/" + $(this).data('id');
	});

	$('#add-form').click(function(e) {
		e.preventDefault();
		var province_code = $('#addModel1 .province_code');
		var district_name = $("#addModel1 .district_name");
		var district_name_en = $("#addModel1 .district_name_en");
		var district_code = $("#addModel1 .district_code");
		var desc = $("#addModel1 .desc");
		var oldId = $("#new-id").val();
		var form = $("#addform");
		insertDistrict(province_code, district_name, district_name_en, district_code, desc, form, oldId);
	});

	$('#edit-form').click(function(e) {
		e.preventDefault();
		var province_code = $('#editModel .province_code');
		var district_name = $("#editModel .district_name");
		var district_name_en = $("#editModel .district_name_en");
		var district_code = $("#editModel .district_code");
		var desc = $("#editModel .desc");
		var oldId = $("#edit-id").val();
		var form = $("#editform");
		insertDistrict(province_code, district_name, district_name_en, district_code, desc, form, oldId);
	});

	function insertDistrict(province_code, district_name, district_name_en, district_code, desc, form, oldId = null) {
		var url = "/get-district?district_code=" + district_code.val() + "&district_name=" + district_name.val() + "&id=" + oldId;
		$.get(url, function(response) {

			if (district_code.val().trim() == '') {
				alert($('.district_code').attr('title'));
				$('.district_code').focus();
				return false;
			} else if (district_name.val().trim() == '') {
				alert($('.district_name').attr('title'));
				$('.district_name').focus();
				return false;
			} else if (district_name_en.val().trim() == '') {
				alert($('.district_name_en').attr('title'));
				$('.district_name_en').focus();
				return false;
			} else if (province_code.val() == null) {
				alert($('.province_code').attr('title'));
				$('.province_code').focus();
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
		$(this).find('form').trigger('reset');
		$('.js-example-basic-single').val(null).trigger('change');
	});
</script>
@endpush