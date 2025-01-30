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
    Schema::create('distribucion_nropedidos', function (Blueprint $table) {
      $table->id();
      $table->string('tipo', 2);
      $table->unsignedBigInteger('distribucion_id');
      $table->date('fecha')->nullable();
      $table->date('fechaEntrega')->nullable();
      $table->date('fechaFactura')->nullable();
      $table->string('nroFactura', 20)->nullable();
      $table->decimal('totalFactura', 12, 2)->nullable();
      $table->date('totalPedido')->nullable();
      $table->string('chofer', 2)->nullable();
      $table->integer('orden')->nullable();
      $table->longText('observaciones')->nullable();
      $table->string('status')->default('A')->nullable();
      $table->timestamps();

      // Clave foránea para distribucion_id
      $table->foreign('distribucion_id')
        ->references('id')
        ->on('distribucions')  // Tabla que contiene las distribuciones
        ->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('distribucion_nropedidos');
  }
};