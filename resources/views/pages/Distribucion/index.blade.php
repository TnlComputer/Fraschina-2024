{{-- @extends('adminlte::page')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card-header">
        <h3 class="card-title">{{ __('Distribución') }}</h3>
      </div>
      <div class="col-12">
        <div class="py-2">
          <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-2 text-gray-900 text-left text-xs">
                <div class="barra__index d-flex justify-content-between align-items-center mb-3">
                  <div class="div__nuevo">
                    <form action="{{ route('distribucion.create') }}">
                      <input class="btn btn-primary" type="submit" value="Nuevo">
                    </form>
                  </div>
                  <div class="div__buscar d-flex">
                    <form method="get" action="{{ route('distribucion.index') }}" class="form__buscar d-flex">
                      @csrf
                      <input type="text" placeholder="Buscar por nombre" name="name" value="{{ $name }}"
                        class="form-control me-2" style="max-width: 350px;">
                      <input type="submit" value="Buscar" class="btn btn-secondary">
                    </form>
                  </div>
                </div>

                <table class="table table-sm table-striped table-bordered w-100">
                  <thead>
                    <tr>
                      <th>Nro.GS</th>
                      <th>Nombre Fantasía</th>
                      <th>Razón social</th>
                      <th>Dirección</th>
                      <th>Barrio</th>
                      <th>Localidad</th>
                      <th>Municipio</th>
                      <th>Zona</th>
                      <th>Teléfono</th>
                      <th>Email</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($distribuciones as $distribucion)
                    <tr class="text-xs">
                      <td>{{ $distribucion->clisg_id != 0 ? $distribucion->clisg_id : '' }}</td>
                      <td>{{ $distribucion->nomfantasia }}</td>
                      <td>{{ $distribucion->razonsocial }}</td>
                      <td>
                        {{ $distribucion->dire_calle }} {{ $distribucion->dire_nro }}
                        @if($distribucion->piso) Piso {{ $distribucion->piso }} @endif
                        @if($distribucion->dpto) Dpto {{ $distribucion->dpto }} @endif
                        @if($distribucion->codpost) - ({{ $distribucion->codpost }}) @endif
                      </td>
                      <td>{{ $distribucion->barrio }}</td>
                      <td>{{ $distribucion->localidad }}</td>
                      <td>{{ $distribucion->municipio }}</td>
                      <td>{{ $distribucion->zona }}</td>
                      <td>{{ $distribucion->telefono }}</td>
                      <td>{{ $distribucion->correo }}</td>
                      <td class="d-flex justify-content-around">
                        <a href="{{ route('distribucion.show', $distribucion->id) }}" class="btn btn-info btn-sm"
                          title="Ver">
                          <i class="fa-regular fa-eye"></i>
                        </a>
                        <a href="{{ route('distribucion.edit', $distribucion->id) }}" class="btn btn-warning btn-sm"
                          title="Editar">
                          <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        <form method="POST" action="{{ route('distribucion.destroy', $distribucion->id) }}"
                          class="d-inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este registro?');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                            <i class="fa-solid fa-trash"></i>
                          </button>
                        </form>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="11" class="text-center">No hay registros para mostrar...</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
                {{ $distribuciones->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection --}}



@extends('adminlte::page')

@section('css')
<style>
  .btn-custom-sm {
    font-size: 0.75rem;
    /* Reduce el tamaño de la fuente */
    padding: 0.25rem 0.5rem;
    /* Reduce el padding del botón */
  }
</style>
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card-header">
        <h3 class="card-title">{{ __('Distribución') }}</h3>
      </div>
      <div class="col-12">
        <div class="py-2">
          <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-2 text-gray-900 text-left text-xs">
                <div class="barra__index d-flex justify-content-between align-items-center mb-3">
                  <div class="div__nuevo">
                    <form action="{{ route('distribucion.create') }}">
                      <input class="btn btn-primary" type="submit" value="Nuevo">
                    </form>
                  </div>
                  <div class="div__buscar d-flex">
                    <form method="get" action="{{ route('distribucion.index') }}" class="form__buscar d-flex">
                      @csrf
                      <input type="text" placeholder="Buscar por nombre" name="name" value="{{ $name }}"
                        class="form-control me-2" style="max-width: 350px;">
                      <input type="submit" value="Buscar" class="btn btn-secondary">
                    </form>
                  </div>
                </div>

                <table class="table table-sm table-striped table-bordered w-100">
                  <thead>
                    <tr>
                      <th>Nro.GS</th>
                      <th>Nombre Fantasía</th>
                      <th>Razón social</th>
                      <th>Dirección</th>
                      <th>Barrio</th>
                      <th>Localidad</th>
                      <th>Municipio</th>
                      <th>Zona</th>
                      <th>Teléfono</th>
                      <th>Email</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($distribuciones as $distribucion)
                    <tr class="text-xs">
                      <td>{{ $distribucion->clisg_id != 0 ? $distribucion->clisg_id : '' }}</td>
                      <td>{{ $distribucion->nomfantasia }}</td>
                      <td>{{ $distribucion->razonsocial }}</td>
                      <td>
                        {{ $distribucion->dire_calle }} {{ $distribucion->dire_nro }}
                        @if($distribucion->piso) Piso {{ $distribucion->piso }} @endif
                        @if($distribucion->dpto) Dpto {{ $distribucion->dpto }} @endif
                        @if($distribucion->codpost) - ({{ $distribucion->codpost }}) @endif
                      </td>
                      <td>{{ $distribucion->barrio }}</td>
                      <td>{{ $distribucion->localidad }}</td>
                      <td>{{ $distribucion->municipio }}</td>
                      <td>{{ $distribucion->zona }}</td>
                      <td>{{ $distribucion->telefono }}</td>
                      <td>{{ $distribucion->correo }}</td>
                      <td class="d-flex justify-content-around">
                        <a href="{{ route('distribucion.show', $distribucion->id) }}" class="btn btn-info btn-custom-sm"
                          title="Ver">
                          <i class="fa-regular fa-eye"></i>
                        </a>
                        <a href="{{ route('distribucion.edit', $distribucion->id) }}"
                          class="btn btn-warning btn-custom-sm" title="Editar">
                          <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        <form method="POST" action="{{ route('distribucion.destroy', $distribucion->id) }}"
                          class="d-inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este registro?');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-custom-sm" title="Eliminar">
                            <i class="fa-solid fa-trash"></i>
                          </button>
                        </form>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="11" class="text-center">No hay registros para mostrar...</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
                {{ $distribuciones->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection