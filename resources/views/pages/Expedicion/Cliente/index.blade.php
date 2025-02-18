@extends('adminlte::page')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card-header">
        <h3 class="card-title">{{ __('Expedicion Cliente') }}</h3>
      </div>
      <div class="col-12">
        <div class="py-2">
          <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-2 text-gray-900 text-left text-xs">
                <div class="barra__index d-flex justify-content-between align-items-center mb-3">
                  <div class="div__nuevo">
                    <form action="{{ route('expedicion_cliente.create') }}">
                      <input class="btn btn-primary" type="submit" value="Nuevo">
                    </form>
                  </div>
                  <div class="div__buscar d-flex">
                    <form method="get" action="{{ route('expedicion_cliente.index') }}" class="form__buscar d-flex">
                      @csrf
                      <input type="text" placeholder="Buscar por nombre" name="name" value="{{ $name }}"
                        class="form-control me-2" style="max-width: 350px;">
                      <input type="submit" value="Buscar" class="btn btn-secondary">
                    </form>
                  </div>
                </div>
                <table class="table table-sm table-striped table-bordered w-100">
                  <tr>
                    <th><strong>Cliente</strong></th>
                    <th><strong>Sigla</strong> </th>
                    <th><strong>Linea 1</strong> </th>
                    <th><strong>Linea 2</strong> </th>
                    <th><strong>Linea 3</strong> </th>
                    <th><strong>Linea 4</strong> </th>
                    <th><strong>Linea 5</strong> </th>
                    <th><strong>Linea 6</strong> </th>
                    <th> <strong>Observaciones</strong> </th>
                    <th> <strong>Comentarios</strong> </th>
                  </tr>
                  @foreach ($expedicion_clientes as $expedicion_cliente)
                  <tr>
                    <td align="right" height="22" style="font-size: 9px">
                      {{ $expedicion_cliente->representacion_id}}
                    </td>
                    <td style="font-size: 9px">
                      {{ $expedicion_cliente->sigla}} </td>
                    <td style="font-size: 9px">
                      {{ $expedicion_cliente->linea1}} </td>
                    <td style="font-size: 9px">
                      {{ $expedicion_cliente->linea2}} </td>
                    <td style="font-size: 9px">
                      {{ $expedicion_cliente->linea3}} </td>
                    <td style="font-size: 9px">
                      {{ $expedicion_cliente->linea4}} </td>
                    <td style="font-size: 9px">
                      {{ $expedicion_cliente->linea5}} </td>
                    <td style="font-size: 9px">
                      {{ $expedicion_cliente->linea6}} </td>
                    <td style="font-size: 9px">
                      {{ $expedicion_cliente->obs}} </td>
                    <td style="font-size: 9px">
                      {{ $expedicion_cliente->comentarios}} </td>
                  </tr>
                  @endforeach
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection