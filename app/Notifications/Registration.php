<?php

namespace App\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Registration extends Notification
{
    use Queueable;

    protected $app_form = null;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($app_form)
    {
        $this->app_form = $app_form;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
       
        return (new \App\Mail\ApproveMail($this->user))
        ->to("nkhdemo.tgi20@gmail.com");
        
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'vehicle_id' => $this->app_form->vehicle_id          
         ];
    }
  
}
