<?php

namespace App\Http\Controllers;

use App\Models\DistribucionAgenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistribucionAgendaController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  // public function index(Request $request)
  // {
  //   // Obtener el término de búsqueda, si existe
  //   $search = $request->get('search');

  //   // Construir la consulta base
  //   $distribuciones = DB::table('distribucion_agenda as disag')
  //     ->join('AuxBarrios as auxb', 'disag.barrio_id', '=', 'auxb.id')
  //     ->join('AuxLocalidades as auxLoc', 'disag.localidad_id', '=', 'auxLoc.id')
  //     ->join('AuxMunicipios as auxMun', 'disag.municipio_id', '=', 'auxMun.id')
  //     ->join('AuxEstados as auxEst', 'disag.estado_id', '=', 'auxEst.id')
  //     ->select(
  //       'disag.*',
  //       'auxb.nombrebarrio as barrio',
  //       'auxLoc.localidad as localidad',
  //       'auxMun.ciudadmunicipio as municipio',
  //       'auxEst.nomEstado as estado',
  //     )
  //     ->where('disag.status', 'A'); // Solo registros activos

  //   // Aplicar el filtro de búsqueda
  //   if ($search) {
  //     $distribuciones->where(function ($query) use ($search) {
  //       $query->where('disag.razonsocial', 'like', '%' . $search . '%')
  //         ->orWhere('disag.productos', 'like', '%' . $search . '%')
  //         ->orWhere('disag.accion', 'like', '%' . $search . '%')
  //         ->orWhere('auxb.nombrebarrio', 'like', '%' . $search . '%')
  //         ->orWhere('auxLoc.localidad', 'like', '%' . $search . '%')
  //         ->orWhere('auxMun.ciudadmunicipio', 'like', '%' . $search . '%');
  //     });
  //   }

  //   // Ordenar por fecha descendente y paginar los resultados
  //   $distribuciones = $distribuciones->orderBy('disag.fecha', 'desc')->paginate(12);

  //   // Retornar los datos a la vista
  //   return view('pages.Distribucion.Agenda.index', compact('distribuciones', 'search'));
  // }

  /**
   * Muestra un listado de todos los registros de distribucion_agenda.
   */
  public function index(Request $request)
  {
    // Obtener el término de búsqueda desde la solicitud (si existe)
    $search = $request->input('search');

    // Consulta los registros con las relaciones necesarias, ordenados por fecha descendente
    $agendas = DistribucionAgenda::with([
      'auxprioridades:id,nombre',
      'auxacciones:id,accion',
      'distribucion:id,razonsocial,nomfantasia,telefono,auto,info,productoCDA,desde,hasta,desde1,hasta1,lunes,sabado,obsrecep,fac_imp',
      'productocda:id,productoCDA',
      'distribucionPersonal:id,nombre,apellido',
      'auxtipoPersonal:id,tipo',
      'auxveraz:id,estado,color',
      'auxestados:id,nomEstado',
      'auxcontacto:id,contacto',
      'auxcargos:id,cargo',
      'auxbarrios:id,nombrebarrio',
      'auxmunicipios:id,ciudadmunicipio',
      'auxlocalidades:id,localidad',
      'auxzonas:id,nombre',
      'auxrubros:id,nombre',
      'auxtamanios:id,nombre',
      'auxmodos:id,nombre',
      'distribucionNropedidos:id,id'
    ])
      ->select([
        'id',
        'fecha',
        'hs',
        'prioridad_id',
        'accion_id',
        'temas',
        'cotizacion',
        'fecCot',
        'fecCotEnt',
        'producto_id',
        'distribucion_id',
        'persona_id',
        'tipoper_id',
        'veraz_id',
        'estado_id',
        'contacto_id',
        'cargo_id',
        'barrio_id',
        'municipio_id',
        'localidad_id',
        'zona_id',
        'rubro_id',
        'tamanio_id',
        'modo_id',
        'pedido_id',
        'estadoPedido',
        'status',
      ])
      ->when($search, function ($query, $search) {
        // Filtra los registros por los campos de búsqueda
        return $query->where(function ($q) use ($search) {
          $q->whereHas('distribucion', function ($q) use ($search) {
            $q->where('razonsocial', 'like', "%$search%")
              ->orWhere('nomfantasia', 'like', "%$search%");
          })
            ->orWhere('distribucion_id', 'like', "%$search%")
            ->orWhereHas('auxacciones', function ($q) use ($search) {
              $q->where('accion', 'like', "%$search%");
            })
            ->orWhereHas('auxveraz', function ($q) use ($search) {
              $q->where('estado', 'like', "%$search%");
              // ->orWhere('color', 'like', "%$search%");
            })
            ->orWhereHas('auxestados', function ($q) use ($search) {
              $q->where('nomEstado', 'like', "%$search%");
            })
            ->orWhereHas('distribucionPersonal', function ($q) use ($search) {
              $q->where('nombre', 'like', "%$search%")
                ->orWhere('apellido', 'like', "%$search%");
            })
            ->orWhereHas('auxcontacto', function ($q) use ($search) {
              $q->where('contacto', 'like', "%$search%");
            })
            ->orWhere('temas', 'like', "%$search%")
            ->orWhere('fecha', 'like', "%$search%")
            ->orWhere('hs', 'like', "%$search%");
        });
      })
      ->orderBy('fecha', 'desc') // Ordena por la columna 'fecha' en orden descendente
      ->paginate(12); // Paginación con 12 registros por página

    // dd($agendas);

    // Retorna la vista con los datos
    return view('pages.Distribucion.Agenda.index', compact('agendas'));
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
