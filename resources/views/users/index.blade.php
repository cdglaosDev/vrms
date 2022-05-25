@extends('vrms2.layouts.master')
@section('staff', 'active')
@section('content')
@include('vrms2.mod1-submenu')
@php
$users = \App\User::getUser();
$loginIds = $users->pluck('login_id');
$emails = $users->pluck('email');
@endphp
<link rel="stylesheet" href="{{ asset('vrms2/css/jquery.multiselect.css')}}">

<h3>
   {{trans('title.user_list')}}
   @can('Staff-Create')
   <a data-toggle="modal"  data-target="#addModel"  data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-save btn-sm" href="#"> {{trans('button.add_user')}}</a>
   @endcan
</h3>
@include('flash')
<div class="card-body">
   <table id="myTable" class="table table-striped" style="width:100%">
      <thead>
         <tr>
            <th>{{trans('user.name')}}</th>
            <th>{{trans('user.email')}}</th>
            <th>LoginId</th>
            <th>{{trans('user.role')}}</th>
            <th  width="400">{{trans('customer.action')}}</th>
         </tr>
      </thead>
      <tbody>
         @foreach ($data as $key => $user)
         <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->login_id }}</td>
            <td>
               @if(!empty($user->getRoleNames()))
               @foreach($user->getRoleNames() as $v)
               <label class="badge badge-info ">{{ $v }}</label>
               @endforeach
               @endif
            </td>
            <td>
               <a  class="show_btn" data-toggle="modal" data-target="#showModal" data-backdrop="static" data-keyboard="false" data-url="{{ url('users',['id'=>$user->id])}}" ><img src="{{ asset('images/view.png') }}" alt="" width="25" height="25px" title="{{ trans('title.view') }}"></a>
               @can('Staff-Edit')
               <a class="btn_edit" data-url="{{ route('users.edit',['id'=>$user->id])}}" data-toggle="modal"  data-target="#editModel" data-backdrop="static" data-keyboard="false"><img src="{{ asset('images/edit.png') }}" alt="" width="25" height="25px"  title="{{ trans('title.edit') }}"></a>
               @endcan
               <a title="Reset Password" href="" class="forgot-password text-white" data-toggle="modal"  data-target="#forgotModel"  data-backdrop="static" data-keyboard="false" data-id="{{ $user->id }}" ><img src="{{ asset('images/reset_password.png') }}" alt="" width="25" height="25px"></a>
              
               @can('Staff-Delete')
               <button type="button" style="background:none !important" class="delete_btn border-0 p-0"
                  data-toggle="modal" data-target="#deleteModel"
                  data-act="Delete" data-backdrop="static" data-keyboard="false"
                  data-id="{{$user->id}}"><img src="{{ asset('images/delete.png') }}" width="25" height="25px"  title="{{ trans('title.delete') }}">
               </button>
               @endcan
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>
</div>
<!-- show role modal popup -->
<div class="modal fade" id="editModel" role="dialog">
    <div class="modal-dialog modal-xl">
      <!-- Modal content-->
        <div class="modal-content edit-modal">
            
        </div>
    </div>
</div>
<!-- end show role modal popup -->
<!-- start forgot password modal popup -->
<div class="modal fade"  id="forgotModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog">
      <div class="modal-content">
      <form action="" method="POST" id="editform" name="editform"> 
        @method('POST') 
        @csrf 
         <div class="modal-body">
            <p>{{ trans('button.confirm_password') }}</p>  
            <input type="hidden" id="user-id">
         </div>
         <div class="modal-footer">
         <button type="submit" class="btn btn-success btn-sm btn-save">{{trans('button.yes')}}</button>
          <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.no')}}</button>
        </div>
      </form>      
      </div>
   </div>
</div>
<!-- end forgot password modal popup -->
@include('showModal')
@include('delete')
@include('users.addModal', $roles)
@endsection
@push('page_scripts')
<script src="{{ asset('vrms2/js/jquery.multiselect.js') }}"></script>
<script type="text/javascript">
   var base_url = "{{url('/users')}}";
   var image_url= "{{url('/images/user')}}";
   $(document).on("click", '.delete_btn', function (e) { 
           document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
   });

   $(".customer_status").change(function(){
         var s_url = "{{url('change-status')}}";
         var url =s_url + "/" + $(this).attr("job")+"/status/"+$(this).val();
         $(this).parent().attr("action",url);
         $(this).parent().submit();
   });
   var loginId = {!! $loginIds !!};
   var email = {!! $emails !!};

   $('.phone').keypress(function(event){
   if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
      event.preventDefault();
   }});

   //forgot password button
   $(document).on("click", '.forgot-password', function(e) {
    
     document.getElementById("editform").action = '/user/reset' + "/" + $(this).data('id');
   });
   $('#multipleRole').multiselect({
    columns: 1,
    placeholder: 'Select Roles',
    search: true
});
</script>

<script src="{{ asset('vrms2/js/match-password.js') }}"></script>
<script src="{{ asset('vrms2/js/showModal.js')}}"></script>
<script type="text/javascript" src="{{asset('vrms2/js/visible-password.js')}}"></script>
<script src="{{ asset('vrms2/js/numvalidate.js') }}"></script>

@endpush
