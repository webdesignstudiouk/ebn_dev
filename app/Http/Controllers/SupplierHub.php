<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Suppliers;
use Illuminate\Support\Facades\Storage;


class SupplierHub extends Controller {
	protected $suppliers;

	public function __construct() {
		$this->suppliers = new Suppliers;
	}

	public function index() {
		$suppliers = $this->suppliers->all();

		return view( 'suppliers_hub.index' )
			->with( 'suppliers', $suppliers );
	}

	public function show( $supplier ) {
		$supplier = $this->suppliers->find( $supplier );
		$documents = Storage::allFiles('/public/suppliers/'.$supplier->id);

		return view( 'suppliers_hub.supplier' )
			->with( 'supplier', $supplier )
			->with( 'documents', $documents );
	}

	public function create_form() {
		return view( 'suppliers_hub.create' );
	}

	public function create( Request $request ) {
		$supplier                                  = new Suppliers();
		$supplier->name                            = $request->name;
		$supplier->logo_url                        = $request->logo_url;
		$supplier->general_phone                   = $request->general_phone;
		$supplier->sme_phone                       = $request->sme_phone;
		$supplier->sme_email_info                  = $request->sme_email_info;
		$supplier->sme_email_termination           = $request->sme_email_termination;
		$supplier->sme_account_manager             = $request->sme_account_manager;
		$supplier->sme_account_manager_dd          = $request->sme_account_manager_dd;
		$supplier->sme_account_manager_email       = $request->sme_account_manager_email;
		$supplier->corporate_phone                 = $request->corporate_phone;
		$supplier->corporate_email_info            = $request->corporate_email_info;
		$supplier->corporate_email_termination     = $request->corporate_email_termination;
		$supplier->corporate_account_manager       = $request->corporate_account_manager;
		$supplier->corporate_account_manager_dd    = $request->corporate_account_manager_dd;
		$supplier->corporate_account_manager_email = $request->corporate_account_manager_email;
		$supplier->direct                          = $request->direct;
		$supplier->aggregator                      = $request->aggregator;

		$supplier->supplier_and_product_info    = $request->supplier_and_product_info;
		$supplier->customer_service_and_billing = $request->customer_service_and_billing;
		$supplier->renewal_cycle                = $request->renewal_cycle;
		$supplier->credit_and_restrictions      = $request->credit_and_restrictions;

		$supplier->cc12_1 = $request->cc12_1;
		$supplier->cc12_2 = $request->cc12_2;

		$supplier->cc24_1 = $request->cc24_1;
		$supplier->cc24_2 = $request->cc24_2;
		$supplier->cc24_3 = $request->cc24_3;

		$supplier->cc36_1 = $request->cc36_1;
		$supplier->cc36_2 = $request->cc36_2;
		$supplier->cc36_3 = $request->cc36_3;
		$supplier->cc36_4 = $request->cc36_4;

		$supplier->cc48_1 = $request->cc48_1;
		$supplier->cc48_2 = $request->cc48_2;
		$supplier->cc48_3 = $request->cc48_3;
		$supplier->cc48_4 = $request->cc48_4;
		$supplier->cc48_5 = $request->cc48_5;

		$supplier->cc60_1 = $request->cc60_1;
		$supplier->cc60_2 = $request->cc60_2;
		$supplier->cc60_3 = $request->cc60_3;
		$supplier->cc60_4 = $request->cc60_4;
		$supplier->cc60_5 = $request->cc60_5;
		$supplier->cc60_6 = $request->cc60_6;

		$supplier->save();

		flash( 'Supplier Created', 'success' );

		return redirect()
			->route( 'suppliers-hub.supplier', $supplier->id );
	}

	public function update_form( $supplier ) {
		$supplier = $this->suppliers->find( $supplier );
		$documents = Storage::allFiles('/public/suppliers/'.$supplier->id);

		return view( 'suppliers_hub.edit' )
			->with( 'supplier', $supplier )
			->with( 'documents', $documents );
	}

