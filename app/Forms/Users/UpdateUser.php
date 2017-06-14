<?php

namespace App\Forms\Users;

use Kris\LaravelFormBuilder\Form;
use App\Models\Users_Groups;

class UpdateUser extends Form
{	
	public $title = "Update User";
	
    public function buildForm()
    {
        $user_groups = Users_Groups::all();
		$this->add('_method', 'hidden', [
			'value' => 'PUT'
		]);

		$this->add('id', 'hidden');

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

        $this->add('password', 'text', [
            'rules' => 'required',
            'value' => ''
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
