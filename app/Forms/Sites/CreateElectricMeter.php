<?php

namespace App\Forms\Sites;

use Kris\LaravelFormBuilder\Form;

class CreateElectricMeter extends Form
{
	public $title = "Create Electric Meter";
	
    public function buildForm()
    {
		
		//row open
		$this->add('em_row_open', 'div', ['class' => "row"]);
		
			//core open
			$this->add('em_core_open', 'div', ['class' => "col-sm-12"]);
			
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
			$this->add('em_core_close', 'close-div');
		
		//row close
		$this->add('em_row_close', 'close-div');
		
		//////////////////////////////////////////////// -- Mpan 1-3 -- //////////////////////////////////////////////
		
		//open row
		$this->add('em_row1_open', 'div', ['class' => "row"]);
			
			$this->add('em_infomation_header', 'header', ['title' => "Information"]);
			
			//mpan 1 open
			$this->add('em_mpan1_open', 'div', ['class' => "col-sm-4"]);
				//mpan 1
				$this->add('mpan_1', 'text', [
					'label' => 'MPAN 1'
				]);
			//mpan 1 close
			$this->add('em_mpan1_close', 'close-div');
			

			//mpan 2 open
			$this->add('em_mpan2_open', 'div', ['class' => "col-sm-4"]);
				//mpan 1
				$this->add('mpan_2', 'text', [
					'label' => 'MPAN 2'
				]);
			//mpan 2 close
			$this->add('em_mpan2_close', 'close-div');
			

			//mpan 3 open
			$this->add('em_mpan3_open', 'div', ['class' => "col-sm-4"]);
				//mpan 1
				$this->add('mpan_3', 'text', [
					'label' => 'MPAN 3'
				]);
			//mpan 3 close
			$this->add('em_mpan3_close', 'close-div');
		
		//row close
		$this->add('em_row1_close', 'close-div');
		
		//////////////////////////////////////////////// -- Mpan 4-7 -- //////////////////////////////////////////////
		
		//open row
		$this->add('em_row2_open', 'div', ['class' => "row"]);
			
			//mpan 4 open
			$this->add('em_mpan4_open', 'div', ['class' => "col-sm-4"]);
				//mpan 4
				$this->add('mpan_4', 'text', [
					'label' => 'MPAN 4'
				]);
			//mpan 1 close
			$this->add('em_mpan4_close', 'close-div');
			

			//mpan 5 open
			$this->add('em_mpan5_open', 'div', ['class' => "col-sm-2"]);
				//mpan 5
				$this->add('mpan_5', 'text', [
					'label' => 'MPAN 5'
				]);
			//mpan 5 close
			$this->add('em_mpan5_close', 'close-div');
			

			//mpan 6 open
			$this->add('em_mpan6_open', 'div', ['class' => "col-sm-2"]);
				//mpan 6
				$this->add('mpan_6', 'text', [
					'label' => 'MPAN 6'
				]);
			//mpan 6 close
			$this->add('em_mpan6_close', 'close-div');
			
			//mpan 7 open
			$this->add('em_mpan7_open', 'div', ['class' => "col-sm-4"]);
				//mpan 7
				$this->add('mpan_7', 'text', [
					'label' => 'MPAN 7'
				]);
			//mpan 7 close
			$this->add('em_mpan7_close', 'close-div');
			
			//////////////////////////////////////////////// -- Dates -- //////////////////////////////////////////////
			
			//dates open
			$this->add('gm_dates_open', 'div', ['class' => "col-sm-6"]);
				
				//header
				$this->add('gm_dates_header', 'header', ['title' => "Other"]);
				//fields
				
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
			
			//////////////////////////////////////////////// -- Rates -- //////////////////////////////////////////////
			
			//rates open
			$this->add('em_rates_open', 'div', ['class' => "col-sm-6"]);
				
				//header
				$this->add('em_dates_header', 'header', ['title' => "Rates"]);
				//fields
				
				//////////////////////////////////////////////// -- EAC -- //////////////////////////////////////////////
				
				//eac1 open
				$this->add('em_eac_open', 'div', ['class' => "col-sm-6"]);  
					
					$this->add('eac', 'text', [
						'label' => 'EAC'
					]);
				
				$this->add('em_eac1_close', 'close-div');
				$this->add('em_eac2_open', 'div', ['class' => "col-sm-6"]);

					$this->add('eac_ew', 'text', [
						'label' => 'EAC E/W'
					]);
					
				//eac1 close
				$this->add('em_eac2_close', 'close-div');
				
				//eac2 open
				$this->add('em_eac3_open', 'div', ['class' => "col-sm-6"]);  
					
					$this->add('eac_day', 'text', [
						'label' => 'EAC Day'
					]);
				
				$this->add('em_eac3_close', 'close-div');
				$this->add('em_eac4_open', 'div', ['class' => "col-sm-6"]);

					$this->add('eac_night', 'text', [
						'label' => 'EAC Night'
					]);
					
				//eac2 close
				$this->add('em_eac4_close', 'close-div');
				
				//////////////////////////////////////////////// -- Rates 2-- //////////////////////////////////////////////
				
				//rates open
				$this->add('em_rates1_open', 'div', ['class' => "col-sm-4"]);  
					
					$this->add('auRate', 'text', [
					'label' => 'AU Rate'
				]);
				
				$this->add('em_rates1_close', 'close-div');
				$this->add('em_rates2_open', 'div', ['class' => "col-sm-4"]);

					$this->add('dayRate', 'text', [
						'label' => 'Day Rate'
					]);
					
				$this->add('em_rates2_close', 'close-div');
				$this->add('em_rates3_open', 'div', ['class' => "col-sm-4"]);
					
					$this->add('nightRate', 'text', [
						'label' => 'Night Rate'
					]);
				
				//rates close
				$this->add('em_rates3_close', 'close-div');

				//////////////////////////////////////////////// -- Rates 3-- //////////////////////////////////////////////
				
				//rates2 open
				$this->add('em_rates21_open', 'div', ['class' => "col-sm-6"]);  

					$this->add('ewRate', 'text', [
					'label' => 'EW Rate'
				]);
				
				$this->add('em_rates21_close', 'close-div');
				$this->add('em_rates22_open', 'div', ['class' => "col-sm-6"]);

					$this->add('fit', 'text');
					
				//rates2 close
				$this->add('em_rates22_close', 'close-div');

				//////////////////////////////////////////////// -- Standing Charge -- //////////////////////////////////////////////
				
				//sc open
				$this->add('em_sc_open', 'div', ['class' => "col-sm-6"]);  

					$this->add('standingCharge', 'text', [
						'label' => 'Standing Charge'
					]);
				
				$this->add('em_sc1_close', 'close-div');
				$this->add('em_sc2_open', 'div', ['class' => "col-sm-6"]);

					$this->add('standingChargePer', 'select', [
						'choices' => ['Day' => 'Day', 'Month' => 'Month', 'Quarterly' => 'Quarterly'],
					]);
					
				//sc close
				$this->add('em_sc2_close', 'close-div');
				
				//////////////////////////////////////////////// -- KVA -- //////////////////////////////////////////////
				
				//kva open
				$this->add('em_kva1_open', 'div', ['class' => "col-sm-6"]);

					$this->add('kv_allowance', 'text', [
						'label' => 'KVA Allowance'
					]);
					
				$this->add('em_kva1_close', 'close-div');
				$this->add('em_kva2_open', 'div', ['class' => "col-sm-6"]);

					$this->add('kva_rate', 'text', [
						'label' => 'KVA Rate'
					]);
					
				//kva close
				$this->add('em_kva2_close', 'close-div');
				
			//rates close
			$this->add('em_rates_close', 'close-div');
			
			//////////////////////////////////////////////// -- Button -- //////////////////////////////////////////////
			
			//button open
			$this->add('em_button_open', 'div', ['class' => "col-sm-12"]);
			
			$this->add('submit', 'submit', [
				'label' => 'Create Electric Meter',
				'attr' => [
					'class' => 'btn btn-success',
					'style' => 'width:100%;'
				]
			]);
			
			//button close
			$this->add('em_button_close', 'close-div');
		
		//row close
		$this->add('em_row2_close', 'close-div');
    }
	
}
