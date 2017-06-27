<?php

namespace App\Forms\Users;

use Kris\LaravelFormBuilder\Form;

class DeleteUser extends Form
{
	public $title = "Delete User";
	
    public function buildForm()
    {
		
		$this->add('_method', 'hidden', [
			'value' => 'DELETE'
		]); 
		
		$this->add('id', 'hidden'); 

		$this->add('submit', 'submit', [
			'label' => 'Delete User',
			 'attr' => [
				'class' => 'btn btn-danger',
				'style' => 'width:100%;'
			]
		]);
    }
	
}
