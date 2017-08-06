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

class CED extends Controller
{
	use FormBuilderTrait;

	protected $prospects;

	public function __construct()
	{
		$this->prospects = new Prospects;
	}
	
	public function timeline(Request $request, $prospectType='1', $meterType='')
	{
        if($request->input('beginDate') != null && $request->input('beginDate') != 'undefined'){
            $beginDate = Carbon::createFromFormat('d/m/Y', $request->input('beginDate'))->toDateString();
        }else{
            $beginDate = Carbon::now()->toDateString();
        }


        if($request->input('endDate') != null){
            $endDate = Carbon::createFromFormat('d/m/Y', $request->input('endDate'))->toDateString();
        }else{
            $endDate = Carbon::now()->addYears(1)->toDateString();
        }

		if($prospectType == '1'){
            $model = new Prospects;
            $dates = $model->select(DB::raw("*, STR_TO_DATE( verbalCED ,'%d/%m/%Y' ) as date"))->distinct()
                     ->where('verbalCED', '!=', '')
                     ->where('type_id', '1')
                     ->where('user_id', Auth::user()->id)
                     ->where('deleted_at', null)
                     ->orderBy('date')
                     ->get();
//                     ->paginate(10);
        }

        if($prospectType == '2' || $prospectType == '3'){
		    if($meterType == 'electric') {
                $model = new ElectricMeters();
                $dates = $model->select(DB::raw("prospects.id as prospectId, 
                    sites.id as siteId, 
                    prospects.company as prospectCompany, 
                    sites_electricMeters.id as meterId, 
                    sites_electricMeters.contractEndDate, 
                    STR_TO_DATE( sites_electricMeters.contractEndDate ,'%Y-%m-%d' ) as date"))->distinct()
                    ->join('sites', 'sites.id', 'sites_electricMeters.site_id')
                    ->join('prospects', 'prospects.id', 'sites.prospect_id')
                    ->where('sites_electricMeters.contractEndDate', '!=', '')
                    ->where('prospects.user_id', Auth::user()->id)
                    ->where('prospects.type_id', $prospectType)
                    ->where('prospects.deleted_at', null)
                    ->orderBy('date')
                    ->get();
//                    ->paginate(10, 'sites_electricMeters');
            }elseif($meterType == 'gas'){
                $model = new GasMeters();
                $dates = $model->select(DB::raw("prospects.id as prospectId, 
                    sites.id as siteId, 
                    prospects.company as prospectCompany, 
                    sites_gasMeters.id as meterId, 
                    sites_gasMeters.contractEndDate, 
                    STR_TO_DATE( sites_gasMeters.contractEndDate ,'%Y-%m-%d' ) as date"))->distinct()
                    ->join('sites', 'sites.id', 'sites_gasMeters.site_id')
                    ->join('prospects', 'prospects.id', 'sites.prospect_id')
                    ->where('sites_gasMeters.contractEndDate', '!=', '')
                    ->where('prospects.user_id', Auth::user()->id)
                    ->where('prospects.type_id', $prospectType)
                    ->where('prospects.deleted_at', null)
                    ->orderBy('date')
                    ->get();
//                    ->paginate(10, 'sites_gasMeters');
            }

        }

		$prospects = $this->prospects->all();
		return view('ceds.ced.ced_graph')
            ->with('beginDate', $beginDate)
            ->with('endDate', $endDate)
            ->with('prospects', $prospects)
            ->with('model', $model)
            ->with('dates', $dates)
            ->with('prospectType', $prospectType)
            ->with('meterType', $meterType);
	}
}
