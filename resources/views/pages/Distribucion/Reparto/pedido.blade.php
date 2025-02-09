@extends('adminlte::page')

@section('title', 'Ver Pedido')

@section('content')
@php
$total = 0;
@endphp
<div class="container">
  <h1>Detalles del Pedido</h1>

  <div class="card">
    <div class="card-header bg-primary text-white">
      Información del Pedido
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <tr>
          <th class="w-25">Pedido</th>
          <td>{{ $pedido->id }}</td>
        </tr>
        <tr>
          <th>Fecha de Entrega</th>
          <td>{{ $pedido->fechaEntrega }}</td>
        </tr>
        <tr>
          <th>Cliente</th>
          <td>{{ $pedido->distribucion->nomfantasia }}</td>
        </tr>
        <tr>
          <th>Total</th>
          <td>${{ number_format($pedido->totalPedido, 2) }}</td>
        </tr>
        <tr>
          <th>Estado</th>
          <td>
            <span class="badge {{ $pedido->estado == 'pendiente' ? 'bg-warning' : 'bg-success' }}">
              {{ ucfirst($pedido->estado) }}
            </span>
          </td>
        </tr>
      </table>
    </div>
  </div>

  <div class="mt-4">
    <h4>Detalles de los productos</h4>
    <table class="table table-sm table-striped table-bordered">
      <thead class="thead-dark">
        <tr>
          <th>Producto</th>
          <th class=" text-center">Cantidad</th>
          <th class=" text-center">Precio Unitario</th>
          <th class=" text-center">Subtotal</th>
          <th class=" text-center">c/Iva</th>

        </tr>
      </thead>
      <tbody>
        @foreach ($pedido->lineasPedidos as $detalle)
        @php
        $precio = $detalle->cantidad * $detalle->precio_unitario;
        $conIva = $precio * $detalle->producto->ivancda / 100;
        $precioConIva = $precio + $conIva;
        $total = $total + $precioConIva;
        @endphp
        <tr>
          <td>{{ $detalle->pedido_id }}- {{$detalle->id}}</td>
          <td>{{ $detalle->producto->productoCDA }}</td>
          <!-- Asumiendo que tienes una relación 'producto' en el modelo de línea -->
          <td class=" text-center">{{ number_format($detalle->cantidad, 0) }}</td>
          <td class=" text-center">${{ number_format($detalle->precio_unitario, 2) }}</td>
          <td class=" text-center">${{ number_format($precio, 2) }}</td>
          <td class=" text-center">${{ number_format($precioConIva, 2) }}</td>
          <td class=" text-center">{{ $detalle->linea }}</td>
        </tr>
        @endforeach
      <tfoot>
        <tr>
          <th colspan="4" class="text-right">Total</th>
          <td class="text-center">${{ number_format($total, 2) }}</td>
        </tr>
      </tfoot>
      </tbody>
    </table>
  </div>

  <div class="mt-4">
    <a href="{{ route('distribucion_reparto.index', ['fecha' => $pedido->fechaEntrega]) }}" class="btn btn-secondary">
      <i class="fas fa-arrow-left"></i> Volver
    </a>
  </div>
</div>
@endsection