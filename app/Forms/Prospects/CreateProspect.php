<?php

namespace App\Forms\Prospects;

use Kris\LaravelFormBuilder\Form;
use App\Models\ProspectsSources;
use App\Models\ProspectsSourcesCampaigns;

class CreateProspect extends Form
{
	public $title = "Create Prospect";

    public function buildForm()
    {
		$sources = ProspectsSources::all();
		$sourcesCampaigns = ProspectsSourcesCampaigns::all();

		$this->add('openRow-1', 'div', ['class' => "row"]);

		//Infomation
		$this->add('openCol-3', 'div', ['class' => "col-sm-12"]);

			//fields
			$this->add('company', 'text', [
				'rules' => 'required'
			]);

			//button
			$this->add('submit', 'submit', [
				'label' => 'Create Prospect',
				'attr' => [
					'class' => 'btn btn-success',
					'style' => 'width:100%;'
				]
			]);

		$this->add('closeRow-1', 'close-div');
    }
}
