{{-- @extends('adminlte::page')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ __('Detalle de Distribución') }}</h3>
          <a href="{{ route('distribucion.index') }}" class="btn btn-secondary btn-sm float-right">Volver</a>
        </div>

        <div class="card-body">
          <!-- Información de la Distribución -->
          <h4>Información de la Distribución</h4>
          <div class="row">
            <div class="col-md-6">
              <table class="table table-sm table-bordered">
                <tbody class="text-xs">
                  <tr>
                    <th>Nro. GS</th>
                    <td>
                      @if ($distribucion->clisg_id > 0)
                      {{ $distribucion->clisg_id }}
                      @else
                      No disponible
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <th>Nombre Fantasía</th>
                    <td>{{ $distribucion->nomfantasia }}</td>
                  </tr>
                  <tr>
                    <th>Razón Social</th>
                    <td>{{ $distribucion->razonsocial }}</td>
                  </tr>
                  <tr>
                    <th>Teléfono</th>
                    <td>{{ $distribucion->telefono }}</td>
                  </tr>
                  <tr>
                    <th>Email</th>
                    <td>{{ $distribucion->correo }}</td>
                  </tr>
                  <tr>
                    <th>CUIT/DNI</th>
                    <td>{{ $distribucion->cuit }}</td>
                  </tr>
                  <tr>
                    <th>Estado</th>
                    <td>{{ $distribucion->estado }}</td>
                  </tr>
                  <tr>
                    <th>Veraz</th>
                    <td>{{ $distribucion->veraz ?? 'No disponible' }}</td>
                  </tr>
                  <tr>
                    <th>Recibe x la mañana</th>
                    <td>{{ $distribucion->desde }} {{ $distribucion->hasta }}</td>
                  </tr>
                  <tr>
                    <th>Recibe x la tarde)</th>
                    <td>{{ $distribucion->desde1 }} {{ $distribucion->hasta1 }}</td>
                  </tr>
                  <tr>
                    <th>Lunes Cerrado</th>
                    <td>{{ $distribucion->lunes ? 'Sí' : 'No' }}</td>
                  </tr>
                  <tr>
                    <th>Sábado Recibe</th>
                    <td>{{ $distribucion->sabado ? 'Sí' : 'No' }}</td>
                  </tr>
                  <tr>
                    <th>Factura Impresa</th>
                    <td>{{ $distribucion->fac_imp ? 'Sí' : 'No' }}</td>
                  </tr>
                  <tr>
                    <th>Marcas</th>
                    <td>{{ $distribucion->Marcas ?? 'No especificada' }}</td>
                  </tr>
                  <tr>
                    <th>Contacto inicial</th>
                    <td>{{ $distribucion->contacto ?? 'Sin contacto' }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-md-6">
              <table class="table table-sm table-bordered">
                <tbody class="text-xs">
                  <tr>
                    <th>Dirección</th>
                    <td>{{ $distribucion->dire_calle }} {{ $distribucion->dire_nro }}</td>
                  </tr>
                  <tr>
                    <th>Barrio</th>
                    <td>{{ $distribucion->barrio }}</td>
                  </tr>
                  <tr>
                    <th>Ciudad/Municipio</th>
                    <td>{{ $distribucion->municipio }}</td>
                  </tr>
                  <tr>
                    <th>Localidad/Provincia</th>
                    <td>{{ $distribucion->localidad }}</td>
                  </tr>
                  <tr>
                    <th>Zona</th>
                    <td>{{ $distribucion->zona }}</td>
                  </tr>
                  <tr>
                    <th>Rubro/Tamaño/Modo</th>
                    <td>{{ $distribucion->rubro }}
                      @if ($distribucion->tamanio) - {{ $distribucion->tamanio }} @endif
                      @if ($distribucion->modo) - {{ $distribucion->modo }} @endif
                    </td>
                  </tr>
                  <tr>
                    <th>Productos</th>
                    <td>{{ $distribucion->productoCDA ?? 'No disponibles' }}</td>
                  </tr>
                  <tr>
                    <th>Observaciones Recepción</th>
                    <td>{{ $distribucion->obsrecep ?? 'No disponibles' }}</td>
                  </tr>
                  <tr>
                    <th>Cobrar</th>
                    <td>{{ $distribucion->cobrar ?? 'No especificada' }}</td>
                  </tr>
                  <tr>
                    <th>Condición de Pago</th>
                    <td>{{ $distribucion->cobro ?? 'No especificada' }}</td>
                  </tr>
                  <tr>
                    <th>Forma de Pago</th>
                    <td>{{ $distribucion->tpago ?? 'No especificada' }}</td>
                  </tr>
                  <tr>
                    <th>Información</th>
                    <td>{{ $distribucion->info ?? 'No especificada' }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Personal Asociado -->
          <h4>Personal Asociado</h4>
          <table class="table table-sm table-bordered">
            <thead class="text-xs">
              <tr>
                <th>Nombre</th>
                <th>Cargo</th>
                <th>Área</th>
                <th>Teléfono</th>
                <th>Email</th>
              </tr>
            </thead>
            <tbody class="text-xs">
              @foreach($personal as $persona)
              <tr>
                <td>{{ $persona->nombre }} {{ $persona->apellido }}</td>
                <td>{{ $persona->cargo }}</td>
                <td>{{ $persona->area }}</td>
                <td>{{ $persona->telcelular }}</td>
                <td>{{ $persona->email }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>

          <!-- Productos Asociados -->
          <h4>Productos Asociados</h4>
          <table class="table table-sm table-bordered">
            <thead class="text-xs">
              <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Fecha Última Cotización</th>
                <th>Fecha Última Entrega</th>
              </tr>
            </thead>
            <tbody class="text-xs">
              @foreach($productos as $producto)
              <tr>
                <td>{{ $producto->nomproducto }}</td>
                <td>{{ number_format($producto->precio, 2) }}</td>
                <td>{{ \Carbon\Carbon::parse($producto->fecha)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($producto->fechaUEnt)->format('d-m-Y') }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection --}}


@extends('adminlte::page')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ __('Detalle de Distribución') }}</h3>
          <a href="{{ route('distribucion.index') }}" class="btn btn-secondary btn-sm float-right">Volver</a>
        </div>

        <div class="card-body">
          <!-- Información de la Distribución -->
          <h4>Información de la Distribución</h4>
          <div class="row">
            <div class="col-md-6">
              <div class="table-responsive">
                <table class="table table-sm table-bordered">
                  <tbody class="text-xs">
                    <tr>
                      <th>Nro. GS</th>
                      <td>
                        @if ($distribucion->clisg_id > 0)
                        {{ $distribucion->clisg_id }}
                        @else
                        No disponible
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <th>Nombre Fantasía</th>
                      <td>{{ $distribucion->nomfantasia }}</td>
                    </tr>
                    <tr>
                      <th>Razón Social</th>
                      <td>{{ $distribucion->razonsocial }}</td>
                    </tr>
                    <tr>
                      <th>Teléfono</th>
                      <td>{{ $distribucion->telefono }}</td>
                    </tr>
                    <tr>
                      <th>Email</th>
                      <td>{{ $distribucion->correo }}</td>
                    </tr>
                    <tr>
                      <th>CUIT/DNI</th>
                      <td>{{ $distribucion->cuit }}</td>
                    </tr>
                    <tr>
                      <th>Estado</th>
                      <td>{{ $distribucion->estado }}</td>
                    </tr>
                    <tr>
                      <th>Veraz</th>
                      <td>{{ $distribucion->veraz ?? 'No disponible' }}</td>
                    </tr>
                    <tr>
                      <th>Recibe x la mañana</th>
                      <td>{{ $distribucion->desde }} {{ $distribucion->hasta }}</td>
                    </tr>
                    <tr>
                      <th>Recibe x la tarde</th>
                      <td>{{ $distribucion->desde1 }} {{ $distribucion->hasta1 }}</td>
                    </tr>
                    <tr>
                      <th>Lunes Cerrado</th>
                      <td>{{ $distribucion->lunes ? 'Sí' : 'No' }}</td>
                    </tr>
                    <tr>
                      <th>Sábado Recibe</th>
                      <td>{{ $distribucion->sabado ? 'Sí' : 'No' }}</td>
                    </tr>
                    <tr>
                      <th>Marcas</th>
                      <td>{{ $distribucion->Marcas ?? 'No especificada' }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-md-6">
              <div class="table-responsive">
                <table class="table table-sm table-bordered">
                  <tbody class="text-xs">
                    <tr>
                      <th>Dirección</th>
                      <td>{{ $distribucion->dire_calle }} {{ $distribucion->dire_nro }}</td>
                    </tr>
                    <tr>
                      <th>Barrio</th>
                      <td>{{ $distribucion->barrio }}</td>
                    </tr>
                    <tr>
                      <th>Ciudad/Municipio</th>
                      <td>{{ $distribucion->municipio }}</td>
                    </tr>
                    <tr>
                      <th>Localidad/Provincia</th>
                      <td>{{ $distribucion->localidad }}</td>
                    </tr>
                    <tr>
                      <th>Zona</th>
                      <td>{{ $distribucion->zona }}</td>
                    </tr>
                    <tr>
                      <th>Rubro/Tamaño/Modo</th>
                      <td>{{ $distribucion->rubro }}
                        @if ($distribucion->tamanio) - {{ $distribucion->tamanio }} @endif
                        @if ($distribucion->modo) - {{ $distribucion->modo }} @endif
                      </td>
                    </tr>
                    <tr>
                      <th>Productos</th>
                      <td>{{ $distribucion->productoCDA ?? 'No disponibles' }}</td>
                    </tr>
                    <tr>
                      <th>Observaciones Recepción</th>
                      <td>{{ $distribucion->obsrecep ?? 'No disponibles' }}</td>
                    </tr>
                    <tr>
                      <th>Cobrar</th>
                      <td>{{ $distribucion->cobrar ?? 'No especificada' }}</td>
                    </tr>
                    <tr>
                      <th>Condición de Pago</th>
                      <td>{{ $distribucion->cobro ?? 'No especificada' }}</td>
                    </tr>
                    <tr>
                      <th>Forma de Pago</th>
                      <td>{{ $distribucion->tpago ?? 'No especificada' }}</td>
                    </tr>
                    <tr>
                      <th>Factura Impresa</th>
                      <td>{{ $distribucion->fac_imp ? 'Sí' : 'No' }}</td>
                    </tr>
                    <tr>
                      <th>Contacto inicial</th>
                      <td>{{ $distribucion->contacto ?? 'Sin contacto' }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-sm table-bordered">
                  <tbody class="text-xs">
                    <tr>
                      <th>Información</th>
                      <td>{{ $distribucion->info ?? 'No especificada' }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- Personal Asociado -->
          <h4>Personal Asociado</h4>
          <div class="table-responsive">
            <table class="table table-sm table-bordered">
              <thead class="text-xs">
                <tr>
                  <th>Nombre</th>
                  <th>Cargo</th>
                  <th>Área</th>
                  <th>Teléfono</th>
                  <th>Email</th>
                  <th></th>
                </tr>
              </thead>
              <tbody class="text-xs">
                @foreach($personal as $persona)
                <tr>
                  <td>{{ $persona->nombre }} {{ $persona->apellido }}</td>
                  <td>{{ $persona->cargo }}</td>
                  <td>{{ $persona->area }}</td>
                  <td>{{ $persona->telcelular }}</td>
                  <td>{{ $persona->email }}</td>
                  <td class=" text-center">edit | borrar</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <!-- Productos Asociados -->
          <h4>Productos Asociados</h4>
          <div class="table-responsive">
            <table class="table table-sm table-bordered">
              <thead class="text-xs">
                <tr>
                  <th>Producto</th>
                  <th class=" text-center">Precio</th>
                  <th class=" text-center">Fecha Última Cotización</th>
                  <th class=" text-center">Fecha Última Entrega</th>
                  <th></th>
                </tr>
              </thead>
              <tbody class="text-xs">
                @foreach($productos as $producto)
                <tr>
                  <td>{{ $producto->nomproducto }}</td>
                  <td class=" text-right">{{ number_format($producto->precio, 2) }}</td>
                  <td class=" text-center">{{ \Carbon\Carbon::parse($producto->fecha)->format('d-m-Y') }}</td>
                  <td class=" text-center">{{ \Carbon\Carbon::parse($producto->fechaUEnt)->format('d-m-Y') }}</td>
                  <td class=" text-center">edit | borrar</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection