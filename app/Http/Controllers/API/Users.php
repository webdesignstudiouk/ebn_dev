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

class Users extends Controller
{
    protected $users;

    public function __construct(){
      $this->users = new User;
    }

    public function getUsers(Request $request){
      $users = $this->users->all();
      return Response::json(array(
        'status' => "success",
        'success_message' => "Retrieved Users",
        'users' => $users,
       ));
    }
}
