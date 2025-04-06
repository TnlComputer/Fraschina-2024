<?php

namespace App\Http\Controllers;

use App\Models\ExpedicionCliente;
use App\Models\Fichas;
use Illuminate\Http\Request;

class ExpedicionClienteController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  // public function index(Request $request)
  // {
  //   $name = $request->name;
  //   $expedicion_clientes = Fichas::orderBy('id', 'DESC',)->paginate(20);
  //   // $expedicion_clientes = Fichas::orderBy('origen_tabla', 'DESC',)->orderBy('fe', 'DESC',)->paginate(20);
  //   // $expedicion_clientes = ExpedicionCliente::all();

  //   // dd($expedicion_clientes);

  //   return view('pages.Expedicion.Cliente.index', compact('expedicion_clientes', 'name'));
  // }

  public function index(Request $request)
  {
    $clientes = Fichas::select('origen_tabla')->distinct()->orderBy('origen_tabla', 'ASC')->get();

    $query = Fichas::query();

    if ($request->has('origen_tabla') && !empty($request->origen_tabla)) {
      $query->where('origen_tabla', $request->origen_tabla);
    }

    // Obtener los últimos 15 registros paginados
    $expedicion_clientes = $query->orderBy('id', 'DESC')->paginate(15);

    // Reordenar los resultados dentro de la página en orden ASC
    $expedicion_clientes->setCollection($expedicion_clientes->getCollection()->sortBy('id'));

    return view('pages.Expedicion.Cliente.index', compact('expedicion_clientes', 'clientes'));
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
    $request->validate([
      'p' => 'numeric|min:20|max:200',
      'l' => 'numeric|min:10|max:300',
      'pl' => 'numeric|min:0.15|max:7.00',
      'w' => 'numeric|min:42|max:600',
      'gh' => 'numeric|min:0|max:45',
      'gs' => 'numeric|min:0|max:20',
      'gi' => 'numeric|min:0|max:100',
      'hum' => 'numeric|min:8.00|max:17.00',
      'cz' => 'numeric|min:0.250|max:1.200',
      'est' => 'numeric|min:0|max:30',
      'abs' => 'numeric|min:40.00|max:70.00',
      'fn' => 'numeric|min:62|max:600',
      'punt' => 'numeric|min:0|max:100',
    ]);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
