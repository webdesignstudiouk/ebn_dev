<?php

namespace App\Forms\Sites;

use Kris\LaravelFormBuilder\Form;

class CreateSite extends Form
{
	public $title = "Create Site";
	
    public function buildForm()
    {
		$this->add('prospect_id', 'hidden', [
			'rules' => 'required',
			'value'=> $this->getModel()->id
		]);
		
		$this->add('name', 'text', [
			'label' => 'Site Name',
			'value' => ""
		]);

		$this->add('street_1', 'text', [
			'label' => 'Street 1',
			'value' => ""
		]);

		$this->add('street_2', 'text', [
			'label' => 'Street 2',
			'value' => ""
		]);

		$this->add('street_3', 'text', [
			'label' => 'Street 3',
			'value' => ""
		]);

		$this->add('Town', 'text', [
			'label' => 'Street 4',
			'value' => ""
		]);

		$this->add('City', 'text', [
			'label' => 'Town',
			'value' => ""
		]);

		$this->add('county', 'text', [
			'label' => 'County',
			'value' => ""
		]);

		$this->add('post_code', 'text', [
			'label' => 'Post Code',
			'value' => ""
		]);

		$this->add('submit', 'submit', [
			'label' => 'Create Site',
			'attr' => [
				'class' => 'btn btn-success',
				'style' => 'width:100%;'
			]
		]);
    }
	
}
