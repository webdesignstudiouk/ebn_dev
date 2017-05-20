<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bican\Roles\Models\Role;

use App\User;

class Users extends Controller
{
	protected $users;

	public function __construct(){
		$this->users = new User;
	}

	public function users($users = "clients"){
		$users = $this->users->all();
		return view('admin.Users.users')
			   ->with('users', $users);
	}

	public function user($id){
		$user = $this->users->find($id);

		$userMetaKeys = array_keys($user->getMeta()->toArray());
		$userMetaValues = array_values($user->getMeta()->toArray());
		$userDetails = array();

		foreach($userMetaKeys as $key){
			$userDetails['keys'] = $userMetaKeys;
			$userDetails['values'] = $userMetaValues;
		}

		return view('admin.Users.user')
			   ->with('user', $user)
			   ->with('userDetails', $userDetails);
	}

	public function assignedAccounts($id){
		$user = $this->users->find($id);
		return view('admin.Users.user_assignedAccounts')
				 ->with('user', $user);
	}

	public function updateUser(Request $request){
		$id = $request->input('id');
		$name = $request->input('name');
		$user = $this->users->find($id);

		$count = 0;
		$userMetaKeys = array_keys($user->getMeta()->toArray());
		$userMetaValues = array_values($user->getMeta()->toArray());
		foreach($userMetaKeys as $key){
			$$key = $request->input($key);
			$count++;
		}

		$user->name = $name;

		$count = 0;
		foreach($userMetaKeys as $key){
			$user->setMeta($key, $$key);
			$count++;
		}

		$user->save();

		return redirect('admin/users/'.$id);
	}

	public function addMeta(Request $request){
		$id = $request->input('id');
		$key = $request->input('key');
		$value = $request->input('value');
		if($key != ""){
			$user = $this->users->find($id);
			$user->setMeta($key, $value);
			$user->save();
		}
		return redirect('admin/users/'.$id);
	}

	public function deleteMeta($id, $meta){
		$user = $this->users->find($id);
		unset($user->$meta);
		$user->save();
		return redirect('admin/users/'.$id);
	}

	public function permissions($id){
		$user = $this->users->find($id);
		$roles = new Role;
		$roles = $roles->all();
		return view('admin.Users.user_permissions')
				 ->with('user', $user)
				 ->with('roles', $roles);
	}

	public function addPermission($id, $role_id){
		$user = $this->users->find($id);
		$user->attachRole($role_id);
		return redirect('admin/users/'.$id.'/permissions');
	}

	public function removePermission($id, $role_id){
		$user = $this->users->find($id);
		$user->detachRole($role_id);
		return redirect('admin/users/'.$id.'/permissions');
	}

}
