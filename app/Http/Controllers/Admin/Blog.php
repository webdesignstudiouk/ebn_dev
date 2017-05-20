<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

use App\Notifications\BlogPostWasCreated;
use App\Notifications\BlogPostStatusChange;

use App\User;
use App\Blog as Blog_Model;
use App\Blog_Categories;
use App\Image;

class Blog extends Controller
{
	public function ajax_blog(){
		$blog = Blog_Model::all();
	    return response()->json([
	        'blog' => $blog
	    ]);
	}

	public function blog(){
		$blog = Blog_Model::all();
        return view('admin.Blog.blog')
			   ->with('blog', $blog);
    }

	public function blogPostForm(){
		$blog_categories = Blog_Categories::pluck('name', 'id')->toArray();
		$images = Image::pluck('id', 'id')->toArray();
        return view('admin.Blog.blogPost')
			   ->with('blog_categories', $blog_categories)   
			   ->with('images', $images);
    }

	public function blogPost(Request $request){
		//get request
		$title = $request->input('title');
		
		if($request->input('slug') == null){
			$slug = str_slug($title, '-');
		}else{
			$slug = $request->input('slug');
		}
		
		$categoryId = $request->input('category_id');
		$post = $request->input('post');
		$imageId = $request->input('image_id');
		
		if($request->input('status') == null){
			$status = 'hidden';
		}else{
			$status = $request->input('status');
		}
		
		//create blog post
		$blogPost = new Blog_Model;
		$blogPost->category_id = $categoryId;
		$blogPost->title = $title;
		$blogPost->slug = $slug;
		$blogPost->post = $post;
		$blogPost->image = $imageId;
		$blogPost->author = 'Admin';
		$blogPost->status = $status;
        $blogPost->save();
		
		Notification::send(User::all(), new BlogPostWasCreated($blogPost));
		
		return redirect('admin/blog');
	}

	public function updateBlogPostForm($id){
		$blogPost = new Blog_Model;
		$blogPost = $blogPost->find($id);
		$blog_categories = Blog_Categories::pluck('name', 'id')->toArray();
		$images = Image::pluck('id', 'id')->toArray();
		return view('admin.Blog.updateBlogPost')
			   ->with('blogPost', $blogPost)
			   ->with('blog_categories', $blog_categories)
			   ->with('images', $images);
	}

	public function updateBlogPost(Request $request){
		//get request
		$id = $request->input('id');
		$slug = $request->input('slug');
		$title = $request->input('title');
		$categoryId = $request->input('category_id');
		$post = $request->input('post');
		$imageId = $request->input('image_id');
		$status = $request->input('status');

		
		//updates blog post
		$blogPost = new Blog_Model;
		$blogPost = $blogPost->find($id);
		$oldStatus = $blogPost->status;
		
		$blogPost->category_id = $categoryId;
		$blogPost->title = $title;
		$blogPost->slug = $slug;
		$blogPost->post = $post;
		$blogPost->image = $imageId;
		$blogPost->status = $status;
		$blogPost->author = 'Admin';
        $blogPost->save();
		
		if($oldStatus != $status){
			Notification::send(User::all(), new BlogPostStatusChange($blogPost, $oldStatus));	
		}
		
		return redirect('admin/blog/'.$id);
	}

}
