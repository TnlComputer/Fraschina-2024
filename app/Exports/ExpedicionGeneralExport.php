<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExpedicionGeneralExport implements FromCollection, WithHeadings
{
  protected $expediciones;

  public function __construct($expediciones)
  {
    $this->expediciones = $expediciones;
  }

  public function collection()
  {
    return $this->expediciones;
  }

  public function headings(): array
  {
    return [
      'ID',
      'Fecha',
      'MO',
      'CL',
      'Modo',
      'Prod',
      'P',
      'L',
      'PL',
      'W',
      'GH',
      'GS',
      'HUM',
      'CZ',
      'EST',
      'ABS',
      'FN',
      'Punt',
      'Particularidades'
    ];
  }
}