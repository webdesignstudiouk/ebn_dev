<?php

namespace App\Forms\Options;

use Kris\LaravelFormBuilder\Form;

class CreateSourceCode extends Form
{
	public $title = "Create Source Code";
	
    public function buildForm()
    {
		$this->add('title', 'text', [
			'rules' => 'required'
		]);
		
		$this->add('description', 'text');

		$this->add('submit', 'submit', [
			'label' => 'Create Source Code',
			'attr' => [
				'class' => 'btn btn-success',
				'style' => 'width:100%;'
			]
		]);
    }
	
}
