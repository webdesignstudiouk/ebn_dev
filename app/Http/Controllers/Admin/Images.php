<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ImageManager;
use Storage;
use Illuminate\Support\Facades\File;

use App\Image ;
use App\Image_Sizes;

class Images extends Controller
{
	protected $images;
	protected $images_sizes;

	public function __construct(){
		$this->images = new Image;
		$this->images_sizes = new Image_Sizes;
	}

	public function images(){
		$images = $this->images->all();
		return view('admin.Images.images')
			   ->with('images', $images);
	}

	public function uploadImageForm(){
        return view('admin.Images.uploadImage');
    }
	
	public function updateImageForm($id){
		$image = $this->images->find($id);
		$image_sizes = $this->images_sizes->where('image_id', $id)->get()->toArray();
		
		if(Storage::disk('image-uploads')->exists('raw/'.$image->id.$image->format)){
		return view('admin.Images.image')
			   ->with('image', $image)
			   ->with('image_sizes', $image_sizes);
		}else{
			return redirect('admin/images');
		}
	}
	
	public function resize($size, $id){
		$image = $this->images->find($id);
		$file = public_path('images/image-uploads/raw/'.$image->id.$image->format);
		if($size=="compressed"){
			if(!Storage::disk('image-uploads')->exists('/compressed/'.$image->id.$image->format)){
				$img = ImageManager::make($file)
				->save(public_path('images/image-uploads/compressed/'.$image->id.$image->format), 70);
			}
		}else{
			$size = explode("x", $size);
			$width = $size[0];
			$height = $size[1];
			
			if(!Storage::disk('image-uploads')->exists('/'.$width.'x'.$height)){
				File::makeDirectory('images/image-uploads/'.$width.'x'.$height);
			}
				
			if(!Storage::disk('image-uploads')->exists('/'.$width.'x'.$height.'/'.$image->id.$image->format)){
				$img = ImageManager::make($file)
				->resize($height,$width)
				->save(public_path('images/image-uploads/'.$width."x".$height.'/'.$image->id.$image->format));
						
				$newSize = new Image_Sizes;
				$newSize->image_id = $image->id;
				$newSize->size = $width."x".$height;
				$newSize->save();
			}
		}
		
		return redirect('admin/images/'.$image->id);
	}

	public function deleteImage($id)
    {
		//delete database entries
		$image = $this->images->find($id);
		$imageSizes = $this->images_sizes->where('image_id', $id)->delete();
		$image->delete();

		//delete files
		$directories = Storage::directories('image-uploads');
		foreach($directories as $directory){
			Storage::delete($directory.'/'.$image->id.$image->format);
		}
		return redirect('admin/images');
    }

	public function uploadImage(Request $request)
    {
		$file = $request->file('file');
		$height = $request->input('height');
		$width = $request->input('width');
		$description = $request->input('description');
		$format = explode(".", $file->getClientOriginalName());

		//create image object
		$image = new Image;
		$image->format = '.'.$format[1];
		$image->description = $description;
        $image->save();
		
		//dd('images/image-uploads/raw/'.$image->id.$image->format);
		//upload image to raw directory
		$fileRaw = $request->file('file')->storeAs('images/image-uploads/raw/', $image->id.$image->format);

		//create 1920x1080 version
		if($height != "" || $width != ""){
			if (!file_exists($width."x".$height)) {
			    $result = File::makeDirectory('images/image-uploads/'.$width.'x'.$height);
			}else{
				echo "directory exists.";
			}
			$img = ImageManager::make($file->getRealPath())
				->resize($height,$width)
				->save(public_path('images/image-uploads/'.$width."x".$height.'/'.$image->id.$image->format));
			$size1920x1080 = new Image_Sizes;
			$size1920x1080->image_id = $image->id;
			$size1920x1080->size = $width."x".$height;
	        $size1920x1080->save();
		}else{
        	return redirect('admin/images');
		}
    }

	public function compress_all(){
		$images = $this->images->all();	
		
		foreach($images as $image){
			$file = public_path('images/image-uploads/raw/'.$image->id.$image->format);
			if(!Storage::disk('image-uploads')->exists('/compressed/'.$image->id.$image->format)){
				$img = ImageManager::make($file)
				->save(public_path('images/image-uploads/compressed/'.$image->id.$image->format), 70);
			}
		}
		return redirect('admin/images');
	}

}
