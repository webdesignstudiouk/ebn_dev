<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Client;

class Clients extends Controller
{
	protected $clients;

	public function __construct(){
		$this->clients = new Client;
	}

	public function clients($type = "clients"){
		if($type == "all"){
			$clients = $this->clients->where('status', '!=', '100')->get();
		}elseif($type == "clients"){
			$clients = $this->clients->where('status', '2')->get();
		}elseif($type == "prospects"){
			$clients = $this->clients->where('status', '1')->get();
		}elseif($type == "archive"){
			$clients = $this->clients->where('status', '0')->get();
		}else{
			$clients = $this->clients->all();
		}
		
		return view('admin.Clients.clients')
			   ->with('clients', $clients)
			   ->with('type', $type);
	}
	
	public function client($id){
		$client = $this->clients->find($id);
		 
		$clientMetaKeys = array_keys($client->getMeta()->toArray());
		$clientMetaValues = array_values($client->getMeta()->toArray());
		$clientDetails = array();
		
		foreach($clientMetaKeys as $key){
			$clientDetails['keys'] = $clientMetaKeys;
			$clientDetails['values'] = $clientMetaValues;
		}
	
		return view('admin.Clients.client')
			   ->with('client', $client)
			   ->with('clientDetails', $clientDetails);
	}
	
	public function updateClient(Request $request){
		$id = $request->input('id');
		$name = $request->input('name');
		$slug = $request->input('slug');
		$client = $this->clients->find($id);
		
		$count = 0;
		$clientMetaKeys = array_keys($client->getMeta()->toArray());
		$clientMetaValues = array_values($client->getMeta()->toArray());
		foreach($clientMetaKeys as $key){
			$$key = $request->input($key);
			$count++;
		}
	
		$client->name = $name;
		$client->slug = $slug;
		
		$count = 0;
		foreach($clientMetaKeys as $key){
			$client->setMeta($key, $$key);
			$count++;
		}
		
		$client->save();
	
		return redirect('admin/clients/'.$id);
	}
	
	public function addMeta(Request $request){
		$id = $request->input('id');
		$key = $request->input('key');
		$value = $request->input('value');
		if($key != ""){
			$client = $this->clients->find($id);
			$client->setMeta($key, $value);
			$client->save();
		}
		return redirect('admin/clients/'.$id);
	}
	
	public function deleteMeta($id, $meta){
		$client = $this->clients->find($id);
		unset($client->$meta);
		$client->save();
		return redirect('admin/clients/'.$id);
	}
	
	public function portfolioList($id){
		$client = $this->clients->find($id);
		$portfolio = $client->portfolio;
		return view('admin.Clients.client_portfolio')
			   ->with('client', $client)
			   ->with('portfolio', $portfolio);
	}
}
