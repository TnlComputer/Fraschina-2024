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
    Schema::create('agro_personal', function (Blueprint $table) {
      $table->id();
      $table->string('nombre', 150)->nullable();
      $table->string('apellido', 150)->nullable();
      $table->unsignedBigInteger('agro_id')->nullable();
      $table->unsignedBigInteger('area_id')->nullable();
      $table->unsignedBigInteger('cargo_id')->nullable();
      $table->unsignedBigInteger('categoriacargo_id')->nullable();
      $table->string('teldirecto', 50)->nullable();
      $table->string('interno', 4)->nullable();
      $table->string('telcelular', 50)->nullable();
      $table->unsignedBigInteger('profesion_id')->nullable();
      $table->string('telparticular', 50)->nullable();
      $table->string('email', 150)->nullable();
      $table->longText('observaciones')->nullable();
      $table->boolean('fuera', 1)->nullable();
      $table->string('status', 1)->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('agro_personal');
  }
};
