<?php



namespace App\Notifications;



use Illuminate\Bus\Queueable;

use Illuminate\Notifications\Notification;

use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Notifications\Messages\MailMessage;



use Alfa6661\Firebase\FirebaseChannel;

use Alfa6661\Firebase\FirebaseMessage;

use Auth;
use App\User;



class EnquiryRecieved extends Notification

{

  use Queueable;

	  protected $enquiry;

  	public $devices;



    /**

     * Create a new notification instance.

     *

     * @return void

     */

    public function __construct($enquiry)

    {

        $this->enquiry = $enquiry;

        $this->devices = [User::find(1)->firebase_token];

    }



    /**

     * Get the notification's delivery channels.

     *

     * @param  mixed  $notifiable

     * @return array

     */

    public function via($notifiable)

    {

        return [FirebaseChannel::class];

    }


    public function toFirebase($notifiable)

    {

        return FirebaseMessage::create()

            ->title('New Enquiry')

            ->body('Someone has just submitted on the WDS Contact Form.')

            ->data(['id' => $notifiable->id]);

    }

}

