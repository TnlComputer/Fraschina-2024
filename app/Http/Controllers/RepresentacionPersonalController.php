<?php

namespace App\Http\Controllers;

use App\Models\AuxAreas;
use App\Models\AuxCargos;
use App\Models\AuxProfesion;
use App\Models\Representacion;
use App\Models\Representacion_Personal;
use Illuminate\Http\Request;

class RepresentacionPersonalController extends Controller
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
  // public function create()
  // {
  //   //
  // }

  /**
   * Store a newly created resource in storage.
   */
  // public function store(Request $request)
  // {
  //   //
  // }


  public function create(Representacion $representacion)
  {
    $representacion = Representacion::findOrFail($representacion->id);
    $profesiones = AuxProfesion::all();
    $areas = AuxAreas::all();
    $cargos = AuxCargos::all();

    dd($representacion, $profesiones, $areas, $cargos);
    return view('pages.Representacion.Personal.create', compact('representacion', 'profesiones', 'areas', 'cargos'));
  }

  /**
   * Almacena un nuevo registro de personal.
   */
  public function store(Request $request)
  {
    // Validación del formulario
    $request->validate([
      'nombre' => 'required|max:150',
      'apellido' => 'required|max:150',
      'representacion_id' => 'required|exists:representacions,id',
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

    // Crear un nuevo personal
    $personal = new Representacion_Personal();
    $personal->fuera = $request->has('fuera') ? $request->fuera : 0;
    $personal->status = $request->has('status') ? $request->status : 'A';

    // Guardar los datos
    $personal->fill($request->except('fuera', 'status'));
    $personal->save();

    // Redirigir con mensaje de éxito
    return redirect()->route('representacion.show', $request->representacion_id)
      ->with('success', 'Nuevo personal creado correctamente.');
  }
  /**
   * Display the specified resource.
   */
  public function show(Representacion_personal $representacion_personal)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  /**
   * Muestra el formulario para editar un registro.
   */
  public function edit($id)
  {
    $personal = Representacion_Personal::findOrFail($id); // Obtén el registro por ID
    $representaciones = Representacion::all(); // Dropdown para representaciones
    $areas = AuxAreas::all(); // Dropdown para áreas
    $cargos = AuxCargos::all(); // Dropdown para cargos
    $profesiones = AuxProfesion::all(); // Dropdown para profesiones

    return view('Pages.Representacion.Personal.edit', compact('personal', 'representaciones', 'areas', 'cargos', 'profesiones'));
  }

  /**
   * Actualiza el registro en la base de datos.
   */
  public function update(Request $request, $id)
  {
    // Validación del formulario
    $request->validate([
      'nombre' => 'required|max:150',
      'apellido' => 'required|max:150',
      'representacion_id' => 'required|exists:representacions,id',
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

    // Recuperar el personal por ID
    $personal = Representacion_Personal::findOrFail($id);

    // Asignar valores por defecto si no se proporcionan
    $personal->fuera = $request->has('fuera') ? $request->fuera : 0;
    $personal->status = $request->has('status') ? $request->status : 'A';

    // Actualizar el registro con los datos recibidos
    $personal->update($request->all());

    // Redirigir con un mensaje de éxito
    return redirect()->route('representacion.show', $request->representacion_id)->with('success', 'Información actualizada correctamente.');
  }


  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Representacion_personal $representacion_personal)
  {
    // Alternar el estado entre 'A' y 'D'
    $representacion_personal->status = $representacion_personal->status === 'A' ? 'D' : 'A';
    $representacion_personal->save();

    // Mensaje según el nuevo estado
    $message = $representacion_personal->status === 'A'
      ? 'Representación activada correctamente'
      : 'Representación desactivada correctamente';

    // Redirigir a la ruta correspondiente con mensaje
    return redirect()->route('representacion.show', $representacion_personal->representacion_id)
      ->with('success', $message);
  }
}