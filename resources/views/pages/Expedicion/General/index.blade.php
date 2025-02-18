@extends('adminlte::page')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card-header">
        <h3 class="card-title">{{ __('Expedicion General') }}</h3>
      </div>
      <div class="col-12">
        <div class="py-2">
          <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-2 text-gray-900 text-left text-xs">
                <div class="barra__index d-flex justify-content-between align-items-center mb-3">
                  <div class="div__nuevo">
                    <form action="{{ route('expedicion_general.create') }}">
                      <input class="btn btn-primary" type="submit" value="Nuevo">
                    </form>
                  </div>
                  <div class="div__buscar d-flex">
                    <form method="get" action="{{ route('expedicion_general.index') }}" class="form__buscar d-flex">
                      @csrf
                      <input type="text" placeholder="Buscar por nombre" name="name" value="{{ $name }}"
                        class="form-control me-2" style="max-width: 350px;">
                      <input type="submit" value="Buscar" class="btn btn-secondary">
                    </form>
                  </div>
                </div>
                <table class="table table-sm table-striped table-bordered">
                  <thead>
                    <tr>
                      <td>FECHA</td>
                      <th>MO</th>
                      <th>CLI</th>
                      <th>modo</th>
                      <th>prd</th>
                      <th>p</th>
                      <th>l</th>
                      <th>pl</th>
                      <th>w </th>
                      <th>gh </th>
                      <th>gs </th>
                      <th>hum </th>
                      <th>cz </th>
                      <th>est </th>
                      <th>abs </th>
                      <th>fn </th>
                      <th>punt </th>
                      <th>Particularidades</th>
                    </tr>
                  </thead>
                  @forelse($expedicion_general as $expedicion_gral)
                  <tr>
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

                    {{-- <td>
                      <a href="{{ route('expedicion_molinos.show', $expedicion_gral->id) }}" class="btn-xs btn-info"
                        title="Ver">
                        <i class="fa-regular fa-eye fa-xs align-middle"></i>
                      </a>
                      <a href="{{ route('expedicion_molinos.edit', $expedicion_gral->id) }}" class="btn-xs btn-warning"
                        title="Editar">
                        <i class="fa-solid fa-pen-to-square fa-xs "></i>
                      </a>
                      <form method="POST" action="{{ route('expedicion_general.destroy', $expedicion_gral->id) }}"
                        onsubmit="return confirm('¿Estás seguro de eliminar este registro?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-xs btn-danger" title="Eliminar">
                          <i class="fa-solid fa-trash fa-xs"></i>
                        </button>
                      </form>
                    </td> --}}
                  </tr>
                  @empty
                  <p>No hay registros para mostrar...</p>
                  @endforelse
                </table>
                {{ $expedicion_general->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection