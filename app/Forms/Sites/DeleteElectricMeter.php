<?php

namespace App\Forms\Sites;

use Kris\LaravelFormBuilder\Form;

class DeleteElectricMeter extends Form
{
	public $title = "Delete Electric Meter";
	
    public function buildForm()
    {
		
		$this->add('_method', 'hidden', [
			'value' => 'DELETE'
		]); 
		
		$this->add('id', 'hidden'); 

		$this->add('submit', 'submit', [
			'label' => 'Delete Electric Meter',
			 'attr' => [
				'class' => 'btn btn-danger',
				'style' => 'width:100%;'
			]
		]);
    }
	
}
