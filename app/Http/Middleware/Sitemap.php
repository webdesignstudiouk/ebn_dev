<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Sitemap
{
	public function handle($request, Closure $next){

		dd("test");
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

		\Cache::put('sitemap', $sitemap, 2880);
		return $next($request);
	}
}
