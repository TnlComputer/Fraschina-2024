@extends('adminlte::page')

@section('title', 'Distribución')

@section('content')
<div class="container">
  <h1>Distribución</h1>

  <!-- Botones para filtrar por fechas -->
  <div class="mb-3">
    <form method="GET" action="{{ route('distribucion_reparto.index') }}" id="fecha-form">
      <!-- Campo de Fecha -->
      <input type="date" name="fecha" id="fecha-input" value="{{ $fecha }}"
        class="form-control d-inline-block w-auto mb-2">

      <!-- Botones de Cambio de Fecha -->
      <button type="button" class="btn btn-primary mx-1" id="hoy-btn">Hoy</button>
      <button type="button" class="btn btn-secondary mx-1" id="anterior-btn">Día Anterior</button>
      <button type="button" class="btn btn-info mx-1" id="posterior-btn">Día Posterior</button>

      <!-- Botón para Enviar -->
      <button type="submit" class="btn btn-success mx-1">Buscar por Fecha</button>
    </form>
  </div>

  <!-- Tabla de distribuciones -->
  <table class="table table-sm text-sm table-bordered">
    <thead>
      <tr>
        <th>Fec.Reparto</th>
        <th>Fec.Fac</th>
        <th>Nro.Fac</th>
        <th>Imp.Fac</th>
        <th><i class="fas fa-print"></i></th>
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
        <td class=" text-center">{{ $lineaPedido->fechaEntrega }}</td>
        <td class="text-center">
          <input type="date" name="fechaFactura[{{ $lineaPedido->id }}]" value="{{ $lineaPedido->fechaFactura }}"
            class="form-control text-center" />
        </td>
        <td class="text-center">
          <input type="text" name="nroFactura[{{ $lineaPedido->id }}]" value="{{ $lineaPedido->nroFactura }}"
            class="form-control text-center" />
        </td>
        <td class="text-center">
          <input type="number" name="totalFactura[{{ $lineaPedido->id }}]" value="{{ $lineaPedido->total_factura }}"
            class="form-control text-center" step="0.01" />
        </td>
        <td class="{{ $distribucion->distribucion->fac_imp ? 'bg-yellow-300' : '' }}">
          @if ($distribucion->distribucion->fac_imp)
          <i class="fas fa-print text-success" title="Factura Impresa"></i>
          @else
          <i class="fas fa-times-circle text-danger" title="Factura No Impresa"></i>
          @endif
        </td>
        <td class="text-center">
          <input type="text" name="chofer[{{ $lineaPedido->id }}]" value="{{ $lineaPedido->chofer }}"
            class="form-control text-center" />
        </td>
        <td class="text-center">
          <input type="number" name="orden[{{ $lineaPedido->id }}]" value="{{ $lineaPedido->orden }}"
            class="form-control text-center" />
        </td>
        <td>{{ $lineaPedido->id }}</td>
        <td>{{ $distribucion->distribucion->nomfantasia }}</td>
        <td>{{ $distribucion->distribucion->razonsocial }}</td>
      </tr>
      @endforeach
      @endforeach
    </tbody>
  </table>

  <!-- Paginación -->
  {{-- <div class="d-flex justify-content-center">
    {{ $distribuciones->links() }}
  </div> --}}
  <!-- Paginación -->
  <div class="d-flex justify-content-center">
    {{ $distribuciones->appends(['fecha' => $fecha])->links() }}
  </div>

</div>

<!-- Scripts -->
<script>
  // Botones y Campo de Fecha
  const hoyBtn = document.getElementById('hoy-btn');
  const anteriorBtn = document.getElementById('anterior-btn');
  const posteriorBtn = document.getElementById('posterior-btn');
  const fechaInput = document.getElementById('fecha-input');
  
  // Función para actualizar el campo de fecha
  function actualizarFecha(dias) {
    const fechaActual = new Date(fechaInput.value || new Date());
    fechaActual.setDate(fechaActual.getDate() + dias);
    fechaInput.value = fechaActual.toISOString().split('T')[0]; // Formato YYYY-MM-DD
    document.getElementById('fecha-form').submit(); // Envía el formulario
  }
  
  // Eventos de los Botones
  hoyBtn.addEventListener('click', () => {
    fechaInput.value = new Date().toISOString().split('T')[0];
    document.getElementById('fecha-form').submit(); // Envía el formulario
  });
  
  anteriorBtn.addEventListener('click', () => {
    actualizarFecha(-1);
  });
  
  posteriorBtn.addEventListener('click', () => {
    actualizarFecha(1);
  });
</script>
@endsection