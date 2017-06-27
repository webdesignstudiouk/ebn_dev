<?php

namespace App\Http\Controllers\Options;

use Illuminate\Http\Request;
use App\Models\ProspectsSources;
use App\Models\ProspectsSourcesCampaigns;
use Kris\LaravelFormBuilder\FormBuilder;
use Carbon\Carbon;
use Goodby\CSV\Export\Standard\Exporter;
use Goodby\CSV\Export\Standard\ExporterConfig;
use Response;

class Subscriptions extends \App\Http\Controllers\Controller
{

	public function export()
     {
	    $people = ProspectsSources::all();

    $csv = \League\Csv\Writer::createFromFileObject(new \SplTempFileObject());

    $csv->insertOne(\Schema::getColumnListing('people'));

    foreach ($people as $person) {
        $csv->insertOne($person->toArray());
    }

    $csv->output('people.csv');
	}
}
