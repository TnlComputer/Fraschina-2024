@extends('adminlte::page')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card-header">
        <h3 class="card-title">{{ __('Transporte') }}</h3>
      </div>
      <div class="col-12">
        <div class="py-2">
          <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-2 text-gray-900 text-left text-xs">
                <div class="barra__index d-flex justify-content-between align-items-center mb-3">
                  <div class="div__nuevo">
                    <form action="{{ route('expedicion_mtcs_textos_clientes.create') }}">
                      <input class="btn btn-primary" type="submit" value="Nuevo">
                    </form>
                  </div>
                  <div class="div__buscar d-flex">
                    <form method="get" action="{{ route('expedicion.MTC.index') }}" class="form__buscar d-flex">
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
                      </th>
                      <td>Molino Nro</td>
                      <th>Calificación</th>
                      <th>Sigla</th>
                      <th>nro U Pedido</th>
                      <th>Estado U Pedido</th>
                      <th>Cliente Nro</th>
                      <th></th>
                    </tr>
                  </thead>
                  @forelse($expedicions_MTC as $expedicion_MTC)
                  <tr>
                    <td>{{ $expedicion_mtc->nroMolino_id }}</td>
                    <td>{{ $expedicion_mtc->calificacion }}</td>
                    <td>{{ $expedicion_mtc->sigla }}</td>
                    <td>{{ $expedicion_mtc->nroUPed }}</td>
                    <td>{{ $expedicion_mtc->contMolino }}</td>
                    <td>{{ $expedicion_mtc->estadoNroMolino }}</td>
                    <td>{{ $expedicion_mtc->nroCliente_id }}</td>
                    <td class=" d-flex justify-content-between">
                      <a href="{{ route('expedicion_mtcs.show', $expedicion_EMT->id) }}" class="btn-xs btn-info"
                        title="Ver">
                        <i class="fa-regular fa-eye fa-xs align-middle"></i>
                      </a>
                      <a href="{{ route('expedicion_mtcs.edit', $expedicion_mtc->id) }}"
                        class="btn-xs btn-warning" title="Editar">
                        <i class="fa-solid fa-pen-to-square fa-xs "></i>
                      </a>
                      <form method="POST" action="{{ route('expedicion_mtcs.destroy', $expedicion_mtc->id) }}"
                        onsubmit="return confirm('¿Estás seguro de eliminar este registro?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-xs btn-danger" title="Eliminar">
                          <i class="fa-solid fa-trash fa-xs"></i>
                        </button>
                      </form>
                    </td>

                  </tr>
                  @empty
                  <p>No hay registros para mostrar...</p>
                  @endforelse
                </table>
                {{-- {{ $expedicion_mtcs->links() }} --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection