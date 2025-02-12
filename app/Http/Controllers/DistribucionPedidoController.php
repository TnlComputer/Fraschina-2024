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
use Illuminate\Support\Facades\DB;


class DistribucionPedidoController extends Controller
{
  public function create()
  {
    $clientes = Distribucion::all();
    $distribuciones = Distribucion::orderBy('nomfantasia')->get();
    $productos = DistribucionProducto::with('producto')->orderBy('producto_id')->get();
    return view('pages.Distribucion.Pedido.create', compact('clientes', 'distribuciones', 'productos'));
  }

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
    // Obtener productos activos del cliente con status 'A' en ambas tablas
    $productos = DistribucionProducto::join('productos_c_d_a', 'distribucion_productos.producto_id', '=', 'productos_c_d_a.id')
      ->where('distribucion_productos.distribucion_id', $clienteId)
      ->where('distribucion_productos.status', 'A') // Filtra productos activos en DistribucionProducto
      ->where('productos_c_d_a.status', 'A') // Filtra productos activos en productos_c_d_a
      ->select('productos_c_d_a.id', 'productos_c_d_a.productoCDA as nombre', 'distribucion_productos.precio')
      ->get();

    // Obtener tareas activas con status 'A'
    $tareas = DistribucionTareas::where('status', 'A')
      ->select('id', 'tarea')
      ->get();

