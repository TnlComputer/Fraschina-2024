@extends('adminlte::page')

@section('title', 'Agenda de Distribución')

@section('content_header')
<h1>Agenda de Distribución</h1>
<div class="d-flex justify-content-between align-items-center mt-3">
  <!-- Botón para nuevo contacto -->
  <a href="{{ route('distribucion_agenda.create') }}" class="btn btn-success ml-3">
    <i class="fas fa-plus"></i> Nuevo Contacto Agenda
  </a>
  <!-- Formulario de búsqueda -->
  <form method="GET" action="{{ route('distribucion_agenda.index') }}" class="d-flex">
    <div class="input-group">
      <input type="text" name="search" class="form-control" placeholder="Buscar..."
        value="{{ request()->input('search') }}">
      <button class="btn btn-primary" type="submit">Buscar</button>
    </div>
  </form>
</div>
@stop

@section('content')
<div class="container">
  <!-- Tabla con paginación -->
  <div class="table-responsive">
    <table class="table table-bordered table-sm text-xs">
      <thead>
        <tr>
          <th>Fecha</th>
          <th>Hora</th>
          <th>Auto</th>
          <th>Nombre Fantasía</th>
          <th>Estado</th>
          <th>Acción</th>
          <th>Temas</th>
          <th>Ver más</th>

          {{-- * <th>Prioridad</th>
          * <th>Razón Social</th>
          * <th>Persona</th>
          * <th>Cargo</th>
          * <th>Teléfono</th>
          * <th>Veráz</th> --}}
        </tr>
      </thead>
      <tbody>
        @foreach($agendas as $agenda)
        <tr>
          <td>{{ $agenda->fecha }}</td>
          <td>{{ $agenda->hs }}</td>
          <td>{{ $agenda->distribucion->auto }}</td>
          <td>{{ $agenda->distribucion->nomfantasia ?? '' }}</td>
          <td>{{ $agenda->auxestados->nomEstado ?? '' }}</td>
          <td>{{ $agenda->auxacciones->accion ?? '' }}</td>
          <td>{{ Str::limit($agenda->temas, 120) }}</td>
          {{-- <td>{{ $agenda->auxveraz->estado ?? '' }}</td> --}}
          {{-- <td>{{ $agenda->auxprioridades->nombre ?? '' }}</td>
          <td>{{ $agenda->distribucion->razonsocial ?? '' }}</td>
          <td>{{ $agenda->distribucionPersonal->nombre ?? '' }} {{ $agenda->distribucionPersonal->apellido ?? '' }}</td>
          <td>{{ $agenda->auxcargos->cargo }}</td>
          <td>{{ $agenda->distribucion->telefono }}</td> --}}
          <td>
            <button class="btn btn-info" data-toggle="modal" data-target="#modal{{ $agenda->id }}">
              Ver más
            </button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- Paginación -->
  <div class="pagination justify-content-center">
    {{ $agendas->links() }}
  </div>

  <!-- Modales -->
  @foreach($agendas as $agenda)
  <div class="modal fade" id="modal{{ $agenda->id }}" tabindex="-1" role="dialog"
    aria-labelledby="modalLabel{{ $agenda->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel{{ $agenda->id }}"><strong>Nombre Fantasia:</strong> {{
            $agenda->distribucion->nomfantasia }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <strong>Razón Social:</strong> {{ $agenda->distribucion->razonsocial }} <br>
          <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($agenda->fecha)->format('d-m-Y') }} <br>
          <strong>Hora:</strong> {{ \Carbon\Carbon::parse($agenda->hs)->format('H:i') }} <br>
          <strong>Auto:</strong> {{ $agenda->distribucion->auto }} <br>
          <strong>Veráz:</strong> {{ $agenda->auxveraz->estado }} <br>
          <strong>Estado:</strong> {{ $agenda->auxestados->nomEstado }} <br>
          <strong>Acción:</strong> {{ $agenda->auxacciones->accion }} <br>
          <strong>Prioridad:</strong> {{ $agenda->auxprioridades->nombre }} <br>
          <strong>Cargo:</strong> {{ $agenda->auxcargos->cargo }} <br>
          <strong>Persona:</strong> {{
          $agenda->distribucionPersonal->nombre ?? '' }} {{ $agenda->distribucionPersonal->apellido ?? '' }} <br>
          <strong>Teléfono:</strong> {{ $agenda->distribucion->telefono }} <br>
          <strong>Temas:</strong>
          <span id="temas{{ $agenda->id }}">{{ $agenda->temas }}</span>
          <div id="full-temas{{ $agenda->id }}" style="display: none;">{{ $agenda->temas }}</div><br>
          <strong>Ult.Cotización /Venta:</strong> {{ $agenda->distribucion->telefono }} <br>
          <strong>Fecha Ult.Cotización:</strong> {{ \Carbon\Carbon::parse($agenda->fecha)->format('d-m-Y') }} <br>
          <strong>Cotización:</strong> {{ $agenda->cotizacion }} <br>
          <strong>Fecha Ult.Entrega:</strong> {{ \Carbon\Carbon::parse($agenda->fecha)->format('d-m-Y') }} <br>
          <strong>Información:</strong> {{ $agenda->distribucion->info }} <br>

          <hr class=" bg-green-600">
          <strong>Calle</strong> {{ $agenda->distribucion->dire_calle_id }} <br>
          <strong>Altura</strong> {{ $agenda->distribucion->dire_nro }} <br>
          <strong>Barrio</strong> {{ $agenda->auxbarrios->nombrebarrio }} <br>
          <strong>Ciudad/Municipio</strong> {{ $agenda->auxmunicipios->ciudadmunicipio }} <br>
          <strong>Localidad</strong> {{ $agenda->auxlocalidades->localidad }} <br>
          <strong>Zona</strong> {{ $agenda->auxzonas->zona }} <br>

          <hr class=" bg-blue-600">
          <strong>Rubro</strong> {{ $agenda->auxrubros->nombre }} <br>
          <strong>Tamaño</strong> {{ $agenda->auxtamanios->nombre }} <br>
          <strong>Modo</strong> {{ $agenda->auxmodos->nombre }} <br>
          <strong>Productos</strong> {{ $agenda->distribucion->productosCDA}} <br>
          <strong>Contacto Inicial</strong> {{ $agenda->auxcontacto->contacto }} <br>

          <hr class="bg-blue-900">
          <strong>Horario Entrega Mañana:</strong> {{ $agenda->distribucion->desde }} - {{ $agenda->distribucion->hasta
          }} <br>
          <strong>Horario Entrega Tarde :</strong> {{ $agenda->distribucion->desde1 }} - {{
          $agenda->distribucion->hasta1
          }}
          <br>
          <strong>Lunes Cerrado:</strong> {{ $agenda->distribucion->lunes }} <br>
          <strong>Sabado Recibe:</strong> {{ $agenda->distribucion->sabado }} <br>
          <strong>Factura Impresa:</strong> {{ $agenda->distribucion->fac_imp }} <br>
          <strong>Obs.Recepción:</strong> {{ $agenda->distribucion->obsrecep }} <br>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
@stop

@section('js')
<script>
  function toggleText(id) {
    const shortText = document.getElementById(`temas${id}`);
    const fullText = document.getElementById(`full-temas${id}`);
    if (shortText.style.display === "none") {
      shortText.style.display = "inline";
      fullText.style.display = "none";
    } else {
      shortText.style.display = "none";
      fullText.style.display = "inline";
    }
  }
</script>
@stop