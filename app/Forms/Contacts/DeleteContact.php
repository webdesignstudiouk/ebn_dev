<?php

namespace App\Forms\Contacts;

use Kris\LaravelFormBuilder\Form;

class DeleteContact extends Form
{
	public $title = "Delete Contact";

    public function buildForm()
    {

		$this->add('_method', 'hidden', [
			'value' => 'DELETE'
		]);

		$this->add('id', 'hidden');

		$this->add('submit', 'submit', [
			'label' => 'Delete Contact',
			 'attr' => [
				'class' => 'btn btn-danger',
				'style' => 'width:100%;'
			]
		]);
    }

}
