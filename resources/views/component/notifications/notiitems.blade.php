@foreach(\Auth::user()->unreadNotifications->where( 'created_at', '>', \Carbon\Carbon::now()->subDays(15))->take(5) as $notification)
<a> 
   
        <div class="dropItemCon">
            <div class="navDropItem">
                <span class="markasread-handle markasread" data-id="{{$notification->id}}" style="cursor: pointer"></span>
                {!! $notification->notifiable->notifyRender($notification) !!}
            <hr/>
            </div>
        </div>
    </a>
@endforeach
@if(\Auth::user()->unreadNotifications()->count() > 5)
    {{-- <a>
        <div class="dropItemCon">
            <div class="navDropItem">
                more
            </div>
        </div>
    </a> --}}
@endif