<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistribucionController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $name = trim($request->get('name'));

    // Construir la consulta base con ordenamiento por razonsocial
    $query = DB::table('distribucions as d')
      ->join('auxcalles as auxCalle', 'd.dire_calle_id', '=', 'auxCalle.id')
      ->join('auxbarrios as auxB', 'd.barrio_id', '=', 'auxB.id')
      ->join('auxlocalidades as auxLoc', 'd.localidad_id', '=', 'auxLoc.id')
      ->join('auxmunicipios as auxMun', 'd.municipio_id', '=', 'auxMun.id')
      ->join('auxzonas as auxZon', 'd.zona_id', '=', 'auxZon.id')
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
        'auxCalle.calle as dire_calle',
        'auxB.nombrebarrio as barrio',
        'auxLoc.localidad as localidad',
        'auxMun.ciudadmunicipio as municipio',
        'auxZon.nombre as zona'
      )
      ->where('d.status', '=', 'A') // Filtrar por estado activo
      ->orderBy('d.razonsocial', 'asc'); // Ordenar por razonsocial de manera ascendente

    if ($name) {
      $query->where(function ($subQuery) use ($name) {
        $subQuery->where('nomfantasia', 'like', '%' . $name . '%')
          ->orWhere('razonsocial', 'like', '%' . $name . '%')
          ->orWhere('clisg_id', 'like', '%' . $name . '%');
      });
    }

    $distribuciones = $query->paginate(15);

    return view('Pages.Distribucion.index', compact('distribuciones', 'name'));
  }


  /**
   * Display the specified resource.
   */
  // public function show($id)
  // {
  //   $distribucion = DB::table('distribucions as d')
  //     ->join('auxcalles as auxCalle', 'd.dire_calle_id', '=', 'auxCalle.id')
  //     ->join('auxbarrios as auxB', 'd.barrio_id', '=', 'auxB.id')
  //     ->join('auxlocalidades as auxLoc', 'd.localidad_id', '=', 'auxLoc.id')
  //     ->join('auxmunicipios as auxMun', 'd.municipio_id', '=', 'auxMun.id')
  //     ->join('auxzonas as auxZon', 'd.zona_id', '=', 'auxZon.id')
  //     ->join('auxrubros as auxRub', 'd.rubro_id', '=', 'auxRub.id')
  //     ->join('auxtamanio as auxTam', 'd.tamanio_id', '=', 'auxTam.id')
  //     ->join('auxmodosos as auxMod', 'd.modo_id', '=', 'auxMod.id')
  //     ->select(
  //       'd.clisg_id',
  //       'd.razonsocial',
  //       'd.nomfantasia',
  //       'd.dire_nro',
  //       'd.piso',
  //       'd.codpost',
  //       'd.dire_obs',
  //       'd.telefono',
  //       'd.fax',
  //       'd.cuit',
  //       'd.correo',
  //       'd.dpto',
  //       'd.marcas',
  //       'd.info',
  //       'd.id',
  //       'auxCalle.calle as dire_calle',
  //       'auxB.nombrebarrio as barrio',
  //       'auxLoc.localidad as localidad',
  //       'auxMun.ciudadmunicipio as municipio',
  //       'auxZon.nombre as zona',
  //       'auxRub.nombre as rubro',
  //       'auxTam.nombre as tamanio',
  //       'auxMod.nombre as modo',
  //     )
  //     ->where('d.id', '=', $id)
  //     ->where('d.status', '=', 'A')
  //     ->first();

  //   if (!$distribucion) {
  //     return redirect()->route('distribucion.index')->with('error', 'Distribución no encontrada');
  //   }

  //   // dd($distribucion);
  //   $personal = DB::table('distribucion_personal as dp')
  //     ->join('auxareas as a', 'dp.area_id', '=', 'a.id')
  //     ->join('auxcargos as c', 'dp.cargo_id', '=', 'c.id')
  //     ->select('dp.nombre', 'dp.apellido', 'dp.teldirecto', 'dp.interno', 'dp.telcelular', 'dp.email', 'dp.observaciones', 'a.area as area', 'c.cargo as cargo')
  //     ->where('dp.distribucion_id', '=', $id)
  //     ->where('dp.status', '=', 'A')
  //     ->get();

  //   $productos = DB::table('distribucion_productos as dp')
  //     ->join('distribucion_aux_productos as p', 'dp.producto_id', '=', 'p.id')
  //     ->select('p.nombre as producto', 'dp.precio', 'dp.fecha', 'dp.nomproducto')
  //     ->where('dp.distribucion_id', '=', $id)
  //     ->where('dp.status', '=', 'A')
  //     ->get();

  //   return view('Pages.Distribucion.show', compact('distribucion', 'personal', 'productos'));
  // }


  public function show($id)
  {

    try {
      // Consulta principal para la distribución
      $distribucion = DB::table('distribucions as d')
        ->leftJoin('auxcalles as auxCalle', 'd.dire_calle_id', '=', 'auxCalle.id')
        ->leftJoin('auxbarrios as auxB', 'd.barrio_id', '=', 'auxB.id')
        ->leftJoin('auxlocalidades as auxLoc', 'd.localidad_id', '=', 'auxLoc.id')
        ->leftJoin('auxmunicipios as auxMun', 'd.municipio_id', '=', 'auxMun.id')
        ->leftJoin('auxzonas as auxZon', 'd.zona_id', '=', 'auxZon.id')
        ->leftJoin('auxrubros as auxRub', 'd.rubro_id', '=', 'auxRub.id')
        ->leftJoin('auxtamanio as auxTam', 'd.tamanio_id', '=', 'auxTam.id')
        ->leftJoin('auxmodos as auxMod', 'd.modo_id', '=', 'auxMod.id')
        ->leftJoin('auxcontacto as auxCon', 'd.contacto_id', '=', 'auxCon.id')
        ->leftJoin('auxestados as auxEst', 'd.estado_id', '=', 'auxEst.id')
        ->leftJoin('auxcobrar as auxCob', 'd.cobrar_id', '=', 'auxCob.id')
        ->leftJoin('auxpagos as auxCar', 'd.cobrar_id', '=', 'auxCar.id')
        ->leftJoin('auxtipopagos as auxTPg', 'd.tcobro_id', '=', 'auxTPg.id')
        ->leftJoin('auxveraz as auxVer', 'd.veraz_id', '=', 'auxVer.id')
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
          'd.auto',
          'd.marcas',
          'd.info',
          'd.id',
          'd.lunes',
          'd.sabado',
          'd.fac_imp',
          'd.obsrecep',
          'd.desde',
          'd.desde1',
          'd.hasta',
          'd.hasta1',
          'd.productoCDA',
          'auxCalle.calle as dire_calle',
          'auxB.nombrebarrio as barrio',
          'auxLoc.localidad as localidad',
          'auxMun.ciudadmunicipio as municipio',
          'auxZon.nombre as zona',
          'auxRub.nombre as rubro',
          'auxTam.nombre as tamanio',
          'auxMod.nombre as modo',
          'auxCon.contacto as contacto',
          'auxEst.nomEstado as estado',
          'auxVer.estado as veraz',
          'auxCob.accion as cobrar',
          'auxCar.nombre as cobro',
          'auxTPg.nombre as tpago',
        )
        ->where('d.id', '=', $id)
        ->where('d.status', '=', 'A')
        ->first();

      // dd($id, $distribucion);

      if (!$distribucion) {
        return redirect()->route('distribucion.index')->with('error', 'Distribución no encontrada');
      }

      // Consulta para el personal
      $personal = DB::table('distribucion_personal as dp')
        ->leftJoin('auxareas as a', 'dp.area_id', '=', 'a.id')
        ->leftJoin('auxcargos as c', 'dp.cargo_id', '=', 'c.id')
        ->select(
          'dp.nombre',
          'dp.apellido',
          'dp.teldirecto',
          'dp.interno',
          'dp.telcelular',
          'dp.email',
          'dp.observaciones',
          'a.area as area',
          'c.cargo as cargo'
        )
        ->where('dp.distribucion_id', '=', $id)
        ->where('dp.status', '=', 'A')
        ->get();

      // Consulta para los productos
      $productos = DB::table('distribucion_productos as dp')
        ->leftJoin('distribucion_aux_productos as p', 'dp.producto_id', '=', 'p.id')
        // ->select('p.nombre as producto', 'dp.precio', 'dp.fecha', 'dp.nomproducto')
        ->where('dp.distribucion_id', '=', $id)
        ->where('dp.status', '=', 'A')
        ->get();

      return view('Pages.Distribucion.show', compact('distribucion', 'personal', 'productos'));
    } catch (\Exception $e) {
      // Redirigir en caso de error
      return redirect()->route('distribucion.index')->with('error', 'Ocurrió un error: ' . $e->getMessage());
    }
  }
}