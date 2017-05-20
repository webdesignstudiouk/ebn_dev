<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BlogPostStatusChange extends Notification
{
    use Queueable;
	protected $blog;
	protected $oldStatus;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($blog, $oldStatus)
    {
        $this->blog = $blog;
		$this->oldStatus = $oldStatus;
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
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'blog_id' => $this->blog->id,
			'blog_old_status' => $this->oldStatus,
        	'blog_status' => $this->blog->status
        ];
    }
}