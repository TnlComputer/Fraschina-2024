@extends('adminlte::page')

@section('title', 'Distribución')

@section('content')
<div class="container">
  <h1>Distribución</h1>

  <!-- Botones para filtrar por fechas -->
  <div class="mb-3 d-flex justify-content-between align-items-center">
    <!-- Botón Nuevo Reparto a la izquierda -->
    <div>
      <a href="{{ route('distribucion_reparto.create') }}" class="btn btn-primary">
        Nuevo Reparto
      </a>
    </div>

    <!-- Formulario y Botones de Cambio de Fecha a la derecha -->
    <form method="GET" action="{{ route('distribucion_reparto.index') }}" id="fecha-form"
      class="d-flex align-items-center">
      <!-- Campo de Fecha -->
      <input type="date" name="fecha" id="fecha-input" value="{{ $fecha }}"
        class="form-control d-inline-block w-auto h-100" style="height: calc(2.25rem + 2px);">

      <!-- Botones de Cambio de Fecha -->
      <button type="submit" class="btn btn-success mx-1 h-100">Buscar por Fecha</button>
      <button type="button" class="btn btn-secondary mx-1 h-100" id="anterior-btn">Día Anterior</button>
      <button type="button" class="btn btn-info mx-1 h-100" id="posterior-btn">Día Posterior</button>
      <button type="button" class="btn btn-primary mx-1 h-100" id="hoy-btn">Hoy</button>
    </form>
  </div>

  <!-- Tabla de distribuciones -->
  <table class="table table-sm text-xs table-bordered w-100">
    <thead>
      <tr>
        <th>Fec.Reparto</th>
        <th></th>
        <th class="text-center">Fec.Fac</th>
        <th class="text-center">Nro.Fac</th>
        <th class="text-center">Imp.Fac</th>
        <th><i class="fas fa-print"></i></th>
        <th class="text-center">Chofer</th>
        <th class="text-center">Orden</th>
        {{-- <th>Linea</th> --}}
        <th>Pedido</th>
        <th>NomFantasia</th>
        <th>RazonSocial</th>
      </tr>
    </thead>
    <tbody class="text-xs bold">
      @foreach ($distribuciones as $distribucion)
      <form method="POST" action="{{ route('distribucion_reparto.update', $distribucion->id) }}"
        id="distribucion-form-{{ $distribucion->id }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="fecha" value="{{ $fecha }}">
        @foreach ($distribucion->lineasPedidos as $lineaPedido)
        <tr>
          @if ($lineaPedido->linea == 1)
          <td class=" text-center">{{ $distribucion->fechaEntrega }}</td>
          <td><button type="submit" id="actualizar-btn" class="btn btn-success btn-xs mx-1">
              <i class="fas fa-sync-alt fs-xs"></i>
            </button>
          </td>
          <td class="text-center">
            <input type="date" name="fechaFactura" value="{{ $distribucion->fechaFactura }}" class="text-center text-xs"
              style="width: 100px;" />
          </td>
          <td class="text-center">
            <input type="text" name="nroFactura" value="{{ $distribucion->nroFactura }}" class=" text-center text-xs"
              style="width: 60px;" />
          </td>
          <td class="text-center">
            @if ($distribucion->totalFactura != $distribucion->totalPedido)
            <input type="number" name="totalFactura" value="{{ $distribucion->totalFactura }}"
              title="${{ number_format($distribucion->totalFactura - $distribucion->totalPedido, 2) }}" class="text-center
            text-xs bg-red" step="0.01" style="width: 90px;" />
            @else
            <input type="number" name="totalFactura" value="{{ $distribucion->totalFactura }}"
              class="text-center text-xs" step="0.01" style="width: 90px;" />
            @endif
          </td>
          <td class="{{ $distribucion->distribucion->fac_imp ? 'bg-yellow-300' : '' }}">
            @if ($distribucion->distribucion->fac_imp)
            <i class="fas fa-print text-success" title="Factura Impresa"></i>
            @else
            <i class="fas fa-times-circle text-danger" title="Factura No Impresa"></i>
            @endif
          </td>
          <td class="text-center">
            <input type="text" name="chofer" value="{{ $distribucion->chofer }}" class="text-center text-xs"
              style="width: 30px;" />
          </td>
          <td class="text-center">
            <input type="number" name="orden" value="{{ $distribucion->orden }}" class="text-center text-xs"
              style="width: 40px;" />
          </td>
          @else
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          @endif
          {{-- <td>{{ $lineaPedido->linea }}</td> --}}
          <td>{{ $distribucion->id }}</td>
          <td>{{ $distribucion->distribucion->nomfantasia }}</td>
          <td>{{ $distribucion->distribucion->razonsocial }}</td>
        </tr>
        @endforeach

        @foreach ($distribucion->lineasTareas as $lineaTarea)
        <tr>
          <td class="text-center text-xs">{{ $distribucion->fechaEntrega }}</td>
          <td><button type="submit" id="actualizar-btn" class="btn btn-success btn-xs mx-1">
              <i class="fas fa-sync-alt"></i>
            </button>
          </td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td class="text-center">
            <input type="text" name="chofer" value="{{ $distribucion->chofer }}" class="text-center text-xs"
              style="width: 30px;" />
          </td>
          <td class="text-center">
            <input type="number" name="orden" value="{{ $distribucion->orden }}" class="text-center text-xs"
              style="width: 40px;" min="0" step="1" />
          </td>
          {{-- <td>{{ $lineaTarea->linea }}</td> --}}
          <td>{{ $distribucion->id }}</td>
          <td>{{ $distribucion->distribucion->nomfantasia }}</td>
          <td>{{ $distribucion->distribucion->razonsocial }}</td>
        </tr>
        @endforeach
      </form>
      @endforeach
    </tbody>
  </table>

</div>
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

// Enviar formulario solo cuando se hace clic en "Actualizar Distribución"
  actualizarBtn.addEventListener('click', function() {
  // Buscar el formulario de distribución correspondiente
  const formulario = document.querySelector(`#distribucion-form`);
  if (formulario) {
  formulario.submit();
  }
  });
  
  // Evitar que el formulario se envíe al presionar Enter accidentalmente
  document.querySelector('form').addEventListener('keydown', function(event) {
  if (event.key === 'Enter') {
  event.preventDefault(); // Evita el envío del formulario
  }
  });
</script>
@endsection