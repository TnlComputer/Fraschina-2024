@extends('adminlte::page')

@section('content')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card-header">
        <h3 class="card-title">{{ __('Expedicion General') }}</h3>
      </div>
      <div class="col-12">
        <div class="py-2">
          <div class="barra__index d-flex justify-content-between align-items-center mb-3">
            <div class="div__nuevo">
              <!-- Botón "Nuevo" a la izquierda -->
              <form action="{{ route('expedicion_general.create') }}">
                <input class="btn btn-success" type="submit" value="Nuevo">
              </form>
            </div>
            <div class="div__buscar d-flex">
              <!-- Formulario de búsqueda alineado a la derecha -->
              <form action="{{ route('expedicion_general.index') }}" method="GET" class="form__buscar d-flex">
                @csrf

                <input type="text" name="mo" class="form-control me-2" style="max-width: 90px;" placeholder="MO"
                  value="{{ request('mo') }}">
                <input type=" text" name="cl" class="form-control me-2" style="max-width: 90px;" placeholder="CL"
                  value="{{ request('cl') }}">
                <input type="text" name="modo" class="form-control me-2" style="max-width: 90px;" placeholder="Modo"
                  value="{{ request('modo') }}">
                <input type="text" name="prod" class="form-control me-2" style="max-width: 90px;" placeholder="Prod"
                  value="{{ request('prod') }}">
                <input type="date" name="fecha" class="form-control me-2" value="{{ request('fecha') }}"
                  placeholder="Buscar por Fecha">
                <input type="number" name="year" class="form-control me-2" style="max-width: 90px;" placeholder="Año"
                  min="2000" value="{{ request('year') }}">
                <input type="submit" value="Buscar" class="btn btn-secondary">
              </form>
            </div>
          </div>
          {{-- <div class="card-body"> --}}
            <table class="table table-sm table-striped table-bordered">
              <thead>
                <tr>
                  <th>FECHA</th>
                  <th>MO</th>
                  <th>CLI</th>
                  <th>Modo</th>
                  <th>Prod</th>
                  <th>P</th>
                  <th>L</th>
                  <th>PL</th>
                  <th>W</th>
                  <th>GH</th>
                  <th>GS</th>
                  <th>HUM</th>
                  <th>CZ</th>
                  <th>EST</th>
                  <th>ABS</th>
                  <th>FN</th>
                  <th>Punt</th>
                  <th>Particularidades</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              @forelse($expedicion_general as $expedicion_gral)
              <tr class="text-sm">
                <td>{{ \Carbon\Carbon::parse($expedicion_gral->fecha)->format('Ymd') }}</td>
                <td>{{ $expedicion_gral->mo }}</td>
                <td>{{ $expedicion_gral->cl }}</td>
                <td>{{ $expedicion_gral->modo }}</td>
                <td>{{ $expedicion_gral->prod }}</td>
                <td>{{ $expedicion_gral->p }}</td>
                <td>{{ $expedicion_gral->l }}</td>
                <td>{{ $expedicion_gral->pl }}</td>
                <td>{{ $expedicion_gral->w }}</td>
                <td>{{ $expedicion_gral->gh }}</td>
                <td>{{ $expedicion_gral->gs }}</td>
                <td>{{ $expedicion_gral->hum }}</td>
                <td>{{ $expedicion_gral->cz }}</td>
                <td>{{ $expedicion_gral->est }}</td>
                <td>{{ $expedicion_gral->abs }}</td>
                <td>{{ $expedicion_gral->fn }}</td>
                <td>{{ $expedicion_gral->punt }}</td>
                <td>{{ $expedicion_gral->particularidades }}</td>
                <td class="d-flex justify-content-center">
                  @can('permiso_12')
                  <a href="{{ route('expedicion_general.edit', $expedicion_gral->id) }}"
                    class="btn btn-warning btn-xs mx-1" title="Editar">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </a>
                  @endcan
                  @can('permiso_13')
                  {{-- <form method="POST" action="{{ route('expedicion_general.destroy', $expedicion_gral->id) }}"
                    id="form-desactivar-{{ $expedicion_gral->id }}"> --}}
                    <form method="POST" action="{{ route('expedicion_general.destroy', $expedicion_gral->id) }}"
                      id="form-desactivar-{{ $expedicion_gral->id }}">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-danger btn-xs mx-1" title="Eliminar"
                        onclick="confirmDesactivar({{ $expedicion_gral->id }})">
                        <i class="fa-solid fa-trash"></i>
                      </button>
                    </form>
                    @endcan
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="19" class="text-center">No hay registros para mostrar...</td>
              </tr>
              @endforelse
            </table>
            {{ $expedicion_general->links() }}
          </div>
        </div>
        {{--
      </div> --}}
    </div>
  </div>

  <script>
    function confirmDesactivar(id) {
        // Usando SweetAlert2 para la confirmación
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Este registro será eliminado, ¿deseas continuar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma, enviar el formulario
                document.getElementById('form-desactivar-' + id).submit();
            }
        });
    }
  </script>
  @endsection