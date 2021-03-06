<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Prospects;
use App\Models\ProspectsLoas;
use App\Models\Contacts;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Excel;
use Input;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class ProspectsUpload extends Controller {
	protected $log;

	public function __construct() {
		$this->log = new Logger( 'process-prospects' );
		$this->log->pushHandler( new StreamHandler( storage_path( 'logs/process-prospects.log' ), Logger::INFO ) );
	}

	public function update( Request $request ) {
		$path = $request->file( 'avatar' )->store( 'avatars' );

		return $path;
	}

	public function delete_file( Request $request ) {
		$prospect_model = new Prospects();
		$prospect = $prospect_model->find($request->prospect_id);
		$file_type = $request->file_type;
		$file_name = $request->file_name;
		Storage::delete( '/public/prospects/' . $prospect->id . '/' . $file_type . '/' . $file_name );

		flash( 'Prospect Document Deleted', 'success' );
		return back()->withInput( [ 'tab' => 'uploads' ] );
	}

	public function update_loa( Request $request ) {
		$loa_model = new ProspectsLoas;
		$loa_upload = $loa_model->find($request->id);
		$loa_upload->supplier_confirmed_ced = $request->supplier_confirmed_ced;
		$loa_upload->sent = $request->sent;
		$loa_upload->recieved = $request->recieved;
		$loa_upload->loa_won = $request->loa_won;
		$loa_upload->save();
		return back();
	}

	public function delete( $prospect_id, $loa_id ) {
		$loa_model = ProspectsLoas::find($loa_id);
		$loa_model->delete();
		return back();
	}

	public function store_loa( Request $request ) {
		$prospect_model = new Prospects();
		$prospect = $prospect_model->find($request->prospect_id);

		$loa_upload = new ProspectsLoas;
		$loa_upload->author_id = Auth::user()->id;
		$loa_upload->prospect_id = $prospect->id;
		$loa_upload->active = 1;

		if($prospect->loa_sent != '' && Carbon::parse($prospect->loa_sent_date)){
			$loa_upload->sent = Carbon::parse($prospect->loa_sent_date)->format('Y-m-d H:i:s');
		}else{
			$loa_upload->sent = Carbon::now();
		}

		//if file type empty
		if ( $request->file( 'file' ) == null ) {
			flash( 'Please include a file.', 'danger' );
			return back();
		} else {
			$file_name = $request->file( 'file' )->getClientOriginalName();
		}

		$loa_upload->file = $file_name;

		//upload file
		$request->file( 'file' )->storeAs(
			'/public/prospects/' . $prospect->id . '/loa/',
			$file_name
		);

		// Archive old loas
		if(isset($prospect->current_loa) && $prospect->current_loa != null){
			$prospect->current_loa->active = 0;
			$prospect->current_loa->save();
		}

		// Set prospect loa_sent to 0
		$prospect->loa_sent = 0;
		$prospect->save();

		$loa_upload->save();
		return back();
	}

	public function store_file( Request $request ) {
		$prospect  = $request->prospect_id;
		$file_type = $request->file_type;

		//if prospect empty
		if ( $prospect == "" ) {
			flash( 'No prospect defined.', 'danger' );

			return back()->withInput( [ 'tab' => 'uploads' ] );
		}

		//if file type empty
		if ( $file_type == "" ) {
			flash( 'Please select document type.', 'danger' );

			return back()->withInput( [ 'tab' => 'uploads' ] );
		}

		//if file type empty
		if ( $request->file( 'file' ) == null ) {
			flash( 'Please include a file.', 'danger' );

			return back()->withInput( [ 'tab' => 'uploads' ] );
		} else {
			$file_name = $request->file( 'file' )->getClientOriginalName();
		}

		//upload file
		$path = $request->file( 'file' )->storeAs(
			'/public/prospects/' . $prospect . '/' . $file_type . '/',
			$file_name
		);

		return back()->withInput( [ 'tab' => 'uploads' ] );
	}

	public function processProspectsView() {
		return view( 'admin.processProspects.processProspects' );
	}

	public function processProspects( Request $request ) {
		ini_set( 'max_execution_time', 0 );
		if ( $request->file( 'prospects' ) == null ) {
			flash( 'Please select a file', 'warning' );

			return back();
		} else {
			if ( $request->campaign_id == null || $request->campaign_id == 0 ) {
				flash( 'Please select a campaign', 'warning' );

				return back();
			} else {
				if ( $request->type == null || $request->type == 0 ) {
					flash( 'Please select a type', 'warning' );

					return back();
				} else {
					$file            = $request->file( 'prospects' );
					$file_path       = $file->getPathName();
					$data            = Excel::load( $file_path, function ( $reader ) {
					} )->get();
					$count           = 0;
					$countDuplicates = 0;
					foreach ( $data as $d ) {
						if ( Prospects::where( 'company', $d->company )->count() == 0 ) {
							$prospect               = new Prospects;
							$prospect->user_id      = 100;
							$prospect->type_id      = 1;
							$prospect->campaign_id  = $request->campaign_id;
							$prospect->lead_type    = $request->type;
							$prospect->company      = $d->company;
							$phone_number           = str_replace( '-', '', $d->phonenumber );
							$prospect->phonenumber  = (string) $phone_number;
							$prospect->businessType = $d->business_type;
							$prospect->url          = $d->url;
							$prospect->email        = $d->email;
							$prospect->street_1     = $d->street_1;
							$prospect->street_2     = $d->street_2;
							$prospect->town         = $d->town;
							$prospect->city         = $d->city;
							$prospect->postcode     = $d->postcode;
							$prospect->subscribed   = 1;
							$prospect->lead_source  = 2;
							$prospect->save();
							$this->log->info( 'Added a prospect', array( 'user'     => Auth::user()->id,
							                                             'prospect' => $prospect
							) );

							$contact              = new Contacts;
							$contact->author_id   = Auth::user()->id;
							$contact->prospect_id = $prospect->id;
							$contact->favourite   = 1;
							$contact->type_id     = 1;
							$contact->title       = $d->title;
							$contact->job_title   = $d->job_title;
							$contact->first_name  = $d->first_name;
							$contact->second_name = $d->second_name;
							$contact->email       = $d->email;
							$contact->phonenumber = $phone_number;
//							$contact->mobile_number = (string)((int)$d->mobile_number);
							$contact->save();
							$this->log->info( 'Added a contact', array( 'user'    => Auth::user()->id,
							                                            'contact' => $contact
							) );

							$count = $count + 1;
						} else {
							$prospect_1 = Prospects::where( 'company', $d->company )->first();
							if ( $request->type == 2 && $prospect_1->lead_type == 2 ) {
								$prospect_1->click_count = $prospect_1->click_count + 1;
							}

							if ( $request->type == 2 && $prospect_1->lead_type != 2 ) {
								$prospect_1->lead_type = 2;
							}

							$prospect_1->save();
							$this->log->info( 'Duplicate prospect', array( 'user'     => Auth::user()->id,
							                                               'prospect' => $d
							) );
							$countDuplicates = $countDuplicates + 1;
						}
					}

					flash( 'Added ' . $count . ' prospects to the database. (Request Pot) and ' . $countDuplicates . ' duplicates where found.', 'info' );

					return redirect()->route( 'prospects.request' );
				}
			}
		}
	}
}
