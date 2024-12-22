<?php

// namespace App\Exports;

// use Illuminate\Support\Facades\DB;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\WithHeadings;

// class DatabaseExport implements FromCollection, WithHeadings
// {
//   protected $tables;

//   public function __construct($tables)
//   {
//     $this->tables = $tables;
//   }

//   public function collection()
//   {
//     $data = collect();

//     // Si hay tablas seleccionadas, las recorremos
//     foreach ($this->tables as $table) {
//       $tableData = DB::table($table)->get(); // Obtiene todos los registros de la tabla
//       $data = $data->merge($tableData); // Combina los registros de todas las tablas
//     }

//     return $data;
//   }

//   public function headings(): array
//   {
//     // Deberías definir diferentes encabezados según las tablas, o determinar dinámicamente
//     if ($this->tables[0] == 'tabla_1') {
//       return ['ID', 'Nombre', 'Representación', 'Distribución']; // Encabezados para tabla_1
//     }

//     if ($this->tables[0] == 'tabla_2') {
//       return ['ID', 'Molinos', 'Proveedores', 'Agros']; // Encabezados para tabla_2
//     }

//     // Puedes agregar lógica similar para cada tabla seleccionada

//     return ['ID', 'Campo 1', 'Campo 2']; // Default headers
//   }
// }

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DatabaseExport implements FromCollection, WithHeadings
{
  protected $tables;

  public function __construct($tables)
  {
    $this->tables = $tables;
  }

  public function collection()
  {
    $data = collect();

    // Si hay tablas seleccionadas, las recorremos
    foreach ($this->tables as $table) {
      $tableData = DB::table($table)->get(); // Obtiene todos los registros de la tabla
      $data = $data->merge($tableData); // Combina los registros de todas las tablas
    }

    return $data;
  }

  public function headings(): array
  {
    $headings = [];

    // Recorre las tablas seleccionadas para obtener los encabezados
    foreach ($this->tables as $table) {
      $columns = DB::getSchemaBuilder()->getColumnListing($table); // Obtiene los nombres de las columnas de la tabla
      $headings[] = ['Tabla: ' . $table];  // Título de la tabla

      // Añadir los encabezados de las columnas
      $headings[] = $columns;
    }

    return $headings;
  }
}
