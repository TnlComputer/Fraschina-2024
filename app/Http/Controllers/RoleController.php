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

    //   $roles = Role::with('permissions')->paginate(10);
    // $permissions = Permission::all();
    // return view('Pages.Tools.Role.index', compact('roles', 'permissions'));
  }


  public function create()
  {
    // $permissions = Permission::all();
    $permissions = Permission::where('name', '!=', 'permiso_99')->get();
    return view('Pages.Tools.Role.create', compact('permissions'));
  }

  // public function store(Request $request)
  // {
  //   $request->validate([
  //     'name' => 'required|unique:roles|max:255',
  //     'permissions' => 'array',
  //   ]);

  //   $role = Role::create(['name' => $request->name]);
  //   $role->syncPermissions($request->permissions);

  //   return redirect()->route('roles.index')->with('success', 'Rol creado correctamente.');
  // }

  public function store(Request $request)
  {
    // Validar los datos de entrada
    $request->validate([
      'name' => 'required|string|max:255|unique:roles,name', // Nombre único para el rol
      'permissions' => 'nullable|array', // Los permisos pueden ser opcionales
      'permissions.*' => 'exists:permissions,id', // Cada permiso debe existir en la tabla
    ]);

    // Crear el rol con el nombre proporcionado
    $role = Role::create(['name' => $request->name]);

    // Convertir los IDs de permisos a nombres
    $permissions = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();

    // Asignar permisos al rol
    $role->syncPermissions($permissions);

    return redirect()->route('roles.index')->with('success', 'Rol creado correctamente.');
  }

  public function edit(Role $role)
  {
    // $permissions = Permission::all();
    $permissions = Permission::where('name', '!=', 'permiso_99')->get();
    return view('Pages.Tools.Role.edit', compact('role', 'permissions'));
  }

  // public function update(Request $request, Role $role)
  // {
  //   $request->validate([
  //     'name' => 'required|max:255|unique:roles,name,' . $role->id,
  //     'permissions' => 'array',
  //   ]);

  //   $role->update(['name' => $request->name]);
  //   $role->syncPermissions($request->permissions);

  //   return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente.');
  // }

  public function update(Request $request, $id)
  {
    // Validar los datos de entrada
    $request->validate([
      'name' => 'required|string|max:255|unique:roles,name,' . $id,
      'permissions' => 'nullable|array', // Los permisos pueden ser nulos
      'permissions.*' => 'exists:permissions,id', // Cada permiso debe existir en la tabla
    ]);

    // Buscar el rol por ID
    $role = Role::findOrFail($id);

    // Actualizar el nombre del rol
    $role->update(['name' => $request->name]);

    // Convertir los IDs de permisos a nombres
    $permissions = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();

    // Sincronizar los permisos del rol
    $role->syncPermissions($permissions);

    return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente.');
  }



  public function destroy(Role $role)
  {
    $role->delete();
    return redirect()->route('roles.index')->with('success', 'Rol eliminado correctamente.');
  }
}
