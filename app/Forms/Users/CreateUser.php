<?php

namespace App\Forms\Users;

use Kris\LaravelFormBuilder\Form;

class CreateUser extends Form
{
	public $title = "Create User";
	
    public function buildForm()
    {
		$this->add('first_name', 'text', [
			'rules' => 'required'
		]);

		$this->add('second_name', 'text', [
			'rules' => 'required'
		]);
		$this->add('email', 'email', [
			'rules' => 'required'
		]);
		
		$this->add('password', 'password', [
			'rules' => 'required'
		]);
	
		$this->add('submit', 'submit', [
			'label' => 'Create User',
			'attr' => [
				'class' => 'btn btn-success',
				'style' => 'width:100%;'
			]
		]);
    }
	
}
