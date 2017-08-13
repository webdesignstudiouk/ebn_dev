<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Cache;
use App\Classes\Report;
use App\Classes\Table;
use DB;
use App\Models\Prospects;
use PDF;

class Reports extends Controller
{
    public function report_dispatch($type, Request $request)
    {
        return $this->$type($request);
    }

    public function reports()
    {
        $reports = array();
        $reports[] = new Report("ced_running_out", "CED Running Out");
        return view('admin.reports.reports')
            ->with('reports', $reports);
    }

    public function ced_running_out_report($request)
    {
        if($request->time == 'week'){
            $beginDate = Carbon::now()->startOfWeek();
            $endDate = Carbon::now()->startOfWeek()->addWeek(1);
        }elseif($request->time == 'month'){
            $beginDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->startOfMonth()->addMonth(1);
        }elseif($request->time == 'year'){
            $beginDate = Carbon::now()->startOfYear();
            $endDate = Carbon::now()->startOfYear()->addYear(1);
        }elseif($request->time == 'all'){
            $beginDate = Carbon::now()->subYears(50);
            $endDate = Carbon::now()->startOfYear()->addYear(50);
        }

        $model = new Prospects;
        $data = $model->select(DB::raw("*, STR_TO_DATE( verbalCED ,'%d/%m/%Y' ) as date"))->distinct()
            ->where('verbalCED', '!=', '')
            ->where('type_id', '1')
            ->where('deleted_at', null)
            ->where(DB::raw("STR_TO_DATE( verbalCED ,'%d/%m/%Y' )"), '>', $beginDate->format('Y-m-d'))
            ->where(DB::raw("STR_TO_DATE( verbalCED ,'%d/%m/%Y' )"), '<', $endDate->format('Y-m-d'))
            ->orderBy('date')
            ->get();

        //output
        if($request->view == "table"){
            return view('reports.'.$request->report_id.'.output.'.$request->view)
                ->with('data', $data)
                ->with('title', $request->report_title)
                ->with('report_beginDate', $beginDate)
                ->with('report_endDate', $endDate);
        }elseif($request->view == "pdf"){
            return PDF::loadView('reports.'.$request->report_id.'.output.pdf', [
                'pdf'=>true,
                'data'=> $data,
                'title'=>$request->report_title,
                'report_beginDate'=> $beginDate,
                'report_endDate'=> $endDate
            ])->download('ced_report.pdf');
        }

    }
}
