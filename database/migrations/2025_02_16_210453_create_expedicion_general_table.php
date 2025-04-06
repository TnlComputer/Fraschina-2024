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
      $table->integer('p')->nullable(); // ❌ Eliminado el (5)
      $table->integer('l')->nullable(); // ❌ Eliminado el (5)
      $table->decimal('pl', 5, 2)->nullable();
      $table->integer('w')->nullable();
      $table->decimal('gh', 5, 2)->nullable();
      $table->decimal('gs', 5, 2)->nullable();
      $table->integer('gi')->nullable();
      $table->decimal('hum', 5, 2)->nullable();
      $table->decimal('cz', 5, 3)->nullable();
      $table->integer('est')->nullable(); // ❌ Eliminado el (5)
      $table->integer('abs')->nullable(); // ✅ Convertido a DECIMAL con precisión
      $table->integer('fn')->nullable();
      $table->integer('punt')->nullable();
      $table->string('particularidades')->nullable();
      $table->char('marca_gral', 1)->nullable(); // ✅ Mejor usar CHAR(1)
      $table->string('controlExp_gral')->nullable();
      $table->string('status')->default('A')->nullable();
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
