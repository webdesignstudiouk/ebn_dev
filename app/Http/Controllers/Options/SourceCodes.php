<?php

namespace App\Http\Controllers\Options;

use Illuminate\Http\Request;
use App\Models\ProspectsSources;
use App\Models\ProspectsSourcesCampaigns;
use Kris\LaravelFormBuilder\FormBuilder;
use Carbon\Carbon;

class SourceCodes extends \App\Http\Controllers\Controller
{
	protected $sourceCodes;
	protected $campaigns;

	public function __construct()
	{
		$this->sourceCodes = new ProspectsSources;
		$this->campaigns = new ProspectsSourcesCampaigns;
	}

	public function index(FormBuilder $formBuilder)
	{
		$sourceCodes = new ProspectsSources();
		$sourceCodes = $sourceCodes->all();
		$createSourceCodes_form = $formBuilder->create(\App\Forms\Options\CreateSourceCode::class, [
			'method' => 'POST',
			'url' => route('source-codes.store')
		]);

		return view('admin.sourceCodes.sourceCodes')
		->with('sourceCodes', $sourceCodes)
		->with('createSourceCodes_form', $createSourceCodes_form);
	}

	public function store(Request $request)
	{
		$sourceCode = new ProspectsSources;
		$sourceCode->title = $request->title;
		$sourceCode->description = $request->description;
		$sourceCode->save();

		flash('Source Code Created', 'success');

		return back();
	}

	public function edit($sourceCode, FormBuilder $formBuilder)
	{
		$sourceCode = $this->sourceCodes->find($sourceCode);

		$createCampaign_form = $formBuilder->create(\App\Forms\Options\CreateCampaign::class, [
			'method' => 'POST',
			'url' => route('campaigns.store', $sourceCode->id),
			'model' => $sourceCode
		]);

		$updateSourceCode_form = $formBuilder->create(\App\Forms\Options\UpdateSourceCode::class, [
			'method' => 'POST',
			'url' => route('source-codes.update', $sourceCode->id), 
			'model' => $sourceCode
		]);

		return view('admin.sourceCodes.sourceCode')
		->with('sourceCode', $sourceCode)
		->with('createCampaign_form', $createCampaign_form)
		->with('updateSourceCode_form', $updateSourceCode_form);
	}

	public function update(Request $request)
	{
		$sourceCode = $this->sourceCodes->find($request->id);
		$sourceCode->title = $request->title;
		$sourceCode->description = $request->description;
		$sourceCode->save();

		flash('Source Code Updated', 'success');

		return back();
	}

	public function campaign($sourceCode, $campaign, FormBuilder $formBuilder)
	{
		$sourceCode = $this->sourceCodes->find($sourceCode);
		$campaign = $this->campaigns->find($campaign);

		$updateCampaign_form = $formBuilder->create(\App\Forms\Options\UpdateCampaign::class, [
			'method' => 'POST',
			'url' => url('admin/options/sourceCodes/'.$sourceCode->id.'/campaigns/'.$campaign->id),
			'model' => $campaign
		]);

		return view('admin.options.sourceCodes.campaigns.campaign')
		->with('sourceCode', $sourceCode)
		->with('campaign', $campaign)
		->with('updateCampaign_form', $updateCampaign_form);
	}
}
