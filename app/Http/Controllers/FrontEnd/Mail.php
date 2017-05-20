<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail as Mailer;
use Illuminate\Support\Facades\Log;

use SEO;
use Image;

use App\Mail\Advert;
use App\Clients_Portfolio;
use App\Blog;

class Mail extends Controller
{

    //Show Advert Mail Page
    public function advert() {
  		$blog = Blog::where('status','published')->get()->sortByDesc("id")->take(3);
  		$portfolio = Clients_Portfolio::all()->sortBy("id")->take(3);
  		return view('email.advert')
  			   ->with('blog', $blog)
  			   ->with('portfolio', $portfolio);
    }

    public function bug() {
      $blog = Blog::where('status','published')->get()->sortByDesc("id")->take(3);
      $portfolio = Clients_Portfolio::all()->sortBy("id")->take(3);
      return view('email.bugUpdate')
           ->with('blog', $blog)
           ->with('portfolio', $portfolio);
   }

	public function sendAdvert($email){
		Mailer::to($email)->queue(new Advert());
		Log::info("Sent email['advert'] to ".$email);
	}


}
