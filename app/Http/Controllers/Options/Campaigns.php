<?php

namespace App\Http\Controllers\Options;

use Illuminate\Http\Request;
use App\Models\ProspectsSources;
use App\Models\ProspectsSourcesCampaigns;
use Kris\LaravelFormBuilder\FormBuilder;
use Carbon\Carbon;

class Campaigns extends \App\Http\Controllers\Controller
{
  protected $sourceCodes;
  protected $campaigns;

  public function __construct()
  {
		$this->sourceCodes = new ProspectsSources;
    $this->campaigns = new ProspectsSourcesCampaigns;
  }

  public function edit($source_id, $campaign_id, FormBuilder $formBuilder)
  {
		$campaign = $this->campaigns->find($campaign_id);
		$sourceCode = $this->sourceCodes->find($campaign->source_id);

		$updateCampaign_form = $formBuilder->create(\App\Forms\Options\UpdateCampaign::class, [
			'method' => 'POST',
			'url' => route('campaigns.update', ['source_id' => $campaign->source_id, 'campaign_id' => $campaign->id]),
			'model' => $campaign
		]);

		return view('admin.sourceCodes.campaigns.campaign')
		->with('sourceCode', $sourceCode)
		->with('campaign', $campaign)
		->with('updateCampaign_form', $updateCampaign_form);
	}

  public function store(Request $request)
  {
    $now = Carbon::now();

    $campaign = new ProspectsSourcesCampaigns;
    $campaign->source_id = $request->source_id;
    $campaign->week_number = $request->week_number;
    $campaign->year = $now->year;
	$campaign->type = $request->type;
    $campaign->save();

    flash('Campaign Created', 'success');
    return back()->withInput(['tab'=>'campaigns']);
  }

  public function update(Request $request)
  {
    $campaign = $this->campaigns->find($request->id);
    $campaign->week_number = $request->week_number;
	$campaign->type = $request->type;
    $campaign->save();

    flash('Campaign Updated', 'success');
    return back();
  }


}
