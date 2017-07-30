<?php


namespace App\Http\Controllers;

use App\Models\ContactsTypes;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Contacts;


class AddressBook extends Controller
{
    protected $contacts;

    public function __construct(){
        $this->contacts = new Contacts;
    }

    public function index($type = 2){
        return view('address_book.contacts')
            ->with('contacts', $this->contacts)
            ->with('type', $type);
    }

    public function create($type = 2){
        return view('address_book.create')
            ->with('contacts', $this->contacts)
            ->with('type', $type);
    }

    public function store(Request $request){
        $contact = new Contacts();
        $contact->author_id = Auth::user()->id;
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

        return redirect()->route('addressBook', $request->type_id);
    }

    public function delete($id){
        $contact = Contacts::find($id);
        $contact->delete();

        flash('Contact Deleted', 'success');

        return back();
    }
}