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
    Schema::create('proveedor_productos', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('proveedor_id');
      $table->unsignedBigInteger('producto_id');
      $table->string('status', 1)->nullable();
      $table->timestamps();

      // Relación con representacion_id
      $table->foreign('proveedor_id')->references('id')->on('proveedores')->onDelete('cascade');
      // Relación con aux_producto_id
      $table->foreign('producto_id')->references('id')->on('proveedor_aux_productos')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('proveedor_productos');
  }
};
