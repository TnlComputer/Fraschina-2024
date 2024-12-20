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
        'r.marcas',
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
    $barrios = AuxBarrios::all();
    $localidades = AuxLocalidades::all();
    $municipios = AuxMunicipios::all();
    $zonas = AuxZonas::all();
    // dd($municipios);
    return view('Pages.Representacion.create', ['barrios' => $barrios, 'localidades' => $localidades, 'municipios' => $municipios, 'zonas' => $zonas]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'razonsocial' => 'nullable|string|max:50',
      'dire_calle' => 'nullable|string|max:50',
      'dire_nro' => 'nullable|string|max:30',
      'piso' => 'nullable|string|max:4',
      'codpost' => 'nullable|string|max:30',
      'dire_obs' => 'nullable|string|max:100',
      'barrio_id' => 'required|exists:barrios,id',
      'localidad_id' => 'required|exists:localidades,id',
      'zona_id' => 'required|exists:zonas,id',
      'municipio_id' => 'nullable|exists:municipios,id',
      'telefono' => 'nullable|string|max:200',
      'fax' => 'nullable|string|max:50',
      'cuit' => 'nullable|string|max:50',
      'excenciones' => 'nullable|string|max:50',
      'marcas' => 'nullable|string|max:200',
      'info' => 'nullable|string',
      'contacto' => 'nullable|string|max:50',
      'horario' => 'nullable|string|max:50',
      'objetivos' => 'nullable|string',
      'comentarios' => 'nullable|string',
      'correo' => 'nullable|string',
      'dpto' => 'nullable|string|max:4',
      'status' => 'nullable|string|max:1',
    ]);

    $representacion = new Representacion();
    $representacion->razonsocial = $validated['razonsocial'];
    $representacion->dire_calle = $validated['dire_calle'];
    $representacion->dire_nro = $validated['dire_nro'];
    $representacion->piso = $validated['piso'];
    $representacion->codpost = $validated['codpost'];
    $representacion->dire_obs = $validated['dire_obs'];
    $representacion->barrio_id = $validated['barrio_id'];
    $representacion->localidad_id = $validated['localidad_id'];
    $representacion->zona_id = $validated['zona_id'];
    $representacion->municipio_id = $validated['municipio_id'];
    $representacion->telefono = $validated['telefono'];
    $representacion->fax = $validated['fax'];
    $representacion->cuit = $validated['cuit'];
    $representacion->excenciones = $validated['excenciones'];
    $representacion->marcas = $validated['marcas'];
    $representacion->info = $validated['info'];
    $representacion->contacto = $validated['contacto'];
    $representacion->horario = $validated['horario'];
    $representacion->objetivos = $validated['objetivos'];
    $representacion->comentarios = $validated['comentarios'];
    $representacion->correo = $validated['correo'];
    $representacion->dpto = $validated['dpto'];
    $representacion->status = $validated['status'];

    $representacion->save();

    return redirect()->route('representacion.index')->with('success', 'Representación creada exitosamente');
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
  /**
   * Mostrar la vista de edición de una representación.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $representacion = Representacion::findOrFail($id);
    $barrios = AuxBarrios::all(); // Asegúrate de tener estos datos disponibles
    $localidades = AuxLocalidades::all();
    $municipios = AuxMunicipios::all();
    $zonas = AuxZonas::all();

    return view('Pages.Representacion.edit', compact('representacion', 'barrios', 'localidades', 'municipios', 'zonas'));
  }

  /**
   * Actualizar una representación en la base de datos.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $request->validate([
      'razonsocial' => 'required|string|max:255',
      'dire_calle' => 'required|string|max:255',
      'dire_nro' => 'required|integer',
      'telefono' => 'required|string|max:150',
      'correo' => 'required|email|max:255',
      'barrio_id' => 'nullable|integer|exists:AuxBarrios,id',
      'localidad_id' => 'required|integer|exists:AuxLocalidades,id',
      'municipio_id' => 'nullable|integer|exists:AuxMunicipios,id',
      'zona_id' => 'nullable|integer|exists:AuxZonas,id',
      'cuit' => 'nullable|string|max:20',
      'marcas' => 'nullable|string|max:255',
      'info' => 'nullable|string|max:500',
    ]);

    $representacion = Representacion::findOrFail($id);

    $representacion->update([
      'razonsocial' => $request->razonsocial,
      'dire_calle' => $request->dire_calle,
      'dire_nro' => $request->dire_nro,
      'piso' => $request->piso,
      'dpto' => $request->dpto,
      'codpost' => $request->codpost,
      'telefono' => $request->telefono,
      'barrio_id' => $request->barrio_id,
      'localidad_id' => $request->localidad_id,
      'municipio_id' => $request->municipio_id,
      'zona_id' => $request->zona_id,
      'cuit' => $request->cuit,
      'correo' => $request->correo,
      'marcas' => $request->marcas,
      'info' => $request->info,
    ]);

    return redirect()->route('representacion.index')
      ->with('success', 'Representación actualizada correctamente.');
  }


  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
