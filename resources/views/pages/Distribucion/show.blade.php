@extends('adminlte::page')

@section('title', 'Detalle de Distribución')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
  <h1>Detalle de Distribución</h1>
  <a href="{{ route('distribucion.index') }}" class="btn btn-secondary btn-sm">Volver</a>
</div>
@endsection
@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-body">
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
              <td class="d-flex justify-content-center">
                @can('permiso_12')
                <a href="{{ route('distribucion_personal.edit', $persona->id) }}" class="btn-xs btn-warning mx-1"
                  title="Editar">
                  <i class="fa-solid fa-pen-to-square fa-sm"></i>
                </a>
                @endcan
                @can('permiso_13')
                <form method="POST" action="{{ route('distribucion_personal.destroy', $persona->id) }}"
                  onsubmit="return confirm('¿Estás seguro de eliminar este registro?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn-2xs btn-danger mx-1" title="Eliminar">
                    <i class="fa-solid fa-trash fa-xs"></i>
                  </button>
                </form>
                @endcan
              </td>
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
              <td class="d-flex justify-content-center">
                @can('permiso_12')
                <a href="{{ route('distribucion_producto.edit', $persona->id) }}" class="btn-xs btn-warning mx-1"
                  title="Editar">
                  <i class="fa-solid fa-pen-to-square fa-sm"></i>
                </a>
                @endcan
                @can('permiso_13')
                <form method="POST" action="{{ route('distribucion_producto.destroy', $persona->id) }}"
                  onsubmit="return confirm('¿Estás seguro de eliminar este registro?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn-2xs btn-danger mx-1" title="Eliminar">
                    <i class="fa-solid fa-trash fa-xs"></i>
                  </button>
                </form>
                @endcan
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection


