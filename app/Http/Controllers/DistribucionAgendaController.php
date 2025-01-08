<?php

namespace App\Http\Controllers;

use App\Models\AuxAcciones;
use App\Models\AuxBarrios;
use App\Models\AuxCargos;
use App\Models\AuxContacto;
use App\Models\AuxEstados;
use App\Models\AuxLocalidades;
use App\Models\AuxModos;
use App\Models\AuxMunicipios;
use App\Models\AuxPrioridades;
use App\Models\AuxRubros;
use App\Models\AuxTamanios;
use App\Models\AuxVeraz;
use App\Models\AuxZonas;
use App\Models\Distribucion;
use App\Models\Distribucion_Personal;
use App\Models\DistribucionAgenda;
use App\Models\DistribucionLineaPedidos;
use App\Models\productoCDA;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistribucionAgendaController extends Controller
{
  /**
   * Muestra un listado de todos los registros de distribucion_agenda.
   */
  public function index(Request $request)
  {
    // Obtener el término de búsqueda desde la solicitud (si existe)
    $search = $request->input('search');

    // Consulta los registros con las relaciones necesarias, ordenados por fecha descendente

    $agendas = DistribucionAgenda::with([
      // 'distribucion.auxcontacto',
      // 'distribucion.auxveraz',
      // 'distribucion.auxestado',
      // 'distribucion.auxrubro',
      // 'distribucion.auxtamanio',
      // 'distribucion.auxlocalidad',
      // 'distribucion.auxmunicipio',
      // 'distribucion.auxbarrio',
      // 'distribucion.auxzona',
      // 'distribucion.auxcobro',
      // 'distribucion.auxtcobro',
      'auxprioridades:id,nombre,color',
      'auxacciones:id,accion,colorAcc',
      'distribucion:id,razonsocial,nomfantasia,telefono,auto,info,productoCDA,desde,hasta,desde1,hasta1,lunes,sabado,obsrecep,fac_imp,dire_calle_id,piso,dpto,dire_nro,barrio_id,municipio_id,localidad_id,zona_id,rubro_id,tamanio_id,modo_id,contacto_id',
      'distribucionPersonal:id,nombre,apellido',
      'distribucionPersonal.auxtipoPersonal:id,tipo',
      // 'auxveraz:id,estado,color',
      // 'auxestados:id,nomEstado',
      // 'auxcontacto:id,contacto',
      'distribucionPersonal.cargo',
      // 'auxbarrios:id,nombrebarrio',
      // 'auxmunicipios:id,ciudadmunicipio',
      // 'auxlocalidades:id,localidad',
      // 'auxzonas:id,nombre',
      // 'auxrubros:id,nombre',
      // 'auxtamanios:id,nombre',
      // 'auxmodos:id,nombre',
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
      ->where('status', 'A') // Solo registros con status 'A'
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

    // Retorna la vista con los datos
    return view('pages.Distribucion.Agenda.index', compact('agendas'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    // Datos auxiliares para las listas desplegables ordenados alfabéticamente por nombre
    $prioridades = AuxPrioridades::orderBy('nombre', 'asc')
      ->get();

    $acciones = AuxAcciones::where('status', 'A')
      ->orderBy('accion', 'asc')
      ->get();

    // Último pedido asociado al distribucion_id
    $ultimoPedido = DistribucionLineaPedidos::where('status', 'A')
      ->latest('id')
      ->first();

    // Distribuciones con status 'A'
    $distribuciones = Distribucion::select('id', 'nomfantasia', 'razonsocial')
      ->where('status', 'A')
      ->orderBy('nomfantasia', 'asc')
      ->orderBy('razonsocial', 'asc')
      ->get();

    return view('pages.Distribucion.Agenda.create', compact(
      'prioridades',
      'acciones',
      'ultimoPedido',
      'distribuciones'
    ));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    // dd($request);

    // Validación de los datos
    $validated = $request->validate([
      'distribucion_id' => 'required|exists:distribucions,id',
      'fecha' => 'required|date',
      'hs' => 'required|date_format:H:i',
      'prioridad_id' => 'required|exists:auxprioridades,id',
      'accion_id' => 'required|exists:auxacciones,id',
      'persona_id' => 'required|exists:distribucion_personal,id',
      'cotizacion' => 'nullable|string|max:255',
      'temas' => 'nullable|string',
    ]);

    $validated['status'] = 'A';

    // Insertar los datos en la tabla `distribucion_agenda`
    $agenda = DistribucionAgenda::create($validated);

    return redirect()->route('distribucion_agenda.index')
      ->with('success', 'Agenda creada exitosamente.');
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
  public function edit($id)
  {

    $agenda = DistribucionAgenda::findOrFail($id);

    $prioridades = AuxPrioridades::orderBy('nombre', 'asc')
      ->get();

    $acciones = AuxAcciones::where('status', 'A')
      ->orderBy('accion', 'asc')
      ->get();

    // Último pedido asociado al distribucion_id
    $ultimoPedido = DistribucionLineaPedidos::where('status', 'A')
      ->latest('id')
      ->first();

    // Distribuciones con status 'A'
    $distribuciones = Distribucion::select('id', 'nomfantasia', 'razonsocial')
      ->where('status', 'A')
      ->orderBy('nomfantasia', 'asc')
      ->get();

    $personal = Distribucion_Personal::where('distribucion_id', $agenda->distribucion_id)->get();

    $agenda->hs = Carbon::parse($agenda->hs)->format('H:i');

    return view('pages.Distribucion.Agenda.edit', compact(
      'prioridades',
      'acciones',
      'personal',
      'ultimoPedido',
      'distribuciones',
      'agenda'
    ));
  }


  public function getPersonal($id)
  {
    // Lista de personal relacionada con la distribución filtrada por status = 'A'
    $personal = Distribucion_Personal::where('distribucion_id', $id)
      ->where('status', 'A')
      ->orderBy('nombre', 'asc')
      ->orderBy('apellido', 'asc')
      ->get();

    // Devuelve los datos como JSON para ser usados en AJAX
    return response()->json($personal);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, DistribucionAgenda $distribucion_agenda)
  {
    // Validar los datos del formulario
    $request->validate([
      'distribucion_id' => 'required|exists:distribucions,id',
      'fecha' => 'required|date',
      'hs' => 'required|date_format:H:i',
      'prioridad_id' => 'required|exists:auxprioridades,id',
      'accion_id' => 'required|exists:auxacciones,id',
      'temas' => 'nullable|string',
      'cotizacion' => 'nullable|string',
      'persona_id' => 'nullable|exists:distribucion_personal,id',
    ]);

    // Buscar la agenda y actualizar los datos
    $agenda = DistribucionAgenda::findOrFail($distribucion_agenda->id);
    $agenda->update([
      'distribucion_id' => $request->distribucion_id,
      'fecha' => $request->fecha,
      'hs' => $request->hs,
      'prioridad_id' => $request->prioridad_id,
      'accion_id' => $request->accion_id,
      'temas' => $request->temas,
      'cotizacion' => $request->cotizacion,
      'persona_id' => $request->persona_id,
    ]);

    // Redirigir con un mensaje de éxito
    return redirect()->route('distribucion_agenda.index')->with('success', 'Agenda actualizada correctamente.');
  }


  /**
   * Remove the specified resource from storage.
   */
  public function destroy($distribucion_agenda)
  {
    // Encuentra el registro de la agenda por su id
    $agenda = DistribucionAgenda::findOrFail($distribucion_agenda);

    // Cambia el estado a "D" (desactivado)
    $agenda->status = 'D';
    $agenda->save();

    // Redirige a la vista de índice con un mensaje de éxito
    return redirect()->route('distribucion_agenda.index')->with('success', 'Agenda desactivada correctamente.');
  }
}