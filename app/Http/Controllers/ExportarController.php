<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DatabaseExport;
use App\Exports\TableExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

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
    // Tablas internas o sensibles que nunca se exportan
    return [
      'users',
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

  /**
   * Tablas que se pueden exportar (todas menos las excluidas).
   */
  protected function exportableTables(): array
  {
    return array_values(array_diff(Schema::getTableListing(), $this->getLaravelTables()));
  }

  public function selectTables()
  {
    $tables = $this->exportableTables();

    return view('pages.Tools.Exportar.selectTables', compact('tables'));
  }

  public function generate(Request $request)
  {
    $request->validate([
      'table' => ['required', 'string', Rule::in($this->exportableTables())],
    ], [
      'table.required' => 'Por favor selecciona una tabla.',
      'table.in' => 'La tabla seleccionada no se puede exportar.',
    ]);

    $table = $request->input('table');

    // Generar y descargar el archivo Excel para la tabla seleccionada
    return Excel::download(new TableExport($table), "{$table}.xlsx");
  }
}
