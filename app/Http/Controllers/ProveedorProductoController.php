<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Models\Proveedor_AuxProductos;
use App\Models\Proveedor_Producto;
use Illuminate\Http\Request;

class ProveedorProductoController extends Controller
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
  public function create($id)
  {
    // Obtener la representación relacionada
    $proveedor = Proveedor::findOrFail($id);

    // Obtener los productos disponibles para seleccionar, ordenados por nombre
    $productosAux = Proveedor_AuxProductos::where('is_active', true)
      ->orderBy('nombre', 'asc')
      ->get();

    return view('pages.Proveedor.Producto.create', compact('proveedor', 'productosAux'));
  }


  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    // Validar los datos de entrada
    $validatedData = $request->validate([
      'proveedor_id'      => 'required|exists:proveedores,id',
      'producto_id'       => 'required|exists:proveedor_aux_productos,id',
      'familia'           => 'nullable|string|max:255',
      'particularidades'  => 'nullable|string',
    ]);

    try {
      // Crear el registro en la base de datos
      Proveedor_Producto::create([
        'proveedor_id'      => $validatedData['proveedor_id'],
        'producto_id'       => $validatedData['producto_id'],
        'familia'           => $validatedData['familia'],
        'particularidades'  => $validatedData['particularidades'], // corregido
        'status'            => 'A', // Estado predeterminado
      ]);

      // Redirigir con un mensaje de éxito
      return redirect()->route('proveedor.show', $validatedData['proveedor_id'])
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
  public function edit(string $id)
  {
    try {
      // Buscar el producto por ID
      $producto = Proveedor_Producto::findOrFail($id);
      // dd($producto);

      // Obtener la representación asociada
      $proveedor = Proveedor::findOrFail($producto->proveedor_id);

      // Obtener la lista de productos auxiliares
      $productosAux = Proveedor_AuxProductos::all();
      // dd($producto, $proveedor, $productosAux);

      // Retornar la vista con los datos necesarios
      return view('pages.Proveedor.Producto.edit', compact('producto', 'proveedor', 'productosAux'));
    } catch (\Exception $e) {
      // Manejar errores y redirigir con un mensaje
      return redirect()->route('proveedor.show', $producto->proveedor_id ?? null)
        ->withErrors(['error' => 'Hubo un problema al cargar la edición: ' . $e->getMessage()]);
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $id)
  {

    // dd($request, $proveedor_producto);

    // Validar los datos de entrada
    $validatedData =  $request->validate([
      'proveedor_id'      => 'required|exists:proveedores,id',
      'producto_id'       => 'required|exists:proveedor_aux_productos,id',
      'familia'           => 'nullable',
      'particularidades'  => 'nullable',
    ]);


    try {
      $producto = Proveedor_Producto::findOrFail($id);

      $producto->update($request->all());

      return redirect()->route('proveedor.show', $request->proveedor_id)
        ->with('success', 'Producto actualizado correctamente.');
    } catch (\Exception $e) {
      return back()->withErrors(['error' => 'Hubo un problema al actualizar el producto: ' . $e->getMessage()]);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Proveedor_Producto $proveedor_producto)
  {
    // Alternar el estado entre 'A' y 'D'
    $proveedor_producto->status = $proveedor_producto->status === 'A' ? 'D' : 'A';
    $proveedor_producto->save();

    // Mensaje según el nuevo estado
    $message = $proveedor_producto->status === 'A'
      ? 'proveedor activada correctamente'
      : 'proveedor desactivada correctamente';

    // Redirigir a la ruta correspondiente con mensaje
    return redirect()->route('proveedor.show', $proveedor_producto->proveedor_id)
      ->with('success', $message);
  }
}