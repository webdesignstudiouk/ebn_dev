<?php

namespace App\Forms\Sites;

use Kris\LaravelFormBuilder\Form;

class CreateGasMeter extends Form
{
	public $title = "Create Gas Meter";

    public function buildForm()
    {
		//row open
		$this->add('gm_row_open', 'div', ['class' => "row"]);

			//core open
			$this->add('gm_core_open', 'div', ['class' => "col-sm-12"]);

				$this->add('site_id', 'text', [
					'value'=> $this->getModel()->id
				]);

				$this->add('prospect_id', 'text', [
					'label' => 'Prospect',
					'attr' => [
						'disabled' => true
					],
					'value'=> $this->getModel()->prospect->company
				]);

				$this->add('site_description', 'text', [
					'label' => 'Site',
					'attr' => [
						'disabled' => true
					],
					'value'=> $this->getModel()->street_1.", ".$this->getModel()->town.", ".$this->getModel()->post_code
				]);

			//core close
			$this->add('gm_core_close', 'close-div');

			//infomation open
			$this->add('gm_infomation_open', 'div', ['class' => "col-sm-12"]);

				//header
				$this->add('gm_infomation_header', 'header', ['title' => "Information"]);
				//fields
				$this->add('mprn', 'text', [
					'label' => 'MPRN'
				]);

			//infomation close
			$this->add('gm_infomation_close', 'close-div');



			//dates open
			$this->add('gm_dates_open', 'div', ['class' => "col-sm-6"]);

				//header
				$this->add('gm_dates_header', 'header', ['title' => "Other"]);
				//fields
				$this->add('eac', 'text', [
					'label' => 'EAC'
				]);

				$this->add('contractEndDate', 'date', [
					'label' => 'Contract End Date'
				]);

				$this->add('terminationDate', 'date', [
					'label' => 'Termination Date'
				]);

                $this->add('start_date', 'date', [
                    'label' => 'Start Date'
                ]);

                $this->add('supplier', 'text', [
                    'label' => 'Supplier'
                ]);

                $this->add('contract_type', 'select', [
                    'label' => 'Contract Type',
                    'choices' => array(
                        'Fully Fixed' => 'Fully Fixed',
                        'Pass Through' => 'Pass Through',
                        'Flexible' => 'Flexible')
                ]);

                $this->add('amr', 'select', [
                    'label' => 'AMR',
                    'choices' => array(
                        '1' => 'Yes',
                        '0' => 'No')
                ]);

			//dates close
			$this->add('gm_dates_close', 'close-div');

			//others open
			$this->add('gm_other_open', 'div', ['class' => "col-sm-6"]);

				//header
				$this->add('gm_other_header', 'header', ['title' => "Rates / Other"]);
				//fields
				$this->add('currentUnitRate', 'text', [
					'label' => 'Current Unit Rate'
				]);

				$this->add('current8c', 'text', [
					'label' => 'Current S/C'
				]);

			//others close
			$this->add('gm_other_close', 'close-div');

			//button open
			$this->add('gm_button_open', 'div', ['class' => "col-sm-12"]);

			$this->add('submit', 'submit', [
				'label' => 'Create Gas Meter',
				'attr' => [
					'class' => 'btn btn-success',
					'style' => 'width:100%;'
				]
			]);

			//button close
			$this->add('gm_button_close', 'close-div');

		//row close
		$this->add('gm_row_close', 'close-div');
    }

}
