<?php

namespace App\Http\Controllers;

use App\Models\AgendaGral;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AgendaGralController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $name = trim($request->get('name'));
    if ($name) {
      $agendaGral = DB::table('agendageneral as ag')
        ->join('AuxProfesion as auxProf', 'ag.cod_prof', '=', 'auxProf.idProfesion')
        ->select(
          'ag.Nombre',
          'ag.Apellido',
          'ag.Empresa_Institucion',
          'auxProf.Profesion',
          'ag.Tel_Particular',
          'ag.Tel_Laboral',
          'ag.Interno',
          'ag.Celular',
          'ag.Mail',
          'ag.Direccion',
          'ag.Observaciones',
          'ag.IDagenda',
          'auxProf.Profesion as Profesion_Especialidad_Oficio',
        )
        ->where('Nombre', 'like', '%' . $request->name . '%')
        ->orWhere('Apellido', 'like', '%' . $request->name . '%')
        ->orWhere('Empresa_Institucion', 'like', '%' . $request->name . '%')
        // ->orWhere('profesion_especialidad_oficio', 'like', '%' . $request->name . '%')
        ->paginate(10);
    } else {
      $agendaGral = DB::table('agendageneral as ag')
        ->join('AuxProfesion as auxProf', 'ag.cod_prof', '=', 'auxProf.idProfesion')
        ->select(
          'ag.Nombre',
          'ag.Apellido',
          'ag.Empresa_Institucion',
          'auxProf.Profesion',
          'ag.Tel_Particular',
          'ag.Tel_Laboral',
          'ag.Interno',
          'ag.Celular',
          'ag.Mail',
          'ag.Direccion',
          'ag.Observaciones',
          'ag.IDagenda',
          'auxProf.Profesion as Profesion_Especialidad_Oficio',
        )
        // ->where('Nombre', 'like', '%' . $request->name . '%')
        // ->orWhere('Apellido', 'like', '%' . $request->name . '%')
        // ->orWhere('Empresa_Institucion', 'like', '%' . $request->name . '%')
        // ->orWhere('profesion_especialidad_oficio', 'like', '%' . $request->name . '%')
        ->paginate(10);
    }
    return view('Pages.AgendaGral.index', compact('agendaGral', 'name'));
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
    $personal = AgendaGral::find($id);
    $profesiones = DB::table('auxprofesiones as auxProf')
      ->where('auxProf.agendas', '=', 'SI')
      ->orderBy('nombreprofesion', 'asc')
      ->get();
    // $profesiones = AuxProfesion::all();
    return view('Pages.AgendaGral.edit', ['personal' => $personal, 'profesiones' => $profesiones]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, AgendaGral $agendaGral)
  {
    $agendaGral->update($request->all());
    return redirect()->route(
      'Pages.AgendaGral.index',
      ['agenda' => $agendaGral->id]
    )->with('success', 'Actualizado con exito');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(AgendaGral $agendaGral)
  {
    $agenda = AgendaGral::findOrFail($agendaGral->id);
    $agenda->status = 'C';
    $agenda->update();
    return redirect()->route('Pages.AgendaGral.index')
      ->with('danger', 'Contacto Eliminado');
  }
}