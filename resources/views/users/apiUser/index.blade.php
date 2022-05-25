@extends('vrms2.layouts.master')
@section('api_user', 'active')
@section('content')
@include('vrms2.mod1-submenu')
<h3>{{trans('user.api_user_list')}}
@can('ApiUser-Create')
<a class="btn btn-primary btn-save btn-sm" data-toggle="modal" data-target="#addModel" data-backdrop="static" data-keyboard="false"> {{trans('button.add_user')}}</a>
@endcan
</h3>
@include('flash')
<div class="card-body pt-1">
        <div class="table-responsive">
            <table id="myTable" class="table table-striped">
            <thead>
              <tr>
                <th class="text-nowrap">{{trans('user.name')}}</th>
                <th class="text-nowrap">{{trans('user.email')}}</th>
                <th class="text-nowrap">{{trans('user.phone')}}</th>
                <th xlass="text-nowrap">Access Token</th>
                <th>{{ trans('common.status')}}</th>
                <th  width="250">{{trans('customer.action')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($api_user as $key => $user)
                  <tr>
                     <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->api_token }}</td>
                    <td>{{ $user->status == 1? 'Active': 'Deactive'}}</td>
                <td>
                <a  class="show_btn"
                        data-toggle="modal" data-target="#showModel"
                        data-act="Edit"
                        data-first_name = "{{ $user->first_name}}"
                        data-last_name = "{{ $user->last_name}}"
                        data-user_mail = "{{ $user->email}}"
                        data-phone = "{{ $user->phone}}"
                        data-status = "{{ $user->status ==1?'Active':'Deactive' }}"
                        data-address = "{{ $user->user_info->address ??''}}"
                        data-id = "{{ $user->id }}"
                        data-backdrop="static" data-keyboard="false"><img src="{{ asset('images/view.png') }}" alt="" width="25" height="25px"  title="{{ trans('title.view') }}"></a>
                 
                  @can('ApiUser-Edit')
                  <a title="{{ trans('title.edit') }}" class="edit_btn"
                        data-toggle="modal" data-target="#editModel" data-backdrop="static" data-keyboard="false"
                        data-act="Edit" 
                        data-first_name = "{{ $user->first_name}}"
                        data-last_name = "{{ $user->last_name}}"
                        data-email = "{{ $user->email}}"
                        data-phone = "{{ $user->phone}}"
                        data-status = "{{ $user->status }}"
                        data-address = "{{ $user->user_info->address ??''}}"
                        data-id = "{{ $user->id }}"
                        ><img src="{{ asset('images/edit.png') }}" alt="" width="25" height="25px"></a>
                  @endcan
                  @can('ApiUser-Delete')
                  <a title="{{ trans('title.delete') }}" class="delete_btn p-0"
                                  data-toggle="modal" data-target="#deleteModel"
                                  data-act="Delete" data-backdrop="static" data-keyboard="false"
                                  data-id="{{$user->id}}"><img src="{{ asset('images/delete.png') }}" alt="" width="25" height="25px">
</a>
                  @endcan
                  </td>
                  </tr>
                   @endforeach
                  </tbody>
                  </table>
                  </div>   
</div>


@include('users.apiUser.editModal')
@include('delete')
@endsection
@push('page_scripts')
<script type="text/javascript">
    var base_url = "{{url('/api-user')}}";
   
    $(document).on("click", '.delete_btn', function (e) { 
            document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
        });
        $(document).on("click", '.edit_btn', function (e) {   
            $('[name="first_name"]').val($(this).data('first_name'));
            $('[name="last_name"]').val($(this).data('last_name'));
            $('[name="email"]').val($(this).data('email'));
            $('[name="phone"]').val($(this).data('phone'));
            $('[name="address"]').val($(this).data('address'));
            $('[name="status"]').val($(this).data('status')).attr('selected', 'selected');
            document.getElementById("editform").action = base_url+"/"+$(this).data('id');
        });
        $(document).on("click", '.show_btn', function (e) { 
            $('#first_name').text($(this).data('first_name'));
            $('#last_name').text($(this).data('last_name'));
            $('#user_mail').text($(this).data('user_mail'));
            $('#phone').text($(this).data('phone'));
            $('#address').text($(this).data('address'));
            $('#status').text($(this).data('status'));

            document.getElementById("editform").action = base_url+"/"+$(this).data('id');
        });
  
   </script>
@endpush