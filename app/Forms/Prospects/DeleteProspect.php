<?php

namespace App\Forms\Prospects;

use Kris\LaravelFormBuilder\Form;

class DeleteProspect extends Form
{
	public $title = "Delete Prospect/Client";

    public function buildForm()
    {

		$this->add('_method', 'hidden', [
			'value' => 'DELETE'
		]);

		$this->add('id', 'hidden');

		$this->add('deleted_reason', 'select', [
			'label' => 'Option',
			'choices' => array(
			'Other' => 'Other',
			'No Interest' => 'No Interest',
			'Multi Contact Fail' => 'Multi Contact Fail',
			'Incorrect Contact Info' => 'Incorrect Contact Info',
			'Uses Other Broker' => 'Uses Other Broker',
			'Does Himself' => 'Does Himself',
			'Dead Line' => 'Dead Line',
			'Duplicate Prospect' => 'Duplicate Prospect',
			'TPS' => 'TPS',)
		]);

        $this->add('deleted_reason_2', 'textarea', [
            'label' => 'Reason',
        ]);

		$this->add('submit', 'submit', [
			'label' => 'Delete Prospect',
			 'attr' => [
				'class' => 'btn btn-danger',
				'style' => 'width:100%;'
			]
		]);
    }

}
