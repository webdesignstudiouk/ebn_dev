<?php

namespace App\Forms\Options;

use Kris\LaravelFormBuilder\Form;

class CreateCampaign extends Form
{
	public $title = "Create Campaign";
	
    public function buildForm()
    {
		
		$this->add('source_id', 'hidden', [
			'rules' => 'required',
			'value'=> $this->getModel()->id
		]);
		
		$this->add('week_number', 'text', [
			'rules' => 'required'
		]);
		
		$this->add('type', 'text', [
			'label' => 'Type',
		]);

		$this->add('submit', 'submit', [
			'label' => 'Create Campaign',
			'attr' => [
				'class' => 'btn btn-success',
				'style' => 'width:100%;'
			]
		]);
    }
	
}
