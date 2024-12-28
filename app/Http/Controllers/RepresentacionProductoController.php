<?php

namespace App\Http\Controllers;

use App\Models\Representacion;
use App\Models\Representacion_AuxProductos;
use App\Models\Representacion_Producto;
use Illuminate\Http\Request;

class RepresentacionProductoController extends Controller
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
  public function create($representacionId)
  {

    // dd($representacionId);

    // Obtener la representación relacionada
    $representacion = Representacion::findOrFail($representacionId);

    // Obtener los productos disponibles para seleccionar
    $productos = Representacion_AuxProductos::where('is_active', true)->get();

    return view('pages.Representacion.Producto.create', compact('representacion', 'productos'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    // dd($request);
    // Validar los datos de entrada
    $request->validate([
      'representacion_id' => 'required|exists:representacions,id',
      'producto_id'       => 'required|exists:representacion_aux_productos,id',
      'pl'                => 'nullable|string|max:50',
      'P'                 => 'nullable|string|max:50',
      'l'                 => 'nullable|string|max:50',
      'w'                 => 'nullable|string|max:50',
      'humedad'           => 'nullable|string|max:50',
      'cenizas'           => 'nullable|string|max:50',
      'glutenhumedo'      => 'nullable|string|max:50',
      'glutenseco'        => 'nullable|string|max:50',
      'fn'                => 'nullable|string|max:50',
      'estabilidad'       => 'nullable|string|max:50',
      'absorcion'         => 'nullable|string|max:50',
      'puntuaciones'      => 'nullable|string|max:50',
      'particularidades'  => 'nullable|string',
    ]);

    try {
      // Crear el registro en la base de datos
      Representacion_Producto::create([
        'representacion_id' => $request->representacion_id,
        'producto_id'       => $request->producto_id,
        'pl'                => $request->pl,
        'P'                 => $request->P,
        'l'                 => $request->l,
        'w'                 => $request->w,
        'humedad'           => $request->humedad,
        'cenizas'           => $request->cenizas,
        'glutenhumedo'      => $request->glutenhumedo,
        'glutenseco'        => $request->glutenseco,
        'fn'                => $request->fn,
        'estabilidad'       => $request->estabilidad,
        'absorcion'         => $request->absorcion,
        'puntuaciones'      => $request->puntuaciones,
        'particularidades'  => $request->particularidades,
        'status'            => 'A', // Estado predeterminado
      ]);

      // Redirigir con un mensaje de éxito
      return redirect()->route('representacion.show', $request->representacion_id)
        ->with('success', 'Producto agregado correctamente.');
    } catch (\Exception $e) {
      // Manejar errores
      return back()->withErrors(['error' => 'Hubo un problema al guardar el producto: ' . $e->getMessage()]);
    }
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
  public function edit($id)
  {
    try {
      // Buscar el producto por ID
      $producto = Representacion_Producto::findOrFail($id);

      // Obtener la representación asociada
      $representacion = Representacion::findOrFail($producto->representacion_id);

      // Obtener la lista de productos auxiliares
      $productos = Representacion_AuxProductos::all();
      // dd($producto, $representacion, $productos);

      // Retornar la vista con los datos necesarios
      return view('pages.Representacion.Producto.edit', compact('producto', 'representacion', 'productos'));
    } catch (\Exception $e) {
      // Manejar errores y redirigir con un mensaje
      return redirect()->route('representacion.show', $producto->representacion_id ?? null)
        ->withErrors(['error' => 'Hubo un problema al cargar la edición: ' . $e->getMessage()]);
    }
  }
  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $id)
  {
    // Validar los datos de entrada
    $request->validate([
      'representacion_id' => 'required|exists:representacions,id',
      'producto_id'       => 'required|exists:representacion_aux_productos,id',
      'pl'                => 'nullable|string|max:50',
      'P'                 => 'nullable|string|max:50',
      'l'                 => 'nullable|string|max:50',
      'w'                 => 'nullable|string|max:50',
      'humedad'           => 'nullable|string|max:50',
      'cenizas'           => 'nullable|string|max:50',
      'glutenhumedo'      => 'nullable|string|max:50',
      'glutenseco'        => 'nullable|string|max:50',
      'fn'                => 'nullable|string|max:50',
      'estabilidad'       => 'nullable|string|max:50',
      'absorcion'         => 'nullable|string|max:50',
      'puntuaciones'      => 'nullable|string|max:50',
      'particularidades'  => 'nullable|string',
    ]);

    try {
      $producto = Representacion_Producto::findOrFail($id);
      $producto->update([
        'representacion_id' => $request->representacion_id,
        'producto_id'       => $request->producto_id,
        'pl'                => $request->pl,
        'P'                 => $request->P,
        'l'                 => $request->l,
        'w'                 => $request->w,
        'humedad'           => $request->humedad,
        'cenizas'           => $request->cenizas,
        'glutenhumedo'      => $request->glutenhumedo,
        'glutenseco'        => $request->glutenseco,
        'fn'                => $request->fn,
        'estabilidad'       => $request->estabilidad,
        'absorcion'         => $request->absorcion,
        'puntuaciones'      => $request->puntuaciones,
        'particularidades'  => $request->particularidades,
      ]);

      return redirect()->route('representacion.show', $request->representacion_id)
        ->with('success', 'Producto actualizado correctamente.');
    } catch (\Exception $e) {
      return back()->withErrors(['error' => 'Hubo un problema al actualizar el producto: ' . $e->getMessage()]);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Representacion_Producto $representacion_producto)
  {
    // Alternar el estado entre 'A' y 'D'
    $representacion_producto->status = $representacion_producto->status === 'A' ? 'D' : 'A';
    $representacion_producto->save();

    // Mensaje según el nuevo estado
    $message = $representacion_producto->status === 'A'
      ? 'Representación activada correctamente'
      : 'Representación desactivada correctamente';

    // Redirigir a la ruta correspondiente con mensaje
    return redirect()->route('representacion.show', $representacion_producto->representacion_id)
      ->with('success', $message);
  }
}
