<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribucionLineaPedidos extends Model
{
  use HasFactory;

  protected $table = 'distribucion_linea_pedidos';

  protected $fillable = [
    'pedido_id',
    'id_linea',
    'fecha',
    'producto_id',
    'cantidad',
    'precio_unitario',
    'totalPedido',
    'totalPedidoN',
    'total_factura',
    'nombre_producto',
    'linea',
    'bandera',
    'distribucion_id',
    'fechaEntrega',
    'prePed',
    'cambiar',
    'retirar',
    'estado_pedido',
    'estado_tarea',
    'chofer',
    'orden',
    'fechaFactura',
    'nroFactura',
    'estado_stock',
    'status',
  ];

  public function distribucion()
  {
    return $this->belongsTo(DistribucionNroPedidos::class, 'id');
  }
}
