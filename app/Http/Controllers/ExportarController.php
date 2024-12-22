<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DatabaseExport;
use App\Exports\TableExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExportarController extends Controller
{
  // public function selectTables()
  // {
  //   // Obtener el nombre de la base de datos desde el entorno
  //   $dbName = env('DB_DATABASE');
  //   if (!$dbName) {
  //     return back()->withErrors('El nombre de la base de datos no está configurado correctamente.');
  //   }

  //   // Obtener las tablas de la base de datos
  //   $tables = DB::select('SHOW TABLES');

  //   // Formatear para obtener solo el nombre de las tablas
  //   $tables = array_map(function ($table) use ($dbName) {
  //     return $table->{'Tables_in_' . $dbName};
  //   }, $tables);

  //   // Filtrar tablas que no quieres mostrar
  //   $excludedTables = ['migrations', 'password_resets', 'personal_access_tokens', 'failed_jobs'];
  //   $tables = array_filter($tables, function ($table) use ($excludedTables) {
  //     return !in_array($table, $excludedTables);
  //   });

  //   // Retornar la vista con las tablas disponibles
  //   return view('Pages.Tools.Exportar.selectTables', compact('tables'));
  // }

  public function getLaravelTables()
  {
    // Detectar las tablas internas de Laravel
    return [
      'migrations',
      'password_resets',
      'password_reset_tokens',
      'personal_access_tokens',
      'jobs',
      'failed_jobs',
      'job_batches',
      'cache',
      'cache_locks',
      'model_has_permissions',
      'model_has_roles',
      'permissions',
      'role_has_permissions',
      'roles',
      'sessions',
      'productos_c_d_a',
      'auxlocalidadesdistribucion',
    ];
  }

  public function selectTables()
  {
    // Obtener las tablas de la base de datos
    $tables = DB::select('SHOW TABLES');

    // Obtener el nombre de la base de datos desde la configuración de Laravel
    $dbName = 'Tables_in_' . env('DB_DATABASE');

    // Extraer solo el nombre de las tablas
    $tables = array_map(function ($table) use ($dbName) {
      return $table->$dbName;
    }, $tables);

    // Obtener las tablas internas de Laravel a excluir
    $excludedTables = $this->getLaravelTables();

    // Filtrar las tablas que no queremos mostrar
    $tables = array_filter($tables, function ($table) use ($excludedTables) {
      return !in_array($table, $excludedTables);
    });

    // Retornar la vista con las tablas disponibles
    return view('Pages.Tools.Exportar.selectTables', compact('tables'));
  }

  public function generate(Request $request)
  {
    // Obtener la tabla seleccionada
    $table = $request->input('table'); // Cambiar a singular para solo una tabla

    if (empty($table)) {
      return redirect()->route('export.selectTables')->with('error', 'Por favor selecciona una tabla.');
    }

    // Generar y descargar el archivo Excel para la tabla seleccionada
    return Excel::download(new TableExport($table), "{$table}.xlsx");
  }
}