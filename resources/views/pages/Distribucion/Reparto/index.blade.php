@extends('adminlte::page')

@section('title', 'Distribución')

@section('content')
<div class="container">
  <h1>Distribución</h1>

  <!-- Botones para filtrar por fechas -->
  <div class="mb-3">
    <form method="GET" action="{{ route('distribucion_reparto.index') }}">
      <button type="submit" name="fecha" value="{{ Carbon\Carbon::today()->toDateString() }}"
        class="btn btn-primary">Hoy</button>
      <button type="submit" name="fecha" value="{{ Carbon\Carbon::yesterday()->toDateString() }}"
        class="btn btn-secondary">Día Anterior</button>
      <button type="submit" name="fecha" value="{{ Carbon\Carbon::tomorrow()->toDateString() }}"
        class="btn btn-info">Día Posterior</button>
      <input type="date" name="fecha" value="{{ $fecha }}" class="form-control d-inline-block w-auto">
      <button type="submit" class="btn btn-success">Buscar por Fecha</button>
    </form>
  </div>

  <!-- Tabla de distribuciones -->
  <table class="table">
    <thead>
      <tr>
        <th>Fec.Reparto</th>
        <th>Fec.Fac</th>
        <th>Nro.Fac</th>
        <th>Imp.Fac</th>
        <th>Impresa</th>
        <th>Chofer</th>
        <th>Orden</th>
        <th>Pedido</th>
        <th>NomFantasia</th>
        <th>RazonSocial</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($distribuciones as $distribucion)
      @foreach ($distribucion->lineasPedidos as $lineaPedido)
      <tr>
        <td>{{ $lineaPedido->fechaEntrega }}</td>
        <td>{{ $lineaPedido->fechaFactura }}</td>
        <td>{{ $lineaPedido->nroFactura }}</td>
        <td>{{ $lineaPedido->total_factura }}</td>
        <td>{{ $distribucion->distribucion->fac_imp }}</td>
        <td>{{ $lineaPedido->chofer }}</td>
        <td>{{ $lineaPedido->orden }}</td>
        <td>{{ $lineaPedido->id }}</td>
        <td>{{ $distribucion->distribucion->nomfantasia }}</td>
        <td>{{ $distribucion->distribucion->razonsocial }}</td>
      </tr>
      @endforeach

      @foreach ($distribucion->lineasTareas as $lineaTarea)
      <tr>
        <td>{{ $distribucion->fechaEntrega }}</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>{{ $lineaPedido->chofer }}</td>
        <td>{{ $lineaPedido->orden }}</td>
        <td>{{ $distribucion->id }}</td>
        <td>{{ $distribucion->distribucion->nomfantasia }}</td>
        <td>{{ $distribucion->distribucion->razonsocial }}</td>
        <td>{{ $lineaTarea->cantidad }}</td>
        <td>{{ $lineaTarea->estado_pedido }}</td>
      </tr>
      @endforeach
      @endforeach
    </tbody>
  </table>

  <!-- Paginación -->
  <div class="d-flex justify-content-center">
    {{ $distribuciones->links() }}
  </div>

</div>
@endsection