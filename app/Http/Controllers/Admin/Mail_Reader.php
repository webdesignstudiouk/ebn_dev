<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Support\Mail;

class Mail_Reader extends Controller
{
	protected $mail;
	protected $inbox;
	protected $message;

	public function __construct(){
		$host = 'mail.webdesignstudiouk.com';
		$user = 'admin@webdesignstudiouk.com';
		$pass = 'K1r4d4x31246969';
		$port = 143;
		$ssl = false;
		$folder = 'INBOX';
		$this->mail = new Mail($host, $user, $pass, $port, $ssl, $folder);
		$this->inbox = $this->mail->getMessageIds();
	}
	
	public function inbox(){
		return view('admin.Mail.inbox')
			   ->with('inbox', $this->inbox);
	}
	
	public function message($id){
		$this->message = $this->mail->getMessage($id);
		return view('admin.Mail.inbox')
			   ->with('inbox', $this->inbox)
			   ->with('message', $this->message);
	}


}
