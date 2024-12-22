<?php

// namespace App\Exports;

// use Illuminate\Support\Facades\DB;
// use Maatwebsite\Excel\Concerns\FromCollection;

// class TableExport implements FromCollection
// {
//   protected $table;

//   public function __construct($table)
//   {
//     $this->table = $table;
//   }

//   public function collection()
//   {
//     // Obtener los datos de la tabla seleccionada
//     $data = DB::table($this->table)->get();

//     // Retornar los datos de la tabla como una colección
//     return $data;
//   }
// }

// namespace App\Exports;

// use Illuminate\Support\Facades\DB;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\WithHeadings;

// class TableExport implements FromCollection, WithHeadings
// {
//   protected $table;

//   public function __construct($table)
//   {
//     $this->table = $table;
//   }

//   public function collection()
//   {
//     // Obtener los datos de la tabla seleccionada
//     return DB::table($this->table)->get();
//   }

//   public function headings(): array
//   {
//     // Obtener los nombres de las columnas
//     $columns = DB::getSchemaBuilder()->getColumnListing($this->table);

//     // Devuelve el nombre de las columnas como encabezados
//     return $columns;
//   }

// namespace App\Exports;

// use Illuminate\Support\Facades\DB;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\WithHeadings;
// use Illuminate\Support\Facades\Schema;

// class TableExport implements FromCollection, WithHeadings
// {
//   protected $table;

//   public function __construct($table)
//   {
//     $this->table = $table;
//   }

//   public function collection()
//   {
//     // Obtener los datos de la tabla seleccionada
//     return DB::table($this->table)->get();
//   }

//   public function headings(): array
//   {
//     // Obtener los encabezados de las columnas de la tabla
//     return Schema::getColumnListing($this->table); // Obtener columnas dinámicamente
//   }

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TableExport implements FromCollection, WithHeadings
{
  protected $table;

  public function __construct($table)
  {
    $this->table = $table;
  }

  public function collection()
  {
    return DB::table($this->table)->get();
  }

  public function headings(): array
  {
    // Obtén los nombres de las columnas de la tabla
    $columns = DB::getSchemaBuilder()->getColumnListing($this->table);
    return $columns ?: [];
  }
}