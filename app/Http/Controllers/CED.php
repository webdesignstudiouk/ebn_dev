<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Prospects;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use App\Models\User;
use Carbon\Carbon;
use Input;
use Charts;
use DB;
use App\Models\ElectricMeters;
use App\Models\GasMeters;

class CED extends Controller {

	use FormBuilderTrait;

	protected $prospects;

	public function __construct() {
		$this->prospects = new Prospects;
	}

	public function timeline( $prospect_type ) {
		$prospectModal = new Prospects;
		$prospects     = $this->prospects->all();
		$prospect_type = \App\Models\ProspectsTypes::find( $prospect_type );

		return view( 'ceds.timeline' )->with( 'prospects', $prospects )->with( 'prospect_type', $prospect_type )->with( 'prospectModal', $prospectModal );
	}

	public function local_report() {
		return $this->report( 1, true );
	}

	public function report( $prospect_type = 1, $report = false ) {
		// If report is true, return a full report with all data for that user/admin
		if ( $report ) {
			$prospect_type = '!=';
		}

		// Permissions
		if ( Auth::check() && Auth::user()->hasRole( 'admin' ) ) {
			$is_admin = true;
			$title = 'Admin Verbal CED Report';
		} else {
			$is_admin = false;
			$title = 'Agent Verbal CED Report';
		}

		$data  = [];
		$users = ( new User() )->all();

		$beginDate = Carbon::now()->subYears( 50 );
		$endDate   = Carbon::now()->startOfYear()->addYear( 50 );

		$model     = new Prospects;
		$prospects = $model->select( DB::raw( "*, STR_TO_DATE( verbalCED ,'%d/%m/%Y' ) as date" ) )->distinct()->where( 'verbalCED', '!=', '' )
		                   ->where( 'type_id', $prospect_type, ( $report ? '100' : '' ) )->where( 'deleted_at', null )
		                   ->where( DB::raw( "STR_TO_DATE( verbalCED ,'%d/%m/%Y' )" ), '>', $beginDate->format( 'Y-m-d' ) )
		                   ->where( DB::raw( "STR_TO_DATE( verbalCED ,'%d/%m/%Y' )" ), '<', $endDate->format( 'Y-m-d' ) )->orderBy( 'date' )->get();

		$counts = [
			'users' => [],
		];

		/**
		 * Add user to counts array and create an array to store
		 * prospect id's to for each user
		 */
		foreach ( $users as $user ) {
			$counts['users'][ $user->first_name . ' ' . $user->second_name ] = [];
			$counts['traffic_lights']                                        = [
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
		}

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

			// Add user data to all data
			if ( $prospect->user->id == Auth::user()->id || ( $is_admin && $report ) ) {
				// Add to agent count
				$counts['users'][ $agent_name ][] = $prospect->id;

				$data[] = $user_data;
			}
		}

		//output
		return view( 'ceds.report' )->with( 'counts', $counts )->with( 'data', $data )->with( 'is_report', $report )->with( 'title', $title )
		                            ->with( 'report_beginDate', $beginDate )->with( 'report_endDate', $endDate );
	}


	public function timeline1( Request $request, $prospectType = '1', $meterType = '' ) {
		if ( $request->input( 'beginDate' ) != null && $request->input( 'beginDate' ) != 'undefined' ) {
			$beginDate = Carbon::createFromFormat( 'd/m/Y', $request->input( 'beginDate' ) )->toDateString();
		} else {
			$beginDate = Carbon::now()->toDateString();
		}


		if ( $request->input( 'endDate' ) != null ) {
			$endDate = Carbon::createFromFormat( 'd/m/Y', $request->input( 'endDate' ) )->toDateString();
		} else {
			$endDate = Carbon::now()->startOfYear()->addYears( 1 )->toDateString();
		}

		if ( $prospectType == '1' ) {
			$model = new Prospects;
			$dates = $model->select( DB::raw( "*, STR_TO_DATE( verbalCED ,'%d/%m/%Y' ) as date" ) )->distinct()->where( 'verbalCED', '!=', '' )->where( 'type_id', '1' )
			               ->where( 'user_id', Auth::user()->id )->where( 'deleted_at', null )->orderBy( 'date' )->get();
			//                     ->paginate(10);
		}

		if ( $prospectType == '2' || $prospectType == '3' ) {
			if ( $meterType == 'electric' ) {
				$model = new ElectricMeters();
				$dates = $model->select( DB::raw( "prospects.id as prospectId, 
                    sites.id as siteId, 
                    prospects.company as prospectCompany, 
                    sites_electricMeters.id as meterId, 
                    sites_electricMeters.contractEndDate, 
                    STR_TO_DATE( sites_electricMeters.contractEndDate ,'%Y-%m-%d' ) as date" ) )->distinct()->join( 'sites', 'sites.id', 'sites_electricMeters.site_id' )
				               ->join( 'prospects', 'prospects.id', 'sites.prospect_id' )->where( 'sites_electricMeters.contractEndDate', '!=', '' )
				               ->where( 'prospects.user_id', Auth::user()->id )->where( 'prospects.type_id', $prospectType )->where( 'prospects.deleted_at', null )
				               ->orderBy( 'date' )->get();
				//                    ->paginate(10, 'sites_electricMeters');
			} elseif ( $meterType == 'gas' ) {
				$model = new GasMeters();
				$dates = $model->select( DB::raw( "prospects.id as prospectId, 
                    sites.id as siteId, 
                    prospects.company as prospectCompany, 
                    sites_gasMeters.id as meterId, 
                    sites_gasMeters.contractEndDate, 
                    STR_TO_DATE( sites_gasMeters.contractEndDate ,'%Y-%m-%d' ) as date" ) )->distinct()->join( 'sites', 'sites.id', 'sites_gasMeters.site_id' )
				               ->join( 'prospects', 'prospects.id', 'sites.prospect_id' )->where( 'sites_gasMeters.contractEndDate', '!=', '' )
				               ->where( 'prospects.user_id', Auth::user()->id )->where( 'prospects.type_id', $prospectType )->where( 'prospects.deleted_at', null )
				               ->orderBy( 'date' )->get();
				//                    ->paginate(10, 'sites_gasMeters');
			}

		}

		$prospects = $this->prospects->all();

		return view( 'ceds.ced.ced_graph' )->with( 'beginDate', $beginDate )->with( 'endDate', $endDate )->with( 'prospects', $prospects )->with( 'model', $model )
		                                   ->with( 'dates', $dates )->with( 'prospectType', $prospectType )->with( 'meterType', $meterType );
	}
}
