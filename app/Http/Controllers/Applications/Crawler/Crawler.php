<?php

namespace App\Http\Controllers\Applications\Crawler;

use App\Http\Controllers\Controller;
use App\API\Companies_House;
use App\API\Google_Search;

use Illuminate\Support\Facades\Mail as Mailer;
use Illuminate\Support\Facades\Log;
use App\Mail\Advert;

class Crawler extends Controller{

	public $processed_info = array();

	public function run(){
		self::process_url("http://www.eon.com/en.html");
			
		dd($this->processed_info);
	}
	 
	public function process_url($url){
		$host = parse_url($url);

		$company_name = explode('.', $host['host']);
		$company_name = $company_name[1]; 

		$string = file_get_contents($url);
		$pattern = '@((https?://)?([-\\w]+\\.[-\\w\\.]+)+\\w(:\\d+)?(/([-\\w/_\\.]*(\\?\\S+)?)?)*)@';
		preg_match_all($pattern, $string, $matches);
		$count = 0;
		foreach($matches[0] as $match){
			if(self::isImage($match) == true){
				$images[] = $match;
			}elseif(self::isAsset($match) == true){
				$assets[] = $match;
			}elseif(self::is_internal_link($match, $url)){
				$internal_links[] = $match;
			}elseif(self::is_twitter_link($match)){
				$social_links['twitter'] = $match;
			}elseif(self::is_facebook_link($match)){
				$social_links['facebook'] = $match;
			}elseif(self::is_instagram_link($match)){
				$social_links['instagram'] = $match;
			}elseif(self::is_googlePlus_link($match)){
				$social_links['google_plus'] = $match;
			}elseif(!filter_var($match, FILTER_VALIDATE_URL) === FALSE) {
				$links[] = $match;
			}
			$count++;
		}
		
		$email_pattern = '/[a-z0-9_\-\+]+@[a-z0-9\-]+\.([a-z]{2,3})(?:\.[a-z]{2})?/i';
		preg_match_all($email_pattern, $string, $email_matches);
		$email_matches = array_unique($email_matches[0], SORT_REGULAR);
		if(isset($links)){
			$processed_links['external_links'] = array_unique($links, SORT_REGULAR);
		}
		if(isset($internal_links)){
			$processed_links['internal_links'] = array_unique($internal_links, SORT_REGULAR);
		}
		if(isset($social_links)){
			$processed_links['social_links'] = array_unique($social_links, SORT_REGULAR);
		}
		
		$this->processed_info[] = [
			'company_name'=>$company_name,
			'url'=>$url, 
			'company_details'=>self::get_company_house_info($company_name),
			'links'=>$processed_links, 
			'assets'=>$assets, 
			'images'=>$images, 
			'emails'=>$email_matches];
			
			foreach($email_matches as $email){
				Mailer::to($email)->queue(new Advert());
				Log::info("Sent email['advert'] to ".$email);
			}
	}
	
	public function get_company_house_info($company_name){
		$comapnies_house_api = new Companies_House();
		$response = $comapnies_house_api->search_by_name($company_name);
		return $response;
	}
	
	public function is_internal_link($match, $url){
		if(strpos($match, $url) !== false){
			return true;
		}else{
			return false;
		}
	}
	
	public function is_facebook_link($url){
		if(strpos($url, 'https://facebook.com') !== false){
			return true;
		}else{
			return false;
		}
	}
	
	public function is_twitter_link($url){
		if(strpos($url, 'https://twitter.com') !== false){
			return true;
		}else{
			return false;
		}
	}
	
	public function is_instagram_link($url){
		if(strpos($url, 'https://www.instagram.com') !== false){
			return true;
		}else{
			return false;
		}
	}
	
	public function is_googlePlus_link($url){
		if(strpos($url, 'https://plus.google.com/+') !== false){
			return true;
		}else{
			return false;
		}
	}
	
	public  function isImage($url){
		$ext = explode('.', $url);
		$ext = end($ext);
		switch ($ext) {
			case "jpg":
				return true;
			case "png":
				return true;
			case "gif":
				return true;
			case "svg":
				return true;
		}
	}
	
	public  function isAsset($url){
		if(strpos($url, 'https://fonts.googleapis.com/') !== false){
			return true;
		}else{
			$ext = explode('.', $url);
			$ext = end($ext);
			switch ($ext) {
				case "js":
					return true;
				case "css":
					return true;
				default:
					return false;
			}
		}
	}
	
	function url_exists($url) {
		if (!$fp = curl_init($url)) return false;
		return true;
	}
	
	public function fetch_google_results(){
		$query = 'SEO';
		$url = "http://ajax.googleapis.com/ajax/services/search/web?v=1.0&q=".$query;

		$body = file_get_contents($url);
		$json = json_decode($body);
		
		dd($json);

		for($x=0;$x<count($json->responseData->results);$x++){
			echo "<b>Result ".($x+1)."</b>";
			echo "<br>URL: ";
			echo $json->responseData->results[$x]->url;
			echo "<br>VisibleURL: ";
			echo $json->responseData->results[$x]->visibleUrl;
			echo "<br>Title: ";
			echo $json->responseData->results[$x]->title;
			echo "<br>Content: ";
			echo $json->responseData->results[$x]->content;
			echo "<br><br>";
		}
	}
	

}