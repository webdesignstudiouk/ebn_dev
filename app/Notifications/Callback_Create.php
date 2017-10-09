<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Auth;

class Callback_Create extends Notification
{
	use Queueable;

	public $callback;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct($callback)
	{
		$this->callback = $callback;
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
			'created_callback' => $this->callback
		];
	}
}
