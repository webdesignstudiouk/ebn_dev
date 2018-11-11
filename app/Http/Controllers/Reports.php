<?php

namespace App\Http\Controllers;

use App\Models\ProspectsLoas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Cache;
use App\Classes\Report;
use DB;
use App\Models\Prospects;
use PDF;
use Response;
use Auth;
use App\Models\User;

class Reports extends Controller {

	public function report_dispatch( $type, Request $request ) {
		return $this->$type( $request );
	}

	public function reports() {
		$reports   = [];
		$reports[] = new Report( "ced_running_out", "Verbal CED Report" );
		$reports[] = new Report( "client_meter_ced", "Client Meter CED Report", 1 );
		$reports[] = new Report( "prospect_emails", "Prospect Emails" );
		//        $reports[] = new Report("prospects_by_type", "Prospect By Type");
		//        $reports[] = new Report("loa", "LOA Send/Recieve", 1);
		$reports[] = new Report( "all_loas", "LOA Management", 1 );
		$reports[] = new Report( "brochure_sent", "Brochures/Mugs Sent", 1 );

		return view( 'admin.reports.reports' )->with( 'reports', $reports );
	}

	public function prospect_emails_report( $request ) {
		ini_set( 'max_execution_time', 0 );
		if ( $request->prospect_type == '1' || $request->prospect_type == '2' | $request->prospect_type == '3' ) {
			$data = Prospects::where( 'type_id', $request->prospect_type )->where( 'email', '!=', '' )->get();
		} elseif ( $request->prospect_type == 'all' ) {
			$data = Prospects::where( 'email', '!=', '' )->get();
		}

		//output
		if ( $request->view == "table" ) {
			return view( 'reports.' . $request->report_id . '.output.' . $request->view )->with( 'data', $data )->with( 'title', $request->report_title );
		} elseif ( $request->view == "pdf" ) {
			return PDF::loadView( 'reports.' . $request->report_id . '.output.pdf', [
				'pdf'   => true,
				'data'  => $data,
				'title' => $request->report_title,
			] )->download( 'prospect_email_report.pdf' );
		} elseif ( $request->view == "csv" ) {
			$headers = [
				'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
				'Content-type'        => 'text/csv',
				'Content-Disposition' => 'attachment; filename=prospect_emails.csv',
				'Expires'             => '0',
				'Pragma'              => 'public',
			];

			$output = [];

			foreach ( $data as $d ) {
				$output[] = [ 'emaill' => $d->email ];
			}

			$data = $output;

			# add headers for each column in the CSV download
			array_unshift( $data, array_keys( $data[0] ) );

			$callback = function () use ( $data ) {
				$FH = fopen( 'php://output', 'w' );
				foreach ( $data as $row ) {
					fputcsv( $FH, $row );
				}
				fclose( $FH );
			};

			return Response::stream( $callback, 200, $headers );
		}
	}

