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

    // Recupera distribuciones con las relaciones usando pedido_id
    $distribuciones = DistribucionNroPedidos::with(['lineasPedidos', 'lineasTareas', 'distribucion'])
      ->where('status', 'A')
      ->whereDate('fechaEntrega', '=', $fecha)
      ->orderBy('fechaEntrega', 'desc')
      ->paginate(10);

    // dd($distribuciones, $fecha);

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
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
