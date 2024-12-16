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
use App\Models\Distribucion;
use Illuminate\Http\Request;
use App\Models\AuxMunicipios;
use App\Models\AuxLocalidades;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class DistribucionController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $name = trim($request->get('name'));

    // Construir la consulta base
    $query = DB::table('distribucions as d')
      ->join('AuxCalles as auxCalle', 'd.dire_calle_id', '=', 'auxCalle.id')
      ->join('AuxBarrios as auxB', 'd.barrio_id', '=', 'auxB.id')
      ->join('AuxLocalidades as auxLoc', 'd.localidad_id', '=', 'auxLoc.id')
      ->join('AuxMunicipios as auxMun', 'd.municipio_id', '=', 'auxMun.id')
      ->join('AuxZonas as auxZon', 'd.zona_id', '=', 'auxZon.id')
      ->select(
        'd.clisg_id',
        'd.razonsocial',
        'd.nomfantasia',
        'd.dire_nro',
        'd.piso',
        'd.codpost',
        'd.dire_obs',
        'd.telefono',
        'd.fax',
        'd.cuit',
        'd.correo',
        'd.dpto',
        'd.marcas',
        'd.info',
        'd.id',
        'd.correo',
        'auxCalle.calle as dire_calle',
        'auxB.nombrebarrio as barrio',
        'auxLoc.localidad as localidad',
        'auxMun.ciudadmunicipio as municipio',
        'auxZon.nombre as zona',
      )
      ->where('d.status', '=', 'A'); // Siempre filtrar por el estado 'A'

    // Si se pasa un nombre, agregar las condiciones de búsqueda
    if ($name) {
      $query->where(function ($subQuery) use ($name) {
        $subQuery->where('nomfantasia', 'like', '%' . $name . '%')
          ->orWhere('razonsocial', 'like', '%' . $name . '%')
          ->orWhere('clisg_id', 'like', '%' . $name . '%');
      });
    }

    // Ejecutar la consulta con paginación
    $distribuciones = $query->paginate(15);
    // dd($distribuciones);
    // Retornar la vista con los resultados
    return view('Pages.Distribucion.index', compact('distribuciones', 'name'));
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