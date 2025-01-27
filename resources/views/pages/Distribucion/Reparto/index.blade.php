@extends('adminlte::page')

@section('title', 'Distribución')

@section('content')
<div class="container">
  <h1>Distribución Reparto</h1>

  <!-- Botones para filtrar por fechas -->
  <div class="mb-3 d-flex justify-content-between align-items-center">
    <!-- Botón Nuevo Pedido a la Izquierda -->
    <div>
      <a href="{{ route('distribucion_reparto.create') }}" class="btn btn-primary">
        Nuevo Pedido
      </a>
    </div>
    <!-- Botón Reparto Impresion -->
    <div>
      <a href="{{ route('distribucion_reparto.imprimirReparto', ['fecha' => $fecha]) }}" title="Impresión Reparto"
        target="_blank" class="btn btn-info"><i class="fas fa-print"></i>
        Reparto
      </a>
    </div> <!-- Botón Control Impresion -->
    <div>
      <a href="{{ route('distribucion_reparto.imprimirControl', ['fecha' => $fecha]) }}" title="Impresi´on Control"
        target="_blank" class="btn btn-secondary"><i class="fas fa-print"></i> Control
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
        <th class="text-center">Reparto</th>
        <th colspan="4"></th>
        <th class="text-center">Fecha Fac</th>
        <th class="text-center">Nro.Fac</th>
        <th class="text-center">Imp.Fac</th>
        <th><i class="fas fa-print"></i></th>
        <th class="text-center">Chofer</th>
        <th class="text-center">Orden</th>
        {{-- <th>Linea</th> --}}
        <th>Pedido</th>
        <th>Nombre Fantasia</th>
        <th>Razón Social</th>
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
          <td>
            <a href="{{ route('distribucion_reparto.imprimirRecibo', ['id' => $distribucion->id]) }}"
              class="btn btn-xs mx-1" title="Impresi´on Recibo" target="_blank">
              <i class="fas fa-print fs-xs text-info"></i>
            </a>
          </td>
          <td>
            <a href="{{ route('distribucion_reparto.show', ['distribucion_reparto' => $distribucion->id]) }}"
              class="btn btn-xs" title="Ver Pedido">
              <i class="fas fa-eye fs-xs text-success"></i>
            </a>
          </td>

          <td><a href="#" id="edit-btn" class="btn btn-xs" title="Editar Pedido">
              <i class="fas fa-pen fs-xs text-blue"></i>
            </a>
          </td>
          <td><button type="submit" id="actualizar-btn" class="btn btn-xs" title="Actualizar">
              <i class="fas fa-sync-alt fs-xs text-orange"></i>
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
          <td colspan="11"></td>
          @endif
          <td>{{ $distribucion->id }}</td>

          <!-- En la vista donde quieres mostrar el modal -->
          <td>
            <button type="button" class="btn btn-xs" data-toggle="modal"
              data-target="#infoModal_{{ $distribucion->id }}">
              {{ $distribucion->distribucion->nomfantasia }}
            </button>
          </td>

          <!-- Modal para mostrar la información del pedido -->
          <div class="modal fade" id="infoModal_{{ $distribucion->id }}" tabindex="-1" role="dialog"
            aria-labelledby="infoModalLabel_{{ $distribucion->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <!-- Encabezado del Modal -->
                <div class="modal-header">
                  <h5 class="modal-title" id="infoModalLabel_{{ $distribucion->id }}">Información del Cliente</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <!-- Cuerpo del Modal -->
                <div class="modal-body">
                  <strong>Razón Social:</strong> {{ $distribucion->distribucion->nomfantasia }}<br>
                  <strong>Dirección:</strong> {{ $distribucion->distribucion->auxCalles->calle }} {{
                  $distribucion->distribucion->dire_nro }}
                  {{ $distribucion->distribucion->piso }}
                  {{ $distribucion->distribucion->dpto }} <br>
                  {{ $distribucion->distribucion->auxbarrio->nombrebarrio }} -
                  {{ $distribucion->distribucion->auxlocalidad->localidad }} - {{
                  $distribucion->distribucion->auxmunicipio->ciudadmunicipio }} <br>
                  <strong>Horarios:</strong><br> Mañana: {{ $distribucion->distribucion->desde }} - {{
                  $distribucion->distribucion->hasta }}<br>
                  Tarde: {{ $distribucion->distribucion->desde1 }} -{{ $distribucion->distribucion->hasta1 }}<br>
                  <strong>Observaciones:</strong><br>
                  {{$distribucion->distribucion->obsrecep }}<br>
                </div>
                <!-- Pie del Modal -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>

          <td>{{ $distribucion->distribucion->razonsocial }}</td>
        </tr>
        @endforeach

        @foreach ($distribucion->lineasTareas as $lineaTarea)
        <tr>
          <td class="text-center text-xs">{{ $distribucion->fechaEntrega }}</td>
          <td colspan="3"></td>
          <td><button type="submit" id="actualizar-btn" class="btn btn-xs text-orange">
              <i class="fas fa-sync-alt"></i>
            </button>
          </td>
          <td colspan="4"></td>
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
          <!-- En la vista donde quieres mostrar el modal -->
          <td>
            <button type="button" class="btn btn-xs" data-toggle="modal"
              data-target="#infoModal_{{ $distribucion->id }}">
              {{ $distribucion->distribucion->nomfantasia }}
            </button>
          </td>

          <!-- Modal para mostrar la información del pedido -->
          <div class="modal fade" id="infoModal_{{ $distribucion->id }}" tabindex="-1" role="dialog"
            aria-labelledby="infoModalLabel_{{ $distribucion->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <!-- Encabezado del Modal -->
                <div class="modal-header">
                  <h5 class="modal-title" id="infoModalLabel_{{ $distribucion->id }}">Información del Cliente</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <!-- Cuerpo del Modal -->
                <div class="modal-body">
                  <strong>Razón Social:</strong> {{ $distribucion->distribucion->nomfantasia }}<br>
                  <strong>Dirección:</strong> {{ $distribucion->distribucion->auxCalles->calle }} {{
                  $distribucion->distribucion->dire_nro }}
                  {{ $distribucion->distribucion->piso }}
                  {{ $distribucion->distribucion->dpto }} <br>
                  {{ $distribucion->distribucion->auxbarrio->nombrebarrio }} -
                  {{ $distribucion->distribucion->auxlocalidad->localidad }} - {{
                  $distribucion->distribucion->auxmunicipio->ciudadmunicipio }} <br>
                  <strong>Horarios:</strong><br> Mañana: {{ $distribucion->distribucion->desde }} - {{
                  $distribucion->distribucion->hasta }}<br>
                  Tarde: {{ $distribucion->distribucion->desde1 }} -{{ $distribucion->distribucion->hasta1 }}<br>
                  <strong>Detalles:</strong><br>
                  {{ $lineaTarea->detalles ?? 'No hay detalles' }}<br>
                  <strong>Tarea:</strong><br>
                  {{ $lineaTarea->tarea->tarea ?? 'Sin tarea' }}<br>
                </div>
                <!-- Pie del Modal -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
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

