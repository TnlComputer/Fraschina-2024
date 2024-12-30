<?php

namespace App\Http\Controllers;

use App\Models\AuxAreas;
use App\Models\AuxCargos;
use App\Models\AuxProfesion;
use App\Models\Distribucion;
use App\Models\Distribucion_Personal;
use Illuminate\Http\Request;

class DistribucionPersonalController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(Distribucion $distribucion)
  {
    $distribucion = Distribucion::findOrFail($distribucion->id);

    $areas = AuxAreas::orderBy('area', 'asc')->get();
    $cargos = AuxCargos::orderBy('cargo', 'asc')->get();
    $profesiones = AuxProfesion::orderBy('nombreprofesion', 'asc')->get();

    return view('distribucion_personal.create', compact('distribucion', 'areas', 'cargos', 'profesiones'));
  }

  /**
   * Store a newly created resource in storage.
   */

  public function store(Request $request)
  {
    $validated = $request->validate([
      'nombre' => 'required|string|max:150',
      'apellido' => 'string|max:150',
      'distribucion_id' => 'required|integer',
      'area_id' => 'required|integer',
      'cargo_id' => 'required|integer',
      'categoriacargo_id' => 'required|integer',
      'teldirecto' => 'nullable|string|max:50',
      'interno' => 'nullable|string|max:50',
      'telcelular' => 'nullable|string|max:50',
      'profesion_id' => 'required|integer',
      'telparticular' => 'nullable|string|max:50',
      'email' => 'nullable|email|max:150',
      'observaciones' => 'nullable|string',
    ]);

    $validated['fuera'] = 0;
    $validated['status'] = 'A';

    Distribucion_Personal::create($validated);

    return redirect()->route('distribucion.show, $request->distribucion_id')->with('success', 'Distribución personal creada exitosamente.');
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
    $personal = Distribucion_Personal::findOrFail($id); // Obtén el registro por ID
    $distribuciones = Distribucion::all(); // Dropdown para representaciones
    $areas = AuxAreas::orderBy('area', 'asc')->get(); // Ordenar áreas por nombre
    $cargos = AuxCargos::orderBy('cargo', 'asc')->get(); // Ordenar cargos por nombre
    $profesiones = AuxProfesion::orderBy('nombreprofesion', 'asc')->get(); // Ordenar profesiones por nombre

    return view('Pages.Distribucion.Personal.edit', compact('personal', 'distribuciones', 'areas', 'cargos', 'profesiones'));
  }

  /**
   * Update the specified resource in storage.
   */

  public function update(Request $request, $id)
  {
    $distribucionPersonal = Distribucion_Personal::findOrFail($id);


    $validated = $request->validate([
      'nombre' => 'required|string|max:150',
      'apellido' => 'required|string|max:150',
      'distribucion_id' => 'required|exists:distribucions,id',
      'area_id' => 'nullable|exists:auxareas,id',
      'cargo_id' => 'nullable|exists:auxcargos,id',
      'teldirecto' => 'nullable|max:50',
      'interno' => 'nullable|max:50',
      'telcelular' => 'nullable|max:50',
      'profesion_id' => 'nullable|exists:auxprofesiones,id',
      'telparticular' => 'nullable|max:50',
      'email' => 'nullable|email|max:150',
      'observaciones' => 'nullable',
      'fuera' => 'nullable|boolean', // No es obligatorio ya que tiene valor por defecto
      'status' => 'nullable|in:A,D', // No es obligatorio ya que tiene valor por defecto
    ], [
      'nombre.required' => 'El nombre es obligatorio.',
      'apellido.required' => 'El apellido es obligatorio.',
      'representacion_id.required' => 'Debe seleccionar una representación.',
      'representacion_id.exists' => 'La representación seleccionada no es válida.',
      'email.email' => 'El correo electrónico no tiene un formato válido.',
      'status.in' => 'El estado debe ser "A" (Activo) o "D" (Desactivado).',
    ]);
    // dd($request->all(), $validated);

    $distribucionPersonal->update($validated);

    return redirect()->route('distribucion.show', $request->distribucion_id)->with('success', 'Distribución personal actualizada exitosamente.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}