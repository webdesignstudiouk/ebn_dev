<?php

namespace App\Forms\Options;

use Kris\LaravelFormBuilder\Form;

class UpdateCampaign extends Form
{	
	public $title = "Update Campaign";
	
    public function buildForm()
    {
		$this->add('_method', 'hidden', [
			'value' => 'PUT'
		]); 

		$this->add('id', 'hidden'); 
		
		$this->add('week_number', 'text', [
			'rules' => 'required'
		]);
		
		$this->add('type', 'text', [
			'label' => 'Type',
		]);
		
		$this->add('submit', 'submit', [
			'label' => 'Update Campaign',
			'attr' => [
				'class' => 'btn btn-success',
				'style' => 'width:100%;'
			]
		]);
    }
}
