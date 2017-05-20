<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Bican\Roles\Models\Role as Role;
use Bican\Roles\Models\Permission as Permission;

class Roles extends Controller
{
	public function __construct(){
		$this->roles = Role::all();
	}

	public function roles(){
      $roles = Role::all();
			return view('admin.Roles.roles')
			   ->with('roles', $roles);
	}

	public function role($id){
		$role = Role::find($id);
		return view('admin.Roles.role')
				 ->with('role', $role);
	}

	public function updateRole(Request $request){
		$id = $request->input('role_id');
    $name = $request->input('name');
    $slug = $request->input('slug');
    $description = $request->input('description');

		$role = Role::find($id);
    $role->name = $name;
    $role->slug = $slug;
    $role->description = $description;
		$role->save();

		return back();
	}

  public function permissions($id){
      $role = Role::find($id);
      $permissions = Permission::pluck('name', 'id')->toArray();
			return view('admin.Roles.Permissions.permissions')
			   ->with('role', $role)
         ->with('permissions', $permissions);
	}

  public function createPermission(Request $request){
    $id = $request->input('role_id');
    $name = $request->input('name');
    $slug = $request->input('slug');
    $description = $request->input('description');
    $permission = new Permission;
    $permission->name = $name;
    $permission->slug = $slug;
    $permission->description = $description;
    $permission->save();
    return back();
  }

  public function addPermission(Request $request){
    $id = $request->input('role_id');
    $permissionId = $request->input('permission_id');
    $role = Role::find($id);
    $role->attachPermission($permissionId);
    return back();
  }

  public function removePermission(Request $request){
    $id = $request->input('role_id');
    $permissionId = $request->input('permission_id');
    $role = Role::find($id);
    $role->detachPermission($permissionId);
    return back();
  }
}
