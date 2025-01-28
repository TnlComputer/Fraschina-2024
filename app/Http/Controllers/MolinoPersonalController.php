<?php

namespace App\Http\Controllers;

use App\Models\AuxAreas;
use App\Models\AuxCargos;
use App\Models\AuxProfesion;
use App\Models\Molino;
use App\Models\MolinoPersonal;
use Illuminate\Http\Request;

class MolinoPersonalController extends Controller
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
  public function create(Molino $molino)
  {
    $modeloMolino = Molino::findOrFail($molino->id); // Obtén el registro completo

    $personal = (object)[
      'molino_id' => $modeloMolino->id, // Usas el ID del modelo
      'fuera' => 0,
    ];

    $molinos = Molino::all(); // Dropdown para representaciones

    $areas = AuxAreas::orderBy('area', 'asc')->get();
    $cargos = AuxCargos::orderBy('cargo', 'asc')->get();
    $profesiones = AuxProfesion::where('molinos', 'SI') // Filtrar donde distribuciones sea igual a "SI"
      ->orderBy('nombreprofesion', 'asc') // Ordenar por "nombreprofesion"
      ->get();

    return view('pages.Molino.Personal.create', compact('personal', 'molinos', 'areas', 'cargos', 'profesiones'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    // dd($request);

    $validatedData = $request->validate([
      'nombre' => 'required|string|max:150',
      'apellido' => 'required|string|max:150',
      'molino_id' => 'required|integer|exists:molinos,id',
      'area_id' => 'required|integer|exists:auxareas,id',
      'cargo_id' => 'required|integer|exists:auxcargos,id',
      'teldirecto' => 'nullable|string|max:50',
      'interno' => 'nullable|string|max:50',
      'telcelular' => 'nullable|string|max:50',
      'profesion_id' => 'nullable|integer|exists:auxprofesiones,id',
      'telparticular' => 'nullable|string|max:50',
      'email' => 'nullable|email|max:150',
      'observaciones' => 'nullable|string',
    ], [
      'nombre.required' => 'El campo Nombre es obligatorio.',
      'apellido.required' => 'El campo Apellido es obligatorio.',
      'molino_id.exists' => 'El molino seleccionado no es válido.',
      // Más mensajes personalizados...
    ]);

    // dd($validatedData);

    // Crear el nuevo registro
    // MolinoPersonal::create(array_merge($validatedData, [
    //   'fuera' => 0, // Valor predeterminado
    //   'status' => 'A', // Valor predeterminado
    // ]));
    try {
      MolinoPersonal::create(array_merge($validatedData, [
        'fuera' => 0,
        'status' => 'A',
      ]));
    } catch (\Exception $e) {
      // \Log ::error('Error al crear personal del molino: ' . $e->getMessage());
      return back()->withErrors('Hubo un error al guardar el registro.');
    }

    // Redirigir al índice con un mensaje de éxito
    return redirect()->route('molino.show', $request->molino_id)
      ->with('success', 'Personal del molino creado exitosamente.');
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
    $personal = MolinoPersonal::findOrFail($id); // Obtén el registro por ID
    $molinos = Molino::all(); // Dropdown para representaciones
    $areas = AuxAreas::orderBy('area', 'asc')->get(); // Ordenar áreas por nombre
    $cargos = AuxCargos::orderBy('cargo', 'asc')->get(); // Ordenar cargos por nombre
    $profesiones = AuxProfesion::where('molinos', 'SI') // Filtrar donde distribuciones sea igual a "SI"
      ->orderBy('nombreprofesion', 'asc') // Ordenar por "nombreprofesion"
      ->get();

    return view('pages.Molino.Personal.edit', compact('personal', 'molinos', 'areas', 'cargos', 'profesiones'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    // dd($request);

    $molinoPersonal = MolinoPersonal::findOrFail($id);

    $validated = $request->validate([
      'nombre' => 'required|string|max:150',
      'apellido' => 'required|string|max:150',
      'molino_id' => 'required|exists:molinos,id',
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
      'molino_id.required' => 'Debe seleccionar una distribución.',
      'molino_id.exists' => 'La distribución seleccionada no es válida.',
      'email.email' => 'El correo electrónico no tiene un formato válido.',
      'fuera.in' => 'El campo "Fuera" debe ser 0, 1, o -1.', // Custom error message for "fuera"
    ]);

    // Override 'fuera' with the correct value
    // $validated['fuera'] = $fuera;
    $validated['fuera'] = $request->has('fuera') ? true : false;

    // dd($validated);

    // Update the record
    $molinoPersonal->update($validated);

    return redirect()
      ->route('molino.show', $request->molino_id)
      ->with('success', 'Los datos del personal fueron actualizados exitosamente.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    // dd($id);

    // Buscar el registro
    $persona = MolinoPersonal::findOrFail($id);

    // dd($id, $persona);

    // Cambiar el status a 'D'
    $persona->update(['status' => 'D']);

    // Redirigir al detalle de la distribución
    return redirect()
      ->route('molino.show', ['molino' => $persona->molino_id])
      ->with('success', 'El personal ha sido desactivado con éxito.');
  }
}