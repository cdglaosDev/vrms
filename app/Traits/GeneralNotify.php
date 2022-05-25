<?php
namespace App\Traits;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;

trait GeneralNotify
{
    use Notifiable;

    public function notifyWithNotiUser($instance)
    {
        $user = \App\User::whereId(auth()->id())->first();
        if ($user) {
            $user->notify($instance);
        } else {
            $this->notify($instance);
        }      
    }

    public function notifyRender($notification)
    {
        $t = explode("\\",$notification->type);
        return view("component.notifications.".$t[count($t)-1], compact("notification"));
    }
}