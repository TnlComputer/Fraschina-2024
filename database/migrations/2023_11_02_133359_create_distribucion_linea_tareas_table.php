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
    Schema::create('distribucion_linea_tareas', function (Blueprint $table) {
      $table->id();
      $table->date('fecha')->nullable();
      $table->unsignedBigInteger('tadea_id')->nullable();
      $table->decimal('cantidad', 8, 0)->nullable();
      $table->string('linea', 2)->nullable();
      $table->string('bandera', 2)->nullable();
      $table->unsignedBigInteger('distribucion_id');
      $table->date('fechaEntrega')->nullable();
      $table->string('prePed', 1)->nullable();
      $table->decimal('estado_pedido', 1, 0)->nullable();
      $table->unsignedBigInteger('distribucion_tarea_id')->nullable();
      $table->longText('detalles')->nullable();
      $table->unsignedBigInteger('pedido_id')->nullable();
      $table->string('status', 1)->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('distribucion_linea_tareas');
  }
};