{{-- @extends('adminlte::page')

@section('title', 'Detalle de Distribución')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
  <h1>Detalle de Distribución</h1>
  <a href="{{ route('distribucion.index') }}" class="btn btn-secondary btn-sm">Volver</a>
</div>
@endsection

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="row mb-2">
            <div class="col-4 font-weight-bold">Nro. GS</div>
            <div class="col-8">
              @if ($distribucion->clisg_id > 0)
              {{ $distribucion->clisg_id }}
              @else
              No disponible
              @endif
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-4 font-weight-bold">Nombre Fantasía</div>
            <div class="col-8">{{ $distribucion->nomfantasia }}</div>
          </div>
          <div class="row mb-2">
            <div class="col-4 font-weight-bold">Razón Social</div>
            <div class="col-8">{{ $distribucion->razonsocial }}</div>
          </div>
          <div class="row mb-2">
            <div class="col-4 font-weight-bold">Teléfono</div>
            <div class="col-8">{{ $distribucion->telefono }}</div>
          </div>
          <div class="row mb-2">
            <div class="col-4 font-weight-bold">Email</div>
            <div class="col-8">{{ $distribucion->correo }}</div>
          </div>
          <div class="row mb-2">
            <div class="col-4 font-weight-bold">CUIT/DNI</div>
            <div class="col-8">{{ $distribucion->cuit }}</div>
          </div>
          <div class="row mb-2">
            <div class="col-4 font-weight-bold">Estado</div>
            <div class="col-8">{{ $distribucion->estado }}</div>
          </div>
          <div class="row mb-2">
            <div class="col-4 font-weight-bold">Veraz</div>
            <div class="col-8">{{ $distribucion->veraz ?? 'No disponible' }}</div>
          </div>
          <div class="row mb-2">
            <div class="col-4 font-weight-bold">Recibe x la mañana</div>
            <div class="col-8">{{ $distribucion->desde }} {{ $distribucion->hasta }}</div>
          </div>
          <div class="row mb-2">
            <div class="col-4 font-weight-bold">Recibe x la tarde</div>
            <div class="col-8">{{ $distribucion->desde1 }} {{ $distribucion->hasta1 }}</div>
          </div>
          <div class="row mb-2">
            <div class="col-4 font-weight-bold">Lunes Cerrado</div>
            <div class="col-8">{{ $distribucion->lunes ? 'Sí' : 'No' }}</div>
          </div>
          <div class="row mb-2">
            <div class="col-4 font-weight-bold">Sábado Recibe</div>
            <div class="col-8">{{ $distribucion->sabado ? 'Sí' : 'No' }}</div>
          </div>
          <div class="row mb-2">
            <div class="col-4 font-weight-bold">Marcas</div>
            <div class="col-8">{{ $distribucion->Marcas ?? 'No especificada' }}</div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row mb-2">
            <div class="col-4 font-weight-bold">Dirección</div>
            <div class="col-8">{{ $distribucion->dire_calle }} {{ $distribucion->dire_nro }}</div>
          </div>
          <div class="row mb-2">
            <div class="col-4 font-weight-bold">Barrio</div>
            <div class="col-8">{{ $distribucion->barrio }}</div>
          </div>
          <div class="row mb-2">
            <div class="col-4 font-weight-bold">Ciudad/Municipio</div>
            <div class="col-8">{{ $distribucion->municipio }}</div>
          </div>
          <div class="row mb-2">
            <div class="col-4 font-weight-bold">Localidad/Provincia</div>
            <div class="col-8">{{ $distribucion->localidad }}</div>
          </div>
          <div class="row mb-2">
            <div class="col-4 font-weight-bold">Zona</div>
            <div class="col-8">{{ $distribucion->zona }}</div>
          </div>
          <div class="row mb-2">
            <div class="col-4 font-weight-bold">Rubro/Tamaño/Modo</div>
            <div class="col-8">{{ $distribucion->rubro }}
              @if ($distribucion->tamanio) - {{ $distribucion->tamanio }} @endif
              @if ($distribucion->modo) - {{ $distribucion->modo }} @endif
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-4 font-weight-bold">Productos</div>
            <div class="col-8">{{ $distribucion->productoCDA ?? 'No disponibles' }}</div>
          </div>
          <div class="row mb-2">
            <div class="col-4 font-weight-bold">Observaciones Recepción</div>
            <div class="col-8">{{ $distribucion->obsrecep ?? 'No disponibles' }}</div>
          </div>
          <div class="row mb-2">
            <div class="col-4 font-weight-bold">Cobrar</div>
            <div class="col-8">{{ $distribucion->cobrar ?? 'No especificada' }}</div>
          </div>
          <div class="row mb-2">
            <div class="col-4 font-weight-bold">Condición de Pago</div>
            <div class="col-8">{{ $distribucion->cobro ?? 'No especificada' }}</div>
          </div>
          <div class="row mb-2">
            <div class="col-4 font-weight-bold">Forma de Pago</div>
            <div class="col-8">{{ $distribucion->tpago ?? 'No especificada' }}</div>
          </div>
          <div class="row mb-2">
            <div class="col-4 font-weight-bold">Factura Impresa</div>
            <div class="col-8">{{ $distribucion->fac_imp ? 'Sí' : 'No' }}</div>
          </div>
          <div class="row mb-2">
            <div class="col-4 font-weight-bold">Contacto inicial</div>
            <div class="col-8">{{ $distribucion->contacto ?? 'Sin contacto' }}</div>
          </div>
        </div>

        <!-- Información Adicional -->
        <div class="col-md-12">
          <div class="row mb-2">
            <div class="col-4 font-weight-bold">Información</div>
            <div class="col-8">{{ $distribucion->info ?? 'No especificada' }}</div>
          </div>
        </div>
      </div>

      <!-- Personal Asociado -->
      <h4>Personal Asociado</h4>
      <div class="row mb-2">
        @foreach($personal as $persona)
        <div class="col-12">
          <div class="row mb-1">
            <div class="col-3">{{ $persona->nombre }} {{ $persona->apellido }}</div>
            <div class="col-2">{{ $persona->cargo }}</div>
            <div class="col-2">{{ $persona->area }}</div>
            <div class="col-2">{{ $persona->telcelular }}</div>
            <div class="col-2">{{ $persona->email }}</div>
            <div class="col-1 d-flex justify-content-center">
              @can('permiso_12')
              <a href="{{ route('distribucion_personal.edit', $persona->id) }}" class="btn-xs btn-warning mx-1"
                title="Editar">
                <i class="fa-solid fa-pen-to-square fa-sm"></i>
              </a>
              @endcan
              @can('permiso_13')
              <form method="POST" action="{{ route('distribucion_personal.destroy', $persona->id) }}"
                onsubmit="return confirm('¿Estás seguro de eliminar este registro?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-2xs btn-danger mx-1" title="Eliminar">
                  <i class="fa-solid fa-trash fa-xs"></i>
                </button>
              </form>
              @endcan
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <!-- Productos Asociados -->
      <h4>Productos Asociados</h4>
      <div class="row mb-2">
        @foreach($productos as $producto)
        <div class="col-12">
          <div class="row mb-1">
            <div class="col-4">{{ $producto->nomproducto }}</div>
            <div class="col-2 text-right">{{ number_format($producto->precio, 2) }}</div>
            <div class="col-2 text-center">{{ \Carbon\Carbon::parse($producto->fecha)->format('d-m-Y') }}</div>
            <div class="col-2 text-center">{{ \Carbon\Carbon::parse($producto->fechaUEnt)->format('d-m-Y') }}</div>
            <div class="col-2 d-flex justify-content-center">
              @can('permiso_12')
              <a href="{{ route('distribucion_producto.edit', $persona->id) }}" class="btn-xs btn-warning mx-1"
                title="Editar">
                <i class="fa-solid fa-pen-to-square fa-sm"></i>
              </a>
              @endcan
              @can('permiso_13')
              <form method="POST" action="{{ route('distribucion_producto.destroy', $persona->id) }}"
                onsubmit="return confirm('¿Estás seguro de eliminar este registro?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-2xs btn-danger mx-1" title="Eliminar">
                  <i class="fa-solid fa-trash fa-xs"></i>
                </button>
              </form>
              @endcan
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection --}}