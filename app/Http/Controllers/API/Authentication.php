<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use PushNotification;
use Response;
use App\User;
use App\Client_Portfolio;
use App\Client;

class Authentication extends Controller
{
    public function attemptToLogin(Request $request) {
      $email = $request->input('email');
      $password = $request->input('password');

      $credentials = [
       'email'    => $email,
       'password' => $password,
      ];

      if (Auth::once($credentials)) {
          return Response::json(array(
            'status' => "success",
            'success_message' => "User logged in successfully using auth_token",
            'api_token' => Auth::user()->api_token,
           ));
      }else{
          return Response::json(array(
            'status' => "failed",
            'error_message' => "Could not log the user in using the auth_token",
           ));
      }
    }

    public function updateFirebaseToken(Request $request) {
      Log::info(str_replace('"', '', $request->input('api_token')));
      $user = User::where("api_token", "=",str_replace('"', '', $request->input('api_token')))->first();
      if($user == null){
        Log::info('Authentication Did Not Work!');
        return Response::json(array(
          'status' => "failed",
          'error_message' => "Could not update auth_token to the server",
         ));
      }else{
        $user = Auth::guard('api')->user();
        Log::info('USER: '.$user);
        Log::info('POST: '.$request);
        $user->firebase_token = $request->input('token');
        $user->save();
        return Response::json(array(
          'status' => "success",
          'success_message' => "Auth_token successfully updated",
         ));
      }
    }
}
