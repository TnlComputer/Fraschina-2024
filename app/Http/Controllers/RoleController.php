<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
  public function index()
  {
    $roles = Role::with('permissions')->paginate(10);
    return view('Pages.Tools.Role.index', compact('roles'));
  }

  public function create()
  {
    $permissions = Permission::all();
    return view('Pages.Tools.Role.create', compact('permissions'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|unique:roles|max:255',
      'permissions' => 'array',
    ]);

    $role = Role::create(['name' => $request->name]);
    $role->syncPermissions($request->permissions);

    return redirect()->route('roles.index')->with('success', 'Rol creado correctamente.');
  }

  public function edit(Role $role)
  {
    $permissions = Permission::all();
    return view('Pages.Tools.Role.edit', compact('role', 'permissions'));
  }

  public function update(Request $request, Role $role)
  {
    $request->validate([
      'name' => 'required|max:255|unique:roles,name,' . $role->id,
      'permissions' => 'array',
    ]);

    $role->update(['name' => $request->name]);
    $role->syncPermissions($request->permissions);

    return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente.');
  }

  public function destroy(Role $role)
  {
    $role->delete();
    return redirect()->route('roles.index')->with('success', 'Rol eliminado correctamente.');
  }
}