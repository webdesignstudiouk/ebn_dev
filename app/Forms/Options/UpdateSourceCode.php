<?php

namespace App\Forms\Options;

use Kris\LaravelFormBuilder\Form;

class UpdateSourceCode extends Form
{	
	public $title = "Update Source Code";
	
    public function buildForm()
    {
		
		$this->add('_method', 'hidden', [
			'value' => 'PUT'
		]); 

		$this->add('id', 'hidden'); 
		
		$this->add('title', 'text', [
			'rules' => 'required'
		]);
		
		$this->add('description', 'text');
		
		$this->add('submit', 'submit', [
			'label' => 'Update Source Code',
			'attr' => [
				'class' => 'btn btn-success',
				'style' => 'width:100%;'
			]
		]);
    }
}
