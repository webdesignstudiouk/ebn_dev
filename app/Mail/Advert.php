<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Clients_Portfolio;
use App\Service;
use App\Client;
use App\Blog;
use App\Blog_Categories;
use App\Blog_Tags;
use App\Enquiries;

class Advert extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
		$blog = Blog::where('status','published')->get()->sortByDesc("id")->take(3);
		$portfolio = Clients_Portfolio::all()->sortBy("id")->take(3);
		return $this->view('email.advert')
			  ->with('blog', $blog)
			  ->with('portfolio', $portfolio);;
    }
}