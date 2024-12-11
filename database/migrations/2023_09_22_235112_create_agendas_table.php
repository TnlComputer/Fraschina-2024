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
    Schema::create('agendas', function (Blueprint $table) {
      $table->id();
      $table->string('nombre', 100)->nullable();
      $table->string('apellido', 100)->nullable();
      $table->string('nomApe', 200)->nullable();
      $table->string('empresa_institucion')->nullable();
      $table->string('profesion_especialidad_oficio')->nullable();
      $table->unsignedBigInteger('cod_prof')->nullable();
      $table->string('tel_particular', 100)->nullable();
      $table->string('tel_laboral', 100)->nullable();
      $table->string('interno', 20)->nullable();
      $table->string('celular', 100)->nullable();
      $table->string('mail', 100)->nullable();
      $table->string('direccion')->nullable();
      $table->longText('observaciones')->nullable();
      $table->string('buscador1', 800)->nullable();
      $table->string('buscador2', 800)->nullable();
      $table->string('buscador3', 800)->nullable();
      $table->string('status', 1)->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('agendas');
  }
};
