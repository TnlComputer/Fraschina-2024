<?php

namespace App\Http\Controllers;

use App\Models\ExpedicionGeneral;
use Illuminate\Http\Request;

class ExpedicionGeneralController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $name = $request->name;

    // Iniciar la consulta ordenada por fecha
    $query = ExpedicionGeneral::orderBy('fecha', 'DESC');

    // Asegurar que solo se obtienen registros con 'status' = 'A'
    $query->where('status', 'A');

    // Búsqueda general en MO, CL y Modo Prod
    if ($request->filled('search')) {
      $search = $request->search;
      $query->where(function ($q) use ($search) {
        $q->where('mo', 'like', "%$search%")
          ->orWhere('cl', 'like', "%$search%")
          ->orWhere('modo_prod', 'like', "%$search%");
      });
    }

    // Filtros individuales
    if ($request->filled('mo')) {
      $query->where('mo', 'like', '%' . $request->mo . '%');
    }
    if ($request->filled('cl')) {
      $query->where('cl', 'like', '%' . $request->cl . '%');
    }
    if ($request->filled('modo')) {
      $query->where('modo', 'like', '%' . $request->modo . '%');
    }
    if ($request->filled('prod')) {
      $query->where('prod', 'like', '%' . $request->prod . '%');
    }

    // Filtro por fecha exacta
    if ($request->filled('fecha')) {
      $query->whereDate('fecha', $request->fecha);
    }

    // Filtro por año
    if ($request->filled('year')) {
      $query->whereYear('fecha', $request->year);
    }

    // Obtener los resultados paginados
    $expedicion_general = $query->paginate(15);

    return view('pages.Expedicion.General.index', compact('expedicion_general', 'name'));
  }

  /**
   * Show the form for creating a new resource.
   */
  // Mostrar el formulario para crear un nuevo registro
  public function create()
  {
    return view('expedicion_general.create');
  }

  // Almacenar el nuevo registro en la base de datos
  public function store(Request $request)
  {
    $request->validate([
      'fecha' => 'required|date',
      'mo' => 'required|max:5',
      'cl' => 'required|max:5',
      'modo' => 'nullable|string',
      'prod' => 'nullable|string',
      'p' => 'nullable|numeric',
      'l' => 'nullable|numeric',
      'pl' => 'nullable|numeric',
      'w' => 'nullable|numeric',
      'gh' => 'nullable|numeric',
      'gs' => 'nullable|numeric',
      'hum' => 'nullable|numeric',
      'cz' => 'nullable|numeric',
      'est' => 'nullable|numeric',
      'abs' => 'nullable|numeric',
      'fn' => 'nullable|numeric',
      'punt' => 'nullable|numeric',
      'particularidades' => 'nullable|string',
    ]);

    ExpedicionGeneral::create($request->all());

    return redirect()->route('expedicion_general.index')->with('success', 'Expedición creada exitosamente.');
  }

  /**
   * Display the specified resource.
   */
  public function show(ExpedicionGeneral $expedicionGeneral)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  // Mostrar el formulario para editar un registro
  public function edit($id)
  {
    $expedicionGeneral = ExpedicionGeneral::findOrFail($id);
    return view('expedicion_general.edit', compact('expedicionGeneral'));
  }

  /**
   * Update the specified resource in storage.
   */
  // Actualizar un registro existente
  public function update(Request $request, $id)
  {
    $request->validate([
      'fecha' => 'required|date',
      'mo' => 'required|max:5',
      'cl' => 'required|max:5',
      'modo' => 'nullable|string',
      'prod' => 'nullable|string',
      'p' => 'nullable|numeric',
      'l' => 'nullable|numeric',
      'pl' => 'nullable|numeric',
      'w' => 'nullable|numeric',
      'gh' => 'nullable|numeric',
      'gs' => 'nullable|numeric',
      'hum' => 'nullable|numeric',
      'cz' => 'nullable|numeric',
      'est' => 'nullable|numeric',
      'abs' => 'nullable|numeric',
      'fn' => 'nullable|numeric',
      'punt' => 'nullable|numeric',
      'particularidades' => 'nullable|string',
    ]);

    $expedicionGeneral = ExpedicionGeneral::findOrFail($id);
    $expedicionGeneral->update($request->all());

    return redirect()->route('expedicion_general.index')->with('success', 'Expedición actualizada exitosamente.');
  }


  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    // Buscar el registro por ID
    $expedicionGeneral = ExpedicionGeneral::findOrFail($id);

    // Cambiar el estado de "A" a "D"
    $expedicionGeneral->status = 'D';
    $expedicionGeneral->save();

    // Redirigir con un mensaje de éxito
    return redirect()->route('expedicion_general.index')->with('success', 'Expedición desactivada correctamente.');
  }
}
