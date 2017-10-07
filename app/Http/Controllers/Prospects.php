<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Prospects as EBNProspects;
use Illuminate\Http\Request;
use Input;
use Log;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\ProspectsSources;
use App\Models\ProspectsSourcesCampaigns;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Cache;

class Prospects extends Controller
{
	protected $prospects;

	public function __construct()
	{
		$this->prospects = new EBNProspects;
	}

	/**
	* Display prospects.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index(Request $request)
	{
		$prospects = $this->prospects->where('type_id', '1')->where('request_delete', '!=', 1)->orderBy('company','asc')->where('user_id', Auth::user()->id)->paginate(200);
		if($request->session()->has('newly_requested_prospect')){
			return view('prospects.prospects')
			->with('prospects', $prospects)
			->with('title', 'Prospects')
			->with('newly_requested_prospect', session('newly_requested_prospect'));
		}else{
			return view('prospects.prospects')
			->with('prospects', $prospects)
			->with('title', 'Prospects');
		}
	}

	/**
	* Display prospects v2.
	*
	* @return \Illuminate\Http\Response
	*/
	public function prospects_2()
	{
		$prospects = $this->prospects->where('type_id', '2')->where('request_delete', '!=', 1)->where('user_id', Auth::user()->id)->orderBy('company','asc')->paginate(200);
		return view('prospects.prospects')
		->with('prospects', $prospects)
		->with('title', 'Prospects 2');
	}

