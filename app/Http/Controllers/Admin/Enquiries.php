<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Enquiries as Enquiries_Model;
use App\Client;

class Enquiries extends Controller
{
	protected $enquiries;

	public function __construct(){
		$this->enquiries = new Enquiries_Model;
	}

	public function enquiries(){
		$enquiries = $this->enquiries->all();
		return view('admin.Enquiries.enquiries')
			   ->with('enquiries', $enquiries);
	}
	
	public function updateEnquiryForm($id){
		$enquiry = $this->enquiries->find($id);
		return view('admin.Enquiries.enquiry')
			   ->with('enquiry', $enquiry);
	}
	
	public function updateEnquiry(Request $request){
		//get request
		$id = $request->input('id');
		$status = $request->input('status');
		$convertToClient = $request->input('convertToClient');
	
		$enquiry = $this->enquiries->find($id);
			
		//updates enquiry
		if($convertToClient == "1" && $enquiry->client_id == "0"){
			$client = $this->convertToClient($id);
			$enquiry->client_id = $client->id;
		}
		
		$enquiry->status = $status;
        $enquiry->save(); 

		return redirect('admin/enquiries/'.$id);
	}
	
	public function convertToClient($id){
		$enquiry = $this->enquiries->find($id);
		//create client based off enquiry
		$client = new Client;
		$client->name = $enquiry->name;
		$client->slug = str_slug($enquiry->name, '-');
        $client->save();
		return $client;
	}
	

}
