<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    // Schema::create('distribucion_linea_pedidos', function (Blueprint $table) {
    //   $table->id();
    //   $table->unsignedBigInteger('pedido_id')->nullable();
    //   $table->date('fecha')->nullable();
    //   $table->unsignedBigInteger('producto_id')->nullable();
    //   $table->integer('cantidad')->nullable();
    //   $table->decimal('precio_unitario', 12, 2)->nullable();
    //   $table->string('totalPedido', 12)->nullable();
    //   $table->decimal('totalPedidoN', 12, 2)->nullable();
    //   $table->decimal('total_factura', 12, 2)->nullable();
    //   $table->string('nombre_producto', 120)->nullable();
    //   $table->string('linea', 2)->nullable();
    //   $table->string('bandera', 2)->nullable();
    //   $table->unsignedBigInteger('distribucion_id')->nullable();
    //   $table->date('fechaEntrega')->nullable();
    //   $table->string('prePed', 1)->nullable();
    //   $table->string('cambiar', 2)->nullable();
    //   $table->string('retirar', 2)->nullable();
    //   $table->string('estado_pedido', 1, 0)->nullable();
    //   $table->string('estado_tarea', 1, 0)->nullable();
    //   $table->string('chofer', 2)->nullable();
    //   $table->string('orden', 2, 0)->nullable();
    //   $table->date('fechaFactura')->nullable();
    //   $table->string('nroFactura', 20)->nullable();
    //   $table->string('estado_stock', 1, 0)->nullable();
    //   $table->integer('status', 1)->nullable();
    //   $table->timestamps();
    Schema::create('distribucion_linea_pedidos', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('pedido_id')->nullable();
      $table->date('fecha')->nullable();
      $table->unsignedBigInteger('producto_id')->nullable();
      $table->integer('cantidad')->nullable();
      $table->decimal('precio_unitario', 12, 2)->nullable();
      $table->string('totalPedido', 12)->nullable();
      $table->decimal('totalPedidoN', 12, 2)->nullable();
      $table->decimal('total_factura', 12, 2)->nullable();
      $table->string('nombre_producto', 120)->nullable();
      $table->string('linea', 2)->nullable();
      $table->string('bandera', 2)->nullable();
      $table->unsignedBigInteger('distribucion_id');
      $table->date('fechaEntrega')->nullable();
      $table->string('prePed', 1)->nullable();
      $table->string('cambiar', 2)->nullable();
      $table->string('retirar', 2)->nullable();
      $table->string('estado_pedido', 1)->nullable();
      $table->string('estado_tarea', 1)->nullable();
      $table->string('chofer', 2)->nullable();
      $table->string('orden', 2)->nullable();
      $table->date('fechaFactura')->nullable();
      $table->string('nroFactura', 20)->nullable();
      $table->string('estado_stock', 1)->nullable();
      $table->integer('status')->nullable();
      $table->timestamps();

      // Claves foráneas
      $table->foreign('pedido_id')->references('nropedido')->on('distribucion_nropedidos')->onDelete('cascade');
      $table->foreign('producto_id')->references('id')->on('distribucion_productos')->onDelete('cascade');
      $table->foreign('distribucion_id')->references('id')->on('distribucions')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('distribucion_linea_pedidos');
  }
};