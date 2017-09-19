<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\ProspectsCallbacks as EBNCallbacks;
use App\Models\Prospects;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use App\Models\User;
use Carbon\Carbon;
use Input;

class Callbacks extends Controller
{
	use FormBuilderTrait;

    protected $callbacks;

	public function __construct()
    {
       $this->callbacks = new EBNCallbacks;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$callbacks = $this->callbacks->orderBy('created_at', 'asc')->all();
		return view('callbacks.callbacks')
			->with('callbacks', $callbacks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormBuilder $formBuilder, Request $request)
    {
			//delete exisitng callbacks for that use so only one shows up.
			$this->callbacks->where('prospect_id', $request->prospect_id)->delete();

			//if empty time
			if($request->callbackTime == NULL){
				$time = "00:00:00";
			}else{
				$time = $request->callbackTime;
			}

			//if wrong date format
//	        dd(Carbon::createFromFormat('Y-m-dd', $request->callbackDate));

	        try{
		        Carbon::createFromFormat('Y-m-d', $request->callbackDate);
            } catch (\Exception $e) {
		        flash('Callback date in the wrong format. DD/MM/YYYY', 'danger');
		        return back()->withInput(['tab'=>'callbacks']);
	        }

			//create new callback
			$callback = new EBNCallbacks;
			$callback->author_id = Auth::user()->id;
			$callback->prospect_id = $request->prospect_id;
			$callback->callbackDate = $request->callbackDate;
			$callback->callbackTime = $time;
			$callback->note = $request->note;
			$callback->save();

			//redirect user
			return back()->withInput(['tab'=>'callbacks']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function show($prospect, FormBuilder $formBuilder)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function edit($prospect, FormBuilder $formBuilder)
    {

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($callback_id)
    {
			//deletes callbacks
			$callback = $this->callbacks->find($callback_id);
			$callback->delete();

			$prospect = Prospects::find($callback->prospect_id);

			if($prospect->callbacks->count() == 0){
				flash('Callback Deleted. '.$prospect->company.' currently does not have any callbacks set for the future. Please think about creating one.', 'warning');
			}else{
				flash('Callback Deleted', 'danger');
			}

			return back();
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function timeline(Request $request)
    {
			if($request->input('beginDate') != null){
				$beginDate = Carbon::createFromFormat('d/m/Y', $request->input('beginDate'))->toDateString();
			}else{
				$beginDate = Carbon::now()->toDateString();
			}


			if($request->input('endDate') != null){
				$endDate = Carbon::createFromFormat('d/m/Y', $request->input('endDate'))->toDateString();
			}else{
				$endDate = Carbon::now()->addWeeks(2)->toDateString();
			}

			$callbackModal = new EBNCallbacks;
			$callbacks = $this->callbacks->all();
			return view('callbacks.timeline')
				->with('beginDate', $beginDate)
				->with('endDate', $endDate)
				->with('callbacks', $callbacks)
				->with('callbacksModal', $callbackModal);
    }
}
