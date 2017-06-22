<?php

namespace App\Forms\Sites;

use Kris\LaravelFormBuilder\Form;

class UpdateGasMeter extends Form
{
	public $title = "Update Gas Meter";
	
    public function buildForm()
    {
		$this->add('_method', 'hidden', [
			'value' => 'PUT'
		]); 

		$this->add('id', 'hidden'); 

		//row open
		$this->add('gm_row_open', 'div', ['class' => "row"]);
		
			//core open
			$this->add('gm_core_open', 'div', ['class' => "col-sm-12"]);
			
				$this->add('prospect_id', 'text', [
					'label' => 'Prospect',
					'attr' => [
						'disabled' => true
					], 
					'value'=> $this->getModel()->site->prospect->company
				]);
				
				$this->add('site_id', 'text', [
					'label' => 'Site',
					'attr' => [
						'disabled' => true
					], 
					'value'=> $this->getModel()->site->street_1.", ".$this->getModel()->site->town.", ".$this->getModel()->site->post_code
				]);
			
			//core close
			$this->add('gm_core_close', 'close-div');
			
			//infomation open
			$this->add('gm_infomation_open', 'div', ['class' => "col-sm-12"]);
				
				//header
				$this->add('gm_infomation_header', 'header', ['title' => "Infomation"]);
				//fields
				$this->add('mprn', 'text', [
					'label' => 'MPRN'
				]);
			
			//infomation close
			$this->add('gm_infomation_close', 'close-div');
			
			
			
			//dates open
			$this->add('gm_dates_open', 'div', ['class' => "col-sm-6"]);
				
				//header
				$this->add('gm_dates_header', 'header', ['title' => "Dates"]);
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
				'label' => 'Update Gas Meter',
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
