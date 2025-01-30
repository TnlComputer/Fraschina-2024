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
    Schema::create('distribucion_productos', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('distribucion_id');
      $table->unsignedBigInteger('producto_id');
      $table->float('precio', 20, 2)->nullable();
      $table->date('fecha')->nullable();
      $table->string('nomproducto', 150)->nullable();
      $table->date('fechaUEnt')->nullable();
      $table->string('status', 1)->nullable();
      $table->timestamps();

      $table->foreign('distribucion_id')->references('id')->on('distribucions')->onDelete('cascade');
      $table->foreign('producto_id')->references('id')->on('productos_c_d_a')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('distribucion_productos');
  }
};
