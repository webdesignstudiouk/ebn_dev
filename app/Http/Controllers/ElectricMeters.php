<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\ElectricMeters as EBNElectricMeters;
use App\Models\Sites;
use App\Models\Prospects;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Models\User;

class ElectricMeters extends Controller
{
	protected $prospects;
	protected $sites;
	protected $electricMeters;

	public function __construct()
	{
		$this->prospects = new Prospects;
		$this->sites = new Sites;
		$this->electricMeters = new EBNElectricMeters;
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

		$electricMeter = new EBNElectricMeters;
		$electricMeter->author_id = Auth::user()->id;
		$electricMeter->site_id = $request->site_id;
		$electricMeter->mpan_1 = $request->mpan_1;
		$electricMeter->mpan_2 = $request->mpan_2;
		$electricMeter->mpan_3 = $request->mpan_3;
		$electricMeter->mpan_4 = $request->mpan_4;
		$electricMeter->mpan_5 = $request->mpan_5;
		$electricMeter->mpan_6 = $request->mpan_6;
		$electricMeter->mpan_7 = $request->mpan_7;
		$electricMeter->eac = $request->eac;
		$electricMeter->eac_day = $request->eac_day;
		$electricMeter->eac_night = $request->eac_night;
		$electricMeter->eac_ew = $request->eac_ew;
		$electricMeter->contractEndDate = $request->contractEndDate;
		$electricMeter->terminationDate = $request->terminationDate;
		$electricMeter->auRate = $request->auRate;
		$electricMeter->dayRate = $request->dayRate;
		$electricMeter->nightRate = $request->nightRate;
		$electricMeter->ewRate = $request->ewRate;
		$electricMeter->fit = $request->fit;
		$electricMeter->standingCharge = $request->standingCharge;
		$electricMeter->standingChargePer = $request->standingChargePer;
		$electricMeter->kv_allowance = $request->kv_allowance;
		$electricMeter->kva_rate = $request->kva_rate;

		$electricMeter->save();

		return redirect()->route('electricMeters.edit', ['id' => $prospect->id, 'site' => $site->id, 'meter' => $electricMeter->id]);
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
	public function edit($prospect, $site, $electricMeter, FormBuilder $formBuilder)
	{
		$electricMeter = $this->electricMeters->find($electricMeter);
		$site = $electricMeter->site;
		$prospect = $site->prospect;

		$updateElectricMeterForm = $formBuilder->create(\App\Forms\Sites\UpdateElectricMeter::class, [
			'method' => 'POST',
			'url' => route('electricMeters.update', ['id' => $prospect->id, 'siteId' => $site->id, 'meterId' => $electricMeter->id]),
			'model' => $electricMeter
		]);

		return view('prospects.prospect.site.meters.electricMeter_edit')
		->with('electricMeter', $electricMeter)
		->with('site', $site)
		->with('prospect', $prospect)
		->with('updateElectricMeterForm', $updateElectricMeterForm);
	}

	public function delete($prospect, $site, $electricMeter, FormBuilder $formBuilder)
	{
		$electricMeter = $this->electricMeters->find($electricMeter);
		$site = $this->sites->find($electricMeter->site_id);
		$prospect = $site->prospect;

		$deleteElectricForm = $formBuilder->create(\App\Forms\Sites\DeleteElectricMeter::class, [
			'method' => 'POST',
			'url' => route('electricMeters.destroy', ['id' => $prospect->id, 'siteId' => $site->id, 'meterId' => $electricMeter->id]),
			'model' => $prospect
		]);

		return view('prospects.prospect.site.meters.electricMeter_delete')
		->with('electricMeter', $electricMeter)
		->with('site', $site)
		->with('prospect', $prospect)
		->with('deleteElectricForm', $deleteElectricForm);
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
		$electricMeter = $this->electricMeters->find($request->id);
		$electricMeter->mpan_1 = $request->mpan_1;
		$electricMeter->mpan_2 = $request->mpan_2;
		$electricMeter->mpan_3 = $request->mpan_3;
		$electricMeter->mpan_4 = $request->mpan_4;
		$electricMeter->mpan_5 = $request->mpan_5;
		$electricMeter->mpan_6 = $request->mpan_6;
		$electricMeter->mpan_7 = $request->mpan_7;
		$electricMeter->eac = $request->eac;
		$electricMeter->eac_day = $request->eac_day;
		$electricMeter->eac_night = $request->eac_night;
		$electricMeter->eac_ew = $request->eac_ew;
		$electricMeter->contractEndDate = $request->contractEndDate;
		$electricMeter->terminationDate = $request->terminationDate;
		$electricMeter->auRate = $request->auRate;
		$electricMeter->dayRate = $request->dayRate;
		$electricMeter->nightRate = $request->nightRate;
		$electricMeter->ewRate = $request->ewRate;
		$electricMeter->fit = $request->fit;
		$electricMeter->standingCharge = $request->standingCharge;
		$electricMeter->standingChargePer = $request->standingChargePer;
		$electricMeter->kv_allowance = $request->kv_allowance;
		$electricMeter->kva_rate = $request->kva_rate;

		$electricMeter->save();

		flash('Electric Meter Updated', 'success');

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
		$meter = $this->electricMeters->find($meter);
		$meter->delete();

		flash('Elecreic Meter Has Been Deleted', 'warning');

		return redirect()->route('sites.edit', ['id'=>$prospect, 'site_id'=> $site]);
	}
}
