<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('expedicion_clientes', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('representacion_id')->nullable();
      $table->string('sigla', 5)->nullable();
      $table->string('linea1', 200)->nullable();
      $table->string('linea2', 200)->nullable();
      $table->string('linea3', 200)->nullable();
      $table->string('linea4', 200)->nullable();
      $table->string('linea5', 200)->nullable();
      $table->string('linea6', 200)->nullable();
      $table->longText('obs')->nullable();
      $table->longText('comentarios')->nullable();

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('expedicion_clientes');
  }
};
