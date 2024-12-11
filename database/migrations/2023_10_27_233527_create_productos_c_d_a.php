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
    Schema::create('productos_c_d_a', function (Blueprint $table) {
      $table->id();
      $table->string('productoCDA', 150);
      $table->double('ivancda', 10, 2)->nullable();
      $table->string('ivacda', 10)->nullable();
      $table->decimal('stockmincda')->nullable();
      $table->decimal('stockmaxcda')->nullable();
      $table->decimal('stockcda')->nullable();
      $table->decimal('stockreservacda')->nullable();
      $table->decimal('stockdisponiblecda')->nullable();
      $table->decimal('stockfecentcda')->nullable();
      $table->date('cantultent')->nullable();
      $table->string('status', 1)->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('productos_c_d_a');
  }
};
