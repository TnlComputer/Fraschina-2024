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
    $productos = DistribucionProducto::with('producto')->orderBy('producto_id')->get();
    return view('pages.Distribucion.Pedido.create', compact('clientes', 'distribuciones', 'productos'));
  }

  // public function store(Request $request)
  // {

  //   // dd($request);

  //   // Validación de los datos recibidos
  //   $validated = $request->validate([
  //     'cliente_id' => 'required|exists:distribucions,id',
  //     'fecha_entrega' => 'required|date',
  //     'productos' => 'required|array',
  //     'tipos' => 'required|array',
  //     'cantidades' => 'required|array',
  //     'precios' => 'required|array',
  //     'observaciones' => 'nullable|string',
  //   ]);

  //   // dd($validated);

  //   // Variables principales
  //   $clienteId = $request->cliente_id;
  //   $fechaPedido = now()->toDateString();
  //   $fechaEntrega = $request->fecha_entrega;
  //   $observaciones = $request->observaciones ?? null;
  //   $tipos = $request->tipos;
  //   $productos = $request->productos;
  //   $cantidades = $request->cantidades ?? [];
  //   $precioUnitario = $request->precios ?? [];

  //   // Determinar el tipo de pedido (P, T o PT)
  //   $tipoPedido = (in_array('P', $tipos) && in_array('T', $tipos)) ? 'PT' : (in_array('P', $tipos) ? 'P' : 'T');

  //   // dd($tipoPedido);

  //   // **1. Crear el registro en DistribucionNroPedidos**
  //   $pedido = new DistribucionNroPedidos();
  //   $pedido->fecha = $fechaPedido;
  //   $pedido->fechaEntrega = $fechaEntrega;
  //   $pedido->distribucion_id = $clienteId;
  //   $pedido->observaciones = $observaciones;
  //   $pedido->status = 'A';
  //   $pedido->tipo = $tipoPedido;
  //   $pedido->save();

  //   // **2. Crear las líneas en DistribucionLineaPedidos**
  //   $lineaNumeroP = 1;  // Control del número de línea
  //   $lineaNumeroT = 1;  // Control del número de línea

  //   foreach ($productos as $index => $productoId) {
  //     $tipo = $tipos[$index];

  //     if (
  //       $tipo === 'P' || $tipo === 'PT'
  //     ) {
  //       dd($productos);

  //       // **Obtener precio unitario del producto**
  //       $producto = DistribucionProducto::firstWhere([
  //         ['producto_id', '=', $productoId],
  //         ['distribucion_id', '=', $clienteId]
  //       ]);
  //       // $precioUnitario = $producto->precio ?? 0;
  //       $cantidad = $cantidades[$index];
  //       $precioUnitario = $precios[$index];
  //       $totalLinea = $precioUnitario * $cantidad;

  //       dd($producto, $cantidad, $precioUnitario, $productoId);

  //       // **Insertar en DistribucionLineaPedidos**
  //       DistribucionLineaPedidos::create([
  //         'pedido_id' => $pedido->id,
  //         'distribucion_id' => $clienteId,
  //         'fecha' => $fechaPedido,
  //         'fechaEntrega' => $fechaEntrega,
  //         'linea' => $lineaNumeroP++,
  //         'producto_id' => $productoId,
  //         'cantidad' => $cantidad,
  //         'precio_unitario' => $precio_unitario,
  //         'totalLinea' => $totalLinea,
  //         'status' => 1,
  //       ]);
  //     }

  //     if ($tipo === 'T' || $tipo === 'PT') {
  //       // **Insertar en DistribucionLineaTareas**
  //       DistribucionLineaTareas::create([
  //         'pedido_id' => $pedido->id,
  //         'distribucion_id' => $clienteId,
  //         'fecha' => $fechaPedido,
  //         'fechaEntrega' => $fechaEntrega,
  //         'linea' => $lineaNumeroT++,
  //         'tarea_id' => $productoId, // En este caso, producto_id representa una tarea
  //         'status' => 'A',
  //       ]);
  //     }
  //   }

  //   // **Redirección con mensaje de éxito**
  //   return redirect()->route('distribucion_agenda.index')->with('success', 'Pedido creado correctamente');
  // }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'cliente_id' => 'required|exists:distribucions,id',
      'fecha_entrega' => 'required|date',
      'productos' => 'required|array',
      'tipos' => 'required|array',
      'cantidades' => 'required|array',
      'precios' => 'required|array',
      'observaciones' => 'nullable|string',
    ]);

    $clienteId = $request->cliente_id;
    $fechaPedido = now()->toDateString();
    $fechaEntrega = $request->fecha_entrega;
    $observaciones = $request->observaciones ?? null;
    $tipos = $request->tipos;
    $productos = $request->productos;
    $cantidades = $request->cantidades ?? [];
    $precios = $request->precios ?? [];

    $tipoPedido = (in_array('P', $tipos) && in_array('T', $tipos)) ? 'PT' : (in_array('P', $tipos) ? 'P' : 'T');

    // Inicializar el total del pedido
    $totalPedido = 0;

    // Crear el pedido
    $pedido = new DistribucionNroPedidos();
    $pedido->fecha = $fechaPedido;
    $pedido->fechaEntrega = $fechaEntrega;
    $pedido->distribucion_id = $clienteId;
    $pedido->observaciones = $observaciones;
    $pedido->status = 'A';
    $pedido->tipo = $tipoPedido;
    $pedido->totalPedido = 0; // Se actualizará después
    $pedido->save();

    $lineaNumeroP = 1;
    $lineaNumeroT = 1;

    foreach ($productos as $index => $productoId) {
      $tipo = $tipos[$index];

      if ($tipo === 'P' || $tipo === 'PT') {
        // Obtener producto
        $producto = DistribucionProducto::where('producto_id', $productoId)
          ->where('distribucion_id', $clienteId)
          ->first();

        if (!$producto) {
          return back()->withErrors(['error' => "El producto con ID $productoId no se encuentra en la distribución."]);
        }

        $cantidad = $cantidades[$index] ?? 1;
        $precioUnitario = $precios[$index] ?? $producto->precio ?? 0;
        $totalLinea = $precioUnitario * $cantidad;

        // Acumular el total del pedido
        $totalPedido += $totalLinea;

        // Insertar en DistribucionLineaPedidos
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
        // Insertar en DistribucionLineaTareas
        DistribucionLineaTareas::create([
          'pedido_id' => $pedido->id,
          'distribucion_id' => $clienteId,
          'fecha' => $fechaPedido,
          'fechaEntrega' => $fechaEntrega,
          'linea' => $lineaNumeroT++,
          'tarea_id' => $productoId,
          'status' => 'A',
        ]);
      }
    }

    // Actualizar el totalPedidos en el pedido
    $pedido->update(['totalPedido' => $totalPedido]);

    return redirect()->route('distribucion_agenda.index')->with('success', 'Pedido creado correctamente');
  }

  public function getProductosYTareasPorCliente($clienteId)
  {
    // Cargar productos del cliente
    $productos = DistribucionProducto::where('distribucion_id', $clienteId)
      ->join('productos_c_d_a', 'distribucion_productos.producto_id', '=', 'productos_c_d_a.id')
      ->select('productos_c_d_a.id', 'productos_c_d_a.productoCDA as nombre', 'distribucion_productos.precio')
      ->get();

    // Cargar tareas del cliente
    $tareas = DistribucionTareas::all()->select('id', 'tarea'); // Asegúrate de que 'descripcion' es el campo correcto

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

          if ($distribucionProducto) {
            // Actualizar el precio si se envía en la petición
            if (isset($lineaData['precio_unitario'])) {
              $distribucionProducto->precio = $lineaData['precio_unitario'];
            }
            // Actualizar la fecha de última entrega si se envía en la petición
            // Suponemos que en $lineaData se envía 'fecEntrega'
            if (isset($lineaData['fecEntrega'])) {
              $distribucionProducto->fechaUEnt = $lineaData['fecEntrega'];
            }
            $distribucionProducto->save();
          }
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