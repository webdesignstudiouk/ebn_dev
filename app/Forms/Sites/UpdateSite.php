<?php

namespace App\Forms\Sites;

use Kris\LaravelFormBuilder\Form;

class UpdateSite extends Form
{
	public $title = "Update Site";
	
    public function buildForm()
    {
		$this->add('_method', 'hidden', [
			'value' => 'PUT'
		]); 

		$this->add('id', 'hidden'); 
		
		$this->add('name', 'text', [
			'label' => 'Site Name'
		]);

		$this->add('street_1', 'text', [
			'label' => 'Street 1'
		]);

		$this->add('street_2', 'text', [
			'label' => 'Street 2'
		]);

		$this->add('street_3', 'text', [
			'label' => 'Street 3'
		]);

		$this->add('street_4', 'text', [
			'label' => 'Street 4'
		]);

		$this->add('town', 'text', [
			'label' => 'Town'
		]);

		$this->add('county', 'text', [
			'label' => 'County'
		]);

		$this->add('post_code', 'text', [
			'label' => 'Post Code'
		]);

		$this->add('submit', 'submit', [
			'label' => 'Update Site',
			'attr' => [
				'class' => 'btn btn-success',
				'style' => 'width:100%;'
			]
		]);
    }
	
}