<!-- Modal -->
<div class="modal fade" id="modalInfo" tabindex="-1" aria-labelledby="modalInfoLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalInfoLabel">Información del Pedido</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="modal-content-body"></div> <!-- Aquí se insertará el contenido dinámico -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
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

  $(document).ready(function(){
    // Al hacer clic en el nombre de fantasía, abrir el modal y cargar contenido
    $('#openModal').on('click', function(e) {
      e.preventDefault();

      var id = $(this).data('id');
      var calle = $(this).data('calle');
      var direccion = $(this).data('direccion');
      var piso = $(this).data('piso');
      var dpto = $(this).data('dpto');
      var barrio = $(this).data('barrio');
      var localidad = $(this).data('localidad');
      var desde = $(this).data('desde');
      var hasta = $(this).data('hasta');
      var desde1 = $(this).data('desde1');
      var hasta1 = $(this).data('hasta1');
      var nomfantasia = $(this).data('nomfantasia');

      // Crear el contenido del modal
      var modalContent = `
        <p><strong>Dirección:</strong> ${calle} ${direccion} ${piso} ${dpto} ${barrio} - ${localidad}</p>
        <p><strong>Horarios:</strong> Mañana: ${desde} - ${hasta} | Tarde: ${desde1} - ${hasta1}</p>
        <p><strong>Nombre de Fantasía:</strong> ${nomfantasia}</p>
      `;

      // Insertar el contenido en el cuerpo del modal
      $('#modal-content-body').html(modalContent);

      // Mostrar el modal
      $('#modalInfo').modal('show');
    });
  });
</script>
@endsection