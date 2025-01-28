<?php

namespace App\Http\Controllers;

use App\Models\AuxVeraz;
use Illuminate\Http\Request;

class VerazController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $name = trim($request->get('name'));
    $sortField = $request->get('sort', 'estado'); // Campo por defecto

    // Comienza la consulta base
    $query = AuxVeraz::query();

    // Si hay un filtro de nombre, se agrega la condición
    if ($name) {
      $query->where('estado', 'like', '%' . $name . '%');
    }

    // Aplica la paginación después de construir la consulta
    $verazes = $query->orderBy($sortField)->paginate(15);

    // Retorna la vista con los datos
    return view('pages.Tools.Veraz.index', compact('verazes', 'name'));
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