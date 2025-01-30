<?php

namespace App\Http\Controllers;

use App\Models\Distribucion;
use App\Models\DistribucionLineaPedidos;
use App\Models\DistribucionLineaTareas;
use App\Models\DistribucionNroPedidos;
use App\Models\DistribucionProducto;
use App\Models\DistribucionTareas;
use App\Models\productoCDA;
use Illuminate\Http\Request;

class DistribucionPedidoController extends Controller
{
  public function create()
  {
    $clientes = Distribucion::all();
    $distribuciones = Distribucion::orderBy('nomfantasia')->get();

    return view('pages.Distribucion.Pedido.create', compact('clientes', 'distribuciones'));
  }

  public function store(Request $request)
  {

    // dd($request->all());

    // Crear el pedido
    // $pedido = DistribucionNroPedidos::create([
    //   'cliente_id' => $request->cliente_id,
    // ]);

    // dd($request->all, $pedido);

    // // Guardar productos en DistribucionProductos
    // if ($request->has('productos')) {
    //   foreach ($request->productos as $index => $producto_id) {
    //     DistribucionProducto::create([
    //       'distribucion_id' => $pedido->id, // Relación con pedido
    //       'producto_id' => $producto_id,
    //       'cantidad' => $request->cantidades[$index],
    //     ]);
    //   }
    // }

    // // Guardar tareas si existen
    // if ($request->has('tareas')) {
    //   foreach ($request->tareas as $descripcion) {
    //     DistribucionTareas::create([
    //       'pedido_id' => $pedido->id,
    //       'descripcion' => $descripcion,
    //     ]);
    //   }
    // }

    // return redirect()->route('distribucion_agenda.index')->with('success', 'Pedido creado con éxito');

    // Validación de los datos recibidos
    $validated = $request->validate([
      'cliente_id' => 'required|exists:distribucions,id',
      'fecha_entrega' => 'required|date',
      'productos' => 'required|array',
      'tipos' => 'required|array',
      'cantidades' => 'nullable|array',
      'observaciones' => 'nullable|string',
    ]);

    // Variables principales
    $clienteId = $request->cliente_id;
    $fechaPedido = now()->toDateString();
    $fechaEntrega = $request->fecha_entrega;
    $observaciones = $request->observaciones ?? null;
    $tipos = $request->tipos;
    $productos = $request->productos;
    $cantidades = $request->cantidades ?? [];

    // Determinar el tipo de pedido (P, T o PT)
    $tipoPedido = (in_array('P', $tipos) && in_array('T', $tipos)) ? 'PT' : (in_array('P', $tipos) ? 'P' : 'T');

    // **1. Crear el registro en DistribucionNroPedidos**
    $pedido = new DistribucionNroPedidos();
    $pedido->fecha = $fechaPedido;
    $pedido->fechaEntrega = $fechaEntrega;
    $pedido->distribucion_id = $clienteId;
    $pedido->observaciones = $observaciones;
    $pedido->status = 'A';
    $pedido->tipo = $tipoPedido;
    $pedido->save();

    // **2. Crear las líneas en DistribucionLineaPedidos**
    $lineaNumeroP = 1;  // Control del número de línea
    $lineaNumeroT = 1;  // Control del número de línea

    foreach ($productos as $index => $productoId) {
      $tipo = $tipos[$index];

      if ($tipo === 'P') {
        // **Obtener precio unitario del producto**
        $producto = productoCDA::find($productoId);
        $precioUnitario = $producto->precio ?? 0; // Asigna 0 si el precio no está definido
        $cantidad = $cantidades[$index] ?? 1; // Evita errores si no se pasa cantidad
        $totalLinea = $precioUnitario * $cantidad;

        // **Insertar la línea en DistribucionLineaPedidos**
        DistribucionLineaPedidos::create([
          'pedido_id' => $pedido->id,
          'distribucion_id' => $clienteId,
          'fecha' => $fechaPedido,
          'fechaEntrega' => $fechaEntrega,
          'linea' => $lineaNumeroP++,
          'producto_id' => $productoId,
          'cantidad' => $cantidad,
          'precio_unitario' => $precioUnitario,
          'totalLinea' => $totalLinea,
          'status' => 1,
        ]);
      } elseif ($tipo === 'T') {
        // **Insertar la línea de la tarea**
        DistribucionLineaTareas::create([
          'pedido_id' => $pedido->id,
          'distribucion_id' => $clienteId,
          'fecha' => $fechaPedido,
          'fechaEntrega' => $fechaEntrega,
          'linea' => $lineaNumeroT++,
          'tarea_id' => $productoId, // En este caso, producto_id representa una tarea
          'status' => 'A',
        ]);
      }
    }

    // **Redirección con mensaje de éxito**
    return redirect()->route('distribucion_agenda.index')->with('success', 'Pedido creado correctamente');
  }

  public function getProductosYTareasPorCliente($clienteId)
  {
    // Cargar productos del cliente
    $productos = DistribucionProducto::where('distribucion_id', $clienteId)
      ->join('productos_c_d_a', 'distribucion_productos.producto_id', '=', 'productos_c_d_a.id')
      ->select('productos_c_d_a.id', 'productos_c_d_a.productoCDA as nombre')
      ->get();

    // Cargar tareas del cliente
    $tareas = DistribucionTareas::all()
      ->select('id', 'tarea'); // Asegúrate de que 'descripcion' es el campo correcto

    // dd($productos, $tareas);

    return response()->json([
      'productos' => $productos,
      'tareas' => $tareas
    ]);
  }
}
