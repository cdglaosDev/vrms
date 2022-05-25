@extends('vrms2.layouts.master')
@section('driving_school','active')
@section('content')

@include('vrms2.mod3-submenu')
    <h3>
        {{trans('title.driving')}}
        <a data-toggle="modal" data-target="#addModel" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-save" style="color: #fff !important">{{trans('common.add_new')}}</a>
    </h3>
@include('flash')
<div class="card-body">
    <table id="myTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>{{trans('common.name')}} (Lao)</th>
                <th>{{trans('common.name')}}(Eng)</th>
                <th>{{trans('user.phone')}}</th>
                <th>{{trans('table_man.pro_name')}}</th>
                <th>{{trans('table_man.dist_name')}}</th>
                <th>{{trans('table_man.vill_name')}}</th>
                <th>{{trans('common.action')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($drivingschool as $data)
            <tr>
                <td>{{$data->name}}</td>
                <td>{{$data->name_en}}</td>
                <td>{{$data->phone}}</td>
                <td>@if(isset($data->province->name))<span>{{$data->province['name']}}({{$data->province['name_en']}})</span>@else{{"_"}}@endif</td>
                <td>@if(isset($data->district->name))<span>{{$data->district['name']}}({{$data->district['name_en']}})</span>@else{{"_"}}@endif</td>
                <td>{{$data->village_code}}</td>
                <td class="">
                    <a href="#" class="edit_btn" 
                    data-toggle="modal" 
                    data-target="#editModel" 
                    data-backdrop="static" 
                    data-keyboard="false" 
                    data-act="Edit" 
                    data-name="{{$data->name}}" 
                    data-name_en="{{$data->name_en}}" 
                    data-address="{{$data->address}}" 
                    data-phone="{{$data->phone}}" 
                    data-email="{{$data->email}}" 
                    data-contact="{{$data->contact}}" 
                    data-province_code="{{$data->province_code}}" 
                    data-district_code="{{$data->district_code}}" 
                    data-village_code="{{$data->village_code}}" 
                    data-id="{{$data->id}}">
                    <img src="{{ asset('images/edit.png') }}" alt="" title="{{trans('button.edit')}}" width="25px" height="25px"></a>
                    
                    <a href="#" class="delete_btn" 
                    data-toggle="modal" 
                    data-target="#deleteModel" 
                    data-backdrop="static" 
                    data-keyboard="false" 
                    data-act="Delete" 
                    data-id="{{$data->id}}">
                    <img src="{{ asset('images/delete.png') }}" alt="" title="{{trans('button.delete')}}" width="25px" height="25px">
                    </a> 
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@component('component.admin.driving-school',['province'=>$province,'district'=>$district,'village'=>$village])
@endcomponent
@include('delete')
@endsection
@push('page_scripts')
<script type="text/javascript">
    var base_url = "{{url('/admin/driving-school')}}";
    $(document).on("click", '.delete_btn', function(e) {
        document.getElementById("deleteform").action = base_url + "/" + $(this).data('id');
    });

    $(document).on("click", '.edit_btn', function(e) {
        $('[name="name"]').val($(this).data('name'));
        $('[name="name_en"]').val($(this).data('name_en'));
        $('[name="address"]').val($(this).data('address'));
        $('[name="phone"]').val($(this).data('phone'));
        $('[name="email"]').val($(this).data('email'));
        $('[name="contact"]').val($(this).data('contact'));
        $('[name="village_code"]').val($(this).data('village_code'));
        $('[name="province_code"]').val($(this).data('province_code')).change();
        getProvinceCode($(this).data('province_code'), $(this).data('district_code'));
        document.getElementById("editform").action = base_url + "/" + $(this).data('id');
    });

    $('#province_code').change(function() {
        var province_code = $(this).val();
        getProvinceCode(province_code);
    });

    function getProvinceCode(province_code, district_code) {
        $("#district_code").empty();
        if (province_code > 0) {
            $.ajax({
                type: "GET",
                url: dist_url + "/" + province_code,
                success: function(data) {
                    $("#district_code").empty();
                    if (data) {
                        $("#district_code").append('<option value="" selected disabled hidden> Select</option>');
                        $.each(data.district, function(key, value) {
                            $("#district_code").append('<option value="' + key + '">' + value + '</option>');
                        });
                        if (district_code > 0) {
                            $('[name="district_code"]').val(district_code);
                        }
                    }
                }
            });
        }
    }
    $('#add-form').click(function(e) {
        e.preventDefault();
        var name = $('#addModel .name');
        var name_en = $("#addModel .name_en");
        var address = $("#addModel .address");
        var phone = $("#addModel .phone");
        var email = $("#addModel .email");
        var contact = $("#addModel .contact");
        var province = $("#addModel .province");
        var district = $("#addModel .district");
        var form = $("#addform");
        insertRecord(name, name_en, address, phone, email, contact, province, district, form);
    });

    $('#edit-form').click(function(e) {
        e.preventDefault();
        var name = $('#editModel .name');
        var name_en = $("#editModel .name_en");
        var address = $("#editModel .address");
        var phone = $("#editModel .phone");
        var email = $("#editModel .email");
        var contact = $("#editModel .contact");
        var province = $("#editModel .province");
        var district = $("#editModel .district");
        var form = $("#editform");
        insertRecord(name, name_en, address, phone, email, contact, province, district, form);
    });

    function insertRecord(name, name_en, address, phone, email, contact, province, district, form) {
        if (name.val().trim() == '') {
            alert($('.name').attr('title'));
            $('.name').focus();
            return false;
        } else if (name_en.val().trim() == '') {
            alert($('.name_en').attr('title'));
            $('.name_en').focus();
            return false;
        } else if (address.val().trim() == '') {
            alert($('.address').attr('title'));
            $('.address').focus();
            return false;
        } else if (phone.val().trim() == '') {
            alert($('.phone').attr('title'));
            $('.phone').focus();
            return false;
        } else if (email.val().trim() == '') {
            alert($('.email').attr('title'));
            $('.email').focus();
            return false;
        } else if (contact.val().trim() == '') {
            alert($('.contact').attr('title'));
            $('.contact').focus();
            return false;
        } else if (province.val() == null) {
            alert($('.province').attr('title'));
            $('.province').focus();
            return false;
        } else if (district.val() == null) {
            alert($('.district').attr('title'));
            $('.district').focus();
            return false;
        } else {
            form.submit();
        }
    }

    $('.modal').on('hidden.bs.modal', function() {
        $(this).find('form').trigger('reset');
        $('.js-example-basic-single').val(null).trigger('change');
    });
</script>
@endpush