<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\GasMeters as EBNGasMeters;
use App\Models\Sites;
use App\Models\Prospects;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Models\User;

class gasMeters extends Controller
{
	protected $prospects;
	protected $sites;
	protected $gasMeters;

	public function __construct()
	{
		$this->prospects = new Prospects;
		$this->sites = new Sites;
		$this->gasMeters = new EBNGasMeters;
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
		$site = $this->sites->find($request->site_id);
		$prospect = $this->prospects->find($site->prospect_id);

		$gasMeter = new EBNGasMeters;
		$gasMeter->author_id = Auth::user()->id;
		$gasMeter->site_id = $request->site_id;
		$gasMeter->mprn = $request->mprn;
		$gasMeter->eac = $request->eac;
		$gasMeter->contractEndDate = $request->contractEndDate;
		$gasMeter->terminationDate = $request->terminationDate;
		$gasMeter->currentUnitRate = $request->currentUnitRate;
		$gasMeter->current8c = $request->current8c;
		$gasMeter->save();

		return redirect()->route('gasMeters.edit', ['id' => $prospect->id, 'site' => $site->id, 'meter' => $gasMeter->id]);
	}

	/**
	* Display the specified resource.
	*
	* @param  \App\Users  $users
	* @return \Illuminate\Http\Response
	*/
	public function show($prospect, $site, FormBuilder $formBuilder)
	{

	}

	/**
	* Show the form for editing the specified resource.
	*
	* @param  \App\Users  $users
	* @return \Illuminate\Http\Response
	*/
	public function edit($prospect, $site, $gasMeter, FormBuilder $formBuilder)
	{
		$gasMeter = $this->gasMeters->find($gasMeter);
		$site = $gasMeter->site;
		$prospect = $site->prospect;

		$updateGasMeterForm = $formBuilder->create(\App\Forms\Sites\UpdateGasMeter::class, [
			'method' => 'POST',
			'url' => route('gasMeters.update', ['id' => $prospect->id, 'siteId' => $site->id, 'meterId' => $gasMeter->id]),
			'model' => $gasMeter
		]);

		return view('prospects.prospect.site.meters.gasMeter_edit')
		->with('gasMeter', $gasMeter)
		->with('site', $site)
		->with('prospect', $prospect)
		->with('updateGasMeterForm', $updateGasMeterForm);
	}

	public function delete($prospect, $site, $gasMeter, FormBuilder $formBuilder)
	{
		$gasMeter = $this->gasMeters->find($gasMeter);
		$site = $gasMeter->site;
		$prospect = $site->prospect;
		$deleteGasForm = $formBuilder->create(\App\Forms\Sites\DeleteGasMeter::class, [
			'method' => 'POST',
			'url' => route('gasMeters.destroy', ['id' => $prospect->id, 'siteId' => $site->id, 'meterId' => $gasMeter->id]),
			'model' => $prospect
		]);

		return view('prospects.prospect.site.meters.gasMeter_delete')
		->with('gasMeter', $gasMeter)
		->with('site', $site)
		->with('prospect', $prospect)
		->with('deleteGasForm', $deleteGasForm);
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
		$gasMeter = $this->gasMeters->find($request->id);
		$gasMeter->mprn = $request->mprn;
		$gasMeter->eac = $request->eac;
		$gasMeter->contractEndDate = $request->contractEndDate;
		$gasMeter->terminationDate = $request->terminationDate;
		$gasMeter->currentUnitRate = $request->currentUnitRate;
		$gasMeter->current8c = $request->current8c;
		$gasMeter->save();

		flash('Gas Meter Updated', 'success');

		return back();
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param  \App\User  $user
	* @return \Illuminate\Http\Response
	*/
	public function destroy($prospect, $site, $meter)
	{

		$meter = $this->gasMeters->find($meter);
		$meter->delete();

		flash('Gas Meter Has Been Deleted', 'warning');

		return redirect()->route('sites.edit', ['id'=>$prospect, 'site_id'=> $site]);
	}
}
