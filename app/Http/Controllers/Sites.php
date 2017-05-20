<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Sites as EBNSites;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Models\User;

class Sites extends Controller
{
	protected $sites;

	public function __construct()
	{
		$this->sites = new EBNSites;
	}

	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{

	}

	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create(FormBuilder $formBuilder)
	{

	}

	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(FormBuilder $formBuilder, Request $request)
	{
		$site = new EBNSites;
		$site->author_id = Auth::user()->id;
		$site->prospect_id = $request->prospect_id;
		$site->name = $request->name;
		$site->street_1 = $request->street_1;
		$site->street_2 = $request->street_2;
		$site->street_3 = $request->street_3;
		$site->street_4 = $request->street_4;
		$site->town = $request->town;
		$site->county = $request->county;
		$site->post_code = $request->post_code;
		$site->save();

		return back()->withInput(['tab'=>'sites']);
	}

	/**
	* Display the specified resource.
	*
	* @param  \App\Users  $users
	* @return \Illuminate\Http\Response
	*/
	public function show($prospect, $site, FormBuilder $formBuilder)
	{
		$sites = $this->sites->find($site);
		dd($site);

		//return view('users.user', compact('form'))->with('user', $user);
	}

	/**
	* Show the form for editing the specified resource.
	*
	* @param  \App\Users  $users
	* @return \Illuminate\Http\Response
	*/
	public function edit($prospect, $site, FormBuilder $formBuilder)
	{
		$site = $this->sites->find($site);
		$prospect = $site->prospect;

		$updateForm = $formBuilder->create(\App\Forms\Sites\UpdateSite::class, [
			'method' => 'POST',
			'url' => url('admin/prospects/'.$prospect->id.'/sites/'.$site->id),
			'model' => $site
		]);

		return view('prospects.prospect.site.edit')
		->with('site', $site)
		->with('prospect', $prospect)
		->with('updateForm', $updateForm);
	}

	public function electricMeters($prospect, $site, FormBuilder $formBuilder)
	{
		$site = $this->sites->find($site);
		$prospect = $site->prospect;

		$createElectricMeter = $formBuilder->create(\App\Forms\Sites\CreateElectricMeter::class, [
			'method' => 'POST',
			'url' => route('electricMeters.store', ['id' => $prospect->id, 'siteId' => $site->id]),
			'model' => $site
		]);

		return view('prospects.prospect.site.electricMeters')
		->with('site', $site)
		->with('prospect', $prospect)
		->with('createElectricMeter', $createElectricMeter);
	}

	public function gasMeters($prospect, $site, FormBuilder $formBuilder)
	{
		$site = $this->sites->find($site);
		$prospect = $site->prospect;

		$createGasMeter = $formBuilder->create(\App\Forms\Sites\CreateGasMeter::class, [
			'method' => 'POST',
			'url' => route('gasMeters.store', ['id' => $prospect->id, 'siteId' => $site->id]),
			'model' => $site
		]);

		return view('prospects.prospect.site.gasMeters')
		->with('site', $site)
		->with('prospect', $prospect)
		->with('createGasMeter', $createGasMeter);
	}

	public function delete($prospect, $site, FormBuilder $formBuilder)
	{
		$site = $this->sites->find($site);
		$prospect = $site->prospect;

		$deleteSiteForm = $formBuilder->create(\App\Forms\Sites\DeleteSite::class, [
			'method' => 'POST',
			'url' => route('sites.destroy', ['id' => $prospect->id, 'siteId' => $site->id]),
			'model' => $prospect
		]);

		return view('prospects.prospect.site.delete')
		->with('site', $site)
		->with('prospect', $prospect)
		->with('deleteSiteForm', $deleteSiteForm);
	}

	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  \App\Users  $user
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request)
	{
		$site = $this->sites->find($request->id);
		$site->name = $request->name;
		$site->street_1 = $request->street_1;
		$site->street_2 = $request->street_2;
		$site->street_3 = $request->street_3;
		$site->street_4 = $request->street_4;
		$site->county = $request->county;
		$site->town = $request->town;
		$site->post_code = $request->post_code;
		$site->save();

		flash('Site Updated', 'success');

		return back();
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param  \App\User  $user
	* @return \Illuminate\Http\Response
	*/
	public function destroy($prospect, $site)
	{
		$site = $this->sites->find($site);
		$site->delete();

		flash('Site Has Been Deleted', 'warning');

		return redirect()->route('prospects.edit', ['id'=>$prospect]);
	}
}
