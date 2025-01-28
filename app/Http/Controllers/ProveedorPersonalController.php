<?php

namespace App\Http\Controllers;

use App\Models\AuxAreas;
use App\Models\AuxCargos;
use App\Models\AuxProfesion;
use App\Models\Proveedor;
use App\Models\ProveedorPersonal;
use Illuminate\Http\Request;

class ProveedorPersonalController extends Controller
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
  public function create(Proveedor $proveedor)
  {
    $modeloProveedor = Proveedor::findOrFail($proveedor->id); // Obtén el registro completo

    $personal = (object)[
      'proveedor_id' => $modeloProveedor->id, // Usas el ID del modelo
      'fuera' => 0,
    ];

    $proveedores = Proveedor::all(); // Dropdown para representaciones

    $areas = AuxAreas::orderBy('area', 'asc')->get();
    $cargos = AuxCargos::orderBy('cargo', 'asc')->get();
    $profesiones = AuxProfesion::where('proveedores', 'SI') // Filtrar donde distribuciones sea igual a "SI"
      ->orderBy('nombreprofesion', 'asc') // Ordenar por "nombreprofesion"
      ->get();

    return view('pages.Proveedor.Personal.create', compact('personal', 'proveedores', 'areas', 'cargos', 'profesiones'));
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
      'proveedor_id' => 'required|integer|exists:proveedores,id',
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
      'proveedor_id.exists' => 'El proveedor seleccionado no es válido.',
      // Más mensajes personalizados...
    ]);

    // dd($validatedData);

    // Crear el nuevo registro
    // ProveedorPersonal::create(array_merge($validatedData, [
    //   'fuera' => 0, // Valor predeterminado
    //   'status' => 'A', // Valor predeterminado
    // ]));
    try {
      ProveedorPersonal::create(array_merge($validatedData, [
        'fuera' => 0,
        'status' => 'A',
      ]));
    } catch (\Exception $e) {
      // \Log ::error('Error al crear personal del proveedor: ' . $e->getMessage());
      return back()->withErrors('Hubo un error al guardar el registro.');
    }

    // Redirigir al índice con un mensaje de éxito
    return redirect()->route('proveedor.show', $request->proveedor_id)
      ->with('success', 'Personal del proveedor creado exitosamente.');
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
    $personal = ProveedorPersonal::findOrFail($id); // Obtén el registro por ID
    $proveedores = Proveedor::all(); // Dropdown para representaciones
    $areas = AuxAreas::orderBy('area', 'asc')->get(); // Ordenar áreas por nombre
    $cargos = AuxCargos::orderBy('cargo', 'asc')->get(); // Ordenar cargos por nombre
    $profesiones = AuxProfesion::where('proveedores', 'SI') // Filtrar donde distribuciones sea igual a "SI"
      ->orderBy('nombreprofesion', 'asc') // Ordenar por "nombreprofesion"
      ->get();

    return view('pages.Proveedor.Personal.edit', compact('personal', 'proveedores', 'areas', 'cargos', 'profesiones'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    // dd($request);

    $proveedorPersonal = ProveedorPersonal::findOrFail($id);

    $validated = $request->validate([
      'nombre' => 'required|string|max:150',
      'apellido' => 'required|string|max:150',
      'proveedor_id' => 'required|exists:proveedores,id',
      'area_id' => 'required|exists:auxareas,id',
      'cargo_id' => 'required|exists:auxcargos,id',
      'teldirecto' => 'nullable|max:50',
      'interno' => 'nullable|max:50',
      'telcelular' => 'nullable|max:50',
      'profesion_id' => 'required|exists:auxprofesiones,id',
      'telparticular' => 'nullable|max:50',
      'email' => 'nullable|email|max:150',
      'observaciones' => 'nullable',
      // 'fuera' => 'nullable|in:0,1,-1', // Allow 0, 1, or -1
    ], [
      'nombre.required' => 'El nombre es obligatorio.',
      'apellido.required' => 'El apellido es obligatorio.',
      'proveedor_id.required' => 'Debe seleccionar una distribución.',
      'proveedor_id.exists' => 'La distribución seleccionada no es válida.',
      'email.email' => 'El correo electrónico no tiene un formato válido.',
      'fuera.in' => 'El campo "Fuera" debe ser 0, 1, o -1.', // Custom error message for "fuera"
    ]);

    // Override 'fuera' with the correct value
    // $validated['fuera'] = $fuera;
    $validated['fuera'] = $request->has('fuera') ? true : false;

    // dd($validated);

    // Update the record
    $proveedorPersonal->update($validated);

    return redirect()
      ->route('proveedor.show', $request->proveedor_id)
      ->with('success', 'Los datos del personal fueron actualizados exitosamente.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    // dd($id);

    // Buscar el registro
    $persona = ProveedorPersonal::findOrFail($id);

    // dd($id, $persona);

    // Cambiar el status a 'D'
    $persona->update(['status' => 'D']);

    // Redirigir al detalle de la distribución
    return redirect()
      ->route('proveedor.show', ['proveedor' => $persona->proveedor_id])
      ->with('success', 'El personal ha sido desactivado con éxito.');
  }
}