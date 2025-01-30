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
      $table->unsignedBigInteger('pedido_id')->nullable();
      $table->unsignedBigInteger('distribucion_id');
      $table->date('fecha')->nullable();
      $table->date('fechaEntrega')->nullable();
      $table->string('linea', 2)->nullable();
      $table->unsignedBigInteger('tarea_id')->nullable();
      $table->longText('detalles')->nullable();
      $table->decimal('estado_pedido', 1, 0)->nullable();
      $table->string('status', 1)->nullable();
      $table->timestamps();

      // Claves foráneas
      $table->foreign('pedido_id')
        ->references('id')
        ->on('distribucion_nropedidos')
        ->onDelete('cascade');
    });

    Schema::table('distribucion_linea_tareas', function (Blueprint $table) {
      $table->foreign('tarea_id')->references('id')->on('distribucion_tareas')->onDelete('cascade');
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
