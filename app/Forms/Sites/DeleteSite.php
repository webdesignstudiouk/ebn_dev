<?php

namespace App\Forms\Sites;

use Kris\LaravelFormBuilder\Form;

class DeleteSite extends Form
{
	public $title = "Delete Site";
	
    public function buildForm()
    {
		
		$this->add('_method', 'hidden', [
			'value' => 'DELETE'
		]); 
		
		$this->add('id', 'hidden'); 

		$this->add('submit', 'submit', [
			'label' => 'Delete Site',
			 'attr' => [
				'class' => 'btn btn-danger',
				'style' => 'width:100%;'
			]
		]);
    }
	
}
