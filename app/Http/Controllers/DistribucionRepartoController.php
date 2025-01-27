<?php

namespace App\Http\Controllers;

use App\Models\DistribucionNroPedidos;
use App\Models\DistribucionProducto;
use App\Services\EnLetrasService;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use NumberToWords\NumberToWords;

class DistribucionRepartoController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $fecha = $request->get('fecha', now()->toDateString());

    $distribuciones = DistribucionNroPedidos::with([
      'lineasPedidos' => function ($query) {
        $query->where('linea', 1);
      },
      'lineasTareas.tarea',  // Cargar la tarea de distribucion_tareas
      'distribucion'
    ])
      ->where('status', 'A')
      ->whereDate('fechaEntrega', '=', $fecha)
      ->orderBy('orden', 'asc')
      ->orderBy('fechaEntrega', 'desc')
      ->orderBy('id', 'asc')
      ->paginate(20);

    // $distribuciones = DistribucionNroPedidos::with([
    //   'lineasPedidos' => function ($query) {
    //     $query->where('linea', 1);
    //   },
    //   'lineasTareas',
    //   'distribucion'
    // ])
    // ->where('status', 'A')
    // ->whereDate('fechaEntrega', '=', $fecha)
    // ->orderBy('orden', 'asc')
    // ->orderBy('fechaEntrega', 'desc')
    // ->orderBy('id', 'asc')
    // ->paginate(20);

    // Ordenar las relaciones 'lineasPedidos' en memoria
    $distribuciones->getCollection()->transform(function ($distribucion) {
      $distribucion->lineasPedidos = $distribucion->lineasPedidos->sortBy('linea');
      return $distribucion;
    });

    // dd($distribuciones);
    return view('pages.Distribucion.Reparto.index', compact('distribuciones', 'fecha'));
  }




  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show($id)
  {
    // Obtener el pedido con sus relaciones necesarias
    $pedido = DistribucionNroPedidos::with(['lineasPedidos', 'lineasTareas'])->find($id);

    // Verificar si el pedido existe
    if (!$pedido) {
      return redirect()->route('distribucion_reparto.index')->with('error', 'Pedido no encontrado.');
    }

    // dd($pedido);

    // Pasar datos a la vista
    return view('pages.Distribucion.Reparto.pedido', compact('pedido'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  { {
      $pedido = DistribucionNroPedidos::with('lineasPedidos.producto')->findOrFail($id);
      // dd($id, $pedido);
      $productos = DistribucionProducto::with('producto')  // 'producto' es la relación que deberías definir en el modelo DistribucionProducto
        ->where('distribucion_id', $pedido->distribucion_id)
        ->get();

      return view('pages.Distribucion.Pedido.edit', compact('pedido', 'productos'));
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $id)
  {
    // Buscar el recurso (distribución)
    $distribucion = DistribucionNroPedidos::findOrFail($id);
    // dd($distribucion);
    // Actualizar los campos del recurso
    $distribucion->fechaFactura = $request->input('fechaFactura');
    $distribucion->nroFactura = $request->input('nroFactura');
    $distribucion->totalFactura = $request->input('totalFactura');
    $distribucion->chofer = $request->input('chofer');
    $distribucion->orden = $request->input('orden');

    // Guardar los cambios
    $distribucion->save();

    // dd($request->fecha);

    // Redirigir con un mensaje de éxito
    return redirect()->route('distribucion_reparto.index', ['fecha' => $request->fecha])
      ->with('success', 'Distribución actualizada correctamente');
  }


  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }

  public function convertirNumeroALetras($numero, $moneda = 'Pesos')
  {
    // Separamos la parte entera y fraccionaria (centavos)
    $entero = floor($numero);
    $centavos = round(($numero - $entero) * 100);

    // Convertimos la parte entera a letras
    $numberToWords = new NumberToWords();
    $numberTransformer = $numberToWords->getNumberTransformer('es');
    $numeroEnLetras = $numberTransformer->toWords($entero);

    // Si hay centavos, los agregamos a la cadena
    $centavosEnLetras = '';
    if ($centavos > 0) {
      $centavosEnLetras = ' con ' . $numberTransformer->toWords($centavos) . ' centavos';
    }

    // Agregamos la moneda al texto
    return 'La suma de ' . $moneda . ': ' . ucfirst($numeroEnLetras) . $centavosEnLetras;
  }

  public function imprimirRecibo($id)
  {
    // Obtener el pedido principal con datos relacionados
    $pedido = DB::table('distribucion_nropedidon as dn')
      ->join('distribucions as d', 'dn.distribucion_id', '=', 'd.id')
      ->join('auxcalles as ac', 'd.dire_calle_id', '=', 'ac.id')
      ->select(
        'dn.*',
        'd.nomfantasia',
        'd.razonsocial',
        'ac.calle as direccion',
        'd.telefono',
        'dn.totalFactura'
      )
      ->where('dn.id', $id)
      ->first();

    // Verificar si el pedido existe
    if (!$pedido) {
      return response()->json(['error' => 'Pedido no encontrado'], 404);
    }

    // Convertimos el total de la factura a letras
    $importeTexto = $this->convertirNumeroALetras($pedido->totalFactura);

    // Configuración de Dompdf y generación del recibo en PDF
    $options = new Options();
    $options->set('isRemoteEnabled', true);

    $dompdf = new Dompdf($options);
    $html = view('pages.Distribucion.Printer.recibo', ['pedido' => $pedido, 'importeTexto' => $importeTexto])->render();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Descargar el PDF
    return $dompdf->stream('recibo.pdf', ['Attachment' => false]);
  }

  // IMPREMIR REPARTO
  public function imprimirReparto(Request $request)
  {
    // Obtener la fecha de la solicitud o la fecha actual
    $fecha = $request->get('fecha', now()->toDateString());

    // Validar formato de la fecha
    if (!Carbon::createFromFormat('Y-m-d', $fecha)) {
      return redirect()->back()->with('error', 'Fecha inválida');
    }

    // Obtener las distribuciones con todas las líneas de pedido
    $distribuciones = DistribucionNroPedidos::with([
      'lineasPedidos', // Se eliminó el filtro de línea específica
      'lineasTareas.tarea',
      'distribucion'
    ])
      ->where('status', 'A')
      ->whereDate('fechaEntrega', '=', $fecha)
      ->orderBy('orden', 'asc')
      ->orderBy('fechaEntrega', 'desc')
      ->orderBy('id', 'asc')
      ->get();

    // Ordenar la colección de lineasPedidos por la columna 'linea'
    $distribuciones->each(function ($distribucion) {
      $distribucion->lineasPedidos = $distribucion->lineasPedidos->sortBy('linea');
    });

    // dd($distribuciones, $fecha);
    // dd($distribuciones->all());

    try {
      // Configuración de Dompdf
      $options = new Options();
      $options->set('isRemoteEnabled', true);

      $dompdf = new Dompdf($options);
      $html = view('pages.Distribucion.Printer.reparto', ['distribuciones' => $distribuciones, 'fecha'
      => $fecha])->render();
      $dompdf->loadHtml($html);
      $dompdf->setPaper('A4', 'landscape');
      $dompdf->render();

      // Descargar el PDF
      return $dompdf->stream('Reparto-' . $fecha . '.pdf', ['Attachment' => false]);
    } catch (\Exception $e) {
      //   return redirect()->back()->with('error', 'Error al generar el PDF: ' . $e->getMessage());
    }
  }


  public function imprimirControl(Request $request)
  {
    // Obtener la fecha de la solicitud o la fecha actual
    $fecha = $request->get('fecha', now()->toDateString());

    // Validar formato de la fecha
    if (!Carbon::createFromFormat('Y-m-d', $fecha)) {
      return redirect()->back()->with('error', 'Fecha inválida');
    }

    // Obtener las distribuciones con todas las líneas de pedido
    $distribuciones = DistribucionNroPedidos::with([
      'lineasPedidos', // Se eliminó el filtro de línea específica
      'distribucion'
    ])
      ->where('status', 'A')
      ->where('tipo', 'P')
      ->whereDate('fechaEntrega', '=', $fecha)
      ->orderBy('orden', 'asc')
      ->orderBy('fechaEntrega', 'desc')
      ->orderBy('id', 'asc')
      ->get();

    // Ordenar la colección de lineasPedidos por la columna 'linea'
    // $distribuciones->each(function ($distribucion) {
    //   $distribucion->lineasPedidos = $distribucion->lineasPedidos->sortBy('linea');
    // });

    // dd($distribuciones, $fecha);
    //  dd($distribuciones->all());

    try {
      // Configuración de Dompdf
      $options = new Options();
      $options->set('isRemoteEnabled', true);

      $dompdf = new Dompdf($options);
      $html = view('pages.Distribucion.Printer.control', ['distribuciones' => $distribuciones, 'fecha'
      => $fecha])->render();
      $dompdf->loadHtml($html);
      $dompdf->setPaper('A4', 'portrait');
      $dompdf->render();
      $canvas = $dompdf->getCanvas();
      $canvas->page_script(function ($pageNumber, $pageCount, $canvas) {
        $canvas->text(500, 820, "Página $pageNumber de $pageCount", null, 10, array(0, 0, 0));
      });

      // Descargar el PDF
      return $dompdf->stream('Control-' . $fecha . '.pdf', ['Attachment' => false]);
    } catch (\Exception $e) {
      //   return redirect()->back()->with('error', 'Error al generar el PDF: ' . $e->getMessage());
    }
  }
}
