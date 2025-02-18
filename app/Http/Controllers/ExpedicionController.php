<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpedicionMolino;

class ExpedicionController extends Controller
{
  public function index(Request $request)
  {
    $name = trim($request->get('name'));
    if ($name) {
      $expediciones =  ExpedicionMolino::paginate(15)->get();
    }
    return view('pages.Expedicion.index', compact('expediciones'));
    //
  }
}
