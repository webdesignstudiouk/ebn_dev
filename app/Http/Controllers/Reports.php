<?php

namespace App\Http\Controllers;

use App\Models\ProspectsLoas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Cache;
use App\Classes\Report;
use App\Classes\Table;
use DB;
use App\Models\Prospects;
use PDF;
use Response;

class Reports extends Controller {
	public function report_dispatch( $type, Request $request ) {
		return $this->$type( $request );
	}

	public function reports() {
		$reports   = array();
		$reports[] = new Report( "ced_running_out", "CED Running Out" );
		$reports[] = new Report( "prospect_emails", "Prospect Emails" );
//        $reports[] = new Report("prospects_by_type", "Prospect By Type");
//        $reports[] = new Report("loa", "LOA Send/Recieve", 1);
		$reports[] = new Report( "all_loas", "LOA Management", 1 );
		$reports[] = new Report( "brochure_sent", "Brochures/Mugs Sent", 1 );

		return view( 'admin.reports.reports' )
			->with( 'reports', $reports );
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
			return view( 'reports.' . $request->report_id . '.output.' . $request->view )
				->with( 'data', $data )
				->with( 'title', $request->report_title );
		} elseif ( $request->view == "pdf" ) {
			return PDF::loadView( 'reports.' . $request->report_id . '.output.pdf', [
				'pdf'   => true,
				'data'  => $data,
				'title' => $request->report_title
			] )->download( 'prospect_email_report.pdf' );
		} elseif ( $request->view == "csv" ) {
			$headers = [
				'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
				,
				'Content-type'        => 'text/csv'
				,
				'Content-Disposition' => 'attachment; filename=prospect_emails.csv'
				,
				'Expires'             => '0'
				,
				'Pragma'              => 'public'
			];

			$output = array();

			foreach ( $data as $d ) {
				$output[] = array( 'emaill' => $d->email );
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

	public function ced_running_out_report( $request ) {
		ini_set( 'max_execution_time', 0 );
		if ( $request->time == 'week' ) {
			$beginDate = Carbon::now()->startOfWeek();
			$endDate   = Carbon::now()->startOfWeek()->addWeek( 1 );
		} elseif ( $request->time == 'month' ) {
			$beginDate = Carbon::now()->startOfMonth();
			$endDate   = Carbon::now()->startOfMonth()->addMonth( 1 );
		} elseif ( $request->time == 'year' ) {
			$beginDate = Carbon::now()->startOfYear();
			$endDate   = Carbon::now()->startOfYear()->addYear( 1 );
		} elseif ( $request->time == 'all' ) {
			$beginDate = Carbon::now()->subYears( 50 );
			$endDate   = Carbon::now()->startOfYear()->addYear( 50 );
		}

		$model = new Prospects;
		$data  = $model->select( DB::raw( "*, STR_TO_DATE( verbalCED ,'%d/%m/%Y' ) as date" ) )->distinct()
		               ->where( 'verbalCED', '!=', '' )
		               ->where( 'type_id', '1' )
		               ->where( 'deleted_at', null )
		               ->where( DB::raw( "STR_TO_DATE( verbalCED ,'%d/%m/%Y' )" ), '>', $beginDate->format( 'Y-m-d' ) )
		               ->where( DB::raw( "STR_TO_DATE( verbalCED ,'%d/%m/%Y' )" ), '<', $endDate->format( 'Y-m-d' ) )
		               ->orderBy( 'date' )
		               ->get();

		//output
		if ( $request->view == "table" ) {
			return view( 'reports.' . $request->report_id . '.output.' . $request->view )
				->with( 'data', $data )
				->with( 'title', $request->report_title )
				->with( 'report_beginDate', $beginDate )
				->with( 'report_endDate', $endDate );
		} elseif ( $request->view == "pdf" ) {
			return PDF::loadView( 'reports.' . $request->report_id . '.output.pdf', [
				'pdf'              => true,
				'data'             => $data,
				'title'            => $request->report_title,
				'report_beginDate' => $beginDate,
				'report_endDate'   => $endDate
			] )->download( 'ced_report.pdf' );
		}

	}

	public function prospects_by_type_report( $request ) {

	}

	public function brochure_sent_report( $request ) {
		$type = $request->type;
		if($type == 'brochure_request'){
			$data = Prospects::where($request->type, '1')->where('brochure_sent', '!=', '1');
		}else{
			$data = Prospects::where($request->type, '1');
		}

		if($request->agent != 'all'){
			$data->where('user_id', $request->agent);
		}

		$data = $data->get();

		return view( 'reports.' . $request->report_id . '.output.' . $request->view )
				->with( 'data', $data )
				->with( 'title', $request->report_title )
				->with( 'type', $type );
	}

	public function all_loas_report( $request ) {
		$loas = ProspectsLoas::with('prospect')->get();
		$data = array();
		foreach($loas as $l) {
			$prospect = \App\Models\Prospects::find( $l->prospect_id );
			if ( isset( $prospect->id ) ) {
				$l->prospect_r = $prospect;
				$data[]        = $l;
			}
		}

		$data = collect($data);

		if ( $request->view == "table" ) {
			return view( 'reports.' . $request->report_id . '.output.' . $request->view )
				->with( 'data', $data )
				->with( 'title', $request->report_title );
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
			return view( 'reports.' . $request->report_id . '.output.' . $request->view )
				->with( 'data', $data )
				->with( 'title', $request->report_title );
		} elseif ( $request->view == "pdf" ) {
			return PDF::loadView( 'reports.' . $request->report_id . '.output.pdf', [
				'pdf'   => true,
				'data'  => $data,
				'title' => $request->report_title
			] )->download( 'loa_report.pdf' );
		}


	}
}