	public function client_meter_ced_report( $request ) {
		$data   = [];
		$counts = [];

		// Date filters - from
		if ( $request->prospect_type == 'all' ) {
			$prospect_type = false;
		} else {
			$prospect_type = $request->prospect_type;
		}

		$agent_to_filter = $request->agent;
		$users           = ( new User() )->all();

		// Counts
		$counts['traffic_lights'] = [
			'danger'  => [
				'description' => 'Under 12 Month',
				'meters'      => [],
			],
			'warning' => [
				'description' => 'Between 12 - 18 Months',
				'meters'      => [],
			],
			'success' => [
				'description' => 'Later than 18 Months',
				'meters'      => [],
			],
		];

		// Prospect type
		$prospects = new Prospects();
		if ( $prospect_type ) {
			$prospects = $prospects->where( 'type_id', $prospect_type );
		} else {
			$prospects = $prospects->where( 'type_id', '!=', 1 );
		}

		$prospects = $prospects->get();


		/**
		 * Loop through each prospect, collate ced info and create a
		 * result array to pass to view
		 */
		foreach ( $prospects as $prospect ) {
			if ( $agent_to_filter == $prospect->user->id || $agent_to_filter == 'all' ) {
				if ( isset( $prospect->user->first_name ) ) {
					// User Data
					$agent_name = $prospect->user->first_name . ' ' . $prospect->user->second_name;

					// Site Data
					foreach ( $prospect->sites as $site ) {
						// Electric Meters
						foreach ( $site->electricMeters as $electric_meter ) {
							$ced             = Carbon::parse( $electric_meter->contractEndDate );
							$ced_diff_months = $ced->diffInMonths( Carbon::now() );
							$ced_diff_days   = $ced->diffInDays( Carbon::now() );
							if ( $ced_diff_months < 12 ) {
								$traffic_light = 'danger';
							} elseif ( $ced_diff_months >= 12 && $ced_diff_months <= 18 ) {
								$traffic_light = 'warning';
							} else {
								$traffic_light = 'success';
							}

							// Add traffic lights
							$counts['traffic_lights'][ $traffic_light ]['meters'][] = $prospect->id;

							$data[] = [
								'id'                => $electric_meter->id,
								'type'              => 'electric',
								'agent'             => $agent_name,
								'company'           => $prospect->company,
								'meter_no'          => $electric_meter->mpan_1 . ' ' . $electric_meter->mpan_2 . ' ' . $electric_meter->mpan_3 . ' ' . $electric_meter->mpan_4 . ' '
								                       . $electric_meter->mpan_5 . ' ' . $electric_meter->mpan_6 . ' ' . $electric_meter->mpan_7,
								'ced_is_past'       => $ced->isPast(),
								'ced_is_today'      => $ced->isToday(),
								'ced'               => $ced->format( 'd/m/Y' ),
								'ced_diff_in_days'  => $ced_diff_days,
								'ced_traffic_light' => $traffic_light,
							];
						}

						// Gas Meters
						foreach ( $site->gasMeters as $gas_meter ) {
							$ced             = Carbon::parse( $gas_meter->contractEndDate );
							$ced_diff_months = $ced->diffInMonths( Carbon::now() );
							$ced_diff_days   = $ced->diffInDays( Carbon::now() );
							if ( $ced_diff_months < 12 ) {
								$traffic_light = 'danger';
							} elseif ( $ced_diff_months >= 12 && $ced_diff_months <= 18 ) {
								$traffic_light = 'warning';
							} else {
								$traffic_light = 'success';
							}

							// Add traffic lights
							$counts['traffic_lights'][ $traffic_light ]['meters'][] = $prospect->id;

							$data[] = [
								'id'                => $gas_meter->id,
								'type'              => 'gas',
								'agent'             => $agent_name,
								'company'           => $prospect->company,
								'meter_no'          => $gas_meter->mprn,
								'ced_is_past'       => $ced->isPast(),
								'ced_is_today'      => $ced->isToday(),
								'ced'               => $ced->format( 'd/m/Y' ),
								'ced_diff_in_days'  => $ced_diff_days,
								'ced_traffic_light' => $traffic_light,
							];
						}
					}
				}
			}
		}

		return view( 'reports.' . $request->report_id . '.output.table' )->with( 'data', $data )->with( 'title', 'Client Meter CED Report' )->with( 'counts', $counts )
		                                                                 ->with( 'is_report', true );
	}

