<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ImageManager;
use Storage;
use Illuminate\Support\Facades\File;

class Image_Convertor extends Controller
{
	protected $portfolio;

    //Show Home Page
    public function image_convertor()
    {
		setupSEO(array('title' => 'Image Convertor', 'description' => 'A image convertor, to help convert, resize and add effects to images uploaded from your computer.'));
		
        return view('wds_front.image_convertor.image_convertor');
    }
	
	//Show Home Page
    public function upload_image(Request $request)
    {
		//get request
		$file = $request->file('file_upload');
		
		$fileRaw = $request->file('file_upload')->storeAs('images/tmp', $file->getClientOriginalName());
		
		session(['file_path' => 'images/tmp/'.$file->getClientOriginalName()]);
		session(['file_name' =>  $file->getClientOriginalName()]);
		session(['file_format' =>   explode(".", $file->getClientOriginalName())[1]]);
		
		return redirect('applications/image-editor/edit-image');
    }
	
	public function edit_image_form(){
		$file_path = session('file_path');
		if(isset($file_path)){
			return view('wds_front.image_convertor.edit_image')
				   ->with('image', $file_path);
		}else{
			return redirect('applications/image-editor');
		}
	}
	  
	public function edit_image(Request $request)
    {
		$file_path =  session('file_path');
		$file_format =  session('file_format');
		$file_name =  str_random(60).'.'.$file_format;

		$image_quality = $request->input('image_quality');
		$greyscale = $request->input('greyscale');
		$image_brightness = $request->input('image_brightness');
		$image_sharpness = $request->input('image_sharpness');
		$invert_colours = $request->input('invert_colours');
	
		//compress image
		$img = ImageManager::make(public_path($file_path));
		
		if($image_brightness != "0"){
			$img->brightness($image_brightness);
		}
		
		if($image_sharpness != "0"){
			$img->sharpen($image_sharpness);
		}
		
		if($greyscale == "yes"){
			$img->greyscale();
		}
		
		if($invert_colours  == "yes" ){
			$img->invert();
		}
		
		if($image_quality != "100"){
			$img->save(public_path('images/tmp_processed/'.$file_name), $image_quality);
		}else{
			$img->save(public_path('images/tmp_processed/'.$file_name));
		}
		
		session(['file_path' => 'images/tmp_processed/'.$file_name]); 
		return redirect('applications/image-editor/edit-image');
    }
	
	public function download_image(){
		$pathToFile =  session('file_path');
		return response()->download(public_path($pathToFile));
	}
	
}
