<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Prospects;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use App\Models\User;
use Carbon\Carbon;
use Input;
use Charts;
use DB;

class CED extends Controller
{
	use FormBuilderTrait;

	protected $prospects;

	public function __construct()
	{
		$this->prospects = new Prospects;
	}

	public function timeline(Request $request)
	{
		if($request->input('beginDate') != null){
			$beginDate = Carbon::createFromFormat('d/m/Y', $request->input('beginDate'))->toDateString();
		}else{
			$beginDate = Carbon::now()->toDateString();
		}

		if($request->input('endDate') != null){
			$endDate = Carbon::createFromFormat('d/m/Y', $request->input('endDate'))->toDateString();
		}else{
			$endDate = Carbon::now()->addWeeks(12)->toDateString();
		}

		$prospectModal = new Prospects;
		$prospects = $this->prospects->all();
		return view('ceds.timeline')
		->with('beginDate', $beginDate)
		->with('endDate', $endDate)
		->with('prospects', $prospects)
		->with('prospectModal', $prospectModal);
	}
	
	public function timeline_admin(Request $request)
	{
		if($request->input('beginDate') != null){
			$beginDate = Carbon::createFromFormat('d/m/Y', $request->input('beginDate'))->toDateString();
		}else{
			$beginDate = Carbon::now()->toDateString();
		} 

		if($request->input('endDate') != null){
			$endDate = Carbon::createFromFormat('d/m/Y', $request->input('endDate'))->toDateString();
		}else{
			$endDate = Carbon::now()->addWeeks(12)->toDateString();
		}    

		$prospectModal = new Prospects;
		$prospects = $this->prospects->all();
		return view('ceds.timeline-admin')
		->with('beginDate', $beginDate)
		->with('endDate', $endDate)
		->with('prospects', $prospects)
		->with('prospectModal', $prospectModal);
	}
}
