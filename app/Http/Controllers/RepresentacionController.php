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
use App\Models\Representacion;
use Illuminate\Http\Request;
use App\Models\AuxMunicipios;
use App\Models\AuxLocalidades;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RepresentacionController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $name = trim($request->get('name'));
    $query = DB::table('representacions as r')
      ->join('AuxBarrios as auxb', 'r.barrio_id', '=', 'auxb.id')
      ->join('AuxLocalidades as auxLoc', 'r.localidad_id', '=', 'auxLoc.id')
      ->join('AuxMunicipios as auxMun', 'r.municipio_id', '=', 'auxMun.id')
      ->join('AuxZonas as auxZon', 'r.zona_id', '=', 'auxZon.id')
      ->select(
        'auxb.nombrebarrio as barrio',
        'auxLoc.localidad as localidad',
        'auxMun.ciudadmunicipio as municipio',
        'auxZon.nombre as zona',
        'r.razonsocial',
        'r.dire_calle',
        'r.dire_nro',
        'r.piso',
        'r.codpost',
        'r.dire_obs',
        'r.telefono',
        'r.fax',
        'r.cuit',
        'r.correo',
        'r.dpto',
        'r.infoenparticular as marcas',
        'r.info',
        'r.id'
      );

    if ($name) {
      $query->where(function ($q) use ($name) {
        $q->where('r.razonsocial', 'like', '%' . $name . '%')
          ->orWhere('r.marcas', 'like', '%' . $name . '%');
      });
    } else {
      $query->where('r.status', '=', 'A');
    }

    $representaciones = $query->paginate(15);

    // Traer datos adicionales para los filtros
    $barrios = AuxBarrios::all();
    $localidades = AuxLocalidades::all();
    $municipios = AuxMunicipios::all();
    $zonas = AuxZonas::all();

    return view('Pages.Representacion.index', [
      'representaciones' => $representaciones,
      'barrios' => $barrios,
      'localidades' => $localidades,
      'municipios' => $municipios,
      'zonas' => $zonas,
      'name' => $name,
      'paso' => $name ? 'Buscando' : 'NO'
    ]);
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