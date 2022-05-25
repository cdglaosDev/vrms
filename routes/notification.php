<?php

use Carbon\carbon;

Route::get('notification/unreadtoread/{id}', function ($id){
    \Auth::user()->unreadNotifications()->whereId($id)->get()->markAsRead();

})->name('notifications.unread_to_read');

Route::get('notification/render',function(){
    return ["unreadcount"=>count(\Auth::user()->unreadNotifications->where( 'created_at', '>', Carbon::now()->subDays(15))),"html"=>view("component.notifications.notiitems")->render()];
})->name("notifications.render");