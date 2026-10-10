<?php

namespace App\Http\Controllers;

class ExpedicionController extends Controller
{
  /**
   * Entrada de Expedición. Hasta tener el tablero de la Central de Pedidos,
   * lleva a Expedición General.
   */
  public function index()
  {
    return redirect()->route('expedicion_general.index');
  }
}
