<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\select;

class UsuarioController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    // dd($request, 'aca entro');
    $name = trim($request->get('name'));
    $sortField = $request->get('sort', 'name'); // Campo por defecto


    // Comienza la consulta con los usuarios activos
    $query = User::where('is_active', '=', '1')
      ->where('permiso', '!=', 99);  // Filtra solo usuarios activos y no con permiso 99

    // Si hay un filtro de nombre o correo, se agregan las condiciones de búsqueda
    if ($name) {
      $query->where(function ($q) use ($name) {
        $q->where('name', 'like', '%' . $name . '%')
          ->orWhere('email', 'like', '%' . $name . '%');
      });
    }

    // Ejecuta la consulta y paginación
    $usuarios = $query->orderBy($sortField)->paginate(15);
    // dd($usuarios);

    // Devuelve la vista con los usuarios
    return view('Pages.Tools.Usuario.index', compact('usuarios', 'name'));
  }


  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
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
  public function edit(string $id)
  {
    //
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
}