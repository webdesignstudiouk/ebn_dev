<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use SocialLogin;
use Illuminate\Http\Request;
use App\Http\Requests;

use Auth;
use App\User;

class AuthController extends Controller
{
	//requests the data from the api
    public function redirectToProvider($provider)
    {
		//start the request
        return SocialLogin::driver($provider)->redirect();
    }

	//manage requested infomation and then create user
    public function handleProviderCallback($provider)
    {
		//store requested infomation into object
        $user = SocialLogin::driver($provider)->stateless()->user();

		// storing data to our use table and logging them in
        $data['name'] = $user->getName();
		$data['email'] = $user->getEmail();

		$exisitingUser = User::where('email', '=', $data['email'])->first();

		if ($user === null) {
			if($provider == "Google"){
				$data['google_id'] = $user->getId();
				$data['sign_up_refrence'] = 'google';
			}elseif($provider == "Facebook"){
				$data['facebook_id'] = $user->getId();
				$data['sign_up_refrence'] = 'facebook';
			}

			//create user
			Auth::login(User::firstOrCreate($data));

			//after login redirecting to home page
			return redirect('/admin');
		}else{
			if($provider == "Google"){
				$data['google_id'] = $user->getId();
				$exisitingUser->google_id = $data['google_id'];
			}elseif($provider == "Facebook"){
				$data['facebook_id'] = $user->getId();
				$exisitingUser->facebook_id = $data['facebook_id'];
			}

			//save social id to their account
			$exisitingUser->save();

			//create user
			Auth::login($exisitingUser);

			//after login redirecting to home page
			return redirect('/login');
		}






    }
}
