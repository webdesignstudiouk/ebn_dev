<?php

namespace App\Forms\Prospects;

use Kris\LaravelFormBuilder\Form;
use App\Models\ProspectsSources;
use App\Models\ProspectsSourcesCampaigns;

class UpdateProspect extends Form
{
	public $title = "Prospect Details";

    public function buildForm()
    {
		$sources = ProspectsSources::all();
		$sourcesCampaigns = ProspectsSourcesCampaigns::where('source_id', $this->getModel()->source_id)->get();

		$this->add('openRow-1', 'div', ['class' => "row"]);

		//Infomation
		$this->add('openCol-3', 'div', ['class' => "col-sm-12"]);

			$this->add('_method', 'hidden', [
				'value' => 'PUT'
			]);

			$this->add('id', 'hidden');

			$this->add('id_title', 'text', [
				'label' => 'ID',
				'attr' => [
					'disabled' => true
				],
				'value'=> $this->getModel()->id
			]);

			$this->add('user_id', 'text', [
				'label' => 'Agent',
				'attr' => [
					'disabled' => true
				],
				'value'=> $this->getModel()->user->first_name." ".$this->getModel()->user->second_name
			]);

			$this->add('type_id', 'text', [
				'label' => 'Prosect Type',
				'attr' => [
					'disabled' => true
				],
				'value'=> $this->getModel()->prospectType->title." - ".$this->getModel()->prospectType->description
			]);

			//fields
			$this->add('openRow-33', 'div', ['class' => "row"]);
				$this->add('openCol-333', 'div', ['class' => "col-sm-4"]);

					$options = [];

					foreach($sources->toArray() as $source){
						$options['s-'. $source['id']] = $source['title'];
						$options['t-'. $source['id']] = "----------------------";
						$sourcesCampaigns = ProspectsSourcesCampaigns::where('source_id', $source['id'])->get();
						foreach($sourcesCampaigns as $campaign){
							$options[$campaign['id']] = $campaign['week_number'].' - '.$campaign['type'];
						}
						$options['d-'. $source['id']] ="";
					}

					$this->add('campaign_id', 'select', [
						'label' => 'Campaign Week Number',
						'choices'=> $options,
						'choice_options' => [
							'wrapper' => false,
							'is_child' => false
						]
					]);

					//link
					$this->add('link-1', 'link', ['url' => route('source-codes'),'link' => 'Create a source code.']);

				$this->add('closeCol-444', 'close-div');
				$this->add('openCol-44', 'div', ['class' => "col-sm-4"]);

					$this->add('lead_type', 'select', [
						'label' => 'Lead Type',
						'choices'=> ['', 'lead', 'clickers', 'openers']
					]);

				$this->add('closeCol-44', 'close-div');
				$this->add('openCol-43', 'div', ['class' => "col-sm-4"]);

					$this->add('lead_source', 'select', [
						'label' => 'Lead Source',
						'choices' => array('', 'Outbound Calls', 'E-Marketing', 'Advertising', 'Internet Search', 'Referral', 'Original')
					]);

				$this->add('closeCol-43', 'close-div');
			$this->add('closeRow-444', 'close-div');

			//header
			$this->add('header-4', 'header', ['title' => "Options"]);
			//fields
			$this->add('r2o', 'div', ['class' => "row"]);
			$this->add('checkbox1o', 'div', ['class' => "col-sm-6"]);
				$this->add('subscribed', 'checkbox', [
					'attr' => [
						'class' => 'iswitch iswitch-secondary'
					]
				]);

				$this->add('checkbox1c', 'close-div');
				$this->add('checkbox2o', 'div', ['class' => "col-sm-6"]);
				$this->add('mug_sent', 'checkbox', [
					'attr' => [
						'class' => 'iswitch iswitch-secondary'
					]
				]);
			$this->add('checkbox2c', 'close-div');
			$this->add('r2c', 'close-div');

		$this->add('closeCol-3', 'close-div');

			//Company Details
			$this->add('openCol-1', 'div', ['class' => "col-sm-6"]);
				//header
				$this->add('header-1', 'header', ['title' => "Company Details"]);
				//fields
                $this->add('company', 'text', [
                    'rules' => 'required'
                ]);

				$this->add('email', 'text', [
					'label' => 'Email'
				]);
				$this->add('phonenumber', 'text', [
					'label' => 'Phone Number'
				]);
				$this->add('url', 'text', [
					'label' => 'Website Address (URL)'
				]);
				$this->add('tradingStyle', 'text', [
					'label' => 'Trading Style'
				]);
				$this->add('regNumber', 'text', [
					'label' => 'Reg Number'
				]);
				$this->add('businessType', 'text', [
					'label' => 'SIC Description'
				]);
				$this->add('verbalCED', 'text', [
					'label' => 'Verbal CED'
				]);

			$this->add('closeCol6-1', 'close-div');

			//Head Office Address
			$this->add('openCol-2', 'div', ['class' => "col-sm-6"]);
				//header
				$this->add('header-2', 'header', ['title' => "Registered Address"]);
				//fields
				$this->add('street_1', 'text');
				$this->add('street_2', 'text');
				$this->add('town', 'text');
				$this->add('city', 'text');
				$this->add('county', 'text');
				$this->add('postcode', 'text');

			$this->add('closeCol6-2', 'close-div');

			//button
			$this->add('submit', 'submit', [
				'label' => 'Update Prospect',
				'attr' => [
					'class' => 'btn btn-success',
					'style' => 'width:100%;'
				]
			]);

		$this->add('closeRow-1', 'close-div');
    }
}
