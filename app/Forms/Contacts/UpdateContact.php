<?php

namespace App\Forms\Contacts;

use Kris\LaravelFormBuilder\Form;
use App\Models\ContactsTypes;

class UpdateContact extends Form
{
	public $title = "Update Contact";

    public function buildForm()
    {
		$contactTypes = ContactsTypes::all();

		$this->add('_method', 'hidden', [
			'value' => 'PUT'
		]);

		$this->add('id', 'hidden');

		$this->add('type_id', 'select', [
			'label' => 'Contact Type',
			'choices' => array_pluck($contactTypes, 'title', 'id')
		]);

		/*
		$this->add('favourite', 'checkbox', [
			'label' => 'Favourite',
		]);
		*/

		$this->add('title', 'select', [
			'label' => 'Title',
			'choices'=> [''=>'','Mr'=>'Mr','Mrs'=>'Mrs','Miss'=>'Miss','Ms'=>'Ms']
		]);

		$this->add('job_title', 'text', [
			'label' => 'Job Title'
		]);

		$this->add('first_name', 'text', [
			'label' => 'First Name'
		]);

		$this->add('second_name', 'text', [
			'label' => 'Second Name'
		]);

		$this->add('email', 'text', [
			'label' => 'Email'
		]);

		$this->add('phonenumber', 'text', [
			'label' => 'Phone Number'
		]);

		$this->add('mobile_number', 'text', [
			'label' => 'Mobile Number'
		]);

		$this->add('submit', 'submit', [
			'label' => 'Update Contact',
			'attr' => [
				'class' => 'btn btn-success',
				'style' => 'width:100%;'
			]
		]);
    }

}
