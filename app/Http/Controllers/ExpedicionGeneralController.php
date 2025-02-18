<?php

namespace App\Http\Controllers;

use App\Models\ExpedicionGeneral;
use Illuminate\Http\Request;

class ExpedicionGeneralController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $name = $request->name;
    $expedicion_general = ExpedicionGeneral::orderBy('fecha', 'DESC')->paginate(20);
    // dd($expedicion_general->all());
    return view('pages.Expedicion.General.index', compact('expedicion_general', 'name'));
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
  public function show(ExpedicionGeneral $expedicionGeneral)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(ExpedicionGeneral $expedicionGeneral)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, ExpedicionGeneral $expedicionGeneral)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(ExpedicionGeneral $expedicionGeneral)
  {
    //
  }
}
