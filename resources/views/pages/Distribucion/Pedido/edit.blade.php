@extends('adminlte::page')

@section('title', 'Editar Pedido')

@section('content')
<div class="container">
  <h1>Editar Pedido</h1>

  <div class="card">
    <div class="card-header bg-primary text-white">
      Información del Pedido
    </div>
    <div class="card-body">
      <form action="{{ route('distribucion_reparto.update', $pedido->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label for="fechaEntrega" class="form-label">Fecha de Entrega</label>
          <input type="date" id="fechaEntrega" name="fechaEntrega" class="form-control"
            value="{{ $pedido->fechaEntrega }}" required>
        </div>

        <div class="mb-3">
          <label for="cliente" class="form-label">Cliente</label>
          <input type="text" id="cliente" name="cliente" class="form-control"
            value="{{ $pedido->distribucion->nomfantasia }}" readonly>
        </div>

        <div class="mb-3">
          <label for="estado" class="form-label">Estado</label>
          <select id="estado" name="estado" class="form-control">
            <option value="pendiente" {{ $pedido->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="completado" {{ $pedido->estado == 'completado' ? 'selected' : '' }}>Completado</option>
          </select>
        </div>

        <h4>Detalles de los productos</h4>
        <table class="table table-sm table-striped table-bordered">
          <thead class="thead-dark">
            <tr>
              <th>Producto</th>
              <th class="text-center">Cantidad</th>
              <th class="text-center">Precio Unitario</th>
              <th class="text-center">Subtotal</th>
              <th class="text-center">c/Iva</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pedido->lineasPedidos as $detalle)
            <tr>
              <td>
                <select name="lineas[{{ $detalle->id }}][producto_id]" class="form-control">
                  @foreach ($productos as $producto)
                  <option value="{{ $producto->id }}" {{ $producto->id == $detalle->producto_id ? 'selected' : '' }}>
                    {{ $producto->productoCDA }}
                  </option>
                  @endforeach
                </select>
              </td>
              <td class="text-center">
                <input type="number" name="lineas[{{ $detalle->id }}][cantidad]" value="{{ $detalle->cantidad }}"
                  class="form-control" required>
              </td>
              <td class="text-center">${{ number_format($detalle->precio_unitario, 2) }}</td>
              <td class="text-center">${{ number_format($detalle->cantidad * $detalle->precio_unitario, 2) }}</td>
              <td class="text-center">${{ number_format(($detalle->cantidad * $detalle->precio_unitario) +
                ($detalle->cantidad * $detalle->precio_unitario * $detalle->producto->ivancda / 100), 2) }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <div class="mt-3">
          <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Cambios</button>
          <a href="{{ route('distribucion_reparto.index', ['fecha' => $pedido->fechaEntrega]) }}"
            class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection