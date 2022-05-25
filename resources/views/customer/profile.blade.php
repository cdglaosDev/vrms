@extends('customer.layouts.master')
@section('dash','active')
@section('content') 
    <h3> {{trans('user.profile')}}</h3>
    <div class="card-body">
       @include('flash') 
       <div class="row pb-3">
         <div class="col-md-2 col-sm-2">
           <img @if($data->user_photo) src="{{asset('images/customer/'.$data->user_photo)}}" @else src="{{asset('images/default.png')}}" @endif width ="150px">
         </div>
         <div class="col-md-8 col-sm-8">
            <p>{{$data->login_id}}</p>
           <p>{{$data->name}}</p>
           <p>{{$data->email}}</p>
           <p>{{$data->phone}}</p>
           <p>{{$data->user_info->address}}</p>
           <p>{{$data->user_info->province_id !=""?$data->user_info->province->name:''}}</p>
           <p>{{$data->user_info->district_id !=""?$data->user_info->district->name:''}}</p>
           <br>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-left">
            <a href="{{url('customer')}}" class="btn btn-secondary btn-sm text-white">{{trans('Back')}}</a>
            <a data-url="{{route('editProfile')}}" class="btn btn-primary btn-sm btn_edit" data-target="#editModal" data-backdrop="static" data-keyboard="false"  data-toggle="modal">{{trans('button.edit')}}</a>
            <a href="{{ url('/customer/change-password') }}" class="btn btn-info btn-sm change-password text-white" data-target="#PasswordModal" data-backdrop="static" data-keyboard="false"  data-toggle="modal">{{trans('title.change_pass')}}</a>
           </div>
        </div>
    
    </div>
   
<!-- edit modal popup -->
<div class="modal fade" id="editModal" role="dialog">
   <div class="modal-dialog modal-xl">
      <!-- Modal content-->
      <div class="modal-content edit-modal">
      </div>
   </div>
</div>
<!-- end edit modal popup -->
@include('customer.change-password')
 @endsection 
 @push('page_scripts')
 <script src="{{ asset('vrms2/js/showModal.js')}}"></script>
 <script type="text/javascript" src="{{asset('vrms2/js/visible-password.js')}}"></script>
 @endpush
 
 
