<?php
require __DIR__ . '/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Configurar opciones de DOMPDF
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

// Variables dinámicas (debes asignarlas según tu lógica)
$nroPedTotalA = "12345";
$fecEnTotalA = "2025-01-15";
$recibosA = [
    [
        'fecEn' => "2025-01-15",
        'idCliLP' => 1,
        'impA' => 1500.75,
        'fecFac' => "2025-01-10",
        'nroFac' => "000123",
        'nroPed' => "0002-1234",
        'NomFantasia' => "Cliente Fantasía",
        'RazonSocial' => "Razón Social Cliente"
    ]
];

// Formatear fecha
$fecRecAm = explode("-", $fecEnTotalA, 3);
$fecRecAM = $fecRecAm[2] . "-" . $fecRecAm[1] . "-" . $fecRecAm[0];

// Crear HTML para el PDF
$html = "
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; }
        h1 { text-align: center; }
        .header, .footer { width: 100%; text-align: center; }
        .header { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total { font-weight: bold; text-align: right; }
    </style>
</head>
<body>
    <div class='header'>
        <h1>Recibo N° {$nroPedTotalA}</h1>
        <p>Fecha: {$fecRecAM}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Factura</th>
                <th>Importe</th>
            </tr>
        </thead>
        <tbody>";

// Agregar filas dinámicas
foreach ($recibosA as $recibo) {
    $fecFacFormatted = date("d-m-Y", strtotime($recibo['fecFac']));
    $html .= "
            <tr>
                <td>{$fecFacFormatted}</td>
                <td>{$recibo['nroFac']}</td>
                <td>" . number_format($recibo['impA'], 2, ',', '.') . "</td>
            </tr>";
}

$html .= "
        </tbody>
    </table>
    <div class='footer'>
        <p><strong>Razón Social:</strong> {$recibosA[0]['RazonSocial']}</p>
        <p><strong>Nombre Fantasía:</strong> {$recibosA[0]['NomFantasia']}</p>
    </div>
</body>
</html>";

// Renderizar PDF con DOMPDF
$dompdf->loadHtml($html);

// Opciones de papel y orientación
$dompdf->setPaper('A4', 'portrait');

// Generar PDF
$dompdf->render();

// Descargar PDF
$dompdf->stream("Recibo_{$nroPedTotalA}.pdf", ["Attachment" => true]);
?>

{{--
<!DOCTYPE html>
<html>

<head>
  <title>Mi PDF</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .titulo {
      text-align: center;
      font-size: 24px;
    }
  </style>
</head>

<body>
  <h1 class="titulo">Este es mi archivo PDF</h1>
  <p>Contenido dinámico: {{ $data }}</p>
</body>

</html> --}}