	public function ced_running_out_report( $request ) {
		$is_admin = true;
		$report   = true;
		$data     = [];
		$title    = 'Verbal CED Report';

		// Date filters - from
		if ( $request->prospect_type == 'all' ) {
			$prospect_type = '!=';
		} else {
			$prospect_type = $request->prospect_type;
		}

		// Date filters - from
		if ( $request->from == '' ) {
			$beginDate = Carbon::now()->subYears( 50 );
		} else {
			$beginDate = Carbon::parse( $request->from );
		}

		// Date filters - to
		if ( $request->to == '' ) {
			$endDate = Carbon::now()->startOfYear()->addYear( 50 );
		} else {
			$endDate = Carbon::parse( $request->to );
		}

		$agent_to_filter = $request->agent;
		$users           = ( new User() )->all();

		$model     = new Prospects;
		$prospects = $model->select( DB::raw( "*, STR_TO_DATE( verbalCED ,'%d/%m/%Y' ) as date" ) )->distinct()->where( 'verbalCED', '!=', '' )
		                   ->where( 'type_id', $prospect_type, ( $prospect_type == '!=' ? '100' : '' ) )->where( 'deleted_at', null )
		                   ->where( DB::raw( "STR_TO_DATE( verbalCED ,'%d/%m/%Y' )" ), '>', $beginDate->format( 'Y-m-d' ) )
		                   ->where( DB::raw( "STR_TO_DATE( verbalCED ,'%d/%m/%Y' )" ), '<', $endDate->format( 'Y-m-d' ) )->orderBy( 'date' );

		if ( $agent_to_filter != 'all' ) {
			$prospects = $prospects->where( 'user_id', $agent_to_filter );
		}

		$prospects = $prospects->get();
		$counts    = [
			'users' => [],
		];

		/**
		 * Add user to counts array and create an array to store
		 * prospect id's to for each user
		 */
		foreach ( $users as $user ) {
			$counts['users'][ $user->first_name . ' ' . $user->second_name ] = [];
		}

		$counts['traffic_lights'] = [
			'danger'  => [
				'description' => 'Under 12 Month',
				'prospects'   => [],
			],
			'warning' => [
				'description' => 'Between 12 - 18 Months',
				'prospects'   => [],
			],
			'success' => [
				'description' => 'Later than 18 Months',
				'prospects'   => [],
			],
		];

		/**
		 * Loop through each prospect, collate ced info and create a
		 * result array to pass to view
		 */
		foreach ( $prospects as $prospect ) {
			$agent_name = $prospect->user->first_name . ' ' . $prospect->user->second_name;

			$verbal_ced_date        = \Carbon\Carbon::createFromFormat( 'd/m/Y', $prospect->verbalCED );
			$verbal_ced_diff_months = $verbal_ced_date->diffInMonths( \Carbon\Carbon::now() );
			$verbal_ced_diff_days   = $verbal_ced_date->diffInDays( \Carbon\Carbon::now() );
			if ( $verbal_ced_diff_months < 12 ) {
				$traffic_light = 'danger';
			} elseif ( $verbal_ced_diff_months >= 12 && $verbal_ced_diff_months <= 18 ) {
				$traffic_light = 'warning';
			} else {
				$traffic_light = 'success';
			}

			// Add traffic lights
			if ( $prospect->user->id == Auth::user()->id || ( $is_admin && $report ) ) {
				$counts['traffic_lights'][ $traffic_light ]['prospects'][] = $prospect->id;
			}

			$user_data = [
				'id'                       => $prospect->id,
				'company'                  => $prospect->company,
				'name'                     => $prospect->first_name . ' ' . $prospect->second_name,
				'agent'                    => $agent_name,
				'verbal_ced_is_past'       => $verbal_ced_date->isPast(),
				'verbal_ced_is_today'      => $verbal_ced_date->isToday(),
				'verbal_ced'               => $verbal_ced_date->format( 'd/m/Y' ),
				'verbal_ced_diff_in_days'  => $verbal_ced_diff_days,
				'verbal_ced_traffic_light' => $traffic_light,
			];

			// Add to agent count
			$counts['users'][ $agent_name ][] = $prospect->id;
			$data[]                           = $user_data;

		}

		//output
		if ( $request->view == 'table' ) {
			return view( 'ceds.report' )->with( 'counts', $counts )->with( 'data', $data )->with( 'is_report', $report )->with( 'title', $title )
			                            ->with( 'report_beginDate', $beginDate )->with( 'report_endDate', $endDate );
		} elseif ( $request->view == 'pdf' ) {
			return PDF::loadView( 'ceds.report', [
				'pdf'              => true,
				'counts'           => $counts,
				'data'             => $data,
				'is_report'        => true,
				'title'            => $title,
				'report_beginDate' => $beginDate,
				'report_endDate'   => $endDate,
			] )->download( 'ced_report.pdf' );
		}
	}

	public function prospects_by_type_report( $request ) {

	}

