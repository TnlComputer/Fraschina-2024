<?php

namespace App\Http\Controllers;

use App\Models\Expedicion_molinos;
use Illuminate\Http\Request;

class ExpedicionMolinosController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $name = $request->name;
    $expedicion_molinos = Expedicion_molinos::all();
    // dd($expedicion_molinos);
    return view('pages.Expedicion.Molino.index', compact('expedicion_molinos', 'name'));
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
  public function show(Expedicion_molinos $expedicion_molinos)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Expedicion_molinos $expedicion_molinos)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Expedicion_molinos $expedicion_molinos)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Expedicion_molinos $expedicion_molinos)
  {
    //
  }
}