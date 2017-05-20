<?php

namespace App\Forms\Callbacks;

use Kris\LaravelFormBuilder\Form;

class CreateCallback extends Form
{
	public $title = "Create Callback";

    public function buildForm()
    {
		$this->add('prospect_id', 'hidden', [
			'rules' => 'required',
			'value'=> $this->getModel()->id
		]);

		$this->add('callbackDate', 'date', [
			'rules' => 'required'
		]);

		$this->add('callbackTime', 'time');

		$this->add('note', 'textarea', [
			'rules' => 'required'
		]);

		$this->add('submit', 'submit', [
			'label' => 'Create Callback',
			'attr' => [
				'class' => 'btn btn-success',
				'style' => 'width:100%;'
			]
		]);
    }

}
