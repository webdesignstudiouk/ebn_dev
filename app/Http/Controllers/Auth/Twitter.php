<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use TwitterManager;

class Twitter extends Controller
{

	public static function getLatestTweets($limit)
	{
		$latestTweets = TwitterManager::getUserTimeline(['screen_name' => 'wdsUK', 'count' => $limit, 'format' => 'array']);
		return $latestTweets;
	}
}
