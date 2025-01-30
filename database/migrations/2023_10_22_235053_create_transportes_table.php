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
    Schema::create('transportes', function (Blueprint $table) {
      $table->id();
      $table->string('razonsocial', 50)->nullable();
      $table->string('dire_calle', 50)->nullable();
      $table->string('dire_nro', 30)->nullable();
      $table->string('piso', 4)->nullable();
      $table->string('dpto', 4)->nullable();
      $table->string('dire_obs', 100)->nullable();
      $table->string('codpost', 30)->nullable();
      $table->unsignedBigInteger('localidad_id')->nullable();
      $table->string('telefono', 200)->nullable();
      $table->string('fax', 50)->nullable();
      $table->string('cuit', 50)->nullable();
      $table->string('excenciones', 50)->nullable();
      $table->unsignedBigInteger('barrio_id')->nullable();
      $table->longText('info')->nullable();
      $table->string('correo', 150)->nullable();
      $table->unsignedBigInteger('municipio_id')->nullable();
      $table->string('marcas', 200)->nullable();
      $table->string('status', 1)->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('transportes');
  }
};
