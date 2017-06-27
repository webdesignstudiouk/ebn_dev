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
			return view('admin.roles.roles')
			   ->with('roles', $roles);
	}

	public function role($id){
		$role = Role::find($id);
		return view('admin.roles.role.edit')
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
        flash('Role Updated', 'success');
		return back();
	}

  public function permissions($id){
      $role = Role::find($id);
      $permissionModel = new Permission();
      $permissions = Permission::pluck('name', 'id')->toArray();
      return view('admin.roles.role.permissions')
      ->with('role', $role)
      ->with('permissions', $permissions)
      ->with('permissionModel', $permissionModel);
	}

  public function createPermission(Request $request){
    $id = $request->input('role_id');
    $group_id = $request->input('group_id');
    $name = $request->input('name');
    $slug = $request->input('slug');
    $description = $request->input('description');
    $permission = new Permission;
    $permission->group_id = $group_id;
    $permission->name = $name;
    $permission->slug = $slug;
    $permission->description = $description;
    $permission->save();
    flash('Permission Created', 'success');
    return back();
  }

  public function updatePermissions(Request $request){
    $role = Role::find($request->role_id);
    $permissionModel = new Permission();
    $permissions_in_group = $permissionModel->where('group_id', $request->group_id)->get();
      //detach permissions
      if($permissions_in_group) {
          foreach ($permissions_in_group as $permission) {
              $role->detachPermission($permission->id);
          }
      }
      //attach chosen permsissions
      if($request->permission) {
          foreach (array_keys($request->permission) as $permission) {
              $role->attachPermission($permission);
          }
      }
    flash('Permissions Updated', 'success');
    return back();
  }

  public function removePermission(Request $request){
    $id = $request->input('role_id');
    $permissionId = $request->input('permission_id');
    $role = Role::find($id);
    $role->detachPermission($permissionId);
    flash('Permission Removed', 'success');
    return back();
  }
}