	/**
	* Display clients
	*
	* @return \Illuminate\Http\Response
	*/
	public function clients()
	{
		$prospects = $this->prospects->where('type_id', '3')->where('request_delete', '!=', 1)->where('user_id', Auth::user()->id)->orderBy('company','asc')->paginate(200);
		return view('prospects.prospects')
		->with('prospects', $prospects)
		->with('title', 'Clients');
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create(FormBuilder $formBuilder)
	{
		$form = $formBuilder->create(\App\Forms\Prospects\CreateProspect::class, [
			'method' => 'POST',
			'url' => route('prospects.store')
		]);

		return view('prospects.create', compact('form'));
	}

	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(FormBuilder $formBuilder, Request $request)
	{
		$form = $formBuilder->create(\App\Forms\Prospects\CreateProspect::class);

		if (!$form->isValid()) {
			return redirect()->back()->withErrors($form->getErrors())->withInput();
		}

		$prospect = new EBNProspects;
		$prospect->user_id = Auth::user()->id;
		$prospect->type_id = 1;

		if($request->campaign_id[0] != "t" && $request->campaign_id[0] != "s" && $request->campaign_id[0] != "d"){
			if($request->campaign_id != ""){
				$campaign = \App\Models\ProspectsSourcesCampaigns::find($request->campaign_id);
				$prospect->campaign_id = $campaign->id;
			}
		}else{
			flash('Please select a campaign week to put this prospect into', 'warning');
			return back();
		}

		$prospect->lead_type = $request->lead_type;
		$prospect->company = $request->company;
		$prospect->email = $request->email;
		$prospect->phonenumber = $request->phonenumber;
		$prospect->url = $request->url;
		$prospect->tradingStyle = $request->tradingStyle;
		$prospect->regNumber = $request->regNumber;
        $prospect->regCharityNumber = $request->regCharityNumber;
		$prospect->businessType = $request->businessType;
		$prospect->verbalCED = $request->verbalCED;
		$prospect->street_1 = $request->street_1;
		$prospect->street_2 = $request->street_2;
		$prospect->town = $request->town;
		$prospect->city = $request->city;
		$prospect->county = $request->county;
		$prospect->postcode = $request->postcode;
		$prospect->lead_source = $request->lead_source;
		$prospect->subscribed = $request->subscribed;
		$prospect->mug_sent = $request->mug_sent;
		$prospect->save();

        //cache
        Cache::forget('admin_prospects_count');

		flash('Prospect Created', 'success');
		return redirect()->route('prospects');

	}

	/**
	* Display the specified resource.
	*
	* @param  \App\Users  $users
	* @return \Illuminate\Http\Response
	*/
	public function show($prospect, FormBuilder $formBuilder)
	{
		$prospect = $this->prospects->find($prospect);
		dd($prospect);

		//return view('users.user', compact('form'))->with('user', $user);
	}

	/**
	* Show the form for editing the specified resource.
	*
	* @param  \App\Users  $users
	* @return \Illuminate\Http\Response
	*/
	public function edit($prospect, FormBuilder $formBuilder)
	{
		$prospect = $this->prospects->withTrashed()->find($prospect);
        $sources = ProspectsSources::all();
        $sourcesCampaigns = ProspectsSourcesCampaigns::where('source_id', $prospect->source_id)->get();

		$updateForm = $formBuilder->create(\App\Forms\Prospects\UpdateProspect::class, [
			'method' => 'POST',
			'url' => url('admin/prospects/'.$prospect->id),
			'model' => $prospect
		]);

		return view('prospects.prospect.edit')
		->with('prospect', $prospect)
		->with('sources', $sources)
		->with('sourcesCampaigns', $sourcesCampaigns)
		->with('updateForm', $updateForm);
	}

	public function callbacks($prospect, FormBuilder $formBuilder)
	{
		$prospect = $this->prospects->find($prospect);

		$createCallbackForm = $formBuilder->create(\App\Forms\Callbacks\CreateCallback::class, [
			'method' => 'POST',
			'url' => route('callbacks.store'),
			'model' => $prospect
		]);

		return view('prospects.prospect.callbacks')
		->with('prospect', $prospect)
		->with('createCallbackForm', $createCallbackForm);
	}

	public function sites($prospect)
	{
		$prospect = $this->prospects->find($prospect);

		return view('prospects.prospect.sites')
		->with('prospect', $prospect);
	}

	public function contacts($prospect, FormBuilder $formBuilder)
	{
		$prospect = $this->prospects->find($prospect);

		return view('prospects.prospect.contacts')
		->with('prospect', $prospect);
	}

    /**
     * @param $prospect
     * @param FormBuilder $formBuilder
     * @return $this
     */
    public function uploads($prospect, FormBuilder $formBuilder)
	{
		$loa_files = Storage::allFiles('/public/prospects/'.$prospect.'/loa');
		$supportingDocuments_files = Storage::allFiles('/public/prospects/'.$prospect.'/supportingDocuments');
		$signedContracts_files = Storage::allFiles('/public/prospects/'.$prospect.'/signedContracts');
		$prospect = $this->prospects->withTrashed()->find($prospect);

		$uploadFile = $formBuilder->create(\App\Forms\Prospects\UploadFile::class, [
			'method' => 'POST',
			'url' => route('store_file'),
			'model' => $prospect
		]);


		return view('prospects.prospect.uploads')
		->with('prospect', $prospect)
		->with('uploadFile', $uploadFile)
		->with('loa_files', $loa_files)
		->with('supportingDocuments_files', $supportingDocuments_files)
		->with('signedContracts_files', $signedContracts_files);
	}

    /**
     * @param $prospect
     * @param FormBuilder $formBuilder
     * @return $this
     */
    public function delete($prospect, FormBuilder $formBuilder)
	{
		$prospect = $this->prospects->find($prospect);

		$deleteForm = $formBuilder->create(\App\Forms\Prospects\DeleteProspect::class, [
			'method' => 'POST',
			'url' => url('admin/prospects/'.$prospect->id),
			'model' => $prospect
		]);

		return view('prospects.prospect.delete')
		->with('prospect', $prospect)
		->with('deleteForm', $deleteForm);
	}

	/**
	 * @param $prospect
	 * @param FormBuilder $formBuilder
	 * @return $this
	 */
	public function request_delete($prospect, FormBuilder $formBuilder)
	{
		$prospect = $this->prospects->find($prospect);

		$deleteForm = $formBuilder->create(\App\Forms\Prospects\RequestDeleteProspect::class, [
			'method' => 'POST',
			'url' => route('prospect.set_request_delete', $prospect->id),
			'model' => $prospect
		]);

		return view('prospects.prospect.request-delete')
			->with('prospect', $prospect)
			->with('deleteForm', $deleteForm);
	}

	/**
	 * @param $prospect
	 * @return $this
	 */
	public function set_request_delete($prospect, Request $request)
	{
		$prospect = $this->prospects->find($prospect);
		if($prospect){
			$prospect->request_delete = 1;
			$prospect->deleted_reason = $request->deleted_reason;
			$prospect->deleted_reason_2 = $request->deleted_reason_2;
			$prospect->save();
			flash('Requested prospect deletion', 'info');
			return redirect()->route('prospects');
		}else{
			flash('Error with requesting prospect deletion', 'danger');
			return back();
		}
	}

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function moveProspects(Request $request){
        //cache
        Cache::forget('admin_prospects_count');

	    if(!empty($request->prospectToMove)){
	        if($request->moveToUser != ""){
                foreach($request->prospectToMove as $prospect){
                    $prospectModel = \App\Models\Prospects::find($prospect);
                    $prospectModel->user_id = $request->moveToUser;
                    $prospectModel->save();
                }
                flash('Successfully moved '.count($request->prospectToMove).' prospects/clients', 'success');
                return back();
            }else{
                flash('You need to select a user to move the prospects too.', 'warning');
                return back();
            }
        }else{
            flash('You need to select prospects to move before submitting the form.', 'warning');
            return back();
        }
    }

	public function progress($prospect)
	{
		$prospect = $this->prospects->find($prospect);
		$loa_files = Storage::allFiles('/public/prospects/'.$prospect->id.'/loa');
		$supportingDocuments_files = Storage::allFiles('/public/prospects/'.$prospect->id.'/supportingDocuments');
		$signedContracts_files = Storage::allFiles('/public/prospects/'.$prospect->id.'/signedContracts');

        //cache
        Cache::forget('admin_prospects_count');

		if($prospect != null){
			if($prospect->type_id == 1){
				if(count($loa_files) > 0){
					$prospect->type_id = 2;
					$prospect->save();
					flash('This prospect has been progressed to prospect 2.', 'success');
					return back();
				}else{
					flash('This prospect does not have a loa currently uploaded. For it to progress it needs one uploaded.', 'danger');
					return back();
				}
			}elseif($prospect->type_id == 2){
				if(count($signedContracts_files) > 0){
					$prospect->type_id = 3;
					$prospect->save();
					flash('This prospect 2 has been progressed to a client.', 'success');
					return back();
				}else{
					flash('This prospect does not have a signed contract currently uploaded. For it to progress it needs one uploaded.', 'danger');
					return back();
				}
			}elseif($prospect->type_id == 3){
				flash('This current prospect is a client and cannot be progressed any further', 'warning');
				return back();
			}else{
				flash('Error', 'danger');
				return back();
			}
		}
	}

	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  \App\Users  $user
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request)
	{
		$prospect = $this->prospects->withTrashed()->find($request->id);

		if($request->campaign_id[0] != "t" && $request->campaign_id[0] != "s" && $request->campaign_id[0] != "d"){
			if($request->campaign_id != ""){
				$campaign = \App\Models\ProspectsSourcesCampaigns::find($request->campaign_id);
				$prospect->campaign_id = $campaign->id;
			}
		}else{
			flash('Please select a campaign week to put this prospect into', 'warning');
			return back();
		}

		$prospect->lead_type = $request->lead_type;
		$prospect->company = $request->company;
		$prospect->email = $request->email;
		$prospect->phonenumber = $request->phonenumber;
		$prospect->url = $request->url;
		$prospect->tradingStyle = $request->tradingStyle;
		$prospect->regNumber = $request->regNumber;
		$prospect->regCharityNumber = $request->regCharityNumber;
		$prospect->businessType = $request->businessType;
		$prospect->verbalCED = $request->verbalCED;
		$prospect->street_1 = $request->street_1;
		$prospect->street_2 = $request->street_2;
		$prospect->town = $request->town;
		$prospect->city = $request->city;
		$prospect->county = $request->county;
		$prospect->postcode = $request->postcode;
		$prospect->lead_source = $request->lead_source;
		$prospect->subscribed = $request->subscribed;
		$prospect->mug_sent = $request->mug_sent;

		if($prospect->verbalCED != '') {
		    if($request->ced_2 != '' && $request->ced_1 != '') {
                $prospect->verbalCED_notification1 = $request->ced_2;
                $prospect->verbalCED_notification2 = $request->ced_1;
            }
        }else{
            $prospect->verbalCED_notification1 = '4';
            $prospect->verbalCED_notification2 = '8';
        }
		$prospect->save();

        //cache
        Cache::forget('admin_prospects_count');

		flash('Prospect Updated', 'success');
		return back();
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param  \App\User  $user
	* @return \Illuminate\Http\Response
	*/
	public function destroy(Request $request)
	{
		$prospect = $this->prospects->find($request->id);
		$prospect->deleted_reason = $request->deleted_reason;
		$prospect->deleted_reason_2 = $request->deleted_reason_2;
		$prospect->save();
		$prospect->delete();

        //cache
        Cache::forget('admin_prospects_count');

		flash('Prospect Has Been Deleted', 'warning');

		return redirect()->route('prospects');
	}


	public function deleteProspects(Request $request)
	{
		$log = new Logger('delete_prospect');
		$log->pushHandler(new StreamHandler(storage_path('logs/prospect_deletes.log'), Logger::INFO));

		if(isset($request->delete)){
			foreach ( $request->prospectToDelete as $prospect ) {
				$prospect = $this->prospects->find($prospect);
				$prospect->delete();
			}
			$log->info('Prospects have been deleted.' , array('user' => Auth::user()->id, 'prospects' => json_encode($request->prospectToDelete)));
			flash('Prospect(s) Have Been Deleted', 'success');
		}else{
			foreach ( $request->prospectToDelete as $prospect ) {
				$prospect = $this->prospects->find($prospect);
				$prospect->request_delete = 0;
				$prospect->deleted_reason = "";
				$prospect->deleted_reason_2 = "";
				$prospect->save();
			}
			$log->info('Prospects have been sent back to agent.' , array('user' => Auth::user()->id, 'prospects' => json_encode($request->prospectToDelete)));
			flash('Prospect(s) Have Been Sent Back To Agent', 'success');
		}

		return back();
	}

	public function requestView()
	{
		$sourcesCampaigns = new ProspectsSourcesCampaigns;
		return view('prospects.request')
		->with('title', 'Request A Prospect')
		->with('sources', ProspectsSources::all())
		->with('sourcesCampaigns', $sourcesCampaigns);
	}

    public function requestAgent(Request $request)
    {
        $log = new Logger('request_prospect');
        $log->pushHandler(new StreamHandler(storage_path('logs/prospect_requests.log'), Logger::INFO));
//        $requestedProspect = $this->prospects->where('user_id','=','100')->where('campaign_id','=','22')->whereIn('lead_type', array(2,1))->take(1)->get();
        $requestedProspect = $this->prospects->where('user_id','=','100')->where('campaign_id', 26)->take(1)->get();
        if(isset($requestedProspect[0])){
	        $requestedProspect = $requestedProspect[0];
	        $log->info('Request a prospect.' , array('user' => Auth::user()->id, 'prospect' => $requestedProspect->id));
	        $requestedProspect->user_id = Auth::user()->id;
	        $requestedProspect->save();
        }else{
	        flash('Cant find a prospect to request.', 'warning');
        }

        return redirect()->route('prospects.edit', $requestedProspect->id);
    }

	public function request(Request $request)
	{
        //cache
        Cache::forget('admin_prospects_count');

		$campaignId = 0;
		$log = new Logger('request_prospect');
		$log->pushHandler(new StreamHandler(storage_path('logs/prospect_requests.log'), Logger::INFO));
		if($request->request_type == 0){ //original
            //make sure there is no callbacks assigned to the user
            $requestedProspects = $this->prospects->where('type_id','!=','2')->where('type_id','!=','3')->where('user_id','=','100')->where('lead_type','')->where('businessType', 'Care Homes')->get();
            $requestedProspect = null;
			foreach($requestedProspects as $rp){
			    if(count($rp->callbacksWithTrashed) == 0){
                    $requestedProspect = $rp;
                    break;
                }
            }

            //make sure there is no callbacks assigned to the user
			if($requestedProspect == null){
                $requestedProspect = null;
				$requestedProspect = $this->prospects->where('type_id','!=','2')->where('type_id','!=','3')->where('user_id','=','100')->where('lead_type','')->get();
                foreach($requestedProspects as $rp){
                    if(count($rp->callbacksWithTrashed) == 0){
                        $requestedProspect = $rp;
                        break;
                    }
                }
            }
			
			if($requestedProspect == null){
				flash('The pot you have picked does not contain any prospects for you to request.', 'warning');
				return back();
			}else{
				session(['newly_requested_prospect' => $requestedProspect->id]);
				$requestedProspect->user_id = Auth::user()->id;
				$requestedProspect->save();
				$log->info('Request a prospect.' , array('user' => Auth::user()->id, 'lead_type' => $request->request_type, 'prospect' => $requestedProspect->id));
				return redirect()->route('prospects.edit', $requestedProspect->id);
			}
			return back();
		}elseif($request->request_type == 1){ //lead
			if($request->request_type_source_lead == 0){
				flash('Please select a lead source to pull the prospect out of.', 'warning');
				return back();
			}else{
				//if its the original pot
				if($request->request_type_source_lead == 1 && $request->{'request_type_campaign_lead_'.$request->request_type_source_lead} == null){
					$campaignId = 1;
				}else{
					$campaignId = $request->{'request_type_campaign_lead_'.$request->request_type_source_lead};
				}
				$requestedProspect = $this->prospects->where('type_id','!=','2')->where('type_id','!=','3')->where('user_id','=','100')->where('lead_type','1')->where('campaign_id',$campaignId)->first();
				if($requestedProspect == null){
					flash('The pot you have picked does not contain any prospects for you to request. | Lead', 'warning');
					return back();
				}else{
					session(['newly_requested_prospect' => $requestedProspect->id]);
					$requestedProspect->user_id = Auth::user()->id;
					$requestedProspect->save();
					$log->info('Request a prospect.' , array('user' => Auth::user()->id, 'lead_type' => $request->request_type, 'prospect' => $requestedProspect->id));
					return redirect()->route('prospects.edit', $requestedProspect->id);
				}
			}
			return back();
		}elseif($request->request_type == 2){ //clicker
			if($request->request_type_source_clicker == 0){
				flash('Please select a clicker source to pull the prospect out of. ', 'warning');
				return back();
			}else{
				//if its the original pot
				if($request->request_type_source_clicker == 1 && $request->{'request_type_campaign_clicker_'.$request->request_type_source_clicker} == null){
					$campaignId = 1;
				}else{
					$campaignId = $request->{'request_type_campaign_clicker_'.$request->request_type_source_clicker};
				}
				$requestedProspect = $this->prospects->where('type_id','!=','2')->where('type_id','!=','3')->where('user_id','=','100')->where('lead_type','2')->where('campaign_id',$campaignId)->orderBy('click_count','desc')->first();
				if($requestedProspect == null){
					flash('The pot you have picked does not contain any prospects for you to request. | Clicker', 'warning');
					return back();
				}else{
					session(['newly_requested_prospect' => $requestedProspect->id]);
					$requestedProspect->user_id = Auth::user()->id;
					$requestedProspect->save();
					$log->info('Request a prospect.' , array('user' => Auth::user()->id, 'lead_type' => $request->request_type, 'prospect' => $requestedProspect->id));
					return redirect()->route('prospects.edit', $requestedProspect->id);
				}
			}
			return back();
		}elseif($request->request_type == 3){ //opener
			$log->info('Request a prospect.' , array('user' => Auth::user()->id, 'lead_type' => $request->request_type));
			if($request->request_type_source_opener == 0){
				flash('Please select a opener source to pull the prospect out of.', 'warning');
				return back();
			}else{
				//if its the original pot
				if($request->request_type_source_opener == 1 &&  $request->{'request_type_campaign_opener_'.$request->request_type_source_opener} == null){
					$campaignId = 1;
				}else{
					$campaignId = $request->{'request_type_campaign_opener_'.$request->request_type_source_opener};
				}
				$requestedProspect = $this->prospects->where('type_id','!=','2')->where('type_id','!=','3')->where('user_id','=','100')->where('lead_type','3')->where('campaign_id',$campaignId)->first();
				if($requestedProspect == null){
					flash('The pot you have picked does not contain any prospects for you to request. | Opener', 'warning');
					return back();
				}else{
					session(['newly_requested_prospect' => $requestedProspect->id]);
					$requestedProspect->user_id = Auth::user()->id;
					$requestedProspect->save();
					return redirect()->route('prospects.edit', $requestedProspect->id);
				}
			}
			return back();
		}

	}

	public function prospectCount(Request $request)
	{
		Log::info(Input::all());
		$type = Input::get('type');
		$campaign = Input::get('campaign');
		$msg = \App\Models\Prospects::where('type_id','!=','2')->where('type_id','!=','3')->where('user_id','=','100')->where('lead_type',$type)->where('campaign_id', $campaign)->count();
		return response()->json(array('msg'=> $msg, 'type'=> $type, 'campaign'=> $campaign), 200);
	}


}