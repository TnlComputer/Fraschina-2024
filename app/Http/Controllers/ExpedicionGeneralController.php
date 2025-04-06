<?php

namespace App\Http\Controllers;

use App\Exports\ExpedicionGeneralExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ExpedicionGeneral;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ExpedicionGeneralController extends Controller
{
  /**
   * Display a listing of the resource.
   */

  public function index(Request $request)
  {
    $query = ExpedicionGeneral::query();

    if ($request->filled('fecha')) {
      $fecha = $request->fecha;

      // Si ingresó solo el año (YYYY)
      if (preg_match('/^\d{4}$/', $fecha)) {
        $query->where('fecha', 'like', "{$fecha}%"); // Busca YYYYxxxx
      }
      // Si ingresó año y mes (YYYYMM)
      elseif (preg_match('/^\d{6}$/', $fecha)) {
        $query->where('fecha', 'like', "{$fecha}%"); // Busca YYYYMMxx
      }
      // Si ingresó la fecha completa (YYYYMMDD)
      elseif (preg_match('/^\d{8}$/', $fecha)) {
        try {
          $fechaFormato = \Carbon\Carbon::createFromFormat('Ymd', $fecha)->format('Y-m-d');
          $query->whereDate('fecha', $fechaFormato);
        } catch (\Exception $e) {
          // Si hay un error en el formato, simplemente no filtra.
        }
      }
    }
    if ($request->filled('mo')) {
      $query->where('mo', 'like', "%{$request->mo}%");
    }
    if ($request->filled('cl')) {
      $query->where('cl', 'like', "%{$request->cl}%");
    }
    if ($request->filled('modo')) {
      $query->where('modo', 'like', "%{$request->modo}%");
    }
    if ($request->filled('prod')) {
      $query->where('prod', 'like', "%{$request->prod}%");
    }
    if ($request->filled('p')) {
      $query->where('p', 'like', "%{$request->p}%");
    }
    if ($request->filled('l')) {
      $query->where('l', 'like', "%{$request->l}%");
    }
    if ($request->filled('pl')) {
      $query->where('pl', 'like', "%{$request->pl}%");
    }
    if ($request->filled('w')) {
      $query->where('w', 'like', "%{$request->w}%");
    }
    if ($request->filled('gh')) {
      $query->where('gh', 'like', "%{$request->gh}%");
    }
    if ($request->filled('gs')) {
      $query->where('gs', 'like', "%{$request->gs}%");
    }
    if ($request->filled('hum')) {
      $query->where('hum', 'like', "%{$request->hum}%");
    }
    if ($request->filled('cz')) {
      $query->where('cz', 'like', "%{$request->cz}%");
    }
    if ($request->filled('est')) {
      $query->where('est', 'like', "%{$request->est}%");
    }
    if ($request->filled('abs')) {
      $query->where('abs', 'like', "%{$request->abs}%");
    }
    if ($request->filled('fn')) {
      $query->where('fn', 'like', "%{$request->fn}%");
    }
    if ($request->filled('punt')) {
      $query->where('punt', 'like', "%{$request->punt}%");
    }
    if ($request->filled('particularidades')) {
      $query->where('particularidades', 'like', "%{$request->particularidades}%");
    }

    $expedicion_general = $query->orderBy('fecha', 'desc')->paginate(10);

    return view('pages.Expedicion.General.index', compact('expedicion_general'));
  }


  /**
   * Show the form for creating a new resource.
   */
  // Mostrar el formulario para crear un nuevo registro
  public function create()
  {
    return view('pages.Expedicion.General.create');
  }

  // Almacenar el nuevo registro en la base de datos
  public function store(Request $request)
  {
    $request->validate([
      'fecha' => 'required|date',
      'mo' => 'required|max:5',
      'cl' => 'required|max:5',
      'modo' => 'nullable|string',
      'prod' => 'nullable|string',
      'p' => 'nullable|numeric',
      'l' => 'nullable|numeric',
      'pl' => 'nullable|numeric',
      'w' => 'nullable|numeric',
      'gh' => 'nullable|numeric',
      'gs' => 'nullable|numeric',
      'hum' => 'nullable|numeric',
      'cz' => 'nullable|numeric',
      'est' => 'nullable|numeric',
      'abs' => 'nullable|numeric',
      'fn' => 'nullable|numeric',
      'punt' => 'nullable|numeric',
      'particularidades' => 'nullable|string',
    ]);

    ExpedicionGeneral::create($request->all());

    return redirect()->route('expedicion_general.index')->with('success', 'Expedición creada exitosamente.');
  }

  /**
   * Display the specified resource.
   */
  public function show(ExpedicionGeneral $expedicionGeneral)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  // Mostrar el formulario para editar un registro
  public function edit($id)
  {
    $expedicionGeneral = ExpedicionGeneral::findOrFail($id);
    return view('pages.Expedicion.General.edit', compact('expedicionGeneral'));
  }

  /**
   * Update the specified resource in storage.
   */
  // Actualizar un registro existente
  public function update(Request $request, $id)
  {
    $request->validate([
      'fecha' => 'required|date',
      'mo' => 'required|max:5',
      'cl' => 'required|max:5',
      'modo' => 'nullable|string',
      'prod' => 'nullable|string',
      'p' => 'nullable|numeric',
      'l' => 'nullable|numeric',
      'pl' => 'nullable|numeric',
      'w' => 'nullable|numeric',
      'gh' => 'nullable|numeric',
      'gs' => 'nullable|numeric',
      'hum' => 'nullable|numeric',
      'cz' => 'nullable|numeric',
      'est' => 'nullable|numeric',
      'abs' => 'nullable|numeric',
      'fn' => 'nullable|numeric',
      'punt' => 'nullable|numeric',
      'particularidades' => 'nullable|string',
    ]);

    $expedicionGeneral = ExpedicionGeneral::findOrFail($id);
    $expedicionGeneral->update($request->all());

    return redirect()->route('expedicion_general.index')->with('success', 'Expedición actualizada exitosamente.');
  }


  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    // Buscar el registro por ID
    $expedicionGeneral = ExpedicionGeneral::findOrFail($id);

    // Cambiar el estado de "A" a "D"
    $expedicionGeneral->status = 'D';
    $expedicionGeneral->save();

    // Redirigir con un mensaje de éxito
    return redirect()->route('expedicion_general.index')->with('success', 'Expedición desactivada correctamente.');
  }

  public function export(Request $request)
  {
    $query = ExpedicionGeneral::query();

    if ($request->filled('fecha')) {
      $fecha = $request->fecha;

      // Si ingresó solo el año (YYYY)
      if (preg_match('/^\d{4}$/', $fecha)) {
        $query->where('fecha', 'like', "{$fecha}%"); // Busca YYYYxxxx
      }
      // Si ingresó año y mes (YYYYMM)
      elseif (preg_match('/^\d{6}$/', $fecha)) {
        $query->where('fecha', 'like', "{$fecha}%"); // Busca YYYYMMxx
      }
      // Si ingresó la fecha completa (YYYYMMDD)
      elseif (preg_match('/^\d{8}$/', $fecha)) {
        try {
          $fechaFormato = \Carbon\Carbon::createFromFormat('Ymd', $fecha)->format('Y-m-d');
          $query->whereDate('fecha', $fechaFormato);
        } catch (\Exception $e) {
          // Si hay un error en el formato, simplemente no filtra.
        }
      }
    }


    if ($request->filled('mo')) {
      $query->where('mo', 'like', "%{$request->mo}%");
    }
    if ($request->filled('cl')) {
      $query->where('cl', 'like', "%{$request->cl}%");
    }
    if ($request->filled('modo')) {
      $query->where('modo', 'like', "%{$request->modo}%");
    }
    if ($request->filled('prod')) {
      $query->where('prod', 'like', "%{$request->prod}%");
    }
    if ($request->filled('p')) {
      $query->where('p', 'like', "%{$request->p}%");
    }
    if ($request->filled('l')) {
      $query->where('l', 'like', "%{$request->l}%");
    }
    if ($request->filled('pl')) {
      $query->where('pl', 'like', "%{$request->pl}%");
    }
    if ($request->filled('w')) {
      $query->where('w', 'like', "%{$request->w}%");
    }
    if ($request->filled('gh')) {
      $query->where('gh', 'like', "%{$request->gh}%");
    }
    if ($request->filled('gs')) {
      $query->where('gs', 'like', "%{$request->gs}%");
    }
    if ($request->filled('hum')) {
      $query->where('hum', 'like', "%{$request->hum}%");
    }
    if ($request->filled('cz')) {
      $query->where('cz', 'like', "%{$request->cz}%");
    }
    if ($request->filled('est')) {
      $query->where('est', 'like', "%{$request->est}%");
    }
    if ($request->filled('abs')) {
      $query->where('abs', 'like', "%{$request->abs}%");
    }
    if ($request->filled('fn')) {
      $query->where('fn', 'like', "%{$request->fn}%");
    }
    if ($request->filled('punt')) {
      $query->where('punt', 'like', "%{$request->punt}%");
    }
    if ($request->filled('particularidades')) {
      $query->where('particularidades', 'like', "%{$request->particularidades}%");
    }

    $expediciones = $query->get();

    // Si no hay datos, mostrar un mensaje en lugar de generar un archivo vacío
    if ($expediciones->isEmpty()) {
      return back()->with('error', 'No hay datos para exportar con los filtros aplicados.');
    }


    $fecha = Carbon::now()->format('Y-m-d'); // Obtiene la fecha actual en formato YYYY-MM-DD
    $nombreArchivo = 'expedicion_general-' . $fecha . '.xlsx'; // Crea el nombre del archivo

    return Excel::download(new ExpedicionGeneralExport($expediciones), $nombreArchivo);
  }
}
