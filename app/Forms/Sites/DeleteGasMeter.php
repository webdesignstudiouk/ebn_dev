<?php

namespace App\Forms\Sites;

use Kris\LaravelFormBuilder\Form;

class DeleteGasMeter extends Form
{
	public $title = "Delete Gas Meter";
	
    public function buildForm()
    {
		
		$this->add('_method', 'hidden', [
			'value' => 'DELETE'
		]); 
		
		$this->add('id', 'hidden'); 

		$this->add('submit', 'submit', [
			'label' => 'Delete Gas Meter',
			 'attr' => [
				'class' => 'btn btn-danger',
				'style' => 'width:100%;'
			]
		]);
    }
	
}
