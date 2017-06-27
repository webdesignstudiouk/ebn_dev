<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Auth;
use App\User;
use App\Client;
use App\Clients_Portfolio;
use App\Service;
use App\Clients_Project_Bugs;
use App\Clients_Project_Bugs_Updates;

class BugUpdate extends Mailable
{
    use Queueable, SerializesModels;

    protected $bugId;
    protected $description;

    public function __construct($bugId, $description){
      $this->bugId = $bugId;
      $this->description = $description;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
      $bug = Clients_Project_Bugs::find($this->bugId);
		    return $this->view('email.bugUpdate')
			  ->with('bug', $bug)
        ->with('description', $this->description);
    }
}
