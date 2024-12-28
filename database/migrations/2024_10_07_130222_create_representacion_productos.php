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
    Schema::create('representacion_productos', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('representacion_id');
      $table->unsignedBigInteger('producto_id');
      $table->string('pl', 50)->nullable();
      $table->string('P', 50)->nullable();
      $table->string('l', 50)->nullable();
      $table->string('w', 50)->nullable();
      $table->string('glutenhumedo', 50)->nullable();
      $table->string('glutenseco', 50)->nullable();
      $table->string('cenizas', 50)->nullable();
      $table->string('fn', 50)->nullable();
      $table->string('humedad', 50)->nullable();
      $table->string('estabilidad', 50)->nullable();
      $table->string('absorcion', 50)->nullable();
      $table->string('puntuaciones', 50)->nullable();
      $table->longText('particularidades')->nullable();  // No es necesario limitar a 255 si se puede extender
      $table->string('status', 1)->nullable();  // Asegúrate de que sea nullable o tenga valor por defecto
      $table->timestamps();

      // Relación con representacion_id
      $table->foreign('representacion_id')->references('id')->on('representacions')->onDelete('cascade');
      // Relación con aux_producto_id
      $table->foreign('producto_id')->references('id')->on('representacion_aux_productos')->onDelete('cascade');
    });
  }


  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('representacion_productos');
  }
};