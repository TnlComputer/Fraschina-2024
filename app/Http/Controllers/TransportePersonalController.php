<?php

namespace App\Http\Controllers;

use App\Models\AuxAreas;
use App\Models\AuxCargos;
use App\Models\AuxProfesion;
use App\Models\Transporte;
use App\Models\Transporte_Personal;
use Illuminate\Http\Request;

class TransportePersonalController extends Controller
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
  public function create(Transporte $transporte)
  {
    $modeloTransporte = Transporte::findOrFail($transporte->id); // Obtén el registro completo

    $personal = (object)[
      'transporte_id' => $modeloTransporte->id, // Usas el ID del modelo
      'fuera' => 0,
    ];

    $transportes = Transporte::all(); // Dropdown para representaciones

    $areas = AuxAreas::orderBy('area', 'asc')->get();
    $cargos = AuxCargos::orderBy('cargo', 'asc')->get();
    $profesiones = AuxProfesion::where('transportes', 'SI') // Filtrar donde distribuciones sea igual a "SI"
      ->orderBy('nombreprofesion', 'asc') // Ordenar por "nombreprofesion"
      ->get();

    return view('pages.Transporte.Personal.create', compact('personal', 'transportes', 'areas', 'cargos', 'profesiones'));
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
      'transporte_id' => 'required|integer|exists:transportes,id',
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
      'transporte_id.exists' => 'El transporte seleccionado no es válido.',
      // Más mensajes personalizados...
    ]);

    // dd($validatedData);

    // Crear el nuevo registro
    // TransportePersonal::create(array_merge($validatedData, [
    //   'fuera' => 0, // Valor predeterminado
    //   'status' => 'A', // Valor predeterminado
    // ]));
    try {
      Transporte_Personal::create(array_merge($validatedData, [
        'fuera' => 0,
        'status' => 'A',
      ]));
    } catch (\Exception $e) {
      // \Log ::error('Error al crear personal del transporte: ' . $e->getMessage());
      return back()->withErrors('Hubo un error al guardar el registro.');
    }

    // Redirigir al índice con un mensaje de éxito
    return redirect()->route('transporte.show', $request->transporte_id)
      ->with('success', 'Personal del transporte creado exitosamente.');
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
    $personal = Transporte_Personal::findOrFail($id); // Obtén el registro por ID
    $transportes = Transporte::all(); // Dropdown para representaciones
    $areas = AuxAreas::orderBy('area', 'asc')->get(); // Ordenar áreas por nombre
    $cargos = AuxCargos::orderBy('cargo', 'asc')->get(); // Ordenar cargos por nombre
    $profesiones = AuxProfesion::where('transportes', 'SI') // Filtrar donde distribuciones sea igual a "SI"
      ->orderBy('nombreprofesion', 'asc') // Ordenar por "nombreprofesion"
      ->get();

    return view('Pages.Transporte.Personal.edit', compact('personal', 'transportes', 'areas', 'cargos', 'profesiones'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    // dd($request);

    $transportePersonal = Transporte_Personal::findOrFail($id);

    $validated = $request->validate([
      'nombre' => 'required|string|max:150',
      'apellido' => 'required|string|max:150',
      'transporte_id' => 'required|exists:transportes,id',
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
      'transporte_id.required' => 'Debe seleccionar una distribución.',
      'transporte_id.exists' => 'La distribución seleccionada no es válida.',
      'email.email' => 'El correo electrónico no tiene un formato válido.',
      'fuera.in' => 'El campo "Fuera" debe ser 0, 1, o -1.', // Custom error message for "fuera"
    ]);

    // Override 'fuera' with the correct value
    // $validated['fuera'] = $fuera;
    $validated['fuera'] = $request->has('fuera') ? true : false;

    // dd($validated);

    // Update the record
    $transportePersonal->update($validated);

    return redirect()
      ->route('transporte.show', $request->transporte_id)
      ->with('success', 'Los datos del personal fueron actualizados exitosamente.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    // Buscar el registro
    $persona = Transporte_Personal::findOrFail($id);

    // Cambiar el status a 'D'
    $persona->update(['status' => 'D']);

    // Redirigir al detalle de la distribución con mensaje de éxito
    return redirect()
      ->route('transporte.show', ['transporte' => $persona->transporte_id])
      ->with('success', 'El personal ha sido desactivado con éxito.');
  }
}
