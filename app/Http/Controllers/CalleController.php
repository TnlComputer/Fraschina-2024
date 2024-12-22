<?php

namespace App\Http\Controllers;

use App\Models\AuxCalles;
use Illuminate\Http\Request;

class CalleController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $name = trim($request->get('name'));

    // Comienza la consulta base
    $query = AuxCalles::query();
    $sortField = $request->get('sort', 'calle'); // Campo por defecto

    // Si hay un filtro de nombre, se agrega la condición
    if ($name) {
      $query->where('calle', 'like', '%' . $name . '%');
    }

    // Ejecuta la consulta y agrega paginación
    $calles = $query->orderBy($sortField)->paginate(15);

    // Devuelve la vista con las calles y el filtro de búsqueda
    return view('Pages.Tools.Calle.index', compact('calles', 'name'));
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
