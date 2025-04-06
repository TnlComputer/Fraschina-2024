@extends('adminlte::page')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card-header">
        <h3 class="card-title">{{ __('Expedición Cliente') }}</h3>
      </div>
      <div class="col-12">
        <div class="py-2">
          <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-2 text-gray-900 text-left text-sm">

                {{-- Selector de Cliente --}}
                <form method="GET" action="{{ route('expedicion_cliente.index') }}" class="mb-3">
                  @csrf
                  <div class="d-flex align-items-center">
                    <label for="cliente" class="m-2">Seleccionar Cliente </label>
                    <select name="origen_tabla" id="cliente" class="form-control m-2" style="max-width: 300px;">
                      <option value="">-- Seleccione un Cliente --</option>
                      @foreach ($clientes as $cliente)
                      <option value="{{ $cliente->origen_tabla }}" {{ request('origen_tabla')==$cliente->origen_tabla ?
                        'selected' : '' }}>
                        {{ $cliente->origen_tabla }}
                      </option>
                      @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                  </div>
                </form>

                {{-- Solo mostrar la tabla si se ha seleccionado un cliente --}}
                @if(request('origen_tabla'))
                <table class="table table-sm table-striped table-bordered w-100">
                  <tr>
                    <th><strong>M</strong></th>
                    <th><strong>PM</strong></th>
                    <th><strong>*</strong></th>
                    <th><strong>FE</strong></th>
                    <th><strong>OR</strong></th>
                    <th><strong>PL</strong></th>
                    <th><strong>CA</strong></th>
                    <th><strong>TB</strong></th>
                    <th><strong>K</strong></th>
                    <th><strong>P</strong></th>
                    <th><strong>I</strong></th>
                    <th><strong>D</strong></th>
                    <th><strong>N</strong></th>
                    <th><strong>FP</strong></th>
                    <th><strong>PP</strong></th>
                    <th><strong>O</strong></th>
                    <th><strong>Ficha</strong></th>
                  </tr>
                  @foreach ($expedicion_clientes as $expedicion_cliente)
                  <tr class="text-sm">
                    <td align="right">{{ $expedicion_cliente->m }}</td>
                    <td>{{ $expedicion_cliente->pn }}</td>
                    <td>{{ $expedicion_cliente->es }}</td>
                    <td>{{ \Carbon\Carbon::parse($expedicion_cliente->fe)->format('Ymd') }}</td>
                    <td>{{ $expedicion_cliente->ord }}</td>
                    <td>{{ $expedicion_cliente->pl }}</td>
                    <td>{{ $expedicion_cliente->ca }}</td>
                    <td>{{ $expedicion_cliente->tb }}</td>
                    <td>{{ $expedicion_cliente->k }}</td>
                    <td>{{ $expedicion_cliente->p }}</td>
                    <td>{{ $expedicion_cliente->i }}</td>
                    <td>{{ $expedicion_cliente->d }}</td>
                    <td>{{ $expedicion_cliente->n }}</td>
                    <td>{{ \Carbon\Carbon::parse($expedicion_cliente->fp)->format('Ymd') }}</td>
                    <td>{{ $expedicion_cliente->pp }}</td>
                    <td>{{ $expedicion_cliente->o }}</td>
                    <td>{{ $expedicion_cliente->origen_tabla }}</td>
                  </tr>
                  @endforeach
                </table>

                {{ $expedicion_clientes->appends(request()->query())->links() }}
                @endif

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection