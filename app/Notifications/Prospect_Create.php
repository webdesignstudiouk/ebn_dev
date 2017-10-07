<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Auth;

class Prospect_Create extends Notification
{
    use Queueable;

	public $prospect;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($prospect)
    {
	    $this->prospect = $prospect;
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

    public function toArray($notifiable)
    {
	    return [
		    'user' => Auth::user()->id,
		    'created_prospect' => $this->prospect
	    ];
    }
}
