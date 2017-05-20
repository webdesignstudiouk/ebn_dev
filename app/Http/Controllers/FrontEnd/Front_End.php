<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;

use SEO;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Auth;

use App\Clients_Portfolio;
use App\Service;
use App\Client;
use App\Blog;
use App\Blog_Categories;
use App\Blog_Tags;
use App\Enquiries;
use App\User;

class Front_End extends Controller
{
	protected $portfolio;
	protected $services;
	protected $blog;
	protected $clients;
	protected $enquiries;

    //Show Home Page
    public function home()
    {
		setupSEO(array('title' => 'Home', 'description' => 'A north east based web design company, that aims to provide clean and efficent web design services.'));
		$blog = Blog::where('status','published')->get()->sortByDesc("id")->take(3);
		$portfolio = Clients_Portfolio::all()->sortBy("id")->take(3);
		return view('wds_front.home')
			   ->with('blog', $blog)
			   ->with('portfolio', $portfolio);
    }

    //Show About Us Page
    public function aboutUs()
    {
        setupSEO(array('title' => 'About Us', 'description' => 'Everything you need to know about the Chester Le Street based Web Design Studio UK.'));
		$this->client = new Client;
		$clients = $this->client->all()->take(3);
        return view('wds_front.aboutUs')
			   ->with('clients', $clients);
    }

    //Show About Us Page
    public function services()
    {
		setupSEO(array('title' => 'Services', 'description' => 'A list of all the services Web Design Studio UK offer to new and exisiting clients. All available at a reasonable price.'));
		$this->services = new Service;
		$services = $this->services->all();
        return view('wds_front.services')
			   ->with('services', $services);
    }

	//Show Portfolio Item Infomation
	public function service($slug)
	{
		$service = Service::where('slug', $slug)->first();

		if($service == null){
			return redirect('services');
		}
		if($service->status == "published"){
			setupSEO(array('title' => 'Service - '.$service->name, 'description' => 'Explaining what you get if you go with our '.$service->name.' service.'));
			return view('wds_front.service')
				   ->with('service', $service);
		}else{
			return redirect('services');
		}
	}

    //Show Portfolio Page
    public function portfolio()
    {
		setupSEO(array('title' => 'Portfolio', 'description' => 'A show page for all the work we have done for our clients at Web Design Studio UK.'));
		$this->portfolio = new Clients_Portfolio;
		$portfolio_websites = $this->portfolio->where('service_id', 1)->get();
		$portfolio_admin_panels = $this->portfolio->where('service_id', 5)->get();
        return view('wds_front.portfolio')
			   ->with('portfolio_websites', $portfolio_websites)
			   ->with('portfolio_admin_panels', $portfolio_admin_panels);
    }

	//Show Portfolio Item Infomation
	public function portfolioItem($slug)
	{
		$client = Client::where('slug', $slug)->first();
		$portfolioItem = $client->portfolio()->first();
		setupSEO(array('title' => 'Portfolio - '.$client->name, 'description' => 'This is the portfolio page for the work we have done for our client: '.$client->name.'.'));
		return view('wds_front.portfolioItem')
			   ->with('client', $client)
			   ->with('portfolioItem', $portfolioItem);
	}

	//Show Blog Page
    public function blog($category = null)
    {
		setupSEO(array('title' => 'Blog', 'description' => 'Web Design Studio UK\'s own blog, talking about the latest in our company, in web design and technology across the UK.'));

		$category = Blog_Categories::where('slug',$category)->get()->first();

		if($category != null){
			if($category->id == null){
				$blog = Blog::where('status','published')->get()->sortByDesc('id');
			}else{
				$blog = Blog::where('category_id', $category->id)->get();
			}
		}else{
			$blog = Blog::where('status','published')->get()->sortByDesc('id');
		}

		$categories = Blog_Categories::all();
		$tags = Blog_Tags::all();
        return view('wds_front.blog')
			   ->with('blog', $blog)
			   ->with('categories', $categories)
			   ->with('tags', $tags);
    }

	//Show Blog Post
    public function blogPost($category, $slug)
    {
		$blogPost = Blog::where('slug', $slug)->first();
		if($blogPost == null){
			return redirect('blog');
		}

		if($blogPost->status == "published"){
			$categories = Blog_Categories::all();
			$tags = Blog_Tags::all();
			setupSEO(array('title' => $blogPost->title, 'description' => 'Web Design Studio UK\'s blog post talking about '.$blogPost->title.'.'));
			return view('wds_front.blogPost')
				   ->with('blogPost', $blogPost)
				   ->with('categories', $categories)
				   ->with('tags', $tags);
		}else{
			return redirect('blog');
		}
    }

    //Show Contact Us Page
    public function contactUsForm()
    {
		setupSEO(array('title' => 'Contact Us', 'description' => 'Web Design Studio UK\'s contact page, making it easier for you to ask queastions and view our contact details.'));
        return view('wds_front.contactUs');
    }

	//Contact Us Submit
    public function contactUs(Request $request)
    {
		$name = $request->input('name');
		$phone_number = $request->input('phone-number');
		$email = $request->input('email');
		$message = $request->input('message');

		$enquiry = new Enquiries;
		$enquiry->name = $name;
		$enquiry->phone_number = $phone_number;
		$enquiry->email = $email;
		$enquiry->message = $message;
		$enquiry->type = "contact-us";
		$enquiry->save();

		User::find(1)->notify(new \App\Notifications\EnquiryRecieved($enquiry));

		return view('wds_front.thankyou');
    }

	//Show About Us Page
    public function newsletter(Request $request)
    {
		$email = $request->input('email');
		$enquiry = new Enquiries;
		$enquiry->email = $email;
		$enquiry->type = "newsletter";
		$enquiry->save();

		return view('wds_front.thankyou');
    }

	//Show Social Login Page
    public function socialLogin()
    {
        $this->setupSEO("Social Login");
        return view('wds_front.socialLogin');
    }
}
