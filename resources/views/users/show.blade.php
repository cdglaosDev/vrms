<div class="modal-header">
    <h3>{{$user->user_type == 'staff'?'Staff Detail':'Customer Detail'}}</h3>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
</div>
<div class="modal-body">
  
    <div class="row">
        <div class="col-md-3 col-sm-3">
           @if($user->user_type == 'staff')
           <img @if($user->user_photo) src="{{asset('images/user/'.$user->user_photo)}}" @else src="{{asset('images/default.png')}}" @endif width="150px">
           @else
           <img @if($user->user_photo) src="{{asset('images/customer/'.$user->user_photo)}}" @else src="{{asset('images/default.png')}}" @endif width="150px">
           @endif
        </div>
        <div class="col-md-3 col-sm-3">
           <h5 class="media-heading">{{ $user->name }}</h5>
           <p>{{$user->login_id}}<br/>
              @if($user->email) {{ $user->email }}<br/> @else  @endif
              @if($user->facebook){{ $user->facebook?? '' }}<br/> @else @endif
              @if($user->whatapps) {{ $user->whatapps?? '' }}<br/> @else @endif
               {{$user->phone}}<br/>
              {{$user->position}}<br/>
              {{$user->user_info->province->name ?? ''}}
           </p>
           <p>@if(!empty($user->getRoleNames()))
              @foreach($user->getRoleNames() as $v)
              <label class="badge">{{ $v }}</label>
              @endforeach
              @endif
           </p>
           
        </div>
     </div>
</div>