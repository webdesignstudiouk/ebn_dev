<?php

namespace App\Forms\Users;

use Kris\LaravelFormBuilder\Form;
use App\Models\Users_Groups;

class CreateUser extends Form
{
	public $title = "Create User";
	
    public function buildForm()
    {
        $user_groups = Users_Groups::all();

        $this->add('group_id', 'select', [
            'label' => 'Group',
            'choices' => array_pluck($user_groups, 'name', 'id')
        ]);

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
