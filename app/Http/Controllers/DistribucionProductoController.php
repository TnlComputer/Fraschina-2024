<?php

namespace App\Http\Controllers;

use App\Models\Distribucion_Producto;
use App\Models\productoCDA;
use Illuminate\Http\Request;

class DistribucionProductoController extends Controller
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

  public function create($distribucion_id)
  {
    // $productos = ProductoCDA::orderBy('productoCDA', 'ASC')->get(); // Obtener productos

    $productos = productoCDA::where('status', '=', 'A')->orderBy('productoCDA', 'asc')->get();

    return view('pages.Distribucion.Producto.create', compact('productos', 'distribucion_id'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'producto_id'     => 'required|exists:productos_c_d_a,id', // Asegura que existe en la tabla
      'precio'          => 'required|numeric',
      'fecha'           => 'required|date',
      'fechaUEnt'       => 'nullable|date',
      'distribucion_id' => 'required|exists:distribucions,id', // Valida que la distribución exista
    ]);

    // Agregar status predeterminado
    $validated['status'] = 'A';

    Distribucion_Producto::create($validated);

    return redirect()->route('distribucion.show', ['distribucion' => $validated['distribucion_id']])
      ->with('success', 'Producto agregado a la distribución.');
  }



  public function edit(Distribucion_Producto $distribucionProducto)
  {
    $distribucion_producto = Distribucion_Producto::findOrFail($distribucionProducto->id);

    $productos = productoCDA::where('status', '=', 'A')->orderBy('productoCDA', 'asc')->get();

    return view('pages.Distribucion.Producto.edit', compact('distribucion_producto', 'productos'));
  }

  public function update(Request $request, $id)
  {
    $validated = $request->validate([
      'producto_id' => 'required|exists:productos_c_d_a,id', // Asegura que existe en la tabla
      'precio'      => 'required|numeric',
      'fecha'       => 'required|date',
      'fechaUEnt'   => 'nullable|date',
      'status'      => 'required|in:A,D', // Validar que el estado sea 'A' o 'D'
    ]);

    $distribucion_producto = Distribucion_Producto::findOrFail($id);
    $distribucion_producto->update($validated);

    return redirect()->route('distribucion.show', ['distribucion' => $distribucion_producto->distribucion_id])
      ->with('success', 'Producto actualizado en la distribución.');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    // dd($id);

    // Buscar el producto en la distribución
    $producto = Distribucion_Producto::findOrFail($id);

    // Cambiar el estado a 'D' (desactivado)
    $producto->update(['status' => 'D']);

    // Redirigir con un mensaje de éxito
    return redirect()->route('distribucion.show', ['distribucion' => $producto->distribucion_id])
      ->with('success', 'Producto desactivado de la distribución.');
  }
}
