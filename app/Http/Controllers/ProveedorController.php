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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProveedorController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $name = trim($request->get('name'));
    if ($name) {
      $proveedores = DB::table('proveedores as resp')
        ->join('AuxBarrios as auxb', 'resp.barrio_id', '=', 'auxb.id')
        ->join('AuxLocalidades as auxLoc', 'resp.localidad_id', '=', 'auxLoc.id')
        ->join('AuxMunicipios as auxMun', 'resp.municipio_id', '=', 'auxMun.id')
        ->select('auxb.nombrebarrio as barrio', 'auxLoc.localidad as localidad', 'auxMun.ciudadmunicipio as municipio', 'resp.razonsocial', 'resp.dire_calle', 'resp.dire_nro', 'resp.piso', 'resp.codpost', 'resp.dire_obs', 'resp.telefono', 'resp.fax', 'resp.cuit', 'resp.correo', 'resp.dpto', 'resp.marcas', 'resp.info', 'resp.id', 'resp.correo')
        ->where('status', '=', 'A')
        ->orWhere('razonsocial', 'like', '%' . $request->name . '%')
        // ->orWhere('marcas', 'like', '%' . $request->name . '%')
        ->paginate(15);
    } else {
      $proveedores = DB::table('proveedores as resp')
        ->join('AuxBarrios as auxb', 'resp.barrio_id', '=', 'auxb.id')
        ->join('AuxLocalidades as auxLoc', 'resp.localidad_id', '=', 'auxLoc.id')
        ->join('AuxMunicipios as auxMun', 'resp.municipio_id', '=', 'auxMun.id')
        ->select('auxb.nombrebarrio as barrio', 'auxLoc.localidad as localidad', 'auxMun.ciudadmunicipio as municipio', 'resp.razonsocial', 'resp.dire_calle', 'resp.dire_nro', 'resp.piso', 'resp.codpost', 'resp.dire_obs', 'resp.telefono', 'resp.fax', 'resp.cuit', 'resp.correo', 'resp.dpto', 'resp.marcas', 'resp.info', 'resp.id', 'resp.correo')
        ->where('status', '=', 'A')
        ->paginate(15);
    }
    return view('Pages.Proveedor.index', compact('proveedores', 'name'));
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