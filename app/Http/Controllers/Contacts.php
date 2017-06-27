<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Contacts as EBNContacts;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use App\Models\User;
use App\Models\Prospects;
use Carbon\Carbon;


class Contacts extends Controller
{
	use FormBuilderTrait;

    protected $contacts;

	public function __construct()
    {
       $this->prospects = new Prospects;
       $this->contacts = new EBNContacts;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormBuilder $formBuilder, Request $request)
    {
			$contact = new EBNContacts;
			$contact->author_id = Auth::user()->id;
			$contact->prospect_id = $request->prospect_id;
			//favourite
			if($this->prospects->find($request->prospect_id)->contacts->count() == 0){
				$contact->favourite = 1;
			}
			$contact->type_id = $request->type_id;
			$contact->title = $request->title;
			$contact->job_title = $request->job_title;
			$contact->first_name = $request->first_name;
			$contact->second_name = $request->second_name;
			$contact->email = $request->email;
			$contact->phonenumber = $request->phonenumber;
			$contact->mobile_number = $request->mobile_number;
			$contact->save();

			flash('Contact Created', 'success');

			return back();
    }

    public function edit($prospect, $contact, FormBuilder $formBuilder)
    {
			$prospect = $this->prospects->find($prospect);
			$contact = $this->contacts->find($contact);

			$updateForm = $formBuilder->create(\App\Forms\Contacts\UpdateContact::class, [
				'method' => 'POST',
				'url' => route('contacts.update', ['prospect_id'=>$prospect->id, 'contact_id'=>$contact->id]),
				'model' => $contact
			]);

			return view('prospects.prospect.contact.edit')
			->with('prospect', $prospect)
			->with('contact', $contact)
			->with('updateForm', $updateForm);
    }

		public function delete($prospect, $contact, FormBuilder $formBuilder)
    {
			$prospect = $this->prospects->find($prospect);
			$contact = $this->contacts->find($contact);

			$deleteForm = $formBuilder->create(\App\Forms\Contacts\DeleteContact::class, [
				'method' => 'POST',
				'url' => route('contacts.destroy', ['prospect_id'=>$prospect->id, 'contact_id'=>$contact->id]),
				'model' => $contact
			]);

			return view('prospects.prospect.contact.delete')
			->with('prospect', $prospect)
			->with('contact', $contact)
			->with('deleteForm', $deleteForm);
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
			$contact = $this->contacts->find($request->id);
			if($this->prospects->find($contact->prospect_id)->contacts->count() == 1){
				$contact->favourite = 1;
			}
			$contact->type_id = $request->type_id;
			$contact->title = $request->title;
			$contact->job_title = $request->job_title;
			$contact->first_name = $request->first_name;
			$contact->second_name = $request->second_name;
			$contact->email = $request->email;
			$contact->phonenumber = $request->phonenumber;
			$contact->mobile_number = $request->mobile_number;
			$contact->save();
			flash('Contact Updated', 'success');
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
			$contact = $this->contacts->find($request->id);
			$contact->save();
			$contact->delete();

			flash('Contact Has Been Deleted', 'warning');

			return redirect()->route('prospect.contacts', $contact->prospect_id);
    }
}
