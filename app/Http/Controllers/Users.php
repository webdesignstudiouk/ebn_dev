<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Users as EBNUsers;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Models\User;
use Auth;

class Users extends Controller {
	protected $users;

	public function __construct() {
		$this->users = new EBNUsers;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$users = $this->users->all();

		return view( 'users.users' )
			->with( 'users', $users );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create( FormBuilder $formBuilder ) {
		$form = $formBuilder->create( \App\Forms\Users\CreateUser::class, [
			'method' => 'POST',
			'url'    => route( 'users.store' )
		], [
			'title' => "Create User"
		] );

		return view( 'users.create', compact( 'form' ) );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( FormBuilder $formBuilder, Request $request ) {
		$form = $formBuilder->create( \App\Forms\Users\CreateUser::class );

		if ( ! $form->isValid() ) {
			return redirect()->back()->withErrors( $form->getErrors() )->withInput();
		}

		$user              = new EBNUsers;
		$user->group_id    = $request->group_id;
		$user->first_name  = $request->first_name;
		$user->second_name = $request->second_name;
		$user->email       = $request->email;

		User::create( [
			'group_id'    => $request->group_id,
			'first_name'  => $request->first_name,
			'second_name' => $request->second_name,
			'email'       => $request->email,
			'password'    => bcrypt( $request->password ),
		] );

		return redirect()->route( 'users' );

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Users $users
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( $user, FormBuilder $formBuilder ) {
		$user = $this->users->find( $user );
		dd( $user );

		//return view('users.user', compact('form'))->with('user', $user);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Users $users
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $user, FormBuilder $formBuilder ) {
		$user = $this->users->find( $user );

		$updateForm = $formBuilder->create( \App\Forms\Users\UpdateUser::class, [
			'method' => 'POST',
			'url'    => url( 'admin/users/' . $user->id ),
			'model'  => $user
		] );

		return view( 'users.user.update_form' )
			->with( 'updateForm', $updateForm )
			->with( 'user', $user );
	}

	public function delete( $user, FormBuilder $formBuilder ) {
		$user = $this->users->find( $user );

		$deleteForm = $formBuilder->create( \App\Forms\Users\DeleteUser::class, [
			'method' => 'POST',
			'url'    => route( 'users.destroy', $user->id ),
			'model'  => $user
		] );

		return view( 'users.user.delete_form' )
			->with( 'deleteForm', $deleteForm )
			->with( 'user', $user );
	}

	public function prospects( $user, $type, FormBuilder $formBuilder ) {
		$user = $this->users->find( $user );
		if ( $type == 'prospects1' ) {
			$prospects = $user->prospects1;
		} elseif ( $type == 'prospects2' ) {
			$prospects = $user->prospects2;
		} elseif ( $type == 'clients' ) {
			$prospects = $user->clients;
		}

		return view( 'users.user.prospects' )
			->with( 'user', $user )
			->with( 'prospects', $prospects )
			->with( 'title', $type )
			->with( 'type', $type );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Users $user
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request ) {
		$user              = $this->users->find( $request->id );
		$user->group_id    = $request->group_id;
		$user->first_name  = $request->first_name;
		$user->second_name = $request->second_name;
		$user->email       = $request->email;
		if ( $request->password != "" ) {
			$user->password = bcrypt( $request->password );
		}
		$user->save();

		flash( 'User Updated', 'success' );

		return back();
	}

	public function notifications() {
		return view( 'account.notifications' );
	}

	public function mark_notifications_as_read() {
		foreach ( Auth::user()->unreadNotifications as $notification ) {
			$notification->markAsRead();
		}

		ob_start();
		$html = '';
		if ( count( Auth::user()->notifications ) == 0 ) {
			$html .= "<li class='active notification-secondary'>
				<a href ='#' >
				    <i class='fa-exclamation'></i >
				    <span class='line'><strong> No Notifications </strong ></span>
				    <span class='line small time'>Try again later </span>
				</a >
			</li >";
		} else {
			foreach ( Auth::user()->notifications as $notification ) {
				$html .= display_notification( $notification );
			}
		}

		$html = ob_get_contents();
		ob_end_clean();

		$response = array(
			'count' => Auth::user()->unreadNotifications->count(),
			'html'  => $html
		);

		return json_encode( $response );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\User $user
	 *
	 * @return \Illuminate\Http\Response
	 */
	public
	function destroy(
		$user
	) {
		$user = $this->users->find( $user );
		$user->delete();

		flash( 'User Has Been Deleted', 'warning' );

		return redirect()->route( 'users' );
	}
}
