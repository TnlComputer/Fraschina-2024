<?php

namespace App\Http\Controllers;

use App\Models\DistribucionNroPedidos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistribucionRepartoController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $fecha = $request->get('fecha', now()->toDateString());

    // Obtener datos principales sin ordenar por la relación
    $distribuciones = DistribucionNroPedidos::with(['lineasPedidos', 'lineasTareas', 'distribucion'])
      ->where('status', 'A')
      ->whereDate('fechaEntrega', '=', $fecha)
      ->orderBy('orden', 'asc')
      ->orderBy('fechaEntrega', 'desc')
      ->orderBy('id', 'asc')
      ->paginate(20);

    // Ordenar las relaciones 'lineasPedidos' en memoria
    $distribuciones->getCollection()->transform(function ($distribucion) {
      $distribucion->lineasPedidos = $distribucion->lineasPedidos->sortBy('linea');
      return $distribucion;
    });

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
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
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
}
