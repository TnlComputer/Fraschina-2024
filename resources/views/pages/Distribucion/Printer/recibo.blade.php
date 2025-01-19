<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 12px;
      margin: 20px;
    }

    h1 {
      text-align: center;
    }

    .header,
    .footer {
      width: 100%;
      text-align: center;
    }

    .header {
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    table,
    th,
    td {
      border: 1px solid black;
    }

    th,
    td {
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    .total {
      font-weight: bold;
      text-align: right;
    }
  </style>
</head>

<body>
  <div class='header'>
    <h1>Recibo N° 0002-0000{{ $pedido->id }}</h1>
    <p>Fecha: {{ $pedido->fecha }}</p>
  </div>
  <table>
    <thead>
      <tr>
        <th>Fecha</th>
        <th>Factura</th>
        <th>Importe</th>
      </tr>
    </thead>
    <tbody>
      {{-- @foreach ($recibosA as $recibo) --}}
      <tr>
        <td>{{ \Carbon\Carbon::parse($pedido->fechaFactura)->format('d-m-Y') }}</td>
        <td>{{ $pedido->nroFactura }}</td>
        <td>{{ number_format($pedido->totalFactura, 2, ',', '.') }}</td>
      </tr>
      {{-- @endforeach --}}
    </tbody>
  </table>
  <p class=" text-uppercase"> {{ $importeTexto }} </p>
  <div class='footer'>
    <p><strong>Razón Social:</strong> {{ $pedido->razonsocial }}</p>
    <p><strong>Nombre Fantasía:</strong> {{ $pedido->nomfantasia }}</p>
  </div>
</body>

</html>