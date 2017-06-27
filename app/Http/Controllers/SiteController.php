<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class SiteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function test()
    {
			$api = new \App\API\Companies_House;
			return $api->search_by_name("digital allies");
    }

    public function sitemap()
    {
		//Create new sitemap object
		$sitemap = \App::make("sitemap");

		//Static routes
		$sitemap->add(\URL::to('/'), '2016-12-13T00:00:00+00:00', '1.0', 'monthly');
		$sitemap->add(\URL::to('/home'), '2016-12-13T00:00:00+00:00', '1.0', 'monthly');
		$sitemap->add(\URL::to('/about-us'), '2016-12-13T00:00:00+00:00', '1.0', 'monthly');
		$sitemap->add(\URL::to('/services'), '2016-12-13T00:00:00+00:00', '1.0', 'monthly');
		$sitemap->add(\URL::to('/portfolio'), '2016-12-13T00:00:00+00:00', '1.0', 'monthly');
		$sitemap->add(\URL::to('/contact-us'), '2016-12-13T00:00:00+00:00', '1.0', 'monthly');

		foreach(\App\Blog::all() as $blogPost){
			$sitemap->add(\URL::to('/blog/'.$blogPost->slug), '2016-12-13T00:00:00+00:00', '1.0', 'weekly');
		}

		//Render sitemap
		$content = \View::make('wds_front.sitemap')->with('sitemap', $sitemap);
		return \Response::make($content, '200')->withHeaders([
                'Content-Type' => 'txt'
            ]);
    }
}
