<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Service;

class Services extends Controller
{
	protected $services;

	public function __construct(){
		$this->services = new Service;
	}

	public function services(){
		$services = $this->services->all();
		return view('admin.Services.services')
			   ->with('services', $services);
	}

}
