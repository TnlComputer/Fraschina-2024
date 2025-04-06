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
    Schema::create('fichas', function (Blueprint $table) {
      $table->id();
      $table->integer('m');
      $table->integer('pn');
      $table->string('es');
      $table->date('fe');
      $table->string('ord');
      $table->string('pl');
      $table->string('ca');
      $table->string('tb');
      $table->integer('k');
      $table->double('p', 5, 3);
      $table->double('i', 12, 2);
      $table->string('d');
      $table->integer('n');
      $table->date('fp');
      $table->integer('pp');
      $table->string('o');
      // $table->unsignedBigInteger('origen_tabla');
      $table->string('origen_tabla');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('fichas');
  }
};
