<?php

namespace App\Http\Controllers\Core;

use Illuminate\Http\Request;
use App\Models\Prospects;
use App\Models\Contacts;
use Input;
use Auth;

class Search extends \App\Http\Controllers\Controller
{

	public function index(){
		return view('core.search');
	}

	public function search(Request $request){
		$search_type = Input::get('search_type');
		$query = Input::get('search_query');
		$prospects = new Prospects;
		$contacts = new Contacts;
		
		if($search_type == 1){
			$prospects = $prospects->with(array('user'=>function($query){
							$query->select('first_name','second_name');
						}))->where('company', 'like', '%'.$query.'%')->get();
			$contacts_fn = $contacts->where('first_name', 'like', '%'.$query.'%')->get();		
			$contacts_sn = $contacts->where('second_name', 'like', '%'.$query.'%')->get();
		}else{
			$prospects = $prospects->where('user_id', Auth::user()->id)->where('company', 'like', '%'.$query.'%')->get();
			$contacts_fn = $contacts->whereHas('prospect', function ($query) {
								$query->where('user_id', Auth::user()->id);
						})->where('first_name', 'like', '%'.$query.'%')->get();		
			$contacts_sn = $contacts->whereHas('prospect', function ($query) {
								$query->where('user_id', Auth::user()->id);
							})->where('second_name', 'like', '%'.$query.'%')->get();
		}
		
		if($contacts_fn->count() == 0){
			$contacts = $contacts_sn;
		}else{
			$contacts = $contacts_fn;
		}
		
		if($contacts->count() == 0 && $prospects->count() == 0){
			$errors = "No Results Found";
		}else{
			$errors = "";
		}

		return response()->json(array(
			'results_prospects'=> $prospects, 
			'prospects_count'=> $prospects->count(),
			'results_contacts'=> $contacts, 
			'contacts_count'=> $contacts->count(),
			'search_query'=> $query, 
			'search_type'=> $search_type, 
			'errors'=> $errors
		), 200);
	}

}