	public function update( Request $request ) {
		$supplier                                  = $this->suppliers->find( $request->id );
		$supplier->name                            = $request->name;
		$supplier->logo_url                        = $request->logo_url;
		$supplier->general_phone                   = $request->general_phone;
		$supplier->sme_phone                       = $request->sme_phone;
		$supplier->sme_email_info                  = $request->sme_email_info;
		$supplier->sme_email_termination           = $request->sme_email_termination;
		$supplier->sme_account_manager             = $request->sme_account_manager;
		$supplier->sme_account_manager_dd          = $request->sme_account_manager_dd;
		$supplier->sme_account_manager_email       = $request->sme_account_manager_email;
		$supplier->corporate_phone                 = $request->corporate_phone;
		$supplier->corporate_email_info            = $request->corporate_email_info;
		$supplier->corporate_email_termination     = $request->corporate_email_termination;
		$supplier->corporate_account_manager       = $request->corporate_account_manager;
		$supplier->corporate_account_manager_dd    = $request->corporate_account_manager_dd;
		$supplier->corporate_account_manager_email = $request->corporate_account_manager_email;
		$supplier->direct                          = $request->direct;
		$supplier->aggregator                      = $request->aggregator;

		$supplier->supplier_and_product_info    = $request->supplier_and_product_info;
		$supplier->customer_service_and_billing = $request->customer_service_and_billing;
		$supplier->renewal_cycle                = $request->renewal_cycle;
		$supplier->credit_and_restrictions      = $request->credit_and_restrictions;

		$supplier->cc12_1 = $request->cc12_1;
		$supplier->cc12_2 = $request->cc12_2;

		$supplier->cc24_1 = $request->cc24_1;
		$supplier->cc24_2 = $request->cc24_2;
		$supplier->cc24_3 = $request->cc24_3;

		$supplier->cc36_1 = $request->cc36_1;
		$supplier->cc36_2 = $request->cc36_2;
		$supplier->cc36_3 = $request->cc36_3;
		$supplier->cc36_4 = $request->cc36_4;

		$supplier->cc48_1 = $request->cc48_1;
		$supplier->cc48_2 = $request->cc48_2;
		$supplier->cc48_3 = $request->cc48_3;
		$supplier->cc48_4 = $request->cc48_4;
		$supplier->cc48_5 = $request->cc48_5;

		$supplier->cc60_1 = $request->cc60_1;
		$supplier->cc60_2 = $request->cc60_2;
		$supplier->cc60_3 = $request->cc60_3;
		$supplier->cc60_4 = $request->cc60_4;
		$supplier->cc60_5 = $request->cc60_5;
		$supplier->cc60_6 = $request->cc60_6;

		$supplier->save();

		flash( 'Supplier Updated', 'success' );

		return redirect()
			->route( 'suppliers-hub.supplier', $supplier->id );

	}

	public function store_file( Request $request ) {
		$supplier  = $request->supplier_id;

		//if file type empty
		if ( $request->file( 'file' ) == null ) {
			flash( 'Please include a file.', 'danger' );

			return back()->withInput( [ 'tab' => 'uploads' ] );
		} else {
			$file_name = $request->file( 'file' )->getClientOriginalName();
		}

		//upload file
		$path = $request->file( 'file' )->storeAs(
			'/public/suppliers/' . $supplier . '/',
			$file_name
		);

		flash( 'Supplier Document Uploaded', 'success' );

		return back()->withInput( [ 'tab' => 'uploads' ] );
	}

	public function delete_file(Request $request)
	{
		$supplier = $request->supplier_id;
		$file_name = $request->file_name;
		Storage::delete('/public/suppliers/'.$supplier.'/'.$file_name);

		flash('Supplier Document Deleted', 'success');

		return back()->withInput(['tab'=>'uploads']);
	}

	public function delete( $supplier_id ) {
		$supplier = $this->suppliers->find( $supplier_id );
		$supplier->delete();
		flash( 'Supplier Deleted', 'success' );

		return redirect()
			->route( 'suppliers-hub', $supplier->id );
	}
}