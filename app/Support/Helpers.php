<?php

if (! function_exists('render_image')) {
    function render_image($params = array())
    {
		$images = array();
		global $images;
		if(isset($params['size'])){
			$size = $params['size'];
		}else{
			$size = "raw";
		}

		$o = "<img ";
		if(isset($params['src'])){
			$o .= " src='{$params['src']}'";
			//stores images in global variable for seo
			$images[] = url('/'.$params['src']);
		}elseif(isset($params['id'])){
			$image = \App\Image::find($params['id']);
			$o .= " src='".asset('images/image-uploads/'.$size.'/'.$image->id.$image->format)."'";
			//stores images in global variable for seo
			$images[] = asset('images/image-uploads/'.$size.'/'.$image->id.$image->format);
			$o .= " alt='".$image->description."'";
		}elseif(isset($params['tmp_src'])){
			$o .= " src='".asset($params['tmp_src'])."'";
		}
		$o .= (isset($params['width']))     ? " width='{$params['width']}'"  	: " width='100%'";
		$o .= (isset($params['class']))     ? " class='{$params['class']}'"  	: "";
		$o .= '/>';
		echo $o;
	}
}

//Setup SEO
if (! function_exists('setupSEO')) {
	function setupSEO($params = array()){
		//title
		if(isset($params['title'])){
			$title = $params['title'];
		}else{
			$title = "";
		}

		//description
		if(isset($params['description'])){
			$description = $params['description'];
		}else{
			$description = "";
		}

		//images
		if(isset($params['images'])){
			$images = $params['images'];
		}else{
			$images = "";
		}

		SEO::setTitle($title)
		->setDescription($description)
		->twitter()->setSite('@wdsUK');
	}
}

//Setup SEO after images have been loaded to view
if (! function_exists('setupSEO_images')) {
	function setupSEO_images(){
		global $images;
		SEO::addImages($images);
	}
}