    return response()->json([
      'productos' => $productos,
      'tareas' => $tareas
    ]);
  }



  public function edit($id)
  {
    // Obtener el pedido con sus productos y tareas
    $pedido = DistribucionNroPedidos::with(['lineasPedidos.producto', 'lineasTareas.tarea'])->findOrFail($id);

    // Filtrar productos solo para el cliente del pedido
    $productos = DistribucionProducto::where('distribucion_id', $pedido->distribucion_id)->get();

    // Filtrar tareas solo para el cliente del pedido
    $tareas = DistribucionTareas::all();

    return view('pages.Distribucion.Pedido.edit', compact('pedido', 'productos', 'tareas'));
  }

  public function update(Request $request, $id)
  {
    // dd($request->all(), $id);

    DB::beginTransaction();
    try {
      // 1. Actualizar datos generales del pedido
      $pedido = DistribucionNroPedidos::findOrFail($id);
      $pedido->fechaEntrega  = $request->input('fecha_entrega');
      $pedido->observaciones = $request->input('observaciones');
      $pedido->save();

      // 2. Procesar líneas de productos existentes
      $existingProductLineIds = $request->input('existing_product_line_ids', []); // IDs de las líneas que siguen en la vista
      if (!empty($existingProductLineIds)) {
        $existingPrecios    = $request->input('existing_precios', []);
        $existingCantidades = $request->input('existing_cantidades', []);
        foreach ($existingProductLineIds as $index => $lineaId) {
          $linea = DistribucionLineaPedidos::find($lineaId);
          if ($linea) {
            $precio   = $existingPrecios[$index];
            $cantidad = $existingCantidades[$index];
            $linea->precio_unitario = $precio;
            $linea->cantidad        = $cantidad;
            // Consultar IVA a partir del producto
            $dp = DistribucionProducto::where('distribucion_id', $pedido->distribucion_id)
              ->where('producto_id', $linea->producto_id)
              ->first();
            $iva = $dp ? ($dp->producto->ivacda ?? 0) : 0;
            $totalBase = $precio * $cantidad;
            $linea->totalLinea = $totalBase + ($totalBase * $iva / 100);
            $linea->save();
          }
        }
      }

      // Eliminar de la BD las líneas de productos que hayan sido removidas
      $idsActualesProductos = DistribucionLineaPedidos::where('pedido_id', $pedido->id)
        ->pluck('id')
        ->toArray();
      $idsAConservar = $existingProductLineIds; // las que llegan en el request
      $idsAEliminar  = array_diff($idsActualesProductos, $idsAConservar);
      if (!empty($idsAEliminar)) {
        DistribucionLineaPedidos::destroy($idsAEliminar);
      }

      // 3. Procesar nuevos productos
      if ($request->has('new_productos')) {
        $newProductos   = $request->input('new_productos', []);
        $newPrecios     = $request->input('new_precios', []);
        $newCantidades  = $request->input('new_cantidades', []);
        foreach ($newProductos as $index => $productoId) {
          // Verificar si ya existe una línea con este producto
          $lineaExistente = DistribucionLineaPedidos::where('pedido_id', $pedido->id)
            ->where('producto_id', $productoId)
            ->first();
          if ($lineaExistente) {
            // Sumar la nueva cantidad a la existente y actualizar precio
            $lineaExistente->cantidad += $newCantidades[$index];
            $lineaExistente->precio_unitario = $newPrecios[$index];
            $dp = DistribucionProducto::where('distribucion_id', $pedido->distribucion_id)
              ->where('producto_id', $productoId)
              ->first();
            $iva = $dp ? ($dp->producto->ivacda ?? 0) : 0;
            $totalBase = $lineaExistente->cantidad * $lineaExistente->precio_unitario;
            $lineaExistente->totalLinea = $totalBase + ($totalBase * $iva / 100);
            $lineaExistente->save();
          } else {
            // Crear nueva línea
            $cantidad = $newCantidades[$index];
            $precio   = $newPrecios[$index];
            $dp = DistribucionProducto::where('distribucion_id', $pedido->distribucion_id)
              ->where('producto_id', $productoId)
              ->first();
            $iva = $dp ? ($dp->producto->ivacda ?? 0) : 0;
            $totalBase  = $cantidad * $precio;
            $totalLinea = $totalBase + ($totalBase * $iva / 100);
            DistribucionLineaPedidos::create([
              'pedido_id'       => $pedido->id,
              'distribucion_id' => $pedido->distribucion_id,
              'fecha'           => $pedido->fecha,
              'fechaEntrega'    => $pedido->fechaEntrega,
              'producto_id'     => $productoId,
              'cantidad'        => $cantidad,
              'precio_unitario' => $precio,
              'totalLinea'      => $totalLinea,
              'status'          => 1,
            ]);
          }
        }
      }

      // 4. Procesar tareas existentes: conservar las que sigan enviadas
      $existingTareaIds = $request->input('existing_tarea_ids', []); // IDs de tareas que se mantienen
      $idsActualesTareas = DistribucionLineaTareas::where('pedido_id', $pedido->id)
        ->pluck('id')
        ->toArray();
      $tareasAEliminar = array_diff($idsActualesTareas, $existingTareaIds);
      if (!empty($tareasAEliminar)) {
        DistribucionLineaTareas::destroy($tareasAEliminar);
      }

      // 5. Procesar nuevas tareas
      if ($request->has('new_tareas')) {
        $newTareas = $request->input('new_tareas', []);
        // Determinar el próximo número de línea para tareas
        $maxLinea = DistribucionLineaTareas::where('pedido_id', $pedido->id)->max('linea') ?? 0;
        foreach ($newTareas as $tareaId) {
          $maxLinea++;
          DistribucionLineaTareas::create([
            'pedido_id'       => $pedido->id,
            'distribucion_id' => $pedido->distribucion_id,
            'fechaEntrega'    => $pedido->fechaEntrega,
            'linea'           => $maxLinea,
            'tarea_id'        => $tareaId,
            'status'          => 'A'
          ]);
        }
      }

      // 6. Recalcular el total del pedido y definir su tipo
      $totalPedido = DistribucionLineaPedidos::where('pedido_id', $pedido->id)
        ->sum('totalLinea');
      $pedido->totalPedido = $totalPedido;
      $tieneProductos = DistribucionLineaPedidos::where('pedido_id', $pedido->id)->exists();
      $tieneTareas    = DistribucionLineaTareas::where('pedido_id', $pedido->id)->exists();
      if ($tieneProductos && $tieneTareas) {
        $pedido->tipo = 'PT';
      } elseif ($tieneProductos) {
        $pedido->tipo = 'P';
      } elseif ($tieneTareas) {
        $pedido->tipo = 'T';
      } else {
        $pedido->tipo = null;
      }
      $pedido->save();

      DB::commit();
      return redirect()->route('distribucion_reparto.index', ['fecha' => $pedido->fechaEntrega])
        ->with('success', 'Pedido actualizado correctamente.');
    } catch (\Exception $e) {
      DB::rollback();
      return redirect()->back()->with('error', 'Error al actualizar el pedido: ' . $e->getMessage());
    }
  }


  public function getProductosTareas($distribucion_id)
  {
    // Filtrar productos por distribucion_id y status 'A'
    $productos = DistribucionProducto::where('distribucion_id', $distribucion_id)
      ->where('status', 'A') // Filtrar productos activos
      ->get();

    // Filtrar tareas con status 'A'
    $tareas = DistribucionTareas::where('status', 'A') // Filtrar tareas activas
      ->select('id', 'tarea') // Seleccionar solo los campos necesarios
      ->get();

    return response()->json([
      'productos' => $productos,
      'tareas' => $tareas
    ]);
  }
}
