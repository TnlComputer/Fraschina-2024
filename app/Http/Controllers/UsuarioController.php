<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use function Laravel\Prompts\select;

class UsuarioController extends Controller
{
  /**
   * Display a listing of the resource.
   */

  public function index(Request $request)
  {
    $name = trim($request->get('name'));
    $sortField = $request->get('sort', 'name'); // Campo por defecto

    // Comienza la consulta con los usuarios activos
    $query = User::where('is_active', '=', '1')
      ->where('permiso', '!=', 99)  // Filtra solo usuarios activos y no con permiso 99
      ->with('roles.permissions'); // Cargar roles y permisos

    // Si hay un filtro de nombre o correo, se agregan las condiciones de búsqueda
    if ($name) {
      $query->where(function ($q) use ($name) {
        $q->where('name', 'like', '%' . $name . '%')
          ->orWhere('email', 'like', '%' . $name . '%');
      });
    }

    // Ejecuta la consulta y paginación
    $usuarios = $query->orderBy($sortField)->paginate(15);
    $roles = Role::all(); // Obtiene todos los roles

    // Devuelve la vista con los usuarios
    return view('Pages.Tools.Usuario.index', compact('usuarios', 'name', 'roles'));
  }


  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $roles = Role::all(); // Obtiene todos los roles
    return view('Pages.Tools.Usuario.create', compact('roles'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    // dd($request->all());
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|string|min:8|confirmed',
      'role' => 'required|exists:roles,id', // Validar que el rol exista
    ]);


    try {
      $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'permiso' => $request->role,
        'is_active' => true, // Siempre true
      ]);

      // Encuentra el rol por ID y asigna al usuario
      $role = Role::find($request->role);
      if (!$role) {
        return redirect()->back()->withErrors(['role' => 'El rol seleccionado no existe.'])->withInput();
      }

      $user->assignRole($role->name); // Asigna el rol usando el nombre

      return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(['error' => 'Ocurrió un error: ' . $e->getMessage()])->withInput();
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(User $user)
  {
    $roles = Role::all();
    $permissions = Permission::all();

    return view('Pages.Tools.Usuario.edit', compact('usuarios', 'roles', 'permissions'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
  public function deactivate($id)
  {
    $user = User::findOrFail($id);
    $user->update(['is_active' => 0]);

    return redirect()->route('usuarios.index')->with('success', 'Usuario desactivado correctamente');
  }

  public function activate($id)
  {
    $user = User::findOrFail($id);
    $user->update(['is_active' => 1]);

    return redirect()->route('usuarios.index')->with('success', 'Usuario activado correctamente');
  }
}
