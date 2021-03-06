<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| AJAX Routes
|--------------------------------------------------------------------------
|
| Here is all routes that have a admin/ prefix
|
*/
Route::get( '/search', 'Core\Search@index' )->name( 'search.index' );


Route::group( [ 'prefix' => 'ajax' ], function () {
	Route::post( 'prospectCount', 'Prospects@prospectCount' )->name( 'ajax.prospectCount' );
	Route::post( 'search', 'Core\Search@search' )->name( 'search' );


	Route::get( 'mark_notifications_as_read', 'Users@mark_notifications_as_read' )->name( 'user.mark_notifications_as_read' );
	Route::post( 'update_verbal_ced', 'Prospects@update_verbal_ced' )->name( 'prospects.update_verbal_ced' );
	Route::post( 'delete_verbal_ced', 'Prospects@delete_verbal_ced' )->name( 'prospects.delete_verbal_ced' );
} );


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Here is all routes that are bound to the AUTH Controller
|
*/
Route::auth();


Route::group( [ 'prefix' => 'impersonation' ], function () {
	Route::get( 'revert', 'Impersonate@revert' )->name( 'impersoante.revert' );
	Route::get( '{user}', 'Impersonate@impersonate' )->name( 'impersonate.impersonate' );
} );


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is all routes that have a admin/ prefix
|
*/
Route::group( [ 'prefix' => 'admin' ], function () {

	//Admin Routes
	Route::group( [ 'middleware' => [ 'auth' ] ], function () {
		Route::get( '/', 'AdminController@index' )->name( 'admin' );
		Route::get( 'dashboard', 'AdminController@index' )->name( 'dashboard' );


		Route::get( 'my-notifications', 'Users@notifications' )->name( 'notifications' );
	} );

	Route::group( [ 'middleware' => [ 'auth', 'role:admin' ] ], function () {
		Route::get( 'notifications/{user}', 'Users@notifications' )->name( 'notifications.user' );
		Route::get( 'process-prospects', 'ProspectsUpload@processProspectsView' )->name( 'process-prospects' );
		Route::post( 'process-prospects', 'ProspectsUpload@processProspects' )->name( 'process-prospects.process' );
	} );

	/*
	|--------------------------------------------------------------------------
	| Source Code Routes
	|--------------------------------------------------------------------------
	|
	| Here is all routes that have a source-codes/ prefix
	|
	*/
	Route::group( [ 'prefix' => 'supplier-hub', 'middleware' => [ 'auth' ] ], function () {
		Route::get( '', 'SupplierHub@index' )->name( 'suppliers-hub' );
		Route::get( 'create', 'SupplierHub@create_form' )->name( 'suppliers-hub.create_form' );
		Route::post( 'create', 'SupplierHub@create' )->name( 'suppliers-hub.create' );
		Route::get( '{supplier}/update', 'SupplierHub@update_form' )->name( 'suppliers-hub.update_form' );
		Route::put( '{supplier}/update', 'SupplierHub@update' )->name( 'suppliers-hub.update' );
		Route::get( '{supplier}/delete', 'SupplierHub@delete' )->name( 'suppliers-hub.delete' );
		Route::get( '{supplier}', 'SupplierHub@show' )->name( 'suppliers-hub.supplier' );

		Route::post( '{supplier}/store_file', 'SupplierHub@store_file' )->name( 'suppliers-hub.store_file' );
		Route::post( '{supplier}/delete_file', 'SupplierHub@delete_file' )->name( 'suppliers-hub.delete_file' );
	} );

	/*
	|--------------------------------------------------------------------------
	| Source Code Routes
	|--------------------------------------------------------------------------
	|
	| Here is all routes that have a source-codes/ prefix
	|
	*/
	Route::group( [ 'prefix' => 'options', 'middleware' => [ 'auth', 'role:admin' ] ], function () {
		Route::get( '', 'Reports@reports' )->name( 'options' );


		Route::get( 'reports', 'Reports@reports' )->name( 'reports' );
		Route::get( 'reports/{report}', 'Reports@reports' );
		Route::post( 'reports/{report}', 'Reports@report_dispatch' )->name( 'reports.dispatch' );

		Route::get( 'stored-infomation/{type_id}', 'AdminController@storedInfomation' )->name( 'storedInfomation' );
		Route::get( 'ajax/stored-infomation/{type_id}', 'AdminController@stored_infomation_table_ajax' )->name( 'stored_infomation_table.ajax' );


		Route::get( 'roles', 'Admin\Roles@roles' )->name( 'roles' );
		Route::get( 'roles/{role}/edit', 'Admin\Roles@role' )->name( 'roles.edit' );
		Route::post( 'roles/{role}/edit', 'Admin\Roles@updateRole' )->name( 'roles.update' );

		Route::get( 'roles/{role}/permissions', 'Admin\Roles@permissions' )->name( 'roles.permissions' );
		Route::post( 'roles/permissions/update-permissions', 'Admin\Roles@updatePermissions' )->name( 'permissions.update' );
		Route::post( 'roles/permissions/create-permission', 'Admin\Roles@createPermission' )->name( 'permissions.create' );

		Route::get( 'source-codes', 'Options\SourceCodes@index' )->name( 'source-codes' );
		Route::get( 'source-codes/create', 'Options\SourceCodes@create' )->name( 'source-codes.create' );
		Route::post( 'source-codes', 'Options\SourceCodes@store' )->name( 'source-codes.store' );
		Route::get( 'source-codes/{sourceCode}', 'Options\SourceCodes@show' )->name( 'source-codes.show' );
		Route::get( 'source-codes/{sourceCode}/edit', 'Options\SourceCodes@edit' )->name( 'source-codes.edit' );
		Route::put( 'source-codes/{sourceCode}', 'Options\SourceCodes@update' )->name( 'source-codes.update' );
	} );
	/*
	|--------------------------------------------------------------------------
	| Source Code Prefix
	|--------------------------------------------------------------------------
	|
	| Here is all routes that have a source-codes/Campaigns prefix
	|
	*/
	Route::group( [ 'prefix' => 'options/source-codes/{source_id}' ], function () {

		/*
		|--------------------------------------------------------------------------
		| Campaigns Prefix
		|--------------------------------------------------------------------------
		|
		| Here is all routes that have a Campaigns/ prefix
		|
		*/
		Route::group( [ 'middleware' => [ 'auth', 'role:admin' ] ], function () {
			Route::post( 'campaigns', 'Options\Campaigns@store' )->name( 'campaigns.store' );
			Route::get( 'campaigns/{sourceCode}/edit', 'Options\Campaigns@edit' )->name( 'campaigns.edit' );
			Route::put( 'campaigns/{sourceCode}', 'Options\Campaigns@update' )->name( 'campaigns.update' );
		} );

	} );

	/*
	|--------------------------------------------------------------------------
	| User Routes
	|--------------------------------------------------------------------------
	|
	| Here is all routes that have a user/ prefix
	|
	*/
	Route::group( [ 'middleware' => [ 'auth', 'role:admin' ] ], function () {
		Route::get( 'options/users', 'Users@index' )->name( 'users' );
		Route::get( 'options/users/create', 'Users@create' )->name( 'users.create' );
		Route::post( 'options/users', 'Users@store' )->name( 'users.store' );
		Route::get( 'options/users/{user}', 'Users@show' )->name( 'users.show' );
		Route::get( 'options/users/{user}/edit', 'Users@edit' )->name( 'users.edit' );
		Route::put( 'options/users/{user}', 'Users@update' )->name( 'users.update' );
		Route::delete( 'options/users/{user}', 'Users@destroy' )->name( 'users.destroy' );

		/*
		|--------------------------------------------------------------------------
		| Extra Users Routes
		|--------------------------------------------------------------------------
		*/
		Route::get( 'users/{user}/delete', 'Users@delete' )->name( 'user.delete' );
		Route::get( 'users/{user}/view/{type}', 'Users@prospects' )->name( 'user.prospects' );
		Route::put( 'users/{user}', 'Users@update' );
	} );

	/*
	|--------------------------------------------------------------------------
	| Prospects Routes
	|--------------------------------------------------------------------------
	|
	| Here is all routes that have a prospects/ prefix
	|
	*/
	Route::group( [ 'middleware' => [ 'auth' ] ], function () {
		Route::get( 'prospects', 'Prospects@index' )->name( 'prospects' );
		Route::get( 'prospects/create', 'Prospects@create' )->name( 'prospects.create' );
		Route::post( 'prospects', 'Prospects@store' )->name( 'prospects.store' );
		Route::get( 'prospects/{prospect}', 'Prospects@show' )->name( 'prospects.show' );
		Route::get( 'prospects/{prospect}/edit', 'Prospects@edit' )->name( 'prospects.edit' );
		Route::put( 'prospects/{prospect}', 'Prospects@update' )->name( 'prospects.update' );
		Route::delete( 'prospects/{prospect}', 'Prospects@destroy' )->name( 'prospects.destroy' );
		Route::post( 'prospects/deleteProspects', 'Prospects@deleteProspects' )->name( 'prospects.deleteProspects' );
		/*
		|--------------------------------------------------------------------------
		| Extra Prospects Routes
		|--------------------------------------------------------------------------
		*/
		Route::get( 'prospects_2', 'Prospects@prospects_2' )->name( 'prospects.prospects_2' );

		//request
		Route::get( 'request-prospect-agent', 'Prospects@requestAgent' )->name( 'prospects.request_agent' );
		Route::get( 'request-prospect-care-homes', 'Prospects@requestCh' )->name( 'prospects.request_ch' );
		Route::get( 'request-prospect-care-homes-deleted', 'Prospects@requestChDeleted' )->name( 'prospects.request_ch_deleted' );
		Route::get( 'request-prospect-care-homes-tom', 'Prospects@requestChTom' )->name( 'prospects.request_ch_tom' );


		Route::post( 'request-prospect', 'Prospects@request' )->name( 'prospect.requestProspect' );




		Route::get( 'prospects/{prospect}/callbacks', 'Prospects@callbacks' )->name( 'prospect.callbacks' );
		Route::get( 'prospects/{prospect}/sites', 'Prospects@sites' )->name( 'prospect.sites' );
		Route::get( 'prospects/{prospect}/contacts', 'Prospects@contacts' )->name( 'prospect.contacts' );
		Route::get( 'prospects/{prospect}/uploads', 'Prospects@uploads' )->name( 'prospect.uploads' );
		Route::get( 'prospects/{prospect}/loas', 'Prospects@loas' )->name( 'prospect.loas' );
		Route::get( 'prospects/{prospect}/loa/{loa}/delete', 'ProspectsUpload@delete' )->name( 'prospect.loa.delete' );


		Route::get( 'prospects/{prospect}/all_meters', 'Prospects@all_meters' )->name( 'prospect.all_meters' );

		Route::get( 'prospects/{prospect}/delete', 'Prospects@delete' )->name( 'prospect.delete_form' );
		Route::delete( 'prospects/{prospect}/delete', 'Prospects@destroy' )->name( 'prospect.delete' );
		Route::get( 'prospects/{prospect}/request-delete', 'Prospects@request_delete' )->name( 'prospect.request_delete' );
		Route::post( 'prospects/{prospect}/request-delete', 'Prospects@set_request_delete' )->name( 'prospect.set_request_delete' );
		Route::get( 'prospects/{prospect}/progress', 'Prospects@progress' )->name( 'prospect.progress' );;
	} );
	Route::group( [ 'middleware' => [ 'auth', 'role:admin' ] ], function () {
		Route::get( 'request-prospect', 'Prospects@requestView' )->name( 'prospects.request' );
		Route::post( 'move-prospects', 'Prospects@moveProspects' )->name( 'prospect.moveProspect' );
		Route::get( 'clients', 'Prospects@clients' )->name( 'prospects.clients' );
		Route::get( 'all_clients', 'Prospects@all_clients' )->name( 'prospects.all_clients' );
	} );
	/*
	|--------------------------------------------------------------------------
	| Prospects Routes
	|--------------------------------------------------------------------------
	|
	| Here is all routes that have a admin/prospects/ prefix
	|
	*/
	Route::group( [ 'prefix' => 'prospects/{id}' ], function () {

		/*
		|--------------------------------------------------------------------------
		| Sites Routes
		|--------------------------------------------------------------------------
		|
		| Here is all routes that have a admin/prospects/sites/ prefix
		|
		*/
		Route::group( [ 'middleware' => [ 'auth' ] ], function () {
			Route::get( 'sites', 'Sites@index' )->name( 'sites' );
			Route::get( 'sites/create', 'Sites@create' )->name( 'sites.create' );
			Route::post( 'sites', 'Sites@store' )->name( 'sites.store' );
			Route::get( 'sites/{site}', 'Sites@show' )->name( 'sites.show' );
			Route::get( 'sites/{site}/edit', 'Sites@edit' )->name( 'sites.edit' );
			Route::put( 'sites/{site}', 'Sites@update' )->name( 'sites.update' );
			Route::delete( 'sites/{site}', 'Sites@destroy' )->name( 'sites.destroy' );
			/*
			|--------------------------------------------------------------------------
			| Extra Sites Routes
			|--------------------------------------------------------------------------
			*/
			Route::get( 'sites/{site}/electricMeters', 'Sites@electricMeters' )->name( 'site.electricMeters' );
			Route::get( 'sites/{site}/gasMeters', 'Sites@gasMeters' )->name( 'site.gasMeters' );
			Route::get( 'sites/{site}/delete', 'Sites@delete' )->name( 'site.delete' );
			Route::get( 'export_sitelist', 'Sites@export_sitelist' )->name( 'site.export_sitelist' );
		} );

		/*
		|--------------------------------------------------------------------------
		| Contacts Routes
		|--------------------------------------------------------------------------
		|
		| Here is all routes that have a admin/prospects/contacts/ prefix
		|
		*/
		Route::group( [ 'middleware' => [ 'auth' ] ], function () {
			Route::get( 'contacts', 'Contacts@index' )->name( 'contacts' );
			Route::get( 'contacts/create', 'Contacts@create' )->name( 'contacts.create' );
			Route::post( 'contacts', 'Contacts@store' )->name( 'contacts.store' );
			Route::get( 'contacts/{contact}', 'Contacts@show' )->name( 'contacts.show' );
			Route::get( 'contacts/{contact}/edit', 'Contacts@edit' )->name( 'contacts.edit' );
			Route::put( 'contacts/{contact}', 'Contacts@update' )->name( 'contacts.update' );
			Route::delete( 'contacts/{contact}', 'Contacts@destroy' )->name( 'contacts.destroy' );
			/*
			|--------------------------------------------------------------------------
			| Extra Contacts Routes
			|--------------------------------------------------------------------------
			*/
			Route::get( 'contacts/{contact}/delete', 'Contacts@delete' )->name( 'contact.delete' );
			Route::get( 'contacts/{contact}/make-favourite', 'Contacts@favourite' )->name( 'contact.favourite' );
		} );

		/*
		|--------------------------------------------------------------------------
		| Sites Routes
		|--------------------------------------------------------------------------
		|
		| Here is all routes that have a admin/prospects/sites/ prefix
		|
		*/
		Route::group( [ 'middleware' => [ 'auth' ] ], function () {
			Route::group( [ 'prefix' => 'sites/{siteId}' ], function () {
				/*
				|--------------------------------------------------------------------------
				| Electric Meter Routes
				|--------------------------------------------------------------------------
				|
				| Here is all routes that have a admin/prospects/sites/electricMeters/ prefix
				|
				*/
				Route::get( 'electricMeters', 'ElectricMeters@index' )->name( 'electricMeters' );
				Route::get( 'electricMeters/create', 'ElectricMeters@create' )->name( 'electricMeters.create' );
				Route::post( 'electricMeters', 'ElectricMeters@store' )->name( 'electricMeters.store' );
				Route::get( 'electricMeters/{electricMeter}', 'ElectricMeters@show' )->name( 'electricMeters.show' );
				Route::get( 'electricMeters/{electricMeter}/edit', 'ElectricMeters@edit' )->name( 'electricMeters.edit' );
				Route::put( 'electricMeters/{electricMeter}', 'ElectricMeters@update' )->name( 'electricMeters.update' );
				Route::delete( 'electricMeters/{electricMeter}', 'ElectricMeters@destroy' )->name( 'electricMeters.destroy' );

				/*
				|--------------------------------------------------------------------------
				| Extra Electric Meter Routes
				|--------------------------------------------------------------------------
				*/
				Route::get( 'electricMeters/{electricMeter}/delete', 'ElectricMeters@delete' )->name( 'electricMeter.delete' );

				/*
				|--------------------------------------------------------------------------
				| Gas Meter Routes
				|--------------------------------------------------------------------------
				|
				| Here is all routes that have a admin/prospects/sites/electricMeters/ prefix
				|
				*/
				Route::get( 'gasMeters', 'GasMeters@index' )->name( 'gasMeters' );
				Route::get( 'gasMeters/create', 'GasMeters@create' )->name( 'gasMeters.create' );
				Route::post( 'gasMeters', 'GasMeters@store' )->name( 'gasMeters.store' );
				Route::get( 'gasMeters/{gasMeter}', 'GasMeters@show' )->name( 'gasMeters.show' );
				Route::get( 'gasMeters/{gasMeter}/edit', 'GasMeters@edit' )->name( 'gasMeters.edit' );
				Route::put( 'gasMeters/{gasMeter}', 'GasMeters@update' )->name( 'gasMeters.update' );
				Route::delete( 'gasMeters/{gasMeter}', 'GasMeters@destroy' )->name( 'gasMeters.destroy' );
				/*
				|--------------------------------------------------------------------------
				| Extra Electric Meter Routes
				|--------------------------------------------------------------------------
				*/
				Route::get( 'gasMeters/{gasMeter}/delete', 'GasMeters@delete' )->name( 'gasMeter.delete' );
			} );
		} );
	} );


	/*
	|--------------------------------------------------------------------------
	| Callbacks Routes
	|--------------------------------------------------------------------------
	|
	| Here is all routes that have a admin/callbacks prefix
	|
	*/
	Route::group( [ 'middleware' => [ 'auth' ] ], function () {
		Route::get( 'callbacks', 'Callbacks@timeline' )->name( 'callbacks' );
		Route::post( 'callbacks/create', 'Callbacks@create' )->name( 'callbacks.create' );
		Route::post( 'callbacks', 'Callbacks@store' )->name( 'callbacks.store' );
		Route::get( 'callbacks', 'Callbacks@timeline' )->name( 'callbacks.timeline' );
		Route::post( 'export', 'Options\Subscriptions@export' )->name( 'subscriptions.export' );
		Route::get( 'delete_callback/{callback_id}', 'Callbacks@destroy' );
	} );

	/*
	|--------------------------------------------------------------------------
	| CED Routes
	|--------------------------------------------------------------------------
	|
	| Here is all routes that have a admin/contract-end-dates prefix
	|
	*/
	Route::group( [ 'middleware' => [ 'auth' ] ], function () {
//		Route::get( 'contract-end-dates/{prospectType?}', 'CED@timeline' )->name( 'ced.timeline' );
//		Route::get( 'contract-end-dates-new/', 'CED@report' )->name( 'ced.report' );
		Route::get( 'contract-end-dates/{prospect_type?}', 'CED@report' )->name( 'ced.report' );
		Route::get( 'contract-end-dates-new/{prospect_type?}', 'CED@report_new' )->name( 'ced.report_new' );
		Route::get( 'ced_report', 'CED@local_report' )->name( 'ced.local_report' );
	} );

	/*
	|--------------------------------------------------------------------------
	| LOA Routes
	|--------------------------------------------------------------------------
	|
	| Here is all routes that are loa / supporting document related 																																				** NEEDS SORTING **
	|
	*/
	Route::group( [ 'middleware' => [ 'auth' ] ], function () {
		Route::get( 'loa_report', 'Prospects@loa_report' )->name( 'loa_report' );
		Route::post( 'store_loa', 'ProspectsUpload@store_loa' )->name( 'store_loa' );

		Route::post( 'store_file', 'ProspectsUpload@store_file' )->name( 'store_file' );
		Route::post( 'delete_file', 'ProspectsUpload@delete_file' )->name( 'delete_file' );
	} );

	Route::post( 'update_loa', 'ProspectsUpload@update_loa' )->name( 'update_loa' );

} );

/*
|--------------------------------------------------------------------------
| Other Routes
|--------------------------------------------------------------------------
|
| Here is all other routes
|
*/
Route::get( 'electricMeters/{electricMeter}', 'ElectricMeters@toggleStatus' )->name( 'electricMeters.toggle_status' );
Route::get( 'gasMeters/{gasMeter}', 'GasMeters@toggleStatus' )->name( 'gasMeters.toggle_status' );

Route::get( '/', function () {
	return redirect( 'login' );
} );

Route::get( '/home', function () {
	return redirect( 'admin/prospects' );
} );

Route::get( '/test', function () {

} );
