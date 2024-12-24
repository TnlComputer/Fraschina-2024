<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
  public function index()
  {
    $permissions = Permission::paginate(10);
    return view('Pages.Tools.Permiso.index', compact('permissions'));
  }

  public function create()
  {
    return view('permissions.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|unique:permissions|max:255',
    ]);

    Permission::create(['name' => $request->name]);

    return redirect()->route('permissions.index')->with('success', 'Permiso creado correctamente.');
  }

  public function edit(Permission $permission)
  {
    return view('Pages.Tools.Permiso.edit', compact('permission'));
  }

  public function update(Request $request, Permission $permission)
  {
    $request->validate([
      'name' => 'required|max:255|unique:permissions,name,' . $permission->id,
    ]);

    $permission->update(['name' => $request->name]);

    return redirect()->route('permissions.index')->with('success', 'Permiso actualizado correctamente.');
  }

  public function destroy(Permission $permission)
  {
    $permission->delete();
    return redirect()->route('permissions.index')->with('success', 'Permiso eliminado correctamente.');
  }
}