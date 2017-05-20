<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Blog extends Model
{
    protected $guarded = [];
	protected $table = "blog";
	protected $metaTable = 'blog_meta';

	/**
	 * Get the tags assigned to this post
	 */
	public function tags(){
		return $this->belongsToMany('App\Blog_Tags', 'blog_tags_relations', 'blog_id', 'tag_id');
	}

	/**
	 * Get the category this post is assigned to
	 */
	public function category(){
		return $this->belongsTo('App\Blog_Categories'); 
	}
	
	public function image_details(){
		 return $this->hasOne('App\Image', 'id', 'image');
	}
	
	public static function getPinnedBlogPost(){
		$pinnedBlogPost = DB::table('blog_meta')
                     ->select(DB::raw('blog_id'))
                     ->where('key', '=', 'pinned')
                     ->get();
		return $pinnedBlogPost[0]->blog_id;
	}
}
