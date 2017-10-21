<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;

class Impersonate extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
		// $this->middleware('can:impersonate');
	}

	public function impersonate($user_id)
	{
		$user = User::find($user_id);

		if ($user->id !== ($original = Auth::user()->id)) {
			session()->put('original_user', $original);

			auth()->login($user);
		}

		return redirect('/home');
	}

	public function revert()
	{
		auth()->loginUsingId(session()->get('original_user'));

		session()->forget('original_user');

		return redirect('/home');
	}
}