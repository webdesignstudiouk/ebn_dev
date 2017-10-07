<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Auth;

class Prospect_Delete extends Notification
{
    use Queueable;

	public $prospects;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
	public function __construct($prospects)
	{
		$this->prospects = $prospects;
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
			'deleted_prospects' => $this->prospects
		];
	}
}
