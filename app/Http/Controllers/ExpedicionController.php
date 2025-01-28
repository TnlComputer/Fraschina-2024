<?php

namespace App\Http\Controllers;

use App\Models\AuxPagos;
use App\Models\AuxVeraz;
use App\Models\AuxZonas;
use App\Models\AuxCalles;
use App\Models\AuxCobrar;
use App\Models\AuxEstado;
use App\Models\AuxBarrios;
use App\Models\AuxContacto;
use App\Models\AuxTipoPagos;
use Illuminate\Http\Request;
use App\Models\AuxMunicipios;
use App\Models\AuxLocalidades;
use App\Models\Expedicion_molinos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ExpedicionController extends Controller
{
  public function index()
  {
    // $name = trim($request->get('name'));
    // if ($name) {
    // $expediciones =  Expedicion_molinos::paginate(15)->get();
    // }
    return view('pages.Expedicion.index', compact('expediciones'));
    //
  }
}