	public function brochure_sent_report( $request ) {
		$type = $request->type;
		if ( $type == 'brochure_request' ) {
			$data = Prospects::where( $request->type, '1' );
			$data->where( 'brochure_sent', null );
		} else {
			$data = Prospects::where( $request->type, '1' );
		}

		//		if($request->agent != 'all'){
		//			$data->where('user_id', $request->agent);
		//		}

		$data = $data->get();

		//		dd($request, $data);

		return view( 'reports.' . $request->report_id . '.output.' . $request->view )->with( 'data', $data )->with( 'title', $request->report_title )->with( 'type', $type );
	}

	public function all_loas_report( $request ) {
		$loas = new ProspectsLoas();
		if ( $request->agent != 'all' ) {
			$loas = $loas->with( 'prospect' )->where( 'author_id', $request->agent );
		} else {
			$loas = $loas->with( 'prospect' );
		}

		if ( $request->won_filter != 'all' ) {
			if ( $request->won_filter == 'open' ) {
				$loas = $loas->where( 'loa_won', $request->won_filter )->orWhere( 'loa_won', null );
			} else {
				$loas = $loas->where( 'loa_won', $request->won_filter );
			}
		}

		$loas = $loas->get();

		$data    = [];
		$loa_ids = [];
		foreach ( $loas as $l ) {
			$prospect = Prospects::find( $l->prospect_id );
			if ( isset( $prospect->id ) && ! in_array( $prospect->id, $loa_ids ) && $l->active == 1 ) {
				$l->prospect_r = $prospect;
				$data[]        = $l;
				$loa_ids[]     = $prospect->id;
			}
		}

		if ( $request->agent != 'all' ) {
			$prospects = Prospects::where( 'user_id', $request->agent )->get();
		} else {
			$prospects = Prospects::where( 'user_id', Auth::user()->id )->get();
		}
		foreach ( $prospects as $p ) {
			if ( isset( $p->loa_sent ) && $p->loa_sent == 1 && ! in_array( $p->id, $loa_ids ) ) {
				$p->prospect_r    = $p;
				$p->not_from_loas = true;
				if ( $request->won_filter == 'all' ) {
					$data[] = $p;
				} else {
					if ( $request->won_filter == 'open' ) {
						$data[] = $p;
					}
				}
			}
		}

		$data = collect( $data );

		if ( $request->view == "table" ) {
			return view( 'reports.' . $request->report_id . '.output.table' )->with( 'data', $data )->with( 'title', $request->report_title );
		} elseif ( $request->view == "pdf" ) {
			return PDF::loadView( 'reports.' . $request->report_id . '.output.pdf', [
				'pdf'   => true,
				'data'  => $data,
				'title' => $request->report_title,
			] )->download( 'loa_report.pdf' );
		}
	}

	public function loa_report( $request ) {
		$results = Prospects::where( 'id', '!=', '' );

		if ( $request->type == 1 ) {
			$results->where( 'type_id', 1 );
		}

		if ( $request->type == 2 ) {
			$results->where( 'type_id', 2 );
		}

		if ( $request->type == 3 ) {
			$results->where( 'type_id', 3 );
		}

		if ( $request->loa_recieved == 1 ) {
			$results->where( 'loa_recieved', 1 );
		}

		if ( $request->loa_business_won == 1 ) {
			$results->where( 'loa_business_won', 1 );
		}

		if ( $request->loa_business_lost == 1 ) {
			$results->where( 'loa_business_lost', 1 );
		}

		if ( $request->loa_pending == 1 ) {
			$results->where( 'loa_pending', 1 );
		}

		$data = $results->get();

		//output
		if ( $request->view == "table" ) {
			return view( 'reports.' . $request->report_id . '.output.' . $request->view )->with( 'data', $data )->with( 'title', $request->report_title );
		} elseif ( $request->view == "pdf" ) {
			return PDF::loadView( 'reports.' . $request->report_id . '.output.pdf', [
				'pdf'   => true,
				'data'  => $data,
				'title' => $request->report_title,
			] )->download( 'loa_report.pdf' );
		}


	}
}