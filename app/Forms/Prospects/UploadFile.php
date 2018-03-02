<?php

namespace App\Forms\Prospects;

use Kris\LaravelFormBuilder\Form;

class UploadFile extends Form
{
	public $title = "Upload File";

    public function buildForm()
    {

		$this->add('prospect_id', 'hidden', [
			'value'=> $this->getModel()->id
		]);

        $this->add('file_type', 'select', [
          'label' => 'File Type',
          'choices' => array('', 'signedContracts'=>'Signed Contracts', 'supportingDocuments'=>'Supporting Document')
        ]);

		$this->add('file', 'file');

		//button
		$this->add('submit', 'submit', [
			'label' => 'Update Prospect',
			'attr' => [
				'class' => 'btn btn-success',
				'style' => 'width:100%;'
			]
		]);
    }
}
