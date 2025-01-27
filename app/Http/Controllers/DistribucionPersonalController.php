<?php

namespace App\Http\Controllers;

use App\Models\AuxAreas;
use App\Models\AuxCargos;
use App\Models\AuxProfesion;
use App\Models\Distribucion;
use App\Models\Distribucion_Personal;
use App\Models\DistribucionPersonal;
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

    $modeloDistribucion = Distribucion::findOrFail($distribucion->id); // Obtén el registro completo

    $personal = (object)[
      'distribucion_id' => $modeloDistribucion->id, // Usas el ID del modelo
      'fuera' => 0,
    ];

    $distribuciones = Distribucion::all(); // Dropdown para representaciones

    $areas = AuxAreas::orderBy('area', 'asc')->get();
    $cargos = AuxCargos::orderBy('cargo', 'asc')->get();
    $profesiones = AuxProfesion::where('distribuciones', 'SI') // Filtrar donde distribuciones sea igual a "SI"
      ->orderBy('nombreprofesion', 'asc') // Ordenar por "nombreprofesion"
      ->get();

    return view('pages.Distribucion.Personal.create', compact('personal', 'distribuciones', 'areas', 'cargos', 'profesiones'));
  }

  /**
   * Store a newly created resource in storage.
   */

  public function store(Request $request)
  {

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
      // 'fuera' => 'nullable|boolean',
    ], [
      'nombre.required' => 'El nombre es obligatorio.',
      'apellido.required' => 'El apellido es obligatorio.',
      'distribucion_id.required' => 'Debe seleccionar una distribución.',
      'distribucion_id.exists' => 'La distribución seleccionada no es válida.',
      'email.email' => 'El correo electrónico no tiene un formato válido.',
      'fuera.in' => 'El campo "Fuera" debe ser 0, 1, o -1.',
    ]);

    // Override 'fuera' with the correct value
    $validated['fuera'] = $request->has('fuera') ? true : false;
    $validated['status'] = 'A';

    DistribucionPersonal::create($validated);

    // dd($request->distribucion_id);

    return redirect()
      ->route('distribucion.show', $request->distribucion_id)
      ->with('success', 'Distribución personal creada exitosamente.');
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
    $personal = DistribucionPersonal::findOrFail($id); // Obtén el registro por ID
    $distribuciones = Distribucion::all(); // Dropdown para representaciones
    $areas = AuxAreas::orderBy('area', 'asc')->get(); // Ordenar áreas por nombre
    $cargos = AuxCargos::orderBy('cargo', 'asc')->get(); // Ordenar cargos por nombre
    $profesiones = AuxProfesion::where('distribuciones', 'SI') // Filtrar donde distribuciones sea igual a "SI"
      ->orderBy('nombreprofesion', 'asc') // Ordenar por "nombreprofesion"
      ->get();

    return view('Pages.Distribucion.Personal.edit', compact('personal', 'distribuciones', 'areas', 'cargos', 'profesiones'));
  }

  /**
   * Update the specified resource in storage.
   */

  public function update(Request $request, $id)
  {
    $distribucionPersonal = DistribucionPersonal::findOrFail($id);

    // Check if 'fuera' checkbox is checked
    // If checked, set to 1; if not, set to 0 or -1 based on your requirements
    // $fuera = $request->has('fuera') ? 1 : 0; // or you could use -1 if needed for unchecked

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
      // 'fuera' => 'nullable|in:0,1,-1', // Allow 0, 1, or -1
    ], [
      'nombre.required' => 'El nombre es obligatorio.',
      'apellido.required' => 'El apellido es obligatorio.',
      'distribucion_id.required' => 'Debe seleccionar una distribución.',
      'distribucion_id.exists' => 'La distribución seleccionada no es válida.',
      'email.email' => 'El correo electrónico no tiene un formato válido.',
      'fuera.in' => 'El campo "Fuera" debe ser 0, 1, o -1.', // Custom error message for "fuera"
    ]);

    // Override 'fuera' with the correct value
    // $validated['fuera'] = $fuera;
    $validated['fuera'] = $request->has('fuera') ? true : false;


    // Update the record
    $distribucionPersonal->update($validated);

    return redirect()
      ->route('distribucion.show', $request->distribucion_id)
      ->with('success', 'Los datos del personal fueron actualizados exitosamente.');
  }




  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    // Buscar el registro
    $persona = DistribucionPersonal::findOrFail($id);

    // dd($id, $persona);

    // Cambiar el status a 'D'
    $persona->update(['status' => 'D']);

    // Redirigir al detalle de la distribución
    return redirect()
      ->route('distribucion.show', ['distribucion' => $persona->distribucion_id])
      ->with('success', 'El personal ha sido desactivado con éxito.');
  }
}