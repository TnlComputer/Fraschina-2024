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
      $table->longText('particularidades', 255)->nullable();
      $table->string('status', 1)->nullable();
      $table->timestamps();
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
