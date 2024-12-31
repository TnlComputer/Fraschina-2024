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
    $productos = ProductoCDA::all(); // Obtener productos
    return view('distribucion_productos.create', compact('productos', 'distribucion_id'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'distribucion_id' => 'required|integer',
      'producto_id'     => 'required|integer',
      'precio'          => 'required|numeric',
      'fecha'           => 'required|date',
      'nomproducto'     => 'required|string|max:150',
      'fechaUEnt'       => 'nullable|date',
      'status'          => 'required|string|max:1',
    ]);

    Distribucion_Producto::create($validated);

    return redirect()->route('distribucion_productos.index')->with('success', 'Producto agregado a la distribución.');
  }

  public function edit(Distribucion_Producto $distribucionProducto)
  {
    $productos = productoCDA::all();
    return view('distribucion_productos.edit', compact('distribucionProducto', 'productos'));
  }

  public function update(Request $request, Distribucion_Producto $distribucionProducto)
  {
    $validated = $request->validate([
      'distribucion_id' => 'required|integer',
      'producto_id'     => 'required|integer',
      'precio'          => 'required|numeric',
      'fecha'           => 'required|date',
      'nomproducto'     => 'required|string|max:150',
      'fechaUEnt'       => 'nullable|date',
      'status'          => 'required|string|max:1',
    ]);

    $distribucionProducto->update($validated);

    return redirect()->route('distribucion_productos.index')->with('success', 'Producto de distribución actualizado.');
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
  public function destroy(string $id)
  {
    //
  }
}
