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
    Schema::create('expedicion_general', function (Blueprint $table) {
      $table->id();
      $table->date('fecha')->nullable();
      $table->string('mo')->nullable();
      $table->string('cl')->nullable();
      $table->string('modo')->nullable();
      $table->string('prod')->nullable();
      $table->string('p')->nullable();
      $table->string('l')->nullable();
      $table->string('pl')->nullable();
      $table->string('w')->nullable();
      $table->string('gh')->nullable();
      $table->string('gs')->nullable();
      $table->string('hum')->nullable();
      $table->string('cz')->nullable();
      $table->string('est')->nullable();
      $table->string('abs')->nullable();
      $table->string('fn')->nullable();
      $table->string('punt')->nullable();
      $table->string('particularidades')->nullable();
      $table->string('marca_gral', 1)->nullable();
      $table->unsignedBigInteger('controlExp_gral')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('expedicion_general');
  }
};
