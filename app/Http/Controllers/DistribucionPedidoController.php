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

    // foreach ($productos as $index => $productoId) {
    //   $tipo = $tipos[$index];

    //   if ($tipo === 'P' ) {
    //     // **Obtener precio unitario del producto**
    //     $producto = productoCDA::find($productoId);
    //     $precioUnitario = $producto->precio ?? 0; // Asigna 0 si el precio no está definido
    //     $cantidad = $cantidades[$index] ?? 1; // Evita errores si no se pasa cantidad
    //     $totalLinea = $precioUnitario * $cantidad;

    //     // **Insertar la línea en DistribucionLineaPedidos**
    //     DistribucionLineaPedidos::create([
    //       'pedido_id' => $pedido->id,
    //       'distribucion_id' => $clienteId,
    //       'fecha' => $fechaPedido,
    //       'fechaEntrega' => $fechaEntrega,
    //       'linea' => $lineaNumeroP++,
    //       'producto_id' => $productoId,
    //       'cantidad' => $cantidad,
    //       'precio_unitario' => $precioUnitario,
    //       'totalLinea' => $totalLinea,
    //       'status' => 1,
    //     ]);
    //   } elseif ($tipo === 'T' ) {
    //     // **Insertar la línea de la tarea**
    //     DistribucionLineaTareas::create([
    //       'pedido_id' => $pedido->id,
    //       'distribucion_id' => $clienteId,
    //       'fecha' => $fechaPedido,
    //       'fechaEntrega' => $fechaEntrega,
    //       'linea' => $lineaNumeroT++,
    //       'tarea_id' => $productoId, // En este caso, producto_id representa una tarea
    //       'status' => 'A',
    //     ]);
    //   }
    // }

    foreach ($productos as $index => $productoId) {
      $tipo = $tipos[$index];

      if (
        $tipo === 'P' || $tipo === 'PT'
      ) {
        // **Obtener precio unitario del producto**
        $producto = productoCDA::find($productoId);
        $precioUnitario = $producto->precio ?? 0;
        $cantidad = $cantidades[$index] ?? 1;
        $totalLinea = $precioUnitario * $cantidad;

        // **Insertar en DistribucionLineaPedidos**
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
      }

      if ($tipo === 'T' || $tipo === 'PT') {
        // **Insertar en DistribucionLineaTareas**
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

  public function edit(string $id)
  { {
      $pedido = DistribucionNroPedidos::with('lineasPedidos.producto')->findOrFail($id);
      // dd($id, $pedido);
      $productos = DistribucionProducto::with('producto')
        ->where('distribucion_id', $pedido->distribucion_id)
        ->whereHas('producto') // Esto solo traerá los que tienen producto relacionado
        ->get();

      // dd($pedido, $productos);

      return view('pages.Distribucion.Pedido.edit', compact('pedido', 'productos'));
    }
  }

  public function update(Request $request, $id)
  {
    // Buscar la distribución principal (DistribucionNroPedidos)
    $distribucion = DistribucionNroPedidos::findOrFail($id);

    // dd($request);

    // Actualizar cada línea de pedido
    if ($request->has('lineas')) {
      foreach ($request->input('lineas') as $lineaId => $lineaData) {
        // Buscar la línea por su id en DistribucionLineaPedidos
        $linea = DistribucionLineaPedidos::find($lineaId);
        if ($linea) {
          // Actualizar los campos básicos
          $linea->producto_id = $lineaData['producto_id'] ?? $linea->producto_id;
          $linea->cantidad = $lineaData['cantidad'] ?? $linea->cantidad;
          if (isset($lineaData['precio_unitario'])) {
            $linea->precio_unitario = $lineaData['precio_unitario'];
          }

          // Recalcular el total de la línea, incluyendo IVA:
          if (isset($lineaData['cantidad']) && isset($lineaData['precio_unitario'])) {
            $cantidad = $lineaData['cantidad'];
            $precioUnitario = $lineaData['precio_unitario'];
            $totalBase = $cantidad * $precioUnitario;

            // dd($linea->producto_id, $linea->distribucion_id);

            // Obtener el IVA del producto:
            // Se busca en DistribucionProducto usando:
            //   - distribucion_id de la distribución principal ($distribucion->distribucion_id)
            //   - producto_id igual al de la línea
            $distribucionProducto = \App\Models\DistribucionProducto::where('distribucion_id', $linea->distribucion_id)
              ->where('producto_id', $linea->producto_id)
              ->first();

            // dd($distribucionProducto);

            // Se obtiene el IVA desde el producto (campo ivacda) si existe
            $iva = 0;
            if ($distribucionProducto && $distribucionProducto->producto) {
              $iva = $distribucionProducto->producto->ivacda;
            }


            // Calcular totalLinea incluyendo IVA:
            // totalLinea = totalBase * (1 + (iva/100))
            $linea->totalLinea = $totalBase * (1 + ($iva / 100));
          }

          // dd($linea->totalLinea);

          $linea->save();
        }
      }
    }

    // Calcular el total del pedido sumando el total de todas las líneas asociadas a este pedido
    // Aquí asumimos que en DistribucionLineaPedidos el campo 'pedido_id' es el id de la distribución principal
    $totalPedido = DistribucionLineaPedidos::where('pedido_id', $id)
      ->sum('totalLinea');

    // Actualizar el totalPedido en la distribución principal
    $distribucion->totalPedido = $totalPedido;
    $distribucion->save();

    // Redirigir con un mensaje de éxito
    return redirect()->route('distribucion_reparto.index', ['fecha' => $request->fechaEntrega])
      ->with('success', 'Distribución actualizada correctamente');
  }
}
