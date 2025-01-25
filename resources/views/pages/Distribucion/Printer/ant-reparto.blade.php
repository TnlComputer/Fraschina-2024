<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Planilla de Reparto</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 8pt;
      color: #000;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    th,
    td {
      padding: 5px;
      border: 1px solid #ddd;
      text-align: left;
    }

    th {
      background-color: #eaeaea;
      font-weight: bold;
    }

    .text-center {
      text-align: center;
    }

    .bold {
      font-weight: bold;
    }
  </style>
</head>

<body>
  <div class="header">
    <h1>Planilla de Reparto</h1>
    <p><strong>Fecha de entrega:</strong> {{ now()->toDateString() }}</p>
  </div>

  @php
  $totalPorChofer = [];
  $totalPorProducto = [];
  @endphp

  @foreach ($distribuciones as $distribucion)
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Fecha</th>
        <th>Chofer</th>
        <th>Orden</th>
        <th>Pedido</th>
        <th>Línea</th>
        <th>Nombre Fantasía</th>
        <th>Razón Social</th>
        <th>Dirección</th>
        <th>Barrio</th>
        <th>Municipio</th>
        <th>Localidad</th>
        <th>Zona</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{ $distribucion->fechaEntrega }}</td>
        <td>{{ $distribucion->chofer }}</td>
        <td>{{ $distribucion->orden }}</td>
        <td>{{ $distribucion->id }}</td>
        <td>{{ $distribucion->lineasPedidos->first()->linea ?? '-' }}</td>
        <td>{{ $distribucion->distribucion->nomfantasia }}</td>
        <td>{{ $distribucion->distribucion->razonsocial }}</td>
        <td>{{ $distribucion->distribucion->auxCalles->calle ?? '' }} {{ $distribucion->distribucion->dire_nro }}</td>
        <td>{{ $distribucion->distribucion->auxbarrio->nombrebarrio ?? '' }}</td>
        <td>{{ $distribucion->distribucion->auxmunicipio->ciudadmunicipio ?? '' }}</td>
        <td>{{ $distribucion->distribucion->auxlocalidad->localidad ?? '' }}</td>
        <td>{{ $distribucion->distribucion->auxzona->nombre ?? '' }}</td>
      </tr>
    </tbody>
  </table>

  <table class="table table-sm table-striped">
    <tr>
      <th>Cobrar</th>
      <th>Cond. Pago</th>
      <th>Forma Pago</th>
      <th>Horario Mañana</th>
      <th>Horario Tarde</th>
      <th>Sábado Recibe</th>
      <th>Importe Factura</th>
      <th>Factura</th>
    </tr>
    <tr>
      <td>{{ $distribucion->distribucion->auxcobro->accion ?? '' }}</td>
      <td>{{ $distribucion->distribucion->auxpago->nombre ?? '' }}</td>
      <td>{{ $distribucion->distribucion->auxtcobro->nombre ?? '' }}</td>
      <td>{{ \Carbon\Carbon::parse($distribucion->distribucion->desde)->format('H:i') ?? '' }} -
        {{ \Carbon\Carbon::parse($distribucion->distribucion->hasta)->format('H:i') ?? '' }}</td>
      @if (empty($distribucion->distribucion->desde1) || $distribucion->distribucion->desde1 == '00:00:00')
      <td> </td>
      @else
      <td>
        {{ \Carbon\Carbon::createFromFormat('H:i:s', $distribucion->distribucion->desde1)->format('H:i') ?? '' }} -
        {{ \Carbon\Carbon::createFromFormat('H:i:s', $distribucion->distribucion->hasta1)->format('H:i') ?? '' }}
      </td>
      @endif
      <td>{{ $distribucion->distribucion->sabado ? 'Sí' : 'No' }}</td>
      <td>${{ number_format($distribucion->totalFactura, 2) }}</td>
      <td><strong>{{ $distribucion->distribucion->fac_imp ? 'IMPRIMIR' : '' }}</strong></td>
    </tr>
    <tr>
      <td><strong>Observaciones</strong></td>
      <td colspan="7">{{ $distribucion->distribucion->obsrecep ?? 'Sin observaciones' }}</td>
    </tr>
  </table>

  {{-- <h3>Productos de la Distribución:</h3> --}}
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Precio Unitario</th>
        <th style="width: 70%"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($distribucion->lineasPedidos as $linea)
      <tr>
        <td>{{ $linea->producto->productoCDA }}</td>
        <td>{{ $linea->cantidad }}</td>
        <td>${{ number_format($linea->precio_unitario, 2) }}</td>
      </tr>
      @php
      $totalPorChofer[$distribucion->chofer] = ($totalPorChofer[$distribucion->chofer] ?? 0) + $linea->cantidad;
      $totalPorProducto[$linea->producto->productoCDA] = ($totalPorProducto[$linea->producto->productoCDA] ?? 0) +
      $linea->cantidad;
      @endphp
      @endforeach
    </tbody>
  </table>

  <hr>
  @endforeach

  <h3>Total por Chofer:</h3>
  <table class="table">
    <thead>
      <tr>
        <th>Chofer</th>
        <th>Total Cantidad</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($totalPorChofer as $chofer => $totalCantidad)
      <tr>
        <td>{{ $chofer }}</td>
        <td>{{ $totalCantidad }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <h3>Total por Producto:</h3>
  <table class="table">
    <thead>
      <tr>
        <th>Producto</th>
        <th>Total Cantidad</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($totalPorProducto as $producto => $totalCantidad)
      <tr>
        <td>{{ $producto }}</td>
        <td>{{ $totalCantidad }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="footer text-center">
    <p>Reporte generado automáticamente por el sistema.</p>
  </div>
</body>

</html>