<?php

namespace App\Forms\Users;

use Kris\LaravelFormBuilder\Form;

class UpdateUser extends Form
{	
	public $title = "Update User";
	
    public function buildForm()
    {
		$this->add('_method', 'hidden', [
			'value' => 'PUT'
		]); 

		$this->add('id', 'hidden'); 
		
		$this->add('first_name', 'text', [
			'rules' => 'required'
		]);

		$this->add('second_name', 'text', [
			'rules' => 'required'
		]);
		$this->add('email', 'email', [
			'rules' => 'required'
		]);
		
		$this->add('submit', 'submit', [
			'label' => 'Update User',
			'attr' => [
				'class' => 'btn btn-success',
				'style' => 'width:100%;'
			]
		]);
    }
}
