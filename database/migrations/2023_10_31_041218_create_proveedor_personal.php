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
    Schema::create('proveedor_personal', function (Blueprint $table) {
      $table->id();
      $table->string('nombre', 150)->nullable();
      $table->string('apellido', 150)->nullable();
      $table->unsignedBigInteger('proveedor_id')->nullable();
      $table->unsignedBigInteger('area_id')->nullable();
      $table->unsignedBigInteger('cargo_id')->nullable();
      $table->unsignedBigInteger('categoriacargo_id')->nullable();
      $table->string('teldirecto', 50)->nullable();
      $table->string('interno', 50)->nullable();
      $table->string('telcelular', 50)->nullable();
      $table->unsignedBigInteger('profesion_id')->nullable();
      $table->string('telparticular', 50)->nullable();
      $table->string('email', 150)->nullable();
      $table->longText('observaciones')->nullable();
      $table->boolean('fuera', 1)->nullable();
      $table->string('status', 1)->nullable();
      $table->timestamps();

      $table->foreign('proveedor_id')->references('id')->on('proveedores')->onDelete('set null');
      $table->foreign('area_id')->references('id')->on('AuxAreas')->onDelete('set null');
      $table->foreign('cargo_id')->references('id')->on('AuxCargos')->onDelete('set null');
      $table->foreign('profesion_id')->references('id')->on('auxprofesiones')->onDelete('set null');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('proveedor_personal');
  }
};